<?php  

class code_snippet{
	public $selected_lang = "";
	public $version_id = "";
	public $url = "";
	public $headers = "";
	public $postbody = "";
	public $req_method = "";
	public $options = [];

	public function  __construct($version_id = "",$url = "",$selected_lang = "") {
		$this->url = $url;
		$this->version_id = $version_id;
		$this->selected_lang = $selected_lang;
	}

	function code_snippet_convertor() {
		global $mongodb_con;

		if($this->version_id == "") {
			return ["status"=>"fail","error"=>"Version Id should not be empty"];
		}
		if($this->selected_lang == "") {
			return ['status' => 'fail','error' => 'Please select Code Display Language'];
		}
		$api_data = $mongodb_con->find_one("phpengine_apis_versions",['_id' => $this->version_id]);
		$api_data = $api_data['data'];

		$req_body = [];
		foreach($api_data['engine']['input_factors'] as $i => $j) {
			$req_body[$i] = "";
		}

		$this->postbody = $req_body;
		$this->req_method = $api_data['input-method'];
		$this->headers = ['Content-Type' => $api_data['output-type']];

		if($this->selected_lang == "php-curl") {
			return $this->php_curl_code_snippet_convertor();
		}else if($this->selected_lang == "Javascript-Fetch") {
			return $this->js_fetch_code_snippet_convertor();
		}else if($this->selected_lang == "Javascript-jQuery") {
			return $this->js_jquery_code_snippet_convertor();
		}else {
			return "Comming soon... ";
		}
	}

	function js_fetch_code_snippet_convertor() {
		$identity = "\t";
	    $indentation = str_repeat($identity, "1");

	    $snippet = "";

	    /*Request header condition start*/
	    if(count($this->headers) > 0) {
	    	$snippet .= "const myHeaders = new Headers();\n";
	    	foreach($this->headers as $i => $j) {
	    		$snippet .= "myHeaders.append('" . $i . "', '" . $j . "');\n\n"; 
	    	}
	    }
	    /*Request header condition ends*/

	    /*Request body formate condition start*/
	    if(count($this->postbody) > 0) {
	    	$snippet .= "const raw = ";
	    	if($this->headers['Content-Type'] == "application/json") {
	    		$snippet .= "JSON.stringify(" . json_encode($this->postbody, JSON_PRETTY_PRINT) . ");\n\n";
	    	}else {
	    		$snippet .= $this->postbody;
	    	}
	    } 
	    /*Request body formate condition ends*/

	    /*Request timeout condition start*/
	    $snippet .= "const controller = new AbortController();\n";
    	$snippet .= "const timerId = setTimeout(() => controller.abort(), 20);\n\n";
	    /*Request timeout condition ends*/

	    $snippet .= "const requestOptions = {\n";
	    $snippet .= $indentation.'method: "' . $this->req_method . '",'."\n";
	    if (count($this->headers) > 0) {
	    	$snippet .= $indentation."headers: myHeaders,\n";
	    }

	    if(count($this->postbody) > 0) {
	    	$snippet .= $indentation."body: raw,\n";
	    }

	    $snippet .= $indentation."signal: controller.signal,\n";
	    $snippet .= $indentation."redirect: 'follow'\n";
	    $snippet .= "};\n\n";

	    /*Fetch request syntax start*/
	    if ($this->options['asyncAwaitEnabled']) {
	    	$snippet .= 'try {' . "\n";
	    	$snippet .= 'const response = await fetch("' . $this->url . '", requestOptions);' . "\n";
	    	$snippet .= 'const result = await response.text();' . "\n";
	    	$snippet .= 'console.log(result)' . "\n";
	    	$snippet .= '} catch (error) {' . "\n";
	    	$snippet .= 'console.error(error);' . "\n";
    		$snippet .= '} finally {' . "\n";
    		$snippet .= 'clearTimeout(timerId);' . "\n";
	    	$snippet .= '};';
	    } else {
	    	$snippet .= 'fetch("' . $this->url . '", requestOptions)' . "\n";
	    	$snippet .= '.then((response) => response.text())' . "\n";
	    	$snippet .= '.then((result) => console.log(result))' . "\n";
	    	$snippet .= '.catch((error) => console.error(error))';
	    	$snippet .= "\n" . '.finally(() => clearTimeout(timerId))';
	    	$snippet .= ';';
	    }
	    /*Fetch request syntax ends*/

	    return $snippet;
	}

	function php_curl_code_snippet_convertor() {
	    $identity = "\t";
	    $indentation = str_repeat($identity, "1");

	    $snippet = "";
	    $snippet = "<?php\n\n\$curl = curl_init();\n\n";
	    $snippet .= "curl_setopt_array(\$curl, array(\n";
	    $snippet .= $indentation . "CURLOPT_URL => '" . $this->url . "',\n";
	    $snippet .= $indentation . "CURLOPT_RETURNTRANSFER => true,\n";
	    $snippet .= $indentation . "CURLOPT_ENCODING => '',\n";
	    $snippet .= $indentation . "CURLOPT_MAXREDIRS => 10,\n";
	    $snippet .= $indentation . "CURLOPT_TIMEOUT => 20,\n";
	    $snippet .= $indentation . "CURLOPT_FOLLOWLOCATION => true,\n";
	    $snippet .= $indentation . "CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,\n";
	    $snippet .= $indentation . "CURLOPT_CUSTOMREQUEST => '" . $this->req_method . "',\n";

	    $header_parts = [];
	    foreach($this->headers as $i => $j) {
	    	$header_parts[] = "'".$i .":". $j."'";
	    }

	    if(count($this->postbody) > 0) {
	    	$snippet .= $indentation . "CURLOPT_POSTFIELDS => '" .json_encode($this->postbody, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT). "',\n";
	    	$snippet .= $indentation . "CURLOPT_HTTPHEADER => array(" .implode(",",$header_parts). "),\n";
	    }

	    $snippet .= "));\n\n";
	    $snippet .= "\$response = curl_exec(\$curl);\n\n";
	    $snippet .= "curl_close(\$curl);\n";
	    $snippet .= "echo \$response;\n";
	    $snippet .= "?>";
	    return $snippet;
	}

	function js_jquery_code_snippet_convertor() {
		$identity = "\t";
	    $indentation = str_repeat($identity, "1");

	    $header_parts = [];
	    foreach($this->headers as $i => $j) {
	    	$header_parts[] = $i .":". $j;
	    }

	    $snippet = "";
	    $snippet .= "var settings = {\n";
	    $snippet .= $indentation. "'url': '" .$this->url. "',\n";
	    $snippet .= $indentation. "'method': " .$this->req_method.",\n";
	    $snippet .= $indentation. "'timeout': 20,\n";
	    $snippet .= $indentation. "'headers': " .json_encode($header_parts, JSON_UNESCAPED_SLASHES).",\n";
	    $snippet .= $indentation. "'data': JSON.stringify(" .json_encode($this->postbody, JSON_PRETTY_PRINT). "),\n";
	    $snippet .= $indentation. "};\n\n";

	    $snippet .= $indentation. "$.ajax(settings).done(function (response) {\n";
	    $snippet .= $indentation. "console.log(response);\n});";

	    return $snippet;
	}
}

?>