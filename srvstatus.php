<?php
require_once "login_helper.php";
verify_session();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once 'head.php'; ?>
  </head>
  <body>

        <?php require_once 'nav.php'; ?>

        <div style="text-align: center; " class="col-md-12">
          <h2>Server Status</h2>
          <p><a class="btn btn-default" href="/srvstatus.php?p=runscript" role="button">Refresh</a></p>
        </div>
        <div class="col-md-6">
          <h2>Runner 1</h2>
          <iframe seamless="seamless" src="http://runner1.isucdc.com:8765/"></iframe>
        </div>
        <div class="col-md-6">
          <h2>Runner 2</h2>
            <iframe seamless="seamless" src="http://runner2.isucdc.com:8765/"></iframe>
        </div>

      <hr>

      <footer>
        <p>&copy; 2016 CDC Inc. <a href="/privacy.txt">privacy policy</a></p>
      </footer>
    </div> <!-- /container -->
  </body>
</html>
