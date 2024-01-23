<?php

/* Note:  redis security host and .htaccess sessions redis are same */
/**
* [getUserIPAdrss get user ipdaddress]
* @return [type] [description]
*/

if( $_SERVER['HTTP_X_FORWARDED_FOR'] ){
	$d = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR'] );
	if( sizeof($d) == 2 ){
		$_SERVER['REMOTE_ADDR'] = trim($d[0]);
		$_SERVER['HTTP_X_REAL_IP'] = trim($d[1]);
	}else if( sizeof($d) == 3 ){
		$_SERVER['REMOTE_ADDR'] = trim($d[1]);
		$_SERVER['HTTP_X_REAL_IP'] = trim($d[2]);
	}
}else{
	$_SERVER['REMOTE_ADDR'] = $_SERVER['HTTP_X_REAL_IP']? $_SERVER['HTTP_X_REAL_IP']:$_SERVER['REMOTE_ADDR'];
}
$config_trusted_hosts = ["backendlessapps.com"]; 
//$config_trusted_hosts = ["testapi.wikia2z.com", "www.wikia2z.com", "test.wikia2z.com","www.backendlessapps.com"]; 

if( $_SERVER['HTTP_HOST'] == "backendlessapps.com" ){ 
	$config_redis_security_host = "localhost";
	$config_redis_security_port = 6379;
	$config_redis_event_host =  "localhost";
	$config_redis_event_port = 6379;
	$config_PE_database = 'Test_Finance_Stats';
}else{
	header('HTTP/1.1 500 server error');
	echo "<html><head></head><body>Configuration item 09 incorrect</body></html>";
	exit;
}

$config_dos_block_msg = "<html>
<head>
	<title>WikiA2Z API</title>
	<link rel=\"stylesheet\" href=\"/css/bootstrap.min.simplex.css\">
</head>
<body>
<div class=\"container-fluid\">
<header>
	<div style=\"position:fixed;z-index:555;left:0px;top:0px;width:100%;height:40px; background-color:#1a3887;\">
		<a href=\"/\" style=\"margin:8px 15px; float:left;color:white; font-weight:bold; line-height:23px;text-decoration:none; font-size:16px;\">API WikiA2Z</a>
		<p>&nbsp;</p>
	</div>
	<div style=\"height:40px;\">&nbsp;</div>
</header>
<html><body><h3>Temporarily Forbidden</h3>
<p>Unfortunately we have found very unusual volume of malicious traffic originated from your IP address.</p>
<p>Site is temporarily forbidden for unusual sources</p>
<p>Please try again after an hour</p>
</div>
</body>
</html>";

function getUserIPAdrss(){
	if( $_SERVER['HTTP_X_FORWARDED_FOR'] ){
		$d = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR'] );
		if( sizeof($d) == 2 ){
			return $_SERVER['REMOTE_ADDR'] = trim($d[0]);
			//$_SERVER['HTTP_X_REAL_IP'] = trim($d[1]);
		}else if( sizeof($d) == 3 ){
			return $_SERVER['REMOTE_ADDR'] = trim($d[1]);
			//$_SERVER['HTTP_X_REAL_IP'] = trim($d[2]);
		}
	}else{
		return $_SERVER['HTTP_X_REAL_IP']? $_SERVER['HTTP_X_REAL_IP']:$_SERVER['REMOTE_ADDR'];
	}
}
	
$con_redis_security = new Redis();
if( !$con_redis_security->connect($config_redis_security_host,$config_redis_security_port,1) ){
	$con_redis_security = false;
	$rediserror = "Redis Connection ERROR - ".$_SERVER['REQUEST_URI']." .; Filename=".$_SERVER['PHP_SELF']."; Errornote:- securty server is unavailable for $config_redis_security_host:$config_redis_security_port";
	error_log($rediserror);
	header('HTTP/1.1 500 server error');
	echo "<html><head></head><body>Configuration item 11 incorrect</body></html>";
	exit;

}else if( $con_redis_security->role()[0] <> 'master' ){
	error_log($_SERVER['HTTP_HOST'].' - Redis Role not Master :'.json_encode($con_redis_security));
	header('HTTP/1.1 500 server error');
	echo "<html><head></head><body>Configuration item 12 incorrect</body></html>";
	exit;
}

if( isset( $_SERVER['HTTP_ORIGIN'], $_SERVER['HTTP_REFERER'] ) ){
	$f = true;
	foreach($config_trusted_hosts as $_thost) {
		if( stripos($_SERVER['HTTP_ORIGIN'],$_thost) == FALSE && stripos($_SERVER['HTTP_REFERER'],$_thost) == FALSE ){
			$f = false;
		}
	}
	if($f){
		header('HTTP/1.1 400 Bad Request');
		echo "<html><head></head><body>Request out of trusted origin!</body></html>";
		exit;
	}
}
   

?>