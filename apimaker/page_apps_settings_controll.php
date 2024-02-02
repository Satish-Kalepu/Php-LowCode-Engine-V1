<?php

if( $_POST['action'] == "get_new_key" ){
	json_response([
		"status"=>"success",
		"key"=>$mongodb_con->generate_id()
	]);
	exit;
}

if( $_POST['action'] == "settings_load_pages" ){
	$t = validate_token("getpages.". $config_param1, $_POST['token']);
	if( $t != "OK" ){
		json_response("fail", $t);
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_pages", [
		'app_id'=>$config_param1
	],[
		'sort'=>['name'=>1],
		'limit'=>200,
		'projection'=>['version_id'=>1,'name'=>1]
	]);
	json_response($res);
}

if( $_POST['action'] == "save_app_settings" ){

	$settings = $_POST['settings'];

	if( !isset($settings['host']) ){
		json_response("fail", "Incorrect data. Host settings missing.");
	}
	if( gettype($settings['host']) != "boolean" ){
		json_response("fail", "Incorrect data");
	}
	if( $settings['host'] ){
		if( !isset($settings['domains']) ){
			json_response("fail", "Incorrect data. Domain settings missing.");
		}
		foreach( $settings['domains'] as $i=>$j ){
			if( !preg_match("/^(https\:\/\/www\.|http\:\/\/www\.|https\:\/\/|http\:\/\/)(localhost|[0-9\.]{7,15}|[a-z0-9\-\.]{3,200}\.[a-z\.]{2,10})[\:0-9]*\/[a-z0-9\.\-\_\.\/]*/i", $j['url']) ){
				json_response("fail", "Incorrect url " . $j['url'] );
			}
			$v = parse_url($settings['domains'][ $i ]['url']);
			if( isset( $v['port'] ) ){
				$settings['domains'][ $i ]['domain'] = $v['host'] . ":" . $v['port'];
			}else{
				$settings['domains'][ $i ]['domain'] = $v['host'];
			}
			$settings['domains'][ $i ]['path'] = $v['path'];
		}
		if( !isset($settings['keys']) ){
			json_response("fail", "Incorrect data. Key settings missing.");
		}
		foreach( $settings['keys'] as $i=>$j ){
			if( !isset($j['key']) ){
				json_response("fail", "Incorrect key" );
			}
			if( !preg_match("/^[a-f0-9]{24}$/", $j['key'] ) ){
				json_response("fail", "Incorrect key: " . $j['key'] );
			}
			if( !isset($j['ips_allowed']) || !is_array($j['ips_allowed']) ){
				json_response("fail", "Incorrect Ip settings" );
			}
			if( sizeof($j['ips_allowed']) == 0 ){
				json_response("fail", "Incorrect IP settings");
			}
			foreach( $j['ips_allowed'] as $ipi=>$ipv ){
				if( $ipv['ip'] == "*" || $ipv['ip'] == "0.0.0.0/0" ){}else{
				if( !preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\/(8|16|24|32)$/", $ipv['ip'] ) ){
					json_response("fail", "Incorrect IP format: " . $ipv['ip']);
				}}
				if( $ipv['action'] != "Allow" && $ipv['action'] != "Reject" ){
					json_response("fail", "Incorrect Action: " . $ipv['action']);
				}
			}
		}
	}
	if( !isset($settings['cloud']) ){
		json_response("fail", "Incorrect data. Cloud settings missing.");
	}
	if( gettype($settings['cloud']) != "boolean" ){
		json_response("fail", "Incorrect cloud data");
	}
	if( $settings['cloud'] ){
		if( !preg_match("/^[a-zA-Z0-9\-\.]{2,25}$/i", $settings['cloud-subdomain']) ){
			json_response("fail", "Incorrect cloud subdomain " . $settings['cloud-subdomain'] );
		}
		if( isset($config_global_apimaker['config_cloud_domains']) ){
			if( !in_array( $settings['cloud-domain'], $config_global_apimaker['config_cloud_domains'] ) ){
				json_response("fail", "Incorrect cloud domain " . $settings['cloud-domain'] );
			}
		}
		if( trim($settings['cloud-enginepath']) != "" ){
			if( !preg_match("/^[a-z][a-zA-Z0-9\-\.\/\_\%]{2,250}$/i", $settings['cloud-enginepath']) ){
				json_response("fail", "Incorrect cloud engine path" . $settings['cloud-enginepath'] );
			}
		}
	}
	if(  !isset($settings['alias']) ){
		json_response("fail", "Incorrect data. Alias settings missing.");
	}
	if( gettype($settings['alias']) != "boolean" ){
		json_response("fail", "Incorrect alias data");
	}
	if( $settings['alias'] ){
		if( !preg_match("/^[a-zA-Z0-9\-\.\_]{2,150}(\.[a-z\.]{2,5})$/i", $settings['alias-domain']) ){
			json_response("fail", "Incorrect alias domain name " . $settings['alias-domain'] );
		}
	}else{
		$settings['alias-domain'] = "";
	}

	//echo $config_global_apimaker['config_mongo_prefix'] . "_apps";exit;
	//print_pre( $settings );exit;
	$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_apps", [
		'_id'=>$config_param1
	], [
		'settings'=>$settings,
		'last_updated'=>date("Y-m-d H:i:s")
	]);
	//update_app_last_change_date( $config_param1 );

	if( $res['status'] == "fail" ){
		json_response( $res );
	}

	update_app_pages( $config_param1 );

	$global_settings = [];
	foreach( $settings['keys'] as $ki=>$kd ){
		$global_settings[ $kd['key'] ] = [
			'ips'=>[],
			'domains'=>[]
		];
		foreach( $kd['ips_allowed'] as $iv=>$ip ){
			$global_settings[ $kd['key'] ][ 'ips' ][ $ip['ip'] ] = $ip['action'];
		}
		foreach( $settings['domains'] as $i=>$dv ){
			$global_settings[ $kd['key'] ][ 'domains' ][ $dv['domain'] ][ $dv['path'] ] = ["ok"=>1];
		}
	}
	//print_pre( $global_settings );exit;

	foreach( $global_settings as $key=>$st ){
		$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_settings", [
			'_id'=>"app_key_".$key
		], $st, ['upsert'=>true]);
		if( $res['status'] == "fail" ){
			json_response( $res );
		}
	}

	json_response([
		"status"=>"success",
	]);
	exit;
}

//print_r( $res );
if( !$app['settings'] ){
	$settings = [
		"host"=>false,
		"domains"=>[
			[
				"domain"=>$_SERVER['HTTP_HOST'],
				"url"=>"http://".$_SERVER['HTTP_HOST']."/engine/",
				"path"=>"/engine/"
			]
		],
		"keys"=>[
			[
				"key"=>$mongodb_con->generate_id(),
				"ips_allowed"=>[
					["ip"=>"*", "action"=>"Allow"],
					["ip"=>"127.0.0.1/32", "action"=>"Allow"],
					["ip"=>"10.10.10.0/24", "action"=>"Allow"],
					["ip"=>"10.10.0.0/16", "action"=>"Allow"],
					["ip"=>"10.0.0.0/16", "action"=>"Reject"]
				],
			]
		],
		"cloud"=>false,
		"cloud-subdomain"=>$app['app'],
		"cloud-enginepath"=>"",
		"cloud-domain"=>isset($config_global_apimaker['config_cloud_default_domain'])?$config_global_apimaker['config_cloud_default_domain']:"",
		"alias"=>false,
		"alias-domain"=>"www.example.com",
	];
}else{
	$settings = $app['settings'];
}