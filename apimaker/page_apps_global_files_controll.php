<?php

if( $_POST['action'] == "get_global_files" ){
	$t = validate_token("getglobalfiles.". $config_param1, $_POST['token']);
	if( $t != "OK" ){
		json_response("fail", $t);
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_global_files", [
		'app_id'=>$config_param1,
		"path"=>$_POST['current_path'],
	],[
		'projection'=>[
			'body'=>false,'data'=>false,
		],
		'sort'=>['name'=>1],
		'limit'=>200,
	]);
	json_response($res);
	exit;
}

if( $config_param3 ){
	if( !preg_match("/^[a-f0-9]{24}$/", $config_param3) ){
		echo404("Incorrect File ID");
	}
	$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_global_files", [
		'app_id'=>$app['_id'],
		'_id'=>$config_param3
	]);
	if( !$res['data'] ){
		echo404("File not found!");
	}
	$file = $res['data'];

	if( $_POST['action'] == "file_load_content" ){
		if( $file['t'] != "base64" ){
			json_response(['status'=>"fail", "error"=>"Incorrect file type"]);exit;
		}
		json_response([
			'status'=>'success',
			'data'=>$file['data']
		]);
		exit;
	}

	if( $file['t'] != "inline" ){
		unset($file['data']);
	}
	//print_r( $file );exit;
	//unset($file['data']);

	$mode = "htmlmixed";
	if( $file['type'] == "text/html" ){
		$mode = "htmlmixed";
	}else if( $file['type'] == "text/css" ){
		$mode = "css";
	}else if( $file['type'] == "text/javascript" ){
		$mode = "javascript";
	}

}