<?php

require_once "login_helper.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['username']) && isset($_POST['creditcard']) && isset($_POST['group'])){
        $u = $_POST['username'];
        $group = $_POST['group'];
        $cc = $_POST['creditcard'];
        update_cc($u,$cc,$group);
        header('Location: /viewacct.php?u='.$u);
    }else{
        header('Location: /');
    }
}else{
    header('Location: /');
}


?>
