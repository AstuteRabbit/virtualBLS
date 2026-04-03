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
  <script>
        (function () {
              function sendHeartbeat(close) {
                    const url = close ? './heartbeat.php?close=1' : './heartbeat.php';
                    if (close && navigator.sendBeacon) {
                          navigator.sendBeacon(url, new Blob([], { type: 'application/x-www-form-urlencoded' }));
                          return;
                    }

                    fetch(url, {
                          method: 'POST',
                          credentials: 'same-origin',
                          cache: 'no-store'
                    }).catch(function () {
                          // Heartbeat  failures are handled server-side by TTL expiry.
                    });
              }

              sendHeartbeat(false);
              setInterval(function () {
                    sendHeartbeat(false);
              }, 5000);

              window.addEventListener('beforeunload', function () {
                    sendHeartbeat(true);
              });
        })();
  </script>

</html> 