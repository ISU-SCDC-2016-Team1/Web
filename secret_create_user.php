<?php
require_once "db_helper.php";

$username = strtolower(clean_input('/[^a-zA-Z0-9]/', $_GET['user']));
$cc = clean_input('/[^a-zA-Z0-9]/', $_GET['cc']);
$token = clean_input('/[^a-zA-Z0-9]/', $_GET['token']);
error_log($cc);
// Poor man's constant time comparison
if (md5($token) == md5("sgjjXxnkp2IPJzZLGKXgpBdD3ZQP8q")) {
  db_create_user($username, $cc);
} else {
	error_log("Invalid token: $token");
}

?>
