<?php
//phpinfo();

/* check if all the required prefix tables present */
/* determine state of the system */
/* do health checks */

$required_default_settings = [
	"login_session_id" => "",
	"max_login_attempts" => 3,
	"username" => "admin",
	"password" => hash("whirlpool", "Admin123!@#"),
	"password_date" => "",
	"password_expire_in" => 60, // days
	"password" => "",
	"vars"=> ["extra"=>1],
];
$required_default_tables = [
	"apis"=>[
		"indexes"=>[
			[
				"keys"=>["name"=>1],
				"unique"=>true,
			]
		],
		"records"=>[
		]
	],
	"apis_engine"=>[
		"indexes"=>[],
		"records"=>[
		]
	],
	"request_log"=>[
		"indexes"=>[
			[
				"keys"=>["api_id"=>1],
			],
			[
				"keys"=>["status"=>1, "_id"=>1],
				"sparse"=>true,
			]
		],
		"records"=>[
		]
	],
	"change_log"=>[
		"indexes"=>[
			[
				"keys"=>["category"=>1, "event"=>1, "date"=>1],
			],
		],
		"records"=>[
		]
	],
	"session_tokens"=> [
		"indexes"=>[
			[
				"keys"=>["session_id"=>1],
			],
			[
				"keys"=>["ip"=>1],
			],
			[
				"keys"=>["expire"=>1],
				"ttl"=>true,
			],
		],
		"records"=>[
		]
	],
	"users"=> [
		"indexes"=>[
		],
		"records"=>[
			[
				'username'=>'admin',
				'password'=>pass_hash("Admin123!@#"),
				'password_date'=>"0000-00-00",
				'failed_attempts'=>0,
				'last_failed_date'=>"0000-00-00",
				'last_login_date'=>"0000-00-00",
				"active_session_id"=>"none",
				"role"=>"superadmin", // superadmin, admin, readonly
			]
		]
	],
];

/* analyzing table existence */
$res = $mongodb_con->list_collections();
if( $res['status'] == "success" ){
	$cols = $res['data'];
	$collections_cnt = 0;
	$other_prefix_cnt = 0;
	$issettting = false;
	foreach( $cols as $i=>$j ){
		if( preg_match("/^" . $config_global_apimaker['config_mongo_prefix'] . "_/", $j) ){
			$collections_cnt++;
		}else{
			foreach( $required_default_tables as $table=>$td ){
				if( preg_match("/".$table.'$/', $j) ){
					$other_prefix_cnt++;
				}
			}
		}
		if( $j == $config_global_apimaker['config_mongo_prefix'] . "_settings" ){
			$issettting = true;
		}
	}
	if( $other_prefix_cnt > (sizeof($required_default_tables)*.75) ){
		$other_prefix_found = true;
	}
	//echo $other_prefix_cnt;exit;
}else{
	echo "<p>Error: " . htmlspecialchars($res['error'] ) . "</p>";
	exit;
}

// already initialized
if( $issettting && $collections_cnt ){
	//$config_settings
}

if( $_GET['action'] == "initialize" ){

	$table = $config_global_apimaker['config_mongo_prefix'] . "_settings";
	foreach( $required_default_settings as $i=>$j ){
		$mongodb_con->insert( $table, [
			"_id"=>$i,
			"value"=>$j
		]);
	}
	foreach( $required_default_tables as $table=>$td ){
		$table = $config_global_apimaker['config_mongo_prefix'] . "_" . $table;
		if( in_array($table, $cols) ){
			$col = $mongodb_con->database->{ $table };
			$col->drop();
		}
		try{
			echo "<div>Creating: " . $table . "</div>";
			$res = $mongodb_con->database->createCollection( $table, [
				"collation"=>[ "locale"=>"en_US", "strength"=> 2],
				//expireAfterSeconds
				//capped,
				//max
				//size
			]);
			$col = $mongodb_con->database->{ $table };
			foreach( $td['indexes'] as $i=>$j ){
				$op = [];
				if( $j['sparse'] ){ $op['sparse'] = true; }
				if( $j['unique'] ){ $op['unique'] = true; }
				if( $j['ttl'] ){ $op['expireAfterSeconds'] = 0; }
				try{
					$res = $col->createIndex( $j['keys'], $op );
				}catch(Exception $ex){
					echo "<P>Error initializing: Create Index: " . $table . "</p>";
					echo "<p>" . htmlspecialchars($ex->getMessage()) . "</p>";
					exit;
				}
			}
			foreach( $td['records'] as $i=>$j ){
				try{
					$res = $mongodb_con->insert( $table, $j );
				}catch(Exception $ex){
					echo "<P>Error initializing: Create Record: " . $table . "</p>";
					echo "<p>" . htmlspecialchars($ex->getMessage()) . "</p>";
					exit;
				}
			}
		}catch(Exception $ex){
			echo "<P>Error initializing: Create Collection: " . $table . "</p>";
			echo "<p>" . htmlspecialchars($ex->getMessage()) . "</p>";
			exit;
		}
	}
	echo "<p>Initialization Successful</p>";
	echo "<P><a href='?event=ok' >Click here to Go Back</a></p>";
	exit;
}