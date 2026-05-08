<?php
// Set the headers to prevent caching and ensure the JSON response
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

$storePath = __DIR__ . '/status-store.json';

function loadStatusStore($path)
{
    if (!file_exists($path)) {
        return [];
    }

    $raw = file_get_contents($path);
    if ($raw === false || $raw === '') {
        return [];
    }

    $decoded = json_decode($raw, true);
    return is_array($decoded) ? $decoded : [];
}

function saveStatusStore($path, $store)
{
    file_put_contents($path, json_encode($store), LOCK_EX);
}

function sanitizeStatusKey($key)
{
    $key = (string)$key;
    if ($key === '' || strlen($key) > 128) {
        return '';
    }

    return preg_match('/^[A-Za-z0-9._-]+$/', $key) ? $key : '';
}

// Check if it's a POST request to update the status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $statusKey = sanitizeStatusKey($_POST['statusKey'] ?? '');
    if ($statusKey === '') {
        http_response_code(400);
        echo json_encode(['success' => false, 'error' => 'Missing or invalid status key']);
        exit;
    }

    $action = strtolower(trim((string)($_POST['action'] ?? 'start')));

    if ($action === 'stop') {
        $store = loadStatusStore($storePath);
        $store[$statusKey] = [
            'buttonClicked' => false,
            'timeout' => 0,
            'timestamp' => time()
        ];
        saveStatusStore($storePath, $store);

        echo json_encode(['success' => true]);
        exit;
    }

    $timeout = isset($_POST['timeout']) ? intval($_POST['timeout']) : 10; // Default to 10 seconds
    $timeout = max(1, min(3600, $timeout));

    $store = loadStatusStore($storePath);
    $store[$statusKey] = [
        'buttonClicked' => true,
        'timeout' => $timeout,
        'timestamp' => time()
    ];
    saveStatusStore($storePath, $store);

    echo json_encode(['success' => true]);
    exit;
}

// Check if it's a GET request to retrieve the status
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $statusKey = sanitizeStatusKey($_GET['statusKey'] ?? '');
    if ($statusKey === '') {
        echo json_encode(['buttonClicked' => false, 'timeout' => 0]);
        exit;
    }

    $store = loadStatusStore($storePath);
    $entry = isset($store[$statusKey]) && is_array($store[$statusKey]) ? $store[$statusKey] : [];

    $buttonClicked = !empty($entry['buttonClicked']);
    $timeout = isset($entry['timeout']) ? intval($entry['timeout']) : 0;
    $timestamp = isset($entry['timestamp']) ? intval($entry['timestamp']) : 0;

    // Check if the timeout has expired
    if ($buttonClicked && (time() - $timestamp) > $timeout) {
        if (isset($store[$statusKey])) {
            $store[$statusKey]['buttonClicked'] = false;
            saveStatusStore($storePath, $store);
        }
        $buttonClicked = false;
    }

    echo json_encode(['buttonClicked' => $buttonClicked, 'timeout' => $timeout]);
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'error' => 'Method not allowed']);
?>