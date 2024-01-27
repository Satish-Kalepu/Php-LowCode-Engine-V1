<?php

class cond_format{
	public $cond = [];
	public $ops = [];
	public $parts = [];
	function parse( $v ){
		//echo $v. "\n";

		$v = preg_replace_callback( "/^(.*?) in (.*?)$/", function($m){
			return trim($m[2]) . "[" . trim($m[1]) . "]";
		},$v);

		//echo $v . "\n";

		$v = preg_replace_callback( "/[\(\)\[\]]+/", function($m){
			$this->parts[] = $m[0];
			return "PPPPP";
		}, $v );
		//print_r( $this->parts );
		//echo $v. "\n";
		$new_cond = "";
		$parts = preg_split("/PPPPP/", $v);
		foreach( $parts as $i=>$j ){
			$j = trim($j);
			{
				$new = new cond_format();
				$j = $new->condp( $j );
				$new_cond .= $j .  $this->parts[ $i ] ;
			}
		}
		return $new_cond;
	}
	function condp( $v ){
		//echo "Condition Making: \n";
		//echo $v . "\n";
		$this->ops = [];
		$v = preg_replace_callback( "/[\&\|\=\!\>\<]+/", function($m){
			$this->ops[] = $m[0];
			return "XXXXX";
		}, $v);
		//print_r( $this->ops );
		//echo $v . "\n";
		$vars = preg_split("/XXXXX/", $v);
		//print_r( $vars );
		$new_cond = "";
		foreach( $vars as $i=>$j ){
			$j = trim($j);
			//if($j)
			{
				list($j,$j2) = explode(".", $j);
				if( is_numeric($j) ){
					$new_cond .= $j . ($j2?".".$j2:"") . $this->ops[ $i ];
				}else if( preg_match( "/^\'(.*?)\'$/", $j ) ){
					$new_cond .= $j . ($j2?".".$j2:"") . $this->ops[ $i ];
				}else{
					$jj = ($j?'$this->vars["'.trim($j).'"]':"") . ($j2?".".$j2:"");
					$new_cond .= $jj . $this->ops[ $i ];
				}
			}
		}
		//echo sizeof($vars) . ": " .sizeof($this->ops) . "\n";
		if( sizeof($vars) < sizeof($this->ops)-1 ){
			$new_cond .= $this->ops[ sizeof($vars) -1 ];
		}
		//echo "Final: " . $new_cond ."\n";
		return $new_cond;
	}
}

class html_render{
	public $template = "";
	public $dom = [];
	public $tags = [];
	public $debug = false;
	public $html = "";
	function __construct(){

	}
	function print_html_tree_($v){
		for($j=0;$j<sizeof($v);$j++){
			if( $v[$j]['t'] == 'tag' ){
				echo $v[$j]['t'] . ": " . $v[$j]['tag'] . " " . $v[$j]['a'] . " " . $v[$j]['s'] . "<BR>";
				//$this->print_html_tree_($v[$j]['sub']);
			}else{
				echo $v[$j]['t'] . ": " . $v[$j]['tag'] . " " . $v[$j]['a']  . " " . $v[$j]['s'] . "<BR>";
			}
		}
	}
	function repl($v){
		//print_r( $v );
		return $v[0];
	}
	function fill_vars( $v, $vars ){
		$this->vars = $vars;
		preg_match_all("/\<\?\=([a-z][a-z0-9\-\_\.]*)\ \?\>/i", $v, $m );
		//print_r( $m );
		foreach( $m[1] as $i=>$j ){
			$v = str_replace( $m[0][$i], ($this->vars[ $j ]?$this->vars[ $j ]:"false"), $v );
		}
		preg_match_all( "/\{b\-value\:(.*?)\}/", $j['s'], $m ) ;
		foreach( $m[0] as $i=>$j ){
			$cm = new cond_format(true);
			$vv = $cm->parse( $m[1][$i] );
			$v = str_replace( $j, $this->vars[ $vv ] );
		}
		return $v;
	}
	function parse( $v, $vars ){
		$this->vars = $vars;
		//echo "Vars: \n";
		///print_r( $this->vars );

		//echo $v . "\n\n";

		/*preg_match_all("/\<\?\=([a-z][a-z0-9\-\_\.]*)\ \?\>/i", $v, $m );
		//print_r( $m );
		foreach( $m[1] as $i=>$j ){
			//echo "==" . $j . "==";
			$v = str_replace( $m[0][$i], ($this->vars[ $j ]?$this->vars[ $j ]:"false"), $v );
		}
		echo $v . "\n\n";
		*/

		$v = trim(preg_replace("/[\r\n\t]+/", "", $v));

		//preg_match_all("/v\-if\=\"(.*?)\"/i", $v, $m);
		//print_r($m);
		$v = preg_replace_callback("/b\-if\=\"(.*?)\"/i", function($m){
			$k = rand(1,10000);
			$this->tags[ $k ] = $m[1];
			return "Cond-".$k;
		}, $v);
		$v = preg_replace_callback("/b\-for\=\"(.*?)\"/i", function($m){
			$k = rand(1,10000);
			$this->tags[ $k ] = $m[1];
			return "Loop-".$k;
		}, $v);

		//echo $vv. "\n\n";
		//print_r( $this->tags );

		$parts = preg_split( "/\<\//", $v );
		//print_r( $parts );
		if( $this->debug ){
			echo "<div style=\"float:left;\" ><pre>";
		}
		$list = [];
		foreach( $parts as $i=>$j ){
			if($i>0){
				$j = "</".$j;
			}
			$p2 = preg_split("/\>/", $j );
			foreach( $p2 as $ii=>$jj ){
				if($ii<sizeof($p2)-1){
					$jj = $jj . ">";
				}
				$list[] = $jj;
			}
		}
		$list2 = [];
		foreach( $list as $i=>$j ){
			$p2 = preg_split("/\</", $j );
			if( sizeof($p2) > 1 ){
				foreach( $p2 as $ii=>$jj ){if($jj){
					if( $ii> 0 ){
						$jj = "<" .$jj;
					}
					$list2[] = $jj;
				}}
			}else{if($j){
				$list2[] = $j;
			}}
		}
		$list = [];
		foreach( $list2 as $i=>$j ){
			preg_match("/^\<\/([a-zA-Z0-9]+)\>$/i", $j, $m);
			if( $m[1] ){
				$list2[$i] = [
					"t"=>"e",
					"tag"=>$m[1],
				];
			}else{
				preg_match("/^\<([a-zA-Z0-9]+)(.*?)\>$/i", $j, $m);
				if( $m[1] ){
					$list2[$i] = [
						"t"=>"s",
						"tag"=>$m[1],
						"a"=>$m[2],
					];
				}else{
					$list2[$i] = [
						"t"=>"tag",
						"tag"=>"text",
						"s"=>$j,
					];
				}
			}
		}

		$list = [];
		$cnt = 0;
		for($_k=0;$k<2;$k++){
		while(true){
			if( $this->debug ){echo "<div style=\"float:left;\" ><pre>";}
			$cnt++;if( $cnt > 50 ){ echo "Reached Limit!"; break; }
			$fd = false;
			for($i=0;$i<sizeof($list2);$i++){
				//print_r( $list2 );
				$j = $list2[$i];
				if( $j['t'] == "s" && $list2[ $i+1 ]['t'] == "e" && $j['tag'] != $list2[ $i+ 1 ]['tag'] ){
					$list2[$i]['t'] = "tag";
					if( $list2[$i]['s'] ){
						$list2[$i]['a'] = $list2[$i]['s'];
					}
					unset($list2[$i]['s']);
					$fd= true;
				}
				if( $j['t'] == "s" ){
					//echo "All check for " . $j['t'] . ": " . $j['tag'] . "\n";
					$ok = true;
					$alltags = true;
					for($ii=$i+1;$ii<sizeof($list2);$ii++){
						$jj = $list2[$ii];
						//echo "--" . $jj['t'] . ": " . $jj['tag'] . "\n";
						if( $jj['t'] != "e" && $jj['t'] != "tag" ){
							$alltags = false;
							break;
						}else if( $jj['t'] == "e" && $jj['tag'] != $j['tag'] ){
							$alltags = false;
							break;
						}else if( $jj['t'] == "e" ){
							break;
						}
					}
					if( $alltags ){
						//echo "All tags: " . $j['tag'] . "\n";
						$list2[$i]['t'] = "tag";
						for($ii=$i+1;$ii<sizeof($list2);$ii++){
							$jj = $list2[$ii];
							if( $jj['t'] == "tag" ){
								$list2[$i]['sub'][] = $list2[$ii];
								$fd= true;
							}else if( $jj['t'] == "e" ){
								break;
							}
						}
						for($ii=$i+1;$ii<sizeof($list2);$ii++){
							$jj = $list2[$ii];
							if( $jj['t'] == "tag" ){
								array_splice($list2,$ii,1);
								$ii--;
							}else if( $jj['t'] == "e" ){
								array_splice($list2,$ii,1);
								//$ii--;
								break;
							}
						}
						$j = $list2[$i];
					}
				}
				if( $j['t'] == "s" ){
					$issingle = true;
					//echo "<div>" . $j['t'] . ": " . $j['tag'] . "</div>";
					for($ii=$i+1;$ii<sizeof($list2);$ii++){
						$jj = $list2[$ii];
						//echo "<div> --" . $jj['t'] . ": " . $jj['tag'] . "</div>";
						if( $jj['t'] == "s" ){
							$issingle = false;
							break;
						}else if( $jj['t'] == "e" && $jj['tag'] == $j['tag'] ){
							$issingle = false;
							break;
						}
					}
					if( $issingle ){
						$list2[$i]['t'] = "tag";
						$fd = true;
					}
				}
				if( $j['t'] == "s" && $list2[ $i+1 ]['t'] == "e" && $j['tag'] == $list2[ $i+ 1 ]['tag'] ){
					$list2[$i]['t'] = "tag";
					//$list2[$i]['a'] = $list2[$i]['s'];
					$list2[$i]['s'] = "";
					array_splice($list2,$i+1,1);
					$fd= true;
				}
				if( $j['t'] == "s" && ( $list2[ $i+1 ]['t'] == "t" || $list2[ $i+1 ]['t'] == "tag" ) && $list2[ $i+2 ]['t'] == "e" && $j['tag'] == $list2[ $i+ 2 ]['tag'] ){
					$list2[$i]['t'] = "tag";
					//$list2[$i]['a'] = $list2[$i]['s'];
					$list2[$i]['sub'] = [];
					$list2[$i]['sub'][] = $list2[$i+1];
					array_splice($list2,$i+1,1);
					array_splice($list2,$i+1,1);
					$fd= true;
				}
			}
			if( $fd == false ){
			foreach( $list2 as $i=>$j ){
				if( $j['t'] == "s" && $list2[ $i+1 ]['t'] == "e" && $j['tag'] == $list2[ $i+ 1 ]['tag'] ){
					$list2[$i]['t'] = "tag";
					$list2[$i]['a'] = $list2[$i]['s'];
					$list2[$i]['s'] = "";
					array_splice($list2,$i+1,1);
					$fd= true;
				}
				if( $j['t'] == "s" && ( $list2[ $i+1 ]['t'] == "t" || $list2[ $i+1 ]['t'] == "tag" ) && $list2[ $i+2 ]['t'] == "e" && $j['tag'] == $list2[ $i+ 2 ]['tag'] ){
					$list2[$i]['t'] = "tag";
					$list2[$i]['a'] = $list2[$i]['s'];
					$list2[$i]['sub'] = [];
					$list2[$i]['sub'][] = $list2[$i+1];
					array_splice($list2,$i+1,1);
					array_splice($list2,$i+1,1);
					$fd= true;
				}
			}
			}
			if( $fd == false ){
				if( $this->debug ){
					echo "end loop at: ". $cnt . "<BR>";
				}
				break;
			}
			//print_r( $list2 );
			if( $this->debug ){
			print_r( $list2 );
			echo "</pre></div>";
			}
		}
		}
		if( $this->debug ){
			echo "<div style=\"float:left;\" ><pre>";
			print_r( $list2 );
			echo "</pre></div>";
		}
		//print_r( $this->tags );
		$list2 = $this->check_types( $list2 );
		//print_r( $list2 );
		//exit;
		$this->dom = $list2;
		//print_r( $this->vars );
		//echo "vars";
		$this->build( $this->dom );
		return $this->html;
	}
	function check_types( $list2 ){
		foreach($list2 as $i=>$j){
			//print_r($j);
			if( $j['a'] ){
			//echo $j['a'] . "\n";
			preg_match("/Cond\-([0-9]+)/", $j['a'], $m );
			if( $m[1] ){
				//echo "Cond " . $m[1];
				$cond = $this->tags[ $m[1] ];
				$cm = new cond_format( $cond );
				$cond = $cm->parse($cond);
				//echo "\n<div>Matched Cond: " . $cond . ": " . $j['a'] . "</div>\n";
				$list2[ $i ]['a'] = preg_replace("/Cond\-([0-9]+)/", "", $list2[ $i ]['a']);
				$list2[ $i ]['cond'] = $cond;
			}
			preg_match("/Loop\-([0-9]+)/", $j['a'], $m );
			if( $m[1] ){
				//echo "Loop " . $m[1];
				$cond = $this->tags[ $m[1] ];
				preg_match("/^(.*?)\,(.*?)in(.*?)$/", $cond, $mm);
				/*$cm = new cond_format(true);
				$mm[1] = $cm->parse( $mm[1] );
				$cm = new cond_format(true);
				$mm[2] = $cm->parse( $mm[2] );
				*/
				if( $mm ){
					$cm = new cond_format(true);
					//echo $mm[3];
					$mm[3] = $cm->parse( $mm[3] );
					$cond = $mm[1] . "," . $mm[2] . " in " . $mm[3];
					//echo "Loop " . $cond. "\n";exit;
					$list2[ $i ]['a'] = preg_replace("/ Loop\-([0-9]+)/", "", $list2[ $i ]['a']);
					$list2[ $i ]['loop'] = [
						"value"=>$mm[1],
						"key"=>$mm[2],
						"array"=>$mm[3]
					];
				}else{
					//echo $cond ;
					preg_match("/^(.*?)in(.*?)$/", $cond, $mm);
					if( $mm ){
						$cm = new cond_format(true);
						$mm[2] = $cm->parse( $mm[2] );
						$cond = $mm[1]. " in " . $mm[2];
						//echo "Loop " . $cond. "\n";exit;
						$list2[ $i ]['a'] = preg_replace("/ Loop\-([0-9]+)/", "", $list2[ $i ]['a']);
						$list2[ $i ]['loop'] = [
							"value"=>$mm[1],
							"key"=>"",
							"array"=>$mm[2]
						];
					}
				}
			}
			}
			if( $j['s'] ){
				//echo $j['s'] . "\n";
				//preg_match_all( "/\{b\-value\:(.*?)\}/", $j['s'], $m);
				preg_match_all( "/\{\{(.*?)\}\}/", $j['s'], $m);
				//print_r( $m );
				if( $m[0] ){
					$list2[$i]['vars'] = [];
					foreach( $m[0] as $ii=>$jj ){
						$cm = new cond_format(true);
						$vv = $cm->parse( $m[1][$ii] );
						$list2[$i]['vars'][] = [
							"t"=>$jj,
							"v"=>$vv,
						];
					}
				}
			}
			if( $j['sub'] ){
				$list2[$i]['sub'] = $this->check_types( $j['sub'] );
			}
		}
		return $list2;
	}
	function build( $list, $sp = "\t" ){
		foreach( $list as $i=>$j ){
			//print_r( $j );
			if( $j['tag'] == "text" ){
				$v = $j['s'];
				//print_r( $j['vars'] );
				foreach( $j['vars'] as $vi=>$vj ){
					$vj['v'] = trim( $vj['v'] );
					//$vv = preg_split("/\[/",$vj['v'],2);
					//$vvv= '$vv=$this->vars["'.$vv[0].'"]'.($vv[1]?"[".$vv[1]:""). ";";
					//echo "\n--------\n";
					//echo $vj['t']. "\n";
					//echo $vj['v']. "\n";
					$vvv= '$vv='.$vj['v']. ";";
					if( $vi == "state_id" ){
						//echo $vi . ": \n";
						//echo $vvv . "\n";
					}
					eval($vvv);
					//print_r( $this->vars );
					//echo "==" . $vv . "\n";
					if( $vv == null ){
						$v = str_replace( $vj['t'], "", $v );
					}else if( gettype($vv) == "array" || gettype($vv) == "object"  ){
						$v = str_replace( $vj['t'], "<pre>".json_encode($vv,JSON_PRETTY_PRINT)."</pre>", $v );
					}else if( gettype($vv) == "string" ){
						$v = str_replace( $vj['t'], $vv, $v );
					}else if( gettype($vv) == "boolean" ){
						$v = str_replace( $vj['t'], ($vv?"True":"False"), $v );
					}else if( gettype($vv) == "integer" || gettype($vv) == "double" || gettype($vv) == "float" ){
						$v = str_replace( $vj['t'], $vv, $v );
					}else if( gettype($vv) == "NULL" ){
						$v = str_replace( $vj['t'], "", $v );
					}else{
						$v = str_replace( $vj['t'], "ValueUnknownDataType:".gettype($vv), $v );
					}
				}
				if( $v ){
					$this->html .= $sp . $v . "\n";
				}
			}else{
				if( $j['loop'] ){
					//print_r( $j['loop'] );
					$cmd = '$loop_array = '.$j['loop']['array'].";\n";
					//echo $cmd . "\n";
					try{
						eval($cmd);
					}catch(Exception $ex){
						echo "There was an error: " . $cmd . "\n" . $ex->getMessage();exit;
					}
					//print_r( $loop_array );
					$key = (trim($j['loop']['key'])?trim($j['loop']['key']):"_loop_key");
					$val = trim($j['loop']['value']);
					//foreach( $loop_array as $this->vars[ $key ]=>$this->vars[ trim($j['loop']['value']) ] ){
					foreach( $loop_array as $_key=>$_val ){
						//echo $key . ": " . $val . "\n";
						$this->vars[ $key ] = $_key;
						$this->vars[ $val ] = $_val;
						//print_r( $this->vars );
						//$this->vars[ $key ] = $val;
						//echo "\nloop\n";
						//echo $this->vars[ $j['loop']['key'] ] . "\n";
						//print_r( $this->vars[ $j['loop']['value'] ] );
						//print_r( $this->vars[ $j['loop']['key'] ] );
						if( $j['tag'] == "template"){
							$this->build( $j['sub'], $sp . "\t" );
						}else{
							$ee = "\n";
							if( sizeof($j['sub']) == 1 && $j['sub'][0]['tag'] == 'text' ){$ee = "";}
							$tag = $sp ."<" . $j['tag'] . (trim($j['a'])?" ".trim($j['a']):"") . (sizeof($j['sub'])?">\n".$ee:"/>\n")  . "";
							$this->html .= $tag;
							if( sizeof($j['sub']) ){
								$this->build( $j['sub'], $sp . "\t" );
								$this->html .= $sp . "</" . $j['tag'] . ">\n";
							}
						}
					}
				}else if( $j['cond'] ){
					//print_r( $j['loop'] );
					$cmd = '$cond_result = '.$j['cond'].";\n";
					//echo $cmd . "\n";
					try{
						eval($cmd);
					}catch(Exception $ex){
						echo "There was an error: " . $cmd . "\n" . $ex->getMessage();exit;
					}
					if( $cond_result ){
						if( $j['tag'] == "template" ){
							$this->build( $j['sub'], $sp . "\t" );
						}else{
							$ee = "\n";
							if( sizeof($j['sub']) == 1 && $j['sub'][0]['tag'] == 'text' ){$ee = "";}
							$tag = $sp ."<" . $j['tag'] . (trim($j['a'])?" ".trim($j['a']):"") . (sizeof($j['sub'])?">\n".$ee:"/>\n")  . "";
							$this->html .= $tag;
							if( sizeof($j['sub']) ){
								$this->build( $j['sub'], $sp . "\t" );
								$this->html .= $sp . "</" . $j['tag'] . ">\n";
							}
						}
					}
				}else{
					if( $j['tag'] == "template" ){
						$this->html .= $j['s'];
						$this->build( $j['sub'], $sp . "\t" );
					}else{
						$tag = $sp . "<" . $j['tag'] . (trim($j['a'])?" ".trim($j['a']):"") . (sizeof($j['sub'])?">\n":"/>\n");
						$this->html .= $tag;
						$this->html .= $j['s'];
						if( sizeof($j['sub']) ){
							$this->build( $j['sub'], $sp . "\t" );
							$this->html .= $sp . "</" . $j['tag'] . ">\n";
						}
					}
				}
			}
		}
	}
}

?>