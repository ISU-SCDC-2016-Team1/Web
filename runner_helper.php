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

function do_runner($f,$p,$r,$u,$re,$m,$s) {
    $fnt = clean_input('/[^a-zA-Z0-9]/', $f);
    $project = clean_input('/[^a-zA-Z0-9 _\/-]/', $p);
    $runner = clean_input('/[^a-zA-Z0-9]/', $r);
    $user = clean_input('/[^a-zA-Z0-9]/', $u);
    $redirect = clean_input('/[^a-zA-Z0-9]/', $re);
    $method = clean_input('/[^a-zA-Z0-9]/', $m);

	$out = "";

    exec("keyescrow get -s /tmp -u $user -t " . $_SESSION['token']);
    if ($fnt == 'stdin') {
        $f = fopen('/tmp/stdin_'.$user.'_stdin.tmp', 'w');
        fwrite($f, $stdin);
        fclose($f);

		$out = file_get_contents("http://127.0.0.1:5634/?function=" . $fnt . "&project=" . $project . '&runner=' . $runner . '&user=' . $user . '&redirect=' . $redirect . '&method=' . $method);
        exec('rm -rf /tmp/stdin_'.$user.'_stdin.tmp');
    } else {
		$out = file_get_contents("http://127.0.0.1:5634/?function=" . $fnt . "&project=" . $project . '&runner=' . $runner . '&user=' . $user . '&redirect=' . $redirect . '&method=' . $method);
    }
	exec("rm /tmp/$user.priv");
	return $out;

}

?>
