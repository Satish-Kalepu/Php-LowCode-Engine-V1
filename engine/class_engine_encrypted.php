<?php

class api_engine{
	public $s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09 = false;
	public $s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09 = [];
	public $s1_T3FMdDFmRUd5cnRHMk55TkFYVjhwQT09 = [];
	public $s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 = [];
	public $s1_Zy9uVWZSTGNCbHI5S3EzTEZsdXhHUT09 = [];
	public $s1_UXZ1eGdJTVhQZE1ZeDZlSHpLeXBOdz09 = [];
	public $s1_UzRuNlp3czBhV2swR1BPSkxFZVgxZz09 = [];
	public $s1_R3hERCs1MXdJaGlvQ0gxQ0ZzZWtQdz09 = "simulate";
	public $s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09 = [];
	public $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09 = [];
	public $s1_VTBtZEVTSHp3SzhyOWNVSzNJMllXQT09 = "";
	public $s1_bGozdGtZSDJIcUM5dE15MENNTWRZQT09 = [];
	public $s1_bmttL01pYVZGK211NysxZTdDQWpxdz09 = 0;
	public $s1_NGh3dHZZTWR5QUdCTUh3VGVLaDJYQT09  = 0;
	public $s1_QVZvTE4zVWNIckk3TVJtTGtZdENodz09 = false;
	public $s1_YWtzNWxzdmxDYlo2aEFleVdOZUl0UT09 = false;
	public $s1_dDd2RG1DTkV0WmhHVjRML2hzOFhYdz09 = "";
	public $s1_MEVhVGN1L3RMRlB3UklaMWowWGNJZz09 = "";
	public $s1_L3RJU1dJUlFXdENqTWl3M2xQUzBFdz09 = 0;
	public $s1_ZWlUYi95ckpvWk10bUxMUWRUcE13Zz09 = "";
	public $s1_S3RMdzk5Y2FsZjcrNkZZZUI0VkIvdz09 = "";
	public $s1_TGtQbFRESGVxVGVFenR5WEM5aUtHdz09 = "";
	public $s1_UXNmcjZIa3I4T2hZbmRBajgra1c0Zz09 = "";
	public $s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09 = [];
	public $s1_VmNYQ3NwUTAvSUpmOXJIeHZtVENyZz09 = [];
	public $s1_bDBwNFNCZjBCYjh4NWcvQW1uS29nQT09 = [];
	public $s1_cUxuaXlybW90SG1GZGtTbHF2N3YyZz09 = 1;
	public $s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09 = [
		"statusCode"=>200,
		"headers"=>[
			"content-type"=>"application/json"
		],
		"body"=>["status"=>"success"],
		"pretty"=>false,
	];

	function __construct(){
		global $mongodb_con;
		$this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09 = $mongodb_con;
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
		if( mb_detect_encoding($str) == btoa('VVRGLTg=') ){ return false; }
		if( mb_detect_encoding($str) == btoa('QVNDSUk=') ){ 
			return preg_match('~[^\x20-\x7E\t\r\n]~', $str) > 0;
			//return true; 
		}
	}
	function execute( $s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09, $s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09, $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09=[] ){
		$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09 = [];
		$this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 = [];
		$this->s1_UXZ1eGdJTVhQZE1ZeDZlSHpLeXBOdz09 = [];
		$this->s1_UzRuNlp3czBhV2swR1BPSkxFZVgxZz09 = [];
		$this->s1_dDd2RG1DTkV0WmhHVjRML2hzOFhYdz09 = "";
		$this->s1_R3hERCs1MXdJaGlvQ0gxQ0ZzZWtQdz09 = btoa('U2ltdWxhdGU=');
		$this->s1_UXNmcjZIa3I4T2hZbmRBajgra1c0Zz09 = btoa('c3VjY2Vzcw==');
		$this->s1_MEVhVGN1L3RMRlB3UklaMWowWGNJZz09 = "";
		$this->s1_VTBtZEVTSHp3SzhyOWNVSzNJMllXQT09 = "";
		$this->s1_L3RJU1dJUlFXdENqTWl3M2xQUzBFdz09 = 0;
		$this->s1_ZWlUYi95ckpvWk10bUxMUWRUcE13Zz09 = "";
		$this->s1_NGh3dHZZTWR5QUdCTUh3VGVLaDJYQT09  = 0;
		$this->s1_bmttL01pYVZGK211NysxZTdDQWpxdz09 = 0;
		$this->s1_YWtzNWxzdmxDYlo2aEFleVdOZUl0UT09 = false;
		$this->s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09 = $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09;
		if( $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09 == false ){
			return $this->s1_NnZrUG1mVkFMcVVXWkZvSzVTYjJDdz09("Error with Database Connection!");
		}
		$this->s1_S3RMdzk5Y2FsZjcrNkZZZUI0VkIvdz09 = $s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09['app']['_id'];
		$this->s1_TGtQbFRESGVxVGVFenR5WEM5aUtHdz09 = $s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09['user_id'];
		$this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09 = $s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09;
		$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['headers']['content-type'] = $s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09['output-type'];
		$this->s1_UXZ1eGdJTVhQZE1ZeDZlSHpLeXBOdz09 = $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')][btoa('aW5wdXRfZmFjdG9ycw==')];
		$this->s1_QVZvTE4zVWNIckk3TVJtTGtZdENodz09 = false;
		
		if( $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09[btoa('cmVxdWVzdF9sb2dfaWQ=')] ){
	        	$this->s1_VTBtZEVTSHp3SzhyOWNVSzNJMllXQT09 = $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['request_log_id'];
		}
		if( $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09[btoa('cmVjdXJzaXZlX2xldmVs')] ){
	        	$this->s1_cUxuaXlybW90SG1GZGtTbHF2N3YyZz09 = $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['recursive_level'];
		}
		if( $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09[btoa('cmVzdWx0')] ){
	        	$this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 = $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['result'];
		}
		if( $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09[btoa('aW5wdXRz')] ){
	        	$this->s1_UXZ1eGdJTVhQZE1ZeDZlSHpLeXBOdz09 = $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['inputs'];
		}
		if( $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09[btoa('b3V0cHV0cw==')] ){
	        	$this->s1_UzRuNlp3czBhV2swR1BPSkxFZVgxZz09 = $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['outputs'];
		}
		if( $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09[btoa('bG9n')] ){
	        	$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09 = $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['log'];
		}
		$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Testing Started: " . date("Y-m-d H:i:s");
		if( $this->s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['raw_output'] ){
			if( isset($s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09['t'])&&isset($s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09['v'])&&$s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09['t']=='O' ){
				$s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09 = $s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09['v'];
			}
		}else if( isset($s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09['t'])&&isset($s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09['v'])&&$s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09['t']=='O'){
			$s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09 = $s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09['v'];
		}else{
			if( $s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09 != null && gettype($s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09) == btoa('YXJyYXk=') ){
				$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09($s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09);
			}
		}
		foreach( $s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09 as $inputi=>$inputv ){if($inputi){
	        	$this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $inputi ] = $inputv;
		}}
		//print_pre( $s1_VmtFdUFtQzl0MTZxTmowako0NTRRZz09 );
		//exit;
		//print_pre( $s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09['engine']['input_factors'] );exit;
		foreach( $s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09['engine']['input_factors'] as $i=>$j ){
			// $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $i ] = [
			// 	btoa('dA==')=>$j['t'],
			// 	btoa('dg==')=>$j['v']
			// ];
			//echo $i . ": " . $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $i ] . btoa('IC0g') ;
			if( $j['m'] && !isset($this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $i ]) ){
				return $this->s1_NnZrUG1mVkFMcVVXWkZvSzVTYjJDdz09("Input: " . $i . btoa('IHJlcXVpcmVk'));
			}
		}
		//$e = false;
		//$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09;
		$s1_SzZkWWZoWGRLMEZ1SnpjTXQwR3pSQT09 = 0;
		if( $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09[btoa('Y3VycmVudF9zcXNfaXRlcmF0aW9u')] ){
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "SQS Iteration: " . $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['current_sqs_iteration'];
			$this->s1_bmttL01pYVZGK211NysxZTdDQWpxdz09 = $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['current_sqs_iteration'];
		}
		if( $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09[btoa('dGFza19xdWV1ZV91cmw=')] ){
			$this->task_queue_url = $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['task_queue_url'];
		}
		if( $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09[btoa('c3RhcnRfZnJvbV9zdGFnZQ==')] ){
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Start from Stage: " . ($s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09[btoa('c3RhcnRfZnJvbV9zdGFnZQ==')]+1);
			$s1_SzZkWWZoWGRLMEZ1SnpjTXQwR3pSQT09 = $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09[btoa('c3RhcnRfZnJvbV9zdGFnZQ==')];
		}
		$s1_R2pkR0tHczF0SHFWRXlxVHNTN1FsUT09 = 0;
		$s1_R1J1aUZnM2dtSzRpYkR6MU9YbUtoQT09=0;
		$s1_SDljK0hvWTZqSGtIWG1iTFhLc2dwZz09=5000;
		$s1_NFVXY0UvVFhMY2ZtNVF4MytYY0Yxdz09=0;
		for($s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09=0;$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09<sizeof($this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages']);$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09++){
			$s1_R1J1aUZnM2dtSzRpYkR6MU9YbUtoQT09++;
			if( $s1_R1J1aUZnM2dtSzRpYkR6MU9YbUtoQT09 >= $s1_SDljK0hvWTZqSGtIWG1iTFhLc2dwZz09 ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Maximum Steps Reached: " . $s1_R1J1aUZnM2dtSzRpYkR6MU9YbUtoQT09;
				break;
			}
			$next_fstaged = $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09+1];
			if( $next_fstaged['type'] == btoa('Rm9yRWFjaA==') ){
				unset($this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09+1]['keys']);
				unset($this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09+1]['keyi']);
			}
			$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 = $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09]; 
			if( $this->s1_QVZvTE4zVWNIckk3TVJtTGtZdENodz09 ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('RW5kIG9mIEV4ZWN1dGlvbg==');
				break;
			}
			if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['t'] == btoa('Yw==') ){
				$d = $s1_R1J1aUZnM2dtSzRpYkR6MU9YbUtoQT09 . ": " . ($s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09+1) . ": " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'];
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('TGV0') ){
					if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['t'] == btoa('Vg==') ){
						$d .= ": ". $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs'] . "= " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['t']. ":" .$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['v']['v'] . ":" . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['v']['t'];
					}else{
						$d .= ": ". $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs'] . "= " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['t']. ":" .$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['v'];
					}
					if( isset($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['v']['vs']) ){
						if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['v']['vs']['v'] ){
							$d .= "->". $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['v']['vs']['v'];
						}
					}
				}
			}else{
				$d = $s1_R1J1aUZnM2dtSzRpYkR6MU9YbUtoQT09 . ": " . ($s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09+1) . ": " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['t'] . ":" . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'];
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['vs']['v'] ){
					$d .= "->" . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['vs']['v'];
				}
			}
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $d;

			//$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09;
			//print_pre( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 );

			if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['t'] == btoa('Yw==') ){
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('TGV0') ){
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs'] . " = " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['t'] . ":" . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['v'];
					$s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs'];
					$s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs'];
					if( preg_match("/\W/", $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09 ) ){
						return $this->s1_NnZrUG1mVkFMcVVXWkZvSzVTYjJDdz09("Line: ".$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 . ": Let variable name should not contain special chars");
					}
					if( $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['t'] == btoa('Vg==') ){
						$v = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09);
						//print_pre( $v );exit;
						//$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $v;
						$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09, $v );
					}else{
						$this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09 ] =$s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09;
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('TGV0Q29tcG9uZW50') ){
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs'] . " = " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['t'];
					$s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs'];
					$s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs'];
					if( preg_match("/\W/", $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09 ) ){
						return $this->s1_NnZrUG1mVkFMcVVXWkZvSzVTYjJDdz09("Line: ".$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 . ": Let variable name should not contain special chars");
					}
					$component = $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v']['i']['v'];
					if( file_exists(btoa('Y2xhc3Nf') . $component . btoa('LnBocA==')) ){
						require_once(btoa('Y2xhc3Nf') . $component . btoa('LnBocA=='));
						$v = new HTTPRequest();
						$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09, [btoa('dA==')=>btoa('Q2xhc3M='), btoa('dg==')=>$v] );
					}else{
						return $this->s1_NnZrUG1mVkFMcVVXWkZvSzVTYjJDdz09("component not found!");
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('QXNzaWdu') ){
					$var = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs']['v']['v'];
					$s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09 = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs']);
					$s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09 = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']);
					if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['t'] != $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['t'] ){
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'];
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Warning: Assign: ". $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['t'] . ":" . $var . " = " . $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['t']. ":";
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'];
					}
					$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $var, $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09 );
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('RXhwcmVzc2lvbl9VbndhbnRlZA==') ){
					$this->s1_VmNYQ3NwUTAvSUpmOXJIeHZtVENyZz09 = [];
					$exp = "(" . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['v'] . ")";
					$exp = preg_replace_callback("/[\(\)\+\-\/\%\*]/", function($m){
						$this->s1_VmNYQ3NwUTAvSUpmOXJIeHZtVENyZz09[] = $m[0];
						return "|e|";
					},$exp);
					$x = explode("|e|", $exp);
					$exp2 = "";
					foreach( $x as $i=>$j ){
						if( trim($j) ){
							if( is_numeric(trim($j) ) ){}else{
								$kv = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09(trim($j));
								if( $kv['t'] == btoa('Tg==') || is_numeric($kv['v']) ){
									$x[$i] = $this->s1_NlhHQUZpczAxZkhodzhranY4ZkhmUT09( $kv['v'] );
								}else{
									$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Error: Expresssion Variable is not Numeric: " . $j . " : " . $kv['t'];
									$x[$i] = btoa('MA==');
								}
							}
						}
						$exp2 .= $x[$i] . $this->s1_VmNYQ3NwUTAvSUpmOXJIeHZtVENyZz09[$i];
					}
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $exp2;
					//echo $exp2;exit;
					$exp2= '$vv='.$exp2. ";";
					try{
						eval($exp2);
					}catch(Exception $ex){
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Expression error: " . $ex->getMessage();
						$vv = 0;
					}
					$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs'], ['t'=>btoa('Tg=='),btoa('dg==')=>$vv] );
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('RXhwcmVzc2lvbg==') ){
					$this->s1_VmNYQ3NwUTAvSUpmOXJIeHZtVENyZz09 = [];
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['v'];
					$exp = "(" . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs']['v'] . ")";
					$exp = preg_replace_callback("/\[([a-z][a-z0-9\-\>\_\ ]*)\]/", function($m){
						$this->s1_VmNYQ3NwUTAvSUpmOXJIeHZtVENyZz09[] = $m[1];
						return "|e|";
					},$exp);
					$x = explode("|e|", $exp);
					$exp2 = "";
					foreach( $x as $i=>$j ){
						if( $i < sizeof($this->s1_VmNYQ3NwUTAvSUpmOXJIeHZtVENyZz09) ){
							$kv = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( trim($this->s1_VmNYQ3NwUTAvSUpmOXJIeHZtVENyZz09[$i]) );
							if( $kv['t'] == btoa('Tg==') || is_numeric($kv['v']) ){
								$kv['v'] = $this->s1_NlhHQUZpczAxZkhodzhranY4ZkhmUT09( $kv['v'] );
							}else{
								$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Error: Expresssion Variable is not Numeric: " . $this->s1_VmNYQ3NwUTAvSUpmOXJIeHZtVENyZz09[$i] . " : " . $kv['t'];
								$x[$i] = btoa('MA==');
							}
							$exp2 .= $j . $kv['v'];
						}else{
							$exp2 .= $j;
						}
					}
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $exp2;
					//echo $exp2;exit;
					$exp2= '$vv='.$exp2. ";";
					try{
						eval($exp2);
					}catch(Exception $ex){
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Expression error: " . $ex->getMessage();
						$vv = 0;
					}
					$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs'], ['t'=>btoa('Tg=='),btoa('dg==')=>$vv] );
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('TWF0aA==') ){
					$s1_ZndEN1F3Z0pBcElycGdaNGE0TmtnUT09v = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs']);
					if( $s1_ZndEN1F3Z0pBcElycGdaNGE0TmtnUT09v['t'] != btoa('Tg==') ){
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Warning: Math: lhs: not numeric";
					}
					$s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['rhs'];
					$s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09 = $this->s1_SG9kbVZtZGQwSG55OUZzNy90MmNMUT09( $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09 );
					$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs'], [btoa('dA==')=>btoa('Tg=='), btoa('dg==')=>$s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09] );
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('SWY=') ){
					$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = true;
					foreach( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['cond'] as $ci=>$cd ){
						$s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09 = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($cd['lhs']);
						$s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09 = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($cd['rhs']);
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('SWYg') . $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['t'].":".$s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] . btoa('IA==') . $cd['op'] . btoa('IA==') . $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['t'].":".$s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'];
						if( $cd['op'] == "==" ){
							if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['t'] == $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['t'] ){
								if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] == $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'] ){}else{$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = false;break; }
							}else{
								$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = false;break;
							}
						}else if( $cd['op'] == "!=" ){
							if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['t'] == $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['t'] ){
								if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] != $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'] ){}else{$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = false;break; }
							}else{
								$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = false;break;
							}
						}else if( $cd['op'] == "<" ){
							if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['t'] == $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['t'] ){
								if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] < $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'] ){}else{$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = false;break; }
							}else{
								$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = false;break;
							}
						}else if( $cd['op'] == "<=" ){
							if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['t'] == $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['t'] ){
								if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] <= $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'] ){}else{$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = false;break; }
							}else{
								$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = false;break;
							}
						}else if( $cd['op'] == ">" ){
							if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['t'] == $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['t'] ){
								if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] > $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'] ){}else{$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = false;break; }
							}else{
								$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = false;break;
							}
						}else if( $cd['op'] == ">=" ){
							if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['t'] == $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['t'] ){
								if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] >= $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'] ){}else{$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = false;break; }
							}else{
								$s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 = false;break;
							}
						}
					}
					if( $s1_RUZpZzNhVE04YU0xTEs5TS9ySXprdz09 ){
						//$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('SWYgbWF0Y2hlZA==');
					}else{
						$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 = $this->s1_ektxNGd0RHZ6cERzaXNOMktOajlkUT09( $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 );
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('Rm9y') ){
					$a = false;
					$vrand = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['vrand'];
					if( isset($this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]) ){
						$a = $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['a'];
					}
					if( !$a ){
						$this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ] = [
							btoa('cw==') => $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['start'])['v'],
							btoa('ZQ==') => $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['end'])['v'],
							btoa('bw==') => $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['order'],
							btoa('bQ==') => $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['modifier'])['v'],
							btoa('bXg=') => (int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['maxloops'],
							btoa('YXM=') => $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['as'],
							btoa('YQ==')=>true,
							btoa('Yw==')=>0
						];
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Start: " . $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['s'] . ", End: " . $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['e'] . ", o: " . $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['o']  . ", mx: ". $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['mx'] . ", as: ". $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['as'];
						$this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['as'] ] = [btoa('dA==')=>btoa('Tg=='), btoa('dg==')=>$this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['s'] ];
					}
					//print_pre( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 );
					$c = $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['c']++;
					$o = $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['o'];
					$mx = $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['mx'];
					// $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][ $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 ][ btoa('c3RhcnQ=') ] = $start;
					// $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][ $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 ][ btoa('ZW5k') ] = $end;
					$x = $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['as'] ]['v'];
					$e = $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['e'];
					$f = false;
					if( $o == btoa('YS16') ){
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "For: ". $x . " <= " . $e . " && " . $c . " < " . $mx;
						if( $x <= $e && $c < $mx ){$f = true;}
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "For: ". $x . " >= " . $e . " && " . $c . " < " . $mx;
						if( $x >= $e && $c < $mx ){$f = true;}
					}
					if( $f ){
						// process loop
					}else{
						$this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['a'] = false;
						$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 = $this->s1_ektxNGd0RHZ6cERzaXNOMktOajlkUT09( $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 );
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('RW5kRm9y') ){
					$vrand = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['vrand'];
					$as = $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['as'];
					$o = $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['o'];
					$m = $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['m'];
					if( $o == btoa('YS16') ){
						$this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $as ]['v']+=$m;
					}else{
						$this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $as ]['v']-=$m;
					}
					if( $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['c'] > $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['mx'] ){
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "For crossed maximum iterations!";
					}else{
						$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 = $this->s1_dFZsT0h5UFdCTkdoNHc1cWtVQmx3dz09( $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 );
						$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09--;
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('Rm9yRWFjaA==') ){
					$a = false;
					$vrand = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['vrand'];
					if( isset($this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]) ){
						$a = $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['a'];
					}
					$v = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['var'] );
					if( $v['t']!=btoa('Tw==') && $v['t']!=btoa('TA==') ){
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Error: ForEach Expects a List";
						return $this->s1_NnZrUG1mVkFMcVVXWkZvSzVTYjJDdz09(btoa('SW5jb3JyZWN0IHZhcmlhYmxlIGZvciBGb3JFYWNo'));
					}
					//print_pre( $v );exit;
					if( !$a ){
						if( $v['t'] != btoa('Tw==') && $v['t'] != btoa('TA==') ){
							return $this->s1_NnZrUG1mVkFMcVVXWkZvSzVTYjJDdz09(btoa('SW5jb3JyZWN0IHZhcmlhYmxlIA=='). $v['t'] .btoa('IGZvciBGb3JFYWNo'));
						}
						$this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ] = [
							btoa('dmFy')=>$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['var']['v'],
							btoa('a2V5cw==')=>array_keys($v['v']),
							btoa('aw==') => $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['key'],
							btoa('dg==') => $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['value'],
							btoa('YQ==')=>true,
						];
					}
					if( sizeof( $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['keys'] ) ){
						//print_r( $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['keys'] );
						$k1 = array_splice($this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['keys'],0,1)[0];
						//echo $k1 . btoa('LS0=');
						$this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['k'] ] = [btoa('dA==')=>btoa('VA=='), btoa('dg==')=>$k1 ];
						$this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['v'] ] = $v['v'][ $k1 ];
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $k1;
					}else{
						$this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['a'] = false;
						$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 = $this->s1_ektxNGd0RHZ6cERzaXNOMktOajlkUT09( $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 );
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('RW5kRm9yRWFjaA==') ){
					$vrand = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['vrand'];
					$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 = $this->s1_dFZsT0h5UFdCTkdoNHc1cWtVQmx3dz09( $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 );
					$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09--;
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('V2hpbGU=') ){
					$a = false;
					$vrand = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['vrand'];
					if( isset($this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]) ){
						$a = $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['a'];
					}
					if( !$a ){
						$this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ] = [
							btoa('bXg=') => (int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['maxloops'],
							btoa('YQ==')=>true,
							btoa('Yw==')=>0
						];
					}
					//print_pre( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 );
					$c = $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['c']++;
					$mx = $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['mx'];
					$f = true;
					foreach( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['cond'] as $ci=>$cd ){
						$s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09 = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $cd['lhs'] );
						$s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09 = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $cd['rhs'] );
						$op = $cd['op'];
						if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['t'] != $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['t'] ){
							$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Error: while condition: data type mismatch: " . $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['t'] . ":" . $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] . btoa('IHRvIA==') . $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['t'] . ":" . $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'];
						}
						if( $op == "==" ){
							$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] . " == " . $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'];
							if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] == $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'] ){}else{$f = false;}
						}else if( $op == "!=" ){
							$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] . " != " . $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'];
							if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] != $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'] ){}else{$f = false;}
						}else if( $op == "<" ){
							$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] . " < " . $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'];
							if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] < $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v']  ){}else{$f = false;}
						}else if( $op == "<=" ){
							$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] . " <= " . $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'];
							if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] <= $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'] ){}else{$f = false;}
						}else if( $op == ">" ){
							$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] . " > " . $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'];
							if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] > $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v']  ){}else{$f = false;}
						}else if( $op == ">=" ){
							$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] . " >= " . $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'];
							if( $s1_b0JaZld2SEpiOFJjcUcrVUg5Z1RoQT09['v'] >= $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09['v'] ){}else{$f = false;}
						}else{
							$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $op . btoa('IG5vdCBpbXBsZW1lbnRlZA==');
							$f = false;
						}
					}
					if( $f ){
						// process loop
					}else{
						$this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['a'] = false;
						$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 = $this->s1_ektxNGd0RHZ6cERzaXNOMktOajlkUT09( $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 );
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('RW5kV2hpbGU=') ){
					$vrand = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['vrand'];
					if( $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['c'] >= $this->s1_M29iTFF3U0sydUJEMXpQcWxFaVU5dz09[ $vrand ]['mx'] ){
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "For crossed maximum iterations!";
					}else{
						$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 = $this->s1_dFZsT0h5UFdCTkdoNHc1cWtVQmx3dz09( $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 );
						$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09--;
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('QnJlYWtMb29w') ){
					for($s1_REVsSStyWjZhN1RmWHlOSXZqRGpLdz09=$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09+1;$s1_REVsSStyWjZhN1RmWHlOSXZqRGpLdz09<sizeof($this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages']);$s1_REVsSStyWjZhN1RmWHlOSXZqRGpLdz09++){
						$ld = $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][$s1_REVsSStyWjZhN1RmWHlOSXZqRGpLdz09];
						if( $ld['k']['v'] == btoa('RW5kV2hpbGU=') || $ld['k']['v'] == btoa('RW5kRm9yRWFjaA==') || $ld['k']['v'] == btoa('RW5kRm9y') ){
							//$vrand = $ld['vrand'];
							$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 = $s1_REVsSStyWjZhN1RmWHlOSXZqRGpLdz09;
						}
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('TmV4dExvb3A=') ){
					for($s1_REVsSStyWjZhN1RmWHlOSXZqRGpLdz09=$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09+1;$s1_REVsSStyWjZhN1RmWHlOSXZqRGpLdz09<sizeof($this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages']);$s1_REVsSStyWjZhN1RmWHlOSXZqRGpLdz09++){
						$ld = $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][$s1_REVsSStyWjZhN1RmWHlOSXZqRGpLdz09];
						if( $ld['k']['v'] == btoa('RW5kV2hpbGU=') || $ld['k']['v'] == btoa('RW5kRm9yRWFjaA==') || $ld['k']['v'] == btoa('RW5kRm9y') ){
							//$vrand = $ld['vrand'];
							$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 = $s1_REVsSStyWjZhN1RmWHlOSXZqRGpLdz09-1;
						}
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('U2V0TGFiZWw=') ){
					$this->s1_bDBwNFNCZjBCYjh4NWcvQW1uS29nQT09[ $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['v'] ] = $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09;
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('SnVtcFRvTGFiZWw=') ){
					if( isset($this->s1_bDBwNFNCZjBCYjh4NWcvQW1uS29nQT09[ $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['v'] ]) ){
						$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 = $this->s1_bDBwNFNCZjBCYjh4NWcvQW1uS29nQT09[ $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['v'] ];
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Label not found!";
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('UmVzcG9uZA==') ){
					//print_pre( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 );
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('UmVzcG9uZA==');
					if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['t'] == btoa('Tw==') ){
						$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] =$this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['v'] );
						return $this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09;
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Respond: " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['t'];
						$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] =[btoa('c3RhdHVz')=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>btoa('VW5oYW5kbGVkIHJldHJ1biB0eXBl')];
						return $this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09;
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('UmVzcG9uZEpTT04=') ){
					if( isset($this->s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['raw_output']) ){
						return [btoa('c3RhdHVz')=>btoa('c3VjY2Vzcw=='), btoa('ZGF0YQ==')=>$this->s1_cXNrYVlUbXp6eWZ3WkU2eDQxTEZiUT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['output']['v'] ) ];
					}else if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['output']['t'] == btoa('Tw==') ){
						$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] =$this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['output']['v'] );
						if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['pretty']['v'] != btoa('ZmFsc2U=') && $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['pretty']['v'] !== false  ){
							$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['pretty'] = true;
						}
						return $this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09;
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Respond: " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['t'];
						$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] = [btoa('c3RhdHVz')=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>btoa('VW5oYW5kbGVkIHJldHJ1biB0eXBl')];
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('UmVzcG9uZFZhcg==') ){
					if( isset($this->s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['raw_output']) ){
						if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['output']['t'] == btoa('Vg==') ){
							$v = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['output']);
						}else{
							$v = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['output'];
						}
						return [btoa('c3RhdHVz')=>btoa('c3VjY2Vzcw=='), btoa('ZGF0YQ==')=>$v ];
					}else if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['output']['t'] == btoa('Vg==') ){
						$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] = $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['output'] );
						return $this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09;
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Respond: " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['t'];
						$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] = [btoa('c3RhdHVz')=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>btoa('VW5oYW5kbGVkIHJldHJ1biB0eXBl')];
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('UmVzcG9uZFhNTA==') ){
					//print_pre( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 );
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('UmVzcG9uZA==');
					if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['output']['t'] == btoa('Tw==') ){
						$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] =$this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['v'] );
						return $this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09;
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Respond: " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['t'];
						$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] = [btoa('c3RhdHVz')=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>btoa('VW5oYW5kbGVkIHJldHJ1biB0eXBl')];
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('QWRkSFRNTA==') ){
					//print_pre( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 );
					if( $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09['output-type'] != "text/html" ){
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('SW5jb3JyZWN0IHBhZ2UgdHlwZSBhbmQgUmVzcG9uc2UgRm9ybWF0');
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('QWRkSFRNTA==');
						if( gettype( $this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] ) == btoa('YXJyYXk=') ){
							$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] = "";
						}
						if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['t'] == btoa('VA==') || $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['t'] == btoa('VFQ=') ){
							$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] .= $this->s1_TXRqa202eHdVNjhjdHY4SmhHcmF3dz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['v'] ) . "\n";
						}else if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['t'] == btoa('SFQ=') ){
							$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] .= $this->s1_TXRqa202eHdVNjhjdHY4SmhHcmF3dz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['v'] ) . "\n";
						}else if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['t'] == btoa('Vg==') ){
							$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d'] );
							if( gettype($d) == btoa('YXJyYXk=') ){
								if( $d['t'] == btoa('Tw==') || $d['t'] == btoa('TA==') ){
									$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] .= json_encode( $this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $d['v'] ) , JSON_PRETTY_PRINT);
								}else{
									$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] .= $this->s1_TXRqa202eHdVNjhjdHY4SmhHcmF3dz09( $d['v'] );
								}
							}
						}else{
							//print_pre( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d'] );exit;
							$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] .= "\nIncorrect Output Format: " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['output']['t'];
							$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Respond: " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['t'];
						}
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('TG9n') ){
					if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['t'] == btoa('Tw==') ){
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['v'] );
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Log: Incorrect Type: " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['t'];
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('RnVuY3Rpb24=') ){
					$val = $this->s1_cVU4Uzg4MzNhT21xR0RwdEFSdW0vUT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d'] );
					if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['self'] == false ){
						$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs'], $val );
					}
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('RnVuY3Rpb25DYWxs') ){
					$s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09 = $this->s1_aVhvWUFsQUpmVGlSaEk1WG9NbVQwdz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d'] );
					//print_pre( $s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09 );
					if( $s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09['status'] == btoa('ZmFpbA==') ){
						if( isset($this->s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['raw_output']) ){
							return $s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09;
						}else{
							$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['statusCode'] = 500;
							$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] = $s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09;
							if( isset($this->s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['raw_output']) ){
								return $s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09;
							}
							return $this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09;
						}
					}
					//print_pre( $s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09 );
					if( !isset($s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09['data']) ){
						$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['statusCode'] = 500;
						$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] = "functionCall: No data returned";
						return $this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09;
					}
					if( !isset($s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09['data']['t']) || !isset($s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09['data']['v']) ){
						$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['statusCode'] = 500;
						$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] = "functionCall: Incorrect return type". json_encode($s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09['data']);
						return $this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09;
					}
					$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['lhs'], $s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09['data'] );
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('TW9uZ29EYg==') ){
					$val = $this->s1_dkJtdlNzMTJGRW1lVTV2Njc4bUlZdz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 );
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('TXlTcWw=') ){
					$val = $this->s1_NEhuSE0zMlhTYjU3NE9NdXRjL3ZGdz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 );
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('SW50ZXJuYWwtVGFibGU=') ){
					$val = $this->table_dynamic( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 );
				}
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] == btoa('SFRUUFJlcXVlc3Q=') ){
					$val = $this->s1_eldmblNGTGI1R2xKTU9nVkt5eXNyUT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 );
				}
			}else{ // variable commands
				if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] != btoa('Tm9uZQ==') && $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] != btoa('bm9uZQ==') ){
					if( $this->s1_aktyRE5hZUxLTjZzK0kxM3NsQmVYUT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] ) ){
						//print_pre( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k'] );//exit;
						$var = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'];
						if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['plg'] ){
							if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['vs']['d']['self'] && $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['vs']['d']['replace'] ){
								$newval = $this->s1_cHpYbklOaFFGN0lVVDAwVU41cWhsQT09(['t'=>btoa('Vg=='), 'v'=>$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']]);
								$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $var, $newval );
							}else{
								$this->s1_OGh2MVBCVjdhWlpNb3Z5aUw4aWRnZz09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']);
							}
						}else{
							if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['vs']['d']['self'] && $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['vs']['d']['replace'] ){
								$newval = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09(['t'=>btoa('Vg=='), 'v'=>$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']]);
								//print_pre( $newval );exit;
								$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $var, $newval );
							}else{
								$this->s1_emlhQ1pSNjkxaStUMGwxZ1dYS0NkUT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']);
							}
						}
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "ERROR: " . $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['k']['v'] . " not found!";
					}
				}
			}
			$s1_NFVXY0UvVFhMY2ZtNVF4MytYY0Yxdz09 = $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09;
		}
		return $this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09;
	}
	function s1_TXRqa202eHdVNjhjdHY4SmhHcmF3dz09( $v ){
		preg_match_all( "/\{\{(.*?)\}\}/", $v, $m);
		if( $m[0] ){
			foreach( $m[0] as $ii=>$jj ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( trim($m[1][$ii]) );
				if( $d['t'] == btoa('Tw==') || $d['t'] == btoa('TA==') ){
					$v = str_replace( $jj, json_encode($d['v']), $v );
				}else{
					$v = str_replace( $jj, $d['v'], $v );
				}
			}
		}
		return $v;
	}
	function s1_cVU4Uzg4MzNhT21xR0RwdEFSdW0vUT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 ){
		$_fn = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'];
		$_fn_inputs = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['inputs'];
		unset($_fn_inputs['type']);
		$_c = "";
		$_ct = btoa('Qg==');
		foreach( $_fn_inputs as $i=>$j ){if( $i != btoa('dHlwZQ==') ){
			if( $j['t'] == btoa('Vg==') ){
				$v = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $j['v']['v'] );
				$_fn_inputs[ $i ]['v'] = $v['v'];
				$_fn_inputs[ $i ]['t'] = $v['t'];
			}
		}}
		if( !$_fn_inputs[btoa('cDE=')]['v'] && gettype( $_fn_inputs[btoa('cDE=')]['v'] ) != btoa('YXJyYXk=') ){
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Variable [".$_fn_inputs[btoa('cDE=')]['name']."] empty";
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('Um91bmQ=') ){
			$_ct = btoa('Tg==');
			$p1 = $this->s1_NlhHQUZpczAxZkhodzhranY4ZkhmUT09($_fn_inputs[btoa('cDE=')]['v']);
			if( $_fn_inputs[btoa('cDM=')]['v'] ){
				$_c = round( $p1, $this->s1_NlhHQUZpczAxZkhodzhranY4ZkhmUT09($_fn_inputs[btoa('cDI=')]['v']), constant($_fn_inputs[btoa('cDM=')]['v']) );
			}else{
				$_c = round( $p1, $this->s1_NlhHQUZpczAxZkhodzhranY4ZkhmUT09($_fn_inputs[btoa('cDI=')]['v']) );
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('UmFuZG9tIE51bWJlcg==') ){
			$_ct = btoa('Tg==');
			if( $_fn_inputs[btoa('cDE=')]['v']  && $_fn_inputs[btoa('cDI=')]['v'] ){
				$_c = rand((int) $_fn_inputs[btoa('cDE=')]['v'], (int)$_fn_inputs[btoa('cDI=')]['v'] );
			}else{
				$_c = rand( 0,1000 );
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('VGV4dCB0byBOdW1iZXI=') ){
			$_ct = btoa('Tg==');
			$_c = $this->s1_NlhHQUZpczAxZkhodzhranY4ZkhmUT09( $_fn_inputs[btoa('cDE=')]['v'] );
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('TnVtYmVyIEZvcm1hdA==') ){
			$_ct = btoa('VA==');
			$_c = (string)number_format($this->s1_NlhHQUZpczAxZkhodzhranY4ZkhmUT09($_fn_inputs[btoa('cDE=')]['v']),(int)$_fn_inputs[btoa('cDI=')]['v']);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('VGV4dCBQYWRkaW5n') ){
			$_ct = btoa('VA==');
			$m = $_fn_inputs[btoa('cDQ=')]['v'];
			if( $m == btoa('TGVmdA==') ){$m = STR_PAD_LEFT;}
			if( $m == btoa('UmlnaHQ=') ){$m = STR_PAD_RIGHT;}
			if( $m == btoa('Qm90aA==') ){$m = STR_PAD_BOTH;}
			$_c = (string)str_pad( $_fn_inputs[btoa('cDE=')]['v'], $_fn_inputs[btoa('cDI=')]['v'], (string)$_fn_inputs[btoa('cDM=')]['v'],$m);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('TnVtYmVyIHRvIFRleHQ=') ){
			$_ct = btoa('VA==');
			$_c = (string)$_fn_inputs[btoa('cDE=')]['v'];
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('aXMgaXQgVGV4dA==') ){
			$_ct = btoa('Qg==');
			if( is_string($_fn_inputs[btoa('cDE=')]['v']) == btoa('c3RyaW5n') ){
				$_c = true;
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('aXMgaXQgTnVtZXJpYw==') ){
			$_ct = btoa('Qg==');
			if( is_numeric($_fn_inputs[btoa('cDE=')]['v']) ){
				$_c = true;
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('aXMgaXQgQmluYXJ5') ){
			$_ct = btoa('Qg==');
			if( $this->isBinary($_fn_inputs[btoa('cDE=')]['v']) || $_fn_inputs[btoa('cDE=')]['t'] == btoa('QklO') ){
				$_c = true;
			}else{
				$_c = false;
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('TnVtYmVyIHRvIExldHRlcg==') ){
			$_ct = btoa('VA==');
			$_c = chr($_fn_inputs[btoa('cDE=')]['v']);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('Q2hhbmdlIFR5cGU=') ){
			if( $_fn_inputs[btoa('cDI=')]['v'] == btoa('VA==') ){
				$_c = (string)$_fn_inputs[btoa('cDE=')]['v'];
				$_ct = 'T';
			}else if( $_fn_inputs[btoa('cDI=')]['v'] == btoa('Tg==') ){
				$_c = $this->s1_NlhHQUZpczAxZkhodzhranY4ZkhmUT09( $_fn_inputs[btoa('cDE=')]['v'] );
				$_ct  = 'N';
			}else if( $_fn_inputs[btoa('cDI=')]['v'] == btoa('Qg==') ){
				$_c = true;
				$_ct  = 'B';
			}else if( $_fn_inputs[btoa('cDI=')]['v'] == btoa('Tw==') ){
				$_c = [];
				$_ct  = 'O';
			}else if( $_fn_inputs[btoa('cDI=')]['v'] == btoa('TA==') ){
				$_c = [];
				$_ct  = 'L';
			}else if( $_fn_inputs[btoa('cDI=')]['v'] == btoa('QklO') ){
				$_c = "";
				$_ct = 'BIN';
			}else if( $_fn_inputs[btoa('cDI=')]['v'] == btoa('QjY0') ){
				$_c = "";
				$_ct = 'B64';
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('dWN3b3Jkcw==') ){
			$_ct = btoa('VA==');
			$_c = ucwords($_fn_inputs[btoa('cDE=')]['v']);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('VW5pcUlE') ){
			$_ct = btoa('VA==');
			$_c = uniqid();
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('bW9uZ29kYl9pZA==') ){
			$_ct = btoa('VA==');
			$_c = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->generate_id();
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('QWRkIERheXM=') ){
			$_ct = btoa('RA==');
			$_c = date(btoa('WS1tLWQ='), strtotime( $_fn_inputs[btoa('cDE=')]['v'] )+($_fn_inputs[btoa('cDI=')]['v']*86400) );
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('TWludXMgRGF5cw==') ){
			$_ct = btoa('RA==');
			$_c = date(btoa('WS1tLWQ='), strtotime( $_fn_inputs[btoa('cDE=')]['v'] )-($_fn_inputs[btoa('cDI=')]['v']*86400) );
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('U3RyVG9UaW1l') ){
			$_ct = btoa('VFM=');
			$_c = strtotime( $_fn_inputs[btoa('cDE=')]['v'] );
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('RGF5cyB0aWxsIFRvZGF5') ){
			$_ct = btoa('Tg==');
			$_c = time()-strtotime( $_fn_inputs[btoa('cDE=')]['v'] );
			$_c = floor($_c/86400);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('TW9udGhzIHRpbGwgVG9kYXk=') ){
			$_ct = btoa('Tg==');
			$_c = time()-strtotime( $_fn_inputs[btoa('cDE=')]['v'] );
			$_c = floor($_c/86400/30);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('WWVhcnMgdGlsbCBUb2RheQ==') ){
			$_ct = btoa('Tg==');
			$_c = time()-strtotime( $_fn_inputs[btoa('cDE=')]['v'] );
			$_c = floor($_c/86400/365);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('RGF5cyBEaWZm') ){
			$_ct = btoa('Tg==');
			$_c = strtotime( $_fn_inputs[btoa('cDI=')]['v'] )-strtotime( $_fn_inputs[btoa('cDE=')]['v'] );
			$_c = floor($_c/86400);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('TW9udGhzIERpZmY=') ){
			$_ct = btoa('Tg==');
			$_c = strtotime( $_fn_inputs[btoa('cDI=')]['v'] )-strtotime( $_fn_inputs[btoa('cDE=')]['v'] );
			$_c = floor($_c/86400/30);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('WWVhcnMgRGlmZg==') ){
			$_ct = btoa('Tg==');
			$s1_cnc0VW00V0kxNGlvcnVkbnpjSTdKQT09 = strtotime( $_fn_inputs[btoa('cDE=')]['v'] );
			$s1_WU1yNDZWbnhlT290K1NXZjRUdDFPQT09 = strtotime( $_fn_inputs[btoa('cDI=')]['v'] );
			$s1_b01XWjZ6cUZodmttaTJNWWxmQ2pOZz09 = $s1_WU1yNDZWbnhlT290K1NXZjRUdDFPQT09 - $s1_cnc0VW00V0kxNGlvcnVkbnpjSTdKQT09;
			$_c = floor($s1_b01XWjZ6cUZodmttaTJNWWxmQ2pOZz09/86400/365);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('Q2hhbmdlIEZvcm1hdA==') ){
			$_ct = btoa('RA==');
			$_c = date($_fn_inputs[btoa('cDI=')]['v'], strtotime( $_fn_inputs[btoa('cDE=')]['v'] ));
		}

		//  LIST FUNCTIONS 
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('TGlzdCBMZW5ndGg=') ){
			$_ct = btoa('Tg==');
			if( gettype($_fn_inputs[btoa('cDE=')]['v']) ==btoa('YXJyYXk=') && array_keys($_fn_inputs[btoa('cDE=')]['v'][0]===0) ){
				$_c = sizeof( $_fn_inputs[btoa('cDE=')]['v'] );
			}else{
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "List length: non array";
				$_c = 0;
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('R2V0IExpc3QgSXRlbQ==') ){
			$_ct = btoa('Tw==');
			$_c = $_fn_inputs[btoa('cDE=')]['v'][ $_fn_inputs[btoa('cDI=')]['v'] ];
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('TGlzdCBBcHBlbmQ=') ){
			$_ct = btoa('TA==');
			if( !is_array($_fn_inputs[btoa('cDE=')]['v']) ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "List Append Error: Value is not list!";
			}else{
				$_fn_inputs[btoa('cDE=')]['v'][] = $_fn_inputs[btoa('cDI=')]['v'];
				$_c = $_fn_inputs[btoa('cDE=')]['v'];
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('TGlzdCBQcmVwZW5k') ){
			array_splice( $_fn_inputs[btoa('cDE=')]['v'], 0, 0, [$_fn_inputs[btoa('cDI=')]['v']] );
			$_c = $_fn_inputs[btoa('cDE=')]['v'];
			$_ct = btoa('TA==');
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('TGlzdCBJdGVtIFJlbW92ZQ==') ){
			array_splice( $_fn_inputs[btoa('cDE=')]['v'], $_fn_inputs[btoa('cDI=')]['v'], 1 );
			$_c = $_fn_inputs[btoa('cDE=')]['v'];
			$_ct = btoa('TA==');
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('R2V0IFZhbHVl') ){
			$_ct = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['return'];
			$_c = $_fn_inputs[btoa('cDE=')]['v'][ $_fn_inputs[btoa('cDI=')]['v'] ];
		}
		
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('U2V0IFZhbHVl') ){
			$_fn_inputs[btoa('cDE=')]['v'][ $_fn_inputs[btoa('cDI=')]['v'] ] = $_fn_inputs[btoa('cDM=')]['v'];
			$_ct = btoa('Tw==');
			$_fn_inputs[btoa('cDE=')]['v'][ $_fn_inputs[btoa('cDI=')]['v'] ];
			$_c = $_fn_inputs[btoa('cDE=')]['v'];
		}
		// LIST FUNCTIONS
		// String Functions Start
		
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('Q29uY2F0') ){
			$_ct = btoa('VA==');
			$_c = "";
			foreach( $_fn_inputs as $i=>$j ){
				$_c .= $j['v'];
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('U3ViIFN0cmluZw==') ){
			$_ct = btoa('VA==');
			$_c = substr( (string)$_fn_inputs[btoa('cDE=')]['v'], (int)$_fn_inputs[btoa('cDI=')]['v'], (int)$_fn_inputs[btoa('cDM=')]['v'] );
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('UmVwbGFjZSBUZXh0') ){
			$_ct = btoa('VA==');
			$_c = str_replace( $_fn_inputs[btoa('cDI=')]['v'], $_fn_inputs[btoa('cDM=')]['v'], $_fn_inputs[btoa('cDE=')]['v'] );
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('dG8gVXBwZXIgQ2FzZQ==') ){
			$_ct = btoa('VA==');
			$_c = strtoupper( $_fn_inputs[btoa('cDE=')]['v'] );
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('dG8gTG93ZXIgQ2FzZQ==') ){
			$_ct = btoa('VA==');
			$_c = strtolower( $_fn_inputs[btoa('cDE=')]['v'] );
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('VHJpbQ==') ){
			$_ct = btoa('VA==');
			$_c = trim( $_fn_inputs[btoa('cDE=')]['v'] );
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('Q2xlYW4=') ){
			$_ct = btoa('VA==');
			$_c = preg_replace("/[\W]+/", "", $_fn_inputs[btoa('cDE=')]['v'] );
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('TWF0Y2ggUGF0dGVybg==') ){
			$m = false;
			@preg_match($_fn_inputs[btoa('cDI=')]['v'], $_fn_inputs[btoa('cDE=')]['v'], $m );
			if( $m ){
				if( $_fn_inputs[btoa('cDM=')]['v'] == btoa('VHJ1ZQ==') ){
					$_ct = btoa('Qg==');
					$_c = true;
				}else if( $_fn_inputs[btoa('cDM=')]['v'] == btoa('TWF0Y2hlZCBTdHJpbmc=') ){
					$_ct = btoa('VA==');
					$_c = $m[0];
				}else if( $_fn_inputs[btoa('cDM=')]['v'] == btoa('TWF0Y2hlZCBHcm91cCAx') && $m[1] ){
					$_ct = btoa('VA==');
					$_c = $m[1];
				}else if( $_fn_inputs[btoa('cDM=')]['v'] == btoa('TWF0Y2hlZCBHcm91cCAy') && $m[2] ){
					$_ct = btoa('VA==');
					$_c = $m[2];
				}else if( $_fn_inputs[btoa('cDM=')]['v'] == btoa('TWF0Y2hlZCBHcm91cCAz') && $m[3] ){
					$_ct = btoa('VA==');
					$_c = $m[3];
				}else{
					$_ct = btoa('Qg==');
					$_c = false;
				}
			}else{
				$_ct = btoa('Qg==');
				$_c = false;
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('SlNPTiBFbmNvZGU=') ){
			$_ct = btoa('VA==');
			if( $_fn_inputs['p2']['v'] == btoa('dHJ1ZQ==') ){
				$_c = json_encode( $this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $_fn_inputs[btoa('cDE=')]['v'] ), JSON_PRETTY_PRINT );
			}else{
				$_c = json_encode( $this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $_fn_inputs[btoa('cDE=')]['v'] ) );
			}
			if( json_last_error() ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "JSON Encode Error: " . json_last_error_msg();
				$_c = "";
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('SlNPTiBEZWNvZGU=') ){
			$_ct = btoa('Tw==');
			$_c = json_decode( $_fn_inputs[btoa('cDE=')]['v'], true );
			if( json_last_error() ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "JSON Decode Error: " . json_last_error_msg();
				$_c = [];
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('SFRNTCBFbnRpdHkgRGVjb2Rl') ){
			$_ct = btoa('VA==');
			$_c = str_replace("&quot;", "\"", $_fn_inputs[btoa('cDE=')]['v']);
			$_c = str_replace("&lt;", "<", $_c);
			$_c = str_replace("&gt;", ">", $_c);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('WE1MIERlY29kZQ==') ){
			$_ct = btoa('Tw==');
			$_c = "";
			$_error = "";
			try{
				$body_parsed = simplexml_load_string($_fn_inputs[btoa('cDE=')]['v']);
				preg_match("/^\<\?xml.*\?\>/i", $_fn_inputs[btoa('cDE=')]['v'], $m);
				if( $m ){
					$_fn_inputs[btoa('cDE=')]['v'] = substr($_fn_inputs[btoa('cDE=')]['v'], strlen($m[0]), strlen($_fn_inputs[btoa('cDE=')]['v']));
				}
				preg_match("/^\<([a-z0-9\:\-\_\.]+)/i", $_fn_inputs[btoa('cDE=')]['v'], $m);
				if( $m ){
					if( $m[1] ){
						$body_parsed = $this->parsexml($body_parsed);
						$_c = [$m[1]=>$body_parsed];
					}
				}
			}catch(Exception $ex){
				$_error = $ex->getMessage();
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "XML Decode Error: " . $_error;
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('QmFzZTY0IEVuY29kZQ==') ){
			$_ct = btoa('QjY0');
			$_c = base64_encode($_fn_inputs[btoa('cDE=')]['v']);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('QmFzZTY0IERlY29kZQ==') ){
			$_ct = btoa('VA==');
			$_c = base64_decode($_fn_inputs[btoa('cDE=')]['v']);
			if( $this->isBinary($_c) ){
				$_ct = btoa('QklO');
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['function']['function'] == btoa('R2VuZXJhdGUgSVY=') ){
			if( $_fn_inputs[btoa('cDI=')]['v'] == btoa('TnVsbEJ5dGVz') ){
				$_c = btoa('MDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMDAwMA==');
				$_c = substr($_c, 0, (int)$_fn_inputs[btoa('cDE=')]['value'] );
			}else{
				$_c = random_bytes( (int)$_fn_inputs[btoa('cDE=')]['v'] );
			}
			$_ct = btoa('QklO');
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('UmFuZG9tIFRleHQ=') ){
			$_c = substr( str_shuffle( btoa('YWJjZGVmMDEyMzQ1Njc5MGdoaWprbG1ub3BxcnN0dXZ3eHl6YWJjZGVmMDEyMzQ1Njc5MGdoaWprbG1ub3BxcnN0dXZ3eHl6YWJjZGVmMDEyMzQ1Njc5MGdoaWprbG1ub3BxcnN0dXZ3eHl6YWJjZGVmMDEyMzQ1Njc5MGdoaWprbG1ub3BxcnN0dXZ3eHl6YWJjZGVmMDEyMzQ1Njc5MGdoaWprbG1ub3BxcnN0dXZ3eHl6YWJjZGVmMDEyMzQ1Njc5MGdoaWprbG1ub3BxcnN0dXZ3eHl6') ), 0, (int)$_fn_inputs[btoa('cDE=')]['v'] );
			$_ct = btoa('VA==');
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['function']['function'] == btoa('R2V0IElWIFNpemU=') ){
			$_ct = btoa('Tg==');
			$_c = openssl_cipher_iv_length($_fn_inputs[btoa('cDE=')]['value']);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['function']['function'] == btoa('SGV4IHRvIEJpbg==') ){
			$_ct = btoa('QklO');
			$_c = hex2bin($_fn_inputs[btoa('cDE=')]['value']);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('SGFzaA==') ){
			$_ct = btoa('VA==');
			$ctx = hash_init($_fn_inputs[btoa('cDI=')]['v']);
			if( $_fn_inputs[btoa('cDM=')]['v'] ){
				hash_update( $ctx, $_fn_inputs[btoa('cDM=')]['v'] );
			}
			hash_update( $ctx, $_fn_inputs[btoa('cDE=')]['v'] );
			$_c = hash_final( $ctx );
			$_ct = btoa('QjY0');
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('T3BlblNTTCBQdWJsaWMgRW5jcnlwdA==') ){
			$_ct = btoa('QjY0');
			$_fn_inputs[btoa('cDI=')]['v'] = $_fn_inputs[btoa('cDI=')]['v']['public'];
			$_fn_inputs[btoa('cDM=')]['v'] = constant( $_fn_inputs[btoa('cDM=')]['v'] );
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $_fn_inputs[btoa('cDE=')]['v'];
			//$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $_fn_inputs[btoa('cDI=')]['v'];
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $_fn_inputs[btoa('cDM=')]['v'];
			//eval("\$p=".$_fn_inputs[btoa('cDM=')]['v'].";");
			$st = openssl_public_encrypt( $_fn_inputs[btoa('cDE=')]['v'], $crypted, $_fn_inputs[btoa('cDI=')]['v'], $_fn_inputs[btoa('cDM=')]['v'] );
			$_c = base64_encode($crypted);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('T3BlblNTTCBQdWJsaWMgRGVjcnlwdA==') ){
			$_ct = btoa('VA==');
			$_fn_inputs[btoa('cDI=')]['v'] = $_fn_inputs[btoa('cDI=')]['v']['public'];
			$_fn_inputs[btoa('cDM=')]['v'] = constant( $_fn_inputs[btoa('cDM=')]['v'] );
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $_fn_inputs[btoa('cDE=')]['v'];
			//$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $_fn_inputs[btoa('cDI=')]['v'];
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $_fn_inputs[btoa('cDM=')]['v'];
			$st = openssl_public_decrypt( base64_decode($_fn_inputs[btoa('cDE=')]['v']), $crypted, $_fn_inputs[btoa('cDI=')]['v'], $_fn_inputs[btoa('cDM=')]['v'] );
			$_c = $crypted;
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('T3BlblNTTCBQcml2YXRlIEVuY3J5cHQ=') ){
			$_ct = btoa('QjY0');
			$_fn_inputs[btoa('cDI=')]['v'] = $_fn_inputs[btoa('cDI=')]['v']['private'];
			$_fn_inputs[btoa('cDM=')]['v'] = constant( $_fn_inputs[btoa('cDM=')]['v'] );
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $_fn_inputs[btoa('cDE=')]['v'];
			//$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $_fn_inputs[btoa('cDI=')]['v'];
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $_fn_inputs[btoa('cDM=')]['v'];
			$st = openssl_private_encrypt( $_fn_inputs[btoa('cDE=')]['v'], $crypted, $_fn_inputs[btoa('cDI=')]['v'], $_fn_inputs[btoa('cDM=')]['v'] );
			$_c = base64_encode($crypted);
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('T3BlblNTTCBQcml2YXRlIERlY3J5cHQ=') ){
			$_ct = btoa('VA==');
			$_fn_inputs[btoa('cDI=')]['v'] = $_fn_inputs[btoa('cDI=')]['v']['private'];
			$_fn_inputs[btoa('cDM=')]['v'] = constant( $_fn_inputs[btoa('cDM=')]['v'] );
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $_fn_inputs[btoa('cDE=')]['v'];
			//$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $_fn_inputs[btoa('cDI=')]['v'];
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $_fn_inputs[btoa('cDM=')]['v'];
			$st = openssl_private_decrypt( base64_decode($_fn_inputs[btoa('cDE=')]['v']), $crypted, $_fn_inputs[btoa('cDI=')]['v'], $_fn_inputs[btoa('cDM=')]['v'] );
			$_c = $crypted;
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('T3BlblNTTCBFbmNyeXB0') ){
			$_ct = btoa('QjY0');
			if( $_fn_inputs[btoa('cDQ=')]['v'] ){
				$_c = openssl_encrypt( $_fn_inputs[btoa('cDE=')]['v'], $_fn_inputs[btoa('cDI=')]['v'], $_fn_inputs[btoa('cDM=')]['v'], 0, $_fn_inputs[btoa('cDQ=')]['v'] );
			}else{
				$_c = openssl_encrypt( $_fn_inputs[btoa('cDE=')]['v'], $_fn_inputs[btoa('cDI=')]['v'], $_fn_inputs[btoa('cDM=')]['v'] );
			}
		}
		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['fn'] == btoa('T3BlblNTTCBEZWNyeXB0') ){
			$_ct = btoa('VA==');
			if( $_fn_inputs[btoa('cDQ=')]['v'] ){
				$_c = openssl_decrypt( $_fn_inputs[btoa('cDE=')]['v'], $_fn_inputs[btoa('cDI=')]['v'], $_fn_inputs[btoa('cDM=')]['v'], 0, $_fn_inputs[btoa('cDQ=')]['v'] );
			}else{
				$_c = openssl_decrypt( $_fn_inputs[btoa('cDE=')]['v'], $_fn_inputs[btoa('cDI=')]['v'], $_fn_inputs[btoa('cDM=')]['v'] );
			}
		}
		if( gettype($_c) == btoa('ZmxvYXQ=') || gettype($_c) == btoa('ZG91Ymxl') ){
			if( is_nan($_c) || is_infinite($_c) ){
				$_ct = btoa('Tkw=');
				$_c = btoa('TlVMTA==');
			}
		}
		///$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "setting: " . $_c;

		if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['self'] ){
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['lhs']['v']['t'] . ":" . $_ct;
			if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['lhs']['v']['t'] != $_ct && $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['lhs']['v']['t'] != ($_ct==btoa('QjY0')?btoa('VA=='):$_ct) ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('VW5leHBlY3RlZCB0eXBlIGFzc2lnbm1lbnQgLi4uIA==');
			}
			if( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['lhs']['v']['t'] != btoa('QklO') && $_ct == btoa('QklO') ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Unexpected: Binary data striped";
			}
			//$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('c2V0dGluZy4uLi4=');
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['lhs'], [btoa('dA==')=>$_ct, btoa('dg==')=>$_c] );
		}
		return [btoa('dA==')=>$_ct, btoa('dg==')=>$_c];
	}
	function s1_cWMzaU5kOG5GaGNzZHhTUldIWXczQT09( &$v, $vs, $var = "" ){
		//print_pre( btoa('ZG9fUExHX2Z1bmN0aW9u') );
		//print_pre( $v );
		//print_pre( $vs );
		$method = $vs['v'];
		$inputs = $vs['d']['inputs'];
		//print_pre( $inputs );
		foreach( $inputs as $i=>$j ){
			$inputs[ $i ] = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $j['v'] );
		}
		//print_pre( $inputs );
		if( method_exists($v['v'], $method) ){
			//echo btoa('TWV0aG9kIGV4aXN0cw==');
			$k = $v['v']->{$method}($inputs);
			// echo btoa('ZG9fcGxnX2Z1bmN0aW9uIA==') . $method . " returning: \n";
			// print_pre( $k );
			if( is_array($k) ){
				return $k;
			}else{
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Method return value incorrect: ". $method;
				return ['t'=>btoa('Qg=='), btoa('dg==')=>false];
			}
		}else{
			//echo "do_plg_function Method not exists: \n";
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Method not found: ". $method;
			return ['t'=>btoa('Qg=='), btoa('dg==')=>false];
		}
		//$rt = true;
		//$inputs = $vs['d']['inputs'];
	}
	function s1_cjV2UStyZlR2YnhUcDRlVWcrU1pVQT09( &$v, $vs ){
		// print_pre( btoa('ZG9faW5saW5lX2Z1bmN0aW9u') );
		// print_pre( $v );
		// print_pre( $vs ); 
		// exit;
		$rt = true;
		$inputs = $vs['d']['inputs'];
		if( $v['t'] == btoa('Tg==') ){
			foreach( $inputs as $i=>$j ){

			}
			if( $vs['v'] == btoa('c2V0') ){
				return $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
			}
			if( $vs['v'] == btoa('YWRk') ){
				$add = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p2']['v'] );
				$v['v']+=$add['v'];
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3Q=') ){
				$add = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p2']['v'] );
				$v['v']-=$add['v'];
				return $v;
			}
			if( $vs['v'] == btoa('cm91bmQ=') ){
				$de = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p2']['v'] );
				$v['v'] = round( (float)$v['v'], (int)$de );
				return $v;
			}
			if( $vs['v'] == btoa('Zmxvb3I=') ){
				$v['v'] = floor((float)$v['v']);
				return $v;
			}
			if( $vs['v'] == btoa('Y2VpbA==') ){
				$v['v'] = ceil((float)$v['v']);
				return $v;
			}
			if( $vs['v'] == btoa('cGFyc2VJbnQ=') ){
				$v['v'] = (int)$v['v'];
				return $v;
			}
			if( $vs['v'] == btoa('Y29udmVydFRvVGV4dA==') ){
				return ['t'=>btoa('VA=='), 'v'=>(string)$v['v']];
			}
			if( $vs['v'] == btoa('dGV4dFBhZGRpbmc=') ){
				$mm = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p4']['v'])['v'];
				if( $mm == btoa('TGVmdA==') ){$m = STR_PAD_LEFT;}else
				if( $mm == btoa('UmlnaHQ=') ){$m = STR_PAD_RIGHT;}else
				if( $mm == btoa('Q2VudGVy') ){$m = STR_PAD_BOTH;}else{$m = STR_PAD_RIGHT;}
				$v['v'] = str_pad( $v['v'], (int)($this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v']), $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p3']['v'])['v'], $m );
				$v['t'] = btoa('VA==');
				return $v;
			}
		}else if( $v['t'] == btoa('VA==') ){
			foreach( $inputs as $i=>$j ){}
			if( $vs['v'] == btoa('c2V0') ){
				return $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
			}
			if( $vs['v'] == btoa('dG9Mb3dlckNhc2U=') ){
				$v['v'] = strtolower($v['v']);return $v;
			}
			if( $vs['v'] == btoa('dG9VcHBlckNhc2U=') ){
				$v['v'] = strtoupper($v['v']);return $v;
			}
			if( $vs['v'] == btoa('dHJpbQ==') ){
				$v['v'] = trim($v['v']);return $v;
			}
			if( $vs['v'] == btoa('bWF0Y2hQYXR0ZXJu') ){
				$rt = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p3']['v'] )['v'];
				preg_match( $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p2']['v'] )['v'], $v['v'], $m );
				if( $m ){
					if( $rt == btoa('dHJ1ZQ==') ){
						return ['t'=>btoa('Qg=='), btoa('dg==')=>true];
					}else if( $rt == btoa('TGlzdA==') ){
						for($i=0;$i<sizeof($m);$i++){
							$m[ $i ] = [btoa('dA==')=>btoa('VA=='), btoa('dg==')=>$m[ $i ]];
						}
						return ['t'=>btoa('TA=='), btoa('dg==')=>$m];
					}else if( $rt == "$0" ){
						return ['t'=>btoa('VA=='), btoa('dg==')=>$m[0]];
					}else if( $rt == "$1" ){
						return ['t'=>btoa('VA=='), btoa('dg==')=>$m[1]];
					}else if( $rt == "$2" ){
						return ['t'=>btoa('VA=='), btoa('dg==')=>$m[2]];
					}
				}else{
					if( $rt == btoa('dHJ1ZQ==') ){
						return ['t'=>btoa('Qg=='), btoa('dg==')=>false];
					}else{
						return ['t'=>btoa('VA=='), btoa('dg==')=>""];
					}
				}
			}
			if( $vs['v'] == btoa('c2VhcmNoUGF0dGVybg==') ){
				$rt = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p3']['v'] )['v'];
				$reg = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p2']['v'] )['v'];
				preg_match_all( $reg, $v['v'], $m );
				if( is_array($m) ){
					for($i=0;$i<sizeof($m);$i++){
						$mm = [];
						for($j=0;$j<sizeof($m[ $i ]);$j++){
							$mm[ $j ] = ['t'=>'T', 'v'=>$m[ $i ][ $j ]];
						}
						$m[ $i ] = [btoa('dA==')=>btoa('TA=='), btoa('dg==')=>$mm];
					}
				}else{
					$m = [];
				}
				return ['t'=>btoa('TA=='), btoa('dg==')=>$m];
			}
			if( $vs['v'] == btoa('aXNOdW1lcmlj') ){
				if( preg_match("/^[0-9\.]+$/", $v['v']) ){
					return ['t'=>btoa('Qg=='), btoa('dg==')=>true];
				}else{
					return ['t'=>btoa('Qg=='), btoa('dg==')=>false];
				}
			}
			if( $vs['v'] == btoa('c3ViU3RyaW5n') ){
				$i = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p2']['v'] )['v'];
				$s = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p3']['v'] )['v'];
				return ['t'=>btoa('VA=='), btoa('dg==')=>substr($v['v'],$i,$s) ];
			}
			if( $vs['v'] == btoa('YXBwZW5k') ){
				for($i=2;$i<=5;$i++){
					if( $inputs['p'.$i]['v'] ){
						$v['v'] .= $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p'.$i]['v'] )['v'];
					}
				}
				return ['t'=>btoa('VA=='), btoa('dg==')=>$v['v'] ];
			}
			if( $vs['v'] == btoa('cHJlcGVuZA==') ){
				$i = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p2']['v'] )['v'];
				return ['t'=>btoa('VA=='), btoa('dg==')=>$i . $v['v'] ];
			}
			if( $vs['v'] == btoa('bGVuZ3Ro') ){
				return ['t'=>btoa('Tg=='), btoa('dg==')=>strlen($v['v']) ];
			}
			if( $vs['v'] == btoa('Y2xlYW4=') ){
				return ['t'=>btoa('VA=='), btoa('dg==')=>preg_replace("/[\W]/", "",$v['v']) ];
			}
			if( $vs['v'] == btoa('Y29udmVydFRvTnVtYmVy') ){
				$v['v'] = preg_replace("/[^0-9\.]+/", "",$v['v']);
				if( preg_match("/\./", $v['v'] ) ){
					return ['t'=>btoa('Tg=='), btoa('dg==')=>(float)$v['v']  ];
				}else{
					return ['t'=>btoa('Tg=='), btoa('dg==')=>(int)$v['v']  ];
				}
			}
			if( $vs['v'] == btoa('c3BsaXQ=') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p2']['v'] )['v'];
				$l = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p3']['v'] )['v'];
				if( !preg_match("/^\/(.*)\/$/", $d) ){
					$d = "/" . $d . "/";
				}
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "regex: " . $d;
				$parts = preg_split( ($d??""),($v['v']??""),($l??-1) );
				for($i=0;$i<sizeof($parts);$i++){
					$parts[$i] = ['t'=>btoa('VA=='), 'v'=>$parts[$i]];
				}
				return ['t'=>btoa('TA=='), 'v'=>$parts ];
			}
			if( $vs['v'] == btoa('cmVwbGFjZQ==') ){
				$f = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p2']['v'] )['v'];
				$r = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p3']['v'] )['v'];
				$v['v'] = str_replace( $f, $r, $v['v'] );
				return $v;
			}
		}else if( $v['t'] == btoa('TA==') ){
			if( $vs['v'] == btoa('Z2V0') ){
				return $v;
			}
			if( $vs['v'] == btoa('c2V0') ){
				$v = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				return ['t'=>btoa('Qg=='), btoa('dg==')=>true];
			}
			if( $vs['v'] == btoa('Z2V0SXRlbQ==') ){
				$val = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				return $v['v'][ $val['v'] ];
			}
			if( $vs['v'] == btoa('aW5zZXJ0') ){
				$index = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				$item = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p3']['v']);
				array_splice($v['v'], (int)$index['v'], 0, [$item]);
				return ['t'=>btoa('Qg=='), btoa('dg==')=>true];
			}
			if( $vs['v'] == btoa('cmVtb3Zl') ){
				$index = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				return ['t'=>btoa('Qg=='), btoa('dg==')=>array_splice($v['v'], (int)$index['v'], 1)];
			}
			if( $vs['v'] == btoa('cG9w') ){
				return ['t'=>btoa('Qg=='), btoa('dg==')=>array_splice($v['v'], sizeof($v['v'])-1, 1 ) ];
			}
			if( $vs['v'] == btoa('YXBwZW5k') || $vs['v'] == btoa('cHVzaA==') ){
				$val = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				$v['v'][] = $val;
				return ['t'=>btoa('Qg=='), btoa('dg==')=>true];
			}
			if( $vs['v'] == btoa('cHJlcGVuZA==') ){
				$val = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				array_splice($v['v'],0,0,[$val]);
				return ['t'=>btoa('Qg=='), btoa('dg==')=>true];
			}
			if( $vs['v'] == btoa('bGVuZ3Ro') ){
				return ['t'=>btoa('Tg=='), btoa('dg==')=>sizeof($v['v'])];
			}
		}else if( $v['t'] == btoa('Tw==') ){
			if( $vs['v'] == btoa('Z2V0') ){
				return $v;
			}
			if( $vs['v'] == btoa('c2V0') ){
				$v = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				return ['t'=>btoa('Qg=='), btoa('dg==')=>true];
			}
			if( $vs['v'] == btoa('Z2V0S2V5') ){
				$val = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				if( !isset( $v['v'][ $val['v'] ] ) ){
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Key: " . $val['v'] . btoa('IG5vdCBmb3VuZA==');
					return [btoa('dA==')=>btoa('VA=='), btoa('dg==')=>""];
				}
				return $v['v'][ $val['v'] ];
			}
			if( $vs['v'] == btoa('Z2V0S2V5TGlzdA==') ){
				$val = array_keys($v['v']);
				$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09($val);
				return ['t'=>btoa('TA=='), btoa('dg==')=>$val ];
			}
			if( $vs['v'] == btoa('c2V0S2V5') ){
				$key = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p2']['v'] );
				$item  = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $inputs['p3']['v'] );
				$v['v'][ $key['v'] ] = $item;
				return ['t'=>btoa('Qg=='), btoa('dg==')=>true];
			}
			if( $vs['v'] == btoa('cmVtb3ZlS2V5') ){
				$key = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				unset( $v['v'][ $key['v'] ] );
				return ['t'=>btoa('Qg=='), btoa('dg==')=>true];
			}
		}else if( $v['t'] == btoa('Qg==') ){
			if( $vs['v'] == btoa('Z2V0') ){
				return $v;
			}
			if( $vs['v'] == btoa('c2V0') ){
				$v = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				return $v;
			}
			if( $vs['v'] == btoa('c2V0VHJ1ZQ==') ){
				$v['v'] = true;
				return $v;
			}
			if( $vs['v'] == btoa('c2V0RmFsc2U=') ){
				$v['v'] = false;
				return $v;
			}
		}else if( $v['t'] == btoa('RA==') ){
			if( $vs['v'] == btoa('Z2V0') ){
				return $v;
			}
			if( $vs['v'] == btoa('c2V0') ){
				$v['v'] = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				return $v;
			}
			if( $vs['v'] == btoa('c2V0VmFsdWU=') ){
				$y = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$m = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p3']['v'])['v'];
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p4']['v'])['v'];
				$v['v'] = date(btoa('WS1tLWQ='), mktime(12,12,12,$m,$d,$y));
				return $v;
			}
			if( $vs['v'] == btoa('Z2V0RGF0ZQ==') ){
				return ['t'=>btoa('Tg=='), date(btoa('ZA=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0TW9udGg=') ){
				return ['t'=>btoa('Tg=='), date(btoa('bQ=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0WWVhcg==') ){
				return ['t'=>btoa('Tg=='), date(btoa('WQ=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0TW9udGhGdWxs') ){
				return ['t'=>btoa('VA=='), date(btoa('TQ=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0TW9udGhTaG9ydA==') ){
				return ['t'=>btoa('VA=='), date(btoa('Rg=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0RGF5RnVsbA==') ){
				return ['t'=>btoa('VA=='), date(btoa('bA=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0RGF5U2hvcnQ=') ){
				return ['t'=>btoa('VA=='), date(btoa('RA=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0RGF5c1RpbGw=') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				$date1 = new DateTime($v['v']);
				$date2 = new DateTime($d['v']);
				$interval = $date1->diff($date2);
				return ['t'=>btoa('Tg=='), btoa('dg==')=>$interval->days ];
			}
			if( $vs['v'] == btoa('Z2V0RGF5c1VudGls') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				$date2 = new DateTime($v['v']);
				$date1 = new DateTime($d['v']);
				$interval = $date1->diff($date2);
				return ['t'=>btoa('Tg=='), btoa('dg==')=>$interval->days ];
			}
			if( $vs['v'] == btoa('Z2V0RGF5c1RpbGxUb2RheQ==') ){
				$date1 = new DateTime(btoa('bm93'));
				$date2 = new DateTime($v['v']);
				$interval = $date1->diff($date2);
				return ['t'=>btoa('Tg=='), btoa('dg==')=>$interval->days ];
			}
			if( $vs['v'] == btoa('Z2V0RGF5c1VudGlsVG9kYXk=') ){
				$date2 = new DateTime(btoa('bm93'));
				$date1 = new DateTime($v['v']);
				$interval = $date1->diff($date2);
				return ['t'=>btoa('Tg=='), btoa('dg==')=>$interval->days ];
			}
			if( $vs['v'] == btoa('Z2V0Rm9ybWF0') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				if( $d == "dd/mm/yyyy" ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date("d/m/Y", strtotime($v['v']) ) ];
				}else if( $d == "mm/dd/yyyy" ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date("m/d/Y", strtotime($v['v']) ) ];
				}else if( $d == btoa('ZGQtbW0teXl5eQ==') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('ZC1tLVk='), strtotime($v['v']) ) ];
				}else if( $d == "yyyy/mm/dd" ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date("Y/m/d", strtotime($v['v']) ) ];
				}else if( $d == "yyyy/dd/mm" ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date("Y/d/m", strtotime($v['v']) ) ];
				}else if( $d == btoa('eXl5eS1tbS1kZA==') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('WS1tLWQ='), strtotime($v['v']) ) ];
				}else if( $d == btoa('eXl5eS1tbS1kZA==') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('WS1tLWQ='), strtotime($v['v']) ) ];
				}else if( $d == btoa('ZGQtbW0teXl5eQ==') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('ZC1tLVk='), strtotime($v['v']) ) ];
				}else if( $d == btoa('ZGQtTU0teXl5eQ==') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('ZC1GLVk='), strtotime($v['v']) ) ];
				}else if( $d == btoa('ZGQgTU0geXl5eQ==') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('ZCBGIFk='), strtotime($v['v']) ) ];
				}else if( $d == btoa('eXl5eSBNTSBkZA==') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('WSBGIGQ='), strtotime($v['v']) ) ];
				}else if( $d == btoa('eXl5eS1NTS1kZA==') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('WS1GLWQ='), strtotime($v['v']) ) ];
				}else if( $d == btoa('ZGQtTS15eXl5') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('ZC1NLVk='), strtotime($v['v']) ) ];
				}else if( $d == btoa('ZGQgTSB5eXl5') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('ZCBNIFk='), strtotime($v['v']) ) ];
				}else if( $d == btoa('eXl5eSBNIGRk') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('WSBNIGQ='), strtotime($v['v']) ) ];
				}else if( $d == btoa('eXl5eS1NLWRk') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('WS1NLWQ='), strtotime($v['v']) ) ];
				}else if( $d == btoa('ZGQgREQgTU0geXl5eQ==') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('ZCBEIEYgWQ=='), strtotime($v['v']) ) ];
				}else if( $d == btoa('eXl5eSBERCBkZCBNTQ==') ){
					return ['t'=>btoa('VA=='), btoa('dg==')=>date(btoa('WSBkIEQgRg=='), strtotime($v['v']) ) ];
				}else{
					return ['t'=>btoa('VA=='), btoa('dg==')=>$v['v']];
				}
			}
			if( $vs['v'] == btoa('YWRkRGF5cw==') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date(btoa('WS1tLWQ='), strtotime($v['v'])+ (86400*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('YWRkTW9udGhz') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date(btoa('WS1tLWQ='), strtotime($v['v'])+ (86400*30*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('YWRkWWVhcnM=') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date(btoa('WS1tLWQ='), strtotime($v['v'])+ (86400*365*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3REYXlz') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date(btoa('WS1tLWQ='), strtotime($v['v'])- (86400*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3RNb250aHM=') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date(btoa('WS1tLWQ='), strtotime($v['v'])- (86400*30*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3RZZWFycw==') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date(btoa('WS1tLWQ='), strtotime($v['v'])- (86400*365*$d) );
				return $v;
			}
		}else if( $v['t'] == btoa('RFQ=') ){
			if( $vs['v'] == btoa('Z2V0') ){
				return $v;
			}
			if( $vs['v'] == btoa('c2V0') ){
				$v['v'] = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				return $v;
			}
			if( $vs['v'] == btoa('c2V0VmFsdWU=') ){
				$y =  $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$m =  $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p3']['v'])['v'];
				$d =  $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p4']['v'])['v'];
				$h =  $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p5']['v'])['v'];
				$i =  $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p6']['v'])['v'];
				$s =  $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p7']['v'])['v'];
				$tz = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p8']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", mktime(12,12,12,$m,$d,$y));
				$v['tz'] = $tz;
				return $v;
			}
			if( $vs['v'] == btoa('Z2V0RGF0ZQ==') ){
				return ['t'=>btoa('Tg=='), date(btoa('ZA=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0TW9udGg=') ){
				return ['t'=>btoa('Tg=='), date(btoa('bQ=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0WWVhcg==') ){
				return ['t'=>btoa('Tg=='), date(btoa('WQ=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0TW9udGhGdWxs') ){
				return ['t'=>btoa('VA=='), date(btoa('TQ=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0TW9udGhTaG9ydA==') ){
				return ['t'=>btoa('VA=='), date(btoa('Rg=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0RGF5RnVsbA==') ){
				return ['t'=>btoa('VA=='), date(btoa('bA=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0RGF5U2hvcnQ=') ){
				return ['t'=>btoa('VA=='), date(btoa('RA=='), strtotime($v['v'])) ];
			}
			if( $vs['v'] == btoa('Z2V0VGltZVpvbmU=') ){
				return ['t'=>btoa('VA=='), btoa('dg==')=>$v['tz'] ];
			}
			if( $vs['v'] == btoa('c2V0VGltZVpvbmU=') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				$v['ts'] = $d['v'];
				return $v;
			}
			if( $vs['v'] == btoa('YWRkRGF5cw==') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])+ (86400*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('YWRkTW9udGhz') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])+ (86400*30*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('YWRkWWVhcnM=') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])+ (86400*365*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('YWRkSG91cnM=') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])+ (60*60*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('YWRkTWludXRlcw==') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])+ (60*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('YWRkU2Vjb25kcw==') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])+ ($d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3REYXlz') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])- (86400*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3RNb250aHM=') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])- (86400*30*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3RZZWFycw==') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v'])- (86400*365*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3RIb3Vycw==') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v']) - (60*60*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3RNaW51dGVz') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v']) - (60*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3RTZWNvbmRz') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", strtotime($v['v']) - ($d) );
				return $v;
			}
		}else if( $v['t'] == btoa('VFM=') ){
			if( $vs['v'] == btoa('Z2V0') ){
				return $v;
			}
			if( $vs['v'] == btoa('c2V0') ){
				$v['v'] = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				return $v;
			}
			if( $vs['v'] == btoa('c2V0VmFsdWU=') ){
				$y =  $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$m =  $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p3']['v'])['v'];
				$d =  $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p4']['v'])['v'];
				$h =  $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p5']['v'])['v'];
				$i =  $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p6']['v'])['v'];
				$s =  $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p7']['v'])['v'];
				$tz = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p8']['v'])['v'];
				$v['v'] = mktime(12,12,12,$m,$d,$y);
				$v['tz'] = $tz;
				return $v;
			}
			if( $vs['v'] == btoa('Z2V0RGF0ZQ==') ){
				return ['t'=>btoa('Tg=='), date(btoa('ZA=='), (int)$v['v']) ];
			}
			if( $vs['v'] == btoa('Z2V0TW9udGg=') ){
				return ['t'=>btoa('Tg=='), date(btoa('bQ=='), (int)$v['v']) ];
			}
			if( $vs['v'] == btoa('Z2V0WWVhcg==') ){
				return ['t'=>btoa('Tg=='), date(btoa('WQ=='), (int)$v['v']) ];
			}
			if( $vs['v'] == btoa('Z2V0TW9udGhGdWxs') ){
				return ['t'=>btoa('VA=='), date(btoa('TQ=='), (int)$v['v']) ];
			}
			if( $vs['v'] == btoa('Z2V0TW9udGhTaG9ydA==') ){
				return ['t'=>btoa('VA=='), date(btoa('Rg=='), (int)$v['v']) ];
			}
			if( $vs['v'] == btoa('Z2V0RGF5RnVsbA==') ){
				return ['t'=>btoa('VA=='), date(btoa('bA=='), (int)$v['v']) ];
			}
			if( $vs['v'] == btoa('Z2V0RGF5U2hvcnQ=') ){
				return ['t'=>btoa('VA=='), date(btoa('RA=='), (int)$v['v']) ];
			}
			if( $vs['v'] == btoa('Z2V0VGltZVpvbmU=') ){
				return ['t'=>btoa('VA=='), btoa('dg==')=>$v['tz'] ];
			}
			if( $vs['v'] == btoa('c2V0VGltZVpvbmU=') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v']);
				$v['ts'] = $d['v'];
				return $v;
			}
			if( $vs['v'] == btoa('YWRkRGF5cw==') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']+ (86400*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('YWRkTW9udGhz') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']+ (86400*30*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('YWRkWWVhcnM=') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']+ (86400*365*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('YWRkSG91cnM=') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']+ (60*60*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('YWRkTWludXRlcw==') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']+ (60*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('YWRkU2Vjb25kcw==') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']+ ($d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3REYXlz') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']- (86400*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3RNb250aHM=') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']- (86400*30*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3RZZWFycw==') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v']- (86400*365*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3RIb3Vycw==') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v'] - (60*60*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3RNaW51dGVz') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v'] - (60*$d) );
				return $v;
			}
			if( $vs['v'] == btoa('c3VidHJhY3RTZWNvbmRz') ){
				$d = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($inputs['p2']['v'])['v'];
				$v['v'] = date("Y-m-d H:i:s", (int)$v['v'] - ($d) );
				return $v;
			}
		}
		return $rt;
	}
	function s1_SG9kbVZtZGQwSG55OUZzNy90MmNMUT09( $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09 ){
		$v = 0;
		$op = "+";
		foreach( $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09 as $i=>$j ){
			if( $op == "+" ){
				$v = $v + $this->s1_Vk1rY284SnU5aTk3WUx4dGxDOTN1dz09( $j['m'] );
			}else if( $op == btoa('LQ==') ){
				$v = $v - $this->s1_Vk1rY284SnU5aTk3WUx4dGxDOTN1dz09( $j['m'] );
			}else if( $op == "/" ){
				$v = $v / $this->s1_Vk1rY284SnU5aTk3WUx4dGxDOTN1dz09( $j['m'] );
			}else if( $op == "*" ){
				$v = $v * $this->s1_Vk1rY284SnU5aTk3WUx4dGxDOTN1dz09( $j['m'] );
			}else if( $op == "%" ){
				$v = $v % $this->s1_Vk1rY284SnU5aTk3WUx4dGxDOTN1dz09( $j['m'] );
			}else if( $op == "^" ){
				$v = $v ^ $this->s1_Vk1rY284SnU5aTk3WUx4dGxDOTN1dz09( $j['m'] );
			}
			$op = $j['OP'];
			//echo $v . ": " . $op . " : \n";
			if( $op == btoa('Lg==') ){break;}
		}
		return $v;
	}
	function s1_Vk1rY284SnU5aTk3WUx4dGxDOTN1dz09( $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09 ){
		$v = 0;
		$op = "+";
		foreach( $s1_ektOWXJ5R1kxMHg0ZjY1c3lXL1g1QT09 as $i=>$j ){
			$vv = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($j);
			if( $vv['t'] != btoa('Tg==') ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Warning: Math: non numeric operand: " . ($j['v'] == btoa('Vg==')?$j['v']['t'].":".$j['v']['v']:$j['t'].":".$j['v']);
			}
			$vv['v'] = $this->s1_NlhHQUZpczAxZkhodzhranY4ZkhmUT09($vv['v']);
			//echo $vv['v'] . btoa('IA==') . $op . " \n";
			if( $op == "+" ){
				$v = $v + $vv['v'];
			}else if( $op == btoa('LQ==') ){
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
			if( $op == btoa('Lg==') ){break;}
		}
		//echo "ret: " . $v . ": \n";
		return $v;
	}
	function s1_NlhHQUZpczAxZkhodzhranY4ZkhmUT09($v){
		if( gettype($v) == btoa('c3RyaW5n') ){
			if( is_numeric($v) ){
				if( preg_match("/\./",$v) ){
					return (float)$v;
				}else{
					return (int)$v;
				}
			}else{
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Numeric expected: ". $v;
				return 0;
			}
		}else if( gettype($v) == btoa('aW50ZWdlcg==') || gettype($v) == btoa('ZmxvYXQ=') || gettype($v) == btoa('ZG91Ymxl') ){
			return $v;
		}else{
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Numeric expected: ". gettype($v) . ": ". $v;
			return 0;
		}
	}
	function s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( &$d ){
		if( array_keys($d)[0] === 0 ){
			for($i=0;$i<sizeof($d);$i++){
				$j = $d[$i];
				if( gettype($j) == btoa('YXJyYXk=') ){
					$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09($j);
					if( array_keys($j)[0] === 0 ){
						$d[ $i ] = [btoa('dA==')=>btoa('TA=='), btoa('dg==')=>$j];
					}else{
						$d[ $i ] = [btoa('dA==')=>btoa('Tw=='), btoa('dg==')=>$j];
					}
				}else if( gettype($j) == btoa('c3RyaW5n') ){
					$d[ $i ] = [btoa('dA==')=>btoa('VA=='), btoa('dg==')=>$j];
				}else if( gettype($j) == btoa('ZG91Ymxl') || gettype($j) == btoa('ZmxvYXQ=') || gettype($j) == btoa('aW50ZWdlcg==') ){
					$d[ $i ] = [btoa('dA==')=>btoa('Tg=='), btoa('dg==')=>$j];
				}else if( gettype($j) == btoa('Ym9vbGVhbg==') ){
					$d[ $i ] = [btoa('dA==')=>btoa('Qg=='), btoa('dg==')=>$j];
				}else if( gettype($j) == btoa('TlVMTA==') ){
					$d[ $i ] = [btoa('dA==')=>btoa('Tkw='), btoa('dg==')=>null];
				}
			}
		}else{
			foreach( $d as $i=>$j ){
				if( gettype($j) == btoa('YXJyYXk=') ){
					$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09($j);
					if( array_keys($j)[0] === 0 ){
						$d[ $i ] = [btoa('dA==')=>btoa('TA=='), btoa('dg==')=>$j];
					}else{
						$d[ $i ] = [btoa('dA==')=>btoa('Tw=='), btoa('dg==')=>$j];
					}
				}else if( gettype($j) == btoa('c3RyaW5n') ){
					$d[ $i ] = [btoa('dA==')=>btoa('VA=='), btoa('dg==')=>$j];
				}else if( gettype($j) == btoa('ZG91Ymxl') || gettype($j) == btoa('ZmxvYXQ=') || gettype($j) == btoa('aW50ZWdlcg==') ){
					$d[ $i ] = [btoa('dA==')=>btoa('Tg=='), btoa('dg==')=>$j];
				}else if( gettype($j) == btoa('Ym9vbGVhbg==') ){
					$d[ $i ] = [btoa('dA==')=>btoa('Qg=='), btoa('dg==')=>$j];
				}else if( gettype($j) == btoa('TlVMTA==') ){
					$d[ $i ] = [btoa('dA==')=>btoa('Tkw='), btoa('dg==')=>null];
				}
			}
		}
		//return $d;
	}
	function s1_Y2ZYL0pvVUlRZlNIY25semw2UVh1UT09( $d ){
		foreach( $d as $i=>$j ){
			if( preg_match("/(\.|\-\>)/", $i) ){
				$x = explode(btoa('Lg=='),$i);
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
	
	function s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $key, $v ){
		if( is_object($v) ){
			return 0;
		}else if( is_string($key) ){
			$var = $key;
		}else if( is_array($key) && isset($key['v']) && isset($key['t']) ){
			if( is_object($key['v']) ){
				return 0;
			}
			if( $key['t'] != btoa('Vg==') ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "ERROR: set_result: incorrect key.: " . print_r($key,true);
				return false;
			}
			$var = $key['v']['v'];
		}else{
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "ERROR: set_result: incorrect key..: " . print_r($key,true);
			return 0;
		}
		if( !isset($v) ){
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('SW5wdXQgTWlzc2luZw==');
		}else{
			if( !is_array($v) ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Warning: " . $var . btoa('IEludmFsaWQgQXNzaWdubWVudA==');
				$v = [btoa('dA==')=>btoa('Tg=='),btoa('dg==')=>0];
			}else if( $v['t'] == btoa('Tg==') ){
				if( $v['v'] != "" ){
					if( is_float($v['v']) && ( is_infinite($v['v']) || is_nan($v['v']) ) ){
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Warning: " . $var . " = Infinate/Nan: 0";
						$v = [btoa('dA==')=>btoa('Tg=='),btoa('dg==')=>0];
					}else if( is_float($v['v']) ){
						$v['v'] = (float)$v['v'];
					}else{
						//echo gettype($v['v']); echo btoa('eWVz');
						$v['v'] = (int)$v['v'];
					}
				}else{
					$v['v'] = 0;
				}
			}
			if( gettype($v['t']) == btoa('QklO') ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Set: " . $var . " = BinaryData";
			}else if( gettype($v['v']) == btoa('YXJyYXk=') ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Set: " . $var  . " = ";
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $v['v'];
			}else if( gettype($v['v']) == btoa('b2JqZWN0') ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Set: " . $var  . " = Object ";
			}else if( gettype($v['v']) == btoa('c3RyaW5n') || $v['t'] == btoa('VA==') ){
				if( $this->isBinary($v['v']) ){
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Set: " . $var . " = BinaryData in " . $v['t'];
				}else{
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Set: " . $var . " = " . substr($v['v'],0,200) . (strlen($v['v'])>200?btoa('Li4u'):"" );
				}
			}else{
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Set: " . $var . " = " . $v['v'];
			}
			$x = explode("->",$var);
			$k = $this->s1_QVBxZVdUbGJNTmNEYmd0WGJWVk90QT09( $x, $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09, $v );
			if( !$k ){ $this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Set: Fail "; }
		}
	}
	function s1_QVBxZVdUbGJNTmNEYmd0WGJWVk90QT09( $x, &$r, $v ){
		//print_r( $x ); print_r( $r );
		$key = $x[0];
		if( isset($r[ $key ]) ){
			if( sizeof($x) > 1 ){
				if( $r[ $key ]['t'] == btoa('Tw==') ){
					array_splice($x,0,1);
					return $this->s1_QVBxZVdUbGJNTmNEYmd0WGJWVk90QT09($x, $r[ $key ]['v'], $v);
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
	function s1_elo2U1V6TExMWDZ2bUwyWmJQV2s2QT09( $i, $v ){
		if( $i ){
			if( is_infinite($v) || is_nan($v) ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Assign: " . $i  . " = Infinate/Nan: 0";
				$v = 0;
			}else{
				if( gettype($v) == btoa('c3RyaW5n') ){
					$v = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $v);  // rpelace all non printable chars
				}
				if( gettype($v) == btoa('YXJyYXk=') || gettype($v) == btoa('b2JqZWN0') ){
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Set: " . $i  . " = ";
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $v;
				}else if( gettype($v) == btoa('c3RyaW5n') ){
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Set: " . $i  . " = " . substr($v,0,500) . (strlen($v)>500?btoa('Li4u'):"" );
				}else{
					$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Set: " . $i  . " = " . $v;
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
	function s1_V2tKZU96dHZDK1gzOUFOQ25LNW5UQT09( $i ){
		if( $i ){
			$x = explode("->",$i);
			if( sizeof($x) == 1 ){
				unset( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $x[0] ] );
			}else if( sizeof($x) == 2 ){
				unset( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $x[0] ][ $x[1] ] );
			}else if( sizeof($x) == 3 ){
				unset( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $x[0] ][ $x[1] ][ $x[2] ] );
			}else if( sizeof($x) == 4 ){
				unset( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ] );
			}else if( sizeof($x) == 5 ){
				unset( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ] );
			}else if( sizeof($x) == 6 ){
				unset( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ][ $x[6] ] );
			}else if( sizeof($x) == 7 ){
				unset( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ][ $x[6] ][ $x[7] ] );
			}else if( sizeof($x) == 8 ){
				unset( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09[ $x[0] ][ $x[1] ][ $x[2] ][ $x[4] ][ $x[5] ][ $x[6] ][ $x[7] ][ $x[8] ] );
			}
		}
		return $v;
	}
	function s1_emlhQ1pSNjkxaStUMGwxZ1dYS0NkUT09( &$k ){
		//print_pre( $k );exit;
		$var = $k['v'];
		$x = explode("->",$var);
		$v = $this->s1_dWE5UVYrTjZTd2hJN2NLS3ZERjhNUT09( $x, $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09, $k );
	}
	function s1_dWE5UVYrTjZTd2hJN2NLS3ZERjhNUT09( $x, &$r, &$k ){
		// print_pre( $x );
		// print_pre( $r );
		$key = $x[0];
		if( isset($r[ $key ]) ){
			if( sizeof($x) > 1 ){
				array_splice($x,0,1);
				if( $r[ $key ]['t'] == btoa('Tw==') ){
					$this->s1_dWE5UVYrTjZTd2hJN2NLS3ZERjhNUT09( $x, $r[ $key ]['v'], $k);
				}
			}else{
				$this->s1_cjV2UStyZlR2YnhUcDRlVWcrU1pVQT09( $r[ $key ], $k['vs'] );
			}
		}
	}
	function s1_OGh2MVBCVjdhWlpNb3Z5aUw4aWRnZz09( &$k ){
		//print_pre( $k );exit;
		$var = $k['v'];
		$x = explode("->",$var);
		$v = $this->s1_dmcvZTMyUXFnQ0NkNjdxK0VtcVV6UT09( $x, $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09, $k );
	}
	function s1_dmcvZTMyUXFnQ0NkNjdxK0VtcVV6UT09( $x, &$r, &$k ){
		// print_pre( $x );
		// print_pre( $r );
		$key = $x[0];
		if( isset($r[ $key ]) ){
			if( is_object($r[ $key ]) ){
				$this->s1_cWMzaU5kOG5GaGNzZHhTUldIWXczQT09( $r[ $key ], $k['vs'] );
			}else if( sizeof($x) > 1 ){
				array_splice($x,0,1);
				if( $r[ $key ]['t'] == btoa('Tw==') ){
					$this->s1_dmcvZTMyUXFnQ0NkNjdxK0VtcVV6UT09( $x, $r[ $key ]['v'], $k);
				}
			}else{
				$this->s1_cWMzaU5kOG5GaGNzZHhTUldIWXczQT09( $r[ $key ], $k['vs'] );
			}
		}
	}
	function s1_cHpYbklOaFFGN0lVVDAwVU41cWhsQT09( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09 ){
		//print_r( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09 );exit;
		if( !is_array($s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09) ){
			$v = ['t'=>btoa('VA=='), btoa('dg==')=>""];
			if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09 ){
				$x = explode("->",$s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09);
				//print_pre( $x );
				$v = $this->s1_VzlqdktlSzREd0VqMi9qQ0ZMck9QZz09( $x, $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 );
				//print_pre( $v );exit;
			}
			if( !isset($v['t']) || !isset($v['v']) ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Error: Variable " . $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09 . btoa('IEludmFsaWQgdmFsdWU=');
				$v = ['t'=>btoa('VA=='), btoa('dg==')=>""];
			}else{
				return $v;
			}
			return $v;
		}else if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['t'] && isset($s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']) ){
			if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['t']==btoa('Vg==') ){
				$val = $this->s1_cHpYbklOaFFGN0lVVDAwVU41cWhsQT09( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['v'] );
				if( isset( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['vs']['v'] ) ){
					if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['vs']['v'] != "" ){
						$newval = $this->s1_cWMzaU5kOG5GaGNzZHhTUldIWXczQT09( $val, $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['vs'], $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['v'] );
						return $newval;
					}
				}
				return $val;
			}else{
				$val = $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v'];
				if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['t'] == btoa('Tg==') && gettype($val) == btoa('c3RyaW5n') ){
					if( preg_match("/\./", $val) ){ $val = (float)$val; }else{ $val = (int)$val; }
					//echo $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['t'] . ": " . $val . "\n";
				}
				return [btoa('dA==')=>$s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['t'], btoa('dg==')=>$val];
			}
		}else{
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "ERROR: get_value: incorrect: ";
			$v = ['t'=>btoa('VA=='), btoa('dg==')=>""];
			return $v;
		}
	}
	function s1_VzlqdktlSzREd0VqMi9qQ0ZMck9QZz09( $x, &$r ){
		// echo "get value2 \n";
		// print_pre( $x );
		// print_pre( $r );
		$key = $x[0];
		if( $key == "[]" ){ $key = 0; }
		if( isset($r[ $key ]) ){
			if( sizeof($x) > 1 ){
				array_splice($x,0,1);
				if( $r[ $key ]['t'] == btoa('Tw==') ){
					return $this->s1_VzlqdktlSzREd0VqMi9qQ0ZMck9QZz09($x, $r[ $key ]['v']);
				}else if( $r[ $key ]['t'] == btoa('TA==') ){
					return $this->s1_VzlqdktlSzREd0VqMi9qQ0ZMck9QZz09($x, $r[ $key ]['v']);
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
	function s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09 ){
		//print_r( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09 );exit;
		if( !is_array($s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09) ){
			$v = ['t'=>btoa('VA=='), btoa('dg==')=>""];
			if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09 ){
				$x = explode("->",$s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09);
				//print_pre( $x );
				$v = $this->s1_QmtBNkFHRU5OWCtWbDg0d0ZBVEVXZz09( $x, $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 );
				//print_pre( $v );exit;
			}
			if( !isset($v['t']) || !isset($v['v']) ){
				$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Error: Variable " . $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09 . btoa('IEludmFsaWQgdmFsdWU=');
				$v = ['t'=>btoa('VA=='), btoa('dg==')=>""];
			}else{
				return $v;
			}
			return $v;
		}else if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['t'] && isset($s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']) ){
			//echo "get value\n" ; print_pre( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09 );
			if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['t']==btoa('Vg==') ){
				if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['plg'] ){
					//echo "get plg value: \n";
					$val = $this->s1_cHpYbklOaFFGN0lVVDAwVU41cWhsQT09( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['v'] );
					//print_pre($val);
					if( isset( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['vs']['v'] ) ){
						if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['vs']['v'] != "" ){
							//echo "do plg function: " . $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['vs']['v'] . "\n";
							$newval = $this->s1_cWMzaU5kOG5GaGNzZHhTUldIWXczQT09( $val, $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['vs'], $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['v'] );
							//echo "returning 2: \n"; print_pre( $new_value );
							return $newval;
						}
					}
					//echo "returning: \n"; print_pre( $val );
					return $val;
				}else{
					//print_pre( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['v'] );
					$val = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['v'] );
					//print_pre($val);
					if( isset( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['vs']['v'] ) ){
						//echo btoa('MTEx') . $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['vs']['v'] . btoa('MTExMQ==');
						if( trim($s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['vs']['v']) != "" ){
							$newval = $this->s1_cjV2UStyZlR2YnhUcDRlVWcrU1pVQT09( $val, $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['vs'], $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']['v'] );
							return $newval;
						}
					}	
					//echo "returning: \n"; print_pre( $val );
					return $val;
				}
			}else{
				$val = $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v'];
				if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['t'] == btoa('Tg==') && gettype($val) == btoa('c3RyaW5n') ){
					if( preg_match("/\./", $val) ){ $val = (float)$val; }else{ $val = (int)$val; }
					//echo $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['t'] . ": " . $val . "\n";
				}
				//echo "returning: \n"; print_pre( $val );
				return [btoa('dA==')=>$s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['t'], btoa('dg==')=>$val];
			}
		}else{
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "ERROR: get_value: incorrect: ";
			$v = ['t'=>btoa('VA=='), btoa('dg==')=>""];
			return $v;
		}
	}
	function s1_QmtBNkFHRU5OWCtWbDg0d0ZBVEVXZz09( $x, &$r ){
		// echo "get value2 \n";
		// print_pre( $x );
		// print_pre( $r );
		$key = $x[0];
		if( $key == "[]" ){ $key = 0; }
		if( isset($r[ $key ]) ){
			if( sizeof($x) > 1 ){
				array_splice($x,0,1);
				if( $r[ $key ]['t'] == btoa('Tw==') ){
					return $this->s1_QmtBNkFHRU5OWCtWbDg0d0ZBVEVXZz09($x, $r[ $key ]['v']);
				}else if( $r[ $key ]['t'] == btoa('TA==') ){
					return $this->s1_QmtBNkFHRU5OWCtWbDg0d0ZBVEVXZz09($x, $r[ $key ]['v']);
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
	function s1_aktyRE5hZUxLTjZzK0kxM3NsQmVYUT09( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09 ){
		$s1_T1ZmNzV5N3E4TWZqci9vRDhxS2dpZz09 = "";
		if( is_array($s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09) ){
			if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['t'] && isset($s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v']) ){
				if( $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['t'] == btoa('Vg==') ){
					$s1_T1ZmNzV5N3E4TWZqci9vRDhxS2dpZz09 = $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09['v'];
				}else{
					return true;
				}
			}else{
				return false;
			}
		}else if( is_string($s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09) ){
			$s1_T1ZmNzV5N3E4TWZqci9vRDhxS2dpZz09 = $s1_RW1CblU0azIyZDc1UEFQa1VYTGdKQT09;
		}
		if( $s1_T1ZmNzV5N3E4TWZqci9vRDhxS2dpZz09 ){
			//print_pre( $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 );
			$x = explode("->", $s1_T1ZmNzV5N3E4TWZqci9vRDhxS2dpZz09);
			return $this->s1_dzhJRUUrbHRqMVlEWThYMFgwOWVsZz09( $x, $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 );
		}
		return false;
	}
	function s1_dzhJRUUrbHRqMVlEWThYMFgwOWVsZz09( $x, $r ){
		$key = $x[0];
		if( isset($r[ $key ]) ){
			if( sizeof($x) > 1 ){
				array_splice($x,0,1);
				if( $r[ $key ]['t'] == btoa('Tw==') ){
					return $this->s1_dzhJRUUrbHRqMVlEWThYMFgwOWVsZz09($x, $r[ $key ]['v']);
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
	function s1_NnZrUG1mVkFMcVVXWkZvSzVTYjJDdz09( $error ){
		if( isset($this->s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09['raw_output']) ){
			return ['status'=>btoa('ZmFpbA=='),btoa('ZXJyb3I=')=>$error];
		}else{
			$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['statusCode'] = 500;
			$this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09['body'] = $error;
			return $this->s1_NUo1eU5RRFRuWFlqZ2hUVE1JRnAxdz09;
		}
	}
	function s1_MUpseW9kbVVUWkdNR3RGRHRJZ0wxQT09($v){
		foreach($v as $i=>$j ){
			if( gettype($j) == btoa('YXJyYXk=') ){
				$v[$i] = $this->s1_MUpseW9kbVVUWkdNR3RGRHRJZ0wxQT09($j);
			}else if( gettype($j) == btoa('ZmxvYXQ=') || gettype($j) == btoa('ZG91Ymxl') ){
				if( is_infinite($j) ){
					$v[$i] = btoa('TlVMTA==');
				}
			}else if( is_nan($j) ){
				$v[$i] = btoa('TlVMTA==');
			} 
		}
		//print_pre( $v );
		return $v;
	}
	function s1_RDJKVnV0bnJESStXYzFscEQ3KzhtQT09( $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 ){
		$n = 0;
		for($i=$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09+1;$i<sizeof($this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages']);$i++){
			if( $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][ $i ]['type'] == btoa('RW5kV2hpbGU=') ||  $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][ $i ]['type'] == btoa('RW5kRm9y') || $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][ $i ]['type'] == btoa('RW5kRm9yRWFjaA==') ){
				return $i;
			}
		}
		return $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09+1;
	}
	function s1_ektxNGd0RHZ6cERzaXNOMktOajlkUT09( $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 ){
		$lastif = -1;
		$n = 0;
		$vrand = $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][ $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 ]['vrand'];
		for($i=$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09+1;$i<sizeof($this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages']);$i++){
			if( $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][ $i ]['vrand'] == $vrand ){
				$lastif = $i;
				break;
			}
		}
		return $lastif;
	}
	function s1_dFZsT0h5UFdCTkdoNHc1cWtVQmx3dz09( $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 ){
		$lastif = -1;
		$n = 0;
		$vrand = $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][ $s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09 ]['vrand'];
		for($i=$s1_eEZOR24xWEY2bEpmbE1qb2dWMjVJZz09-1;$i>-1;$i--){
			//print_pre($this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages']);
			if( $this->s1_aXowSVBuaGZRRlpCeGZCaHhGN1ZsZz09[btoa('ZW5naW5l')]['stages'][ $i ]['vrand'] == $vrand ){
				$lastif = $i;
				break;
			}
		}
		//echo "lastif = ".$lastif. "<br>";
		return $lastif;
	}
	function s1_M1FPR3VJRGpLWVBKaFBiVE1DOEN3QT09( $value, $template ){
		if( 1==15 ){
			print_pre($value);
			print_pre($template);
			exit;
		}
		$outputs = [];
		foreach( $template as $i=>$j ){
			//echo "<div>" . $i . ": " . $j['name'] . "</div>";
			if( $value[ $i ] || is_numeric($value[$i]) ){
				if( $j[btoa('dmFsdWU=')] ){
					$outputs[ $j[btoa('dmFsdWU=')] ] = $value[$i];
				}else if( $j[btoa('c3Vi')] ){
					$o = $this->s1_M1FPR3VJRGpLWVBKaFBiVE1DOEN3QT09( $value[$i], $j[btoa('c3Vi')] );
					foreach( $o as $ii=>$jj ){
						$outputs[ $ii ] = $jj;
					}
				}
			}
		}
		return $outputs;
	}

	function s1_VnU1S004YVZKbFNzc3VJdHg3Q3EvQT09( $v, $enclose = true ){
		if( $enclose ){
			return "[".$v."]";
		}else{
			return $v;
		}
	}

	function s1_ak9mYzJIRGRRY1lYTEZLYzN0WEJWQT09( $v ){
		$vv = [];
		if( is_array($v) ){
			if( array_keys($v)[0] === 0 ){
				for($i=0;$i<sizeof($v);$i++){
					$vv[ $v[$i]['k']['v'] ] = $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09( $v[$i]['v'] );
				}
			}
		}
		return $vv;
	}

	function s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $v ){
		// echo "template to array\n";
		// print_pre( $v );
		if( is_array($v) ){
			if( array_keys($v)[0] === 0 ){
				for($i=0;$i<sizeof($v);$i++){
					$j = $v[ $i ];
					if( gettype($j) == btoa('YXJyYXk=') ){
						if( $j['t'] == btoa('Vg==') ){
							$j = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $j );
						}
						if( gettype($j['v']) == btoa('c3RyaW5n') ){
							if( $this->isBinary($j['v']) ){
								$j['v'] = btoa('QmluYXJ5IFN0cmlwcGVk');
							}
						}
						if( $j['t'] == btoa('Tw==') || $j['t'] == btoa('TA==') ){
							$v[ $i ] = $this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $j['v'] );
						}else if( $j['t'] == btoa('Tg==') ){
							if( gettype($j['v']) == btoa('c3RyaW5n') ){
								if( preg_match("/\./", $j['v']) ){
									$v[ $i ] = (float)$j['v'];
								}else{
									$v[ $i ] = (int)$j['v'];
								}
							}else{
								$v[ $i ] = $j['v'];
							}
						}else if( $j['t'] == btoa('RFQ=') ){
							$v[ $i ] = $j['v']['v'] . btoa('IA==') . $j['v']['tz'];
						}else if( $j['t'] == btoa('Qg==') ){
							$v[ $i ] = ((!$j['v']||$j['v']==btoa('ZmFsc2U='))?false:true);
						}else if( $j['t'] == btoa('Tkw=') ){
							$v[ $i ] = null;
						}else{
							$v[ $i ] = $j['v'];
						}
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "ERROR: template_to_array: incorrect item: " . $j; 
					}
				}
			}else{
				foreach( $v as $i=>$j ){
					//echo "Each key: " . $i . "\n";
					if( gettype( $j ) == btoa('YXJyYXk=') ){
						if( $j['t'] == btoa('Vg==') ){
							$j = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $j );
							//print_pre($j);
						}
						if( gettype($j['v']) == btoa('c3RyaW5n') ){
							if( $this->isBinary($j['v']) ){
								$j['v'] = btoa('QmluYXJ5IFN0cmlwcGVk');
							}
						}
						if( $j['t'] == btoa('Tw==') || $j['t'] == btoa('TA==') ){
							$v[ $i ] = $this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $j['v'] );
							//print_pre( $v[ $i ] );
							//echo btoa('eHh4');exit;
						}else if( $j['t'] == btoa('Tg==') ){
							if( gettype($j['v']) == btoa('c3RyaW5n') ){
								if( preg_match("/\./", $j['v']) ){
									$v[ $i ] = (float)$j['v'];
								}else{
									$v[ $i ] = (int)$j['v'];
								}
							}else{
								$v[ $i ] = $j['v'];
							}
						}else if( $j['t'] == btoa('Qg==') ){
							$v[ $i ] = ((!$j['v']||$j['v']==btoa('ZmFsc2U='))?false:true);
						}else if( $j['t'] == btoa('RFQ=') ){
							$v[ $i ] = $j['v']['v'] . btoa('IA==') . $j['v']['tz'];
						}else if( $j['t'] == btoa('Tkw=') ){
							$v[ $i ] = null;
						}else{
							$v[ $i ] = $j['v'];
						}
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "Error: unhandled parts " .$j;
						//echo btoa('VW5oYW5kbGVkIHBhcnRz');
						//print_pre( $j );
						$v[ $i ] = ['t'=>btoa('VA=='), btoa('dg==')=>$j . "(Unhandled)"];
					}
				}
			}
		}else{
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "template to array: " . gettype($v);
		}
		// echo "template to array returning...\n";
		// print_pre( $v );
		return $v;
	}
	function s1_cXNrYVlUbXp6eWZ3WkU2eDQxTEZiUT09( $v ){
		// echo "template to array\n";
		// print_pre( $v );
		if( is_array($v) ){
			if( array_keys($v)[0] === 0 ){
				for($i=0;$i<sizeof($v);$i++){
					$j = $v[ $i ];
					if( gettype($j) == btoa('YXJyYXk=') ){
						if( $j['t'] == btoa('Vg==') ){
							$v[ $i ] = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $j );
						}else if( $j['t'] == btoa('Tw==') || $j['t'] == btoa('TA==') ){
							$v[ $i ]['v'] = $this->s1_cXNrYVlUbXp6eWZ3WkU2eDQxTEZiUT09( $j['v'] );
						}
						if( gettype($v[ $i ]['v']) == btoa('c3RyaW5n') ){
							if( $this->isBinary($v[ $i ]['v']) ){
								$v[ $i ]['v'] = btoa('QmluYXJ5IFN0cmlwcGVk');
							}
						}
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "ERROR: template_to_substitute: incorrect item: " . $j; 
					}
				}
			}else if( isset($v['t']) && isset($v['v']) ){
				$v = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($v);
				print_pre( $v );
			}else{
				foreach( $v as $i=>$j ){
					//echo "Each key: " . $i . "\n";
					if( gettype($j) == btoa('YXJyYXk=') ){
						if( $j['t'] == btoa('Vg==') ){
							$v[ $i ] = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $j );
						}else if( $j['t'] == btoa('Tw==') || $j['t'] == btoa('TA==') ){
							$v[ $i ]['v'] = $this->s1_cXNrYVlUbXp6eWZ3WkU2eDQxTEZiUT09( $j['v'] );
						}
						if( gettype($v[ $i ]['v']) == btoa('c3RyaW5n') ){
							if( $this->isBinary($v[ $i ]['v']) ){
								$v[ $i ]['v'] = btoa('QmluYXJ5IFN0cmlwcGVk');
							}
						}
					}else{
						$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "ERROR: template_to_substitute: incorrect item: " . $j; 
					}
				}
			}
		}else{
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "template_to_substitute: " . gettype($v);
		}
		// echo "template to array returning...\n";
		// print_pre( $v );
		return $v;
	}
	function s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09( $j ){
		if( $j['t'] == btoa('Vg==') ){
			$j = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $j );
		}
		if( gettype($j['v']) == btoa('c3RyaW5n') ){
			if( $this->isBinary($j['v']) ){
				$j['v'] = btoa('QmluYXJ5IFN0cmlwcGVk');
			}
		}
		if( $j['t'] == btoa('Tw==') || $j['t'] == btoa('TA==') ){
			$v = $this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $j['v'] );
		}else if( $j['t'] == btoa('Tg==') ){
			if( gettype($j['v']) == btoa('c3RyaW5n') ){
				if( preg_match("/\./", $j['v']) ){
					$v = (float)$j['v'];
				}else{
					$v = (int)$j['v'];
				}
			}else{
				$v = $j['v'];
			}
		}else if( $j['t'] == btoa('Qg==') ){
			$v = ((!$j['v']||$j['v']==btoa('ZmFsc2U='))?false:true);
		}else if( $j['t'] == btoa('RFQ=') ){
			$v = $j['v']['v'] . btoa('IA==') . $j['v']['tz'];
		}else if( $j['t'] == btoa('Tkw=') ){
			$v = null;
		}else{
			$v = $j['v'];
		}
		return $v;
	}
	function s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $v ){
		// echo "template to array\n";
		// print_pre( $v );
		$s1_cGZzNTlHMFM5MG1JOGI5ckFtenR1Zz09 = [];
		for($i=0;$i<sizeof($v);$i++){
			$j = $v[ $i ];
			$val = $j['v'];
			$val = $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09($val);
			$s1_cGZzNTlHMFM5MG1JOGI5ckFtenR1Zz09[ str_replace("->", btoa('Lg=='), $j['f']['v'] ) ] = $val;
		}
		return $s1_cGZzNTlHMFM5MG1JOGI5ckFtenR1Zz09;
	}
	function s1_N1R3NVl0R2hOYVhPTWtNc3Y4Qnp6Zz09( $v ){
		// echo "template to array\n";
		// print_pre( $v );
		$s1_cGZzNTlHMFM5MG1JOGI5ckFtenR1Zz09 = [];
		for($i=0;$i<sizeof($v);$i++){
			$j = $v[ $i ];
			$val = $j['v']['v'];
			$s1_cGZzNTlHMFM5MG1JOGI5ckFtenR1Zz09[ str_replace("->", btoa('Lg=='), $j['f']['v'] ) ] = ($val==btoa('dHJ1ZQ==')||$val===true?true:false);
		}
		return $s1_cGZzNTlHMFM5MG1JOGI5ckFtenR1Zz09;
	}
	function s1_aEhzQ3I3d25CVmpnOXZ6VGRuSHFlQT09( $v ){
		// echo "template to array\n";
		// print_pre( $v );
		$s1_cGZzNTlHMFM5MG1JOGI5ckFtenR1Zz09 = [];
		for($i=0;$i<sizeof($v);$i++){
			$j = $v[ $i ];
			$val = $j['v']['v'];
			$s1_cGZzNTlHMFM5MG1JOGI5ckFtenR1Zz09[ str_replace("->", btoa('Lg=='), $j['f']['v'] ) ] = ($val==btoa('LTE=')||$val===-1?-1:1);
		}
		return $s1_cGZzNTlHMFM5MG1JOGI5ckFtenR1Zz09;
	}
	function s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $v ){
		// echo "template to array\n";
		// print_pre( $v );
		$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = [];

		for($i=0;$i<sizeof($v);$i++){
			$j = $v[$i];
			$j['f']['v'] = str_replace("->", btoa('Lg=='), $j['f']['v']);
			if( $j['v']['t'] == btoa('Vg==') ){
				$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09[ $j['f']['v'] ] = $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09( $j['v'] );
			}else if( $j['v']['t'] == btoa('TA==') && ( $j['f']['v'] == '$and' || $j['f']['v'] == '$or' ) ){
				$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09[ $j['f']['v'] ] = [];
				for($k=0;$k<sizeof($j['v']['v']);$j++){
					$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09[ $j['f']['v'] ][] = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09($j['v']['v'][$k]['v']);
				}
			}else{
				$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09[ $j['f']['v'] ] = [];
				if( $j['c']['v'] == '$eq' ){
					$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09[ $j['f']['v'] ] = $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09( $j['v'] );
				}else{
					$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09[ $j['f']['v'] ][ $j['c']['v'] ] = $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09( $j['v'] );
				}
			}
		}
		return $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
	}

	function s1_dkJtdlNzMTJGRW1lVTV2Njc4bUlZdz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 ){
		global $config_global_engine;
		$s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['action']['v'];
		$s1_QTU4Rkd6NTV3MHcrbVRQZlF2OFJQZz09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['db']['i']['v'];
		$s1_bHl0TmhldnM2aTBLMzJSQ0NwcThrdz09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['table']['i']['v'];
		$s1_YlM2anUvZ2lwRW9SY3FhTkpMV1Y3QT09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['schema']['v'];
		$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['query']['v'];
		$project = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['project']['v'];
		$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['sort']['v'];
		$set = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['set']['v'];
		$unset = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['unset']['v'];
		$inc = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['inc']['v'];
		$output = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['output']['v'];

		//print_pre( $config_global_engine );exit;

		//print_pre( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d'] );exit;

		$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->find_one( $config_global_engine['config_mongo_prefix'] . btoa('X2RhdGFiYXNlcw=='), ['_id'=>$s1_QTU4Rkd6NTV3MHcrbVRQZlF2OFJQZz09] );
		if( !isset($s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['data']) ){
			return ['status'=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>btoa('RGF0YWJhc2Ugbm90IGZvdW5k')];
		}else{
			$db = $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['data'];
		}
		$tres = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->find_one( $config_global_engine['config_mongo_prefix'] . btoa('X3RhYmxlcw=='), ['_id'=>$s1_bHl0TmhldnM2aTBLMzJSQ0NwcThrdz09] );
		if( !isset($tres['data']) ){
			return ['status'=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>btoa('RGF0YWJhc2Ugbm90IGZvdW5k')];
		}else{
			$s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09 = $tres['data'];
		}
		$db['details']['username'] = pass_decrypt($db['details']['username']);
		$db['details']['password'] = pass_decrypt($db['details']['password']);
		//print_pre( $db );exit;
		//print_pre( $s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09 );exit;

		$mongo_con = new mongodb_connection( $db['details']['host'], $db['details']['port'], $db['details']['database'], $db['details']['username'], $db['details']['password'],$db['details']['authSource'], ($db['details']['tls']?true:false) );

		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('SW5zZXJ0') || $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('SW5zZXJ0T25l') ){
			//print_pre( $set );exit;
			$insert_data = $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $set );
			//print_pre( $insert_data );exit;
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $mongo_con->insert( $s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09['table'], $insert_data );
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['insertId'] = $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['inserted_id'];unset($s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['inserted_id']);
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			if( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['status'] == btoa('c3VjY2Vzcw==') ){}
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('RmluZE9uZQ==') ){
			$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 );
			$project = $this->s1_N1R3NVl0R2hOYVhPTWtNc3Y4Qnp6Zz09( $project );
			$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 = $this->s1_aEhzQ3I3d25CVmpnOXZ6VGRuSHFlQT09( $s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 );
			$ops = ['limit'=>(int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['limit']['v'] ];
			if( sizeof($s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09) ){
				$ops['sort'] = $s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09;
			}
			if( sizeof($project) ){
				$ops['projection'] = $project;
			}
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $mongo_con->find_one($s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09['table'], $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09, $ops);
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('REIgY29uZA==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			//$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['cond'] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('RmluZE1hbnk=') ){
			$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 );
			$project = $this->s1_N1R3NVl0R2hOYVhPTWtNc3Y4Qnp6Zz09( $project );
			$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 = $this->s1_aEhzQ3I3d25CVmpnOXZ6VGRuSHFlQT09( $s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 );
			$ops = ['limit'=>(int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['limit']['v'] ];
			if( sizeof($s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09) ){
				$ops['sort'] = $s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09;
			}
			if( sizeof($project) ){
				$ops['projection'] = $project;
			}
			//print_pre( $ops );exit;
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $mongo_con->find($s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09['table'], $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09, $ops);
			//print_pre( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );exit;
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('REIgY29uZA==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			//$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['cond'] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('VXBkYXRlT25l') ){
			$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 );
			$set =  $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $set );
			$unset= $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $unset );
			$inc =  $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $inc );
			$ops = [];

			$d = [];
			if( $set ){$d['$set'] = $set;}
			if( $unset ){$d['$unset'] = $unset;}
			if( $inc ){$d['$inc'] = $inc;}

			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $mongo_con->update_one($s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09['table'], $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09, $d, $ops);
			//print_pre( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );exit;
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('REIgY29uZA==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('RGF0YQ==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $d;
			//$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['cond'] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('VXBkYXRlTWFueQ==') ){
			$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 );
			$set =  $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $set );
			$unset= $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $unset );
			$inc =  $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $inc );
			$ops = ['limit'=>(int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['limit']['v'] ];

			$d = [];
			if( $set ){$d['$set'] = $set;}
			if( $unset ){$d['$unset'] = $unset;}
			if( $inc ){$d['$inc'] = $inc;}

			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $mongo_con->update_one($s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09['table'], $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09, $d, $ops);
			//print_pre( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );exit;
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('REIgY29uZA==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('RGF0YQ==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $d;
			//$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['cond'] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('RGVsZXRlT25l') ){
			$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 );
			$ops = [];
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $mongo_con->delete_one($s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09['table'], $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09, $ops);
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('REIgY29uZA==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('VXBkYXRlTWFueQ==') ){
			$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 );
			$ops = ['limit'=>(int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['limit']['v'] ];
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $mongo_con->update_one($s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09['table'], $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09, $ops);
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('REIgY29uZA==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
	}

	function table_dynamic( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 ){
		global $config_global_engine;
		$s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['action']['v'];
		$s1_bHl0TmhldnM2aTBLMzJSQ0NwcThrdz09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['table']['i']['v'];
		$s1_YlM2anUvZ2lwRW9SY3FhTkpMV1Y3QT09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['schema']['v'];
		$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['query']['v'];
		$project = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['project']['v'];
		$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['sort']['v'];
		$set = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['set']['v'];
		$insert = $this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09($this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['insert'])['v']);
		$unset = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['unset']['v'];
		$inc = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['inc']['v'];
		$output = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['output']['v'];

		$tres = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->find_one( $config_global_engine['config_mongo_prefix'] . btoa('X3RhYmxlc19keW5hbWlj'), ['_id'=>$s1_bHl0TmhldnM2aTBLMzJSQ0NwcThrdz09] );
		if( !isset($tres['data']) ){
			return ['status'=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>btoa('RGF0YWJhc2Ugbm90IGZvdW5k')];
		}else{
			$s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09 = $tres['data'];
		}

		$s1_WXdxeXQxK2ZuWW1jTGFjRHMyd21udz09 = $config_global_engine['config_mongo_prefix'] . btoa('X2R0Xw==') . $s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09['_id'];
		//echo $s1_WXdxeXQxK2ZuWW1jTGFjRHMyd21udz09;exit;

		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('SW5zZXJ0') || $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('SW5zZXJ0T25l') ){
			//print_pre( $set );exit;
			//print_pre( $insert );exit;
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->insert( $s1_WXdxeXQxK2ZuWW1jTGFjRHMyd21udz09, $insert );
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['insertId'] = $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['inserted_id'];unset($s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['inserted_id']);
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			if( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['status'] == btoa('c3VjY2Vzcw==') ){}
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('RmluZE9uZQ==') ){
			$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 );
			$project = $this->s1_N1R3NVl0R2hOYVhPTWtNc3Y4Qnp6Zz09( $project );
			$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 = $this->s1_aEhzQ3I3d25CVmpnOXZ6VGRuSHFlQT09( $s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 );
			$ops = ['limit'=>(int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['limit']['v'] ];
			if( sizeof($s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09) ){
				$ops['sort'] = $s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09;
			}
			if( sizeof($project) ){
				$ops['projection'] = $project;
			}
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->find_one($s1_WXdxeXQxK2ZuWW1jTGFjRHMyd21udz09, $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09, $ops);
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('REIgY29uZA==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			//$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['cond'] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('RmluZE1hbnk=') ){
			$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 );
			$project = $this->s1_N1R3NVl0R2hOYVhPTWtNc3Y4Qnp6Zz09( $project );
			$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 = $this->s1_aEhzQ3I3d25CVmpnOXZ6VGRuSHFlQT09( $s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 );
			$ops = ['limit'=>(int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['limit']['v'] ];
			if( sizeof($s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09) ){
				$ops['sort'] = $s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09;
			}
			if( sizeof($project) ){
				$ops['projection'] = $project;
			}
			//print_pre( $ops );exit;
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->find($s1_WXdxeXQxK2ZuWW1jTGFjRHMyd21udz09, $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09, $ops);
			//print_pre( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );exit;
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('REIgY29uZA==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			//$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['cond'] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('VXBkYXRlT25l') ){
			$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 );
			$set =  $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $set );
			$unset= $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $unset );
			$inc =  $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $inc );
			$ops = [];

			$d = [];
			if( $set ){$d['$set'] = $set;}
			if( $unset ){$d['$unset'] = $unset;}
			if( $inc ){$d['$inc'] = $inc;}

			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->update_one($s1_WXdxeXQxK2ZuWW1jTGFjRHMyd21udz09, $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09, $d, $ops);
			//print_pre( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );exit;
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('REIgY29uZA==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('RGF0YQ==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $d;
			//$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['cond'] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('VXBkYXRlTWFueQ==') ){
			$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 );
			$set =  $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $set );
			$unset= $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $unset );
			$inc =  $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $inc );
			$ops = ['limit'=>(int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['limit']['v'] ];

			$d = [];
			if( $set ){$d['$set'] = $set;}
			if( $unset ){$d['$unset'] = $unset;}
			if( $inc ){$d['$inc'] = $inc;}

			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->update_one($s1_WXdxeXQxK2ZuWW1jTGFjRHMyd21udz09, $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09, $d, $ops);
			//print_pre( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );exit;
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('REIgY29uZA==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('RGF0YQ==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $d;
			//$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['cond'] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('RGVsZXRlT25l') ){
			$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 );
			$ops = [];
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->delete_one($s1_WXdxeXQxK2ZuWW1jTGFjRHMyd21udz09, $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09, $ops);
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('REIgY29uZA==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('VXBkYXRlTWFueQ==') ){
			$s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09 = $this->s1_K1J4THh0Z3BxaTNzQW91bk94K0l6Zz09( $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 );
			$ops = ['limit'=>(int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['limit']['v'] ];
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->update_one($s1_WXdxeXQxK2ZuWW1jTGFjRHMyd21udz09, $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09, $ops);
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('REIgY29uZA==');
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_SE96aXJqUFhRZ3k3K2l2NDIweDVIQT09;
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>'O', 'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
	}

	function s1_MklSc28xSUZHTmJVWVlKTGhaYXNRUT09($con, $v ){
		$vv = [];
		if( gettype($v)==btoa('YXJyYXk=') ){
			if( array_keys($v)[0] === 0  ){
				foreach($v as $k=>$vd){
					if( $vd['v']['t'] == btoa('Vg==') ){
						$vv[] = "`".$vd['f']['v'] ."`". $vd['c']['v'] ."'". mysqli_escape_string($con, $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09($vd['v']) ) . "'";
					}else if( $vd['v']['t'] == btoa('TA==') ){
						$vv[] = " ( " . $this->s1_MklSc28xSUZHTmJVWVlKTGhaYXNRUT09($con, $vd['v']['v']) . " ) ";
					}else{
						$vv[] = "`".$vd['f']['v'] ."`". $vd['c']['v'] ."'". mysqli_escape_string($con, $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09($vd['v']) ) . "'";
					}
					if( $k < sizeof($v) - 1 ){
						$vv[] = $vd['n']['v'];
					}
				}
			}else{ $this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = btoa('d2hlcmUgY29uZGl0aW9uIG5vdCBhcnJheQ=='); }
		}else{ $this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "where condition incorrect type: "+ gettype($v); }
		return implode(btoa('IA=='), $vv);
	}
	function s1_M2RNSHRicHJDVW84MlNqQXJDNGVEZz09($v){
		$vv = [];
		if( gettype($v)==btoa('YXJyYXk=') ){
				foreach($v as $k=>$vd){
					$vv[] = $k;
				}
		}else{ $this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "get_fields_notation: incorrect type: " .gettype($v); }
		return implode(", ", $vv );
	}
	function s1_UjV2UTMvN0xKazdoUVFCc3U1eEs1QT09($v){
		$vv = [];
		if( gettype($v)==btoa('YXJyYXk=') ){
			if( array_keys($v)[0] === 0  ){
				foreach($v as $k=>$vd){
					$vv[] = $vd['f']['v'] . ($vd['o']['v']==btoa('RGVzYw==')?btoa('IGRlc2M='):"");
				}
			}else{ $this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "get_fields_notation: not a object "; }
		}else{ $this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = "get_fields_notation: incorrect type: " .gettype($v); }
		return implode(", ", $vv );
	}

	function s1_NEhuSE0zMlhTYjU3NE9NdXRjL3ZGdz09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 ){
		global $config_global_engine;
		//print_pre( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 );exit;
		$s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['query']['v'];
		$s1_QTU4Rkd6NTV3MHcrbVRQZlF2OFJQZz09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['db']['i']['v'];
		$s1_bHl0TmhldnM2aTBLMzJSQ0NwcThrdz09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['table']['i']['v'];
		$s1_YlM2anUvZ2lwRW9SY3FhTkpMV1Y3QT09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['schema']['v'];
		$s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['where']['v'];
		$s1_YUFYV2I5S0ltc1dFaTBBV3NXYjNqUT09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['fields']['v'];
		$key = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['key']['v'];
		$value = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['value']['v'];
		$keys = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['schema']['keys']['v'];
		$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['sort']['v'];
		$set = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['set']['v'];
		$output = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['output']['v'];

		//print_pre( $config_global_engine );exit;
		//print_pre( $keys );exit;

		$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->find_one( $config_global_engine['config_mongo_prefix'] . btoa('X2RhdGFiYXNlcw=='), ['_id'=>$s1_QTU4Rkd6NTV3MHcrbVRQZlF2OFJQZz09] );
		if( !isset($s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['data']) || !$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['data'] ){
			return ['status'=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>btoa('RGF0YWJhc2Ugbm90IGZvdW5k')];
		}else{
			$db = $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09['data'];
		}
		$tres = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->find_one( $config_global_engine['config_mongo_prefix'] . btoa('X3RhYmxlcw=='), ['_id'=>$s1_bHl0TmhldnM2aTBLMzJSQ0NwcThrdz09] );
		if( !isset($tres['data']) || !$tres['data'] ){
			return ['status'=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>btoa('RGF0YWJhc2Ugbm90IGZvdW5k')];
		}else{
			$s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09 = $tres['data'];
		}
		$db['details']['username'] = pass_decrypt($db['details']['username']);
		$db['details']['password'] = pass_decrypt($db['details']['password']);
		//print_pre( $db );exit;
		//print_pre( $s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09 );exit;

		$mysql_con = mysqli_connect( $db['details']['host'], $db['details']['username'], $db['details']['password'], $db['details']['database'], (int)$db['details']['port'] ) ;
		if( mysqli_connect_error() ){
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, [
				'status'=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>"ConnectError:" . mysqli_connect_error()
			] );return false;
		}
		mysqli_options($mysql_con, MYSQLI_OPT_INT_AND_FLOAT_NATIVE, true); 
		mysqli_report(MYSQLI_REPORT_OFF);

		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('SW5zZXJ0') ){
			//print_pre( $set );exit;
			$insert_data = $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $set );
			//print_pre( $insert_data );exit;
			$q = [];
			foreach($insert_data as $i=>$j){
				$q[] = "`" . $i . "` = '" . mysqli_escape_string($mysql_con, $j ) . "' ";
			}
			$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 = "insert into `" . $s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09['table'] . "` \nset " . implode(", \n", $q );
			$s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09 = mysqli_query( $mysql_con, $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09);
			if( mysqli_error( $mysql_con) ){
				//echo mysqli_error( $mysql_con);
				$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = [
					btoa('c3RhdHVz')=>['t'=>btoa('VA=='), btoa('dg==')=>btoa('ZmFpbA==')],
					btoa('ZXJyb3I=')=>['t'=>btoa('VA=='), btoa('dg==')=>mysqli_error($mysql_con) ],
					btoa('cXVlcnk=')=>['t'=>btoa('VA=='), btoa('dg==')=>$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09]
				];
				$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, ['t'=>btoa('Tw=='),'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09] );return false;
			}
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = [
				btoa('c3RhdHVz')=>['t'=>btoa('VA=='), btoa('dg==')=>btoa('c3VjY2Vzcw==')],
				btoa('ZXJyb3I=')=>['t'=>btoa('VA=='), btoa('dg==')=>"" ],
				btoa('cXVlcnk=')=>['t'=>btoa('VA=='), btoa('dg==')=>$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09],
				btoa('aW5zZXJ0SWQ=')=>['t'=>btoa('Tg=='), btoa('dg==')=>mysqli_insert_id($mysql_con)],
			];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, ['t'=>btoa('Tw=='),'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09] );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('U2VsZWN0') || $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('U2VsZWN0QXNzb2M=') || $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('U2VsZWN0S2V5VmFsdWU=') ){
			$s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09 = $this->s1_MklSc28xSUZHTmJVWVlKTGhaYXNRUT09($mysql_con, $s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09 );
			if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('U2VsZWN0QXNzb2M=') || $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('U2VsZWN0S2V5VmFsdWU=') ){
				if( !isset($s1_YUFYV2I5S0ltc1dFaTBBV3NXYjNqUT09[ $key ]) ){
					$s1_YUFYV2I5S0ltc1dFaTBBV3NXYjNqUT09[ $key ] = ['t'=>'T'];
				}
			}
			if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('U2VsZWN0S2V5VmFsdWU=') ){
				$s1_YUFYV2I5S0ltc1dFaTBBV3NXYjNqUT09 = [ $key => ['t'=>'T'], $value => ['t'=>'T'] ];
			}
			$s1_YUFYV2I5S0ltc1dFaTBBV3NXYjNqUT09 = $this->s1_M2RNSHRicHJDVW84MlNqQXJDNGVEZz09( $s1_YUFYV2I5S0ltc1dFaTBBV3NXYjNqUT09 );
			$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 = $this->s1_UjV2UTMvN0xKazdoUVFCc3U1eEs1QT09( $s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 );
			$key = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['key']['v'];
			$value = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['value']['v'];
			$s1_Tk1teWVrN3NnWDZaUWQ0ejNXblFWQT09 = btoa('bGltaXQg') . (int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['limit']['v'];
			$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 = btoa('c2VsZWN0IA==') . (trim($s1_YUFYV2I5S0ltc1dFaTBBV3NXYjNqUT09)?$s1_YUFYV2I5S0ltc1dFaTBBV3NXYjNqUT09:"*") . " from `" . $s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09['table'] . "` " . (trim($s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09)?"\nwhere " . $s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09:"") . btoa('IA==') . (trim($s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09)?"\norder by " .$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09:"") . " \n" . $s1_Tk1teWVrN3NnWDZaUWQ0ejNXblFWQT09;
			$s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09 = mysqli_query($mysql_con, $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09);
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09;
			if( mysqli_error( $mysql_con) ){
				//echo mysqli_error( $mysql_con);
				$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = [
					btoa('c3RhdHVz')=>['t'=>btoa('VA=='), btoa('dg==')=>btoa('ZmFpbA==')],
					btoa('ZXJyb3I=')=>['t'=>btoa('VA=='), btoa('dg==')=>mysqli_error($mysql_con) ],
					btoa('cXVlcnk=')=>['t'=>btoa('VA=='), btoa('dg==')=>$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09]
				];
				$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, ['t'=>btoa('Tw=='),'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09] );return false;
			}
			$rec = [];
			while( $row = mysqli_fetch_assoc($s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09) ){
				if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('U2VsZWN0QXNzb2M=') ){
					$rec[ $row[ $key ] ] = $row;
				}else if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('U2VsZWN0S2V5VmFsdWU=') ){
					$rec[ $row[ $key ] ] = $row[ $value ];
				}else{
					$rec[] = $row;
				}
			}
			$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09( $rec );
			if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('U2VsZWN0QXNzb2M=') || $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('U2VsZWN0S2V5VmFsdWU=') ){
				$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>btoa('Tw=='),'v'=>[
					btoa('c3RhdHVz')=>['t'=>btoa('VA=='), btoa('dg==')=>btoa('c3VjY2Vzcw==')],
					btoa('ZGF0YQ==')=>['t'=>'O', 'v'=>$rec],
					btoa('Y291bnQ=')=>['t'=>'N', 'v'=>sizeof($rec)],
					btoa('cXVlcnk=')=>['t'=>btoa('VA=='), btoa('dg==')=>$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09]
				]];
			}else{
				$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = ['t'=>btoa('Tw=='),'v'=>[
					btoa('c3RhdHVz')=>['t'=>btoa('VA=='), btoa('dg==')=>btoa('c3VjY2Vzcw==')],
					btoa('ZGF0YQ==')=>['t'=>'L', 'v'=>$rec],
					btoa('Y291bnQ=')=>['t'=>'N', 'v'=>sizeof($rec)],
					btoa('cXVlcnk=')=>['t'=>btoa('VA=='), btoa('dg==')=>$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09]
				]];
			}
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, $s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('VXBkYXRl') ){
			$s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09 = $this->s1_MklSc28xSUZHTmJVWVlKTGhaYXNRUT09($mysql_con, $s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09 );
			$s1_cGZzNTlHMFM5MG1JOGI5ckFtenR1Zz09 = $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $set );
			$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 = $this->s1_UjV2UTMvN0xKazdoUVFCc3U1eEs1QT09( $s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 );
			$s1_Tk1teWVrN3NnWDZaUWQ0ejNXblFWQT09 = btoa('bGltaXQg') . (int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['limit']['v'];
			$q = [];
			foreach($s1_cGZzNTlHMFM5MG1JOGI5ckFtenR1Zz09 as $i=>$j){
				$q[] = "`" . $i . "` = '" . mysqli_escape_string($mysql_con, $j ) . "' ";
			}
			$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 = "update `" . $s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09['table'] .  "` ";
			$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 .= "\nset " . implode(", \n", $q ) . btoa('IA=='); 
			$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 .= (trim($s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09)?"\nwhere " . $s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09:"");
			$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 .= (trim($s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09)?"\norder by " .$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09:"") . " \n" . $s1_Tk1teWVrN3NnWDZaUWQ0ejNXblFWQT09;
			$s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09 = mysqli_query($mysql_con, $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09);
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09;
			if( mysqli_error( $mysql_con) ){
				//echo mysqli_error( $mysql_con);
				$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = [
					btoa('c3RhdHVz')=>['t'=>btoa('VA=='), btoa('dg==')=>btoa('ZmFpbA==')],
					btoa('ZXJyb3I=')=>['t'=>btoa('VA=='), btoa('dg==')=>mysqli_error($mysql_con) ],
					btoa('cXVlcnk=')=>['t'=>btoa('VA=='), btoa('dg==')=>$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09]
				];
				$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, ['t'=>btoa('Tw=='),'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09] );
				return false;
			}
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = [
				btoa('c3RhdHVz')=>['t'=>btoa('VA=='), btoa('dg==')=>btoa('c3VjY2Vzcw==')],
				btoa('ZXJyb3I=')=>['t'=>btoa('VA=='), btoa('dg==')=>"" ],
				btoa('cXVlcnk=')=>['t'=>btoa('VA=='), btoa('dg==')=>$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09],
				btoa('dXBkYXRlZA==')=>['t'=>btoa('Tg=='), btoa('dg==')=>mysqli_affected_rows($mysql_con)],
			];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, ['t'=>btoa('Tw=='),'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09] );
		}
		if( $s1_c2JCL3VNVExXeTBrdjVsMkNzY1J4UT09 == btoa('RGVsZXRl') ){
			$s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09 = $this->s1_MklSc28xSUZHTmJVWVlKTGhaYXNRUT09($mysql_con, $s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09 );
			$s1_cGZzNTlHMFM5MG1JOGI5ckFtenR1Zz09 = $this->s1_RGw5Mmg0K3NEMjhlT1dDV0dtRjF1UT09( $set );
			$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 = $this->s1_UjV2UTMvN0xKazdoUVFCc3U1eEs1QT09( $s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09 );
			$s1_Tk1teWVrN3NnWDZaUWQ0ejNXblFWQT09 = btoa('bGltaXQg') . (int)$s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['limit']['v'];
			$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 = "delete from `" . $s1_QUt2SnJZY3IzSXVsRkZrU0NkKzNhZz09['table'] .  "` ";
			$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 .= (trim($s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09)?"\nwhere " . $s1_M2NRaU5oOVVQcWZMd3lQOWJtN2YyZz09:"");
			$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09 .= (trim($s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09)?"\norder by " .$s1_elE0UlFpRGVtSWNkdFVNbHM1Sm5Hdz09:"") . " \n" . $s1_Tk1teWVrN3NnWDZaUWQ0ejNXblFWQT09;
			$s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09 = mysqli_query($mysql_con, $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09);
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09;
			if( mysqli_error( $mysql_con) ){
				//echo mysqli_error( $mysql_con);
				$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = [
					btoa('c3RhdHVz')=>['t'=>btoa('VA=='), btoa('dg==')=>btoa('ZmFpbA==')],
					btoa('ZXJyb3I=')=>['t'=>btoa('VA=='), btoa('dg==')=>mysqli_error($mysql_con) ],
					btoa('cXVlcnk=')=>['t'=>btoa('VA=='), btoa('dg==')=>$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09]
				];
				$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, ['t'=>btoa('Tw=='),'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09] );
				return false;
			}
			$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09 = [
				btoa('c3RhdHVz')=>['t'=>btoa('VA=='), btoa('dg==')=>btoa('c3VjY2Vzcw==')],
				btoa('ZXJyb3I=')=>['t'=>btoa('VA=='), btoa('dg==')=>"" ],
				btoa('cXVlcnk=')=>['t'=>btoa('VA=='), btoa('dg==')=>$s1_aHJ2SUFkc3BrYWp4VHNCck5SYUtPZz09],
				btoa('ZGVsZXRlZA==')=>['t'=>btoa('Tg=='), btoa('dg==')=>mysqli_affected_rows($mysql_con)],
			];
			$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, ['t'=>btoa('Tw=='),'v'=>$s1_QmwveHhKM2Nyd0ZOcklmMnhST1dzdz09] );
		}
	}
	function s1_eldmblNGTGI1R2xKTU9nVkt5eXNyUT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 ){
		global $config_global_engine;
		//print_pre( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09 );exit;
		$method = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['method']['v'];
		$url = $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['url']);
		$contentType = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['content-type']['v'];
		$reqheaders = $this->s1_ak9mYzJIRGRRY1lYTEZLYzN0WEJWQT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['headers']['v'] );
		$payload = $this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['payload']['v'] );
		$redirects = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['redirect']['v'];
		$ctime = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['ctime']['v'];
		$rtime = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['rtime']['v'];
		$sslverify = $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['sslverify']);
		$twoway = $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['twoway']);
		$sslcert = $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['sslcert']);
		$sslkey = $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['sslkey']);
		$userproxy = $this->s1_Z1VoVGxQZjJWR0h5bW85MjhReTdIQT09($s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['userproxy']);
		$proxy = $this->s1_Z3ZHaExyMmRFMm1oZnNlaHF1VVJlQT09( $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['proxy']['v'] );
		$output = $s1_dzBUZmRRQlpCMXBVcC9ha3UvaTBHQT09['d']['data']['output']['v'];

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
		$s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09 = array(
			CURLOPT_HEADER => 1,
			CURLOPT_URL => $url,
			CURLOPT_CONNECTTIMEOUT=> (int)$ctime,
			CURLOPT_TIMEOUT => (int)$rtime,
			CURLOPT_RETURNTRANSFER =>true,
			CURLOPT_AUTOREFERER=>true,
			CURLOPT_HEADER=>true
		);
		curl_setopt_array($ch, $s1_b3dVcDNXc3V6akRjQTY1VWdGZzNTdz09);
		if( $sslverify ){
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true );
		}
		if( $twoway ){
			curl_setopt($ch, CURLOPT_SSLCERT, $sslcert );
			curl_setopt($ch, CURLOPT_SSLKEY, $sslkey );
		}
		//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method );
		if( $mthod == btoa('UE9TVA==') ){
			curl_setopt($ch, CURLOPT_POST, 1 );
			curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );
		}else{
			curl_setopt($ch, CURLOPT_HTTPGET, 1 );
		}
		if( sizeof($reqheaders) ){
  			curl_setopt($ch, CURLOPT_HTTPHEADER, $reqheaders );
  		}
		$s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 = curl_exec($ch);
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
			$parts = explode("\r\n\r\n", $s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09);
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
					if( strtolower(trim($k[0])) == btoa('Y29udGVudC10eXBl') ){
						$k[1] = trim(explode(";",$k[1])[0]);
						if( !$k[1] ){
							$k[1] = "";
						}
					}
					if( strtolower(trim($k[0])) == btoa('c2V0LWNvb2tpZQ==') ){
						$k[1] = trim(explode(";",$k[1])[0]);
						$ck = explode("=",trim($k[1]));
						$cookies[ $ck[0] ] = trim($ck[1]);
					}else{
						$headers[ strtolower(trim($k[0])) ] = trim($k[1]);
					}
				}
			}
			if( $info[btoa('Y29udGVudF90eXBl')] ){
				$content_type=explode(";",$info[btoa('Y29udGVudF90eXBl')])[0];
			}else{
				$content_type="text/plain";
			}
		}
		$d = [
			'status'=>(int)$info['http_code'],
			btoa('Ym9keQ==')=>$body,
			btoa('ZXJyb3I=')=>$error,
			btoa('Y29udGVudF90eXBl')=>$content_type,
			btoa('dGltZV90YWtlbg==')=>$info['total_time'],
			btoa('c2l6ZQ==')=>(int)$info['size_download'],
			btoa('aGVhZGVycw==')=>$headers,
			btoa('Y29va2llcw==')=>$cookies
		];
		//print_pre( $d );exit;
		$this->s1_MllQMDAreVFmYXdXRE5ueHRUcHdKQT09($d);
		//print_pre( $d );
		$this->s1_WDVJU0lDM2xXY29pMVV2MkRKUWxlZz09( $output, ['t'=>'O', 'v'=>$d] );
	}
	function s1_aVhvWUFsQUpmVGlSaEk1WG9NbVQwdz09( $d ){
		global $config_global_engine;
		//print_pre( $d );
		//$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $this->s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09;
		$fn = $d['fn']['v']['i']['v'];
		$fnl = $d['fn']['v']['l']['v'];
		//echo btoa('YmVmb3JlIGZ1bmN0aW9uIGNhbGwg');
		//print_pre( $d['fn']['v']['inputs'] );
		$inputs = [];
		foreach( $d['fn']['v']['inputs']['v'] as $i=>$j ){
			$inputs[ $i ] = $this->s1_dTZDOE84eWcyYjdCQmJWZ3R5Yno4UT09( $j );
		}
		//$inputs = $this->s1_cXNrYVlUbXp6eWZ3WkU2eDQxTEZiUT09( $d['fn']['v']['inputs'] );
		//print_pre($inputs);exit;
		$return = $d['fn']['v']['return'];
		$s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09 = $this->s1_SVJwRzdsaWFYSDR3WmpaSDNzajNtdz09->find_one( $config_global_engine['config_mongo_prefix'] . btoa('X2Z1bmN0aW9uc192ZXJzaW9ucw=='), ['_id'=>$fn] );
		if( !isset($s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09['data']) || !$s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09['data'] ){
			return ['status'=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>"Function: ".$fnl.btoa('IG5vdCBmb3VuZA==')];
		}else{
			$sub_engine = new api_engine();
			if( !$sub_engine ){
				return ['status'=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>"Function: ".$fnl.": Error initializing function engine"];
			}
			if( $this->s1_cUxuaXlybW90SG1GZGtTbHF2N3YyZz09 > 50 ){
				return ['status'=>btoa('ZmFpbA=='), btoa('ZXJyb3I=')=>"Function: ".$fnl.": Error Max Recursive Limit Reached"];
			}
			$s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09 = $sub_engine->execute( $s1_R1dnRUlQVWJUWmFXSC8xT290QWxXdz09['data'], $inputs, [
				btoa('cmVxdWVzdF9sb2dfaWQ=')=>$this->s1_VTBtZEVTSHp3SzhyOWNVSzNJMllXQT09, 
				'raw_output'=>true,
				btoa('cmVjdXJzaXZlX2xldmVs')=>($this->s1_cUxuaXlybW90SG1GZGtTbHF2N3YyZz09+1)
			]);
			$this->s1_RzlzbTlFeThCdlN4WlVYc2RRa05BUT09[] = $sub_engine->log;
			if( isset($s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09['status']) ){
				if( $s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09['status'] == btoa('ZmFpbA==') ){
					if( strpos($s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09['error'], "Function: ".$fnl) === 0 ){

					}else{
						$s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09['error'] = "Function: ".$fnl.": " . $s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09['error'];
					}
				}
				return $s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09;
			}
			return ['status'=>btoa('ZmFpbA=='), btoa('ZGF0YQ==')=>"Function: ".$fnl.": Incorrect response: " . json_encode($s1_dzFuWlEzb3ZrZDVjL09Ha01GdndIZz09)];
		}
	}
}

function btoa($v){return base64_decode($v);}