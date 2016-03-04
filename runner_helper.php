<?php

function get_public_key($user){
    $cmd ='USER="'.$user.'" ke -s 192.168.1.11:7654 get';
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

function get_private_key($user){
    $cmd ='USER="'.$user.'" ke -s 192.168.1.11:7654 get';
    $output = shell_exec($cmd);
    $lines = explode("\n",$output);
    $out = '';
    $i = 0;
    foreach($lines as $line){
        if($i > 4){
            if($i == 5){
                $a = substr($line,13);
                $out = $out.$a.PHP_EOL;
            }elseif($line != ''){
                $out = $out.$line.PHP_EOL;
            }
        }
        $i++;
    }
    return $out;
}

function do_runner($fnt,$project,$runner,$user,$stdin){
    exec("USER=\"$user\" keyescrow get -t /tmp");
    if($fnt == 'stdin'){
        shell_exec('mkdir /tmp/stdin_'.$user);
        shell_exec('echo "'.$stdin.'" > /tmp/stdin_'.$user.'/stdin.tmp');
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
