<?php

if( $_POST['action'] == "get_token" ){
	if( !isset($_POST['event']) ){
		json_response(['status'=>"fail", 'error'=>"missing data"]);
	}
	if( isset($_POST['expire']) ){
		if( isset($_POST['max_hits']) ){
			$v = get_token( $_POST['event'], (is_numeric($_POST['expire'])?$_POST['expire']:5), (is_numeric($_POST['max_hits'])?$_POST['max_hits']:10) );
		}else{
			$v = get_token( $_POST['event'], (is_numeric($_POST['expire'])?$_POST['expire']:5) );
		}
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
