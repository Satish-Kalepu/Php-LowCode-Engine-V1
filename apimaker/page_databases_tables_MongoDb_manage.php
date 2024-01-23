<div id="app" >
	<div class="leftbar" >
		<?php require("page_apps_leftbar.php"); ?>
	</div>
	<div style="position: fixed;left:150px; top:40px; height: calc( 100% - 40px ); width:calc( 100% - 150px ); background-color: white; " >
		<div style="padding: 10px;" >

			<div style="float:right;"><a class="btn btn-outline-secondary btn-sm" v-bind:href="dbpath">Back</a></div>

			<h4>Database - <span class="small" style="color:#999;" ><?=ucwords($db['engine']) ?></span>: <?=htmlspecialchars($db['des']) ?> &nbsp;&nbsp;&nbsp;<span class="small" style="color:#999;" >Table:</span> {{ table['des'] }} </h4>

		<ul class="nav nav-tabs mb-2" >
			<li class="nav-item">
				<a class="nav-link<?=$config_param6=='records'||$config_param6==''?" active":"" ?>" v-bind:href="tablepath+'records'">Records</a>
			</li>
			<li class="nav-item">
				<a class="nav-link<?=$config_param6=='manage'?" active":"" ?>" v-bind:href="tablepath+'manage'">Manage</a>
			</li>
			<li class="nav-item">
				<a class="nav-link<?=$config_param6=='import'?" active":"" ?>" v-bind:href="tablepath+'import'">Import</a>
			</li>
			<li class="nav-item">
				<a disabled class="nav-link<?=$config_param6=='export'?" active":"" ?>" v-bind:href="tablepath+'export'">Export</a>
			</li>
		</ul>

			<div style="overflow: auto;height: calc( 100% - 130px );">

			<table class="table table-sm" >
				<tr>
					<td align="right" width="150">Description</td>
					<td><input class="form-control form-control-sm" type="text" v-model="table['des']" placeholder="Description/purpose"></td>
				</tr>
				<tr>
					<td align="right">Collection</td>
					<td>
						<select class="form-select form-select-sm" v-model="table['table']" placeholder="Table/Collection" v-on:change="check_source_database">
							<option v-if="tables_loading" value="" >Loading Collections List</option>
							<option v-for="t in source_tables" v-bind:value="t" >{{ t }}</option>
							<option v-bind:value="table['table']" >{{ table['table'] }}</option>
						</select>
						<div v-if="load_tables_error" class="text-danger" >{{ load_tables_error }}</div>
						<div v-if="load_tables_msg" class="text-success" >{{ load_tables_msg }}</div>
						<span>{{ check_msg }}</span>  
						<span v-if="check_error" class="text-danger" >{{check_error}}</span>
						<div v-if="source_tables.length > 0 && table['table']" >
							<div><input class="btn btn-link btn-sm" type="button" value="Reload source collection schema" v-on:click="check_source_database" > <input class="btn btn-link btn-sm" type="button" value="Show source schema" v-on:click="do_show_sourceschema" ></div>
							<template v-if="'source_schema' in table">
								<span class="small text-secondary">Last checked: {{ table['source_schema']['last_checked'] }}</span>
							</template>
						</div>
					</td>
				</tr>
				<template v-if="source_tables.length>0&&'source_schema' in table&&table['table']!=''" >
				<tr>
					<td align="right">Schema</td>
					<td>
						<div v-for="sd,si in table['schema']" style="border: 1px solid #999; margin-bottom: 10px;" >
							<div style="padding: 5px; background-color: #f0f0f0;" >
								<span v-if="si=='default'" >Default Schema</span>
								<div v-else >
									<div v-if="'e' in sd==false" > {{ sd['name'] }}  <input type="button" class="pull-right" value="i" v-on:click="show_edit_schema_name(si)" ><input type="button" class="pull-right" value="X" v-on:click="delete_schema(si)" ></div>
									<div v-else ><input type="text" v-model="sd['name']" placeholder="Schema Name" ><input v-if="sd['name']!=sd['e']" type="button" value="Update" v-on:click="edit_schema_name(si)" ></div>
								</div>
							</div>
							<div style="padding: 5px;" >
								<div style="float:right;"><input type="button" value="Import" style="padding:2px;" v-on:click="show_import(si)" ></div>
								<dbobject_table_mongodb v-if="vshow" v-bind:engine="table['engine']" v-bind:level="1" v-bind:items="sd['fields']" v-on:edited="table_fields_edited(si,$event)" ></dbobject_table_mongodb>
							</div>
						</div>
						<div><input type="button" value="Add Schema" v-on:click="show_add_schema=true" ></div>
						<div v-if="show_add_schema"><input type="text" v-model="new_schema" placeholder="New Schema"><input type="button" value="Add" v-on:click="add_schema" ></div>
					</td>
				</tr>
				<tr>
					<td align="right">Indexes</td>
					<td>


						<table class="table table-bordered table-sm w-auto">
							<tr class="bg-light">
								<td>IndexName</td>
								<td>Keys</td>
								<td>Options</td>
							</tr>
							<tr v-for="kd,ki in keys_list" >
								<td>
									<input type="text" v-model="kd['name']" title="Index Name" v-on:change="index_update" style="width:150px;" >
								</td>
								<td>
									<div v-for="fd,fi in kd['keys']" >
										<input type="text" v-model="fd['name']" placeholder="Field name" v-on:change="index_update"  style="width:150px;" >
										<select v-model="fd['type']" v-on:change="index_update" >
											<option value='text'>Text</option>
											<option value='number'>Number</option>
											<option value='boolean'>Boolean</option>
										</select>
										<select v-model="fd['sort']" v-on:change="index_update" >
											<option value="asc" >ASC</option>
											<option value="dsc" >DSC</option>
										</select>
										<input v-if="fi>0" type="button" value="X" style="padding:0px 2px;" v-on:click="index_delete_key(ki,fi)" >
									</div>
									<div><input type="button" value="+" style="padding:0px 2px;" v-on:click="index_add_key(ki)" ></div>
								</td>
								<td>
									<label style="cursor:pointer;">Sparse <input type="checkbox" v-model="kd['sparse']" title="Sparse Index"></label>
									<label style="cursor:pointer;">Unique <input type="checkbox" v-model="kd['unique']" title="Unique Index"></label>
								</td>
								<td>
									<input type="button" value="X" style="padding:0px 2px;" v-on:click="delete_index(ki)" >
								</td>
							</tr>
						</table>
						<div><input type="button" value="Add Index" v-on:click="add_index" ></div>

					</td>
				</tr>
				<tr>
					<td align="right">&nbsp;</td>
					<td>
						<p><button type="button" v-on:click="save_now" class="btn btn-outline-dark btn-sm">Save</button></p>
						<p>Note: This form cannot validate the schema because Mongodb is a schemaless database. You can only find schema by observing existing records or documentation. Therefore define schema manually and with caution.</p>
					</td>
				</tr>
				</template>
			</table>

			<pre>{{ table }}</pre>

			</div>


		</div>
	</div>


	<div class="modal fade" id="import_popup" tabindex="-1" >
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Import Schema</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
				<textarea class="form-control form-control-sm" style="min-height:200px;resize:both;" v-model="importjson"></textarea>
				<div><span class='text-danger'>{{ importjson_msg }}</span><input type="button" value="IMPORT" style="float:right;" v-on:click="import_schema_json" ></div>
	      </div>
	    </div>
	  </div>
	</div>



	<div class="modal fade" id="showschema" tabindex="-1" >
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Source Collection Schema</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">

	      	<template v-if="'source_schema' in table" >
				<div><input type="button" class="btn btn-outline-secondary btn-sm" value="Import to default schema" v-on:click="update_table_schema_from_source" ></div>
				<pre>{{ create_data_template(table['source_schema']['fields']) }}</pre>

				<div>Indexes</div>
				<table class="table table-bordered table-sm" style="width:initial;">
				<tr>
					<td>IndexName</td>
					<td>Keys</td>
					<td>Type</td>
				</tr>
				<template v-if="'length' in table['source_schema']['keys']==false" >
				<tr v-for="v,ind in table['source_schema']['keys']" >
					<td>{{ ind }}</td>
					<td>
						<span v-for="fd,fi in v['keys']" >{{ fd['name'] }} </span>
					</td>
					<td>
						<span class='badge' v-if="v['sparse']" >sparse</span><span class='badge' v-if="v['unique']" >unique</span>
					</td>
				</tr>
				</template>
				</table>
			</template>

	      </div>
	    </div>
	  </div>
	</div>


</div>

<script>
<?php
include("page_databases_tables_MongoDb_dbobject.js");
?>
var app = Vue.createApp({
	"data"	: function(){
		return {
			"path": "<?=$config_global_apimaker_path ?>apps/<?=$app['_id'] ?>/",
			"dbpath": "<?=$config_global_apimaker_path ?>apps/<?=$app['_id'] ?>/databases/<?=$config_param3 ?>/",
			"tablepath": "<?=$config_global_apimaker_path ?>apps/<?=$app['_id'] ?>/databases/<?=$config_param3 ?>/table/<?=$config_param5 ?>/",
			"app_id": "<?=$config_param1 ?>",
			"db_id": "<?=$config_param3 ?>",
			"table_id": "<?=$config_param5 ?>",
			"table": <?=json_encode($table,JSON_PRETTY_PRINT) ?>,
			"table_checked": false,
			"schema_matches": false,
			"showschema": false,
			"check_error": "",
			"check_msg": "",
			"keys_list": [],
			"import_schema_id": "",
			"importjson": "",
			"importjson_msg": "",
			"import_popup": false,
			"error": "",
			"vshow": true,
			"show_add_schema": false,
			"new_schema": "",
			"tables_loading": true,
			"source_tables": [],
			"source_tables_exists": true,
			"new_collection_name": "",
			"source_fields": [],
			"load_tables_msg": "",
			"load_tables_error": "",
		};
	},
	mounted : function(){
		if( "source_schema" in this.table == false ){
			this.table['source_schema'] = {
				"keys":{},
				"fields":{},
				"last_checked": "Never",
			};
		}
		this.update_keys_list();
		this.load_source_tables();
	},
	methods : {
		load_source_tables: function(){
			this.load_tables_error = "";
			this.load_tables_msg = "Checking source database...";
			var vd__ =  {
				"action"		: "check_mongodb_source_collection_list", 
				"db_id"			: this.db_id, 
				"app_id"			: this.app_id, 
			};
			axios.post("?", vd__ ).then(response=>{
				this.load_tables_msg = "";
				console.log( response.status );
				if( response.status == 500 ){
					alert( "There was an error checking source database" );
					this.load_tables_error = "http 500";
				}else if( response.data["status"] == "success" ){
					this.source_tables = response.data['data'];
					if( this.source_tables.length == 0 ){
						this.source_tables_exists = false;
					}else{
						this.source_tables_exists = true;
					}
					this.load_tables_msg = "Database is ok";
					this.tables_loading = false;
					if( 'source_schema' in this.table == false ){
						this.check_source_table();
					}
				}else{
					this.check_error = "Database check failed..." +response.data['error'];
				}
			}).catch(error=>{
				this.load_tables_error = error.toString();
			});
		},
		update_keys_list: function(){
			var k = [];
			for(var vkey in this.table['keys'] ){
				var kd = JSON.parse( JSON.stringify( this.table['keys'][ vkey ] ) );
				kd['e'] = false,
				k.push(kd);
			}
			this.keys_list = k;
		},
		echo__: function(v){
			if( typeof(v)=="object" ){
				console.log( JSON.stringify(v,null,4) );
			}else{
				console.log( v );
			}
		},
		show_import: function( vsi ){
			this.import_schema_id = vsi+'';
			this.import_popup = new bootstrap.Modal(document.getElementById('import_popup'));
			this.import_popup.show();
		},
		hide_import_popup: function(){
			this.import_popup.hide();
		},
		import_schema_json: function(){
			this.importjson_msg = "";
			var v = this.importjson +'';
			v = v.replace(/\,\}/g, "}");
			v = v.replace(/\,\]/g, "}");
			try{
				var j = JSON.parse( v );
				var fv = this.make_fields_schema( j );
				fv[ "_id" ] = {"name":"_id", "key":"_id","type":"text", "order":0,"m":true};
				this.vshow = false;
				this.table['schema'][ this.import_schema_id ][ 'fields' ] = fv;
				setTimeout(function(v){v.vshow=true;},300,this);
			}catch( e ){
				this.importjson_msg = "Error in Import: "+ e;
			}
			this.hide_import_popup();
		},
		make_fields_schema: function( j ){
			var k = {};
			var cnt = 1;
			if( typeof(j) == "object" && "length" in j == false ){
			for(var i in j ){
				if( j[i] == null ){
					k[ i+'' ] = {
						"name": i+'', "key": i+'',
						"type": "null", "m": true, "order": cnt,
						"sub": {},
					};
				}else if( typeof(j[i]) == "boolean" ){
					k[ i+'' ] = {
						"name": i+'', "key": i+'',
						"type": "boolean", "m": true, "order": cnt,
						"sub": {},
					};
				}else if( typeof(j[i]) == "string" ){
					k[ i+'' ] = {
						"name": i+'', "key": i+'',
						"type": "text", "m": true, "order": cnt,
						"sub": {},
					};
				}else if( typeof(j[i]) == "number" ){
					k[ i+'' ] = {
						"name": i+'', "key": i+'',
						"type": "number", "m": true, "order": cnt,
						"sub": {},
					};
				}else if( typeof(j[i]) == "object" && "length" in j[i] == false ){
					k[ i+'' ] = {
						"name": i+'', "key": i+'',
						"type": "dict", "m": true, "order": cnt,
						"sub": this.make_fields_schema( j[i] ),
					};
				}else if( typeof(j[i]) == "object" && "length" in j[i] ){
					k[ i+'' ] = {
						"name": i+'', "key": i+'',
						"type": "list", "m": true, "order": cnt,
						"sub": [ this.make_fields_schema( j[i][0] ) ],
					};
				}
				cnt++;
			}
			}
			this.echo__(k );
			return k;
		},
		add_schema: function(){
			if( this.new_schema ){
				var k = this.new_schema.replace( /\W+/g, "" );
				if( k in this.table['schema'] ){
					alert("Schema name already exists!");
				}else{
					var t =JSON.parse( JSON.stringify( this.table['schema']['default'] ));
					t['name'] = this.new_schema+"";
					this.table['schema'][k] = t;
					this.new_schema = "";
					this.show_add_schema=false;
				}
			}
		},
		delete_schema: function(si){
			if( confirm("Are you sure to delete `" + si + "` schema" ) ){
				this.$delete( this.table['schema'], si );
			}
		},
		show_edit_schema_name: function( si ){
			this.table['schema'][si][ 'e' ] = this.table['schema'][si]['name']+"";
		},
		edit_schema_name: function( si ){
			var k = this.table['schema'][ si ]['name'].replace( /\W+/g, "" );
			var n = this.table['schema'][ si ]['name']+"";
			if( k != si ){
				var t =JSON.parse( JSON.stringify( this.table['schema'][ si ] ));
				t['name'] = n;
				this.$delete(this.table['schema'], si);
				this.table['schema'][ k ] = t;
				this.$delete(this.table['schema'][k], 'e');
			}
		},
		index_update: function(){
			var kd = {};
			for(var i=0;i<this.keys_list.length;i++){if( this.keys_list[i]['name'] ){
				kd[ this.keys_list[i]['name']+'' ] = JSON.parse( JSON.stringify( this.keys_list[i] ) );
			}}
			this.table[ 'keys' ] =kd;
		},
		table_fields_edited: function( si, vf ){
			var v = [];
			for( var i in vf ){
				v.push( Number(vf[i]['order']) );
			}
			v.sort();
			var v_fn = [];
			var k = [];
			for( var i=0;i<v.length;i++){
				for( var j in vf ){if( vf[ j ]['order'] == v[i] ){
					v_fn.push( vf[ j ]['name']+'' );
				}}
			}
			this.echo__( vf );
			this.table['schema'][si][ 'fields' ] =vf;
		},
		index_add_key: function( vi ){
			this.keys_list[ vi ]['keys'].push( JSON.parse( JSON.stringify( this.keys_list[ vi ]['keys'][0] ) ) );
		},
		index_delete_key: function( vi, ki ){
			this.keys_list[ vi ]['keys'].splice(ki,1);
		},
		add_index: function(){
			this.keys_list.push({
				"name": "",
				"keys":[
					{"name":"field", "type": "text", "sort":"asc"}
				],
				"sparse": true,
				"unique": false,
				"e": true,
			});
			this.index_update();
		},
		delete_index: function(vi){
			this.keys_list.splice(vi,1);
			this.index_update();
		},
		save_now: function(){
			this.table['table'] = (this.table['table']+"").trim();
			this.table['des']   = (this.table['des']+"").trim();
			if( this.table['des']== "" ){
				alert("Enter Table Description");
				return false;
			}else if( this.table['des'].match( /^[A-Za-z0-9\-\_\s\.\ ]{5,50}$/ ) == null ){
				alert("Table description From 5 to 50 characters in length, A-Z a-z 0-9 _ - . and spaces allowed.");
				return false;
			}else if( this.table['table']== "" ){
				alert("Enter Table Name");
				return false;
			}else if( this.table['table'].match( /^[a-z0-9\-\_\.]{2,25}$/ ) == null ){
				alert("Table name From 5 to 25 characters in length, lowercase a-z 0-9 _ - . allowed. space is not allowed");
				return false;
			}else{
				for(var ind in this.table['keys'] ){
					if( ind.match(/^[a-z0-9\.\-\_]{2,60}$/) == null ){
						alert("Index name " + ind + " incorrect");
						return false;
					}else{
						for(var i=0;i<this.table['keys'][ ind ]['keys'];i++){
							if(   this.table['keys'][ ind ]['keys'][i]["name"].match(/^[a-z0-9\.\-\_]{2,60}$/) == null ){
								alert("Index field name `" + this.table['keys'][ind]['keys'][i]["name"] + "` incorrect");
								return false;
							}
						}
					}
				}
				vd__ =  {
					"action"	: "save_table_mongodb", 
					"table"		: this.table, 
					"app_id"	: this.app_id, 
					"db_id"		: this.db_id, 
					"table_id"	: this.table['_id'] ,
				};
				axios.post( "?", vd__ ).then(response=>{
					if( response.data['status'] == "success" ){
						if( this.table['_id'] == "new" ){
							document.location = this.dbpath+"tables/" + response.data['data'] + "/manage";
						}else{
							alert("Successfully saved");
						}
					}else{
						alert( response.data['data'] );
					}
				});
			}
		},
		compare_schema: function(){
			var ve = true;
			if( 1==51 ){
				for( var ind in this.table['source_schema']['keys'] ){
					var v = this.table['source_schema']['keys'][ ind ];
					if( ind in this.table['keys']==false ){
						ve = false;
						break;
					}else if( this.table['keys'][ ind ]['keys'].length != v['keys']['length'] ){
						ve = false;
						break;
					}else{
						for(var k=0;k<v['keys'].length;k++){
							if( this.table['keys'][ind]['key'][k]['name'] != v['keys'][k]['name'] ){
								ve = false;
								break;
							}
						}
					}
				}
			}
			this.schema_matches = ve;
		},
		check_source_table: function(){
			if( 'source_schema' in this.table == false && this.table['table'] != "" && this.table['table'] != "new" ){
				this.check_source_database();
			}else if( this.table['source_schema']['last_checked'] == "Never" && this.table['table'] != "" && this.table['table'] != "new" ){
				this.check_source_database();
			}
		},
		check_source_database: function(){
			this.check_error = "";
			this.check_msg = "Checking source database...";
			var vd__ =  {
					"action"		: "check_mongodb_source_table", 
					"app_id"			: this.app_id, 
					"db_id"			: this.db_id, 
					"table_id"		: this.table_id, 
					"table"			: this.table['table'],
				};
			axios.post("?", vd__ ).then(response=>{
				this.check_msg = "";
				console.log( response.status );
				if( response.status == 500 ){
					alert( response.data );
				}else if( response.data["status"] == "success" ){
					this.table[ 'source_schema' ] = response.data['data'];
					this.compare_schema();
					if( this.schema_matches == false ){
						this.showschema = new bootstrap.Modal(document.getElementById('showschema'));
						this.showschema.show();
					}
					this.$forceUpdate();
				}else{
					this.check_error = response.data['data'] ;
				}
			}).catch(error=>{
				this.check_error = error.toString();
			});
		},
		do_show_sourceschema: function(){
			this.showschema = new bootstrap.Modal(document.getElementById('showschema'));
			this.showschema.show();
		},
		update_table_schema_from_source: function(){
			this.vshow = false;
			this.table['keys'] = JSON.parse( JSON.stringify( this.table['source_schema']['keys'] ) );
			console.log( JSON.stringify( this.table['source_schema']['fields'],null,4 ) );
			this.table['schema']['default'][ 'fields' ] =JSON.parse( JSON.stringify( this.table['source_schema']['fields'] ) );
			setTimeout(function(v){v.vshow=true;},500,this);
			this.check_msg = "Table configuration updated from source!";
			this.check_error = "";
			this.schema_matches = true;
			this.showschema.hide();
			this.update_keys_list();
		},
		create_data_template: function( v ){
			var vdata__ = JSON.parse( JSON.stringify( v ));
			for( var i in vdata__ ){
				if( vdata__[i]['type'] == "dict" ){
					vdata__[i] = this.create_data_template( vdata__[i]['sub'] )
				}else if( vdata__[i]['type'] == "list" ){
					var v = [];
					v.push( this.create_data_template( vdata__[i]['sub'][0] ) );
					vdata__[i] = v;
				}else{
					if( vdata__[i]['type'] == "number" ){
						vdata__[i] = "number";
					}else{
						vdata__[i] = "text";
					}
				}
			}
			return vdata__;
		},
		create_collection_at_source: function(){
			if( this.new_collection_name.match(/^[a-z][a-z0-9]{3,35}$/) == null ){
				alert("Mongodb collection names should be plain alphabates. No special chars & spaces allowed.");
			}else{
				this.check_error = "";
				this.check_msg = "Creating collection at source database...";
				var vd__ =  {
						"action"		: "create_mongodb_collection", 
						"app_id"		: this.app_id, 
						"db_id"			: this.db_id, 
						"collection"	: this.new_collection_name, 
				};
				axios.post("?", vd__ ).then(response=>{
					this.check_msg = "";
					console.log( response.status );
					if( response.status == 500 ){
						alert( response.data );
					}else if( response.data["status"] == "success" ){
						this.check_msg = "Successfully created";
						setTimeout(function(v){v.check_msg = "";}, 3000, this);
						this.load_source_tables();
					}else{
						this.check_error = response.data['data'] ;
					}
				}).catch(error=>{
					this.check_error = error.toString();
				});
			}
		}
	}
});
app.component( "dbobject_table_mongodb", dbobject_table_mongodb );
app.mount("#app");

</script>
