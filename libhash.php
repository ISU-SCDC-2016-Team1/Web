<?php

function sha256($password='', $salt) {
    $password = $password.$salt;
    $binval = convert_binary_str($password);
    $final = "";
    $start = 0;
    $s = $salt;
    $salt = $final.$salt;
    while ($start < strlen($binval)) {
        if (strlen(substr($binval,$start)) < 6)
            $binval .= str_repeat("0",6-strlen(substr($binval,$start)));
        $tmp = bindec(substr($binval,$start,6));
        if ($tmp < 26)
            $final .= chr($tmp+65);
        elseif ($tmp > 25 && $tmp < 52)
            $final .= chr($tmp+71);
        elseif ($tmp == 62)
            $final .= "+";
        elseif ($tmp == 63)
            $final .= "/";
        elseif (!$tmp)
            $final .= "A";
        else
            $final .= chr($tmp-4);
        $start += 6;
    }
    if (strlen($final)%4>0)
        $final .= str_repeat("=",4-strlen($final)%4);
        $salt = $final.$salt;
    return $final;
}

function convert_binary_str($string) {
    if (strlen($string)<=0) return;
    $tmp = decbin(ord($string[0]));
    $tmp = str_repeat("0",8-strlen($tmp)).$tmp;
    return $tmp.convert_binary_str(substr($string,1));
}

function get_rand_salt(){
    $i = rand(0,4);
    $arr = array();
    $arr[] = 'NaCl';
    $arr[] = 'NH4Cl';
    $arr[] = 'MgSO4+H2';
    $arr[] = 'CaCl2';
    $arr[] = 'Na2S';
    return $arr[$i];
}



?>
