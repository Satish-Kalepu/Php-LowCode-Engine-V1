<style>

table.zz td div{ max-width:250px; max-height:75px;overflow:auto; white-space:nowrap; }
table.zz thead td { background-color:#666; color:white; }

div.zz::-webkit-scrollbar {width: 5px;height: 5px;}
div.zz::-webkit-scrollbar-track { background: #f1f1f1;}
div.zz::-webkit-scrollbar-thumb { background: #888;}
div.zz::-webkit-scrollbar-thumb:hover { background: #555;}

pre.sample_data{ height:300px;overflow:auto; white-space:nowrap; border:1px solid #333; }
pre.sample_data::-webkit-scrollbar {width: 5px;height: 5px;}
pre.sample_data::-webkit-scrollbar-track { background: #f1f1f1;}
pre.sample_data::-webkit-scrollbar-thumb { background: #888;}
pre.sample_data::-webkit-scrollbar-thumb:hover { background: #555;}

</style>
<div id="app" >
	<div class="leftbar" >
		<?php require("page_apps_leftbar.php"); ?>
	</div>
	<div style="position: fixed;left:150px; top:40px; height: calc( 100% - 40px ); width:calc( 100% - 150px ); background-color: white; " >
		<div style="padding: 10px;" >

			<div style="float:right;"><a class="btn btn-outline-secondary btn-sm" v-bind:href="dbpath">Back</a></div>

			<h4>Table - <?=ucwords($table['table']) ?></h4>

			<ul class="nav nav-tabs mb-2">
				<li class="nav-item">
					<a class="nav-link<?=$config_param4=='records'||$config_param4==''?" active":"" ?>" v-bind:href="dbpath+'records'">Records</a>
				</li>
				<li class="nav-item">
					<a class="nav-link<?=$config_param4=='manage'?" active":"" ?>" v-bind:href="dbpath+'manage'">Manage</a>
				</li>
				<li class="nav-item">
					<a class="nav-link<?=$config_param4=='import'?" active":"" ?>" v-bind:href="dbpath+'import'">Import</a>
				</li>
				<li class="nav-item">
					<a disabled class="nav-link<?=$config_param4=='export'?" active":"" ?>" v-bind:href="dbpath+'export'">Export</a>
				</li>
			</ul>

			<div style="height: 50px; border-bottom: 1px solid #ccc; ">
				<div v-if="step==1" >
					<div class="mb-2" style="display:flex; gap:20px;" >
						<select class="form-select form-select-sm w-auto" v-model="upload_type" v-on:change="upload_type_select" >
							<option value="CSV" >CSV</option>
							<option value="JSON" >JSON</option>
							<option value="XLS" >XLS</option>
							<option value="XLSX" >XLSX</option>
						</select>
						<input type="file" id="upload_file" class="form-control form-control-sm w-auto" style="" v-on:change="fileselect" >
					</div>
					<div class="mb-2" v-if="err" >
						<div>Sample Data:</div>
						<pre v-if="sample_data" >{{ sample_data }}</pre>
					</div>
				</div>
				<div v-if="step==2" >
					<input type="button" class="btn btn-outline-dark btn-sm" v-on:click="cancel_step2" value="Cancel" style="float:right;">
					<input v-if="tot_cnt<=20000" type="button" class="btn btn-outline-dark btn-sm" v-on:click="doimport" value="Import" style="float:right; margin-right: 10px;">

					<div style="display: flex; gap:20px;">
						<div>
							<div>FileSize: {{ get_size() }}</div>
							<div>FileType: {{ upload_type }}</div>
						</div>
						<div>
							<div>Preview: <span class="badge text-bg-light">{{ sample_records.length }}</span> of <span class="badge text-bg-light">{{ tot_cnt }}</span> records </div>
						</div>
						<div v-if="tot_cnt>20000" style="color:red;">File has more than 20,000 records. Not allowed.</div>
					</div>
				</div>
				<div v-if="step==3||step==4" >
					<input type="button" class="btn btn-outline-dark btn-sm" v-on:click="cancel_step2" value="Cancel" style="float:right;">
					<input v-if="tot_cnt<=20000" type="button" class="btn btn-outline-dark btn-sm" v-on:click="doimport2" value="Proceed" style="float:right; margin-right: 10px;">

					<div style="display: flex; gap:20px;">
						<div>
							<div>FileSize: {{ get_size() }}</div>
							<div>FileType: {{ upload_type }}</div>
						</div>
						<div>
							<div><b>Schema Check</b></div>
						</div>
					</div>
				</div>
			</div>

			<div style="overflow: auto;height: calc( 100% - 130px - 50px - 30px ); padding-right:10px;">
				<div v-if="step==2" >
					<template v-if="sample_records.length>0" >
						<table class="table table-striped table-bordered table-sm w-auto zz" >
							<thead v-if="head_record" style="position:sticky; top:0px; ">
								<tr>
									<td v-for="f in head_record" ><div class="zz">{{ f }}</div></td>
								</tr>
							</thead>
							<tbody>
								<tr v-for="d in sample_records" >
									<td v-for="f in d" ><div class="zz">{{ f }}</div></td>
								</tr>
							</tbody>
						</table>
					</template>
				</div>
				<div v-if="step==3" >
					<template v-if="upload_type=='CSV'" >
						<div class="py-2">Map columns of CSV file to the Database Schema</div>

						<div class="row mb-2">
							<div  class="col-6" ><div v-if="msg2" v-html="msg2" ></div></div>
							<div  class="col-6" ><div v-if="err2" style="color:red;" >{{ err2 }}</div></div>
						</div>

						<table class="table table-bordered table-sm w-auto">
							<thead>
								<tr class="text-bg-light">
									<td>Table Field</td>
									<td>Type</td>
									<td>=</td>
									<td>CSV Column</td>
								</tr>
							</thead>
							<tbody>
								<tr v-for="fd,f in sch_keys" >
									<td>{{ f }}</td>
									<td>{{ fd['type'] }}<span v-if="f=='_id'" > Key</span></td>
									<td>=</td>
									<td>
										<select class="form-select form-select-sm w-auto" v-model="sch_keys[ f ]['map']" v-on:change="import2_check" >
											<option value="-1" >Not Mapped</option>
											<option v-for="hidx,hd in fields_match" v-bind:value="hidx+''" >{{ hd }}</option>
										</select>
									</td>
								</tr>
							</tbody>
						</table>

					</template>
					<template>Unhandled upload type</template>
				</div>
				<div v-if="step==4" >
					<div class="row mb-2">
						<div class="col-6">Progress <span style="font-size:1.5rem;">{{ upload_progress }} %</span></div>
						<div class="col-6">Uploaded <span style="font-size:1.5rem;">{{ upload_cnt }}/{{ tot_cnt }}</span></div>
					</div>
					<div class="row mb-2">
						<div class="col-6">Success <span class="b-400" >{{ upload_success_cnt }}</span></div>
						<div class="col-6">Skipped <span class="bold" >{{ upload_skipped_cnt }}</span></div>
					</div>

					<div  class="py-2" v-if="msg3" v-html="msg2" ></div>
					<div  class="py-2" v-if="err3" style="color:red;" >{{ err3 }}</div>

					<div v-if="uploaded_skipped_cnt>0" >
						<div>Skipped Items: </div>
						<div v-for="v in upload_skipped_items" >{{ v }}</div>
					</div>

				</div>
			</div>
			<div style="height: 30px; padding-right:10px;" >
				<div v-if="msg" >{{ msg }}</div>
				<div v-if="err" style="float:right;color:red;" >{{ err }}</div>
			</div>


		</div>
	</div>




</div>

<script>
<?php
include( "page_apps_tables_dynamic_object.js" );
?>
var app = Vue.createApp({
	"data"	: function(){
		return {
			"path": "<?=$config_global_apimaker_path ?>apps/<?=$app['_id'] ?>/",
			"dbpath": "<?=$config_global_apimaker_path ?>apps/<?=$app['_id'] ?>/tables_dynamic/<?=$config_param3 ?>/",
			"app_id": "<?=$config_param1 ?>",
			"table_id": "<?=$config_param3 ?>",
			"table": <?=json_encode($table,JSON_PRETTY_PRINT) ?>,
			"token": "",
			"vshow": true,
			"msg": "", "err": "", "msg2": "", "err2": "", "msg3": "", "err3": "", 
			"upload_type": "CSV",
			"filedata": "nothing",
			"sample_records": [],
			"is_head": true,
			"head_record": [],
			"step": 1,
			"tot_cnt": 0,
			"sch_keys": {}, "sch_ikeys": {},
			"fields_match": {}, "keys_match": {},
			"sample_data": "",
			"upload_progress": 0,
			"upload_cnt": 0,"upload_success_cnt": 0,"upload_skipped_cnt": 0, "upload_batch_cnt": 0,
			"upload_skipped_items": [],
			"batch_limit": 500,
		};
	},
	mounted : function(){
		//this.load_source_tables();
		this.echo__( this.table );

		var sch_keys  = {};
		for(var sch in this.table['schema'] ){
			for( var fi in this.table['schema'][sch]['fields'] ){
				sch_keys[ fi ] = {
					"type": this.table['schema'][sch]['fields'][ fi ]['type'],
					"map": "-1"
				}
			}
		}
		this.echo__(sch_keys);
		var sch_ikeys = {};
		for(var idx in this.table['keys'] ){
			var k = Object.keys(this.table['keys'][ idx ]['keys']);
			for( var i=0;i<k.length;i++){
				sch_ikeys[ k[i] ] = 1;
			}
		}
		this.sch_keys = sch_keys;
		this.sch_ikeys = sch_ikeys;
	},
	methods: {
		echo__: function(v){
			if( typeof(v)=="object" ){
				console.log( JSON.stringify(v,null,4) );
			}else{
				console.log( v );
			}
		},
		is_token_ok(t){
			if( t!= "OK" && t.match(/^[a-f0-9]{24}$/)==null ){
				setTimeout(this.token_validate,100,t);
				return false;
			}else{
				return true;
			}
		},
		token_validate(t){
			if( t.match(/^(SessionChanged|NetworkChanged)$/) ){
				this.err = "Login Again";
				alert("Need to Login Again");
			}else{
				this.err = "Token Error: " + t;
			}
		},
		get_size: function(){
			var s = this.vf.size;
			if( s < 1024 ){ return s + " bytes";}
			if( s/1024 < 1024 ){ return (s/1024).toFixed(0) + " KB";}
			if( s/1024/1024 < 1024 ){ return (s/1024/1024).toFixed(2) + " MB";}
		},
		readcsvline: function(){
			if( this.fpos >= this.filedata.length ){
				return "end";
			}
			var d = this.filedata.substr(this.fpos,1024);
			if( d.trim() == "" ){
				return "end";
			}
			var p = 0;
			var r = [];
			var cnt = 0;
			while( p<d.length-1 ){cnt++;if( cnt > 100 ){break;}
				// console.log("Pos:"+p);
				// console.log( d.substr( p, 200 ) );
				m1 = d.substr( p, 500 ).match( /^\"([\S\s]+?)\"([\,\n])/ );
				//console.log( m1 );
				if( m1 != null ){
					r.push( m1[1].replace(/[\r\n]/, "") );
					p+= m1[0].length;
					if( m1[2] == "\n" ){ this.fpos += p; return r; }
				}else{
					m1 = d.substr( p, 500 ).match( /^([\S\s]+?)([\,\n])/ );
					//console.log( m1 );
					if( m1 != null ){
						r.push( m1[1].replace(/[\r\n]/, "") );
						p+= m1[0].length;
						if( m1[2] == "\n" ){ this.fpos += p; return r; }
					}else{
						console.log("Null");
						return "error";
					}
				}
			}
			console.log("Read line failed with max loops");
			return "Failed";
		},
		cancel_step2: function(){
			this.step = 1;
			this.filedata = "";
			this.vf = false;
			this.sample_data = "";
			this.sample_records = [];
			this.head_record = {};
			this.fields_match = {};
			this.tot_cnt = 0;
		},
		checkfile: function(){

			if( this.upload_type == "CSV" ){
				var d = this.filedata.substr(this.fpos,1024);
				var line = d.split("\n")[0];
				var fields = line.split(",");
				if( fields.length < 3 ){
					alert("File is not in CSV Format");
					this.err = "File is not in CSV Format";
					console.log( d );
					this.sample_data = d;
				}else{
					this.checkfile_csv();
				}
			}else{

			}
		},
		checkfile_csv: function(){
			this.err = "";
			this.msg = "";

			this.fpos =0;
			this.tot_cnt = 0;
			if( this.vf.size > 1024*1024*5 ){
				this.msg = "File size is more than 5 MB";
			}
			var d = this.readcsvline();
			if( d === false ){ alert("Failed reading csv"); return false; }
			if( typeof(d) == "object"){
				this.head_record = d;
				this.fields_match = {};
				for(var vf in d ){
					this.fields_match[ d[vf] ] = vf;
				}
			}else{
 				alert("Failed reading csv " + d); return false; 
			}

			// this.fields_match = {};
			// this.keys_match = {};
			// for(var fi=0;fi<d.length;d++){
			// 	var field = d[fi];
			// 	if( field in this.sch_keys == false ){
			// 		this.fields_match[ field ] = false;
			// 	}else{
			// 		this.fields_match[ field ] = true;
			// 	}
			// 	this.keys_match[ field ] = true;
			// }

			var c_cnt = Object.keys(this.head_record).length;
			var r_cnt = 0;var or_cnt = c_cnt;var issue_cnt = 0;
			var recs = [];
			for(var i=0;i<100;i++){
				var d = this.readcsvline();
				if( typeof(d) == "object" ){
					recs.push(d);
					this.tot_cnt++;
				}else if( d == "end" ){ break; }else{ this.err = d; break; }
				var r_cnt = Object.keys(d).length;
				if( r_cnt != or_cnt || c_cnt != r_cnt ){issue_cnt++;}or_cnt = r_cnt+0;
				//break;
			}
			if( i == 100 ){
				setTimeout(this.checkfile_csv_continue,500);
			}
			console.log( i );
			this.sample_records = recs;
			this.step = 2;
			if( r_cnt != c_cnt ){ this.err = "Header and records column count not same."; }
			if( issue_cnt > 10 ){
				this.err = this.err  + " Column count inconsistent in " + issue_cnt + "% records";
			}else if( issue_cnt > 0 ){
				this.err = this.err + " Column count issues";
			}

			if( this.err == "" ){

			}
		},
		checkfile_csv_continue: function(){
			while( 1 ){
				var d = this.readcsvline();
				if( typeof(d) == "object" ){
					this.tot_cnt++;
				}else if( d == "end" ){ break; }else{ this.err = d; break; }
			}
		},
		openbrowse: function(){
			document.getElementById("upload_file").click();
		},
		fileselect: function(){
			this.err = "";
			this.sample_data = "";
			var vf = document.getElementById("upload_file").files[0];
			console.log( vf );
			if( this.upload_type == "CSV" ){
				if( vf.name.match(/\.csv$/i) == null ){
					document.getElementById("upload_file").value = "";
					alert("Please select a file type .CSV");return false;
				}
			}else if( this.upload_type == "JSON" ){
				if( vf.name.match(/\.json$/i) == null ){
					document.getElementById("upload_file").value = "";
					alert("Please select a file type .JSON");return false;
				}
			}else{
				document.getElementById("upload_file").value = "";
				alert( this.upload_type + " not ready. please choose CSV/JSON");return false;
			}

			if( vf.size > (1024*1024*20) ){
				document.getElementById("upload_file").value = "";
				alert("Please select a file with a size less than 20MB and max 10000 records");return false;
			}

			this.vf = vf;
			this.fn = vf.name+'';

			this.fr = new FileReader();
			this.fr.vapp = this;
			this.fr.onload = (e) => {
				e.target.vapp.filedata = e.target.result;
				e.target.vapp.checkfile();
			}
			this.fr.readAsText(vf);
		},
		doimport: function(){
			this.step = 3;
			this.err2 = "";
			this.msg2 = "";
		},
		import2_check: function(){
			this.err2 = "";
			this.msg2 = "";
			var cnt = 0;
			var matched = {};
			for( var vf in this.sch_keys ){
				if( this.sch_keys[ vf ]['map'] != "-1" ){
					if( this.sch_keys[ vf ]['map'] in matched ){
						this.err2 = "Same field `"+this.sch_keys[ vf ]['map']+"` is mapped multiple times";
					}else{
						if( vf != "_id" ){
							cnt++;
						}
						matched[ this.sch_keys[ vf ]['map'] ] = 1;
					}
				}
			}
			this.echo__(matched);
			if( Object.keys(this.sch_keys).length > cnt ){
				this.msg2 = "You have mapped <span class='badge bg-secondary' >" + cnt + "</span> fields out of <span class='badge bg-secondary' >" + Object.keys(this.sch_keys).length + "</span> fields of Table Schema";
			}
			if( cnt == 0 ){
				this.err2 = "at lease one key mapping is required for import";
			}
		},
		doimport2: function(){
			if( this.err2 ){
				if( confirm("There was some errors in mapping.\n\nDo you still want to proceed?") ){
					this.start_importing();
				}
			}else{
				if( confirm("Have you verified data mappings?\nIncorrect mapping can lead to garbage collection\n\nDo you want to proceed?") ){
					this.start_importing();
				}
			}
		},
		start_importing: function(){
			this.step = 4;
			this.upload_progress = 0;
			this.upload_cnt = 0;this.upload_success_cnt = 0;this.upload_skipped_cnt = 0;this.upload_skipped_items = [];
			this.err3 = "";
			this.msg3 = "Initiating...";
			this.fpos =0;
			var d = this.readcsvline();
			axios.post("?", {
				"action":"get_token",
				"event":"tables_dynamic_import_batch."+this.app_id + "." + this.table['_id'],
				"expire":10,
				"max_hits": 1000,
			}).then(response=>{
				this.msg3 = "";
				if( response.status == 200 ){
					if( typeof(response.data) == "object" ){
						if( 'status' in response.data ){
							if( response.data['status'] == "success" ){
								this.token = response.data['token'];
								if( this.is_token_ok(this.token) ){
									this.start_importing_batch();
								}
							}else{
								alert("Token error: " + response.dat['data']);
								this.err3 = "Token Error: " + response.data['data'];
							}
						}else{
							this.err3 = "Incorrect response";
						}
					}else{
						this.err3 = "Incorrect response Type";
					}
				}else{
					this.err3 = "Response Error: " . response.status;
				}
			});
		},
		start_importing_batch: function(){
			var recs = [];
			for(var i=0;i<this.batch_limit;i++){
				var d = this.readcsvline();
				if( typeof(d) == "object" ){
					var rec = {};
					for( fi in this.sch_keys ){
						var fd = this.sch_keys[fi];
						if( fd['map'] != "-1" ){
							if( d[ Number(fd['map']) ] ){
								var v = d[ Number(fd['map']) ];
								if( v != undefined ){
									rec[ fi ] = v;
								}
								if( fd['type'] == "number" ){
									if( typeof(v) == "string" ){
										rec[ fi ] = Number(v);
									}else if( typeof(v) == "number" ){
										rec[ fi ] = v;
									}else{
										rec[ $fi ] = 0;
									}
								}else{
									rec[ fi ] = v;
								}
							}
						}
					}
					recs.push( rec );
				}else if( d == "end" ){ break; }else{ this.err3 = d; break; }
			}
			if( recs.length ){
				this.upload_batch_cnt = recs.length;
				axios.post( "?", {
					"action": "tables_dynamic_import_batch",
					"data": recs,
					"token": this.token
				}).then(response=>{
					this.msg3 = "";
					if( response.status == 200 ){
						if( typeof(response.data) == "object" ){
							if( 'status' in response.data ){
								if( response.data['status'] == "success" ){
									this.upload_cnt = Number(this.upload_cnt) + Number(this.upload_batch_cnt);
									this.upload_progress = ((this.upload_cnt/this.tot_cnt)*100).toFixed(1);
									this.upload_success_cnt += response.data['success'];
									this.upload_skipped_cnt += response.data['skipped'];
									for( var i in response.data['skipped_items'] ){
										this.upload_skipped_items.push( response.data['skipped_items'][ i ] );
									}
									setTimeout(this.start_importing_batch,50);
								}else{
									this.err3 = "Import Error: " + response.data['error'];
								}
							}else{
								this.err3 = "Incorrect response";
							}
						}else{
							this.err3 = "Incorrect response Type";
						}
					}else{
						this.err3 = "Response Error: " . response.status;
					}
				});
			}
		}
	}
});
app.component( "table_dyanmic_object", table_dyanmic_object );
app.mount("#app");

</script>
