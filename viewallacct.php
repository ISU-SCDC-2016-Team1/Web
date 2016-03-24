<?php
require_once "db_helper.php";
require_once "login_helper.php";
verify_session();
$logged_in = false;
$admin = false;
$user = '';
$cc = '';
$group = '';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    //if(!isset($_GET['u'])){
    //    header('Location: /');
    //}else{
    //    $user = $_GET['u'];
    //}
    if(isset($_COOKIE)){
        $logged_in = is_logged_in($_COOKIE);
        $admin = is_admin($_COOKIE);
        //$cc = db_get_creditcard($user);
        $user = db_get_cookie_user($_COOKIE['session']);
        $userlist = db_get_users();
    }else{
        header('Location: /');
    }
    if(!$logged_in){
        header('Location: /');
    }

    if($admin){
        $group = 'admin';
    }else{
        $group = 'user';
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

        <?php require_once 'nav.php'; ?>

    <div style="text-align: center; margin-top: 15px;" class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-12">
          <h2>User Management</h2>
          <table class="table">
        <tbody>
        <?php
        foreach($userlist as $u){
        ?>
        <tr>
        <td><a href="/viewacct.php?u=<?php echo $u;?>"><?php echo $u;?></a></td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
        </div>
      </div>
      <hr>
      <div class="row">

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
