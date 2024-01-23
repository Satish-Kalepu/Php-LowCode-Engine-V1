<?php

	$config_max_sessions_per_ip = 5;

	//$res2 = $mongodb_con->count( $config_global_apimaker['config_mongo_prefix'] . "_sessions", ['ip'=> $_SERVER['REMOTE_ADDR'] ] );

	$redis_key = "apimaker:".$_SERVER['HTTP_HOST'].":".$_SERVER['REMOTE_ADDR'];
	// depends on $config_global_apimaker['config_use_redis'] = true;

	$skip = false;
  	if( $_GET['check'] == "session" ){$skip = true;}
	if( $_GET['action'] == "clearblock" ){$skip = true;}

	if( !session_id() ){
		header("http/1.1 500 Server Error");
		echo "<html><body><div>Dos Blocker. Configuration Error. session not found </div></body></html>";
		exit;
	}

if( $skip == false ){

	$sess_id = md5( session_id() );

	if( $config_global_apimaker['config_use_redis'] ){
		if( !$con_redis_security ){
			header("http/1.1 500 Server Error");
			echo "<html><body><div>Dos Blocker. Configuration Error. redis cache not found</div></body></html>";
			exit;
		}

		$sessions = $con_redis_security->hgetall( $redis_key );
		if( !$sessions ){
			$sessions = array();
		}
		foreach( $sessions as $i=>$j ){
			if( $j < time()-(120) ){
				unset($sessions[$i]);
				$con_redis_security->hdel( $redis_key, $i );
			}
		}
		if( $_GET['test'] ){ echo "<pre>"; print_r( $sessions ); echo "</pre>"; }
		$total_active_sessions = sizeof( $sessions );
		if( $_GET['test'] ){ echo "<div>Sessions: ".  $total_active_sessions . "</div>"; }
		if( $total_active_sessions < $config_max_sessions_per_ip+5 ){
			$con_redis_security->hset( $redis_key, $sess_id, time() );
			$con_redis_security->expire( $redis_key, 120 );
		}
		if( $total_active_sessions > $config_max_sessions_per_ip ){
			if( $_GET['ajax_type'] == "json" || $_POST['ajax_type'] == "json" ){
				header("content-type: application/json", true);
				echo json_encode(array("status"=>"fail", "details"=>"Request blocked. Please try again in sometime!"));
				exit;
			}
			header("http/1.1 403 Forbidden");
			header("Stage: 3434");
			echo "<h4>Temporarily Forbidden</h4>
			<p>Too many active sessions from your IP.".$_SERVER['REMOTE_ADDR']."</p>
			<p>Site is temporarily forbidden for unusual sources</p>
			<p>Please try again in 5 Minutes</p>";
			exit;
		}

	}

	list($v,$t) = $_SESSION['v'];
	$d = (time()-$t);
	header("Stream: " . $v . "-". $d );
	if( $_GET['test'] ){ echo "<dvi>". $v . ": " . $d . "</div>"; }
	if( $_GET['test'] ){ echo "<pre>"; print_r( $_SESSION['u'] ); echo "</pre>"; }
	if( $d <= 1 ){ 
		$v = $v + 1; 
	}else if( $d > 15 ){
		$v = 1;
	}else if( $d > 5 && $v > 1 ){
		$v = $v - 2;
	}
	$_SESSION['v'] = array( $v, time() );

	if( $v > 50 && false ){
		if( $_GET['ajax_type'] == "json" || $_POST['ajax_type'] == "json" ){
			header("Content-Type: application/json", true);
			echo json_encode(array("status"=>"fail", "details"=>"Request blocked. Please try again in sometime!"));
			exit;
		}
		header("http/1.1 403 Forbidden");
		header("Stage: 53663");
		echo "<h4>Temporarily Forbidden</h4>
		<p>Too many requests in a short period of time.</p>
		<p>Site is temporarily forbidden for unusual sources</p>
		<p>Please try again in a moment</p>
		<p id='ssd' ></p>
		</div>
		<script>
		var ct =15;
		function countit(){document.getElementById('ssd').innerHTML=ct--;}
		setTimeout(\"document.location.reload()\",15000);setInterval(\"countit()\",1000);
		</script>";
		exit;
	}

}
