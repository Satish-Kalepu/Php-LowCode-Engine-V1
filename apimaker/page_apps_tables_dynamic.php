<?php

if( $config_param3 && $config_param4 == "manage" ){
	require("page_apps_tables_dynamic_manage.php");

}else if( $config_param3 && ( $config_param4 == "browse" || $config_param4 == "records" ) ){
	require("page_apps_tables_dynamic_browse.php");

}else if( $config_param3 && $config_param4 == "manage" ){
	require("page_apps_tables_dynamic_manage.php");

}else{
	require("page_apps_tables_dynamic_home.php");

}

