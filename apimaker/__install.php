<?php

//error_reporting(4798);
//ini_set("display_errors", "On");
//ini_set("display_startup_errors", "On");

// echo "<pre>";
// print_r( $_SERVER );
// echo __DIR__;
// exit;

$apimaker_dir = __DIR__;
$apimaker_folder = array_pop(explode("/", $apimaker_dir));
if( !$apimaker_folder ){
	$apimaker_folder = array_pop(array_pop(explode("/", $apimaker_dir)));
}

$v = pathinfo( $_SERVER['PHP_SELF'] );
if( !isset($v['dirname']) ){
	echo "No configuration found!<BR>Please follow installation procedures";exit;
}
$config_apimaker_path = $v['dirname'] . "/";

$loc = [
	"./config_global_apimaker.php",
	"../config_global_apimaker.php",
	"../../config_global_apimaker.php",
	"/var/tmp/config_global_apimaker.php",
];
$locc=0;
$file_loc = "";
$loc_found = false;
foreach( $loc as $j ){ if(file_exists($j)){$locc++;$file_loc=$j;$loc_found=true;} }

if( $locc > 1 ){
	?>
	<html><head><title>Php LowCode Engine Maker V1 Installation</title></head>
	<body>
		<p><b>Php LowCode Engine Maker Installation Step 0 </b></p>
		<p style="color:red;">Multipe Configuration files found. Please keep only one. </p>
		<p>You can put the config file in following locations:</p>
		<ul>
			<li>./config_global_apimaker.php (current folder)</li>
			<li>../../config_global_apimaker.php (outside codebase document root)</li>
			<li>/var/tmp/config_global_apimaker.php (system tmp folder)</li>
		</ul>
	</body>
	</html>
	<?php
	exit;
}

if( $file_loc == "" ){
	$file_loc = "../../config_global_apimaker.php";
}

function get_timezones(){
	$timezone_identifiers = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
	return $timezone_identifiers;
}

$variables = [

	"timezone"						=> ["t"=>"dropdown", "v"=>"Asia/Kolkata", "list"=>"timezones", "label"=>"Timezone"],

	"config_use_https_only"			=> ["t"=>"boolean", "v"=>false, "label"=>"Force HTTPS", "help"=>"It is highly recommended to host this service on HTTPS. which will enforce cookie security as well"],

	"config_app_name" 				=> ["t"=>"text", "v"=>"Business Logic Manager", "label"=>"Application Name", "preg"=>"/^[a-z][a-z0-9\ \.\-]{3,100}$/i"], // for error page title

	"config_enable_apps"			=> ["t"=>"boolean", "v"=>"true", "label"=>"Enable Multiple Apps"],

	"config_apimaker_domain" 			=> ["t"=>"text", "v"=>$_SERVER['HTTP_HOST'], "label"=>"Engine Maker Domain", "preg"=>"/^[a-z][a-z0-9\ \.]{3,100}$/i"],
	"config_apimaker_path" 			=> ["t"=>"text", "v"=>$config_apimaker_path, "label"=>"Engine Maker Path", "preg"=>"/^\/[a-z][a-z0-9\/\.\-\_]{2,25}$/i", "help"=> "https://www.example.com/(engine_maker_path). How do you want to access this application.<BR>Do not change the current folder."],

	// default database settings:
	"config_mongo_host" 			=> ["t"=>"text", "v"=>"localhost", "label"=>"DB Host","preg"=>"/^[a-z0-9\.\-\_]{3,100}$/i"],
	"config_mongo_port" 			=> ["t"=>"number", "v"=>12717, "label"=>"DB Port","preg"=>"/^[0-9]{2,5}$/"],
	"config_mongo_db" 				=> ["t"=>"text", "v"=>"phpengine", "label"=>"DB Name","preg"=>"/^[a-z0-9\-\_]{3,100}$/i"],
	"config_mongo_username" 		=> ["t"=>"text", "v"=>"test", "label"=>"DB Username","preg"=>"/^[a-z0-9\.\-\_]{3,100}$/i"],
	"config_mongo_password" 		=> ["t"=>"text", "v"=>"test", "encrypted"=>true, "label"=>"DB Password"],
	"config_mongo_authSource" 		=> ["t"=>"text", "v"=>"admin", "label"=>"DB AuthSource","preg"=>"/^[a-z0-9\.\-\_]{3,100}$/i"], // default is always admin
	"config_mongo_tls" 				=> ["t"=>"boolean", "v"=>false, "label"=>"Use TLS"],  // used for aws services or mongodb atlas
	"config_mongo_prefix"			=> ["t"=>"text", "v"=>"phpengine", "label"=>"DB Collection Prefix","preg"=>"/^[a-z][a-z0-9]{3,20}$/", "help"=>"Must be lowercase"], // [a-z] no special chars

	"config_session_timeout" 		=> ["t"=>"number", "v"=>86400, "label"=>"Login Session Timeout", "help"=>"Session timeout in seconds. 86400 for 24 hours."],	

	"config_session_redis" 			=> ["t"=>"boolean", "v"=>false, "label"=>"Session Database Redis", "help"=>"Use Redis Database for sessions. This setting helps to preserv sessions in the multi tier high availability clusters."],
	"config_redis_host" 			=> ["t"=>"text", "v"=>"localhost", "label"=>"Redis Host","preg"=>"/^[a-z0-9\.\-\_]{3,100}$/i"],
	"config_redis_port" 			=> ["t"=>"number", "v"=>6379, "label"=>"Redis Port","preg"=>"/^[0-9]{2,5}$/"],

	"config_encrypt_key" 			=> ["t"=>"text", "v"=>'axbycz!@#', "encrypted"=>true, "label"=>"Encryption Key", "preg"=>"/^[a-z0-9\,\~\!\@\#\$\%\^\&\*\(\)\+\`\-\=\[\]\{\}\;\:\,\.\<\>\?\/\_]{8,64}$/i", "help"=>"Length should be between 8 to 64" ],
	"config_encrypt_algo" 			=> ["t"=>"text", "v"=>'aes256', "label"=>"Encryption Algorithem", "fiex"=>true],

	"config_encrypt_keys" 			=> [
		"t"=>"object", 
		"v"=>[
			[
				"key"	=>["t"=>"text", "v"=>"k1", "preg"=>"/^[a-z][0-9]{1,3}$/i", "tip"=>"[a-z][0-9]{1,3}"],
				"val"	=>[
					"t"=>"object", 
					"v"=>[
						[
							"key"=>["t"=>"text","v"=>"key", "fixed"=>true],
							"val"=>["t"=>"text","v"=>"abcdef012345689",  "preg"=>"/^[a-z0-9]{8,64}$/i", "tip"=>"[a-z0-9]{8,64}", "help"=>"Key must be minimum 8 char. upto 64. no special chars"],
						],
						[
							"key"=>["t"=>"text","v"=>"comments", "fixed"=>true],
							"val"=>["t"=>"text","v"=>"Default" ],
						]
					],
					"fixed"=>true,
				]
			],
		],
		"fixed"=>false,
		"default_item"=>[
				"key"	=>["t"=>"text", "v"=>"new_key"],
				"val"	=>[
					"t"=>"object", 
					"v"=>[
						[
							"key"=>["t"=>"text","v"=>"key", "fixed"=>true],
							"val"=>["t"=>"text","v"=>"abcdef"],
						],
						[
							"key"=>["t"=>"text","v"=>"comments", "fixed"=>true],
							"val"=>["t"=>"text","v"=>"Default"],
						]
					],
					"fixed"=>true,
				]
			], 
		"label"=>"Encryption Keys", 
		"help"=>"Not sure? Leave the default configuraton"
	],
	"config_encrypt_default_key" 	=> ["t"=>"text", "v"=>"k1", "label"=>"Default Encryption Key"],
	"config_password_salt" 			=> ["t"=>"text", "v"=>"12345QEWER", "label"=>"Password Hash Salt", "help"=>"This salt is same for global login passowrd hashing. and user accounts<BR>Be very cautious when changing salt. it can make entire application irrecoverable."],

	"config_login_username" 		=> ["t"=>"text", "v"=>"admin", "label"=>"Login Username", "preg"=>"/^[a-z][a-z0-9\-\.\_\@]{3,20}$/i", "help"=>"Username for initial user account" ], // initial username on first run
	"config_login_password" 		=> ["t"=>"password", "v"=>"", "hashed"=>true, "label"=>"Login Password", "help"=>"Password is hashed with whirlpool"], // initial username on first run
	"config_login_whitelists" 		=> ["t"=>"list", "v"=>[
			[ "t"=>"text", "v"=>"*", "validate"=>"ip"],
		], 
		"default_item"=>[ "t"=>"text", "v"=>"*", "validate"=>"ip"], "label"=>"Login IP WhiteList"		
	], // empty array allows all ips. ips can be subnet ranges.


	// "config_engine_path" 			=> ["t"=>"text", "v"=>"/engine/", "label"=>"Engine Path"],
	// "config_engine_cache"			=> ["t"=>"boolean", "v"=>false, "label"=>"Engine Settings Cache?", "help"=>"If Engine Maker & Processor both on same machine/vpc, Cache is not required<BR>When Engine Processor is hosted on AWS Lambda/Remote VM Cache is required."],
	// "config_engine_cache_interval"	=> ["t"=>"number", "v"=>60, "label"=>"Engine Settings Refresh Internal"],
	// "config_engine_type" 			=> ["t"=>"dropdown", "v"=>"database", "label"=>"Engine Connectivity", "datalist"=> ["database", "api"] , "help"=>"For local/vpc setup, database is default. for Remote engine deployment API is required"],
	// "config_engine_app_id" 			=> ["t"=>"text", "v"=>"default", "label"=>"Engine APP ID", "fixed"=>true, "help"=>"The default app_id which should be served by the engine." ],

	/*
	"config_engine_keys"=> [
		"t"=>"object", 
		"v"=>[
			[
				"key"=>[ "t"=>"text", "v"=>"key", "fixed"=>true ],
				"val"=>[ "t"=>"text", "v"=>"12345" ],
			],
			[
				"key"=>[ "t"=>"text", "v"=>"expire", "fixed"=>true ],
				"val"=>[ "t"=>"date", "v"=>"2035-12-12" ],
			],
			[
				"key"=>[ "t"=>"text", "v"=>"domains_allowed", "fixed"=>true ],
				"val"=>[ 
					"t"=>"object", 
					"v"=>[
						[
							"key"=>["t"=>"text", "v"=>"*"],
							"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
						],
						[
							"key"=>["t"=>"text", "v"=>"*.example.com"],
							"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
						],
						[
							"key"=>["t"=>"text", "v"=>"example.com"],
							"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
						]
					], 
					"fixed"=>false, 
					"default_item"=> [
						"key"=>["t"=>"text", "v"=>"*"],
						"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
					]
				],
			],
			[
				"key"=>[ "t"=>"text", "v"=>"apps_allowed", "fixed"=>true ],
				"val"=>[ 
					"t"=>"object", 
					"v"=>[
						[
							"key"=>["t"=>"text", "v"=>"*"],
							"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
						],
						[
							"key"=>["t"=>"text", "v"=>"SomeAPPId"],
							"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
						],
					],
					"fixed"=>false, 
					"default_item"=> [
						"key"=>["t"=>"text", "v"=>"*"],
						"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
					],
				],
			],
			[
				"key"=>[ "t"=>"text", "v"=>"ips_allowed", "fixed"=>true ],
				"val"=>[ 
					"t"=>"object", 
					"v"=>[
						[
							"key"=>["t"=>"text", "v"=>"*"],
							"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
						],
						[
							"key"=>["t"=>"text", "v"=>"127.0.0.1/32"],
							"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
						],
						[
							"key"=>["t"=>"text", "v"=>"10.10.10.0/24"],
							"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
						],
					],
					"fixed"=>false, 
					"default_item"=> [
						"key"=>["t"=>"text", "v"=>"*"],
						"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
					],
				],
			],
			[
				"key"=>[ "t"=>"text", "v"=>"ips_denied", "fixed"=>true ],
				"val"=>[ 
					"t"=>"object", 
					"v"=>[
						[
							"key"=>["t"=>"text", "v"=>"8.8.8.8/32"],
							"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
						],
					],
					"fixed"=>false, 
					"default_item"=> [
						"key"=>["t"=>"text", "v"=>"8.8.8.8/32"],
						"val"=>["t"=>"text", "v"=>1, "fixed"=>true],
					],
				],
			],
		]
	]
	*/
];

//echo "<pre>";
function fill_item( $item, $vars ){
	if( $item['t'] == "text" || $item['t'] == "number" || $item['t'] == "boolean" ){
		$item['v'] = $vars;
	}else if( $item['t'] == "list" ){
		if( is_array($vars) ){
			foreach( $item['v'] as $i=>$j ){
				$item['v'][ $i ] = fill_item( $j, $vars[ $i ] );
			}
		}
	}
	return $item;
}
function fill_template( $template, $vars ){
	foreach( $template as $key=>$item ){
		if( isset($vars[ $key ]) ){
			$template[ $key ] = fill_item( $item, $vars[ $key ] );
		}
	}
	return $template;
}

if( $loc_found ){
	require($file_loc);
	if( is_array($config_global_apimaker) ){
		$variables = fill_template($variables, $config_global_apimaker);
	}
}

if( $_POST['action'] == "saveconf" ){

	function convert2($item){
		global $required_pass_salt;
		if( $item['t'] == "dropdown" ){
			return $item['v'];
		}else if( $item['t'] == "text" || $item['t'] == "password" ){
			if( isset($item['hashed']) ){
				return pass_hash2($item['v'],$required_pass_salt);
			}else{
				return $item['v'];
			}
		}else if( $item['t'] == "number" ){
			return (int)$item['v'];
		}else if( $item['t'] == "boolean" ){
			return ($item['v']==="true"||$item['v']===true?true:false);
		}else if( $item['t'] == "checkbox" ){
			return ($item['v']==="true"||$item['v']===true?true:false);
		}else if( $item['t'] == "list" ){
			$d = [];
			foreach( $item['v'] as $ii=>$jj ){
				$d[] = convert2($jj);
			}
			return $d;
		}else if( $item['t'] == "object" ){
			$d = [];
			foreach( $item['v'] as $ii=>$jj ){
				$k = convert2($jj['key']);
				$v = convert2($jj['val']);
				$d[ $k ] = $v;
			}
			return $d;
		}
	}
	function convert($data){
		$d = [];
		foreach( $data as $i=>$j ){
			$d[ $i ] = convert2( $j );
		}
		return $d;
	}
	function pass_hash2( $pass, $salt ){
		$ctx = hash_init('whirlpool');
		hash_update( $ctx, $salt );
		hash_update( $ctx, $pass );
		return hash_final( $ctx );
	}

	$data = json_decode($_POST['data'],true);
	if( !is_array($data) || json_last_error() ){
		echo json_encode(["status"=>"error", "error"=>"Data decode failed"]);exit;
	}
	$required_pass_salt = $data['config_password_salt']['v'];
	$user = $data['config_login_username']['v'];
	$pass = $data['config_login_password']['v'];
	unset($data['config_login_username']); unset($data['config_login_password']);

	$data = convert($data);
	if( $data== null ||  !is_array($data) ){
		echo json_encode(["status"=>"error", "error"=>"Data convert failed"]);exit;
	}

	require("classes/class_mongodb.php");
	if( $data['config_mongo_username'] ){
		$mongodb_con = new mongodb_connection(
			$data['config_mongo_host'], 
			$data['config_mongo_port'], 
			$data['config_mongo_db'], 
			$data['config_mongo_username'], 
			$data['config_mongo_password'], 
			$data['config_mongo_authSource'], 
			$data['config_mongo_tls']
		);
	}else{
		$mongodb_con = new mongodb_connection( $data['config_mongo_host'], $data['config_mongo_port'], $data['config_mongo_db'] );
	}

	$defult_engine_url = "https://".$data['config_apimaker_domain'].$data['config_apimaker_path'];
	$default_engine_key = "65b3e2eb822fa7476b0576c2";
	$default_app_id = "64f237a775a7be05200cedd0";

	$required_default_settings = [
		"login_session_id" => "",
		"max_login_attempts" => 3,
		"vars"=> ["extra"=>1],
	];
	$required_pass_salt = $data['config_password_salt']; // "abcdef0123456789";
	$required_default_tables = [
		"apis"=>[
			"indexes"=>[["keys"=>["app_id"=>1,"name"=>1],"unique"=>true]],
			"records"=>[json_decode('{"_id": "6537f1334042e656940dfa0e","app_id": "'.$default_app_id.'","name": "api-test-2","des": "api test 2","type": "api","created": "2023-10-24 2:00:43","updated": "2024-01-17 16:37:37","active": true,"version": 1,"version_id": "6537f1334042e656940dfa0d","output-type": "application/json","input-method": "GET","input-type": "query_string","m_i": "2023-10-24 22:00:43","engine": null}',true)]
		],
		"apis_versions"=>[
			"indexes"=>[["keys"=>["app_id"=>1,"api_id"=>1]]
			],
			"records"=>[json_decode('{"_id": "6537f1334042e656940dfa0d","app_id": "'.$default_app_id.'","api_id": "6537f1334042e656940dfa0e","name": "api-test-2","des": "api test 2","type": "api","created": "2023-10-24 22:00:43","updated": "2024-01-17 16:37:37","active": true,"version": 1,"output-type": "application/json","input-method": "GET","input-type": "query_string","m_i": "2023-10-24 22:00:43","engine": {"input_factors": [],"stages": [{"k": {"v": "HTTPRequest","t": "c","vs": false},"pk": "HTTPRequest","t": "c","d": {"data": {"method": {"t": "T","v": "GET"},"url": {"t": "T","v": "http://ifconfig.ca/"},"content-type": {"t": "T","v": "application/x-www-form-urlencoded"},"auth": {"type": {"t": "T","v": "none"},"user": {"t": "T","v": ""},"pass": {"t": "T","v": ""}},"headers": {"t": "L","v": []},"payload": {"t": "O","v": []},"redirect": {"t": "N","v": "No"},"ctime": {"t": "N","v": 1},"rtime": {"t": "N","v": 5},"sslverify": {"t": "B","v": "false"},"twoway": {"t": "B","v": "false"},"sslcert": {"t": "TT","v": ""},"sslkey": {"t": "TT","v": ""},"useproxy": {"t": "T","v": "No"},"proxy": {"t": "O","v": {"host": {"t": "T","v": "192.168.1.1"},"port": {"t": "N","v": 8080},"user": {"t": "T","v": ""},"pass": {"t": "T","v": ""}}},"parse": {"t": "B","v": "false"},"output": {"t": "T","v": "httpResponse"},"struct": {"status": {"t": "N"},"body": {"t": "T"},"headers": {"t": "O","_": []},"content_type": {"t": "T"},"time_taken": {"t": "N"},"size": {"t": "N"},"error": {"t": "T"},"cookies": {"t": "O","_": []}}}},"l": 1,"e": false,"ee": true,"er": "","wr": ""},{"k": {"v": "RespondJSON","t": "c","vs": false},"pk": "RespondJSON","t": "c","d": {"output": {"t": "O","v": {"status": {"t": "T","v": "success","k": "status"},"data": {"t": "V","v": {"v": "httpResponse","t": "O","vs": {"v": "","t": "","d": []}},"k": "data"}}},"pretty": {"t": "B","v": "true"}},"l": 1,"e": false,"ee": true,"er": "","wr": ""}]},"test": {"domain": "v2.backendmaker.com","path": "/engine/","factors": {"t": "O","v": []}}}',true)]
		],
		"apps"=>[
			"indexes"=>[],
			"records"=>[
				json_decode('{
				"_id": "'.$default_app_id.'","app": "MyFirstApp", "des": "A sample app ", 
				"created": "2023-09-02 00:42:39", "updated": "2023-09-02 00:42:39", "active": true, "m_i": "2024-01-26 16:07:42",
				"settings": {
				 "domains": [{"domain": "'.$data['config_apimaker_domain'].'", "url": "'.$defult_engine_url.'", "path": "'.$data['config_apimaker_path'].'"}],
				 "keys": [{"key": "'.$default_engine_key.'","ips_allowed": [{"ip": "0.0.0.0/0","action": "Allow"}]}],
				 "cloud": false,"cloud-domain": "","cloud-subdomain": "","cloud-enginepath": "",
				 "host": true,"alias": false,"alias-domain": "",
				 "homepage": {"t": "page","v": "657ae0613d8e5397370ecb08:657ae0613d8e5397370ecb07"}
				},
				"functions": [],
				"last_updated": "2024-01-26 22:21:00",
				"pages": {"home": {"version_id": "657ae0613d8e5397370ecb07","t": "page"},"api-test-2": {"_id": "6537f1334042e656940dfa0e","name": "api-test-2","version_id": "6537f1334042e656940dfa0d","input-method": "GET","t": "api"}}
				}',true)
			]
		],
		"databases"=>[
			"indexes"=>[["keys"=>["app_id"=>1,"des"=>1]]],
			"records"=>[]
		],
		"tables"=>[
			"indexes"=>[["keys"=>["app_id"=>1,"db_id"=>1]],["keys"=>["app_id"=>1,"des"=>1]]],
			"records"=>[]
		],
		"tables_dynamic"=>[
			"indexes"=>[["keys"=>["app_id"=>1,"db_id"=>1]]],
			"records"=>[]
		],
		"files"=>[
			"indexes"=>[["keys"=>["app_id"=>1, "name"=>1]]],
			"records"=>[]
		],
		"functions"=>[
			"indexes"=>[["keys"=>["app_id"=>1,"name"=>1]]],
			"records"=>[]
		],
		"functions_versions"=>[
			"indexes"=>[["keys"=>["app_id"=>1,"function_id"=>1]]],
			"records"=>[]
		],
		"pages"=>[
			"indexes"=>[["keys"=>["app_id"=>1,"name"=>1]]],
			"records"=>[json_decode('{"_id": "657ae0613d8e5397370ecb08","app_id": "'.$default_app_id.'","name": "home","des": "home page","created": "2023-12-14 16:30:49","updated": "2023-12-14 16:30:49","active": true,"version": 1,"version_id": "657ae0613d8e5397370ecb07","m_i": "2023-12-14 16:30:49"}',true)]
		],
		"pages_versions"=>[
			"indexes"=>[["keys"=>["app_id"=>1,"page_id"=>1]]],
			"records"=>[json_decode('{"_id":"657ae0613d8e5397370ecb07","app_id":"'.$default_app_id.'","page_id":"657ae0613d8e5397370ecb08","name":"home","des":"home page","created":"2023-12-14 16:30:49","updated":"2023-12-14 16:30:49","active":true,"version":1,"html":"\r\n<div class=\"container\">\r\n <header class=\"blog-header py-3\">\r\n <div class=\"row flex-nowrap justify-content-between align-items-center\">\r\n <div class=\"col-4 pt-1\">\r\n <a class=\"link-secondary\" href=\"#\">Subscribe</a>\r\n </div>\r\n <div class=\"col-4 text-center\">\r\n <a class=\"blog-header-logo text-dark\" href=\"#\">Large</a>\r\n </div>\r\n <div class=\"col-4 d-flex justify-content-end align-items-center\">\r\n <a class=\"link-secondary\" href=\"#\" aria-label=\"Search\">\r\n <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" fill=\"none\" stroke=\"currentColor\" stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" class=\"mx-3\" role=\"img\" viewBox=\"0 0 24 24\"><title>Search</title><circle cx=\"10.5\" cy=\"10.5\" r=\"7.5\"/><path d=\"M21 21l-5.2-5.2\"/></svg>\r\n </a>\r\n <a class=\"btn btn-sm btn-outline-secondary\" href=\"#\">Sign up</a>\r\n </div>\r\n </div>\r\n </header>\r\n\r\n <div class=\"nav-scroller py-1 mb-2\">\r\n <nav class=\"nav d-flex justify-content-between\">\r\n <a class=\"p-2 link-secondary\" href=\"#\">World</a>\r\n <a class=\"p-2 link-secondary\" href=\"#\">U.S.</a>\r\n <a class=\"p-2 link-secondary\" href=\"#\">Technology</a>\r\n <a class=\"p-2 link-secondary\" href=\"#\">Design</a>\r\n <a class=\"p-2 link-secondary\" href=\"#\">Culture</a>\r\n <a class=\"p-2 link-secondary\" href=\"#\">Business</a>\r\n <a class=\"p-2 link-secondary\" href=\"#\">Politics</a>\r\n <a class=\"p-2 link-secondary\" href=\"#\">Opinion</a>\r\n <a class=\"p-2 link-secondary\" href=\"#\">Science</a>\r\n <a class=\"p-2 link-secondary\" href=\"#\">Health</a>\r\n <a class=\"p-2 link-secondary\" href=\"#\">Style</a>\r\n <a class=\"p-2 link-secondary\" href=\"#\">Travel</a>\r\n </nav>\r\n </div>\r\n</div>\r\n\r\n<main class=\"container\">\r\n <div class=\"p-4 p-md-5 mb-4 text-white rounded bg-dark\">\r\n <div class=\"col-md-6 px-0\">\r\n <h1 class=\"display-4 fst-italic\">Title of a longer featured blog post</h1>\r\n <p class=\"lead my-3\">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>\r\n <p class=\"lead mb-0\"><a href=\"#\" class=\"text-white fw-bold\">Continue reading...</a></p>\r\n </div>\r\n </div>\r\n\r\n <div class=\"row mb-2\">\r\n <div class=\"col-md-6\">\r\n <div class=\"row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative\">\r\n <div class=\"col p-4 d-flex flex-column position-static\">\r\n <strong class=\"d-inline-block mb-2 text-primary\">World</strong>\r\n <h3 class=\"mb-0\">Featured post</h3>\r\n <div class=\"mb-1 text-muted\">Nov 12</div>\r\n <p class=\"card-text mb-auto\">This is a wider card with supporting text below as a natural lead-in to additional content.</p>\r\n <a href=\"#\" class=\"stretched-link\">Continue reading</a>\r\n </div>\r\n <div class=\"col-auto d-none d-lg-block\">\r\n <svg class=\"bd-placeholder-img\" width=\"200\" height=\"250\" xmlns=\"http://www.w3.org/2000/svg\" role=\"img\" aria-label=\"Placeholder: Thumbnail\" preserveAspectRatio=\"xMidYMid slice\" focusable=\"false\"><title>Placeholder</title><rect width=\"100%\" height=\"100%\" fill=\"#55595c\"/><text x=\"50%\" y=\"50%\" fill=\"#eceeef\" dy=\".3em\">Thumbnail</text></svg>\r\n\r\n </div>\r\n </div>\r\n </div>\r\n <div class=\"col-md-6\">\r\n <div class=\"row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative\">\r\n <div class=\"col p-4 d-flex flex-column position-static\">\r\n <strong class=\"d-inline-block mb-2 text-success\">Design</strong>\r\n <h3 class=\"mb-0\">Post title</h3>\r\n <div class=\"mb-1 text-muted\">Nov 11</div>\r\n <p class=\"mb-auto\">This is a wider card with supporting text below as a natural lead-in to additional content.</p>\r\n <a href=\"#\" class=\"stretched-link\">Continue reading</a>\r\n </div>\r\n <div class=\"col-auto d-none d-lg-block\">\r\n <svg class=\"bd-placeholder-img\" width=\"200\" height=\"250\" xmlns=\"http://www.w3.org/2000/svg\" role=\"img\" aria-label=\"Placeholder: Thumbnail\" preserveAspectRatio=\"xMidYMid slice\" focusable=\"false\"><title>Placeholder</title><rect width=\"100%\" height=\"100%\" fill=\"#55595c\"/><text x=\"50%\" y=\"50%\" fill=\"#eceeef\" dy=\".3em\">Thumbnail</text></svg>\r\n\r\n </div>\r\n </div>\r\n </div>\r\n </div>\r\n\r\n <div class=\"row g-5\">\r\n <div class=\"col-md-8\">\r\n <h3 class=\"pb-4 mb-4 fst-italic border-bottom\">\r\n From the Firehose\r\n </h3>\r\n\r\n <article class=\"blog-post\">\r\n <h2 class=\"blog-post-title\">Sample blog post</h2>\r\n <p class=\"blog-post-meta\">January 1, 2021 by <a href=\"#\">Mark</a></p>\r\n\r\n <p>This blog post shows a few different types of content that’s supported and styled with Bootstrap. Basic typography, lists, tables, images, code, and more are all supported as expected.</p>\r\n <hr>\r\n <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. Well repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>\r\n <h2>Blockquotes</h2>\r\n <p>This is an example blockquote in action:</p>\r\n <blockquote class=\"blockquote\">\r\n <p>Quoted text goes here.</p>\r\n </blockquote>\r\n <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. Well repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>\r\n <h3>Example lists</h3>\r\n <p>This is some additional paragraph placeholder content. Its a slightly shorter version of the other highly repetitive body text used throughout. This is an example unordered list:</p>\r\n <ul>\r\n <li>First list item</li>\r\n <li>Second list item with a longer description</li>\r\n <li>Third list item to close it out</li>\r\n </ul>\r\n <p>And this is an ordered list:</p>\r\n <ol>\r\n <li>First list item</li>\r\n <li>Second list item with a longer description</li>\r\n <li>Third list item to close it out</li>\r\n </ol>\r\n <p>And this is a definition list:</p>\r\n <dl>\r\n <dt>HyperText Markup Language (HTML)</dt>\r\n <dd>The language used to describe and define the content of a Web page</dd>\r\n <dt>Cascading Style Sheets (CSS)</dt>\r\n <dd>Used to describe the appearance of Web content</dd>\r\n <dt>JavaScript (JS)</dt>\r\n <dd>The programming language used to build advanced Web sites and applications</dd>\r\n </dl>\r\n <h2>Inline HTML elements</h2>\r\n <p>HTML defines a long list of available inline tags, a complete list of which can be found on the <a href=\"https://developer.mozilla.org/en-US/docs/Web/HTML/Element\">Mozilla Developer Network</a>.</p>\r\n <ul>\r\n <li><strong>To bold text</strong>, use <code class=\"language-plaintext highlighter-rouge\">&lt;strong&gt;</code>.</li>\r\n <li><em>To italicize text</em>, use <code class=\"language-plaintext highlighter-rouge\">&lt;em&gt;</code>.</li>\r\n <li>Abbreviations, like <abbr title=\"HyperText Markup Langage\">HTML</abbr> should use <code class=\"language-plaintext highlighter-rouge\">&lt;abbr&gt;</code>, with an optional <code class=\"language-plaintext highlighter-rouge\">title</code> attribute for the full phrase.</li>\r\n <li>Citations, like <cite>— Mark Otto</cite>, should use <code class=\"language-plaintext highlighter-rouge\">&lt;cite&gt;</code>.</li>\r\n <li><del>Deleted</del> text should use <code class=\"language-plaintext highlighter-rouge\">&lt;del&gt;</code> and <ins>inserted</ins> text should use <code class=\"language-plaintext highlighter-rouge\">&lt;ins&gt;</code>.</li>\r\n <li>Superscript <sup>text</sup> uses <code class=\"language-plaintext highlighter-rouge\">&lt;sup&gt;</code> and subscript <sub>text</sub> uses <code class=\"language-plaintext highlighter-rouge\">&lt;sub&gt;</code>.</li>\r\n </ul>\r\n <p>Most of these elements are styled by browsers with few modifications on our part.</p>\r\n <h2>Heading</h2>\r\n <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. Well repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>\r\n <h3>Sub-heading</h3>\r\n <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. Well repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>\r\n <pre><code>Example code block</code></pre>\r\n <p>This is some additional paragraph placeholder content. Its a slightly shorter version of the other highly repetitive body text used throughout.</p>\r\n </article>\r\n\r\n <article class=\"blog-post\">\r\n <h2 class=\"blog-post-title\">Another blog post</h2>\r\n <p class=\"blog-post-meta\">December 23, 2020 by <a href=\"#\">Jacob</a></p>\r\n\r\n <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. Well repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>\r\n <blockquote>\r\n <p>Longer quote goes here, maybe with some <strong>emphasized text</strong> in the middle of it.</p>\r\n </blockquote>\r\n <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. Well repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>\r\n <h3>Example table</h3>\r\n <p>And dont forget about tables in these posts:</p>\r\n <table class=\"table\">\r\n <thead>\r\n <tr>\r\n <th>Name</th>\r\n <th>Upvotes</th>\r\n <th>Downvotes</th>\r\n </tr>\r\n </thead>\r\n <tbody>\r\n <tr>\r\n <td>Alice</td>\r\n <td>10</td>\r\n <td>11</td>\r\n </tr>\r\n <tr>\r\n <td>Bob</td>\r\n <td>4</td>\r\n <td>3</td>\r\n </tr>\r\n <tr>\r\n <td>Charlie</td>\r\n <td>7</td>\r\n <td>9</td>\r\n </tr>\r\n </tbody>\r\n <tfoot>\r\n <tr>\r\n <td>Totals</td>\r\n <td>21</td>\r\n <td>23</td>\r\n </tr>\r\n </tfoot>\r\n </table>\r\n\r\n <p>This is some additional paragraph placeholder content. Its a slightly shorter version of the other highly repetitive body text used throughout.</p>\r\n </article>\r\n\r\n <article class=\"blog-post\">\r\n <h2 class=\"blog-post-title\">New feature</h2>\r\n <p class=\"blog-post-meta\">December 14, 2020 by <a href=\"#\">Chris</a></p>\r\n\r\n <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. Well repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>\r\n <ul>\r\n <li>First list item</li>\r\n <li>Second list item with a longer description</li>\r\n <li>Third list item to close it out</li>\r\n </ul>\r\n <p>This is some additional paragraph placeholder content. Its a slightly shorter version of the other highly repetitive body text used throughout.</p>\r\n </article>\r\n\r\n <nav class=\"blog-pagination\" aria-label=\"Pagination\">\r\n <a class=\"btn btn-outline-primary\" href=\"#\">Older</a>\r\n <a class=\"btn btn-outline-secondary disabled\">Newer</a>\r\n </nav>\r\n\r\n </div>\r\n\r\n <div class=\"col-md-4\">\r\n <div class=\"position-sticky\" style=\"top: 2rem;\">\r\n <div class=\"p-4 mb-3 bg-light rounded\">\r\n <h4 class=\"fst-italic\">About</h4>\r\n <p class=\"mb-0\">Customize this section to tell your visitors a little bit about your publication, writers, content, or something else entirely. Totally up to you.</p>\r\n </div>\r\n\r\n <div class=\"p-4\">\r\n <h4 class=\"fst-italic\">Archives</h4>\r\n <ol class=\"list-unstyled mb-0\">\r\n <li><a href=\"#\">March 2021</a></li>\r\n <li><a href=\"#\">February 2021</a></li>\r\n <li><a href=\"#\">January 2021</a></li>\r\n <li><a href=\"#\">December 2020</a></li>\r\n <li><a href=\"#\">November 2020</a></li>\r\n <li><a href=\"#\">October 2020</a></li>\r\n <li><a href=\"#\">September 2020</a></li>\r\n <li><a href=\"#\">August 2020</a></li>\r\n <li><a href=\"#\">July 2020</a></li>\r\n <li><a href=\"#\">June 2020</a></li>\r\n <li><a href=\"#\">May 2020</a></li>\r\n <li><a href=\"#\">April 2020</a></li>\r\n </ol>\r\n </div>\r\n\r\n <div class=\"p-4\">\r\n <h4 class=\"fst-italic\">Elsewhere</h4>\r\n <ol class=\"list-unstyled\">\r\n <li><a href=\"#\">GitHub</a></li>\r\n <li><a href=\"#\">Twitter</a></li>\r\n <li><a href=\"#\">Facebook</a></li>\r\n </ol>\r\n </div>\r\n </div>\r\n </div>\r\n </div>\r\n\r\n</main>\r\n\r\n<footer class=\"blog-footer\">\r\n <p>Blog template built for <a href=\"https://getbootstrap.com/\">Bootstrap</a> by <a href=\"https://twitter.com/mdo\">@mdo</a>.</p>\r\n <p>\r\n <a href=\"#\">Back to top</a>\r\n </p>\r\n</footer>\r\n\r\n","m_i":"2023-12-14 16:30:49"}',true)]
		],
		"request_log"=>[
			"indexes"=>[["keys"=>["api_id"=>1]],["keys"=>["status"=>1, "_id"=>1],"sparse"=>true]],
			"records"=>[]
		],
		"tables"=>[
			"indexes"=>[["keys"=>["category"=>1, "event"=>1, "date"=>1]]],
			"records"=>[]
		],
		"session_tokens"=> [
			"indexes"=>[["keys"=>["session_id"=>1]],["keys"=>["ip"=>1]],["keys"=>["expire"=>1],"ttl"=>true]],
			"records"=>[]
		],
		"users"=> [
			"indexes"=>[],
			"records"=>[
				[
					'username'=>$user,
					'password'=>pass_hash2($pass, $required_pass_salt),
					'password_date'=>date("Y-m-d H:i:s"),'failed_attempts'=>0,'last_failed_date'=>"0000-00-00",'last_login_date'=>"0000-00-00","active_session_id"=>"none","role"=>"superadmin", // superadmin, admin, readonly
				]
			]
		],
	];

	$res = $mongodb_con->list_collections();
	if( $res['status'] != "success" ){
		echo json_encode([
			"status"=>"fail",
			"error"=>"Database Setup: " . $res['error']
		]);exit;
	}
	$cols = $res['data'];
	$collections_cnt = 0;
	$other_prefix_cnt = 0;
	$other_prefix = "";
	$issettting = false;
	foreach( $cols as $i=>$j ){
		if( preg_match("/^" . $data['config_mongo_prefix'] . "_/", $j) ){
			$collections_cnt++;
		}else{
			foreach( $required_default_tables as $table=>$td ){
				if( preg_match("/".$table.'$/', $j) ){
					$other_prefix_cnt++;
					$other_prefix = str_replace( "_" .$table, "", $j );
				}
			}
		}
		if( $j == $data['config_mongo_prefix'] . "_settings" ){
			$issettting = true;
		}
	}
	if( $other_prefix_cnt > (sizeof($required_default_tables)*.75) ){
		$other_prefix_found = true;
	}

	// already initialized
	if( $issettting && $collections_cnt ){
		if( $_POST['force_update'] === "true" ){}else{
			echo json_encode([
				"status"=>"dbinitialized", "error"=>"Database is already initialized"
			]);exit;
		}
	}else if( $other_prefix_found ){
		if( $_POST['force_update'] === "true" ){}else{
			echo json_encode([
				"status"=>"dbinitialized2", "error"=>"Database is already initialized with different prefix: " . $other_prefix
			]);exit;
		}
	}

	$table = $data['config_mongo_prefix'] . "_settings";
	foreach( $required_default_settings as $i=>$j ){
		$mongodb_con->insert( $table, [
			"_id"=>$i,
			"value"=>$j
		]);
	}
	foreach( $required_default_tables as $table=>$td ){
		$table = $data['config_mongo_prefix'] . "_" . $table;
		if( in_array($table, $cols) ){
			$col = $mongodb_con->database->{ $table };
			$col->drop();
		}
		try{
			$res = $mongodb_con->database->createCollection( $table, [
				"collation"=>[ "locale"=>"en_US", "strength"=> 2],
				//expireAfterSeconds //capped, //max //size
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
					echo json_encode(["status"=>"error", "error"=>"Error initializing: Create Index: " . $table . ": ". $ex->getMessage() ]);exit;
					exit;
				}
			}
			if( isset($td['records']) ){
			foreach( $td['records'] as $i=>$j ){
				try{
					$res = $mongodb_con->insert( $table, $j );
				}catch(Exception $ex){
					echo json_encode(["status"=>"error", "error"=>"Error initializing: Create Record: " . $table . ": ". $ex->getMessage() ]);exit;
					exit;
				}
			}
			}
		}catch(Exception $ex){
			echo json_encode(["status"=>"error", "error"=>"Error initializing: Create Collection: " . $table . ": ". $ex->getMessage() ]);exit;
			exit;
		}
	}

	$vstr = '<'.'?'."php\n\n";
	$vstr .= "/* Last updated on " . date("Y-m-d H:i:s") . "*/\n\n";
	$vstr .= "\$config_global_apimaker_path = '".$config_apimaker_path."';\n\n";
	$vstr .= '$config_global_apimaker = ' . var_export($data,true) . ";\n\n";

	try{
		file_put_contents( $_POST['config_path'], $vstr );
		chmod( $_POST['config_path'], 0777 );
	}catch(Exception $ex){
		echo json_encode(["status"=>"error", "error"=>"Failed to create file ". $ex->getMessage() ]);exit;
	}
	if( !file_exists( $_POST['config_path'] ) ){
		echo json_encode(["status"=>"error", "error"=>"Failed to create file" ]);exit;
	}

	$engine_setup = false;
	if( is_dir("../engine") ){

		$fn = "../config_global_engine.php";

		$enginedata = [
			"config_engine_key" 			=> $default_engine_key,
			"config_engine_app_id" 			=> $default_app_id,
			"config_apimaker_endpoint_url"	=> $defult_engine_url,
			"config_engine_path"			=> '/engine/',
			"config_engine_cache_interval"	=>	60, // seconds
			"config_engine_cache_refresh_action_query_string"	=>	["cache"=>"refresh"], // seconds
		];

		$vstr = '<'.'?'."php\n\n";
		$vstr .= "/* Last updated on " . date("Y-m-d H:i:s") . "*/\n\n";
		$vstr .= '$config_global_apimaker_engine = ' . var_export($enginedata,true) . ";\n\n";
		try{
			file_put_contents( $fn, $vstr );
			chmod( $fn, 0777 );
		}catch(Exception $ex){
			echo json_encode(["status"=>"error", "error"=>"Failed to create engine file: ".$fn." ". $ex->getMessage() ]);exit;
		}
		if( !file_exists( $fn ) ){
			echo json_encode(["status"=>"error", "error"=>"Failed to create file " . $fn ]);exit;
		}
		$engine_setup = true;
	}

	echo json_encode(["status"=>"success", "msg"=>"OK", "engine_setup"=>$engine_setup ]);

	exit;
}

// print_r( $variables );

	?>
	<html><head><title>Php LowCode Engine Maker V1 Installation</title></head>
	<body>
		<style>
			* { font-family:Arial; font-size:12px; }
			td{ border:0.5px solid #ccc; }
			body{ margin:50px; }
		</style>
		<script src="js/vue3.min.prod.js" ></script>
		<p><b>Php LowCode Engine Maker Installation Step 1 </b></p>
		<div id="app" >

		<div v-if="step=='one'" >
		<div style="padding:10px 0px;">
			<div v-if="loc_found" >
				<p>Config file location: {{ config_path }}</p>
			</div>
			<div v-else >
				<p>Config file location: <select v-model="config_path" >
				<option value="./config_global_apimaker.php" >./config_global_apimaker.php </option>
				<option value="../config_global_apimaker.php" >../config_global_apimaker.php </option>
				<option value="../../config_global_apimaker.php" >../../config_global_apimaker.php</option>
				<option value="/var/tmp/config_global_apimaker.php" >/var/tmp/config_global_apimaker.php</option>
				</select>
				</p>
			</div>
			<p style="color:gray;" >Storing config file in the code repository prone to leakage of credentials leakage. <BR>Choose a parent folder above apache document root or system tmp folder.</p>
		</div>

		<table cellpadding="5"  cellspacing="0" border="0" style="border-collapse:collapsed;">
			<tr style="position: sticky; top:0px; background-color: #fec;">
				<td>Variable</td>
				<td>Value</td>
			</tr>
			<tr v-for="vd,vk in variables" valign="top">
				<td>
					<span v-if="'label' in vd" >{{ vd['label'] }}</span>
					<span v-else>{{ vk }}</span>
				</td>
				<td>
					<vitem v-bind:item="vd" ></vitem>
					<div v-if="'help' in vd" style="color:gray;" v-html="vd['help']" ></div>
					<div v-if="vk in errs" >
						<div v-if="errs[vk]" style="color:red;">{{ errs[vk ] }}</div>
					</div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<div><input type="button" value="VALIDATE" v-on:click="submit" ></div>
					<div v-if="voption==1" >
						<label><input type="checkbox" v-model="force_update"  > Do you want to replace previous installation? </label>
					</div>
					<div v-if="voption==2" >
						<label><input type="checkbox" v-model="force_update" > Do you want to ignore installation which already exists with different prefix? </label>
					</div>
					<div v-if="err" style="color:red; padding: 10px; margin:10px 0px; border:1px solid orange;" v-html="err" ></div>
					<div v-if="msg" style="color:blue; padding: 10px; margin:10px 0px; border:1px solid #333;" v-html="msg" ></div>
				</td>
			</tr>
		</table>
		</div>
		<div v-if="step=='two'" >
			<div v-if="msg" style="color:blue; padding: 10px; margin:10px 0px; border:1px solid #333;" v-html="msg" ></div>
			<div style="padding: 10px; margin:10px 0px; " >
				<div v-if="engine_setup">
					<p>Engine is ready to use at the default path: https://<?=$_SERVER['HTTP_HOST'] ?>/engine/</p>
					<p>You can rename or host /engine/ codebase on a different virtual instance(s).</p>
					<p>Please make sure engine codebase can always connect to maker url and database is in same local network.</p>
				</div>
				<p v-else>Go to app settings to setup engine in your desired location</p>
			</div>
		</div>

		</div>
		<script>
		var vitem = {
			data: function(){
				return {
				};
			},
			props: ["item"],
			mounted: function(){
				if( this.item['t'] =="list" ){
					if( typeof(this.item['v']) != "object" || "length" in this.item['v'] == false ){
						if( 'default_value' in this.item){
							this.item['v'] = JSON.parse(JSON.stringify(item['default_value']));
						}else{
							console.log("default value not found");
						}
					}
				}else if( this.item['t'] =="object" ){
					if( typeof(this.item['v']) != "object" || "length" in this.item['v']==false ){
						if( 'default_value' in this.item ){
							this.item['v'] = [JSON.parse(JSON.stringify(item['default_value']))];
						}else{
							console.log("default value not found");
						}
					}
				}
			},
			methods: {

			},
			template: `<div>
				<div v-if="item['t']=='text'||item['t']=='password'||item['t']=='number'">
					<div v-if="'fixed' in item" >{{ item['v'] }}</div>
					<input v-else-if="'tip' in item" v-bind:type="item['t']" v-model="item['v']" v-bind:title="item['tip']" >
					<input v-else v-bind:type="item['t']" v-model="item['v']" >
				</div>
				<input v-else-if="item['t']=='boolean'" type="checkbox" v-model="item['v']" >
				<select v-else-if="item['t']=='dropdown'" v-model="item['v']" >
					<template v-if="'datalist' in item" >
						<option v-for="d,di in item['datalist']" v-bind:value="d" >{{ d }}</option>
					</template>
					<template v-else-if="item['list']=='timezones'" >
						<option v-for="d,di in $root.timezones" v-bind:value="d" >{{ d }}</option>
					</template>
				</select>
				<template v-else-if="item['t']=='list'" >
					<vlist v-if="typeof(item['v'])=='object'&&'length' in item['v']" v-bind:items="item['v']" v-bind:default_item="item['default_item']"  ></vlist>
				</template>
				<template v-else-if="item['t']=='object'" >
					<vobject v-if="typeof(item['v'])=='object'&&'length' in item['v']"  v-bind:items="item['v']" v-bind:default_item="item['default_item']"  v-bind:fixed="item['fixed']"  ></vobject>
				</template>
				<div v-else>{{ item }}</div>
			</div>`
		};
		var vlist = {
			data: function(){
				return {
				};
			},
			props: ["items", "default_item"],
			methods: {
				addit: function(){
					this.items.push(JSON.parse(JSON.stringify(this.default_item)));
				},
				delit: function(vi){
					this.items.splice(vi,1);
				}
			},
			template: `<div>
				<div>[</div>
				<ul>
				<li v-for="v,i in items" >
					<div style="border:1px solid #ccc; display:flex; gap:10px; " >
						<input type="button" value="X" v-on:click="delit(i)" >
						<vitem v-bind:item="v" ></vitem>
					</div>
				</li>
				<li><input type="button" value="+" v-on:click="addit" ></li>
				</ul>
				<div>]</div>
			</div>`
		};
		var vobject = {
			data: function(){
				return {
					"new_key": ""
				};
			},
			props: ["items", "default_item", "fixed"],
			methods: {
				addit: function(){
					this.items.push(JSON.parse(JSON.stringify(this.default_item)));
				},
				delit: function(vi){
					this.items.splice(vi,1);
				}
			},
			template: `<div>
			<div>{</div>
			<table cellpadding="5" cellspacing="0" border="0" style=" margin-left:20px;border-collapse:collapsed;">
				<tr v-for="vd,vk in items" >
				 	<td v-if="fixed==false" ><input type="button" value="X" v-on:click="delit(vk)" ></td>
					<td>
						<vitem v-bind:item="vd['key']" >
					</td>
					<td>
						<vitem v-bind:item="vd['val']" >
					</td>
				</tr>
				<tr v-if="fixed==false">
					<td><input type="button" value="+" v-on:click="addit" ></td>
					<td></td>
					<td></td>
				</tr>
			</table>
			<div>}</div>
			</div>`
		};
		var msg = Vue.ref("");
		var app = Vue.createApp({
			data: function(){
				return {
					"timezones": <?=json_encode(get_timezones()) ?>,
					"variables": <?=json_encode($variables) ?>,
					"msg": "",
					"err": "",
					"errs": {},
					"config_path": "<?=$file_loc ?>",
					"loc_found": <?=$loc_found?"true":"false" ?>,
					"voption": -1,
					"force_update": false,
					"step":"one",
					"engine_setup":false,
				};
			},
			mounted: function(){
				var e = {};
				for(var k in this.variables ){
					e[ k ] = "";
				}
				this.errs = e;
			},
			methods: {
				submit: function(){
					this.err = "";
					for(var k in this.variables ){
						var e = this.is_it_ok(this.variables[ k ]);
						this.errs[ k ] = e;
						if( e ){
							this.err = "Please correct values of items where errors are shown";	
						}
					}
					if( this.err == "" ){
						this.submit2();
					}
				},
				submit2: function(){
					setmsg = this.setmsg;
					seterr = this.seterr;
					setoption = this.setoption;
					setstep = this.setstep;
					this.msg = "Submitting...";
					vpost = "action=saveconf&force_update="+this.force_update+"&config_path="+encodeURIComponent(this.config_path)+"&data="+encodeURIComponent(JSON.stringify(this.variables));
					var con = new XMLHttpRequest();
					con.open("POST","?", true);
					con.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					con.onload = function(){
						setmsg("");
						console.log( this.responseText );
						try{
							var d = JSON.parse(this.responseText);
							if( 'status' in d == false ){
								seterr( "Invalid Response: status tag missing" );
							}else if( d['status'] == "success" ){
								console.log("ok");
								setmsg( "Successfully Updated.<BR>For security reasons, please delete __install.php<BR>start using application and you can manually tweak the config file as required." );
								setstep("two", d['engine_setup']);
							}else if( d['status'] == "dbinitialized" ){
								setoption( 1 );
								seterr( "Database is already initialized. Do you want to ReInitialize?" );
							}else if( d['status'] == "dbinitialized2" ){
								setoption( 2 );
								seterr( d['error'] );
							}else{
								setoption( 0 );
								seterr( "Error: " + d['error'] );
							}
						}catch(e){
							seterr( "Incorrect Response: " + e );
						}
					}
					con.send(vpost);
				},
				setstep: function(m,v){this.step = m;this.engine_setup=v;},
				setmsg: function(m){this.msg = m;},
				seterr: function(m){this.err = m;},
				setoption: function(v){this.voption = v;},
				get_regexp: function(v){
					var vpr = v+'';
					//console.log( vpr );
					var vpr = vpr.split("/^");
					//console.log( vpr );
					var vpr2 = vpr[1].split("$/");
					//console.log( vpr2 );
					return new RegExp( "^"+vpr2[0]+'$', vpr2[1] );
				},
				is_it_ok: function(v){
					if( v['t'] == "text" || v['t'] == "password" ){
						if( v['v'] == "" || typeof(v['v']) != "string" ){
							return "Cannot be empty or Incorrect";
						}else if( 'validate' in v ){
							if( v['validate'] == "ip" ){
								if( v['v'].match( /^((25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\/(32|24|16|8|0)|\*)$/) == null ){
									return "Incorrect ip format";
								}
							}
						}else if( 'preg' in v ){
							var reg = this.get_regexp(v['preg'])
							//console.log( reg );
							if( v['v'].match( reg ) == null ){
								if( 'help' in v ){
									return v['help'];
								}
								return "Incorrect format";
							}
						}
					}else if( v['t'] == "number" ){
						if( v['v'] == "" || v['v'] === 0 ){
							return "Cannot be empty";
						}else if( 'preg' in v ){
							var reg = this.get_regexp(v['preg'])
							console.log( reg );
							if( (v['v']+'').match( reg ) == null ){
								return "Incorrect format";
							}
						}
					}else if( v['t'] == "boolean" ){
						if( v['v'] === "" || v['v'] === 0 ){
							return "Cannot be empty";
						}else if( typeof(v['v']) == "string" ){
							if( v['v'] != "true" || v['v'] == "false" ){
								return "Need true/false";
							}
						}
					}else if( v['t'] == "list" ){
						if( typeof(v['v']) != "object" || "length" in v['v'] == false ){
							return "Cannot be empty or Incorrect object";
						}else if( v['v'].length == 0 ){
							return "Cannot be empty ";
						}else{
							for( var i=0;i<v['v'].length;i++ ){
								var m = this.is_it_ok(v['v'][i]);
								if( m ){ return m; }
							}
						}
					}else if( v['t'] == "object" ){
						if( typeof(v['v']) != "object" || "length" in v['v'] == false ){
							return "Cannot be empty or Incorrect object";
						}else if( v['v'].length == 0 ){
							return "Cannot be empty ";
						}else{
							for( var i=0;i<v['v'].length;i++ ){
								if( 'key' in v['v'][i] == false ){
									return "Key Prop missing object";
								}
								if( 'val' in v['v'][i] == false ){
									return "Val Prop missing object";
								}
								console.log( v['v'][i]['val'] );
								var m = this.is_it_ok(v['v'][i]['key']);
								if( m ){ return "key Error: "+ m; }
								var m = this.is_it_ok(v['v'][i]['val']);
								if( m ){ return "Value Error: "+ m; }
							}
						}
					}
					return "";
				}
			}
		});
		app.component("vlist", vlist);
		app.component("vobject", vobject);
		app.component("vitem", vitem);
		app.mount("#app");
		</script>
	</body>
	</html>
	<?php

