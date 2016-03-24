<?php
<<<<<<< HEAD
     
    $M_host = 'localhost';
    $M_user = '';
    $M_password = '';
    $M_database = '';
    
    global $mysqli;
    
    $mysqli = new mysqli($M_host, $M_user, $M_password, $M_database);
    if ($mysqli->connect_errno) {
        die("Failed to connect to MySQL: " . $mysqli->connect_error);
=======
require_once "login_helper.php";
verify_session();

function db_get_hash($username) {
    try{
        $user = "web";
        $pass = "7f0DlNcl3Lv5rQ6sHOuq";
        $db = "web";
        $host = "localhost";
        mysql_connect($host,$user,$pass);
        mysql_select_db($db) or die("Unable to select database");
        $query="select password from credentials where username=?";
        $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->bind_result($hash);
        mysql_close();
        return $hash;
    }catch(Exception $e){
        return 'idk';
>>>>>>> ca0eee024fea1449f0c93cfa4eb1cca5a3366432
    }
    $mysqli->set_charset("utf8");

    unset($M_host);
    unset($M_user);
    unset($M_password);
    unset($M_database);
	
function clean_input($regex, $input) {
	if ($regex != "comments"){
		$lstring = preg_replace($regex, '', str_replace(chr(0), '', $input));
	}
	else{
		$lstring = preg_replace(str_replace(chr(0), '', $input));
	}
    $lstring = preg_replace($regex, '', str_replace(chr(0), '', $input));
    $string = stripslashes(strip_tags($lstring));
    while ($string != $lstring) {
        $lstring = $string;
        $string = stripslashes(strip_tags($lstring));
    }

    return stripslashes($string);
}

function db_get_creditcard($username) {
 
    global $mysqli;
    $query="select creditcard from credentials where username=?";
    $stmt=$mysqli->prepare($query);
    $stmt->bind_param("s", $username);
    $cc = NULL;
	$stmt->bind_result($cc);
	if(!$stmt->fetch()){
			$cc ="";
	}
    
    return $cc;
}

function db_get_users(){
   
    global $mysqli;
    $query="select * from credentials";
    $users = array();
    $result=mysql_query($query);
    while ($row = mysql_fetch_assoc($result)) {
        $users[] = $row["username"];
    }
    mysql_close();
    return $users;
}

function db_update_user($username,$creditcard){
        
    global $mysqli;
    $query="update credentials set username='?', creditcard='?' where username='?'";
    $stmt=$mysqli->prepare($query);
    $stmt->bind_param("sss", $username, $creditcard, $_SESSION['username']);
	if(!$stmt->fetch()){
			return false;
	}
    $_SESSION['username'] = $username;
    return true;
}

function db_update_cc($username,$creditcard){
       
    global $mysqli;
    $query="update credentials set creditcard='?' where username='?'";
	$stmt=$mysqli->prepare($query);
    $stmt->bind_param("ss", $creditcard, $username);
	if(!$stmt->fetch()){
			return false;
	}
   
    return true;
}

function db_get_comments($num) {
   // TODO: Sanitize output
    global $mysqli;
    $query="select * from comments limit ".$num;
    $stmt = $conn->prepare()
    $result=mysql_query($query);
    mysql_close();
    return $result;
}

function db_put_comment($comment) {
    // TODO: Sanitize input
	global $mysqli;

    $sql = "INSERT INTO comments (c) VALUES (?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $comment);
    $stmt->execute()
    mysql_close();
    return $result;
}
?>
