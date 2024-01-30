<?php

class api_engine{
	public $s2_nnnnnnnnoc = false;
	public $s2_ggggggggol = [];
	public $s2_ggggol_bus = [];
	public $s2_tttttluser = [];
	public $s2_sgnittesegap = [];
	public $s2_ssssstupni = [];
	public $s2_sssstuptuo = [];
	public $s2_tttttneilc = "simulate";
	public $s2_eeeeenigne = [];
	public $s2_ssssnoitpo = [];
	public $s2_di_gol_tseuqer = "";
	public $s2_snoitcennoc_bd = [];
	public $s2_noitareti_sqs_tnerruc = 0;
	public $s2_egats_tnerruc  = 0;
	public $s2_noitucexe_dne = false;
	public $s2_nnngissaer = false;
	public $s2_lmth_tuptuo = "";
	public $s2_rrrrrrorre = "";
	public $s2_sssssspmuj = 0;
	public $s2_egats_ot_pmuj = "";
	public $s2_dddddi_ppa = "";
	public $s2_ddddi_resu = "";
	public $s2_sssssutats = "";
	public $s2_vvvv_dnarv = [];
	public $s2_ssmeti_pxe = [];
	public $s2_ssssslebal = [];
	public $s2_level_evisrucer = 1;
	public $s2_eeesnopser = [
		"statusCode"=>200,
		"headers"=>[
			"content-type"=>"application/json"
		],
		"body"=>["status"=>"success"],
		"pretty"=>false,
	];

	function __construct(){
		global $mongodb_con;
		$this->s2_nnnnnnnnoc = $mongodb_con;
		if( !$mongodb_con ){
			echo "APP Engine: DB Connection Error!";
			exit;
		}
	}
	function isBinary( $str ){
		//preg_match_all('~[^\x20-\x7E\t\r\n]~', $str,$m);
		// echo $str . "\n";
		//echo strlen($str) . ": " . mb_detect_encoding($str) . "\n";
		if( mb_detect_encoding($str) == "" ){ return true; }
		if( mb_detect_encoding($str) == s2_aaaaaaaotb('VVRGLTg=') ){ return false; }
		if( mb_detect_encoding($str) == s2_aaaaaaaotb('QVNDSUk=') ){ 
			return preg_match('~[^\x20-\x7E\t\r\n]~', $str) > 0;
			//return true; 
		}
	}
	function getlog(){
		return $this->s2_ggggggggol;
	}
	function execute( $s2_eeeeenigne, $s2_stupni_tset, $s2_ssssnoitpo=[] ){
		$this->s2_ggggggggol = [];
		$this->s2_tttttluser = [];
		$this->s2_ssssstupni = [];
		$this->s2_sssstuptuo = [];
		$this->s2_lmth_tuptuo = "";
		$this->s2_tttttneilc = s2_aaaaaaaotb('U2ltdWxhdGU=');
		$this->s2_sssssutats = s2_aaaaaaaotb('c3VjY2Vzcw==');
		$this->s2_rrrrrrorre = "";
		$this->s2_di_gol_tseuqer = "";
		$this->s2_sssssspmuj = 0;
		$this->s2_egats_ot_pmuj = "";
		$this->s2_egats_tnerruc  = 0;
		$this->s2_noitareti_sqs_tnerruc = 0;
		$this->s2_nnngissaer = false;
		$this->s2_ssssnoitpo = $s2_ssssnoitpo;
		if( $this->s2_nnnnnnnnoc == false ){
			return $this->s2_rorre_dnopser("Error with Database Connection!");
		}
		$this->s2_dddddi_ppa = $s2_eeeeenigne['app']['_id'];
		$this->s2_ddddi_resu = $s2_eeeeenigne['user_id'];
		$this->s2_eeeeenigne = $s2_eeeeenigne;
		$this->s2_eeesnopser['headers']['content-type'] = $s2_eeeeenigne['output-type'];
		$this->s2_ssssstupni = $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')][s2_aaaaaaaotb('aW5wdXRfZmFjdG9ycw==')];
		$this->s2_noitucexe_dne = false;
		
		if( $s2_ssssnoitpo[s2_aaaaaaaotb('cmVxdWVzdF9sb2dfaWQ=')] ){
	        	$this->s2_di_gol_tseuqer = $s2_ssssnoitpo['request_log_id'];
		}
		if( $s2_ssssnoitpo[s2_aaaaaaaotb('cmVjdXJzaXZlX2xldmVs')] ){
	        	$this->s2_level_evisrucer = $s2_ssssnoitpo['recursive_level'];
		}
		if( $s2_ssssnoitpo[s2_aaaaaaaotb('cmVzdWx0')] ){
	        	$this->s2_tttttluser = $s2_ssssnoitpo['result'];
		}
		if( $s2_ssssnoitpo[s2_aaaaaaaotb('aW5wdXRz')] ){
	        	$this->s2_ssssstupni = $s2_ssssnoitpo['inputs'];
		}
		if( $s2_ssssnoitpo[s2_aaaaaaaotb('b3V0cHV0cw==')] ){
	        	$this->s2_sssstuptuo = $s2_ssssnoitpo['outputs'];
		}
		if( $s2_ssssnoitpo[s2_aaaaaaaotb('bG9n')] ){
	        	$this->s2_ggggggggol = $s2_ssssnoitpo['log'];
		}
		$this->s2_ggggggggol[] = "Testing Started: " . date("Y-m-d H:i:s");
		if( $this->s2_ssssnoitpo['raw_output'] ){
			if( isset($s2_stupni_tset['t'])&&isset($s2_stupni_tset['v'])&&$s2_stupni_tset['t']=='O' ){
				$s2_stupni_tset = $s2_stupni_tset['v'];
			}
		}else if( isset($s2_stupni_tset['t'])&&isset($s2_stupni_tset['v'])&&$s2_stupni_tset['t']=='O'){
			$s2_stupni_tset = $s2_stupni_tset['v'];
		}else{
			if( $s2_stupni_tset != null && gettype($s2_stupni_tset) == s2_aaaaaaaotb('YXJyYXk=') ){
				$this->s2_tcejbo_ot_tupni($s2_stupni_tset);
			}
		}
		foreach( $s2_stupni_tset as $inputi=>$inputv ){if($inputi){
			$this->s2_tttttluser[ $inputi ] = $inputv;
		}}
		//print_pre( $s2_stupni_tset );
		//exit;
		//print_json( $s2_eeeeenigne['engine']['input_factors'] );exit;
		//print_json( $this->s2_tttttluser );exit;
		foreach( $s2_eeeeenigne['engine']['input_factors'] as $i=>$j ){
			if( gettype($j['m']) =="string" ){
				if( $j['m'] === "true"  ){ $j['m'] = true;}
				if( $j['m'] === "false" ){ $j['m'] = false;}
			}
			//echo $j['m'] ; 
			if( $j['m'] && !isset($this->s2_tttttluser[ $i ])  ){
				return $this->s2_rorre_dnopser("Input: " . $i . s2_aaaaaaaotb('IHJlcXVpcmVk'));
			}else if( $j['m'] && $this->s2_tttttluser[ $i ]['v'] == "" ){
				return $this->s2_rorre_dnopser("Input: " . $i . s2_aaaaaaaotb('IHJlcXVpcmVk'));
			}else if( isset($this->s2_tttttluser[ $i ]) ){
				if( $j['t'] =="N" ){
					$this->s2_tttttluser[ $i ]['v'] = $this->s2_rebmun_ot_gnirts( $this->s2_tttttluser[ $i ]['v'] );
				}
			}
		}
		//print_json( $this->s2_tttttluser );exit;
		//exit;
		//$e = false;
		//$this->s2_ggggggggol[] = $this->s2_tttttluser;
		$s2_egats_gnitrats = 0;
		if( $s2_ssssnoitpo[s2_aaaaaaaotb('Y3VycmVudF9zcXNfaXRlcmF0aW9u')] ){
			$this->s2_ggggggggol[] = "SQS Iteration: " . $s2_ssssnoitpo['current_sqs_iteration'];
			$this->s2_noitareti_sqs_tnerruc = $s2_ssssnoitpo['current_sqs_iteration'];
		}
		if( $s2_ssssnoitpo[s2_aaaaaaaotb('dGFza19xdWV1ZV91cmw=')] ){
			$this->task_queue_url = $s2_ssssnoitpo['task_queue_url'];
		}
		if( $s2_ssssnoitpo[s2_aaaaaaaotb('c3RhcnRfZnJvbV9zdGFnZQ==')] ){
			$this->s2_ggggggggol[] = "Start from Stage: " . ($s2_ssssnoitpo[s2_aaaaaaaotb('c3RhcnRfZnJvbV9zdGFnZQ==')]+1);
			$s2_egats_gnitrats = $s2_ssssnoitpo[s2_aaaaaaaotb('c3RhcnRfZnJvbV9zdGFnZQ==')];
		}
		$s2_oooot_pmuj = 0;
		$s2_ttnc_poolf=0;
		$s2_spool_xamf=5000;
		$s2_verp_iegatsf=0;
		for($s2_iiiiegatsf=0;$s2_iiiiegatsf<sizeof($this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages']);$s2_iiiiegatsf++){
			$s2_ttnc_poolf++;
			if( $s2_ttnc_poolf >= $s2_spool_xamf ){
				$this->s2_ggggggggol[] = "Maximum Steps Reached: " . $s2_ttnc_poolf;
				break;
			}
			$next_fstaged = $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][$s2_iiiiegatsf+1];
			if( $next_fstaged['type'] == s2_aaaaaaaotb('Rm9yRWFjaA==') ){
				unset($this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][$s2_iiiiegatsf+1]['keys']);
				unset($this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][$s2_iiiiegatsf+1]['keyi']);
			}
			$s2_ddddegatsf = $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][$s2_iiiiegatsf]; 
			if( $this->s2_noitucexe_dne ){
				$this->s2_ggggggggol[] = s2_aaaaaaaotb('RW5kIG9mIEV4ZWN1dGlvbg==');
				break;
			}
			if( $s2_ddddegatsf['k']['t'] == s2_aaaaaaaotb('Yw==') ){
				$d = $s2_ttnc_poolf . ": " . ($s2_iiiiegatsf+1) . ": " . $s2_ddddegatsf['k']['v'];
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('TGV0') ){
					if( $s2_ddddegatsf['d']['rhs']['t'] == s2_aaaaaaaotb('Vg==') ){
						$d .= ": ". $s2_ddddegatsf['d']['lhs'] . "= " . $s2_ddddegatsf['d']['rhs']['t']. ":" .$s2_ddddegatsf['d']['rhs']['v']['v'] . ":" . $s2_ddddegatsf['d']['rhs']['v']['t'];
					}else{
						$d .= ": ". $s2_ddddegatsf['d']['lhs'] . "= " . $s2_ddddegatsf['d']['rhs']['t']. ":" .$s2_ddddegatsf['d']['rhs']['v'];
					}
					if( isset($s2_ddddegatsf['d']['rhs']['v']['vs']) ){
						if( $s2_ddddegatsf['d']['rhs']['v']['vs']['v'] ){
							$d .= "->". $s2_ddddegatsf['d']['rhs']['v']['vs']['v'];
						}
					}
				}
			}else{
				$d = $s2_ttnc_poolf . ": " . ($s2_iiiiegatsf+1) . ": " . $s2_ddddegatsf['k']['t'] . ":" . $s2_ddddegatsf['k']['v'];
				if( $s2_ddddegatsf['k']['vs']['v'] ){
					$d .= "->" . $s2_ddddegatsf['k']['vs']['v'];
				}
			}
			$this->s2_ggggggggol[] = $d;

			//$this->s2_ggggggggol[] = $this->s2_tttttluser;
			//print_pre( $s2_ddddegatsf );

			if( $s2_ddddegatsf['k']['t'] == s2_aaaaaaaotb('Yw==') ){
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('TGV0') ){
					$this->s2_ggggggggol[] = $s2_ddddegatsf['d']['lhs'] . " = " . $s2_ddddegatsf['d']['rhs']['t'] . ":" . $s2_ddddegatsf['d']['rhs']['v'];
					$s2_sssssssshl = $s2_ddddegatsf['d']['lhs'];
					$s2_sssssssshr = $s2_ddddegatsf['d']['rhs'];
					if( preg_match("/\W/", $s2_sssssssshl ) ){
						return $this->s2_rorre_dnopser("Line: ".$s2_iiiiegatsf . ": Let variable name should not contain special chars");
					}
					if( $s2_sssssssshr['t'] == s2_aaaaaaaotb('Vg==') ){
						$v = $this->s2_eeulav_teg($s2_sssssssshr);
						//print_pre( $v );exit;
						//$this->s2_ggggggggol[] = $v;
						$this->s2_tluser_tes( $s2_sssssssshl, $v );
					}else{
						$this->s2_tttttluser[ $s2_sssssssshl ] =$s2_sssssssshr;
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('TGV0Q29tcG9uZW50') ){
					$this->s2_ggggggggol[] = $s2_ddddegatsf['d']['lhs'] . " = " . $s2_ddddegatsf['d']['rhs']['t'];
					$s2_sssssssshl = $s2_ddddegatsf['d']['lhs'];
					$s2_sssssssshr = $s2_ddddegatsf['d']['rhs'];
					if( preg_match("/\W/", $s2_sssssssshl ) ){
						return $this->s2_rorre_dnopser("Line: ".$s2_iiiiegatsf . ": Let variable name should not contain special chars");
					}
					$component = $s2_sssssssshr['v']['i']['v'];
					if( file_exists(s2_aaaaaaaotb('Y2xhc3Nf') . $component . s2_aaaaaaaotb('LnBocA==')) ){
						require_once(s2_aaaaaaaotb('Y2xhc3Nf') . $component . s2_aaaaaaaotb('LnBocA=='));
						$v = new HTTPRequest();
						$this->s2_tluser_tes( $s2_sssssssshl, [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Q2xhc3M='), s2_aaaaaaaotb('dg==')=>$v] );
					}else{
						return $this->s2_rorre_dnopser("component not found!");
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('QXNzaWdu') ){
					$var = $s2_ddddegatsf['d']['lhs']['v']['v'];
					$s2_sssssssshl = $this->s2_eeulav_teg($s2_ddddegatsf['d']['lhs']);
					$s2_sssssssshr = $this->s2_eeulav_teg($s2_ddddegatsf['d']['rhs']);
					if( $s2_sssssssshl['t'] != $s2_sssssssshr['t'] ){
						$this->s2_ggggggggol[] = $s2_sssssssshr['v'];
						$this->s2_ggggggggol[] = "Warning: Assign: ". $s2_sssssssshl['t'] . ":" . $var . " = " . $s2_sssssssshr['t']. ":";
						$this->s2_ggggggggol[] = $s2_sssssssshr['v'];
					}
					$this->s2_tluser_tes( $var, $s2_sssssssshr );
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('RXhwcmVzc2lvbl9VbndhbnRlZA==') ){
					$this->s2_ssmeti_pxe = [];
					$exp = "(" . $s2_ddddegatsf['d']['rhs']['v'] . ")";
					$exp = preg_replace_callback("/[\(\)\+\-\/\%\*]/", function($m){
						$this->s2_ssmeti_pxe[] = $m[0];
						return "|e|";
					},$exp);
					$x = explode("|e|", $exp);
					$exp2 = "";
					foreach( $x as $i=>$j ){
						if( trim($j) ){
							if( is_numeric(trim($j) ) ){}else{
								$kv = $this->s2_eeulav_teg(trim($j));
								if( $kv['t'] == s2_aaaaaaaotb('Tg==') || is_numeric($kv['v']) ){
									$x[$i] = $this->s2_rebmun_ot_gnirts( $kv['v'] );
								}else{
									$this->s2_ggggggggol[] = "Error: Expresssion Variable is not Numeric: " . $j . " : " . $kv['t'];
									$x[$i] = s2_aaaaaaaotb('MA==');
								}
							}
						}
						$exp2 .= $x[$i] . $this->s2_ssmeti_pxe[$i];
					}
					$this->s2_ggggggggol[] = $exp2;
					//echo $exp2;exit;
					$exp2= '$vv='.$exp2. ";";
					try{
						eval($exp2);
					}catch(Exception $ex){
						$this->s2_ggggggggol[] = "Expression error: " . $ex->getMessage();
						$vv = 0;
					}
					$this->s2_tluser_tes( $s2_ddddegatsf['d']['lhs'], ['t'=>s2_aaaaaaaotb('Tg=='),s2_aaaaaaaotb('dg==')=>$vv] );
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('RXhwcmVzc2lvbg==') ){
					$this->s2_ssmeti_pxe = [];
					$this->s2_ggggggggol[] = $s2_ddddegatsf['d']['rhs']['v'];
					$exp = "(" . $s2_ddddegatsf['d']['rhs']['v'] . ")";
					$exp = preg_replace_callback("/\[([a-z][a-z0-9\-\>\_\ ]*)\]/", function($m){
						$this->s2_ssmeti_pxe[] = $m[1];
						return "|e|";
					},$exp);
					$x = explode("|e|", $exp);
					$exp2 = "";
					foreach( $x as $i=>$j ){
						if( $i < sizeof($this->s2_ssmeti_pxe) ){
							$kv = $this->s2_eeulav_teg( trim($this->s2_ssmeti_pxe[$i]) );
							if( $kv['t'] == s2_aaaaaaaotb('Tg==') || is_numeric($kv['v']) ){
								$kv['v'] = $this->s2_rebmun_ot_gnirts( $kv['v'] );
							}else{
								$this->s2_ggggggggol[] = "Error: Expresssion Variable is not Numeric: " . $this->s2_ssmeti_pxe[$i] . " : " . $kv['t'];
								$x[$i] = s2_aaaaaaaotb('MA==');
							}
							$exp2 .= $j . $kv['v'];
						}else{
							$exp2 .= $j;
						}
					}
					$this->s2_ggggggggol[] = $exp2;
					//echo $exp2;exit;
					$exp2= '$vv='.$exp2. ";";
					try{
						eval($exp2);
					}catch(Exception $ex){
						$this->s2_ggggggggol[] = "Expression error: " . $ex->getMessage();
						$vv = 0;
					}
					$this->s2_tluser_tes( $s2_ddddegatsf['d']['lhs'], ['t'=>s2_aaaaaaaotb('Tg=='),s2_aaaaaaaotb('dg==')=>$vv] );
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('TWF0aA==') ){
					$s2________shlv = $this->s2_eeulav_teg($s2_ddddegatsf['d']['lhs']);
					if( $s2________shlv['t'] != s2_aaaaaaaotb('Tg==') ){
						$this->s2_ggggggggol[] = "Warning: Math: lhs: not numeric";
					}
					$s2_sssssssshr = $s2_ddddegatsf['d']['rhs'];
					$s2_sssssssser = $this->s2_hhhhtam_od( $s2_sssssssshr );
					$this->s2_tluser_tes( $s2_ddddegatsf['d']['lhs'], [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>$s2_sssssssser] );
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('SWY=') ){
					$s2_kkkkkodnoc = true;
					foreach( $s2_ddddegatsf['d']['cond'] as $ci=>$cd ){
						$s2_sssssssshl = $this->s2_eeulav_teg($cd['lhs']);
						$s2_sssssssshr = $this->s2_eeulav_teg($cd['rhs']);
						$this->s2_ggggggggol[] = s2_aaaaaaaotb('SWYg') . $s2_sssssssshl['t'].":".$s2_sssssssshl['v'] . s2_aaaaaaaotb('IA==') . $cd['op'] . s2_aaaaaaaotb('IA==') . $s2_sssssssshl['t'].":".$s2_sssssssshr['v'];
						if( $cd['op'] == "==" ){
							if( $s2_sssssssshl['t'] == $s2_sssssssshr['t'] ){
								if( $s2_sssssssshl['v'] == $s2_sssssssshr['v'] ){}else{$s2_kkkkkodnoc = false;break; }
							}else{
								$s2_kkkkkodnoc = false;break;
							}
						}else if( $cd['op'] == "!=" ){
							if( $s2_sssssssshl['t'] == $s2_sssssssshr['t'] ){
								if( $s2_sssssssshl['v'] != $s2_sssssssshr['v'] ){}else{$s2_kkkkkodnoc = false;break; }
							}else{
								$s2_kkkkkodnoc = false;break;
							}
						}else if( $cd['op'] == "<" ){
							if( $s2_sssssssshl['t'] == $s2_sssssssshr['t'] ){
								if( $s2_sssssssshl['v'] < $s2_sssssssshr['v'] ){}else{$s2_kkkkkodnoc = false;break; }
							}else{
								$s2_kkkkkodnoc = false;break;
							}
						}else if( $cd['op'] == "<=" ){
							if( $s2_sssssssshl['t'] == $s2_sssssssshr['t'] ){
								if( $s2_sssssssshl['v'] <= $s2_sssssssshr['v'] ){}else{$s2_kkkkkodnoc = false;break; }
							}else{
								$s2_kkkkkodnoc = false;break;
							}
						}else if( $cd['op'] == ">" ){
							if( $s2_sssssssshl['t'] == $s2_sssssssshr['t'] ){
								if( $s2_sssssssshl['v'] > $s2_sssssssshr['v'] ){}else{$s2_kkkkkodnoc = false;break; }
							}else{
								$s2_kkkkkodnoc = false;break;
							}
						}else if( $cd['op'] == ">=" ){
							if( $s2_sssssssshl['t'] == $s2_sssssssshr['t'] ){
								if( $s2_sssssssshl['v'] >= $s2_sssssssshr['v'] ){}else{$s2_kkkkkodnoc = false;break; }
							}else{
								$s2_kkkkkodnoc = false;break;
							}
						}
					}
					if( $s2_kkkkkodnoc ){
						//$this->s2_ggggggggol[] = s2_aaaaaaaotb('SWYgbWF0Y2hlZA==');
					}else{
						$s2_iiiiegatsf = $this->s2_dnar_txen_dnif( $s2_iiiiegatsf );
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('Rm9y') ){
					$a = false;
					$vrand = $s2_ddddegatsf['vrand'];
					if( isset($this->s2_vvvv_dnarv[ $vrand ]) ){
						$a = $this->s2_vvvv_dnarv[ $vrand ]['a'];
					}
					if( !$a ){
						$this->s2_vvvv_dnarv[ $vrand ] = [
							s2_aaaaaaaotb('cw==') => $this->s2_eeulav_teg($s2_ddddegatsf['d']['start'])['v'],
							s2_aaaaaaaotb('ZQ==') => $this->s2_eeulav_teg($s2_ddddegatsf['d']['end'])['v'],
							s2_aaaaaaaotb('bw==') => $s2_ddddegatsf['d']['order'],
							s2_aaaaaaaotb('bQ==') => $this->s2_eeulav_teg($s2_ddddegatsf['d']['modifier'])['v'],
							s2_aaaaaaaotb('bXg=') => (int)$s2_ddddegatsf['d']['maxloops'],
							s2_aaaaaaaotb('YXM=') => $s2_ddddegatsf['d']['as'],
							s2_aaaaaaaotb('YQ==')=>true,
							s2_aaaaaaaotb('Yw==')=>0
						];
						$this->s2_ggggggggol[] = "Start: " . $this->s2_vvvv_dnarv[ $vrand ]['s'] . ", End: " . $this->s2_vvvv_dnarv[ $vrand ]['e'] . ", o: " . $this->s2_vvvv_dnarv[ $vrand ]['o']  . ", mx: ". $this->s2_vvvv_dnarv[ $vrand ]['mx'] . ", as: ". $this->s2_vvvv_dnarv[ $vrand ]['as'];
						$this->s2_tttttluser[ $this->s2_vvvv_dnarv[ $vrand ]['as'] ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>$this->s2_vvvv_dnarv[ $vrand ]['s'] ];
					}
					//print_pre( $this->s2_tttttluser );
					$c = $this->s2_vvvv_dnarv[ $vrand ]['c']++;
					$o = $this->s2_vvvv_dnarv[ $vrand ]['o'];
					$mx = $this->s2_vvvv_dnarv[ $vrand ]['mx'];
					// $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][ $s2_iiiiegatsf ][ s2_aaaaaaaotb('c3RhcnQ=') ] = $start;
					// $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][ $s2_iiiiegatsf ][ s2_aaaaaaaotb('ZW5k') ] = $end;
					$x = $this->s2_tttttluser[ $this->s2_vvvv_dnarv[ $vrand ]['as'] ]['v'];
					$e = $this->s2_vvvv_dnarv[ $vrand ]['e'];
					$f = false;
					if( $o == s2_aaaaaaaotb('YS16') ){
						$this->s2_ggggggggol[] = "For: ". $x . " <= " . $e . " && " . $c . " < " . $mx;
						if( $x <= $e && $c < $mx ){$f = true;}
					}else{
						$this->s2_ggggggggol[] = "For: ". $x . " >= " . $e . " && " . $c . " < " . $mx;
						if( $x >= $e && $c < $mx ){$f = true;}
					}
					if( $f ){
						// process loop
					}else{
						$this->s2_vvvv_dnarv[ $vrand ]['a'] = false;
						$s2_iiiiegatsf = $this->s2_dnar_txen_dnif( $s2_iiiiegatsf );
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('RW5kRm9y') ){
					$vrand = $s2_ddddegatsf['vrand'];
					$as = $this->s2_vvvv_dnarv[ $vrand ]['as'];
					$o = $this->s2_vvvv_dnarv[ $vrand ]['o'];
					$m = $this->s2_vvvv_dnarv[ $vrand ]['m'];
					if( $o == s2_aaaaaaaotb('YS16') ){
						$this->s2_tttttluser[ $as ]['v']+=$m;
					}else{
						$this->s2_tttttluser[ $as ]['v']-=$m;
					}
					if( $this->s2_vvvv_dnarv[ $vrand ]['c'] > $this->s2_vvvv_dnarv[ $vrand ]['mx'] ){
						$this->s2_ggggggggol[] = "For crossed maximum iterations!";
					}else{
						$s2_iiiiegatsf = $this->s2_dnar_verp_dnif( $s2_iiiiegatsf );
						$s2_iiiiegatsf--;
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('Rm9yRWFjaA==') ){
					$a = false;
					$vrand = $s2_ddddegatsf['vrand'];
					if( isset($this->s2_vvvv_dnarv[ $vrand ]) ){
						$a = $this->s2_vvvv_dnarv[ $vrand ]['a'];
					}
					$v = $this->s2_eeulav_teg( $s2_ddddegatsf['d']['var'] );
					if( $v['t']!=s2_aaaaaaaotb('Tw==') && $v['t']!=s2_aaaaaaaotb('TA==') ){
						$this->s2_ggggggggol[] = "Error: ForEach Expects a List";
						return $this->s2_rorre_dnopser(s2_aaaaaaaotb('SW5jb3JyZWN0IHZhcmlhYmxlIGZvciBGb3JFYWNo'));
					}
					//print_pre( $v );exit;
					if( !$a ){
						if( $v['t'] != s2_aaaaaaaotb('Tw==') && $v['t'] != s2_aaaaaaaotb('TA==') ){
							return $this->s2_rorre_dnopser(s2_aaaaaaaotb('SW5jb3JyZWN0IHZhcmlhYmxlIA=='). $v['t'] .s2_aaaaaaaotb('IGZvciBGb3JFYWNo'));
						}
						$this->s2_vvvv_dnarv[ $vrand ] = [
							s2_aaaaaaaotb('dmFy')=>$s2_ddddegatsf['d']['var']['v'],
							s2_aaaaaaaotb('a2V5cw==')=>array_keys($v['v']),
							s2_aaaaaaaotb('aw==') => $s2_ddddegatsf['d']['key'],
							s2_aaaaaaaotb('dg==') => $s2_ddddegatsf['d']['value'],
							s2_aaaaaaaotb('YQ==')=>true,
						];
					}
					if( sizeof( $this->s2_vvvv_dnarv[ $vrand ]['keys'] ) ){
						//print_r( $this->s2_vvvv_dnarv[ $vrand ]['keys'] );
						$k1 = array_splice($this->s2_vvvv_dnarv[ $vrand ]['keys'],0,1)[0];
						//echo $k1 . s2_aaaaaaaotb('LS0=');
						$this->s2_tttttluser[ $this->s2_vvvv_dnarv[ $vrand ]['k'] ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$k1 ];
						$this->s2_tttttluser[ $this->s2_vvvv_dnarv[ $vrand ]['v'] ] = $v['v'][ $k1 ];
						$this->s2_ggggggggol[] = $k1;
					}else{
						$this->s2_vvvv_dnarv[ $vrand ]['a'] = false;
						$s2_iiiiegatsf = $this->s2_dnar_txen_dnif( $s2_iiiiegatsf );
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('RW5kRm9yRWFjaA==') ){
					$vrand = $s2_ddddegatsf['vrand'];
					$s2_iiiiegatsf = $this->s2_dnar_verp_dnif( $s2_iiiiegatsf );
					$s2_iiiiegatsf--;
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('V2hpbGU=') ){
					$a = false;
					$vrand = $s2_ddddegatsf['vrand'];
					if( isset($this->s2_vvvv_dnarv[ $vrand ]) ){
						$a = $this->s2_vvvv_dnarv[ $vrand ]['a'];
					}
					if( !$a ){
						$this->s2_vvvv_dnarv[ $vrand ] = [
							s2_aaaaaaaotb('bXg=') => (int)$s2_ddddegatsf['d']['maxloops'],
							s2_aaaaaaaotb('YQ==')=>true,
							s2_aaaaaaaotb('Yw==')=>0
						];
					}
					//print_pre( $this->s2_tttttluser );
					$c = $this->s2_vvvv_dnarv[ $vrand ]['c']++;
					$mx = $this->s2_vvvv_dnarv[ $vrand ]['mx'];
					$f = true;
					foreach( $s2_ddddegatsf['d']['cond'] as $ci=>$cd ){
						$s2_sssssssshl = $this->s2_eeulav_teg( $cd['lhs'] );
						$s2_sssssssshr = $this->s2_eeulav_teg( $cd['rhs'] );
						$op = $cd['op'];
						if( $s2_sssssssshl['t'] != $s2_sssssssshr['t'] ){
							$this->s2_ggggggggol[] = "Error: while condition: data type mismatch: " . $s2_sssssssshl['t'] . ":" . $s2_sssssssshl['v'] . s2_aaaaaaaotb('IHRvIA==') . $s2_sssssssshr['t'] . ":" . $s2_sssssssshr['v'];
						}
						if( $op == "==" ){
							$this->s2_ggggggggol[] = $s2_sssssssshl['v'] . " == " . $s2_sssssssshr['v'];
							if( $s2_sssssssshl['v'] == $s2_sssssssshr['v'] ){}else{$f = false;}
						}else if( $op == "!=" ){
							$this->s2_ggggggggol[] = $s2_sssssssshl['v'] . " != " . $s2_sssssssshr['v'];
							if( $s2_sssssssshl['v'] != $s2_sssssssshr['v'] ){}else{$f = false;}
						}else if( $op == "<" ){
							$this->s2_ggggggggol[] = $s2_sssssssshl['v'] . " < " . $s2_sssssssshr['v'];
							if( $s2_sssssssshl['v'] < $s2_sssssssshr['v']  ){}else{$f = false;}
						}else if( $op == "<=" ){
							$this->s2_ggggggggol[] = $s2_sssssssshl['v'] . " <= " . $s2_sssssssshr['v'];
							if( $s2_sssssssshl['v'] <= $s2_sssssssshr['v'] ){}else{$f = false;}
						}else if( $op == ">" ){
							$this->s2_ggggggggol[] = $s2_sssssssshl['v'] . " > " . $s2_sssssssshr['v'];
							if( $s2_sssssssshl['v'] > $s2_sssssssshr['v']  ){}else{$f = false;}
						}else if( $op == ">=" ){
							$this->s2_ggggggggol[] = $s2_sssssssshl['v'] . " >= " . $s2_sssssssshr['v'];
							if( $s2_sssssssshl['v'] >= $s2_sssssssshr['v'] ){}else{$f = false;}
						}else{
							$this->s2_ggggggggol[] = $op . s2_aaaaaaaotb('IG5vdCBpbXBsZW1lbnRlZA==');
							$f = false;
						}
					}
					if( $f ){
						// process loop
					}else{
						$this->s2_vvvv_dnarv[ $vrand ]['a'] = false;
						$s2_iiiiegatsf = $this->s2_dnar_txen_dnif( $s2_iiiiegatsf );
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('RW5kV2hpbGU=') ){
					$vrand = $s2_ddddegatsf['vrand'];
					if( $this->s2_vvvv_dnarv[ $vrand ]['c'] >= $this->s2_vvvv_dnarv[ $vrand ]['mx'] ){
						$this->s2_ggggggggol[] = "For crossed maximum iterations!";
					}else{
						$s2_iiiiegatsf = $this->s2_dnar_verp_dnif( $s2_iiiiegatsf );
						$s2_iiiiegatsf--;
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('QnJlYWtMb29w') ){
					for($s2_222iegatsf=$s2_iiiiegatsf+1;$s2_222iegatsf<sizeof($this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages']);$s2_222iegatsf++){
						$ld = $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][$s2_222iegatsf];
						if( $ld['k']['v'] == s2_aaaaaaaotb('RW5kV2hpbGU=') || $ld['k']['v'] == s2_aaaaaaaotb('RW5kRm9yRWFjaA==') || $ld['k']['v'] == s2_aaaaaaaotb('RW5kRm9y') ){
							//$vrand = $ld['vrand'];
							$s2_iiiiegatsf = $s2_222iegatsf;
						}
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('TmV4dExvb3A=') ){
					for($s2_222iegatsf=$s2_iiiiegatsf+1;$s2_222iegatsf<sizeof($this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages']);$s2_222iegatsf++){
						$ld = $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][$s2_222iegatsf];
						if( $ld['k']['v'] == s2_aaaaaaaotb('RW5kV2hpbGU=') || $ld['k']['v'] == s2_aaaaaaaotb('RW5kRm9yRWFjaA==') || $ld['k']['v'] == s2_aaaaaaaotb('RW5kRm9y') ){
							//$vrand = $ld['vrand'];
							$s2_iiiiegatsf = $s2_222iegatsf-1;
						}
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('U2V0TGFiZWw=') ){
					$this->s2_ssssslebal[ $s2_ddddegatsf['d']['v'] ] = $s2_iiiiegatsf;
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('SnVtcFRvTGFiZWw=') ){
					if( isset($this->s2_ssssslebal[ $s2_ddddegatsf['d']['v'] ]) ){
						$s2_iiiiegatsf = $this->s2_ssssslebal[ $s2_ddddegatsf['d']['v'] ];
					}else{
						$this->s2_ggggggggol[] = "Label not found!";
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('UmVzcG9uZA==') ){
					//print_pre( $this->s2_tttttluser );
					$this->s2_ggggggggol[] = s2_aaaaaaaotb('UmVzcG9uZA==');
					if( $s2_ddddegatsf['d']['t'] == s2_aaaaaaaotb('Tw==') ){
						$this->s2_eeesnopser['body'] =$this->s2_yarra_ot_etalpmet( $s2_ddddegatsf['d']['v'] );
						return $this->s2_eeesnopser;
					}else{
						$this->s2_ggggggggol[] = "Respond: " . $s2_ddddegatsf['d']['t'];
						$this->s2_eeesnopser['body'] =[s2_aaaaaaaotb('c3RhdHVz')=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>s2_aaaaaaaotb('VW5oYW5kbGVkIHJldHJ1biB0eXBl')];
						return $this->s2_eeesnopser;
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('UmVzcG9uZEpTT04=') ){
					if( isset($this->s2_ssssnoitpo['raw_output']) ){
						return [s2_aaaaaaaotb('c3RhdHVz')=>s2_aaaaaaaotb('c3VjY2Vzcw=='), s2_aaaaaaaotb('ZGF0YQ==')=>$this->s2_etutitsbus_ot_etalpmet( $s2_ddddegatsf['d']['output']['v'] ) ];
					}else if( $s2_ddddegatsf['d']['output']['t'] == s2_aaaaaaaotb('Tw==') ){
						$this->s2_eeesnopser['body'] =$this->s2_yarra_ot_etalpmet( $s2_ddddegatsf['d']['output']['v'] );
						if( $s2_ddddegatsf['d']['pretty']['v'] != s2_aaaaaaaotb('ZmFsc2U=') && $s2_ddddegatsf['d']['pretty']['v'] !== false  ){
							$this->s2_eeesnopser['pretty'] = true;
						}
						return $this->s2_eeesnopser;
					}else{
						$this->s2_ggggggggol[] = "Respond: " . $s2_ddddegatsf['d']['t'];
						$this->s2_eeesnopser['body'] = [s2_aaaaaaaotb('c3RhdHVz')=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>s2_aaaaaaaotb('VW5oYW5kbGVkIHJldHJ1biB0eXBl')];
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('UmVzcG9uZFZhcg==') ){
					if( isset($this->s2_ssssnoitpo['raw_output']) ){
						if( $s2_ddddegatsf['d']['output']['t'] == s2_aaaaaaaotb('Vg==') ){
							$v = $this->s2_eeulav_teg($s2_ddddegatsf['d']['output']);
						}else{
							$v = $s2_ddddegatsf['d']['output'];
						}
						return [s2_aaaaaaaotb('c3RhdHVz')=>s2_aaaaaaaotb('c3VjY2Vzcw=='), s2_aaaaaaaotb('ZGF0YQ==')=>$v ];
					}else if( $s2_ddddegatsf['d']['output']['t'] == s2_aaaaaaaotb('Vg==') ){
						$this->s2_eeesnopser['body'] = $this->s2_eulav_erup_teg( $s2_ddddegatsf['d']['output'] );
						return $this->s2_eeesnopser;
					}else{
						$this->s2_ggggggggol[] = "Respond: " . $s2_ddddegatsf['d']['t'];
						$this->s2_eeesnopser['body'] = [s2_aaaaaaaotb('c3RhdHVz')=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>s2_aaaaaaaotb('VW5oYW5kbGVkIHJldHJ1biB0eXBl')];
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('UmVzcG9uZFhNTA==') ){
					//print_pre( $this->s2_tttttluser );
					$this->s2_ggggggggol[] = s2_aaaaaaaotb('UmVzcG9uZA==');
					if( $s2_ddddegatsf['d']['output']['t'] == s2_aaaaaaaotb('Tw==') ){
						$this->s2_eeesnopser['body'] =$this->s2_yarra_ot_etalpmet( $s2_ddddegatsf['d']['v'] );
						return $this->s2_eeesnopser;
					}else{
						$this->s2_ggggggggol[] = "Respond: " . $s2_ddddegatsf['d']['t'];
						$this->s2_eeesnopser['body'] = [s2_aaaaaaaotb('c3RhdHVz')=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>s2_aaaaaaaotb('VW5oYW5kbGVkIHJldHJ1biB0eXBl')];
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('QWRkSFRNTA==') ){
					//print_pre( $this->s2_tttttluser );
					if( $this->s2_eeeeenigne['output-type'] != "text/html" ){
						$this->s2_ggggggggol[] = s2_aaaaaaaotb('SW5jb3JyZWN0IHBhZ2UgdHlwZSBhbmQgUmVzcG9uc2UgRm9ybWF0');
					}else{
						$this->s2_ggggggggol[] = s2_aaaaaaaotb('QWRkSFRNTA==');
						if( gettype( $this->s2_eeesnopser['body'] ) == s2_aaaaaaaotb('YXJyYXk=') ){
							$this->s2_eeesnopser['body'] = "";
						}
						if( $s2_ddddegatsf['d']['t'] == s2_aaaaaaaotb('VA==') || $s2_ddddegatsf['d']['t'] == s2_aaaaaaaotb('VFQ=') ){
							$this->s2_eeesnopser['body'] .= $this->s2_srav_lmth_ecalper( $s2_ddddegatsf['d']['v'] ) . "\n";
						}else if( $s2_ddddegatsf['d']['t'] == s2_aaaaaaaotb('SFQ=') ){
							$this->s2_eeesnopser['body'] .= $this->s2_srav_lmth_ecalper( $s2_ddddegatsf['d']['v'] ) . "\n";
						}else if( $s2_ddddegatsf['d']['t'] == s2_aaaaaaaotb('Vg==') ){
							$d = $this->s2_eeulav_teg( $s2_ddddegatsf['d'] );
							if( gettype($d) == s2_aaaaaaaotb('YXJyYXk=') ){
								if( $d['t'] == s2_aaaaaaaotb('Tw==') || $d['t'] == s2_aaaaaaaotb('TA==') ){
									$this->s2_eeesnopser['body'] .= json_encode( $this->s2_yarra_ot_etalpmet( $d['v'] ) , JSON_PRETTY_PRINT);
								}else{
									$this->s2_eeesnopser['body'] .= $this->s2_srav_lmth_ecalper( $d['v'] );
								}
							}
						}else{
							//print_pre( $s2_ddddegatsf['d'] );exit;
							$this->s2_eeesnopser['body'] .= "\nIncorrect Output Format: " . $s2_ddddegatsf['d']['output']['t'];
							$this->s2_ggggggggol[] = "Respond: " . $s2_ddddegatsf['d']['t'];
						}
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('TG9n') ){
					if( $s2_ddddegatsf['d']['t'] == s2_aaaaaaaotb('Tw==') ){
						$this->s2_ggggggggol[] = $this->s2_yarra_ot_etalpmet( $s2_ddddegatsf['d']['v'] );
					}else{
						$this->s2_ggggggggol[] = "Log: Incorrect Type: " . $s2_ddddegatsf['d']['t'];
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('RnVuY3Rpb24=') ){
					$val = $this->s2_noitcnuf_od( $s2_ddddegatsf['d'] );
					if( $s2_ddddegatsf['d']['self'] == false ){
						$this->s2_tluser_tes( $s2_ddddegatsf['d']['lhs'], $val );
					}
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('RnVuY3Rpb25DYWxs') ){
					$s2_sssssssser = $this->s2_llac_noitcnuf_od( $s2_ddddegatsf['d'] );
					//print_pre( $s2_sssssssser );
					if( $s2_sssssssser['status'] == s2_aaaaaaaotb('ZmFpbA==') ){
						if( isset($this->s2_ssssnoitpo['raw_output']) ){
							return $s2_sssssssser;
						}else{
							$this->s2_eeesnopser['statusCode'] = 500;
							$this->s2_eeesnopser['body'] = $s2_sssssssser;
							if( isset($this->s2_ssssnoitpo['raw_output']) ){
								return $s2_sssssssser;
							}
							return $this->s2_eeesnopser;
						}
					}
					//print_pre( $s2_sssssssser );
					if( !isset($s2_sssssssser['data']) ){
						$this->s2_eeesnopser['statusCode'] = 500;
						$this->s2_eeesnopser['body'] = "functionCall: No data returned";
						return $this->s2_eeesnopser;
					}
					if( !isset($s2_sssssssser['data']['t']) || !isset($s2_sssssssser['data']['v']) ){
						$this->s2_eeesnopser['statusCode'] = 500;
						$this->s2_eeesnopser['body'] = "functionCall: Incorrect return type". json_encode($s2_sssssssser['data']);
						return $this->s2_eeesnopser;
					}
					$this->s2_tluser_tes( $s2_ddddegatsf['d']['lhs'], $s2_sssssssser['data'] );
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('TW9uZ29EYg==') ){
					$val = $this->s2_bbbbdognom( $s2_ddddegatsf );
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('TXlTcWw=') ){
					$val = $this->s2_llllllqsym( $s2_ddddegatsf );
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('SW50ZXJuYWwtVGFibGU=') ){
					$val = $this->table_dynamic( $s2_ddddegatsf );
				}
				if( $s2_ddddegatsf['k']['v'] == s2_aaaaaaaotb('SFRUUFJlcXVlc3Q=') ){
					$val = $this->s2_tseuqeRPTTH( $s2_ddddegatsf );
				}
			}else{ // variable commands
				if( $s2_ddddegatsf['k']['v'] != s2_aaaaaaaotb('Tm9uZQ==') && $s2_ddddegatsf['k']['v'] != s2_aaaaaaaotb('bm9uZQ==') ){
					if( $this->s2_ttttttessi( $s2_ddddegatsf['k']['v'] ) ){
						//print_pre( $s2_ddddegatsf['k'] );//exit;
						$var = $s2_ddddegatsf['k']['v'];
						if( $s2_ddddegatsf['k']['plg'] ){
							if( $s2_ddddegatsf['k']['vs']['d']['self'] && $s2_ddddegatsf['k']['vs']['d']['replace'] ){
								$newval = $this->s2_eulav_glp_teg(['t'=>s2_aaaaaaaotb('Vg=='), 'v'=>$s2_ddddegatsf['k']]);
								$this->s2_tluser_tes( $var, $newval );
							}else{
								$this->s2_eulav_glp_tes($s2_ddddegatsf['k']);
							}
						}else{
							if( $s2_ddddegatsf['k']['vs']['d']['self'] && $s2_ddddegatsf['k']['vs']['d']['replace'] ){
								$newval = $this->s2_eeulav_teg(['t'=>s2_aaaaaaaotb('Vg=='), 'v'=>$s2_ddddegatsf['k']]);
								//print_pre( $newval );exit;
								$this->s2_tluser_tes( $var, $newval );
							}else{
								$this->s2_eeulav_tes($s2_ddddegatsf['k']);
							}
						}
					}else{
						$this->s2_ggggggggol[] = "ERROR: " . $s2_ddddegatsf['k']['v'] . " not found!";
					}
				}
			}
			$s2_verp_iegatsf = $s2_iiiiegatsf;
		}
		return $this->s2_eeesnopser;
	}
	function s2_srav_lmth_ecalper( $v ){
		preg_match_all( "/\{\{(.*?)\}\}/", $v, $m);
		if( $m[0] ){
			foreach( $m[0] as $ii=>$jj ){
				$d = $this->s2_eeulav_teg( trim($m[1][$ii]) );
				if( $d['t'] == s2_aaaaaaaotb('Tw==') || $d['t'] == s2_aaaaaaaotb('TA==') ){
					$v = str_replace( $jj, json_encode($d['v']), $v );
				}else{
					$v = str_replace( $jj, $d['v'], $v );
				}
			}
		}
		return $v;
	}
	function s2_noitcnuf_od( $s2_ddddegatsf ){
		$_fn = $s2_ddddegatsf['fn'];
		$_fn_inputs = $s2_ddddegatsf['inputs'];
		unset($_fn_inputs['type']);
		$_c = "";
		$_ct = s2_aaaaaaaotb('Qg==');
		foreach( $_fn_inputs as $i=>$j ){if( $i != s2_aaaaaaaotb('dHlwZQ==') ){
			if( $j['t'] == s2_aaaaaaaotb('Vg==') ){
				$v = $this->s2_eeulav_teg( $j['v']['v'] );
				$_fn_inputs[ $i ]['v'] = $v['v'];
				$_fn_inputs[ $i ]['t'] = $v['t'];
			}
		}}
		if( !$_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] && gettype( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] ) != s2_aaaaaaaotb('YXJyYXk=') ){
			$this->s2_ggggggggol[] = "Variable [".$_fn_inputs[s2_aaaaaaaotb('cDE=')]['name']."] empty";
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('Um91bmQ=') ){
			$_ct = s2_aaaaaaaotb('Tg==');
			$p1 = $this->s2_rebmun_ot_gnirts($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']);
			if( $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] ){
				$_c = round( $p1, $this->s2_rebmun_ot_gnirts($_fn_inputs[s2_aaaaaaaotb('cDI=')]['v']), constant($_fn_inputs[s2_aaaaaaaotb('cDM=')]['v']) );
			}else{
				$_c = round( $p1, $this->s2_rebmun_ot_gnirts($_fn_inputs[s2_aaaaaaaotb('cDI=')]['v']) );
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('UmFuZG9tIE51bWJlcg==') ){
			$_ct = s2_aaaaaaaotb('Tg==');
			if( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']  && $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] ){
				$_c = rand((int) $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], (int)$_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] );
			}else{
				$_c = rand( 0,1000 );
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('VGV4dCB0byBOdW1iZXI=') ){
			$_ct = s2_aaaaaaaotb('Tg==');
			$_c = $this->s2_rebmun_ot_gnirts( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('TnVtYmVyIEZvcm1hdA==') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = (string)number_format($this->s2_rebmun_ot_gnirts($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']),(int)$_fn_inputs[s2_aaaaaaaotb('cDI=')]['v']);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('VGV4dCBQYWRkaW5n') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$m = $_fn_inputs[s2_aaaaaaaotb('cDQ=')]['v'];
			if( $m == s2_aaaaaaaotb('TGVmdA==') ){$m = STR_PAD_LEFT;}
			if( $m == s2_aaaaaaaotb('UmlnaHQ=') ){$m = STR_PAD_RIGHT;}
			if( $m == s2_aaaaaaaotb('Qm90aA==') ){$m = STR_PAD_BOTH;}
			$_c = (string)str_pad( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], (string)$_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'],$m);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('TnVtYmVyIHRvIFRleHQ=') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = (string)$_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'];
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('aXMgaXQgVGV4dA==') ){
			$_ct = s2_aaaaaaaotb('Qg==');
			if( is_string($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']) == s2_aaaaaaaotb('c3RyaW5n') ){
				$_c = true;
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('aXMgaXQgTnVtZXJpYw==') ){
			$_ct = s2_aaaaaaaotb('Qg==');
			if( is_numeric($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']) ){
				$_c = true;
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('aXMgaXQgQmluYXJ5') ){
			$_ct = s2_aaaaaaaotb('Qg==');
			if( $this->isBinary($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']) || $_fn_inputs[s2_aaaaaaaotb('cDE=')]['t'] == s2_aaaaaaaotb('QklO') ){
				$_c = true;
			}else{
				$_c = false;
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('TnVtYmVyIHRvIExldHRlcg==') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = chr($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('Q2hhbmdlIFR5cGU=') ){
			if( $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] == s2_aaaaaaaotb('VA==') ){
				$_c = (string)$_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'];
				$_ct = 'T';
			}else if( $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] == s2_aaaaaaaotb('Tg==') ){
				$_c = $this->s2_rebmun_ot_gnirts( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
				$_ct  = 'N';
			}else if( $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] == s2_aaaaaaaotb('Qg==') ){
				$_c = true;
				$_ct  = 'B';
			}else if( $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] == s2_aaaaaaaotb('Tw==') ){
				$_c = [];
				$_ct  = 'O';
			}else if( $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] == s2_aaaaaaaotb('TA==') ){
				$_c = [];
				$_ct  = 'L';
			}else if( $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] == s2_aaaaaaaotb('QklO') ){
				$_c = "";
				$_ct = 'BIN';
			}else if( $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] == s2_aaaaaaaotb('QjY0') ){
				$_c = "";
				$_ct = 'B64';
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('dWN3b3Jkcw==') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = ucwords($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('VW5pcUlE') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = uniqid();
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('bW9uZ29kYl9pZA==') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = $this->s2_nnnnnnnnoc->generate_id();
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('QWRkIERheXM=') ){
			$_ct = s2_aaaaaaaotb('RA==');
			$_c = date(s2_aaaaaaaotb('WS1tLWQ='), strtotime( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] )+($_fn_inputs[s2_aaaaaaaotb('cDI=')]['v']*86400) );
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('TWludXMgRGF5cw==') ){
			$_ct = s2_aaaaaaaotb('RA==');
			$_c = date(s2_aaaaaaaotb('WS1tLWQ='), strtotime( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] )-($_fn_inputs[s2_aaaaaaaotb('cDI=')]['v']*86400) );
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('U3RyVG9UaW1l') ){
			$_ct = s2_aaaaaaaotb('VFM=');
			$_c = strtotime( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('RGF5cyB0aWxsIFRvZGF5') ){
			$_ct = s2_aaaaaaaotb('Tg==');
			$_c = time()-strtotime( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
			$_c = floor($_c/86400);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('TW9udGhzIHRpbGwgVG9kYXk=') ){
			$_ct = s2_aaaaaaaotb('Tg==');
			$_c = time()-strtotime( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
			$_c = floor($_c/86400/30);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('WWVhcnMgdGlsbCBUb2RheQ==') ){
			$_ct = s2_aaaaaaaotb('Tg==');
			$_c = time()-strtotime( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
			$_c = floor($_c/86400/365);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('RGF5cyBEaWZm') ){
			$_ct = s2_aaaaaaaotb('Tg==');
			$_c = strtotime( $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] )-strtotime( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
			$_c = floor($_c/86400);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('TW9udGhzIERpZmY=') ){
			$_ct = s2_aaaaaaaotb('Tg==');
			$_c = strtotime( $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] )-strtotime( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
			$_c = floor($_c/86400/30);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('WWVhcnMgRGlmZg==') ){
			$_ct = s2_aaaaaaaotb('Tg==');
			$s2_11111111c_ = strtotime( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
			$s2_22222222c_ = strtotime( $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] );
			$s2_33333333c_ = $s2_22222222c_ - $s2_11111111c_;
			$_c = floor($s2_33333333c_/86400/365);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('Q2hhbmdlIEZvcm1hdA==') ){
			$_ct = s2_aaaaaaaotb('RA==');
			$_c = date($_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], strtotime( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] ));
		}

		//  LIST FUNCTIONS 
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('TGlzdCBMZW5ndGg=') ){
			$_ct = s2_aaaaaaaotb('Tg==');
			if( gettype($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']) ==s2_aaaaaaaotb('YXJyYXk=') && array_keys($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'][0]===0) ){
				$_c = sizeof( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
			}else{
				$this->s2_ggggggggol[] = "List length: non array";
				$_c = 0;
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('R2V0IExpc3QgSXRlbQ==') ){
			$_ct = s2_aaaaaaaotb('Tw==');
			$_c = $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'][ $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] ];
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('TGlzdCBBcHBlbmQ=') ){
			$_ct = s2_aaaaaaaotb('TA==');
			if( !is_array($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']) ){
				$this->s2_ggggggggol[] = "List Append Error: Value is not list!";
			}else{
				$_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'][] = $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'];
				$_c = $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'];
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('TGlzdCBQcmVwZW5k') ){
			array_splice( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], 0, 0, [$_fn_inputs[s2_aaaaaaaotb('cDI=')]['v']] );
			$_c = $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'];
			$_ct = s2_aaaaaaaotb('TA==');
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('TGlzdCBJdGVtIFJlbW92ZQ==') ){
			array_splice( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], 1 );
			$_c = $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'];
			$_ct = s2_aaaaaaaotb('TA==');
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('R2V0IFZhbHVl') ){
			$_ct = $s2_ddddegatsf['return'];
			$_c = $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'][ $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] ];
		}
		
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('U2V0IFZhbHVl') ){
			$_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'][ $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] ] = $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'];
			$_ct = s2_aaaaaaaotb('Tw==');
			$_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'][ $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] ];
			$_c = $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'];
		}
		// LIST FUNCTIONS
		// String Functions Start
		
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('Q29uY2F0') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = "";
			foreach( $_fn_inputs as $i=>$j ){
				$_c .= $j['v'];
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('U3ViIFN0cmluZw==') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = substr( (string)$_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], (int)$_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], (int)$_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] );
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('UmVwbGFjZSBUZXh0') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = str_replace( $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('dG8gVXBwZXIgQ2FzZQ==') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = strtoupper( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('dG8gTG93ZXIgQ2FzZQ==') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = strtolower( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('VHJpbQ==') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = trim( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('Q2xlYW4=') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = preg_replace("/[\W]+/", "", $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('TWF0Y2ggUGF0dGVybg==') ){
			$m = false;
			@preg_match($_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], $m );
			if( $m ){
				if( $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] == s2_aaaaaaaotb('VHJ1ZQ==') ){
					$_ct = s2_aaaaaaaotb('Qg==');
					$_c = true;
				}else if( $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] == s2_aaaaaaaotb('TWF0Y2hlZCBTdHJpbmc=') ){
					$_ct = s2_aaaaaaaotb('VA==');
					$_c = $m[0];
				}else if( $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] == s2_aaaaaaaotb('TWF0Y2hlZCBHcm91cCAx') && $m[1] ){
					$_ct = s2_aaaaaaaotb('VA==');
					$_c = $m[1];
				}else if( $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] == s2_aaaaaaaotb('TWF0Y2hlZCBHcm91cCAy') && $m[2] ){
					$_ct = s2_aaaaaaaotb('VA==');
					$_c = $m[2];
				}else if( $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] == s2_aaaaaaaotb('TWF0Y2hlZCBHcm91cCAz') && $m[3] ){
					$_ct = s2_aaaaaaaotb('VA==');
					$_c = $m[3];
				}else{
					$_ct = s2_aaaaaaaotb('Qg==');
					$_c = false;
				}
			}else{
				$_ct = s2_aaaaaaaotb('Qg==');
				$_c = false;
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('SlNPTiBFbmNvZGU=') ){
			$_ct = s2_aaaaaaaotb('VA==');
			if( $_fn_inputs['p2']['v'] == s2_aaaaaaaotb('dHJ1ZQ==') ){
				$_c = json_encode( $this->s2_yarra_ot_etalpmet( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] ), JSON_PRETTY_PRINT );
			}else{
				$_c = json_encode( $this->s2_yarra_ot_etalpmet( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] ) );
			}
			if( json_last_error() ){
				$this->s2_ggggggggol[] = "JSON Encode Error: " . json_last_error_msg();
				$_c = "";
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('SlNPTiBEZWNvZGU=') ){
			$_ct = s2_aaaaaaaotb('Tw==');
			$_c = json_decode( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], true );
			if( json_last_error() ){
				$this->s2_ggggggggol[] = "JSON Decode Error: " . json_last_error_msg();
				$_c = [];
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('SFRNTCBFbnRpdHkgRGVjb2Rl') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = str_replace("&quot;", "\"", $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']);
			$_c = str_replace("&lt;", "<", $_c);
			$_c = str_replace("&gt;", ">", $_c);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('WE1MIERlY29kZQ==') ){
			$_ct = s2_aaaaaaaotb('Tw==');
			$_c = "";
			$_error = "";
			try{
				$body_parsed = simplexml_load_string($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']);
				preg_match("/^\<\?xml.*\?\>/i", $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], $m);
				if( $m ){
					$_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] = substr($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], strlen($m[0]), strlen($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']));
				}
				preg_match("/^\<([a-z0-9\:\-\_\.]+)/i", $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], $m);
				if( $m ){
					if( $m[1] ){
						$body_parsed = $this->parsexml($body_parsed);
						$_c = [$m[1]=>$body_parsed];
					}
				}
			}catch(Exception $ex){
				$_error = $ex->getMessage();
				$this->s2_ggggggggol[] = "XML Decode Error: " . $_error;
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('QmFzZTY0IEVuY29kZQ==') ){
			$_ct = s2_aaaaaaaotb('QjY0');
			$_c = base64_encode($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('QmFzZTY0IERlY29kZQ==') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_c = base64_decode($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']);
			if( $this->isBinary($_c) ){
				$_ct = s2_aaaaaaaotb('QklO');
			}
		}
		if( $s2_ddddegatsf['function']['function'] == s2_aaaaaaaotb('R2VuZXJhdGUgSVY=') ){
			if( $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] == s2_aaaaaaaotb('TnVsbEJ5dGVz') ){
				$_c = s2_aaaaaaaotb('MDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMA==');
				$_c = substr($_c, 0, (int)$_fn_inputs[s2_aaaaaaaotb('cDE=')]['value'] );
			}else{
				$_c = random_bytes( (int)$_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
			}
			$_ct = s2_aaaaaaaotb('QklO');
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('UmFuZG9tIFRleHQ=') ){
			$_c = substr( str_shuffle( s2_aaaaaaaotb('YWJjZGVmMDEyMzQ1Njc5MGdoaWprbG1ub3BxcnN0dXZ3eHl6YWJjZGVmMDEyMzQ1Njc5MGdoaWprbG1ub3BxcnN0dXZ3eHl6YWJjZGVmMDEyMzQ1Njc5MGdoaWprbG1ub3BxcnN0dXZ3eHl6YWJjZGVmMDEyMzQ1Njc5MGdoaWprbG1ub3BxcnN0dXZ3eHl6YWJjZGVmMDEyMzQ1Njc5MGdoaWprbG1ub3BxcnN0dXZ3eHl6YWJjZGVmMDEyMzQ1Njc5MGdoaWprbG1ub3BxcnN0dXZ3eHl6') ), 0, (int)$_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
			$_ct = s2_aaaaaaaotb('VA==');
		}
		if( $s2_ddddegatsf['function']['function'] == s2_aaaaaaaotb('R2V0IElWIFNpemU=') ){
			$_ct = s2_aaaaaaaotb('Tg==');
			$_c = openssl_cipher_iv_length($_fn_inputs[s2_aaaaaaaotb('cDE=')]['value']);
		}
		if( $s2_ddddegatsf['function']['function'] == s2_aaaaaaaotb('SGV4IHRvIEJpbg==') ){
			$_ct = s2_aaaaaaaotb('QklO');
			$_c = hex2bin($_fn_inputs[s2_aaaaaaaotb('cDE=')]['value']);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('SGFzaA==') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$ctx = hash_init($_fn_inputs[s2_aaaaaaaotb('cDI=')]['v']);
			if( $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] ){
				hash_update( $ctx, $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] );
			}
			hash_update( $ctx, $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'] );
			$_c = hash_final( $ctx );
			$_ct = s2_aaaaaaaotb('QjY0');
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('T3BlblNTTCBQdWJsaWMgRW5jcnlwdA==') ){
			$_ct = s2_aaaaaaaotb('QjY0');
			$_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] = $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v']['public'];
			$_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] = constant( $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] );
			$this->s2_ggggggggol[] = $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'];
			//$this->s2_ggggggggol[] = $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'];
			$this->s2_ggggggggol[] = $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'];
			//eval("\$p=".$_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'].";");
			$st = openssl_public_encrypt( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], $crypted, $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] );
			$_c = base64_encode($crypted);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('T3BlblNTTCBQdWJsaWMgRGVjcnlwdA==') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] = $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v']['public'];
			$_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] = constant( $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] );
			$this->s2_ggggggggol[] = $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'];
			//$this->s2_ggggggggol[] = $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'];
			$this->s2_ggggggggol[] = $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'];
			$st = openssl_public_decrypt( base64_decode($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']), $crypted, $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] );
			$_c = $crypted;
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('T3BlblNTTCBQcml2YXRlIEVuY3J5cHQ=') ){
			$_ct = s2_aaaaaaaotb('QjY0');
			$_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] = $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v']['private'];
			$_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] = constant( $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] );
			$this->s2_ggggggggol[] = $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'];
			//$this->s2_ggggggggol[] = $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'];
			$this->s2_ggggggggol[] = $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'];
			$st = openssl_private_encrypt( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], $crypted, $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] );
			$_c = base64_encode($crypted);
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('T3BlblNTTCBQcml2YXRlIERlY3J5cHQ=') ){
			$_ct = s2_aaaaaaaotb('VA==');
			$_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'] = $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v']['private'];
			$_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] = constant( $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] );
			$this->s2_ggggggggol[] = $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'];
			//$this->s2_ggggggggol[] = $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'];
			$this->s2_ggggggggol[] = $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'];
			$st = openssl_private_decrypt( base64_decode($_fn_inputs[s2_aaaaaaaotb('cDE=')]['v']), $crypted, $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] );
			$_c = $crypted;
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('T3BlblNTTCBFbmNyeXB0') ){
			$_ct = s2_aaaaaaaotb('QjY0');
			if( $_fn_inputs[s2_aaaaaaaotb('cDQ=')]['v'] ){
				$_c = openssl_encrypt( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'], 0, $_fn_inputs[s2_aaaaaaaotb('cDQ=')]['v'] );
			}else{
				$_c = openssl_encrypt( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] );
			}
		}
		if( $s2_ddddegatsf['fn'] == s2_aaaaaaaotb('T3BlblNTTCBEZWNyeXB0') ){
			$_ct = s2_aaaaaaaotb('VA==');
			if( $_fn_inputs[s2_aaaaaaaotb('cDQ=')]['v'] ){
				$_c = openssl_decrypt( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'], 0, $_fn_inputs[s2_aaaaaaaotb('cDQ=')]['v'] );
			}else{
				$_c = openssl_decrypt( $_fn_inputs[s2_aaaaaaaotb('cDE=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDI=')]['v'], $_fn_inputs[s2_aaaaaaaotb('cDM=')]['v'] );
			}
		}
		if( gettype($_c) == s2_aaaaaaaotb('ZmxvYXQ=') || gettype($_c) == s2_aaaaaaaotb('ZG91Ymxl') ){
			if( is_nan($_c) || is_infinite($_c) ){
				$_ct = s2_aaaaaaaotb('Tkw=');
				$_c = s2_aaaaaaaotb('TlVMTA==');
			}
		}
		///$this->s2_ggggggggol[] = "setting: " . $_c;

		if( $s2_ddddegatsf['self'] ){
			$this->s2_ggggggggol[] = $s2_ddddegatsf['lhs']['v']['t'] . ":" . $_ct;
			if( $s2_ddddegatsf['lhs']['v']['t'] != $_ct && $s2_ddddegatsf['lhs']['v']['t'] != ($_ct==s2_aaaaaaaotb('QjY0')?s2_aaaaaaaotb('VA=='):$_ct) ){
				$this->s2_ggggggggol[] = s2_aaaaaaaotb('VW5leHBlY3RlZCB0eXBlIGFzc2lnbm1lbnQgLi4uIA==');
			}
			if( $s2_ddddegatsf['lhs']['v']['t'] != s2_aaaaaaaotb('QklO') && $_ct == s2_aaaaaaaotb('QklO') ){
				$this->s2_ggggggggol[] = "Unexpected: Binary data striped";
			}
			//$this->s2_ggggggggol[] = s2_aaaaaaaotb('c2V0dGluZy4uLi4=');
			$this->s2_tluser_tes( $s2_ddddegatsf['lhs'], [s2_aaaaaaaotb('dA==')=>$_ct, s2_aaaaaaaotb('dg==')=>$_c] );
		}
		return [s2_aaaaaaaotb('dA==')=>$_ct, s2_aaaaaaaotb('dg==')=>$_c];
	}
	function s2_noitcnuf_glp_od( &$v, $vs, $var = "" ){
		//print_pre( s2_aaaaaaaotb('ZG9fUExHX2Z1bmN0aW9u') );
		//print_pre( $v );
		//print_pre( $vs );
		$method = $vs['v'];
		$inputs = $vs['d']['inputs'];
		//print_pre( $inputs );
		foreach( $inputs as $i=>$j ){
			$inputs[ $i ] = $this->s2_eeulav_teg( $j['v'] );
		}
		//print_pre( $inputs );
		if( method_exists($v['v'], $method) ){
			//echo s2_aaaaaaaotb('TWV0aG9kIGV4aXN0cw==');
			$k = $v['v']->{$method}($inputs);
			// echo s2_aaaaaaaotb('ZG9fcGxnX2Z1bmN0aW9uIA==') . $method . " returning: \n";
			// print_pre( $k );
			if( is_array($k) ){
				return $k;
			}else{
				$this->s2_ggggggggol[] = "Method return value incorrect: ". $method;
				return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>false];
			}
		}else{
			//echo "do_plg_function Method not exists: \n";
			$this->s2_ggggggggol[] = "Method not found: ". $method;
			return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>false];
		}
		//$rt = true;
		//$inputs = $vs['d']['inputs'];
	}
	function s2_noitcnuf_enilni_od( &$v, $vs ){
		// print_pre( s2_aaaaaaaotb('ZG9faW5saW5lX2Z1bmN0aW9u') );
		// print_pre( $v );
		// print_pre( $vs ); 
		// exit;
		$rt = true;
		$inputs = $vs['d']['inputs'];
		if( $v['t'] == s2_aaaaaaaotb('Tg==') ){
			foreach( $inputs as $i=>$j ){

			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0') ){
				return $this->s2_eeulav_teg($inputs['p2']['v']);
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRk') ){
				$add = $this->s2_eeulav_teg( $inputs['p2']['v'] );
				$v['v']+=$add['v'];
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3Q=') ){
				$add = $this->s2_eeulav_teg( $inputs['p2']['v'] );
				$v['v']-=$add['v'];
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('cm91bmQ=') ){
				$de = $this->s2_eeulav_teg( $inputs['p2']['v'] );
				$v['v'] = round( (float)$v['v'], (int)$de );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('Zmxvb3I=') ){
				$v['v'] = floor((float)$v['v']);
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('Y2VpbA==') ){
				$v['v'] = ceil((float)$v['v']);
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('cGFyc2VJbnQ=') ){
				$v['v'] = (int)$v['v'];
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('Y29udmVydFRvVGV4dA==') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), 'v'=>(string)$v['v']];
			}
			if( $vs['v'] == s2_aaaaaaaotb('dGV4dFBhZGRpbmc=') ){
				$mm = $this->s2_eeulav_teg($inputs['p4']['v'])['v'];
				if( $mm == s2_aaaaaaaotb('TGVmdA==') ){$m = STR_PAD_LEFT;}else
				if( $mm == s2_aaaaaaaotb('UmlnaHQ=') ){$m = STR_PAD_RIGHT;}else
				if( $mm == s2_aaaaaaaotb('Q2VudGVy') ){$m = STR_PAD_BOTH;}else{$m = STR_PAD_RIGHT;}
				$v['v'] = str_pad( $v['v'], (int)($this->s2_eeulav_teg($inputs['p2']['v'])['v']), $this->s2_eeulav_teg($inputs['p3']['v'])['v'], $m );
				$v['t'] = s2_aaaaaaaotb('VA==');
				return $v;
			}
		}else if( $v['t'] == s2_aaaaaaaotb('VA==') ){
			foreach( $inputs as $i=>$j ){}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0') ){
				return $this->s2_eeulav_teg($inputs['p2']['v']);
			}
			if( $vs['v'] == s2_aaaaaaaotb('dG9Mb3dlckNhc2U=') ){
				$v['v'] = strtolower($v['v']);return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('dG9VcHBlckNhc2U=') ){
				$v['v'] = strtoupper($v['v']);return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('dHJpbQ==') ){
				$v['v'] = trim($v['v']);return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('bWF0Y2hQYXR0ZXJu') ){
				$rt = $this->s2_eeulav_teg( $inputs['p3']['v'] )['v'];
				preg_match( $this->s2_eeulav_teg( $inputs['p2']['v'] )['v'], $v['v'], $m );
				if( $m ){
					if( $rt == s2_aaaaaaaotb('dHJ1ZQ==') ){
						return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>true];
					}else if( $rt == s2_aaaaaaaotb('TGlzdA==') ){
						for($i=0;$i<sizeof($m);$i++){
							$m[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$m[ $i ]];
						}
						return ['t'=>s2_aaaaaaaotb('TA=='), s2_aaaaaaaotb('dg==')=>$m];
					}else if( $rt == "$0" ){
						return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$m[0]];
					}else if( $rt == "$1" ){
						return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$m[1]];
					}else if( $rt == "$2" ){
						return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$m[2]];
					}
				}else{
					if( $rt == s2_aaaaaaaotb('dHJ1ZQ==') ){
						return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>false];
					}else{
						return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>""];
					}
				}
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2VhcmNoUGF0dGVybg==') ){
				$rt = $this->s2_eeulav_teg( $inputs['p3']['v'] )['v'];
				$reg = $this->s2_eeulav_teg( $inputs['p2']['v'] )['v'];
				preg_match_all( $reg, $v['v'], $m );
				if( is_array($m) ){
					for($i=0;$i<sizeof($m);$i++){
						$mm = [];
						for($j=0;$j<sizeof($m[ $i ]);$j++){
							$mm[ $j ] = ['t'=>'T', 'v'=>$m[ $i ][ $j ]];
						}
						$m[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('TA=='), s2_aaaaaaaotb('dg==')=>$mm];
					}
				}else{
					$m = [];
				}
				return ['t'=>s2_aaaaaaaotb('TA=='), s2_aaaaaaaotb('dg==')=>$m];
			}
			if( $vs['v'] == s2_aaaaaaaotb('aXNOdW1lcmlj') ){
				if( preg_match("/^[0-9\.]+$/", $v['v']) ){
					return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>true];
				}else{
					return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>false];
				}
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3ViU3RyaW5n') ){
				$i = $this->s2_eeulav_teg( $inputs['p2']['v'] )['v'];
				$s = $this->s2_eeulav_teg( $inputs['p3']['v'] )['v'];
				return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>substr($v['v'],$i,$s) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('YXBwZW5k') ){
				for($i=2;$i<=5;$i++){
					if( $inputs['p'.$i]['v'] ){
						$v['v'] .= $this->s2_eeulav_teg( $inputs['p'.$i]['v'] )['v'];
					}
				}
				return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$v['v'] ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('cHJlcGVuZA==') ){
				$i = $this->s2_eeulav_teg( $inputs['p2']['v'] )['v'];
				return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$i . $v['v'] ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('bGVuZ3Ro') ){
				return ['t'=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>strlen($v['v']) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Y2xlYW4=') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>preg_replace("/[\W]/", "",$v['v']) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Y29udmVydFRvTnVtYmVy') ){
				$v['v'] = preg_replace("/[^0-9\.]+/", "",$v['v']);
				if( preg_match("/\./", $v['v'] ) ){
					return ['t'=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>(float)$v['v']  ];
				}else{
					return ['t'=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>(int)$v['v']  ];
				}
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3BsaXQ=') ){
				$d = $this->s2_eeulav_teg( $inputs['p2']['v'] )['v'];
				$l = $this->s2_eeulav_teg( $inputs['p3']['v'] )['v'];
				if( !preg_match("/^\/(.*)\/$/", $d) ){
					$d = "/" . $d . "/";
				}
				$this->s2_ggggggggol[] = "regex: " . $d;
				$parts = preg_split( ($d??""),($v['v']??""),($l??-1) );
				for($i=0;$i<sizeof($parts);$i++){
					$parts[$i] = ['t'=>s2_aaaaaaaotb('VA=='), 'v'=>$parts[$i]];
				}
				return ['t'=>s2_aaaaaaaotb('TA=='), 'v'=>$parts ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('cmVwbGFjZQ==') ){
				$f = $this->s2_eeulav_teg( $inputs['p2']['v'] )['v'];
				$r = $this->s2_eeulav_teg( $inputs['p3']['v'] )['v'];
				$v['v'] = str_replace( $f, $r, $v['v'] );
				return $v;
			}
		}else if( $v['t'] == s2_aaaaaaaotb('TA==') ){
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0') ){
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0') ){
				$v = $this->s2_eeulav_teg($inputs['p2']['v']);
				return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>true];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0SXRlbQ==') ){
				$val = $this->s2_eeulav_teg($inputs['p2']['v']);
				return $v['v'][ $val['v'] ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('aW5zZXJ0') ){
				$index = $this->s2_eeulav_teg($inputs['p2']['v']);
				$item = $this->s2_eeulav_teg($inputs['p3']['v']);
				array_splice($v['v'], (int)$index['v'], 0, [$item]);
				return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>true];
			}
			if( $vs['v'] == s2_aaaaaaaotb('cmVtb3Zl') ){
				$index = $this->s2_eeulav_teg($inputs['p2']['v']);
				return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>array_splice($v['v'], (int)$index['v'], 1)];
			}
			if( $vs['v'] == s2_aaaaaaaotb('cG9w') ){
				return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>array_splice($v['v'], sizeof($v['v'])-1, 1 ) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('YXBwZW5k') || $vs['v'] == s2_aaaaaaaotb('cHVzaA==') ){
				$val = $this->s2_eeulav_teg($inputs['p2']['v']);
				$v['v'][] = $val;
				return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>true];
			}
			if( $vs['v'] == s2_aaaaaaaotb('cHJlcGVuZA==') ){
				$val = $this->s2_eeulav_teg($inputs['p2']['v']);
				array_splice($v['v'],0,0,[$val]);
				return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>true];
			}
			if( $vs['v'] == s2_aaaaaaaotb('bGVuZ3Ro') ){
				return ['t'=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>sizeof($v['v'])];
			}
		}else if( $v['t'] == s2_aaaaaaaotb('Tw==') ){
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0') ){
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0') ){
				$v = $this->s2_eeulav_teg($inputs['p2']['v']);
				return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>true];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0S2V5') ){
				$val = $this->s2_eeulav_teg($inputs['p2']['v']);
				if( !isset( $v['v'][ $val['v'] ] ) ){
					$this->s2_ggggggggol[] = "Key: " . $val['v'] . s2_aaaaaaaotb('IG5vdCBmb3VuZA==');
					return [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>""];
				}
				return $v['v'][ $val['v'] ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0S2V5TGlzdA==') ){
				$val = array_keys($v['v']);
				$this->s2_tcejbo_ot_tupni($val);
				return ['t'=>s2_aaaaaaaotb('TA=='), s2_aaaaaaaotb('dg==')=>$val ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0S2V5') ){
				$key = $this->s2_eeulav_teg( $inputs['p2']['v'] );
				$item  = $this->s2_eeulav_teg( $inputs['p3']['v'] );
				$v['v'][ $key['v'] ] = $item;
				return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>true];
			}
			if( $vs['v'] == s2_aaaaaaaotb('cmVtb3ZlS2V5') ){
				$key = $this->s2_eeulav_teg($inputs['p2']['v']);
				unset( $v['v'][ $key['v'] ] );
				return ['t'=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>true];
			}
		}else if( $v['t'] == s2_aaaaaaaotb('Qg==') ){
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0') ){
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0') ){
				$v = $this->s2_eeulav_teg($inputs['p2']['v']);
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0VHJ1ZQ==') ){
				$v['v'] = true;
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0RmFsc2U=') ){
				$v['v'] = false;
				return $v;
			}
		}else if( $v['t'] == s2_aaaaaaaotb('RA==') ){
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0') ){
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0') ){
				$v['v'] = $this->s2_eeulav_teg($inputs['p2']['v']);
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0VmFsdWU=') ){
				$y = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$m = $this->s2_eeulav_teg($inputs['p3']['v'])['v'];
				$d = $this->s2_eeulav_teg($inputs['p4']['v'])['v'];
				$v['v'] = date(s2_aaaaaaaotb('WS1tLWQ='), mktime(12,12,12,$m,$d,$y));
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF0ZQ==') ){
				return ['t'=>s2_aaaaaaaotb('Tg=='), date(s2_aaaaaaaotb('ZA=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0TW9udGg=') ){
				return ['t'=>s2_aaaaaaaotb('Tg=='), date(s2_aaaaaaaotb('bQ=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0WWVhcg==') ){
				return ['t'=>s2_aaaaaaaotb('Tg=='), date(s2_aaaaaaaotb('WQ=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0TW9udGhGdWxs') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), date(s2_aaaaaaaotb('TQ=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0TW9udGhTaG9ydA==') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), date(s2_aaaaaaaotb('Rg=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF5RnVsbA==') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), date(s2_aaaaaaaotb('bA=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF5U2hvcnQ=') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), date(s2_aaaaaaaotb('RA=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF5c1RpbGw=') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v']);
				$date1 = new DateTime($v['v']);
				$date2 = new DateTime($d['v']);
				$interval = $date1->diff($date2);
				return ['t'=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>$interval->days ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF5c1VudGls') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v']);
				$date2 = new DateTime($v['v']);
				$date1 = new DateTime($d['v']);
				$interval = $date1->diff($date2);
				return ['t'=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>$interval->days ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF5c1RpbGxUb2RheQ==') ){
				$date1 = new DateTime(s2_aaaaaaaotb('bm93'));
				$date2 = new DateTime($v['v']);
				$interval = $date1->diff($date2);
				return ['t'=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>$interval->days ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF5c1VudGlsVG9kYXk=') ){
				$date2 = new DateTime(s2_aaaaaaaotb('bm93'));
				$date1 = new DateTime($v['v']);
				$interval = $date1->diff($date2);
				return ['t'=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>$interval->days ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0Rm9ybWF0') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				if( $d == "dd/mm/yyyy" ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date("d/m/Y", strtotime($v['v']) ) ];
				}else if( $d == "mm/dd/yyyy" ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date("m/d/Y", strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('ZGQtbW0teXl5eQ==') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('ZC1tLVk='), strtotime($v['v']) ) ];
				}else if( $d == "yyyy/mm/dd" ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date("Y/m/d", strtotime($v['v']) ) ];
				}else if( $d == "yyyy/dd/mm" ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date("Y/d/m", strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('eXl5eS1tbS1kZA==') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('WS1tLWQ='), strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('eXl5eS1tbS1kZA==') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('WS1tLWQ='), strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('ZGQtbW0teXl5eQ==') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('ZC1tLVk='), strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('ZGQtTU0teXl5eQ==') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('ZC1GLVk='), strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('ZGQgTU0geXl5eQ==') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('ZCBGIFk='), strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('eXl5eSBNTSBkZA==') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('WSBGIGQ='), strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('eXl5eS1NTS1kZA==') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('WS1GLWQ='), strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('ZGQtTS15eXl5') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('ZC1NLVk='), strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('ZGQgTSB5eXl5') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('ZCBNIFk='), strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('eXl5eSBNIGRk') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('WSBNIGQ='), strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('eXl5eS1NLWRk') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('WS1NLWQ='), strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('ZGQgREQgTU0geXl5eQ==') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('ZCBEIEYgWQ=='), strtotime($v['v']) ) ];
				}else if( $d == s2_aaaaaaaotb('eXl5eSBERCBkZCBNTQ==') ){
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>date(s2_aaaaaaaotb('WSBkIEQgRg=='), strtotime($v['v']) ) ];
				}else{
					return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$v['v']];
				}
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkRGF5cw==') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date(s2_aaaaaaaotb('WS1tLWQ='), strtotime($v['v'])+ (86400*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkTW9udGhz') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date(s2_aaaaaaaotb('WS1tLWQ='), strtotime($v['v'])+ (86400*30*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkWWVhcnM=') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date(s2_aaaaaaaotb('WS1tLWQ='), strtotime($v['v'])+ (86400*365*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3REYXlz') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date(s2_aaaaaaaotb('WS1tLWQ='), strtotime($v['v'])- (86400*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3RNb250aHM=') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date(s2_aaaaaaaotb('WS1tLWQ='), strtotime($v['v'])- (86400*30*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3RZZWFycw==') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date(s2_aaaaaaaotb('WS1tLWQ='), strtotime($v['v'])- (86400*365*$d) );
				return $v;
			}
		}else if( $v['t'] == s2_aaaaaaaotb('RFQ=') ){
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0') ){
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0') ){
				$v['v'] = $this->s2_eeulav_teg($inputs['p2']['v']);
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0VmFsdWU=') ){
				$y =  $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$m =  $this->s2_eeulav_teg($inputs['p3']['v'])['v'];
				$d =  $this->s2_eeulav_teg($inputs['p4']['v'])['v'];
				$h =  $this->s2_eeulav_teg($inputs['p5']['v'])['v'];
				$i =  $this->s2_eeulav_teg($inputs['p6']['v'])['v'];
				$s =  $this->s2_eeulav_teg($inputs['p7']['v'])['v'];
				$tz = $this->s2_eeulav_teg($inputs['p8']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", mktime(12,12,12,$m,$d,$y));
				$v['tz'] = $tz;
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF0ZQ==') ){
				return ['t'=>s2_aaaaaaaotb('Tg=='), date(s2_aaaaaaaotb('ZA=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0TW9udGg=') ){
				return ['t'=>s2_aaaaaaaotb('Tg=='), date(s2_aaaaaaaotb('bQ=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0WWVhcg==') ){
				return ['t'=>s2_aaaaaaaotb('Tg=='), date(s2_aaaaaaaotb('WQ=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0TW9udGhGdWxs') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), date(s2_aaaaaaaotb('TQ=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0TW9udGhTaG9ydA==') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), date(s2_aaaaaaaotb('Rg=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF5RnVsbA==') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), date(s2_aaaaaaaotb('bA=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF5U2hvcnQ=') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), date(s2_aaaaaaaotb('RA=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0VGltZVpvbmU=') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$v['tz'] ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0VGltZVpvbmU=') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v']);
				$v['ts'] = $d['v'];
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkRGF5cw==') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])+ (86400*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkTW9udGhz') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])+ (86400*30*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkWWVhcnM=') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])+ (86400*365*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkSG91cnM=') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])+ (60*60*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkTWludXRlcw==') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])+ (60*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkU2Vjb25kcw==') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])+ ($d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3REYXlz') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])- (86400*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3RNb250aHM=') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])- (86400*30*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3RZZWFycw==') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])- (86400*365*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3RIb3Vycw==') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v']) - (60*60*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3RNaW51dGVz') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v']) - (60*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3RTZWNvbmRz') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v']) - ($d) );
				return $v;
			}
		}else if( $v['t'] == s2_aaaaaaaotb('VFM=') ){
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0') ){
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0') ){
				$v['v'] = $this->s2_eeulav_teg($inputs['p2']['v']);
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0VmFsdWU=') ){
				$y =  $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$m =  $this->s2_eeulav_teg($inputs['p3']['v'])['v'];
				$d =  $this->s2_eeulav_teg($inputs['p4']['v'])['v'];
				$h =  $this->s2_eeulav_teg($inputs['p5']['v'])['v'];
				$i =  $this->s2_eeulav_teg($inputs['p6']['v'])['v'];
				$s =  $this->s2_eeulav_teg($inputs['p7']['v'])['v'];
				$tz = $this->s2_eeulav_teg($inputs['p8']['v'])['v'];
				$v['v'] = mktime(12,12,12,$m,$d,$y);
				$v['tz'] = $tz;
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF0ZQ==') ){
				return ['t'=>s2_aaaaaaaotb('Tg=='), date(s2_aaaaaaaotb('ZA=='), (int)$v['v']) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0TW9udGg=') ){
				return ['t'=>s2_aaaaaaaotb('Tg=='), date(s2_aaaaaaaotb('bQ=='), (int)$v['v']) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0WWVhcg==') ){
				return ['t'=>s2_aaaaaaaotb('Tg=='), date(s2_aaaaaaaotb('WQ=='), (int)$v['v']) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0TW9udGhGdWxs') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), date(s2_aaaaaaaotb('TQ=='), (int)$v['v']) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0TW9udGhTaG9ydA==') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), date(s2_aaaaaaaotb('Rg=='), (int)$v['v']) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF5RnVsbA==') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), date(s2_aaaaaaaotb('bA=='), (int)$v['v']) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0RGF5U2hvcnQ=') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), date(s2_aaaaaaaotb('RA=='), (int)$v['v']) ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('Z2V0VGltZVpvbmU=') ){
				return ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$v['tz'] ];
			}
			if( $vs['v'] == s2_aaaaaaaotb('c2V0VGltZVpvbmU=') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v']);
				$v['ts'] = $d['v'];
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkRGF5cw==') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']+ (86400*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkTW9udGhz') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']+ (86400*30*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkWWVhcnM=') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']+ (86400*365*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkSG91cnM=') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']+ (60*60*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkTWludXRlcw==') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']+ (60*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('YWRkU2Vjb25kcw==') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']+ ($d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3REYXlz') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']- (86400*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3RNb250aHM=') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']- (86400*30*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3RZZWFycw==') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']- (86400*365*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3RIb3Vycw==') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v'] - (60*60*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3RNaW51dGVz') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v'] - (60*$d) );
				return $v;
			}
			if( $vs['v'] == s2_aaaaaaaotb('c3VidHJhY3RTZWNvbmRz') ){
				$d = $this->s2_eeulav_teg($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v'] - ($d) );
				return $v;
			}
		}
		return $rt;
	}
	function s2_hhhhtam_od( $s2_sssssssshr ){
		$v = 0;
		$op = "+";
		foreach( $s2_sssssssshr as $i=>$j ){
			if( $op == "+" ){
				$v = $v + $this->s2_bus_htam_od( $j['m'] );
			}else if( $op == s2_aaaaaaaotb('LQ==') ){
				$v = $v - $this->s2_bus_htam_od( $j['m'] );
			}else if( $op == "/" ){
				$v = $v / $this->s2_bus_htam_od( $j['m'] );
			}else if( $op == "*" ){
				$v = $v * $this->s2_bus_htam_od( $j['m'] );
			}else if( $op == "%" ){
				$v = $v % $this->s2_bus_htam_od( $j['m'] );
			}else if( $op == "^" ){
				$v = $v ^ $this->s2_bus_htam_od( $j['m'] );
			}
			$op = $j['OP'];
			//echo $v . ": " . $op . " : \n";
			if( $op == s2_aaaaaaaotb('Lg==') ){break;}
		}
		return $v;
	}
	function s2_bus_htam_od( $s2_sssssssshr ){
		$v = 0;
		$op = "+";
		foreach( $s2_sssssssshr as $i=>$j ){
			$vv = $this->s2_eeulav_teg($j);
			if( $vv['t'] != s2_aaaaaaaotb('Tg==') ){
				$this->s2_ggggggggol[] = "Warning: Math: non numeric operand: " . ($j['v'] == s2_aaaaaaaotb('Vg==')?$j['v']['t'].":".$j['v']['v']:$j['t'].":".$j['v']);
			}
			$vv['v'] = $this->s2_rebmun_ot_gnirts($vv['v']);
			//echo $vv['v'] . s2_aaaaaaaotb('IA==') . $op . " \n";
			if( $op == "+" ){
				$v = $v + $vv['v'];
			}else if( $op == s2_aaaaaaaotb('LQ==') ){
				$v = $v - $vv['v'];
			}else if( $op == "/" ){
				$v = $v / $vv['v'];
			}else if( $op == "*" ){
				$v = $v * $vv['v'];
			}else if( $op == "%" ){
				$v = $v % $vv['v'];
			}else if( $op == "^" ){
				$v = $v ^ $vv['v'];
			}
			$op = $j['OP'];
			if( $op == s2_aaaaaaaotb('Lg==') ){break;}
		}
		//echo "ret: " . $v . ": \n";
		return $v;
	}
	function s2_rebmun_ot_gnirts($v){
		if( gettype($v) == s2_aaaaaaaotb('c3RyaW5n') ){
			if( is_numeric($v) ){
				if( preg_match("/\./",$v) ){
					return (float)$v;
				}else{
					return (int)$v;
				}
			}else{
				$this->s2_ggggggggol[] = "Numeric expected: ". $v;
				return 0;
			}
		}else if( gettype($v) == s2_aaaaaaaotb('aW50ZWdlcg==') || gettype($v) == s2_aaaaaaaotb('ZmxvYXQ=') || gettype($v) == s2_aaaaaaaotb('ZG91Ymxl') ){
			return $v;
		}else{
			$this->s2_ggggggggol[] = "Numeric expected: ". gettype($v) . ": ". $v;
			return 0;
		}
	}
	function s2_tcejbo_ot_tupni( &$d ){
		if( array_keys($d)[0] === 0 ){
			for($i=0;$i<sizeof($d);$i++){
				$j = $d[$i];
				if( gettype($j) == s2_aaaaaaaotb('YXJyYXk=') ){
					$this->s2_tcejbo_ot_tupni($j);
					if( array_keys($j)[0] === 0 ){
						$d[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('TA=='), s2_aaaaaaaotb('dg==')=>$j];
					}else{
						$d[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Tw=='), s2_aaaaaaaotb('dg==')=>$j];
					}
				}else if( gettype($j) == s2_aaaaaaaotb('c3RyaW5n') ){
					$d[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$j];
				}else if( gettype($j) == s2_aaaaaaaotb('ZG91Ymxl') || gettype($j) == s2_aaaaaaaotb('ZmxvYXQ=') || gettype($j) == s2_aaaaaaaotb('aW50ZWdlcg==') ){
					$d[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>$j];
				}else if( gettype($j) == s2_aaaaaaaotb('Ym9vbGVhbg==') ){
					$d[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>$j];
				}else if( gettype($j) == s2_aaaaaaaotb('TlVMTA==') ){
					$d[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Tkw='), s2_aaaaaaaotb('dg==')=>null];
				}
			}
		}else{
			foreach( $d as $i=>$j ){
				if( gettype($j) == s2_aaaaaaaotb('YXJyYXk=') ){
					$this->s2_tcejbo_ot_tupni($j);
					if( array_keys($j)[0] === 0 ){
						$d[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('TA=='), s2_aaaaaaaotb('dg==')=>$j];
					}else{
						$d[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Tw=='), s2_aaaaaaaotb('dg==')=>$j];
					}
				}else if( gettype($j) == s2_aaaaaaaotb('c3RyaW5n') ){
					$d[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$j];
				}else if( gettype($j) == s2_aaaaaaaotb('ZG91Ymxl') || gettype($j) == s2_aaaaaaaotb('ZmxvYXQ=') || gettype($j) == s2_aaaaaaaotb('aW50ZWdlcg==') ){
					$d[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>$j];
				}else if( gettype($j) == s2_aaaaaaaotb('Ym9vbGVhbg==') ){
					$d[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Qg=='), s2_aaaaaaaotb('dg==')=>$j];
				}else if( gettype($j) == s2_aaaaaaaotb('TlVMTA==') ){
					$d[ $i ] = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Tkw='), s2_aaaaaaaotb('dg==')=>null];
				}
			}
		}
		//return $d;
	}
	function s2_yarra_ot_atad_cigol_trevnoc( $d ){
		foreach( $d as $i=>$j ){
			if( preg_match("/(\.|\-\>)/", $i) ){
				$x = explode(s2_aaaaaaaotb('Lg=='),$i);
				if( sizeof($x) == 1 ){
					$d[ $x[0] ] = $j;
				}else if( sizeof($x) == 2 ){
					$d[ $x[0] ][ $x[1] ] = $j;
				}else if( sizeof($x) == 3 ){
					$d[ $x[0] ][ $x[1] ][ $x[2] ] = $j;
				}else if( sizeof($x) == 4 ){
					$d[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ] = $j;
				}else if( sizeof($x) == 5 ){
					$d[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ] = $j;
				}else if( sizeof($x) == 6 ){
					$d[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ][ $x[6] ] = $j;
				}else if( sizeof($x) == 7 ){
					$d[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ][ $x[6] ][ $x[7] ] = $j;
				}else if( sizeof($x) == 8 ){
					$d[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ][ $x[6] ][ $x[7] ][ $x[8] ] = $j;
				}
				unset($d[$i]);			
			}
		}
		return $d;
	}
	
	function s2_tluser_tes( $key, $v ){
		if( is_object($v) ){
			return 0;
		}else if( is_string($key) ){
			$var = $key;
		}else if( is_array($key) && isset($key['v']) && isset($key['t']) ){
			if( is_object($key['v']) ){
				return 0;
			}
			if( $key['t'] != s2_aaaaaaaotb('Vg==') ){
				$this->s2_ggggggggol[] = "ERROR: set_result: incorrect key.: " . print_r($key,true);
				return false;
			}
			$var = $key['v']['v'];
		}else{
			$this->s2_ggggggggol[] = "ERROR: set_result: incorrect key..: " . print_r($key,true);
			return 0;
		}
		if( !isset($v) ){
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('SW5wdXQgTWlzc2luZw==');
		}else{
			if( !is_array($v) ){
				$this->s2_ggggggggol[] = "Warning: " . $var . s2_aaaaaaaotb('IEludmFsaWQgQXNzaWdubWVudA==');
				$v = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Tg=='),s2_aaaaaaaotb('dg==')=>0];
			}else if( $v['t'] == s2_aaaaaaaotb('Tg==') ){
				if( $v['v'] != "" ){
					if( is_float($v['v']) && ( is_infinite($v['v']) || is_nan($v['v']) ) ){
						$this->s2_ggggggggol[] = "Warning: " . $var . " = Infinate/Nan: 0";
						$v = [s2_aaaaaaaotb('dA==')=>s2_aaaaaaaotb('Tg=='),s2_aaaaaaaotb('dg==')=>0];
					}else if( is_float($v['v']) ){
						$v['v'] = (float)$v['v'];
					}else{
						//echo gettype($v['v']); echo s2_aaaaaaaotb('eWVz');
						$v['v'] = (int)$v['v'];
					}
				}else{
					$v['v'] = 0;
				}
			}
			if( gettype($v['t']) == s2_aaaaaaaotb('QklO') ){
				$this->s2_ggggggggol[] = "Set: " . $var . " = BinaryData";
			}else if( gettype($v['v']) == s2_aaaaaaaotb('YXJyYXk=') ){
				$this->s2_ggggggggol[] = "Set: " . $var  . " = ";
				$this->s2_ggggggggol[] = $v['v'];
			}else if( gettype($v['v']) == s2_aaaaaaaotb('b2JqZWN0') ){
				$this->s2_ggggggggol[] = "Set: " . $var  . " = Object ";
			}else if( gettype($v['v']) == s2_aaaaaaaotb('c3RyaW5n') || $v['t'] == s2_aaaaaaaotb('VA==') ){
				if( $this->isBinary($v['v']) ){
					$this->s2_ggggggggol[] = "Set: " . $var . " = BinaryData in " . $v['t'];
				}else{
					$this->s2_ggggggggol[] = "Set: " . $var . " = " . substr($v['v'],0,200) . (strlen($v['v'])>200?s2_aaaaaaaotb('Li4u'):"" );
				}
			}else{
				$this->s2_ggggggggol[] = "Set: " . $var . " = " . $v['v'];
			}
			$x = explode("->",$var);
			$k = $this->s2_2tluser_tes( $x, $this->s2_tttttluser, $v );
			if( !$k ){ $this->s2_ggggggggol[] = "Set: Fail "; }
		}
	}
	function s2_2tluser_tes( $x, &$r, $v ){
		//print_r( $x ); print_r( $r );
		$key = $x[0];
		if( isset($r[ $key ]) ){
			if( sizeof($x) > 1 ){
				if( $r[ $key ]['t'] == s2_aaaaaaaotb('Tw==') ){
					array_splice($x,0,1);
					return $this->s2_2tluser_tes($x, $r[ $key ]['v'], $v);
				}else{
					return false;
				}
			}else{
				$r[ $key ] = $v;
				//$r[ $key ]['t'] = $v['t'];
				return true;
			}
		}else{ 
			$r[ $key ] = $v;
			return true;
		}
	}
	function s2_noisses_tes( $i, $v ){
		if( $i ){
			if( is_infinite($v) || is_nan($v) ){
				$this->s2_ggggggggol[] = "Assign: " . $i  . " = Infinate/Nan: 0";
				$v = 0;
			}else{
				if( gettype($v) == s2_aaaaaaaotb('c3RyaW5n') ){
					$v = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $v);  // rpelace all non printable chars
				}
				if( gettype($v) == s2_aaaaaaaotb('YXJyYXk=') || gettype($v) == s2_aaaaaaaotb('b2JqZWN0') ){
					$this->s2_ggggggggol[] = "Set: " . $i  . " = ";
					$this->s2_ggggggggol[] = $v;
				}else if( gettype($v) == s2_aaaaaaaotb('c3RyaW5n') ){
					$this->s2_ggggggggol[] = "Set: " . $i  . " = " . substr($v,0,500) . (strlen($v)>500?s2_aaaaaaaotb('Li4u'):"" );
				}else{
					$this->s2_ggggggggol[] = "Set: " . $i  . " = " . $v;
				}
			}
			$x = explode("->",$i);
			if( sizeof($x) == 2 ){ //http.set_session_value
				$_SESSION[ $x[1] ] = $v;
			}else if( sizeof($x) == 3 ){
				$_SESSION[ $x[1] ][ $x[2] ] = $v;
			}else if( sizeof($x) == 4 ){
				$_SESSION[ $x[1] ][ $x[2] ][ $x[4] ] = $v;
			}else if( sizeof($x) == 5 ){
				$_SESSION[ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ] = $v;
			}else if( sizeof($x) == 6 ){
				$_SESSION[ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ][ $x[6] ] = $v;
			}else if( sizeof($x) == 7 ){
				$_SESSION[ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ][ $x[6] ][ $x[7] ] = $v;
			}else if( sizeof($x) == 8 ){
				$_SESSION[ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ][ $x[6] ][ $x[7] ][ $x[8] ] = $v;
			}
		}
		return $v;
	}
	function s2_tluser_tesnu( $i ){
		if( $i ){
			$x = explode("->",$i);
			if( sizeof($x) == 1 ){
				unset( $this->s2_tttttluser[ $x[0] ] );
			}else if( sizeof($x) == 2 ){
				unset( $this->s2_tttttluser[ $x[0] ][ $x[1] ] );
			}else if( sizeof($x) == 3 ){
				unset( $this->s2_tttttluser[ $x[0] ][ $x[1] ][ $x[2] ] );
			}else if( sizeof($x) == 4 ){
				unset( $this->s2_tttttluser[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ] );
			}else if( sizeof($x) == 5 ){
				unset( $this->s2_tttttluser[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ] );
			}else if( sizeof($x) == 6 ){
				unset( $this->s2_tttttluser[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ][ $x[6] ] );
			}else if( sizeof($x) == 7 ){
				unset( $this->s2_tttttluser[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ][ $x[6] ][ $x[7] ] );
			}else if( sizeof($x) == 8 ){
				unset( $this->s2_tttttluser[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ][ $x[6] ][ $x[7] ][ $x[8] ] );
			}
		}
		return $v;
	}
	function s2_eeulav_tes( &$k ){
		//print_pre( $k );exit;
		$var = $k['v'];
		$x = explode("->",$var);
		$v = $this->s2_2eulav_tes( $x, $this->s2_tttttluser, $k );
	}
	function s2_2eulav_tes( $x, &$r, &$k ){
		// print_pre( $x );
		// print_pre( $r );
		$key = $x[0];
		if( isset($r[ $key ]) ){
			if( sizeof($x) > 1 ){
				array_splice($x,0,1);
				if( $r[ $key ]['t'] == s2_aaaaaaaotb('Tw==') ){
					$this->s2_2eulav_tes( $x, $r[ $key ]['v'], $k);
				}
			}else{
				$this->s2_noitcnuf_enilni_od( $r[ $key ], $k['vs'] );
			}
		}
	}
	function s2_eulav_glp_tes( &$k ){
		//print_pre( $k );exit;
		$var = $k['v'];
		$x = explode("->",$var);
		$v = $this->s2_2eulav_glp_tes( $x, $this->s2_tttttluser, $k );
	}
	function s2_2eulav_glp_tes( $x, &$r, &$k ){
		// print_pre( $x );
		// print_pre( $r );
		$key = $x[0];
		if( isset($r[ $key ]) ){
			if( is_object($r[ $key ]) ){
				$this->s2_noitcnuf_glp_od( $r[ $key ], $k['vs'] );
			}else if( sizeof($x) > 1 ){
				array_splice($x,0,1);
				if( $r[ $key ]['t'] == s2_aaaaaaaotb('Tw==') ){
					$this->s2_2eulav_glp_tes( $x, $r[ $key ]['v'], $k);
				}
			}else{
				$this->s2_noitcnuf_glp_od( $r[ $key ], $k['vs'] );
			}
		}
	}
	function s2_eulav_glp_teg( $s2_iiiiiiiiii ){
		//print_r( $s2_iiiiiiiiii );exit;
		if( !is_array($s2_iiiiiiiiii) ){
			$v = ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>""];
			if( $s2_iiiiiiiiii ){
				$x = explode("->",$s2_iiiiiiiiii);
				//print_pre( $x );
				$v = $this->s2_2eulav_glp_teg( $x, $this->s2_tttttluser );
				//print_pre( $v );exit;
			}
			if( !isset($v['t']) || !isset($v['v']) ){
				$this->s2_ggggggggol[] = "Error: Variable " . $s2_iiiiiiiiii . s2_aaaaaaaotb('IEludmFsaWQgdmFsdWU=');
				$v = ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>""];
			}else{
				return $v;
			}
			return $v;
		}else if( $s2_iiiiiiiiii['t'] && isset($s2_iiiiiiiiii['v']) ){
			if( $s2_iiiiiiiiii['t']==s2_aaaaaaaotb('Vg==') ){
				$val = $this->s2_eulav_glp_teg( $s2_iiiiiiiiii['v']['v'] );
				if( isset( $s2_iiiiiiiiii['v']['vs']['v'] ) ){
					if( $s2_iiiiiiiiii['v']['vs']['v'] != "" ){
						$newval = $this->s2_noitcnuf_glp_od( $val, $s2_iiiiiiiiii['v']['vs'], $s2_iiiiiiiiii['v']['v'] );
						return $newval;
					}
				}
				return $val;
			}else{
				$val = $s2_iiiiiiiiii['v'];
				if( $s2_iiiiiiiiii['t'] == s2_aaaaaaaotb('Tg==') && gettype($val) == s2_aaaaaaaotb('c3RyaW5n') ){
					if( preg_match("/\./", $val) ){ $val = (float)$val; }else{ $val = (int)$val; }
					//echo $s2_iiiiiiiiii['t'] . ": " . $val . "\n";
				}
				return [s2_aaaaaaaotb('dA==')=>$s2_iiiiiiiiii['t'], s2_aaaaaaaotb('dg==')=>$val];
			}
		}else{
			$this->s2_ggggggggol[] = "ERROR: get_value: incorrect: ";
			$v = ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>""];
			return $v;
		}
	}
	function s2_2eulav_glp_teg( $x, &$r ){
		// echo "get value2 \n";
		// print_pre( $x );
		// print_pre( $r );
		$key = $x[0];
		if( $key == "[]" ){ $key = 0; }
		if( isset($r[ $key ]) ){
			if( sizeof($x) > 1 ){
				array_splice($x,0,1);
				if( $r[ $key ]['t'] == s2_aaaaaaaotb('Tw==') ){
					return $this->s2_2eulav_glp_teg($x, $r[ $key ]['v']);
				}else if( $r[ $key ]['t'] == s2_aaaaaaaotb('TA==') ){
					return $this->s2_2eulav_glp_teg($x, $r[ $key ]['v']);
				}else{
					return false;
				}
			}else{
				return $r[ $key ];
			}
		}else{
			return false;
		}
	}
	function s2_eeulav_teg( $s2_iiiiiiiiii ){
		//print_r( $s2_iiiiiiiiii );exit;
		if( !is_array($s2_iiiiiiiiii) ){
			$v = ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>""];
			if( $s2_iiiiiiiiii ){
				$x = explode("->",$s2_iiiiiiiiii);
				//print_pre( $x );
				$v = $this->s2_2eulav_teg( $x, $this->s2_tttttluser );
				//print_pre( $v );exit;
			}
			if( !isset($v['t']) || !isset($v['v']) ){
				$this->s2_ggggggggol[] = "Error: Variable " . $s2_iiiiiiiiii . s2_aaaaaaaotb('IEludmFsaWQgdmFsdWU=');
				$v = ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>""];
			}else{
				return $v;
			}
			return $v;
		}else if( $s2_iiiiiiiiii['t'] && isset($s2_iiiiiiiiii['v']) ){
			//echo "get value\n" ; print_pre( $s2_iiiiiiiiii );
			if( $s2_iiiiiiiiii['t']==s2_aaaaaaaotb('Vg==') ){
				if( $s2_iiiiiiiiii['v']['plg'] ){
					//echo "get plg value: \n";
					$val = $this->s2_eulav_glp_teg( $s2_iiiiiiiiii['v']['v'] );
					//print_pre($val);
					if( isset( $s2_iiiiiiiiii['v']['vs']['v'] ) ){
						if( $s2_iiiiiiiiii['v']['vs']['v'] != "" ){
							//echo "do plg function: " . $s2_iiiiiiiiii['v']['vs']['v'] . "\n";
							$newval = $this->s2_noitcnuf_glp_od( $val, $s2_iiiiiiiiii['v']['vs'], $s2_iiiiiiiiii['v']['v'] );
							//echo "returning 2: \n"; print_pre( $new_value );
							return $newval;
						}
					}
					//echo "returning: \n"; print_pre( $val );
					return $val;
				}else{
					//print_pre( $s2_iiiiiiiiii['v']['v'] );
					$val = $this->s2_eeulav_teg( $s2_iiiiiiiiii['v']['v'] );
					//print_pre($val);
					if( isset( $s2_iiiiiiiiii['v']['vs']['v'] ) ){
						//echo s2_aaaaaaaotb('MTEx') . $s2_iiiiiiiiii['v']['vs']['v'] . s2_aaaaaaaotb('MTExMQ==');
						if( trim($s2_iiiiiiiiii['v']['vs']['v']) != "" ){
							$newval = $this->s2_noitcnuf_enilni_od( $val, $s2_iiiiiiiiii['v']['vs'], $s2_iiiiiiiiii['v']['v'] );
							return $newval;
						}
					}	
					//echo "returning: \n"; print_pre( $val );
					return $val;
				}
			}else{
				$val = $s2_iiiiiiiiii['v'];
				if( $s2_iiiiiiiiii['t'] == s2_aaaaaaaotb('Tg==') && gettype($val) == s2_aaaaaaaotb('c3RyaW5n') ){
					if( preg_match("/\./", $val) ){ $val = (float)$val; }else{ $val = (int)$val; }
					//echo $s2_iiiiiiiiii['t'] . ": " . $val . "\n";
				}
				//echo "returning: \n"; print_pre( $val );
				return [s2_aaaaaaaotb('dA==')=>$s2_iiiiiiiiii['t'], s2_aaaaaaaotb('dg==')=>$val];
			}
		}else{
			$this->s2_ggggggggol[] = "ERROR: get_value: incorrect: ";
			$v = ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>""];
			return $v;
		}
	}
	function s2_2eulav_teg( $x, &$r ){
		// echo "get value2 \n";
		// print_pre( $x );
		// print_pre( $r );
		$key = $x[0];
		if( $key == "[]" ){ $key = 0; }
		if( isset($r[ $key ]) ){
			if( sizeof($x) > 1 ){
				array_splice($x,0,1);
				if( $r[ $key ]['t'] == s2_aaaaaaaotb('Tw==') ){
					return $this->s2_2eulav_teg($x, $r[ $key ]['v']);
				}else if( $r[ $key ]['t'] == s2_aaaaaaaotb('TA==') ){
					return $this->s2_2eulav_teg($x, $r[ $key ]['v']);
				}else{
					return false;
				}
			}else{
				return $r[ $key ];
			}
		}else{
			return false;
		}
	}
	function s2_ttttttessi( $s2_iiiiiiiiii ){
		$s2_vvvvvvvvvv = "";
		if( is_array($s2_iiiiiiiiii) ){
			if( $s2_iiiiiiiiii['t'] && isset($s2_iiiiiiiiii['v']) ){
				if( $s2_iiiiiiiiii['t'] == s2_aaaaaaaotb('Vg==') ){
					$s2_vvvvvvvvvv = $s2_iiiiiiiiii['v'];
				}else{
					return true;
				}
			}else{
				return false;
			}
		}else if( is_string($s2_iiiiiiiiii) ){
			$s2_vvvvvvvvvv = $s2_iiiiiiiiii;
		}
		if( $s2_vvvvvvvvvv ){
			//print_pre( $this->s2_tttttluser );
			$x = explode("->", $s2_vvvvvvvvvv);
			return $this->s2_22222tessi( $x, $this->s2_tttttluser );
		}
		return false;
	}
	function s2_22222tessi( $x, $r ){
		$key = $x[0];
		if( isset($r[ $key ]) ){
			if( sizeof($x) > 1 ){
				array_splice($x,0,1);
				if( $r[ $key ]['t'] == s2_aaaaaaaotb('Tw==') ){
					return $this->s2_22222tessi($x, $r[ $key ]['v']);
				}else{
					return false;
				}
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
	function s2_rorre_dnopser( $error ){
		if( isset($this->s2_ssssnoitpo['raw_output']) ){
			return ['status'=>s2_aaaaaaaotb('ZmFpbA=='),s2_aaaaaaaotb('ZXJyb3I=')=>$error];
		}else{
			$this->s2_eeesnopser['statusCode'] = 500;
			$this->s2_eeesnopser['body'] = [$error];
			return $this->s2_eeesnopser;
		}
	}
	function s2_tluser_naelc($v){
		foreach($v as $i=>$j ){
			if( gettype($j) == s2_aaaaaaaotb('YXJyYXk=') ){
				$v[$i] = $this->s2_tluser_naelc($j);
			}else if( gettype($j) == s2_aaaaaaaotb('ZmxvYXQ=') || gettype($j) == s2_aaaaaaaotb('ZG91Ymxl') ){
				if( is_infinite($j) ){
					$v[$i] = s2_aaaaaaaotb('TlVMTA==');
				}
			}else if( is_nan($j) ){
				$v[$i] = s2_aaaaaaaotb('TlVMTA==');
			} 
		}
		//print_pre( $v );
		return $v;
	}
	function s2_dnepool_txen_dnif( $s2_iiiiegatsf ){
		$n = 0;
		for($i=$s2_iiiiegatsf+1;$i<sizeof($this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages']);$i++){
			if( $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][ $i ]['type'] == s2_aaaaaaaotb('RW5kV2hpbGU=') ||  $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][ $i ]['type'] == s2_aaaaaaaotb('RW5kRm9y') || $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][ $i ]['type'] == s2_aaaaaaaotb('RW5kRm9yRWFjaA==') ){
				return $i;
			}
		}
		return $s2_iiiiegatsf+1;
	}
	function s2_dnar_txen_dnif( $s2_iiiiegatsf ){
		$lastif = -1;
		$n = 0;
		$vrand = $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][ $s2_iiiiegatsf ]['vrand'];
		for($i=$s2_iiiiegatsf+1;$i<sizeof($this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages']);$i++){
			if( $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][ $i ]['vrand'] == $vrand ){
				$lastif = $i;
				break;
			}
		}
		return $lastif;
	}
	function s2_dnar_verp_dnif( $s2_iiiiegatsf ){
		$lastif = -1;
		$n = 0;
		$vrand = $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][ $s2_iiiiegatsf ]['vrand'];
		for($i=$s2_iiiiegatsf-1;$i>-1;$i--){
			//print_pre($this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages']);
			if( $this->s2_eeeeenigne[s2_aaaaaaaotb('ZW5naW5l')]['stages'][ $i ]['vrand'] == $vrand ){
				$lastif = $i;
				break;
			}
		}
		//echo "lastif = ".$lastif. "<br>";
		return $lastif;
	}
	function s2_stuptuo_pam( $value, $template ){
		if( 1==15 ){
			print_pre($value);
			print_pre($template);
			exit;
		}
		$outputs = [];
		foreach( $template as $i=>$j ){
			//echo "<div>" . $i . ": " . $j['name'] . "</div>";
			if( $value[ $i ] || is_numeric($value[$i]) ){
				if( $j[s2_aaaaaaaotb('dmFsdWU=')] ){
					$outputs[ $j[s2_aaaaaaaotb('dmFsdWU=')] ] = $value[$i];
				}else if( $j[s2_aaaaaaaotb('c3Vi')] ){
					$o = $this->s2_stuptuo_pam( $value[$i], $j[s2_aaaaaaaotb('c3Vi')] );
					foreach( $o as $ii=>$jj ){
						$outputs[ $ii ] = $jj;
					}
				}
			}
		}
		return $outputs;
	}

	function s2_eman_tupni_teg( $v, $enclose = true ){
		if( $enclose ){
			return "[".$v."]";
		}else{
			return $v;
		}
	}

	function s2_yarra_ot_etalpmet_eulav_yek( $v ){
		$vv = [];
		if( is_array($v) ){
			if( array_keys($v)[0] === 0 ){
				for($i=0;$i<sizeof($v);$i++){
					$vv[ $v[$i]['k']['v'] ] = $this->s2_eulav_erup_teg( $v[$i]['v'] );
				}
			}
		}
		return $vv;
	}

	function s2_yarra_ot_etalpmet( $v ){
		// echo "template to array\n";
		// print_pre( $v );
		if( is_array($v) ){
			if( array_keys($v)[0] === 0 ){
				for($i=0;$i<sizeof($v);$i++){
					$j = $v[ $i ];
					if( gettype($j) == s2_aaaaaaaotb('YXJyYXk=') ){
						if( $j['t'] == s2_aaaaaaaotb('Vg==') ){
							$j = $this->s2_eeulav_teg( $j );
						}
						if( gettype($j['v']) == s2_aaaaaaaotb('c3RyaW5n') ){
							if( $this->isBinary($j['v']) ){
								$j['v'] = s2_aaaaaaaotb('QmluYXJ5IFN0cmlwcGVk');
							}
						}
						if( $j['t'] == s2_aaaaaaaotb('Tw==') || $j['t'] == s2_aaaaaaaotb('TA==') ){
							$v[ $i ] = $this->s2_yarra_ot_etalpmet( $j['v'] );
						}else if( $j['t'] == s2_aaaaaaaotb('Tg==') ){
							if( gettype($j['v']) == s2_aaaaaaaotb('c3RyaW5n') ){
								if( preg_match("/\./", $j['v']) ){
									$v[ $i ] = (float)$j['v'];
								}else{
									$v[ $i ] = (int)$j['v'];
								}
							}else{
								$v[ $i ] = $j['v'];
							}
						}else if( $j['t'] == s2_aaaaaaaotb('RFQ=') ){
							$v[ $i ] = $j['v']['v'] . s2_aaaaaaaotb('IA==') . $j['v']['tz'];
						}else if( $j['t'] == s2_aaaaaaaotb('Qg==') ){
							$v[ $i ] = ((!$j['v']||$j['v']==s2_aaaaaaaotb('ZmFsc2U='))?false:true);
						}else if( $j['t'] == s2_aaaaaaaotb('Tkw=') ){
							$v[ $i ] = null;
						}else{
							$v[ $i ] = $j['v'];
						}
					}else{
						$this->s2_ggggggggol[] = "ERROR: template_to_array: incorrect item: " . $j; 
					}
				}
			}else{
				foreach( $v as $i=>$j ){
					//echo "Each key: " . $i . "\n";
					if( gettype( $j ) == s2_aaaaaaaotb('YXJyYXk=') ){
						if( $j['t'] == s2_aaaaaaaotb('Vg==') ){
							$j = $this->s2_eeulav_teg( $j );
							//print_pre($j);
						}
						if( gettype($j['v']) == s2_aaaaaaaotb('c3RyaW5n') ){
							if( $this->isBinary($j['v']) ){
								$j['v'] = s2_aaaaaaaotb('QmluYXJ5IFN0cmlwcGVk');
							}
						}
						if( $j['t'] == s2_aaaaaaaotb('Tw==') || $j['t'] == s2_aaaaaaaotb('TA==') ){
							$v[ $i ] = $this->s2_yarra_ot_etalpmet( $j['v'] );
							//print_pre( $v[ $i ] );
							//echo s2_aaaaaaaotb('eHh4');exit;
						}else if( $j['t'] == s2_aaaaaaaotb('Tg==') ){
							if( gettype($j['v']) == s2_aaaaaaaotb('c3RyaW5n') ){
								if( preg_match("/\./", $j['v']) ){
									$v[ $i ] = (float)$j['v'];
								}else{
									$v[ $i ] = (int)$j['v'];
								}
							}else{
								$v[ $i ] = $j['v'];
							}
						}else if( $j['t'] == s2_aaaaaaaotb('Qg==') ){
							$v[ $i ] = ((!$j['v']||$j['v']==s2_aaaaaaaotb('ZmFsc2U='))?false:true);
						}else if( $j['t'] == s2_aaaaaaaotb('RFQ=') ){
							$v[ $i ] = $j['v']['v'] . s2_aaaaaaaotb('IA==') . $j['v']['tz'];
						}else if( $j['t'] == s2_aaaaaaaotb('Tkw=') ){
							$v[ $i ] = null;
						}else{
							$v[ $i ] = $j['v'];
						}
					}else{
						$this->s2_ggggggggol[] = "Error: unhandled parts " .$j;
						//echo s2_aaaaaaaotb('VW5oYW5kbGVkIHBhcnRz');
						//print_pre( $j );
						$v[ $i ] = ['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$j . "(Unhandled)"];
					}
				}
			}
		}else{
			$this->s2_ggggggggol[] = "template to array: " . gettype($v);
		}
		// echo "template to array returning...\n";
		// print_pre( $v );
		return $v;
	}
	function s2_etutitsbus_ot_etalpmet( $v ){
		// echo "template to array\n";
		// print_pre( $v );
		if( is_array($v) ){
			if( array_keys($v)[0] === 0 ){
				for($i=0;$i<sizeof($v);$i++){
					$j = $v[ $i ];
					if( gettype($j) == s2_aaaaaaaotb('YXJyYXk=') ){
						if( $j['t'] == s2_aaaaaaaotb('Vg==') ){
							$v[ $i ] = $this->s2_eeulav_teg( $j );
						}else if( $j['t'] == s2_aaaaaaaotb('Tw==') || $j['t'] == s2_aaaaaaaotb('TA==') ){
							$v[ $i ]['v'] = $this->s2_etutitsbus_ot_etalpmet( $j['v'] );
						}
						if( gettype($v[ $i ]['v']) == s2_aaaaaaaotb('c3RyaW5n') ){
							if( $this->isBinary($v[ $i ]['v']) ){
								$v[ $i ]['v'] = s2_aaaaaaaotb('QmluYXJ5IFN0cmlwcGVk');
							}
						}
					}else{
						$this->s2_ggggggggol[] = "ERROR: template_to_substitute: incorrect item: " . $j; 
					}
				}
			}else if( isset($v['t']) && isset($v['v']) ){
				$v = $this->s2_eeulav_teg($v);
				print_pre( $v );
			}else{
				foreach( $v as $i=>$j ){
					//echo "Each key: " . $i . "\n";
					if( gettype($j) == s2_aaaaaaaotb('YXJyYXk=') ){
						if( $j['t'] == s2_aaaaaaaotb('Vg==') ){
							$v[ $i ] = $this->s2_eeulav_teg( $j );
						}else if( $j['t'] == s2_aaaaaaaotb('Tw==') || $j['t'] == s2_aaaaaaaotb('TA==') ){
							$v[ $i ]['v'] = $this->s2_etutitsbus_ot_etalpmet( $j['v'] );
						}
						if( gettype($v[ $i ]['v']) == s2_aaaaaaaotb('c3RyaW5n') ){
							if( $this->isBinary($v[ $i ]['v']) ){
								$v[ $i ]['v'] = s2_aaaaaaaotb('QmluYXJ5IFN0cmlwcGVk');
							}
						}
					}else{
						$this->s2_ggggggggol[] = "ERROR: template_to_substitute: incorrect item: " . $j; 
					}
				}
			}
		}else{
			$this->s2_ggggggggol[] = "template_to_substitute: " . gettype($v);
		}
		// echo "template to array returning...\n";
		// print_pre( $v );
		return $v;
	}
	function s2_eulav_erup_teg( $j ){
		if( $j['t'] == s2_aaaaaaaotb('Vg==') ){
			$j = $this->s2_eeulav_teg( $j );
		}
		if( gettype($j['v']) == s2_aaaaaaaotb('c3RyaW5n') ){
			if( $this->isBinary($j['v']) ){
				$j['v'] = s2_aaaaaaaotb('QmluYXJ5IFN0cmlwcGVk');
			}
		}
		if( $j['t'] == s2_aaaaaaaotb('Tw==') || $j['t'] == s2_aaaaaaaotb('TA==') ){
			$v = $this->s2_yarra_ot_etalpmet( $j['v'] );
		}else if( $j['t'] == s2_aaaaaaaotb('Tg==') ){
			if( gettype($j['v']) == s2_aaaaaaaotb('c3RyaW5n') ){
				if( preg_match("/\./", $j['v']) ){
					$v = (float)$j['v'];
				}else{
					$v = (int)$j['v'];
				}
			}else{
				$v = $j['v'];
			}
		}else if( $j['t'] == s2_aaaaaaaotb('Qg==') ){
			$v = ((!$j['v']||$j['v']==s2_aaaaaaaotb('ZmFsc2U='))?false:true);
		}else if( $j['t'] == s2_aaaaaaaotb('RFQ=') ){
			$v = $j['v']['v'] . s2_aaaaaaaotb('IA==') . $j['v']['tz'];
		}else if( $j['t'] == s2_aaaaaaaotb('Tkw=') ){
			$v = null;
		}else{
			$v = $j['v'];
		}
		return $v;
	}
	function s2_yarra_ot_etalpmet_atad_ognom( $v ){
		// echo "template to array\n";
		// print_pre( $v );
		$s2_aaaaaaatad = [];
		for($i=0;$i<sizeof($v);$i++){
			$j = $v[ $i ];
			$val = $j['v'];
			$val = $this->s2_eulav_erup_teg($val);
			$s2_aaaaaaatad[ str_replace("->", s2_aaaaaaaotb('Lg=='), $j['f']['v'] ) ] = $val;
		}
		return $s2_aaaaaaatad;
	}
	function s2_yarra_ot_etalpmet_tcejorp_ognom( $v ){
		// echo "template to array\n";
		// print_pre( $v );
		$s2_aaaaaaatad = [];
		for($i=0;$i<sizeof($v);$i++){
			$j = $v[ $i ];
			$val = $j['v']['v'];
			$s2_aaaaaaatad[ str_replace("->", s2_aaaaaaaotb('Lg=='), $j['f']['v'] ) ] = ($val==s2_aaaaaaaotb('dHJ1ZQ==')||$val===true?true:false);
		}
		return $s2_aaaaaaatad;
	}
	function s2_yarra_ot_etalpmet_tros_ognom( $v ){
		// echo "template to array\n";
		// print_pre( $v );
		$s2_aaaaaaatad = [];
		for($i=0;$i<sizeof($v);$i++){
			$j = $v[ $i ];
			$val = $j['v']['v'];
			$s2_aaaaaaatad[ str_replace("->", s2_aaaaaaaotb('Lg=='), $j['f']['v'] ) ] = ($val==s2_aaaaaaaotb('LTE=')||$val===-1?-1:1);
		}
		return $s2_aaaaaaatad;
	}
	function s2_yarra_ot_etalpmet_yreuq_ognom( $v ){
		// echo "template to array\n";
		// print_pre( $v );
		$s2_dddddddnoc = [];

		for($i=0;$i<sizeof($v);$i++){
			$j = $v[$i];
			$j['f']['v'] = str_replace("->", s2_aaaaaaaotb('Lg=='), $j['f']['v']);
			if( $j['v']['t'] == s2_aaaaaaaotb('Vg==') ){
				$s2_dddddddnoc[ $j['f']['v'] ] = $this->s2_eulav_erup_teg( $j['v'] );
			}else if( $j['v']['t'] == s2_aaaaaaaotb('TA==') && ( $j['f']['v'] == '$and' || $j['f']['v'] == '$or' ) ){
				$s2_dddddddnoc[ $j['f']['v'] ] = [];
				for($k=0;$k<sizeof($j['v']['v']);$j++){
					$s2_dddddddnoc[ $j['f']['v'] ][] = $this->s2_yarra_ot_etalpmet_yreuq_ognom($j['v']['v'][$k]['v']);
				}
			}else{
				$s2_dddddddnoc[ $j['f']['v'] ] = [];
				if( $j['c']['v'] == '$eq' ){
					$s2_dddddddnoc[ $j['f']['v'] ] = $this->s2_eulav_erup_teg( $j['v'] );
				}else{
					$s2_dddddddnoc[ $j['f']['v'] ][ $j['c']['v'] ] = $this->s2_eulav_erup_teg( $j['v'] );
				}
			}
		}
		return $s2_dddddddnoc;
	}

	function s2_bbbbdognom( $s2_ddddegatsf ){
		global $config_global_engine;
		$s2_ttttttttca = $s2_ddddegatsf['d']['data']['action']['v'];
		$s2_ddddddi_bd = $s2_ddddegatsf['d']['data']['db']['i']['v'];
		$s2_dddi_elbat = $s2_ddddegatsf['d']['data']['table']['i']['v'];
		$s2_aaaaamehcs = $s2_ddddegatsf['d']['data']['schema']['v'];
		$s2_yyyyyyreuq = $s2_ddddegatsf['d']['data']['query']['v'];
		$project = $s2_ddddegatsf['d']['data']['project']['v'];
		$s2_tttttttros = $s2_ddddegatsf['d']['data']['sort']['v'];
		$set = $s2_ddddegatsf['d']['data']['set']['v'];
		$unset = $s2_ddddegatsf['d']['data']['unset']['v'];
		$inc = $s2_ddddegatsf['d']['data']['inc']['v'];
		$output = $s2_ddddegatsf['d']['data']['output']['v'];

		//print_pre( $config_global_engine );exit;

		//print_pre( $s2_ddddegatsf['d'] );exit;

		$s2_sssssserbd = $this->s2_nnnnnnnnoc->find_one( $config_global_engine['config_mongo_prefix'] . s2_aaaaaaaotb('X2RhdGFiYXNlcw=='), ['_id'=>$s2_ddddddi_bd] );
		if( !isset($s2_sssssserbd['data']) ){
			return ['status'=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>s2_aaaaaaaotb('RGF0YWJhc2Ugbm90IGZvdW5k')];
		}else{
			$db = $s2_sssssserbd['data'];
		}
		$tres = $this->s2_nnnnnnnnoc->find_one( $config_global_engine['config_mongo_prefix'] . s2_aaaaaaaotb('X3RhYmxlcw=='), ['_id'=>$s2_dddi_elbat] );
		if( !isset($tres['data']) ){
			return ['status'=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>s2_aaaaaaaotb('RGF0YWJhc2Ugbm90IGZvdW5k')];
		}else{
			$s2_eeeeeelbat = $tres['data'];
		}
		$db['details']['username'] = pass_decrypt($db['details']['username']);
		$db['details']['password'] = pass_decrypt($db['details']['password']);
		//print_pre( $db );exit;
		//print_pre( $s2_eeeeeelbat );exit;

		$mongo_con = new mongodb_connection( $db['details']['host'], $db['details']['port'], $db['details']['database'], $db['details']['username'], $db['details']['password'],$db['details']['authSource'], ($db['details']['tls']?true:false) );

		if( $s2_ttttttttca == s2_aaaaaaaotb('SW5zZXJ0') || $s2_ttttttttca == s2_aaaaaaaotb('SW5zZXJ0T25l') ){
			//print_pre( $set );exit;
			$insert_data = $this->s2_yarra_ot_etalpmet_atad_ognom( $set );
			//print_pre( $insert_data );exit;
			$s2_sssssserbd = $mongo_con->insert( $s2_eeeeeelbat['table'], $insert_data );
			$s2_sssssserbd['insertId'] = $s2_sssssserbd['inserted_id'];unset($s2_sssssserbd['inserted_id']);
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			if( $s2_sssssserbd['status'] == s2_aaaaaaaotb('c3VjY2Vzcw==') ){}
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('RmluZE9uZQ==') ){
			$s2_dddddddnoc = $this->s2_yarra_ot_etalpmet_yreuq_ognom( $s2_yyyyyyreuq );
			$project = $this->s2_yarra_ot_etalpmet_tcejorp_ognom( $project );
			$s2_tttttttros = $this->s2_yarra_ot_etalpmet_tros_ognom( $s2_tttttttros );
			$ops = ['limit'=>(int)$s2_ddddegatsf['d']['data']['limit']['v'] ];
			if( sizeof($s2_tttttttros) ){
				$ops['sort'] = $s2_tttttttros;
			}
			if( sizeof($project) ){
				$ops['projection'] = $project;
			}
			$s2_sssssserbd = $mongo_con->find_one($s2_eeeeeelbat['table'], $s2_dddddddnoc, $ops);
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('REIgY29uZA==');
			$this->s2_ggggggggol[] = $s2_dddddddnoc;
			//$s2_sssssserbd['cond'] = $s2_dddddddnoc;
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('RmluZE1hbnk=') ){
			$s2_dddddddnoc = $this->s2_yarra_ot_etalpmet_yreuq_ognom( $s2_yyyyyyreuq );
			$project = $this->s2_yarra_ot_etalpmet_tcejorp_ognom( $project );
			$s2_tttttttros = $this->s2_yarra_ot_etalpmet_tros_ognom( $s2_tttttttros );
			$ops = ['limit'=>(int)$s2_ddddegatsf['d']['data']['limit']['v'] ];
			if( sizeof($s2_tttttttros) ){
				$ops['sort'] = $s2_tttttttros;
			}
			if( sizeof($project) ){
				$ops['projection'] = $project;
			}
			//print_pre( $ops );exit;
			$s2_sssssserbd = $mongo_con->find($s2_eeeeeelbat['table'], $s2_dddddddnoc, $ops);
			//print_pre( $s2_sssssserbd );exit;
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('REIgY29uZA==');
			$this->s2_ggggggggol[] = $s2_dddddddnoc;
			//$s2_sssssserbd['cond'] = $s2_dddddddnoc;
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('VXBkYXRlT25l') ){
			$s2_dddddddnoc = $this->s2_yarra_ot_etalpmet_yreuq_ognom( $s2_yyyyyyreuq );
			$set =  $this->s2_yarra_ot_etalpmet_atad_ognom( $set );
			$unset= $this->s2_yarra_ot_etalpmet_atad_ognom( $unset );
			$inc =  $this->s2_yarra_ot_etalpmet_atad_ognom( $inc );
			$ops = [];

			$d = [];
			if( $set ){$d['$set'] = $set;}
			if( $unset ){$d['$unset'] = $unset;}
			if( $inc ){$d['$inc'] = $inc;}

			$s2_sssssserbd = $mongo_con->update_one($s2_eeeeeelbat['table'], $s2_dddddddnoc, $d, $ops);
			//print_pre( $s2_sssssserbd );exit;
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('REIgY29uZA==');
			$this->s2_ggggggggol[] = $s2_dddddddnoc;
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('RGF0YQ==');
			$this->s2_ggggggggol[] = $d;
			//$s2_sssssserbd['cond'] = $s2_dddddddnoc;
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('VXBkYXRlTWFueQ==') ){
			$s2_dddddddnoc = $this->s2_yarra_ot_etalpmet_yreuq_ognom( $s2_yyyyyyreuq );
			$set =  $this->s2_yarra_ot_etalpmet_atad_ognom( $set );
			$unset= $this->s2_yarra_ot_etalpmet_atad_ognom( $unset );
			$inc =  $this->s2_yarra_ot_etalpmet_atad_ognom( $inc );
			$ops = ['limit'=>(int)$s2_ddddegatsf['d']['data']['limit']['v'] ];

			$d = [];
			if( $set ){$d['$set'] = $set;}
			if( $unset ){$d['$unset'] = $unset;}
			if( $inc ){$d['$inc'] = $inc;}

			$s2_sssssserbd = $mongo_con->update_one($s2_eeeeeelbat['table'], $s2_dddddddnoc, $d, $ops);
			//print_pre( $s2_sssssserbd );exit;
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('REIgY29uZA==');
			$this->s2_ggggggggol[] = $s2_dddddddnoc;
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('RGF0YQ==');
			$this->s2_ggggggggol[] = $d;
			//$s2_sssssserbd['cond'] = $s2_dddddddnoc;
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('RGVsZXRlT25l') ){
			$s2_dddddddnoc = $this->s2_yarra_ot_etalpmet_yreuq_ognom( $s2_yyyyyyreuq );
			$ops = [];
			$s2_sssssserbd = $mongo_con->delete_one($s2_eeeeeelbat['table'], $s2_dddddddnoc, $ops);
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('REIgY29uZA==');
			$this->s2_ggggggggol[] = $s2_dddddddnoc;
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('VXBkYXRlTWFueQ==') ){
			$s2_dddddddnoc = $this->s2_yarra_ot_etalpmet_yreuq_ognom( $s2_yyyyyyreuq );
			$ops = ['limit'=>(int)$s2_ddddegatsf['d']['data']['limit']['v'] ];
			$s2_sssssserbd = $mongo_con->update_one($s2_eeeeeelbat['table'], $s2_dddddddnoc, $ops);
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('REIgY29uZA==');
			$this->s2_ggggggggol[] = $s2_dddddddnoc;
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
	}

	function table_dynamic( $s2_ddddegatsf ){
		global $config_global_engine;
		$s2_ttttttttca = $s2_ddddegatsf['d']['data']['action']['v'];
		$s2_dddi_elbat = $s2_ddddegatsf['d']['data']['table']['i']['v'];
		$s2_aaaaamehcs = $s2_ddddegatsf['d']['data']['schema']['v'];
		$s2_yyyyyyreuq = $s2_ddddegatsf['d']['data']['query']['v'];
		$project = $s2_ddddegatsf['d']['data']['project']['v'];
		$s2_tttttttros = $s2_ddddegatsf['d']['data']['sort']['v'];
		$set = $s2_ddddegatsf['d']['data']['set']['v'];
		$insert = $this->s2_yarra_ot_etalpmet($this->s2_eeulav_teg($s2_ddddegatsf['d']['data']['insert'])['v']);
		$unset = $s2_ddddegatsf['d']['data']['unset']['v'];
		$inc = $s2_ddddegatsf['d']['data']['inc']['v'];
		$output = $s2_ddddegatsf['d']['data']['output']['v'];

		$tres = $this->s2_nnnnnnnnoc->find_one( $config_global_engine['config_mongo_prefix'] . s2_aaaaaaaotb('X3RhYmxlc19keW5hbWlj'), ['_id'=>$s2_dddi_elbat] );
		if( !isset($tres['data']) ){
			return ['status'=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>s2_aaaaaaaotb('RGF0YWJhc2Ugbm90IGZvdW5k')];
		}else{
			$s2_eeeeeelbat = $tres['data'];
		}

		$s2_eman_elbat = $config_global_engine['config_mongo_prefix'] . s2_aaaaaaaotb('X2R0Xw==') . $s2_eeeeeelbat['_id'];
		//echo $s2_eman_elbat;exit;

		if( $s2_ttttttttca == s2_aaaaaaaotb('SW5zZXJ0') || $s2_ttttttttca == s2_aaaaaaaotb('SW5zZXJ0T25l') ){
			//print_pre( $set );exit;
			//print_pre( $insert );exit;
			$s2_sssssserbd = $this->s2_nnnnnnnnoc->insert( $s2_eman_elbat, $insert );
			$s2_sssssserbd['insertId'] = $s2_sssssserbd['inserted_id'];unset($s2_sssssserbd['inserted_id']);
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			if( $s2_sssssserbd['status'] == s2_aaaaaaaotb('c3VjY2Vzcw==') ){}
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('RmluZE9uZQ==') ){
			$s2_dddddddnoc = $this->s2_yarra_ot_etalpmet_yreuq_ognom( $s2_yyyyyyreuq );
			$project = $this->s2_yarra_ot_etalpmet_tcejorp_ognom( $project );
			$s2_tttttttros = $this->s2_yarra_ot_etalpmet_tros_ognom( $s2_tttttttros );
			$ops = ['limit'=>(int)$s2_ddddegatsf['d']['data']['limit']['v'] ];
			if( sizeof($s2_tttttttros) ){
				$ops['sort'] = $s2_tttttttros;
			}
			if( sizeof($project) ){
				$ops['projection'] = $project;
			}
			$s2_sssssserbd = $this->s2_nnnnnnnnoc->find_one($s2_eman_elbat, $s2_dddddddnoc, $ops);
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('REIgY29uZA==');
			$this->s2_ggggggggol[] = $s2_dddddddnoc;
			//$s2_sssssserbd['cond'] = $s2_dddddddnoc;
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('RmluZE1hbnk=') ){
			$s2_dddddddnoc = $this->s2_yarra_ot_etalpmet_yreuq_ognom( $s2_yyyyyyreuq );
			$project = $this->s2_yarra_ot_etalpmet_tcejorp_ognom( $project );
			$s2_tttttttros = $this->s2_yarra_ot_etalpmet_tros_ognom( $s2_tttttttros );
			$ops = ['limit'=>(int)$s2_ddddegatsf['d']['data']['limit']['v'] ];
			if( sizeof($s2_tttttttros) ){
				$ops['sort'] = $s2_tttttttros;
			}
			if( sizeof($project) ){
				$ops['projection'] = $project;
			}
			//print_pre( $ops );exit;
			$s2_sssssserbd = $this->s2_nnnnnnnnoc->find($s2_eman_elbat, $s2_dddddddnoc, $ops);
			//print_pre( $s2_sssssserbd );exit;
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('REIgY29uZA==');
			$this->s2_ggggggggol[] = $s2_dddddddnoc;
			//$s2_sssssserbd['cond'] = $s2_dddddddnoc;
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('VXBkYXRlT25l') ){
			$s2_dddddddnoc = $this->s2_yarra_ot_etalpmet_yreuq_ognom( $s2_yyyyyyreuq );
			$set =  $this->s2_yarra_ot_etalpmet_atad_ognom( $set );
			$unset= $this->s2_yarra_ot_etalpmet_atad_ognom( $unset );
			$inc =  $this->s2_yarra_ot_etalpmet_atad_ognom( $inc );
			$ops = [];

			$d = [];
			if( $set ){$d['$set'] = $set;}
			if( $unset ){$d['$unset'] = $unset;}
			if( $inc ){$d['$inc'] = $inc;}

			$s2_sssssserbd = $this->s2_nnnnnnnnoc->update_one($s2_eman_elbat, $s2_dddddddnoc, $d, $ops);
			//print_pre( $s2_sssssserbd );exit;
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('REIgY29uZA==');
			$this->s2_ggggggggol[] = $s2_dddddddnoc;
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('RGF0YQ==');
			$this->s2_ggggggggol[] = $d;
			//$s2_sssssserbd['cond'] = $s2_dddddddnoc;
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('VXBkYXRlTWFueQ==') ){
			$s2_dddddddnoc = $this->s2_yarra_ot_etalpmet_yreuq_ognom( $s2_yyyyyyreuq );
			$set =  $this->s2_yarra_ot_etalpmet_atad_ognom( $set );
			$unset= $this->s2_yarra_ot_etalpmet_atad_ognom( $unset );
			$inc =  $this->s2_yarra_ot_etalpmet_atad_ognom( $inc );
			$ops = ['limit'=>(int)$s2_ddddegatsf['d']['data']['limit']['v'] ];

			$d = [];
			if( $set ){$d['$set'] = $set;}
			if( $unset ){$d['$unset'] = $unset;}
			if( $inc ){$d['$inc'] = $inc;}

			$s2_sssssserbd = $this->s2_nnnnnnnnoc->update_one($s2_eman_elbat, $s2_dddddddnoc, $d, $ops);
			//print_pre( $s2_sssssserbd );exit;
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('REIgY29uZA==');
			$this->s2_ggggggggol[] = $s2_dddddddnoc;
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('RGF0YQ==');
			$this->s2_ggggggggol[] = $d;
			//$s2_sssssserbd['cond'] = $s2_dddddddnoc;
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('RGVsZXRlT25l') ){
			$s2_dddddddnoc = $this->s2_yarra_ot_etalpmet_yreuq_ognom( $s2_yyyyyyreuq );
			$ops = [];
			$s2_sssssserbd = $this->s2_nnnnnnnnoc->delete_one($s2_eman_elbat, $s2_dddddddnoc, $ops);
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('REIgY29uZA==');
			$this->s2_ggggggggol[] = $s2_dddddddnoc;
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('VXBkYXRlTWFueQ==') ){
			$s2_dddddddnoc = $this->s2_yarra_ot_etalpmet_yreuq_ognom( $s2_yyyyyyreuq );
			$ops = ['limit'=>(int)$s2_ddddegatsf['d']['data']['limit']['v'] ];
			$s2_sssssserbd = $this->s2_nnnnnnnnoc->update_one($s2_eman_elbat, $s2_dddddddnoc, $ops);
			$this->s2_ggggggggol[] = s2_aaaaaaaotb('REIgY29uZA==');
			$this->s2_ggggggggol[] = $s2_dddddddnoc;
			$this->s2_tcejbo_ot_tupni( $s2_sssssserbd );$s2_sssssserbd = ['t'=>'O', 'v'=>$s2_sssssserbd];
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
	}

	function s2_gnirts_ot_etalpmet_erehw_lqsym($con, $v ){
		$vv = [];
		if( gettype($v)==s2_aaaaaaaotb('YXJyYXk=') ){
			if( array_keys($v)[0] === 0  ){
				foreach($v as $k=>$vd){
					if( $vd['v']['t'] == s2_aaaaaaaotb('Vg==') ){
						$vv[] = "`".$vd['f']['v'] ."`". $vd['c']['v'] ."'". mysqli_escape_string($con, $this->s2_eulav_erup_teg($vd['v']) ) . "'";
					}else if( $vd['v']['t'] == s2_aaaaaaaotb('TA==') ){
						$vv[] = " ( " . $this->s2_gnirts_ot_etalpmet_erehw_lqsym($con, $vd['v']['v']) . " ) ";
					}else{
						$vv[] = "`".$vd['f']['v'] ."`". $vd['c']['v'] ."'". mysqli_escape_string($con, $this->s2_eulav_erup_teg($vd['v']) ) . "'";
					}
					if( $k < sizeof($v) - 1 ){
						$vv[] = $vd['n']['v'];
					}
				}
			}else{ $this->s2_ggggggggol[] = s2_aaaaaaaotb('d2hlcmUgY29uZGl0aW9uIG5vdCBhcnJheQ=='); }
		}else{ $this->s2_ggggggggol[] = "where condition incorrect type: "+ gettype($v); }
		return implode(s2_aaaaaaaotb('IA=='), $vv);
	}
	function s2_gnirts_ot_etalpmet_sdleif_lqsym($v){
		$vv = [];
		if( gettype($v)==s2_aaaaaaaotb('YXJyYXk=') ){
				foreach($v as $k=>$vd){
					$vv[] = $k;
				}
		}else{ $this->s2_ggggggggol[] = "get_fields_notation: incorrect type: " .gettype($v); }
		return implode(", ", $vv );
	}
	function s2_gnirts_ot_etalpmet_tros_lqsym($v){
		$vv = [];
		if( gettype($v)==s2_aaaaaaaotb('YXJyYXk=') ){
			if( array_keys($v)[0] === 0  ){
				foreach($v as $k=>$vd){
					$vv[] = $vd['f']['v'] . ($vd['o']['v']==s2_aaaaaaaotb('RGVzYw==')?s2_aaaaaaaotb('IGRlc2M='):"");
				}
			}else{ $this->s2_ggggggggol[] = "get_fields_notation: not a object "; }
		}else{ $this->s2_ggggggggol[] = "get_fields_notation: incorrect type: " .gettype($v); }
		return implode(", ", $vv );
	}

	function s2_llllllqsym( $s2_ddddegatsf ){
		global $config_global_engine;
		//print_pre( $s2_ddddegatsf );exit;
		$s2_ttttttttca = $s2_ddddegatsf['d']['data']['query']['v'];
		$s2_ddddddi_bd = $s2_ddddegatsf['d']['data']['db']['i']['v'];
		$s2_dddi_elbat = $s2_ddddegatsf['d']['data']['table']['i']['v'];
		$s2_aaaaamehcs = $s2_ddddegatsf['d']['data']['schema']['v'];
		$s2_eeeeeerehw = $s2_ddddegatsf['d']['data']['where']['v'];
		$s2_sssssdleif = $s2_ddddegatsf['d']['data']['fields']['v'];
		$key = $s2_ddddegatsf['d']['data']['key']['v'];
		$value = $s2_ddddegatsf['d']['data']['value']['v'];
		$keys = $s2_ddddegatsf['d']['data']['schema']['keys']['v'];
		$s2_tttttttros = $s2_ddddegatsf['d']['data']['sort']['v'];
		$set = $s2_ddddegatsf['d']['data']['set']['v'];
		$output = $s2_ddddegatsf['d']['data']['output']['v'];

		//print_pre( $config_global_engine );exit;
		//print_pre( $keys );exit;

		$s2_sssssserbd = $this->s2_nnnnnnnnoc->find_one( $config_global_engine['config_mongo_prefix'] . s2_aaaaaaaotb('X2RhdGFiYXNlcw=='), ['_id'=>$s2_ddddddi_bd] );
		if( !isset($s2_sssssserbd['data']) || !$s2_sssssserbd['data'] ){
			return ['status'=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>s2_aaaaaaaotb('RGF0YWJhc2Ugbm90IGZvdW5k')];
		}else{
			$db = $s2_sssssserbd['data'];
		}
		$tres = $this->s2_nnnnnnnnoc->find_one( $config_global_engine['config_mongo_prefix'] . s2_aaaaaaaotb('X3RhYmxlcw=='), ['_id'=>$s2_dddi_elbat] );
		if( !isset($tres['data']) || !$tres['data'] ){
			return ['status'=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>s2_aaaaaaaotb('RGF0YWJhc2Ugbm90IGZvdW5k')];
		}else{
			$s2_eeeeeelbat = $tres['data'];
		}
		$db['details']['username'] = pass_decrypt($db['details']['username']);
		$db['details']['password'] = pass_decrypt($db['details']['password']);
		//print_pre( $db );exit;
		//print_pre( $s2_eeeeeelbat );exit;

		$mysql_con = mysqli_connect( $db['details']['host'], $db['details']['username'], $db['details']['password'], $db['details']['database'], (int)$db['details']['port'] ) ;
		if( mysqli_connect_error() ){
			$this->s2_tluser_tes( $output, [
				'status'=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>"ConnectError:" . mysqli_connect_error()
			] );return false;
		}
		mysqli_options($mysql_con, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, true); 
		mysqli_report(MYSQLI_REPORT_OFF);

		if( $s2_ttttttttca == s2_aaaaaaaotb('SW5zZXJ0') ){
			//print_pre( $set );exit;
			$insert_data = $this->s2_yarra_ot_etalpmet_atad_ognom( $set );
			//print_pre( $insert_data );exit;
			$q = [];
			foreach($insert_data as $i=>$j){
				$q[] = "`" . $i . "` = '" . mysqli_escape_string($mysql_con, $j ) . "' ";
			}
			$s2_yyyyyyreuq = "insert into `" . $s2_eeeeeelbat['table'] . "` \nset " . implode(", \n", $q );
			$s2_sssssssser = mysqli_query( $mysql_con, $s2_yyyyyyreuq);
			if( mysqli_error( $mysql_con) ){
				//echo mysqli_error( $mysql_con);
				$s2_sssssserbd = [
					s2_aaaaaaaotb('c3RhdHVz')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>s2_aaaaaaaotb('ZmFpbA==')],
					s2_aaaaaaaotb('ZXJyb3I=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>mysqli_error($mysql_con) ],
					s2_aaaaaaaotb('cXVlcnk=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$s2_yyyyyyreuq]
				];
				$this->s2_tluser_tes( $output, ['t'=>s2_aaaaaaaotb('Tw=='),'v'=>$s2_sssssserbd] );return false;
			}
			$s2_sssssserbd = [
				s2_aaaaaaaotb('c3RhdHVz')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>s2_aaaaaaaotb('c3VjY2Vzcw==')],
				s2_aaaaaaaotb('ZXJyb3I=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>"" ],
				s2_aaaaaaaotb('cXVlcnk=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$s2_yyyyyyreuq],
				s2_aaaaaaaotb('aW5zZXJ0SWQ=')=>['t'=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>mysqli_insert_id($mysql_con)],
			];
			$this->s2_tluser_tes( $output, ['t'=>s2_aaaaaaaotb('Tw=='),'v'=>$s2_sssssserbd] );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('U2VsZWN0') || $s2_ttttttttca == s2_aaaaaaaotb('U2VsZWN0QXNzb2M=') || $s2_ttttttttca == s2_aaaaaaaotb('U2VsZWN0S2V5VmFsdWU=') ){
			$s2_eeeeeerehw = $this->s2_gnirts_ot_etalpmet_erehw_lqsym($mysql_con, $s2_eeeeeerehw );
			if( $s2_ttttttttca == s2_aaaaaaaotb('U2VsZWN0QXNzb2M=') || $s2_ttttttttca == s2_aaaaaaaotb('U2VsZWN0S2V5VmFsdWU=') ){
				if( !isset($s2_sssssdleif[ $key ]) ){
					$s2_sssssdleif[ $key ] = ['t'=>'T'];
				}
			}
			if( $s2_ttttttttca == s2_aaaaaaaotb('U2VsZWN0S2V5VmFsdWU=') ){
				$s2_sssssdleif = [ $key => ['t'=>'T'], $value => ['t'=>'T'] ];
			}
			$s2_sssssdleif = $this->s2_gnirts_ot_etalpmet_sdleif_lqsym( $s2_sssssdleif );
			$s2_tttttttros = $this->s2_gnirts_ot_etalpmet_tros_lqsym( $s2_tttttttros );
			$key = $s2_ddddegatsf['d']['data']['key']['v'];
			$value = $s2_ddddegatsf['d']['data']['value']['v'];
			$s2_ttttttimil = s2_aaaaaaaotb('bGltaXQg') . (int)$s2_ddddegatsf['d']['data']['limit']['v'];
			$s2_yyyyyyreuq = s2_aaaaaaaotb('c2VsZWN0IA==') . (trim($s2_sssssdleif)?$s2_sssssdleif:"*") . " from `" . $s2_eeeeeelbat['table'] . "` " . (trim($s2_eeeeeerehw)?"\nwhere " . $s2_eeeeeerehw:"") . s2_aaaaaaaotb('IA==') . (trim($s2_tttttttros)?"\norder by " .$s2_tttttttros:"") . " \n" . $s2_ttttttimil;
			$s2_sssssssser = mysqli_query($mysql_con, $s2_yyyyyyreuq);
			$this->s2_ggggggggol[] = $s2_yyyyyyreuq;
			if( mysqli_error( $mysql_con) ){
				//echo mysqli_error( $mysql_con);
				$s2_sssssserbd = [
					s2_aaaaaaaotb('c3RhdHVz')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>s2_aaaaaaaotb('ZmFpbA==')],
					s2_aaaaaaaotb('ZXJyb3I=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>mysqli_error($mysql_con) ],
					s2_aaaaaaaotb('cXVlcnk=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$s2_yyyyyyreuq]
				];
				$this->s2_tluser_tes( $output, ['t'=>s2_aaaaaaaotb('Tw=='),'v'=>$s2_sssssserbd] );return false;
			}
			$rec = [];
			while( $row = mysqli_fetch_assoc($s2_sssssssser) ){
				if( $s2_ttttttttca == s2_aaaaaaaotb('U2VsZWN0QXNzb2M=') ){
					$rec[ $row[ $key ] ] = $row;
				}else if( $s2_ttttttttca == s2_aaaaaaaotb('U2VsZWN0S2V5VmFsdWU=') ){
					$rec[ $row[ $key ] ] = $row[ $value ];
				}else{
					$rec[] = $row;
				}
			}
			$this->s2_tcejbo_ot_tupni( $rec );
			if( $s2_ttttttttca == s2_aaaaaaaotb('U2VsZWN0QXNzb2M=') || $s2_ttttttttca == s2_aaaaaaaotb('U2VsZWN0S2V5VmFsdWU=') ){
				$s2_sssssserbd = ['t'=>s2_aaaaaaaotb('Tw=='),'v'=>[
					s2_aaaaaaaotb('c3RhdHVz')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>s2_aaaaaaaotb('c3VjY2Vzcw==')],
					s2_aaaaaaaotb('ZGF0YQ==')=>['t'=>'O', 'v'=>$rec],
					s2_aaaaaaaotb('Y291bnQ=')=>['t'=>'N', 'v'=>sizeof($rec)],
					s2_aaaaaaaotb('cXVlcnk=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$s2_yyyyyyreuq]
				]];
			}else{
				$s2_sssssserbd = ['t'=>s2_aaaaaaaotb('Tw=='),'v'=>[
					s2_aaaaaaaotb('c3RhdHVz')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>s2_aaaaaaaotb('c3VjY2Vzcw==')],
					s2_aaaaaaaotb('ZGF0YQ==')=>['t'=>'L', 'v'=>$rec],
					s2_aaaaaaaotb('Y291bnQ=')=>['t'=>'N', 'v'=>sizeof($rec)],
					s2_aaaaaaaotb('cXVlcnk=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$s2_yyyyyyreuq]
				]];
			}
			$this->s2_tluser_tes( $output, $s2_sssssserbd );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('VXBkYXRl') ){
			$s2_eeeeeerehw = $this->s2_gnirts_ot_etalpmet_erehw_lqsym($mysql_con, $s2_eeeeeerehw );
			$s2_aaaaaaatad = $this->s2_yarra_ot_etalpmet_atad_ognom( $set );
			$s2_tttttttros = $this->s2_gnirts_ot_etalpmet_tros_lqsym( $s2_tttttttros );
			$s2_ttttttimil = s2_aaaaaaaotb('bGltaXQg') . (int)$s2_ddddegatsf['d']['data']['limit']['v'];
			$q = [];
			foreach($s2_aaaaaaatad as $i=>$j){
				$q[] = "`" . $i . "` = '" . mysqli_escape_string($mysql_con, $j ) . "' ";
			}
			$s2_yyyyyyreuq = "update `" . $s2_eeeeeelbat['table'] .  "` ";
			$s2_yyyyyyreuq .= "\nset " . implode(", \n", $q ) . s2_aaaaaaaotb('IA=='); 
			$s2_yyyyyyreuq .= (trim($s2_eeeeeerehw)?"\nwhere " . $s2_eeeeeerehw:"");
			$s2_yyyyyyreuq .= (trim($s2_tttttttros)?"\norder by " .$s2_tttttttros:"") . " \n" . $s2_ttttttimil;
			$s2_sssssssser = mysqli_query($mysql_con, $s2_yyyyyyreuq);
			$this->s2_ggggggggol[] = $s2_yyyyyyreuq;
			if( mysqli_error( $mysql_con) ){
				//echo mysqli_error( $mysql_con);
				$s2_sssssserbd = [
					s2_aaaaaaaotb('c3RhdHVz')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>s2_aaaaaaaotb('ZmFpbA==')],
					s2_aaaaaaaotb('ZXJyb3I=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>mysqli_error($mysql_con) ],
					s2_aaaaaaaotb('cXVlcnk=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$s2_yyyyyyreuq]
				];
				$this->s2_tluser_tes( $output, ['t'=>s2_aaaaaaaotb('Tw=='),'v'=>$s2_sssssserbd] );
				return false;
			}
			$s2_sssssserbd = [
				s2_aaaaaaaotb('c3RhdHVz')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>s2_aaaaaaaotb('c3VjY2Vzcw==')],
				s2_aaaaaaaotb('ZXJyb3I=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>"" ],
				s2_aaaaaaaotb('cXVlcnk=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$s2_yyyyyyreuq],
				s2_aaaaaaaotb('dXBkYXRlZA==')=>['t'=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>mysqli_affected_rows($mysql_con)],
			];
			$this->s2_tluser_tes( $output, ['t'=>s2_aaaaaaaotb('Tw=='),'v'=>$s2_sssssserbd] );
		}
		if( $s2_ttttttttca == s2_aaaaaaaotb('RGVsZXRl') ){
			$s2_eeeeeerehw = $this->s2_gnirts_ot_etalpmet_erehw_lqsym($mysql_con, $s2_eeeeeerehw );
			$s2_aaaaaaatad = $this->s2_yarra_ot_etalpmet_atad_ognom( $set );
			$s2_tttttttros = $this->s2_gnirts_ot_etalpmet_tros_lqsym( $s2_tttttttros );
			$s2_ttttttimil = s2_aaaaaaaotb('bGltaXQg') . (int)$s2_ddddegatsf['d']['data']['limit']['v'];
			$s2_yyyyyyreuq = "delete from `" . $s2_eeeeeelbat['table'] .  "` ";
			$s2_yyyyyyreuq .= (trim($s2_eeeeeerehw)?"\nwhere " . $s2_eeeeeerehw:"");
			$s2_yyyyyyreuq .= (trim($s2_tttttttros)?"\norder by " .$s2_tttttttros:"") . " \n" . $s2_ttttttimil;
			$s2_sssssssser = mysqli_query($mysql_con, $s2_yyyyyyreuq);
			$this->s2_ggggggggol[] = $s2_yyyyyyreuq;
			if( mysqli_error( $mysql_con) ){
				//echo mysqli_error( $mysql_con);
				$s2_sssssserbd = [
					s2_aaaaaaaotb('c3RhdHVz')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>s2_aaaaaaaotb('ZmFpbA==')],
					s2_aaaaaaaotb('ZXJyb3I=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>mysqli_error($mysql_con) ],
					s2_aaaaaaaotb('cXVlcnk=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$s2_yyyyyyreuq]
				];
				$this->s2_tluser_tes( $output, ['t'=>s2_aaaaaaaotb('Tw=='),'v'=>$s2_sssssserbd] );
				return false;
			}
			$s2_sssssserbd = [
				s2_aaaaaaaotb('c3RhdHVz')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>s2_aaaaaaaotb('c3VjY2Vzcw==')],
				s2_aaaaaaaotb('ZXJyb3I=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>"" ],
				s2_aaaaaaaotb('cXVlcnk=')=>['t'=>s2_aaaaaaaotb('VA=='), s2_aaaaaaaotb('dg==')=>$s2_yyyyyyreuq],
				s2_aaaaaaaotb('ZGVsZXRlZA==')=>['t'=>s2_aaaaaaaotb('Tg=='), s2_aaaaaaaotb('dg==')=>mysqli_affected_rows($mysql_con)],
			];
			$this->s2_tluser_tes( $output, ['t'=>s2_aaaaaaaotb('Tw=='),'v'=>$s2_sssssserbd] );
		}
	}
	function s2_tseuqeRPTTH( $s2_ddddegatsf ){
		global $config_global_engine;
		//print_pre( $s2_ddddegatsf );exit;
		$method = $s2_ddddegatsf['d']['data']['method']['v'];
		$url = $this->s2_eulav_erup_teg($s2_ddddegatsf['d']['data']['url']);
		$contentType = $s2_ddddegatsf['d']['data']['content-type']['v'];
		$reqheaders = $this->s2_yarra_ot_etalpmet_eulav_yek( $s2_ddddegatsf['d']['data']['headers']['v'] );
		$payload = $this->s2_yarra_ot_etalpmet( $s2_ddddegatsf['d']['data']['payload']['v'] );
		$redirects = $s2_ddddegatsf['d']['data']['redirect']['v'];
		$ctime = $s2_ddddegatsf['d']['data']['ctime']['v'];
		$rtime = $s2_ddddegatsf['d']['data']['rtime']['v'];
		$sslverify = $this->s2_eulav_erup_teg($s2_ddddegatsf['d']['data']['sslverify']);
		$twoway = $this->s2_eulav_erup_teg($s2_ddddegatsf['d']['data']['twoway']);
		$sslcert = $this->s2_eulav_erup_teg($s2_ddddegatsf['d']['data']['sslcert']);
		$sslkey = $this->s2_eulav_erup_teg($s2_ddddegatsf['d']['data']['sslkey']);
		$userproxy = $this->s2_eulav_erup_teg($s2_ddddegatsf['d']['data']['userproxy']);
		$proxy = $this->s2_yarra_ot_etalpmet( $s2_ddddegatsf['d']['data']['proxy']['v'] );
		$output = $s2_ddddegatsf['d']['data']['output']['v'];

		if( 1==12 ){
			$k = [
				'method'=>$method,
				'url'=>$url,
				'contentType'=>$contentType,
				'reqheaders'=>$reqheaders,
				'payload'=>$payload,
				'redirects'=>$redirects,
				'ctime'=>$ctime,
				'rtime'=>$rtime,
				'sslverify'=>$sslverify,
				'twoway'=>$twoway,
				'sslcert'=>$sslcert,
				'sslkey'=>$sslkey,
				'userproxy'=>$userproxy,
				'proxy'=>$proxy,
				'output'=>$output,
			];
			echo json_encode($k,JSON_PRETTY_PRINT);exit;
		}

		$ch = curl_init();
		$s2_ssssnoitpo = array(
			CURLOPT_HEADER => 1,
			CURLOPT_URL => $url,
			CURLOPT_CONNECTTIMEOUT=> (int)$ctime,
			CURLOPT_TIMEOUT => (int)$rtime,
			CURLOPT_RETURNTRANSFER =>true,
			CURLOPT_AUTOREFERER=>true,
			CURLOPT_HEADER=>true
		);
		curl_setopt_array($ch, $s2_ssssnoitpo);
		if( $sslverify ){
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true );
		}
		if( $twoway ){
			curl_setopt($ch, CURLOPT_SSLCERT, $sslcert );
			curl_setopt($ch, CURLOPT_SSLKEY, $sslkey );
		}
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method );
		if( $mthod == s2_aaaaaaaotb('UE9TVA==') ){
			curl_setopt($ch, CURLOPT_POST, 1 );
			curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );
		}else{
			curl_setopt($ch, CURLOPT_HTTPGET, 1 );
		}
		if( sizeof($reqheaders) ){
  			curl_setopt($ch, CURLOPT_HTTPHEADER, $reqheaders );
  		}
		$s2_tttttluser = curl_exec($ch);
		$info = curl_getinfo( $ch );
		$error = curl_error( $ch );
		$errorno = curl_errno( $ch );
		curl_close($ch);
		$headers = [];
		$h = "";
		$body = "";
		$content_type="";
		$cookies = [];
		if( $error ){
		}else{
			//print_pre( $info );
			$parts = explode("\r\n\r\n", $s2_tttttluser);
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
					if( strtolower(trim($k[0])) == s2_aaaaaaaotb('Y29udGVudC10eXBl') ){
						$k[1] = trim(explode(";",$k[1])[0]);
						if( !$k[1] ){
							$k[1] = "";
						}
					}
					if( strtolower(trim($k[0])) == s2_aaaaaaaotb('c2V0LWNvb2tpZQ==') ){
						$k[1] = trim(explode(";",$k[1])[0]);
						$ck = explode("=",trim($k[1]));
						$cookies[ $ck[0] ] = trim($ck[1]);
					}else{
						$headers[ strtolower(trim($k[0])) ] = trim($k[1]);
					}
				}
			}
			if( $info[s2_aaaaaaaotb('Y29udGVudF90eXBl')] ){
				$content_type=explode(";",$info[s2_aaaaaaaotb('Y29udGVudF90eXBl')])[0];
			}else{
				$content_type="text/plain";
			}
		}
		$d = [
			'status'=>(int)$info['http_code'],
			s2_aaaaaaaotb('Ym9keQ==')=>$body,
			s2_aaaaaaaotb('ZXJyb3I=')=>$error,
			s2_aaaaaaaotb('Y29udGVudF90eXBl')=>$content_type,
			s2_aaaaaaaotb('dGltZV90YWtlbg==')=>$info['total_time'],
			s2_aaaaaaaotb('c2l6ZQ==')=>(int)$info['size_download'],
			s2_aaaaaaaotb('aGVhZGVycw==')=>$headers,
			s2_aaaaaaaotb('Y29va2llcw==')=>$cookies
		];
		//print_pre( $d );exit;
		$this->s2_tcejbo_ot_tupni($d);
		//print_pre( $d );
		$this->s2_tluser_tes( $output, ['t'=>'O', 'v'=>$d] );
	}
	function s2_llac_noitcnuf_od( $d ){
		global $config_global_engine;
		//print_pre( $d );
		//$this->s2_ggggggggol[] = $this->s2_tttttluser;
		$fn = $d['fn']['v']['i']['v'];
		$fnl = $d['fn']['v']['l']['v'];
		//echo s2_aaaaaaaotb('YmVmb3JlIGZ1bmN0aW9uIGNhbGwg');
		//print_pre( $d['fn']['v']['inputs'] );
		$inputs = [];
		foreach( $d['fn']['v']['inputs']['v'] as $i=>$j ){
			$inputs[ $i ] = $this->s2_eeulav_teg( $j );
		}
		//$inputs = $this->s2_etutitsbus_ot_etalpmet( $d['fn']['v']['inputs'] );
		//print_pre($inputs);exit;
		$return = $d['fn']['v']['return'];
		$s2_sssssssser = $this->s2_nnnnnnnnoc->find_one( $config_global_engine['config_mongo_prefix'] . s2_aaaaaaaotb('X2Z1bmN0aW9uc192ZXJzaW9ucw=='), ['_id'=>$fn] );
		if( !isset($s2_sssssssser['data']) || !$s2_sssssssser['data'] ){
			return ['status'=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>"Function: ".$fnl.s2_aaaaaaaotb('IG5vdCBmb3VuZA==')];
		}else{
			$sub_engine = new api_engine();
			if( !$sub_engine ){
				return ['status'=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>"Function: ".$fnl.": Error initializing function engine"];
			}
			if( $this->s2_level_evisrucer > 50 ){
				return ['status'=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZXJyb3I=')=>"Function: ".$fnl.": Error Max Recursive Limit Reached"];
			}
			$s2_tttttluser = $sub_engine->execute( $s2_sssssssser['data'], $inputs, [
				s2_aaaaaaaotb('cmVxdWVzdF9sb2dfaWQ=')=>$this->s2_di_gol_tseuqer, 
				'raw_output'=>true,
				s2_aaaaaaaotb('cmVjdXJzaXZlX2xldmVs')=>($this->s2_level_evisrucer+1)
			]);
			$this->s2_ggggggggol[] = $sub_engine->getlog();
			if( isset($s2_tttttluser['status']) ){
				if( $s2_tttttluser['status'] == s2_aaaaaaaotb('ZmFpbA==') ){
					if( strpos($s2_tttttluser['error'], "Function: ".$fnl) === 0 ){

					}else{
						$s2_tttttluser['error'] = "Function: ".$fnl.": " . $s2_tttttluser['error'];
					}
				}
				return $s2_tttttluser;
			}
			return ['status'=>s2_aaaaaaaotb('ZmFpbA=='), s2_aaaaaaaotb('ZGF0YQ==')=>"Function: ".$fnl.": Incorrect response: " . json_encode($s2_tttttluser)];
		}
	}
}

function s2_aaaaaaaotb($v){return base64_decode($v);}