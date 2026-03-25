<?php
//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>

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