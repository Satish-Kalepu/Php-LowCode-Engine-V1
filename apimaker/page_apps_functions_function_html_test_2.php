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
				<div><button class='btn btn-link btn-sm' v-on:click="s2_selbairav_tset_etaerc">Create Test Object</button></div>
				<div class="code_line"  >
					<pre title="Object or Associative List" data-type="payloadeditable" editable-type="O" data-for="s2_tttttttset" data-var="factors:v" style="margin-bottom:5px;" >{{ s2_noitaton_tcejbo_teg(s2_tttttttset['factors']['v']) }}</pre>
				</div>
				<input type="button" style="float:right;" value="SAVE TEST" v-on:click.stop="s2_ttset_evas">
				<div v-if="s2_desu_cnysa"><input type="checkbox" id="vskip_async" v-model="s2_piks_cnysa" value="yes" > <label style="cursor:pointer;" for="vskip_async" >Skip Async! Execute all stages.</label></div>
				<div><input type="checkbox" id="test_debug" v-model="s2_gubed_tset" v-on:click="s2_tnemnorivne_tset_tceles" title="Note: it would fetch too much data!" value="yes" > <label style="cursor:pointer;" for="test_debug" title="Note: it would fetch too much data!" >Retrieve debugging log!</label></div>
				<div><input class="btn btn-dark btn-sm" type="button" value="TEST" v-on:click.stop="s2_noitalumis_tset"></div>
				<div align='center' v-if="s2_gnitiaw_tset"><span class="test_loader"></span><span class="test_loader2"></span></div>
				<div v-if="s2_esnopser_tset!=false">
					<template v-if="typeof(s2_esnopser_tset)=='object'" >
						<div>Response:</div>
						<pre style="padding:5px; border:1px solid #cdcdcd;" >{{ s2_yalpsid_erofeb_naelc_esnopser(s2_esnopser_tset['body']) }}</pre>
					</template>
					<div v-else>Error: test response is not object</div>
				</div>
			</div>
			<div v-else>Select environment</div>
			<p>&nbsp;</p>
		</div>