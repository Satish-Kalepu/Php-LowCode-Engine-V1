<?php @include_once($_SERVER['DOCUMENT_ROOT'].'admin/config_script_block.php'); ?>
<div class="clearfix">
	<a href="/admin/databases/<?=$config_param1 ?>/" class="btn btn-dark btn-sm pull-right">Back</a>
	<h2>Table - <?=$table['_id']=='new'?"Create":$table['des'] ?></h2>
</div>
<div id="table_app">
	<input type="hidden" name="security_token" id="security_token" value="<?=get_new_token( 'database_dynamodb_manage',$config_param3 )?>">
	<div style="padding: 10px; margin-bottom:20px; border: 1px solid #bbb;">
		<table width="100%"><tr><td>
			<div><b>Original Table Structure: </b></div>
			<div v-if="'source_schema' in table">Last checked: {{ table['source_schema']['last_checked'] }}</div>
		</td><td>
			<input type="button" value="Check Source Database" v-on:click="check_source_database" >
			<span>{{ check_msg }} </span>
			<span v-if="check_error" class="text-danger" >{{check_error}}</span>
			<span v-if="'source_schema' in table">
				<span v-if="'schema' in table['source_schema']">
				<span v-if="'pk' in table['source_schema']['schema']">
					<span v-if="'pk' in table['source_schema']['schema']&&schema_matches==false" class="text-danger" >Schema does not match with original table</span>
					<span v-else-if="'pk' in table['source_schema']['schema']" class="text-success" >Schema Matches</span>
					<input v-if="showschema" type="button" value="Hide" v-on:click="showschema=false" ><input v-else-if="schema_matches==false" type="button" value="Show" v-on:click="showschema=true" >
				</span>
				</span>
			</span>
		</td>
		</table>
		<div v-if="showschema&&'pk' in table['source_schema']['schema']" >
			<table>
			<tr><td>
				<table class="table table-bordered table-sm" style="width:initial;">
				<tr>
					<td>Primary Key</td>
					<td>{{ table['source_schema']['schema']['pk']['field'] }} - {{ table['source_schema']['schema']['pk']['type'] }} </td>
					<td><span class="text-danger" v-if="table['pk']['field']!=table['source_schema']['schema']['pk']['field']||table['pk']['type']!=table['source_schema']['schema']['pk']['type']" >Not matching</span></td>
				</tr>
				<tr>
					<td>Sort Key</td>
					<td><span v-if="'sk' in table['source_schema']['schema']" >{{ table['source_schema']['schema']['sk']['field'] }} - {{ table['source_schema']['schema']['sk']['type'] }} </span></td>
					<td>
						<span class="text-danger" v-if="table['sk']['enable']!=table['source_schema']['schema']['sk']['enable']" >Not Enabled</span>
						<span v-if="table['sk']['enable']" >
							<span class="text-danger" v-if="table['sk']['field']!=table['source_schema']['schema']['sk']['field']||table['sk']['type']!=table['source_schema']['schema']['sk']['type']" >Not matching</span>
						</span>
					</td>
				</tr>
				</table>
				<div>Indexes</div>
				<table class="table table-bordered table-sm" style="width:initial;">
				<tr><td>IndexName</td><td>Primary Key</td><td>Sort Key</td></tr>
				<tr v-for="v,ind in table['source_schema']['schema']['keys']" >
					<td>{{ ind }}</td>
					<td>{{ v['pk']['field'] }} - {{ v['pk']['type'] }}</td>
					<td><span v-if="'sk' in v" >{{ v['sk']['field'] }} - {{ v['sk']['type'] }}</span></td>
					<td>
						<span class="text-danger" v-if="ind in table['keys']==false" >Indexname not found!</span>
						<span class="text-danger" v-else-if="v['pk']['field']!=table['keys'][ ind ]['pk']['field']" >Not Matching</span>
						<span class="text-danger" v-else-if="v['pk']['type']!=table['keys'][ ind ]['pk']['type']" >Not Matching</span>
						<span class="text-danger" v-else-if="v['sk']['enable']!=table['keys'][ ind ]['sk']['enable']" >Not Matching</span>
						<span class="text-danger" v-else-if="v['sk']['field']!=table['keys'][ ind ]['sk']['field']" >Not Matching</span>
						<span class="text-danger" v-else-if="v['sk']['type']!=table['keys'][ ind ]['sk']['type']" >Not Matching</span>
					</td>
				</tr>
				</table>
			</td><td>
				<input type="button" value="Update Table" v-on:click="update_table_schema_from_source" >
			</td></tr></table>
		</div>
	</div>

	<table class="table table-sm" >
		<tr>
			<td align="right">Description</td>
			<td><input class="form-control form-control-sm" type="text" v-model="table['des']" placeholder="Description/purpose"></td>
		</tr>
		<tr>
			<td align="right">Table</td>
			<td>
				<input class="form-control form-control-sm" type="text" v-model="table['table']" placeholder="Table/Collection">
				<div><em>Exact table name as in dynamodb database</em></div>
			</td>
		</tr>
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
						<dbobject_table_dynamodb v-if="vshow" v-bind:engine="table['engine']" v-bind:level="1" v-bind:items="sd['fields']" v-on:edited="table_fields_edited(si,$event)" ></dbobject_table_dynamodb>
						<div v-if="table['pk']['field'] in sd['fields']==false" class="text-danger" >Primary Key is must in schema</div>
						<div v-else-if="table['sk']['enable']" ><div v-if="table['sk']['field'] in sd['fields']==false" class="text-danger" >Sort Key is must in schema</div></div>
	
						<template v-for="kd,ki in keys_list" >
							<div v-if="kd['pk']['field'] in sd['fields']==false" class="text-warning" >Note: Index Key {{ kd['pk']['field'] }} is not present in schema</div>
							<div v-else-if="kd['sk']['enable']" >
								<div v-if="kd['sk']['field'] in sd['fields']==false" class="text-warning" >Sort Key is {{ kd['sk']['field'] }} is not present in schema</div>
							</div>
						</template>
					</div>
				</div>
				<div><input type="button" value="Add Schema" v-on:click="show_add_schema=true" ></div>
				<div v-if="show_add_schema"><input type="text" v-model="new_schema" placeholder="New Schema"><input type="button" value="Add" v-on:click="add_schema" ></div>
			</td>
		</tr>
		<tr>
			<td align="right">Primary Key</td>
			<td>
				<input type="text" v-model="table['pk']['field']" placeholder="Primary Key" style="width: 120px;">
				<select v-model="table['pk']['type']" >
					<option value="text" >Text</option>
					<option value="number" >Number</option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right">Sort Key</td>
			<td>
				<p>Enable sort key <input type="checkbox" v-model="table['sk']['enable']" ></p>
				<div v-if="table['sk']['enable']">
					<input type="text" v-model="table['sk']['field']" placeholder="Sort Key" style="width: 120px;">
					<select v-model="table['sk']['type']" >
						<option value="text" >Text</option>
						<option value="number" >Number</option>
					</select>
				</div>
			</td>
		</tr>
		<tr>
			<td align="right">Secondary Indexes</td>
			<td>
				<table class="table table-bordered table-sm" style="width:initial;">
					<tr>
						<td>Index Name</td>
						<td>Primary Key</td>
						<td colspan="2">Sort Key (optional)</td>
						<td>-</td>
					</tr>
					<tr v-for="kd,ki in keys_list" >
						<td>
						<input type="text" v-model="kd['name']" title="Index Name" v-on:change="index_name_change(ki)"  style="width: 150px;" >
						</td>
						<td>
							<input type="text" v-model="kd['pk']['field']" title="Primary key" style="width: 120px;" >
							<select v-model="kd['pk']['type']" >
								<option value="text" >Text</option>
								<option value="number" >Number</option>
							</select>
						</td>
						<td><input type="checkbox" v-model="kd['sk']['enable']" title="Sort key Enable"  ></td>
						<td>
							<div v-if="kd['sk']['enable']" >
							<input type="text" v-model="kd['sk']['field']" title="Sort key"  style="width: 120px;" >
							<select v-model="kd['sk']['type']" >
								<option value="text" >Text</option>
								<option value="number" >Number</option>
							</select>
							</div>
						</td>
						<td>
							<input type="button" value="X" v-on:click="delete_index(ki)" >
						</td>
					</tr>
				</table>
				<div><input type="button" value="Add Index" v-on:click="add_index" ></div>
			</td>
		</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td>
				<button type="button" v-on:click="save_now" class="btn btn-primary btn-sm">Save</button>
			</td>
		</tr>
	</table>
	<div v-if="show_import_popup" class="importpopup" >
		<div class="importhead" ><span>Import Schema</span><input type="button" value="Close" style="float:right;" v-on:click="show_import_popup=false" ></div>
		<div class="importbody">
			<textarea v-model="importjson"></textarea>
		</div>
		<div class="importfooter" ><span class='text-danger'>{{ importjson_msg }}</span><input type="button" value="IMPORT" style="float:right;" v-on:click="import_schema_json" ></div>
	</div>
</div>
<style>
.importpopup{ position: fixed; top:100px; left:100px; width:calc(100% - 200px);height:calc(100% - 200px); box-shadow: 5px 5px 10px #999; border:1px solid #666; background-color: white; }
.importhead{ height:30px; background-color: #f0f0f0; }
.importhead span{ padding: 5px; font-weight: bold; }
.importbody{ height: calc( 100% - 80px); }
.importbody textarea{ width: 100%; height: 100%; padding: 10px; }
.importfooter{ height: 30px; background-color: #f0f0f0; }
</style>
<script>
<?php
include("apps/dbobject_table_dynamodb.js");
?>
var database_app = new Vue({
	"el"	: "#table_app",
	"data"	: {
		"db_id": "<?=$config_param1 ?>",
		"table_id": "<?=$config_param3 ?>",
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
		"show_import_popup": false,
		"error": "",
		"vshow": true,
		"show_add_schema": false,
		"new_schema": "",
	},
	watch: {

	},
	created: function(){

	},
	mounted : function(){
		if( "source_schema" in this.table == false ){
			this.$set( this.table,'source_schema',{
				"schema":{},
				"last_checked": "Never",
			});
		}
		this.update_keys_list();
		if( this.table['table'] != "new" ){
			setTimeout(this.check_source_database,1000);
		}
	},
	methods : {
		update_keys_list: function(){
			var k = [];
			for(var i in this.table['keys'] ){
				var kd = JSON.parse( JSON.stringify( this.table['keys'][i] ) );
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
			this.show_import_popup = true;
		},
		import_schema_json: function(){
			this.importjson_msg = "";
			var v = this.importjson +'';
			v = v.replace(/\,\}/g, "}");
			v = v.replace(/\,\]/g, "}");
			try{
				var j = JSON.parse( v );
				var fv = this.make_fields_schema( j );
				fv[ this.table['pk']['field']+'' ] = {"name":this.table['pk']['field']+'', "key":this.table['pk']['field']+'',"type":this.table['pk']['type']+'', "order":0,"m":true};
				if( this.table['sk']['enable'] ){
					fv[ this.table['sk']['field']+'' ] = {"name":this.table['sk']['field']+'', "key":this.table['sk']['field']+'',"type":this.table['sk']['type']+'', "order":0,"m":true};
				}
				this.echo__( fv );
				this.vshow = false;
				this.$set( this.table['schema'][ this.import_schema_id ],'fields', fv );
				setTimeout(function(v){v.vshow=true;},300,this);
			}catch( e ){
				this.importjson_msg = "Error in Import: "+ e;
			}
			this.show_import_popup=false;
		},
		make_fields_schema: function( j ){
			var k = {};
			var cnt = 1;
			if( typeof(j) == "object" && "length" in j == false ){
			for(var i in j ){
				if( j[i] == null ){
					k[ i+'' ] = {
						"name": i+'', "key": i+'',
						"type": "null", "m": false, "order": cnt,
						"sub": {},
					};
				}else if( typeof(j[i]) == "boolean" ){
					k[ i+'' ] = {
						"name": i+'', "key": i+'',
						"type": "boolean", "m": false, "order": cnt,
						"sub": {},
					};
				}else if( typeof(j[i]) == "string" ){
					k[ i+'' ] = {
						"name": i+'', "key": i+'',
						"type": "text", "m": false, "order": cnt,
						"sub": {},
					};
				}else if( typeof(j[i]) == "number" ){
					k[ i+'' ] = {
						"name": i+'', "key": i+'',
						"type": "number", "m": false, "order": cnt,
						"sub": {},
					};
				}else if( typeof(j[i]) == "object" && "length" in j[i] == false ){
					k[ i+'' ] = {
						"name": i+'', "key": i+'',
						"type": "dict", "m": false, "order": cnt,
						"sub": this.make_fields_schema( j[i] ),
					};
				}else if( typeof(j[i]) == "object" && "length" in j[i] ){
					k[ i+'' ] = {
						"name": i+'', "key": i+'',
						"type": "list", "m": false, "order": cnt,
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
					var f = {};
					f[ this.table['pk']['field']+'' ] = {"name":this.table['pk']['field']+'', "key":this.table['pk']['field']+'',"type":this.table['pk']['type']+'', "order":0,"m":true};
					if( this.table['sk']['enable'] ){
						f[ this.table['sk']['field']+'' ] = {"name":this.table['sk']['field']+'', "key":this.table['sk']['field']+'',"type":this.table['sk']['type']+'', "order":0,"m":true};
					}
					var t = {'name': this.new_schema+"", 'fields': f};
					this.$set( this.table['schema'],k, t );
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
			this.$set( this.table['schema'][si],'e',this.table['schema'][si]['name']+"" );
		},
		edit_schema_name: function( si ){
			var k = this.table['schema'][ si ]['name'].replace( /\W+/g, "" );
			var n = this.table['schema'][ si ]['name']+"";
			if( k != si ){
				var t =JSON.parse( JSON.stringify( this.table['schema'][ si ] ));
				t['name'] = n;
				this.$delete(this.table['schema'], si);
				this.$set( this.table['schema'], k, t );
				this.$delete(this.table['schema'][k], 'e');
			}
		},
		index_type: function( ki ){
			if( this.table['keys'][ ki ]['m'] == false ){
				this.$set( this.table['keys'][ ki ]['b'],'field', "" );
				this.edit_key();
			}
		},
		edit_key: function( ki ){
			var k = "";
			if( this.table['keys'][ ki ]['a']['field'] ){
				k = this.table['keys'][ ki ]['a']['field']+"";
			}
			if( this.table['keys'][ ki ]['b']['field'] ){
				k = k + "_" + this.table['keys'][ ki ]['a']['field']+"";
			}
			this.$set( this.table['keys'][ ki ],'name', k );
		},
		table_fields_edited: function( si, vf ){
			//console.log( "Table fields edited!");
			this.echo__( vf );
			var v = [];
			for( var i in vf ){
				v.push( Number(vf[i]['order']) );
			}
			v.sort();
			var v_fn = [];
			var k = [];
			for(var i=0;i<v.length;i++){
				for( var j in vf ){if( vf[ j ]['order'] == v[i] ){
					v_fn.push( vf[ j ]['name']+'' );
				}}
			}
			this.$set( this.table['schema'][si], 'fields', vf );
		},
		add_index: function(){
			this.keys_list.push({
				"name":"f1_f2_index",
				"pk": {"field":"f1", "type": "text"},
				"sk": {"enable":true, "field":"f2", "type": "text"},
			});
		},
		delete_index: function(ki){
			this.keys_list.splice(ki,1);
		},
		save_now: function(){
			this.table['table'] = (this.table['table']+"").trim();
			this.table['des'] = (this.table['des']+"").trim();
			if( this.table['des']== "" ){
				alert("Enter Table Description");
				return false;
			}else if( this.table['des'].match( /^[A-Za-z0-9\-\_\s\.\ ]{5,50}$/ ) == null ){
				alert("Table description From 5 to 50 characters in length, A-Z a-z 0-9 _ - . and spaces allowed.");
				return false;
			}else if( this.table['table']== "" ){
				alert("Enter Table Name");
				return false;
			}else if( this.table['table'].match( /^[a-z0-9\-\_\.]{5,25}$/ ) == null ){
				alert("Table name From 5 to 25 characters in length, lowercase a-z 0-9 _ - . allowed. space is not allowed");
				return false;
			}else if( this.table['pk']['field'] == "" ){
				alert("Primary key is must for a dynamodb table!");
			}else if( this.table['pk']['field'].match( /^[A-Za-z0-9\-\_\.]{1,25}$/ ) == null ){
				alert("Primary key should be max 25 characters in length, a-z 0-9 _ - . allowed. space is not allowed");
				return false;
			}else if( this.table['sk']['enable'] && this.table['sk']['field'] != "" && this.table['sk']['field'].match( /^[A-Za-z0-9\-\_\.]{1,25}$/ ) == null ){
				alert("Sort key should be max 25 characters in length, a-z 0-9 _ - . allowed. space is not allowed");
				return false;
			}else{
				var k = {};
				for(var i=0;i<this.keys_list.length;i++){
					var kd = this.keys_list[i];
					if( kd['name'] in k ){
						alert("Secondary Index: " + kd['name'] + " - Repeated");
						return false;
					}
					if( kd['name'] == "" ){
						alert("Secondary Index: " + (i+1) + " - IndexName Required");
						return false;
					}else if( kd['name'].match(/^[a-z0-9\.\-\_]{2,50}$/) == null ){
						alert("Secondary Index: " + (i+1) + " - IndexName should not contain spaces and special chars. max length 50");
						return false;
					}else if( kd['pk']['field'] == "" ){
						alert("Secondary Index: " + kd['name'] + " - Primary Key Required");
						return false;
					}else if( kd['pk']['field'].match(/^[a-z0-9\.\-\_]{2,50}$/) == null ){
						alert("Secondary Index: " + kd['name'] + " - Primary Key should not contain spaces and special chars. max length 50");
						return false;
					}else if( kd['sk']['enable'] && kd['sk']['field'] == "" ){
						alert("Secondary Index: " + kd['name'] + " - Sort Key Required");
						return false;
					}else if( kd['sk']['enable'] && kd['sk']['field'].match(/^[a-z0-9\.\-\_]{2,50}$/) == null ){
						alert("Secondary Index: " + kd['name'] + " - Sort Key should not contain spaces and special chars. max length 50");
						return false;
					}
					k[ kd['name']+'' ] = {
						"name": kd['name'],
						"pk": {"field": kd['pk']['field'], "type": kd['pk']['type'] },
						"sk": {"enable": kd['sk']['enable'], "field": kd['sk']['field'], "type": kd['sk']['type'] },
					};
				}
				this.$set( this.table,'keys',k);
				for(var i in this.table['schema'] ){
					var f = this.table['schema'][i]['fields'];
					if( this.table['pk']['field'] in f == false){
						alert("Primary Key should be in schema `" + i + "`");
						return false;
					}
					if( this.table['sk']['enable'] && this.table['sk']['field'] in f == false){
						alert("Sort Key should be in schema `" + i + "`");
						return false;
					}
				}
				var vd__ = {
						"action"		: "save_table_dynamodb", 
						"table"			: this.table, 
						"db_id"			: this.db_id, 
						"table_id"		: this.table['_id'],
						"security_token"	: $("#security_token").val(),
				};
				axios.post( "?", vd__  ).then(response=>{
					if( response.data['status'] == "success" ){
						if( this.table['_id'] == "new" ){
							document.location = "<?=$config_site_path ?>databases/<?=$config_param1 ?>/tables/" + response.data['details'] + "/manage";
						}else{
							alert("Successfully saved");
						}
					}else{
						alert( response.data['details'] );
					}
				});
			}
		},
		compare_schema: function(){
			var ve = true;
			if( this.table['pk']['field']!=this.table['source_schema']['schema']['pk']['field']||this.table['pk']['type']!=this.table['source_schema']['schema']['pk']['type'] ){
				ve = false;
			}else if( this.table['sk']['enable']!=this.table['source_schema']['schema']['sk']['enable'] ){
				ve = false;
			}else if( this.table['sk']['field']!=this.table['source_schema']['schema']['sk']['field']||this.table['sk']['type']!=this.table['source_schema']['schema']['sk']['type'] ){
				ve = false;
			}else{
				for( var ind in this.table['source_schema']['schema']['keys'] ){
					var v = this.table['source_schema']['schema']['keys'][ ind ];
					if( ind in this.table['keys']==false ){
						ve = false;
						break;
					}else if( v['pk']['field']!=this.table['keys'][ ind ]['pk']['field'] ){
						ve = false;
						break;
					}else if( v['pk']['type']!=this.table['keys'][ ind ]['pk']['type'] ){
						ve = false;
						break;
					}else if( v['sk']['enable']!=this.table['keys'][ ind ]['sk']['enable'] ){
						ve = false;
						break;
					}else if( v['sk']['field']!=this.table['keys'][ ind ]['sk']['field'] ){
						ve = false;
						break;
					}else if( v['sk']['type']!=this.table['keys'][ ind ]['sk']['type'] ){
						ve = false;
						break;
					}
				}
			}
			this.schema_matches = ve;
		},
		check_source_database: function(){
			this.check_error = "";
			this.check_msg = "Checking source database...";
			vd__ = {
					"action"		: "check_dynamodb_source_table", 
					"db_id"			: this.db_id, 
					"table_id"		: this.table_id, 
					"table"			: this.table['table'],
					"security_token"	: $("#security_token").val(),
			       };
			axios.post("?", vd__ ).then(response=>{
				if( response.data["status"] == "success" ){
					this.$set( this.table, 'source_schema', response.data['details'] );
					var fields = this.table["source_schema"]["fields"];
					//console.log( JSON.stringify( this.table['source_schema'],null,4 ) );
					this.check_msg = "Checked";
					this.compare_schema();
					if( this.schema_matches == false ){
						this.showschema = true;
					}
					this.$forceUpdate();
				}else{
					this.check_error = response.data['details'] ;
					this.check_msg = "Checked";
				}
			});
		},
		update_table_schema_from_source: function(){	
			this.vshow = false;
			this.$set( this.table, 'pk', JSON.parse( JSON.stringify( this.table['source_schema']['schema']['pk'] ) ) );
			this.$set( this.table, 'sk', JSON.parse( JSON.stringify( this.table['source_schema']['schema']['sk'] ) ) );
			this.$set( this.table, 'keys', JSON.parse( JSON.stringify( this.table['source_schema']['schema']['keys'] ) ) );
			if( Object.keys(this.table['source_schema']['fields']).length == 0 ){
				vd__ = {
						"pk": {"name": this.table['source_schema']['schema']['pk']['field'],"key": this.table['source_schema']['schema']['pk']['field'],"type":this.table['source_schema']['schema']['pk']['type'],"order": 0,"m": true},
						"sk": {"name": this.table['source_schema']['schema']['sk']['field'],"key": this.table['source_schema']['schema']['sk']['field'],"type":this.table['source_schema']['schema']['sk']['type'],"order": 1,"m": true},
		        		};
	        		this.$set( this.table['schema']['default'], 'fields' , JSON.parse( JSON.stringify( vd__ ) ) );
			}else{
				this.$set( this.table['schema']['default'], 'fields', JSON.parse( JSON.stringify( this.table['source_schema']['fields'] ) ) );
			}
			//console.log( JSON.stringify( this.table['source_schema'],null,4 ) );
			setTimeout(function(v){v.vshow=true;},500,this);
			this.check_msg = "Table configuration updated from source!";
			this.check_error = "";
			this.schema_matches = true;
			this.showschema = false;
			this.update_keys_list();
		}
	}
});
</script>
