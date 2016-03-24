<?php
require_once "db_helper.php";
require_once "login_helper.php";
require_once "runner_helper.php";
require_authenticated();
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

  </body>
</html>
