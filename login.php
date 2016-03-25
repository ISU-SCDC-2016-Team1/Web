<?php
require_once "login_helper.php";
require_once "db_helper.php";
verify_session();

if (check_authenticated()) {
    header('Location: /');
    die();
}

$login_error = false;
$login_error_msg = '';

if (isset($_POST['username']) || isset($_POST['password'])) {
  $username = clean_input('/[^a-zA-Z0-9]/', $_POST['username']);
  $password = $_POST['password'];

  if (!isset($_POST['password'])) {
    $password = '';
  }

  if ($username == '' || $password == '') {
    $login_error = true;
    $login_error_msg = 'Missing either username or password.';
  } else {
    if (login($username, $password)) {
      header('Location: /');
      die();
    } else {
      $login_error = true;
      $login_error_msg = 'Invalid username or password.';
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once 'head.php'; ?>
  </head>
  <body>
    <?php require_once 'nav.php'; ?>

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
        <p>Error: <?php echo $login_error_msg; ?></p>
    </div>
    <?php
    }
    ?>



      <hr>

      <footer>
        <p>&copy; 2016 CDC Inc. <a href="/privacy.txt">privacy policy</a></p>
      </footer>
    </div> <!-- /container -->

  </body>
</html>
