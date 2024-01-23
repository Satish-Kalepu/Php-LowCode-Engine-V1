<?php
require_once 'AWSSDK/aws-autoloader.php';
use Aws\DynamoDb\Exception\DynamoDbException;
use Aws\DynamoDb\Marshaler;
require_once( "class_dynamodb.php" );
$config_api_tables = "api_tables_dynamodb";

$db['details']['access_key'] = pass_decrypt($db['details']['access_key']);
$db['details']['access_secret'] = pass_decrypt($db['details']['access_secret']);
if( $config_param4 == "table" && $config_param4 == "new" ){

	$breadcrumb[] = ["name"=> "Create Table"];
	$meta_title = "Databases - Dynamodb - Create Table";

	$table = [
		"_id"   => "new",
		"db_id" => $config_param1,
		"des"	=> "New",
		"table"	=> "new", // dynamodb table name
		"pk"=>[ "field"=> "user", "type"=> "text" ],
		"sk"=>[ "enable"=>true, "field"=> "orderid", "type"=> "number" ],
		"keys"=>[
			/*
			indexname => [
				"name"=>"indexname",
				"pk"=> "", "pktype": "text",
				"sk"=>"", "sktype": "text",
			]
			*/
		],
		"schema"=>[
			"default"=> [
				"name"=> "Default",
				"fields"=>[
					"user" =>["key"=>"user", "name"=>"user", "type"=> "text", "m"=> true, "order"=> 1],
					"orderid" =>["key"=>"orderid", "name"=>"orderid", "type"=> "number", "m"=> true, "order"=> 2],
					"price" =>["key"=>"price", "name"=>"price", "type"=> "number", "m"=> true, "order"=> 2],
				]
			]
		],
	];
}else if( $config_param4 == "table" && $config_param4 ){
	if( !$mongodb_con->is_id_valid( $config_param4 ) ){
		echo "<p>Incorrect URL!</p>";exit;
	}
	$main_table_res = $mongodb_con->find_one($config_api_tables, ["_id"=>$config_param4]);
	if( $main_table_res["status"] == "fail" || $main_table_res["status"] == "success" &&  $main_table_res["data"]  == "" ){
		echo404("Table not found!");
	}else{
		$table  = $main_table_res["data"];
	}
	$breadcrumb[] = ["name"=> $table['des'], "link"=>$config_site_path.'databases/'.$db['_id'].'/table/'.$table['_id'].'/records' ];
	if( $config_param4 == "manage" ){
		$breadcrumb[] = ["name"=> "Manage"];
	}else if( $config_param4 == "records" ){
		$breadcrumb[] = ["name"=> "Records"];
	}else if( $config_param4 == "export" ){
		$breadcrumb[] = ["name"=> "Export"];
	}else if( $config_param4 == "import" ){
		$breadcrumb[] = ["name"=> "Import"];
	}else if( $config_param4 == "indexes" ){
		$breadcrumb[] = ["name"=> "Indexes"];
	}
	$meta_title = "Databases - Dynamodb - Create Table";
}
$con = new dynamodb_connection();
$st = $con->connect( $db['details']['region'], $db['details']['access_key'], $db['details']['access_secret'] );
if( !$st ){
	echo404("Database connection failed!" . $con->error);exit;
	//json_response("fail", "Database connection failed!" . $con->error);
}
$fields = [];
function find_dynamodb_fields_structure2($rec){
	$fields = [];
	$cnt= 0;
	foreach( $rec as $i=>$j ){
		$cnt++;
		$t = "text";
		if( $j['S'] ){ $t = "text"; $v = $j['S']; }
		if( $j['N'] ){ $t = "number"; $v = $j['N']; }
		if( $j['M'] ){ $t = "dict"; $v = $j['M']; }
		if( $j['L'] ){ $t = "list"; $v = $j['L']; }
		$fields[ $i ] = [ "key"=>$i, "name"=>$i, "type"=>$t, "m"=>true, "order"=>$cnt, "sub"=>[] ];
		if( $t == "dict" ){
			$fields[ $i ]['sub'] = find_dynamodb_fields_structure2($v);
		}
		if( $t == "list" ){
			$fields[ $i ]['sub'] = [];
			$fields[ $i ]['sub'][0] = find_dynamodb_fields_structure2($v[0]);
		}
	}
	return $fields;
}
function find_dynamodb_fields_structure($recs){
	$fields = [];
	foreach( $recs as $i=>$j ){
		$f = find_dynamodb_fields_structure2( $j, $fields );
		$fields = array_replace_recursive( $fields, $f );
	}
	return $fields;
}
function find_field_type( $fn, $v, $fields ){
	if( $fields[ $fn ] ){
		if( $fields[ $fn ]['type'] == "number" ){
			if( strpos($v,".") ){
				$v = (float)$v;
			}else{
				$v = (int)$v;
			}
		}
	}
	return $v;
}
function dynamodb_unmarshal($items){
	foreach( $items as $i=>$j){
		$items[$i] = dynamodb_unmarshal2($j);
	}
	return $items;
}
/*Manage*/
if( $_POST['action'] == "check_dynamodb_source_table" ){
	$config_debug = false;
	if($config_debug == false){ 
		$token_status = validate_new_token($_POST['security_token'],"database_dynamodb_manage",$config_param4 );
		if( $token_status != "ok" ){
			if( $token_status == "Toomany Requests" ){
				$token_status = "Too Many Requests.Please Try After Sometime";
			}
			json_response("fail",$token_status);
		}
	}
	$res = $con->fetch_table_description( $_POST['table'] );
	if( $res['status'] == "success" ){
		$res2 = $con->scan_few( $_POST['table'] );
		if( $res2["status"] == "fail" ){
			json_response("fail",$res2['error']);
		}
		$fields = find_dynamodb_fields_structure( $res2['data']['Items'] );
		ksort($fields);
		//print_pre($fields);print_pre($fields);exit;
		if( $config_param4 != "new" ){
			$main_table_res = $mongodb_con->find_one($config_api_tables, ["_id"=>$config_param4]);
			if( $main_table_res["status"] == "fail" || $main_table_res["status"] == "success" && $main_table_res["data"] == "" ){
				json_response("fail","Table not found!");
			}else{
				$main_table = $main_table_res["data"];
				$insert_data = ["source_schema"=>["schema"=>$res['data'],"last_checked"=>date("Y-m-d H:i:s")]];
				//print_pre($insert_data);exit;
				$update_rec = $mongodb_con->update_one($config_api_tables,$insert_data, ["_id"=>$main_table['_id']]);
				if($update_rec["status"] == "fail" ||  ($update_rec["status"] == "success" && $update_rec["data"]["matched_count"] != $update_rec["data"]["modified_count"] ) ){
					json_response("fail",$update_rec['error']);
				}else{
					$data = [
							"schema"=>$res['data'],
							"fields"=>$fields,
							"last_checked"=>date("Y-m-d H:i:s")
						];
					json_response("success",$data);
				}
			}
		}
	}else{
		json_response( "fail", $res['error'] );
	}
}
if( $_POST['action'] == "save_table_dynamodb" ){
	$config_debug = false;
	if($config_debug == false){ 
		$token_status = validate_new_token($_POST['security_token'],"database_dynamodb_manage",$config_param4 );
		if( $token_status != "ok" ){
			if( $token_status == "Toomany Requests" ){
				$token_status = "Too Many Requests.Please Try After Sometime";
			}
			json_response("fail",$token_status);
		}
	}
	if( $_POST['table']['db_id']== ""){
		json_response("fail", "Database id missing");
	}else{
		$db_res = $mongodb_con->find_one($config_api_databases, ["_id"=>$_POST['table']['db_id']]);
		if( $db_res["status"] == "fail" || $db_res["status"] == "success" && sizeof( $db_res["data"] ) == 0 ){
			json_response("fail","Database not found!");
		}else{
			$db = $db_res["data"];
			if( $_POST['table']['table']== "" ){
				json_response("fail", "Enter Table Name");
			}else if( !preg_match("/^[A-Za-z0-9\-\_\.]{5,25}$/i", $_POST['table']['table'] ) ){
				json_response("fail","Table name From 5 to 25 characters in length, lowercase a-z 0-9 _ - . allowed. space is not allowed");
			}else if( $_POST['table']['des']== "" ){
				json_response("fail", "Enter Table Description");
			}else if( !preg_match("/^[A-Za-z0-9\-\_\s\.\ ]{5,50}$/i", $_POST['table']['des'] ) ){
				json_response("fail", "Table description From 5 to 50 characters in length, A-Z a-z 0-9 _ - . and spaces allowed.");
			}else{
				if( $_POST['table']['_id'] == "new" ){
					$cond = [ "des" => $_POST['table']['des'], "db_id"=>$_POST['table']['db_id'] ];
					$tables_res = $mongodb_con->find($config_api_tables_dynamodb, $cond);
					if( $tables_res["status"] == "fail"){
						json_response("fail", "Table Details Missing!");
					}else{
						if( sizeof( $tables_res["data"] ) == 0 ){
							unset($_POST['table']['_id']);
							$insert_data = [];
							$insert_data = $_POST['table'];
							$insert_data["user_id"] = $_SESSION["user_id"];
							$insert_data["user_name"] = $_SESSION["user_name"];
							$insert_res = $mongodb_con->insert( $config_api_tables_dynamodb, $insert_data );
							if( $insert_res["status"] == "fail" ){
								json_response("fail", "Server Error.Please Try After Sometime");
							}else{
								json_response("success", $insert_res["data"] );
							}
						}else{
							json_response("fail", "Table description already exists!");
						}
					}
				}else{
					$maintables_res = $mongodb_con->find_one($config_api_tables_dynamodb, ["_id"=>$_POST['table_id'] ]);
					if( $maintables_res["status"] == "fail"){
						json_response("fail", "Table Details Missing!");
					}else{
						if( sizeof( $maintables_res["data"] ) == 0 ){
							json_response("fail", "Table Not Found!");
						}else{
							$table = $maintables_res["data"];
							$cond = [ "_id"=> ["\$ne" =>$mongodb_con->get_id($table["_id"] ) ], "des"=>$_POST['table']['des'], "db_id"=>$_POST['table']['db_id'] ];
							$tables_res = $mongodb_con->find($config_api_tables_dynamodb, $cond);
							if( $tables_res["status"] == "fail"){
								json_response("fail", "Table Details Missing!");
							}else{
								//print_pre($cond);exit;
								if( sizeof( $tables_res["data"] ) == 0 ){
									$data = [
											"table"		=> $_POST['table']['table'],
											"des"		=> $_POST['table']['des'],
											"schema" 	=> $_POST['table']['schema'],
											"keys" 		=> $_POST['table']['keys'],
											"pk"  		=> $_POST['table']['pk'],
											"sk" 		=> $_POST['table']['sk'],
										];
									$insert_res = $mongodb_con->update_one( $config_api_tables_dynamodb, $data, ["_id"=> $_POST['table_id']] );
									if( $insert_res["status"] == "fail" || ($insert_res["status"] == "success" && $insert_res["data"]["matched_count"] != $insert_res["data"]["modified_count"]) ){
										json_response("fail", "Server Error.Please Try After Sometime");
									}else{
										json_response("success", $maintables_res["data"] );
									}
								}else{
									json_response("fail", "Table with same description already exists!");
								}
							}	
						}
					}
				}
			}
		}
	}
}


/*Browse*/
if( $_POST['action'] == "load_dynamodb_records" ){
	$config_debug = false;
	if($config_debug == false){ 
		$token_status = validate_new_token($_POST['security_token'],"database_dynamodb_browse",$config_param4 );
		if( $token_status != "ok" ){
			if( $token_status == "Toomany Requests" ){
				$token_status = "Too Many Requests.Please Try After Sometime";
			}
			json_response("fail",$token_status);
		}
	}
	if($config_param1 != $_POST['db_id'] || $config_param4 != $_POST['table_id'] ){
		json_response("fail", "Incorrect credentials");
	}
	$main_table_res = $mongodb_con->find_one($config_api_tables, ["_id" => $_POST['table_id'] ]);
	if( $main_table_res["status"] == "fail" || $main_table_res["status"] == "success" && $main_table_res["data"] == "" ){
		json_response("fail","Table not found!");
	}
	$main_table = $main_table_res["data"];
	$filters = ["="=>'$eq',"!="=>'$ne', "<"=>'$lt', "<="=>'$lte', ">"=>'$gt', ">="=>'$gte'];
	try{
		$s = $_POST["s"];
		if( $s["t"] == "scan" ){
			$param = [
				'TableName' => $main_table['table'],
				'ReturnConsumedCapacity'=>"TOTAL",
				'Limit' => $_POST['limit'],
				'ScanIndexForward' => ($_POST['sort']=="asc"?true:false),
			];
			if( $_POST['last_key'] ){
				$param['ExclusiveStartKey'] = $_POST['last_key'];
			}
			$res = $con->scan_raw($param);
		}else{
			$cond = [];
			$options = ["limit"=>$_POST['limit'] ];
			//if( $s["i"] == "i_p" )
			{
				if( $s["i"] == "i_p" ){
					$key = ["pk"=>$main_table['pk'], "sk"=>$main_table['sk']];
				}else{
					$key = $main_table['keys'][ $s['i'] ];
				}

				$cond = [];
				$filter_cond = [];
				$attribute_values = [];
				$attribute_names = [];
				$key_cond = "";
				$af = $key['pk']['field'];
				$ac = $s["a"]["c"];
				$at = ($key['pk']['type'] == "number"?"N":"S");
				$av = $s["a"]["v"];
				$av2 = $s["a"]["v2"];
				if( $av ){
					$attribute_names[ "#pk" ] = $af;
					$attribute_values[ ":pk" ] = [];
					$attribute_values[ ":pk" ][ $at ] = $av;
					if( $ac == "><" ){
						$attribute_values[ ":pk2" ] = [];
						$attribute_values[ ":pk2" ][ $at ] = $av2;
						$key_cond = "#pk BETWEEN :pk and :pk2";
					}else{
						$key_cond = "#pk ".$ac." :pk";
					}
				}
				if( $av && $key['sk']['enable'] ){
					$bf = $key['sk']['field'];
					$bc = $s["b"]["c"];
					$bt = ($key['sk']['type']== "number"?"N":"S");
					$bv = $s["b"]["v"];
					$bv2 = $s["b"]["v2"];
					if( $bv ){
						$attribute_names[ "#sk" ] = $bf;
						$attribute_values[ ":sk" ] = [];
						$attribute_values[ ":sk" ][ $bt ] = $bv;
						if( $bc == "><" ){
							$attribute_values[ ":sk2" ] = [];
							$attribute_values[ ":sk2" ][ $bt ] = $bv2;
							$key_cond .= " and #sk BETWEEN :sk and :sk2";
						}else{
							$key_cond .= " and #sk ".$bc." :sk";
						}
					}
				}
				$param = [
					'TableName'=>$main_table['table'],
					'ReturnConsumedCapacity'=>"TOTAL",
					'Limit'=>$_POST['limit'],
					'ScanIndexForward'=>($s['sort']=="asc"?true:false),
					'KeyConditionExpression' => $key_cond,
					'ExpressionAttributeNames' => $attribute_names,
					'ExpressionAttributeValues' => $attribute_values,
				];
				if( $s['i'] != "i_p" ){
					$param['IndexName'] = $s['i'];
				}
				if( $_POST['last_key'] ){
					$param['ExclusiveStartKey'] = $_POST['last_key'];
				}
			}
			$res = $con->query_raw($param);
		}
		if( $res["status"] == "fail" ){	
			json_response("fail", ['error'=>$res['error'], "param"=>$param] );
		}else{
			if( $res['data']['LastEvaluatedKey'] ){
				$lk = $res['data']['LastEvaluatedKey'];
			}else{
				$lk = false;
			}
			if( $res['status'] == "success" ){
				json_response("success",["records"=>$res['data']['Items'], "last_key"=>$lk, "param"=>$param]);
			}else{
				json_response("fail", ['error'=>$res['error'], "param"=>$param] );
			}
		}
	}catch(Exception $e){
		json_response("fail",$e->getMessage() );
	}
}
if( $_POST['action'] == "update_record" ){
	$config_debug = false;
	if($config_debug == false){ 
		$token_status = validate_new_token($_POST['security_token'],"database_dynamodb_browse",$config_param4 );
		if( $token_status != "ok" ){
			if( $token_status == "Toomany Requests" ){
				$token_status = "Too Many Requests.Please Try After Sometime";
			}
			json_response("fail",$token_status);
		}
	}
	if( $config_param1 != $_POST['db_id'] || $config_param4 != $_POST['table_id'] ){
		json_response("fail", "Incorrect credentials");
	}else{
		$main_table_res = $mongodb_con->find_one($config_api_tables, ["_id" => $_POST['table_id'] ]);
		if( $main_table_res["status"] == "fail" || $main_table_res["status"] == "success" &&  $main_table_res["data"]  == "" ){
			json_response("fail","Table not found!");	
		}else{
			$main_table = $main_table_res["data"];
			$record = $_POST['record'];
			if( $record[ $main_table['pk']['field'] ] == "" ){
				json_response("fail", "Primary key value empty");
			}
			if( $main_table['pk']['type'] == "number" ){
				if( !is_numeric($record[ $main_table['pk']['field'] ]) ){
					if( strpos(".", $record[ $main_table['pk']['field'] ]) ){
						$record[ $main_table['pk']['field'] ] = (float)$record[ $main_table['sk']['field'] ];
					}else{
						$record[ $main_table['pk']['field'] ] = (float)$record[ $main_table['sk']['field'] ];
					}
				}
			}
			$key = [];
			$key[ $main_table['pk']['field'] ] = $record[ $main_table['pk']['field'] ];
			if( $main_table['sk']['enable'] ){
				if( $record[ $main_table['sk']['field'] ] == "" ){
					json_response("fail", "Sort key value empty");
				}
				if( $main_table['sk']['type'] == "number" ){
					if( !is_numeric($record[ $main_table['sk']['field'] ]) ){
						if( strpos(".", $record[ $main_table['sk']['field'] ]) ){
							$record[ $main_table['sk']['field'] ] = (float)$record[ $main_table['sk']['field'] ];
						}else{
							$record[ $main_table['sk']['field'] ] = (float)$record[ $main_table['sk']['field'] ];
						}
					}
				}
				$key[ $main_table['sk']['field'] ] = $record[ $main_table['sk']['field'] ];
			}
			if( $_POST['edit_mode'] == "new" ){
				$res = $con->get_item($main_table['table'], $key);
				if( $res['status'] == "success" ){
					if( $res['data']['Item'] ){
						json_response("fail", "Record already Exists"); // frontend check
					}
				}
			}
			$res = $con->insert_raw(['TableName'=>$main_table['table'],'Item'=>$record,'ReturnConsumedCapacity'=>"TOTAL"]);
			if( $res['status'] == "success" ){
				$_id2 = $mongodb_con->increment($config_api_tables, $main_table['_id'], "count", 1);
				if( $_id2['status'] == "success" ){
					json_response("success", $res['data'] );
				}else{
					json_response("fail", $_id2['error'] );
				}
			}else{
				json_response("fail", $res['error'] );
			}
		}
	}
}
if($_POST['action'] == "delete_record_multiple"){
	$config_debug = false;
	if($config_debug == false){ 
		$token_status = validate_new_token($_POST['security_token'],"database_dynamodb_browse",$config_param4 );
		if( $token_status != "ok" ){
			if( $token_status == "Toomany Requests" ){
				$token_status = "Too Many Requests.Please Try After Sometime";
			}
			json_response("fail",$token_status);
		}
	}
	$table_res = $mongodb_con->find_one($config_api_tables,["_id"=>$_POST['table_id'] ]);
	if($table_res["status"] == "fail"){
		json_response("fail", "Server Error ".$table_res["error"]);
	}else if( $table_res["data"] == "" ){
		json_response("fail","Table not found!");
	}else{
		$table = $table_res["data"];
		foreach($_POST["record"] as $index => $rec){
			$res = $con->get_item($table['table'], $rec );
			if( $res['status'] == "success" ){
				if( !$res['data']['Item'] ){
					json_response("fail", "Record not found"); // frontend check
				}
			}
			$res2 = $con->delete_item( $table['table'], $rec );
			if($res2["status"] == "fail"){
				json_response("fail", "Server Error ".$res2["error"]);
			}
			$increment_res = $mongodb_con->increment($config_api_tables, $table['_id'], "count", -1);
			if($increment_res["status"] == "fail"){
				json_response("fail", "Server Error ".$increment_res["error"]);
			}
		}
		json_response("success","ok");
	}
}
if($_POST['action'] == "delete_record"){
	$config_debug = false;
	if($config_debug == false){ 
		$token_status = validate_new_token($_POST['security_token'],"database_dynamodb_browse",$config_param4 );
		if( $token_status != "ok" ){
			if( $token_status == "Toomany Requests" ){
				$token_status = "Too Many Requests.Please Try After Sometime";
			}
			json_response("fail",$token_status);
		}
	}
	$table_res = $mongodb_con->find_one($config_api_tables,["_id"=>$_POST['table_id'] ]);
	if($table_res["status"] == "fail"){
		json_response("fail", "Server Error ".$table_res["error"]);
	}
	if( $table_res["data"] == "" ){
		json_response("fail","Table not found!");
	}
	$main_table = $table_res["data"];
	$res = $con->get_item($main_table['table'], $_POST['record_key']);
	if( $res['status'] == "success" ){
		if( !$res['data']['Item'] ){
			json_response("fail", "Record not found"); // frontend check
		}
	}
	$res = $con->delete_item( $main_table['table'], $_POST['record_key'] );
	if($res["status"] == "fail"){
		json_response("fail", "Server Error ".$res["error"]);
	}
	$increment_res = $mongodb_con->increment($config_api_tables, $main_table['_id'], "count", -1);
	if($increment_res["status"] == "fail"){
		json_response("fail", "Server Error ".$increment_res["error"]);
	}
	json_response("success", "ok" );
}
/*Export*/
if($_POST["action"] == "export_dynamodb_data"){
	$config_debug = false;
	if($config_debug == false){ 
		$token_status = validate_new_token($_POST['security_token'],"database_dynamodb_export",$config_param4 );
		if( $token_status != "ok" ){
			if( $token_status == "Toomany Requests" ){
				$token_status = "Too Many Requests.Please Try After Sometime";
			}
			json_response("fail",$token_status);
		}
	}
	if( $config_param4 != $_POST['table_id'] ){
		$_SESSION["export_error"] = "Incorrect credentials";
		header("Location: /admin/databases/".$config_param1."/table/".$config_param4."/export?event=fail");exit;
	}
	$main_table_res = $mongodb_con->find_one($config_api_tables, ["_id" => $_POST['table_id'] ]);
	if( $main_table_res["status"] == "fail" || ( $main_table_res["status"] == "success" &&  $main_table_res["data"] == "" ) ){
		$_SESSION["export_error"] = "Table not found!";
		header("Location: /admin/databases/".$config_param1."/table/".$config_param4."/export?event=fail");exit;
	}else{
		$main_table = $main_table_res["data"];
		$s = json_decode($_POST["s"],true);
		$delimeter = $s["delimeter"];
		$titles = [];
		$fields = $main_table["schema"][ $_POST["selected_schema"] ]["fields"];
		foreach ($fields as $ij=>$jj) {
			$titles[] = $ij;
		}
		$filters = ["="=>'$eq',"!="=>'$ne', "<"=>'$lt', "<="=>'$lte', ">"=>'$gt', ">="=>'$gte'];
		$execution_time = 20;
		$start = time(); 
		while( true ){
			if( (time() - $start) >$execution_time ){
				//echo "<P>Time Over1</p>";
				break;
			}
			if( $s["t"] == "scan" ){
				$param = [
					'TableName' => $main_table['table'],
					'ReturnConsumedCapacity'=>"TOTAL",
					'Limit' => (int)$_POST['limit'],
					'ScanIndexForward' => ($s['sort']=="asc"?true:false),
				];
				try{      
					$res = $con->scan_raw($param);
					if( $res['status'] == "success" ){
						if( $res['data']['LastEvaluatedKey'] ){
							$last_key = $res['data']['LastEvaluatedKey'];
						}
						$data_export = $res['data']['Items'];
						if( !$data_export ){
							$data_export = [];
						}
					}else{
						$_SESSION["export_error"] = $res["error"];
						header("Location: /admin/databases/".$config_param1."/table/".$config_param4."/export?event=fail");exit;
					}
				}catch(Exception $e){
					$_SESSION["export_error"] = $e->getMessage();
					header("Location: /admin/databases/".$config_param1."/table/".$config_param4."/export?event=fail");exit;
				}
			}else{
				$cond = [];
				$options = ["limit"=>$_POST['limit'] ];
				if( $s["i"] == "i_p" ){
					$key = ["pk"=>$main_table['pk'], "sk"=>$main_table['sk']];
				}else{
					$key = $main_table['keys'][ $s['i'] ];
				}
	
				$cond = [];
				$filter_cond = [];
				$attribute_values = [];
				$attribute_names = [];
				$key_cond = "";
				$af = $key['pk']['field'];
				$ac = $s["a"]["c"];
				$at = ($key['pk']['type'] == "number"?"N":"S");
				$av = $s["a"]["v"];
				$av2 = $s["a"]["v2"];
				if( $av ){
					$attribute_names[ "#pk" ] = $af;
					$attribute_values[ ":pk" ] = [];
					$attribute_values[ ":pk" ][ $at ] = $av;
					if( $ac == "><" ){
						$attribute_values[ ":pk2" ] = [];
						$attribute_values[ ":pk2" ][ $at ] = $av2;
						$key_cond = "#pk BETWEEN :pk and :pk2";
					}else{
						$key_cond = "#pk ".$ac." :pk";
					}
				}
				if( $av && $key['sk']['enable'] ){
					$bf = $key['sk']['field'];
					$bc = $s["b"]["c"];
					$bt = ($key['sk']['type']== "number"?"N":"S");
					$bv = $s["b"]["v"];
					$bv2 = $s["b"]["v2"];
					if( $bv ){
						$attribute_names[ "#sk" ] = $bf;
						$attribute_values[ ":sk" ] = [];
						$attribute_values[ ":sk" ][ $bt ] = $bv;
						if( $bc == "><" ){
							$attribute_values[ ":sk2" ] = [];
							$attribute_values[ ":sk2" ][ $bt ] = $bv2;
							$key_cond .= " and #sk BETWEEN :sk and :sk2";
						}else{
							$key_cond .= " and #sk ".$bc." :sk";
						}
					}
				}
				$param = [
					'TableName'=>$main_table['table'],
					'ReturnConsumedCapacity'=>"TOTAL",
					'Limit'=>(int)$_POST['limit'],
					'ScanIndexForward'=>($s['sort']=="asc"?true:false),
					'KeyConditionExpression' => $key_cond,
					'ExpressionAttributeNames' => $attribute_names,
					'ExpressionAttributeValues' => $attribute_values,
				];
				if( $s['i'] != "i_p" ){
					$param['IndexName'] = $s['i'];
				}
				try{
					$res = $con->query_raw($param);
					if( $res['status'] == "success" ){
						if( $res['data']['LastEvaluatedKey'] ){
							$last_key = $res['data']['LastEvaluatedKey'];
						}
						$data_export = $res['data']['Items'];
						if( !$data_export ){
							$data_export = [];
						}
					}else{
						$_SESSION["export_error"] = $res["error"];
						header("Location: /admin/databases/".$config_param1."/table/".$config_param4."/export?event=fail");exit;
					}
				}catch(Exception $e){
					$_SESSION["export_error"] = $e->getMessage();
					header("Location: /admin/databases/".$config_param1."/table/".$config_param4."/export?event=fail");exit;
				}
			}
		}
		$exported_data = [];
		foreach ($data_export as $key => $value) {
			foreach ($fields as $field => $fn) {
				if($_POST["export_type"] == "csv"){
					$add_data = false;
					if( $fn["type"] == "_id" || $fn["type"] == "text" || $fn["type"] == "number" ){
						$add_data = true;
					}
				}else{
					$add_data = true;
				}
				if( $add_data ){
					if($value[$field]){
						$exported_data[$key][$field] =  ($value[$field]);
					}else{
						$exported_data[$key][$field] =  "";
					}
				}
			}
		}
		$export_filename = ($mongodb_con->clean_text($main_table["table"])).'_'.date("Ymd_His");
		if($_POST["export_type"] == "csv"){
			$export_path = "./tempfiles/" . $export_filename . ".csv";
		}else{
			$export_path = "./tempfiles/" . $export_filename . ".json";
		}
		$fp = fopen( $export_path, "w"); 
		if($_POST["export_type"] == "csv"){
			fputs($fp, implode($delimeter, $titles) . "\r\n" ); 
			foreach ($exported_data as $i=>$j) {
			 	fputs($fp, implode($delimeter, $j) . "\r\n" ); 
			}
			fclose($fp);
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename="'.$export_filename.'.csv";' );
			readfile($export_path);exit;
		}else{
			foreach($exported_data as $i=>$j){
				fwrite($fp, json_encode( $j ) . "\r\n" );
			}
			fclose($fp);
			header("Content-type: application/json");
			header('Content-Disposition: attachment; filename="'.$export_filename.'.json";' );
			readfile($export_path);exit;
		}
	}
}
/*Import*/
if($_POST['action'] == "import_dynamodb_data"){
	$config_debug = false;
	if($config_debug == false){ 
		$token_status = validate_new_token($_POST['security_token'],"database_dynamodb_import",$config_param4 );
		if( $token_status != "ok" ){
			if( $token_status == "Toomany Requests" ){
				$token_status = "Too Many Requests.Please Try After Sometime";
			}
			json_response("fail",$token_status);
		}
	}
	if( $config_param4 != $_POST['table_id'] ){
		json_response("fail", ["error_type" =>"dulipcates","error"=>"Incorrect credentials"]);
	}
	$main_table_res = $mongodb_con->find_one($config_api_tables, ["_id" => $_POST['table_id'] ]);
	if($main_table_res["status"] == "fail" ){
		json_response("fail",["error_type" =>"dulipcates","error"=>"Server Error " . $main_table_res["error"] ]);
	}
	if($main_table_res["data"] == "" ){
		json_response("fail",["error_type" =>"dulipcates","error"=>"Table not found!"]);
	}
	$main_table = $main_table_res["data"];
	if( sizeof( $_POST["data"] ) == 0 ){
		json_response("fail",["error_type" =>"dulipcates","error"=>"Please Enter File With Data"]);
	}
	$tablename = $main_table['_id'];
	$errors  = $fields = $records = $dulipicate_records = [];
	while( 1 == 1){
		for($rec=0;$rec<sizeof($_POST["data"]);$rec++){
			if( $rec>=sizeof($_POST["data"]) ){break;}
			$record = $_POST['data'][ $rec ];
			if( $record[ $main_table['pk']['field'] ] == "" ){
				$errors[ $rec ][ $main_table['pk']['field'] ] =  "Primary key value empty";
			}
			if( $main_table['pk']['type'] == "number" ){
				if( !is_numeric($record[ $main_table['pk']['field'] ]) ){
					if( strpos(".", $record[ $main_table['pk']['field'] ]) ){
						$record[ $main_table['pk']['field'] ] = (float)$record[ $main_table['sk']['field'] ];
					}else{
						$record[ $main_table['pk']['field'] ] = (float)$record[ $main_table['sk']['field'] ];
					}
				}
			}
		$key = [];
		$key[ $main_table['pk']['field'] ] = $record[ $main_table['pk']['field'] ];
		if( $main_table['sk']['enable'] ){
				if( $record[ $main_table['sk']['field'] ] == "" ){
					$errors[ $rec ][ $main_table['sk']['field'] ] =  "Sort key value empty";
				}
				if( $main_table['sk']['type'] == "number" ){
					if( !is_numeric($record[ $main_table['sk']['field'] ]) ){
						if( strpos(".", $record[ $main_table['sk']['field'] ]) ){
							$record[ $main_table['sk']['field'] ] = (float)$record[ $main_table['sk']['field'] ];
						}else{
							$record[ $main_table['sk']['field'] ] = (float)$record[ $main_table['sk']['field'] ];
						}
					}
				}
				$key[ $main_table['sk']['field'] ] = $record[ $main_table['sk']['field'] ];
			}
			$res = $con->get_item($main_table['table'], $key);
			if( $res['status'] == "success" ){
				if( $res['data']['Item'] ){
					$dulipicate_records[] = $rec;
					if( $_POST["dulipicate_check"] == "skip" ){
						$record['_status__'] = "skip";
					}
				}
			}
			$records[] = $record;
		}
		if( sizeof($errors) ){
			json_response("fail",["error_type" =>"server_errors", "record_wise_errors"=>$errors]);
		}
		if( $_POST["duplicate_check"] == "check" && sizeof($duplicate_records) >0 ){
			json_response("fail",["error_type" =>"dulipcates", "duplicate_records"=>$duplicate_records]);
		}
		$main_fields = $main_table["schema"];
		foreach( $_POST["fields"] as $i => $j ){
			unset($j["new_field"] );
			if( $j["insert"] == true || $j["key"] == "_id" ){
		  		unset($j["insert"]);
		  		$fields[ $i ] = $j;
			}
		};
        	$main_fields[$_POST["selected_schema"]]["fields"] = $fields;
        	$errors = [];
		foreach( $records as $field => $rec ){
			unset( $rec["_insert__"] );unset( $rec["_main_cnt__"] );
			if( $rec["_status__"] != "skip" ){
				unset( $rec["_status__"] );
				$params = [
						'TableName'=>$main_table['table'],
						'Item'=>$rec,
						'ReturnConsumedCapacity'=>"TOTAL"
					  ];
				$new_insert_res = $con->insert_raw($params);
				if( $new_insert_res['status'] == "success" ){
					$increment_rec = $mongodb_con->increment($config_api_tables, $main_table['_id'], "count", 1);
					if( $increment_rec['status'] == "fail" ){
						$error_log = [ "tablename" => $main_table['table'] , "page" => "Database Dynamodb Import" ,"url" => $request_uri , "user_id" => $_SESSION["user_id"] ,"event" => "increment error" , "error" => $increment_rec['error'] , "action" =>"import_mongodb_data","data" => $rec , "date" => date("d-m-Y H:i:s") ];
						$error_log_res = $user_data_con->insert($error_log_col, $error_log);
					}
				}else{
					$error_log = [ "tablename" => $main_table['table'] ,"page" => "Database Dynamodb Import" ,"url" => $request_uri , "user_id" => $_SESSION["user_id"] ,"event" => "Insert error" , "error" => $new_insert_res['error'] , "action" =>"import_mongodb_data","data" => $rec , "date" => date("d-m-Y H:i:s") ];
					$error_log_res = $user_data_con->insert($error_log_col, $error_log);
				}
			}
			//print_pre($new_insert_res);exit;
		}
	}
	$update_rec = $mongodb_con->update_one( $config_api_tables,["schema" => $main_fields], ["_id"=>$_POST['table_id'] ] );
	if($update_rec["status"] == "fail" ||  ($update_rec["status"] == "success" && $update_rec["data"]["matched_count"] != $update_rec["data"]["modified_count"] ) ){
		json_response("fail",$update_rec['error']);
	}
	json_response("success", "ok");
}
?>