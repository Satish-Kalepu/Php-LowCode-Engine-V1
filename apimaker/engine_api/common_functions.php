<?php

function json_response($v, $v2 = ""){
	if( gettype($v) == "array" ){
		header("Content-Type: application/json");
		echo json_encode($v);
	}else if( $v == "success" || $v == "fail" ){
		header("Content-Type: application/json");
		echo json_encode([
			"status"=>$v,
			"details"=>$v2
		]);
	}
	exit;
}