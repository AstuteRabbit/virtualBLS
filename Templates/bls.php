<?php

//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>


$expires = isset($_GET['expires']) ? intval($_GET['expires']) : 0;
if ($expires === 0 || time() > $expires) {
    http_response_code(410);
    die('This session link has expired.');
}
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