<?php
require_once "login_helper.php";
verify_session();

$logged_in = false;
$admin = false;
$user = '';
if(isset($_COOKIE)){
    $logged_in = is_logged_in($_COOKIE);
    $admin = is_admin($_COOKIE);
    $user = db_get_cookie_user($_COOKIE['session']);
}


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

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <?php
        if(!$logged_in){
        ?>
        <div class="col-md-4">
          <h2>Login</h2>
          <p>Click here to login to our code deployment environment! </p>
          <p><a class="btn btn-default" href="/login.php" role="button">Login</a></p>
        </div>
        <div class="col-md-4">
          <h2>Register</h2>
          <p>Start running your code on our custom code deployment environment today! We wrote all of our services from scratch and don't beleive in using libraries so you know our stuff is secure. We accept all major credit cards. </p>
          <p><a class="btn btn-default" href="/register.php" role="button">Register</a></p>
       </div>
        <div class="col-md-4">
          <h2>Live Server Status</h2>
          <p>Need to check if the code runners are online? Our custom monitoring software keeps track of the runner servers in real-time and displays their status here.</p>
          <p><a class="btn btn-default" href="/srvstatus.php?p=runscript" role="button">Check Server Status</a></p>
        </div>
        <?php
        }else{
        ?>
        <div class="col-md-4">
          <h2>Welcome <?php echo $user;?></h2>
          <p>Welcome to the Cluster Deployment Company. Logout?</p>
          <p><a class="btn btn-default" href="/logout.php" role="button">Logout</a></p>
        </div>
        <div class="col-md-4">
          <h2>Live Server Status</h2>
          <p>Need to check if the code runners are online? Our custom monitoring software keeps track of the runner servers in real-time and displays their status here.</p>
          <p><a class="btn btn-default" href="/srvstatus.php?p=runscript" role="button">Check Server Status</a></p>
        </div>
        <div class="col-md-4">
          <h2>My Account</h2>
          <p>Manage account details and get server keys all in one convenient place.</p>
          <p><a class="btn btn-default" href="/viewacct.php?u=<?php echo $user;?>" role="button">My Account</a></p>
        </div>
        <?php
        }
        ?>
      </div>
      <div class="container" style="text-align: center; margin-top: 30px;">
        <img style="border:  40px solid transparent; border-image: url('/logo.png');" src="/dist/img/real_hackers.png"/>
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
