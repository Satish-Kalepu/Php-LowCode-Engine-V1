<?php

if( $param1 == "get" ){

	$keys = $config_global_apimaker;
	unset( $keys['config_engine_keys'] );
	json_response([
		"status" => "success",
		"configs" => $keys
	]);

}