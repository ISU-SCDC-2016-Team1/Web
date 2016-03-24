<?php
require_once "login_helper.php";
verify_session();

$logged_in = false;
$admin = false;
$user = '';
$runner1 = '';
$runner2 = '';
$path = '';
if(isset($_COOKIE)){
    $logged_in = is_logged_in($_COOKIE);
    $admin = is_admin($_COOKIE);
    $user = db_get_cookie_user($_COOKIE['session']);
}
if(isset($_GET['p'])){
    $path = $_GET['p'];
}
$runner1 = shell_exec("bash $path/runner1status.sh");
$runner2 = shell_exec("bash $path/runner2status.sh");


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/favicon.ico">

    <title>Cluster Deployment Company</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/dist/css/custom.css" rel="stylesheet">
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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/dist/js/jquery.min.js"></script>
    <script src="/dist/js/bootstrap.min.js"></script>
  </body>
</html>
