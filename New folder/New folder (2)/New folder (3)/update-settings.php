<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settings = [
        'timeout' => $_POST['timeout'] ?? '',
        'background' => $_POST['background'] ?? '',
        'target' => $_POST['target'] ?? '',
        'refresh' => $_POST['refresh'] ?? false

    ];
    
    $json = json_encode($settings);
    file_put_contents('settings.json', $json);
    
    echo json_encode(['success' => true]);
}
   