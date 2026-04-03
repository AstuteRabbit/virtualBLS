<?php
$expires = isset($_GET['expires']) ? intval($_GET['expires']) : 0;
if ($expires === 0 || time() > $expires) {
    http_response_code(410);
    die('This session link has expired.');
}
 
$base_dir = dirname(__DIR__);
$state_file = $base_dir . '/settings_state.json';
$settings_file = $base_dir . '/settings.json';
$heartbeat_ttl_seconds = 15;

function clear_settings_json($path) {
    $fp = fopen($path, 'c+');
    if (!$fp) {
        return false;
    }

    if (!flock($fp, LOCK_EX)) {
        fclose($fp);
        return false;
    }

    ftruncate($fp, 0);
    rewind($fp);
    fwrite($fp, "{}\n");
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
    return true;
}

$state_fp = fopen($state_file, 'c+');
if (!$state_fp || !flock($state_fp, LOCK_EX)) {
    if ($state_fp) {
        fclose($state_fp);
    }
    http_response_code(500);
    die('Unable to validate settings activity.');
}

$state_raw = stream_get_contents($state_fp);
$state = $state_raw ? json_decode($state_raw, true) : [];
if (!is_array($state)) {
    $state = [];
}

$last_seen = isset($state['last_seen']) ? intval($state['last_seen']) : 0;
$settings_active = $last_seen > 0 && (time() - $last_seen) <= $heartbeat_ttl_seconds;

if (!$settings_active) {
    clear_settings_json($settings_file);

    $state['last_seen'] = 0;
    ftruncate($state_fp, 0);
    rewind($state_fp);
    fwrite($state_fp, json_encode($state, JSON_UNESCAPED_SLASHES));
    fflush($state_fp);
    flock($state_fp, LOCK_UN);
    fclose($state_fp);

    http_response_code(409);
    die('Settings is not active. Please open settings.php and try again.');
}

flock($state_fp, LOCK_UN);
fclose($state_fp);
?>
<!DOCTYPE html> 
<html lang="en-us">
    <head>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . '/wp-content/custom/includes/blsHead.php';
        ?>
    </head>
    <body>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/wp-content/custom/includes/blsBody.php';
    ?> 
    </body>
    
    <script src="../../../custom/resources/scripts/script.js" type="text/javascript"></script>
    <script src="../../../custom/resources/scripts/applySettings.js" type="text/javascript"></script>
    <script src="../../../custom/resources/scripts/status.js" type="text/javascript"></script>

</html>