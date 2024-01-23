<?php
trait execute_dynamic_form{
	public function execute_dynamicForm( $params__, $vid__ ,$page_id__,$version_id__ ){
		$params = json_decode($params__,true);//print_pre($params);
		$r = "vuejs_form_div_".str_replace(".","_",microtime(true));
		$data = "<script>
		var dynamic_form_rand_id = '".$r."';
		if( 'backendless_dynamic_forms' in document == false ){
			document['backendless_dynamic_forms'] = {};
		}
		document['backendless_dynamic_forms'][ dynamic_form_rand_id+'' ] = {'template':'','app':false,'params':''};
		document['backendless_dynamic_forms'][ dynamic_form_rand_id+'' ]['params'] = ".json_encode($params,JSON_PRETTY_PRINT).";
		document['backendless_dynamic_forms'][ dynamic_form_rand_id+'' ]['page_id'] = '".$page_id__."';
		document['backendless_dynamic_forms'][ dynamic_form_rand_id+'' ]['stage_id'] = '".$vid__."';
		document['backendless_dynamic_forms'][ dynamic_form_rand_id+'' ]['version_id'] = '".$version_id__."';
		document['backendless_dynamic_forms'][ dynamic_form_rand_id+'' ]['template'] = `".file_get_contents("include_dynamic_form_template.html")."`;
		document.write(\"<div id='".$r."' ></div>\");
		</script>";
		$data .= file_get_contents("include_dynamic_form_part1.html");
		return $data;
	}
}
?>