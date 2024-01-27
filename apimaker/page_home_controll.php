<?php

if( $_POST['action'] == "load_apps" ){

	if( !$_POST['token'] ){
		json_response([
			"status"=>"fail",
			"error"=>"Token not found"
		]);
	}
	$token_status = validate_token(  "load_apps", $_POST['token'] );

	if( $token_status != "OK" ){
		json_response([
			"status"=>"TokenError",
			"error"=>$token_status
		]);
	}

	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_apps", ['deleted'=>['$exists'=>false]], ['sort'=>[ 'app'=>1 ]] );
	if( $res['status'] == 'success' ){
		json_response([
			"status"=>"success",
			"apps"=>$res['data']
		]);
	}else{
		json_response([
			"status"=>"fail",
			"error"=>$res['error']
		]);
	}
}

if( $_POST['action'] == "delete_app" ){
	if( !$_POST['token'] ){
		json_response([
			"status"=>"fail",
			"error"=>"Token not found"
		]);
	}
	$token_status = validate_token(  "delete_app", $_POST['token'] );

	if( $token_status != "OK" ){
		json_response([
			"status"=>"TokenError",
			"error"=>$token_status
		]);
	}

	if( !preg_match("/^[a-z0-9\-]{3,25}$/", $_POST['app_id']) ){
		json_response("fail", "Name incorrect");
	}

	$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apps", [
		'_id'=>$_POST['app_id']
	]);
	if( !$res['data'] ){
		json_response("fail", "Does not exists");
	}

	$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_apps", [
		'_id'=>$_POST['app_id']
	],
	[
		"deleted"=>'y',
		"deleted_date"=>date("Y-m-d H:i:s"),
		"active"=>false,
	]);
	//http_response(500, "something wrong");
	json_response([
		"status"=>"success",
	]);

}

if( $_POST['action'] == "create_app" ){

	if( !$_POST['token'] ){
		json_response([
			"status"=>"fail",
			"error"=>"Token not found"
		]);
	}
	$token_status = validate_token(  "create_app", $_POST['token'] );

	if( $token_status != "OK" ){
		json_response([
			"status"=>"TokenError",
			"error"=>$token_status
		]);
	}

	if( !preg_match("/^[a-z0-9\-]{3,25}$/", $_POST['new_app']['app']) ){
		json_response("fail", "Name incorrect");
	}
	if( !preg_match("/^[a-z0-9\!\@\%\^\&\*\.\-\_\'\"\n\r\t\ ]{5,50}$/i", $_POST['new_app']['des']) ){
		json_response("fail", "Description incorrect");
	}
	$_POST['new_app']['app'] = trim($_POST['new_app']['app']);
	$_POST['new_app']['des'] = trim($_POST['new_app']['des']);
	$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apps", [
		'app'=>$_POST['new_app']['app']
	]);
	if( $res['data'] ){
		json_response("fail", "Already exists");
	}
	$version_id = $mongodb_con->generate_id();
	$res = $mongodb_con->insert( $config_global_apimaker['config_mongo_prefix'] . "_apps", [
		"app"=>$_POST['new_app']['app'],
		"des"=>$_POST['new_app']['des'],
		"created"=>date("Y-m-d H:i:s"),
		"updated"=>date("Y-m-d H:i:s"),
		"active"=>true,
	]);
	//http_response(500, "something wrong");
	json_response([
		"status"=>"success",
	]);
}