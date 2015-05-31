<?php
// this is a sample login script. place this in http://localhost/osamlogin.php
// if you are changing the URL of this app, please coordinate with COMMIT.

define('API_SECRET','isTdRsjIj3GTEMI6kMD0');
define('API_URL','https://www.uplbosa.org/legacy/oneauth?code=onlineyearbook');

if ($_GET['auth']) {
	$code = $_GET['code'];
	$hash = md5($_GET['auth'].' '.API_SECRET);
	// verify if code is correct
	$array = array('code' => $_GET['auth'], 'hash' => $hash);
	$options = array(
	  'http'=>array(
		'method'=>"POST",
		'header'=>
		  "Accept-language: en\r\n".
		  "Content-type: application/x-www-form-urlencoded\r\n",
		'content'=>http_build_query($array,'','&')
	));
	$context = stream_context_create($options);
	$result = @file_get_contents('https://www.uplbosa.org/legacy/oneauth?code=onlineyearbook',false,$context);
	$result = json_decode($result,true);
	if ($result['error']) {
		die('Cannot log you in: '.$result['error']);
	} else if ($result['data']) {
		// user successfully logged in
		die('You logged in successfully! Your student number is <strong>'.$result['data']['student_no'].'</strong> and your name is <strong>'.$result['data']['name'].'</strong>.');
	}
} else {
	header('Location: https://www.uplbosa.org/legacy/oneauth?code=onlineyearbook');
	exit;
} 