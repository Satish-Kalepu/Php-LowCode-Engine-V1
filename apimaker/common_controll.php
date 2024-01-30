<?php

if( $_POST['action'] == "get_token" ){
	if( $_POST['expire'] ){
		$v = get_token( $_POST['event'], (is_numeric($_POST['expire'])?$_POST['expire']:5) );
	}else{
		$v = get_token( $_POST['event'] );
	}
	if( preg_match("/^[a-f0-9]{24}$/", $v ) ){
		json_response(['status'=>"success", 'token'=>$v]);
	}else{
		json_response(['status'=>"fail", 'error'=>$v]);
	}
	exit;
}
