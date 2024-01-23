<?php

require( "../config_global_settings.php" );

require($_SERVER['DOCUMENT_ROOT']."class_mongodb.php");
$mongodb_con = new mongodb_connection( $config_mongo_host );
$mongodb_con->debug = $config_mongo_debug;
$mongodb_con->connect( $config_mongo_db );

$data = file_get_contents("php://input");
$data = json_decode($data,true);
if( is_array($data) && $data != "" ){
	$mongodb_con->insert("log_static_form",$data);
	header("content-type: application/json");
	echo json_encode(["status"=>"success"]);
}else{
	header("content-type: application/json");
	echo json_encode(["status"=>"fail", "error"=>"incorrect request"]);
}

?>