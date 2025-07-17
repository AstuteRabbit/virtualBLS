<!DOCTYPE html>
<html lang="en-us">
  <head>
    <?php
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/settingsHead.php';
    ?>
  </head>
  <body id="settingsBody">
  <?php
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/settingsBody.php';
  ?>
  </body>
  <script src="../../../resources/scripts/form.js" type="text/javascript"></script>
  <script src="../../../resources/scripts/modal.js" type="text/javascript"></script>
  <script src="../../../resources/scripts/script.js" type="text/javascript"></script>
  <script>
      $(document).ready(function(){
          document.getElementById("year").innerHTML = new Date().getFullYear();
          document.getElementById("year2").innerHTML = new Date().getFullYear();    
      });
  </script>
  <script src="../../../resources/scripts/pageLink.js"></script>
  <script src="../../../resources/scripts/checkStatus.js"></script>

</html> 