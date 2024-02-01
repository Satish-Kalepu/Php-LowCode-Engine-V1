<?php

if( $_POST['action'] == "exports_get_snapshots" ){
	$fp = dir("/tmp/phpengine_backups/");
	$f = [];
	while($fn = $fp->read() ){if( preg_match("/^[a-f0-9]{24}\_[0-9]+\_[0-9]+\.gz$/", $fn) ){
		$f[] = $fn;
	}}
	sort($f);
	json_response(['status'=>'success', 'snapshots'=>$f]);
}

if( $_POST['action'] == "app_backup" ){
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

	@mkdir("/tmp/phpengine_backups/",0777);
	$tmfn = "/tmp/phpengine_backups/".$app['_id'] . "_" . date("Ymd_His");
	$fp = fopen($tmfn, "w");
	$pass = $_POST['backup_pass'];

	$data = "";
	if( $_POST['backup_pass'] ){
		$line = "BackupVersion:1;AppVersion:1;PasswordProtected:true;Hash:" . pass_hash2( $data, $pass );
	}else{
		$line = "BackupVersion:1;AppVersion:1;PasswordProtected:false;Hash:" . pass_hash2( $data, "version1" );
	}
	$data .= $line . "\n";

	$data = json_encode($app) . "\n";
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_apis", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$j['__t'] = "apis";
		$res2 = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_apis_versions", [
			'_id'=>$j['version_id']
		]);
		$j['version_part'] = $res2['data'];
		$data .= json_encode($j) . "\n";
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_pages", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$j['__t'] = "pages";
		$res2 = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_pages_versions", [
			'_id'=>$j['version_id']
		]);
		$j['version_part'] = $res2['data'];
		$data .= json_encode($j) . "\n";
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_functions", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$j['__t'] = "functions";
		$res2 = $mongodb_con->find_one( $config_global_apimaker['config_mongo_prefix'] . "_functions_versions", [
			'_id'=>$j['version_id']
		]);
		$j['version_part'] = $res2['data'];
		$data .= json_encode($j) . "\n";
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_databases", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$j['__t'] = "databases";
		$data .= json_encode($j) . "\n";
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_tables", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$j['__t'] = "tables";
		$data .= json_encode($j) . "\n";
	}

	fwrite($fp, $data);

	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_files", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$j['__t'] = "files";
		fwrite($fp,json_encode($j) . "\n");
	}
	$res = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_tables_dynamic", [
		'app_id'=>$config_param1
	]);
	foreach( $res['data'] as $i=>$j ){
		$j['__t'] = "tables_dynamic";
		fwrite($fp,json_encode($j) . "\n");
		$res2 = $mongodb_con->find( $config_global_apimaker['config_mongo_prefix'] . "_dt_" . $j['_id'], [
		]);
		foreach( $res2['data'] as $di=>$dj ){
			fwrite($fp,"dt_" . $j['_id'] . ":" . json_encode($dj) . "\n");
		}
	}
	fclose($fp);
	//echo $tmfn;
	exec("gzip " . $tmfn);
	$tmfn .= ".gz";

	json_response(['status'=>"success", "temp_fn"=>str_replace("/tmp/phpengine_backups/", "", $tmfn), "sz"=>filesize($tmfn)]);
	exit;
}

if( $_GET['action'] == "download_snapshot" ){
	$fn = $_GET['snapshot_file'];
	$tmfn = "/tmp/phpengine_backups/". $fn;
	ini_set('zlib.output_compression','Off');
	header('Content-Type: application/x-download');
	//header('Content-Encoding: gzip'); #
	header('Content-Length: '.filesize($tmfn)); #
	header('Content-Disposition: attachment; filename="'.$fn.'"');
	readfile($tmfn);
	exit;
}

if( $_POST['action'] == "exports_restore_upload" ){
	if( file_exists( $_FILES['file']['tmp_name'] ) && filesize($_FILES['file']['tmp_name']) > 0  ){
		if( !preg_match("/^[a-f0-9]{24}\_[0-9]{8}\_[0-9]{6}\.gz$/",$_FILES['file']['name'] ) ){
			json_response(['status'=>"fail","error"=>"Filename format mismatch"]);
		}
		$fn = $_FILES['file']['tmp_name'] . ".gz";
		echo $fn;
		move_uploaded_file( $_FILES['file']['tmp_name'], $fn );
		if( !file_exists($fn) ){
			json_response(['status'=>"fail","error"=>"File upload failed 2"]);
		}
		$st = exec("gzip --uncompress " . $fn, $out);
		if( $st === false ){
			json_response(['status'=>"fail","error"=>"File uncompress failed"]);
		}
		$fp = fopen($_FILES['file']['tmp_name'], "r" );
		$data = "";
		$filestatus = "";
		$fpos = 0;
		while( $line = fgets($fp, 4096) ){
			$fpos = ftell($fp);
			if( !$line){break;}
			echo $line . "\n----\n";
			if( preg_match("/^BackupVersion/", $line) ){
				$filestatus = $line;
				break;
			}
			$data .= $line;
		}
		if( !$filestatus ){
			json_response(['status'=>"fail","error"=>"File incorrect data"]);
		}
		$bstats = explode(";", $filestatus);
		$bst=[];
		foreach( $bstats as $i=>$j ){if( $j ){
			$x = explode(":",$j);
			$bst[ $x[0] ] = $x[1];
		}}

		$newhash = pass_hash2( $data, $pass );
		if( $bst['Hash'] == $newhash ){
			echo "all ok";
		}else{
			json_response(['status'=>"fail","error"=>"File corrupted or Incorrect password"]);
		}

	if( $_POST['backup_pass'] ){
		$line = "BackupVersion:1;AppVersion:1;PasswordProtected:true;Hash:" . pass_hash2( $data, $pass );
	}else{
		$line = "BackupVersion:1;AppVersion:1;PasswordProtected:false;Hash:" . pass_hash2( $data, "version1" );
	}



	}else{
		json_response(['status'=>"fail","error"=>"File upload failed"]);
	}
	exit;
}