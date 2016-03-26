<?php

require_once 'db_helper.php';
require_once 'login_helper.php';

function get_public_key($username) {
    $user = clean_input('/[^a-zA-Z0-9]/', $username);
    $cmd = "ke -s 10.3.3.2:7654 get -u $user -t " . $_SESSION['token'];
    $output = shell_exec($cmd);
    $lines = explode("\n",$output);
    $out = '';
    $i = 0;
    foreach($lines as $line){
        if($i == 3){
            $out = $out.$line;
        }
        $i++;
    }
    $out = substr($out,12);
    return $out;
}

function get_private_key($username){
    $user = clean_input('/[^a-zA-Z0-9]/', $username);
    $cmd ="ke -s 10.3.3.2:7654 get -u $user -t " . $_SESSION['token'];
    $output = shell_exec($cmd);
    $lines = explode("\n",$output);
    $out = '';
    $i = 0;
    foreach($lines as $line){
        if($i > 4){
            if($i == 5) {
                $a = substr($line,13);
                $out = $out.$a.PHP_EOL;
            } elseif ($line != '') {
                $out = $out.$line.PHP_EOL;
            }
        }
        $i++;
    }
    return $out;
}

function do_runner($f,$p,$r,$u,$re,$m,$s) {
    set_time_limit(10000);
    $fnt = clean_input('/[^a-zA-Z0-9]/', $f);
    $project = clean_input('/[^a-zA-Z0-9 _\/-]/', $p);
    $runner = clean_input('/[^a-zA-Z0-9]/', $r);
    $user = clean_input('/[^a-zA-Z0-9]/', $u);
    $redirect = clean_input('/[^a-zA-Z0-9]/', $re);
    $method = clean_input('/[^a-zA-Z0-9]/', $m);

    error_log("$fnt . $project . $runner . $user . $redirect . $method");

    $kf = "bash -c 'echo " . $_SESSION['token'] . " | /usr/local/bin/keyescrow-client get -s /tmp -u $user'";
    shell_exec($kf);
    if ($fnt == 'stdin') {
        shell_exec('rm -rf /tmp/stdin_'.$user);
        shell_exec('mkdir /tmp/stdin_'.$user);

        $f = fopen('/tmp/stdin_'.$user.'/stdin.tmp', 'w');
        fwrite($f, $stdin);
        fclose($f);

        $cmd = "/usr/local/bin/crconsole -u $user -i /tmp/$user.priv -p $project -r $runner stdin -f /tmp/stdin_$user/stdin.tmp 2>&1";
	$out = shell_exec($cmd);
	error_log($cmd);
	//shell_exec("rm /tmp/$user*");
        return $out;
    } else if ($fnt == 'get') {
	$cmd = "/usr/local/bin/crconsole -u $user -i /tmp/$user.priv -p $project -r $runner get -m $method 2>&1";
        $out = shell_exec($cmd);
	error_log($cmd);
	//shell_exec("rm /tmp/$user*");
        return $out;
    } else if ($fnt == 'run') {
	$cmd = "/usr/local/bin/crconsole -u $user -i /tmp/$user.priv -p $project -r $runner run -x $redirect 2>&1";
        $out = shell_exec($cmd);
	error_log($cmd);
	//shell_exec("rm /tmp/$user*");
        return $out;
    } else {
	$cmd = "/usr/local/bin/crconsole -u $user -i /tmp/$user.priv -p $project -r $runner $fnt 2>&1";
        #$cmd = 'sleep 30 && echo "hi"';
	$out = shell_exec($cmd);
	error_log($cmd);	
	//shell_exec("rm /tmp/$user*");
        return $out;
    }
}

?>
