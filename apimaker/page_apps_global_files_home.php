<style>
	div.vid{ padding:0px 2px; cursor:pointer; }
	div.vid pre.vid{display: none; position: absolute; background-color: white; padding: 3px; border: 1px solid #aaa;}
	div.vid:hover pre.vid{display: block;}
</style>
<div id="app" >
	<div class="leftbar" >
		<?php require("page_apps_leftbar.php"); ?>
	</div>
	<div style="position: fixed;left:150px; top:40px; height: calc( 100% - 40px ); width:calc( 100% - 150px ); background-color: white; "  >
		<div style="padding: 10px;" >
			<div class="h3 mb-3 w-auto">Global Files</div>
			<div style="display: flex; height: 25px;">
				<div style="min-width:5px; cursor: pointer; padding:0px 5px; border:1px solid #ccc;" v-on:click="change_path('/')" >/</div>
				<div v-for="vv in paths" style="min-width:20px; cursor: pointer; padding:0px 5px; border:1px solid #ccc;" v-on:click="change_path(vv['tp'])" >{{ vv['p'] }}/</div>
			</div>
			<div style="height: calc( 100% - 130px ); overflow: auto;"  >
			<table class="table table-striped table-bordered table-sm" >
				<tr>
					<td>ID</td>
					<td>Name/Path</td>
					<td></td>
				</tr>
				<template v-for="v,i in files">
				<tr v-if="v['vt']=='folder'">
					<td><div class="vid">#<pre class="vid">{{v['_id']}}</pre></div></td>
					<td width="90%">
						<div><a v-bind:href="path+'global_files/?path='+v['name']" v-on:click.stop.prevent="enter_path(v['name'])" >{{ this.current_path + v['name'] }}/</a></div>
						<div align="right" >
							Folder
						</div>
					</td>
				</tr>
				</template>
				<template v-for="v,i in files">
				<tr v-if="v['vt']!='folder'">
					<td><div class="vid">#<pre class="vid">{{v['_id']}}</pre></div></td>
					<td width="90%">
						<div><a v-bind:href="path+'global_files/'+v['_id']" >{{ this.current_path + v['name'] }}</a></div>
						<div align="right" style="color:gray;">
							<div v-if="'sz' in v" style="display: inline-block; width: 100px; overflow: hidden;">{{ getsz(v['sz']) }}</div>
							<div style="display: inline-block; width:100px; overflow: hidden; ">{{ getc(v) }}</div>
							<div style="display: inline-block; width: 100px; overflow: hidden;">{{ v['type'] }}</div>
						</div>
					</td>
				</tr>
				</template>
			</table>
			</div>
		</div>
	</div>

</div>
<script>
var app = Vue.createApp({
	data(){
		return {
			path: "<?=$config_global_apimaker_path ?>apps/<?=$app['_id'] ?>/",
			app_id: "<?=$app['_id'] ?>",
			app__: <?=json_encode($app) ?>,
			msg: "",
			err: "",
			cmsg: "",
			cerr: "",
			files: [],
			upload_list: [],
			new_folder_name: "",
			current_path: "<?=$_GET['path']?$_GET['path']:'/' ?>",
			paths: [],
			active_uploads: 0,
			ext: {
				"txt":"text/plain",
				"text":"text/plain",
				"js":"text/javascript",
				"json": "application/json",
				"html": "text/html",
				"xml": "text/xml",
				"svg": "image/svg",
				"css": "text/css",
			},
			show_create_file: false,
			new_file: {
				"name": "",
				"type": "html",
				"ssr": false,
			},
			create_file_modal: false,
			upload_file_modal: false,
			create_folder_modal: false,
			token: "",
			dropdiv: false,dropdiv2: false,
		};
	},
	mounted(){
		this.update_paths();
		this.load_files();
		setInterval(this.check_queue,1000);
		//document.addEventListener("drop", function(e){e.preventDefault();e.stopPropagation();app.dropit(e);}, true);
	},
	methods: {
		getc: function(v){
			if( 'm_i' in v ){
				return v['m_i'].substr(0,10);
			}return "";
		},
		getsz: function(v){
			if( v < 1024 ){
				return (v) + " b";
			}else if( v/1024 < 1024 ){
				return (v/1024).toFixed(2) + " kb";
			}else if( v/1024/1024 < 1024 ){
				return (v/1024/1024).toFixed(2) + " mb";
			}else{
				return v;
			}
		},
		
		nchange: function(){
			var m = this.new_file['name'].match(/\.([a-z]{2,5})$/);
			if( m != null ){
				if( m[1] in this.ext ){
					this.new_file['type'] = this.ext[ m[1] ];
				}
			}
		},
		change_path: function(tp){
			console.log("change path: "+ tp );
			this.current_path = tp+'';
			this.upload_list = [];
			this.update_paths();
			this.load_files();
		},
		enter_path: function(v){
			this.current_path = this.current_path + v + "/";
			this.upload_list = [];
			console.log( this.current_path );
			this.update_paths();
			this.load_files();
		},
		update_paths(){
			console.log( this.current_path );
			var paths = this.current_path.split(/\//g);
			paths.splice(0,1);
			paths.pop();
			var p = [];
			var tp = "/";
			console.log( JSON.stringify(paths,null,4) );
			for(var i=0;i<paths.length;i++){
				tp = tp + paths[i] + "/";
				p.push({
					"p":paths[i],
					"tp": tp+'',
				});
			}
			this.files = [];
			this.paths = p;
			console.log( JSON.stringify(p,null,4) );
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
		load_files(){
			this.msg = "Loading...";
			this.err = "";
			axios.post("?", {
				"action":"get_token",
				"event":"getglobalfiles."+this.app_id,
				"expire":2
			}).then(response=>{
				this.msg = "";
				if( response.status == 200 ){
					if( typeof(response.data) == "object" ){
						if( 'status' in response.data ){
							if( response.data['status'] == "success" ){
								this.token = response.data['token'];
								if( this.is_token_ok(this.token) ){
									this.load_files2();
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
		load_files2(){
			this.msg = "Loading...";
			this.err = "";
			axios.post("?",{
				"action":"get_global_files",
				"app_id":this.app_id,
				"token":this.token,
				"current_path": this.current_path,
			}).then(response=>{
				this.msg = "";
				if( response.status == 200 ){
					if( typeof(response.data) == "object" ){
						if( 'status' in response.data ){
							if( response.data['status'] == "success" ){
								this.files = response.data['data'];
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
		cleanit( v ){
			v = v.replace( /\-/g, "DASH" );
			v = v.replace( /\//g, "SLASHS" );
			v = v.replace( /\_/g, "UDASH" );
			v = v.replace( /\./g, "DOTT" );
			v = v.replace( /\W/g, "-" );
			v = v.replace( /DASH/g, "-" );
			v = v.replace( /UDASH/g, "_" );
			v = v.replace( /DOTT/g, "." );
			v = v.replace( /SLASHS/g, "/" );
			v = v.replace( /[\-]{2,5}/g, "-" );
			v = v.replace( /[\_]{2,5}/g, "_" );
			return v;
		},
	}
}).mount("#app");
</script>