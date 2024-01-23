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
				<div><button class='btn btn-link btn-sm' v-on:click="create_test_variables__">Create Test Object</button></div>
				<div class="code_line"  >
					<pre title="Object or Associative List" data-type="payloadeditable" editable-type="O" data-for="test__" data-var="factors:v" style="margin-bottom:5px;" >{{ get_object_notation__(test__['factors']['v']) }}</pre>
				</div>
				<input type="button" style="float:right;" value="SAVE TEST" v-on:click.stop="save_test__">
				<div v-if="async_used__"><input type="checkbox" id="vskip_async" v-model="async_skip__" value="yes" > <label style="cursor:pointer;" for="vskip_async" >Skip Async! Execute all stages.</label></div>
				<div><input type="checkbox" id="test_debug" v-model="test_debug__" v-on:click="select_test_environment__" title="Note: it would fetch too much data!" value="yes" > <label style="cursor:pointer;" for="test_debug" title="Note: it would fetch too much data!" >Retrieve debugging log!</label></div>
				<div><input class="btn btn-dark btn-sm" type="button" value="TEST" v-on:click.stop="test_simulation__"></div>
				<div align='center' v-if="test_waiting__"><span class="test_loader"></span><span class="test_loader2"></span></div>
				<div v-if="test_response__!=false">
					<template v-if="typeof(test_response__)=='object'" >
						<div>Response:</div>
						<pre style="padding:5px; border:1px solid #cdcdcd;" >{{ response_clean_before_display__(test_response__['body']) }}</pre>
					</template>
					<div v-else>Error: test response is not object</div>
				</div>
			</div>
			<div v-else>Select environment</div>
			<p>&nbsp;</p>
		</div>