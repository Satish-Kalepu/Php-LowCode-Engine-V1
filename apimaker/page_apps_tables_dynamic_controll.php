<?php

if( $_POST['action'] == "get_dynamic_tables" ){
	$t = validate_token("get_dynamic_tables.". $config_param1, $_POST['token']);
	if( $t != "OK" ){
		json_response("fail", $t);
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
		'app_id'=>$config_param1
	],[
		'sort'=>['table'=>1],
		'limit'=>200,
		'projection'=>[
			'schema'=>false,
			'keys'=>false
		]
	]);
	json_response($res);
	exit;
}

if( $_POST['action'] == "delete_dynamic_table" ){
	$t = validate_token("deletedynamic_table". $config_param1 . $_POST['dynamic_table_id'], $_POST['token']);
	if( $t != "OK" ){
		json_response("fail", $t);
	}
	if( !preg_match("/^[a-f0-9]{24}$/i", $_POST['dynamic_table_id']) ){
		json_response("fail", "ID incorrect");
	}
	$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
		"app_id"=>$config_param1,
		'_id'=>$_POST['dynamic_table_id']
	]);
	if( !$res['data'] ){
		$table = $res['data'];
		json_response("fail", "Table not found");
	}
	$res = $mongodb_con->delete_one( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
		"app_id"=>$config_param1,
		'_id'=>$_POST['dynamic_table_id']
	]);
	if( $res['status'] == "success" ){
		$res2 = $mongodb_con->drop_collection( $config_global_apimaker['config_mongo_prefix'] . "_dt_" . $_POST['dynamic_table_id'] );
		if( $res2['status'] != "success" ){
			json_response("fail", "Table metadata deleted but dataset deletion failed\n" . $res2['error']);
		}
	}
	json_response( $res );
}

if( $_POST['action'] == "create_table_dynamic" ){
	if( $_POST['app_id'] != $config_param1 ){
		json_response("fail", "Incorrect URL");
	}
	if( !preg_match("/^[a-z0-9\.\-\_\ ]{3,25}$/i", $_POST['new_table']['table']) ){
		json_response("fail", "Name incorrect");
	}
	if( !preg_match("/^[a-z0-9\!\@\%\^\&\*\.\-\_\'\"\n\r\t\ ]{5,250}$/i", $_POST['new_table']['des']) ){
		json_response("fail", "Description incorrect");
	}
	$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
		'app_id'=>$_POST['app_id'],
		'name'=>$_POST['new_table']['table']
	]);
	if( $res['data'] ){
		json_response("fail", "Already exists");
	}
	$res = $mongodb_con->insert( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
		"app_id"=>$config_param1,
		"table"=>$_POST['new_table']['table'],
		"des"=>$_POST['new_table']['des'],
		"created"=>date("Y-m-d H:i:s"),
		"updated"=>date("Y-m-d H:i:s"),
	]);
	if( $res['status'] == "success" && $res['inserted_id'] ){
		$resc = $mongodb_con->create_collection( $config_global_apimaker['config_mongo_prefix'] . "_dt_" . $res['inserted_id'] );
		json_response( $resc );
	}
	json_response($res);
	exit;
}

if( $config_param3 ){
	if( !preg_match("/^[a-f0-9]{24}$/", $config_param3) ){
		echo404("Incorrect Table ID");
	}
	if( $config_param3 == "new" ){
		echo "unhandled";
		exit;
	}else{
		$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
			'app_id'=>$app['_id'],
			'_id'=>$config_param3
		]);
		if( !$res['data'] ){
			json_response("fail", "Table not found");
		}
		$table = $res['data'];
		//print_pre( $table );exit;

		$dynamic_table_name = $config_global_apimaker['config_mongo_prefix'] . "_dt_" . $table["_id"];

		$total_cnt_res = $mongodb_con->count( $dynamic_table_name,[],[] );
		if( $total_cnt_res["status"] == "fail"){ echo404("Server Error ".$total_cnt_res['error'] );exit; }
		$total_cnt = $total_cnt_res["data"];
		$indexeres = $mongodb_con->list_indexes_raw( $dynamic_table_name );
		$indexes = $indexres['data'];
		$m_t = $table['des'];
		if( $config_param4 == "manage" ){
			$m_t .= " - Manage";
		}else if( $config_param4 == "indexes" ){
			$m_t .= " - Indexes";
		}else if( $config_param4 == "export" ){
			$m_t .= " - Export";
		}else if( $config_param4 == "import" ){
			$m_t .= " - Import";
		}else{
			$m_t .= " - Browse";
		}
		$meta_title = "Dynamic Table - " . $m_t;

		if( $_POST['action'] == "save_table_dynamic" ){

			if( $_POST['app_id'] != $config_param1 ){
				json_response("fail", "Incorrect APP id");exit;
			}else if( $_POST['table_id'] != $config_param3 ){
				json_response("fail", "Incorrect Table id");exit;
			}

			{
				$cond = [
					"app_id"=>$_POST['app_id'],
					"_id"=> [ "\$ne" =>$mongodb_con->get_id($table["_id"]) ],
					"table"=>$_POST['table']['table'],
				];
				$t2res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", $cond);
				if( $t2res['data'] ){
					json_response("fail", "Table with same description already exists!");
				}else{
					if( $_POST['table']['table']== "" ){
						json_response("fail", "Enter Table Name");
					}else if( !preg_match("/^[A-Za-z0-9\-\_\.]{3,25}$/i", $_POST['table']['table'] ) ){
						json_response("fail","Table name From 5 to 25 characters in length, lowercase a-z 0-9 _ - . allowed. space is not allowed");
					}else if( $_POST['table']['des']== "" ){
						json_response("fail", "Enter Table Description");
					}else if( !preg_match("/^[A-Za-z0-9\-\_\s\.\ ]{3,50}$/i", $_POST['table']['des'] ) ){
						json_response("fail", "Table description From 5 to 50 characters in length, A-Z a-z 0-9 _ - . and spaces allowed.");
					}else{
						$data = [
							"table"		=> $_POST['table']['table'],
							"des"		=> ucwords($_POST['table']['des']),
							"schema" 	=> $_POST['table']['schema'],
						];
						$res = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
							"app_id"=>$_POST['app_id'],
							"_id"=> $_POST['table_id']
						], $data );
						json_response( $res );
					}
				}
			}
			exit;
		}

		if( $_POST['action'] == "table_dynamic_drop_index" ){
			if( $_POST['app_id'] != $config_param1 ){
				json_response("fail", "Incorrect APP id");exit;
			}else if( $_POST['table_id'] != $config_param3 ){
				json_response("fail", "Incorrect Table id");exit;
			}

			$keys_list = (isset($table['keys_list'])?($table['keys_list']??[]):[]);
			foreach( $keys_list as $i=>$j ){
				if( $j['name'] == $_POST['index'] ){
					array_splice($keys_list,$i,1);
				}
			}
			$keys = [];
			foreach( $keys_list as $i=>$j ){
				$k = [];
				foreach( $j['keys'] as $ki=>$kd ){
					$k[ $kd['name'] ] = ($kd['sort']=="dsc"?-1:1);
				}
				$keys[ $j['name'] ] = [
					'keys'=>$k,
					'unique'=>($_POST['new_index']['unique']?true:false)
				];
			}

			$table_res = $mongodb_con->drop_index( $dynamic_table_name, $_POST['index'] );
			if( $table_res['status'] == 'fail' ){
				json_response("fail", "Dropping index failed on table\n" . $table_res['error']);
			}

			$resu = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
				'app_id'  =>$_POST['app_id'],
				'_id'=>$_POST['table_id'],
			], [
				'keys_list'=>$keys_list,
				'keys'=>$keys
			]);
			json_response($resu);

			exit;
		}

		if( $_POST['action'] == "table_dynamic_create_index" ){
			if( $_POST['app_id'] != $config_param1 ){
				json_response("fail", "Incorrect APP id");exit;
			}else if( $_POST['table_id'] != $config_param3 ){
				json_response("fail", "Incorrect Table id");exit;
			}
			{
				// print_pre( $_POST['new_index'] );
				// print_pre( $table );
				// print_pre( $indexes );
				if( !preg_match("/^[a-z][a-z0-9\-\_\.]{1,90}$/i", $_POST['new_index']['name']) ){
					json_response("fail", "Index name: " . $_POST['new_index']['name'] . ": incorrect format");
				}
				$keys = [];
				foreach( $_POST['new_index']['keys'] as $k=>$j ){
					if( !preg_match("/^[a-z][a-z0-9\-\_]{1,90}$/i", $j['name']) ){
						json_response("fail","Field name: " . $j['name'] . ": incorrect format");
					}
					$keys[ $j['name'] ] = ($J['sort']=="dsc"?-1:1);
				}
				$ops = [
					'sparse'=>true,
					'name'=>$_POST['new_index']['name']
				];
				if( $_POST['new_index']['unique'] ){
					$ops['unique'] = true;
				}
				$resind = $mongodb_con->create_index( $dynamic_table_name, $keys, $ops );
				if( $resind['status'] != "success" ){
					json_rsponse($resind);
				}
				$keys_list = isset($table['keys_list'])?($table['keys_list']??[]):[];
				$keys_list[] = [
					'name'=>$_POST['new_index']['name'], 
					'keys'=>$_POST['new_index']['keys'],
					'unique'=>($_POST['new_index']['unique']?true:false)
				];
				$keys = [];
				foreach( $keys_list as $i=>$j ){
					$k = [];
					foreach( $j['keys'] as $ki=>$kd ){
						$k[ $kd['name'] ] = ($kd['sort']=="dsc"?-1:1);
					}
					$keys[ $j['name'] ] = [
						'keys'=>$k,
						'unique'=>($_POST['new_index']['unique']?true:false)
					];
				}
				$resu = $mongodb_con->update_one( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
					'app_id'  =>$_POST['app_id'],
					'_id'=>$_POST['table_id'],
				], [
					'keys_list'=>$keys_list,
					'keys'=>$keys
				]);
				json_response( $resu );
			}
			exit;
		}

		if( $_POST['action'] == "copy_table" ){	
			$_POST['name'] = trim($_POST['name']);
			if( !$_POST['name'] ){
				json_response("fail", "Name Missing");
			}
			if( trim($_POST['name']) == trim($tables['table']) ){
				json_response("fail", "Same Name");
			}
			$table_res2 = $mongodb_con->find_one($config_table_name, ["_id"=>['$ne'=>$_POST['_id']],"table"=>$_POST['name'] ]);
			if( $table_res2["status"] == "fail"){
				json_response( "fail" , "Server Error ".$table_res2['error'] );
			} 
			if( sizeof( $table_res2["data"] ) != 0  ){
				json_response("success", "Table with same description already exists!");
			}
			$tables['table'] = trim($_POST['name']);
			$tables['des'] = $tables['des'] . " copied from " . $tables['table'];
			unset($tables['_id']);
			$insert_id = $mongodb_con->insert( $config_table_name, $tables);
			if($insert_id["status"] == "fail"){
				json_response("fail","Server Error ".$insert_id["error"]  );
			}
			json_response("success",$insert_id["data"]);
		}
		/*Browse*/
		if( $_POST['action'] == "table_dynamic_load_records" ){
			$filters = ["="=>'$eq',"!="=>'$ne', "<"=>'$lt', "<="=>'$lte', ">"=>'$gt', ">="=>'$gte'];
			try{
				$cond = [];
				$options = [ "limit" => (int)$_POST['limit'] ];
				if( $_POST["search_index"] == "primary" ){
					$ac = $_POST["primary_search"]["cond"];
					$av = $_POST["primary_search"]["value"];
					if( $av ){
						$av = $mongodb_con->get_id($av);
					}
					$av2 = $_POST["primary_search"]["value2"];
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
					if( $_POST['last_id'] ){
						if( $_POST["primary_search"]['sort']=="desc" ){
							$cond['_id'] = ['$lt'=>$mongodb_con->get_id($_POST['last_id']) ];
						}else{
							$cond['_id'] = ['$gt'=>$mongodb_con->get_id($_POST['last_id']) ];
						}
					}
					$s = [];
					$s[ "_id" ] = ($_POST["primary_search"]['sort']=="desc"?-1:1);
					$options["sort"] = $s; 
				}else{
					$options["hint"] = $_POST['search_index'];
					$s = [];
					foreach( $_POST["index_search"] as $i=>$j ){
						$af = $j['field'];
						$ac = $j["cond"];
						$av = $j["value"];
						if( $av && $af == '_id' ){
							$av = $mongodb_con->get_id($av);
						}
						$av2 = $j["value2"];
						if( $av2 && $af == '_id' ){
							$av2 = $mongodb_con->get_id($av2);
						}
						if( $av ){
							if( $ac == "=" ){
								$cond[ $af ] = $av;
							}else if( $ac == "><"){
								$cond[ $af ] = [];
								$cond[ $af ][ $filters['>='] ] = $av;
								$cond[ $af ][ $filters['<='] ] = $av2;
							}else{
								$cond[ $af ] = [];
								$cond[ $af ][ $filters[ $ac ] ] = $av;
							}
							$s[ $af ] = ($j['sort']=="desc"?-1:1);
						}
					}
					$options["sort"] = $s;
				}
				$records_list =$mongodb_con->find( $dynamic_table_name, $cond, $options);
				if($records_list["status"] == "fail" ){
					json_response("fail","Server Error While Finding Record: ". $records_list['error'] );
				}
				if( $records_list["data"] == "" ){
					$records_list["data"] = [];
				}
				json_response("success",["records" => $records_list["data"], "c" => $cond, "o" => $options]);
			}catch(Exception $e){
				json_response("fail",$e->getMessage() );
			}
		}
		if( $_POST['action'] == "table_dynamic_update_record" ){
			if( $_POST['record'] == "" ){
				json_response("fail", "Please type data");
			}
			$data = $_POST['record'];
			//$er = validate_json($data);
			if( !$data['_id'] ){
				$res = $mongodb_con->insert( $dynamic_table_name, $data );
				$data['_id'] = (string)$res['inserted_id'];
			}else{
				$res = $mongodb_con->find_one( $dynamic_table_name, ['_id'=>$data['_id']] );
				if( $res['data'] ){
					$id = $data['_id'];
					unset($data['_id']);
					$res = $mongodb_con->update_one( $dynamic_table_name, ['_id'=>$id], ['$set'=>$data] );
					$data['_id'] = $id;
				}else{
					$res = $mongodb_con->insert( $dynamic_table_name, $data );
					$data['_id'] = (string)$res['inserted_id'];
				}
			}
			$res['record'] = $data;
			json_response($res);
			exit;
		}
		if($_POST['action'] == "table_dynamic_delete_record"){
			$res = $mongodb_con->delete_one( $dynamic_table_name, ["_id"=>$_POST['record_id'] ] );
			if( $res["status"] == "fail"){
				json_response( "fail" , "Server Error ".$res['error'] );
			}
			json_response("success","ok");
		}
		if( $_POST['action'] == "table_dynamic_delete_record_multiple" ){
			{
				foreach($_POST["record"] as $index => $_id ){
					$res = $mongodb_con->delete_one($dynamic_table_name, ["_id"=>$_id ] );
					if($res == false){
						json_response("fail", "Server Error");
					}
				}
				json_response("success","ok");
			}
		}
		/*Export*/
		if($_POST["action"] == "export_dynamic_data"){
			$config_debug = false;
			if($config_debug == false){ 
				$token_status = validate_new_token($_POST['security_token'],"table_dynamic_export",$config_param1 );
				if( $token_status != "ok" ){
					if( $token_status == "Toomany Requests" ){
						$token_status = "Too Many Requests.Please Try After Sometime";
					}
					json_response("fail",$token_status);
				}
			}
			$table_res = $mongodb_con->find_one($config_table_name, ["_id"=>$_POST['table_id']] );
			if( $table_res["status"] == "fail"){
				$_SESSION["export_error"] = "Server Error ".$table_res['error'];
				header("Location: /admin/tables_dynamic/".$config_param1."/export?event=fail");exit;
			} 
			if( $table_res["data"]  == ""  ){
				$_SESSION["export_error"] = "Table Not Found!";
				header("Location: /admin/tables_dynamic/".$config_param1."/export?event=fail");exit;
			}
			$main_table = $table_res["data"];
			$cond = [];
			$options = ["limit"=>(int)$_POST['limit'] ];
			$s =  json_decode($_POST["s"],true);
			$keys = $table["indexes"][ $s["i"] ];
			if( $s["i"] == "i_p" ){
				$ac = $s["a"]["c"];
				$av = $s["a"]["v"];
				if( $av ){
					$av = $mongodb_con->get_id($av);
				}
				$av2 = $s["a"]["v2"];
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
				$s1 = [];
				$s1[ "_id" ] = ($s['sort']=="desc"?-1:1);
				$options["sort"] = $s1; 
			}else{
				$options["hint"] = $_POST['s']['i'];
				$ac = $s["a"]["c"];
				$bc = $s["b"]["c"];
				$af = $s['a']["f"];
				$bf = $s['b']["f"];
				if( $s["a"]["v"] ){
					$av = find_field_type( $af, $s["a"]["v"], $table['fields'] );
				}
				if( $s["a"]["v2"] ){
					$av2 = find_field_type( $af, $s["a"]["v2"], $table['fields'] );
				}
				if( $av ){
							if( $ac == "=" ){
								$cond[ $af ] = $av;
							}else if( $ac == "><"){
								$cond[ $af ] = [];
								$cond[ $af ][$filters['>=']] = $av;
								$cond[ $af ][$filters['<=']] = $av2;
							}else{
								$cond[ $af ] = [];
								$cond[ $af ][$filters[ $ac ]] = $av;
							}
				}

				if( $bv && $bf ){
					if( $s["b"]['f'] == "_id" ){
						if( $s["b"]["v"] ){
							$bv = $mongodb_con->get_id($s["b"]["v"]);
						}
						if( $s["b"]["v2"] ){
							$bv2 = $mongodb_con->get_id($s["b"]["v2"]);
						}
					}else{
						if( $s["b"]["v"] ){
							$bv = find_field_type( $bf, $s["b"]["v"], $table['fields'] );
						}
						if( $s["b"]["v2"] ){
							$bv2 = find_field_type( $bf, $s["b"]["v2"], $table['fields'] );
						}
					}
					if( $bv ){
						if( $bc == "=" ){
							$cond[ $bf ] = $bv;
						}else if( $bc == "><"){
							$cond[ $bf ] = [];
							$cond[ $bf ][$filters['>=']] = $bv;
							$cond[ $bf ][$filters['<=']] = $bv2;
						}else{
							$cond[ $bf ] = [];
							$cond[ $bf ][$filters[ $bc ]] = $bv;
						}
					}
				}
				$s = [];
				if( $bf ){
					$s[ $af ] = 1;
					$s[ $bf ] = ($s['sort']=="desc"?-1:1);
				}else{
					$s[ $af ] = ($s['sort']=="desc"?-1:1);
				}
				$options["sort"] = $s;
			}
			$delimeter = $s["delimeter"];
			$titles = [];
			$fields = $main_table["fields"];
			foreach ($fields as $ij=>$jj) {
				$titles[] = $ij;// str_replace($ij,$delimeter," ");
			}
			$exported_data = [];
			$data_export = $user_data_con->find($main_table['_id'], $cond, $options);
			if( $data_export["status"] == "fail"){
				$_SESSION["export_error"] = "Server Error ".$data_export['error'];
				header("Location: /admin/tables_dynamic/".$config_param1."/export?event=fail");exit;
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
			unset( $_SESSION["export_error"] );
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
		/*Import*/
		if($_POST["action"] == "import_dynamic_data"){
			$config_debug = false;
			if($config_debug == false){ 
				$token_status = validate_new_token($_POST['security_token'],"table_dynamic_import",$config_param1 );
				if( $token_status != "ok" ){
					if( $token_status == "Toomany Requests" ){
						$token_status = "Too Many Requests.Please Try After Sometime";
					}
					json_response("fail",$token_status);
				}
			}
			if( $config_param1 != $_POST['table_id'] ){
				json_response("fail", ["error_type" =>"dulipcates","error"=>"Incorrect credentials"]);
			}

			foreach( $_POST["fields"] as $i => $j ){
				unset($j["new_field"] );
				if( $j["insert"] == true || $j["key"] == "_id" ){
			  		unset($j["insert"]);
			  		$fields[ $i ] = $j;
				}
			};
			//print_pre($fields);exit;
			$errors  = $fields = $records = [];
			while( 1 == 1){
				for($rec=0;$rec<sizeof($_POST["data"]);$rec++){
					if( $rec>=sizeof($_POST["data"]) ){break;}
					$record = $_POST['data'][ $rec ];
					$cnt = 0;
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
					$du_r = $user_data_con->find_one($dynamic_table_name,$d_r_1);
					if($du_r["status"] == "success" && sizeof( $du_r["data"] ) != 0 ){
						$duplicate_records[] = $record;
						if( $_POST["duplicate_check"] == "skip" ){
							$record['_status__'] = "skip";
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
				foreach( $_POST["fields"] as $i => $j ){
					unset($j["new_field"] );
					if( $j["insert"] == true || $j["key"] == "_id" ){
				  		unset($j["insert"]);
				  		$fields[ $i ] = $j;
					}
				};
				$errors = [];
				$error_log_col = "error_log";	
				
				$update_rec = $mongodb_con->update_one( $config_table_name,["fields" => $fields], ["_id"=>$_POST['table_id'] ] );
				if($update_rec["status"] == "fail" ||  ($update_rec["status"] == "success" && $update_rec["data"]["matched_count"] != $update_rec["data"]["modified_count"] ) ){
					json_response("fail",$update_rec['error']);
				}
				foreach( $records as $field => $rec2 ){
					unset( $rec2["_insert__"] );unset( $rec2["_main_cnt__"] );
					if( $rec2["_status__"] != "skip" ){
						unset( $rec2["_status__"] );
						if( $rec2["duplicate_check"] == "check" ){
							$new_insert_res = $user_data_con->insert( $dynamic_table_name, $rec2, "check" );
						}else if( $rec2["duplicate_check"] == "replace" ){
							$new_insert_res = $user_data_con->insert( $dynamic_table_name, $rec2, "update" );
						}else{
							$new_insert_res = $user_data_con->insert( $dynamic_table_name, $rec2 );
						}	
						if( $new_insert_res['status'] == "success" ){
							$increment_rec = $mongodb_con->increment($config_table_name, $main_table['_id'], "count", 1);
							if( $increment_rec['status'] == "fail" ){
								$error_log = [ "tablename" => $dynamic_table_name , "page" => "Database MongoDb Import" ,"url" => $request_uri , "user_id" => $_SESSION["user_id"] ,"event" => "increment error" , "error" => $increment_rec['error'] , "action" =>"import_mongodb_data","data" => $rec2 , "date" => date("d-m-Y H:i:s") ];
								$error_log_res = $user_data_con->insert($error_log_col, $error_log);
							}
							
						}else{
							$error_log = [ "tablename" => $dynamic_table_name ,"page" => "Database MongoDb Import" ,"url" => $request_uri , "user_id" => $_SESSION["user_id"] ,"event" => "Insert error" , "error" => $new_insert_res['error'] , "action" =>"import_mongodb_data","data" => $rec2 , "date" => date("d-m-Y H:i:s") ];
							$error_log_res = $user_data_con->insert($error_log_col, $error_log);
						}
					}
				}
				json_response("success", "ok");
			}
		}
	}
}



