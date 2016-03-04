<?php
require_once 'db_helper.php';
require_once 'libhash.php';

function is_logged_in($cookies){
    if(!isset($cookies['session'])){
        return false;
    }
    $user = db_get_cookie_user($cookies['session']);
    if($user == '0'){
        return false;
    }else{
        return true;
    }
}

function is_admin($cookies){
    if(isset($cookies['group'])){
        if($cookies['group'] == 'admin'){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function create_session($username,$group){
    $session = get_random_session_token();
    $cookies = array();
    $cookies['session'] = $session;
    $cookies['group'] = $group;
    db_insert_cookie($username,'session',$session);
    db_insert_cookie($username,'group',$group);
    return $cookies;
}

function get_random_session_token(){
    $random_seed = time();
    $s = (string) $random_seed;
    $s = $s.$s.$s;
    return sha256($s,'');
}

?>
