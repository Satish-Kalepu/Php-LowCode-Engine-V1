<?php

$config_api_databases = $config_global_apimaker['config_mongo_prefix'] . "_databases";
$config_api_tables = $config_global_apimaker['config_mongo_prefix'] . "_tables";
$config_tables_dynamic = $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic";

if( $_POST['action'] == "context_load_things" ){
	if( $_POST['thing'] == "Components" ){
		$things = [
			[
				"th"=> "Component", 
				"i"=>["t"=>"T", "v"=>"HTTPRequest"],
				"l"=>["t"=>"T", "v"=>"HTTPRequest"]
			],
			[
				"th"=> "Component", 
				"i"=>["t"=>"T", "v"=>"Database-MySql"],
				"l"=>["t"=>"T", "v"=>"Database-MySql"]
			],
			[
				"th"=> "Component", 
				"i"=>["t"=>"T", "v"=>"Database-MongoDb"],
				"l"=>["t"=>"T", "v"=>"Database-MongoDb"]
			],
			[
				"th"=> "Component", 
				"i"=>["t"=>"T", "v"=>"Database-DynamoDb"],
				"l"=>["t"=>"T", "v"=>"Database-DynamoDb"]
			],
			[
				"th"=> "Component", 
				"i"=>["t"=>"T", "v"=>"Database-Redis"],
				"l"=>["t"=>"T", "v"=>"Database-Redis"]
			],
			[
				"th"=> "Component", 
				"i"=>["t"=>"T", "v"=>"Dynamic-Table"],
				"l"=>["t"=>"T", "v"=>"Dynamic-Table"]
			],
			[
				"th"=> "Component", 
				"i"=>["t"=>"T", "v"=>"Elastic-Table"],
				"l"=>["t"=>"T", "v"=>"Elastic-Table"]
			]
		];
	}else if( $_POST['thing'] == "MongoDb-Database" ){
		$res= $mongodb_con->find( $config_api_databases, ["engine"=>"MongoDb"] );
		$things = [];
		foreach( $res['data'] as $i=>$j ){
			$things[] = [
				"th"=> "MongoDb", 
				"i"=>["t"=>"T", "v"=>$j['_id']],
				"l"=>["t"=>"T", "v"=>$j['des']]
			];
		}
	}else if( $_POST['thing'] == "MongoDb-Collection" ){
		$res= $mongodb_con->find( $config_api_tables, ["db_id"=>$_POST['depend']] );
		$things = [];
		foreach( $res['data'] as $i=>$j ){
			$things[] = [
				"th"=> "MongoDb-Collection", 
				"i"=>["t"=>"T", "v"=>$j['_id']],
				"l"=>["t"=>"T", "v"=>$j['des']]
			];
		}
	}else if( $_POST['thing'] == "MySql-Database" ){
		$res= $mongodb_con->find( $config_api_databases, ["engine"=>"MySql", "app_id"=>$_POST['app_id']] );
		$things = [];
		foreach( $res['data'] as $i=>$j ){
			$things[] = [
				"th"=> "MySql-Database", 
				"i"=>["t"=>"T", "v"=>$j['_id']],
				"l"=>["t"=>"T", "v"=>$j['des']]
			];
		}
	}else if( $_POST['thing'] == "MongoDb-Schema" ){
		list($db_id,$table_id) = explode(":",$_POST['depend']);
		$res= $mongodb_con->find_one( $config_api_tables, ["app_id"=>$_POST['app_id'], "db_id"=>$db_id,"_id"=>$table_id] );
		$things = [];
		if( $res['data'] ){
			foreach( $res['data']['schema'] as $sch=>$j ){
				$things[] = [
					"th"=> "MongoDb-Schema", 
					"i"=>["t"=>"T", "v"=>$sch],
					"l"=>["t"=>"T", "v"=>$j['name']],
					"fields" =>["t"=>"O", "v"=>$j['fields']],
					"keys"=>["t"=>"O", "v"=>$res['data']['keys']]
				];
			}
		}
	}else if( $_POST['thing'] == "MySql-Table" ){
		$res= $mongodb_con->find( $config_api_tables, ["db_id"=>$_POST['depend']] );
		$things = [];
		foreach( $res['data'] as $i=>$j ){
			$things[] = [
				"th"=> "MySql-Table", 
				"i"=>["t"=>"T", "v"=>$j['_id']],
				"l"=>["t"=>"T", "v"=>$j['des']]
			];
		}
	}else if( $_POST['thing'] == "MySql-Schema" ){
		list($db_id,$table_id) = explode(":",$_POST['depend']);
		$res= $mongodb_con->find_one( $config_api_tables, ["db_id"=>$db_id,"_id"=>$table_id] );
		$things = [];
		if( $res['data'] ){
			//print_pre( $res['data'] );exit;
			foreach( $res['data']['schema'] as $sch=>$j ){
				$things[] = [
					"th"=> "MySql-Schema", 
					"i"=>["t"=>"T", "v"=>$sch],
					"l"=>["t"=>"T", "v"=>$j['name']],
					"fields" =>["t"=>"O", "v"=>$j['fields']],
					"keys"=>["t"=>"O", "v"=>$res['data']['source_schema']['keys']]
				];
			}
		}
	}else if( $_POST['thing'] == "Internal-Table" ){
		$res= $mongodb_con->find( $config_tables_dynamic, ["app_id"=>$_POST['app_id']] );
		$things = [];
		foreach( $res['data'] as $i=>$j ){
			$things[] = [
				"th"=> "Internal-Table", 
				"i"=>["t"=>"T", "v"=>$j['_id']],
				"l"=>["t"=>"T", "v"=>$j['table']]
			];
		}
	}else if( $_POST['thing'] == "Internal-Schema" ){
		$res= $mongodb_con->find_one( $config_tables_dynamic, ["app_id"=>$_POST['app_id'], "_id"=>$_POST['depend']] );
		//print_pre( $res );
		$things = [];
		if( $res['data'] ){
			foreach( $res['data']['schema'] as $sch=>$j ){
				$things[] = [
					"th"=> "Internal-Schema", 
					"i"=>["t"=>"T", "v"=>$sch],
					"l"=>["t"=>"T", "v"=>$j['name']],
					"fields" =>["t"=>"O", "v"=>$j['fields']],
					"keys"=>["t"=>"O", "v"=>$res['data']['keys']],
					"keys_list"=>["t"=>"O", "v"=>$res['data']['keys_list']]
				];
			}
		}
	}else if( $_POST['thing'] == "Functions" ){
		$res= $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_functions", [
			"app_id"=>$_POST['app_id'],
		], ['sort'=>['name'=>1]]);
		$things = [];
		if( $res['data'] ){
			//print_pre( $res['data'] );exit;
			foreach( $res['data'] as $sch=>$j ){
				$res2= $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_functions_versions", [
					"_id"=>$j['version_id'],
				], ['sort'=>['name'=>1]]);
				if( $res2['data'] ){
					//print_pre( $res2 );
					//print_r( array_keys( $res2['data']['engine'] ) );
					$things[] = [
						"th"=> "Function", 
						"i"=>["t"=>"T", "v"=>$res2['data']['_id']],
						"l"=>["t"=>"T", "v"=>$j['name']],
						"inputs" =>["t"=>"O", "v"=>$res2['data']['engine']['input_factors']],
						"return" =>$res2['data']['engine']['output']
					];
				}
			}
		}
	}else if( $_POST['thing'] == "PolicyThings" ){

		if( $_POST['depend'] == "tables" ){

			$things = [];
			$things[] = ["l"=>["t"=>"T", "v"=>"*"],   "i"=>["t"=>"T", "v"=>"*"]];
			$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
				'app_id'=>$_POST['app_id']
			],[
				'sort'=>['table'=>1],
				'limit'=>200,
			]);
			foreach( $res['data'] as $i=>$j ){
				$things[] = ["l"=>["t"=>"T", "v"=>"internal:".$j['table'] ], "i"=>["t"=>"T", "v"=>"table_dynamic:".$j['_id']] ];
			}

			$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_databases", [
				'app_id'=>$_POST['app_id']
			],[
				'sort'=>['des'=>1],
				'limit'=>200,
				'projection'=>['details'=>false, 'm_i'=>false, 'user_id'=>false]
			]);
			foreach( $res['data'] as $i=>$j ){
				$res2 = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_tables", [
					'app_id'=>$_POST['app_id'],
					"db_id"=>$j['_id']
				],[
					'sort'=>['des'=>1],
					'limit'=>200,
					'projection'=>['f_n'=>false, 'source_schema'=>false, 'm_i'=>false, 'user_id'=>false ]
				]);
				foreach( $res2['data'] as $ii=>$jj ){
					$things[] = ["l"=>["t"=>"T", "v"=>"external:".$j['des'] . ":" . $jj['des']], "i"=>["t"=>"T", "v"=>"table:".$jj['_id']] ];
				}
			}
		}
		if( $_POST['depend'] == "apis" ){
			$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
				'app_id'=>$_POST['app_id']
			],[
				'sort'=>['name'=>1],
				'limit'=>200,
				'projection'=>[
					'name'=>true, 'des'=>true
				]
			]);
			//print_r( $res['data'] );exit;
			foreach( $res['data'] as $i=>$j ){
				$things[] = ["l"=>["t"=>"T", "v"=>"api:".$j['name'] ], "i"=>["t"=>"T", "v"=>"api:".$j['_id']] ];
			}

			$things[] = ["l"=>["t"=>"T", "v"=>"auth_api:generate_access_token"], "i"=>["t"=>"T", "v"=>"auth_api:10001"]];
			$things[] = ["l"=>["t"=>"T", "v"=>"auth_api:user_authentication"],   "i"=>["t"=>"T", "v"=>"auth_api:10002"]];
		}

	}else if( $_POST['thing'] == "page_edit_tables_internal" ){
		$things = [];
		$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
			'app_id'=>$_POST['app_id']
		],[
			'sort'=>['table'=>1],
			'limit'=>200,
		]);
		foreach( $res['data'] as $i=>$j ){
			$things[] = ["l"=>"internal:".$j['table'], "i"=>"table_dynamic:".$j['_id']];
		}
	}else if( $_POST['thing'] == "page_edit_tables_external" ){
		$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_databases", [
			'app_id'=>$_POST['app_id']
		],[
			'sort'=>['des'=>1],
			'limit'=>200,
			'projection'=>['details'=>false, 'm_i'=>false, 'user_id'=>false]
		]);
		foreach( $res['data'] as $i=>$j ){
			$res2 = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_tables", [
				'app_id'=>$_POST['app_id'],
				"db_id"=>$j['_id']
			],[
				'sort'=>['des'=>1],
				'limit'=>200,
				'projection'=>['f_n'=>false, 'source_schema'=>false, 'm_i'=>false, 'user_id'=>false ]
			]);
			foreach( $res2['data'] as $ii=>$jj ){
				$things[] = ["l"=>"external:".$j['des'] . ":" . $jj['des'], "i"=>"table:".$j['engine'].":".$jj['_id']];
			}
		}
	}else{
		$things = [];
	}
	json_response([
		"status"=>"success",
		"things"=>$things
	]);
}
