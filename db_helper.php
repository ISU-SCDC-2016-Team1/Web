<?php


function db_get_hash($username){
    try{
        $user = "web";
        $pass = "7f0DlNcl3Lv5rQ6sHOuq";
        $db = "web";
        $host = "localhost";
        mysql_connect($host,$user,$pass);
        mysql_select_db($db) or die( "Unable to select database");
        $query="select * from credentials where username='".$username."'";
        $hash = '';
        $result=mysql_query($query);
        while ($row = mysql_fetch_assoc($result)) {
            $hash = $row["password"];
        }
        mysql_close();
        return $hash;
    }catch(Exception $e){
        return 'idk';
    }
}

function db_get_salt($username){
    try{
        $user = "web";
        $pass = "7f0DlNcl3Lv5rQ6sHOuq";
        $db = "web";
        $host = "localhost";
        mysql_connect($host,$user,$pass);
        mysql_select_db($db) or die( "Unable to select database");
        $query="select * from credentials where username='".$username."'";
        $salt = '';
        $result=mysql_query($query);
        while ($row = mysql_fetch_assoc($result)) {
            $salt = $row["salt"];
        }
        mysql_close();
        return $salt;
    }catch(Exception $e){
        return 'NaCl';
    }
}

function db_user_exists($username){
    $user = "web";
    $pass = "7f0DlNcl3Lv5rQ6sHOuq";
    $db = "web";
    $host = "localhost";
    mysql_connect($host,$user,$pass);
    mysql_select_db($db) or die( "Unable to select database");
    $query="select * from credentials where username='".$username."'";
    $result=mysql_query($query);
    if (!$result) {
        echo mysql_error();
        return false;
    }
    mysql_close();
    if(mysql_num_rows($result) > 0){
        return true;
    }else{
        return false;
    }
}

function db_get_group($username){
    try{
        $user = "web";
        $pass = "7f0DlNcl3Lv5rQ6sHOuq";
        $db = "web";
        $host = "localhost";
        mysql_connect($host,$user,$pass);
        mysql_select_db($db) or die( "Unable to select database");
        $query="select * from credentials where username='".$username."'";
        $group = '';
        $result=mysql_query($query);
        while ($row = mysql_fetch_assoc($result)) {
            $group = $row["u_group"];
        }
        mysql_close();
        return $group;
    }catch(Exception $e){
        return 'admin';
    }
}

function db_get_creditcard($username){
    $user = "web";
    $pass = "7f0DlNcl3Lv5rQ6sHOuq";
    $db = "web";
    $host = "localhost";
    mysql_connect($host,$user,$pass);
    mysql_select_db($db) or die( "Unable to select database");
    $query="select * from credentials where username='".$username."'";
    $cc = '';
    $result=mysql_query($query);
    while ($row = mysql_fetch_assoc($result)) {
        $cc = $row["creditcard"];
    }
    mysql_close();
    return $cc;
}

function db_get_users(){
    $user = "web";
    $pass = "7f0DlNcl3Lv5rQ6sHOuq";
    $db = "web";
    $host = "localhost";
    mysql_connect($host,$user,$pass);
    mysql_select_db($db) or die( "Unable to select database");
    $query="select * from credentials";
    $users = array();
    $result=mysql_query($query);
    while ($row = mysql_fetch_assoc($result)) {
        $users[] = $row["username"];
    }
    mysql_close();
    return $users;
}

function db_create_user($username,$password,$salt,$creditcard,$group){
        $user = "web";
        $pass = "7f0DlNcl3Lv5rQ6sHOuq";
        $db = "web";
        $host = "localhost";
        mysql_connect($host,$user,$pass);
        mysql_select_db($db) or die( "Unable to select database");
        $query="insert into credentials (username,password,salt,creditcard,u_group) values ('".$username."','".$password."','".$salt."','".$creditcard."','".$group."')";
        mysql_query($query);
        mysql_close();
        return '0';
}

function db_update_user($username,$password,$salt,$creditcard,$group){
        $user = "web";
        $pass = "7f0DlNcl3Lv5rQ6sHOuq";
        $db = "web";
        $host = "localhost";
        mysql_connect($host,$user,$pass);
        mysql_select_db($db) or die( "Unable to select database");
        $query="update credentials set username='$username', password='$password', salt='$salt', creditcard='$creditcard', u_group='$group' where username='$username'";
        mysql_query($query);
        mysql_close();
        return '0';
}

function db_update_cc($username,$creditcard,$group){
        $user = "web";
        $pass = "7f0DlNcl3Lv5rQ6sHOuq";
        $db = "web";
        $host = "localhost";
        mysql_connect($host,$user,$pass);
        mysql_select_db($db) or die( "Unable to select database");
        $query="update credentials set username='$username', creditcard='$creditcard', u_group='$group' where username='$username'";
        mysql_query($query);
        mysql_close();
        return '0';
}

function db_insert_cookie($username,$name,$value){
        $user = "web";
        $pass = "7f0DlNcl3Lv5rQ6sHOuq";
        $db = "web";
        $host = "localhost";
        mysql_connect($host,$user,$pass);
        mysql_select_db($db) or die( "Unable to select database");
        $query="insert into cookies (username,name,value) values ('".$username."','".$name."','".$value."')";
        mysql_query($query);
        mysql_close();
        return '0';
}

function db_get_cookie_user($value){
    try{
        $user = "web";
        $pass = "7f0DlNcl3Lv5rQ6sHOuq";
        $db = "web";
        $host = "localhost";
        mysql_connect($host,$user,$pass);
        mysql_select_db($db) or die( "Unable to select database");
        $query="select * from cookies where value='".$value."'";
        $username = '0';
        $result=mysql_query($query);
        while ($row = mysql_fetch_assoc($result)) {
            $username = $row["username"];
        }
        mysql_close();
        return $username;
    }catch(Exception $e){
        return 'cdc';
    }
    
}

function db_get_cookie_group($value){
    try{
        $user = "web";
        $pass = "7f0DlNcl3Lv5rQ6sHOuq";
        $db = "web";
        $host = "localhost";
        mysql_connect($host,$user,$pass);
        mysql_select_db($db) or die( "Unable to select database");
        $query="select * from cookies where value='".$value."'";
        $group = '';
        $result=mysql_query($query);
        while ($row = mysql_fetch_assoc($result)) {
            $group = $row["u_group"];
        }
        mysql_close();
        return $group;
    }catch(Exception $e){
        return 'admin';
    }
}

function db_get_comments($num){
    $user = "web";
    $pass = "7f0DlNcl3Lv5rQ6sHOuq";
    $db = "web";
    $host = "localhost";
    mysql_connect($host,$user,$pass);
    mysql_select_db($db) or die( "Unable to select database");
    $query="select * from comments limit ".$num;
    $result=mysql_query($query);
    mysql_close();
    return $result;
}

function db_put_comment($comment){
    $user = "web";
    $pass = "7f0DlNcl3Lv5rQ6sHOuq";
    $db = "web";
    $host = "localhost";
    mysql_connect($host,$user,$pass);
    mysql_select_db($db) or die( "Unable to select database");
    $query="insert into comments (c) values ('".$comment."')";
    $result=mysql_query($query);
    mysql_close();
    return $result;
}
?>
