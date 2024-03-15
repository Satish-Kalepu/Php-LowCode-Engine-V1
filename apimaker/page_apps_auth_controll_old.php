<?php

	if( $_POST['action'] == "auth_load_users" ){
		$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_user_pool", [], ['projection'=>['password'=>false] ] );
		foreach( $res['data'] as $i=>$j ){
			$res['data'][$i]['ch_pwd'] = false;
			$res['data'][$i]['_id_enc'] = md5($j['_id']. session_id() );
			$res['data'][$i]['password'] = "";
		}
		json_response($res);
	}

	if( $_POST['action'] == "auth_load_tables" ){
		// $t = validate_token("get_global_apis.". $config_param1, $_POST['token']);
		// if( $t != "OK" ){
		// 	json_response("fail", $t);
		// }
		$tables = [];
		$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
			'app_id'=>$config_param1
		],[
			'sort'=>['table'=>1],
			'limit'=>200,
		]);
		foreach( $res['data'] as $i=>$j ){
			$tables[] = ["table"=>"internal:".$j['table'], "_id"=>"table_dynamic:".$j['_id']];
		}

		$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_databases", [
			'app_id'=>$config_param1
		],[
			'sort'=>['des'=>1],
			'limit'=>200,
			'projection'=>['details'=>false, 'm_i'=>false, 'user_id'=>false]
		]);
		foreach( $res['data'] as $i=>$j ){
			$res2 = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_tables", [
				'app_id'=>$config_param1,
				"db_id"=>$j['_id']
			],[
				'sort'=>['des'=>1],
				'limit'=>200,
				'projection'=>['f_n'=>false, 'source_schema'=>false, 'm_i'=>false, 'user_id'=>false ]
			]);
			foreach( $res2['data'] as $ii=>$jj ){
				$tables[] = ["table"=>"dbtable:".$j['des'] . ":" . $jj['des'], "_id"=>"table:".$jj['_id']];
			}
		}
		json_response(['status'=>"success", "tables"=>$tables]);
	}
	if( $_POST['action'] == "load_access_keys" ){
		$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_user_keys", ['t'=>"ak"] );
		foreach( $res['data'] as $i=>$j ){
			$res['data'][$i]['_id_enc'] = md5( $j['_id'] . session_id() );
			$res['data'][$i]['secret'] = "";
		}
		json_response($res);
	}
	if( $_POST['action'] == "load_tokens" ){
		$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_user_keys", ['t'=>"uk"] );
		json_response($res);
	}

	if( $_POST['action'] == "auth_user_delete" ){
		if( !preg_match("/^[a-f0-9]{24}$/", $_POST['user_id']) ){
			json_response(['status'=>"fail","error"=>"Incorrect user id" ]);
		}
		$res = $mongodb_con->delete_one( $config_global_apimaker['config_mongo_prefix'] . "_user_pool", ['_id'=>$_POST['user_id']] );
		json_response(['status'=>"success"]);
	}

	if( $_POST['action'] == "auth_access_key_delete" ){
		if( !preg_match("/^[a-f0-9]{24}$/", $_POST['access_key_id']) ){
			json_response(['status'=>"fail","error"=>"Incorrect key id" ]);
		}
		$res = $mongodb_con->delete_one( $config_global_apimaker['config_mongo_prefix'] . "_user_keys", ['t'=>"ak", '_id'=>$_POST['access_key_id']] );
		json_response(['status'=>"success"]);
	}

	if( $_POST['action'] == "save_user" ){
		$user = $_POST['user'];
		$user_id = "";
		if( $user["app_id"]!=$config_param1 ){
			json_response(['status'=>"fail", "error"=>"ID incorrect"]);
		}
		if( isset($user['_id']) ){
			$user_id = $user['_id'];
			unset($user['_id']);
			if( md5($user_id.session_id()) != $user['_id_enc'] ){
				json_response(['status'=>"fail", "error"=>"ID incorrect"]);
			}
			if( !preg_match("/^[a-f0-9]{24}$/", $user_id) ){
				json_response(['status'=>"fail", "error"=>"ID incorrect"]);
			}
			//print_r( ["app_id"=>$config_param1, "_id"=>['$ne'=>$user_id], "username"=>$user['username']] );exit;
			$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_user_pool", ["app_id"=>$config_param1, "_id"=>['$ne'=>$user_id], "username"=>$user['username']] );
		}else{
			$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_user_pool", ["app_id"=>$config_param1, "username"=>$user['username']] );
		}
		if( $res['data'] ){
			json_response(['status'=>"fail", "error"=>"username already exists"]);
		}
		unset($user['ch_pwd']);
		unset($user['_id_enc']);
		$user['updated'] = date("Y-m-d H:i:s");
		if( isset($user['password']) && $user['password'] == "" ){
			unset($user['password']);
		}
		if( isset($user['password']) && $user['password'] != "" ){
			$user['password']=hash("whirlpool",$user['password']."123456");
			$user["pwdexpire_date"] = date("Y-m-d H:i:s", time()+(30*86400) );
		}
		$user["app_id"]=$config_param1;
		if( $user_id ){
			$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_user_pool", ['_id'=>$user_id ], $user );
		}else{
			$res = $mongodb_con->insert( $config_global_apimaker['config_mongo_prefix'] . "_user_pool", $user );
		}
		json_response($res);
	}

	if( $_POST['action'] == "save_key" ){
		$key = $_POST['key'];
		$key_id = "";
		if( isset($key['_id']) ){
			$key_id = $key['_id'];
			if( $key['_id_enc'] != md5( $key_id . session_id() ) ){
				json_response(['status'=>"fail", "error"=>"Key incorrect"]);
			}
			unset($key['_id']);
			$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_user_keys", ['app_id'=>$config_param1, '_id'=>$key_id] );
			if( !$res['data'] ){
				json_response(['status'=>"fail", "error"=>"Key not found"]);
			}
		}
		$key["expire"] = (int)$key["expire"];
		if( isset($_POST['expire_minits']) ){
			date_default_timezone_set("UTC");
			$key["expire"] = time()+((int)$_POST['expire_minits']*60);
		}
		$key["updated"] = date("Y-m-d H:i:s");
		unset($key['_id_enc']);
		$key['app_id'] = $config_param1;
		$key['t'] = "ak"; // ak admin key, uk user key
		if( $key_id ){
			$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_user_keys", ['_id'=>$key_id] , $key );
		}else{
			$res = $mongodb_con->insert( $config_global_apimaker['config_mongo_prefix'] . "_user_keys", $key );
			$key_id = $res['inserted_id'];
		}

		$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_user_keys", ['_id'=>$key_id]);
		$res['data']['_id_enc'] = md5($res['data']['_id'].session_id());
		json_response([
			"status"=>"success",
			"key"=>$res['data']
		]);
	}



	function process_session(){
		global $dynamodb_con;
		if( $this->requestContext['cookies']["dbapi_session"] ){
			$s = $this->requestContext['cookies']["dbapi_session"];
			$res = $dynamodb_con->getItem($_ENV['config_user_table'], [
				"pk"=>"session", "sk"=>$s
			]);
			if( $res['Item'] ){
				if( (int)$res['Item']['expire'] < (time()-3600) || $res['Item']['ua'] != $this->requestContext['headers']['User-Agent'] || $res['Item']['ip'] != $this->requestContext['ip'] ){
					set_cookie("dbapi_session", "", 2);
					return [
						"status"=>"success",
						"session_id"=>"", 
						"error"=>"session expired"
					];
				}
				$res["session_id"] = $s;
			}
			return $res;
		}else{
			return ["status"=>"success","session_id"=>""];
		}
	}
	function verify_session($key, $table ="", $action = ""){
		if( !$key ){
			return [
				"status"=>"fail",
				"error"=>"Session Key Missing",
			];
		}
		global $dynamodb_con;
		$res = $dynamodb_con->getItem($_ENV['config_user_table'], [
			"pk"=>"user_key", 
			"sk"=>$key
		]);
		if( $res['Item'] ){
			if( (int)$res['Item']['expire'] < time() || $res['Item']['ua'] != $this->requestContext['headers']['User-Agent'] || $res['Item']['ip'] != $this->requestContext['ip'] ){
				return [
					"status"=>"fail",
					"error"=>"Session Expired",
					"Item"=>$res["Item"]
				];
			}
			$this->session = $res["Item"];
			if( $table && $action ){
				$allow_it = false;
				foreach( $res['Item']['policies'] as $pi=>$pv ){
					$a1 = false;
					if( in_array("*", $pv['allow_tables']) !== false ){
						$a1 = true;
					}else if( in_array($table, $pv['allow_tables'] ) !== false ){
						$a1 = true;
					}
					$a2 = false;
					if( in_array("*", $pv['allow_actions']) !== false){
						$a2 = true;
					}else if( in_array($action, $pv['allow_actions']) !== false ){
						$a2 = true;
					}
					if( $a1 && $a2 ){ $allow_it = true; break;}
				}
				if( !$allow_it ){
					return [
						"status"=>"fail", 
						"error"=>"Access denied for table: " . $table . ":".$action, 
					];
				}
			}
			return ["status"=>"success"];
		}else{
			return ["status"=>"fail","error"=>"Session Expired", "Item"=>"Not Found"];
		}
	}
	function generate_user_key($user){
		global $dynamodb_con;
		$rand = date("YmdHis").".".rand(1000,9999);
		$expire = time() + ($user['policy_expire']*60);
		$res = $dynamodb_con->putItem($_ENV['config_user_table'], [
			"pk"=> "user_key",
			"sk"=> $rand,
			"ip"=>$this->requestContext['ip'],
			"ua"=>$this->requestContext['headers']["User-Agent"],
			"policies"  => $user['policies'],
			"expire"=>(int)$expire,
			"created"=>date("Y-m-d H:i:s")
		]);
		if( $res['status'] == "success" ){
			$res['key'] = $rand;
		}
		return $res;
	}

	function POST_login(){
		//$this->status =404;
		global $dynamodb_con;
		global $mr;
		$post = $this->requestContext['body'];
		$res = $dynamodb_con->getItem($_ENV['config_user_table'],[
				"pk"=>"user",
				"sk"=>$post['username'],
		]);
		if( $res["status"] == "success" ){
			if( $res["Item"] ){
				$res2 = $dynamodb_con->getItem($_ENV['config_user_table'],[
						"pk"=>"user_password",
						"sk"=>$post['username'],
				]);
				if( $res2['Item']['password'] == hash("whirlpool", $post['password']) ){
					$st = $this->generate_user_key($res["Item"]);
					if( $st['status'] == "success" ){
						return [
							"status"=>"success",
							"session_key"=>$st['key']
						];
					}else{
						$st['error'] = "Error generating key: " . $st['error'];
						return $st;
					}
				}else{
					return [
						"status"=>"error",
						"error"=>"Password incorrect",
					];
				}
			}else{
				return [
					"status"=>"error",
					"error"=>"Username not found",
				];
			}
		}else{
			return $res;
		}
	}
	function POST_generate_session_token(){
		global $dynamodb_con;
		global $mr;
		$post = $this->requestContext['body'];
		if( !$post['admin_access_key'] ){
			return [
				'status'=>"fail",
				"error"=>"input admin_access_key missing"
			];
		}else if( !preg_match( "/^[0-9\.]+$/", $post['admin_access_key'] ) ){
			return [
				'status'=>"fail",
				"error"=>"input admin_access_key incorrect format"
			];
		}
		if( !$post['policies'] ){
			return ["status"=>"fail", "error"=>"policies required"];
		}else if( !is_array($post['policies']) ){
			return ["status"=>"fail", "error"=>"policies should be a list"];
		}
		if( !$post['allow_ips'] ){
			return ["status"=>"fail", "error"=>"allow_ips required"];
		}else if( !is_array($post['allow_ips']) ){
			return ["status"=>"fail", "error"=>"allow_ips should be a list"];
		}else{
			foreach( $post['allow_ips'] as $i=>$ip ){
				if( !preg_match("/^([0-9]+)\.([0-9]+)\.([0-9]+)\.([0-9]+)\/(16|24|32)$/", $ip, $m ) ){
					return ["status"=>"fail", "error"=>"incorrect ip notation: " . $ip];
				}else{
					if( (int)$m[1] < 1 || (int)$m[1] > 255 || (int)$m[2] < 1 || (int)$m[2] > 255 || (int)$m[3] < 0 || (int)$m[3] > 255 || (int)$m[4] < 0 || (int)$m[4] > 255 ){
						return ["status"=>"fail", "error"=>"incorrect ip notation: " . $ip];
					}
				}
			}
		}
		if( !$post['expire'] ){
			return ["status"=>"fail", "error"=>"expire required"];
		}else if( !is_numeric($post['expire']) ){
			return ["status"=>"fail", "error"=>"expire should be numeric"];
		}else{
			$post['expire'] = (int)$post['expire'];
			if( $post['expire'] < 5 || $post['expire'] > 86400 ){
				return ["status"=>"fail", "error"=>"expire out of allowed limit"];
			}
		}
		$ak = $dynamodb_con->getItem($_ENV['config_user_table'], ["pk"=>"admin_key", "sk"=>$post['admin_access_key']]);
		if( !$ak['Item'] ){
			return [
				'status'=>"fail",
				"error"=>"admin_access_key not found"
			];
		}
		$ak = $ak['Item'];
		if( !$ak['allow_sessions'] ){
			return ["status"=>"fail", "error"=>"role `session creation` is not granted"];
		}
		$is_ip_allowed = false;
		foreach( $ak['allow_ips'] as $i=>$ip ){
			if( $ip == "*" ){
				$is_ip_allowed = true;break;
			}else if( preg_match("/^([0-9]+)\.([0-9]+)\.([0-9]+)\.([0-9]+)\/(16|24|32)$/", $ip, $m ) ){
				preg_match("/^([0-9]+)\.([0-9]+)\.([0-9]+)\.([0-9]+)$/", $this->requestContext['ip'], $mm );
				if( $m[5] == "32" ){
					if( $m[1] .".".$m[2].".".$m[3].".".$m[4] == $mm[1] .".".$mm[2].".".$mm[3].".".$mm[4] ){
						$is_ip_allowed = true;break;
					}
				}else if( $m[5] == "24" ){
					if( $m[1] .".".$m[2].".".$m[3] == $mm[1] .".".$mm[2].".".$mm[3] ){
						$is_ip_allowed = true;break;
					}
				}else if( $m[5] == "16" ){
					if( $m[1] .".".$m[2] == $mm[1] .".".$mm[2] ){
						$is_ip_allowed = true;break;
					}
				}
			}
		}
		if( !$is_ip_allowed ){
			return ["status"=>"fail", "error"=>"Client IP not allowed", "ip"=>$this->requestContext['ip']];
		}
		$is_all_policies_allowed = true;
		$matched_policy = false;
		foreach( $post['policies'] as $cpi=>$cpv ){
			if( !is_array($cpv['allow_tables']) ){
				return ["status"=>"fail", "error"=>"Policy ". ($cpi+1) .": allow_tables should be a list"];
			}
			if( !is_array($cpv['allow_actions']) ){
				return ["status"=>"fail", "error"=>"Policy ". ($cpi+1) .": allow_actions should be a list"];
			}
			$allowed_policy = false;
			foreach( $ak['policies'] as $pi=>$pv ){
				$is_all_tables_allowed = true;
				$is_all_actions_allowed = true;
				if( in_array("*", $pv['allow_actions'] ) ){
					$is_all_actions_allowed = true;
				}else{
					foreach( $cpv['allow_actions'] as $ai=>$aa ){
						if( is_string($aa) ){
							if( !in_array($aa, $pv['allow_actions'] ) ){
								$is_all_actions_allowed = false;
							}
						}else{
							$is_all_actions_allowed = false;
						}
					}
				}
				if( in_array("*", $pv['allow_tables'] ) ){
					$is_all_tables_allowed = true;
				}else{
					foreach( $cpv['allow_tables'] as $ai=>$aa ){
						if( is_string($aa) ){
							if( !in_array($aa, $pv['allow_tables'] ) ){
								$is_all_tables_allowed = false;
							}
						}else{
							$is_all_tables_allowed = false;
						}
					}
				}
				if( $is_all_tables_allowed && $is_all_actions_allowed ){
					$allowed_policy = true;
					$matched_policy = $pv;
				}
			}
			if( !$allowed_policy ){
				$is_all_policies_allowed = false;break;
			}
		}
		if( !$is_all_policies_allowed ){
			return [
				"status"=>"fail",
				"error"=>"Policies out of scope"
			];
		}
		$session_key = date("YmdHis").".".rand(10000,99999);
		$res = $dynamodb_con->putItem($_ENV['config_user_table'],[
			"pk"=>"user_key",
			"sk"=>$session_key,
			"created"=>date("Y-m-d H:i:s"),
			"policies"=>$post['policies'],
			"expire"=>(int)$post['expire'],
			"allow_ips"=>$post['allow_ips'],
		]);
		if( $res['status'] != "success"){
			return $res;
		}
		return [
			"status"=>"success",
			//"matched_policy"=>$matched_policy
			"session_key"=>$session_key
		];
	}

	function verify_session2(){
		global $dynamodb_con;
		if( $this->requestContext['cookies']["dbapi_session"] ){
			$s = $this->requestContext['cookies']["dbapi_session"];
			$res = $dynamodb_con->getItem($_ENV['config_user_table'], [
				"pk"=>"session", "sk"=>$s
			]);
			if( $res['Item'] ){
				if( (int)$res['Item']['expire'] < (time()-3600) || $res['Item']['ua'] != $this->requestContext['headers']['User-Agent'] || $res['Item']['ip'] != $this->requestContext['ip'] ){
					return [
						"status"=>"fail",
						"error"=>"Session expired"
					];
				}
				return ["status"=>"success","res"=>$res, "session_id"=>$s];
			}else{
				return ["status"=>"fail","error"=>"Session Expired"];
			}
		}else{
			return ["status"=>"fail","error"=>"Session Not Found"];
		}
	}
	function POST_check_session(){
		$res = $this->process_session();
		if( $res['session_id'] ){
			return [
				"status"=>"success",
			];
		}else{
			return [
				"status"=>"fail",
				"error"=>"notfound"
			];
		}
	}
	function POST_default(){
		//$this->status =404;
		$post = $this->requestContext['body'];
		if( $post["action"] == "login" ){
		}
		return [
			"statusCode"=>404,
			"body"=>"Not Found",
			"headers"=>[
				"Content-Type"=> "text/html"
			]
		];
	}
	function POST_login2(){
		//$this->status =404;
		global $dynamodb_con;
		global $mr;
		$post = $this->requestContext['body'];
		if( !$post["captcha"] || !$post["captcha_code"] ){
			return [
				"status"=>"fail",
				"error"=>"Captcha Missing"
			];
		}else{
			$res = curl_get($_ENV['config_captcha_api_url']."captcha/verify", [
				"captcha"=>$post['captcha'],
				"code"=>$post['captcha_code']
			]);
			if( $res['status'] == 200 ){
				$res = json_decode($res['body'],true);
				if( $res['status'] != "success" ){
					return [
						"status"=>"fail",
						"error"=>"Captcha Incorrect",
						"res"=>$res,
					];
				}
			}else{
				return [
					"status"=>"fail",
					"error"=>"Captcha Incorrect",
					"res"=>$res,
				];
			}
		}
		if( $post["username"] == $_ENV['config_admin_username'] && $post["password"] == $_ENV['config_admin_password'] ){
			$rand = time().".".rand(1000,9999);
			$st = $dynamodb_con->putItem($_ENV['config_user_table'],[
					"pk"=>"session",
					"sk"=>$rand,
					"expire"=>time()+3600,
					"ua"=>$this->requestContext['headers']['User-Agent'],
					"ip"=>$this->requestContext['ip'],
			]);
			if( $st["status"]=="success" ){
				set_cookie("dbapi_session", $rand, time()+3600 );
				return [
					"status"=>"success",
					"session_id"=>$rand
				];
			}else{
				return [
					"status"=>"error",
					"error"=>$dynamodb_con->error,
				];
			}
		}
		return [
			"statusCode"=>200,
			"body"=>[
				"status"=>"fail",
				"error"=>"Incorrect username/password"
			],
		];
	}
	function POST_scan_records(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$q = [
			"TableName"=>$post["TableName"],
			"Limit"=>50
		];
		if( $post['Index'] != "main" ){
			$q[ "IndexName" ] = $post['Index'];
		}
		if( $post["LastEvaluatedKey"] ){
			$q['ExclusiveStartKey'] = $post['LastEvaluatedKey'];
		}
		$res = $dynamodb_con->scan($q);
		if( $res["status"] == "success" ){
			$fields = [];
			foreach( $res["Items"] as $i=>$j ){
				foreach( $j as $fn=>$jj ){
					$fields[ $fn ] += 1;
				}
			}
			arsort($fields);
			$res["fields"] = $fields;
		}
		return $res;
	}
	function POST_query_records(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$q = [
			"TableName"=>$post["TableName"],
			"Limit"=>50
		];
		if( $post["LastEvaluatedKey"] ){
			$q['ExclusiveStartKey'] = $post['LastEvaluatedKey'];
		}
		if( $post['Index'] != "main" ){
			$q[ "IndexName" ] = $post['Index'];
		}
		if( $post['Order'] != "asc" ){
			$q[ "ScanIndexForward" ] = false;
		}
		if( $post["Schema"] ){
			$ke = [];
			$an = [];
			$av = [];
			foreach( $post['Schema'] as $i=>$j ){
				if( $j['KeyType'] == "HASH" ){
					$ke[] = "#".$j['AttributeName'] . " = " . ":" . $j['AttributeName'];
					$an["#".$j['AttributeName']] = $j['AttributeName'];
					if( $j['Type'] == "N" ){
						$av[":".$j['AttributeName']] = (int)$j['value'];
					}else{
						$av[":".$j['AttributeName']] = $j['value'];
					}
				}elseif( $j['value'] ){
					$ke[] = "#".$j['AttributeName'] . " " . $j['cond'] . " " . ":" . $j['AttributeName'];
					$an["#".$j['AttributeName']] = $j['AttributeName'];
					if( $j['Type'] == "N" ){
						$av[":".$j['AttributeName']] = (int)$j['value'];
					}else{
						$av[":".$j['AttributeName']] = $j['value'];
					}
				}
			}
			$q['KeyConditionExpression'] = implode(" and ",$ke);
			$q["ExpressionAttributeNames"] = $an;
			$q["ExpressionAttributeValues"] = $av;
		}
		$res = $dynamodb_con->raw_query( $q );
		if( $res["status"] == "success" ){
			$fields = [];
			foreach( $res["Items"] as $i=>$j ){
				foreach( $j as $fn=>$jj ){
					$fields[ $fn ] += 1;
				}
			}
			arsort($fields);
			$res["fields"] = $fields;
		}
		return $res;
	}
	function POST_save_item(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$res = $dynamodb_con->getItem( $post["TableName"], $post["Key"] );
		$res2 = $dynamodb_con->putItem( $post["TableName"], $post["Item"] );
		if( $res['Item'] ){
			$res2["extra"] = "Already Exists";
		}
		return $res2;
	}
	function POST_delete_item(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$res = $dynamodb_con->deleteItem( $post["TableName"], $post["Key"] );
		$res["vi"] = $post['vi'];
		return $res;
	}
