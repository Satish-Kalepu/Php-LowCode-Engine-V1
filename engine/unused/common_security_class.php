<?php 
/*
Security class Created on Apr 04 2017 - fz
*/

if( !$config_redis_event_host || !$config_redis_event_port ){
	header('HTTP/1.1 500 server error');
	echo "<html><head></head><body>Configuration item 14 incorrect</body></html>";
	exit;
}

function get_token1(){
	return md5(session_id().getUserIPAdrss() );
}
function get_token2(){
	$d = time();
	$t2 = md5(session_id() . $d);
	$_SESSION['token2'][ $d ]=$t2;
	return [$d, $t2];
}
function print_token2($return=false){
	$t2 = get_token2();
	$vstr = "<input type='hidden' id='security_token2' name='security_token2' value='".$t2[1]."' ><input type='hidden' name='security_token2_rand' id='security_token2_rand' value='".$t2[0]."' >";
	if( $return ){
		return $vstr;
	}
	echo $vstr;
}
function print_tokens(){
	$t2 = get_token2();
	$vstr = "<input type='hidden' name='security_token1' id='security_token1' value='".get_token1()."' >
	<input type='hidden' name='security_token2' id='security_token2' value='".$t2[1]."' >
	<input type='hidden' name='security_token2_rand' id='security_token2_rand' value='".$t2[0]."' >";
	if( $return ){
		return $vstr;
	}
	echo $vstr;	
}
function validate_token1($block = false){
	if( md5(session_id().getUserIPAdrss()) == ($_POST['security_token1']?$_POST['security_token1']:$_GET['security_token1']) ){
		return true; 
	}else{
		if( $block ){
			// header('HTTP/1.1 400 server error');
			// echo "<html><head></head><body>Bad request token1 mismatch</body></html>";
			// exit;
			if( $_SERVER['REQUEST_METHOD']=="POST" && preg_match("/json/i", $_SERVER['CONTENT_TYPE']) ){
				// header('HTTP/1.1 400 server error');
				header("content-type: application/json");
				echo json_encode( array("status"=>'fail', "details"=>'Token1 Expired'), JSON_PRETTY_PRINT );
				exit;
			}else{
				header('HTTP/1.1 400 server error');
				echo "<html><head>
						<script>
						var redirect = setTimeout(function() {
						window.location='/login/';
						}, 2000);
						</script>
				</head><body>Token1 Expired, you will be redirected to login page</body></html>";
				exit;
			}
		}
		return false;
	}
}
function validate_token2( $block = false ){
	if( $_SESSION['token2'][ $_POST['security_token2_rand'] ] == ($_POST['security_token2']?$_POST['security_token2']:$_GET['security_token2']) ){
		return true; 
	}else{
		if( $block ){
			if( $_SERVER['REQUEST_METHOD']=="POST" && preg_match("/json/i", $_SERVER['CONTENT_TYPE']) ){
				// header('HTTP/1.1 400 server error');
				header("content-type: application/json");
				echo json_encode( array("status"=>'fail', "details"=>'Token2 Expired'), JSON_PRETTY_PRINT );
				exit;
			}else{
				header('HTTP/1.1 400 server error');
				echo "<html><head>
						<script>
						var redirect = setTimeout(function() {
						window.location='/login/';
						}, 3000);
						</script>
				</head><body>Token2 Expired, you will be redirected to login page</body></html>";
				exit;
			}			
		}
		return false;
	}
}
function clear_token2(){
	unset($_SESSION["token2"][ $_POST['security_token2_rand'] ]);
}

function isitin($ndl,$hstck){
	foreach ($hstck as $bypass) {
		if(stripos(strtolower(trim($ndl)), strtolower(trim($bypass))) !== FALSE) return true;
	}
	return false;
}

class SECURITY
{
	/**
	 * [__construct description]
	 */
	function __construct(){
		global $con_redis_security;
		$this->filters = 
			[
				'onabort(|\ |\t)+\=',
				'onafterprint(|\ |\t)+\=',
				'onbeforeprint(|\ |\t)+\=',
				'onbeforeunload(|\ |\t)+\=',
				'onblur(|\ |\t)+\=',
				'oncanplay(|\ |\t)+\=',
				'oncanplaythrough(|\ |\t)+\=',
				'onchange(|\ |\t)+\=',
				'onclick(|\ |\t)+\=',
				'oncontextmenu(|\ |\t)+\=',
				'oncopy(|\ |\t)+\=',
				'oncuechange(|\ |\t)+\=',
				'oncut(|\ |\t)+\=',
				'ondblclick(|\ |\t)+\=',
				'ondrag(|\ |\t)+\=',
				'ondragend(|\ |\t)+\=',
				'ondragenter(|\ |\t)+\=',
				'ondragleave(|\ |\t)+\=',
				'ondragover(|\ |\t)+\=',
				'ondragstart(|\ |\t)+\=',
				'ondrop(|\ |\t)+\=',
				'ondurationchange(|\ |\t)+\=',
				'onemptied(|\ |\t)+\=',
				'onended(|\ |\t)+\=',
				'onerror(|\ |\t)+\=',
				'onfocus(|\ |\t)+(\=|\:)',
				'onhashchange(|\ |\t)+\=',
				'oninput(|\ |\t)+\=',
				'oninvalid(|\ |\t)+\=',
				'onkeydown(|\ |\t)+\=',
				'onkeypress(|\ |\t)+\=',
				'onkeyup(|\ |\t)+\=',
				'onload(|\ |\t)+\=',
				'onloadeddata(|\ |\t)+\=',
				'onloadedmetadata(|\ |\t)+\=',
				'onloadstart(|\ |\t)+\=',
				'onmessage(|\ |\t)+\=',
				'onmousedown(|\ |\t)+\=',
				'onmousemove(|\ |\t)+\=',
				'onmouseout(|\ |\t)+\=',
				'onmouseover(|\ |\t)+\=',
				'onmouseup(|\ |\t)+\=',
				'onmousewheel(|\ |\t)+\=',
				'onoffline(|\ |\t)+\=',
				'ononline(|\ |\t)+\=',
				'onpagehide(|\ |\t)+\=',
				'onpageshow(|\ |\t)+\=',
				'onpaste(|\ |\t)+\=',
				'onpause(|\ |\t)+\=',
				'onplay(|\ |\t)+\=',
				'onplaying(|\ |\t)+\=',
				'onpopstate(|\ |\t)+\=',
				'onprogress(|\ |\t)+\=',
				'onratechange(|\ |\t)+\=',
				'onreset(|\ |\t)+\=',
				'onresize(|\ |\t)+\=',
				'onscroll(|\ |\t)+\=',
				'onsearch(|\ |\t)+\=',
				'onseeked(|\ |\t)+\=',
				'onseeking(|\ |\t)+\=',
				'onselect(|\ |\t)+\=',
				'onshow(|\ |\t)+\=',
				'onstalled(|\ |\t)+\=',
				'onstorage(|\ |\t)+\=',
				'onsubmit(|\ |\t)+\=',
				'onsuspend(|\ |\t)+\=',
				'ontimeupdate(|\ |\t)+\=',
				'ontoggle(|\ |\t)+\=',
				'onunload(|\ |\t)+\=',
				'onvolumechange(|\ |\t)+\=',
				'onwaiting(|\ |\t)+\=',
				'onwheel(|\ |\t)+\=',
				'ondblclick(|\ |\t)+\=',
				'ondrag(|\ |\t)+\=',
				'oncut(|\ |\t)+\=',
				'onwheel(|\ |\t)+\=',
				'group\_concat',
				'drop table',
				'select database',
				'\?\>',
				'exec master\.dbo\.xp\_dirtree',
				'DBMS\_PIPE\.RECEIVE\_MESSAGE',
				'while\(',
				'do\{',
				'function\(',
				'order by',
				'Date\(',
				'waitfor delay',
				'select\*from',
				'sleep\(',
				'version\(',
				'const\(',
				'char\(',
				'\)\=\(',
				'select \* ',
				'dATABASE([\(\ ]+)',
				'database\(',
				'IFNULL',
				'HEX\(IFNULL\(CAST',
				'\ UNION\ ALL',
				'eval\(',
				'base64\_decode',
				'include\(',
				'\_config',
				'pass\_decrypt',
				'\$\_post',
				'\<script',
				'\.cookie',
				'alert\(',
				'javascript',
				'\<META HTTP',
				'\<META',
				'iframe',
				'\<\?php',
				'\?\>',
				'base64',
				'prompt\(',
				'\<svg',
				'onclick\(',
				'^document\.',
				'location\.href',
				'window\.open',
				'\<style',
				'\<span',
				'\<a href',
				'\<div',
				'\<img',
				'\<layer',
				'\<xss',
				'\<xml',
				'\<form',
				'\<input',
				'passthru',
				'shell\_exec',
				'master.dbo',
				'declare \@',
				'varchar',
				'\<xmltype',
				'extractvalue',
				'load_file',
				'convert\(',
				'\.\.\/\.\.\/',
				'\$\_server',
				'\<body',
				'onload\=',
				'onerror\=',
				'src\=',
				'src(|\ |\t)+\=',
				'dynsrc(|\ |\t)+\=',
				'lowsrc(|\ |\t)+\=',
				'FSCommand(|\ |\t)+\(',
				'confirm\(',
				'(alert|confirm|prompt)(|\ )+\(.*?\)',
				'\+\[\]\)', // new payload from BMW
				'&#97&#108;&#101;&#114;&#116;', //hex code alert
				'window\[',
				'update(?:.*?)set',
				'delete(|\ )+from',
				'window(?:.*?)\[',
				'window\/\*(?:.*?)\*\/\[',
				'\/\*(.*?)\*\/',
				'\/\*',
				'\*\/',
				'top\[',
				'find\/\*(?:.*?)\*\/\(',
				'contenteditable',
				'ondrag',
				'bit_count',
				'ascii',
				'MID(|\ )+\(',
				'user\(\)',
				'\{0\}',
				'\>\>',
				'query\.format',
				'if\(',
				'exp\(',
				'\[0x0a\]',
				'burpcollab',
				'BENCHMARK\(',
				'exp\('
			];
			$this->push_events_redis_connection = false;
			$this->msg              = "";
			$this->op               = null;
			$this->opmt             = null;
			$this->block            = false;
			$this->specialchars     = false;
			$this->white_list_files = ['doc','docx','pps','ppt','bmp','gif','jpeg','jpg','png','pdf','xls','xlsx','txt','bmp','apk'];
			$this->logfile          = $_SERVER['DOCUMENT_ROOT']."logs/actions_log_".date("Ymd").".html";
			$this->sts_tble         = "actions_log_".date("Y_m_d");
			$this->con_redis_security = false;
			$this->_ignore_keys = ["series_code","event_terms","mail_subject","cars_message","auction_remarks","location_sub","message"];
			$this->bypassed_fields = ["statustext"=>"\<a href"];
	}
	/**
	 * [filter description]
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	function filter($data){
		foreach ( (array) $data as $key => $value) {
			if(is_array($value))
				$this->filter($value);
			// if(in_array($key, $this->_ignore_keys)) continue;
			if (isitin($key,$this->_ignore_keys)) continue;
			$this->data = $value;
			$this->_key = $key;
			$this->xss();
			/**checking Keys START**/
			$this->data = $key;
			$this->_key = $key;
			$this->xss();
			/**checking Keys END**/
			if($key !='request_uri' || $key !='request_url')
			{
				if(!preg_match("^[0-9a-z\-\.\ \+]$/i",urldecode($value)) && $value !="")
				{
					$this->specialchars= true;
				}
				
			}
		}
	}
	/**
	 * [xss description]
	 * @return [type] [description]
	 */
	function xss(){
		if(is_array($this->data)){
			return true;
		}
		foreach ($this->filters as $fltr) {
			if(preg_match("/".$fltr."/i", $this->data , $mtc)){
				$this->op[$this->_key] = $this->data;
				$this->opmt[$this->_key] = $fltr;
				if($this->bypassed_fields[trim($this->_key)] <> trim($fltr))
					$this->block = true;
				else
					$this->block = false;
				// $this->msg[] = "Filters Matched : $fltr";	
			}
		}
	}
	/**
	 * [actionlog description]
	 * @return [type] [description]
	 */
	function actionlog(){
		$_n = 0;
		if( !file_exists($this->logfile) )
		{
			$_n = 1;
		}
		$fp = @fopen($this->logfile, "a");
		if(!$fp){
			error_log("File open failed at common_security_class.php (".$this->logfile.")");
		}else{
			if($_n){	
				$_tblstart = '<table style="text-align:center;width:100%;border-collapse:collapse;font-size: 12px;border-bottom: 1px solid gray;" cellpadding="0" cellspacing="0" border=1>';
				$_tblstart .= '<tr><th>TIME</th><th>REQUEST METHOD</th><th>Action</th><th>Host</th><th>IP address</th><th>URL</th><th>Info</th><th>Msg</th></tr>';
				@fwrite($fp, $_tblstart);
			}
			$_m_s_g = "<tr>";
			if($this->block) {
				$_m_s_g .= "<td>".Date('Y-m-d H:i:s')."</td>";
				$_m_s_g .= "<td>".$_SERVER['REQUEST_METHOD']."</td><td>blocked</td>";
				$_m_s_g .= "<td>".$_SERVER['HTTP_HOST']."</td>";
				$_m_s_g .= "<td><a target='_new' style='font-weight:bold;' href='https://ipinfo.io/".getUserIPAdrss()."'>".getUserIPAdrss()."</a></td>";
				$_m_s_g .= "<td><div  style='width:600px;overflow:auto;'>".htmlspecialchars($_SERVER['REQUEST_URI'],ENT_QUOTES)."</div></td>";
			}
			if(is_array($this->op)){
				$_m_s_g .= "<td><table width='100%'><tr><td width='10%' style='font-size:11px;font-weight:bold;'>key</td><td width='15%'  style='font-size:11px;font-weight:bold;'>Regex</td><td style='font-size:11px;font-weight:bold;'>value</td></tr>";
				foreach ($this->op as $k => $_op) {
					$_m_s_g .= "<tr><td style='color:brown;font-size:10px;'>".htmlspecialchars($k,ENT_QUOTES)." </td><td style='color:brown;font-size:10px;'> ".$this->opmt[$k].".</td><td  style='color:brown;font-size:10px;'>".htmlspecialchars($_op,ENT_QUOTES)."</td></tr>";
				}
				$_m_s_g .= "</table></td>";
			}
			if( is_array($this->msg) ){
				$_m_s_g .= "<td><table width='100%'>";
				$_m_s_g .= "<tr><th>Msg</th></tr>";
				foreach( array_unique($this->msg) as $_msg ){
					$_m_s_g .="<tr><td>".htmlspecialchars($_msg)."</td></tr>";
				}
				$_m_s_g .= "</table></td>";
			}
			$_m_s_g .= '</td></tr>';
			@fwrite($fp, $_m_s_g."\n");
			@fclose($fp);
		}
	}	
	/**
	 * [fileUpload description]
	 * @return [type] [description]
	 */
	function fileUpload(){
		if(isset($_FILES))
		{
			foreach ($_FILES as $key => $value) {
				if(is_array($value['name']))
				{
					foreach ($value['name'] as $filetyp) {
						$_FILES[$key]['name'][$_ky] = htmlspecialchars($filetyp,ENT_QUOTES,'UTF-8');
						$_xt = strtolower(pathinfo($filetyp)['extension']);
						if( $_xt && !in_array(trim($_xt),$this->white_list_files) )
							$_block_request = true;
					}
				}else{
					$__xt = strtolower(pathinfo($value['name'])['extension']);
					$_FILES[$key]['name'] = htmlspecialchars($value['name'],ENT_QUOTES,'UTF-8');
					if( $__xt && !in_array(trim($__xt),$this->white_list_files)){
						$_block_request = true;
					}	
				}
			}
			if($_block_request === true)
			{
				$this->block = true;
				$this->msg = []; 
				$this->msg[] = "Blocked Arbitary Fileuploads";	
			}
		}
	}

	function push_events_redis( $method, $data ){

		global $config_redis_event_host, $config_redis_event_port;
			
		if( $method == "http_post_json" ){
			if( !$data['api_name'] ){
				return array("status"=>"fail", "error"=>"API name missing" );
			}			
			if( !$data['api_endpoint'] ){
				return array("status"=>"fail", "error"=>"API endpoint missing" );
			}
			if( !$data['postdata'] ){
				return array("status"=>"fail", "error"=>"Postdata missing" );
			}
			if( !$data['request_type'] ){
				return array("status"=>"fail", "error"=>"Request type missing" );
			}
			$request_data = json_encode(array(
						"method"=>"http_post_json",
						"data" =>json_encode($data)
						));
			if( !$request_data ){
				$vdata = var_export($data,true);			
				error_log( "json-encode error in commoncontrol, pushevents " . $vdata  );
				$vdatatype = "string";	
				$request_data = json_encode(array(
						"method"=>"http_post_json",      
						"url" => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],						
						"data" =>$vdata,
						"datatype"=>$vdatatype,						
						));										
			}                    
									
			$event_queue_type = "events_queue_http:" . $data["api_name"];
	             
		}else if( $method == "db_insert" ){
		
			if( !$data['database'] ){
				return array("status"=>"fail", "error"=>"Database name missing" );
			}
			if( !$data['table'] ){
				return array("status"=>"fail", "error"=>"Table name missing" );
			}
			if( !$data['data'] ){
				return array("status"=>"fail", "error"=>"JSON data missing" );
			}
			$vdata = @json_encode($data);
			$vdatatype = "json";			
			if( !$vdata ){
				$vdata = var_export($data,true);			
				error_log( "json-encode error in commoncontrol, pushevents " . $vdata  );
				$vdatatype = "string";											
			}						
			$request_data = json_encode(array(
						"method"=>"db_insert",      
						"database" => $data['database'],
						"table" => $data['table'],
						"url" => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],						
						"data" =>$vdata,
						"datatype"=>$vdatatype,						
						));      
			$event_queue_type = "events_queue_db_insert:" . $data["database"];
		}else if( $method == "db_insert_serverless" )
		{

			if( !is_array($data) ){
				return array("status"=>"fail", "error"=>"Data needs to be array" );
			}
			$data["method"] = "db_insert_serverless";
						if( !$data['database'] ){
				return array("status"=>"fail", "error"=>"Database name missing" );
			}
			if( !$data['table'] ){
				return array("status"=>"fail", "error"=>"Table name missing" );
			}
			if( !$data['timestamp'] ){
				return array("status"=>"fail", "error"=>"Timestamp field is missing" );
			}
			$request_data = json_encode($data);      
			$event_queue_type = "events_queue_db_insert2";

		}else if( $method == "db_insert_serverless_ver2" ){

			$config_queues = array(
				"ct_stats"=>1,
				"ct_mobile_log"=>1,
				"ct_action_log"=>1, 
				"cte_stats"=>1, 
				"cte_mobile_log"=>1, 
				"cte_action_log"=>1 
			);
			if( !is_array($data) ){
				return array("status"=>"fail", "error"=>"Data needs to be array" );
			}
			if( !$data['database'] ){
				return array("status"=>"fail", "error"=>"Database name missing" );
			}
			if( !$data['table'] ){
				return array("status"=>"fail", "error"=>"Table name missing" );
			}
			if( !$data['timestamp'] ){
				return array("status"=>"fail", "error"=>"Timestamp field is missing" );
			}
			if( !$data['queue'] ){
				return array("status"=>"fail", "error"=>"Queue field is missing" );
			}else if( !$config_queues[ $data['queue'] ] ){
				return array("status"=>"fail", "error"=>"Queue field incorrect: " . $data['queue'] );
			}
			$request_data = json_encode($data);
			$event_queue_type = "events_queue_db_insert_serverless:".strtolower($data['queue']);
			
		}else if( $method == "db_function" ){
		
			if( !$data['queue_name'] ){
				return array("status"=>"fail", "error"=>"queue name missing" );
			}
		        $data["method"] = "db_function";
			$vdata = @json_encode($data);
	      		$vdatatype = "json";			
	      		if( !$vdata ){
	      			$vdata = var_export($data,true);			
	      			error_log( "json-encode error in commoncontrol, pushevents " . $vdata  );
	      			$vdatatype = "string";											
	      		}						
	      		$request_data = json_encode(array(
	      					"method"=>"db_function",      
	      					"queue_name" => $data["queue_name"],                  					
	      					"url" => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],						
	      					 "data" => $vdata,
	      					"datatype"=>$vdatatype,						
	      					));         
			$event_queue_type = "events_queue_db_function:" . $data["queue_name"];
		}else if( $method == "db_update" ){
		
			if( !$data['database'] ){
				return array("status"=>"fail", "error"=>"Database name missing" );
			}
	        if( !$data['table'] ){
	                return array("status"=>"fail", "error"=>"Table name is missing" );
	        }
	        if( !$data['data'] ){
	                return array("status"=>"fail", "error"=>"data is missing" );
	        }else if( !is_array( $data["data"] ) ){
	        	return array("status"=>"fail", "error"=>"data should be in array" );
			}

	        if( !$data['condition'] ){
	        	return array("status"=>"fail", "error"=>"condition is missing" );
	        }else if( !is_array( $data["condition"] ) ){
	    		return array("status"=>"fail", "error"=>"condition should be in array" );
			}
		          
	        $vdata = @json_encode($data);
			$vdatatype = "json";			
			if( !$vdata ){
				$vdata = var_export($data,true);			
				error_log( "json-encode error in commoncontrol, pushevents, db_update, " . $vdata  );
				$vdatatype = "string";											
			}						
			$request_data = json_encode(array(
						"method"=>"db_update",      
						"database" => $data['database'],
						"table" => $data['table'],
						"url" => $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'],						
						"data" =>$vdata,
						"datatype"=>$vdatatype,						
						));
			$event_queue_type = "events_queue_db_update:" . $data["database"];
		}else{
			return array("status"=>"fail", "error"=>"Method not found!");
		}
                if( !$request_data ){
			$vdata = var_export($data,true);
			error_log( "json-encode error in commoncontrol, pushevents " . $vdata  );
			foreach( $data as $i=>$j ){ 
				if( is_array($j)){ 
					foreach( $j as $i2=>$j2 ){ 
						$request_data .= "###". $i2 . "|||" . $j2;
					 } 
				}else{
				 	$request_data .= "###". $i . "|||" . $j; 
				} 
			}
						 
		}
		if( $this->push_events_redis_connection == false ){
			$this->push_events_redis_connection = new Redis();
			if( !@$this->push_events_redis_connection->connect($config_redis_event_host, $config_redis_event_port, 1) ){
				error_log( "INFO: CC Redis connection failed ".$config_redis_event_host.":".$config_redis_event_port ." ".date('Y-m-d H:i:s') );
				header('HTTP/1.1 500 server error');
				echo "<html><head></head><body>Configuration item 16 incorrect</body></html>";
				exit;
	        	}
		}

		//$id = time() . rand(10000,99999);
		$id = time() . rand(10000,99999);
		if( !$this->push_events_redis_connection->hSet( $event_queue_type . "_msg" , $id, $request_data) ){
			$ret = $this->push_events_redis_connection->getLastError();
			return array("status"=>"fail", "id"=>$id, "error"=>"error in redis hset " . print_r($ret,true) );
		} 

		if( !$this->push_events_redis_connection->ZADD( $event_queue_type , $id, $id ) ){ 
			return array("status"=>"fail", "id"=>$id, "error"=>"error in redis zadd " );
		}  
		return array("status"=>"ok", "id"=>$id);

	}

	function logtable()
	 {
	 	global $config_PE_database;
		/**********  added below code to push data to push events *********/
		$postdata_aws = array(
			'queue' => 'cte_action_log',
			'database' =>  $config_PE_database,    //mandatory
			'table'=> 'actions_log',     //mandatory
			'timestamp'=>date("Y-m-d H:i:s"),      //mandatory
			
			'ip'=>getUserIPAdrss(),
			'domain'=>$_SERVER['HTTP_HOST'], 
			'url'=> $_SERVER['REQUEST_URI'],
			'method'=>$_SERVER['REQUEST_METHOD'],
			'domain'=>$_SERVER['HTTP_HOST'],
			'server'=> php_uname('n'),
			'get'=> $_GET,
			'post'=> $_POST,
			'scriptname'=>$_SERVER['SCRIPT_NAME'],
			'blocked'=>($this->block?'1':'0'),
			'action'=>$_REQUEST['action']
		); 
		$push_event_response = $this->push_events_redis("db_insert_serverless_ver2", $postdata_aws);
		if($push_event_response['status'] == 'fail' )
		{
			   error_log( "Action Log insert Error: " . $push_event_response['error'] );
		}
		
	}

	/**
	 * [redis_ip_block description]
	 * @return [type] [description]
	 */
	function redis_ip_block( $action = false ){
		global $config_dos_block_msg;	
		$key = "IP:BL:".$_SERVER['HTTP_HOST'].":".getUserIPAdrss();
		if( $this->con_redis_security ){
			if( $action == "clear" ){
				$this->con_redis_security->del( $key );
				echo "cleared";
				exit;
			}
			$ip_requests_cnt = $this->con_redis_security->hLen($key);
			header("badcount:" . $ip_requests_cnt);
			if( $ip_requests_cnt > 20 ){
				$this->block = true;
				$this->redis_ip_blocked = true;
				echo $config_dos_block_msg;
				exit;
			}else{
				if( $this->block ){
					$_rmsg  = "###Server: ".@json_encode( $_SERVER );
					$_rmsg .= "###SESSION:<br>".@json_encode( $_SESSION );
					$_rmsg .= "###REQUEST<br>".@json_encode( $_REQUEST );
					$_rmsg .= "###COOKIE<br>".@json_encode( $_COOKIE );
					$this->con_redis_security->hset( $key, date('YmdHisv'), $_rmsg );
					$this->con_redis_security->expire( $key, 3600 ); //1 hour
				}
				return false;
			}
		}
	}
}

?>