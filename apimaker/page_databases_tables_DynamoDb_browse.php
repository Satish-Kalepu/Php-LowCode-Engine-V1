<style type="text/css">
	.form_popup{
		position:absolute;
		top:50px;
		left:90px;
		box-shadow:3px 3px 6px black;
		background-color: white;
		width:85%;	
		border:1px solid #cdcdcd;
		margin:auto;
		margin-bottom: 20px;
		z-index:2;		
	}
	#popup_card{width:80%;height:50%;overflow:auto}
	.home_main >.table>thead>tr>td {position: -webkit-sticky;position: sticky;top: -1px;z-index: 2;background-color: white;}
	.home_main>.table>thead td {
		border-top: none !important;
		border-bottom: none !important;
		box-shadow: inset 0 2px 0 #cdcdcd,
		            inset 0 -1px 0 #cdcdcd;
		padding:6px
	}
	.home_main::-webkit-scrollbar-track {background: #f1f1f1;}
	.home_main::-webkit-scrollbar {width: 5px;height: 10px;}
	.home_main::-webkit-scrollbar-thumb {background: #88888838;-webkit-width:5;-webkit-height:5;}
	.home_main::-webkit-scrollbar-thumb:hover {background: #555;}
	.home_main{overflow-y: auto; height: calc(100% - 350px); }
	
</style>
<div id="db_list_app" >
	<input type="hidden" id="security_token" value="<?=get_new_token( 'database_dynamodb_browse',$config_param3 )?>">
	<div>
	<table width="100%">
		<tr>
		<td>
			<table>
				<tr>
					<td>
						<select v-model="s['t']" class="form-control form-control-sm" style="width:100px;display:inline;" >
							<option value="scan">Scan</option>
							<option value="query">Query</option>
						</select>
					</td>
					<td>
						<select v-model="s['i']" class="form-control form-control-sm" style="width:150px;display:inline;" v-on:change="change_index">
							<option value="i_p">Primary Index</option>
							<option v-for="v,indexname in table['keys']" v-bind:value="indexname">{{ indexname }}</option>
						</select>
					</td>
					<td v-if="s['t']=='query'">
						<div v-if="s['i']=='i_p'">
							<table>
								<tr>
									<td><span style="padding: 0px 10px;" >{{ table['pk']['field'] }} = </span></td>
									<td>
										<select v-model="s['a']['c']" class="form-control form-control-sm" style="width:70px;display:inline;">
											<option value="=" >=</option>
										</select>
									</td>
									<td>
										<input v-bind:type="get_type('a')" autocomplete="off" v-model="s['a']['v']" placeholder="Search"  v-bind:class="{'form-control form-control-sm':true,'border-danger':av}"  style="width:150px;display:inline;" >
									</td>
								</tr>
								<tr v-if="table['sk']['enable']">
									<td><span style="padding: 0px 10px;" >{{ table['sk']['field'] }} = </span></td>
									<td>
										<select v-model="s['b']['c']" class="form-control form-control-sm" style="width:70px;display:inline;">
											<option v-for="f,i in filters" v-bind:value="i" >{{ f }}</option>
										</select>
									</td>
									<td>
										<template v-if="s['b']['c']!='><'">
											<input v-bind:type="get_type('b')" autocomplete="off" v-model="s['b']['v']" placeholder="Search"  v-bind:class="{'form-control form-control-sm':true,'border-danger':av}"  style="width:150px;display:inline;" >
										</template>
										<template v-else>
											<input v-bind:type="get_type('b')" autocomplete="off" v-model="s['b']['v']" placeholder="From"  v-bind:class="{'form-control form-control-sm':true,'border-danger':av}"  style="width:80px;display:inline;" >
											<input v-bind:type="get_type('b')" autocomplete="off" v-model="s['b']['v2']" placeholder="To"  v-bind:class="{'form-control form-control-sm':true,'border-danger':av2}"  style="width:80px;display:inline;" >
										</template>
									</td>
								</tr>
							</table>
						</div>
						<div v-else-if="s['i'] in table['keys']">
							<div>
								<table>
									<tr>
										<td><span style="padding: 0px 10px;" >{{ table['keys'][ s['i'] ]['pk']['field'].replace(".","->") }}</span></td>
										<td>
											<select v-model="s['a']['c']" class="form-control form-control-sm" style="width:70px;display:inline;">
												<option value="=" >=</option>
											</select>
										</td>
										<td>
											<input v-bind:type="get_type('a')" autocomplete="off" v-model="s['a']['v']" placeholder="Search" v-bind:class="{'form-control form-control-sm':true,'border-danger':av}" style="width:150px;display:inline;" >
										</td>
									</tr>
								</table>
							</div>
							<div v-if="table['keys'][ s['i'] ]['sk']['enable']">
								<table>
									<tr>
										<td><span style="padding: 0px 10px;" >{{ table['keys'][ s['i'] ]['sk']['field'].replace(".","->") }}</span></td>
										<td>
											<select v-model="s['b']['c']" class="form-control form-control-sm" style="width:70px;display:inline;">
												<option v-for="f,i in filters" v-bind:value="i" >{{f}}</option>
											</select>
										</td>
										<td>
											<template v-if="s['b']['c']!='><'">
												<input v-bind:type="get_type('b')" autocomplete="off" v-model="s['b']['v']" placeholder="Search" v-bind:class="{'form-control form-control-sm':true,'border-danger':bv}"  style="width:150px;display:inline;" >
											</template>
											<template v-else>
												<input v-bind:type="get_type('b')" autocomplete="off" v-model="s['b']['v']" placeholder="From" v-bind:class="{'form-control form-control-sm':true,'border-danger':bv}"  style="width:80px;display:inline;" >
												<input v-bind:type="get_type('b')" autocomplete="off" v-model="s['b']['v2']" placeholder="To" v-bind:class="{'form-control form-control-sm':true,'border-danger':bv2}"  style="width:80px;display:inline;" >
											</template>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</td>
					<td>
						<select v-model="s['sort']" class="form-control form-control-sm" style="width:100px;display:inline;">
							<option value="asc" >Ascending</option>
							<option value="desc" >Descending</option>
						</select>
						<button class="btn btn-sm btn-success" v-on:click="search_filter_cond">Search</button>
					</td>
				</tr>
			</table>
		</td>
		<td width="100">
			<select v-model="selected_schema" >
				<option v-for="vs,vi in table['schema']" v-bind:value="vi" >{{ vs['name'] }}</option>
			</select>
		</td>
		<td width="100">
			<button class="btn btn-sm btn-success" v-on:click="add_record_now">Add Record</button>
		</td>
		</tr>
	</table>
	</div>
	<div class="home_main table-responsive" >
		<table class="table table-hover table-striped table-sm"  >
			<thead>
				<tr>
					<td nowrap class="sticky_column nowrap">
						Select all: <input type="checkbox" v-model="selected_all" v-on:click="Select_all">
						<i class="fa fa-trash text-danger" v-on:click="Delete_Record_Multi" v-if="show_delete"></i>
					</td>
					<td  v-for="ff,fi in table['schema'][selected_schema]['fields']"  >{{ ff['name'] }}</td>
				</tr>
			</thead>
			<tbody>
				<tr v-for="dd,di in data_list" class="content" >
					<td  class="sticky_column text-nowrap">
						<input type="checkbox" :value="dd" v-model="D_Rs" >
						<i class="fa fa-edit text-success"  v-on:click="edit_record( di )" title="Edit"></i>
						<i class="fa fa-trash text-danger"  v-on:click="delete_record( di )" title="Delete"></i>
					</td>
					<td class="text-nowrap" v-for="ff,fi in table['schema'][selected_schema]['fields']" ><pre>{{dd[ fi ]}}</pre></td>
				</tr>
			</tbody>
		</table>
	</div>
	<button v-if="found_more" class="btn btn-info btn-sm float-end" v-on:click="load_more" >Load More</button>
	<div v-if="show_add" class="form_popup">
		<div class="card popup_card">
			<div class="card-header text-center text-info" style="font-size: 25px;">
				{{edit_mode == "new"?"Add Data":"Edit Data"}}
				<button class="btn btn-sm btn-danger float-end mt-2" v-on:click="show_add=false" >&times</button>
			</div>
			<div class="card-body">
				<table_mongodb_edit_record v-bind:schema="add_record"></table_mongodb_edit_record>
			</div>
		</div>
		<div class="mb-1 text-center">
			<button v-if="edit_mode=='new'" class="btn btn-sm btn-success mt-2" v-on:click="save_data('new')">Insert</button>
			<button v-if="edit_mode=='edit'" class="btn btn-sm btn-success mt-2" v-on:click="save_data('edit')">Update</button>
			<div v-if="permission_to_update" >Record already exists! Do you want to update? <button class="btn btn-sm btn-success mt-2" v-on:click="edit_mode='edit';permission_to_update=false;error=''">Yes</button> </div>
			<div v-if="error" class="alert alert-danger" >{{ error }}</div>
			<div v-if="edit_status" class="alert alert-success" >{{ edit_status }}</div>
		</div>
	</div>
</div>
<script type="text/javascript">
<?php 	include("apps/apis_table_mongodb_edit_record.js");?>
	var db_list_app = new Vue({
		"el"	: "#db_list_app",
		"data"	: {
			"data_list"		: [],
			"table"			: <?=json_encode($table,JSON_PRETTY_PRINT) ?>,
			"selected_schema"	: "default",
			"s" 			: {"t": "scan","sort": "asc","i": "i_p","a":{"f":"","c":"=","v":"", "v2":""},"b":{"f":"","c":"=","v":"", "v2":""}},
			"av"			: false,
			"av2"			: false,
			"bv"			: false,
			"bv2"			: false,
			"limit"			: 3000,
			"error"			: "",
			"show_add"		: false,
			"add_record"		: {},
			"new_record"		: {},
			"edit_status"		: "",
			"edit_record_index" 	: -1,
			"delete_record_index"	: -1,
			"edit_mode"	: "new",
			"permission_to_update"	: false,
			"editdata"		: [],
			"current_data"		: {},
			"last_key"		: false,
			"found_more"		: false,
			"count" 		: 0,
			"sort"			: "desc",
			"first_page"		: false,
			"selected_all"		: "",
			"D_Rs"			: [],
			"show_delete"		: "",
			"filters"	  	: {"="	: "=","!=": "!=","<" : "<","<="	: "<=",">": ">",">=": ">=","><"	: "><","^." : "^..."},
		},
		watch:{
		  	D_Rs:function(){
				if( this.D_Rs.length >  0){
					this.show_delete = true;
				}
			}
		},
		mounted : function(){
			this.load_records();
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
						v.push( this.data_list[i] );
					}
					this.D_Rs = v;
				}else{
					this.selected_all = false;
					this.show_delete = false;
					this.D_Rs =[];
				}
			},
			Delete_Record_Multi:function(){
				if( confirm("Are You Sure To Delete This Record") ){
					var d = {};
					for( vi in this.D_Rs){
						var rk = {};
						var rec = this.D_Rs[ vi ];
						rk[ this.table['pk']['field'] ] = rec[ this.table['pk']['field'] ];
						if( this.table['sk']['enable'] ){
							rk[ this.table['sk']['field'] ] = rec[ this.table['sk']['field'] ];
						}
						d[ vi ] = rk;
					}
					var vd__ = {
							"action"		: "delete_record_multiple",
							"table_id"		: this.table['_id'] ,
							"record"		: d,
							"security_token"	: $("#security_token").val(),
						   };
					axios.post( "?" , vd__ ).then(response=>{
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
			delete_record:function( vi ){
				this.delete_record_index = vi;
				if(confirm("Are you sure you want to delate")){
					var rk = {};
					var rec = this.data_list[ this.delete_record_index ];
					rk[ this.table['pk']['field'] ] = rec[ this.table['pk']['field'] ];
					if( this.table['sk']['enable'] ){
						rk[ this.table['sk']['field'] ] = rec[ this.table['sk']['field'] ];
					}
					var vd__ = {
							"action"		: "delete_record",
							"db_id"			: this.table['db_id'], 
							"table_id"		: this.table['_id'] ,
							"record_key"		: rk ,
							"security_token"	: $("#security_token").val(),
						   };
					axios.post( "?" , vd__ ).then(response=>{
						if(response.data.hasOwnProperty("status")){
							var vdata = response.data;
							if(vdata['status'] == "success"){
								this.data_list.splice(this.delete_record_index,1);
								this.delete_record_index = -1;
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
			get_type: function( v ){
				if( this.s['i'] == "i_p" ){
					if( v== 'a' ){
						return this.table['pk']['type']+''
					}else if( v== 'b' ){
						return this.table['sk']['type']+''
					}
					return "text";
				}else if( this.s['i'] in this.table['keys'] ){
					if( v == "a" ){
						return this.table['keys'][ this.s['i'] ]['pk']['type']+'';
					}else if( v == "b" ){
						return this.table['keys'][ this.s['i'] ]['sk']['type']+'';
					}else{
						return "text";
					}
				}else{
					return "text";
				}
			},
			change_index: function(){
				this.$set( this.s['a'], 'f', "" );this.$set( this.s['a'],'v', "" );this.$set( this.s['a'],'v2', "" );
				this.$set( this.s['b'], 'f', "" );this.$set( this.s['b'],'v', "" );this.$set( this.s['b'],'v2', "" );
				if( this.s['i'] == "i_p"){
					this.$set( this.s['a'], 'f', this.table['pk']['field']+'' );
					this.$set( this.s['a'], 'f', this.table['sk']['field']+'' );
				}else{
					this.$set( this.s['a'], 'f', this.table['keys'][ this.s['i'] ]['pk']['field'] );
					this.$set( this.s['b'], 'f', this.table['keys'][ this.s['i'] ]['sk']['field'] );
				}
			},
			prev: function(){
				this.current_fields_id--;
			},
			next: function(){
				this.current_fields_id++;
			},
			search_filter_cond:function(v){
				this.av = false;this.av2 = false;this.bv = false;this.bv2 = false;
				if( this.s['t'] == 'query' ){
				if( this.s['i'] == "i_p" ){
					if( this.s['a']['v'] == "" ){
						this.av = true;
						return false;
					}
					if( this.table['sk']['enable'] ){
					if( this.s['a']['c'] == "><" ){
						if( this.s['a']['v'] == "" ){
							this.av = true;
						}
						if( this.s['a']['v2'] == "" ){
							this.av2 = true;
						}
						if( this.av || this.av2 ){
							return false;
						}
					}
					}
				}else{
					if( this.s['a']['v'] == "" ){
						this.av = true;
					}
					if( this.table['keys'][ this.s['i'] ]['enable'] ){
					if( this.s['b']['c'] == "><" ){
						if( this.s['b']['v'] == "" ){
							this.bv = true;
						}
						if( this.s['b']['v2'] == "" ){
							this.bv2 = true;
						}
					}
					}
				}
				}
				if( this.av || this.av2 || this.bv || this.bv2 ){
					return false;
				}
				this.first_page = true;
				this.last_key = false;
				this.data_list = [];
				this.load_records();
			},
			reset_filter:function(v){
				this.first_page = true;
				this.last_key	= false;
				this.load_records();
			},
			load_more: function(){
				this.load_records();
			},
			load_records: function(){
				var v = {
					"action"		:"load_dynamodb_records",
					"db_id"			: this.table['db_id'],
					"table_id"		: this.table['_id'],
					"limit"			: this.limit,
					"skip"			: this.data_list.length,
					"s"			: this.s,
					"security_token"	: $("#security_token").val(),
				};
				if( this.last_key ){
					v['last_key'] = this.last_key;
				}
				axios.post("?",v).then(response=>{
					if(response.data.hasOwnProperty("status")){
						var vdata = response.data;
						if( vdata['status'] == "success" ){
							var r = vdata['details']['records'];
							this.last_key = vdata['details']['last_key'];
							if( r.length == 0 ){
								this.found_more = false;
								//this.last_key = "";
							}else{
								this.first_page = false;
								for(var j=0;j<r.length;j++){
									this.data_list.push( r[j] );
								}

								if( r.length >= this.limit ){
									this.found_more = true;
								}else{
									this.found_more = false;
								}
							}
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
				this.add_record = JSON.parse( JSON.stringify( this.create_field_template_edit(vfield__,vdata__) ) );
				//this.echo__( this.add_record );
				this.show_add = true;
			},
			add_record_now: function(){
				this.edit_record_index = -1;
				this.edit_mode = "new";
				var vfield__ =  JSON.parse(JSON.stringify(this.table['schema'][ this.selected_schema ]['fields']));
				this.add_record = JSON.parse( JSON.stringify( this.create_field_template_edit(vfield__, {} ) ) );
				this.show_add = true;
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
			save_data: function(){
				this.edit_status = "";
				this.new_record = this.create_data_template( JSON.parse(JSON.stringify(this.add_record)) );
				this.echo__( this.new_record );
				if( 1 == 1){
					vpost_data = {
						"action"		: "update_record",
						'record'		: this.new_record,
						"db_id"			: this.table['db_id'],
						"table_id"		: this.table['_id'],
	                   			"record_index" 		: this.edit_record_index,
	                   			"edit_mode"		: this.edit_mode,
						"security_token"	: $("#security_token").val(),
					};
					axios.post("?",vpost_data ).then(response => {
						if( response.data.hasOwnProperty("status") ){
							vdata = response.data;
							if( vdata["status"] == "success" ){
								//this.show_add = false;
								if( this.edit_mode == "new" ){
									this.data_list.splice(0, 0, JSON.parse( JSON.stringify( this.new_record ) ) );
									this.edit_status = "Record Inserted";
								}else{
									this.$set( this.data_list, this.edit_record_index, JSON.parse( JSON.stringify( this.new_record ) ) );
									this.edit_status = "Record Updated";
								}
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
					str = v.replace( /[\\~\!\@\#\$\%\^\&\*\(\)\_\-\+\=\{\}\[\]\\\|\;\:\"\'\,\.\/\<\>\?\t\r\n]+/g, " " );
					str = str.replace( /[\ ]{2,10}/g, " ");
					str = str.trim();
					return (str + '').replace(/^(.)|\s+(.)/g, function ($1){return $1.toUpperCase()})
				}
			},
		}
	});
</script>
