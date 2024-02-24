<?php

if( $_POST['action'] == "get_apis" ){
	$t = validate_token("getapis.". $config_param1, $_POST['token']);
	if( $t != "OK" ){
		json_response("fail", $t);
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
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

if( $_POST['action'] == "delete_api" ){
	$t = validate_token("deleteapi". $config_param1 . $_POST['api_id'], $_POST['token']);
	if( $t != "OK" ){
		json_response("fail", $t);
	}
	if( !preg_match("/^[a-f0-9]{24}$/i", $_POST['api_id']) ){
		json_response("fail", "ID incorrect");
	}
	$res = $mongodb_con->delete_one( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
		'_id'=>$_POST['api_id']
	]);
	$res = $mongodb_con->delete_many( $config_global_apimaker['config_mongo_prefix'] . "_apis_versions", [
		'api_id'=>$_POST['api_id']
	]);
	update_app_pages( $config_param1 );
	json_response($res);
}

if( $_POST['action'] == "create_api" ){
	if( !preg_match("/^[a-z0-9\.\-\_]{3,100}$/i", $_POST['new_api']['name']) ){
		json_response("fail", "Name incorrect");
	}
	if( !preg_match("/^[a-z0-9\!\@\%\^\&\*\.\-\_\'\"\n\r\t\ ]{5,250}$/i", $_POST['new_api']['des']) ){
		json_response("fail", "Description incorrect");
	}
	$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
		"app_id"=>$config_param1,
		'name'=>$_POST['new_api']['name']
	]);
	if( $res['data'] ){
		json_response("fail", "Already exists");
	}
	$version_id = $mongodb_con->generate_id();
	$res = $mongodb_con->insert( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
		"app_id"=>$config_param1,
		"name"=>$_POST['new_api']['name'],
		"des"=>$_POST['new_api']['des'],
		"type"=>"api",
		"created"=>date("Y-m-d H:i:s"),
		"updated"=>date("Y-m-d H:i:s"),
		"active"=>true,
		"version"=>1,
		"version_id"=>$version_id,
		"type"		=> "api",
		"output-type"	=> "application/json",
		"input-method"	=> "POST",
		"input-type"	=> "application/json",
	]);
	if( $res['status'] == 'success' ){
		$res = $mongodb_con->insert( $config_global_apimaker['config_mongo_prefix'] . "_apis_versions", [
			"_id"=>$mongodb_con->get_id($version_id),
			"app_id"=>$config_param1,
			"api_id"=>$res['inserted_id'],
			"name"=>$_POST['new_api']['name'],
			"des"=>$_POST['new_api']['des'],
			"type"=>"api",
			"created"=>date("Y-m-d H:i:s"),
			"updated"=>date("Y-m-d H:i:s"),
			"active"=>true,
			"version"=>1,
			"type"		=> "api",
			"output-type"	=> "application/json",
			"input-method"	=> "POST",
			"input-type"	=> "application/json",
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
	$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
		'app_id'=>$app['_id'],
		'_id'=>$config_param3
	]);
	if( !$res['data'] ){
		echo404("Api not found!");
	}
	$main_api = $res['data'];
}

if( $config_param4 && $main_api ){
	if( !preg_match("/^[a-f0-9]{24}$/", $config_param4) ){
		echo404("Incorrect API Version ID");
	}
	$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis_versions", [
		"api_id"=>$main_api['_id'],
		"_id"=>$config_param4
	]);
	if( $res['data'] ){
		$api = $res['data'];
	}else{
		echo404("Api version not found!");
	}

	if( $_POST['action'] == "load_engine_data" ){
		json_response([
			"status"=>"success", 
			"engine"=>($api['engine']?$api['engine']:[]), 
			"test"=>($api['test']?$api['test']:[])
		]);
	}
	unset($api['engine']);
	unset($api['test']);
	if( $_POST['action'] == "edit_api" ){
		$t = validate_token("edit_api". $_POST['edit_api']['_id'], $_POST['token']);
		if( $t != "OK" ){
			json_response("fail", $t);
		}
		if( !preg_match("/^[a-z0-9\.\-\_]{3,100}$/i", $_POST['edit_api']['name']) ){
			json_response("fail", "Name incorrect");
		}
		if( !preg_match("/^[a-z0-9\!\@\%\^\&\*\.\-\_\'\"\n\r\t\ ]{5,250}$/i", $_POST['edit_api']['des']) ){
			json_response("fail", "Description incorrect");
		}
		// uses above api record
		// $res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
		// 	'_id'=>$_POST['edit_api']['_id']
		// ]);
		// if( !$res['data'] ){
		// 	json_response("fail", "Record not found");
		// }
		// $api = $res['data'];
		$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
			'name'=>$_POST['edit_api']['name'],
			'_id'=>['$ne'=>$mongodb_con->get_id($_POST['edit_api']['api_id']) ]
		]);
		if( $res['data'] ){
			json_response("fail", "Name is already in use");
		}
		$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
			'_id'=>$_POST['edit_api']['api_id']
		],[
			"name"=>$_POST['edit_api']['name'],
			"des"=>$_POST['edit_api']['des'],
			"updated"=>date("Y-m-d H:i:s"),
			"active"=>true,
		]);
		$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_apis_versions", [
			'_id'=>$config_param4
		],[
			"name"=>$_POST['edit_api']['name'],
			"des"=>$_POST['edit_api']['des'],
			"updated"=>date("Y-m-d H:i:s"),
			"active"=>true,
		]);
		update_app_pages( $config_param1 );
		//update_app_last_change_date( $config_param1 );
		json_response($res);
		exit;
	}

	if( $_POST['action'] == "save_engine_test" ){
		$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_apis_versions", [
			"app_id"=> $config_param1,
			"_id"=>$config_param4
		],[
			"test"=>$_POST['test']
		]);
		if($res["status"] == "fail" ){
			json_response("fail",$res["error"]);
		}
		json_response("success","ok");
	}

	if( $_POST['action'] == "save_engine_data" ){
		if( !preg_match("/^[a-f0-9]{24}$/", $_POST['api_id'] ) ){
			json_response("fail", "Error In Page Id");
		}else if( !preg_match("/^[a-f0-9]{24}$/", $_POST['version_id'] ) ){
			json_response("fail", "Error In Version Id");
		}
		$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis_versions", [
			"_id"=>$_POST['version_id']
		]);
		if( $res["status"] == "fail" ){
			json_response("fail","Error finding version: ".$res["error"]);
		}else if( !$res['data'] ){
			json_response("fail","Version record not found");
		}
		$version = $res['data'];

		if( $version['api_id'] != $_POST['api_id'] ){
			json_response("fail","Incorrect version ID mapping");
		}

		$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
			"_id"=>$_POST['api_id']
		]);
		if( $res["status"] == "fail" ){
			json_response("fail","Error finding API: ".$res["error"]);
		}else if( !$res['data'] ){
			json_response("fail","API record not found");
		}
		$api = $res['data'];

		$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_apis_versions", [
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

		if( $api['version_id'] == $version['_id'] ){
			$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
				"_id"=> $_POST['api_id']
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

	if($_POST['action'] == "postman_collection_export") {
		if(!isset($_POST['api_id'])) {
			json_response("fail", "Page Id should not be empty");
		}
		if(!isset($_POST['version_id'])) {	
			json_response("fail", "Version ID should not be empty");
		}
		if( !preg_match("/^[a-f0-9]{24}$/", $_POST['api_id'] ) ){
			json_response("fail", "Error In Page Id");
		}
		if( !preg_match("/^[a-f0-9]{24}$/", $_POST['version_id'] ) ){
			json_response("fail", "Error In Version Id");
		}

		$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis_versions", [
			"_id"=>$_POST['version_id']
		]);
		if( $res["status"] == "fail" ){
			json_response("fail","Error finding version: ".$res["error"]);
		}else if( !$res['data'] ){
			json_response("fail","Version record not found");
		}
		$version = $res['data'];

		if( $version['api_id'] != $_POST['api_id'] ){
			json_response("fail","Incorrect version ID mapping");
		}

		$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
			"_id"=>$_POST['api_id']
		]);
		if( $res["status"] == "fail" ){
			json_response("fail","Error finding API: ".$res["error"]);
		}else if( !$res['data'] ){
			json_response("fail","API record not found");
		}

		$api = $res['data'];

		if( $api['version_id'] == $version['_id'] ){
			/*Postman Collection Export Code*/
			$json_data = array();

			$json_data['info'] = ['_postman_id' => "",'name' => $version['name']." ".$version['des'],'schema' => 'https://schema.getpostman.com/json/collection/v2.1.0/collection.json','_exporter_id' => ""];

			/*Post body input fields start*/

			$req_json_data = array();

			foreach($version['engine']['input_factors'] as $k => $v) {
				$req_json_data[$k] = "";
			}


			$req_data = array();
			$req_data['mode'] = "raw";
			$req_data['raw'] = json_encode($req_json_data);
			$req_data['options']['raw']['language'] = "json";

			/*Post body input fields ends*/

			/*Query string start*/

			$que_data = array();
			$url = str_replace("\n", "", base64_decode($_POST['engine_url']));
			$query_str = parse_url($url);
			parse_str($query_str['query'], $query_params);

			foreach ($query_params as $key => $value) {
				$que_data[] = ['key' => $key, 'value' => $value];
			}

			/*Query string ends*/

			$req_url = array();
			$req_url['raw'] = base64_decode($_POST['engine_url']);
			$req_url['protocol'] = (preg_match("/localhost/i",base64_decode($_POST['engine_url'])) == 1?"http":"https");
			$host_data = explode(":", (string)$_SERVER['HTTP_HOST']);
			$req_url['host'] = explode(".", (string)$host_data[0]);
			if($host_data[1]) {
				$req_url['port'] = $host_data[1];
			}
			$req_url['path'][] = "engine";
			$req_url['path'][] = "";

			if(count($que_data) > 0) {
				$req_url['query'] = $que_data;
			}

			$data_postman = array();
			$data_postman['name'] = $version['name']." ".$version['des'];
			$data_postman['request']['method'] = $version['input-method'];
			$data_postman['request']['header'] = [];
			if($data_postman['request']['method'] == "POST") {
				$data_postman['request']['body'] = $req_data;
			}
			$data_postman['request']['url'] = $req_url;
			$data_postman['response'] = [];

			$doc_data = array();
			$doc_data[] = $data_postman;
			$json_data['item'] = $doc_data;
			$json = json_encode($json_data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

			$filename = $version['name']." ".$version['des'].".json";

			json_response("success",["file" => $filename,'json_data' => $json]);
		}else {
			json_response("fail","Invalid Post Data");
		}

	}

	if(isset($_POST['action']) && $_POST['action'] == "get_code_snippt_lang") {
		if(!isset($_POST['api_id'])) {
			json_response("fail", "Page Id should not be empty");
		}
		if(!isset($_POST['version_id'])) {	
			json_response("fail", "Version ID should not be empty");
		}
		if( !preg_match("/^[a-f0-9]{24}$/", $_POST['api_id'] ) ){
			json_response("fail", "Error In Page Id");
		}
		if( !preg_match("/^[a-f0-9]{24}$/", $_POST['version_id'] ) ){
			json_response("fail", "Error In Version Id");
		}

		$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis_versions", [
			"_id"=>$_POST['version_id']
		]);
		if( $res["status"] == "fail" ){
			json_response("fail","Error finding version: ".$res["error"]);
		}else if( !$res['data'] ){
			json_response("fail","Version record not found");
		}
		$version = $res['data'];

		if( $version['api_id'] != $_POST['api_id'] ){
			json_response("fail","Incorrect version ID mapping");
		}

		$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
			"_id"=>$_POST['api_id']
		]);
		if( $res["status"] == "fail" ){
			json_response("fail","Error finding API: ".$res["error"]);
		}else if( !$res['data'] ){
			json_response("fail","API record not found");
		}

		$api = $res['data'];

		if( $api['version_id'] == $version['_id'] ) {
			require_once("classes/class_code_snippet.php");

			$url = str_replace("\n", "", base64_decode($_POST['engine_url']));

			$code = new code_snippet($_POST['version_id'],$url,$_POST['selected_lang']);

			$generate_code = $code->code_snippet_convertor();

			json_response("success",$generate_code);
		}else {
			json_response("fail","Invalid Post data");
		}

	}

}