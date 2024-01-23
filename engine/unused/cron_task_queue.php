<?php

//echo date("Y-m-d H:i:s", hexdec("618e22d1") );exit;
//echo "das";exit;
require("../config_global_settings.php");

require($_SERVER['DOCUMENT_ROOT']."class_mongodb.php");
require($_SERVER['DOCUMENT_ROOT']."class_mongodb_new.php");
$mongodb_con = new mongodb_connection( $config_mongo_host );
$mongodb_con->debug = $config_mongo_debug;
$mongodb_con->connect( $config_mongo_db );

/*$mongodb_conn = new mongodb_connection__( $config_mongo_host );
$mongodb_conn->debug = $config_mongo_debug;
$mongodb_conn->connect( $config_mongo_db );
*/

require("common_functions.php");
require("common_functions_aws.php");
//require("config_alias_domains.php");

$d = exec("whoami");
if( $d == "root" ){ echo "Should not be executed with root user"; exit; }

if( $_SERVER['HTTP_HOST'] || $_SERVER['REQUEST_URI'] ){
	echo "Should be executed command line"; exit;
}


echo date("Y-m-d H:i:s")."\n";

exec("ps -A -F | grep task_queue_thread", $out);
//print_r( $out );
$threads = [];
$scripts = [];
foreach( $out as $i=>$j ){
	//satish    7457     1  0 96652 26856   0 09:57 pts/0    00:00:00 php cron_task_queue_thread.php 61999272bb0317641b383a20 1
	$x = preg_split("/[\ ]+/", $j, 11);
	//print_r( $x );
	$threads[] = [
		"user"=>$x[0],
		"pid"=>$x[1],
		"ppid"=>$x[2],
		"c"=>$x[3],
		"sz"=>$x[4],
		"rss"=>$x[5],
		"psr"=>$x[6],
		"stime"=>$x[7],
		"tty"=>$x[8],
		"time"=>$x[9],
		"cmd"=>$x[10]
	];

	//php cron_task_queue_thread.php 6199c99cb4a0cd78332dc0e7 1
	preg_match( "/^php cron\_task\_queue\_thread\.php ([a-f0-9]{24}) ([0-9]+)/", $x[10], $m);
	if( $m ){
		if( $scripts[ $m[1] ][ $m[2] ] ){
			echo "\nfound double thread. killing now\n";
			exec("kill " . $x[1] );
		}else{
			$scripts[ $m[1] ][ $m[2] ] = $x[1];
		}
	}
}

if( $argv[1] == 'killall' ){
	foreach( $threads as $i=>$j ){
		exec("kill " . $j['pid'] );
	}
	echo "done";
	exit;
}

foreach( $scripts as $q=>$ts ){

}

$queues = $mongodb_con->find("task_queue");
foreach( $queues as $i=>$queue ){

	if( $queue['type'] == "async" ){
		for($t=1;$t<=$queue['t'];$t++){
			if( strtotime($queue['status'][$t]['last']) < time()-20 ){
				echo "\nQueue: " . $queue['des']  . " thread ".$t." not executing. restarting now";
				$cmd = "php cron_task_queue_thread.php " . $queue['_id'] . " ".$t." > /dev/null & ";
				echo "\n".$cmd ."\n";
				$d = exec( $cmd );
			}else{
				echo "\nQueue: " . $queue['des']  . " thread ". $t." is fine. " . $queue['status'][$t]['last'];
			}
		}
	}else if( $queue['type'] == "fifo" ){
		if( strtotime($queue['status'][1]['last']) < time()-20 ){
			echo "\nQueue: " . $queue['des']  . " thread 1 not executing. restarting now";
			$cmd = "php cron_task_queue_thread.php " . $queue['_id'] . " 1 > /dev/null & ";
			echo "\n".$cmd ."\n";
			$d = exec( $cmd );
		}else{
			echo "\nQueue: " . $queue['des']  . " thread 1 is fine. " . $queue['status'][1]['last'];
		}
	}

}
echo "\n";

?>