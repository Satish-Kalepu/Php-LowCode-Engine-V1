<?php

//echo date("Y-m-d H:i:s", hexdec("618e22d1") );exit;
//echo "das";exit;
require("../config_global_settings.php");
require("control_config.php");
require("common_functions.php");
require("common_functions_aws.php");
//require("config_alias_domains.php");

function api_request_log( $log_data, $error = "" ){
        global $mongodb_con;
        $log_data["timestamp"] = date('Y-m-d H:i:s');
        $log_data["ip"] = $_SERVER['REMOTE_ADDR'];
        $log_data["uid"] = $_SESSION['user_id'];
        if( $error ){
        	$log_data["status"] = "fail";
		$log_data["error"] = $error;
	}
        $result = $mongodb_con->insert("api_requests", $log_data);
	if( !$result ){
		echo "<p>There was an error!</p>";
		exit;
	}
        return true;
}

// ---------------------------------------------------------------------------------------------------

$test = [];
if( $_SERVER['REQUEST_METHOD']=="POST" && preg_match("/json/i", $_SERVER['CONTENT_TYPE']) ){
	$input_data = file_get_contents('php://input');
	$test = json_decode($input_data, true);
	if( json_last_error() ){
		$e = "JSON Parse Error: " . json_last_error_msg();
		if( $page['output-type'] == "application/json" ){
			header("Content-type: application/json");
			echo json_encode(["status"=>"fail", "error"=>$e ]);exit;
		}else{
			header("Content-type: " . $page['output-type']);
			echo json_encode(["status"=>"fail", "error"=>$e]);exit;
		}
	}
	//print_pre( $test );exit;
	if( $test == "" ){
		$e = "Input missing";
		if( $page['output-type'] == "application/json" ){
			header("Content-type: application/json");
			echo json_encode(["status"=>"fail", "error"=>$e ]);exit;
		}else{
			header("Content-type: " . $page['output-type']);
			echo json_encode(["status"=>"fail", "error"=>$e]);exit;
		}
	}
}else{
	if( $page['output-type'] == 'application/json' ){
		header("Content-Type: application/json");
		echo json_encode(["status"=>"fail", "error"=>"Incorrect Input method/Content-type" ]);exit;
	}else{
		header("Content-Type: " . $page['output-type']);
		echo json_encode(["status"=>"fail", "error"=>"Incorrect Input method/Content-type" ]);exit;
	}
}
$result = [];
$test = [
	"server"=>$_SERVER,
	"body"=>$data
];

api_request_log([
	"_id"=>$request_log_id,
	"type"=>"function",
	"api_key"=>"",
	"status"=>$result['status'],
	"source_from"=> "APIEdit",
	"error"=>$result['error'],
	"inputs"=>$test,
	"outputs"=>filter_result( $result['outputs'] ),
	"log"=>filter_result( $result['log'] ),
]);

echo json_encode(["statusCode"=>200,"body"=>""]);

exit;


function url_repl($m){
	return "\\" . $m[0];
}
if( $_GET["version_id"] ){
        $page = $mongodb_con->find_one("api_pages_versions", ["_id"=>$_GET['version_id']] );
        //print_pre( $page );exit;
	$url_inputs = [];
	$url_page_id = "";
	$app = $mongodb_con->find_one("api_apps", ["_id"=>$page["app"]["_id"]] );
	$pr = $page['reg_url'];
	$pr = preg_replace_callback("/\W/", "url_repl", $pr);
	$pr = str_replace("regexp\\-number", "([0-9]+)", $pr);
	$pr = str_replace("regexp\\-text", "([a-z0-9\-\_]+)", $pr);
	$pr = "/^" . $pr . "$/i";
	if( preg_match( $pr, "/" . $path, $m ) ){
		$url_page_id = $page['page_id'];
		foreach( $m as $mi=>$mj ){
			if( $mi>0 ){
				$url_inputs[ $page['url_inputs'][ $mi-1 ]['variable'] ] = $mj;
			}
		}
	}
}else{
	$url_inputs = [];
	$url_page_id = "";
	$app = $alias_rec['app'];
	foreach( $alias_rec['pages'] as $reg_url=>$j ){
		//echo "<div>" . $j['url'] . "</div>\n";
		if( $j['url'] == "/".$path ){
			$url_page_id = $j['page_id'];
		}else if( $j['inputs'] ){
			$pr = $reg_url;
			$pr = preg_replace_callback("/\W/", "url_repl", $pr);
			$pr = str_replace("regexp\\-number", "([0-9]+)", $pr);
			$pr = str_replace("regexp\\-text", "([a-z0-9\-\_]+)", $pr);
			$pr = "/^" . $pr . "$/i";
			if( preg_match( $pr, "/" . $path, $m ) ){
				$url_page_id = $j['page_id'];
				foreach( $m as $mi=>$mj ){
					if( $mi>0 ){
						$url_inputs[ $j['inputs'][ $mi-1 ]['variable'] ] = $mj;
					}
				}
			}
		}
	}
	if( !$url_page_id ){
		header("http/1.1 404 not found");
		header("content-type: text/plain");
		header("stage: one");
		echo $_SERVER['HTTP_REALHOST'] . "\n\nPage/API not found! 2";
		exit;
	}
	$page = $mongodb_con->find_one("api_pages", [ "app._id"=>$app['_id'], "_id"=>$url_page_id] );
	//print_pre($page);exit;
}


if( !$page ){
	header("http/1.1 404 not found");
	header("content-type: text/plain");
	header("stage: one");
	echo $_SERVER['HTTP_REALHOST'] . "\n\nPage/API not found!";
	exit;
}
//print_pre( $page );exit;

$request_log_id = $mongodb_con->generate_id();
require_once("class_api_engine.php");
require_once("common_functions_sqs.php");

$test = [];
//print_pre( $url_inputs );exit;
$test['url_inputs_'] = $url_inputs;

$api_engine = new api_engine();
if( !$api_engine ){
	echo "Error initializing api engine!";exit;
}
$result = $api_engine->execute( $page, $test, [
	"request_log_id"=>$request_log_id
]);
//print_pre( $result );exit;
function filter_result( $res ){
	$r = [];
	foreach( $result_ as $i=>$j ){
		if( !$i ){$i = "Undefined";}
		if( gettype($j) == "string" ){
			if( strlne($j) < 250 ){
				$r[ $i ] = substr($j,0,250);
			}else{
				$r[ $i ] = $j;
			}
		}else if( is_array($j) == "" ){
			$r[ $i ] = filter_result( $j );
		}else{
			$r[ $i ] = $j;
		}
	}
	return $r;
}
//$log = filter_result($result['log']);
//print_pre( $_SESSION );exit;
api_request_log([
	"_id"=>$request_log_id,
	"api_key"=>"",
	"status"=>$result['status'],
	"source_from"=> "APIEdit",
	"error"=>$result['error'],
	"inputs"=>$test,
	"outputs"=>filter_result( $result['outputs'] ),
	"log"=>filter_result( $result['log'] ),
]);

?>