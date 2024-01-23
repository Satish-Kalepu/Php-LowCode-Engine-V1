<div id="app" >
	<div  class="leftbar"  >
		<a class="left_btn" v-bind:href="path+'home'">Dashboard</a>
		<a class="left_btn" v-bind:href="path+'apis'">APIs</a>
		<a class="left_btn" v-bind:href="path+'tables'">Tables</a>
		<a class="left_btn" v-bind:href="path+'databases'">Databases</a>
		<a class="left_btn" v-bind:href="path+'plugins'">Plugins</a>
	</div>
	<div style="position: fixed;left:180px; top:40px; height: calc( 100% - 40px ); width:calc( 100% - 180px ); background-color: #f8f8f8; " >
		<div style="padding: 5px;" >
			<div style="float:right;" >
				<div v-if="msg" class="alert alert-primary" >{{ msg }}</div>
				<div v-if="err" class="alert alert-danger" >{{ err }}</div>
			</div>
			<div><button class="btn btn-primary btn-sm" v-on:click="open_create_popup()" >Create Plugin</button></div>
			<table class="table table-striped table-bordered table-sm" >
				<tr>
					<td>ID</td>
					<td>Plugin</td>
					<td></td>
				</tr>
				<tr v-for="v,i in plugins">
					<td><pre class="id">{{v['_id']}}</pre></td>
					<td width="70%">
						<div><a v-bind:href="path+'apis/'+v['_id']+'/'+v['version_id']" >/plugin/{{ v['name'] }}</a></div>
						<div class="text-secondary">{{ v['des'] }}</div>
					</td>
					<td><input type="button" class="btn btn-danger btn-sm" value="X" v-on:click="delete_plugin(i)" ></td>
				</tr>
			</table>
		</div>
	</div>
		<div class="modal fade" id="create_plugin_modal" tabindex="-1" >
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Create Plugin</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		        	<div>Name</div>
		        	<input type="text" class="form-control" v-model="new_plugin['name']" placeholder="Name" >
		        	<div>no spaces. no special chars. except dash(-). lowercase recommended</div>
		        	<div>&nbsp;</div>
		        	<div>Description</div>
		        	<textarea class="form-control" v-model="new_plugin['des']" ></textarea>
		        	<div v-if="cmsg" class="alert alert-success" >{{ cmsg }}</div>
		        	<div v-if="cerr" class="alert alert-success" >{{ cerr }}</div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
		        <button type="button" class="btn btn-primary btn-sm"  v-on:click="createnow">Create</button>
		      </div>
		    </div>
		  </div>
		</div>
</div>
<script>
var app = Vue.createApp({
	data(){
		return {
			path: "<?=$config_global_apimaker_path ?>",
			msg: "",
			err: "",
			cmsg: "",
			cerr: "",
			plugins: [],
			show_create_api: false,
			new_plugin: {
				"name": "",
				"des": "",
			},
			create_app_modal: false,
			token: "",
		};
	},
	mounted(){},
	methods: {

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
		load_plugins(){
			this.msg = "Loading...";
			this.err = "";
			axios.post("?", {"action":"get_token","event":"getplugins","expire":2}).then(response=>{
				this.msg = "";
				if( response.status == 200 ){
					if( typeof(response.data) == "object" ){
						if( 'status' in response.data ){
							if( response.data['status'] == "success" ){
								this.token = response.data['token'];
								if( this.is_token_ok(this.token) ){
									this.load_plugins2();
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
		load_plugins2(){
			this.msg = "Loading...";
			this.err = "";
			axios.post("?",{"action":"get_plugins","token":this.token}).then(response=>{
				this.msg = "";
				if( response.status == 200 ){
					if( typeof(response.data) == "object" ){
						if( 'status' in response.data ){
							if( response.data['status'] == "success" ){
								this.plugins = response.data['data'];
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
		api_show_create_form(){
			this.create_app_modal = new bootstrap.Modal(document.getElementById('create_app_modal'));
			this.create_app_modal.show();
			this.cmsg = ""; this.cerr = "";
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
		createnow(){
			this.cerr = "";
			this.new_plugin['name'] = this.cleanit(this.new_plugin['name']);
			if( this.new_plugin['name'].trim() == "" ){
				this.cerr = "Name incorrect";
				return false;
			}
			if( this.new_plugin['des'].match(/^[a-z0-9\.\_\&\,\!\@\'\"\ \r\n]{5,200}$/i) == null ){
				this.cerr = "Description incorrect. Special chars not allowed";
				return false;
			}
			this.cmsg = "Creating...";
			axios.post("?", {
				"action": "create_api", 
				"new_plugin": this.new_plugin
			}).then(response=>{
				this.cmsg = "";
				if( response.status == 200 ){
					if( typeof(response.data) == "object" ){
						if( 'status' in response.data ){
							if( response.data['status'] == "success" ){
								this.cmsg = "Created";
								this.create_app_modal.hide();
								this.load_plugins();
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
		},
		delete_api( vi ){
			if( confirm("Are you sure?") ){
				this.msg = "Deleting...";
				this.err = "";
				axios.post("?", {"action":"get_token","event":"deleteapi"+this.plugins[vi]['_id'],"expire":1}).then(response=>{
					this.msg = "";
					if( response.status == 200 ){
						if( typeof(response.data) == "object" ){
							if( 'status' in response.data ){
								if( response.data['status'] == "success" ){
									this.token = response.data['token'];
									if( this.is_token_ok(this.token) ){
										axios.post("?", {
											"action":"delete_api",
											"token":this.token,
											"api_id": this.plugins[ vi ]['_id']
										}).then(response=>{
											this.msg = "";
											if( response.status == 200 ){
												if( typeof(response.data) == "object" ){
													if( 'status' in response.data ){
														if( response.data['status'] == "success" ){
															this.load_plugins();
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
			}
		}
	}
}).mount("#app");
</script>