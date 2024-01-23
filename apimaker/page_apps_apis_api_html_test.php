		<div style="margin-bottom:5px; padding:5px;background-color:#f8f8f8; line-height:30px; border-bottom:1px solid #cdcdcd; font-size:16px;" >
			Simulation Test 
			<div class="btn btn-dark btn-sm pull-right" v-on:click="show_test_tab__=false;code_editor_full__=true">X</div>
		</div>
		<div class="test_menu_sub_div" style="padding: 5px; height: calc( 100% - 80px ); overflow: auto;">
			<div>
				Engine Environment: <select v-model="test__['domain']" v-on:click="select_test_environment__" >
					<option v-for="d,i in app__['settings']['domains']" v-bind:value="d['domain']" >{{ d['domain'] }}</option>
				</select>
			</div>
			<div v-if="test__['domain']!=''" >
				<div v-if="api__['input-method']=='GET'" >Engine EndPoint: GET: <a target='_blank' v-bind:href="test_url__" ><pre>{{ url_neat__(test_url__) }}</pre></a></div>
				<div v-else>Engine EndPoint: POST: {{ url_neat__(test_url__) }}</div>
				<!-- <pre>{{ test__['factors']['v'] }}</pre> -->
				<div v-if="api__['input-method']=='GET'">
					<div>Query String:  <button class='btn btn-link btn-sm' v-on:click="create_test_variables__">Create Test Form</button></div>
					<input_values v-bind:v="test__['factors']['v']" datafor="test__" datavar="factors:v" viewas="payload" allowsub="no" v-on:edited="test_factors_edited__"></input_values>
				</div>
				<div v-else>
					<div><button class='btn btn-link btn-sm' v-on:click="create_test_variables__">Create Test Object</button></div>
					<div class="code_line"  >
						<pre v-if="api__['input-type']=='application/json'" title="Object or Associative List" data-type="payloadeditable" editable-type="O" data-for="test__" data-var="factors:v" style="margin-bottom:5px;" >{{ get_object_notation__(test__['factors']['v']) }}</pre>
						<input_values v-else v-bind:v="test__['factors']['v']" datafor="test__" datavar="factors:v" viewas="payload" allowsub="no" v-on:edited="test_factors_edited__"></input_values>
					</div>
				</div>
				<input type="button" style="float:right;" value="SAVE TEST" v-on:click.stop="save_test__">
				<div v-if="async_used__"><input type="checkbox" id="vskip_async" v-model="async_skip__" value="yes" > <label style="cursor:pointer;" for="vskip_async" >Skip Async! Execute all stages.</label></div>
				<div><input type="checkbox" id="test_debug" v-model="test_debug__" v-on:click="select_test_environment__" title="Note: it would fetch too much data!" value="yes" > <label style="cursor:pointer;" for="test_debug" title="Note: it would fetch too much data!" >Retrieve debugging log!</label></div>
				<div><input class="btn btn-dark btn-sm" type="button" value="TEST" v-on:click.stop="test_simulation__"></div>
				<div align='center' v-if="test_waiting__"><span class="test_loader"></span><span class="test_loader2"></span></div>
				<div v-if="test_response__!=false">
					<template v-if="typeof(test_response__)=='object'" >
					<div v-if="'status' in test_response__" >
						<div v-bind:class="{'m-1':1, 'text-success':test_response__['status']==200, 'text-danger':test_response__['status']!=200  }" ><b style='font-size:14px;'><em>Http Status:</em> {{ test_response__['status'] }}</b></div>
						<div>Headers: <button v-if="test_headers_show__==false" class='btn btn-link btn-sm' v-on:click="test_headers_show__=true">Show</button><button v-if="test_headers_show__" class='btn btn-link btn-sm' v-on:click="test_headers_show__=false">Hide</button></div>
						<table v-if="test_headers_show__" class="table table-bordered table-sm" style="width:initial;" >
						<tr v-for="v,i in test_response__['headers']">
							<td  nowrap>{{ i }}</td><td>{{ v }}</td>
						</tr>
						</table>
						<div v-if="'content-type' in test_response__['headers']" >
							<div>Content-Type: {{ test_response__['headers']['content-type'] }}</div>
							<div v-if="api__['output-type']=='application/json'&&typeof(test_response__['body'])!='object'" class="text-danger">Incorrect response type</div>
							<div>Response Body:</div>
							<pre style="padding:5px; border:1px solid #cdcdcd;" >{{ response_clean_before_display__(test_response__['body']) }}</pre>
						</div>
					</div>
					</template>
					<div v-else>Error: test response is not object</div>
				</div>
			</div>
			<div v-else>Select environment</div>
			<p>&nbsp;</p>
		</div>