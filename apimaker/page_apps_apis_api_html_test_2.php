		<div style="margin-bottom:5px; padding:5px;background-color:#f8f8f8; line-height:30px; border-bottom:1px solid #cdcdcd; font-size:16px;" >
			Simulation Test 
			<div class="btn btn-dark btn-sm pull-right" v-on:click="s2_bat_tset_wohs=false;s2_lluf_rotide_edoc=true">X</div>
		</div>
		<div class="test_menu_sub_div" style="padding: 5px; height: calc( 100% - 80px ); overflow: auto;">
			<div>
				Engine Environment: <select v-model="s2_tttttttset['domain']" v-on:click="s2_tnemnorivne_tset_tceles" >
					<option v-for="d,i in s2_pppppppppa['settings']['domains']" v-bind:value="d['domain']" >{{ d['domain'] }}</option>
				</select>
			</div>
			<div v-if="s2_tttttttset['domain']!=''" >
				<div v-if="s2_iiiiiiiipa['input-method']=='GET'" >Engine EndPoint: GET: <a target='_blank' v-bind:href="s2_lllru_tset" ><pre>{{ s2_tttaen_lru(s2_lllru_tset) }}</pre></a></div>
				<div v-else>Engine EndPoint: POST: {{ s2_tttaen_lru(s2_lllru_tset) }}</div>
				<!-- <pre>{{ s2_tttttttset['factors']['v'] }}</pre> -->
				<div v-if="s2_iiiiiiiipa['input-method']=='GET'">
					<div>Query String:  <button class='btn btn-link btn-sm' v-on:click="s2_selbairav_tset_etaerc">Create Test Form</button></div>
					<input_values v-bind:v="s2_tttttttset['factors']['v']" datafor="s2_tttttttset" datavar="factors:v" viewas="payload" allowsub="no" v-on:edited="s2_detide_srotcaf_tset"></input_values>
				</div>
				<div v-else>
					<div><button class='btn btn-link btn-sm' v-on:click="s2_selbairav_tset_etaerc">Create Test Object</button></div>
					<div class="code_line"  >
						<pre v-if="s2_iiiiiiiipa['input-type']=='application/json'" title="Object or Associative List" data-type="payloadeditable" editable-type="O" data-for="s2_tttttttset" data-var="factors:v" style="margin-bottom:5px;" >{{ s2_noitaton_tcejbo_teg(s2_tttttttset['factors']['v']) }}</pre>
						<input_values v-else v-bind:v="s2_tttttttset['factors']['v']" datafor="s2_tttttttset" datavar="factors:v" viewas="payload" allowsub="no" v-on:edited="s2_detide_srotcaf_tset"></input_values>
					</div>
				</div>
				<div class="d-flex" style="float:right;">
					<input type="button" style="margin-right: 5px;" value="SAVE TEST" v-on:click.stop="s2_ttset_evas">
					<input type="button" style="margin-right: 5px;" value="Postman Export" v-on:click="s2_postman_export(btoa(s2_tttaen_lru(s2_lllru_tset)))">
					<input type="button" style="margin-right: 5px;" value="Swagger Export" >
					<input type="button" style="margin-right: 5px;" value="Code Snippet" v-on:click="get_code_snippt_lang(btoa(s2_tttaen_lru(s2_lllru_tset)));">
				</div>
				<div v-if="s2_desu_cnysa"><input type="checkbox" id="vskip_async" v-model="s2_piks_cnysa" value="yes" > <label style="cursor:pointer;" for="vskip_async" >Skip Async! Execute all stages.</label></div>
				<div><input type="checkbox" id="test_debug" v-model="s2_gubed_tset" v-on:click="s2_tnemnorivne_tset_tceles" title="Note: it would fetch too much data!" value="yes" > <label style="cursor:pointer;" for="test_debug" title="Note: it would fetch too much data!" >Retrieve debugging log!</label></div>
				<div><input class="btn btn-dark btn-sm" type="button" value="TEST" v-on:click.stop="s2_noitalumis_tset"></div>
				<div align='center' v-if="s2_gnitiaw_tset"><span class="test_loader"></span><span class="test_loader2"></span></div>
				<div v-if="s2_esnopser_tset!=false">
					<template v-if="typeof(s2_esnopser_tset)=='object'" >
					<div v-if="'status' in s2_esnopser_tset" >
						<div v-bind:class="{'m-1':1, 'text-success':s2_esnopser_tset['status']==200, 'text-danger':s2_esnopser_tset['status']!=200  }" ><b style='font-size:14px;'><em>Http Status:</em> {{ s2_esnopser_tset['status'] }}</b></div>
						<div>Headers: <button v-if="s2_wohs_sredaeh_tset==false" class='btn btn-link btn-sm' v-on:click="s2_wohs_sredaeh_tset=true">Show</button><button v-if="s2_wohs_sredaeh_tset" class='btn btn-link btn-sm' v-on:click="s2_wohs_sredaeh_tset=false">Hide</button></div>
						<table v-if="s2_wohs_sredaeh_tset" class="table table-bordered table-sm" style="width:initial;" >
						<tr v-for="v,i in s2_esnopser_tset['headers']">
							<td  nowrap>{{ i }}</td><td>{{ v }}</td>
						</tr>
						</table>
						<div v-if="'content-type' in s2_esnopser_tset['headers']" >
							<div>Content-Type: {{ s2_esnopser_tset['headers']['content-type'] }}</div>
							<div v-if="s2_iiiiiiiipa['output-type']=='application/json'&&typeof(s2_esnopser_tset['body'])!='object'" class="text-danger">Incorrect response type</div>
							<div>Response Body:</div>
							<pre style="padding:5px; border:1px solid #cdcdcd;" >{{ s2_yalpsid_erofeb_naelc_esnopser(s2_esnopser_tset['body']) }}</pre>
						</div>
					</div>
					</template>
					<div v-else>Error: test response is not object</div>
				</div>
			</div>
			<div v-else>Select environment</div>
			<p>&nbsp;</p>
			<div class="mt-2" v-if="show_code_snippet == true" style="width: 99%">
				<div class="row">
					<div class="col-2">
						<select v-model="selected_lang" class="form-select" v-on:change="get_code_snippt_lang(btoa(s2_tttaen_lru(s2_lllru_tset)))">
							<option v-for="i in code_snippet_lang" :value="i">{{i}}</option>
						</select>
					</div>
					<div class="col-8"></div>
					<div class="col-2 d-flex justify-content-end">
						<button class="btn btn-sm btn-primary" v-on:click="copy_code_snippet()">Click to Copy</button>
					</div>
				</div>
				<div class="mt-2">
					<pre>{{code_snippet_data}}</pre>
				</div>
			</div>
		</div>