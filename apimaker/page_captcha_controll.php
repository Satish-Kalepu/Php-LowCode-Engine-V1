<?php

if( $_GET['action'] == "getcaptcha" ){

	$v = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz-!_.,@#$%^&*<>=";
	$cap = substr($v,rand(0,76),1)." ".substr($v,rand(0,76),1)." ".substr($v,rand(0,76),1)." ".substr($v,rand(0,76),1);
	$code = time();

	$im = imagecreatetruecolor(120,40);
	$white = imagecolorallocate($im, rand(0,255),rand(0,255),rand(0,255));
	imagefill($im, 0,0, $white);
	$white = imagecolorallocate($im, rand(110,255),rand(110,255),rand(110,255));

	$sz = rand(20,24);
	$angle = rand(-5,5);
	$x = rand(0,20);
	$y = rand(20,30);
	imagettftext($im, $sz, $angle, $x, $y, $white,  __DIR__."/arial.ttf", $cap);
	$red = imagecolorallocate($im, rand(0,55),rand(0,85),rand(0,95));
	imagettftext($im, $sz, $angle, $x+1, $y+1, $red,  __DIR__."/arial.ttf", $cap);
	$red = imagecolorallocate($im, rand(0,155),rand(0,155),rand(0,155));
	imagettftext($im, $sz, $angle, $x-1, $y-1, $red,  __DIR__."/arial.ttf", $cap);

	$_SESSION['login_captcha'] = str_replace(" ","", $cap);
	$_SESSION['login_code'] = $code;

	//header("Content-Type: image/jpeg");imagepng($im);exit;
	ob_start();
	imagepng($im);
	$imagedata = ob_get_contents();
	ob_end_clean();
	json_response([
		"status"=>"success",
		"img"=>"data:image/png;base64,".base64_encode($imagedata),
		"code"=>$code,
	]);
	exit;
}


class captcha{
	public $status = 200;
	public $response = "Serverless Captcha Service";
	public $headers = [];
	public $error = "";
	public $request_method = "GET";
	public $request_headers = [];
	public $GET = [];
	public $POST = [];
	public $input = "";
	public $params = [];
	public $requestContext = [];
	function __construct( $requestContext = [], $params ){
		$this->requestContext = $requestContext;
		$this->params = $params;
		$this->conn = false;
		//$req['queryStringParameters']
		//$req['body']
		//$req['headers']
		//$req['headers']['host']
		//$req['headers']['x-forwarded-for']
	}
	function GET_default(){
		$this->status =404;
		$this->response = "Get request disabled";
	}
	function POST_default(){
		$this->status =200;
		$this->response = "Home poste request recieved <BR>" . $this->requestContext['body'];
	}
	function GET_GET(){

		global $request_context;

		if( !$request_context['headers']['host'] ){
			return ['statusCode'=>'400', 'body'=>"Host header missing in the request"];
		}else{
			$x= explode(",",$_ENV['config_allow_domains'] );
			$f = false;
			foreach( $x as $i=>$j ){
				if( strpos( strtolower($request_context['headers']['host']), strtolower(trim($j)) ) === false ){
				}else{
					$f = true;
				}
			}
			if( !$f ){
				return ['statusCode'=>'400', 'body'=>"Host not allowed. " . $request_context['headers']['host']];
			}
		}

		$im = imagecreatetruecolor(120, 50);
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$code = substr($chars,rand(0,35),1);
		$code .= substr($chars,rand(0,35),1);
		$code .= substr($chars,rand(0,35),1);
		$code .= substr($chars,rand(0,35),1);
		$code .= substr($chars,rand(0,35),1);
		$tcode = time() . ".". rand(1000,9999);
		if( $this->insert( $code, $tcode ) == false ){
			return false;
		}
		$c = imagecolorallocate($im, rand(150,255),rand(150,255),rand(150,255));
		imagefill($im, 0,0, $c);
		$c = imagecolorallocate($im, rand(0,125),rand(0,125),rand(0,125));
		$f = getcwd() . "/arial.ttf";
		//echo "imagettftext: " . $f . "\n";
		if( !file_exists($f) ){
			echo "ERROR: file not found!\n";
			$this->response = [
				"status"=>"fail",
				"error"=>"ttf file not found!"
			];
			return false;
		}
		imagettftext($im, 20, rand(-10,10), 15, 35, $c, $f, $code);
		$c = imagecolorallocate($im, rand(0,225),rand(0,225),rand(0,225));
		imageline($im, rand(0,20), rand(0,20), rand(75,120), rand(75,120), $c);
		$c = imagecolorallocate($im, rand(0,225),rand(0,225),rand(0,225));
		imageline($im, rand(75,120), rand(0,20), rand(75,120),  rand(0,20), $c);
		$c = imagecolorallocate($im, rand(0,225),rand(0,225),rand(0,225));
		imageline($im, rand(75,120), rand(0,20), rand(0,20), rand(0,120), $c);
		$c = imagecolorallocate($im, rand(0,225),rand(0,225),rand(0,225));
		imageline($im, rand(0,20), rand(0,20), rand(75,120), rand(75,120), $c);
		$c = imagecolorallocate($im, rand(0,225),rand(0,225),rand(0,225));
		imageline($im, rand(75,120), rand(0,20), rand(75,120),  rand(0,20), $c);
		$c = imagecolorallocate($im, rand(0,225),rand(0,225),rand(0,225));
		imageline($im, rand(75,120), rand(0,20), rand(0,20), rand(0,120), $c);
		imagejpeg($im, "/tmp/ff", 80);
		unset($im);
		$d = file_get_contents("/tmp/ff");
		$this->response = [
			"status"=>"ok",
			"img"=>base64_encode($d),
			"code"=>$tcode,
			"t"=>(time()+3600)
		];
	}
	function insert( $code, $tcode ){
		global $connections;
		if( $this->connect_dynamodb() ){
			try{
				$connections["dbcon"]->putItem([
					'TableName'=>$_ENV['config_captcha_tablename'],
					'Item'=>$this->mr->marshalItem([
						"captcha" => $code,
						"time" => date("Y-m-d H:i:s"),
						"expire" => (int)(time()+300 ),
						"code" => $tcode
					])
				]);
				return true;
			}catch(Exception $ex){
				$this->status = 500;
				$this->response = "Error with DB: " . $ex->getMessage();
				return false;
			}
		}
	}
	function connect_dynamodb(){
		global $connections;
		$this->mr = new Aws\DynamoDb\Marshaler();
		if( !$connections["dbcon"] ){
		try{
			if( $_ENV['AWS_ACCESS_KEY_ID'] ){
				$connections["dbcon"] = new Aws\DynamoDb\DynamoDbClient([
					'version' => 'latest',
					'region' => $_ENV['config_captcha_region'],
				]);
			}else{
				$connections["dbcon"] = new Aws\DynamoDb\DynamoDbClient([
					'version' => 'latest',
					'region' => $_ENV['config_captcha_region'],
					'credentials' => [
						'key' => $_ENV["config_local_aws_key"],
						'secret' => $_ENV["config_local_aws_secret"],
					]
				]);
			}
		}catch(Exceptin $ex){
			$this->response= [
				"status"=>"fail",
				"error"=>"DB error: " . $ex->getMessage()
			];
			return false;
		}
		}
		return true;
	}
	function GET_verify(){
		global $connections;
		if( $this->connect_dynamodb() ){
			try{
				$res = $connections["dbcon"]->getItem([
					'TableName'=>$_ENV['config_captcha_tablename'],
					'Key'=>$this->mr->marshalItem([
						"captcha" => $this->requestContext['queryStringParameters']['captcha'],
					])
				])->toArray();
				if( $res['Item'] ){
					$item = $this->mr->unmarshalItem($res['Item']);
					if( $item['code'] == $this->requestContext['queryStringParameters']['code'] ){
						$connections["dbcon"]->deleteItem([
							'TableName'=>$_ENV['config_captcha_tablename'],
							"Key"=>$this->mr->marshalItem(["captcha"=>$this->requestContext['queryStringParameters']['captcha']])
						]);
						$this->response = [
							"status"=>"success",
						];
					}else{
						$this->response = [
							"status"=>"fail",
							"error"=>"Code mismatch!",
							"code"=>$item['code'],
						];
					}
				}else{
					$this->status = 404;
					$this->response = [
						"status"=>"fail",
						"error"=>"Code not found!"
					];
				}
				return true;
			}catch(Exception $ex){
				$this->status = 500;
				$this->response = "Error with DB: " . $ex->getMessage();
				return false;
			}
		}
	}
}