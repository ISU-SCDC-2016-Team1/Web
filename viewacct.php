<?php
require_once "db_helper.php";
require_once "login_helper.php";
require_once "runner_helper.php";
require_authenticated();

$user = clean_input('/[^a-zA-Z0-9]/', $_GET['u']);

$userlist = db_get_users();
$found = false;
foreach($userlist as $u){
  if ($user == $u) {
    $found = true;
  }
}

if (!$found) {
    $user = $_SESSION['username'];
}

if (!check_administrator()) {
  $user = $_SESSION['username'];
}

$cc = db_get_creditcard($user);
$group = "user"
$administrators = ["orin", "mushnik"];
foreach ($administrators as $admin) {
    if (strcasecmp($admin, $user) == 0) {
        $group = "admin";
    }
}

$public_key = get_public_key($user);
$private_key = get_public_key($user);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once 'head.php'; ?>
  </head>
  <body>

        <?php require_once 'nav.php'; ?>

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
       <h3 class="form-signin-heading">Change Password</h3>
       <a href="https://google.com">Please go here to change your password</a>.
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

  </body>
</html>
