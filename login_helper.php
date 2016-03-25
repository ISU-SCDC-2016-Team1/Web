<?php
require_once "db_helper.php";
require_once "runner_helper.php";

function login($user, $password){
    $ldap = ldap_connect("10.4.4.2");

    if ($bind = ldap_bind($ldap, "cn=$user,cn=users,dc=team1,dc=isucdc,dc=com", $password)) {
        $_SESSION['username'] = $user;
        $_SESSION['auth_id'] = hash("sha256", openssl_random_pseudo_bytes(200));
        $_SESSION['start_time'] = time();
        $_SESSION['last_request'] = time();
        $_SESSION['logged_in'] = true;
        $_SESSION['admin'] = false;
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['remote_ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['password'] = $password;
        $_SESSION['token'] = shell_exec("echo $password | ke -s 10.3.3.2:7654 token -u $user | grep Token | sed 's/Token: //g'");

        $is_admin = file_get_contents("https://ldap.team1.isucdc.com/isAdmin.ashx?user=$user");
        if (strcasecmp($is_admin, "True") == 0) {
            $_SESSION['admin'] = true;
        }

        session_regenerate_id(true);
        return true;
    }

    return false;
}

function destroy_session() {
    if (session_id() == "") {
        session_start();
    }
    if ( isset( $_COOKIE[session_name()] ) ) {
        setcookie( session_name(), "", time()-3600, "/" );
    }
    $_SESSION = array();
    session_destroy();
}

function verify_session() {
    if (session_id() == "") {
        session_start();
    }
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        if ($_SERVER['HTTP_USER_AGENT'] != $_SESSION['user_agent'] || $_SERVER['REMOTE_ADDR'] != $_SESSION['remote_ip']) {
            destroy_session();
            die("Bad session.");
        }
        if ($_SESSION['last_request'] < time() - 300 || $_SESSION['start_time'] < time() - 900) {
            destroy_session();
            die("Old session.");
        }
        $_SESSION['last_request'] = time();
        $password = $_SESSION['password'];
        $_SESSION['token'] = shell_exec("echo $password | ke -s 10.3.3.2:7654 token -u $user 2>/dev/null | grep Token | sed 's/Token: //g'");
        session_regenerate_id(true);
    }
}

function check_authenticated() {
    verify_session();
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        return false;
    }
    return true;
}

function check_administrator() {
    verify_session();
    if (!check_authenticated() || !isset($_SESSION['admin']) || $_SESSION['admin'] == false) {
        return false;
    }
    return true;
}

function require_authenticated() {
    verify_session();
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        die("Not logged in.");
    }
}

function require_administrator() {
    require_authenticated();
    if (!isset($_SESSION['admin']) || $_SESSION['admin'] == false) {
        die("Not administrator.");
    }
}
?>
