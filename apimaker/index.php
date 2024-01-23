<?php

/* backend maker */

if( ini_get("session.cookie_httponly") != "1" || ini_get("session.cookie_httponly") != 1 ){
	header("http/1.1 403 forbidden");
	header("ERROR: Incorrect session.cookie_httponly configuration");
	echo "<p style='font-family:Arial;font-size:24px;'>session.cookie_httponly missing</p>";
	echo "<p style='font-family:Arial;font-size:14px;'>OWASP top 10 complaince issues.</p>";
	exit;
}
if( ini_get("session.cookie_secure") != "On" ){
	header("http/1.1 403 forbidden");
	header("ERROR: Incorrect session.cookie_secure");
	echo "<p style='font-family:Arial;font-size:24px;'>session.cookie_secure flag missing</p>";
	echo "<p style='font-family:Arial;font-size:14px;'>OWASP top 10 complaince issues.</p>";
	exit;
}

require_once( "../../config_global_apimaker.php" );
require_once( "config.php" );

$request_uri = $_GET['request_url']?$_GET['request_url']:"";
$parts = parse_url( $request_uri );
$x = explode( "/" , $parts['path'] );

$config_page = $x[0];
if(sizeof($x)>1){$config_param1=$x[1];}
if(sizeof($x)>2){$config_param2=$x[2];}
if(sizeof($x)>3){$config_param3=$x[3];}
if(sizeof($x)>4){$config_param4=$x[4];}
if(sizeof($x)>5){$config_param5=$x[5];}
if(sizeof($x)>6){$config_param6=$x[6];}
if(sizeof($x)>7){$config_param7=$x[7];}
if(sizeof($x)>8){$config_param8=$x[8];}

if( $_SERVER['HTTP_USER_AGENT'] == "" ){
	header("http/1.1 400 Bad Request" );
	exit;
}

if( $_SERVER['HTTP_X_FORWARDED_FOR'] ){
    $d = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR'] );
    $_SERVER['REMOTE_ADDR'] = trim($d[0]);
    $_SERVER['HTTP_X_REAL_IP'] = trim($d[0]);
}else{
    $_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_REAL_IP']?$_SERVER['HTTP_X_REAL_IP']:$_SERVER['REMOTE_ADDR'];
}

if( $_SERVER['REQUEST_METHOD']=="POST" && preg_match("/json/i", $_SERVER['CONTENT_TYPE']) ){
	$input_data = file_get_contents('php://input');
	$_POST = json_decode($input_data, true);
	if( json_last_error() ){
		error_log("Error parsing json post event: " . $_SERVER['REQUEST_URI'] . ": " . $input_data );
		header("http/1.1 400 Request ERROR");
		echo "JSON Parse Error: " . json_last_error_msg();
		exit;
	}
}

if( !$config_global_apimaker[ 'config_session_timeout'] ){
	header("http/1.1 400 Bad Request" );
	echo "<p style='font-family:Arial;font-size:24px;'>session.cookie_timeout flag missing</p>";
	echo "<p style='font-family:Arial;font-size:14px;'>OWASP top 10 complaince issues.</p>";
	exit;
}

if( session_id() != "" ){
	header("http/1.1 500 Bad Request" );
	echo "<p style='font-family:Arial;font-size:24px;'>incorrect session initialization or unexpected session override.</p>";
	exit;
}

$session_name = 'apimaker';
ini_set( 'session.name', $session_name );
ini_set( 'session.cookie_path', $config_global_apimaker_path );

if( $config_global_apimaker['config_use_redis'] ){
	ini_set( 'session.save_handler', "redis" );
	ini_set( 'session.save_path', "tcp://".$config_global_apimaker['config_redis_host'].":".$config_global_apimaker['config_redis_port'] );
}

if( $_COOKIE[$session_name] ){
	session_start();
	if( $_SESSION['ua'] ){
		if( $_SESSION['ua'] != $_SERVER['HTTP_USER_AGENT'] || $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] ){
			session_destroy();
			session_regenerate_id();
			header("Location: " . $config_global_apimaker_path . "?event=Session_unRecognised");
			exit;
		}
	}
	if( !$_POST['action'] && !$_GET['action'] ){
		setcookie( $session_name, session_id(), (time()+$config_global_apimaker[ 'config_session_timeout']), $config_global_apimaker_path, "", TRUE, TRUE);
	}
}else{
	unset($_GET[ $session_name ]);
	session_start();
	$_SESSION['ua'] = $_SERVER['HTTP_USER_AGENT'];
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
}

require( "common_functions.php" ); /* here because of echo403 function */

if( $config_page == "" && $_SESSION['apimaker_loggedin'] == 'y' ){
	$config_page = "home";
}else if(  $config_page == "" ){
	$config_page = "login";
}

if( isset($_GET['check']) && $_GET['check'] == 'session' ){
	if( $_SESSION['apimaker_loggedin'] != 'y' ){
	 	echo403json();
	}
}

require( "control_config.php" );
require( "common_dos_blocker.php" );

if( $_GET['action'] == "logout" ){
	session_destroy();
	session_regenerate_id();
	header("Location: " . $config_global_apimaker_path . "login?event=Logout");
	exit;
}

if( $config_global_apimaker['config_allow_concurrent_login'] == false ){
	if( $_SESSION['apimaker_loggedin'] == 'y' ){ // concurrent login check
		if( $_POST['action'] != "login" ){
			$col = $config_global_apimaker['config_mongo_prefix'] . "_vars";
			$res = $mongodb_con->find_one( $col, [ "_id"=> "login_session" ] );
			if( $res['status'] != 'success' ){
				echo500("Concurrent session check: DB Error: " . $res['error']);
			}
			if( $res['data']['value'] != session_id() ){
				session_destroy();
				session_regenerate_id();
				header("Location: " . $config_global_apimaker_path . "login?event=SessionTakeOver");exit;
			}
			$res = $mongodb_con->update_one( $col, [ "_id"=> "login_session" ], ['time'=>date("Y-m-d H:i:s") ] );
			if( $res['status'] != 'success' ){
				echo500("Concurrent session check: DB Error: " . $res['error']);
			}
		}
	}
}

if( !$_SESSION['apimaker_login_ok'] && $config_page != "login" && $config_page != "captcha" && $config_page != "install" ){
	if( $_POST['action'] || $_GET['action'] ){
		json_response("fail", "SessionExpired");
	}
	header("Location: " . $config_global_apimaker_path . "login?event=SessionExpired");
	exit;
}

if( $_SESSION['apimaker_login_ok'] && $config_page == "login" ){
	header("Location: " . $config_global_apimaker_path . "home");
	exit;
}

if($goto_install){$config_page="install";}

if( $_SESSION['apimaker_login_ok'] ){
	$res = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_users", ['_id'=>$_SESSION['apimaker_login_id']], ['projection'=>['password'=>false]] );
	if( $res['data'] ){
		// check if user active;
		$login_user = $res['data'];
	}else{
		session_destroy();
		session_regenerate_id();
		header("Location: " . $config_global_apimaker_path . "login?event=UserNotFound");
		exit;
	}
}

require_once( "common_controll.php" );

if( $config_page != "" ){
	$controllerfile = "page_" . $config_page . "_controll.php";
	if( file_exists( $controllerfile ) ){
		require_once( $controllerfile );
	}
}

if( $config_layout ){
	require("layout_".$config_layout.".php");
}else{
	require("layout_main.php");
}
