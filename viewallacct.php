<?php
require_once "db_helper.php";
require_once "login_helper.php";

require_administrator();

$userlist = db_get_users();
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

  </body>
</html>
