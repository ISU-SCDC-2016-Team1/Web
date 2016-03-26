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
        <h2>A tribute to <a href="https://twitter.com/tompohl/status/713561371791601664">@CPCharron</a>, friend of @tompohl.</h2>
        <img style="border:  40px solid transparent; border-image: url('/logo.png'); height: 600px;" src="/dist/img/real_hackers.png"/>
      </div>

      <hr>

      <footer>
        <p>&copy; 2016 CDC Inc. <a href="/privacy.txt">privacy policy</a></p>
      </footer>
    </div> <!-- /container -->
  </body>
</html>
