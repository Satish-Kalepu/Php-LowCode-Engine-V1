<?php

$_convert = false;
if( $_GET['convert'] == "skip" ){
	$_convert = false;
}
if( $_convert ){
	ob_start();
}

require("page_apps_apis_api_css.php"); 
require("page_apps_functions_function_html.php"); 
require("page_apps_functions_function_script.php");

if( $_convert ){
//	echo ob_get_clean() ;exit;
	echo script_convert( ob_get_clean() );
}
