<?php 
trait misc{
	//include("include_execute_dynamicform.php");
	function execute_renderarticle( $renderarticle , $vstage ){
		if( $renderarticle['article_id'] ){
			$v = "article_content_" .rand(1,1000);
			$vv = "random_element_" . rand(1,1000);
			$this->output_html .= "\t<link rel='stylesheet' type='text/css' href='bootstrap/articles_styles.css' >\n\t";
			$this->output_html .= "<link rel='stylesheet' type='text/css' href='bootstrap/articles_styles2.css' >\n\t";
			if( $renderarticle['type'] == "dynamic" ){	
				$data = file_get_contents("article_view.js"); 
				$this->output_html .= "<div id='" . $vv . "' ></div>\n";
				$this->output_html .="<script>\n\t var v1='".$renderarticle['article_id']  . "';\n\t var v2='".$renderarticle['page_id']  . "';\n\t v3='".$vstage. "';\n\t </script>";
				$data = str_replace( "article_content_", $v, $data );
				$data = str_replace( "random_element_", $vv, $data );
				$this->output_html .="<script>".$data . "</script>";
				
			}else{
				$article = $this->con->find_one( "api_articles", ["user_id"=>$renderarticle['user_id'], "_id"=>$renderarticle['article_id']] );
				if( $article != false ){
					$article_sections = $this->con->find("api_articles_sections",["article_id"=>$article['_id']],[ "sort" => ["section_order_id"=>1] ] );
					$data = $this->execute_static_renderarticle($article_sections,true,$article['title'], ( $article['m_u']?$article['m_u']:$article['m_i'] ) );
					$this->output_html .= $data;
				}
			}
		}
	}
	function execute_static_renderarticle( $vsections,$vshow_article,$article_title,$article_date  ){
		$data = "";
		$data .= '<div class="container" id="articles_view">
			<div class="p-1">';
		if( $vshow_article == true ){
			$data .= '<div style="border-bottom:1px solid #aaa;" class="clearfix"  >
					<div class="fs-2 float-start">'.$article['title']."</div>
				  </div>
				<div>Last edited on: ".( $article['m_u']?$article['m_u']:$article['m_i'] )."&nbsp;&nbsp;&nbsp;</div>
				<div>&nbsp;</div>\n";
		}
		foreach( $vsections as $sec_id => $section ){
			$data .= "<div><a style='position:absolute; margin-top:-50px;' name='section_".$sec_id."'></a>";
			if($section['type'] == 'text'){
				$data .= "<div class='section_div2'>
						<div id='article_section_".$sec_id."' class='section_content ckeditor' spellcheck='false'>".$section['body']."</div>
					</div>";
			}
			if($section['type'] == 'code' && $section['body'] != ""){
				$data .= "<div class='section_div2'>
						<pre id='article_section_".$sec_id."' class='section_content'>".$section['body']."</pre>
					</div>";
			}
			if($section['type'] == 'attachment' && $section['attachment_url']){
				$data .= "<div class='section_div3'>
						<a id='article_section_".$sec_id."' href='".$section['attachment_url']."' target='_blank' >".$section['attachment_caption']."</a>
					</div>";
			}
			if($section['type'] == 'image' && $section['image_url']){
				$vstyle = "min-height:50px; text-align:center;";
				if( $section['image_style']=='FloatLeft' || $section['image_style']=='FloatRight' ){
					if( $section['image_style']=='FloatLeft' ){ $vstyle .= "float:left; margin-right:20px;";}
					if( $section['image_style']=='FloatRight'){ $vstyle .= "float:right; margin-left:20px;";}
					if( $section['image_width']=='100%' ){ $vstyle = "width:100%;";}
					if( $section['image_width']=='50%' ){ $vstyle = "width:50%;";}
					if( $section['image_width']=='25%' ){ $vstyle = "width:25%;";}
				}
				$vstyle1 = "position: relative; text-align: center; display: inline-block; ";
				if( $section['image_style'] == 'Center' || $section['image_style'] == 'Full' ){
					if( $section['image_width']=='100%' ){ $vstyle1 = "width:100%;";}
					if( $section['image_width']=='50%' ){ $vstyle1 = "width:50%;";}
					if( $section['image_width']=='25%' ){ $vstyle1 = "width:25%;";}
				}else{
					$vstyle1 .= "width:100%;";
				}
				$vstyle2 = "max-width:100%;max-height:500px; min-width:100px; min-height:50px;";
				$data .= "<div class='section_div' style='".$vstyle."'>";
				if( $section['image_url'] != '' && $section['image_link'] != '' ){
					$data .= "<a target='_blank' href='".$section['image_link']."' title='".$section['image_link']."'>
							<img src='".$section['image_url']."' style='".$vstyle2."' >
						  </a>";
					$data .= "<a target='_blank' href='".$section['image_link']."'>".$section['image_caption']."</a>";
				}
				if( $section['image_url'] != '' ){
					$data .= "<img src='".$section['image_url']."' style='".$vstyle2."' title='Double click to preview' onclick='expand_image__(".$sec_id.")' >";
					$data .= "<div alt='".$section['image_caption']."'>".$section['image_caption']."</div>";
				}
				$data .= "</div>";
			}
			$data .= "</div>";
		}
		$data .= "<div style='display:none' id='expand_image_w'></div><div style='display:none' id='expand_image_h'></div><div style='display:none' id='expand_image_percent'></div>";
		$data .= '<div class="expand_popup" id="expand_popup" onclick="close_expand_popup()" style="display:none">
				<div style="position:fixed; top:0px; left:0px; background-color:rgba(255,255,255,0.6); width:100%; text-align:left;">
					<span style=" padding:5px 20px; font-weight:bold;" id="expand_image_title" ></span>
					<input type="button" class="btn btn-danger btn-sm float-end" value="X" onclick="close_expand_popup()">
				</div>
				<img id="expand_popup_img_tag" onclick.stop onwheel.prevent.stop="expand_wheel()" onload="expand_image2_style__()" style="get_expand_image_style()">
		</div>';
		$data .= "</div>
		</div>";
		$data .="<script>\n\t var vsections=".json_encode($vsections,JSON_PRETTY_PRINT)."; </script>\n";
		$data .="<script src='article_view_.js'></script>";
		return $data;
	
	}
	function execute_renderarticle2($renderarticle){
		/*{
			article_id,
			user_id,
			page_id,
			article_title,
		}*/
		if( $renderarticle['article_id'] ){
			//$article = $this->con->find_one( "api_articles", ["user_id"=>$renderarticle['user_id'], "_id"=>$renderarticle['article_id']] ); 

			if( $renderarticle['type'] == "dynamic" ){
	
				$v = "article_content_" .rand(1,1000);
				$vv = "random_element_" . rand(1,1000);
				$vvv = "article_id_" .rand(1,1000);
				$this->output_html .= "<link rel='stylesheet' type='text/css' href='bootstrap/articles_styles.css' >\n";
				$this->output_html .= "<link rel='stylesheet' type='text/css' href='bootstrap/articles_styles2.css' >\n";
				$this->output_html .= "<div id='" . $vv . "' ></div>\n";
				$this->output_html .= "<script> var ".$v." =". json_encode($renderarticle['article'],JSON_PRETTY_PRINT)."</script>";
				$data = file_get_contents("article_view.js"); 
				// ajax action ?action=get_artilce_contet&page_id=&article_id 
				$data = str_replace( "article_content_", $v, $data );
				$data = str_replace( "random_element_", $vv, $data );
				$this->output_html .= "<script>" . $data . "</script>";
				
			}else{
				//php echo $this->output_html  
			} 
		}
	}
	function execute_renderblock( $renderblock ){
		//print_pre( $renderblock );
		if( $renderblock['block_id'] ){
			//echo $renderblock['block']['type'];
			if( $renderblock['block']['type'] == "static" ){
				$pa = new html_render();
				$vars = [];
				//print_pre($renderblock);
				foreach( $renderblock['mapping'] as $i=>$j ){
					//echo $i." == ".$j."=="."<br>";print_pre($this->result[ $j ] );
					$vars[ $i ] = $this->get_value( $j );
				}
				//print_pre( $vars );exit;
				foreach( $renderblock['block']['blocks'] as $i=>$j ){
					if( $j['type']=="js"){
						$this->output_html .= "<script>";
					}
					if( $j['type']=="css"){
						$this->output_html .= "<style>";
					}
					if( $j['type']=="html" || $j["type"] == "article" ){
						if( $j['render'] ){
							$parse = new html_render();
							$parse->debug = false;
							$parse->parse( $j['body'], $vars );
							$this->output_html .= $parse->html;
						}else{
							$this->output_html .= $j['body'];
						}
					}else{
						if( $j['render'] ){
							$parse = new html_render();
							$parse->debug = false;
							$this->output_html .= $parse->fill_vars( $j['body'], $vars );
						}else{
							$this->output_html .= $j['body'];		
						}
					}
					if( $j['type']=="js"){
						$this->output_html .= "</script>";
					}
					if( $j['type']=="css"){
						$this->output_html .= "</style>";
					}
					//echo $this->output_html;exit;
					//exit;
				}
			}else if( $renderblock['block']['type'] == "article" ){ 
				$this->output_html .= "\t<link rel='stylesheet' type='text/css' href='bootstrap/articles_styles.css' >\n\t";
				$this->output_html .= "<link rel='stylesheet' type='text/css' href='bootstrap/articles_styles2.css' >\n\t";
				$this->output_html .=  $this->execute_static_renderarticle($renderblock['block']['blocks'],false,'','' );
				
			}else if( $renderblock['block']['type'] == "list" || $renderblock['block']['type'] == "image" || $renderblock['block']['type'] == "imagelibrary"  ){ 
				$this->output_html .= $renderblock['block']['blocks']['body'];
			}else if( $renderblock['block']['type'] ==  "headline"  ){ 
				$this->output_html .= $renderblock['block']['blocks']['body'];
			}else if( $renderblock['block']['type'] == "carousel" ){ 
				$this->output_html .= $renderblock['block']['blocks']['body'];
			}else if( $renderblock['block']['type'] == "simple-table"){
				$this->output_html .= $renderblock['block']['blocks']['body'];
			}else if( $renderblock['block']['type'] == "contactus" ){
				$this->output_html .= $renderblock['block']['blocks']['body'];
			}else if( $renderblock['block']['type'] == "single-card" ){
				$this->output_html .= $renderblock['block']['blocks']['body'];
			}
		}
	}
	function execute_renderhtml( $renderhtml ){
		//print_pre( $renderblock );
		if( $renderhtml['html_body'] ){
			$parse = new html_render();
			$parse->debug = false;
			$parse->parse( $renderhtml['html_body'], $this->result );
			$this->output_html .= $parse->html;
			$this->output_html .= "<style>" .$renderhtml['style_body']. "</style>";
		}
	}
	function execute_api_call( $api_data, $api ){
		$this->inputs[ "apiStatusCode" ] = [
			"name"=> "API Status code",
			"type"=> "number",
		];
		$this->inputs[ "apiStatus" ] = [
			"name"=> "API Status",
			"type"=> "text",
		];
		$this->set_result( "apiStatusCode", 0 );
		$this->set_result( "apiStatus",  "Pending" );
		$api_debug = false;
		{
			foreach( $api_data['input_mapping'] as $ini=>$ind ){
				$this->set_result( $ini, $this->get_value(  $ind ) );
			}
			if( $api_debug ){
				echo "Input Mapping: ";
				print_pre( $api_data['input_mapping'] );
				echo "API Inputs mapped: ";
				print_pre( $this->result );					
			}
			//print_pre( $api_input );
			//exit;
			if( $api_debug ){
				echo "Calling: ";
				echo $api['data']['url'];
			}

			$this->execute_formula( $api['data']['program'], false );
			preg_match_all("/\#([A-Za-z0-9\.\-\_]+)\#/", $api['data']['url'], $m );
			if( sizeof($m[0]) ){
				foreach( $m[0] as $i=>$j ){
					$api['data']['url'] = str_replace( $j, urlencode($this->get_value(  $m[1][$i]  ) ), $api['data']['url'] );
				}
			}			

			$this->log[] = "API: ". $api['data']['url'];
			$header_error = false;
			foreach( $api['data']['headers'] as $i=>$j ){
				if( $j['type'] == 'variable' ){
					$api['data']['headers'][$i]['value'] = $this->get_value(  $j['value'] );
					if( !$this->get_value(  $j['value'] ) ){
						$header_error = "Header: " . $api['data']['headers'][$i]['name'] . " required";
					}
				}else if( $api['data']['headers'][$i]['value'] =="" ){
					$header_error = "Header: " . $api['data']['headers'][$i]['name'] . " required";
				}
			}
			if( $header_error ){
				$this->set_result( "apiStatusCode", 500 );
				$this->set_result( "apiStatus", $header_error );
			}else{
	
				if( $api_debug ){
					print_pre($result);
				}
	
				$postbody = "";
				if( $api['data']['content-type'] == "application/x-www-form-urlencoded" ){
					$v = [];
					foreach( $api['data']['body'] as $i=>$j ){
						if( $j['vtype'] == "static" ){
							//if( $j['vtpye'] == "")
							$v[] = $i . "=". urlencode($j['value']);
						}else{
							if( gettype( $this->get_value(  $j['value'] ) ) == "array" || gettype( $this->get_value(  $j['value'] ) ) == "object" ){
								$v[] = $i . "=". urlencode(json_encode( $this->get_value(  $j['value'] ), JSON_PRETTY_PRINT));
							}else{
								$v[] = $i . "=". urlencode( $this->get_value( $j['value'] ) );
							}
						}
					}
					$postbody = implode("&",$v);
					if( $api_debug ){
						echo $postbody;
					}
				}else if( $api['data']['content-type'] == "text/plain" ){
					if( $api['data']['body']['vtype']=="variable"){
						$postbody = $this->get_value(  $api['data']['body']['value'] );
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
					$postbody = json_encode( $postbody);
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
					$this->set_result( "apiStatusCode", 500 );
					$this->set_result( "apiStatus", "Request content-type unknown" );
					$this->log[] = "API Call failed: " . "Request content-type unknown";
				}
				if( $postbody == "" ){
					$this->log[] = "Error: PostBody Empty!"; 
				}
				if( $this->outputs[ "apiStatusCode" ]["value"] == 0 ){
					$response = $this->do_api_call( $api['data'], $postbody );
					if( $api_debug ){
						print_pre( $response );
					}
					if( $response["status"] == "success" ){
			                	$response = $response["response"];
						if( $response['status'] == 200 ){
							if( $response["body"] == "" ){
								$this->set_result( "apiStatusCode", 500 );
								$this->set_result( "apiStatus", "Empty Response" );
							}else if( strtolower($response['content-type']) != strtolower($api['data']['response']['content-type']) ){
								$this->set_result( "apiStatusCode", 500 );
								$this->set_result( "apiStatus", "Incorrect content-type in response 1" );
								$this->set_result( "content-type-error", strtolower($response['content-type']) . " != " . strtolower($api['data']['response']['content-type']) );
								$this->log[] = "Content type mismatch: " .strtolower($response['content-type']) . " != " . strtolower($api['data']['response']['content-type']); 
							}else{
								if( $response["content-type"] == "application/json" && gettype($response['body']) != "array" ){
									$this->set_result( "apiStatusCode", 500 );
									$this->set_result( "apiStatus", "Incorrect Response 2: " . $response['body_error'] );
								}else{
									$output_variables_from_api = [];
									if( $response["content-type"] == "application/json" ){
										if( gettype($response["body"]) == "array" ){
										$output_variables_from_api = $this->map_outputs( $response["body"], $api["data"]["response"]["body"] );
										if($api_debug){
											echo "Output Variables from API: ";						
											print_pre( $output_variables_from_api );
										}
										foreach( $output_variables_from_api as $i=>$j ){
											$this->set_result( $i, $j );
										}
										}
									}
									if( $response["content-type"] == "application/xml" || $response["content-type"] == "application/xhtml+xml" || $response["content-type"] == "text/xml" ){
										if( gettype($response["body"]) == "array" ){
										$output_variables_from_api = $this->map_outputs( $response["body"], $api["data"]["response"]["body"] );
										if( $api_debug ){
											echo "Output Variables from API: ";						
											print_pre( $output_variables_from_api );
										}
										foreach( $output_variables_from_api as $i=>$j ){
											$this->set_result( $i, $j );
										}
										}
									}
		                                                        $this->execute_formula( $api['data']['program2'], false );
									foreach( $api_data['output_factors'] as $ini=>$ind ){
										$this->inputs[ $ind['key'] ] = [
											"name"=> $ind['name'],
											"type"=> $ind['type'],
										];
										$this->set_result( $ind['key'], $this->get_value( $ini ) );
									}
									$this->set_result( "apiStatusCode", (int)$response['status'] );
									$this->set_result( "apiStatus", "OK" );
								}
							}
						}else if( $response['status']== 302 || $response['status'] == 301 ){
							$this->set_result( "apiStatusCode", (int)$response['status'] );
							$this->set_result( "apiStatus", "Redirect:".$response['headers']['Location'] );
						}else{
							$this->set_result( "apiStatusCode", (int)$response['status'] );
							$this->set_result( "apiStatus", "OK" );
						}
					}else{
						$this->set_result( "apiStatusCode", 502 );
						$this->set_result( "apiStatus", $response['error'] );
						$this->log[] = "API Call failed: " . $response['error'];
					}
				}
			}
		}
	}


	function execute_aws( $params ){
		if( $params['service'] == "" || $params['action'] == "" ){
			$this->set_result( $params['output'], [
				"status"=>"error",
				"error"=>"Params missing"
			]);
			return false;
		}
		if( $params['service'] == "S3" && $params['action'] == "PutObject" ){
			$b = $params['inputs']['bucket'];
			if( $b == "" || $params['inputs']['bucket_id'] == "" ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Bucket name missing"
				]);
				return false;
			}
			if( $params['inputs']['key']['t'] == "static" ){
				$k = $params['inputs']['key']['v'];
			}else{
				$k = $this->get_value( $params['inputs']['key']['v'] );
			}
			if( $k == "" ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Key Missing"
				]);
				return false;
			}
			if( $params['inputs']['body'] == "" ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Body Missing"
				]);
				return false;
			}
			if( $params['inputs']['ct']['v'] == "" ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Content-Type missing"
				]);
				return false;
			}
			$b = $this->get_value( $params['inputs']['body'] );
			$ce = $params['inputs']['ce'];
			if( $params['inputs']['ct']['t'] == "static" ){
				$ct = $params['inputs']['ct']['v'];
			}else{
				$ct = $this->get_value( $params['inputs']['ct']['v'] );
			}
			$bucket = $this->con->find_one("aws_s3_buckets", ["user_id"=>$this->user_id, "_id"=> $params['inputs']['bucket_id'] ]);
			if( !$bucket ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"S3 Bucket configuration not found!"
				]);
				return false;
			}
			$aws_client = [
				'version' => 'latest',
				'region'  => $bucket['region'],
				'credentials' => [
					'key' => $this->user_data_decrypt($bucket['access_key'], $this->user_id),
					'secret' => $this->user_data_decrypt($bucket['access_secret'], $this->user_id)
				]
			];
			$s3_con = new S3Client( $aws_client );
			try{
				$p = [ "Bucket"=>$bucket['bucket'], 'Key'=>$k, 'Content_Type'=>$ct, 'Body'=>$b ];
				if( $ce ){ $p['Content_Encoding'] = $ce; }
				$res = $s3_con->putObject( $p );
				$this->set_result( $params['output'], [
					"status"=>"success",
					"error"=>""
				]);
			}catch(S3 $ex){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>$ex->getMessage()
				]);
				return false;
			}
		}
		if( $params['service'] == "S3" && $params['action'] == "SignURL" ){
			$b = $params['inputs']['bucket'];
			if( $b == "" || $params['inputs']['bucket_id'] == "" ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Bucket name missing"
				]);
				return false;
			}
			if( $params['inputs']['key']['t'] == "static" ){
				$k = $params['inputs']['key']['v'];
			}else{
				$k = $this->get_value( $params['inputs']['key']['v'] );
			}
			if( $k == "" ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Key Missing"
				]);
				return false;
			}
			if( $params['inputs']['ct']['v'] == "" ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Content-Type missing"
				]);
				return false;
			}
			$m = $params['inputs']['method'];
			if( !$m ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Method required"
				]);
				return false;
			}
			$val = $params['inputs']['validity'];
			if( !preg_match("/^(5|10|15|20)$/", $val) ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Validity duration required"
				]);
				return false;
			}
			$b = $this->get_value( $params['inputs']['body'] );
			$ce = $params['inputs']['ce'];
			if( $params['inputs']['ct']['t'] == "static" ){
				$ct = $params['inputs']['ct']['v'];
			}else{
				$ct = $this->get_value( $params['inputs']['ct']['v'] );
			}
			$bucket = $this->con->find_one("aws_s3_buckets", ["user_id"=>$this->user_id, "_id"=> $params['inputs']['bucket_id'] ]);
			if( !$bucket ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"S3 Bucket configuration not found!"
				]);
				return false;
			}
			$aws_client = [
				'version' => 'latest',
				'region'  => $bucket['region'],
				'credentials' => [
					'key' => $this->user_data_decrypt($bucket['access_key'], $this->user_id),
					'secret' => $this->user_data_decrypt($bucket['access_secret'], $this->user_id)
				]
			];
			$s3_con = new S3Client( $aws_client );
			if( $m == "GET" ){
				$cmd = $s3_con->getCommand( "GetObject", [
					'Bucket' => $bucket['bucket'],
					'Key' => $k
				]);
			}else{
				$p = [
					'Bucket' => $bucket['bucket'],
					'Key' => $k,
					'Content_Type'=>$ct,
				];
				if( $ce ){ $p['Content_Encoding'] = $ce; }
				$cmd = $s3_con->getCommand( "PutObject", $p);
			}
			try{
				$res = $s3_con->createPresignedRequest( $cmd, "+" .$val . " minutes" );
				$this->set_result( $params['output'], [
					"status"=>"success",
					"error"=>"",
					"url"=>(string)$res->getUri()
				]);
			}catch(S3 $ex){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>$ex->getMessage()
				]);
				return false;
			}
		}
		if( $params['service'] == "S3" && $params['action'] == "GetObject" ){
			$b = $params['inputs']['bucket'];
			if( $b == "" || $params['inputs']['bucket_id'] == "" ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Bucket name missing"
				]);
				return false;
			}
			if( $params['inputs']['key']['t'] == "static" ){
				$k = $params['inputs']['key']['v'];
			}else{
				$k = $this->get_value( $params['inputs']['key']['v'] );
			}
			if( $k == "" ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Key Missing"
				]);
				return false;
			}
			$bucket = $this->con->find_one( "aws_s3_buckets", [ "user_id"=>$this->user_id, "_id"=> $params['inputs']['bucket_id'] ] );
			if( !$bucket ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"S3 Bucket configuration not found!"
				]);
				return false;
			}
			$aws_client = [
				'version' => 'latest',
				'region'  => $bucket['region'],
				'credentials' => [
					'key' => $this->user_data_decrypt($bucket['access_key'], $this->user_id),
					'secret' => $this->user_data_decrypt($bucket['access_secret'], $this->user_id)
				]
			];
			$s3_con = new S3Client( $aws_client );
			try{
				$p = [ "Bucket"=>$bucket['bucket'], 'Key'=>$k ];
				$res = $s3_con->getObject( $p );
				$vbody = $res['Body']->getContents();
				$this->set_result( $params['output'], [
					"status"=>"success",
					"error"=>"",
					"body"=>["type"=>"file", "body"=>$vbody],
					"content_type"=>""
				]);
			}catch(S3 $ex){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>$ex->getMessage(),
				]);
				return false;
			}
		}
		if( $params['service'] == "SNS" && $params['action'] == "Publish" ){
			//print_pre( $params );exit;
			$topic_id = $params['inputs']['topic_id'];
			if( $topic_id == "" ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Topic ID Missing"
				]);
				return false;
			}
			$sub = $this->get_value( $params['inputs']['sub'] );
			if( $sub == "" ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Subject Missing"
				]);
				return false;
			}
			$msg = $this->get_value( $params['inputs']['msg'] );
			if( $msg == "" ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"Message Missing"
				]);
				return false;
			}
			$sns_rec = $this->con->find_one( "aws_sns_topics", [ "user_id"=>$this->user_id, "_id"=> $topic_id ] );
			if( !$sns_rec ){
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>"SNS Topic configuration not found!"
				]);
				return false;
			}
			$aws_client = [
				'version' => 'latest',
				'region'  => $sns_rec['region'],
				'credentials' => [
					'key' => $this->user_data_decrypt($sns_rec['access_key'], $this->user_id),
					'secret' => $this->user_data_decrypt($sns_rec['access_secret'], $this->user_id)
				]
			];
			//print_r( $aws_client );exit;
			$sns_con = new SnsClient( $aws_client );
			$sns_req = [
				/*'Message' => '<string>', // REQUIRED
				'MessageAttributes' => [
				'<String>' => [
				'BinaryValue' => <string || resource || Psr\Http\Message\StreamInterface>,
				'DataType' => '<string>', // REQUIRED
				'StringValue' => '<string>',
				],
				// ...
				],
				'MessageDeduplicationId' => '<string>',
				'MessageGroupId' => '<string>',
				'MessageStructure' => '<string>',
				'PhoneNumber' => '<string>',
				'Subject' => '<string>',
				'TargetArn' => '<string>',
				'TopicArn' => '<string>',*/
				'Message'=>$msg,
				'Subject'=>$sub,
				'TopicArn'=>$sns_rec['arn']
			];
			try{
				$res = $sns_con->publish( $sns_req );
				$this->set_result( $params['output'], [
					"status"=>"success",
					"error"=>"",
					"MessageId"=>$res['MessageId'],
					"statusCode"=>$res['@metadata']['statusCode']
				]);
			}catch(SNS $ex){
				//print_pre( get_class_methods( $ex) );
				//echo $ex->getAwsErrorCode() . "<BR>";
				//echo $ex->getAwsErrorType() . "<BR>";
				//echo $ex->getStatusCode() . "<BR>";
				//echo $ex->getAwsRequestId() . "<BR>";
				//exit;
				$this->set_result( $params['output'], [
					"status"=>"error",
					"error"=>$ex->getStatusCode().":".$ex->getAwsErrorType().":".$ex->getAwsErrorCode(),
					"aws-request-id"=>$ex->getAwsRequestId(),
					//"params"=>$sns_req
				]);
				return false;
			}
		}
	}
	function execute_email( $email ){
		if( $email['subject']['type'] == "static" ){
			$subject = $email['subject']['value'];
		}else{
			$subject = $this->get_value( $email['subject']['value'] );
		}
		if( $email['body']['type'] == "static" ){
			$body = $email['body']['value'];
		}else{
			$body = $this->get_value( $email['body']['value'] );
		}
		$to = [];
		foreach( $email['to'] as $i=>$j ){if($j['value']){
			if( $j['type'] == "static" ){
				$to[] = $j['value'];
			}else{
				if( $this->get_value( $j['value'] ) ){
				$to[] = $this->get_value( $j['value'] );
				}
			}
		}}
		$cc = [];
		foreach( $email['cc'] as $i=>$j ){if($j['value']){
			if( $j['type'] == "static" ){
				$cc[] = $j['value'];
			}else{
				if( $this->get_value( $j['value'] ) ){
				$cc[] = $this->get_value( $j['value'] );
				}
			}
		}}
		$bcc = [];
		foreach( $email['bcc'] as $i=>$j ){if($j['value']){
			if( $j['type'] == "static" ){
				$bcc[] = $j['value'];
			}else if( $j['value'] ){
				if( $this->get_value( $j['value'] ) ){
				$bcc[] = $this->get_value( $j['value'] );
				}
			}
		}}
		$sender_name = $email['sender']['name']?$email['sender']['name']:"Backend Sender";
		$sender_email = $email['sender']['email'];
		$this->log[] = "From: " . $sender_name . " <" . $sender_email . ">";
		$this->log[] = "To: ". implode(",",$to);
		$this->log[] = "Cc: ". implode(",",$cc);
		$this->log[] = "Bcc: ". implode(",",$bcc);
		$this->log[] = "Subject: ". $subject;
		$this->log[] = "Body: ". $body;
		if( !$sender_email ){
			$this->set_result( "email_result", [
				"status"=>"error",
				"error"=>"Sender Email"
			]);
		}else if( !sizeof($to) ){
			$this->set_result( "email_result", [
				"status"=>"error",
				"error"=>"To Address"
			]);
		}else if( !$subject ){
			$this->set_result( "email_result", [
				"status"=>"error",
				"error"=>"Subject"
			]);
		}else if( !$body ){
			$this->set_result( "email_result", [
				"status"=>"error",
				"error"=>"Body"
			]);
		}else{
			$sstatus = send_ses_email( $sender_name, $sender_email, $to, $cc, $bcc, $subject, $body );
			$this->set_result( "email_result", $sstatus );
		}	
	}
	function execute_sms( $sms ){
		if( $sms['mobile']['type'] == "static" ){
			$mobile = $sms['mobile']['value'];
		}else{
			$mobile = $this->get_value( $sms['mobile']['value'] );
		}
		
		//if( !preg_match( "/^[0-9]{10}/$",     $mobile ) ){
		if(preg_match( "/^[0-9]{10}+$/" , $mobile  ) == false ){
			return array("status"=>"error", "error"=>"Indian mobile number should be 10 digits" );
		}
		if( $sms['message']['type'] == "static" ){
			$message = $sms['message']['value'];
		}else{
			$message = $this->get_value( $sms['message']['value'] );
		}
		$this->log[] = "Mobile: " . $mobile;
		$this->log[] = "Message: " . $message;
		if( !$mobile ){
			$this->set_result( "sms_result", [
				"status"=>"error",
				"error"=>"Mobile empty"
			]);
		}else if( !$message ){
			$this->set_result( "sms_result", [
				"status"=>"error",
				"error"=>"Message empty"
			]);
		}else{ 
			$sstatus = send_pinpoint_sms( "india", $mobile, $message );
			$this->set_result( "sms_result", $sstatus );
		}
	}
	function execute_queuepush( $queue ){
		global $config_mongo_task_queue_host;
		global $config_mongo_task_queue_db;
		global $config_mongo_task_queue_port;
		global $config_mongo_task_queue_user;
		global $config_mongo_task_queue_pass;

		$new_conn = new mongodb_connection__( $config_mongo_task_queue_host );
		$new_conn->debug = false;
		$new_conn->connect( $config_mongo_task_queue_db );

		$inputs = [];
		foreach( $queue['task']['inputs'] as $i=>$j ){
			$inputs[ $j['key'] ] = $this->get_value( $j['value'] );
		}

		if( $queue['task']['delay'] ){
			$delay = $queue['task']['delay'];
		}else{
			$delay = 0;
		}

		$pick = time();
		if( $queue['delay'] ){
			$pick = time()+$queue['delay'];
		}
		$res = $new_conn->insert( "queue", [
			"queue_id"=>$queue['queue_id'],
			"status"=>1,
			"res"=>0,
			"pick"=>$pick,
			"c"=>"Pending",
			"c_i"=>date("Y-m-d H:i:s"),
			"task"=>$queue['task'],
			"app_id"=>$this->app_id,
			"user_id"=>$this->user_id,
			"inputs"=>$inputs,
			"outputs"=>[],
		]);
		$this->log[] = "QueuePush: " . $res;
		$this->set_result( $queue['output'], [
			"status"=>"success",
			"error"=>"",
			"queue_id"=>$res['insert_id']
		]);
	}
	function execute_pagesettings( $pagesettings ){
		foreach( $pagesettings as $ps=>$pv ){
			foreach( $pv['data'] as $dk=>$dv ){
				if( $dv['vtype'] == "variable" ){
					$pv['data'][$dk]['value'] = $this->result[ $pv['data'][$dk]['value'] ];
				}
			}
			$multi_elements = [
				"meta_tag"=>1,
				"link_css"=>1,
				"link_js"=>1,
				"custom"=>1,
			];
			if( $multi_elements[ $pv['prop'] ] ){
				$this->pagesettings[ $pv['prop'] ][] = $pv['data'];
			}else{
				$this->pagesettings[ $pv['prop'] ] = $pv['data'];
			}
		}
	}


	function build_json( $template, $data ){
		$vi = [];
		foreach( $template as $i=>$j ){
			if( $j['type'] == "dict" ){
				if( sizeof($j['sub']) ){
					$vi[ $i ] = [];
					$vi[ $i ] = $this->build_json( $j['sub'], $data );
				}else{
					$vi[ $i ] = $data[ $j['value'] ];
				}
			}else if( $j['type'] == "list" ){
				if( $i == "rows" ){
				//	print_pre( $j );exit;
				}
				if( $j['vtype'] == "static" ){
					$vi[ $i ] = [];
					foreach( $j['sub'] as $kk=>$km ){
						if( $km['type'] == "dict" ){
							$vi[ $i ][] = $this->build_json( $km['sub'], $data );
						}else if( $km['type'] == "text" ){
							$vi[ $i ][] = $km['value'];
						}else if( is_float($km['value']) ){
							$vi[ $i ][] = (float)$km['value'];
						}else if( is_numeric($km['value']) ){
							$vi[ $i ][] = (int)$km['value'];
						}else{
							$vi[ $i ][] = $km['value'];
						}
					}
				}else{
					$vi[ $i ] = $data[ $j['value'] ];
				}
			}else if( $j['type'] == "text" ){
				if( $j['vtype'] == "static" ){
					$vi[ $i ] = (string)$j['value'];
				}else{
					$vi[ $i ] = (string)$data[ $j['value'] ];
				}
			}else if( $j['type'] == "boolean" ){
				if( $j['vtype'] == "static" ){
					if( $j['value'] == "true" ){
						$vi[ $i ] = true;
					}else{
						$vi[ $i ] = false;
					}
				}else{
					$vi[ $i ] = (boolean)$data[ $j['value'] ];
				}
			}else if( $j['type'] == "number" ){
				if( $j['vtype'] == "static" ){
					if( is_float($j['value']) ){
						$vi[ $i ] = (float)$j['value'];
					}else if( is_numeric($j['value']) ){
						$vi[ $i ] = (int)$j['value'];
					}else{
						$vi[ $i ] = "";
					} 
				}else{
					if( is_float( $data[ $j['value'] ] ) ){
						$vi[ $i ] = (float)$data[ $j['value'] ];
					}else if( is_numeric( $data[ $j['value'] ] ) ){
						$vi[ $i ] = (int)$data[ $j['value'] ];
					}else{
						$vi[ $i ] = "";
					}
				}
			}else if( $j['type'] == "null" ){
				$vi[ $i ] = null;
			}
		}
		return $vi;
	}
	function build_post_json( $template, $data ){
		$vi = [];
		foreach( $template as $i=>$j ){
			if( $j['type'] == "dict" ){
				if( sizeof($j['sub']) ){
					$vi[ $i ] = [];
					$vi[ $i ] = $this->build_post_json( $j['sub'], $data );
				}else{
					$vi[ $i ] = $data[ $j['value'] ];
				}
			}else if( $j['type'] == "list" ){
				if( $j['vtype'] == "static" ){
					$vi[ $i ] = [];
					foreach( $j['sub'] as $kk=>$km ){
						if( $km['type'] == "text" ){
							$vi[ $i ][$kk] = $km['value'];
						}else if( is_float($km['value']) ){
							$vi[ $i ][$kk] = (float)$km['value'];
						}else if( is_numeric($km['value']) ){
							$vi[ $i ][$kk] = (int)$km['value'];
						}else{
							$vi[ $i ][$kk] = $km['value'];
						}
					}
				}else{
					$vi[ $i ] = $data[ $j['value'] ];
				}
			}else if( $j['type'] == "text" ){
				if( $j['vtype'] == "static" ){
					$vi[ $i ] = (string)$j['value'];
				}else{
					$vi[ $i ] = (string)$data[ $j['value'] ];
				}
			}else if( $j['type'] == "boolean" ){
				if( $j['vtype'] == "static" ){
					if( $j['value'] == "true" ){
						$vi[ $i ] = true;
					}else{
						$vi[ $i ] = false;
					}
				}else{
					$vi[ $i ] = (boolean)$data[ $j['value'] ];
				}
			}else if( $j['type'] == "number" ){
				if( $j['vtype'] == "static" ){
					if( is_float($j['value']) ){
						$vi[ $i ] = (float)$j['value'];
					}else if( is_numeric($j['value']) ){
						$vi[ $i ] = (int)$j['value'];
					}else{
						$vi[ $i ] = "";
					} 
				}else{
					if( is_float( $data[ $j['value'] ] ) ){
						$vi[ $i ] = (float)$data[ $j['value'] ];
					}else if( is_numeric( $data[ $j['value'] ] ) ){
						$vi[ $i ] = (int)$data[ $j['value'] ];
					}else{
						$vi[ $i ] = "";
					}
				}
			}else if( $j['type'] == "null" ){
				$vi[ $i ] = null;
			}
		}
		return $vi;      	
	}
	function build_xml( $template, $data, $tabs = "" ){
		$vstr = "";
		foreach( $template as $i=>$j ){
			if( $j['type'] == "dict" ){
				if( sizeof($j['sub']) ){
					$vstr .= $tabs. "<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">\n";
					$vstr .= $this->build_xml( $j['sub'], $data, $tabs."\t" );
					$vstr .= $tabs."</". $i . ">\n";
				}else{
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">" . $data[ $j['value'] ] . "</".$i . ">\n";
				}
			}else if( $j['type'] == "list" ){
				if( $j['vtype'] == "static" ){
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">\n";
					foreach( $j['sub'] as $kk=>$km ){
						if( $km['type'] == "dict" && gettype( $km['value'] ) ){
							$vstr .= $tabs.$this->build_xml( $j['sub'], $data, $tabs."\t" );                 
						}
					}
					$vstr .= $tabs."</". $i . ">\n";
				}else{
					$vstr .= $tabs . "<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">\n";
					$kk = explode("\n", $data[ $j['value'] ] );
					foreach( $kk as $kki=>$kkd ){if($kkd){
						$vstr .= $tabs . "\t". $kkd . "\n"; 
					}}
					$vstr .= $tabs . "</".$i . ">\n";
				}
			}else if( $j['type'] == "text" ){
				if( $j['vtype'] == "static" ){
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">" . $j['value'] . "</".$i . ">\n";
				}else{
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">" . $data[ $j['value'] ] . "</".$i . ">\n";
				}
			}else if( $j['type'] == "boolean" ){
				if( $j['vtype'] == "static" ){
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">" . $j['value'] . "</".$i . ">\n";
				}else{
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">" . $data[ $j['value'] ] . "</".$i . ">\n";
				}
			}else if( $j['type'] == "number" ){
				if( $j['vtype'] == "static" ){
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">" . $j['value'] . "</".$i . ">\n";				 
				}else{
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .=">" . $data[ $j['value'] ] . "</".$i . ">\n";
				}
			}else if( $j['type'] == "null" ){
				$vstr .= $tabs."<" . $i . ">null</".$i . ">\n";
			}
		}
		return $vstr;      	
	}
	function build_post_xml( $template, $data, $tabs = "" ){
		$vstr = "";
		foreach( $template as $i=>$j ){
			if( $j['type'] == "dict" ){
				if( sizeof($j['sub']) ){
					$vstr .= $tabs. "<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">\n";
					$vstr .= $this->build_post_xml( $j['sub'], $data, $tabs."\t" );
					$vstr .= $tabs."</". $i . ">\n";
				}else{
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">" . $data[ $j['value'] ] . "</".$i . ">\n";
				}
			}else if( $j['type'] == "list" ){
				if( $j['vtype'] == "static" ){
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">\n";
					foreach( $j['sub'] as $kk=>$km ){
						if( $km['type'] == "dict" && gettype( $km['value'] ) ){
							$vstr .= $tabs.$this->build_post_xml( $j['sub'], $data, $tabs."\t" );                 
						}
					}
					$vstr .= $tabs."</". $i . ">\n";
				}else{
					$vstr .= $tabs . "<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">\n";
					$kk = explode("\n", $data[ $j['value'] ] );
					foreach( $kk as $kki=>$kkd ){if($kkd){
						$vstr .= $tabs . "\t". $kkd . "\n"; 
					}}
					$vstr .= $tabs . "</".$i . ">\n";
				}
			}else if( $j['type'] == "text" ){
				if( $j['vtype'] == "static" ){
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">" . $j['value'] . "</".$i . ">\n";
				}else{
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">" . $data[ $j['value'] ] . "</".$i . ">\n";
				}
			}else if( $j['type'] == "boolean" ){
				if( $j['vtype'] == "static" ){
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">" . $j['value'] . "</".$i . ">\n";
				}else{
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">" . $data[ $j['value'] ] . "</".$i . ">\n";
				}
			}else if( $j['type'] == "number" ){
				if( $j['vtype'] == "static" ){
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .= ">" . $j['value'] . "</".$i . ">\n";				 
				}else{
					$vstr .= $tabs."<" . $i;
					if( $j['a'] ){
						$vstr .= " " . $j['a'];
					}
					$vstr .=">" . $data[ $j['value'] ] . "</".$i . ">\n";
				}
			}else if( $j['type'] == "null" ){
				$vstr .= $tabs."<" . $i . ">null</".$i . ">\n";
			}
		}
		return $vstr;      	
	}
	function execute_httprequest( $httprequest ){
		$url = $httprequest['url']['value'];
		if( $httprequest['url']['type'] == "variable" ){
			$url = $this->get_value( $httprequest['url']['value'] );
		}
		$ch = curl_init();
		$options = array(
			CURLOPT_HEADER => 1,
			CURLOPT_URL => $url,
			CURLOPT_CONNECTTIMEOUT_MS=> round($httprequest['options']['timeout']*1000), // 500 ms connection timeout
			CURLOPT_TIMEOUT => (int)($httprequest['options']['timeout']*1000),
			CURLOPT_RETURNTRANSFER =>true,
			CURLOPT_AUTOREFERER=>true,
		);
		$request_headers = [];
		$is_user_agent=false;
		foreach( $httprequest['headers'] as $i=>$j ){
			$request_headers[] = $j['name'].": ". $j['value'];
			if( strtolower($j['name']) == "user-agent" ){
				$is_user_agent=true;
			}
		}
		if( !$is_user_agent ){
			//$request_headers[] = "User-Agent: BackendLessApps";
		}
		$url_parts = parse_url($httprequest['url']['value']);
		if( $url_parts['scheme'] == "https" ){
			$options[CURLOPT_SSL_VERIFYPEER]= false;
			if( $httprequest['options']['two_way_ssl'] ){
				if( !$httprequest['options']['certificate'] ){
					return ["status"=>"fail", "error"=>"two way ssl data missing", "info"=>[], "postbody"=>"" ];
				}else{
					$cert = $this->con->find_one("bre_certificates", ["_id"=>$httprequest['options']['certificate'] ] );
					if( !$cert ){
						return ["status"=>"fail", "error"=>"two way ssl record missing", "info"=>[], "postbody"=>"" ];
					}
					$cert_file = "tempfiles/ssl_". $httprequest['options']['certificate'] . ".cer";
					$fp = fopen($cert_file, "w" );
					$key = data_decrypt($cert['public']);
					if( $cert['chain'] ){
						$key .= data_decrypt($cert['chain']);
					}
					fwrite($fp, $key);
					fclose($fp);
					chmod($cert_file, 0777);
					$cert_key_file = "tempfiles/ssl_". $httprequest['options']['certificate'] . ".key";
					$fp = fopen($cert_key_file, "w" );
					$key = data_decrypt($cert['private']);
					fwrite($fp, $key);
					fclose($fp);
					chmod($cert_key_file, 0777);
					$options[CURLOPT_SSLCERT] = $cert_file;
				        $options[CURLOPT_SSLKEY] = $cert_key_file;
				        //$options[CURLOPT_VERBOSE] = true;
				        //$options[CURLOPT_CERTINFO] = true;
				}
			}
		}
		if( $httprequest['method'] == "POST" ){
			$options[CURLOPT_POST] = 1;
			$options[CURLOPT_POSTFIELDS] = $postbody;
			if( $httprequest['content-type'] == "application/x-www-form-urlencoded" ){
				$request_headers[] = "Content-Type: application/x-www-form-urlencoded";
			}else if( $httprequest['content-type'] == "application/json" ){
				$request_headers[] = "Content-Type: application/json";
			}
		}else if( $httprequest['method'] == "GET" ){
			$options[CURLOPT_HTTPGET] =1;
		}else if( $httprequest['method'] == "PUT" ){
			return ["status"=>"fail", "error"=>"Method not implemented"];
			$options[CURLOPT_PUT] =1;
		}
		if( sizeof($request_headers) ){
			$options[CURLOPT_HTTPHEADER] = $request_headers;
		}
		if( sizeof($request_headers) ){
			$this->log[] = "Request Headers:";
			$this->log[] = $request_headers;
		}
		if( $httprequest['method'] == "POST" || $httprequest['method'] == "PUT" ){
			$this->log[] = "PostBody = ".substr( $postbody, 0, 500 );
		}
		//print_pre( $options );exit;
		//$this->log[] = $options;
		curl_setopt_array( $ch, $options );
		$result = curl_exec( $ch );

		//echo $result;exit;

		$info = curl_getinfo( $ch );
		$body_error= "";
		$headers = [];
		$body = "";
		$content_type = "";
		$cookies = [];
		if( !$result ){
			if( $info['ssl_verify_result'] > 0 ){
				$info['http_code'] = 500;
				$body_error = "SSL verification failed";
			}else{
				$body_error = "empty";
			}
		}else{
			$result = str_replace("HTTP/1.1 100 Continue\r\n\r\n","",$result);
			$headers["Content-Type"]=str_split(";",$info["content_type"])[0];
			$headers["Content-Length"]=$info["download_content_length"];
			if( $info["redirect_url"] ){
				$headers["Location"]=$info["redirect_url"];
			}
			list($h, $body) = explode("\r\n\r\n", $result, 2);
			$body_error = "";
			$headers = [];
			$h = explode("\r\n",$h);
			//print_pre( $h );
			foreach( $h as $i=>$j ){
				$k = explode(":",$j,2);
				if( sizeof($k) > 1 ){
					$k[0] = strtolower(trim( $k[0] ));
					if( $k[0] == "content-type" ){
						$content_type = trim(explode(";",$k[1])[0]);
					}
					if( $k[0] == "set-cookie" ){
						if( !$headers[ "set-cookie" ] ){
							$headers[ "set-cookie" ] = [];
						}
						$headers[ "set-cookie" ][] = trim($k[1]);
						$c = explode(";", trim($k[1]));
						$cf = "";
						$ccc = [];
						foreach( $c as $c_i=>$c_j ){
							$cc = explode("=",trim($c_j));
							if( sizeof($cc) >= 2 ){
								if( $cf == ""){
									$cf = trim($cc[0]);
								}
								if( trim($cc[0]) == "expires" ){
									$cc[1] = date("Y-m-d H:i:s", strtotime(trim($cc[1])) );
								}
								$ccc[ trim($cc[0]) ] = trim($cc[1]); 
							}
						}
						$cookies[ $cf ] = [
							"value"=>$ccc[$cf],
							"expires"=>$ccc['expires'],
							"path"=>$ccc['path'],
							"Max-Age"=>$ccc['Max-Age']
						];
					}else{
						$headers[trim($k[0])] = trim($k[1]);
					}
				}
			}
		}
		//exit;
		$this->set_result( $httprequest['output'], [
			"statusCode"=>$info['http_code'], 
			"status"=>$info['http_code'],
			"content-type"=>$content_type, 
			"headers"=>$headers, 
			"body"=>$body, 
			"cookies"=>$cookies,
			"body_error"=>$body_error, 
			"info"=>[
				"ssl_verify_result"=>$info['ssl_verify_result'],
				"ip"=>$info['primary_ip'],
				"size"=>$info['size_download'],
				"time"=>$info['total_time']
			],
		]);
	}
	function sqlite_request( $method, $url, $postbody, $headers, $voptions = [] ){
		/*$voptions = ["content-type"=>"application/json", // default x-form-urlencode
				"timeout"=>in seconds ,// default 5,
			     ];*/
		if( !$voptions['timeout'] ){$voptions['timeout'] = 30;}
		$postbody = json_encode($postbody);
		$ch = curl_init();
		$curlConfig = array(
		    	CURLOPT_HEADER => 1,
			CURLOPT_URL => $url,
			CURLOPT_CONNECTTIMEOUT_MS=> round($voptions['timeout']*1000), // 500 ms connection timeout
			CURLOPT_TIMEOUT => (int)$voptions['timeout'],
			CURLOPT_RETURNTRANSFER =>true,
			CURLOPT_AUTOREFERER=>true,
		);
		$request_headers = [];
		$is_user_agent=false;
		foreach( $api['headers'] as $i=>$j ){
			$request_headers[] = $j['name'].": ". $j['value'];
			if( strtolower($j['name']) == "user-agent" ){
				$is_user_agent=true;
			}
		}
		if( !$is_user_agent ){
			$request_headers[] = "User-Agent: BackendLessApps";
		}
		if( $method == "POST" ){
			$curlConfig[CURLOPT_POST] = 1;
			$curlConfig[CURLOPT_POSTFIELDS] = $postbody;
			if( $voptions['content-type'] == "application/x-www-form-urlencoded" ){
				$request_headers[] = "Content-Type: application/x-www-form-urlencoded";
			}else if( $voptions['content-type'] == "application/json" ){
				$request_headers[] = "Content-Type: application/json";
			}else{
				$request_headers[] = "Content-Type: application/json";
			}
		}else if( $method == "GET" ){
			$curlConfig[CURLOPT_HTTPGET] =1;
		}else if( $method == "PUT" ){
			return ["status"=>"fail", "error"=>"Method not implemented"];
			$curlConfig[CURLOPT_PUT] =1;
		}
		if( sizeof($request_headers) ){
			$curlConfig[CURLOPT_HTTPHEADER] = $request_headers;
		}
		if( sizeof($request_headers) ){
			$this->log[] = "Request Headers:";
			$this->log[] = $request_headers;
		}
		if( $method == "POST" || $method == "PUT" ){
			$this->log[] = "PostBody = ".substr($postbody,0,500);
		}
		try{
			curl_setopt_array( $ch, $curlConfig );
			$result = curl_exec( $ch );
			$info = curl_getinfo( $ch );
			curl_close($ch);
			if( !$result ){
				return ["status"=>"fail", "error"=>"response empty", "info"=>$info, "postbody"=>$postbody ];
			}else{
				$headers = [];
				$body = "";
				$content_type = "";
				$result = str_replace("HTTP/1.1 100 Continue\r\n\r\n","",$result);
				$headers["Content-Type"]=str_split(";",$info["content_type"])[0];
				$headers["Content-Length"]=$info["download_content_length"];
				if( $info["redirect_url"] ){
					$headers["Location"]=$info["redirect_url"];
				}
				list($h, $body) = explode("\r\n\r\n", $result, 2);
				$headers = [];
				$h = explode("\r\n",$h);
				foreach( $h as $i=>$j ){
					$k = explode(":",$j,2);
					if( sizeof($k) > 1 ){
						$k[0] = strtolower(trim( $k[0] ));
						if( $k[0] == "content-type" ){
							$content_type = trim(explode(";",$k[1])[0]);
						}
						$headers[trim($k[0])] = trim($k[1]);
					}
				}
				if( $info['http_code'] != 200 ){
					$status = "fail";
					$error = $info['http_code'];
				}else{	
					$body_data ="";
					$body_data = json_decode($body,true);
					if( !$body_data || json_last_error() ){
						print_pre($body);
						$status = "fail";
						$body_data = "";
						$error = "Json parse error: " . json_last_error_msg();
					}else{
						if( $body_data['status'] == "success" ){
							$status = "success";
							$error = "";
						}else{
							$status = "fail";
							$error = $body_data['error'];
						}
					}
				}
				$return_data =  [
							"status"=>$status,
							"error"=>$error,
							"content-type"=>$content_type,
							"headers"=>$headers,
							"body"=>$body_data,
							"info"=>["ip"=>$info['primary_ip']],
						];
				return $return_data;
			}
		}catch(Exception $ex){
			if( get_class($ex) == "InvalidArgumentException" ){
				$er = $ex->getMessage();
			}else{
				$er = $ex->getAwsErrorMessage();
			}
			return ["status"=>"fail","error"=>$er];
		}
	}
	function do_api_call( $api, $postbody ){
		$ch = curl_init();
		$options = array(
			CURLOPT_HEADER => 1,
			CURLOPT_URL => $api['url'],
			CURLOPT_CONNECTTIMEOUT_MS=> 2000, // 500 ms connection timeout
			CURLOPT_TIMEOUT => (int)$api['options']['timeout'],
			CURLOPT_RETURNTRANSFER =>true,
			CURLOPT_AUTOREFERER=>true,
		);
		$request_headers = [];
		$is_user_agent=false;
		foreach( $api['headers'] as $i=>$j ){
			$request_headers[] = $j['name'].": ". $j['value'];
			if( strtolower($j['name']) == "user-agent" ){
				$is_user_agent=true;
			}
		}
		if( !$is_user_agent ){
			$request_headers[] = "User-Agent: CarTradeExchange Finance Module";
		}
		$url_parts = parse_url($api['url']);
		if( $url_parts['scheme'] == "https" ){
			$options[CURLOPT_SSL_VERIFYPEER]= false;
			if( $api['options']['two_way_ssl'] ){
				if( !$api['options']['certificate'] ){
					return ["status"=>"fail", "error"=>"two way ssl data missing", "info"=>[], "postbody"=>"" ];
				}else{
					$cert = $this->con->find_one("bre_certificates", ["_id"=>$api['options']['certificate'] ] );
					if( !$cert ){
						return ["status"=>"fail", "error"=>"two way ssl record missing", "info"=>[], "postbody"=>"" ];
					}
					$cert_file = "tempfiles/ssl_". $api['options']['certificate'] . ".cer";
					$fp = fopen($cert_file, "w" );
					$key = data_decrypt($cert['public']);
					if( $cert['chain'] ){
						$key .= data_decrypt($cert['chain']);
					}
					fwrite($fp, $key);
					fclose($fp);
					chmod($cert_file, 0777);
					$cert_key_file = "tempfiles/ssl_". $api['options']['certificate'] . ".key";
					$fp = fopen($cert_key_file, "w" );
					$key = data_decrypt($cert['private']);
					fwrite($fp, $key);
					fclose($fp);
					chmod($cert_key_file, 0777);
					$options[CURLOPT_SSLCERT] = $cert_file;
				        $options[CURLOPT_SSLKEY] = $cert_key_file;
				        //$options[CURLOPT_VERBOSE] = true;
				        //$options[CURLOPT_CERTINFO] = true;
				}
			}
		}
		if( $api['method'] == "POST" ){
			$options[CURLOPT_POST] = 1;
			$options[CURLOPT_POSTFIELDS] = $postbody;
			if( $api['content-type'] == "application/x-www-form-urlencoded" ){
				$request_headers[] = "Content-Type: application/x-www-form-urlencoded";
			}else if( $api['content-type'] == "application/json" ){
				$request_headers[] = "Content-Type: application/json";
			}
		}else if( $api['method'] == "GET" ){
			$options[CURLOPT_HTTPGET] =1;
		}else if( $api['method'] == "PUT" ){
			return ["status"=>"fail", "error"=>"Method not implemented"];
			$options[CURLOPT_PUT] =1;
		}
		if( sizeof($request_headers) ){
			$options[CURLOPT_HTTPHEADER] = $request_headers;
		}
		if( sizeof($request_headers) ){
			$this->log[] = "Request Headers:";
			$this->log[] = $request_headers;
		}
		if( $api['method'] == "POST" || $api['method'] == "PUT" ){
			$this->log[] = "PostBody = ".substr($postbody,0,500);
		}
		//print_pre( $options );exit;
		//$this->log[] = $options;
		curl_setopt_array( $ch, $options );
		$result = curl_exec( $ch );
		$info = curl_getinfo( $ch );
		if( !$result ){
			return ["status"=>"fail", "error"=>curl_error($ch), "info"=>$info, "postbody"=>$postbody ];
		}

		$result = str_replace("HTTP/1.1 100 Continue\r\n\r\n","",$result);

		$headers = [];
		$headers["Content-Type"]=str_split(";",$info["content_type"])[0];
		$headers["Content-Length"]=$info["download_content_length"];
		if( $info["redirect_url"] ){
			$headers["Location"]=$info["redirect_url"];
		}
		list($h, $body) = explode("\r\n\r\n", $result, 2);
		$body_error = "";
		$headers = [];
		$h = explode("\r\n",$h);
		foreach( $h as $i=>$j ){
			$k = explode(":",$j,2);
			if( sizeof($k) > 1 ){
				if( strtolower(trim($k[0])) == "content-type" ){
					$content_type = trim(explode(";",$k[1])[0]);
				}
				if( trim($k[0]) == "Set-Cookie" ){
					if( !$headers[ "Set-Cookie" ] ){
						$headers[ "Set-Cookie" ] = [];
					}
					$headers[ "Set-Cookie" ][] = trim($k[1]);
				}else{
					$headers[trim($k[0])] = trim($k[1]);
				}
			}
		}
		if( $content_type == "application/json" || $content_type == "text/json" ){
			$body_parsed = json_decode( $body, true );
			if( $body_parsed ){
				$body = $body_parsed;
			}else{
				$body_error = "JSON Parse Error: " . json_last_error_msg();
				$body_error .= $body;
			}
		}
		if( $content_type == "application/xml" || $content_type == "application/xhtml+xml" || $content_type == "text/xml" ){
			$body_parsed = simplexml_load_string($body);
			preg_match("/^\<\?xml.*[\>\r\n\ \t]+/i", $body, $m);
			if( $m ){
				$body = substr($body, strlen($m[0]), strlen($body));
			}
			preg_match("/^\<([a-z0-9\:\-\_\.]+)/i", $body, $m);
			if( $m ){
				if( $m[1] ){
					$body_parsed = $this->parsexml($body_parsed);
					$body = [$m[1]=>$body_parsed];
				}
			}
		}
		return [
			"status"=>"success", 
			"response"=>[
				"status"=>$info['http_code'], 
				"content-type"=>$content_type, 
				"headers"=>$headers, 
				"body"=>$body, 
				"body_error"=>$body_error, 
				"info"=>$info,
				"postbody"=>$postbody
			]
		];
	}
	function parsexml($v){
		$v = (array)$v;
		foreach( (array)$v as $i=>$j ){
			//echo $i . ": " . gettype((array)$j) . "\n";
			//print_r( (array)$j );
			if( gettype($j) == "object" ){
				if( sizeof( (array)$j ) ){
					$v[ $i ] = $this->parsexml( (array)$j );
				}else{
					$v[ $i ] = "";
				}
			}
		}
		return $v;
	}	

	function user_data_encrypt( $str, $key ){
		$encrypted = @openssl_encrypt($str, "aes128", $key );
		return "uid_".base64_encode($encrypted);
	}
	function user_data_decrypt( $str, $key ){
		if( substr($str,0,4) == "uid_" ){
			$decrypted =  openssl_decrypt(base64_decode( substr($str,3,255) ),"aes128",$key );
			if( !$decrypted ){
				return false;
			}
			return $decrypted;
		}else{
			return false;
		}
	}

}


