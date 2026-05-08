<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists('settings.json')) {
        $json = file_get_contents('settings.json');
        echo $json;
    } else {
        echo json_encode([]);
    }
}
