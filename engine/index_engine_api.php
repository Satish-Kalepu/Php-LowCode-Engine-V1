<?php

	/*
		auth_api/generate_access_token
		auth_api/user_authentication
		tables_dynamic/table_id
		tables/table_id
	*/

	if( $_SERVER['REQUEST_METHOD']!="POST" ){
		http_response_code(400);header("Coontent-Type:application/json");
		echo json_encode(["status"=>"fail", "error"=>"Unexpected GET Request" ]);exit;
	}
	if( !preg_match("/json/i", $_SERVER['CONTENT_TYPE']) ){
		http_response_code(400);header("Coontent-Type:application/json");
		echo json_encode(["status"=>"fail", "error"=>"Unexpected Payload" ]);exit;
	}
	$input_data = $php_input;
	$_POST = json_decode($input_data, true);
	if( json_last_error() ){
		$e = "JSON Parse Error: " . json_last_error_msg();
		http_response_code(400);header("Coontent-Type: application/json");
		echo json_encode(["status"=>"fail", "error"=>"Payload Json Decode Fail" ]);exit;
	}

	//print_r( $_POST );

	if( !isset($path_params[1]) ){
		http_response_code(404);header("Coontent-Type:application/json");
		echo json_encode(["status"=>"fail", "error"=>"Are you lost." ]);exit;
	}
	if( $path_params[1] == "tables_dynamic" || $path_params[1] == "tables" ){
		if( !isset($_POST['action']) ){
			http_response_code(403);header("Coontent-Type:application/json");
			echo json_encode(["status"=>"fail", "error"=>"Are you lost," ]);exit;
		}
		$action = $_POST['action'];
		$options = [];
		if( isset($_POST['options']) && is_array($_POST['options']) ){
			$options = $_POST['options'];
		}else if( isset($_POST['options']) && !is_array($_POST['options']) ){
			http_response_code(403);header("Coontent-Type:application/json");
			echo json_encode(["status"=>"fail", "error"=>"Options incorrect" ]);exit;
		}
	}

	$thing_type = $path_params[1];
	if( $path_params[1] == "captcha" ){
		if( !isset($path_params[2]) ){
			http_response_code(404);header("Coontent-Type:application/json");
			echo json_encode(["status"=>"fail", "error"=>"API Not found" ]);exit;
		}
		if( $path_params[2] == "get" ){
			$thing_id = "10101";
		}
	}

	if( $path_params[1] == "auth" ){
		$thing_type = "auth_api";
		if( !isset($path_params[2]) ){
			http_response_code(404);header("Coontent-Type:application/json");
			echo json_encode(["status"=>"fail", "error"=>"API Not found" ]);exit;
		}
		$action = $path_params[2];
		$api_slug = $path_params[2];
		if( $api_slug == "generate_access_token" ){
			$thing_id = "10001";
		}else if( $api_slug == "user_auth" ){
			$thing_id = "10002";
		}else if( $api_slug == "user_auth_captcha" ){
			$thing_id = "10003";
		}else if( $api_slug == "verify_session_key" ){
			$thing_id = "10004";
		}
	}
	if( $path_params[1] == "tables_dynamic" ){
		$thing_type = "table_dynamic";
		if( !isset($path_params[2]) ){
			http_response_code(404);header("Coontent-Type:application/json");
			echo json_encode(["status"=>"fail", "error"=>"Not found" ]);exit;
		}
		$thing_id = $path_params[2];
		if( !preg_match("/^[a-f0-9]{24}$/", $thing_id) ){
			http_response_code(400);header("Coontent-Type:application/json");
			echo json_encode(["status"=>"fail", "error"=>"Incorrect URL ID" ]);exit;
		}
		$table_res = $mongodb_con->find_one( $db_prefix . "_tables_dynamic", [
			"app_id"=>$app_id, "_id"=>$thing_id
		]);
		if( !$table_res['data'] ){
			http_response_code(400);header("Coontent-Type:application/json");
			echo json_encode(["status"=>"fail", "error"=>"Table not found" ]);exit;
		}
	}
	if( $path_params[1] == "tables" ){
		$thing_type = "table";
		if( !isset($path_params[2]) ){
			http_response_code(404);header("Coontent-Type:application/json");
			echo json_encode(["status"=>"fail", "error"=>"Not found" ]);exit;
		}
		$thing_id = $path_params[2];
		if( !preg_match("/^[a-f0-9]{24}$/", $thing_id) ){
			http_response_code(400);
			echo json_encode(["status"=>"fail", "error"=>"Incorrect URL ID" ]);exit;
		}
		$table_res = $mongodb_con->find_one( $db_prefix . "_tables", [
			"app_id"=>$app_id, "_id"=>$thing_id
		]);
		if( !$table_res['data'] ){
			http_response_code(400);header("Coontent-Type:application/json");
			echo json_encode(["status"=>"fail", "error"=>"Table not found" ]);exit;
		}
	}

	$config_public_apis = [
		["auth","verify_session_key"]
	];

	$allow_policy = false;
	foreach( $config_public_apis as $i=>$j ){
		if( $path_params[1] == $j[0] ){
			if( isset($path_params[2]) ){
				if( isset($j[1]) ){
					if( $path_params[2] == $j[1] ){
						$allow_policy = true;
					}
				}
			}
		}
	}

	if( !$allow_policy ){{
			if( !isset($_SERVER['HTTP_ACCESS_KEY']) ){
				http_response_code(403);
				header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Access-Key required" ]);exit;
			}else if( !preg_match( "/^[0-9a-f]{24}$/", $_SERVER['HTTP_ACCESS_KEY']) ){
				http_response_code(403);
				header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Access-Key Incorrect" ]);exit;
			}else{
				$res = $mongodb_con->find_one( $db_prefix . "_user_keys", [
					"app_id"=>$app_id,
					"_id"=>$_SERVER['HTTP_ACCESS_KEY']
				] );
				if( !$res['data'] ){
					http_response_code(403);
					header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Access-Key not found" ]);exit;
				}
				// echo time();
				// print_pre( $res['data'] );exit;
				if( $res['data']['expire'] < time() || $res['data']['active'] != 'y' ){
					http_response_code(403);
					header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Access-Key Expired/InActive" ]);exit;
				}
				$ipf = false;
				$x = explode(".", $_SERVER['REMOTE_ADDR']);
				$ip2 = implode(".",[$x[0],$x[1],$x[2]] );
				$ip3 = implode(".",[$x[0],$x[1]] );
				$ip4 = $x[0];
				if( isset($res['data']['ips']) && is_array($res['data']['ips']) ){
					foreach( $res['data']['ips'] as $ii=>$ip ){
						if( $ip == "*" ){
							$ipf = true;break;
						}
						$x = explode("/", $ip);
						$x2 = explode(".",$x[0]);
						if( $x[1] == "32" ){
							if( $_SERVER['REMOTE_ADDR'] == $x[0] ){
								$ipf = true;break;
							}
						}else if( $x[1] == "24" ){
							if( $ip2 == implode(".",[ $x2[0],$x2[1],$x2[2] ] ) ){
								$ipf = true;break;
							}
						}else if( $x[1] == "16" ){
							if( $ip3 == implode(".",[ $x2[0],$x2[1] ] ) ){
								$ipf = true;break;
							}
						}else if( $x[1] == "8" ){
							if( $ip4 == $x2[0] ){
								$ipf = true;break;
							}
						}
					}
				}
				if( $ipf == false ){
					http_response_code(403);
					header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Access Key IP rejected" ]);exit;
				}
				//print_r( $res['data']['policies'] );exit;
				$allow_policy = false;
				if( isset($res['data']['policies']) && is_array($res['data']['policies']) ){
					foreach( $res['data']['policies'] as $ii=>$ip ){
						$ad_allow = false;$td_allow = false;
						if( isset($ip['service']) ){
							//print_r( $ip['actions'] );
							if( isset($ip['actions']) && is_array($ip['actions']) ){
								foreach( $ip['actions'] as $ad ){
									if( $ad == "*" || $ad == $_POST['action'] ){
										$ad_allow = true;break;
									}
								}
							}
							if( isset($ip['things']) && is_array($ip['things']) ){
								foreach( $ip['things'] as $td ){
									if( $td['_id'] == "*" ){
										$td_allow = true;break;
									}else{
										$x = explode(":", $td['_id']);
										//echo $x[0] . "==" . $thing_type . " : " . $x[1] . "==" . $thing_id . "<BR>";
										if( $x[0] == $thing_type && $x[1] == $thing_id ){
											$td_allow = true;break;
										}
									}
								}
							}
						}
						//echo ($ad_allow?"Actionok":"").($td_allow?"tableOK":"");
						if( $ad_allow && $td_allow ){
							$allow_policy = true;break;
						}
					}
				}
				if( $allow_policy == false ){
					http_response_code(403);
					header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Access Key Policy Rejected" ]);exit;
				}else{
					$resu = $mongodb_con->update_one( $db_prefix . "_user_keys", [
						"app_id"=>$app_id,
						"_id"=>$_SERVER['HTTP_ACCESS_KEY']
					], [
						'$set'=>['last_used'=>time(), 'last_ip'=>$_SERVER['REMOTE_ADDR']], 
						'$inc'=>['hits'=>1]
					]);
				}
			}
	}}

	if( $thing_type == "captcha" ){
		if( !isset($path_params[2]) ){
			http_response_code(404);header("Coontent-Type:application/json");
			echo json_encode(["status"=>"fail", "error"=>"API Not found" ]);exit;
		}
		if( $path_params[2] == "get" ){
			require("api_captcha.php");exit;
		}
	}

	if( $thing_type == "table" || $thing_type == "table_dynamic" ){
		if( isset( $_POST['query'] ) && !is_array($_POST['query']) ){
			http_response_code(400);header("Content-Type: application/json");
			echo json_encode(["status"=>"fail", "error"=>"Query format mismatch" ]);exit;
		}
		if( isset( $_POST['options'] ) && !is_array($_POST['options']) ){
			http_response_code(400);header("Content-Type: application/json");
			echo json_encode(["status"=>"fail", "error"=>"Options format mismatch" ]);exit;
		}else if( isset( $_POST['options'] ) && is_array($_POST['options']) ){
			if( $action == "findMany" && $action == "updateMany" && $action == "deleteMany" ){
				if( !isset( $_POST['options']['limit'] ) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Options:Limit is required" ]);exit;
				}else if( !is_numeric( $_POST['options']['limit'] ) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Options:Limit format mismatch" ]);exit;
				}
			}
		}
	}

	function mongo_query( $query ){
		global $mongodb_con;
		foreach( $query as $field=>$j ){
			if( $field == '$and' || $field == '$or' ){
				for($ii=0;$ii<sizeof($j);$ii++){
					$query[ $field ][ $ii ] = mongo_query($query[ $field ][ $ii ]);
				}
			}else if( $field == '_id' ){
				if( is_array($j) ){
					$jj = [];
					$keys = array_keys($j);
					foreach( $keys as $c ){
						$v = $j[ $c ];
						if( is_string($v) && preg_match("/^[a-f0-9]{24}$/",$v) ){
							$v = $mongodb_con->get_id($v);
						}
						if( $c == '<'  ){ $c = '$lt';  }
						if( $c == '<=' ){ $c = '$lte'; }
						if( $c == '>'  ){ $c = '$gt';  }
						if( $c == '>=' ){ $c = '$gte'; }
						if( $c == '='  ){ $c = '$eq';  }
						if( $c == '!=' ){ $c = '$ne';  }
						$jj[ $c ] = $v;
					}
					$query[ $field ] = $jj;
				}else if( is_string($j) && preg_match("/^[a-f0-9]{24}$/",$j) ){
					$query[ $field ] = $mongodb_con->get_id($j);
				}
			}
		}
		return $query;
	}

	function mysql_cond($con, $query ){
		$cond = [];
		foreach( $query as $field=>$j ){
			//echo $field . "--";
			if( $field == '$and' ){
				$c = [];
				for($ii=0;$ii<sizeof($j);$ii++){
					$c[] = mysql_cond($con, $query[ $field ][ $ii ]);
				}
				$cond[] = " ( " . implode(" and ", $c ) . " ) ";
			}else if( $field == '$or' ){
				//echo "llll";
				$c = [];
				for($ii=0;$ii<sizeof($j);$ii++){
					$c[] = mysql_cond($con, $query[ $field ][ $ii ]);
				}
				$cond[] = " ( " . implode(" or ", $c ) . " ) ";
			}else{
				if( is_array($j) ){
					$c = array_keys($j)[0];
					$v = $j[ $c ];
					if( $c == '$lt'  ){ $c = '<';  }
					if( $c == '$lte' ){ $c = '<='; }
					if( $c == '$gt'  ){ $c = '>';  }
					if( $c == '$gte' ){ $c = '>='; }
					if( $c == '$eq'  ){ $c = '=';  }
					if( $c == '$ne'  ){ $c = '!=';  }
					$cond[] = "`" . $field . "` ".$c." '" . mysqli_escape_string($con, $v ) . "' ";
				}else{
					$cond[] = "`" . $field . "` = '" . mysqli_escape_string($con, $j ) . "' ";
				}
			}
		}
		return implode(" and ", $cond);
	}

	if( $thing_type == "auth_api" ){
		if( $api_slug == "verify_session_key" ){
			if( !isset($_POST['session-key']) ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Session Key required"]);exit;
			}else if( !preg_match( "/^[a-f0-9]{24}$/", $_POST['session-key'] ) ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Session Key incorrect"]);exit;
			}
			$res = $mongodb_con->find_one( $db_prefix . "_user_keys", ["app_id"=>$app_id, '_id'=>$_POST['session-key']] );
			if( !$res['data'] ){
				header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Session Expired"]);exit;
			}
			//print_r( $res['data'] );exit;
			$e = $res['data']['expire'];
			//echo ($e - time());
			if( $e > time() && $res['data']['ips'][0] == $_SERVER['REMOTE_ADDR'] . "/32" ){
				header("Content-Type: application/json");
				echo json_encode(["status"=>"success", "error"=>"SessionOK"]);exit;
			}else{
				header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Session Expired", "e"=>($e - time()) ]);exit;
			}
		}
		if( $api_slug == "generate_access_token" ){

			if( !isset($_POST['access_key']) ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Access Key required"]);exit;
			}else if( !preg_match( "/^[a-f0-9]{24}$/", $_POST['access_key'] ) ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Access Key incorrect"]);exit;
			}

			$res = $mongodb_con->find_one( $db_prefix . "_user_keys", [ "app_id"=>$app_id, '_id'=>$_POST['access_key']]);
			if( !$res['data'] ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Access Key Not Found"]);exit;
			}
			if( !isset($res['data']['allow_sessions']) ){
				http_response_code(500);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Access Key Policy does not allow sub sessions"]);exit;
			}else if( $res['data']['allow_sessions'] === false ){
				http_response_code(500);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Access Key Policy does not allow sub sessions"]);exit;
			}
			if( isset($_POST['expire_minutes']) ){
				if( !is_numeric($_POST['expire_minutes']) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Incorrect expire minutes"]);exit;
				}
				$expire = (int)$_POST['expire_minutes'];
			}else{
				$expire = 2;
			}
			$expire = time() + ($expire*60);
			if( isset($_POST['client_ip']) ){
				if( !preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\/(32|24|16)$/", $_POST['client_ip']) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Incorrect client IP"]);exit;
				}
				$user_ip = $_POST['client_ip'];
			}else{
				$user_ip = $_SERVER['REMOTE_ADDR'] . "/32";
			}

			$key = [];
			$key['active'] = 'y';
			$key['policies'] = $res['data']['policies'];
			$key['ips'] = [$user_ip];
			$key["app_id"] = $app_id;
			$key['expire'] = $expire;
			$key['expiret'] = new \MongoDB\BSON\UTCDateTime($expire*1000);
			$key['t'] = "uk";
			$key['updated']= date("Y-m-d H:i:s");
			
			$res = $mongodb_con->insert( $db_prefix . "_user_keys", $key);
			header("Content-Type: application/json");
			echo json_encode(["status"=>"success", "access-key"=>$res['inserted_id'] ]);exit;

		}else if( $api_slug == "user_auth" ||  $api_slug == "user_auth_captcha"  ){

			if( !isset($_POST['username']) || !isset($_POST['password']) ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Username or Password wrong"]);exit;
			}else if( !preg_match( "/^[a-z][a-z0-9\-]{2,50}$/", $_POST['username'] ) ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Username or password wrong.."]);exit;
			}

			if( $api_slug == "user_auth_captcha" ){
				if( !preg_match( "/^[a-f0-9]{24}$/", $_POST['code'] ) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"CaptchaCode incorrect"]);exit;
				}
				$cap_res = $mongodb_con->find_one( $db_prefix . "_captcha", ['_id'=>$_POST['code']] );
				if( !$cap_res['data'] ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Captcha mismatch..."]);exit;
				}
				if( $cap_res['data']['c'] != $_POST['captcha'] ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Captcha mismatch..."]);exit;
				}
				//echo "captcha check pending";exit;
			}

			$user_res = $mongodb_con->find_one( $db_prefix . "_user_pool", ['username'=>$_POST['username']]);
			if( !$user_res['data'] ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Username or password wrong..."]);exit;
			}
			
			if( hash("whirlpool",$_POST['password']."123456") != $user_res['data']['password'] ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Username or password wrong...."]);exit;
			}
			if( isset($_POST['expire_minutes']) ){
				if( !is_numeric($_POST['expire_minutes']) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Incorrect expire minutes"]);exit;
				}
				$expire = (int)$_POST['expire_minutes'];
			}else{
				$expire = 5;
			}
			$expire = time() + ($expire*60);
			if( isset($_POST['client_ip']) ){
				if( !preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\/(32|24|16)$/") ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Incorrect client IP"]);exit;
				}
				$user_ip = $_POST['client_ip'];
			}else{
				$user_ip = $_SERVER['REMOTE_ADDR'] . "/32";
			}

			$key = [];
			$key['active'] = 'y';
			$key['app_id'] = $app_id;
			$key['policies'] = $user_res['data']['policies'];
			$key['ips'] = [$user_ip];
			$key['expire'] = $expire;
			$key['expiret'] = new \MongoDB\BSON\UTCDateTime($expire*1000);
			$key['t'] = "uk";
			$key['updated']= date("Y-m-d H:i:s");
			
			$res = $mongodb_con->insert( $db_prefix . "_user_keys", $key);
			if( $res['status'] == "success" ){
				$new_key = $res['inserted_id'];

				$res = $mongodb_con->update_one( $db_prefix . "_user_pool", ["_id"=>$user_res['data']['_id']], ['last_login'=>date("Y-m-d H:i:s")] );

				header("Content-Type: application/json");
				echo json_encode(["status"=>"success", "access-key"=>$new_key ]);exit;
			}else{
				http_response_code(500);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"DB insert error" ]);exit;
			}

		}else{
			http_response_code(404);header("Content-Type: application/json");
			echo json_encode(["status"=>"fail", "error"=>"Unknown Api Slug"]);exit;
		}

	}else if( $thing_type == "table_dynamic" ){
		if( $action == "findMany" ){
			$cond = [];
			if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
				$cond = mongo_query( $_POST['query'] );
			}
			$ops = [];
			if( isset($options['limit']) ){
				$ops['limit'] = $options['limit'];
			}else{
				$ops['limit'] = 10;
			}
			if( !isset($options['sort']) ){
				$ops['sort'] = ['_id'=>1];
			}else if( isset($options['sort']) ){
				$ops['sort'] = $options['sort'];
			}
			if( isset($options['projection']) && is_array($options['projection']) ){
				$ops['projection'] = $options['projection'];
			}
			$res = $mongodb_con->find( $db_prefix . "_dt_" . $table_res['data']['_id'], $cond, $ops );
			if( $res['status'] != "success" ){
				http_response_code(500); header("Content-Type: application/json");
				echo json_encode($res);exit;
			}
			header("Content-Type: application/json");
			echo json_encode([
				"status"=>"success", "data"=>$res['data'], "query"=>$cond
			]);exit;
		}else if( $action == "findOne" ){
			$cond = [];
			if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
				$cond = mongo_query( $_POST['query'] );
			}
			$ops = [];
			if( !isset($options['sort']) ){
				$ops['sort'] = ['_id'=>1];
			}
			if( isset($options['projection']) && is_array($options['projection']) ){
				$ops['projection'] = $options['projection'];
			}
			$res = $mongodb_con->find_one( $db_prefix . "_dt_" . $table_res['data']['_id'], $cond, $ops );
			if( $res['status'] != "success" ){
				http_response_code(500); header("Content-Type: application/json");
				echo json_encode($res);exit;
			}
			header("Content-Type: application/json");
			echo json_encode([
				"status"=>"success", "data"=>$res['data'], "query"=>$cond
			]);exit;

		}else if( $action == "insertMany" ){
			$ops = [];
			if( !isset($_POST['data']) || !is_array($_POST['data']) ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Data invalid" ]);exit;
			}
			$data = $_POST['data'];
			if( array_keys($data)[0] !== 0 ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"List required" ]);exit;
			}
			$res = $mongodb_con->insert_many( $db_prefix . "_dt_" . $table_res['data']['_id'], $data, $ops );
			if( $res['status'] != "success" ){
				http_response_code(500); header("Content-Type: application/json");
				echo json_encode($res);exit;
			}
			header("Content-Type: application/json");
			//print_r( get_class_methods($res))
			echo json_encode($res);exit;
		}else if( $action == "insertOne" ){
			$ops = [];
			if( !isset($_POST['data']) || !is_array($_POST['data']) ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Data invalid" ]);exit;
			}
			$res = $mongodb_con->insert( $db_prefix . "_dt_" . $table_res['data']['_id'], $_POST['data'], $ops );
			if( $res['status'] != "success" ){
				http_response_code(500); header("Content-Type: application/json");
				echo json_encode($res);exit;
			}
			header("Content-Type: application/json");
			echo json_encode($res);exit;
		}else if( $action == "updateMany" ){
			$cond = [];
			if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
				$cond = mongo_query( $_POST['query'] );
			}
			$ops = [];
			if( isset($options['limit']) ){
				$ops['limit'] = $options['limit'];
			}else{
				$ops['limit'] = 100;
			}
			if( !isset($_POST['update']) || !is_array($_POST['update']) ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Data invalid" ]);exit;
			}
			$data = $_POST['update'];
			foreach( $data as $tc=>$j ){
				if( $tc == '$set' ){
					if( isset($j['_id']) ){
						http_response_code(400);header("Content-Type: application/json");
						echo json_encode(["status"=>"fail", "error"=>"\$set should not have _id" ]);exit;
					}
				}else if( $tc == '$unset' ){
					if( isset($j['_id']) ){
						http_response_code(400);header("Content-Type: application/json");
						echo json_encode(["status"=>"fail", "error"=>"\$unset should not have _id" ]);exit;
					}
				}else if( $tc == '$inc' ){
					if( isset($j['_id']) ){
						http_response_code(400);header("Content-Type: application/json");
						echo json_encode(["status"=>"fail", "error"=>"\$inc should not have _id" ]);exit;
					}
				}else{
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=> $tc. ": operator not allowed" ]);exit;
				}
			}
			$res = $mongodb_con->update_many( $db_prefix . "_dt_" . $table_res['data']['_id'], $cond, $data, $ops );
			if( $res['status'] != "success" ){
				http_response_code(500); header("Content-Type: application/json");
				echo json_encode($res);exit;
			}
			header("Content-Type: application/json");
			echo json_encode($res);exit;
		}else if( $action == "updateOne" ){
			$cond = [];
			if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
				$cond = mongo_query( $_POST['query'] );
			}
			$ops = [];
			if( !isset($_POST['update']) || !is_array($_POST['update']) ){
				http_response_code(400);header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Data invalid" ]);exit;
			}
			$data = $_POST['update'];
			foreach( $data as $tc=>$j ){
				if( $tc == '$set' ){
					if( isset($j['_id']) ){
						http_response_code(400);header("Content-Type: application/json");
						echo json_encode(["status"=>"fail", "error"=>"\$set should not have _id" ]);exit;
					}
				}else if( $tc == '$unset' ){
					if( isset($j['_id']) ){
						http_response_code(400);header("Content-Type: application/json");
						echo json_encode(["status"=>"fail", "error"=>"\$unset should not have _id" ]);exit;
					}
				}else if( $tc == '$inc' ){
					if( isset($j['_id']) ){
						http_response_code(400);header("Content-Type: application/json");
						echo json_encode(["status"=>"fail", "error"=>"\$inc should not have _id" ]);exit;
					}
				}else{
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=> $tc. ": operator not allowed" ]);exit;
				}
			}
			$res = $mongodb_con->update_one( $db_prefix . "_dt_" . $table_res['data']['_id'], $cond, $data, $ops );
			if( $res['status'] != "success" ){
				http_response_code(500); header("Content-Type: application/json");
				echo json_encode($res);exit;
			}
			header("Content-Type: application/json");
			echo json_encode($res);exit;
		}else if( $action == "deleteMany" ){
			$cond = [];
			if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
				$cond = mongo_query( $_POST['query'] );
			}
			$ops = [];
			if( isset($options['limit']) ){
				$ops['limit'] = $options['limit'];
			}else{
				$ops['limit'] = 100;
			}
			$res = $mongodb_con->delete_many( $db_prefix . "_dt_" . $table_res['data']['_id'], $cond, $ops );
			if( $res['status'] != "success" ){
				http_response_code(500); header("Content-Type: application/json");
				echo json_encode($res);exit;
			}
			header("Content-Type: application/json");
			echo json_encode($res);exit;
		}else if( $action == "deleteOne" ){
			$cond = [];
			if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
				$cond = mongo_query( $_POST['query'] );
			}
			$ops = [];
			$res = $mongodb_con->delete_one( $db_prefix . "_dt_" . $table_res['data']['_id'], $cond, $ops );
			if( $res['status'] != "success" ){
				http_response_code(500); header("Content-Type: application/json");
				echo json_encode($res);exit;
			}
			header("Content-Type: application/json");
			echo json_encode($res);exit;
		}else{
			http_response_code(403);
			header("Content-Type: application/json");
			echo json_encode(["status"=>"fail", "error"=>"Unknown action" ]);exit;
		}


	}else if( $thing_type == "table" ){

		//print_r( $table_res );exit;
		$db_res = $mongodb_con->find_one( $db_prefix . "_databases", ["_id"=>$table_res['data']['db_id'] ] );
		if( !$db_res['data'] ){
			http_response_code(500); header("Content-Type: application/json");
			echo json_encode(["status"=>"fail", "error"=>"Database not found" ]);exit;
		}

		//print_r( $db_res['data'] );exit;
		$engine = $db_res['data']['engine'];
		$col = $table_res['data']['table'];

		if( $engine == "MongoDb" ){

			$clientdb_con = new mongodb_connection( 
				$db_res['data']['details']['host'], 
				$db_res['data']['details']['port'], 
				$db_res['data']['details']['database'], 
				pass_decrypt($db_res['data']['details']['username']), 
				pass_decrypt($db_res['data']['details']['password']), 
				$db_res['data']['details']['authSource'], 
				$db_res['data']['details']['tls'], 
			);

			if( $action == "findMany" ){
				$cond = [];
				if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
					$cond = mongo_query( $_POST['query'] );
				}
				$ops = [];
				if( isset($options['limit']) ){
					$ops['limit'] = $options['limit'];
				}else{
					$ops['limit'] = 10;
				}
				if( !isset($options['sort']) ){
					$ops['sort'] = ['_id'=>1];
				}else if( isset($options['sort']) ){
					$ops['sort'] = $options['sort'];
				}
				if( isset($options['projection']) && is_array($options['projection']) ){
					$ops['projection'] = $options['projection'];
				}
				$res = $clientdb_con->find( $col, $cond, $ops );
				if( $res['status'] != "success" ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode($res);exit;
				}
				header("Content-Type: application/json");
				echo json_encode([
					"status"=>"success", "data"=>$res['data'], "query"=>$cond
				]);exit;
			}else if( $action == "findOne" ){
				$cond = [];
				if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
					$cond = mongo_query( $_POST['query'] );
				}
				$ops = [];
				if( !isset($options['sort']) ){
					$ops['sort'] = ['_id'=>1];
				}
				if( isset($options['projection']) && is_array($options['projection']) ){
					$ops['projection'] = $options['projection'];
				}
				$res = $clientdb_con->find_one( $col, $cond, $ops );
				if( $res['status'] != "success" ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode($res);exit;
				}
				header("Content-Type: application/json");
				echo json_encode([
					"status"=>"success", "data"=>$res['data'], "query"=>$cond
				]);exit;

			}else if( $action == "insertMany" ){
				$ops = [];
				if( !isset($_POST['data']) || !is_array($_POST['data']) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Data invalid" ]);exit;
				}
				$data = $_POST['data'];
				if( array_keys($data)[0] !== 0 ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"List required" ]);exit;
				}
				$res = $clientdb_con->insert_many( $col, $data, $ops );
				if( $res['status'] != "success" ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode($res);exit;
				}
				header("Content-Type: application/json");
				//print_r( get_class_methods($res))
				echo json_encode($res);exit;
			}else if( $action == "insertOne" ){
				$ops = [];
				if( !isset($_POST['data']) || !is_array($_POST['data']) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Data invalid" ]);exit;
				}
				$res = $clientdb_con->insert( $col, $_POST['data'], $ops );
				if( $res['status'] != "success" ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode($res);exit;
				}
				header("Content-Type: application/json");
				echo json_encode($res);exit;
			}else if( $action == "updateMany" ){
				$cond = [];
				if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
					$cond = mongo_query( $_POST['query'] );
				}
				$ops = [];
				if( isset($options['limit']) ){
					$ops['limit'] = $options['limit'];
				}else{
					$ops['limit'] = 100;
				}
				if( !isset($_POST['update']) || !is_array($_POST['update']) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Data invalid" ]);exit;
				}
				$data = $_POST['update'];
				foreach( $data as $tc=>$j ){
					if( $tc == '$set' ){
						if( isset($j['_id']) ){
							http_response_code(400);header("Content-Type: application/json");
							echo json_encode(["status"=>"fail", "error"=>"\$set should not have _id" ]);exit;
						}
					}else if( $tc == '$unset' ){
						if( isset($j['_id']) ){
							http_response_code(400);header("Content-Type: application/json");
							echo json_encode(["status"=>"fail", "error"=>"\$unset should not have _id" ]);exit;
						}
					}else if( $tc == '$inc' ){
						if( isset($j['_id']) ){
							http_response_code(400);header("Content-Type: application/json");
							echo json_encode(["status"=>"fail", "error"=>"\$inc should not have _id" ]);exit;
						}
					}else{
						http_response_code(400);header("Content-Type: application/json");
						echo json_encode(["status"=>"fail", "error"=> $tc. ": operator not allowed" ]);exit;
					}
				}
				$res = $clientdb_con->update_many( $col, $cond, $data, $ops );
				if( $res['status'] != "success" ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode($res);exit;
				}
				header("Content-Type: application/json");
				echo json_encode($res);exit;
			}else if( $action == "updateOne" ){
				$cond = [];
				if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
					$cond = mongo_query( $_POST['query'] );
				}
				$ops = [];
				if( !isset($_POST['update']) || !is_array($_POST['update']) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Data invalid" ]);exit;
				}
				$data = $_POST['update'];
				foreach( $data as $tc=>$j ){
					if( $tc == '$set' ){
						if( isset($j['_id']) ){
							http_response_code(400);header("Content-Type: application/json");
							echo json_encode(["status"=>"fail", "error"=>"\$set should not have _id" ]);exit;
						}
					}else if( $tc == '$unset' ){
						if( isset($j['_id']) ){
							http_response_code(400);header("Content-Type: application/json");
							echo json_encode(["status"=>"fail", "error"=>"\$unset should not have _id" ]);exit;
						}
					}else if( $tc == '$inc' ){
						if( isset($j['_id']) ){
							http_response_code(400);header("Content-Type: application/json");
							echo json_encode(["status"=>"fail", "error"=>"\$inc should not have _id" ]);exit;
						}
					}else{
						http_response_code(400);header("Content-Type: application/json");
						echo json_encode(["status"=>"fail", "error"=> $tc. ": operator not allowed" ]);exit;
					}
				}
				$res = $clientdb_con->update_one( $col, $cond, $data, $ops );
				if( $res['status'] != "success" ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode($res);exit;
				}
				header("Content-Type: application/json");
				echo json_encode($res);exit;
			}else if( $action == "deleteMany" ){
				$cond = [];
				if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
					$cond = mongo_query( $_POST['query'] );
				}
				$ops = [];
				if( isset($options['limit']) ){
					$ops['limit'] = $options['limit'];
				}else{
					$ops['limit'] = 100;
				}
				$res = $clientdb_con->delete_many( $col, $cond, $ops );
				if( $res['status'] != "success" ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode($res);exit;
				}
				header("Content-Type: application/json");
				echo json_encode($res);exit;
			}else if( $action == "deleteOne" ){
				$cond = [];
				if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
					$cond = mongo_query( $_POST['query'] );
				}
				$ops = [];
				$res = $clientdb_con->delete_one( $col, $cond, $ops );
				if( $res['status'] != "success" ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode($res);exit;
				}
				header("Content-Type: application/json");
				echo json_encode($res);exit;
			}else{
				http_response_code(403);
				header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Unknown action" ]);exit;
			}


		}else if( $engine == "MySql" ){

			$clientdb_con = mysqli_connect(
				$db_res['data']['details']['host'], 
				pass_decrypt($db_res['data']['details']['username']), 
				pass_decrypt($db_res['data']['details']['password']), 
				$db_res['data']['details']['database'], 
				$db_res['data']['details']['port'], 				
			);
			if( mysqli_connect_error() ){
				http_response_code(500); header("Content-Type: application/json");
				echo json_encode([
					"status"=>"fail", "error"=>"DB Connect Error: " . mysqli_connect_error()
				]);exit;
			}
			mysqli_options($clientdb_con, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, true); 
			mysqli_report(MYSQLI_REPORT_OFF);

			//print_r( $table_res );exit;
			$primary_keys = $table_res['data']['source_schema']['keys']['PRIMARY']['keys'];
			$primary_key = array_keys($primary_keys)[0];
			$primary_key_type = $primary_keys[ $primary_key ]['type'];

			if( $action == "findMany" ){
				$where = "";
				if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
					$where = mysql_cond( $clientdb_con, $_POST['query'] );
					if( trim($where) ){
						$where = " where " . $where;
					}
				}
				$limit = 10;
				if( isset($options['limit']) ){
					$limit = $options['limit'];
				}
				if( !isset($options['sort']) ){
					$sort = "`". $primary_key. "`";
				}else if( isset($options['sort']) ){
					$sorts = [];
					foreach( $options['sort'] as $i=>$j ){
						$sorts[] = "`".$i . "` " . ($j>0?"ASC":"DESC");
					}
					$sort = implode(", ", $sorts );
				}
				if( isset($options['projection']) && is_array($options['projection']) ){
					$fields = implode(",",array_keys($options['projection']));
				}else{
					$fields = "*";
				}
				$query = "select " . $fields . " from `" . $table_res['data']['table'] . "` " . $where . " order by " . $sort . " limit " . $limit;
				$res = mysqli_query( $clientdb_con, $query );
				if( mysqli_error($clientdb_con) ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode([
						"status"=>"fail",
						"error"=>mysqli_error($clientdb_con),
						"query"=>$query
					]);exit;
				}
				$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
				header("Content-Type: application/json");
				echo json_encode([
					"status"=>"success", "data"=>$rows, "query"=>$query
				]);exit;

			}else if( $action == "findOne" ){
				$where = "";
				if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
					$where = mysql_cond( $clientdb_con, $_POST['query'] );
					if( trim($where) ){
						$where = " where " . $where;
					}
				}
				$limit = 1;
				if( !isset($options['sort']) ){
					$sort = "`". $primary_key. "`";
				}else if( isset($options['sort']) ){
					$sorts = [];
					foreach( $options['sort'] as $i=>$j ){
						$sorts[] = "`".$i . "` " . ($j>0?"ASC":"desc");
					}
					$sort = implode(", ", $sorts );
				}
				if( isset($options['projection']) && is_array($options['projection']) ){
					$fields = implode(",",array_keys($options['projection']));
				}else{
					$fields = "*";
				}
				$query = "select " . $fields . " from `" . $table_res['data']['table'] . "` " . $where . " order by " . $sort . " limit " . $limit;
				$res = mysqli_query( $clientdb_con, $query );
				if( mysqli_error($clientdb_con) ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode([
						"status"=>"fail",
						"error"=>mysqli_error($clientdb_con),
						"query"=>$query
					]);exit;
				}
				$row = mysqli_fetch_assoc($res);
				header("Content-Type: application/json");
				echo json_encode([
					"status"=>"success", "data"=>$row, "query"=>$query
				]);exit;

			}else if( $action == "insertMany" ){
				if( !isset($_POST['data']) || !is_array($_POST['data']) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Data invalid" ]);exit;
				}
				$data = $_POST['data'];
				if( array_keys($data)[0] !== 0 ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"List required" ]);exit;
				}
				$values = [];
				$query = "insert into `". $table_res['data']['table'] . "` ( " . $fields . " ) values " . implode(", ", $values);
				$res = $clientdb_con->insert_many( $col, $data, $ops );
				if( $res['status'] != "success" ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode($res);exit;
				}
				header("Content-Type: application/json");
				//print_r( get_class_methods($res))
				echo json_encode([
					"status"=>"success", "data"=>$row, "query"=>$query
				]);exit;

			}else if( $action == "insertOne" ){
				if( !isset($_POST['data']) || !is_array($_POST['data']) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Data invalid" ]);exit;
				}
				$data = $_POST['data'];
				$values = [];
				foreach( $data as $i=>$j ){
					$values[] = "`" . $i . "` = '" . mysqli_escape_string( $clientdb_con, $j ) . "' ";
				}
				$query = "insert into `". $table_res['data']['table'] . "` set " . implode(", ", $values) . " ";
				$res = mysqli_query( $clientdb_con, $query );
				if( mysqli_error( $clientdb_con ) ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode([
						"status"=>"fail",
						"error"=>mysqli_error($clientdb_con),
						"query"=>$query
					]);exit;
				}
				header("Content-Type: application/json");
				echo json_encode([
					"status"=>"success", "inserted_id"=>mysqli_insert_id($clientdb_con), "query"=>$query
				]);exit;

			}else if( $action == "updateMany" ){
				if( !isset($_POST['update']) || !is_array($_POST['update']) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Data invalid" ]);exit;
				}
				$data = $_POST['update'];
				$values = [];
				foreach( $data as $i=>$j ){
					$values[] = "`" . $i . "` = '" . mysqli_escape_string( $clientdb_con, $j ) . "' ";
				}
				$where = "";
				if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
					$where = mysql_cond( $clientdb_con, $_POST['query'] );
					if( trim($where) ){
						$where = " where " . $where;
					}
				}
				$limit = 10;
				if( isset($options['limit']) ){
					$limit = $options['limit'];
				}
				if( !isset($options['sort']) ){
					$sort = "`". $primary_key. "`";
				}else if( isset($options['sort']) ){
					$sorts = [];
					foreach( $options['sort'] as $i=>$j ){
						$sorts[] = "`".$i . "` " . ($j>0?"ASC":"desc");
					}
					$sort = implode(", ", $sorts );
				}
				$query = "update  `". $table_res['data']['table'] . "` set " . implode(", ", $values) . " " . $where . " limit " . $limit;
				$res = mysqli_query( $clientdb_con, $query );
				if( mysqli_error( $clientdb_con ) ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode([
						"status"=>"fail",
						"error"=>mysqli_error($clientdb_con),
						"query"=>$query
					]);exit;
				}
				header("Content-Type: application/json");
				echo json_encode([
					"status"=>"success", "affected"=>mysqli_affected_rows($clientdb_con), "query"=>$query
				]);exit;

			}else if( $action == "updateOne" ){
				if( !isset($_POST['update']) || !is_array($_POST['update']) ){
					http_response_code(400);header("Content-Type: application/json");
					echo json_encode(["status"=>"fail", "error"=>"Data invalid" ]);exit;
				}
				$data = $_POST['update'];
				$values = [];
				foreach( $data as $i=>$j ){
					$values[] = "`" . $i . "` = '" . mysqli_escape_string( $clientdb_con, $j ) . "' ";
				}
				$where = "";
				if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
					$where = mysql_cond( $clientdb_con, $_POST['query'] );
					if( trim($where) ){
						$where = " where " . $where;
					}
				}
				$limit = 1;
				if( !isset($options['sort']) ){
					$sort = "`". $primary_key. "`";
				}else if( isset($options['sort']) ){
					$sorts = [];
					foreach( $options['sort'] as $i=>$j ){
						$sorts[] = "`".$i . "` " . ($j>0?"ASC":"desc");
					}
					$sort = implode(", ", $sorts );
				}
				$query = "update  `". $table_res['data']['table'] . "` set " . implode(", ", $values) . " " . $where . " limit " . $limit;
				$res = mysqli_query( $clientdb_con, $query );
				if( mysqli_error( $clientdb_con ) ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode([
						"status"=>"fail",
						"error"=>mysqli_error($clientdb_con),
						"query"=>$query
					]);exit;
				}
				header("Content-Type: application/json");
				echo json_encode([
					"status"=>"success", "affected"=>mysqli_affected_rows($clientdb_con), "query"=>$query
				]);exit;


			}else if( $action == "deleteMany" ){
				$where = "";
				if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
					//print_r( $_POST['query'] );	
					$where = mysql_cond( $clientdb_con, $_POST['query'] );
					//echo $where ;exit;
					if( trim($where) ){
						$where = " where " . $where;
					}
				}
				$limit = 10;
				if( isset($options['limit']) ){
					$limit = $options['limit'];
				}
				if( !isset($options['sort']) ){
					$sort = "`". $primary_key. "`";
				}else if( isset($options['sort']) ){
					$sorts = [];
					foreach( $options['sort'] as $i=>$j ){
						$sorts[] = "`".$i . "` " . ($j>0?"ASC":"desc");
					}
					$sort = implode(", ", $sorts );
				}
				$query = "delete from  `". $table_res['data']['table'] . "` " . $where . " limit " . $limit;
				$res = mysqli_query( $clientdb_con, $query );
				if( mysqli_error( $clientdb_con ) ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode([
						"status"=>"fail",
						"error"=>mysqli_error($clientdb_con),
						"query"=>$query
					]);exit;
				}
				header("Content-Type: application/json");
				echo json_encode([
					"status"=>"success", "affected"=>mysqli_affected_rows($clientdb_con), "query"=>$query
				]);exit;


			}else if( $action == "deleteOne" ){
				$where = "";
				if( isset( $_POST['query'] ) && is_array($_POST['query']) ){
					$where = mysql_cond( $clientdb_con, $_POST['query'] );
					if( trim($where) ){
						$where = " where " . $where;
					}
				}
				$limit = 1;
				if( !isset($options['sort']) ){
					$sort = "`". $primary_key. "`";
				}else if( isset($options['sort']) ){
					$sorts = [];
					foreach( $options['sort'] as $i=>$j ){
						$sorts[] = "`".$i . "` " . ($j>0?"ASC":"desc");
					}
					$sort = implode(", ", $sorts );
				}
				$query = "delete from  `". $table_res['data']['table'] . "` " . $where . " limit " . $limit;
				$res = mysqli_query( $clientdb_con, $query );
				if( mysqli_error( $clientdb_con ) ){
					http_response_code(500); header("Content-Type: application/json");
					echo json_encode([
						"status"=>"fail",
						"error"=>mysqli_error($clientdb_con),
						"query"=>$query
					]);exit;
				}
				header("Content-Type: application/json");
				echo json_encode([
					"status"=>"success", "affected"=>mysqli_affected_rows($clientdb_con), "query"=>$query
				]);exit;

			}else{
				http_response_code(403);
				header("Content-Type: application/json");
				echo json_encode(["status"=>"fail", "error"=>"Unknown action" ]);exit;
			}

		}else{
			http_response_code(500);
			header("Content-Type: application/json");
			echo json_encode(["status"=>"fail", "error"=>"Unknown DB Engine" ]);exit;
		}

	}


	header("Content-Type: application/json");
	echo json_encode(["status"=>"success", "error"=>"Access Key Accepted" ]);exit;

exit;