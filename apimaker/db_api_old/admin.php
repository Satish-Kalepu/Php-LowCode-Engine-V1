<?php
class admin{
	public $status = 200;
	public $response = "DB API Admin";
	public $isBase64Encoded = false;
	public $headers = [];
	public $error = "";
	public $params = [];
	public $requestContext = [];
	function __construct( $requestContext = [], $params ){
		$this->requestContext = $requestContext;
		$this->params = $params;
		//POST  = $this->requestContext["body"]
		//GET = $this->requestContext["queryStringParameters"]
		//$req['queryStringParameters']
		//$req['body']
		//$req['headers']
		//$req['headers']['host']
		//$req['headers']['x-forwarded-for']
	}
	function GET_default(){
		//$this->status =404;
		$data = file_get_contents("admin.html");
		$res = $this->process_session();
		if( $res['status'] != "success" ){
			return [
				"statusCode"=>500,
				"body"=>$res,
			];
		}
		$s = $res['session_id'];
		$data = str_replace("##session_id##", $s, $data );
		$data = str_replace("##captcha_api_url##", $_ENV['config_captcha_api_url'], $data );
		return $data;
	}
	function GET_logout(){
		set_cookie("dbapi_session", "", 2);
		return [
			"statusCode"=>302,
			"body"=>"Redirect", 
			"headers"=>["Location"=>"/admin/?event=Loggedout"]
		];
	}
	function process_session(){
		global $dynamodb_con;
		if( $this->requestContext['cookies']["dbapi_session"] ){
			$s = $this->requestContext['cookies']["dbapi_session"];
			$res = $dynamodb_con->getItem($_ENV['config_user_table'], [
				"pk"=>"session", "sk"=>$s
			]);
			if( $res['Item'] ){
				if( (int)$res['Item']['expire'] < (time()-3600) || $res['Item']['ua'] != $this->requestContext['headers']['User-Agent'] || $res['Item']['ip'] != $this->requestContext['ip'] ){
					set_cookie("dbapi_session", "", 2);
					return [
						"status"=>"success",
						"session_id"=>"", 
						"error"=>"session expired"
					];
				}
				$res["session_id"] = $s;
			}
			return $res;
		}else{
			return ["status"=>"success","session_id"=>""];
		}
	}
	function verify_session(){
		global $dynamodb_con;
		if( $this->requestContext['cookies']["dbapi_session"] ){
			$s = $this->requestContext['cookies']["dbapi_session"];
			$res = $dynamodb_con->getItem($_ENV['config_user_table'], [
				"pk"=>"session", "sk"=>$s
			]);
			if( $res['Item'] ){
				if( (int)$res['Item']['expire'] < (time()-3600) || $res['Item']['ua'] != $this->requestContext['headers']['User-Agent'] || $res['Item']['ip'] != $this->requestContext['ip'] ){
					return [
						"status"=>"fail",
						"error"=>"Session expired"
					];
				}
				return ["status"=>"success","res"=>$res, "session_id"=>$s];
			}else{
				return ["status"=>"fail","error"=>"Session Expired"];
			}
		}else{
			return ["status"=>"fail","error"=>"Session Not Found"];
		}
	}
	function POST_check_session(){
		$res = $this->process_session();
		if( $res['session_id'] ){
			return [
				"status"=>"success",
			];
		}else{
			return [
				"status"=>"fail",
				"error"=>"notfound"
			];
		}
	}
	function POST_default(){
		//$this->status =404;
		$post = $this->requestContext['body'];
		if( $post["action"] == "login" ){
		}
		return [
			"statusCode"=>404,
			"body"=>"Not Found",
			"headers"=>[
				"Content-Type"=> "text/html"
			]
		];
	}
	function POST_login(){
		//$this->status =404;
		global $dynamodb_con;
		global $mr;
		$post = $this->requestContext['body'];
		if( !$post["captcha"] || !$post["captcha_code"] ){
			return [
				"status"=>"fail",
				"error"=>"Captcha Missing"
			];
		}else{
			if( $post['captcha_code'] == 99999 ){}else{
				$res = curl_get($_ENV['config_captcha_api_url']."captcha/verify", [
					"captcha"=>$post['captcha'],
					"code"=>$post['captcha_code']
				]);
				if( $res['status'] == 200 ){
					$res = json_decode($res['body'],true);
					if( $res['status'] != "success" ){
						return [
							"status"=>"fail",
							"error"=>"Captcha Incorrect",
							"res"=>$res,
						];
					}
				}else{
					return [
						"status"=>"fail",
						"error"=>"Captcha Incorrect",
						"res"=>$res,
					];
				}
			}
		}
		if( $post["username"] == $_ENV['config_admin_username'] && $post["password"] == $_ENV['config_admin_password'] ){
			$rand = time().".".rand(1000,9999);
			$st = $dynamodb_con->putItem($_ENV['config_user_table'],[
					"pk"=>"session",
					"sk"=>$rand,
					"expire"=>time()+3600,
					"ua"=>$this->requestContext['headers']['User-Agent'],
					"ip"=>$this->requestContext['ip'],
			]);
			if( $st["status"]=="success" ){
				set_cookie("dbapi_session", $rand, time()+3600 );
				return [
					"status"=>"success",
					"session_id"=>$rand
				];
			}else{
				return [
					"status"=>"error",
					"error"=>$dynamodb_con->error,
				];
			}
		}
		return [
			"statusCode"=>200,
			"body"=>[
				"status"=>"fail",
				"error"=>"Incorrect username/password"
			],
		];
	}
	function POST_load_tables(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$res = $dynamodb_con->listTablesDetailed();
		return $res;
	}
	function POST_scan_records(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$q = [
			"TableName"=>$post["TableName"],
			"Limit"=>50
		];
		if( $post['Index'] != "main" ){
			$q[ "IndexName" ] = $post['Index'];
		}
		if( $post["LastEvaluatedKey"] ){
			$q['ExclusiveStartKey'] = $post['LastEvaluatedKey'];
		}
		$res = $dynamodb_con->scan($q);
		if( $res["status"] == "success" ){
			$fields = [];
			foreach( $res["Items"] as $i=>$j ){
				foreach( $j as $fn=>$jj ){
					$fields[ $fn ] += 1;
				}
			}
			arsort($fields);
			$res["fields"] = $fields;
		}
		return $res;
	}
	function POST_query_records(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$q = [
			"TableName"=>$post["TableName"],
			"Limit"=>50
		];
		if( $post["LastEvaluatedKey"] ){
			$q['ExclusiveStartKey'] = $post['LastEvaluatedKey'];
		}
		if( $post['Index'] != "main" ){
			$q[ "IndexName" ] = $post['Index'];
		}
		if( $post['Order'] != "asc" ){
			$q[ "ScanIndexForward" ] = false;
		}
		if( $post["Schema"] ){
			$ke = [];
			$an = [];
			$av = [];
			foreach( $post['Schema'] as $i=>$j ){
				if( $j['KeyType'] == "HASH" ){
					$ke[] = "#".$j['AttributeName'] . " = " . ":" . $j['AttributeName'];
					$an["#".$j['AttributeName']] = $j['AttributeName'];
					if( $j['Type'] == "N" ){
						$av[":".$j['AttributeName']] = (int)$j['value'];
					}else{
						$av[":".$j['AttributeName']] = $j['value'];
					}
				}elseif( $j['value'] ){
					$ke[] = "#".$j['AttributeName'] . " " . $j['cond'] . " " . ":" . $j['AttributeName'];
					$an["#".$j['AttributeName']] = $j['AttributeName'];
					if( $j['Type'] == "N" ){
						$av[":".$j['AttributeName']] = (int)$j['value'];
					}else{
						$av[":".$j['AttributeName']] = $j['value'];
					}
				}
			}
			$q['KeyConditionExpression'] = implode(" and ",$ke);
			$q["ExpressionAttributeNames"] = $an;
			$q["ExpressionAttributeValues"] = $av;
		}
		$res = $dynamodb_con->query( $q );
		if( $res["status"] == "success" ){
			$fields = [];
			foreach( $res["Items"] as $i=>$j ){
				foreach( $j as $fn=>$jj ){
					$fields[ $fn ] += 1;
				}
			}
			arsort($fields);
			$res["fields"] = $fields;
		}
		return $res;
	}
	function POST_save_item(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$res = $dynamodb_con->getItem( $post["TableName"], $post["Key"] );
		$res2 = $dynamodb_con->putItem( $post["TableName"], $post["Item"] );
		if( $res['Item'] ){
			$res2["extra"] = "Already Exists";
		}
		return $res2;
	}
	function POST_delete_item(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$res = $dynamodb_con->deleteItem( $post["TableName"], $post["Key"] );
		$res["vi"] = $post['vi'];
		return $res;
	}
	function POST_load_access_keys(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$res = $dynamodb_con->query([
			"TableName"=>$_ENV['config_user_table'],
			"query"=>[
				[
					"KeyType"=> "HASH",
					"Type"=>"S",
					"field"=> "pk",
					"value"=> "admin_key",
					"cond"=> "="
				]
			],
			//"order"=>"asc"
		]);
		return $res;
	}
	function POST_save_key(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$item = $post['Item'];
		$item["pk"] = "admin_key";
		if( !$item['sk'] ){
			$item["sk"] = date("YmdHis").".".rand(1000,9999);
		}
		$item["expire"] = (int)$item["expire"];
		if( $_POST['expire_minits'] ){
			date_default_timezone_set("UTC");
			$item["expire"] = time()+($_POST['expire_minits']*60);
		}
		$item["created"] = date("Y-m-d H:i:s");
		$res = $dynamodb_con->putItem($_ENV['config_user_table'],$item);
		return $res;
	}
	function POST_load_users(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$res = $dynamodb_con->query([
			"TableName"=>$_ENV['config_user_table'],
			"query"=>[
				[
					"KeyType"=> "HASH",
					"Type"=>"S",
					"field"=> "pk",
					"value"=> "user",
					"cond"=> "="
				]
			],
			//"order"=>"asc"
		]);
		return $res;
	}
	function POST_save_user(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$item = $post['Item'];
		$item["pk"] = "user";
		if( $item['password'] ){
			$res = $dynamodb_con->putItem($_ENV['config_user_table'],[
				"pk"=>"user_password",
				"sk"=>$item['sk'],
				"password"=>hash("whirlpool",$item['password'])
			]);
			$item["pwdexpire_date"] = date("Y-m-d H:i:s",time()+($item['pexpire']*(30*86400)) );
			unset($item['password']);
		}
		$item["created"] = date("Y-m-d H:i:s");
		$res = $dynamodb_con->putItem($_ENV['config_user_table'],$item);
		return $res;
	}
	function POST_fetch_keys(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$start = time();
		$post = $this->requestContext['body'];
		$table = $post['TableName'];
		$log = [];
		$err = "";
		try{
			$res = $dynamodb_con->con->describeTable(['TableName'=>$table])->toArray();
			if( $res['Table'] ){
				if( $post['query_index'] == "main" ){
					$schema = $res['Table']['KeySchema'];
				}else{
					foreach( $res['Table']['GlobalSecondaryIndexes'] as $si=>$sd ){
						if( $sd['IndexName'] == $post['query_index'] ){
							$schema = $res['Table']['GlobalSecondaryIndexes'][ $si ]['KeySchema'];
						}
					}
				}
				//print_r( $res['Table'] );exit;
				$pk = $schema[0]['AttributeName'];
				$sk = $schema[1]['AttributeName'];
				$log[] = $schema;
			}
		}catch(Exception $ex){
			return [
				"status"=>"fail",
				"error"=>"describe Table Fail: " . $ex->getMessage()
			];
		}
		if( !$pk ){
			return [
				"status"=>"fail",
				"error"=>"Primary Key not found"
			];
		}

		//echo $pk . ":" . $sk . "\n";

		$keys = [];

		$p = ["TableName"=> $table, "Limit"=> 1];
		if( $post['query_index'] != "main" ){
			$p['IndexName'] = $post['query_index'];
		}
		$res = $dynamodb_con->con->scan( $p )->toArray();
		$start_key = $res['LastEvaluatedKey'];
		//print_r( $start_key );
		//echo $start_key[$pk]['S'] . ": " . $start_key[$sk]['S'] . "\n";
		$keys[ $start_key[$pk]['S'] ] = [ 'start'=>$start_key[$sk]['S'] ];
		$log[] = $start_key;
		$key = false;
		while( 1 ){
			$log[] = "fetching last key of: "  .$start_key[$pk]['S'] ;
			$p = [
				"TableName"=> $table,
				"Limit"=> 1,
				"ExpressionAttributeNames"=>["#pk"=> $pk ],
				"ExpressionAttributeValues"=>[":pk"=> ['S'=>$start_key[$pk]['S']] ],
				"KeyConditionExpression"=>"#pk = :pk",
				"ScanIndexForward"=>false,
			];
			if( $post['query_index'] != "main" ){
				$p['IndexName'] = $post['query_index'];
			}
			try{
				$res = $dynamodb_con->con->query($p)->toArray();
				if( !$res['Items'] ){
					return [
						"status"=>"fail",
						"error"=>"Query no items",
						"log"=>$log
					];
				}
			}catch( Exception $ex ){
				return [
					"status"=>"fail",
					"error"=>"describe Table Fail: " . $ex->getMessage(),
					"log"=>$log
				];
			}
			//echo "End: " .  $res['Items'][0][$pk]['S'] . ": " . $res['Items'][0][$sk]['S'] . "\n";
			$log[] = $start_key;
			$keys[ $start_key[$pk]['S'] ][ 'end' ] = $res['Items'][0][$sk]['S'];
			$start_key = [$pk=>$res['Items'][0][$pk], $sk=>$res['Items'][0][$sk] ];
			if( !$res['Items'][0][$pk] || !$res['Items'][0][$sk] ){
				return [
					"status"=>"fail",
					"error"=>"Key not found",
					"log"=>$log
				];
			}

			//echo "\nnext scan: \n";
			//print_r( $start_key );
			$log[] = "fetching first key of: " . $res['Items'][0][$pk]['S'];
			$p = [
				"TableName"=> $table,
				"Limit"=> 1,
				"ExclusiveStartKey"=>$start_key
			];
			if( $post['query_index'] != "main" ){
				$p['IndexName'] = $post['query_index'];
			}
			try{
				$res = $dynamodb_con->con->scan($p)->toArray();
				if( sizeof($res['Items'])==0 ){
					$log[] = "no items found";
					break;
				}
				if( !$res['LastEvaluatedKey'] ){
					return [
						"status"=>"fail",
						"error"=>"No Result, LastEvaluatedKey not found",
						"res"=>$res,
						"p"=>$p,
						"log"=>$log
					];
					exit;
				}
			}catch( Exception $ex ){
				return [
					"status"=>"fail",
					"error"=>"scan table Fail: " . $ex->getMessage(),
					"log"=>$log
				];
			}
			$start_key = $res['LastEvaluatedKey'];
			//echo "Next: " . $start_key[ $pk ]['S'] . ": " . $start_key[ $sk ]['S'] . "\n";
			if( $keys[ $start_key[ $pk ]['S'] ] ){
				//echo "Key to start!";
				break;
			}else{
				$keys[ $start_key[ $pk ]['S'] ] = [ 'start'=>$start_key[ $sk ]['S'] ];
			}

			if( !$start_key ){
				break;
			}
			if( time()-$start >  30 ){
				$err = "Timeout";
				break;
			}
			if( sizeof($keys) > 100 ){
				$err = "Too many keys";
				break;
			}
			//usleep(10000);
		}

		return [
			'status'=>'success',
			'keys'=>$keys,
			'error'=>$err,
			//'log'=>$log,
		];
	}
	function POST_find_key_count(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$table = $post['TableName'];
		$log = [];
		try{
			$res = $dynamodb_con->con->describeTable(['TableName'=>$table])->toArray();
			if( $res['Table'] ){
				if( $post['query_index'] == "main" ){
					$schema = $res['Table']['KeySchema'];
				}else{
					foreach( $res['Table']['GlobalSecondaryIndexes'] as $si=>$sd ){
						if( $sd['IndexName'] == $post['query_index'] ){
							$schema = $res['Table']['GlobalSecondaryIndexes'][ $si ]['KeySchema'];
						}
					}
				}
				//print_r( $res['Table'] );exit;
				$pk = $schema[0]['AttributeName'];
				$sk = $schema[1]['AttributeName'];
				$log[] = $schema;
			}
		}catch(Exception $ex){
			return [
				"status"=>"fail",
				"error"=>"describe Table Fail: " . $ex->getMessage()
			];
		}
		if( !$pk ){
			return [
				"status"=>"fail",
				"error"=>"Primary Key not found"
			];
		}

		//echo $pk . ":" . $sk . "\n";
		$cnt = 0;
		$units = 0;
		$log = [];
		$start = time();
		$lk = false;
		$err = "";
		while( 1 ){
			$p = [
				"TableName"=> $table, 
				"project"=> $pk.",".$sk,
				"query"=>[ 
					[
						'field'=>$pk,
						'Type'=>"S",
						"KeyType"=>"hash",
						'value'=>$post['key']
					]
				],
				"ReturnConsumedCapacity"=>"TOTAL",
			];
			if( $post['query_index'] != "main" ){
				$p['IndexName'] = $post['query_index'];
			}
			if( $lk ){
				$p['ExclusiveStartKey'] = $lk;
			}
			$res = $dynamodb_con->query( $p );
			unset($res['Items']);
			//$log[] = $res;
			$log[] = $res['LastEvaluatedKey'];
			$cnt += $res['Count'];
			$units += $res["ConsumedCapacity"];
			$log[] = $cnt;
			$lk = $res['LastEvaluatedKey'];
			if( !$lk ){
				break;
			}
			if( $units > 10000 ){
				$log[] = "CapacityUnits outbreak";
				$err = "CapacityUnits outbreak";
				break;
			}
			if( time()-$start > 30 ){
				$log[] = "Timeout";
				$err = "Timeout";
				break;
			}
		}
		return [
			'status' => 'success',
			'key' => $post['key'],
			'cnt' => $cnt,
			'units' => $units,
			'log'=>$log,
			'error'=>$err
		];
	}
	function POST_find_all_key_count(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$table = $post['TableName'];
		$log = [];
		try{
			$res = $dynamodb_con->con->describeTable(['TableName'=>$table])->toArray();
			if( $res['Table'] ){
				if( $post['query_index'] == "main" ){
					$schema = $res['Table']['KeySchema'];
				}else{
					foreach( $res['Table']['GlobalSecondaryIndexes'] as $si=>$sd ){
						if( $sd['IndexName'] == $post['query_index'] ){
							$schema = $res['Table']['GlobalSecondaryIndexes'][ $si ]['KeySchema'];
						}
					}
				}
				//print_r( $res['Table'] );exit;
				$pk = $schema[0]['AttributeName'];
				$sk = $schema[1]['AttributeName'];
				$log[] = $schema;
			}
		}catch(Exception $ex){
			return [
				"status"=>"fail",
				"error"=>"describe Table Fail: " . $ex->getMessage()
			];
		}
		if( !$pk ){
			return [
				"status"=>"fail",
				"error"=>"Primary Key not found"
			];
		}

		$cnt = 0;
		$units = 0;
		$log = [];
		$start = time();
		$last_key = false;
		$keys = [];
		$err = "";
		while( 1 ){
			$p = [
				"TableName"=> $table, 
				"ProjectionExpression"=> '#pk, #sk',
				"ExpressionAttributeNames"=>['#pk'=>$pk, '#sk'=>$sk],
				"ReturnConsumedCapacity"=>"TOTAL",
			];
			if( $post['query_index'] != "main" ){
				$p['IndexName'] = $post['query_index'];
			}
			if( $last_key ){
				$p['ExclusiveStartKey'] = $last_key;
			}
			$res = $dynamodb_con->con->scan( $p )->toArray();
			foreach( $res['Items'] as $i=>$j ){
				if( !$keys[ $j[ $pk ]['S'] ] ){
					$keys[ $j[ $pk ]['S'] ] = ['start'=>$j[ $sk ]['S'], 'end'=>'', 'cnt'=>1 ];
				}
				$keys[ $j[ $pk ]['S'] ]['end'] = $j[ $sk ]['S'];
				$keys[ $j[ $pk ]['S'] ]['cnt']+=1;
			}
			unset($res['Items']);

			//$log[] = $res;
			$last_key = $res['LastEvaluatedKey'];
			$log[] = $res['LastEvaluatedKey'];
			$cnt += sizeof($res['Count']);
			$units += $res["ConsumedCapacity"]["CapacityUnits"];
			$log[] = $cnt;
			$lk = $res['LastEvaluatedKey'];
			if( !$lk ){
				break;
			}
			if( $units > 10000 ){
				$log[] = "CapacityUnits outbreak";
				$err = "CapacityUnits outbreak";
				break;
			}
			if( time()-$start > 30 ){
				$log[] = "Timeout";
				$err = "Timeout";
				break;
			}
		}
		return [
			'status'=>'success',
			'keys'=>$keys,
			'cnt'=>$cnt,
			'units'=>$units,
			'log'=>$log,
			'error'=>$err
		];
	}
	function POST_bulk_delete_keys(){
		global $dynamodb_con;
		global $mr;
		$res = $this->verify_session();
		if( $res['status'] != "success" ){
			return $res;
		}
		$post = $this->requestContext['body'];
		$table = $post['TableName'];
		$log = [];
		try{
			$res = $dynamodb_con->con->describeTable(['TableName'=>$table])->toArray();
			if( $res['Table'] ){
				if( $post['query_index'] == "main" ){
					$schema = $res['Table']['KeySchema'];
				}else{
					foreach( $res['Table']['GlobalSecondaryIndexes'] as $si=>$sd ){
						if( $sd['IndexName'] == $post['query_index'] ){
							$schema = $res['Table']['GlobalSecondaryIndexes'][ $si ]['KeySchema'];
						}
					}
				}
				//print_r( $res['Table'] );exit;
				$pk = $schema[0]['AttributeName'];
				$sk = $schema[1]['AttributeName'];
				$log[] = $schema;
			}
		}catch(Exception $ex){
			return [
				"status"=>"fail",
				"error"=>"describe Table Fail: " . $ex->getMessage()
			];
		}
		if( !$pk ){
			return [
				"status"=>"fail",
				"error"=>"Primary Key not found"
			];
		}

		//echo $pk . ":" . $sk . "\n";
		$cnt = 0;
		$units = 0;
		$log = [];
		$start = time();
		$lk = false;
		$err = "";
		while( 1 ){
			$p = [
				"TableName"=> $table, 
				"project"=> $pk.",".$sk,
				"query"=>[
					[
						'field'=>$pk,
						'Type'=>"S",
						"KeyType"=>"hash",
						'value'=>$post['key']
					]
				],
				"ReturnConsumedCapacity"=>"TOTAL",
				"Limit"=>25,
			];
			if( $post['query_index'] != "main" ){
				$p['IndexName'] = $post['query_index'];
			}
			if( $lk ){
				$p['ExclusiveStartKey'] = $lk;
			}
			$res = $dynamodb_con->query( $p );
			$log[] = $res['LastEvaluatedKey'];
			$cnt += $res['Count'];
			$units += $res["ConsumedCapacity"];
			$log[] = $cnt;
			$lk = $res['LastEvaluatedKey'];

			$dl_keys = [];
			foreach( $res['Items'] as $ii=>$iv ){
				$dl_keys[] = ['DeleteRequest'=>['Key'=>$dynamodb_con->mr->marshalItem($iv)]];
			}
			if( $res['Items'] ){
				$pp = [
					'RequestItems'=>[
						$table=>$dl_keys
					],
					"ReturnConsumedCapacity"=>"TOTAL",
				];
				//print_r( $pp );exit;
				$log[] = $pp;
				$res = $dynamodb_con->con->batchWriteItem($pp)->toArray();
				$log[] = "delete success";
				$log[] = $res;
				$units += $res["ConsumedCapacity"]['CapacityUnits'];
			}
			if( !$lk ){
				break;
			}
			if( $units > 1000 ){
				$log[] = "CapacityUnits outbreak";
				//$err = "CapacityUnits outbreak";
				break;
			}
			if( time()-$start > 10 ){
				$log[] = "Timeout";
				//$err = "Timeout";
				break;
			}
			//break;
		}
		return [
			'status' => 'success',
			'cnt' => $cnt,
			'units' => $units,
			'log'=>$log,
			'error'=>$err
		];
	}
}