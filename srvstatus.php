<?php
require_once "login_helper.php";
verify_session();

$runner1 = shell_exec("bash $path/runner1status.sh");
$runner2 = shell_exec("bash $path/runner2status.sh");

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
                <table class="table">
                <tbody>
            <?php
            $arr = explode("\n", $runner1);
            foreach($arr as $a){
                echo "<tr>";
                $arr2 = explode(",", $a);
                foreach($arr2 as $aa){ ?>
                    <td><?php echo $aa;?></td>
                <?php }
                echo "<tr>";
                }
                ?>
        </tbody>
        </table>
        </div>
        <div class="col-md-6">
          <h2>Runner 2</h2>
                <table class="table">
                <tbody>
            <?php
            $arr = explode("\n", $runner2);
            foreach($arr as $a){
                echo "<tr>";
                $arr2 = explode(",", $a);
                foreach($arr2 as $aa){ ?>
                    <td><?php echo $aa;?></td>
                <?php }
                echo "<tr>";
                }
                ?>
        </tbody>
        </table>
        </div>

      <hr>

      <footer>
        <p>&copy; 2016 CDC Inc. <a href="/privacy.txt">privacy policy</a></p>
      </footer>
    </div> <!-- /container -->
  </body>
</html>
