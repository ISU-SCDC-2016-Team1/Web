<?php
require_once "login_helper.php";
require_authenticated();


if(isset($_POST['username']) || isset($_POST['creditcard'])){
    $user = clean_input('/[^a-zA-Z0-9]/', $_POST['username']);
    $cc = clean_input('/[^a-zA-Z0-9]/', $_POST['username']);

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

    if (!check_administrator() || $user == '') {
      $user = $_SESSION['username'];
    }

    db_update_cc($user, $cc);
    header('Location: /viewacct.php?u='.$user);
  } else {
    die("Error processing request.");
  }
?>
