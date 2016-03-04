<?php

require_once "login_helper.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['creditcard']) && isset($_POST['group'])){
        $u = $_POST['username'];
        $p = $_POST['password'];
        $p2 = $_POST['password2'];
        $group = $_POST['group'];
        $cc = $_POST['creditcard'];
        update_account($u,$p,$p2,$cc,$group);
        header('Location: /viewacct.php?u='.$u);
    }else{
        header('Location: /');
    }
}else{
    header('Location: /');
}


?>
