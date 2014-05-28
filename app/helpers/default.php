<?php

Form::macro('selectModel', function($model, $property, $selected, $name, $htmlProperties = array(), $zero = '') {
	$arr = array();
	if($zero) {
		$arr['0'] = $zero;
	}
	foreach($model as $item) {
		$arr[$item->id] = ucfirst($item->$property);
	}
	return Form::select($name, $arr, $selected, $htmlProperties);
});

Form::macro('selectSource', function($name, $selected, $htmlProperties, $zero = false) {
	$arr = array();
	if($zero) $arr['all'] = 'All';
	$arr['organic'] = 'Organic'; $arr['import'] = 'Import';
	
	return Form::select($name, $arr, $selected, $htmlProperties);
});


//Taken from http://stackoverflow.com/a/3291689/762551
function crypto_rand_secure($min, $max) {
	$range = $max - $min;
	if ($range < 0) return $min; // not so random...
	$log = log($range, 2);
	$bytes = (int) ($log / 8) + 1; // length in bytes
	$bits = (int) $log + 1; // length in bits
	$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
	do {
		$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
		$rnd = $rnd & $filter; // discard irrelevant bits
	} while ($rnd >= $range);
	return $min + $rnd;
}

//Taken from http://stackoverflow.com/a/3291689/762551
function getToken($length=32) {
	$token = "";
	$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
	$codeAlphabet.= "0123456789";
	for($i=0;$i<$length;$i++){
		$token .= $codeAlphabet[crypto_rand_secure(0,strlen($codeAlphabet))];
	}
	return $token;
}

function getInputOrSession($var) {
    if(Input::get($var)) {
	$result = Input::get($var);
        Session::put($var, $result);
    } else if(Session::get($var)) {
        $result = Session::get($var);
    } else {
	$result = '0';
    }
    return $result;
}

function getDateInputOrSession($var) {
    if(Input::get($var)) {
	$result = Input::get($var);
        Session::put($var, $result);
    } else if(Session::get($var)) {
        $result = new Datetime(Session::get($var));
    } else {
	$result = date('Y-m-d H:i:s');
    }
    return $result;
}

function getColumnSum($array, $columnname) {
    $sum = 0;
    foreach ($array as $a){
        $sum = $sum + $a[$columnname];
    }
    return $sum;
}

