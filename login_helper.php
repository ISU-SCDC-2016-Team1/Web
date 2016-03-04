<?php
require_once "db_helper.php";
require_once "libhash.php";
require_once "libcookie.php";
require_once "runner_helper.php";

function login($username, $password){
    if(!db_user_exists($username)){
        return '1';
    }else{
        $pass_hash = db_get_hash($username);
        $pass_salt = db_get_salt($username);
        $newhash = sha256($password, $pass_salt);
        if($pass_hash  != $newhash){
           return '2'; 
        }else{
            $group = db_get_group($username);
            $cookies = create_session($username,$group);
           return $cookies;
        }
    }
}

function register($username, $password, $password2, $creditcard, $group){
    if(db_user_exists($username)){
        return '1';
    }
    if($password != $password2){
        return '2';
    }
    if($group != 'user' && $group != 'admin'){
        return '3';
    }
    $salt = get_rand_salt();
    $hashed_password = sha256($password,$salt);
    create_user($username,$password);
    return db_create_user($username,$hashed_password,$salt,$creditcard,$group);
}

function create_user($username, $password){
    shell_exec('sshpass -p "cdc" ssh root@runner1 "useradd '.$username.'; mkhomedir_helper '.$username.'"');
    shell_exec('sshpass -p "cdc" ssh root@runner2 "useradd '.$username.'; mkhomedir_helper '.$username.'"');
    shell_exec('sshpass -p "cdc" ssh root@keyescrow "useradd '.$username.'; mkhomedir_helper '.$username.'"');
    shell_exec('sshpass -p "cdc" ssh root@git "useradd '.$username.'; mkhomedir_helper '.$username.'"');
    shell_exec('sshpass -p "cdc" ssh root@shell "useradd '.$username.'; mkhomedir_helper '.$username.'"');
    shell_exec('sshpass -p "cdc" ssh root@localhost "useradd '.$username.'; mkhomedir_helper '.$username.'"');

    shell_exec('USER="'.$username.'" ke -s keyescrow:7654 generate');
    shell_exec('USER="'.$username.'" ke -s keyescrow:7654 dispatch');

    $key = get_public_key($username);
    shell_exec('sshpass -p "cdc" ssh root@git "http_proxy=\"\" python /root/adduser.py '.$username.'@'.$username.'.com '.$username.' '.$username.' '.$password.'"');
    shell_exec('http_proxy="" bash /var/www/web/runscript/addssh.sh '.$username.' '.$key);
    
}

function update_account($username, $password, $password2, $creditcard, $group){
    $salt = get_rand_salt();
    $hashed_password = sha256($password,$salt);
    return db_update_user($username,$hashed_password,$salt,$creditcard,$group);
}

function update_cc($username, $creditcard, $group){
    return db_update_cc($username,$creditcard,$group);
}
?>
