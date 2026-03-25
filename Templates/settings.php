<?php
//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>


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
  <script src="../../../custom/resources/scripts/form.js" type="text/javascript"></script>
  <script src="../../../custom/resources/scripts/script.js" type="text/javascript"></script>
  <script>
      $(document).ready(function(){
          document.getElementById("year").innerHTML = new Date().getFullYear();
          document.getElementById("year2").innerHTML = new Date().getFullYear();    
      });
  </script>
  <script src="../../../custom/resources/scripts/pageLink.js"></script>
  <script src="../../../custom/resources/scripts/checkStatus.js"></script>

</html> 