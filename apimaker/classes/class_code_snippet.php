<?php  

class code_snippet{
	public $selected_lang = "";
	public $version_id = "";
	public $url = "";
	public $headers = "";
	public $postbody = "";
	public $req_method = "";

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
			return $this->php_curl_code_snippet_convertor($this->url,$this->headers,$this->postbody,$this->req_method);
		}
	}

	function php_curl_code_snippet_convertor() {

	    $identity = "\t";
	    $indentation = str_repeat($identity, "1");
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
	    
	    if(count($this->postbody) > 0) {
	    	$snippet .= json_encode($this->postbody);
	    }

	    $snippet .= json_encode($this->headers);

	    $snippet .= "));\n\n";
	    $snippet .= "\$response = curl_exec(\$curl);\n\n";
	    $snippet .= "curl_close(\$curl);\n";
	    $snippet .= "echo \$response;\n";
	    $snippet .= "?>";
	    return $snippet;
	}
}

?>