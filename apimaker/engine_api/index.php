<?php

$locs = [
	"../config_global_apimaker.php",
	"../../config_global_apimaker.php",
	"../../../config_global_apimaker.php",
	"../../../../config_global_apimaker.php",
	"/var/tmp/config_global_apimaker.php",
];
foreach( $locs as $i=>$j ){
	if( file_exists($j) ){
		require($j);
		break;
	}
}

require("../common_functions.php");
require("../control_config.php");

$app_id = $_SERVER['HTTP_APPID'];
$app_key = $_SERVER['HTTP_APPKEY'];
if( !$app_id || !$app_key ){
	json_response([
		"status"=>"fail",
		"error"=>"AppID and Key Missing"
	]);
}

if( !$config_global_apimaker[ "config_engine_keys" ] ){
	json_response([
		"status"=>"fail",
		"error"=>"config_engine_keys missing"
	]);
}
if( !$config_global_apimaker[ "config_engine_keys" ][ $app_key ] ){
	json_response([ "status"=>"fail", "error"=>"app_key not found!"]);
}
if( !$config_global_apimaker[ "config_engine_keys" ][ $app_key ][ "apps_allowed"][ "*" ] && !$config_global_apimaker[ "config_engine_keys" ][ $app_key ][ "apps_allowed"][ $app_id ] ){
	json_response([ "status"=>"fail", "error"=>"app not allowed!"]); exit;
}
if( !$config_global_apimaker[ "config_engine_keys" ][ $app_key ][ "apps_allowed"][ "*" ] && !$config_global_apimaker[ "config_engine_keys" ][ $app_key ][ "apps_allowed"][ $app_id ] ){
	json_response(["status"=>"fail", "error"=>"app not allowed!"]); exit;
}
if( !$config_global_apimaker[ "config_engine_keys" ][ $app_key ][ "ips_allowed"][ "*" ] ){
	foreach( $config_global_apimaker[ "config_engine_keys" ][ $app_key ][ "ips_allowed"][ "*" ] as $i=>$j ){

	}
}
if( $config_global_apimaker[ "config_engine_keys" ][ $app_key ][ "expire"] < date("Y-m-d H:i:s") ){
	json_response(["status"=>"fail", "error"=>"key expired!"]); exit;
}

$p = explode("/", $_GET['request_url']);

$path = $p[0];
if( sizeof($p)>1){$param1=$p[1];}else{$param1="";}
if( sizeof($p)>2){$param2=$p[2];}else{$param2="";}
if( sizeof($p)>3){$param3=$p[3];}else{$param3="";}
if( sizeof($p)>4){$param4=$p[4];}else{$param4="";}
if( sizeof($p)>5){$param5=$p[5];}else{$param5="";}

if( file_exists("page_" . $path . ".php") ){
	require("page_" . $path . ".php");
}else{
	http_response_code(404);
	header("ERROR: path not found");
	exit;
}