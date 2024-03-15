<?php

$config_global_files = [
	["name"=>"bootstrap/5.2/css/bootstrap.min.css", "type"=>"text/css" ],
	["name"=>"bootstrap/5.2/css/bootstrap-grid.min.css", "type"=>"text/css" ],
	["name"=>"bootstrap/5.2/css/bootstrap-grid.rtl.min.css", "type"=>"text/css" ],
	["name"=>"bootstrap/5.2/css/bootstrap-reboot.min.css", "type"=>"text/css" ],
	["name"=>"bootstrap/5.2/css/bootstrap-reboot.rtl.min.css", "type"=>"text/css" ],
	["name"=>"bootstrap/5.2/css/bootstrap.rtl.min.css", "type"=>"text/css" ],
	["name"=>"bootstrap/5.2/css/bootstrap-utilities.min.css", "type"=>"text/css" ],
	["name"=>"bootstrap/5.2/css/bootstrap-utilities.rtl.min.css", "type"=>"text/css" ],
	["name"=>"bootstrap/5.2/js/bootstrap.bundle.min.js", "type"=>"text/javascript" ],
	["name"=>"bootstrap/5.2/js/bootstrap.esm.min.js", "type"=>"text/javascript" ],
	["name"=>"bootstrap/5.2/js/bootstrap.min.js", "type"=>"text/javascript" ],
	["name"=>"www/axios.min.js", "type"=>"text/javascript" ],
	["name"=>"www/beautify-css.js", "type"=>"text/javascript" ],
	["name"=>"www/beautify-html.js", "type"=>"text/javascript" ],
	["name"=>"www/beautify.js", "type"=>"text/javascript" ],
	["name"=>"www/codemirror.js", "type"=>"text/javascript" ],
	["name"=>"www/jszip.min.js", "type"=>"text/javascript" ],
	["name"=>"www/vue3.min.js", "type"=>"text/javascript" ],
	["name"=>"www/vue3.min.prod.js", "type"=>"text/javascript" ],
	["name"=>"www/vue.router.min.js", "type"=>"text/javascript" ],
	["name"=>"www/xlsx.core.min.js", "type"=>"text/javascript" ],
	["name"=>"www/xlsx.full.min.js", "type"=>"text/javascript" ],
];

$test_url = "https://www.example.com/engine/";
foreach( $app['settings']['domains'] as $d=>$dd ){
	$path = $dd['path'];
	$domain = $dd['domain'];
	$test_url = $dd['url'];
	break;
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