<?php
// filepath: c:\Users\Starlord\Desktop\status.php

session_start();

// Check if it's a POST request to update the status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $timeout = isset($_POST['timeout']) ? intval($_POST['timeout']) : 10; // Default to 10 seconds
    $_SESSION['buttonClicked'] = true;
    $_SESSION['timeout'] = $timeout;
    $_SESSION['timestamp'] = time(); // Store the current time
    echo json_encode(['success' => true]);
    exit;
}

// Check if it's a GET request to retrieve the status
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $buttonClicked = isset($_SESSION['buttonClicked']) ? $_SESSION['buttonClicked'] : false;
    $timeout = isset($_SESSION['timeout']) ? $_SESSION['timeout'] : 0;
    $timestamp = isset($_SESSION['timestamp']) ? $_SESSION['timestamp'] : 0;

    // Check if the timeout has expired
    if ($buttonClicked && (time() - $timestamp) > $timeout) {
        $_SESSION['buttonClicked'] = false; // Reset the status
        $buttonClicked = false;
    }

    echo json_encode(['buttonClicked' => $buttonClicked, 'timeout' => $timeout]);
    exit;
}
?>