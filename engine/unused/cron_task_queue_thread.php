<?php

//echo date("Y-m-d H:i:s", hexdec("618e22d1") );exit;
//echo "das";exit;
require("../config_global_settings.php");

require($_SERVER['DOCUMENT_ROOT']."class_mongodb.php");
require($_SERVER['DOCUMENT_ROOT']."class_mongodb_new.php");
$mongodb_con = new mongodb_connection( $config_mongo_host );
$mongodb_con->debug = $config_mongo_debug;
$mongodb_con->connect( $config_mongo_db );

/*
$mongodb_conn = new mongodb_connection__( $config_mongo_host );
$mongodb_conn->debug = $config_mongo_debug;
$mongodb_conn->connect( $config_mongo_db );
*/

require("common_functions.php");
require("common_functions_aws.php");
//require("config_alias_domains.php");
require_once("class_api_engine.php");
require_once("common_functions_sqs.php");

$cron_start_time = time(); // for auto initialize on demand

$d = exec("whoami");
if( $d == "root" ){ echo "Should not be executed with root user"; exit; }

if( $_SERVER['HTTP_HOST'] || $_SERVER['REQUEST_URI'] ){
	echo "Should be executed command line"; exit;
}

if( sizeof($argv) < 3 ){
	echo "Need arguments!";exit;
}

$queue_id = $argv[1];
$thread_id = $argv[2];

if( !preg_match("/^[a-f0-9]{24}$/", $queue_id) ){
	echo "Incorrect arg 1 "; exit;
}
if( !preg_match("/^[0-9]+$/", $thread_id) ){
	echo "Incorrect arg 2 "; exit;
}
if( $thread_id > 5 ){
	echo "Threads > 5 is disabled "; exit;
}

while( 1 ){ //loop every 30 secs

	$queue = $mongodb_con->find_one("task_queue", ["_id"=>$queue_id]);
	if( !$queue ){
		echo "Queue record not found!";
		exit;
	}
	if( $queue['type'] == "fifo" ){
		if( $thread_id > 1 ){
			$mongodb_con->update_one("task_queue", [
				"status.".$thread_id.".last"=> date("Y-m-d H:i:s"),
				"status.".$thread_id.".queue"=> "nil",
				"status.".$thread_id.".status"=> "Terminated"
			], ["_id"=>$queue_id]);
			echo "extra fifo queue is ending...!"; exit;
		}
	}
	if( $queue['type'] == "async" ){
		if( $thread_id > $queue['t'] ){
			$mongodb_con->update_one("task_queue", [
				"status.".$thread_id.".last"=> date("Y-m-d H:i:s"),
				"status.".$thread_id.".queue"=> "nil",
				"status.".$thread_id.".status"=> "Terminated"
			], ["_id"=>$queue_id]);
			echo "extra async queue is ending...!"; exit;
		}
	}
	if( $queue['restart'] ){
		if( $queue['restart'] > $cron_start_time ){
			$mongodb_con->update_one("task_queue", [
				"status.".$thread_id.".last"=> date("Y-m-d H:i:s",time()-10),
				"status.".$thread_id.".queue"=> "nil",
				"status.".$thread_id.".status"=> "Restarting",
				"event"=>"restarted",
			], ["_id"=>$queue_id]);
			echo "Restarting!"; exit;
		}
	}

	$start_sub_loop = time();
	while( 1 ){

		$queue_con = new mongodb_connection( $config_mongo_task_queue_host );
		$queue_con->connect( $config_mongo_task_queue_db );

		try{
			$res = $queue_con->find_and_modify([
				"findandmodify"=>"queue",
				"query"=>["queue_id"=>$queue_id, "pick"=>['$lt'=>time()] ],
				"update"=>['$set'=>[ "pick"=>time()+15] ],
				"sort"=>[ "queue_id"=>1, "pick"=>1, "_id"=>1 ],
				"new"=>true,// to return modified document
			]);
			if( $res['status'] == "success" ){
				echo "\nSelected One\n";

				$task_data = $res['data'];

				$res = $mongodb_con->update_one("task_queue", [
					"status.".$thread_id.".last"=> date("Y-m-d H:i:s"),
					"status.".$thread_id.".queue"=> $task_data['_id'] . " " . $task_data['task']['app'] . " " . $task_data['task']['prop_name'],
					"status.".$thread_id.".status"=> "Running"
				], ["_id"=>$queue_id]);

				$api_engine = new api_engine();
				if( !$api_engine ){
					echo "Error initializing api engine!";exit;
				}

				$page = $mongodb_con->find_one("api_pages", ["_id"=>$task_data['task']['prop_id'] ]);
				$result = $api_engine->execute( $page, $task_data['inputs'], [
					"request_log_id"=>$mongodb_con->generate_id()
				]);

				$task_data['outputs'] = $result['outputs'];
				$task_data['log'] = $result['log'];
				$task_data['e_i'] = date("Y-m-d H:i:s");
				$task_data['by_thread'] = $thread_id;
				if( $result['status'] == "success" ){
					$task_data['res'] = 1;
					$task_data['c'] = "Success";
				}else{
					$task_data['res'] = 2;
					$task_data['error'] = $result['error'];
					$task_data['c'] = "Failed";
				}
				$res = $queue_con->delete_one("queue",["_id"=>$task_data['_id'] ]);
				$res = $queue_con->insert("queue_done", $task_data );

			}else{
				$res = $mongodb_con->update_one("task_queue", [
					"status.".$thread_id.".last"=> date("Y-m-d H:i:s"),
					"status.".$thread_id.".queue"=> "Empty",
					"status.".$thread_id.".status"=> "Running"
				], ["_id"=>$queue_id]);
				echo "\nNo message is pending\n";
				sleep(1);
			}
		}catch(Exception $ex){
			$res = $mongodb_con->update_one("task_queue", [
				"status.".$thread_id.".last"=> date("Y-m-d H:i:s"),
				"status.".$thread_id.".queue"=> "ERROR " . $em->getMessage(),
				"status.".$thread_id.".status"=> "Terminated",
			], ["_id"=>$queue_id]);
			exit;
		}

		if( (time()-$start_sub_loop) > 30 ){
			break;
		}
	}
}

?>