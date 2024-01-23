<?php

class HTTPRequest{
	public $request = ['t'=>"O",'v'=>[
		"url"=>["t"=>"T", "v"=>""],
		"method"=>["t"=>"T", "v"=>"GET"],
		"content-type"=>["t"=>"T", "v"=>"application/x-www-form-urlencoded"],
		"headers"=> ["t"=>"O", "v"=>[]],
		"user-agent"=>["t"=>"T", "v"=>"Revolutionary NoCode Tool"],
		"ssl_verify"=>["t"=>"B", "v"=>false],
		"ssl_2way"=>["t"=>"B", "v"=>false],
		"ssl_key"=>["t"=>"T", "v"=>""],
		"ssl_cert"=>["t"=>"T", "v"=>""],
		"use_proxy"=>["t"=>"B", "v"=>false],
		"proxy_type"=>["t"=>"T", "v"=>"http"],
		"proxy"=>["t"=>"O", "v"=>[
			"host"=>["t"=>"T", "v"=>""],
			"port"=>["t"=>"N", "v"=>""],
			"username"=>["t"=>"T", "v"=>""],
			"password"=>["t"=>"T", "v"=>""] 
			]
		],
		"connect_timeout"=>["t"=>"N", "v"=>5000],
		"read_timeout"=>["t"=>"N", "v"=>5000],
		"authorization"=>["t"=>"T", "v"=>""],
		"payload"=>["t"=>"O", "v"=>[]],
		"files"=>["t"=>"T", "v"=>""],
	]];
	public $response = ['t'=>"O", 'v'=>[
		"status"=>["t"=>"T", "v"=>""],
		"body"=>["t"=>"T", "v"=>""],
		"headers"=>['t'=>"O", 'v'=>[
			"content-type"=>["t"=>"T", "v"=>"text/plain"],
			"content-length"=>["t"=>"N", "v"=>0],
		]]
	]];
	function __constructor(){
		//CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	}
	function GET($vs){
		// echo "GET Method";
		// print_pre($vs);
		$this->request['v']['method']['v'] = "GET";
		$this->request['v']['url']['v'] = $vs['p2']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function POST($vs){
		$this->request['v']['method']['v'] = "POST";
		$this->request['v']['url']['v'] = $vs['p2']['v'];
		$this->request['v']['content-type']['v'] = $vs['p3']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function setRequestHeader($vs){
		$this->request['v']['headers']['v'][ $vs['p2']['v'] ] = $vs['p3']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function setContentType($vs){
		$this->request['v']['headers']['v'][ "content-type" ] = $vs['p2']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function setPayload($vs){
		$this->request['v']['payload']['v'] = $vs['p2']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function setFollowRedirect($vs){
		//$this->request['v']['payload'] = $vs['p2']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function setConnectTimeout($vs){
		if( $vs['p2']['v'] < 1000 ){
			$vs['p2']['v'] = 1000;
			$this->log[] = "Error: setConnectTimeout: value should be in milliseconds";
		}
		$this->request['v']['connect_timeout']['v'] = (int)$vs['p2']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function setReadTimeout($vs){
		if( $vs['p2']['v'] < 1000 ){
			$vs['p2']['v'] = 2000;
			$this->log[] = "Error: setConnectTimeout: value should be in milliseconds";
		}
		$this->request['v']['connect_timeout']['v'] = (int)$vs['p2']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function setUserAgent($vs){
		$this->request['v']['headers']['v']['User-Agent'] = $vs['p2']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function setSSLVerify($vs){
		$this->request['v']['ssl_verify']['v'] = $vs['p2']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function set2WaySSL($vs){
		$this->request['v']['ssl_key']['v'] = $vs['p2']['v'];
		$this->request['v']['ssl_key']['v'] = $vs['p2']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function setProxyHttp($vs){
		$this->request['v']['use_proxy']['v'] = true;
		$this->request['v']['proxy_type']['v'] = "http";
		$this->request['v']['proxy']['v']['host']['v'] = $vs['p2']['v'];
		$this->request['v']['proxy']['v']['port']['v'] = $vs['p3']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function setProxySocks($vs){
		$this->request['v']['use_proxy']['v'] = true;
		$this->request['v']['proxy_type']['v'] = "socks";
		$this->request['v']['proxy']['v']['host']['v'] = $vs['p2']['v'];
		$this->request['v']['proxy']['v']['port']['v'] = $vs['p3']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function setProxySocks5($vs){
		$this->request['v']['use_proxy']['v'] = true;
		$this->request['v']['proxy_type']['v'] = "socks5";
		$this->request['v']['proxy']['v']['host']['v'] = $vs['p2']['v'];
		$this->request['v']['proxy']['v']['port']['v'] = $vs['p3']['v'];
		$this->request['v']['proxy']['v']['username']['v'] = $vs['p4']['v'];
		$this->request['v']['proxy']['v']['password']['v'] = $vs['p5']['v'];
		return ['t'=>"B", 'v'=>true];
	}
	function getResponseStatus($vs){
		return $this->response['v']['status'];
	}
	function getResponseContent($vs){
		return $this->response['v']['body'];
	}
	function getResponseHeaders($vs){
		return $this->response['v']['headers'];
	}
	function getResponseHeader($vs){
		return $this->response['v']['headers']['v'][ $vs['p2']['v'] ];
	}
	function getError($vs){
		return $this->response['v']['error'];
	}
	function getVariables($vs){
		return ['t'=>"O", 'v'=>[
			"request"=>$this->request,
			"response"=>$this->response,
		]];
	}
	function execute($vs){
		//print_pre( $this->request );
		$ch = curl_init();
		$options = array(
			CURLOPT_HEADER => 1,
			CURLOPT_URL => $this->request['v']['url']['v'],
			CURLOPT_CONNECTTIMEOUT_MS=> (int)$this->request['v']['connect_timeout']['v'],
			CURLOPT_TIMEOUT => (int)$this->request['v']['read_timeout']['v'],
			CURLOPT_RETURNTRANSFER =>true,
			CURLOPT_AUTOREFERER=>true,
		);
		curl_setopt_array($ch, $options);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->request['v']['ssl_verify']['v'] );
		if( $this->request['v']['ssl_2way']['v'] ){
			curl_setopt($ch, CURLOPT_SSLCERT, $this->request['v']['ssl_cert']['v'] );
			curl_setopt($ch, CURLOPT_SSLKEY, $this->request['v']['ssl_key']['v'] );
		}
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->request['v']['method']['v'] );
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		if( $this->request['v']['method']['v'] == "POST" ){
			curl_setopt($ch, CURLOPT_POST, 1 );
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->request['v']['payload']['v'] );
		}else{
			curl_setopt($ch, CURLOPT_HTTPGET, 1 );
		}
  		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->request['v']['headers']['v'] );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ch);
		$info = curl_getinfo( $ch );
		$error = curl_error( $ch );
		$errorno = curl_errno( $ch );
		curl_close($ch);
		$headers = [];
		$h = "";
		$body = "";
		$content_type="";
		if( $error ){
		}else{
			//print_pre( $info );
			$parts = explode("\r\n\r\n", $result);
			if( sizeof($parts) > 2 ){
				if( preg_match( "/^HTTP\/([10\.]+)\ 100/i", $parts[0]) ){
					array_splice( $parts, 0, 1 );
				}
			}
			$h = array_splice($parts,0,1)[0];
			$body = implode("\r\n\r\n", $parts);
			unset($parts);

			$h = explode("\r\n",$h);
			foreach( $h as $i=>$j ){
				$k = explode(":",$j,2);
				if( sizeof($k) > 1 ){
					if( strtolower(trim($k[0])) == "content-type" ){
						$k[1] = trim(explode(";",$k[1])[0]);
						if( !$k[1] ){
							$k[1] = "";
						}
					}
					if( strtolower(trim($k[0])) == "Set-Cookie" ){
						if( !$headers[ "set-cookie" ] ){
							$headers[ "set-cookie" ] = ['t'=>"L",'v'=>[]];
						}
						$headers[ "set-cookie" ]['v'] = ['t'=>"T","v"=>trim($k[1])];
					}else{
						$headers[ strtolower(trim($k[0])) ] = ['t'=>"T","v"=>trim($k[1]) ];
					}
				}
			}

			if( $info["content_type"] ){
				$content_type=explode(";",$info["content_type"])[0];
			}else{
				$content_type="text/plain";
			}
		}

		//echo $info['http_code'];exit;
		$this->response['v']['status']['v'] = $info['http_code'];
		$this->response['v']['body']['v'] = $body;
		$this->response['v']['error']['v'] = $error;
		$this->response['v']['errno']['v'] = $errno;
		$this->response['v']['content-type']['v'] = $content_type;
		$this->response['v']["total_time"]['v'] = $info['total_time'];
		$this->response['v']["size_download"]['v'] = $info['size_download'];
		$this->response['v']['headers']['v'] = $headers;
		//print_pre( $this->response );
		if( $error ){
			return ['t'=>"B", "v"=>false];
		}else{
			return ['t'=>"B", "v"=>true];
		}
	}
	function build_payload(){
		$postbody = "";
			if( $api['data']['content-type'] == "application/x-www-form-urlencoded" ){
				$v = [];
				foreach( $api['data']['body'] as $i=>$j ){
					if( $j['vtype'] == "static" ){
						//if( $j['vtpye'] == "")
						$v[] = $i . "=". urlencode($j['value']);
					}else{
						if( gettype( $this->result[ $j['value'] ] ) == "array" || gettype( $this->result[ $j['value'] ] ) == "object" ){
							$v[] = $i . "=". urlencode(json_encode( $this->result[ $j['value'] ], JSON_PRETTY_PRINT));
						}else{
							$v[] = $i . "=". urlencode( $this->result[ $j['value'] ] );
						}
					}
				}
				$postbody = implode("&",$v);
				if( $api_debug ){
					echo $postbody;
				}
			}else if( $api['data']['content-type'] == "multipart/form-data" ){
				$v = [];
				//print_r( $api['data']['body'] );
				foreach( $api['data']['body'] as $i=>$j ){
					if( $j['vtype'] == "static" ){
						$v[] = "Content-Disposition: form-data; name=\"".$i."\"\r\n\r\n".$j['value']."\r\n";
					}else{
						if( $j['type'] == "file" ){
							$filed = $this->download_file( $this->result[ $j['value'] ] );
							//print_r( $filed );
							if( $filed['status'] == 200 && $filed['size'] > 0 ){
								$filetype = $filed['filetype'];
								//$filed['body'] = base64_encode($filed['body']);
								//$v[] = "Content-Disposition: form-data; name=\"".$i."\"; filename=\"".$filed['filename']."\"\r\nContent-Type: ".$filetype."\r\nContent-Transfer-Encoding: base64\r\n\r\n".$filed['body']."\r\n";
								//$filed['body'] = utf8_encode( $filed['body'] );
								$v[] = "Content-Disposition: form-data; name=\"".$i."\"; filename=\"".$filed['filename']."\"\r\nContent-Type: ".$filetype."\r\n\r\n".base64_decode($filed['body'])."\r\n";
							}else{
								$this->set_output( "apiStatusCode", 500 );
								$this->set_output( "apiStatus", "Input File Download Failed!" . $filed['error'] );
								$this->sub_log[] = "API Call failed: " . "Input File Download Failed!" . $filed['error'];
							}
						}else if( gettype( $this->result[ $j['value'] ] ) == "array" || gettype( $this->result[ $j['value'] ] ) == "object" ){
							$v[] = "Content-Disposition: form-data; name=\"".$i."\"\r\n\r\n".json_encode( $this->result[ $j['value'] ], JSON_PRETTY_PRINT)."\r\n";
						}else{
							$v[] = "Content-Disposition: form-data; name=\"".$i."\"\r\n\r\n".$this->result[ $j['value'] ]."\r\n";
						}
					}
				}
				//print_r( $v );
				$boundary = "boundary-" .time();
				$api['data']['boundary']  = $boundary;
				$boundary = "--" . $boundary;
				$postbody = $boundary . "\r\n" . implode($boundary."\r\n",$v) .$boundary . "--";

				//header("content-type: text/plain");echo $postbody; exit;

				if( $api_debug ){
					echo $postbody;
				}
			}else if( $api['data']['content-type'] == "text/plain" || $api['data']['content-type'] == "application/octet-stream" ){
				if( $api['data']['body']['vtype']=="variable"){
					$postbody = $this->result[ $api['data']['body']['value'] ];
				}else{
					$postbody = $api['data']['body']['value'];
				}
			}else if( $api['data']['content-type'] == "application/json" ){
				if( $api_debug && 1==2 ){
					echo "Body Template";
					print_pre( $api['data']['body'] );
				}
				$postbody = $this->build_post_json($api['data']['body'],$this->result);
				if( $api_debug ){
					echo "PostBody: ";
					print_pre($postbody);
				}
				$postbody = json_encode( $postbody, JSON_PRETTY_PRINT );
			}else if( $api['data']['content-type'] == "application/xml" || $api['data']['content-type'] == "application/xhtml+xml" || $api['data']['content-type'] == "text/xml" ){
				if( $api_debug && 1==2 ){
					echo "Body Template";
					print_pre( $api['data']['body'] );
				}
				$postbody = "<"."?xml version=\"1.0\" encoding=\"UTF-8\"?".">\n".$this->build_post_xml($api['data']['body'],$this->result);
				if( $api_debug ){
					echo "PostBody: ";
					print_pre($postbody);
				}
			}else{
				$this->set_output( "apiStatusCode", 500 );
				$this->set_output( "apiStatus", "Request content-type unknown" );
				$this->sub_log[] = "API Call failed: " . "Request content-type unknown";
			}
	}
}
