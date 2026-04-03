<?php
// Heartbeat endpoint for the settings page.
if (!session_id()) {
    session_start();
}

$token_is_valid = isset($_SESSION['settings_page_token']) &&
    isset($_SESSION['settings_page_token_time']) &&
    (time() - $_SESSION['settings_page_token_time']) < 3600;

if (!$token_is_valid) {
    http_response_code(403);
    die('Access Denied.');
}

$base_dir = dirname(__DIR__);
$state_file = $base_dir . '/settings_state.json';

$fp = fopen($state_file, 'c+');
if (!$fp) {
    http_response_code(500);
    die('Unable to update heartbeat state.');
}

if (!flock($fp, LOCK_EX)) {
    fclose($fp);
    http_response_code(500);
    die('Unable to lock heartbeat state.');
}

$raw = stream_get_contents($fp);
$state = $raw ? json_decode($raw, true) : [];
if (!is_array($state)) {
    $state = [];
}

if (isset($_GET['close']) && $_GET['close'] === '1') {
    $state['last_seen'] = 0;
} else {
    $state['last_seen'] = time();
}

ftruncate($fp, 0);
rewind($fp);
fwrite($fp, json_encode($state, JSON_UNESCAPED_SLASHES));
fflush($fp);
flock($fp, LOCK_UN);
fclose($fp);

header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
http_response_code(204);
