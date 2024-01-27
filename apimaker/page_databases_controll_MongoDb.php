<?php

$db['details']['username'] = pass_decrypt($db['details']['username']);
$db['details']['password'] = pass_decrypt($db['details']['password']);


$con = new mongodb_connection( $db['details']['host'], $db['details']['port'], $db['details']['database'], $db['details']['username'], $db['details']['password'],$db['details']['authSource'], ($db['details']['tls']?true:false) );
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
function find_mongodb_fields_structure2($rec){
	$fields = [];
	$cnt= 0;
	foreach( $rec as $i=>$j ){
		$cnt++;
		$t = "text";
		if( gettype($j)== "integer" || gettype($j)== "double" ){$t = "number";}
		if( gettype($j)== "boolean" ){$t = "boolean";}
		if( gettype($j)== "array" ){
			if(array_keys($j) !== range(0, count($j) - 1)){
			    $t = "dict";
			}else{
			    $t = "list";
			}
		}
		$fields[ $i ] = [ "key"=>$i, "name"=>$i, "type"=>$t, "m"=>true, "order"=>$cnt, "sub"=>[] ];
		if( $t == "dict" ){
			$fields[ $i ]['sub'] = find_mongodb_fields_structure2($j);
		}
		if( $t == "list" ){
			$fields[ $i ]['sub'] = [];
			$fields[ $i ]['sub'][0] = find_mongodb_fields_structure2($j[0]);
		}
	}
	if( sizeof($fields) == 0 ){
		$fields['_id'] = [ "key"=>'_id', "name"=>'_id', "type"=>'text', "m"=>true, "order"=>1, "sub"=>[] ];
	}
	return $fields;
}
function find_mongodb_fields_structure( $recs ){
	$fields = [];
	foreach( $recs as $i=>$j ){
		$f = find_mongodb_fields_structure2( $j );
		$fields = array_replace_recursive( $fields, $f );
	}
	return $fields;
}
/*Manage*/

if( $_POST['action'] == "create_mongodb_collection" ){
	if( $_POST['app_id'] != $config_param1 ){
		json_response("fail", "Incorrect APP id");exit;
	}else if( $_POST['db_id'] != $config_param3 ){
		json_response("fail", "Incorrect DB id");exit;
	}

	if( $_POST['collection']== "" ){
		json_response("fail", "Need collection name");
	}else if( !preg_match("/^[a-z][a-z0-9]{3,35}$/", $_POST['collection'] ) ){
		json_response("fail","Collection name should be lowercase. no special chars and spaces");
	}
	$res = $con->create_index($_POST['collection'], ['t'=>1], ['sparse'=>true]);
	json_response($res);
}

if( $_POST['action'] == "save_table_mongodb" ){
	$config_debug = false;

	if( $_POST['app_id'] != $config_param1 ){
		json_response("fail", "Incorrect APP id");exit;
	}else if( $_POST['db_id'] != $config_param3 ){
		json_response("fail", "Incorrect DB id");exit;
	}

	if( $_POST['table']['db_id']== ""){
		json_response("fail", "Database id missing");exit;
	}else{
		$db_res = $mongodb_con->find_one($config_api_databases, ["_id"=>$_POST['table']['db_id']]);
		if( !$db_res['data'] ){
			json_response("fail","Database not found!");
		}else{
			$db = $db_res;
			if( $_POST['table']['table']== "" ){
				json_response("fail", "Enter Table Name");
			}else if( !preg_match("/^[A-Za-z0-9\-\_\.]{3,25}$/i", $_POST['table']['table'] ) ){
				json_response("fail","Table name From 5 to 25 characters in length, lowercase a-z 0-9 _ - . allowed. space is not allowed");
			}else if( $_POST['table']['des']== "" ){
				json_response("fail", "Enter Table Description");
			}else if( !preg_match("/^[A-Za-z0-9\-\_\s\.\ ]{3,50}$/i", $_POST['table']['des'] ) ){
				json_response("fail", "Table description From 5 to 50 characters in length, A-Z a-z 0-9 _ - . and spaces allowed.");
			}else{
				if( $_POST['table']['_id'] == "new" ){
					$cond = [
						"app_id"=>$_POST['app_id'], 
						"des" => $_POST['table']['table'], 
						"db_id"=>$_POST['table']['db_id'] 
					];
					$tables_res = $mongodb_con->find_one($config_api_tables, $cond);
					if( $tables_res['data'] ){
						json_response("fail", "Table already exists!");
					}else{
						unset($_POST['table']['_id']);
						$insert_data = [];
						$insert_data = $_POST['table'];
						$insert_data['app_id'] = $_POST['app_id'];
						$insert_data['des'] = ucwords($insert_data['des']);
						$insert_res = $mongodb_con->insert( $config_api_tables, $insert_data );
						if( $insert_res['status'] == "fail" ){
							json_response("fail", "Server Error.Please Try After Sometime");
						}else{
							json_response($insert_res);
						}
					}
				}else{
					$maintables_res = $mongodb_con->find_one($config_api_tables,[
						"app_id"=>$_POST['app_id'],
						"db_id"=>$_POST['db_id'],
						"_id"=>$_POST['table_id'] 
					]);
					if( !$maintables_res['data'] ){
						json_response("fail", "Table Details Missing!");
					}else{
						$table = $maintables_res['data'];
						$cond = [ 
							"_id"=> ["\$ne" =>$mongodb_con->get_id($table["_id"] ) ], 
							"des"=>$_POST['table']['table'], 
							"db_id"=>$_POST['table']['db_id'] 
						];
						$tables_res = $mongodb_con->find_one($config_api_tables, $cond);
						if( !$tables_res['data'] ){
							$data = [
								"table"		=> $_POST['table']['table'],
								"des"		=> ucwords($_POST['table']['des']),
								"schema" 	=> $_POST['table']['schema'],
								"keys" 		=> $_POST['table']['keys'],
								"pk"  		=> $_POST['table']['pk'],
								"sk" 		=> $_POST['table']['sk'],
							];
							$insert_res = $mongodb_con->update_one($config_api_tables, [
								"db_id"=>$_POST['db_id'],
								"_id"=> $_POST['table_id']
							], $data );
							if( $insert_res['status'] == "fail" ){
								json_response("fail", "Server Error.Please Try After Sometime");
							}else{
								json_response("success", $table["_id"] );
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

if( $_POST['action'] == "check_mongodb_source_collection_list" ){
	$res = $con->list_collections();
	json_response($res);
	exit;
}

if( $_POST['action'] == "check_mongodb_source_table" ){
	$config_debug = false;
	{
		$res 	= $con->list_indexes_raw( $_POST['table'] );
		if( $res['status'] == 'fail' ){
			json_response( "fail", $res['error'] );
		}
		$res2 	= $con->find( $_POST['table'], [], ["limit"=>10] );
		if( !isset($res2['data']) || sizeof($res2['data']) == 0 ){
			$fields = [ '_id'=>[ "key"=>'_id', "name"=>'_id', "type"=>'text', "m"=>true, "order"=>1, "sub"=>[] ] ];
		}else{
			$fields = find_mongodb_fields_structure( $res2['data'] );
		}
			if( $config_param4 != "new" ){
				$update_data = [
					"source_schema"=>[
						"schema"=>$res['data'],
						"last_checked"=>date("Y-m-d H:i:s")
					]
				];
				$res3 = $mongodb_con->update_one($config_api_tables,[
					"app_id"=>$_POST['app_id'],
					"db_id"=>$_POST['db_id'],
					"_id"=>$main_table['_id']
				],$update_data );
				if( $res3['status'] == "fail" ){
					json_response( "fail", $res3["error"] );
				}
			}
			json_response( "success", [
				"keys" => $res['data'],
				"fields" => $fields,
				"last_checked" => date("Y-m-d H:i:s")
			]);
	}
}

/*Import*/

if( $_POST["action"] == "import_mongodb_data" ){
	$config_debug = false;
	if( $config_param3 != $_POST['db_id'] ){
		json_response("fail", ["error_type" =>"error","error"=>"Incorrect DB id"]);
	}else if( $config_param5 != $_POST['table_id'] ){
		json_response("fail", ["error_type" =>"dulipcates","error"=>"Incorrect credentials"]);
	}else if( sizeof( $_POST["data"] ) == 0 ){
		json_response("fail",["error_type" =>"dulipcates","error"=>"Please Enter File With Data"]);
	}else{
		$main_table_res = $mongodb_con->find_one($config_api_tables, ["_id" => $_POST['table_id'] ]);
		if($main_table_res["status"] == "fail" ){
			json_response("fail",["error_type" =>"dulipcates","error"=>"Table not found!"]);
		}else if($main_table_res["data"] == "" ){
			json_response("fail",["error_type" =>"dulipcates","error"=>"Table not found!"]);
		}else{
			$main_table = $main_table_res["data"];
			$error  = $fields = [];
			$tablename = $main_table['table'];
			for($rec=0;$rec < sizeof($_POST["data"]);$rec++){
				if( $rec >=sizeof($_POST["data"]) ){break;}
				$record = $_POST['data'][ $rec ];
				$d_r_1 = [];
				for($rec=0;$rec < sizeof($_POST["data"]);$rec++){
    				if( $rec >=sizeof($_POST["data"]) ){break;}
    				$record = $_POST['data'][ $rec ];
    				$d_r_1 = [];
    				foreach( $_POST["fields"] as $f => $field ){
    					if( $field["type"] == "number" ){
						if( preg_match("/\./", $record[ $f ] ) ){
							$val____ = (float)$record[ $f ];
						}else{
							$val____ = (int)$record[ $f ];
						}
					}else if( $field["type"] == "text" ){
						$val____ = trim($record[ $f ]);
					}else{
						$val____ = ($record[ $f ]);
					}
					if( $f == "_id" && $record[$f] == "" ){
						$val____ = new MongoDB\BSON\ObjectID();
					}
					$record[ $f ] = $val____;
					if( $field["m"] == true && $field["insert"] == true){
	  					$d_r_1[ $f ] = $record[ $f ];
						if($val____ =='' ){
							$errors[ $rec ][ $f ] = "required!";
						}
					}
    				}
                            	$record['_status__'] = "done";
					$du_r = $con->find_one($tablename,$d_r_1);
					if($du_r["status"] == "success" && sizeof( $du_r["data"] ) != 0 ){
						$duplicate_records[] = $_POST["data"][$rec];
						if( $_POST["duplicate_check"] == "skip" ){
							$record['_status__'] = "skip";
						}
					}
				$records[] = $record;
    			}
    		}
			if( sizeof($errors) ){
				json_response("fail",["error_type" =>"server_errors", "record_wise_errors"=>$errors]);
			}else if( $_POST["duplicate_check"] == "check" && sizeof($duplicate_records) >0 ){
				json_response("fail",["error_type" =>"dulipcates", "duplicate_records"=>$duplicate_records]);
			}else{
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
						$new_insert_res = $con->insert( $tablename, $rec, "check" );
						if( $new_insert_res['status'] == "success" ){
					    	$increment_rec = $mongodb_con->increment($config_api_tables, $main_table['_id'], "count", 1);
							if( $increment_rec['status'] == "fail" ){
								$error_log                = [];
								$error_log["page"]        = "Database MongoDb Import";
								$error_log["url"]         = $request_uri;
								$error_log["user_id"]     = $_SESSION["user_id"];
								$error_log["event"]       = "increment error";
								$error_log["error"]       = $increment_rec['error'];
								$error_log["action"]      = "import_mongodb_data";
								$error_log["data"]        = $rec;
								$error_log["date"]        = date("d-m-Y H:i:s");
								$error_log_res = $con->insert($error_log_col, $error_log);
							}
						}else{
							$error_log                = [];
							$error_log["page"]        = "Database MongoDb Import";
							$error_log["url"]         = $request_uri;
							$error_log["user_id"]     = $_SESSION["user_id"];
							$error_log["event"]       = "Insert error";
							$error_log["error"]       = $new_insert_res['error'];
							$error_log["action"]      = "import_mongodb_data";
							$error_log["data"]        = $rec;
							$error_log["date"]        = date("d-m-Y H:i:s");
							$error_log_res = $con->insert($error_log_col, $error_log);
						}
					}
            	}
            	$update_rec = $mongodb_con->update_one( $config_api_tables,["schema" => $main_fields], ["_id"=>$_POST['table_id'] ] );
				if($update_rec["status"] == "fail" ||  ($update_rec["status"] == "success" && $update_rec["data"]["matched_count"] != $update_rec["data"]["modified_count"] ) ){
					json_response("fail",$update_rec['error']);
				}else{
					json_response("success", "ok");
				}
    		}
		}
	}
}
/*Export*/
if($_POST["action"] == "export_mongodb_data"){
	$config_debug = false;
	
	if( $config_param4 != $_POST['table_id'] ){
		$_SESSION["export_error"] = "Table not found!";
		header("Location: /databases/".$config_param1."/table/".$config_param4."/export?event=fail");exit;
	}else{
		$main_table_res = $mongodb_con->find_one($config_api_tables, ["_id" => $_POST['table_id'] ]);
		if($main_table_res["status"] == "fail" ){
			$_SESSION["export_error"] = "Table not found!";
			header("Location: /databases/".$config_param1."/table/".$config_param4."/export?event=fail");exit;
		}else if($main_table_res["data"] == "" ){
			$_SESSION["export_error"] = "Table not found!";
			header("Location: /databases/".$config_param1."/table/".$config_param4."/export?event=fail");exit;
		}else{
			$main_table = $main_table_res["data"];
			$filters = ["="=>'$eq',"!="=>'$ne', "<"=>'$lt', "<="=>'$lte', ">"=>'$gt', ">="=>'$gte'];
			$primary_search = bson_to_json(json_decode($_POST["primary_search"])  );
			$delimeter = $primary_search["delimeter"] ? $primary_search["delimeter"]:",";
			$cond = [];
			$options = ["limit"=>(int) $_POST['limit'] ];
			if( $_POST["search_index"] == "primary" ){
				$ac = $primary_search['c'];
				$av = $primary_search['v'];
				if( $av ){
					$av = $mongodb_con->get_id($av);
				}
				$av2 = $primary_search['v2'];
				if( $av2 ){
					$av2 = $mongodb_con->get_id($av2);
				}
				if( $av ){
					if( $ac == "=" ){
						$cond[ "_id" ] = $av;
					}else if( $ac == "><"){
						$cond[ "_id" ] = [];
						$cond[ "_id" ][ $filters['>='] ] = $av;
						$cond[ "_id" ][ $filters['<='] ] = $av2;
					}else{
						$cond[ "_id" ] = [];
						$cond[ "_id" ][ $filters[ $ac ] ] = $av;
					}
				}
				if( $_POST['last_key'] ){
					if( $_POST['primary_search']['sort']=="desc" ){
						$cond['_id'] = ['$lt'=>$mongodb_con->get_id($_POST['last_id']) ];
					}else{
						$cond['_id'] = ['$gt'=>$mongodb_con->get_id($_POST['last_id']) ];
					}
				}
				$s = [];
				$s[ "_id" ] = ($_POST['primary_search']['sort']=="desc"?-1:1);
				$options["sort"] = $s;

			}else{
				$options["hint"] = $_POST['search_index'];
				$sort = [];
				foreach( $_POST['index_search'] as $i=>$j ){
					$bv = $bv2 = "";
					$sort[ $j['name'] ] = ($j['sort']=="asc"?1:-1);
					if( $j['name'] == "_id" ){
						if( $j['v'] ){
							$bv = $mongodb_con->get_id( $j['v'] );
						}
						if( $j['v2'] ){
							$bv2 = $mongodb_con->get_id( $j['v2'] );
						}
					}else{
						if( $j['v'] ){
							$bv = find_field_type( $j['name'], $j["v"], $main_table['fields'] );
						}
						if( $j['v2'] ){
							$bv2 = find_field_type( $j['name'], $j["v2"], $main_table['fields'] );
						}
					}
					if( $bv ){
						if( $j['cond'] == "=" ){
							$cond[ $j['name'] ] = $bv;
						}else if( $j['cond'] == "><"){
							$cond[ $j['name'] ] = [];
							$cond[ $j['name'] ][$filters['>=']] = $bv;
							$cond[ $j['name'] ][$filters['<=']] = $bv2;
						}else{
							$cond[ $j['name'] ] = [];
							$cond[ $j['name'] ][ $filters[ $j['cond'] ] ] = $bv;
						}
					}
				}
				if( $_POST['skip'] ){
					$options['skip'] = (int)$_POST['skip'];
				}
				$options["sort"] = $sort;
			}
			try{
				$titles = [];
				$fields = $main_table["schema"][ $_POST["selected_schema"] ]["fields"];
				foreach ($fields as $ij=>$jj) {
					$titles[] = $ij;// str_replace($ij,$delimeter," ");
				}
				$exported_data = [];
				$data_export =$con->find($main_table['table'], $cond, $options);
				if( $data_export["status"] == "fail" ){
					json_response( "fail",$data_export["error"] );
				}else{
					if( sizeof($data_export["data"]) == 0 || $data_export["data"] == "" ){
						$data_export["data"] = [];
					}
					foreach ($data_export["data"] as $key => $value) {
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
			}catch(Exception $ex){
				$_SESSION["export_error"] = $e->getMessage();
				header("Location: /databases/".$config_param1."/table/".$config_param4."/export?event=fail");
				exit;
			}
		}
	}
}
/*Browse*/	
if( $_POST['action'] == "load_mongodb_records" ){
	if( $config_param3 != $_POST['db_id'] ){
		json_response("fail", "Incorrect Db Id");
	}
	if( $config_param5 != $_POST['table_id'] ){
		json_response("fail", "Incorrect Table Id");
	}else{
		$main_table_res = $mongodb_con->find_one($config_api_tables, [
			"db_id"=> $_POST['db_id'],
			"_id" => $_POST['table_id'] 
		]);
		if(!$main_table_res['data'] ){
			json_response("fail","Table not found!");
		}else{
			$main_table = $main_table_res['data'];
			$filters = ["="=>'$eq',"!="=>'$ne', "<"=>'$lt', "<="=>'$lte', ">"=>'$gt', ">="=>'$gte'];
			$primary_search = $_POST["primary_search"];
			$cond = [];
			$options = ["limit"=>$_POST['limit'] ];
			if( $_POST["search_index"] == "primary" ){
				$ac = $primary_search['c'];
				$av = $primary_search['v'];
				if( $av ){
					$av = $mongodb_con->get_id($av);
				}
				$av2 = $primary_search['v2'];
				if( $av2 ){
					$av2 = $mongodb_con->get_id($av2);
				}
				if( $av ){
					if( $ac == "=" ){
						$cond[ "_id" ] = $av;
					}else if( $ac == "><"){
						$cond[ "_id" ] = [];
						$cond[ "_id" ][ $filters['>='] ] = $av;
						$cond[ "_id" ][ $filters['<='] ] = $av2;
					}else{
						$cond[ "_id" ] = [];
						$cond[ "_id" ][ $filters[ $ac ] ] = $av;
					}
				}
				if( $_POST['last_key'] ){
					if( $_POST['primary_search']['sort']=="desc" ){
						$cond['_id'] = ['$lt'=>$mongodb_con->get_id($_POST['last_id']) ];
					}else{
						$cond['_id'] = ['$gt'=>$mongodb_con->get_id($_POST['last_id']) ];
					}
				}
				$s = [];
				$s[ "_id" ] = ($_POST['primary_search']['sort']=="desc"?-1:1);
				$options["sort"] = $s;

			}else{
				$options["hint"] = $_POST['search_index'];
				$sort = [];
				foreach( $_POST['index_search'] as $i=>$j ){
					$bv = $bv2 = "";
					$sort[ $j['name'] ] = ($j['sort']=="asc"?1:-1);
					if( $j['name'] == "_id" ){
						if( $j['v'] ){
							$bv = $mongodb_con->get_id( $j['v'] );
						}
						if( $j['v2'] ){
							$bv2 = $mongodb_con->get_id( $j['v2'] );
						}
					}else{
						if( $j['v'] ){
							$bv = find_field_type( $j['name'], $j["v"], $main_table['fields'] );
						}
						if( $j['v2'] ){
							$bv2 = find_field_type( $j['name'], $j["v2"], $main_table['fields'] );
						}
					}
					if( $bv ){
						if( $j['cond'] == "=" ){
							$cond[ $j['name'] ] = $bv;
						}else if( $j['cond'] == "><"){
							$cond[ $j['name'] ] = [];
							$cond[ $j['name'] ][$filters['>=']] = $bv;
							$cond[ $j['name'] ][$filters['<=']] = $bv2;
						}else{
							$cond[ $j['name'] ] = [];
							$cond[ $j['name'] ][ $filters[ $j['cond'] ] ] = $bv;
						}
					}
				}
				if( $_POST['skip'] ){
					$options['skip'] = (int)$_POST['skip'];
				}
				$options["sort"] = $sort;
			}
			try{
				$records_list = $con->find( $main_table['table'], $cond, $options );
				if( !isset($records_list['data']) || $records_list['status'] == "fail" ){
					json_response( "fail", $records_list["error"] );
				}else{
					json_response("success",[
						"records"=>$records_list['data'], 
						"c"=>$cond, 
						"o"=>$options
					]);
				}
			}catch(Exception $ex){
				json_response("fail", $ex->getMessage());
			}
		}
	}
	exit;
}

if( $_POST['action'] == "update_record" ){
	$config_debug = false;
	if( $config_param1 != $_POST['app_id'] ){
		json_response("fail", "Incorrect App Id");
	}
	if( $config_param3 != $_POST['db_id'] ){
		json_response("fail", "Incorrect Db Id");
	}
	if( $config_param5 != $_POST['table_id'] ){
		json_response("fail", "Incorrect credentials");
	}else{
		$main_table_res = $mongodb_con->find_one( $config_api_tables, [
			"db_id"=> $_POST['db_id'],
			"_id" => $_POST['table_id'] 
		] );
		if( !$main_table_res['data'] ){
			json_response("fail","Table not found!");
		}else{
			$main_table = $main_table_res['data'];
			if($_POST['record_id']  == "new"){
				if( $_POST["record"]["_id"]){
					if(!preg_match("/^[a-f0-9]{24}$/", $_POST["record"]["_id"] ) ){
						json_response("fail", "_id is not mongodb format" );
					}
				}else{
					unset($_POST["record"]["_id"] );
				}
				$res = $con->insert( $main_table["table"], $_POST['record'],"check" );
				if( $res['status'] == "fail" ){
					json_response("fail", $res['error'] );
				}else{
					$record_id = $res["inserted_id"];
					$res = $mongodb_con->increment($config_api_tables, $main_table['_id'], "count", 1);
					if( $res['status']=="fail" ){
						json_response("fail", $res['error'] );
					}
				}
			}else{
				$record_id = $_POST['record_id'];
				$main_rec = $con->find_one( $main_table["table"],["_id"=> $record_id ] );
				if( !$main_rec['data'] ){
					json_response("fail", $main_rec["error"] );
				}else{
					unset($_POST["record"]["_id"] );
					$rec2 = $con->update_one( $main_table["table"], ["_id"=>$record_id ], $_POST['record'] );
					if( $rec2['status'] == "fail" ){
						json_response("fail", $rec2["error"] );
					}
				}
			}
			$rec = $con->find_one( $main_table["table"],["_id"=> $record_id ] );
			if( $rec['status'] == "fail" ){
				json_response( "fail", $rec["error"] );
			}else{
				json_response( "success", $rec["data"] );
			}
		}
	}
}
if($_POST['action'] == "delete_record_multiple"){
	$config_debug = false;
	if( $config_param1 != $_POST['app_id'] ){
		json_response("fail", "Incorrect App Id");
	}
	if( $config_param3 != $_POST['db_id'] ){
		json_response("fail", "Incorrect Db Id");
	}
	if( $config_param5 != $_POST['table_id'] ){
		json_response("fail", "Incorrect credentials");
	}
	$table_res = $mongodb_con->find_one($config_api_tables, ["_id"=>$_POST['table_id'] ]);
	if( !$table_res['data'] ){
		json_response("fail","Table not found!");
	}
	$table = $table_res['data'];
	$tablename  = $table['table'];
	foreach($_POST["record"] as $index => $rec){
		$res = $con->delete_one( $table['table'], ["_id"=>$rec["_id"] ] );
		if( $res['status'] == "fail" ){
			json_response("fail", "Server Error ".$res["error"]);
		}
		$increment_res = $mongodb_con->increment($config_api_tables, $table['_id'], "count", -1);
		if( !$increment_res ){
			json_response("fail", "Server Error ".$increment_res["error"]);
		}
	}
	json_response("success","ok");
}
if( $_POST['action'] == "delete_record" ){
	$config_debug = false;
	if( $config_param1 != $_POST['app_id'] ){
		json_response("fail", "Incorrect App Id");
	}
	if( $config_param3 != $_POST['db_id'] ){
		json_response("fail", "Incorrect Db Id");
	}
	if( $config_param5 != $_POST['table_id'] ){
		json_response("fail", "Incorrect credentials");
	}
	$table_res = $mongodb_con->find_one($config_api_tables,["_id"=>$_POST['table_id'] ]);
	if( !$table_res['data'] ){
		json_response("fail","Table not found!");
	}
	$table = $table_res['data'];
	$res = $con->delete_one( $table['table'], ["_id"=>$_POST['record_id'] ] );
	if( $res['status']=="fail" ){
		json_response("fail", "Server Error ".$res["error"]);
	}
	$increment_res = $mongodb_con->increment($config_api_tables, $table['_id'], "count", -1);
	if( $increment_res['status'] == "fail" ){
		json_response("fail", "Server Error ".$increment_res["error"]);
	}
	json_response("success","ok");
}
if( $config_param4 == "table" && $config_param5 == "new" ){
	$table = [
		"_id"    => "new",
		"app_id"  => $config_param1,
		"db_id"  => $config_param3,
		"des"	 => "",
		"table"	 => "",
		"keys"	 => [],/*["a"=>["field"=>"","order"=>""], "b"=>["field"=>"","order"=>"", "m"=>false], "type"=>"index/sparse/unique"]*/
		"f_n"	 => ["_id", "f1", "f2"],
		"schema" => [
			"default"=> [
				"name"		=> "Default",
				"fields" 	=> [
					"_id"=> ["key"=>"_id", "name"=>"_id", "des"=>"Primary ID", "type"=> "text", "m"=> true, "order"=> 0],
					"f1" => ["key"=>"f1", "name"=>"f1", "des"=>"Name", "type"=> "text", "m"=> true, "order"=> 1],
					"f2" => ["key"=>"f2", "name"=>"f2", "des"=>"Mobile", "type"=> "number", "m"=> true, "order"=> 2],
			   ]
			]
		]
	];
}else if( $config_param4 == "table" && $config_param5 ){
	if( !$mongodb_con->is_id_valid( $config_param5 ) ){
		echo404("Incorrect URL!");
	}
	$table_res = $mongodb_con->find_one($config_api_tables, ["_id"=>$config_param5]);
	if( !$table_res['data'] ){
		echo404("Table Not Found!");
	}else{
		$table = $table_res['data'];		
		$table_rec_cnt = $con->count($table["table"],[],[] );
		if($table_rec_cnt["status"] == "fail"){
			echo404("count fail: " . $table_rec_cnt['error']);
		}else{
			$total_cnt = (int)$table_rec_cnt['data'];
		}
	}
}
