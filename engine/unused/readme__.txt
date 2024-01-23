
cron_task_queue.   should be executed as non root user
	make sure . urls pointed with local dns.

	php cron_task_queue.php    to run every minit.
	php cron_task_queue_thread.php will be executed by above script.

	queue table index:
	["status", "_id", "pick"]

  
../config_global_settings.php

<?php
/*
NOTE:  .htaccess session.cookie_lifetime, session.gc_maxlifetime  and $config_session_timeout  should be same
redis security host can be common to all applicatins. there is no prefix for keys.
$config_redis_security_host  should be same in auto prepend file common security and application config.php file.
applcation wise redis host should be separate and exclusive to application variables.
*/

$config_main_domain = "backendlessapps.com";
$config_main_default_domain = "www.backendlessapps.com";

$config_mongo_host = "localhost:8889";
$config_mongo_port = 8889;
$config_mongo_db = "backendlessapps";
$config_mongo_debug = true;

$config_dynamic_host = "localhost:8889";
$config_dynamic_port = 8889;
$config_dynamic_db = "backendlessapps_user_tables";
$config_dynamic_debug = true;

$config_mongo_task_queue_host = "localhost:8889";
$config_mongo_task_queue_port = 8889;
$config_mongo_task_queue_db = "backendlessapps_task_queues";
$config_mongo_task_queue_debug = true;

$config_redis_security_host = "localhost";
$config_redis_security_port = 6379;

$config_use_dev_otp = "12345";
$config_secret_key = '?^SsgZF-^?@cF@h&xr43T4w3w';
$config_crypt_type = 'aes256';
$config_secret_key_2 = '$#%#sdlkfs#%3';
$config_crypt_type_2 = 'aes256';

$config_task_queue_url= "https://sqs.ap-south-1.amazonaws.com/492602576693/bre_task_queue_testbre4";

$config_pass_encrypt_keys = [
	"k1"=>["key"=>"abcdef", "comments"=> "added on 2021july31st"],
	"k2"=>["key"=>"qwerty", "comments"=> "added on 2021july31st"],
];
$config_pass_encrypt_default_key = "k1";


$config_password_salt = "12345QEWER";
$config_session_timeout = 86400;

?>