<?php

if( $_POST['action'] == "getDBsList" ){
	sleep(1);
	json_response([
		"status"=>"success", 
		"DBs"=> [
			["l"=> "DB One", "i"=> "100"],
			["l"=> "DB Two", "i"=> "200"],
			["l"=> "DB Three", "i"=> "300"]
		]
	]);
}
if( $_POST['action'] == "getTablesList" ){
	json_response([
		"status"=>"success", 
		"Tables"=> [
			["l"=> "Table One", "i"=> "100"],
			["l"=> "Table Two", "i"=> "200"],
			["l"=> "Table Three", "i"=> "300"]
		]
	]);
}
if( $_POST['action'] == "getTableFields" ){
	json_response([
		"status"=>"success", 
		"Fields"=> [
			["l"=> "Field One", "i"=> "100"],
			["l"=> "Field Two", "i"=> "200"],
			["l"=> "Field Three", "i"=> "300"]
		]
	]);
}

json_response("success", "OK");

?>