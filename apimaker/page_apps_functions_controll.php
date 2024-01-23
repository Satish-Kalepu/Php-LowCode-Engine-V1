<?php

if( $_POST['action'] == "get_functions" ){
	$t = validate_token("getfunctions.". $config_param1, $_POST['token']);
	if( $t != "OK" ){
		json_response("fail", $t);
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_functions", [
		'app_id'=>$config_param1
	],[
		'sort'=>['name'=>1],
		'limit'=>200,
		'projection'=>[
			'engine'=>false
		]
	]);
	json_response($res);
	exit;
}

if( $_POST['action'] == "delete_function" ){
	$t = validate_token("deletefunction". $config_param1 . $_POST['function_id'], $_POST['token']);
	if( $t != "OK" ){
		json_response("fail", $t);
	}
	if( !preg_match("/^[a-f0-9]{24}$/i", $_POST['function_id']) ){
		json_response("fail", "ID incorrect");
	}
	$res = $mongodb_con->delete_one( $config_global_apimaker['config_mongo_prefix'] . "_functions", [
		'_id'=>$_POST['function_id']
	]);
	$res = $mongodb_con->delete_many( $config_global_apimaker['config_mongo_prefix'] . "_functions_versions", [
		'function_id'=>$_POST['function_id']
	]);
	update_app_pages( $config_param1 );
	json_response($res);
}

if( $_POST['action'] == "create_function" ){
	if( !preg_match("/^[a-z0-9\.\-\_\ ]{3,100}$/i", $_POST['new_function']['name']) ){
		json_response("fail", "Name incorrect");
	}
	if( !preg_match("/^[a-z0-9\!\@\%\^\&\*\.\-\_\'\"\n\r\t\ ]{5,200}$/i", $_POST['new_function']['des']) ){
		json_response("fail", "Description incorrect");
	}
	$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_functions", [
		'name'=>$_POST['new_function']['name']
	]);
	if( $res['data'] ){
		json_response("fail", "Already exists");
	}
	$version_id = $mongodb_con->generate_id();
	$res = $mongodb_con->insert( $config_global_apimaker['config_mongo_prefix'] . "_functions", [
		"app_id"=>$config_param1,
		"name"=>$_POST['new_function']['name'],
		"des"=>$_POST['new_function']['des'],
		"created"=>date("Y-m-d H:i:s"),
		"updated"=>date("Y-m-d H:i:s"),
		"version"=>1,
		"version_id"=>$version_id,
	]);
	if( $res['status'] == "success" ){
		$res = $mongodb_con->insert( $config_global_apimaker['config_mongo_prefix'] . "_functions_versions", [
			"_id"=>$mongodb_con->get_id($version_id),
			"app_id"=>$config_param1,
			"function_id"=>$res['inserted_id'],
			"name"=>$_POST['new_function']['name'],
			"des"=>$_POST['new_function']['des'],
			"created"=>date("Y-m-d H:i:s"),
			"updated"=>date("Y-m-d H:i:s"),
			"version"=>1,
		]);
		update_app_pages( $config_param1 );
		json_response($res);
	}else{
		json_response($res);
	}
	exit;
}

if( $config_param3 ){
	if( !preg_match("/^[a-f0-9]{24}$/", $config_param3) ){
		echo404("Incorrect API ID");
	}
	$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_functions", [
		'app_id'=>$app['_id'],
		'_id'=>$config_param3
	]);
	if( !$res['data'] ){
		echo404("Api not found!");
	}
	$main_function = $res['data'];
}

if( $config_param4 && $main_function ){
	if( !preg_match("/^[a-f0-9]{24}$/", $config_param4) ){
		echo404("Incorrect API Version ID");
	}
	$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_functions_versions", [
		"function_id"=>$main_function['_id'],
		"_id"=>$config_param4
	]);
	if( $res['data'] ){
		$function = $res['data'];
	}else{
		echo404("Api version not found!");
	}

	//print_pre( $function );exit;

	if( $_POST['action'] == "load_engine_data" ){
		json_response([
			"status"=>"success", 
			"engine"=>($function['engine']?$function['engine']:[]), 
			"test"=>($function['test']?$function['test']:[])
		]);
	}
	unset($function['engine']);
	unset($function['test']);
	if( $_POST['action'] == "edit_function" ){
		$t = validate_token("edit_function". $_POST['edit_function']['_id'], $_POST['token']);
		if( $t != "OK" ){
			json_response("fail", $t);
		}
		if( !preg_match("/^[a-z0-9\.\-\_\ ]{3,100}$/i", $_POST['edit_function']['name']) ){
			json_response("fail", "Name incorrect");
		}
		if( !preg_match("/^[a-z0-9\!\@\%\^\&\*\.\-\_\'\"\n\r\t\ ]{5,250}$/i", $_POST['edit_function']['des']) ){
			json_response("fail", "Description incorrect");
		}
		$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_functions", [
			'name'=>$_POST['edit_function']['name'],
			'_id'=>['$ne'=>$mongodb_con->get_id($_POST['edit_function']['function_id']) ]
		]);
		if( $res['data'] ){
			json_response("fail", "Name is already in use");
		}
		$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_functions", [
			'_id'=>$_POST['edit_function']['function_id']
		],[
			"name"=>$_POST['edit_function']['name'],
			"des"=>$_POST['edit_function']['des'],
			"updated"=>date("Y-m-d H:i:s"),
		]);
		$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_functions_versions", [
			'_id'=>$config_param4
		],[
			"name"=>$_POST['edit_function']['name'],
			"des"=>$_POST['edit_function']['des'],
			"updated"=>date("Y-m-d H:i:s"),
		]);
		update_app_last_change_date( $config_param1 );
		json_response($res);
		exit;
	}

	if( $_POST['action'] == "save_engine_test" ){
		$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_functions_versions", [
			"app_id"=> $config_param1,
			"_id"=>$config_param4
		],[
			"test"=>$_POST['test']
		]);
		if($res["status"] == "fail" ){
			json_response("fail",$res["error"]);
		}
		update_app_last_change_date( $config_param1 );
		json_response("success","ok");
	}

	if( $_POST['action'] == "save_engine_data" ){
		if( !preg_match("/^[a-f0-9]{24}$/", $_POST['function_id'] ) ){
			json_response("fail", "Error In Page Id");
		}else if( !preg_match("/^[a-f0-9]{24}$/", $_POST['version_id'] ) ){
			json_response("fail", "Error In Version Id");
		}
		$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_functions_versions", [
			"_id"=>$_POST['version_id']
		]);
		if( $res["status"] == "fail" ){
			json_response("fail","Error finding version: ".$res["error"]);
		}else if( !$res['data'] ){
			json_response("fail","Version record not found");
		}
		$version = $res['data'];

		if( $version['function_id'] != $_POST['function_id'] ){
			json_response("fail","Incorrect version ID mapping");
		}

		$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_functions", [
			"_id"=>$_POST['function_id']
		]);
		if( $res["status"] == "fail" ){
			json_response("fail","Error finding API: ".$res["error"]);
		}else if( !$res['data'] ){
			json_response("fail","API record not found");
		}
		$function = $res['data'];

		$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_functions_versions", [
			"_id"=> $_POST['version_id']
		],[
			"type"		=> $_POST['type'],
			"input-method"	=> $_POST['input-method'],
			"input-type"	=> $_POST['input-type'],
			"output-type"	=> $_POST['output-type'],
			"engine"	=> $_POST['data'],
			"updated"	=> date("Y-m-d H:i:s"),
		]);
		if( $res["status"] == "fail" ){
			json_response("fail","Version update failed: ".$res["error"]);
		}

		if( $function['version_id'] == $version['_id'] ){
			$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_functions", [
				"_id"=> $_POST['function_id']
			],[
				"type"		=> $_POST['type'],
				"input-method"	=> $_POST['input-method'],
				"input-type"	=> $_POST['input-type'],
				"output-type"	=> $_POST['output-type'],
				"engine"	=> $_POST['engine'],
				"updated"	=> date("Y-m-d H:i:s"),
			]);
			if( $res["status"] == "fail" ){
				json_response("fail","API update failed: ".$res["error"]);
			}
		}
		update_app_last_change_date( $config_param1 );
		json_response("success", "OK");
	}

}