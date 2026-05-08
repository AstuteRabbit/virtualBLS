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
    <?php $assetVersion = time(); ?>
    <script src="../../../custom/resources/scripts/script.js?v=<?php echo $assetVersion; ?>" type="text/javascript"></script>
    <script src="../../../custom/resources/scripts/applySettings.js?v=<?php echo $assetVersion; ?>" type="text/javascript"></script>
    <script src="../../../custom/resources/scripts/status.js?v=<?php echo $assetVersion; ?>" type="text/javascript"></script>

</html>