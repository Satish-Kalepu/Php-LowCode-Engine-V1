<script>
<?php 

	// functions list
	require("page_apis_api_functions.js");
	require("page_apis_api_stage_params.js");

	$components = [
		"input_field",
		"input_object",
		"input_factors_list",
	];
	foreach( $components as $i=>$j ){
		require("apps/" . $j . ".js");
	}

	if( 1==2 ){
	// components
	include("apps/input_field.js");
	include("apps/input_object.js");
	include("apps/input_factors_list.js");
	include("apps/apis_vobjectlist.js");
	include("apps/apis_vlistitem.js");
	include("apps/apis_vobject.js");
	include("apps/apis_vfield.js");
	include("apps/simplelist.js");
	include("apps/simplelist2.js");
	include("apps/simpleobject.js");
	include("apps/simplefield.js");
	include("apps/apis_voutputmapper_vlist.js");
	include("apps/apis_voutputmapper_vobject.js");
	include("apps/apis_voutputmapper_vfield.js");
	include("apps/renderblock.js");
	include("apps/renderarticle.js");
	include("apps/renderhtml.js");
	include("apps/pagesettings.js");
	include("apps/db.js");
	include("apps/dynamodb.js");
	include("apps/aws.js");
	include("apps/elasticdb.js");
	include("apps/sqlite.js");
	include("apps/dynamicdb.js");
	include("apps/dynamic_form.js");
	include("apps/static_form.js");
	include("apps/queue_push.js");
	//include("apps/dbredis.js");
	include("apps/thingdb.js");
	include("apps/sms.js");
	include("apps/email.js");
	include("apps/vlist.js");
	//include("apps/globalprocedure.js");
	//include("apps/procedure.js");
	include("apps/httprequest.js");
	include("page_app_pages_functions.js");
	include("page_app_pages_redis.js");
	include("page_app_pages_edit_htmlelements.js");
	}

?>
const temp1 = {
	template: `<div>temp1 component</div>`
};

String.prototype.toProperCase = function(){
    return this.replace(/\w\S*/g, function(txt){
    	return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
	});
};

var app = Vue.createApp({
	data(){
		return {
			path: '<?=$config_global_apimaker_path ?>',
			msg: "",
			err: "",
			cmsg: "",
			cerr: "",
			api__: <?=json_encode($api) ?>,
			edit_api: {},
			edit_modal: false,
			token: "",
			engine__: {},
			vshow: false,

			"server_host__"			: "<?=$config_page_domain ?>",
			"version__"			: "<?=$api["_id"] ?>",
			"versions_list"			: {},
			"api_tables__"			: {},
			"api_dynamic_tables__"		: {},
			"api_elastic_tables__"		: {},
			"api_redis_tables__"		: {},
			"api_things__"			: {},
			"page__"			: {},
			"alias_lists__"			: {},
			"api_blocks__"			: {},
			"api_articles__"		: {},
			"files_list__"			: {},
			"test1111"			: 11111,
			"show_add_input_factor_form__"	: false,
			"html_elements__"		: {},
			"is_locked__"			: false,
			"verror__"			: "",
			"all_factors__"			: {},
			"all_factors_stage_wise__"	: {},
			"show_saving__"			: false,
			"save_message__"		: "Saving..",
			"save_need__"			: false,
			"show_stages__"			: false,
			"show_test_tab__"		: false,
			"code_editor_full__"		: true,
			"test__"			: {},
			"test_status__"			: "",
			"test_error__"			: "",
			"test_response__"		: false,
			"test_headers_show__"		: false,
			"test_log__"			: [],
			"test_debug__"			: false,
			"test_waiting__"		: false,
			"test_url__"			: "",
			"json_view__"			: false,
            "lock_status__"			: 0,
            "async_used__"			: false,
            "async_skip__"			: true,
            "stage_wise_errors__"		: {},
            "show_import_popup__"		: false,
			"vrand__"			: "s_" + (Math.random()*1000000).toFixed(0),
			"label_names__"			: [],
			"stage_names__"			: {},
			"functions_data__"		: config_functions_data,
			"functions__"			: config_functions,
			"redis_functions__"		: {},
			"show_add_new_of__"		: false,
			"current_year__"		: "2020",
			"date_today__"			: "2020-01-01",
			"datetime__"			: "2020-01-01 01:01:01",
			"import_xml__"			: false,
        		"import_xml_content__"		: "",
        		"import_json__"			: false,
        		"import_json_content__"		: "",
        		"checks__"			: [],
        		"checked_items__"		: false,
        		"flags__"			: {},
			"test_url_main"			: "",
			"input_factor_types__"		: {
								"text": "Text",
								"number": "Number",
								"date": "Date",
								"datetime": "DateTime",
								"list": "List",
								"dict": "Assoc List",
								"boolean": "Boolean"
							  },
			"predefined_types__"		: {
								"yearc": "Current Year",
								"date": "Date Today",
								"datefs": "Firm Start date",
								"datefe": "Firm End Date",
								"datetime": "DateTime Now",
								"time": "Time Now",
								"timestamp": "UnixTimeStamp",
							  },
			"variables__"			: {},
        		"block_types__"			: {
						 		"static"		: "Static HTML",
						 		"staticrender"		: "Static HTML Render",
						 		"article"		: "Article",
						 		"carousel"		: "Carousel",
								"contactus"		: "Contact Us",
								"headline"		: "Headline",
								"footer"		: "Footer",
								"image"			: "Image",
								"imagelibrary"		: "Image Library",
								"list"			: "list",
								"card"			: "Multiple Card",
								"single-card"		: "Single Card",
								"simple-table"		: "Simple Table",
								"subscribe"		: "Subscribe",
						 		"vueapp"		: "VueJs App",
						 		"reactapp"		: "ReactJs APP",
						 		"googlemap"		: "Google Map",
						 		"imagelibrary"		: "Image Library"
							 },
							"stages_by_type__"		: [
								{
									"group": "none",
									"sub": {
										"none": {"page":true, "api":true, "function":true},
									}
								},
								{
									"group": "Expression",
									"sub": {
										"Let": {"page":true, "api":true, "function":true},
										"Assign": {"page":true, "api":true, "function":true},
										"Math": {"page":true, "api":true, "function":true},
										"Expression": {"page":true, "api":true, "function":true},
										"Function": {"page":true, "api":true, "function":true},
										"GlobalProcedure": {"page":true, "api":true, "function":true},
										"Procedure": {"page":true, "api":true, "function":true},
										"ParseJson": {"page":false, "api":true, "function":true},
										"ParseXml": {"page":false, "api":true, "function":true},
									}
								},
								{
									"group": "Control",
									"sub": {
										"If": {"page":true, "api":true, "function":true},
										"While": {"page":true, "api":true, "function":true},
										"For": {"page":true, "api":true, "function":true},
										"ForEach": {"page":true, "api":true, "function":true},
										"BreakLoop": {"page":true, "api":true, "function":true},
										"SetLabel": {"page":true, "api":true, "function":true},
										"JumpToLabel": {"page":true, "api":true, "function":true},
										"Sleep": {"page":false, "api":true, "function":true},
										"Async": {"page":true, "api":true, "function":true},
									}
								},
								{
									"group": "Output",
									"sub": {
										"Output": {"page":true, "api":true, "function":true},
										"OutputValue": {"page":false, "api":true, "function":false},
										"PageSettings": {"page":true, "api":false, "function":false},
										"RenderBlock": {"page":true, "api":false, "function":false},
										"RenderArticle": {"page":true, "api":false, "function":false},
										"RenderHTML": {"page":true, "api":false, "function":false},
										"HTMLElement":  {"page":true, "api":false, "function":false},
										"Respond": {"page":true, "api":true, "function":false},
										"RespondError": {"page":true, "api":true, "function":false},
										"Log": {"page":false, "api":true, "function":true},
										"SetSession": {"page":true, "api":true, "function":true},
										"SetCookie": {"page":true, "api":true, "function":true},
									}
								},
								{
									"group": "Pluggins",
									"sub": {
										"DataBase"			: {"page":true, "api":true, "function":true},
										"SQLite"		: {"page":true, "api":true, "function":true},
										"ElasticTable"		: {"page":true, "api":true, "function":true},
										"DynamicTable"		: {"page":true, "api":true, "function":true},
										"CreateCollection"	: {"page":true, "api":true, "function":true},
										/*"DynamoDB"		: {"page":true, "api":true, "function":true},
										"Redis"			: {"page":true, "api":true, "function":true},*/
									}
								},
								{
									"group": "Database",
									"sub": {
										"DB"			: {"page":true, "api":true, "function":true},
										"SQLite"		: {"page":true, "api":true, "function":true},
										"ElasticTable"		: {"page":true, "api":true, "function":true},
										"DynamicTable"		: {"page":true, "api":true, "function":true},
										"CreateCollection"	: {"page":true, "api":true, "function":true},
										/*"DynamoDB"		: {"page":true, "api":true, "function":true},
										"Redis"			: {"page":true, "api":true, "function":true},*/
									}
								},
								{
									"group": "Messaging",
									"sub": {
										"SMS": {"page":false, "api":true, "function":true},
										"EMail": {"page":false, "api":true, "function":true},
										"Queue": {"page":false, "api":true, "function":true},
										"Notification": {"page":false, "api":true, "function":true},
									}
								},
								{
									"group": "Form/User Input",
									"sub": {
										"StaticForm": {"page":true, "api":false, "function":false},
										"DynamicForm": {"page":true, "api":true, "function":false},
									}
								},
								{
									"group": "Miscellaneous",
									"sub": {
										"HTTPRequest": {"page":true, "api":true, "function":true},
										"QueuePush": {"page":true, "api":true, "function":true},
										"AWS": {"page":false, "api":true, "function":true},
									}
								}
							],
			"stage_params__"	: config_stage_params__,

				context_menu__: false,
				context_el__: false,
				context_style__: "top:50px;left:50px;",
				context_stage_id__: -1,
				context_list__: [],
				context_type__: "",
				context_datavar__: "",
				context_menu_current_item__: "",
				context_menu_key__: "",

		};
	},
	mounted(){
		this.load_initial_data__();
		//document.addEventListener("mousedown", this.event_mousedown );
		document.addEventListener("keyup", this.event_keyup );
		document.addEventListener("keydown", this.event_keydown);
		document.addEventListener("click", this.event_click, true);
		document.addEventListener("scroll", this.event_scroll, true);
	},
	methods: {
		event_scroll: function(e){
			if( e.target.className == "codeeditor_block_a" ){
				if( this.context_menu__ ){
					this.set_context_menu_style__();
				}
			}
		},
		event_keyup: function(e){
			console.log( e.target.hasAttribute("data-type") );
			if( e.target.hasAttribute("data-type") ){
				if( e.target.getAttribute("data-type") == "editable" ){
					console.log( e.keyCode );
					console.log( e.target.nextSibling );
					//e.target.nextSibling nextElementSibling
					if( e.target.nextSibling ){

					}else{
						e.target.insertAdjacentHTML("afterend", `<div class="inlinebtn" data-type="editablebtn" ><i class="fa fa-check-square-o" ></i></div>` );
					}
				}
			}
		},
		event_keydown: function(e){
			// var el = e.target;
			// for(var c=0;c<5;c++){
			// 	if( el.hasAttribute("data-type") ){
			// 		e.stopPropagation();
			// 		break;
			// 	}
			// 	el = el.parentNode;
			// }
			if( e.hasAttribute("data-type") ){
				if( e.getAttribute("data-type") =="editable" ){
					if( e.keyCode == 13 || e.keyCode == 10 ){
						e.preventDefault();

					}
				}
			}
		},
		event_click: function(e){
			var el = e.target;
			console.log( el );
			var f = false;
			var el_context = false;
			var el_data_type = false;
			var stage_id = -1;
			var data_var = "";
			var data_var_l = [];
			for(var c=0;c<5;c++){
				try{
					if( el.hasAttribute("data-context") && el_context == false ){
						el_context = el;
					}
					if( el.hasAttribute("data-type") && el_data_type == false ){
						el_data_type = el;
					}
					if( el.hasAttribute("data-var") && data_var == false ){
						data_var = el.getAttribute("data-var");
						data_var_l = data_var.split(/\:/g);
					}

					if( el.hasAttribute("data-stagei") ){
						stage_id = Number(el.getAttribute("data-stagei"));
					}
					el = el.parentNode;
					console.log( el );
				}catch(e){
					console.log( el );
					console.log( "Error: " + e );
					break;
				}
			}
			if( el_data_type ){
				console.log("Element Data-Type");
				console.log( el_data_type );
				var t = el_data_type.getAttribute("data-type");
				if( t == "dropdown" ){
					this.context_el__ = el_data_type;
					this.context_menu_key__ = "";
					this.context_stage_id__ = stage_id;
					this.context_type__ = el_data_type.getAttribute("data-list");
					this.context_datavar__ = data_var;
					if( this.context_type__ == "fixed" ){
						this.context_list__ = el_data_type.getAttribute("data-list-values").split(",");
					}
					this.show_and_focus_context_menu__();
					this.set_context_menu_style__();
				}else if( t == "editablebtn" ){
					this.editable_update( el_data_type, stage_id, data_var);
				}
			}else if( el_context ){
				console.log("Element Data-Context");
				
			}else{
				if( this.context_menu__ ){
					this.context_menu__ = false;
				}
			}
		},
		editable_update: function( el, stage_id, data_var ){
			var v = el.previousSibling.innerHTML;
			var x = data_var.split(":");
			this.engine__['stages'][ stage_id ][ x[0] ][ x[1] ] = v;
			el.outerHTML = "";
			this.updated_stage_var(stage_id, data_var, v );
		},
		show_and_focus_context_menu__: function(){
			setTimeout(function(){document.getElementById("contextmenu_key1").focus();},300);
			this.context_menu__ = true;
		},
		set_context_menu_style__: function(){
			var s = this.context_el__.getBoundingClientRect();
			this.context_style__ = "top: "+s.top+"px;left: "+s.left+"px;";
		},
		get_context_list__: function(){
			var v = [];
			for(var i=0;i<this.stages_by_type__.length;i++){
				for(var s in this.stages_by_type__[i]['sub']){
					v.push({
						"g":this.stages_by_type__[i]['group'],
						"c":s,
					});
				}
			}
			return v;
		},
		context_menu_keyup__: function(e){
			this.get_context_list__();
		},
		context_menu_key_match__: function(v){
			if( this.context_menu_key__ == "" ){
				return true;
			}else if( v.toLowerCase().indexOf(this.context_menu_key__.toLowerCase() ) > -1 ){
				return true;
			}
		},
		context_menu_key_highlight__: function(v){
			var r = new RegExp( this.context_menu_key__ , "i" );
			console.log( r );
			var c = v.match( r );
			console.log( c );
			return v.replace( c, "<span>"+c+"</span>" );
		},
		context_select__(k, t){
			//this.engine__['stages'][ this.context_stage_id__ ]['k'] = k
			var x = this.context_datavar__.split(":");
			if( x[0] == "k" ){
				this.stage_change_stage__(this.context_stage_id__,k,t);
			}else if( x.length > 1 ){
				this.engine__['stages'][ this.context_stage_id__ ][ x[0] ][ x[1] ] = k;
			}else if( x.length > 2 ){
				this.engine__['stages'][ this.context_stage_id__ ][ x[0] ][ x[1] ][ x[2] ] = k;
			}
			this.updated_stage_var(this.context_stage_id__, this.context_datavar__, k );
			this.updated_option__(this.context_stage_id__);
			this.context_menu__ = false;
		},
		is_token_ok(t){
			if( t!= "OK" && t.match(/^[a-f0-9]{24}$/)==null ){
				setTimeout(this.token_validate,100,t);
				return false;
			}else{
				return true;
			}
		},
		open_edit_form: function(){
			this.edit_modal = new bootstrap.Modal(document.getElementById('edit_modal'));
			this.edit_modal.show();
			this.cmsg = ""; this.cerr = "";
			this.edit_api = this.json__(this.api);
		},
		token_validate(t){
			if( t.match(/^(SessionChanged|NetworkChanged)$/) ){
				this.err = "Login Again";
				alert("Need to Login Again");
			}else{
				this.err = "Token Error: " + t;
			}
		},
		load_apis(){
			this.msg = "Loading...";
			this.err = "";
			axios.post("?", {"action":"get_token","event":"getapis","expire":2}).then(response=>{
				this.msg = "";
				if( response.status == 200 ){
					if( typeof(response.data) == "object" ){
						if( 'status' in response.data ){
							if( response.data['status'] == "success" ){
								this.token = response.data['token'];
								if( this.is_token_ok(this.token) ){
									this.load_apis2();
								}
							}else{
								alert("Token error: " + response.data['data']);
								this.err = "Token Error: " + response.data['data'];
							}
						}else{
							this.err = "Incorrect response";
						}
					}else{
						this.err = "Incorrect response Type";
					}
				}else{
					this.err = "Response Error: " . response.status;
				}
			});
		},
		load_apis2(){
			this.msg = "Loading...";
			this.err = "";
			axios.post("?",{"action":"get_apis","token":this.token}).then(response=>{
				this.msg = "";
				if( response.status == 200 ){
					if( typeof(response.data) == "object" ){
						if( 'status' in response.data ){
							if( response.data['status'] == "success" ){
								this.apis = response.data['data'];
							}else{
								alert("Token error: " + response.data['error']);
								this.err = "Token Error: " + response.data['error'];
							}
						}else{
							this.err = "Incorrect response";
						}
					}else{
						this.err = "Incorrect response Type";
					}
				}else{
					this.err = "Response Error: " . response.status;
				}
			});
		},
		cleanit(v){
			v = v.replace( /\-/g, "DASH" );
			v = v.replace( /\_/g, "UDASH" );
			v = v.replace( /\W/g, "-" );
			v = v.replace( /DASH/g, "-" );v = v.replace( /UDASH/g, "_" );
			v = v.replace( /[\-]{2,5}/g, "-" );
			v = v.replace( /[\_]{2,5}/g, "_" );
			return v;
		},
		editnow(){
			this.cerr = "";
			this.edit_api['name'] = this.cleanit(this.edit_api['name']);
			if( this.edit_api['name'].trim() == "" ){
				this.cerr = "Name incorrect";
				return false;
			}
			if( this.edit_api['des'].match(/^[a-z0-9\.\_\&\,\!\@\'\"\ \r\n]{5,200}$/i) == null ){
				this.cerr = "Description incorrect. Special chars not allowed";
				return false;
			}
			this.cmsg = "Editing...";
			axios.post("?", {"action":"get_token","event":"edit_api"+this.edit_api['_id'],"expire":2}).then(response=>{
				this.msg = "";
				if( response.status == 200 ){
					if( typeof(response.data) == "object" ){
						if( 'status' in response.data ){
							if( response.data['status'] == "success" ){
								this.token = response.data['token'];
								if( this.is_token_ok(this.token) ){
									axios.post("?", {
										"action": "edit_api", 
										"edit_api": this.edit_api,
										"token": this.token
									}).then(response=>{
										this.cmsg = "";
										if( response.status == 200 ){
											if( typeof(response.data) == "object" ){
												if( 'status' in response.data ){
													if( response.data['status'] == "success" ){
														this.cmsg = "Created";
														this.edit_modal.hide();
														this.api = JSON.parse( JSON.stringify(this.edit_api));
													}else{
														this.cerr = response.data['error'];
													}
												}else{
													this.cerr = "Incorrect response";
												}
											}else{
												this.cerr = "Incorrect response Type";
											}
										}else{
											this.cerr = "Response Error: " . response.status;
										}
									});
								}
							}else{
								alert("Token error: " + response.dat['data']);
								this.err = "Token Error: " + response.data['data'];
							}
						}else{
							this.err = "Incorrect response";
						}
					}else{
						this.err = "Incorrect response Type";
					}
				}else{
					this.err = "Response Error: " . response.status;
				}
			});
		},
		load_initial_data__: function(){
			var vd__ = {
				"action"		: "load_engine_data",
			};
			axios.post( "?",vd__).then(response=>{
				if( response.data["status"] == "success" ){
					if( typeof( response.data["engine"] ) == "object" && 'length' in response.data["engine"] == false ){
						this.engine__		= response.data["engine"];
					}
					console.log( this.engine__ );
					if( typeof( response.data["test"] ) == "object" && 'length' in response.data["test"] == false ){
						this.test__ 		= response.data["test"];
					}
					console.log( "loaded..." );
					this.load_initial_data2__();
				}else{
					alert("Server Error.Please Try After Sometime");
				}
			});
		},
		load_initial_data2__: function(){
			console.log("load initial data2 ");
			if( this.engine__.hasOwnProperty("input_factors") == false ){
				this.engine__['input_factors'] ={};
			}else if( this.engine__["input_factors"].hasOwnProperty("length") ){
				this.engine__['input_factors'] = {};
			}
			console.log( this.engine__ );
			if( 'stages' in this.engine__ == false ){
				this.engine__['stages'] =[];
			}
			if( this.engine__.hasOwnProperty("output_vars") == false ){
				this.engine__['output_vars'] = {};
			}else if( this.engine__["output_vars"].hasOwnProperty("length") ){
				this.engine__['output_vars'] = {};
			}
			if( this.engine__.hasOwnProperty("session_schema") == false ){
				this.engine__['session_schema'] = {};
			}else if( this.engine__["session_schema"].hasOwnProperty("length") ){
				this.engine__['session_schema'] = {};
			}
			if( this.engine__.hasOwnProperty("cookie_schema") == false ){
				this.engine__['cookie_schema'] ={};
			}else if( this.engine__["cookie_schema"].hasOwnProperty("length") ){
				this.engine__['cookie_schema'] ={};
			}
			var dt = new Date();
			this.current_year__ = dt.getFullYear();
			this.date_today__ = dt.toJSON().substr(0,10);
			this.datetime__ = dt.toJSON().substr(0,19).replace("T", " " );
			this.find_checks__();
			this.fill_variables__();
			this.vshow	= true;			
		},
		stage_show_or_not__: function( v ){
			for(var j=0;j<this.stages_by_type__.length;j++){
				if( v in this.stages_by_type__[j]['sub'] ){
					if( this.api__['type'] in this.stages_by_type__[j]['sub'][ v ] ){
						if( this.stages_by_type__[j]['sub'][ v ][ this.api__['type'] ] == true ){
							return true;
						}
					}
				}
			}
			return false;
		},
		input_type_change__: function(){
			if( this.api__['input-type'] == "application/x-www-form-urlencoded" ){
				for(var i in this.engine__['input_factors'] ){
					if( this.engine__['input_factors'][i]['type'] != "text" && this.engine__['input_factors'][i]['type'] != "number" ){
						this.engine__['input_factors'][i][ 'type' ] =  "text" ;
						this.engine__['input_factors'][i][ 'sub' ] =  {} ;
					}
				}
			}
			this.save_need__ = true;
		},
		page_type_change__: function(){
			this.test_response__ = false;
			this.save_need__ = true;
			if( this.api__['type'] =="function" ){
				this.api__[  'input-method' ] =  "POST";
				this.api__[  'input-type' ] =  "application/json";
				this.api__[  'output-type' ] =  "application/json" ;
				if( "output_vars" in this.api__['engine'] == false ){
					this.api__['engine'][  "output_vars" ] =  {} ;
				}
			}
		},
		page_method_change__: function(){
			if( this.api__['input-method'] == "GET" ){
				this.api__[  'input-type' ] =  "application/json";
				this.api__[  'output-type' ] =  "application/json" ;
			}
			if( this.api__['input-method'] == "POST" ){
				this.api__[  'input-type' ] =  "application/json";
				this.api__[  'output-type' ] =  "application/json";
			}
			this.save_need__ = true;
		},
		input_factors_edited__: function( vdata ){
			this.engine__[  'input_factors' ] =  vdata ;
			this.save_need__ = true;
			this.fill_variables__();
		},
		session_schema_edited__: function( vdata ){
			this.engine__[  'session_schema' ] =  vdata ;
			this.save_need__ = true;
			this.fill_variables__();
		},
		cookie_schema_edited__: function( vdata ){
			this.engine__[  'cookie_schema' ] =  vdata ;
			this.save_need__ = true;
			this.fill_variables__();
		},
		get_object_to_list__: function( vd ){
			var v = this.get_object_to_list2__( vd, "" );
			return v
		},
		get_object_to_list2__: function( vd, vp ){
			var v = [];
			for( var i in vd ){
				v.push({
					"key": vp + i,
					"name": vd[i]['name'],
					"type": vd[i]['type'],
					"m": vd[i]['m'],
				});
				if( vd[i]['type'] == "dict" ){
					var v2 = this.get_object_to_list2__( vd[i]['sub'], vp + i + "->" )
					for( var i2=0;i2<v2.length;i2++){
						v.push( v2[i2] );
					}
				}
				if( vd[i]['type'] == "list" ){
					var v2 = this.get_object_to_list2__( vd[i]['sub'], vp + i + "->[]->" )
					for( var i2=0;i2<v2.length;i2++){
						v.push( v2[i2] );
					}
				}
			}
			return v;
		},
		get_vars_list__: function( vlist, vmatch ){
			var n = {};
			if( vmatch.indexOf("->EachKey") > 0 ){
				var vmatch_ = vmatch.replace("->EachKey", "" );
				for(var jj in vlist){
					if( jj.indexOf( vmatch_ ) == 0 ){
						if( jj.indexOf( vmatch_ + "->" ) == 0 ){
							var p22 = jj.replace(vmatch_+"->", "");
							n[ p22 ] = {
								"name": p22,
								"type": vlist[jj]['type'],
							}
						}
					}
				}
			}else if( vmatch.indexOf("->EachValue") > 0 ){
				var vmatch_ = vmatch.replace("->EachValue", "" );
				for(var jj in vlist){
					if( jj.indexOf( vmatch_ ) == 0 ){
						if( jj.indexOf( vmatch_ + "->" ) == 0 ){
							var p22 = jj.replace(vmatch_+"->", "");
							var s = p22.split("->");
							if( s[0] ){
								if( p22.indexOf( s[0] +"->" ) == 0 ){
									p22 = p22.replace( s[0] + "->", "" );
									if( p22 ){
										n[ p22 ] = {"name": p22, "type": vlist[jj]['type']}
									}
								}
							}
						}
					}
				}
			}else{
				var vmatch_ = vmatch.replace("->EachKey", "" );
				for(var jj in vlist){
					if( jj.indexOf( vmatch_ ) == 0 ){
						var p22 = jj.replace(vmatch_+"->", "");
						n[ p22 ] = {
							"name": p22,
							"type": vlist[jj]['type'],
						}
					}
				}
			}
			return n;
		},
		get_keys_list__: function( vlist, vmatch ){
			var n = [];
			var vmatch_ = vmatch.replace("->EachKey", "" );
			for(var jj in vlist){
				if( jj.indexOf( vmatch_ ) == 0 ){
					if( jj.indexOf( vmatch_ + "->" ) == 0 ){
						var p22 = jj.replace(vmatch_+"->", "");
						var s = p22.split("->");
						if( s.length > 0 ){
							if( s[0] !="EachKey" && s[0] !="EachValue" ){
								n.push( s[0] );
							}
						}
					}
				}
			}
			return n;
		},
		merge_variables__: function( vo, vd ){
			for( var i=0;i<vd.length;i++ ){
				vo[ vd[i]['key']+"" ] = {
					"name": vd[i]['name']+"",
					"type": vd[i]['type']+"",
				}
			}
			return vo;
		},
		ksort__: function( vd ){
			var oo = {};
			var _o = Object.keys(vd).sort();
			for( var i in _o ){
				oo[ _o[i]+"" ] = {
					"name": vd[ _o[i] ]['name']+"",
					"type": vd[ _o[i] ]['type']+"",
				};
			}
			return oo
		},
		get_output_var_dump: function(vi, v){
			if( vi in this.all_factors__ ){
				if( this.all_factors__[ vi ]['type'] != "dict" && this.all_factors__[ vi ]['type'] != "list" ){
					return "Nil";
				}else{
					if( v == null ){
						return "null";
					}else if( typeof(v) == "object" && "length" in v ){
						var d = {};
						for(var i=0;i<v.length;i++){
							d[ v[i]['key'] ] = {"type": v[i]['type']};
						}
						if( this.all_factors__[ vi ]['type'] == "list" ){
							var dd = [{}];
						}else{
							var dd = {};
						}
						var d_keys = Object.keys( d ).sort();
						for(var i=0;i<d_keys.length;i++){
							var ii = d_keys[i];
							var vm = "";
							if( d[ii]['type'] == "text" ){ vm = "\"text\""; }
							if( d[ii]['type'] == "number" ){ vm = "\"number\""; }
							if( d[ii]['type'] == "dict" ){ vm = "{}"; }
							if( d[ii]['type'] == "list" ){ vm = "[{}]"; }
							var k = ii;
							//k = k.replace(/\[\]/g, "[0]");
							k = k.replace( /\-\>/g, "']['" );
							//k = k.replace( /\'\[\]\'/g, "[0]");
							k = "dd['"+ k + "'] = " + vm;
							k = k.replace( /\'\[\]\'/g, "0");
							try{
								eval(k);
							}catch(e){
								//console.log( k );
								return "error";
							}
						}
						return JSON.parse( JSON.stringify( dd, null, 4 ) );
					}else{
						return "unknown";
					}
				}
			}else{
				return "unknown";
			}
		},
		fill_variables__: function(){
			var used_outputs = {};
			var engine_output_vars = JSON.parse( JSON.stringify( this.engine__['output_vars'] ) );
			var o = {};
			var vin = this.get_object_to_list__( this.engine__['input_factors']);
			o = this.merge_variables__( o, vin );

			o[ "server_" ] = {"name": "server_","type": "dict"};
			o[ "server_->ip" ] = {"name": "server_->ip","type": "text"};
			o[ "server_->user-agent" ] = {"name": "server_->user-agent","type": "text"};
			for(var stagei__=0;stagei__<this.engine__['stages'].length;stagei__++ ){
				var staged__ = this.engine__['stages'][stagei__];
				if( staged__.hasOwnProperty("er") == false ){
					staged__[  'er' ] =  "" ;
				}
				var oo = this.ksort__(o);
				this.all_factors_stage_wise__[  Number(stagei__) ] =  oo ;
				
				
				if( staged__['k'] != "none" ){
					if( staged__['k'] == "MakeAsync" ){
						this.async_used__ = true;
					}
					if( staged__['k'] == "Let" ){
						if( staged__.hasOwnProperty("let") ){
							var vt = staged__['let']['name']+"";
							vt = vt.replace( /[\W]+/g, "" ).toLowerCase();
							if( vt ){
								o[ vt ] = {
									"name": vt+"",
									"type": staged__['let']['type'],
								};
								/*
								used_outputs[ vt ] = "1";
								if( vt in engine_output_vars == false ){
									engine_output_vars[vt]={
										"name": vt+'',
										"as": "",
										"type": staged__['let']['type']+'',
										"schema": [],
										"d_t": staged__['let']['type']+'',
										"d_v": '',
										"checked": true,
									};
								}else{
									engine_output_vars[vt]['type'] = staged__['let']['type'];
								}*/
							}
						}
					}
					if( staged__['k'] == "Output" ){
						if( staged__['output']['type'] == "variable" ){
							var vt = staged__['output']['value']+"";
							if( vt ){
							if( vt in o ){

								var ovsl = [];
								for(var jb in o ){
									if( jb.indexOf( vt + "->" ) == 0 ){
										ovsl.push({
											"key":jb.replace(vt + "->",''),
											"name":o[jb]['name']+'',
											"type":o[jb]['type']+''
										});
									}
								}
								used_outputs[ vt ] = "1";
								if( vt in engine_output_vars == false ){
									engine_output_vars[vt] = {
										"name": staged__['output']['value']+"",
										"as": staged__['output']['as']+"",
										"type": o[ vt ]['type']+'',
										"sch": ovsl,
										"d_t": o[ vt ]['type']+'',/*default type*/
										"d_v": '',/*default value*/
										"checked": true,
									};
								}else{
									engine_output_vars[vt]['as'] = staged__['output']['as']+"";
									engine_output_vars[vt]['type'] = o[ vt ]['type']+"";
									engine_output_vars[vt]['sch'] = ovsl;
								}
							}
							}
						}
					}
					if( staged__['k'] == "SMS" ){
						o['sms_result'] = {
							"name": "SMS Result",
							"type": "dict"
						}
						o['sms_result->status'] = {
							"name": "Status",
							"type": "text"
						}
						o['sms_result->error'] = {
							"name": "Error",
							"type": "text"
						}
					}
					if( staged__['k'] == "EMail" ){
						o['email_result'] = {
							"name": "Email Result",
							"type": "dict"
						}
						o['email_result->status'] = {
							"name": "Status",
							"type": "text"
						}
						o['email_result->error'] = {
							"name": "Error",
							"type": "text"
						}
					}
					if( staged__['k'] == "ForEach" ){
						if( staged__.hasOwnProperty("foreach") ){
							o[ staged__['foreach']['key']+"" ] = {
								"name": staged__['foreach']['key']+"",
								"type": "text",
							};
							var vt = staged__['foreach']['value'];
							o[ staged__['foreach']['value']+"" ] = {
								"name": staged__['foreach']['value']+"",
								"type": "text"
							}
							var k = this.find_sub_variables__( staged__['foreach']['var'], stagei__ );
							for(var i=0;i<k.length;i++){
								var vtt = vt+"->"+k[i]['key'];
								o[ vtt ]={
									"name": k[i]['name']+"",
									"type": k[i]['type']+"",
								};
							}
						}
					}
					if( staged__['k'] == "EndForEach" ){
						var ki = this.find_prev_rand__( stagei__ );
						if( ki != -1 ){
							delete o[ staged__['foreach']['key']+"" ];
							delete o[ staged__['foreach']['value']+"" ];
						}
					}
					if( staged__['k'] == "For" ){
						if( staged__.hasOwnProperty("for") ){
							var vt = staged__['for']['as'];
							o[ vt ] = {
								"name": vt,
								"type": "text",
							};
						}
					}
					if( staged__['k'] == "Assign" ){
						if( staged__['assign']['rhs']['type']=="json" ){
							var v = this.get_object_to_list__( staged__['assign']['rhs']['value'] );
							for( var i=0;i<v.length;i++ ){
								o[ staged__['assign']['lhs']+"->"+ v[i]['key'] ] = {
									"name":staged__['assign']['lhs']+"->"+ v[i]['key'],
									"type": v[i]['type']
								};
							}
						}
					}
					if( staged__['k'] == "EndFor" ){
						var ki = this.find_prev_rand__( stagei__ );
						if( ki != -1 ){
							var vt = this.engine__['stages'][ki]['for']['us']+"";
							delete o[ vt ];
						}
					}
					if( staged__['k'] == "Redis" ){
						var dba = staged__["db"]['action']+"";
						o[ "dbStatus" ] = {
							"name": "dbStatus",
							"type": "text"
						};
						var vt = staged__["db"]['output']+"";
					}
					if( staged__['k'] == "Function" ){
						if( staged__['function']['function'] == "Set Value" ){
							var p1 = staged__['function']['inputs']['p1']['value'];
							var p2 = staged__['function']['inputs']['p2']['value'];
							var p3 = staged__['function']['inputs']['p3']['value'];
							if( staged__['function']['inputs']['p2']['type'] == "variable" ){
								o[ p1 +"->" + "["+p2+"]" ] = {
									"name": p1 +"->" + "["+p2+"]",
									"type": staged__['function']['inputs']['p3']['type']+"",
								};
							}else{
								o[ p1 + "->" + p2 ] = {
									"name": p1 + "->" + p2,
									"type": staged__['function']['inputs']['p2']['type']+"",
								};
							}
						}
						if( staged__['function']['function'] == "Get List Item" ){
							var vt = staged__['function']['lhs'];
							o[ staged__['function']['lhs'] ] = {
								"name": staged__['function']['lhs'],
								"type": "dict",
							};
							var k = this.find_sub_variables__( staged__['function']['inputs']['p1']['value'], stagei__ );
							for(var i=0;i<k.length;i++){
								var vtt = vt+"->"+k[i]['key'];
								o[ vtt ]={
									"name": k[i]['name']+"",
									"type": k[i]['type']+"",
								};
							}
						}
					}
					if( staged__['k'] == "GlobalProcedure" ){
						o[ "procedureStatus" ] = {
							"name": "procedureStatus",
							"type": "text"
						};
						var vt = staged__["procedure"]['output']+"";
						o[ vt ] = {
							"name": vt,
							"type": "dict"
						};
						for(var i=0;i<staged__['procedure']['output_vars'].length;i++){
							var vtt = vt + "->" + staged__['procedure']['output_vars'][i]['name'];
							o[ vtt ] = {
								"name": vtt+"",
								"type": staged__['procedure']['output_vars'][i]['type']+"",
							}
						}
					}
					if( staged__['k'] == "Procedure" ){
						o[ "procedureStatus" ] = {
							"name": "procedureStatus",
							"type": "text"
						};
						var vt = staged__["procedure"]['output']+"";
						o[ vt ] = {
							"name": vt,
							"type": "dict"
						};
						for(var i=0;i<staged__['procedure']['output_vars'].length;i++){
							var vtt = vt + "->" + staged__['procedure']['output_vars'][i]['name'];
							o[ vtt ] = {
								"name": vtt+"",
								"type": staged__['procedure']['output_vars'][i]['type']+"",
							}
						}
					}
					if( staged__['k'] == "DynamoDB" ){
						var dba = staged__["db"]['action']+"";
						o[ "dbStatus" ] = {
							"name": "dbStatus",
							"type": "text"
						};
						var vt = staged__["db"]['output']+"";
						if( dba == "FindMany" ){
							o[ vt ] = {
								"name": vt,
								"type": "list"
							};
						}else{
							o[ vt ] = {
								"name": vt,
								"type": "dict"
							};
						}
						if( dba == "Insert" ){
							var vtt = vt + "->status";
							o[ vtt ] = {
								"name": vtt+"",
								"type": "text",
							}
							var vtt = vt + "->insert_id";
							o[ vtt ] = {
								"name": vtt+"",
								"type": "text",
							}
						}else if( dba == "FindMany" ){
							for(var i=0;i<staged__['db']['output_vars'].length;i++){
								var vtt = vt + "->[]->" + staged__['db']['output_vars'][i]['name'];
								o[ vtt ] = {
									"name": vtt+"",
									"type": staged__['db']['output_vars'][i]['type']+"",
								}
							}
						}else if( dba == "FindOne" ){
							for(var i=0;i<staged__['db']['output_vars'].length;i++){
								var vtt = vt + "->" + staged__['db']['output_vars'][i]['name'];
								o[ vtt ] = {
									"name": vtt+"",
									"type": staged__['db']['output_vars'][i]['type']+"",
								}
							}
						}
					}
					if( staged__['k'] == "Thing" ){
						var dba = staged__["db"]['action']+"";
						o[ "dbStatus" ] = {
							"name": "dbStatus",
							"type": "text"
						};
						var vt = staged__["db"]['output']+"";
						if( dba == "FindMany" ){
							o[ vt ] = {
								"name": vt,
								"type": "list"
							};
						}else{
							o[ vt ] = {
								"name": vt,
								"type": "dict"
							};
						}
						if( dba == "Insert" ){
							var vtt = vt + "->status";
							o[ vtt ] = {
								"name": vtt+"",
								"type": "text",
							}
							var vtt = vt + "->insert_id";
							o[ vtt ] = {
								"name": vtt+"",
								"type": "text",
							}
						}else if( dba == "FindMany" ){
							for(var i=0;i<staged__['db']['output_vars'].length;i++){
								var vtt = vt + "->[]->" + staged__['db']['output_vars'][i]['name'];
								o[ vtt ] = {
									"name": vtt+"",
									"type": staged__['db']['output_vars'][i]['type']+"",
								}
							}
						}else if( dba == "FindOne" ){
							for(var i=0;i<staged__['db']['output_vars'].length;i++){
								var vtt = vt + "->" + staged__['db']['output_vars'][i]['name'];
								o[ vtt ] = {
									"name": vtt+"",
									"type": staged__['db']['output_vars'][i]['type']+"",
								}
							}
						}
					}
					if( staged__['k'] == "DB" ){
						var dba = staged__["db"]['action']+"";
						o[ "dbStatus" ] = {
							"name": "dbStatus",
							"type": "text"
						};
						var vt = staged__["db"]['output']+"";
						//this.echo__( staged__["db"] );
						if( dba == "FindMany" ){
							o[ vt ] = {
								"name": vt,
								"type": "dict"
							};
							o[ vt + "->status"] = {
								"name": vt+'->status',
								"type": "text"
							};
							o[ vt + "->error"] = {
								"name": vt+'->error',
								"type": "text"
							};
							o[ vt + "->data"] = {
								"name": vt+'->data',
								"type": "list"
							};
							for(var di=0;di<staged__["db"]['output_vars'].length;di++ ){
								var dd = staged__["db"]['output_vars'][ di ];
								o[ vt + "->data->[]->" + dd['name']+'' ] = {
									"name": vt + "->data->[]->" + dd['name']+'',
									"type": dd['type']+''
								};
							}
						}else if( dba == "FindOne" ){
							o[ vt ] = {
								"name": vt+'',
								"type": "dict"
							};
							o[ vt + "->status"] = {
								"name": vt+'->status',
								"type": "text"
							};
							o[ vt + "->error"] = {
								"name": vt+'->error',
								"type": "text"
							};
							o[ vt + "->data"] = {
								"name": vt+'->data',
								"type": "dict"
							};
							for(var di=0;di<staged__["db"]['output_vars'].length;di++ ){
								var dd = staged__["db"]['output_vars'][ di ];
								o[ vt + "->data->" + dd['name']+'' ] = {
									"name": vt + "->data->" + dd['name']+'',
									"type": dd['type']+''
								};
							}
						}else{
							o[ vt ] = {
								"name": vt+'',
								"type": "dict"
							};
							o[ vt + "->status"] = {
								"name": vt+'->status',
								"type": "text"
							};
							o[ vt + "->error"] = {
								"name": vt+'->error',
								"type": "text"
							};
							if( dba == "Insert" ){
								if( staged__["db"]['engine'] == "dynamodb" ){
									o[ vt + "->consumedCapacity" ] = {
										"name": vt + "->consumedCapacity",
										"type": "number",
									}
								}else{//} if( staged__["db"]['engine'] == "dynamodb" ){
									o[ vt + "->insert_id" ] = {
										"name": vt + "->insert_id",
										"type": "text",
									}
								}
							}
							if( dba == "DeleteOne" || dba == "DeleteMany" ){
								if( staged__["db"]['engine'] == "dynamodb" ){
								o[ vt + "->consumedCapacity" ] = {
									"name": vt + "->consumedCapacity",
									"type": "number",
								}
								}else if( staged__["db"]['engine'] == "dynamodb" ){
								o[ vt + "->deleted_count" ] = {
									"name": vt + "->deleted_count",
									"type": "text",
								}
								}
							}
							if( dba == "UpdateOne" || dba == "UpdateMany" ){
								if( staged__["db"]['engine'] == "dynamodb" ){
								o[ vt + "->consumedCapacity" ] = {
									"name": vt + "->consumedCapacity",
									"type": "number",
								}
								}else if( staged__["db"]['engine'] == "mongodb" ){
								o[ vt + "->modified_count" ] = {
									"name": vt + "->modified_count",
									"type": "text",
								}
								o[ vt + "->matched_count" ] = {
									"name": vt + "->matched_count",
									"type": "text",
								}
								}
							}
						}
						//this.echo__( o );
					}
					if( staged__['k'] == "ElasticTable" ){
						var dba = staged__['elastic_table']['action']+"";
						o[ "dbStatus" ] = {
							"name": "dbStatus",
							"type": "text"
						};
						var vt = staged__['elastic_table']['output']+"";
						//this.echo__( staged__['elastic_table'] );
						if( dba == "FindMany" ){
							o[ vt ] = {
								"name": vt,
								"type": "dict"
							};
							o[ vt + "->status"] = {
								"name": vt+'->status',
								"type": "text"
							};
							o[ vt + "->error"] = {
								"name": vt+'->error',
								"type": "text"
							};
							o[ vt + "->LastEvaluatedKey"] = {
								"name": vt+'->LastEvaluatedKey',
								"type": "dict"
							};
							o[ vt + "->data"] = {
								"name": vt+'->data',
								"type": "list"
							};
							for(var di=0;di<staged__['elastic_table']['output_vars'].length;di++ ){
								var dd = staged__['elastic_table']['output_vars'][ di ];
								o[ vt + "->data->[]->" + dd['name']+'' ] = {
									"name": vt + "->data->[]->" + dd['name']+'',
									"type": dd['type']+''
								};
							}
						}else if( dba == "FindOne" ){
							o[ vt ] = {
								"name": vt+'',
								"type": "dict"
							};
							o[ vt + "->status"] = {
								"name": vt+'->status',
								"type": "text"
							};
							o[ vt + "->error"] = {
								"name": vt+'->error',
								"type": "text"
							};
							o[ vt + "->LastEvaluatedKey" ] = {
								"name": vt+'->LastEvaluatedKey',
								"type": "dict"
							};
							o[ vt + "->data"] = {
								"name": vt+'->data',
								"type": "dict"
							};
							for(var di=0;di<staged__['elastic_table']['output_vars'].length;di++ ){
								var dd = staged__['elastic_table']['output_vars'][ di ];
								o[ vt + "->data->" + dd['name']+'' ] = {
									"name": vt + "->data->" + dd['name']+'',
									"type": dd['type']+''
								};
							}
						}else{
							o[ vt ] = {
								"name": vt+'',
								"type": "dict"
							};
							o[ vt + "->status"] = {
								"name": vt+'->status',
								"type": "text"
							};
							o[ vt + "->error"] = {
								"name": vt+'->error',
								"type": "text"
							};
							if( dba == "Insert" ){
								o[ vt + "->consumedCapacity" ] = {
									"name": vt + "->consumedCapacity",
									"type": "number",
								}
							}
							if( dba == "DeleteOne" || dba == "DeleteMany" ){
								o[ vt + "->consumedCapacity" ] = {
									"name": vt + "->consumedCapacity",
									"type": "number",
								}
							}
							if( dba == "UpdateOne" || dba == "UpdateMany" ){
								o[ vt + "->consumedCapacity" ] = {
									"name": vt + "->consumedCapacity",
									"type": "number",
								}
							}
						}
						//this.echo__( o );
					}
					if( staged__['k'] == "DynamicTable" ){
						var dba = staged__["dynamic_table"]['action']+"";
						o[ "dbStatus" ] = {
							"name": "dbStatus",
							"type": "text"
						};
						var vt = staged__["dynamic_table"]['output']+"";
						o[ vt ] = {
							"name": vt,
							"type": "dict"
						};
						o[ vt + "->status" ] = {
							"name": vt + "->status",
							"type": "text"
						};
						o[ vt + "->error" ] = {
							"name": vt + "->error",
							"type": "text"
						};
						if( dba == "Insert" ){
							var vtt = vt + "->insert_id";
							o[ vtt ] = {
								"name": vtt+"",
								"type": "text",
							}
						}else if( dba == "FindMany" ){
							var vtt = vt + "->data";
							o[ vtt ] = {
								"name": vtt,
								"type": "list"
							};
							for(var i=0;i<staged__['dynamic_table']['output_vars'].length;i++){
								var vtt = vt + "->data->[]->" + staged__['dynamic_table']['output_vars'][i]['name'];
								o[ vtt ] = {
									"name": vtt+"",
									"type": staged__['dynamic_table']['output_vars'][i]['type']+"",
								}
							}
						}else if( dba == "FindOne" ){
							var vtt = vt + "->data";
							o[ vtt ] = {
								"name": vtt,
								"type": "list"
							};
							for(var i=0;i<staged__['dynamic_table']['output_vars'].length;i++){
								var vtt = vt + "->data->" + staged__['dynamic_table']['output_vars'][i]['name'];
								o[ vtt ] = {
									"name": vtt+"",
									"type": staged__['dynamic_table']['output_vars'][i]['type']+"",
								}
							}
						}
					}
					if( staged__['k'] == "QueuePush" ){
						var vt = staged__['queue']['output']+"";
						o[ vt ] = {
							"name": vt,
							"type": "dict"
						};
						o[ vt + "->status"] = {
							"name": vt+'->status',
							"type": "text"
						};
						o[ vt + "->error"] = {
							"name": vt+'->error',
							"type": "text"
						};
						o[ vt + "->queue_id"] = {
							"name": vt+'->queue_id',
							"type": "text"
						};
						//this.echo__( o );
					}
					if( staged__['k'] == "HTTPRequest" ){
						var vt = staged__["httprequest"]['output']+"";
						o[ vt ] = {
							"name": vt,
							"type": "dict"
						};
						o[ vt + "->statusCode" ] = {
							"name": vt + "->statusCode",
							"type": "number"
						};
						o[ vt + "->status" ] = {
							"name": vt + "->status",
							"type": "text"
						};
						o[ vt + "->headers" ] = {
							"name": vt + "->headers",
							"type": "dict"
						};
						o[ vt + "->headers->content-type" ] = {
							"name": vt + "->headers->content-type",
							"type": "text"
						};
						o[ vt + "->headers->location" ] = {
							"name": vt + "->headers->location",
							"type": "text"
						};
						o[ vt + "->headers->content-length" ] = {
							"name": vt + "->headers->content-length",
							"type": "text"
						};
						o[ vt + "->headers->content-encoding" ] = {
							"name": vt + "->headers->content-encoding",
							"type": "text"
						};
						o[ vt + "->headers->set-cookie" ] = {
							"name": vt + "->headers->set-cookie",
							"type": "list"
						};
						o[ vt + "->body" ] = {
							"name": vt + "->body",
							"type": "text"
						};
						o[ vt + "->cookies" ] = {
							"name": vt + "->cookies",
							"type": "dict"
						};
					}
					if( staged__['k'] in this.stage_params__ ){
						if( '_o_v' in staged__ ){
							for( var oi in staged__['_o_v'] ){
								o[ oi+'' ] = staged__['_o_v'][ oi ];
							}
						}
					}
				}
			}
			this.all_factors__ = this.ksort__(o);
			this.show_stages__ = true;

			for( var i in engine_output_vars ){
				if( i in o == false ){
					delete engine_output_vars[i] ;
				}
				if( i in used_outputs == false ){
					delete engine_output_vars[i] ;
				}
			}
			this.engine__[ 'output_vars' ] =  engine_output_vars ;

			var ol= [];
			for( var i=0; i<this.engine__['stages'].length; i++ ){
				if( this.engine__['stages'][i]['type'] == "SetLabel" ){
					ol.push( this.engine__['stages'][i]['label']+"" );
				}
			}
			this.label_names__ = ol;
			this.validate_things__();
		},
		validate_things__: function(){
			this.verror__ = "";
			var error_text = "";
			this.stage_wise_errors__ = {};
			var v_a_s = {};

			v_a_s[ "server_" ] = {"cnt":0,"ready":true, "stage": "Server"};
			v_a_s[ "server_->ip" ] = {"cnt":0,"ready":true, "stage": "Server"};
			v_a_s[ "server_->user-agent" ] = {"cnt":0,"ready":true, "stage": "Server"};
			//v_a_s[ "server_->" ] = {"cnt":0,"ready":true, "stage": "Server"};

			var v = this.get_object_to_list__( this.engine__['input_factors'] );
			for( var i=0;i<v.length;i++ ){
				v_a_s[ v[i]['key']+"" ] = {"cnt":0,"ready":true, "stage": "Input Factors"};
			}


			v_a_s[ "api_status" ] = {"cnt":0, "ready":true, "stage": "Initial"}
			v_a_s[ "api_error" ] = {"cnt":0, "ready":true, "stage": "Initial"}
			var l = {};
			for( var stagei__=0;stagei__<this.engine__['stages'].length;stagei__++ ){
				var staged__ = this.engine__['stages'][stagei__];
				var er = "";
				if( staged__['k'] == 'Let' ){
					var vt = this.engine__['stages'][stagei__]['d']['name']+"";
					vt = vt.replace( /[\W]+/g, "" ).toLowerCase();
					v_a_s[ vt ] = {"cnt":0, "ready":false, "stage": stagei__ };
					if( this.engine__['stages'][stagei__]['d']['type']=="dict" || this.engine__['stages'][stagei__]['d']['type']=="list" ){
						v_a_s[ vt ]['ready'] = true;
					}else if( this.engine__['stages'][stagei__]['d']['value'] ){
						v_a_s[ vt ]['ready'] = true;
					}
				}
				if( staged__['k'] == 'SMS' ){
					v_a_s[ "sms_result" ] = {"cnt":0,"ready":true, "stage": "SMS"}
					v_a_s[ "sms_result->status" ] = {"cnt":0,"ready":true, "stage": "SMS"}
					v_a_s[ "sms_result->error" ] = {"cnt":0,"ready":true, "stage": "SMS"}
				}
				if( staged__['k'] == 'EMail' ){
					v_a_s[ "email_result" ] = {"cnt":0,"ready":true, "stage": "EMail"}
					v_a_s[ "email_result->status" ] = {"cnt":0,"ready":true, "stage": "EMail"}
					v_a_s[ "email_result->error" ] = {"cnt":0,"ready":true, "stage": "EMail"}
				}
				if( staged__['k'] == 'Output' ){
					if( staged__['output']['type'] == "variable" ){
					var __a = staged__['output']['value'];
					if( __a ){
						if( v_a_s.hasOwnProperty( __a ) == false ){
							er = "Variable: [" + this.get_v_name__(__a) + "] is not available";
						}else if( v_a_s[ __a ]['ready'] == false ){
							er = "Variable: [" + this.get_v_name__(__a) + "] is not ready";
							v_a_s[ __a ]['cnt'] += 1;
						}else{
							v_a_s[ __a ]['cnt'] += 1;
						}
					}
					}
					v_a_s[ staged__['output']['as']+'' ] = {"cnt":0,"ready":true, "stage": "Output"}
				}
				if( staged__['k'] == 'OutputValue' ){

				}
				if( staged__['k'] == "ForEach" ){
					if( staged__.hasOwnProperty("foreach") ){
						v_a_s[ staged__['foreach']['key']+"" ] = {"cnt":0,"ready":true, "stage": "Foreach value"};
						v_a_s[ staged__['foreach']['value']+"" ] = {"cnt":0,"ready":true, "stage": "Foreach value"};
						var k = this.find_sub_variables__( staged__['foreach']['var'], stagei__ );
						for(var i=0;i<k.length;i++){
							var vtt = staged__['foreach']['value']+"->"+k[i]['key'];
							v_a_s[ vtt ]={"cnt":0,"ready":true, "stage": "Foreach value"};
						}
					}
				}
				if( staged__['k'] == "EndForEach" ){
					var ki = this.find_prev_rand__( stagei__ );
					if( ki != -1 ){
						delete v_a_s[ this.engine__['stages'][ki]['foreach']['key']+'' ];
						delete v_a_s[ this.engine__['stages'][ki]['foreach']['value']+'' ];
						var k = this.find_sub_variables__( staged__['foreach']['var'], stagei__ );
						for(var i=0;i<k.length;i++){
							var vtt = staged__['foreach']['value']+"->"+k[i]['key'];
							delete v_a_s[ vtt ];
						}
					}
				}
				if( staged__['k'] == "For" ){
					if( staged__.hasOwnProperty("for") ){
						var vt = staged__['for']['as']+"";
						v_a_s[ vt ] = {"cnt":0,"ready":true, "stage": "For value"}
						v_a_s[ vt ] = {"cnt":0,"ready":true, "stage": "For value"}
					}
				}
				if( staged__['k'] == "EndFor" ){
					var ki = this.find_prev_rand__( stagei__ );
					if( ki != -1 ){
						var vt = this.engine__['stages'][ki]['for']['as']+"";
						delete v_a_s[ vt ];
					}
				}
				if( staged__['k'] == 'SetLabel' ){
					if( l.hasOwnProperty( staged__['label'] ) ){
						er = "Repeated";
					}else{
						l[ staged__['label'] ] = 1;
					}
				}
				if( staged__['k'] == 'JumpToLabel' ){
					if( l.hasOwnProperty( staged__['jump_to_label'] ) == false ){
						er = "Label not found!";
					}
				}
				if( staged__['k'] == 'If' || staged__['k'] == 'While' ){
					for(var z=0;z<staged__['cond'].length;z++){
						var __a = staged__['cond'][z]['lhs'];
						var __b = staged__['cond'][z]['rhs']['value'];
						if( __a ){
							if( v_a_s.hasOwnProperty( __a ) == false ){
								er = "Variable: [" + this.get_v_name__(__a) + "] is not available";
							}else if( v_a_s[ __a ]['ready'] == false ){
								er = "Variable: [" + this.get_v_name__(__a) + "] is not ready";
								v_a_s[ __a ]['cnt'] += 1;
							}else{
								v_a_s[ __a ]['cnt'] += 1;
							}
						}
						if( __b ){
							if( staged__['cond'][z]['rhs']['type'] == "variable" ){
								if( v_a_s.hasOwnProperty( __b ) == false ){
									er = "Variable: [" + this.get_v_name__(__b) + "] is not available";
								}else if( v_a_s[ __b ]['ready'] == false ){
									er = "Variable: [" + this.get_v_name__(__b) + "] is not ready";
									v_a_s[ __b ]['cnt'] += 1;
								}else{
									v_a_s[ __b ]['cnt'] += 1;
								}
							}
						}
					}
				}
				if( staged__['k'] == 'ForEach' ){
					var __a = staged__['foreach']['var'];
					if( __a ){
						if( v_a_s.hasOwnProperty( __a ) == false ){
							er = "Variable: [" + this.get_v_name__(__a) + "] is not available";
						}else if( v_a_s[ __a ]['ready'] == false ){
							er = "Variable: [" + this.get_v_name__(__a) + "] is not ready";
							v_a_s[ __a ]['cnt'] += 1;
						}else{
							v_a_s[ __a ]['cnt'] += 1;
						}
					}
				}
				if( staged__['k'] == 'For' ){
					if( staged__['for']['start']['type']=='variable' ){
						var __a = staged__['for']['start']['value'];
						if( __a ){
							if( v_a_s.hasOwnProperty( __a ) == false ){
								er = "Variable: [" + this.get_v_name__(__a) + "] is not available";
							}else if( v_a_s[ __a ]['ready'] == false ){
								er = "Variable: [" + this.get_v_name__(__a) + "] is not ready";
								v_a_s[ __a ]['cnt'] += 1;
							}else{
								v_a_s[ __a ]['cnt'] += 1;
							}
						}
					}
					if( er == "" && staged__['for']['end']['type']=='variable' ){
						var __a = staged__['for']['end']['value'];
						if( __a ){
							if( v_a_s.hasOwnProperty( __a ) == false ){
								er = "Variable: [" + this.get_v_name__(__a) + "] is not available";
							}else if( v_a_s[ __a ]['ready'] == false ){
								er = "Variable: [" + this.get_v_name__(__a) + "] is not ready";
								v_a_s[ __a ]['cnt'] += 1;
							}else{
								v_a_s[ __a ]['cnt'] += 1;
							}
						}
					}
					if( er == "" && staged__['for']['modifier']['type']=='variable' ){
						var __a = staged__['for']['modifier']['value'];
						if( __a ){
							if( v_a_s.hasOwnProperty( __a ) == false ){
								er = "Variable: [" + this.get_v_name__(__a) + "] is not available";
							}else if( v_a_s[ __a ]['ready'] == false ){
								er = "Variable: [" + this.get_v_name__(__a) + "] is not ready";
								v_a_s[ __a ]['cnt'] += 1;
							}else{
								v_a_s[ __a ]['cnt'] += 1;
							}
						}
					}
					if( er == "" && staged__['for']['order']['type']=='variable' ){
						var __a = staged__['for']['order']['value'];
						if( __a ){
							if( v_a_s.hasOwnProperty( __a ) == false ){
								er = "Variable: [" + this.get_v_name__(__a) + "] is not available";
							}else if( v_a_s[ __a ]['ready'] == false ){
								er = "Variable: [" + this.get_v_name__(__a) + "] is not ready";
								v_a_s[ __a ]['cnt'] += 1;
							}else{
								v_a_s[ __a ]['cnt'] += 1;
							}
						}
					}
				}
				if( staged__['k'] == 'Assign' ){
					var __a = staged__['assign']['lhs'];
					var __b = staged__['assign']['rhs']['value'];
					if( v_a_s.hasOwnProperty( __a ) == false ){
						er = "Variable: [" + this.get_v_name__(__a) + "] is not available" ;
					}else{
						v_a_s[ __a ]['ready'] = true;
					}
					if( staged__['assign']['rhs']['type'] == "variable" ){
						if( v_a_s.hasOwnProperty( __b ) == false ){
							er = "Variable: [" + this.get_v_name__(__b) + "] is not available";
						}else if( v_a_s[ __b ]['ready'] == false ){
							er = "Variable: [" + this.get_v_name__(__b) + "] is not ready";
							v_a_s[ __b ]['cnt'] += 1;
						}else{
							v_a_s[ __b ]['cnt'] += 1;
						}
					}
					if( staged__['assign']['rhs']['type']=="json" ){
						var v = this.get_object_to_list__( staged__['assign']['rhs']['value'] );
						for( var i=0;i<v.length;i++ ){
							v_a_s[ staged__['assign']['lhs']+"->"+ v[i]['key'] ] = {"cnt":0, "ready":true, "stage": "Stage: " + stagei__};
						}
					}
				}
				if( staged__['k'] == 'Math' ){
					var __a = staged__['math']['lhs'];
					var __b = staged__['math']['rhs']['a'];
					var __c = staged__['math']['rhs']['b']['value'];
					if( v_a_s.hasOwnProperty( __a ) == false ){
						er = "Variable: [" + this.get_v_name__(__a) + "] is not available";
					}else{
						v_a_s[ __a ]['ready'] = true;
					}
					if( v_a_s.hasOwnProperty( __b ) == false ){
						er = "Variable: [" + this.get_v_name__(__b) + "] is not available";
					}else if( v_a_s[ __b ]['ready'] == false ){
						er = "Variable: [" + this.get_v_name__(__b) + "] is not ready";
						v_a_s[ __b ]['cnt'] += 1;
					}else{
						v_a_s[ __b ]['cnt'] += 1;
					}
					if( staged__['math']['rhs']['b']['type'] == "variable" ){
						if( v_a_s.hasOwnProperty( __c ) == false ){
							er = "Variable: [" + this.get_v_name__(__c) + "] is not available";
						}else if( v_a_s[ __c ]['ready'] == false ){
							er = "Variable: [" + this.get_v_name__(__c) + "] is not ready";
							v_a_s[ __c ]['cnt'] += 1;
						}else{
							v_a_s[ __c ]['cnt'] += 1;
						}
					}
				}
				if( staged__['k'] == 'Function' ){
					if( staged__['function']['return'] ){
						var __a = staged__['function']['lhs'];
						if( v_a_s.hasOwnProperty( __a ) == false ){
							er = "Variable: [" + this.get_v_name__(__a) + "] is not available";
						}else{
							v_a_s[ __a ]['ready'] = true;
						}
					}
					for( var i in staged__['function']['inputs'] ){if( i != "type" ){if( staged__['function']['inputs'][i]['type'] == "variable" ){if( staged__['function']['inputs'][i]['value'] ){
						var __a = staged__['function']['inputs'][i]["value"];
						if( __a == "" ){
							er = "Input Pending for param ["+staged__['function']['inputs'][i]['name']+"] ";
						}else if( v_a_s.hasOwnProperty( __a ) == false ){
							er = "Variable: [" + this.get_v_name__(__a) + "] is not available";
						}else if( v_a_s[ __a ]['ready'] == false ){
							er = "Variable: [" + this.get_v_name__(__a) + "] is not ready";
							v_a_s[ __a ]['cnt'] += 1;
						}else{
							v_a_s[ __a ]['cnt'] += 1;
						}
					}}}}
					if( staged__['function']['function'] == "Get List Item" ){
						var vt = staged__['function']['lhs'];
						var k = this.find_sub_variables__( staged__['function']['inputs']['p1']['value'], stagei__ );
						for(var i=0;i<k.length;i++){
							var vtt = vt+"->"+k[i]['key'];
							v_a_s[ vtt ] = {"cnt":0, "ready":true, "stage": "Stage: " + stagei__};
						}
					}
					if( staged__['function']['function'] == "Set Value" ){
						var p1 = staged__['function']['inputs']['p1']['value'];
						var p2 = staged__['function']['inputs']['p2']['value'];
						var p3 = staged__['function']['inputs']['p3']['value'];
						if( staged__['function']['inputs']['p2']['type'] == "variable" ){
							if( p2.indexOf("->EachKey") > 0 ){
								var newkeyslist = this.get_keys_list__( v_a_s, p2 );
								for(var newkeyslisti=0;newkeyslisti<newkeyslist.length;newkeyslisti++){
									var newkey = newkeyslist[newkeyslisti];
									if( staged__['function']['inputs']['p3']['type'] == "variable" ){
										var newlist = this.get_vars_list__( v_a_s, p3 );
										if( Object.keys(newlist).length > 0 ){
											for( var newlistk in newlist ){
												v_a_s[ p1 +"->" + newkey + "->" + newlistk ] = {"cnt":0, "ready":true, "stage": "Stage: " + stagei__};
											}
										}else{
											v_a_s[ p1 +"->" + newkey ] = {"cnt":0, "ready":true, "stage": "Stage: " + stagei__};
										}
									}else{
										v_a_s[ p1 +"->" + newkey ] = {"cnt":0, "ready":true, "stage": "Stage: " + stagei__};
									}
								}
							}
						}else{
							v_a_s[ p1 + "->" + p2 ] = {"cnt":0, "ready":true, "stage": "Stage: " + stagei__};
						}
					}
				}
				if( staged__['k'] == 'Redis' ){
					v_a_s[ staged__['db']['output']+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ "dbStatus" ] = {"cnt":0,"ready":true, "stage": "DB"};
					var vt = staged__['db']['output']+"";
				}
				if( staged__['k'] == 'DynamoDB' ){
					v_a_s[ staged__['db']['output']+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ "dbStatus" ] = {"cnt":0,"ready":true, "stage": "DB"};
					var vt = staged__['db']['output']+"";
					if( staged__['db']['action'] == "FindMany" ){
						for(i=0;i<staged__['db']['output_vars'].length;i++){
							var vtt = vt + "->[]->" + staged__['db']['output_vars'][i]['name'];
							v_a_s[ vtt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}else{
						for(i=0;i<staged__['db']['output_vars'].length;i++){
							var vtt = vt + "->" + staged__['db']['output_vars'][i]['name'];
							v_a_s[ vtt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}
				}
				if( staged__['k'] == 'Thing' ){
					v_a_s[ staged__['db']['output']+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ "dbStatus" ] = {"cnt":0,"ready":true, "stage": "DB"};
					var vt = staged__['db']['output']+"";
					if( staged__['db']['action'] == "FindMany" ){
						for(i=0;i<staged__['db']['output_vars'].length;i++){
							var vtt = vt + "->[]->" + staged__['db']['output_vars'][i]['name'];
							v_a_s[ vtt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}else{
						for(i=0;i<staged__['db']['output_vars'].length;i++){
							var vtt = vt + "->" + staged__['db']['output_vars'][i]['name'];
							v_a_s[ vtt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}
				}
				if( staged__['k'] == 'QueuePush' ){
					var vt = staged__['queue']['output']+"";
					v_a_s[ vt+"" ] = {"cnt":0,"ready":true, "stage": "QueuePush"};
					v_a_s[ vt+"->status" ] = {"cnt":0,"ready":true, "stage": "QueuePush"};
					v_a_s[ vt+"->error" ] = {"cnt":0,"ready":true, "stage": "QueuePush"};
					v_a_s[ vt+"->queue_id" ] = {"cnt":0,"ready":true, "stage": "QueuePush"};
				}
				if( staged__['k'] == 'ElasticTable' ){
					var vt = staged__['elastic_table']['output']+"";
					v_a_s[ vt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ vt+"->status" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ vt+"->error" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ vt+"->data" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ "dbStatus" ] = {"cnt":0,"ready":true, "stage": "DB"};
					if( staged__['elastic_table']['action'] == "FindMany" ){
						v_a_s[ vt+"->LastEvaluatedKey" ] = {"cnt":0,"ready":true, "stage": "DB"};
						for(i=0;i<staged__['elastic_table']['output_vars'].length;i++){
							var vtt = vt + "->data->[]->" + staged__['elastic_table']['output_vars'][i]['name'];
							v_a_s[ vtt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}else if( staged__['elastic_table']['action'] == "FindOne" ){
						v_a_s[ vt+"->LastEvaluatedKey" ] = {"cnt":0,"ready":true, "stage": "DB"};
						for(i=0;i<staged__['elastic_table']['output_vars'].length;i++){
							var vtt = vt + "->data->" + staged__['elastic_table']['output_vars'][i]['name'];
							v_a_s[ vtt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}else if( staged__['elastic_table']['action'] == "Insert" ){
						if( staged__['elastic_table']['engine'] == "mongodb" ){
							v_a_s[ vt+"->insert_id" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}else if( staged__['elastic_table']['engine'] == "dynamodb" ){
							v_a_s[ vt+"->consumedCapacity" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}else if( staged__['elastic_table']['action'] == "DeleteOne" ||  staged__['elastic_table']['action'] == "DeleteMany" ){
						if( staged__['elastic_table']['engine'] == "mongodb" ){
							v_a_s[ vt+"->deleted_count" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}else if( staged__['elastic_table']['engine'] == "dynamodb" ){
							v_a_s[ vt+"->consumedCapacity" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}else if( staged__['elastic_table']['action'] == "UpdateOne" || staged__['elastic_table']['action'] == "UpdateMany" ){
						if( staged__['elastic_table']['engine'] == "mongodb" ){
							v_a_s[ vt+"->modified_count" ] = {"cnt":0,"ready":true, "stage": "DB"};
							v_a_s[ vt+"->matched_count" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}else if( staged__['elastic_table']['engine'] == "dynamodb" ){
							v_a_s[ vt+"->consumedCapacity" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}
				}
				if( staged__['k'] == 'DynamicTable' ){
					v_a_s[ staged__['dynamic_table']['output']+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ staged__['dynamic_table']['output']+"->status" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ staged__['dynamic_table']['output']+"->error" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ staged__['dynamic_table']['output']+"->data" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ "dbStatus" ] = {"cnt":0,"ready":true, "stage": "DB"};
					var vt = staged__['dynamic_table']['output']+"";
					if( staged__['dynamic_table']['action'] == "FindMany" ){
						for(i=0;i<staged__['dynamic_table']['output_vars'].length;i++){
							var vtt = vt + "->data->[]->" + staged__['dynamic_table']['output_vars'][i]['name'];
							v_a_s[ vtt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}else{
						for(i=0;i<staged__['dynamic_table']['output_vars'].length;i++){
							var vtt = vt + "->data->" + staged__['dynamic_table']['output_vars'][i]['name'];
							v_a_s[ vtt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}
				}

				if( staged__['k'] == 'DB' ){
					var vt = staged__['db']['output']+"";
					v_a_s[ vt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ vt+"->status" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ vt+"->error" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ vt+"->data" ] = {"cnt":0,"ready":true, "stage": "DB"};
					v_a_s[ "dbStatus" ] = {"cnt":0,"ready":true, "stage": "DB"};
					if( staged__['db']['action'] == "FindMany" ){
						for(i=0;i<staged__['db']['output_vars'].length;i++){
							var vtt = vt + "->data->[]->" + staged__['db']['output_vars'][i]['name'];
							v_a_s[ vtt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}else if( staged__['db']['action'] == "FindOne" ){
						for(i=0;i<staged__['db']['output_vars'].length;i++){
							var vtt = vt + "->data->" + staged__['db']['output_vars'][i]['name'];
							v_a_s[ vtt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}else if( staged__['db']['action'] == "Insert" ){
						if( staged__['db']['engine'] == "mongodb" ){
							v_a_s[ vt+"->insert_id" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}else if( staged__['db']['engine'] == "dynamodb" ){
							v_a_s[ vt+"->consumedCapacity" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}else if( staged__['db']['action'] == "DeleteOne" ||  staged__['db']['action'] == "DeleteMany" ){
						if( staged__['db']['engine'] == "mongodb" ){
							v_a_s[ vt+"->deleted_count" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}else if( staged__['db']['engine'] == "dynamodb" ){
							v_a_s[ vt+"->consumedCapacity" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}else if( staged__['db']['action'] == "UpdateOne" || staged__['db']['action'] == "UpdateMany" ){
						if( staged__['db']['engine'] == "mongodb" ){
							v_a_s[ vt+"->modified_count" ] = {"cnt":0,"ready":true, "stage": "DB"};
							v_a_s[ vt+"->matched_count" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}else if( staged__['db']['engine'] == "dynamodb" ){
							v_a_s[ vt+"->consumedCapacity" ] = {"cnt":0,"ready":true, "stage": "DB"};
						}
					}
				}
				if( staged__['k'] == 'GlobalProcedure' ){
					v_a_s[ "procedureStatus" ] = {"cnt":0,"ready":true, "stage": "DB"};
					var vt = staged__['procedure']['output']+"";
					v_a_s[ vt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
					for(i=0;i<staged__['procedure']['output_vars'].length;i++){
						var vtt = vt + "->" + staged__['procedure']['output_vars'][i]['name'];
						v_a_s[ vtt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
					}
				}
				if( staged__['k'] == 'Procedure' ){
					v_a_s[ "procedureStatus" ] = {"cnt":0,"ready":true, "stage": "DB"};
					var vt = staged__['procedure']['output']+"";
					v_a_s[ vt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
					for(i=0;i<staged__['procedure']['output_vars'].length;i++){
						var vtt = vt + "->" + staged__['procedure']['output_vars'][i]['name'];
						v_a_s[ vtt+"" ] = {"cnt":0,"ready":true, "stage": "DB"};
					}
				}
				if( staged__['k'] == 'HTMLElement' ){
					if( stagei__ > 0 ){
						var vprev_tag = "";
						var vprev_type = "";
						for(var j=stagei__-1;j>=0;j--){
							if( this.engine__['stages'][ j ]['type'] == "HTMLElement" ){
								vprev_tag = this.engine__['stages'][ j ]['htmlelement']['tag']+'';
								vprev_type = "open";
								break;
							}
							if( this.engine__['stages'][ j ]['type'] == "HTMLElementEnd" ){
								vprev_tag = this.engine__['stages'][ j ]['htmlelement']['tag']+'';
								vprev_type = "close";
								break;
							}
						}
						var vnext_tag = "";
						var vnext_type = "";
						for(var j=stagei__+1;j<this.engine__['stages'].length;j++){
							if( this.engine__['stages'][ j ]['type'] == "HTMLElement" ){
								vnext_tag = this.engine__['stages'][ j ]['htmlelement']['tag']+'';
								vnext_type = "open";
								break;
							}
							if( this.engine__['stages'][ j ]['type'] == "HTMLElementEnd" ){
								vnext_tag = this.engine__['stages'][ j ]['htmlelement']['tag']+'';
								vnext_type = "close";
								break;
							}
						}
						var vtag = this.engine__['stages'][ stagei__ ]['htmlelement']['tag'];
						if( vtag in this.html_elements__ ){
							if( this.html_elements__[ vtag ]['next'] ){
								var f = false;
								for(var hi in this.html_elements__[ vtag ]['next'] ){
									if( hi == vnext_tag ){
										f = true;
									}
								}
								if( f == false ){
									er = er + "\nHTMLElement `" + vtag + "` should be used before `" + Object.keys(this.html_elements__[ vtag ]['next']).join(",") + "`";
								}
							}
							if( this.html_elements__[ vtag ]['prev'] ){
								var f = false;
								for( var hi in this.html_elements__[ vtag ]['prev'] ){
									if( hi == vprev_tag ){
										f = true;
									}
								}
								if( f == false ){
									er = er + "\nHTMLElement `" + vtag + "` should be used after `" + Object.keys(this.html_elements__[ vtag ]['prev']).join(",") + "`";
								}
							}
						}
					}
				}
				if( staged__['k'] == 'HTMLElementEnd' ){
					if( stagei__ > 0 ){
						var vprev_tag = "";
						var vprev_type = "";
						for(var j=stagei__-1;j>=0;j--){
							if( this.engine__['stages'][ j ]['type'] == "HTMLElement" ){
								vprev_tag = this.engine__['stages'][ j ]['htmlelement']['tag']+'';
								vprev_type = "open";
								break;
							}
							if( this.engine__['stages'][ j ]['type'] == "HTMLElementEnd" ){
								vprev_tag = this.engine__['stages'][ j ]['htmlelement']['tag']+'';
								vprev_type = "close";
								break;
							}
						}
						var vnext_tag = "";
						var vnext_type = "";
						for(var j=stagei__+1;j<this.engine__['stages'].length;j++){
							if( this.engine__['stages'][ j ]['type'] == "HTMLElement" ){
								vnext_tag = this.engine__['stages'][ j ]['htmlelement']['tag']+'';
								vnext_type = "open";
								break;
							}
							if( this.engine__['stages'][ j ]['type'] == "HTMLElementEnd" ){
								vnext_tag = this.engine__['stages'][ j ]['htmlelement']['tag']+'';
								vnext_type = "close";
								break;
							}
						}
						var vtag = this.engine__['stages'][ stagei__ ]['htmlelement']['tag'];
						if( vtag in this.html_elements__ ){
							if( this.html_elements__[ vtag ]['prev'] ){
								var f = false;
								for(var hi in this.html_elements__[ vtag ]['prev'] ){
									if( hi == vnext_tag ){
										f = true;
									}
								}
								if( f == false ){
									er = er + "\nHTMLElement `" + vtag + "` should be used with `" + Object.keys(this.html_elements__[ vtag ]['next']).join(",") + "`";
								}
							}
							if( this.html_elements__[ vtag ]['next'] ){
								var f = false;
								for( var hi in this.html_elements__[ vtag ]['next'] ){
									if( hi == vprev_tag ){
										f = true;
									}
								}
								if( f == false ){
									er = er + "\nHTMLElement `" + vtag + "` should be used with `" + Object.keys(this.html_elements__[ vtag ]['prev']).join(",") + "`";
								}
							}
						}
					}
				}
				if( staged__['k'] == "HTTPRequest" ){
					var vt = staged__["httprequest"]['output']+"";
					v_a_s[ vt ] = {"cnt":0,"ready":true, "stage": "httprequest"};
					v_a_s[ vt+ "->statusCode" ] = {"cnt":0,"ready":true, "stage": "httprequest"};
					v_a_s[ vt+ "->status" ] = {"cnt":0,"ready":true, "stage": "httprequest"};
					v_a_s[ vt+ "->headers" ] = {"cnt":0,"ready":true, "stage": "httprequest"};
					v_a_s[ vt+ "->headers->content-type" ] = {"cnt":0,"ready":true, "stage": "httprequest"};
					v_a_s[ vt+ "->headers->location" ] = {"cnt":0,"ready":true, "stage": "httprequest"};
					v_a_s[ vt+ "->headers->content-length" ] = {"cnt":0,"ready":true, "stage": "httprequest"};
					v_a_s[ vt+ "->headers->content-encoding" ] = {"cnt":0,"ready":true, "stage": "httprequest"};
					v_a_s[ vt+ "->headers->set-cookie" ] = {"cnt":0,"ready":true, "stage": "httprequest"};
					v_a_s[ vt+ "->body" ] = {"cnt":0,"ready":true, "stage": "httprequest"};
					v_a_s[ vt+ "->cookies" ] = {"cnt":0,"ready":true, "stage": "httprequest"};
				}
				if( staged__['k'] in this.stage_params__ ){
					if( '_o_v' in staged__ ){
						for( var oi in staged__['_o_v'] ){
							v_a_s[ oi+'' ] = {"cnt":0, "ready":true, "stage": staged__['k']};
						}
					}
				}
				this.engine__['stages'][ stagei__ ][  'er' ] =  er ;
			}
		},
		find_sub_variables__: function( v, vstagei__ ){
			var k = [];
			if( this.all_factors_stage_wise__.hasOwnProperty( vstagei__ ) ){
				for(var vkey in this.all_factors_stage_wise__[ vstagei__ ] ){
					if( vkey.indexOf( v + "->[]->") == 0 ){
						var vt = vkey.replace( v + "->[]->", "" );
						k.push({
							"key": vt,
							"name": this.all_factors_stage_wise__[ vstagei__ ][ vkey ]['name']+"",
							"type": this.all_factors_stage_wise__[ vstagei__ ][ vkey ]['type']+"",
						});
					}
				}
			}
			return k;
		},
		handlescroll__: function( e ){
			var scrolltop = e.target.scrollTop;
			var scrollheight = e.target.scrollHeight;
			var offsettop = e.target.offsetTop;
			var v = document.getElementById("div_input_factors");
			var inputheight = v.scrollHeight;
			var v = document.getElementById("div_stages");
			if( scrolltop >  Number(inputheight+50)  ){
				v.style.position = 'fixed';
				v.style.top = '91px';
				v.style.left = '1px';
				v.style.boxShadow = "2px 2px 2px #cdcdcd";
			}else{
				v.style.position = 'static';
				v.style.boxShadow = "initial";
			}

		},
		get_v_name__: function( vn ){
			return vn+"";
		},
		sessexpired__: function(v){
			$('#ses_expired').modal('show');
			setTimeout(function() {
			$('#ses_expired').modal('hide');
				document.location.reload();
			}, 3000);
		},
		echo__: function(v){
			if( typeof(v) == "object" ){
				console.log( JSON.stringify(v,null,4) );
			}else{
				console.log( v );
			}
		},
		ucwords: function(v){
			var str = v+"";
			var v = str.split(/[\ ]+/g);
			var v2 = [];
			for(var i=0;i<v.length;i++){
				if( v[i] != "" ){
					v2.push( v[i][0].toUpperCase() + v[i].substr(1,100) );
				}
			}
			return v2.join(" ");
		},
		create_test_variables_fill_value_object__: function( vd ){
			if( this.api__['input-type'] == "application/json" ){
				for(var i in vd){
					if( vd[i].hasOwnProperty("value") ==false ){
						vd[i]['value'] = this.derive_value__( vd[i]['type'] );
					}
					if( vd[i]['type'] == "dict" ){
						vd[i]['sub'] = this.create_test_variables_fill_value_object__( vd[i]['sub'] );
					}
					if( vd[i]['type'] == "list" ){
						vd[i]['sub'] = [this.create_test_variables_fill_value_object__( vd[i]['sub'] )];
					}
				}
			}else{
				for(var i in vd){
					if( vd[i].hasOwnProperty("value") ==false ){
						vd[i]['value'] = "";
						vd[i]['type'] = "text";
						vd[i]['sub'] = {};
					}
				}
			}
			return vd;
		},
		create_test_variables__: function(){
			var vtest = JSON.parse( JSON.stringify( this.engine__['input_factors'] ));
			vtest = this.create_test_variables_fill_value_object__( vtest );
			this.test__ = vtest;
		},
		derive_value__: function( v ){
			if( v == "text" ||  v== "date" ){
				return "";
			}else if( v== "number" ){
				return 0;
			}else if( v == 'dict' ){
				return {};
			}else if( v == 'list' ){
				return [];
			}else if( v == 'boolean' ){
				return true;
			}else{
				return "";
			}
		},
		save_sms_data__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'sms' ] =  vdata ;
			this.updated_option__( stagei__ );
		},
		save_email_data__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'email' ] =  vdata ;
			this.updated_option__( stagei__ );
		},
		save_common__: function( stagei__, vdata ){
			//console.log( stagei__);
			//console.log( vdata);
			for( var vdi in vdata ){
				this.engine__['stages'][ stagei__ ][  vdi+'' ] =  this.json__(vdata[ vdi ]) ;
			}
			this.updated_option__( stagei__ );
		},
		save_httprequest__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'httprequest' ] =  vdata ;
			this.updated_option__( stagei__ );
		},
		save_queuepush__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'queue' ] =  vdata ;
			this.updated_option__( stagei__ );
		},
		save_thing_data__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'db' ] =  vdata ;
			this.updated_option__( stagei__ );
			this.hide_edit_stage__( stagei__, 'all');
		},
		save_dynamodb_data__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'db' ] =  vdata ;
			this.updated_option__( stagei__ );
			this.hide_edit_stage__( stagei__, 'all');
		},
		save_elasticdb_data__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'db' ] =  vdata ;
			this.updated_option__( stagei__ );
			this.hide_edit_stage__( stagei__, 'all');
		},
		save_dynamicdb_data__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'db' ] =  vdata ;
			this.updated_option__( stagei__ );
			this.hide_edit_stage__( stagei__, 'all');
		},
		save_db_data__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'db' ] =  vdata ;
			this.updated_option__( stagei__ );
			this.hide_edit_stage__( stagei__, 'all');
		},
		save_redis_data__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'db' ] =  vdata ;
			this.updated_option__( stagei__ );
			this.hide_edit_stage__( stagei__, 'all');
		},
		save_global_procedure_data__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'procedure' ] =  vdata ;
			this.updated_option__( stagei__ );
			this.hide_edit_stage__( stagei__, 'all');
		},
		save_procedure_data__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'procedure' ] =  vdata ;
			this.updated_option__( stagei__ );
			this.hide_edit_stage__( stagei__, 'all');
		},
		save_renderblock__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'renderblock' ] =  vdata ;
			this.updated_option__( stagei__ );

		},
		save_renderarticle__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'renderarticle' ] =  vdata ;
			this.updated_option__( stagei__ );

		},
		save_renderhtml__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ]['renderhtml'][  'html_body' ] =  vdata['html'] ;
			this.engine__['stages'][ stagei__ ]['renderhtml'][  'style_body' ] =  vdata['style'] ;
			this.engine__['stages'][ stagei__ ]['renderhtml'][  'd' ] =  false ;
			this.updated_option__( stagei__ );
		},
		save_pagesettings__: function( stagei__, vdata ){
			this.engine__['stages'][ stagei__ ][  'pagesettings' ] =  vdata ;
			this.updated_option__( stagei__ );
			this.hide_edit_stage__(stagei__, 'all');
		},
		save_test__: function(){
			this.hide_edit_stage__(-1, 'all');
			this.show_saving__ = true;
			var vd__ =  {
				"action"		: "save_engine_test",
				"test"			: this.test__,
			};
			axios.post("?", vd__).then(response=>{
				if( response.data["status"] == "success" ){
					this.show_saving__ = false;
				}else if( response.data["details"] == "SessionExpired" ){
					this.save_message__ = "Session Expired.. Redirecting to Home page";
					this.sessexpired__();
				}else{
					alert( "Error in response:\n" + response.data['status'] );
				}
			});
		},
		save_data__: function(){
			this.hide_edit_stage__(-1, 'all');
			this.save_need__ = false;
			this.show_saving__ = true;
			var vd__ = {
					"action"		: "save_engine_data",
					"data"			: this.engine__,
					"type"			: this.api__['type'],
					"input-method"		: this.api__['input-method'],
					"input-type"		: this.api__['input-type'],
					"output-type"		: this.api__['output-type'],
					"version_id"		: "<?=$config_param2 ?>",
					"api_id"		: "<?=$config_param1 ?>",
				};
			axios.post( "?", vd__).then(response=>{
				this.save_need__ = false;
				if( response.data["status"] == "success" ){
					this.show_saving__ = false;
					this.save_need__ = false;
				}else if( response.data["error"] == "Token Expired" ){
					this.save_message__ = "Token expired!. please reload page and try again!";
				}else if( response.data["error"] == "Incorrect Token" ){
					this.save_message__ = "Token expired/Incorrect!. please reload page and try again!";
				}else if( response.data["error"] == "SessionExpired" ){
					this.save_message__ = "Session Expired.. Redirecting to Home page";
					this.sessexpired__();
				}else{
					alert( "Error in response:\n" + response.data['status'] );
				}
			});
		},
		get_object_array__: function( v ){
			var val = {};
			for( var i in v ){
				if( v[i]['type'] == "list" ){
					val[ i ] = [];
					for(var k=0;k<v[i]['sub'].length;k++){
						val[i].push( this.get_object_array__( v[i]['sub'][k] ) );
					}
				}else if( v[i]['type'] == "dict" ){
					val[ i ] = this.get_object_array__( v[i]['sub'] );
				}else if( v[i]['type'] == "boolean" ){
					val[ i ] = v[i]['value']=="true"?true:false;
				}else if( v[i]['type'] == "text" ){
					val[ i ] = String( v[i]['value'] );
				}else if( v[i]['type'] == "number" ){
					val[ i ] = Number( v[i]['value'] );
				}else{
					val[ i ] = v[i]['value'];
				}
			}
			return val;
		},
		get_list_array__: function( v ){
			var val = [];
			for( var j in v ){
				if( v[j]['type'] == "list" ){
					val.push( this.get_list_array__( v[j]['value'] ) );
				}else if( v[j]['type'] == "dict" ){
					val.push( this.get_object_array__( v[j]['value'] ) );
				}else if( v[j]['type'] == "number" ){
					val.push( Number( v[j]['value'] ) );
				}else if( v[j]['type'] == "text" ){
					val.push( String( v[j]['value'] ) );
				}else if( v[j]['type'] == "boolean" ){
					val.push( (v[j]['value']=='true'?true:false) );
				}else{
					val.push( v[j]['value'] );
				}
			}
			return val;
		},
		test_simulation__: function(){
			this.test_url__ = "https://" + this.server_host__ + this.api__['name'];
			if( this.test_url__.indexOf("?") >1 ){
				this.test_url__ = this.test_url__ + "&version_id="+this.api__["_id"];
			}else{
				this.test_url__ = this.test_url__ + "?version_id="+this.api__["_id"];
			}
			this.test_status__="Testing...";
			this.test_error__="";
			this.test_response__ = false;
			this.test_headers_show__ = false;
			this.test_waiting__=true;
			var vpostdata = "";
			var vops = {'headers':{}, 'crossDomain': true };
			if( this.api__['input-type'] == "application/x-www-form-urlencoded" ){
				vops['headers']['content-type'] = "application/x-www-form-urlencoded";
				var vpostdata = this.make_query_string__( this.test__ );
				if( this.test_debug__ ){
					vpostdata = vpostdata + "&debug=true";
				}
			}else{
				vops['headers']['content-type'] = "application/json";
				var vpostdata = this.get_object_array__(this.test__);
				this.echo__( vpostdata );
				if( this.test_debug__ ){
					vpostdata[ "debug" ] = true;
				}
			}
			axios.post(this.test_url__, vpostdata, vops ).then(response=>{
				if( typeof(response.data) == "object" ){
					if( 'status' in response.data ){
						this.test_response__ = {
							"status": response.status,
							"body": response.data,
							"headers": response.headers
						};
						this.test_waiting__=false;
					}else{
						this.test_response__ = {
							"status": "Unknown",
							"body": "",
							"headers": {}
						};
						this.test_waiting__=false;
					}
				}else{
					this.test_response__ = {
						"status": response.status,
						"body": response.data,
						"headers": response.headers
					};
					this.test_waiting__=false;
				}
			}).catch(response=>{
				alert( response.status + ": " + response.message );
			});
		},
		test_simulation2__: function(){
			this.test_status__="Testing...";
			this.test_error__="";
			this.test_waiting__=true;
			this.test_headers_show__ = false;
			this.test_response__ = false;
			this.test_url__ = "https://" + this.server_host__ + this.api__['name'];
			this.test_url__ = this.test_url__ + "?"+this.make_query_string__();
			if( this.test_debug__ ){
				this.test_url__ = this.test_url__ + "&debug=true";
			}
			this.test_url__ = this.test_url__ +"&version_id="+this.api__["_id"];
			axios.interceptors.response.use((response) => response, (error) => {
			  if (typeof error.response === 'undefined') {
			    return Promise.reject('A network error occurred. \n'
			        + 'This could be a CORS issue or a dropped internet connection. \n'
			        + 'It is not possible for us to know.\n\nTry browse it in new tab');
			  }
			  return Promise.reject(error)
			})
			axios.get( this.test_url__, {'crossDomain': true} ).then(response=>{
				var r = {
					"status": "200",
					"headers": {},
					"body": "",
				};
				r['status'] = response.status;
				if( 'data' in response ){
					r['body'] = response['data'];
				}
				if( 'headers' in response ){
					r['headers'] = response['headers'];
				}
				this.test_response__ = r;
				this.test_waiting__=false;
			}).catch(response=>{
				if( typeof( response ) == "object" ){
					//console.log( response );
				}else{
					var r = {
						"status": "ERROR",
						"headers": {},
						"body": response+"",
					};
					this.test_response__ = r;
					this.test_waiting__=false;
				}
			});
		},
		make_query_string__: function(){
			var q = [];
			for(var i in this.test__ ){
				q.push( i+ "=" + encodeURIComponent( this.test__[i]['value'] ) );
			}
			return q.join("&");
		},
		initiate_export_data__: function(){
			var vp = prompt("Enter password");
			if( vp ){
				var vurl__ = "/admin/app/<?=$config_param1 ?>/pages/<?=$page["_id"]?>/edit?version=&action=export_api_engine&page_version_id=<?=md5($page['_id']) ?>&password="+encodeURIComponent(vp);
				window.open( vurl__ );
				//window.open("?action=export_api_engine&page_version_id=<?=md5($_GET['version_id']) ?>&password="+encodeURIComponent(vp) );
			}
		},
		initiate_import_data__: function(){
			this.show_import_popup__ = true;
		},
		find_checks__: function(){
			var c = [];
			for(var i=0;i<this.engine__['stages'].length;i++){
				c.push( {"checked":false, "if":false} );
			}
			this.checks__ = c;
		},
		item_clicked__: function( k ){
			this.hide_edit_stage__( k, 'others' );
			setTimeout(this.item_clicked2__,50, k);
		},
		item_clicked2__: function( k ){
			var vfirst = -1;
			for( var i=0;i<k;i++ ){
				if( this.checks__[i]['checked'] ){
					vfirst = i+0;
				}
			}
			if( vfirst > -1 && vfirst < k &&  this.checks__[k]['checked'] ){
				for(var i=vfirst+1;i<=k;i++){
					if( this.engine__['stages'][i]['type'].match( /^(If|While|for|ForEach|HTMLElement)$/i) ){
						break;
					}
					this.checks__[  i ] =  {"checked":true,"if":false} ;
				}
			}
			if( this.engine__['stages'][k]['type'].match( /^(If|While|for|ForEach|HTMLElement)$/i) ){
				if( this.checks__[k]['checked'] == true ){
					var k2 = this.find_next_rand__( k );
					for(var i=k+1;i<=k2;i++){
						this.checks__[  i ] =  {"checked":true,"if":true} ;
					}
				}else{
					this.find_checks__();
				}
			}
			setTimeout(this.find_checked_count__, 50);
		},
		find_checked_count__: function(){
			var c = 0;
			var is_checked = 0;
			for( var i=0;i<this.checks__.length;i++ ){
				if( this.checks__[i]['checked'] ){
					c++;
					if( is_checked == 0 ){
						is_checked= 1;
					}
				}
				if( is_checked == 1 ){
					if( this.checks__[i]['checked'] == false ){
						is_checked = 2;
					}
				}else if( is_checked == 2 && this.checks__[i]['checked'] ){
					this.checks__[  i ] =  {"checked":false,"if":false} ;
					c--;
				}
			}
			this.checked_items__ = c;
		},
		delete_stages__: function(v){
			var delcnt=0;
			for( var i=0;i<this.checks__.length;i++){if( this.checks__[i]['checked'] ){
				this.engine__['stages'].splice(i-delcnt,1);
				delcnt++;
			}}
			this.find_checks__();
			this.find_checked_count__();
			this.fill_variables__();
			this.save_need__=true;
		},
		duplicate_stages__: function(){
			var sp = [];
			var lasti = 0;
			var vc = [];
			for( var i=0;i<this.checks__.length;i++){if( this.checks__[i]['checked'] ){
				sp.push( JSON.parse( JSON.stringify( this.engine__['stages'][i] ) ) );
				vc.push( this.checks__[i] );
				lasti = i;
			}}
			var c = [];
			lasti++;
			for(var i=0;i<sp.length;i++){
				this.checks__.splice( lasti, 0, {"checked":false,"if":false} );
				this.engine__['stages'].splice( lasti, 0, sp[i] );
				c.push(lasti);
				lasti++;
			}
			this.find_checks__();
			for(var i=0;i<c.length;i++){
				this.checks__[  c[i] ] =  vc[i] ;
			}
			this.find_checked_count__();
			this.fill_variables__();
			this.save_need__=true;
		},
		uncheck_all__: function(){
			this.checked_items__ = 0;
			this.find_checks__();
		},
		move_up__: function(){
			var sp = [];
			var c = [];
			var firsti = -1;
			var vl = 0;
			var vc = [];
			for( var i=0;i<this.checks__.length;i++){if( this.checks__[i]['checked'] ){
				sp.push( JSON.parse( JSON.stringify( this.engine__['stages'][i] ) ) );
				if( firsti == -1){
					firsti = i;
				}
				vc.push( this.checks__[i] );
				c.push( i );
			}}
			if( firsti > 0 ){
				vl = 0;
				if( this.engine__['stages'][firsti-1]['type'].match( /^(EndIf|EndWhile|EndFor|EndForEach|HTMLElementEnd)$/i ) ){
					vl = 1;
				}else if( this.engine__['stages'][firsti-1]['type'].match( /^(If|while|for|foreach|htmlelement)$/i ) ){
					if( this.engine__['stages'][firsti-1]['type'] == "HTMLElement" ){
						if( this.engine__['stages'][firsti-1]['htmlelement']['single'] == false ){
							vl = -1;
						}
					}else{
						vl = -1;
					}
				}
				var delcnt=0;
				for(var i=0;i<this.checks__.length;i++){if( this.checks__[i]['checked'] ){
					this.engine__['stages'].splice( i-delcnt, 1 );
					delcnt++;
				}}
				firsti--;
				for(var i=0;i<sp.length;i++){
					sp[i]['l'] = sp[i]['l']+vl;
					this.engine__['stages'].splice( firsti, 0, sp[i] );
					firsti++;
				}
				this.find_checks__();
				for(var i=0;i<c.length;i++){
					this.checks__[  Number(c[i])-1 ] =  vc[i] ;
				}
				this.find_checked_count__();
				this.fill_variables__();
				this.save_need__=true;
			}
		},
		move_down__: function(vid){
			var sp = [];
			var c = [];
			var firsti = -1;
			var lasti = -1;
			var vl = 0;
			var vc = [];
			for( var i=0;i<this.checks__.length;i++){if( this.checks__[i]['checked'] ){
				sp.push( JSON.parse( JSON.stringify( this.engine__['stages'][i] ) ) );
				if( firsti == -1){
					firsti = i;
				}
				lasti = i;
				c.push( i );
				vc.push( this.checks__[i] );
			}}
			if( firsti > -1 && lasti < this.checks__.length-1 ){
				vl = 0;
				if( this.engine__['stages'][lasti+1]['type'].match( /^(EndIf|EndWhile|EndFor|EndForEach|htmlelementend)$/i ) ){
					vl = -1;
				}else if( this.engine__['stages'][lasti+1]['type'].match( /^(If|While|For|ForEach|htmlelement)$/i ) ){
					if( this.engine__['stages'][lasti+1]['type'] == "HTMLElement" ){
						if( this.engine__['stages'][lasti+1]['htmlelement']['single'] == false ){
							vl = 1;
						}
					}else{
						vl = 1;
					}
				}
				var delcnt=0;
				for(var i=0;i<this.checks__.length;i++){if( this.checks__[i]['checked'] ){
					this.engine__['stages'].splice( i-delcnt, 1 );
					delcnt++;
				}}
				firsti++;
				for(var i=0;i<sp.length;i++){
					sp[i]['l'] = sp[i]['l']+vl;
					this.engine__['stages'].splice( firsti, 0, sp[i] );
					firsti++;
				}
				this.find_checks__();
				for(var i=0;i<c.length;i++){
					this.checks__[  Number(c[i])+1 ] =  vc[i] ;
				}
				this.find_checked_count__();
				this.fill_variables__();
				this.save_need__=true;
			}
		},
		updated_stage_var: function( stagei__, data_var, val ){
			var k = this.engine__['stages'][ stagei__ ]['k'];
			var x = data_var.split(":");
			if( x.length > 1 ){
				if( k == 'Let' ){
					if( x[1] == "vtype" ){
						this.engine__['stages'][ stagei__ ]['d']['value'] = "";
					}
					if( x[1] == "type" ){
						if( this.engine__['stages'][ stagei__ ]['d']['type'] == "boolean" ){
							this.engine__['stages'][ stagei__ ]['d']['value'] = "true";
						}
					}
					if( x[1] == "name" ){
						var n = this.engine__['stages'][stagei__]['d']['name'];
						n = n.replace(/[\W]+/g, "");
						n = n.trim();
						this.engine__['stages'][stagei__]['d']['name'] = n;
					}
				}
				if( k == "Function" ){
					if( this.engine__['stages'][ vstagei__ ]['function']['function'] == "" ){
						this.engine__['stages'][ vstagei__ ]['function'][  'inputs' ] =  {} ;
						this.engine__['stages'][ vstagei__ ]['function'][  'return' ] =  false ;
					}else{
						var v = this.functions__[ this.engine__['stages'][ vstagei__ ]['function']['function'] ];
						v = this.json__( v );
						this.engine__['stages'][ vstagei__ ]['function'][  'inputs' ] =  v['inputs'] ;
						this.engine__['stages'][ vstagei__ ]['function'][  'return' ] =  v['return'] ;
					}
				}
			}else{
				
			}
		},
		updated_option__: function( stagei__, vv = "" ){
			if( this.engine__['stages'][ stagei__ ]['k'] == "SetLabel" ){
				var v = this.engine__['stages'][ stagei__ ]['label'];
				v = v.replace(/[\W]+/g, "");
				v = v.toProperCase(v.trim())
				this.engine__['stages'][ stagei__ ][  'label' ] =  v ;
			}
			if( vv == "OutputSelect" ){
				var k = this.engine__['stages'][ stagei__ ]['output']['value']+'';
				k = k.split(/\-\>/g);
				k = k[ k.length-1]+'';
				this.engine__['stages'][ stagei__ ]['output'][ 'as' ] = k;
			}
			if( this.engine__['stages'][ stagei__ ]['k'] == "Let" ){
				var t  = this.engine__['stages'][ stagei__ ]['d']['type'];
				var vt = this.engine__['stages'][ stagei__ ]['d']['vtype'];
				if( vt == "static" && ( t == "dict" || t == "list" ) ){
					this.engine__['stages'][ stagei__ ]['d'][ 'value' ] = '';
				}
			}
			this.fill_variables__();
			//this.build_code__( stagei__ );
			this.save_need__=true;
		},
		show_edit_stage__: function( vi ){
			this.uncheck_all__();
			if( this.engine__['stages'][ vi ]['type'] == "HTMLElementEnd" || this.engine__['stages'][ vi ]['type'] == "EndIf" || this.engine__['stages'][ vi ]['type'] == "EndForEach"|| this.engine__['stages'][ vi ]['type'] == "EndFor"|| this.engine__['stages'][ vi ]['type'] == "EndWhile" ){
			}else{
				this.engine__['stages'][ vi ][  'e' ] =  true ;
			}
			this.hide_edit_stage__( vi, 'others' );
		},
		hide_edit_stage__: function( vi, vm ){
			if( vi == undefined || vi == null || vi == Event ){
				vi = -1;
			}
			if( vi != -1 ){
				if( this.engine__['stages'][ vi ]['type'] == "HTMLElement" ){
					this.engine__['stages'][ vi ][  'htmlelement' ] =  JSON.parse( JSON.stringify( this.engine__['stages'][ vi ]['htmlelement'] ) ) ;
				}
				this.fill_variables__();
			}
			if( vm == 'all' ){ vi = -1; }
			for(var i=0;i<this.engine__['stages'].length;i++){
				if( this.engine__['stages'][ i ]['e'] == true && i != vi ){
					//this.build_code__( i );
					this.engine__['stages'][ i ][  'e' ] =  false ;
				}
			}
		},
		add_stage__: function( vp ){
			this.hide_edit_stage__(-1, 'all');
			this.checks__.push({"checked":false,"if":false});
			var new_stage_id = vp;
			if( vp == 'last' ){
				this.engine__['stages'].push({
					"k": "none",
					"t": "n", // n=none,c=cmd,o=object
					"d": {}, // data
					"l": 1, // level
					"e": false,
					"ee": true, //editable
					"er": "",
				});
				new_stage_id = this.engine__['stages'].length-1;
			}else{
				var vl = Number( this.engine__['stages'][vp]['l'] );
				if( this.engine__['stages'][vp]['type'] == "EndIf" || this.engine__['stages'][vp]['type'] == "EndWhile" || this.engine__['stages'][vp]['type'] == "EndForEach" || this.engine__['stages'][vp]['type'] == "EndFor"  || this.engine__['stages'][vp]['type'] == "HTMLElementEnd" ){
					vl++;
				}
				this.engine__['stages'].splice( vp, 0, {
					"k": "none",
					"t": "n", // n=none,c=cmd,o=object
					"d": {},
					"l": vl,
					"e": false,
					"ee": true,
					"er": "",
				});
			}
			this.find_checks__();
			this.save_need__ = true;
			this.fill_variables__();
		},
		stage_change_stage__: function( vid, new_key, new_type ){
			console.log( vid );
			var curstage = Number(this.engine__['stages'][ vid ]['l']);
			this.engine__['stages'][ vid ][ 'e' ] = true;
			this.engine__['stages'][ vid ][ 'd' ] = false;
			this.engine__['stages'][ vid ][ '_output_vars' ] = {};
			if( this.engine__['stages'][ vid ]['pk'] == "ForEach" && this.engine__['stages'][ vid ]['k'] != "ForEach" ){
				this.engine__['stages'][ vid ][ 'pk' ] =  "none";
				this.engine__['stages'][ vid ][ 'k' ] =  "none";
				this.engine__['stages'][ vid ][ 't' ] =  "none";
				delete  this.engine__['stages'][ vid ][ 'foreach' ] ;
				var lastif = this.find_next_rand__( vid );
				this.checks__.pop();
				this.engine__['stages'].splice(lastif,1);
				for(var i=Number(vid)+1;i<lastif;i++){
					this.engine__['stages'][ i ][  'l' ] =  Number(this.engine__['stages'][ i ]['l'])-1 ;
				}
			}
			if( this.engine__['stages'][ vid ]['pk'] == "While" && this.engine__['stages'][ vid ]['k'] != "While" ){
				this.engine__['stages'][ vid ][ 'pk' ] =  "none";
				this.engine__['stages'][ vid ][ 'k' ] =  "none";
				this.engine__['stages'][ vid ][ 't' ] =  "n";
				delete  this.engine__['stages'][ vid ][ 'while' ] ;
				var lastif = this.find_next_rand__( vid );
				this.checks__.pop();
				this.engine__['stages'].splice(lastif,1);
				for(var i=Number(vid)+1;i<lastif;i++){
					this.engine__['stages'][ i ][  'l' ] =  Number(this.engine__['stages'][ i ]['l'])-1 ;
				}
			}
			if( this.engine__['stages'][ vid ]['pk'] == "For" && this.engine__['stages'][ vid ]['k'] != "For" ){
				this.engine__['stages'][ vid ][ 'pk' ] =  "none";
				this.engine__['stages'][ vid ][ 'k' ] =  "none";
				this.engine__['stages'][ vid ][ 't' ] =  "n";
				delete  this.engine__['stages'][ vid ][ 'for' ] ;
				var lastif = this.find_next_rand__( vid );
				this.checks__.pop();
				this.engine__['stages'].splice(lastif,1);
				for(var i=Number(vid)+1;i<lastif;i++){
					this.engine__['stages'][ i ][  'l' ] =  Number(this.engine__['stages'][ i ]['l'])-1 ;
				}
			}
			if( this.engine__['stages'][ vid ]['pk'] == "If" && this.engine__['stages'][ vid ]['k'] != "If" ){
				this.engine__['stages'][ vid ][ 'pk' ] =  "none";
				this.engine__['stages'][ vid ][ 'k' ] =  "none";
				this.engine__['stages'][ vid ][ 't' ] =  "n";
				delete  this.engine__['stages'][ vid ][ 'if' ] ;
				var lastif = this.find_next_rand__( vid );
				this.checks__.pop();
				this.engine__['stages'].splice(lastif,1);
				for(var i=Number(vid)+1;i<lastif;i++){
					this.engine__['stages'][ i ][  'l' ] =  Number(this.engine__['stages'][ i ]['l'])-1 ;
				}
			}
			if( this.engine__['stages'][ vid ]['pk'] == "HTMLElement" && this.engine__['stages'][ vid ]['k'] != "HTMLElement" ){
				this.engine__['stages'][ vid ][ 'pk' ] =  "none";
				this.engine__['stages'][ vid ][ 'k' ] =  "none";
				this.engine__['stages'][ vid ][ 't' ] =  "n";
				delete this.engine__['stages'][ vid ][ 'htmlelement' ] ;
				var lastif = this.find_next_rand__( vid );
				this.checks__.pop();
				this.engine__['stages'].splice(lastif,1);
				for(var i=Number(vid)+1;i<lastif;i++){
					this.engine__['stages'][ i ][  'l' ] =  Number(this.engine__['stages'][ i ]['l'])-1 ;
				}
			}
			if( this.engine__['stages'][ vid ]['type'] == "HTMLElement" ){
				this.engine__['stages'][ vid ][  'pk' ] =  "HTMLElement" ;
				var vrand__ = "v_" + ( (Math.random()*10000000).toFixed() );
				this.engine__['stages'][ vid ][  'vrand' ] =  vrand__+"" ;
				this.engine__['stages'][ vid ][  'htmlelement' ] =  {
					"tag": "none",
					"ptag": "none",
					"attr": {},
					"styles": {},
					"classes": {},
					"single": true,
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "SMS" ){
				this.engine__['stages'][ vid ][  'pk' ] =  "SMS" ;
				this.engine__['stages'][ vid ][  'sms' ] =  {
					"mobile": {
						"type": "static",
						"value": "",
					},
					"message": {
						"type": "static",
						"value": "",
					},
					"gateway": "default",
					"template": "default",
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "EMail" ){
				this.engine__['stages'][ vid ][  'pk' ] =  "EMail" ;
				this.engine__['stages'][ vid ][  'email' ] =  {
					"to": [],
					"cc": [],
					"bcc": [],
					"reply-to": {"type":"static", "value": ""},
					"sender_id": false,
					"sender": false,
					"type": "html",
					"body": {"type":"static", "value": ""},
					"type": "html",
					"attachments": [],
					"subject": {"type":"static", "value": ""},
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "SetCookie" ){
				this.engine__['stages'][ vid ][  'pk' ] =  "SetCookie" ;
				this.engine__['stages'][ vid ][  'setcookie' ] =  {
					"lhs": "",
					"rhs": {"type":"text", "value":"", "timetype": "h", "time": 1},
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "SetSession" ){
				this.engine__['stages'][ vid ][  'pk' ] =  "SetSession" ;
				this.engine__['stages'][ vid ][  'setsession' ] =  {
					"lhs": "",
					"rhs": {"type":"text", "value":""},
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "Output" || this.engine__['stages'][ vid ]['type'] == "OutputValue" ){
				this.engine__['stages'][ vid ][  'pk' ] =  "Output" ;
				this.engine__['stages'][ vid ][  'output' ] =  {
					"value": "",
					"as": "",
					"type": "static",
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "BreakLoop" ){
				this.engine__['stages'][ vid ][ 'pk' ] =  "BreakLoop";
			}
			if( this.engine__['stages'][ vid ]['type'] == "If" ){
				this.engine__['stages'][ vid ][  'pk' ] =  "If" ;
				var vrand__ = "v_" + ( (Math.random()*10000000).toFixed() );
				this.engine__['stages'][ vid ][  'vrand' ] =  vrand__+"" ;
				var cond = [{
					"lhs": "",
					"operator": "==",
					"rhs": {
						"type": "static",
						"value": "",
					}
				}];
				this.engine__['stages'][ vid ][  'cond' ] =  cond ;
				this.engine__['stages'][ vid ][  'type' ] =  "If" ;
				this.checks__.push({"checked":false,"if":false});
				this.insert_after__( vid, {
					"k": "EndIf",
					"t": "cmd",
					"l": curstage,
					"e": false,
					"d": {},
					"er": "",
					"vrand": vrand__,
				});
				this.checks__.push({"checked":false,"if":false});
				this.insert_after__( vid, {
					"k": "None",
					"t": "n",
					"l": (curstage+1),
					"e": false,
					"d": {},
					"er": "",
				});
				this.$forceUpdate();
			}
			if( this.engine__['stages'][ vid ]['type'] == "While" ){
				this.engine__['stages'][ vid ][  'pk' ] =  "While" ;
				var vrand__ = "v_" + ( (Math.random()*10000000).toFixed() );
				this.engine__['stages'][ vid ][  'vrand' ] =  vrand__+"" ;
				var cond = [{
					"lhs": "",
					"operator": "==",
					"rhs": {
						"type": "static",
						"value": "",
					}
				}];
				this.engine__['stages'][ vid ][  'cond' ] =  cond ;
				this.checks__.push({"checked":false,"if":false});
				this.insert_after__( vid, {
					"k": "EndWhile",
					"t": "cmd",
					"l": curstage,
					"e": false,
					"d": {},
					"er": "",
					"vrand": vrand__+"",
				});
				this.checks__.push({"checked":false,"if":false});
				this.insert_after__( vid, {
					"k": "None",
					"t": "n",
					"l": (curstage+1),
					"e": false,
					"d": {},
					"er": "",
				});
				this.$forceUpdate();
			}
			if( this.engine__['stages'][ vid ]['type'] == "ForEach" ){
				this.engine__['stages'][ vid ][  'pk' ] =  "ForEach" ;
				this.engine__['stages'][ vid ][  'foreach' ] =  {
					"var": "",
					"key": "",
					"value":""
				};
				var vrand__ = "v_" + ( (Math.random()*10000000).toFixed() );
				this.engine__['stages'][ vid ][  'vrand' ] =  vrand__+"" ;
				this.checks__.push({"checked":false,"if":false});
				this.insert_after__( vid, {
					"k": "EndForEach",
					"t": "cmd",
					"l": curstage,
					"e": false,
					"d": {},
					"er": "",
					"vrand": vrand__+"",
				});
				this.checks__.push({"checked":false,"if":false});
				this.insert_after__( vid, {
					"k": "None",
					"t": "n",
					"l": (curstage+1),
					"e": false,
					"d": {},
					"er": "",
				});
				this.$forceUpdate();
			}
			if( this.engine__['stages'][ vid ]['type'] == "For" ){
				this.engine__['stages'][ vid ][  'pk' ] =  "For" ;
				this.engine__['stages'][ vid ][  'for' ] =  {
					"start": {"type":"number", "value": 0},
					"end": {"type": "number", "value": 100},
					"order": {"type":"text", "value": "asc"},
					"modifier": {"type":"number", "value": 1},
					"maxloops": {"type":"number", "value": 1000},
					"as": "x",
				};
				var vrand__ = "v_" + ( (Math.random()*10000000).toFixed() );
				this.engine__['stages'][ vid ][  'vrand' ] =  vrand__+"" ;
				this.checks__.push({"checked":false,"if":false});
				this.insert_after__( vid, {
					"k": "EndFor",
					"t": "cmd",
					"l": curstage,
					"e": false,
					"d": "EndFor",
					"er": "",
					"vrand": vrand__+"",
				});
				this.checks__.push({"checked":false,"if":false});
				this.insert_after__( vid, {
					"k": "None",
					"t": "cmd",
					"l": (curstage+1),
					"e": false,
					"d": "None",
					"er": "",
				});
				this.$forceUpdate();
			}
			if( new_key in this.stage_params__ ){
				this.engine__['stages'][ vid ]['d'] = this.stage_params__[new_key]['p'];
			}else if( new_key == 'Let' ){
				this.engine__['stages'][ vid ]['d'] = {
					"name": "",
					"type": "text",
					"vtype": "static",
					"value": "",
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "Assign" ){
				this.engine__['stages'][ vid ]['pk'] = this.engine__['stages'][ vid ]['type']+"";
				var cond = {
					"lhs": "",
					"operator": "==",
					"rhs": {
						"type": "static",
						"value": "",
					},
				};
				this.engine__['stages'][ vid ][  'assign' ] =  cond ;
				this.engine__['stages'][ vid ][  'type' ] =  "Assign" ;
			}
			if( this.engine__['stages'][ vid ]['type'] == "Function" ){
				this.engine__['stages'][ vid ]['pk'] = this.engine__['stages'][ vid ]['type']+"";
				var cond = {
					"lhs": "",
					"function": "",
					"inputs": {}
				};
				this.engine__['stages'][ vid ][  'function' ] =  cond ;
			}
			if( this.engine__['stages'][ vid ]['type'] == "GlobalProcedure" ){
				this.engine__['stages'][ vid ]['pk'] = this.engine__['stages'][ vid ]['type']+"";
				cond = {
					"procedure": "",
					"inputs": {},
					"mapping": {},
					"output": "",
					"output_vars": [],
				};
				this.engine__['stages'][ vid ][  'procedure' ] =  cond ;
			}
			if( this.engine__['stages'][ vid ]['type'] == "Procedure" ){
				this.engine__['stages'][ vid ]['pk'] = this.engine__['stages'][ vid ]['type']+"";
				cond = {
					"procedure": "",
					"inputs": {},
					"mapping": {},
					"output": "",
					"output_vars": [],
				};
				this.engine__['stages'][ vid ][  'procedure' ] =  cond ;
			}
			if( this.engine__['stages'][ vid ]['type'] == "Math" ){
				this.engine__['stages'][ vid ]['pk'] = this.engine__['stages'][ vid ]['type']+"";
				var cond = {
					"lhs": "",
					"rhs": {
						"operator": "+",
						"a": "",
						"b":{
							"type": "static",
							"value": "",
						},
						"c":{
							"type": "static",
							"value": "",
						}
					},
				};
				this.engine__['stages'][ vid ][  'math' ] =  cond ;
				this.engine__['stages'][ vid ][  'type' ] =  "Math" ;
			}
			if( this.engine__['stages'][ vid ]['type'] == "ParseJson" ){
				this.engine__['stages'][ vid ][  'pk' ] =  "ParseJson" ;
				this.engine__['stages'][ vid ][  'parsejson' ] =  {"input":"","rules":""} ;
			}
			if( this.engine__['stages'][ vid ]['type'] == "ParseXml" ){
				this.engine__['stages'][ vid ][  'pk' ] =  "ParseXml" ;
				this.engine__['stages'][ vid ][  'parsexml' ] =  {"input":"","rules":""} ;
			}
			if( this.engine__['stages'][ vid ]['type'] == "SetLabel" ){
				this.engine__['stages'][ vid ][  'label' ] =  "" ;
			}
			if( this.engine__['stages'][ vid ]['type'] == "JumpToLabel" ){
				this.engine__['stages'][ vid ][  'jump_to_label' ] =  "" ;
			}
			if( this.engine__['stages'][ vid ]['type'] == "Sleep" ){
				this.engine__['stages'][ vid ][  'sleep' ] =  {
					"types": ["variable", "number"],
					"type": "number",
					"value": "10",
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "Log" ){
				this.engine__['stages'][ vid ][  'log' ] =  {
					"types": ["variable", "text"],
					"type": "variable",
					"value": "",
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "RespondError" ){
				this.engine__['stages'][ vid ][  'enderror' ] =  {"type":"static", "value":""} ;
			}
			if( this.engine__['stages'][ vid ]['type'] == "Thing" ){
				this.engine__['stages'][ vid ][  'db' ] =  {
					"table_id": "",
					"table": "",
					"schema": "",
					"action": "FindOne",
					"conditions": [{"field": "_id","operator": "==","value": ""}],
					"data": [],
					"outputs": [],
					"output_vars": [],
					"limit": 1,
					"orderby": "", "order": "asc",
					"output": "",
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "DynamoDB" ){
				this.engine__['stages'][ vid ][  'db' ] =  {
					"table_id": "",
					"table": "",
					"schema": "",
					"action": "FindOne",
					"conditions": [{"field": "_id","operator": "==","value": ""}],
					"data": [],
					"outputs": [],
					"output_vars": [],
					"limit": 1,
					"orderby": "", "order": "asc",
					"output": "",
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "DB" ){
				this.engine__['stages'][ vid ][  'db' ] =  {
					"db_id": "",
					"database": "",
					"table_id": "",
					"table": "",
					"engine": "",
					"schema": {
						"name": "",
						"fields": "",
					},
					"keys": {},
					"action": "FindOne",
					"data": [],
					"conditions": [],
					"dc": {
						"pi": "main",
						"pk": {"field":"", "type":"static", "vtype": "text", "value":""},
						"sk": {"field":"", "type":"static", "vtype": "text", "value":"", "enable":true},
						"sort": "asc",
					},
					"data": [],
					"outputs": [],
					"output_vars": [],
					"limit": 1,
					"order": {
						"order1": {"field":"", "order":"asc"},
						"order2": {"field":"", "order":"asc"},
					},
					"hint": "",
					"output": "",
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "DynamicTable" ){
				this.engine__['stages'][ vid ][  'dynamic_table' ] =  {
					"table_id": "",
					"table": "",
					"schema": {},
					"action": "FindOne",
					"dc": {
						"pi": "main",
						"a": {
							"f":"_id",
							"t": "text",
							"vt":"static",
							"op":"=",
							"v":"",
							"vt2":"static",
							"op2":"=",
							"v2":"",
							"sort": "asc",
						},
						"b": {
							"e": false,
							"f":"",
							"t": "text",
							"vt":"static",
							"op":"=",
							"v":"",
							"vt2":"static",
							"op2":"=",
							"v2":"",
							"sort": "asc",
						},
						"c": {
							"e": false,
							"f":"",
							"t": "text",
							"vt":"static",
							"op":"=",
							"v":"",
							"vt2":"static",
							"op2":"=",
							"v2":"",
							"sort": "asc",
						},
					},
					"data": [],
					"outputs": [],
					"output_vars": [],
					"limit": 1,
					"output": "",
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "ElasticTable" ){
				this.engine__['stages'][ vid ][  'elastic_table' ] =  {
					"table_id": "",
					"table_series_id": "",
					"index_table": "",
					"primary_type": "auto",
					"table": "",
					"schema": {
						"name": "",
						"fields": "",
					},
					"action": "FindOne",
					"data": [],
					"pk": {"field": "", "type": "text"},
					"conditions": [],
					"dc": {
						"pi": "main",
						"pk": {
							"field":"",
							"vtype": "text",
							"type":"static",
							"op":"=",
							"value":"",
							"type2":"static",
							"op2":"=",
							"value2":"",
							"map":""
						},
						"sk": {
							"field":"",
							"map": "",
							"vtype": "text",
							"type":"static",
							"op":"=",
							"value":"",
							"type2":"static",
							"op2":"=",
							"value2":"",
							"enable":true
						},
						"sort": "asc",
						"start_key": "",
					},
					"data": [],
					"outputs": [],
					"output_vars": [],
					"limit": 1,
					"output": "",
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "Redis" ){
				var cond = {
					"lhs": "",
					"function": "",
					"inputs": {},
					"table_id": "",
					"table": "",
				};
				this.engine__['stages'][ vid ][  'db' ] =  cond ;
			}
			if( this.engine__['stages'][ vid ]['type'] == "PageSettings" ){
				this.engine__['stages'][ vid ][  'pagesettings' ] =  [{
					"prop": "",
					"data": {},
				}];
			}
			if( this.engine__['stages'][ vid ]['type'] == "RenderBlock" ){
				this.engine__['stages'][ vid ][  'renderblock' ] =  {
					"block_id": "",
					"block": {},
					"mapping": {},
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "RenderArticle" ){
				this.engine__['stages'][ vid ][  'renderarticle' ] =  {
					"page_id"	: this.api__["_id"],
					"article_id"	: "",
					"user_id"	: "",
					"article_title"	: ""
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "RenderHTML" ){
				this.engine__['stages'][ vid ][  'renderhtml' ] =  {
					"html_body": "",
					"style_body": "",
					"d": false,
					"mapping": {},
					"variables": {}
				};
			}
			if( this.engine__['stages'][ vid ]['type'] == "HTTPRequest" ){
				this.engine__['stages'][ vid ][  'httprequest' ] =  "initial";
			}
			if( this.engine__['stages'][ vid ]['type'] == "QueuePush" ){
				this.engine__['stages'][ vid ][  'queue' ] =  {
					"queue_id":"",
					"des":"",
					"priority":false,
					"task": {
						"type": "",
						"app_id": "",
						"app": "",
						"prop_id": "",
						"prop_name":"",
						"inputs": [],
						"outputs": [],
					},
					"delay": 0,
					"output": "res",
				};
			}
			if( new_key in this.stage_params__ ){
				if( new_type == 'c' ){
					this.engine__['stages'][ vid ]['d'] = this.json__( this.stage_params__[ new_key ]['p'] );
				}else{
					this.engine__['stages'][ vid ]['d'] = {};
				}
				
				this.engine__['stages'][ vid ]['er' ] =  false ;
			}

			this.engine__['stages'][ vid ]['k'] = new_key;
			this.engine__['stages'][ vid ]['t'] = new_type;
			this.engine__['stages'][ vid ]['pk' ] =  new_key;
			this.engine__['stages'][ vid ]['e'] = false;

			this.save_need__ = true;
		},
		json__: function( v ){
			if( typeof(v) == "object" ){
				return JSON.parse( JSON.stringify( v ) );
			}else{
				return v;
			}
		},
		insert_after__: function( vid, vd ){
			if( Number(this.engine__['stages'].length)-1 == Number(vid) ){
				this.engine__['stages'].push(vd);
			}else{
				this.engine__['stages'].splice( Number(vid)+1, 0, vd );
			}
			this.save_need__ = true;
		},
		getlevel__: function(vid){
			var vl = (Number(this.engine__['stages'][vid]['l'])-1);
			if( vl < 0 ){
				vl = 0;
			}
			var v = "margin-left:"+(vl*20)+"px; border-left:1px dashed #bbb;";
			return v;
		},
		find_next_rand__: function( vi ){
			if( 1==2 ){
				for(var i=Number(vi)+1;i<this.engine__['stages'].length;i++){
					var vrand__ = "";
					if( 'vrand' in this.engine__['stages'][ i ] ){
						vrand__ = this.engine__['stages'][ i ]['vrand']+""
					}
				}
			}
			var lastif = -1;
			var start_rand = this.engine__['stages'][ Number(vi) ]['vrand'];
			for(var i=Number(vi)+1;i<this.engine__['stages'].length;i++){
				if( 'vrand' in this.engine__['stages'][ i ] ){
					if( start_rand == this.engine__['stages'][ i ]['vrand']+"" ){
						lastif = i+0;
						break;
					}
				}
			}
			return lastif;
		},
		find_prev_rand__: function( vi ){
			var lastif = -1;
			var start_rand = this.engine__['stages'][ Number(vi) ]['vrand'];
			for(var i=Number(vi)-1;i>this.engine__['stages'].length;i--){
				if( 'vrand' in this.engine__['stages'][ i ] ){
					if( start_rand == this.engine__['stages'][ i ]['vrand']+"" ){
						lastif = i+0;
						break;
					}
				}
			}
			return lastif;
		},
		add_if_condition__: function( vi ){
			this.engine__['stages'][ vi ]['cond'].push({
				"lhs": "",
				"operator": "==",
				"rhs": {
					"type": "static",
					"value": "",
				}
			});
			this.save_need__ = true;
		},
		delete_if_condition__: function( vi, vfi ){
			this.engine__['stages'][ vi ]['cond'].splice(vfi,1);
			this.save_need__ = true;
		},
		make_post_body_json__: function(v){
			if( typeof(v) == "object" ){
			if( "length" in v ){
				var vi = [];
				for( var i=0;i<v.length;i++){
					if( v[i]['vtype'] == "static" ){
						if( v[i]['type'] == "text" ){
							vi[i] = v[i]['value']+"";
						}else if( v[i]['type'] == "number" ){
							vi[i] = Number(v[i]['value']);
						}else if( v[i]['type'] == "null" ){
							vi[i] = null;
						}else if( v[i]['type'] == "boolean" ){
							vi[i] = (v[i]['value']=="true"?true:false);
						}else if( v[i]['type'] == "dict" || v[i]['type'] == "list" ){
							vi[i] = this.make_post_body_json__( v[i]['sub'] );
						}else{
							vi[i] = "ERROR";
						}
					}else{
						vi[ i ] = "Variable["+v[i]['value']+"]";
					}
				}
				return vi;
			}else{
				var vi = {};
				for( var i in v ){
					if( v[i]['vtype'] == "variable" ){
						vi[ i ] = "Variable["+v[i]['value']+"]";
					}else{
						if( v[i]['type'] == "dict" ){
							vi[ i ] = {};
							vi[ i ] = this.make_post_body_json__( v[i]['sub'] );
						}else if( v[i]['type'] == "list" ){
							vi[ i ] = [];
							vi[ i ] = this.make_post_body_json__( v[i]['sub'] );
						}else if( v[i]['type'] == "text" ){
							vi[ i ] = v[i]['value'].toString();
						}else if( v[i]['type'] == "null" ){
							vi[i] = null;
						}else if( v[i]['type'] == "number" ){
							vi[ i ] = Number(v[i]['value'])
						}else if( v[i]['type'] == "boolean" ){
							if( v[i]['value'] == "true" ){
								vi[ i ] = true;
							}else{
								vi[ i ] = false;
							}
						}
					}
				}
				return vi;
			}
			}else{
				return v
			}
	        },
	        make_post_body_xml__: function( v, vtabs="" ){
			var vstr = "";
			var k = Object.keys(v).sort();
			for( var ii in k ){
				var i = k[ii];
				if( v[i]['type'] == "dict" ){
					if( Object.keys( v[i]['sub'] ).length ){
						vstr = vstr + vtabs + "<" + v[i]['name'];
						if( v[i]['a'] ){
							vstr = vstr + " " + v[i]['a'];
						}
						vstr = vstr + ">\n";
						vstr = vstr + this.make_post_body_xml__( v[i]['sub'], vtabs+"\t" );
						vstr = vstr + vtabs + "</" + v[i]['name'] + ">\n";
					}else if( v[i]['vtype'] == "variable" ){
						vstr = vstr + vtabs + "<" + v[i]['name'];
						if( v[i]['a'] ){
							vstr = vstr + " " + v[i]['a'];
						}
						vstr = vstr + ">"+ "Variable["+v[i]['value']+"]" +"</" + v[i]['name'] + ">\n";
					}else{
						vstr = vstr + vtabs + "<" + v[i]['name'];
						if( v[i]['a'] ){
							vstr = vstr + " " + v[i]['a'];
						}
						vstr = vstr + "></" + v[i]['name'] + ">\n";
					}
				}else if( v[i]['type'] == "list" ){
					if( v[i]['vtype'] == "static" ){
						vstr = vstr + vtabs + "<" + v[i]['name'] + ">\n";
						for( var kk in v[i]['sub'] ){
							vstr = vstr + this.make_post_body_xml__( v[i]['sub'][kk], vtabs+"\t" );
						}
						vstr = vstr + vtabs + "</" + v[i]['name'] + ">\n";
					}else{
						vstr = vstr + vtabs + "<" + v[i]['name'] + ">"+ "Variable["+v[i]['value']+"]" +"</" + v[i]['name'] + ">\n";
					}
				}else{
					vstr = vstr + vtabs + "<" + v[i]['name'];
					if( v[i]['a'] ){
						vstr = vstr + " " + v[i]['a'];
					}
					vstr = vstr + ">";
					if( v[i]['vtype'] == "static" ){
						vstr = vstr + v[i]['value'].toString() + "</" + v[i]['name'] + ">\n";
					}else{
						vstr = vstr + "Variable["+v[i]['value']+"</" + v[i]['name'] + ">\n";
					}
				}
			}
			return vstr;
	        },
	        make_response_body_json__: function(v){
			var vi = {};
			for( var i in v ){
				if( v[i]['type'] == "dict" ){
					if( Object.keys(v[i]['sub']).length ){
						vi[ i ] = {};
						vi[ i ] = this.make_response_body_json__( v[i]['sub'] );
					}else if( v[i]['vtype'] == "variable" ){
						vi[ i ] = "Variable["+this.get_v_name__(v[i]['value'])+"]";
					}else{

					}
				}else if( v[i]['type'] == "list" ){
					vi[ i ] = ["Variable["+this.get_v_name__(v[i]['value'])+"]"];
				}else if( v[i]['type'] == "text" ){
					vi[ i ] = "Variable["+this.get_v_name__(v[i]['value'])+"]";
				}else if( v[i]['type'] == "number" ){
					vi[ i ] = "Variable["+this.get_v_name__(v[i]['value'])+"]";
				}else if( v[i]['type'] == "boolean" ){
					vi[ i ] = "Variable["+v[i]['value']+"]";
				}
			}
			return vi;
	        },
	        make_response_body_xml__: function( v, vtabs="" ){
			var vstr = "";
			var k = Object.keys(v).sort();
			for( var ii in k ){
				var i = k[ii];
				if( v[i]['type'] == "dict" ){
					if( Object.keys( v[i]['sub'] ).length ){
						vstr = vstr + vtabs + "<" + v[i]['name'];
						vstr = vstr + ">\n";
						vstr = vstr + this.make_response_body_xml__( v[i]['sub'], vtabs+"\t" );
						vstr = vstr + vtabs + "</" + v[i]['name'] + ">\n";
					}else{
						vstr = vstr + vtabs + "<" + v[i]['name'];
						vstr = vstr + ">"+ "Variable["+v[i]['value']+"]" +"</" + v[i]['name'] + ">\n";
					}
				}else if( v[i]['type'] == "list" ){
					vstr = vstr + vtabs + "<" + v[i]['name'] + ">"+ "Variable["+v[i]['value']+"]" +"</" + v[i]['name'] + ">\n";
				}else{
					vstr = vstr + vtabs + "<" + v[i]['name'];
					vstr = vstr + ">";
					vstr = vstr + "Variable["+v[i]['value']+"]</" + v[i]['name'] + ">\n";
				}
			}
			return vstr;
        },
		escapeHtml__: function(text){
			return text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
		},
		is_it_orphan__: function( stagei__, vn ){
			if( vn == "" ){ return false; }
			if( this.all_factors_stage_wise__.hasOwnProperty(stagei__) == false ){
				return true;
			}else if( this.all_factors_stage_wise__[ stagei__ ].hasOwnProperty( vn+"") ){
				return false;
			}else{
				return true
			}
		},
		nameKeydown__(e) {
			if (/^\W$/.test(e.key)) {
				e.preventDefault();
			}
		},
		parsejson_updated__( vi, vdata ){
			this.engine__['stages'][ vi ]['parsejson'][  "rules" ] =  vdata ;
			this.updated_option__( vi );
		},
		parsexml_updated__( vi, vdata ){
			this.engine__['stages'][ vi ]['parsexml'][   "rules" ] =  vdata ;
			this.updated_option__( vi );
		},
		assign_updated__( vi, vdata ){
			this.engine__['stages'][vi]['assign']['rhs'][  "value" ] =  vdata ;
			this.updated_option__( vi );
		},
		import_json_data__: function( stagei__ ){
			var v = this.import_json_content__.trim();
			try{
				v = v.replace(/\,[\t\r\n\ ]*\}/mg, "}");
				v = v.replace(/\,[\t\r\n\ ]*\]/mg, "]");
				var vdata = JSON.parse( v );
				vdata = this.make_object_body__( vdata );
				this.engine__['stages'][ stagei__ ]['assign']['rhs'][  'value' ] =  vdata ;
				this.unset_flag__('import_json', stagei__);
			}catch(e){
				alert("Import JSON Error: " + e );
			}
		},
		import_xml_data__: function(stagei__){
			var v = this.import_xml_content__.trim();
			if( v.indexOf("<") == 0 && v.indexOf("<") > -1 && v.indexOf(">") > 3 ){
				var vdata = this.xml_to_array__( v );
				var vdata = this.make_object_body__( vdata );
				this.engine__['stages'][ stagei__ ]['assign']['rhs'][  'value' ] =  vdata ;
				this.unset_flag__('import_xml', stagei__);
			}
		},
		xml_to_array__: function( vtext ){
			var v = vtext+"";
			v = v.trim();
			v = v.replace( /\>[\r\n\ \t]+\</g, "><" );
			var vlist = [];
			var vtags = v.split(/\</g);
			for(var i=0;i<vtags.length;i++){if(vtags[i]){
				vtags[i] = "<"+vtags[i];
				var vtags2 = vtags[i].split(/\>/g);
				for(var j=0;j<vtags2.length;j++){if(vtags2[j]){
					if( vtags2[j].substr(0,1) == "<" ){
						if( vtags2[j].indexOf(" ") > 0 ){
							var kk = vtags2[j].match(/\<[a-zA-Z0-9\-\_\:]+/);
							if( kk ){
								if( vtags2[j].substr( vtags2[j].length-1, 1 ) == "/" ){
									vtags2[j] = kk[0]+"/";
								}else{
									vtags2[j] = kk[0];
								}
							}
						}
						vtags2[j] = vtags2[j]+">";
					}
					vlist.push( vtags2[j] );
				}}
			}}
			for(var j=0;j<vlist.length;j++){
				if( vlist[j].substr(0,2) == "</" ){
					var vt = vlist[j].match( /\<\/(.*?)\>/ );
					if( vt ){
						vlist[j] = {
						"t": "close",
						"tag": vt[1],
						};
					}
				}else if( vlist[j].substr(0, 1) == "<" ){
					var vt = vlist[j].match( /\<(.*?)\>/ );
					if( vt ){
						if( vlist[j].substr( vlist[j].length-2, 2 ) == "/>" ){
							vlist[j] = {
							"t": "tag",
							"tag": vt[1].substr(0, vt[1].length-1 ),
							};
						}else{
							vlist[j] = {
							"t": "open",
							"tag": vt[1],
							};
						}
					}
				}else{
					vlist[j] = {
						"t": "text",
						"v": vlist[j]
					};
				}
			}
			for(var j=0;j<vlist.length;j++){
				if( vlist[j].hasOwnProperty('t') ){
					if( vlist[j]['t'] == "tag" ){
						var k = {};
						k[ vlist[ j ][ 'tag' ] ] = "";
						vlist[j] = k;
					}
				}
			}
			for(var j=0;j<vlist.length-2;j++){
				if( vlist[j].hasOwnProperty('t') && vlist[j+1].hasOwnProperty('t') && vlist[j+2].hasOwnProperty('t') ){
					if( vlist[j]['t'] == "open" && vlist[j+1]['t'] == "text" && vlist[j+2]['t'] == "close" ){
						var k = {};
						k[ vlist[j][ 'tag' ] ] = vlist[j+1]['v'];
						vlist[j] = k;
						vlist.splice( j+1, 2 );
					}
				}
			}
			for(var jj=0;jj<20;jj++){
			for(var j=0;j<vlist.length-2;j++){
				if( vlist[j].hasOwnProperty("t") ){
					if( vlist[j]['t'] == "open" ){
						var ind = 0;
						for(var k=j+1;k<vlist.length;k++){
							if( vlist[k].hasOwnProperty("t") ){
								if( vlist[k]['t'] == "open" ){
									break;
								}
								if( vlist[k]['t'] == "close" ){
									ind = k;
									break;
								}
							}
						}
						if( ind ){
							var d = {};
							for(var k=j+1;k<ind;k++){
								for( var kk in vlist[k] ){
									d[ kk ] = vlist[k][kk];
								}
							}
							var k = {};
							k[ vlist[j]['tag'] ] = d;
							vlist[j] = k;
							vlist.splice(j+1, ind-j );
						}
					}
				}
			}
			}
			var es = this.xml_to_array_isclean__( vlist[0] );
			if( es ){
				alert("Data format incorrect!");
				return false;
			}
			return vlist[0];
		},
		xml_to_array_isclean__: function( vlist ){
			if( typeof(vlist) == "object" ){
				if( vlist.hasOwnProperty("t") ){
					return true;
				}else if( vlist.hasOwnProperty("length") ){
					for(var i=0;i<vlist.length;i++){
						var es = this.xml_to_array_isclean__( vlist[i] );
						if( es ){
							return true;
						}
					}
				}else{
					for(var i in vlist ){
						var es = this.xml_to_array_isclean__(vlist[i]);
						if( es ){
							return true;
						}
					}
				}
			}
			return false;
		},
		make_object_body__: function( v, prefix = "" ){
			if( "length" in v ){
				var vv = []
				for(var i=0;i<v.length;i++){
					if( typeof( v[i] ) == "string" ){
						vv[i] = {
							"vtype": "static",
							"type": "text",
							"value": v[i]+"",
							"a": "",
							"sub": {},
						};
					}else if( typeof( v[i] ) == "number" ){
						vvv[i] = {
							"vtype": "static",
							"type": "number",
							"value": v[i],
							"a": "",
							"sub": {},
						};;
					}else if( typeof( v[i] ) == "object" && "length" in v[i] == false ){
						vv[i] = {
							"vtype": "static",
							"type": "dict",
							"value": "",
							"a": "",
							"sub": this.make_object_body__( v[i], prefix + " " +i ),
						};
					}else if( typeof( v[i] ) == "object" && "length" in v[i] ){
						vv[i] = {
							"vtype": "static",
							"type": "list",
							"value": "",
							"a": "",
							"sub": this.make_object_body__( v[i], prefix + " " +i ),
						};
					}else if( typeof( v[i] ) == "boolean" ){
						vv[i] = {
							"vtype": "static",
							"type": "boolean",
							"value": v[i],
							"a": "",
							"sub": {},
						};
					}else{
						vv[i] = {
							"name": i+"",
							"vtype": "static",
							"type": "text",
							"value": "Error",
							"a": "",
							"sub": {},
						};
					}
				}
			}else{
				var vv = {}
				for( var i in v ){
					if( typeof(v[i]) == "object" ){
						if( "length" in v[i] ){
							vv[i] = {
								"name": i+"",
								"vtype": "static",
								"type": "list",
								"value": "",
								"a": "",
								"sub": this.make_object_body__( v[i], prefix + " " +i ),
							};
						}else{
							vv[i] = {
								"name": i+"",
								"vtype": "static",
								"type": "dict",
								"value": "",
								"a": "",
								"sub": this.make_object_body__( v[i], prefix + " " +i ),
							};
						}
					}else if( typeof(v[i]) == "string" ){
						vv[i] = {
							"name": i+"",
							"vtype": "static",
							"type": "text",
							"value": v[i]+"",
							"a": "",
							"sub": {
							}
						};
					}else if( typeof(v[i]) == "number" ){
						vv[i] = {
							"name": i+"",
							"vtype": "static",
							"type": "number",
							"value": v[i],
							"a": "",
							"sub": {
							}
						};
					}else if( typeof(v[i]) == "boolean" ){
						vv[i] = {
							"name": i+"",
							"vtype": "static",
							"type": "boolean",
							"value": v[i],
							"a": "",
							"sub": {
							}
						};
					}
				}
			}
			return vv;
		},
		set_flag__: function( v, n ){
			this.flags__[  v+n ] =  true ;
		},
		get_flag__: function( v, n ){
			if( this.flags__.hasOwnProperty(v+n) ){
				return true;
			}else{
				return false;
			}
		},
		unset_flag__: function( v, n ){
			if( this.flags__.hasOwnProperty(v+n) ){
				delete this.flags__[  v+n  ];
			}
		},
	}
});

<?php foreach( $components as $i=>$j ){ ?>
	app.component( "<?=$j ?>", <?=$j ?> );
<?php } ?>
app.mount("#app");

</script>