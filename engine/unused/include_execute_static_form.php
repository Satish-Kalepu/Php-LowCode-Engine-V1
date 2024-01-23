<?php

trait execute_static_form{
	public function execute_staticForm( $params__, $vid__ ,$page_id__, $app_id ){
		//ksort($params__['schema']['fields']);
		if( !$this->pagesettings['bootstrap'] ){
			return "<div class='text-danger' >Error: pagesettings:bootstrap required!</div>";
		}
		if( !$this->pagesettings['axios'] ){
			return "<div class='alert alert-danger' >Error: pagesettings:axios required!</div>";
		}

		$params = json_decode($params__,true);
		if( $params['api']['request']['url']['vtype'] == "variable" ){
			$params['api']['request']['url']['url'] = $this->get_value( $params['api']['request']['url']['url'] );
		}
		foreach( $params['fields'] as $ii=>$jj ){
			if( $jj['type'] == "select" || $jj['type'] == "checks" || $jj['type'] == "option" ){
				$v = [];
				$l = explode("\n",$jj['data']);
				foreach($l as $vv=>$vd){
					$x = explode(",",trim($vd));
					$v[] = ["p"=>$x[0],"v"=>$x[1]];
				}
				$params['fields'][ $ii ]['data'] = $v;
			}
		}
		foreach( $params['api']['request']['headers'] as $ii=>$jj ){
			if( $params['api']['request']['headers'][ $ii ]['vtype'] = "variable" ){
				$params['api']['request']['headers'][ $ii ]['v'] = $this->get_value( $params['api']['request']['headers'][ $ii ]['v'] );
			}
		}

		$r = "vuejs_form_div_".str_replace(".","_",microtime(true));
		$data = "<script>
		var static_form_rand_id = '".$r."';
		if( 'backendless_static_forms' in document == false ){
			document['backendless_static_forms'] = {};
		}
		document['backendless_static_forms'][ static_form_rand_id+'' ] = {'template':'','app':false,'params':''};
		document['backendless_static_forms'][ static_form_rand_id+'' ]['params'] = ".json_encode($params,JSON_PRETTY_PRINT).";
		document['backendless_static_forms'][ static_form_rand_id+'' ]['page_id'] = '".$page_id__."';
		document['backendless_static_forms'][ static_form_rand_id+'' ]['app_id'] = '".$app_id__."';
		document['backendless_static_forms'][ static_form_rand_id+'' ]['stage_id'] = '".$vid__."';
		document['backendless_static_forms'][ static_form_rand_id+'' ]['template'] = `".file_get_contents("include_static_form_template.html")."`;
		document.write(\"<div id='".$r."' ></div>\");
		</script>";
		//echo $r."_params";exit;
		$data .= file_get_contents("include_static_form_part1.html");
		return $data;
	}
}

?>