<?php

if( $config_param3 == "importfile" ){
	require("page_apps_tables_dynamic_importfile.php");

}else if( $config_param3 == "importdump" ){
	require("page_apps_tables_dynamic_importdump.php");

}else if( $config_param3 && $config_param4 == "manage" ){
	require("page_apps_tables_dynamic_manage.php");

}else if( $config_param3 && ( $config_param4 == "browse" || $config_param4 == "records" ) ){
	require("page_apps_tables_dynamic_browse.php");

}else if( $config_param3 && $config_param4 == "manage" ){
	require("page_apps_tables_dynamic_manage.php");

}else if( $config_param3 && $config_param4 == "import" ){
	require("page_apps_tables_dynamic_import.php");

}else if( $config_param3 && $config_param4 == "export" ){
	require("page_apps_tables_dynamic_export.php");

}else{
	require("page_apps_tables_dynamic_home.php");

}

