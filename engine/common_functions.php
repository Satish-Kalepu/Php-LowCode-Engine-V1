<?php

function print_pre( $v ){
	echo "<pre>";
	print_r( $v );
	echo "</pre>";
}
function print_json( $v ){
	echo "<pre>";
	echo json_encode($v,JSON_PRETTY_PRINT);
	echo "</pre>";
}

function get_request($options){
	$headers = [];
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $options['url'],
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_TIMEOUT => 2,
	  CURLOPT_CONNECTTIMEOUT=>1,
	  CURLOPT_FOLLOWLOCATION => false,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_HEADER => true,
	  CURLOPT_HTTPHEADER => $options['headers']?$options['headers']:[],
	));
	$response = curl_exec($curl);
	$info = curl_getinfo($curl);
	$erno = curl_errno($curl);
	if( $erno ){
		$err = $erno . ":" . curl_error($curl);
	}else{$err="";}
	curl_close( $curl );
	if( $erno ){
		$status = "error";$body = "";
	}else{
		$resp = explode("\r\n\r\n", $response);
		$body = $resp[ sizeof($resp)-1 ];
		$hh = $resp[ sizeof($resp)-2 ];
		$status = $info['http_code'];
		$hl = explode("\n", $hh);
		foreach($hl as $hi=>$hv){
			$hp = explode(':', $hv, 2);
			if (count($hp) < 2){continue;}
			$headers[strtolower(trim($hp[0]))] = trim($hp[1]);
		}
	}
	return [
		"status"=>$status,
		"headers"=>$headers,
		"body"=>$body,
		"error"=>$err
	];
}


function pass_hash( $pass ){
	global $config_global_engine;
	$ctx = hash_init('whirlpool');
	hash_update( $ctx, $config_global_engine['config_password_salt'] );
	hash_update( $ctx, $pass );
	return hash_final( $ctx );
}
function pass_encrypt( $data, $key= "" ){
	global $config_global_engine;
	if( !$key ){
		$key = $config_global_engine['config_encrypt_default_key'];
	}else if( !$config_global_engine['config_encrypt_keys'][ $key ] ){
		echo "Error in pass_encrypt key";exit;
	}
	if( strpos($data,$key.":") === 0 ){
		return $data;
	}
	$secret = $config_global_engine['config_encrypt_keys'][ $key ]['key'];

	$encrypted = @openssl_encrypt($data, "aes256", $secret);
	if( !$encrypted ){
		return "";
	}
	return $key.":".base64_encode($encrypted);
}
function pass_decrypt( $data ){
	global $config_global_engine;
	list($key,$data) = explode(":",$data,2);
	if( !$key ){
		return $data;
	}
	if( !$config_global_engine['config_encrypt_keys'][ $key ] ){
		echo "Error in pass_decrypt key";exit;
	}
	$secret = $config_global_engine['config_encrypt_keys'][ $key ]['key'];
	$decrypted =  openssl_decrypt(base64_decode($data), "aes256", $secret );
	return $decrypted;
}