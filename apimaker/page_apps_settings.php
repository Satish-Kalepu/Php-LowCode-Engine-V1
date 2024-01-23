<div id="app" v-cloak >

	<div  class="leftbar"  >
		<?php require("page_apps_leftbar.php"); ?>
	</div>
	<div style="position: fixed;left:150px; top:40px; height: 40px; width:calc( 100% - 150px ); background-color: white; border-bottom:1px solid #ccc; " >
		<div style="padding: 5px;" >
			<div>
				<div style="float:right;"><input type="button" value="Save Settings"  class="btn btn-outline-dark btn-sm" v-on:click="save_settings"></div>
				<h5 class="d-inline">{{ app__['app'] }} <span class="text-secondary">Settings</span></h5>
			</div>
		</div>
	</div>

	<div id="content_div" style="position: fixed;left:150px; top:90px; height: calc( 100% - 90px );width:calc( 100% - 150px ); overflow: auto; " >
		<div style="padding: 10px;" >

			<div class="alert alert-danger d-flex align-items-center" v-if="'settings' in app__==false" >
				<svg xmlns="http://www.w3.org/2000/svg" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" style="width:30px;" viewBox="0 0 16 16" role="img" aria-label="Warning:"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>
				<div>Configure app settings to continue</div>
			</div>

			<div v-if="msg" class="alert alert-primary" >{{ msg }}</div>
			<div v-if="err" class="alert alert-danger" >{{ err }}</div>

			<div style="border: 1px solid #ccc; margin-bottom: 20px; " >
				<div style="background-color:#e8e8e8; padding: 5px;">Cloud Hosting</div>
				<div style="padding:5px;">

					<div><label style="cursor: pointer;">Enable cloud hosting  <input type="checkbox" v-model="settings['cloud']" ></label></div>
					<template v-if="'cloud' in settings" >
						<template v-if="settings['cloud']" >

						<div class="input-group mb-3 mt-3">
						  <span class="input-group-text">https://</span>
						  <input type="text" class="form-control form-control-sm" placeholder="SubDomain"  v-model="settings['cloud-subdomain']" >
						  <span class="input-group-text">.</span>
						  <select class="form-select form-select-sm" placeholder="Server" v-model="settings['cloud-domain']" >
							<option v-for="d in cd" v-bind:value="d" >{{ d }}</option>
						  </select>
						  <span class="input-group-text">/</span>
						  <input type="text" class="form-control  form-control-sm" placeholder="Path" v-model="settings['cloud-enginepath']" >
						</div>
						<div class="text-secondary">https://{{ settings['cloud-subdomain'] + '.' + settings['cloud-domain'] }}/{{ settings['cloud-enginepath'] }}</div>

						<div>&nbsp;</div>
						<div><label style="cursor: pointer;">Use an alias name for above domain  <input type="checkbox" v-model="settings['alias']" ></label></div>
						<div v-if="settings['alias']" class="input-group mb-3 mt-3">
						  <span class="input-group-text">https://</span>
						  <input type="text" class="form-control  form-control-sm" placeholder="Alias domain" v-model="settings['alias-domain']" >
						</div>

						</template>
					</template>

					<!-- <pre>{{ settings }}</pre> -->

				</div>
			</div>

			<div style="border: 1px solid #ccc; margin-bottom: 20px; " >
				<div style="background-color:#e8e8e8; padding: 5px;">Custom Hosting</div>
				<div style="padding:5px;">
					<p><label style="cursor: pointer;">Enable custom hosting <input type="checkbox" v-model="settings['host']" ></label></p>

					<template v-if="settings['host']" >
					<div style="border: 1px solid #ccc; margin-bottom: 20px; " >
						<div style="background-color:#e8e8e8; padding: 5px;">URLs Allowed</div>
						<div style="padding:5px;">
							<div class="small">Urls with path where engine is configured</div>
							<table class="table table-sm" >
							<tr v-for="dd,di in settings['domains']">
								<td><input type="text" class="form-control form-control-sm" v-model="dd['url']" ></td>
								<td width="50"><input type="button" value="X" class="btn btn-outline-dark btn-sm" v-on:click="delete_url(di)"></td>
							</tr>
							</table>
							<div><input type="button" value="Add Engine URL Endpoint"  class="btn btn-outline-dark btn-sm" v-on:click="add_domain"></div>
						</div>
					</div>

					<div style="border: 1px solid #ccc; margin-bottom: 20px; " >
						<div style="background-color:#e8e8e8; padding: 5px;">Access Keys</div>
						<div style="padding:10px;">
							<div v-for="dd,di in settings['keys']" style=" border:1px solid #ccc; margin-bottom:10px; " >
								<div class="p-2" style="border-bottom:1px solid #ccc;" >
									<input type="button" class="btn btn-outline-light btn-sm" style="float:right;" value="X" v-on:click="delete_key(di)" >
									<div>Key: {{ dd['key'] }}</div>
								</div>
								<div class="p-2">
								<div>IPs Allowed</div>
								<div v-for="ip,ipi in dd['ips_allowed']" style="display: flex; column-gap: 5px; padding:5px;" >
									<input type="text" class="form-control form-control-sm w-auto" v-model="ip['ip']" >
									<select class="form-select form-select-sm w-auto" v-model="ip['action']" >
										<option value="Allow" >Allow</option><option value="Reject" >Reject</option>
									</select>
									<input type="button" class="btn btn-outline-dark btn-sm" value="X" class="btn btn-danger btn-sm" v-on:click="delete_ip(di,ipi)">
								</div>
								<div><input type="button" class="btn btn-outline-dark btn-sm" value="Add IP Range" v-on:click="add_ip(di)" ></div>
								</div>
							</div>
							<div style="padding: 5px;"><input type="button" class="btn btn-outline-dark btn-sm" value="Create Access Key" v-on:click="add_key" ></div>
						</div>
					</div>
					</template>

				</div>
			</div>

			<div style="border: 1px solid #ccc; margin-bottom: 20px; " >
				<div style="background-color:#e8e8e8; padding: 5px;">Other Settings</div>
				<div style="padding:5px;">
					<p>Home page </p>
					<p>Type: <select class="form-select form-select-sm w-auto d-inline" v-model="settings['homepage']['t']">
						<option value="" >Select</option>
						<option value="page" >Page</option>
						<option value="apisummary" >Api Summary</option>
					</select>
					<template v-if="settings['homepage']['t']=='page'" >
						<select class="form-select form-select-sm w-auto d-inline" v-model="settings['homepage']['v']" >
							<option v-for="p in pages" v-bind:value="p['_id']+':'+p['version_id']" >{{ p['name'] }}</option>
						</select>
					</template>
					</p>
				</div>
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
			cd: <?=json_encode($config_global_apimaker['config_cloud_domains']) ?>,
			msg: "",
			err: "",
			pages:[],
			settings: <?=json_encode($settings) ?>,
			show_create_api: false,
			new_api: { "name": "", "des": "" },
			create_app_modal: false,
			token: "",
		};
	},
	mounted(){
		if( 'cloud' in this.settings == false ){
			this.settings['cloud'] = false;
			this.settings['cloud-domain'] = "backendmaker.com";
			this.settings['cloud-subdomain'] = this.app__['app']+'';
			this.settings['cloud-enginepath'] = '';
		}
		if( 'host' in this.settings == false ){
			this.settings['host'] = true;
		}
		if( 'alias' in this.settings == false ){
			this.settings['alias'] = false;
			this.settings['alias-domain'] = "www.example.com";
		}
		if( 'homepage' in this.settings == false ){
			this.settings['homepage'] = {
				"t":"page",
				"v":"home",
			};
		}
		this.load_pages();
	},
	methods: {

		load_pages: function(){
			axios.post("?", {
				"action":"get_token",
				"event":"getpages."+this.app_id,
				"expire":2
			}).then(response=>{
				this.msg = "";
				if( response.status == 200 ){
					if( typeof(response.data) == "object" ){
						if( 'status' in response.data ){
							if( response.data['status'] == "success" ){
								this.token = response.data['token'];
								if( this.is_token_ok(this.token) ){
									this.load_pages2();
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
		load_pages2: function(){
			axios.post("?",{"action":"settings_load_pages","app_id":this.app_id,"token":this.token}).then(response=>{
				this.pages = response.data['data'];
			})
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
		add_domain: function(){
			this.settings['domains'].push({
				"domain": "example.com",
				"url": "https://www.example.com/engine/"
			});
		},
		delete_url: function(vi){
			if( this.settings['domains'].length <= 1 ){
				alert("At lease one engine endpoint is required for the application serve.");
			}else if( confirm("Are you sure to delete URL?\nPlease make sure that your existing applications are not disturbed!" ) ){
				this.settings['domains'].splice(vi,1);
			}
		},
		delete_key: function(vi){
			if( this.settings['keys'].length <= 1 ){
				alert("At lease one access key is required for application to work!\nIt is always suggested to generate another key before deleting current key");
			}else if( confirm("Are you sure to delete the Access Key?\nAny existing applications being configured with the given will fail to work!\nNote: There is no going back once deleted!" ) ){
				this.settings['keys'].splice(vi,1);
			}
		},
		delete_ip: function(di,ipi){
			if( this.settings['keys'][ di ][ 'ips_allowed' ].length <= 1 ){
				alert("At lease one ip range is required for application to work!");
			}else{
				this.settings['keys'][ di ][ 'ips_allowed' ].splice(ipi,1);
			}
		},
		add_key: function(){
			axios.post("?", {
				"action": "get_new_key",
			}).then(response=>{
				this.msg = "";
				if( response.status == 200 ){
					if( typeof(response.data) == "object" ){
						if( 'status' in response.data ){
							if( response.data['status'] == "success" ){
								this.settings['keys'].push({
									"key": response.data['key'],
									"ips_allowed": [
										{"ip": "0.0.0.0/0", "action":"Allow"}
									]
								});
							}else{
								this.err = response.data['error'];
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
		add_ip: function( ki ){
			this.settings['keys'][ ki ]['ips_allowed'].push({
				"ip": "0.0.0.0/0"
			});
		},
		save_settings(){
			this.err = "";
			this.msg = "Saving...";
			document.getElementById("content_div").scrollTo(0,0);
			axios.post("?", {
				"action": "save_app_settings", 
				"settings": this.settings
			}).then(response=>{
				this.msg = "";
				if( response.status == 200 ){
					if( typeof(response.data) == "object" ){
						if( 'status' in response.data ){
							if( response.data['status'] == "success" ){
								this.msg = "Saved Successfully";
								this.app__['settings'] = this.settings;
								setTimeout(function(v){v.msg= '';},5000,this);
							}else{
								this.err = response.data['error'];
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
	}
}).mount("#app");
</script>