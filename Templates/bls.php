<?php
$expires = isset($_GET['x']) ? intval($_GET['x']) : 0;
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