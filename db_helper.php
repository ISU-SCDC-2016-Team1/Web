<?php
    $M_host = 'localhost';
    $M_user = 'web';
    $M_password = '7f0DlNcl3Lv5rQ6sHOuq';
    $M_database = 'web';

    global $mysqli;

    $mysqli = new mysqli($M_host, $M_user, $M_password, $M_database);
    if ($mysqli->connect_errno) {
        die("Failed to connect to MySQL: " . $mysqli->connect_error);
    }
    $mysqli->set_charset("utf8");

    unset($M_host);
    unset($M_user);
    unset($M_password);
    unset($M_database);

function clean_input($regex, $input) {
    $lstring = $input;
    if ($regex != "comments"){
        $lstring = preg_replace($regex, '', str_replace(chr(0), '', $input));
    }
    else{
        $lstring = str_replace(chr(0), '', $input);
    }
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
      if(!$stmt->execute()){
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
      if(!$stmt->execute()){
          return false;
      }

    return true;
}

function db_get_comments($num) {
    $limit = clean_input('/[^0-9]/', $num);
    if ($limit == '') {
        $limit = 10;
    }
    global $mysqli;
    $query="SELECT c FROM comments ORDER BY id DESC LIMIT $limit";
    error_log("$query -- $limit");
    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $comment = NULL;
    $comments = [];
    if ($stmt->bind_result($comment)) {
    error_log("Fetching...: " . $stmt->num_rows);
    while ($stmt->fetch()) {
        error_log("Got comment: $comment");
        $comments[] = clean_input("comments", $comment);
      }
    }
    else {
    error_log($stmt->error());
}
return $comments;
    
}

function db_put_comment($comment) {
    $value = clean_input("comments", $comment);
    global $mysqli;
    $sql = "INSERT INTO comments (c) VALUES (?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $value);
    $stmt->execute();
    return $result;
}
?>
