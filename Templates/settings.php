      <?php
      // Make sure the user is coming from WordPress and has a valid session.

      if (!session_id()) {
            session_start();
      }

      $token_is_valid = isset($_SESSION['settings_page_token']) &&
            isset($_SESSION['settings_page_token_time']) &&
            (time() - $_SESSION['settings_page_token_time']) < 3600;

      if (!$token_is_valid) {
            http_response_code(403);
            die('Access Denied. Please log in to virtualBLS.net to access this page through the provided links.');
      }
      ?>
<!DOCTYPE html>
<html lang="en-us">
  <head>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/wp-content/custom/includes/settingsHead.php';
    ?>
  </head>
  <body id="settingsBody">
  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/wp-content/custom/includes/settingsBody.php';
  ?>
  </body>
      <?php $assetVersion = time(); ?>
      <script src="../../../custom/resources/scripts/form.js?v=<?php echo $assetVersion; ?>" type="text/javascript"></script>
      <script src="../../../custom/resources/scripts/script.js?v=<?php echo $assetVersion; ?>" type="text/javascript"></script>
  <script>
      $(document).ready(function(){
          document.getElementById("year").innerHTML = new Date().getFullYear();
          document.getElementById("year2").innerHTML = new Date().getFullYear();    
      });
  </script>
      <script src="../../../custom/resources/scripts/pageLink.js?v=<?php echo $assetVersion; ?>"></script>
      <script src="../../../custom/resources/scripts/checkStatus.js?v=<?php echo $assetVersion; ?>"></script>

</html> 