<?php

if( $_GET['action'] == "app_backup" ){
	// $t = validate_token("backupnow.". $config_param1, $_POST['token']);
	// if( $t != "OK" ){
	// 	json_response("fail", $t);
	// }

	//header("Content-Type: text/plain");
	function enc( $data ){
		return $data;
		global $pass;
		if( $pass ){
			$encrypted = openssl_encrypt($data, "aes256", "abcdef".$pass);
		}else{
			$encrypted = openssl_encrypt($data, "aes256", "abcdef");
		}
		return $encrypted;
	}
	function dec( $data ){
		global $pass;
		if( $pass ){
			$encrypted = openssl_decrypt($data, "aes256", "abcdef".$pass);
		}else{
			$encrypted = openssl_decrypt($data, "aes256", "abcdef");
		}
		return $encrypted;
	}

	$tmfn = "/tmp/" . preg_replace("/\W/", "", $app['name']) . "_" . date("Ymd_His");
	$pass = $_GET['backup_pass'];
	$data = "";
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$res2 = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis_versions", [
			'_id'=>$j['version_id']
		]);
		$j['version_part'] = $res2['data'];
		$data.=json_encode($j) . "\n";
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_pages", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$res2 = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_pages_versions", [
			'_id'=>$j['version_id']
		]);
		$j['version_part'] = $res2['data'];
		$data.=json_encode($j) . "\n";
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_files", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$data.=json_encode($j) . "\n";
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_functions", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$res2 = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_functions_versions", [
			'_id'=>$j['version_id']
		]);
		$j['version_part'] = $res2['data'];
		$data.=json_encode($j) . "\n";
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$data.=json_encode($j) . "\n";
		$res2 = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_dt_" . $j['_id'], [
		]);
		foreach( $res2['data'] as $di=>$dj ){
			$data.=json_encode($dj) . "\n";
		}
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_databases", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$data.=json_encode($j) . "\n";
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_tables", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$data.=json_encode($j) . "\n";
	}

	if( $_GET['backup_pass'] ){
		$line = "BackupVersion:1;AppVersion:1;PasswordProtected:true;Hash:" . pass_hash2( $data, $pass );
	}else{
		$line = "BackupVersion:1;AppVersion:1;PasswordProtected:false;Hash:" . pass_hash2( $data, "version1" );
	}
	$data .= $line;
	header("Content-Type: text/plain");
	echo $data;exit;
	//$data2 = base64_encode(gzcompress($data));
	$data2 = gzcompress($data);
	//json_response(['status'=>"success","data"=>$data2]);
	$zipname = $app['name'] . "_backup_" . date("Ymd_His") . ".gz";
	ini_set('zlib.output_compression','Off');
	header('Content-Type: application/x-download');
	header('Content-Encoding: gzip'); #
	header('Content-Length: '.strlen($data2)); #
	header('Content-Disposition: attachment; filename="'.$zipname.'"');

	echo $data2;
	exit;
}