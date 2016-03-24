<?php
require_once "db_helper.php";

$username = clean_input('/[^a-zA-Z0-9]/', $_GET['user']);
$token = clean_input('/[^a-zA-Z0-9]/', $_GET['token']);

// Poor man's constant time comparison
if (md5($token) == md5("kHbpesKtPDn5oQhOOSbbXdXIQQRnah")) {
    echo db_get_group($username);
}

?>
