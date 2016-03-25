<?php

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

function do_runner($f,$p,$r,$u,$s) {
    $fnt = clean_input('/[^a-zA-Z0-9]/', $f);
    $project = clean_input('/[^a-zA-Z0-9 _-]/', $p);
    $runner = clean_input('/[^a-zA-Z0-9]/', $r);
    $user = clean_input('/[^a-zA-Z0-9]/', $r);

    exec("keyescrow get -t /tmp -u $user -t " . $_SESSION['token']);
    if($fnt == 'stdin'){
        shell_exec('rm -rf /tmp/stdin_'.$user);
        shell_exec('mkdir /tmp/stdin_'.$user);

        $f = fopen('/tmp/stdin_'.$user.'/stdin.tmp', 'w');
        fwrite($f, $stdin);
        fclose($f);

        $cmd = 'echo \'stdin "/tmp/stdin_'.$user.'/stdin.tmp", :'.$project.' => :'.$runner.'\' | USER="'.$user.'" crconsole 2>&1';
        $out = shell_exec($cmd);
        return $out;
    }else{
        $cmd = 'echo "'.$fnt.' :'.$project.' => :'.$runner.'" | USER="'.$user.'" crconsole 2>&1';
        $out = shell_exec($cmd);
        return $out;
    }
}

?>
