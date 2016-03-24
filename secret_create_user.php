<?php
require_once "db_helper.php";

$username = clean_input('/[^a-zA-Z0-9]/', $_GET['user']);
$cc = clean_input('/[^a-zA-Z0-9]/', $_GET['cc']);
$token = clean_input('/[^a-zA-Z0-9]/', $_GET['token']);

// Poor man's constant time comparison
if (md5($token) == md5("sgjjXxnkp2IPJzZLGKXgpBdD3ZQP8q")) {
  db_create_user($username, $cc);
}

?>
