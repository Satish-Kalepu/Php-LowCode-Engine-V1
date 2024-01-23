<?php

function sqs_push_event_fail_log( $data ){
	$fp = fopen( str_replace("//", "/", $_SERVER['DOCUMENT_ROOT'] . "/sqs_event_fail.log"), "a" );
	fwrite( $fp, date("Y-m-d H:i:s") . ": " . json_encode($data) ."\n" );
	fclose($fp);
}

function sqs_push_event( $data, $wait = 0, $queue = "" ){
	require_once( ($_SERVER['DOCUMENT_ROOT']?$_SERVER['DOCUMENT_ROOT']:__DIR__) . '/events/sdk/vendor/autoload.php' );
	$sqsclient = new Aws\Sqs\SqsClient([
	    'region' => 'ap-south-1',
	    'version' => '2012-11-05',
	    'credentials' => array(
		'key'    => 'AKIAXFMLGZ42SVGBLHPU',
		'secret' => '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',
	    )
	]);
	if( !$queue ){
		return "Error: SQS Push: Queue URL Missing";
	}
	if( !$data["async_task_id"] ){
		return "Error: SQS Push: Async task id required! for sqs push";
	}
	try{
		$msg = json_encode($data);
		if( !$msg ){
			$e = "send sqs_event: json encode fail: " . json_last_error();
			error_log( $_SERVER['PHP_SELF'] . ": " . $e );
			if( $stop_on_error ){
				echo $e;exit;
			}
			return array("status"=>"fail", "body"=>$e );
		}else{
			$params = [
			    'MessageBody' => $msg,
			    //'MessageGroupId'=> "async_task_queue",
			    'QueueUrl' => $queue,
			];
			if( $wait ){
				$params['DelaySeconds'] = (int)$wait;
			}
			try{
				$result = $sqsclient->sendMessage($params);
				//echo "<pre>";print_r( $result );echo "</pre>";
				return "success";
			}catch( Aws\Exception\AwsException $e ){
				sqs_push_event_fail_log($msg);
				$e = "sqs_event response: " . $e->getMessage();
				error_log( $_SERVER['PHP_SELF'] . ": " . $e );
				return $e;
			}
		}
		return "success";	
	}catch(Exception $e){
		$e = "sqs event response: " . $e->getMessage();
		error_log( $_SERVER['PHP_SELF'] . ": ".$e );
		return $e;
	}	
}

?>