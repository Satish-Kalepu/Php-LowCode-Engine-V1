<?php

if( $_GET['action'] == "getcaptcha" ){

	$v = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz-!_.,@#$%^&*<>=";
	$cap = substr($v,rand(0,76),1)." ".substr($v,rand(0,76),1)." ".substr($v,rand(0,76),1)." ".substr($v,rand(0,76),1);
	$code = time();

	$im = imagecreatetruecolor(120,40);
	$white = imagecolorallocate($im, rand(0,255),rand(0,255),rand(0,255));
	imagefill($im, 0,0, $white);
	$white = imagecolorallocate($im, rand(110,255),rand(110,255),rand(110,255));

	$sz = rand(20,24);
	$angle = rand(-5,5);
	$x = rand(0,20);
	$y = rand(20,30);
	imagettftext($im, $sz, $angle, $x, $y, $white,  __DIR__."/arial.ttf", $cap);
	$red = imagecolorallocate($im, rand(0,55),rand(0,85),rand(0,95));
	imagettftext($im, $sz, $angle, $x+1, $y+1, $red,  __DIR__."/arial.ttf", $cap);
	$red = imagecolorallocate($im, rand(0,155),rand(0,155),rand(0,155));
	imagettftext($im, $sz, $angle, $x-1, $y-1, $red,  __DIR__."/arial.ttf", $cap);

	$_SESSION['login_captcha'] = str_replace(" ","", $cap);
	$_SESSION['login_code'] = $code;

	//header("Content-Type: image/jpeg");imagepng($im);exit;
	ob_start();
	imagepng($im);
	$imagedata = ob_get_contents();
	ob_end_clean();
	json_response([
		"status"=>"success",
		"img"=>"data:image/png;base64,".base64_encode($imagedata),
		"code"=>$code,
	]);
	exit;
}

