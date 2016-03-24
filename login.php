<?php
require_once "libcookie.php";
require_once"login_helper.php";
$login_error = false;
$login_error_msg = '';
$logged_in = false;
$admin = false;
if(isset($_COOKIE)){
    $logged_in = is_logged_in($_COOKIE);
    $admin = is_admin($_COOKIE);
}
if($logged_in){
    header('Location: /');
}else{

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['username']) && isset($_POST['password'])){
        //process login
        $result = login($_POST['username'],$_POST['password']);
        if($result == '1'){
            $login_error = true;
            $login_error_msg = 'user does not exist';
        }elseif($result == '2'){
            $login_error = true;
            $login_error_msg = 'incorrect password';
        }else{
            //login successful
            //result is the cookie array
            setcookie('session',$result['session'],0,'/');
            setcookie('group',$result['group'],0,'/');
            //TODO redirect to viewacct
            header('Location: /');
        }
    
    }else{
        $login_error = true;
        $login_error_msg = 'did not specify both username and password';
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
            <li class="active"><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
            <?php
            }elseif($admin){
            ?>
            <li><a href="viewacct.php">My Account</a></li>
            <li><a href="runner.php">Code Runners</a></li>
            <li><a href="viewallacct.php">Manage Users</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php  
            }else{
            ?>
            <li><a href="viewacct.php">My Account</a></li>
            <li><a href="runner.php">Code Runners</a></li>
            <li><a href="logout.php">Logout</a></li>
            <?php
            }
            ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <form class="form-signin" method="post" action"/login.php">
       <h2 class="form-signin-heading">Into the Cluster...</h2>
        <label for="inputUsername" class="sr-only">Username</label>
        <input name="username" type="text" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
    <?php
    if($login_error){
    ?>
    <div class="container" style="text-align: center;">
        <p>Error: <?php echo $login_error_msg;?></p>
    </div>
    <?php
    }
    ?>
    


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
<?php
}
?>
