<?php

//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>


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
   