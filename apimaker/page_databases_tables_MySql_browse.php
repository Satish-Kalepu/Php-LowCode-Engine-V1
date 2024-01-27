<style type="text/css">
	.importpopup{ position: fixed; top:100px; left:100px;z-index: 1050; width:calc(100% - 200px);height:calc(100% - 200px); box-shadow: 5px 5px 10px #999; border:1px solid #dee2e6; background-color: white; }
	.importhead{padding:5px;background-color: #f0f0f0; }
	.importbody{padding:10px;height: calc( 100% - 90px);overflow:auto }
	.importfooter{height:50px; }
	.form_popup{
		position:absolute;
		top:50px;
		box-shadow:3px 3px 6px black;
		background-color: white;
		width:70%;	
		border:1px solid #cdcdcd;
		margin: 5% auto 15% auto;
		z-index:2;		
	}
	.popup_card {width: 100%;height: 500px;overflow: auto;}
	.home_main >.table>thead>tr>td {position: -webkit-sticky;position: sticky;top: -1px;z-index: 2;background-color: white;}
	.home_main>.table>thead td {
		border-top: none !important;
		border-bottom: none !important;
		box-shadow: inset 0 2px 0 #cdcdcd,
		            inset 0 -1px 0 #cdcdcd;
		padding:6px
	}
	.home_main::-webkit-scrollbar-track {background: #bbb;}
	.home_main::-webkit-scrollbar {width: 5px;height: 10px;}
	.home_main::-webkit-scrollbar-thumb {background: #666;-webkit-width:5;-webkit-height:5;}
	.home_main::-webkit-scrollbar-thumb:hover {background: #111;}
	.home_main{overflow-y: auto; height: calc(100% - 200px); }
	
</style>
<div id="db_list_app" >
	<div v-if="error" class="alert alert-danger" >{{ error }}</div>
	<div v-if="SuccessMsg" class="alert alert-success" >{{ SuccessMsg }}</div>
	<table width="100%">
		<tr>
		<td>
			<table>
				<tr>
					<td>
						<select v-model="search_index" class="form-control form-control-sm" style="width:150px;display:inline;" v-on:change="change_index">
							<option v-for="v,indexname in table['source_schema']['keys']" v-bind:value="indexname">{{ indexname }}</option>
						</select>
					</td>
					<td>
						<table v-if="index_search.length>0">
							<tr v-for="kd,ki in index_search">
								<td><span style="padding: 0px 10px;" >{{ kd['field'] }}</span></td>
								<td>
									<select v-model="kd['c']" class="form-control form-control-sm" style="width:70px;display:inline;">
										<option v-for="f,i in filters" v-bind:value="i" >{{f}}</option>
									</select>
								</td>
								<td>
									<template v-if="kd['c']!='><'">
										<input v-bind:type="kd['type']" autocomplete="off" v-model="kd['v']" placeholder="Search" v-bind:class="{'form-control form-control-sm':true,'border-danger':bv}"  style="width:150px;display:inline;" >
									</template>
									<template v-else>
										<input v-bind:type="kd['type']" autocomplete="off" v-model="kd['v']" placeholder="From" v-bind:class="{'form-control form-control-sm':true,'border-danger':bv}"  style="width:80px;display:inline;" >
										<input v-bind:type="kd['type']" autocomplete="off" v-model="kd['v2']" placeholder="To" v-bind:class="{'form-control form-control-sm':true,'border-danger':bv2}"  style="width:80px;display:inline;" >
									</template>
								</td>
								<td>
									<select v-model="kd['sort']" class="form-control form-control-sm" style="width:60px;" >
										<option value="asc" >Asc</option>
										<option value="desc" >Desc</option>
									</select>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<input type="number" v-model="limit" class="form-control form-control-sm"  style="width:80px;" >
					</td>
					<td>
						<button class="btn btn-sm btn-success" v-on:click="search_filter_cond">Search</button>
					</td>
				</tr>
			</table>
		</td>
		<td width="100">
			<select v-model="selected_schema" v-on:change="search_filter_cond" >
				<option v-for="vs,vi in table['schema']" v-bind:value="vi" >{{ vs['name'] }}</option>
			</select>
		</td>
		</tr>
	</table>
	<div class="home_main table-responsive" >
		<table class="table table-hover table-striped table-sm"  >
			<thead>
				<tr>
					<td  v-for="ff,fi in table['schema'][selected_schema]['fields']"  >{{ fi }}</td>
				</tr>
			</thead>
			<tbody>
				<tr v-for="dd,di in data_list" class="content" >
					<td class="text-nowrap" v-for="ff,fi in table['schema'][selected_schema]['fields']" ><pre>{{ dd[ fi ] }}</pre></td>
				</tr>
			</tbody>
		</table>
	</div>
	<button v-for="v in current_page" class="btn btn-default btn-sm" v-on:click="goto_page(v)" >{{ v }}</button>
	<button v-if="current_page<pages" class="btn btn-default btn-sm" v-on:click="load_next" >Next</button>
</div>
<script type="text/javascript">
<?php
	include("page_databases_tables_mysql_edit.js");
?>
	var db_list_app = new Vue({
		"el"	: "#db_list_app",
		"data"	: {
			"data_list"		: [],
			"table"			: <?=json_encode($table,JSON_PRETTY_PRINT) ?>,
			"selected_schema"	: "default",
			"search_index"		: "PRIMARY",
			"index_search"		: [],
			"av"			: false,
			"av2"			: false,
			"bv"			: false,
			"bv2"			: false,
			"limit"			: 50,
			"pages":  0,
			"total":  0,
			"current_page": 1,
			"error"			: "",
			"SuccessMsg"		: "",
			"show_add"		: false,
			"add_record"		: {},
			"add_record2"		: {},
			"new_record"		: {},
			"edit_status"		: "",
			"edit_record_index" 	: -1,
			"delete_record_index"	: -1,
			"edit_mode"		: "new",
			"permission_to_update"	: false,
			"editdata"		: [],
			"current_data"		: {},
			"last_key"		: false,
			"found_more"		: false,
			"count" 		: 0,
			"sort"			: "desc",
			"first_page"		: false,
			"Edit_Tab"		: 'schema',
			"total_cnt"		: "<?=$total_cnt?$total_cnt:0 ?>",
			"selected_all"		: "",
			"D_Rs"			: [],
			"show_delete"		: "",
			"filters"	  	: {"="	: "=","!=": "!=","<" : "<","<="	: "<=",">": ">",">=": ">=","><"	: "><","^." : "^..."},
		},
		watch:{
		  	D_Rs:function(){
				if( this.D_Rs.length > 0 ){
					this.show_delete = true;
				}
			}
		},
		mounted : function(){
			setTimeout(this.change_index,500);
			setTimeout(this.load_records,1500);
		},
		methods : {
			echo__: function(v__){
				if( typeof(v__) == "object" ){
					console.log( JSON.stringify(v__,null,4) );
				}else{
					console.log( v__ );
				}
			},
			Select_all:function(){
				if(this.selected_all == false){
					this.selected_all = true;
					this.show_delete = true;
					v = [];
					for(i in this.data_list){
						v.push(i);
					}
					this.D_Rs = v;
				}else{
					this.selected_all = false;
					this.show_delete = false;
					this.D_Rs =[];
				}
			},
			delete_record:function( vi ){
				this.delete_record_index = vi;
				if(confirm("Are you sure you want to delete")){
					var rk = {};
					var rec = this.data_list[ this.delete_record_index ];
					rk = rec["_id"];
					var vd__ = {
							"action"		: "delete_record",
							"db_id"			: this.table['db_id'], 
							"table_id"		: this.table['_id'] ,
							"record_id"		: rk,
						};
					axios.post( "?", vd__ ).then(response=>{
						if(response.data.hasOwnProperty("status")){
							var vdata = response.data;
							if(vdata['status'] == "success"){
								this.data_list.splice(this.delete_record_index,1);
								this.delete_record_index = -1;
								this.SuccessMsg = "Deleted Succesfully";
								setTimeout( function(v){v.SuccessMsg = ''},1000,this );
							}else{
								this.error = vdata['details'];
							}
						}else{
						        console.log("error");
						        console.log(response.data);
						}
					});
				}
			},
			Delete_Record_Multi:function(){
				if( confirm("Are You Sure To Delete This Record") ){
					var d = {};
					for( i in this.D_Rs){
						d[i] = this.data_list[i];
					}
					var vd__ = {
							"action"		: "delete_record_multiple",
							"table_id"		: this.table['_id'],
							"record"		: d,
						};
					axios.post( "?", vd__ ).then(response=>{
						if(response.data.hasOwnProperty("status")){
							var vdata = response.data;
							if(vdata['status'] == "success"){
								this.Successmsg = "deleted Successfully"; 
								document.location.reload();	
							}else{
								this.ErrorMsg = vdata['details'];
							}
						}else{
						        console.log("error");
						        console.log(response.data);
						}
					});
				}
			},
			get_type: function( v ){
				if( this.search_index in this.table['source_schema']['keys'] ){
					if( v == "a" ){
						return this.table['source_schema']['keys'][ this.search_index ]['pk']['type']+'';
					}else if( v == "b" ){
						return this.table['source_schema']['keys'][ this.search_index ]['sk']['type']+'';
					}else{
						return "text";
					}
				}else{
					return "text";
				}
			},
			toggle_edit_tab: function( v ){
				this.Edit_Tab = v+'';
			},
			change_index: function(){
				if( this.search_index in this.table['source_schema']['keys'] ){
					var k = [];
					for(var key in this.table['source_schema']['keys'][ this.search_index ]['keys'] ){
						var j = this.table['source_schema']['keys'][ this.search_index ]['keys'][ key ];
						k.push({
							"field": key+'',
							"type": j['type']+'',
							"cond": "=",
							"v": "",
							"v2": "",
							"sort": "asc",
						});
					}
					this.index_search = k;
				}
			},
			prev: function(){
				this.current_fields_id--;
			},
			next: function(){
				this.current_fields_id++;
			},
			search_filter_cond:function(v){
				this.current_page = 1;
				this.data_list = [];
				this.load_records();
			},
			reset_filter:function(v){
				this.current_page = 1;
				this.data_list = [];
				this.load_records();
			},
			goto_page: function(vi){
				this.current_page = Number(vi);
				this.load_records();
			},
			load_next: function(){
				if( Number( this.current_page ) < Number( this.pages ) ){
					this.current_page = Number(this.current_page)+1;
					this.load_records();
				}
			},
			load_prev: function(){
				if( Number( this.current_page ) > 2 ){
					this.current_page = Number(this.current_page)-1;
					this.load_records();
				}
			},
			load_records: function(){
				var v = {
					"action"		:"load_mysql_records",
					"db_id"			: this.table['db_id'],
					"table_id"		: this.table['_id'],
					"limit"			: this.limit,
					"p"			: this.current_page,
					"search_index"		: this.search_index,
					"index_search"		: this.index_search,
					"schema": this.selected_schema
				};
				axios.post("?",v).then(response=>{
					if( response.data.hasOwnProperty("status") ){
						var vdata = response.data;
						if( vdata['status'] == "success" ){
							this.data_list = vdata['details']['records'];
							this.pages = Number(vdata['details']['pages']);
						}else{
							this.error = vdata['details'];
						}
					}else{
						console.log("error");
						console.log(response.data);
					}
				});
			},
			edit_record: function( vid__ ){
				var vfield__ =  JSON.parse(JSON.stringify(this.table['schema'][ this.selected_schema ]['fields']));
				var vdata__ =  JSON.parse(JSON.stringify(this.data_list[vid__]));
				this.edit_record_index = vid__;
				this.edit_mode = "edit";
				this.add_record2 = JSON.stringify(this.create_json_template(vfield__,vdata__),null,4).replace(/[\ ]{4}/g, "\t");
				this.add_record = JSON.parse( JSON.stringify( this.create_field_template_edit(vfield__,vdata__) ) );
				this.show_add = true;
			},
			add_record_now: function(){
				this.edit_record_index = -1;
				this.edit_mode = "new";
				var vfield__ =  JSON.parse(JSON.stringify(this.table['schema'][ this.selected_schema ]['fields']));
				this.add_record2 = JSON.stringify(this.create_json_template( vfield__ ,{} ),null,4).replace(/[\ ]{4}/g, "\t");
				this.add_record = JSON.parse( JSON.stringify( this.create_field_template_edit(vfield__, {} ) ) );
				this.show_add = true;
			},
			create_json_template( vfields__,vdata__ ){
				var d = {};
				for( var field__ in vfields__ ){
					if( vfields__[field__]['type'] == "dict" ){
						v1 = [];
						for( i__ in vdata__[field__] ){
							v1.push(this.create_json_template( vfields__[field__]['sub'] ,vdata__[field__][i__] ) );
						}
						d[field__+''] = v1 ;
					}else if( vfields__[field__]['type'] == "list" ){
						d[field__+''] = this.create_json_template( vfields__[field__]['sub'] ,vdata__[field__] );
					}else if( vfields__[field__]['type'] == "text" ){
						d[field__+''] =( vdata__[field__] != "" && vdata__[field__] != undefined)?vdata__[field__]:'';
					}else if( vfields__[field__]['type'] == "number" ){
						if( vdata__[field__] != "" && vdata__[field__] != undefined){
							try{
								if( typeof(vdata__[field__]) == "string" ){
									if( vdata__[field__].match(/^[0-9\.]+$/)){
										vdata__[field__] = Number(vdata__[field__]);
									}else{
										vdata__[field__] = 0;
									}
								}else{
									vdata__[field__] = vdata__[field__];
								}
							}catch(e){
								console.log("errro : " +  e);
							}
						}else{
							vdata__[field__] = 0;
						}
						d[field__+''] = vdata__[field__];
					}else if( vfields__[field__]['type'] == "boolean" ){
						d[field__+''] =( vdata__[field__] != "" && vdata__[field__] != undefined)?vdata__[field__]:'';
					}
				}
				return d;
			},
			create_field_template_edit(vfields__,vdata__){
				for( var i in vfields__ ){
					if( vfields__[i]['type'] == "dict" ){
						if( vdata__.hasOwnProperty(i) == false ){
							vdata__[i] = {};
						}
						vfields__[i]['data'] = this.create_field_template_edit( vfields__[i]['sub'],vdata__[i] );
					}else if( vfields__[i]['type'] == "list" ){
						vfields__[i]['data'] = [];
						if( vdata__.hasOwnProperty(i) == false ){
							vdata__[i] = [];
						}
						for(var jj=0;jj<vdata__[i].length;jj++){
							var vp = {};
							for( var j=0;j<vfields__[i]['sub'].length;j++ ){
								vp = this.create_field_template_edit( JSON.parse( JSON.stringify( vfields__[i]['sub'][0] )) ,vdata__[i][jj] );
							}
							vfields__[i]['data'].push(vp);
						}
					}else{
						if( vdata__.hasOwnProperty(i) == false ){
							vdata__[i] = '';
						}
						vfields__[i]['data'] = vdata__[i];
					}
				}
				return vfields__;
			},
			create_field_template: function( vfields__ ){
				for( var i in vfields__ ){
					if( vfields__[i]['type'] == "dict" ){
						vfields__[i]['sub'] = this.create_field_template( vfields__[i]['sub'] );
					}else if( vfields__[i]['type'] == "list" ){
						vfields__[i]['data'] = [];
						for( var j=0;j<vfields__[i]['sub'].length;j++ ){
							vfields__[i]['data'][j] = this.create_field_template( vfields__[i]['sub'][j] );
						}
					}else{
						vfields__[i]['data'] = "";
					}
				}
				return vfields__;
			},
			create_data_template: function( vdata__ ){
				for( var i in vdata__ ){
					if( vdata__[i]['type'] == "dict" ){
						vdata__[i] = this.create_data_template( vdata__[i]['data'] )
					}else if( vdata__[i]['type'] == "list" ){
						var v = [];
						for( var vsubi = 0;vsubi<vdata__[i]['data'].length;vsubi++){
							v.push( this.create_data_template( vdata__[i]['data'][vsubi] ) );
						}
						vdata__[i] = v;
					}else{
						if( vdata__[i]['type'] == "number" ){
							if( 'data' in vdata__[i] ){
								try{
									if( typeof(vdata__[i]['data']) == "string" ){
										if( vdata__[i]['data'].match(/^[0-9\.]+$/)){
											vdata__[i] = Number(vdata__[i]['data']);
										}else{
											vdata__[i] = 0;
										}
									}else{
										vdata__[i] = vdata__[i]['data'];
									}
								}catch(e){
									console.log("errro : " +  e);
									this.echo__( vdata__[i]['data'] );
								}
							}else{
								vdata__[i]['data'] = 0;
							}
						}else{
							vdata__[i] = vdata__[i]['data']+'';
						}
					}
				}
				return vdata__;
			},
			validate_json: function(tf, jf, p = ""){
				for(var f in tf ){
					if( f in jf == false && tf[f]['m'] == true ){
						if( p == "" ){

						}else{
							this.error = "Field `" + p+f + "` is required!";
							return true;
						}
					}else if( f in jf ){
						var vt = typeof( jf[f] );
						if( vt == "string" ){ vt = "text";}
						if( vt == "number" ){ vt = "number";}
						if( vt == "object" && 'length' in jf[f] ){ vt = "list";}
						if( vt == "object" && 'length' in jf[f] == false ){ vt = "dict";}
						if( vt != tf[f]['type'] ){
							this.error = "Field `"+ p+f +"` should be " + tf[f]['type'];
							return true;
						}
						if( vt == "dict" ){
							if( this.validate_json( tf[f]['sub'], jf[f], p+f+"." ) ){
								return true;
							}
						}else if( vt == "list" ){
							for(var i=0;i<jf[f].length;i++){
								if( this.validate_json( tf[f]['sub'][0], jf[f][i], p+f+"["+i+"]." ) ){
									return true;
								}
							}
						}
					}
				}
				return false;
			},
			save_data: function(){
				this.error = "";
				this.edit_status = "";
				if( this.Edit_Tab == "json" ){
					var v = this.add_record2+''
					v = v.replace(/\,[\r\n\ \t]*\}/g, "}");
					v = v.replace(/\,[\r\n\ \t]*\]/g, "]");
					try{
						var new_record = JSON.parse( v );
						var v = this.validate_json(this.table['schema'][ this.selected_schema ]['fields'],new_record);
						this.new_record = new_record;
						if( v ){
							this.SuccessMsg = "";
							return false;
						}
					}catch(e){
						this.error = "Error in json: " + e
						return false;
					}
				}else{
					this.new_record = this.create_data_template( JSON.parse(JSON.stringify(this.add_record)) );
				}
				console.log( this.new_record );
				if( 1 == 1){
					if(this.edit_mode == "edit"){
						var record_id = this.data_list[ this.edit_record_index ]["_id"];
					}else{
						var record_id = "new";
					}
					vpost_data = {
						"action"		: "update_record",
						'record'		: this.new_record,
						'record_id'		: record_id,
						"db_id"			: this.table['db_id'],
						"table_id"		: this.table['_id'],
						"record_index" 		: this.edit_record_index,
						"edit_mode"		: this.edit_mode,
					};
					axios.post("?",vpost_data ).then(response => {
						if( response.data.hasOwnProperty("status") ){
							vdata = response.data;
							if( vdata["status"] == "success" ){
								//this.show_add = false;
								if( this.edit_mode == "new" ){
									this.data_list.splice(0, 0, JSON.parse( JSON.stringify( vdata["details"] ) ) );
									this.edit_status = "Record Inserted";
								}else{
									this.$set( this.data_list, this.edit_record_index, JSON.parse( JSON.stringify( vdata["details"] ) ) );
									this.edit_status = "Record Updated";
								}
								this.SuccessMsg = this.edit_status;
								setTimeout( function(v){v.SuccessMsg = ''},500,this );
							}else if( vdata['details'] == "Record already Exists" ){
								this.error = response.data['details'];
								if( this.edit_mode == "new" ){
									this.permission_to_update = true;
								}
							}else{
								this.error = response.data['details'];
							}
						}else{
							console.log("error");
							console.log(response.data);
						}
					});
				}
			},
			ucwords( v ){
				if( v != '' ){
					var str = v.replace( /[\\~\!\@\#\$\%\^\&\*\(\)\_\-\+\=\{\}\[\]\\\|\;\:\"\'\,\.\/\<\>\?\t\r\n]+/g, " " );
					str = str.replace( /[\ ]{2,10}/g, " ");
					str = str.trim();
					return (str + '').replace(/^(.)|\s+(.)/g, function ($1){return $1.toUpperCase()})
				}
			},
		}
	});
</script>
