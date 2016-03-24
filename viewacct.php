<?php
require_once "libcookie.php";
require_once "db_helper.php";
require_once "runner_helper.php";
$logged_in = false;
$admin = false;
$user = '';
$cc = '';
$group = '';
$public_key = '';
$private_key = '';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(!isset($_GET['u'])){
        header('Location: /');
    }else{
        $user = $_GET['u'];
    }
    if(isset($_COOKIE)) {
        $logged_in = is_logged_in($_COOKIE);
        $admin = is_admin($_COOKIE);
        $cc = db_get_creditcard($user);
        $group = db_get_group($user);
        $public_key = get_public_key($user);
        $private_key = get_private_key($user);
        //$user = db_get_cookie_user($_COOKIE['session']);

    }else{
        header('Location: /');
    }
    if(!$logged_in){
        header('Location: /');
    }


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
    <link href="/dist/css/signin.css" rel="stylesheet">
  </head>
  <body>

    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Cluster Deployment Company</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="/srvstatus.php?p=runscript">Server Status</a></li>
            <li><a href="/comments.php?l=10">Comments</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php
            if(!$logged_in){
            ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <?php
            }elseif($admin){
            ?>
            <li class="active"><a href="viewacct.php?u=<?php echo $user;?>">My Account</a></li>
            <li><a href="runner.php">Code Runners</a></li>
            <li><a href="viewallacct.php">Manage Users</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php
            }else{
            ?>
            <li class="active"><a href="viewacct.php?u=<?php echo $user;?>">My Account</a></li>
            <li><a href="runner.php">Code Runners</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php
            }
            ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>


    <div style="text-align: center; margin-top: 15px;" class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-12">
          <h2>Account Management: <?php echo $user;?></h2>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-6">
          <h2>Account Info</h2>
          <table class="table">
        <tbody>
        <tr>
        <td>Credit Card</td> <td><?php echo $cc;?></td>
        </tr>
        <tr>
        <td>Group</td> <td><?php echo $group;?></td>
        </tr>
        </tbody>
        </table>
          <h3>Public Key</h3>
          <textarea class="form-control" rows="3"><?php echo $public_key;?></textarea>
          <h3>Private Key</h3>
          <textarea class="form-control" rows="20"><?php echo $private_key;?></textarea>
        </div>
        <div class="col-md-6">
          <h2>Edit Account</h2>
       <form class="form-signin" method="post" action="/updatepass.php">
       <h3 class="form-signin-heading">Change Password</h3>
        <input name="username" type="hidden" class="form-control" value="<?php echo $user;?>">
        <input name="group" type="hidden" class="form-control" value="<?php echo $group;?>">
        <input name="creditcard" type="hidden" class="form-control" value="<?php echo $cc;?>">
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword2" class="sr-only">Repeat Password</label>
        <input name="password2" type="password" id="inputPassword2" class="form-control" placeholder="Repeat Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Update Password</button>
      </form>
       <form class="form-signin" method="post" action="/updatecc.php">
       <h3 class="form-signin-heading">Change Credit Card</h3>
        <input name="username" type="hidden" class="form-control" value="<?php echo $user;?>">
        <input name="group" type="hidden" class="form-control" value="<?php echo $group;?>">
        <label for="inputcc" class="sr-only">Credit Card</label>
        <input name="creditcard" type="text" id="inputcc" class="form-control" placeholder="Credit Card" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Update Credit Card</button>
      </form>
       </div>
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
