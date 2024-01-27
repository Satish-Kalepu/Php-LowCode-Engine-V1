/*
dependent props 
sets extra sub methods in the same class
or 
sets extra sub properties 

global props list for vars contains dependencies.
*/

var s2_snigulp_tluafed_gifnoc = {
	"HTTPRequest": {
		"p": {
			"GET": {"self":true, "return":"B", "out":false, "inputs":{
				"p2": {"n": "URL", "m": true, "types": ["T", "V"], "v": {"t":"T", "v":"https://www.example.com/something" }},
			}},
			"POST": {"self":true, "return":"B", "out":false, "inputs":{
				"p2": {"n": "URL", "m": true, "types": ["T", "V"], "v": {"t":"T", "v":"https://www.example.com/something" }},
				"p3": {"n": "Content-Type", "m": true, "types": ["ContentType"], "v": {"t":"ContentType","v":"application/json" }},
			}},
			"setRequestHeader": {"self":true,"return":"B", "out":false,"inputs":{
				"p2": {"n": "Header", "m": true, "types": ["T","V"], "v": {"t":"T","v":"X-Header1" }},
				"p3": {"n": "Value", "m": true, "types": ["T", "V"], "v": {"t":"T","v":"Header-Value" }},
			}},
			"setContentType": {"self":true,"return":"B", "out":false,"inputs":{
				"p2": {"n": "Content-Type", "m": true, "types": ["ContentType"], "v": {"t":"ContentType","v":"application/json" }},
			}},
			"setPayLoad": {"self":true,"return":"B", "out":true, "inputs":{
				"p2": {"n": "PayLoad", "m": true, "types": ["V", "O"], "v": {"t":"O", "v":{"Field1":{"t":"T","v":""}, "Field2":{"t":"T","v":""} } }},
			}},
			"execute": {"self":true,"return":"B", "out":true},
			"setUserAgent": {"self":true,"return":"B", "out":false,"inputs":{
				"p2": {"n": "Text", "m": true, "types": ["T"], "v": {"t":"T","v":"A revolutionary No-Code Tool" }},
			}},
			"setFollowRedirect": {"self":true,"return":"B", "out":false,"inputs":{
				"p2": {"n":"Count", "types":["N"], "v":{"t": "N", "v": "1"}},
			}},
			"setConnectTimeout": {"self":true,"return":"B", "out":false,"inputs":{
				"p2": {"n":"Milli Seconds", "types":["N"], "v":{"t": "N", "v": "2000"}},
			}},
			"setReadTimeout": {"self":true,"return":"B", "out":false,"inputs":{
				"p2": {"n":"Milli Seconds", "types":["N"], "v":{"t": "N", "v": "2000"}},
			}},
			"setSSLVerify": {"self":true,"return":"B", "out":false,"inputs":{
				"p2": {"n":"Verify", "types":["B"], "v":{"t": "B", "v": "true"}},
			}},
			"set2WaySSL": {"self":true,"return":"B", "out":false,"inputs":{
				"p2": {"n":"PrivateKey", "types":["TT","V"], "v":{"t": "TT", "v": ""}},
			}},
			"setProxyHttp": {"self":true,"return":"B", "out":false,"inputs":{
				"p2": {"n":"Host", "types":["T"], "v":{"t": "T", "v": "127.0.0.1"}},
				"p3": {"n":"Port", "types":["N"], "v":{"t": "N", "v": "8888"}},
			}},
			"setProxySocks": {"self":true,"return":"B", "out":false,"inputs":{
				"p2": {"n":"Host", "types":["T"], "v":{"t": "T", "v": "127.0.0.1"}},
				"p3": {"n":"Port", "types":["N"], "v":{"t": "N", "v": "8888"}},
			}},
			"setProxySocks5": {"self":true,"return":"B", "out":false,"inputs":{
				"p2": {"n":"Host", "types":["T"], "v":{"t": "T", "v": "127.0.0.1"}},
				"p3": {"n":"Port", "types":["N"], "v":{"t": "N", "v": "8888"}},
				"p4": {"n":"Username", "types":["T"], "v":{"t": "T", "v": "username"}},
				"p5": {"n":"Password", "types":["T"], "v":{"t": "T", "v": "password"}},
			}},
			"getResponseStatus": {"self":false, "return":"N", "out":true},
			"getResponseContent": {"self":false, "return":"T", "out":true},
			"getResponseHeaders": {"self":false, "return":"O", "out":true, "structure": {'t':"O", 'v':{
							"content-type":{"t":"T", "v":"text/plain"},
							"content-length":{"t":"N", "v":0},
							"cache-control": {"t":"N", "v":"max-age=604800"},
							"date": {"t":"N", "v":"Tue, 24 Oct 2023 17:16:05 GMT"},
							"expires": {"t":"N", "v":"Tue, 31 Oct 2023 17:16:05 GMT"},
							"last-modified": {"t":"N", "v":"Mon, 23 Oct 2023 05:57:14 GMT"},
							"server": {"t":"N", "v":"ECS (dcb\/7F80)"},
						}
					}
			},
			"getResponseHeader": {"self":false, "return":"T", "out":true, "inputs":{
				"p2": {"n": "Header", "m": true, "types": ["T"], "v": {"t":"T", "v":""}},
			}},
			"getError": {"self":false, "return":"T", "out":true},
			"getVariables": {"self":false, "return":"O", "out":true, "structure": {'t':'O', 'v':{
				"request": {
					't':"O",'v':{
						"url":{"t":"T", "v":""},
						"method":{"t":"T", "v":"GET"},
						"content-type":{"t":"T", "v":"application/x-www-form-urlencoded"},
						"headers": {"t":"O", "v":{}},
						"user-agent":{"t":"T", "v":"Revolutionary NoCode Tool"},
						"ssl_verify":{"t":"B", "v":false},
						"ssl_2way":{"t":"B", "v":false},
						"ssl_key":{"t":"T", "v":""},
						"ssl_cert":{"t":"T", "v":""},
						"use_proxy":{"t":"B", "v":false},
						"proxy_type":{"t":"T", "v":"http"},
						"proxy":{"t":"O", "v":{
							"host":{"t":"T", "v":""},
							"port":{"t":"N", "v":""},
							"username":{"t":"T", "v":""},
							"password":{"t":"T", "v":""} 
							}
						},
						"connect_timeout":{"t":"N", "v":5000},
						"read_timeout":{"t":"N", "v":5000},
						"authorization":{"t":"T", "v":""},
						"payload":{"t":"O", "v":{}},
						"files":{"t":"T", "v":""},
					}
				},
				"response": {
					't':"O", 'v':{
						"status":{"t":"T", "v":""},
						"body":{"t":"T", "v":""},
						"headers":{'t':"O", 'v':{
							"content-type":{"t":"T", "v":"text/plain"},
							"content-length":{"t":"N", "v":0},
						}}
				}}
			}}},
		}
	},
	"APICall": {
		"p": {
			"selectAPI": {"self":true, "return":"B", "out":false, "inputs":{
				"p2": {"n": "API", "m": true, "types":["APIs"], "v": {"t":"APIs", "v":"" }, "ajax": {
					"ajax-action": {"action":"getAPIsList"},
					"update_var": "APIs",
				}, "onSelect": {
					"action": "ajax",
					"ajax-action": "getAPIInputs",
					"update_var": "apis",
				}},
			}},
			"setInputs": {"self":true, "return":"B", "out":false, "inputlist":"vars:inputs"},
			"callApi": {"self":true, "return":"B", "out":false},
			"getOutputs": {"self":false, "return":"O", "out":true, "outvar":"vars:outputs"},
			"getOutput": {"self":false, "return":"T", "out":true, "outvar":"vars:outputs"},
		},
		"vars": {
			"APIs": {"t":"O", "v":{
				"inputs": {"t":"O", "v":{}},
				"outputs": {"t":"O", "v":{}},
			}},
			"Inputs": [
				{"f": "Field 1", "v": {"t":"T", "v":""} },
				{"f": "Field 2", "v": {"t":"T", "v":""} },
				{"f": "Field 3", "v": {"t":"T", "v":""} },
				{"f": "Field n", "v": {"t":"T", "v":""} },
			],
		},
		"dependencies": {
			"p2": {
				"APIs": {
					"*": {
						"p3": {"n":"Inputs", "m":true, "types":["M"], "v": {"t": "M", "v":"Inputs"}},
					},
				}
			}
		}
	},
	"Database555555555": {
		"p": {
			"Command": {"self":true, "return":"B", "out":false, "inputs":{
				"p2": {"n": "Database", "m": true, "types":["TH"], "v": {"t":"TH", "thfixed":true, "v":{"th":"DBs", "i":"","l":""} }, "ajax": {
					"ajax-action": {"action": "getDBsList"},
					"response_var": "DBs",
				}, 
				// "onSelect": {
				// 	"action": "ajax",
				// 	"ajax-action": {"action":"getTablesList", "database":"p2:v:v:i"},
				// 	"update_var": "Tables",
				// }
				},
				"p3": {"n": "Table", "m": true, "types":["TH"], "v": {"t":"TH", "thfixed":true, "v":{"th":"Tables", "i":"","l":""} }, "ajax": {
					"ajax-action": {"action": "getTablesList", "database":"p2:v:v:i"},
					"response_var": "Tables",
				}, "onSelect":[
					{
						"action": "ajax",
						"ajax-action": {"action":"getTableFields", "database":"p2:v:v:i", "table":"p3:v:v:i"},
					 	"post_actions": [
					 		{"action":"update_var", "expect": "fields", "var": "TableFields"},
					 	],
					},
				]},
				"p4": {"n": "Action", "m": true, "types":["DBAction"], "v": {"t":"DBAction", "v":"FindOne" }},
			}},
			"setInputs": {"self":true, "return":"B", "out":false, "inputlist":"vars:inputs"},
			"callApi": {"self":true, "return":"B", "out":false},
			"getOutputs": {"self":false, "return":"O", "out":true, "outvar":"vars:outputs"},
			"getOutput": {"self":false, "return":"T", "out":true, "outvar":"vars:outputs"},
		},
		"vars": {
			"DBs": [],
			"Tables": [],
			"DBAction": ["Find", "FindOne", "Insert", "InsertMany", "UpdateOne", "UpdateMany", "DeleteOne", "DeleteMany"],
		},
		"things": {
			"TableFields": [],
		},
		"dependencies": {
			"p4": {
				"DBAction": {
					"Find": {
						"p5": {"n":"Conditions", "m":true, "types":["DBCondObject"], "v": {"t": "DBCondObject", "v":[] }},
					},
				}
			}
		}
	},
	"Database-MongoDb": {
		"p": {
			"UseDatabase": {"self":true, "return":"B", "out":false, "inputs":{
				"p2": {
					"n": "Database", 
					"m": true, 
					"types":["TH"], 
					"v": {"t":"TH", "thfixed":true, "v":{"th":"MongoDb", "i":"","l":""}},
				}
			}},
			"FindOne": {"self":false, "return":"O", "out":true, "inputs":{
				"p2": {
					"n": "Condition",
					"m": true, 
					"types":["MongoQ"], 
					"v": {"t":"MongoQ", "v":{}},
				},
				"p3": {
					"n": "Projection",
					"m": true, 
					"types":["MongoP"], 
					"v": {"t":"MongoP", "v":{}},
				}
			}},
			"SetAction": {"self":true, "return":"B", "out":false, "inputs":{
				"p2": {"n": "Table", "m": true, "types":["TH"], "v": {"t":"TH", "thfixed":true, "v":{"th":"Tables", "i":"","l":""} }, "ajax": {
					"ajax-action": {"action": "getTablesList"},
					"response_var": "Tables",
				}, 
			}}},
			"setInputs": {"self":true, "return":"B", "out":false, "inputlist":"vars:inputs"},
			"callApi": {"self":true, "return":"B", "out":false},
			"getOutputs": {"self":false, "return":"O", "out":true, "outvar":"vars:outputs"},
			"getOutput": {"self":false, "return":"T", "out":true, "outvar":"vars:outputs"},
		},
		"vars": {
			"DBs": [],
			"Tables": [],
			"DBAction": ["Find", "FindOne", "Insert", "InsertMany", "UpdateOne", "UpdateMany", "DeleteOne", "DeleteMany"],
		},
		"things": {
			"TableFields": [],
		},
		"dependencies": {
			"p4": {
				"DBAction": {
					"Find": {
						"p5": {"n":"Conditions", "m":true, "types":["DBCondObject"], "v": {"t": "DBCondObject", "v":[] }},
					},
				}
			}
		}
	},
};
