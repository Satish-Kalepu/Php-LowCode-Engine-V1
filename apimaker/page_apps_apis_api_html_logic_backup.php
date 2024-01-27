				<div id="div_input_factors" >
					<table class='table table-sm table-bordered' style='width:initial;'>
						<tr>
							<td>Type</td>
							<template v-if="api__['type']!='function'">
							<td>Method</td>
							<td>Input</td>
							<td>Output</td>
							<td>-</td>
							</template>
						</tr>
						<tr>
							<td>
								<select v-model="api__['type']" v-on:change="page_type_change__" >
									<option value="api">Api</option>
									<option value="function">Function</option>
								</select>
							</td>
							<template v-if="api__['type']!='function'">
							<td>
								<select v-model="api__['input-method']"  v-on:change="page_method_change__" >
									<option value="GET">GET</option>
									<option value="POST">POST</option>			
								</select>
							</td>
							<td v-if="api__['input-method']=='POST'">
								<select v-model="api__['input-type']" v-on:change="input_type_change__" >
									<option value="application/json">application/json</option>
									<option value="application/x-www-form-urlencoded">application/x-www-form-urlencoded</option>
								</select>
							</td>
							<td v-if="api__['input-method']=='GET'">
								<select v-model="api__['input-type']" >
									<option value="query_string">Query String</option>
								</select>
							</td>
							<td>
								<select v-model="api__['output-type']" v-on:change="save_need__=true" >
									<option value="application/json">application/json</option>
									<option value="text/xml"	>text/xml</option>
								</select>
							</td>
							</template>
						</tr>
					</table>
					<div style="border-bottom:1px solid #bbcccc; margin-bottom:10px;" >
						<div v-if="api__['input-type']=='application/json'">
							<div style="font-size:14px; ">Input JSON: </div>
							<input_object v-bind:items="engine__['input_factors']" v-on:edited="input_factors_edited__"></input_object>
						</div>
						<div v-if="api__['input-type']=='query_string'">
							<div style="font-size:14px; ">URL Query String</div>
							<input_factors_list v-bind:items="engine__['input_factors']" v-on:edited="input_factors_edited__"></input_factors_list>
						</div>
						<div v-if="api__['input-type']=='application/x-www-form-urlencoded'">
							<div style="font-size:14px; ">Input Post Fields: </div>
							<input_factors_list v-bind:items="engine__['input_factors']" v-on:edited="input_factors_edited__"></input_factors_list>
						</div>
					</div>
					<div v-if="verror__" class="alert alert-danger" v-html="verror__" ></div>
				</div>
				<div style="background-color:white;" v-if="show_stages__" >
					<div style="font-size:14px; border-bottom:1px solid #cdcdcd; margin-bottom:5px; ">Stages of Execution: Develop & derive logical result</div>
					<div style="height:35px;" >
						<div id="div_stages" ref="div_stages" style="height:35px; display:block; width:99%; background-color:white; border-bottom:1px solid #cdcdcd; " >
							<div id="div_stages_menu" ref="div_stages_menu" style="position:absolute; background-color:white; z-index:50; height:30px; padding:5px 5px;" >
								<div v-if="checked_items__" >
									<div style="padding:0px 10px; display:inline-block;" >
									Selected <span class="badge badge-dark text-white" >{{ checked_items__ }}</span>
									</div>
									<button class="btn btn-success btn-sm text-white" type="button" style="padding:3px;" v-on:click="duplicate_stages__" >Copy</button>
									<button class="btn btn-default btn-sm" type="button" style="padding:3px; width:30px;font-weight:bold;color:black;" v-on:click="move_up__" >&#8673;</button>
									<button class="btn btn-default btn-sm" type="button" style="padding:3px; width:30px;font-weight:bold;color:black;" v-on:click="move_down__" >&#8675;</button>
									<button class="btn btn-danger btn-sm text-white" type="button"  style="padding:3px;" v-on:click="delete_stages__" >Delete</button>
									<button class="btn btn-default btn-sm" type="button"  style="padding:3px;" v-on:click="uncheck_all__" >Reset</button>
								</div>
							</div>
							<div style='margin-left:10px; padding:5px;'>Selected <span class="badge badge-dark text-white" >0</span></div>
						</div>
					</div>
					<div v-for="staged__,stagei__ in engine__['stages']" class="myrow1" >
						<div class="mycol1" >
							<input type="checkbox" v-bind:disabled="is_locked__||staged__['type']=='HTMLElementEnd'||staged__['type']=='EndIf'||staged__['type']=='EndWhile'||staged__['type']=='EndForEach'||checks__[stagei__]['if']" v-model="checks__[stagei__]['checked']"  v-on:click="item_clicked__(stagei__)"  style="width:20px;height:20px;" >
						</div>
						<div class="mycol1" >
							<input type="button"  v-if="checked_items__==0" value="+" v-on:click="add_stage__(stagei__)" style="padding:0px 5px;" v-bind:disabled="is_locked__" >
						</div>
						<div class="mycol2" >
							<input type="button" v-if="staged__['e']&&staged__['type']!='DB'&&staged__['type']!='ElasticTable'&&staged__['type']!='DynamicTable'" value="&check;" style="position:absolute; margin-left:5px; " v-on:click="hide_edit_stage__(stagei__,'all')" >
							<div style="width:40px; padding:5px;" align='right'>{{ (stagei__+1) }}</div>
						</div>
						<div class="mycol3" v-on:click.stop="hide_edit_stage__(stagei__, 'others')">
							<div v-if="staged__['er']" style="float:left; width:10px; background-color:red;cursor:pointer;color:black;" v-bind:title="staged__['er']" v-on:click="alert(staged__['er'])"> * </div>
							<div v-if="staged__['error']" style="float:left; width:10px; background-color:red;cursor:pointer;color:black;" v-bind:title="staged__['error_msg']" v-on:click="alert(staged__['error_msg'])"> * </div>
							<div v-bind:style="getlevel__(stagei__)" >
								<pre class="stagedisp" v-if="staged__['e']==false" v-html="staged__['d']" v-on:click.stop="show_edit_stage__(stagei__)" ></pre>
								<table v-else class="table_noborder_padding3" style="width:100%;">
									<tr valign="top">
										<td width="110" >
											<select v-if="staged__['type']!='EndIf'&&staged__['type']!='EndWhile'&&staged__['type']!='EndForEach'&&staged__['type']!='EndFor'" v-bind:id="'state_type_'+stagei__" v-model="staged__['type']" v-on:change="stage_change_stage__(stagei__)" v-bind:disabled="is_locked__" style="display:inline-block; ">
												<template v-for="grp__,groupi in stages_by_type__" >
												<optgroup v-bind:label="grp__['group']" > 
													<template v-for="stagetype__,stagetypei__ in grp__['sub']" >
													<option v-bind:value="stagetypei__" >{{ stagetypei__ }}</option>
													</template>
												</optgroup>
												</template>
												<optgroup label="Current Stage" v-if="staged__['type']!=''&&staged__['type']!='none'" >
													<option v-bind:value="staged__['type']">{{ staged__['type'] }}</option>
												</optgroup>
											</select>
										</td>
										<td>
											<div v-if="staged__['type']=='HTMLElement'" style="display:inline-block; width:100%;" >
												<table>
													<tr valign="top">
														<td>
															<select v-bind:disabled="is_locked__" v-model="staged__['htmlelement']['tag']" v-on:change="html_element_change__(stagei__)" >
																<option v-for="vr__,vi__ in html_elements__" v-bind:value="vi__" >{{ vi__ }}</option>
																<option v-if="staged__['htmlelement']['tag']=='none'" value="none">None</option>
															</select>
														</td>
														<td>
															<div>Attributes:</div>
															<table>
																<tr v-for="av__,ai__ in staged__['htmlelement']['attr']">
																	<td><input type="text" v-model="av__['name']" style="width:100px;"></td>
																	<td><input type="text" v-model="av__['value']" style="width:100px;"></td>
																	<td><input type="button" value="X" v-on:click="htmlelement_del_attribute__(stagei__,ai__)"></td>
																</tr>
																<tr>
																	<td><input type="button" value="+" v-on:click="htmlelement_add_attribute__(stagei__)"></td>
																</tr>
															</table>
														</td><td>
															<div>Styles:</div>
															<table>
															<tr v-for="av__,ai__ in staged__['htmlelement']['styles']">
																<td><input type="text" v-model="av__['name']" style="width:100px;"></td>
																<td><input type="text" v-model="av__['value']" style="width:100px;"></td>
																<td><input type="button" value="X" v-on:click="htmlelement_del_style__(stagei__,ai__)"></td>
															</tr>
															<tr>
																<td><input type="button" value="+" v-on:click="htmlelement_add_style__(stagei__)"></td>
															</tr>
															</table>
														</td>
													</tr>
												</table>
											</div>
											<div v-if="staged__['type']=='HTMLElementEnd'" style="display:inline-block; width:100%;" >{{ staged__['d'] }}</div>
											<div v-if="staged__['type']=='EndIf'" style="display:inline-block; width:100%;" >EndIf</div>
											<div v-if="staged__['type']=='If'" style="display:inline-block; width:100%;" >
												<div style="display:inline-block; vertical-align:top;" >
													<div v-for="ifv__,ifi__ in staged__['cond']" >
														<select v-bind:disabled="is_locked__" v-model="ifv__['lhs']" v-on:change="updated_option__(stagei__)" style="width:150px; vertical-align:top;">
															<option v-for="vr__,vi__ in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi__" v-bind:disabled="vi__.indexOf('[]')>1" >{{ vi__ }} - [{{ vr__['type'] }}]</option>
															<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,ifv__['lhs'])&&typeof(ifv__['lhs'])=='string'" >
																<option v-bind:value="ifv__['lhs']" >{{ get_v_name__(ifv__['lhs']) }}</option>
															</optgroup>
														</select>
														<select v-bind:disabled="is_locked__" v-model="ifv__['operator']" v-on:change="updated_option__(stagei__)" style="width:80px; vertical-align:top;">
															<option value="==">==</option>
															<option value="!=">!=</option>
															<option value=">">&gt;</option>
															<option value=">=">&gt;=</option>
															<option value="<">&lt;</option>
															<option value="<=">&lt;=</option>
															<option value="contain">contain</option>
														</select>
														<select v-bind:disabled="is_locked__" v-model="ifv__['rhs']['type']" v-on:change="updated_option__(stagei__)" style="width:100px; vertical-align:top;">
															<option value="text" title="Text">Text</option>
															<option value="number" title="Number">Number</option>
															<option value="date">Date</option>
															<option value="variable" title="Variable">Variable</option>
															<option value="null" title="Null or Zero or Empty">Null/Zero</option>
															<option value="boolean">Boolean</option>
															<option value="list" title="Match one option">Options</option>
														</select>
														<textarea v-bind:disabled="is_locked__" v-if="ifv__['rhs']['type']=='list'" v-model="ifv__['rhs']['value']" placeholder="List of options" title="Enter one item in each line" style="width:150px; height:50px;resize:both;white-space:nowrap; vertical-align:top;"  v-on:change="updated_option__(stagei__)"></textarea>
														<input  v-bind:disabled="is_locked__" v-if="ifv__['rhs']['type']=='text'||ifv__['rhs']['type']=='number'||ifv__['rhs']['type']=='date'" v-model="ifv__['rhs']['value']" v-bind:type="ifv__['rhs']['type']" v-bind:placeholder="ifv__['rhs']['type']+' to match'" v-bind:title="ifv__['rhs']['type']+' to match'" style="width:150px; vertical-align:top;"  v-on:change="updated_option__(stagei__)">
														<select v-bind:disabled="is_locked__" v-if="ifv__['rhs']['type']=='boolean'" v-model="ifv__['rhs']['value']" title="Boolean to Value" v-on:change="updated_option__(stagei__)" >
															<option value="true">True</option>
															<option value="false">False</option>
														</select>
														<select v-bind:disabled="is_locked__" v-if="ifv__['rhs']['type']=='variable'" v-model="ifv__['rhs']['value']" title="Variable to Match" v-on:change="updated_option__(stagei__)" style="width:150px; vertical-align:top;">
															<option v-for="vr__,vi__ in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi__" v-bind:disabled="vi__.indexOf('[]')>1" >{{ vi__ }} - [{{ vr__['type'] }}]</option>
															<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,ifv__['rhs']['value'])&&typeof(ifv__['rhs']['value'])=='string'" >
															<option v-bind:value="ifv__['rhs']['value']" >{{ get_v_name__(ifv__['rhs']['value']) }}</option>
															</optgroup>
														</select>
														<input v-bind:disabled="is_locked__" v-if="staged__['cond'].length" class="btn btn-light btn-sm btnsp" type="button" v-on:click="delete_if_condition__(stagei__, ifi__)" title="Add Condition" value="x">&nbsp;<input v-if="ifi__==staged__['cond'].length-1" class="btn btn-light btn-sm btnsp float-right" type="button" v-on:click="add_if_condition__(stagei__)" title="Add Condition" value="+" style=" vertical-align:top;">
													</div>
												</div>
											</div>
											<div v-if="staged__['type']=='EndWhile'" style="display:inline-block; width:100%;" >EndWhile</div>
											<div v-if="staged__['type']=='While'" style="display:inline-block; width:100%;" >
												<div style="display:inline-block; vertical-align:top;" >
													<div v-for="ifv__,ifi__ in staged__['cond']" >
														<select v-bind:disabled="is_locked__" v-model="ifv__['lhs']" v-on:change="updated_option__(stagei__)" style="width:150px; vertical-align:top;">
															<option v-for="vr__,vi__ in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi__" v-bind:disabled="vi__.indexOf('[]')>1" >{{ vi__ }} - [{{ vr__['type'] }}]</option>
															<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,ifv__['lhs'])&&typeof(ifv__['lhs'])=='string'" >
																<option v-bind:value="ifv__['lhs']" >{{ get_v_name__(ifv__['lhs']) }}</option>
															</optgroup>
														</select>
														<select v-bind:disabled="is_locked__" v-model="ifv__['operator']" v-on:change="updated_option__(stagei__)" style="width:80px; vertical-align:top;">
															<option value="==">==</option>
															<option value="!=">!=</option>
															<option value=">">&gt;</option>
															<option value=">=">&gt;=</option>
															<option value="<">&lt;</option>
															<option value="<=">&lt;=</option>
															<option value="contain">contain</option>
														</select>
														<select v-bind:disabled="is_locked__" v-model="ifv__['rhs']['type']" v-on:change="updated_option__(stagei__)" style="width:100px; vertical-align:top;">
															<option value="text" title="Text">Text</option>
															<option value="number" title="Number">Number</option>
															<option value="date">Date</option>
															<option value="variable" title="Variable">Variable</option>
															<option value="null" title="Null or Zero or Empty">Null/Zero</option>
															<option value="boolean">Boolean</option>
															<option value="list" title="Match one option">Options</option>
														</select>
														<textarea v-bind:disabled="is_locked__" v-if="ifv__['rhs']['type']=='list'" v-model="ifv__['rhs']['value']" placeholder="List of options" title="Enter one item in each line" style="width:150px; height:50px;resize:both;white-space:nowrap; vertical-align:top;" v-on:change="updated_option__(stagei__)"></textarea>
														<input  v-bind:disabled="is_locked__" v-if="ifv__['rhs']['type']=='text'||ifv__['rhs']['type']=='number'||ifv__['rhs']['type']=='date'" v-model="ifv__['rhs']['value']" v-bind:type="ifv__['rhs']['type']" v-bind:placeholder="ifv__['rhs']['type']+' to match'" v-bind:title="ifv__['rhs']['type']+' to match'" style="width:150px; vertical-align:top;"  v-on:change="updated_option__(stagei__)">
														<select v-bind:disabled="is_locked__" v-if="ifv__['rhs']['type']=='boolean'" v-model="ifv__['rhs']['value']" title="Boolean to Value" v-on:change="updated_option__(stagei__)" >
															<option value="true">True</option>
															<option value="false">False</option>
														</select>
														<select v-bind:disabled="is_locked__" v-if="ifv__['rhs']['type']=='variable'" v-model="ifv__['rhs']['value']" title="Variable to Match" v-on:change="updated_option__(stagei__)" style="width:150px; vertical-align:top;">
															<option v-for="vr__,vi__ in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi__" v-bind:disabled="vi__.indexOf('[]')>1" >{{ vi__ }} - [{{ vr__['type'] }}]</option>
															<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,ifv__['rhs']['value'])&&typeof(ifv__['rhs']['value'])=='string'" >
															<option v-bind:value="ifv__['rhs']['value']" >{{ get_v_name(ifv__['rhs']['value']) }}</option>
															</optgroup>
														</select>
														<input v-bind:disabled="is_locked__" v-if="staged__['cond'].length" class="btn btn-light btn-sm btnsp" type="button" v-on:click="delete_if_condition__(stagei__,ifi__)" title="Add Condition" value="x">&nbsp;<input v-if="ifi__==staged__['cond'].length-1" class="btn btn-light btn-sm btnsp float-end" type="button" v-on:click="add_if_condition__(stagei__)" title="Add Condition" value="+" style=" vertical-align:top;">
													</div>
												</div>
											</div>
											<div v-if="staged__['type']=='EndForEach'" style="display:inline-block; width:100%;" >EndForEach</div>
											<div v-if="staged__['type']=='ForEach'" style="display:inline-block; width:100%;" >
												<select v-bind:disabled="is_locked__" v-model="staged__['foreach']['var']" v-on:change="updated_option__(stagei__)" style="vertical-align:top;">
													<option v-for="vr__,vi__ in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi__" v-bind:disabled="vi__.indexOf('[]')>1" >{{ vi__ }} - [{{ vr__['type'] }}]</option>
													<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['foreach'])&&typeof(staged__['foreach'])=='string'" >
														<option v-bind:value="staged__['foreach']" >{{ staged__['foreach'] }}</option>
													</optgroup>
												</select>
												as <input type="text" v-model="staged__['foreach']['key']" placeholder="Key" style="width:100px;">, <input type="text" v-model="staged__['foreach']['value']" placeholder="Value" style="width:100px;">
											</div>
											<div v-if="staged__['type']=='For'" style="display:inline-block; width:100%;" >
												<table class="simpleborder" >
													<tr>
														<td>Start</td>
														<td>End</td>
														<td>Order</td>
														<td>Modifier</td>
														<td>As</td>
														<td>Max Loops</td>
													</tr>
													<tr>
														<td>
															<select v-bind:disabled="is_locked__" v-model="staged__['for']['start']['type']" v-on:change="updated_option__(stagei__)" style="width:100px; vertical-align:top;">
																<option value="number" >Number</option>
																<option value="variable" >Variable</option>
															</select>
															<select v-bind:disabled="is_locked__" v-if="staged__['for']['start']['type']=='variable'" v-model="staged__['for']['start']['value']" v-on:change="updated_option__(stagei__)" style="width:150px; vertical-align:top;">
																<option v-for="vr__,vi__ in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi__" v-bind:disabled="vi__.indexOf('[]')>1" >{{ vi__ }} - [{{ vr__['type'] }}]</option>
																<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['for']['start']['value'])&&typeof(staged__['for']['start']['value'])=='string'" >
																	<option v-bind:value="staged__['for']['start']['value']" >{{ get_v_name__(staged__['for']['start']['value']) }}</option>
																</optgroup>
															</select>
															<input type="number" v-else v-model="staged__['for']['start']['value']" style="width:80px;" >
														</td>
														<td>
															<select v-bind:disabled="is_locked__" v-model="staged__['for']['end']['type']" v-on:change="updated_option__(stagei__)" style="width:100px; vertical-align:top;">
																<option value="number" >Number</option>
																<option value="variable" >Variable</option>
															</select>
															<select v-bind:disabled="is_locked__" v-if="staged__['for']['end']['type']=='variable'" v-model="staged__['for']['end']['value']" v-on:change="updated_option__(stagei__)" style="width:150px; vertical-align:top;">
																<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
																<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['for']['end']['value'])&&typeof(staged__['for']['end']['value'])=='string'" >
																	<option v-bind:value="staged__['for']['end']['value']" >{{ get_v_name__(staged__['for']['end']['value']) }}</option>
																</optgroup>
															</select>
															<input type="number" v-else v-model="staged__['for']['end']['value']" style="width:80px;" >
														</td>
														<td>
															<select v-bind:disabled="is_locked__" v-model="staged__['for']['order']['type']" v-on:change="updated_option__(stagei__)" style="width:100px; vertical-align:top;">
																<option value="text" >Text</option>
																<option value="variable" >Variable</option>
															</select>
															<select v-bind:disabled="is_locked__" v-if="staged__['for']['order']['type']=='variable'" v-model="staged__['for']['order']['value']" v-on:change="updated_option__(stagei__)" style="width:150px; vertical-align:top;">
																<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
																<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['for']['order']['value'])&&typeof(staged__['for']['order']['value'])=='string'" >
																	<option v-bind:value="staged__['for']['order']['value']" >{{ get_v_name__(staged__['for']['order']['value']) }}</option>
																</optgroup>
															</select>
															<select v-bind:disabled="is_locked__" v-if="staged__['for']['order']['type']=='text'" v-model="staged__['for']['order']['value']" v-on:change="updated_option__(stagei__)" style="width:50px; vertical-align:top;">
																<option value="asc">asc</option><option value="dsc"  >dsc</option>
															</select>
														</td>
														<td>
															<select v-bind:disabled="is_locked__" v-model="staged__['for']['modifier']['type']" v-on:change="updated_option__(stagei__)" style="width:100px; vertical-align:top;">
																<option value="number" >Number</option>
																<option value="variable" >Variable</option>
															</select>
															<select v-bind:disabled="is_locked__" v-if="staged__['for']['modifier']['type']=='variable'" v-model="staged__['for']['modifier']['value']" v-on:change="updated_option__(stagei__)" style="width:150px; vertical-align:top;">
																<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
																<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['for']['modifier']['value'])&&typeof(staged__['for']['modifier']['value'])=='string'" >
																	<option v-bind:value="staged__['for']['modifier']['value']" >{{ get_v_name__(staged__['for']['modifier']['value']) }}</option>
																</optgroup>
															</select>
															<input type="number" v-else v-model="staged__['for']['modifier']['value']" style="width:80px;" >
														</td>
														<td><input type="text" v-model="staged__['for']['as']" style="width:50px;" ></td>
														<td><input type="number" v-model="staged__['for']['maxloops']['value']" style="width:80px;" ></td>
													</tr>
												</table>
											</div>
											<div v-if="staged__['type']=='Let'"  style="display:inline-block; width:100%;">
												<table class="simple_code_t3" v-if="'let' in staged__">
													<tr valign="top">
														<td><input type="text" v-model="staged__['let']['name']" v-on:blur="let_name_change__(stagei__)" placeholder="Variable Name" style="width:150px;"  v-bind:disabled="is_locked__" /></td>
														<td>=</td>
														<td>
															<select v-bind:disabled="is_locked__" v-model="engine__['stages'][stagei__]['let']['type']" style="width:150px;" v-on:change="updated_option__(stagei__,'LetChange')"  >
																<option v-for="v2,k2 in input_factor_types__" v-bind:value="k2" v-html="v2"></option>
															</select>
														</td>
														<td>
															<select v-bind:disabled="is_locked__" v-model="staged__['let']['vtype']" >
																<option value="static">Static</option>
																<option value="variable">Variable</option>
															</select>
														</td>
														<td v-if="staged__['let']['vtype']=='variable'">
															<select v-bind:disabled="is_locked__" v-model="staged__['let']['value']" v-on:change="updated_option__(stagei__)" style="width:150px;">
																<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" >{{ vi }} - [{{ vr['type'] }}]</option>
																<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['let']['value'])&&typeof(staged__['let']['value'])=='string'" >
																<option v-bind:value="staged__['let']['value']" >{{ get_v_name__(staged__['let']['value']) }}</option>
																</optgroup>
															</select>
														</td>
														<td v-else-if="staged__['let']['type']=='text'||staged__['let']['type']=='number'||staged__['let']['type']=='date'">
															<input v-bind:disabled="is_locked__" v-model="staged__['let']['value']" v-on:change="updated_option__(stagei__)" v-bind:type="staged__['let']['type']" placeholder="Value to Assign" style="width:150px;" >
														</td>
														<td v-else-if="staged__['let']['type']=='boolean'">
															<select v-bind:disabled="is_locked__" v-model="staged__['let']['value']" >
																<option value="true">True</option>
																<option value="false">False</option>
															</select>
														</td>
													</tr>
												</table>
											</div>
											<div v-if="staged__['type']=='Output'"  style="display:inline-block; width:100%;">
												<select v-model="engine__['stages'][stagei__]['output']['type']" v-on:change="updated_option__(stagei__)" >
													<option value="variable">Variable</option>
												</select>
												<textarea v-if="engine__['stages'][stagei__]['output']['type']=='text'" type="text" v-model="engine__['stages'][stagei__]['output']['value']" placeholder="Output Text" style="width:99%;height:60px;"></textarea>
												<input v-else-if="engine__['stages'][stagei__]['output']['type']=='number'" type="number" v-model="engine__['stages'][stagei__]['output']['value']" placeholder="Output Value">
												<select v-else-if="engine__['stages'][stagei__]['output']['type']=='variable'"  v-model="engine__['stages'][stagei__]['output']['value']" v-on:change="updated_option__(stagei__, 'OutputSelect')" >
													<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:disabled="vi.indexOf('[]')!=-1" v-bind:value="vi" >{{ vi }} - [{{ vr['type'] }}]</option>
													<optgroup label="Orphan" v-if="is_it_orphan__(stagei__, staged__['output']['value'])&&typeof(staged__['output']['value'])=='string'" >
													<option v-bind:value="staged__['output']['value']" >{{ get_v_name__(staged__['output']['value']) }}</option>
													</optgroup>
												</select>
												<template v-if="api__['output-type']!='text/html'&&api__['output-type']!='text/plain'" >
													<span> As </span>
													<input type="text" v-model="engine__['stages'][stagei__]['output']['as']" placeholder="Alias name">
												</template>
											</div>
											<div v-if="staged__['type']=='OutputValue'"  style="display:inline-block; width:100%;">
												<select v-model="engine__['stages'][stagei__]['output']['value']" v-on:change="updated_option__(stagei__)" >
													<template v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" >
													<option v-if="vi.indexOf('->')==-1&&vi.indexOf('[]')==-1" v-bind:value="vi" v-bind:disabled="vr['type']!='dict'" >{{ vi }} - [{{ vr['type'] }}]</option>
													</template>
													<optgroup label="Orphan" v-if="is_it_orphan__(stagei__, staged__['output']['value'])&&typeof(staged__['output']['value'])=='string'" >
													<option v-bind:value="staged__['output']['value']" >{{ get_v_name__(staged__['output']['value']) }}</option>
													</optgroup>
												</select>
											</div>
											<div v-if="staged__['type']=='SetSession'" style="display:inline-block; width:100%;" >
												<table>
													<tr valign="top">
														<td>
															<select v-model="engine__['stages'][stagei__]['setsession']['lhs']" v-on:change="updated_option__(stagei__)" >
																<template v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]">
																<option  v-if="vi.indexOf('[]')==-1&&vi.indexOf('session_->')==0" v-bind:value="vi" >{{ vi }} - [{{ vr['type'] }}]</option>
																</template>
																<optgroup label="Orphan" v-if="is_it_orphan__(stagei__, staged__['setsession']['lhs'])&&typeof(staged__['setsession']['lhs'])=='string'" >
																<option v-bind:value="staged__['setsession']['lhs']" >{{ get_v_name__(staged__['setsession']['lhs']) }}</option>
																</optgroup>
															</select>
														</td>
														<td>=</td>
														<td>
															<select v-model="engine__['stages'][stagei__]['setsession']['rhs']['type']" v-on:change="updated_option__(stagei__)" >
																<option value="text">Text</option>
																<option value="number">Number</option>
																<option value="variable">Variable</option>
															</select>
														</td>
														<td>
															<textarea v-if="engine__['stages'][stagei__]['setsession']['rhs']['type']=='text'" type="text" v-model="engine__['stages'][stagei__]['setsession']['rhs']['value']" placeholder="setsession Text" style="width:99%;height:60px;"></textarea>
															<input v-else-if="engine__['stages'][stagei__]['setsession']['rhs']['type']=='number'" type="number" v-model="engine__['stages'][stagei__]['setsession']['rhs']['value']" placeholder="setsession Value">
															<select v-else-if="engine__['stages'][stagei__]['setsession']['rhs']['type']=='variable'"  v-model="engine__['stages'][stagei__]['setsession']['rhs']['value']" v-on:change="updated_option__(stagei__)" >
																<template v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]">
																<option v-if="vi.indexOf('[]')==-1" v-bind:value="vi" >{{ vi }} - [{{ vr['type'] }}]</option>
																</template>
																<optgroup label="Orphan" v-if="is_it_orphan__(stagei__, staged__['setsession']['rhs']['value'])&&typeof(staged__['setsession']['rhs']['value'])=='string'" >
																<option v-bind:value="staged__['setsession']['rhs']['value']" >{{ get_v_name__(staged__['setsession']['rhs']['value']) }}</option>
																</optgroup>
															</select>
														</td>
													</tr>
												</table>
											</div>
											<div v-if="staged__['type']=='SetCookie'" style="display:inline-block; width:100%;" >
												<table>
													<tr valign="top">
														<td><input type="text" v-model="engine__['stages'][stagei__]['setcookie']['lhs']" v-on:change="updated_option__(stagei__)" placeholder="Cookie Name" ></td>
														<td>=</td>
														<td>
															<select v-model="engine__['stages'][stagei__]['setcookie']['rhs']['type']" v-on:change="updated_option__(stagei__)" >
																<option value="text">Text</option>
																<option value="number">Number</option>
																<option value="variable">Variable</option>
															</select>
														</td>
														<td>
															<textarea v-if="engine__['stages'][stagei__]['setcookie']['rhs']['type']=='text'" type="text" v-model="engine__['stages'][stagei__]['setcookie']['rhs']['value']" placeholder="setcookie Text" style="width:99%;height:60px;"></textarea>
															<input v-else-if="engine__['stages'][stagei__]['setcookie']['rhs']['type']=='number'" type="number" v-model="engine__['stages'][stagei__]['setcookie']['rhs']['value']" placeholder="setcookie Value">
															<select v-else-if="engine__['stages'][stagei__]['setcookie']['rhs']['type']=='variable'"  v-model="engine__['stages'][stagei__]['setcookie']['rhs']['value']" v-on:change="updated_option__(stagei__)" >
																<template v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" >
																<option  v-if="vi.indexOf('[]')==-1" v-bind:value="vi" >{{ vi }} - [{{ vr['type'] }}]</option>
																</template>
																<optgroup label="Orphan" v-if="is_it_orphan__(stagei__, staged__['setcookie']['rhs']['value'])&&typeof(staged__['setcookie']['rhs']['value'])=='string'" >
																<option v-bind:value="staged__['setcookie']['rhs']['value']" >{{ get_v_name__(staged__['setcookie']['rhs']['value']) }}</option>
																</optgroup>
															</select>
														</td>
														<td><input type="number" style="width:50px;" v-model="engine__['stages'][stagei__]['setcookie']['rhs']['time']" v-on:change="updated_option__(stagei__)" placeholder="Cookie Name" ></td>
														<td>
															<select v-model="engine__['stages'][stagei__]['setcookie']['rhs']['timetype']" v-on:change="updated_option__(stagei__)" >
																<option value="m">Minits</option>
																<option value="h">Hours</option>
																<option value="d">Days</option>
															</select>
														</td>
													</tr>
												</table>
											</div>
											<div v-if="staged__['type']=='Assign'" style="display:inline-block; width:100%;" >
												<div>
													<select v-bind:disabled="is_locked__" v-model="staged__['assign']['lhs']" v-on:change="updated_option__(stagei__)" style="width:150px;">
														<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1"  >{{ vi }} - [{{ vr['type'] }}]</option>
														<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['assign']['lhs'])&&typeof(staged__['assign']['lhs'])=='string'" >
															<option v-bind:value="staged__['assign']['lhs']" >{{ get_v_name__(staged__['assign']['lhs']) }}</option>
														</optgroup>
													</select>
													&nbsp;=&nbsp;
													<select v-bind:disabled="is_locked__" v-model="staged__['assign']['rhs']['type']" v-on:change="updated_option__(stagei__)" style="width:150px;">
														<option value="text">Text</option>
														<option value="number">Number</option>
														<option value="date">Date</option>
														<option value="variable">Variable</option>
														<option value="predefined">PreDefined</option>
														<option value="mongodb_id">MongoDb ID</option>
														<option value="json">Json</option>
														<option value="xml">XML</option>
													</select>
													<div style="display:inline;" v-if="staged__['assign']['rhs']['type']=='text'||staged__['assign']['rhs']['type']=='number'||staged__['assign']['rhs']['type']=='date'" >
														<span v-if="all_factors_stage_wise__[ stagei__ ].hasOwnProperty(staged__['assign']['lhs'])==false" >Undefined</span>
														<input  v-bind:disabled="is_locked__" v-model="staged__['assign']['rhs']['value']" v-on:change="updated_option__(stagei__)" v-bind:type="staged__['assign']['rhs']['type']" placeholder="Value to Assign" style="width:150px;" >
													</div>
													<select v-bind:disabled="is_locked__" v-if="staged__['assign']['rhs']['type']=='variable'" 	v-model="staged__['assign']['rhs']['value']" v-on:change="updated_option__(stagei__)" style="width:150px;">
														<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
														<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['assign']['rhs']['value'])&&typeof(staged__['assign']['rhs']['value'])=='string'" >
														<option v-bind:value="staged__['assign']['rhs']['value']" >{{ get_v_name__(staged__['assign']['rhs']['value']) }}</option>
														</optgroup>
													</select>
													<select v-bind:disabled="is_locked__" v-if="staged__['assign']['rhs']['type']=='predefined'" v-model="staged__['assign']['rhs']['value']" v-on:change="updated_option__(stagei__)" style="width:150px;">
														<option value="yearc">Current Year ({{current_year__}})</option>
														<option value="date">Date Today ({{date_today__}})</option>
														<option value="datefs" title="April 1st">Firm Start Date</option>
														<option value="datefe" title="March 31st">Firm End Date</option>
														<option value="datetime">Datetime Now</option>
														<option value="time">Time Now</option>
														<option value="timestamp">UnixTimeStamp</option>
													</select>
													<div v-if="staged__['assign']['rhs']['type']=='json'" >
														<div align="left" ><div class="btn btn-sm" v-on:click="set_flag__('import_json',stagei__)"><u>Import JSON Format</u></div></div>
														<div v-if="get_flag__('import_json',stagei__)" style="position:fixed;top:0px;right:0px;z-index:500; width:600px; height:100%; border-left:2px solid #999999; box-shadow:-5px 0px 5px rgba(0,0,0,0.5); background-color:white; padding:10px;" >
															<div class='btn btn-default btn-sm float-end' v-on:click="unset_flag__('import_json',stagei__)">X</div>
															<div>Paste Raw JSON text</div>
															<textarea v-model="import_json_content__" class="form-control form-control-sm" style="height:400px;" ></textarea>
															<div align='center'><div class='btn btn-primary btn-sm' v-on:click="import_json_data__(stagei__)">IMPORT</div></div>
														</div>
														<div style="border:1px solid #aaaaaa; width:800px; max-height:450px; overflow:auto;resize:both; padding:10px;">
															<vobject v-bind:items="staged__['assign']['rhs']['value']" v-bind:vinputs="all_factors_stage_wise__[ stagei__ ]" v-bind:ftype="'linked'" v-bind:vtype="'object'" v-on:edited="assign_updated__(stagei__,$event)"></vobject>
													        </div>
													</div>
													<div v-if="staged__['assign']['rhs']['type']=='xml'" >
														<div align="left" ><div class="btn btn-sm" v-on:click="set_flag__('import_xml',stagei__)"><u>Import XML Format</u></div></div>
														<div v-if="get_flag__('import_xml',stagei__)" style="position:fixed;top:0px;right:0px;z-index:500; width:600px; height:100%; border-left:2px solid #999999; box-shadow:-5px 0px 5px rgba(0,0,0,0.5); background-color:white; padding:10px;" >
															<div class='btn btn-default btn-sm float-end' v-on:click="unset_flag__('import_xml',stagei__)">X</div>
															<div>Paste Raw XML text</div>
															<textarea v-model="import_xml_content__" class="form-control form-control-sm" style="height:400px;" ></textarea>
															<div align='center'><div class='btn btn-primary btn-sm' v-on:click="import_xml_data__(stagei__)">IMPORT</div></div>
														</div>
														<div style="border:1px solid #aaaaaa; width:800px; max-height:450px; overflow:auto;resize:both; padding:10px;">
															<vobjectxml v-bind:items="staged__['assign']['rhs']['value']" v-bind:vinputs="all_factors_stage_wise__[ stagei__ ]" v-bind:istoplevel="true" v-bind:ftype="'linked'" v-bind:vtype="'object'" v-on:edited="assign_updated__(stagei__,$event)"></vobjectxml>
														</div>
													</div>
												</div>
											</div>
											<div v-if="staged__['type']=='ParseJson'" style="display:inline-block; width:100%;">
												<div>Json/Dict Variable</div>
												<select v-bind:disabled="is_locked__" v-model="staged__['parsejson']['input']" v-on:change="updated_option__(stagei__)" style="width:150px;">
													<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
													<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['parsejson']['input'])&&typeof(staged__['parsejson']['input'])=='string'" >
														<option v-bind:value="staged__['parsejson']['input']" >{{ get_v_name__(staged__['parsejson']['input']) }}</option>
													</optgroup>
												</select>
												<div>Output Mapper</div>
										                <voutputmapper_vobject    v-bind:items="staged__['parsejson']['rules']" v-bind:vtype="'object'" v-bind:ftype="'linked'" v-bind:voutputs="all_factors_stage_wise__[ stagei__ ]" v-on:edited="parsejson_updated__(stagei__, $event)"></voutputmapper_vobject>
											</div>
											<div v-if="staged__['type']=='ParseXml'" style="display:inline-block; width:100%;">
												<div>XML Variable</div>
												<select v-bind:disabled="is_locked__" v-model="staged__['parsexml']['input']" v-on:change="updated_option__(stagei__)" style="width:150px;">
													<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
													<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['parsexml']['input'])&&typeof(staged__['parsexml']['input'])=='string'" >
														<option v-bind:value="staged__['parsexml']['input']" >{{ get_v_name__(staged__['parsexml']['input']) }}</option>
													</optgroup>
												</select>
												<div>Output Mapper</div>
										                <voutputmapper_vobjectxml v-bind:items="staged__['parsexml']['rules']" v-bind:vtype="'object'" v-bind:ftype="'linked'" v-bind:voutputs="all_factors_stage_wise__[ stagei__ ]" v-on:edited="parsexml_updated__(stagei__, $event)"></voutputmapper_vobjectxml>
											</div>
											<div v-if="staged__['type']=='Math'"  style="display:inline-block; width:100%;">
												<div>
													<select v-bind:disabled="is_locked__" v-model="staged__['math']['lhs']" v-on:change="updated_option__(stagei__)" style="width:150px;">
														<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
														<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['math']['lhs'])&&typeof(staged__['math']['lhs'])=='string'" >
															<option v-bind:value="staged__['math']['lhs']" >{{ get_v_name__(staged__['math']['lhs']) }}</option>
														</optgroup>
													</select>
													&nbsp;=&nbsp;
													<select v-bind:disabled="is_locked__" v-model="staged__['math']['rhs']['a']" v-on:change="updated_option__(stagei__)" style="width:150px;">
														<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
														<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['math']['rhs']['a'])&&typeof(staged__['math']['rhs']['a'])=='string'" >
															<option v-bind:value="staged__['math']['rhs']['a']" >{{ get_v_name__(staged__['math']['rhs']['a']) }}</option>
														</optgroup>
													</select>
													<select v-bind:disabled="is_locked__" v-model="staged__['math']['rhs']['operator']" v-on:change="updated_option__(stagei__)" style="width:100px;">
														<option value="+">+ (Plus)</option>
														<option value="-">- (Minus)</option>
														<option value="*">* (Multiply)</option>
														<option value="/">/ (Divide)</option>
														<option value="%">% (Percent)</option>
														<option value="^">^ (Power<sup>^</sup>)</option>
														<option value="mod">mod (Modulus)</option>
													</select>
													<select v-bind:disabled="is_locked__" v-model="staged__['math']['rhs']['b']['type']" v-on:change="updated_option__(stagei__)" style="width:80px;">
														<option value="number">Number</option>
														<option value="variable">Variable</option>
													</select>
													<input  v-bind:disabled="is_locked__" v-if="staged__['math']['rhs']['b']['type']=='number'" v-model="staged__['math']['rhs']['b']['value']" type="number" placeholder="Number" style="width:150px;"  v-on:change="updated_option__(stagei__)">
													<select v-bind:disabled="is_locked__" v-if="staged__['math']['rhs']['b']['type']=='variable'" v-model="staged__['math']['rhs']['b']['value']"  v-on:change="updated_option__(stagei__)" style="width:150px;">
														<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
														<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['math']['rhs']['b']['value'])&&typeof(staged__['math']['rhs']['b']['value'])=='string'" >
															<option v-bind:value="staged__['math']['rhs']['b']['value']" >{{ get_v_name__(staged__['math']['rhs']['b']['value']) }}</option>
														</optgroup>
													</select>
												</div>
											</div>
											<div v-if="staged__['type']=='Function'" style="display:inline-block;white-space:nowrap;" >
												<div style="display: inline-block; vertical-align:top; white-space:nowrap; " > 
													<select v-bind:disabled="is_locked__" v-model="staged__['function']['function']" v-on:change="function_change__(stagei__)" style="width:150px; vertical-align:top;" >
														<optgroup v-for="ft in ['Text','Number','List','Assoc List','Convert','Date','Cryptography','Miscellaneous']" v-bind:label="ft" >
															<template v-for="fv,fi in functions__" >
															<option  v-if="fv['type']==ft" v-bind:value="fi">{{ fi }}</option>
															</template>
														</optgroup>
													</select>
													<div v-if="staged__['function']['return']" style="display:inline-block; vertical-align:top;">
													<select v-bind:disabled="is_locked__" v-model="staged__['function']['lhs']" v-on:change="updated_option__(stagei__)" style="width:150px;" >
														<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
														<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['function']['lhs'])&&typeof(staged__['function']['lhs'])=='string'" >
															<option v-bind:value="staged__['function']['lhs']" >{{ get_v_name__(staged__['function']['lhs']) }}</option>
														</optgroup>
													</select>
													&nbsp;=&nbsp;
													</div>
													<div v-if="staged__['function'].hasOwnProperty('inputs')" style="display:inline-block;" >
														<table cellpadding='5' class="simple_code_t1">
														<tr><template v-for="fv,fi in staged__['function']['inputs']" ><td v-if="fi!='type'" >{{ fv['name'] }}</td></template></tr>
														<tr><template v-for="fv,fi in staged__['function']['inputs']" ><td  v-if="fi!='type'" >
															<select v-bind:disabled="is_locked__" v-model="staged__['function']['inputs'][fi]['type']" v-on:change="updated_option__(stagei__)" style="width:150px;">
																<option v-for="vr,vi in staged__['function']['inputs'][fi]['types']" v-bind:value="vr" >{{ vr }}</option>
															</select>
														</td></template></tr>
														<tr><template v-for="fv,fi in staged__['function']['inputs']" ><td v-if="fi!='type'" >
															<select v-bind:disabled="is_locked__" v-if="fv['type']=='variable'" v-model="staged__['function']['inputs'][fi]['value']" v-on:change="updated_option__(stagei__)" style="width:150px;">
																<option value="" >None</option>	
																<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
																<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['function']['inputs'][fi]['value'])&&typeof(staged__['function']['inputs'][fi]['value'])=='string'"  >
																<option v-bind:value="staged__['function']['inputs'][fi]['value']" >{{ get_v_name__(staged__['function']['inputs'][fi]['value']) }}</option>
																</optgroup>
															</select>
															<div v-if="functions_data__.hasOwnProperty(fv['type'])" >
															<select v-bind:disabled="is_locked__" v-model="staged__['function']['inputs'][fi]['value']" v-on:change="updated_option__(stagei__)" style="width:150px;">
																<option value="" >None</option>
																<option v-for="vr,vi in functions_data__[fv['type']]" v-bind:value="vi" >{{ vr }}</option>
															</select>
															</div>
															<input v-bind:disabled="is_locked__" v-else-if="fv['type']=='number'||fv['type']=='date'||fv['type']=='text'" v-model="staged__['function']['inputs'][fi]['value']" v-on:change="updated_option__(stagei__)" v-bind:type="fv['type']" style="width:150px;">
														</td></template></tr>
														</table>
													</div>
												</div>
											</div>
											<div v-if="staged__['type']=='none'"  style="display:inline-block; width:100%;"><div>-</div></div>
											<div v-if="staged__['type']=='EndIf'"  style="display:inline-block; width:100%;"><div>-</div></div>
											<div v-if="staged__['type']=='Respond'" style="display:inline-block; width:100%;">
												<div>&nbsp;&nbsp;End execution/Skip subsequent steps!</div>
											</div>
											<div v-if="staged__['type']=='RespondError'" style="display:inline-block; width:100%;">
												<div>
													<select v-model="staged__['enderror']['type']"  v-on:change="updated_option__(stagei__)" >
														<option value="static">static</option>
														<option value="variable">variable</option>
													</select>
													<select v-if="staged__['enderror']['type']=='variable'" v-model="staged__['enderror']['value']"  v-on:change="updated_option__(stagei__)" >
														<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
														<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['enderror']['value'])&&typeof(staged__['enderror']['value'])=='string'" >
														<option v-bind:value="staged__['enderror']['value']" >{{ get_v_name__(staged__['enderror']['value']) }}</option>
														</optgroup>
													</select>
												</div>
												<div v-if="staged__['enderror']['type']=='static'"><textarea class="form-control form-control-sm" style="min-width:300px;" v-bind:disabled="is_locked__" v-model="staged__['enderror']['value']" type="text" placeholder="Error Message" v-on:blur="updated_option__(stagei__)"></textarea></div>
												<div>Skip subsequent steps! Response status: fail</div>
											</div>
											<div v-if="staged__['type']=='SetLabel'" style="display:inline-block; width:100%;">
												<input v-bind:disabled="is_locked__" v-model="staged__['label']" type="text" placeholder="Enter Label Name" style="width:150px;" v-on:keydown="nameKeydown__($event)"  v-on:blur="updated_option__(stagei__)">
											</div>
											<div v-if="staged__['type']=='JumpToLabel'" style="display:inline-block; width:100%;">
												<select v-bind:disabled="is_locked__" v-model="staged__['jump_to_label']" v-on:change="updated_option__(stagei__)" style="width:150px;">
													<option value="" >None</option>
													<option v-for="v,i in label_names__" v-bind:value="v" >{{ v }}</option>
												</select>
											</div>
											<div v-if="staged__['type']=='Sleep'" style="display:inline-block; width:100%;">
												<select v-bind:disabled="is_locked__" v-model="staged__['sleep']['type']" v-on:change="updated_option__(stagei__)" style="width:150px;">
													<option value="number" >number</option>
													<option value="variable" >variable</option>
												</select>
												<select v-if="staged__['sleep']['type']=='variable'" v-bind:disabled="is_locked__" v-model="staged__['sleep']['value']" v-on:change="updated_option__(stagei__)" style="width:150px;">
													<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
													<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['sleep']['value'])&&typeof(staged__['sleep']['value'])=='string'" >
													<option v-bind:value="staged__['sleep']['value']" >{{ get_v_name__(staged__['sleep']['value']) }}</option>
													</optgroup>
												</select>
												<input type="number" v-if="staged__['sleep']['type']=='number'" v-bind:disabled="is_locked__" v-model="staged__['sleep']['value']" v-on:change="updated_option__(stagei__)" style="width:60px;">
											</div>
											<div v-if="staged__['type']=='Log'" style="display:inline-block; width:100%;">
												<select v-bind:disabled="is_locked__" v-model="staged__['log']['type']" v-on:change="updated_option__(stagei__)" style="width:150px;">
													<option value="number" >number</option>
													<option value="variable" >variable</option>
												</select>
												<select v-if="staged__['log']['type']=='variable'" v-bind:disabled="is_locked__" v-model="staged__['log']['value']" v-on:change="updated_option__(stagei__)" style="width:150px;">
													<option v-for="vr,vi in all_factors_stage_wise__[ stagei__ ]" v-bind:value="vi" v-bind:disabled="vi.indexOf('[]')>1" >{{ vi }} - [{{ vr['type'] }}]</option>
													<optgroup label="Orphan" v-if="is_it_orphan__(stagei__,staged__['log']['value'])&&typeof(staged__['log']['value'])=='string'" >
														<option v-bind:value="staged__['log']['value']" >{{ get_v_name__(staged__['log']['value']) }}</option>
													</optgroup>
												</select>
												<input type="text" v-if="staged__['log']['type']=='number'" v-bind:disabled="is_locked__" v-model="staged__['sleep']['value']" v-on:change="updated_option__(stagei__)" style="width:250px;">
											</div>
											<div v-if="staged__['type']=='DB'" style="display:inline-block; width:100%;" >
												<div style="min-height: 200px;" v-html="staged__['d']" ></div>
												<div style="position:fixed; top:100px; left:100px; width:80%; max-height:80%; background-color: white; border-bottom: 1px solid black; padding: 10px; border-radius: 5px; box-shadow: 5px 5px 20px #333; z-index:401; overflow:auto; " >
													<div><input type="button" value="Close" class="btn btn-dark btn-sm float-right pull-right mr-3" v-on:click="staged__['e']=false" ></div>
													<db v-bind:ref="'stage_'+stagei__" v-bind:input_factors="all_factors_stage_wise__[stagei__]" v-bind:data="staged__['db']" v-on:save_data="save_db_data__(stagei__, $event)" ></db>
												</div>
											</div>
											<div v-if="staged__['type']=='ElasticTable'" style="display:inline-block; width:100%;" >
												<div style="min-height: 200px;" v-html="staged__['d']" ></div>
												<div style="position:fixed; top:100px; left:100px; width:80%; max-height:80%; background-color: white; border-bottom: 1px solid black; border-radius: 5px; box-shadow: 5px 5px 20px #333; z-index:401; overflow:auto; " >
													<div style=" padding: 10px; background-color: #f0f0f0; border-bottom:1px solid #333;"><b>ElasticTable</b><input type="button" value="Close" class="btn btn-dark btn-sm float-right pull-right mr-3" v-on:click="staged__['e']=false" ></div>
													<div style=" padding: 10px;" >
														<elastic_table v-bind:ref="'stage_'+stagei__" v-bind:input_factors="all_factors_stage_wise__[stagei__]" v-bind:api_tables="api_elastic_tables__" v-bind:data="staged__['elastic_table']" v-on:save_data="save_elasticdb_data__(stagei__, $event)" ></elastic_table>
													</div>
												</div>
											</div>
											<div v-if="staged__['type']=='DynamicTable'" style="display:inline-block; width:100%;" >
												<div style="min-height: 200px;" v-html="staged__['d']" ></div>
												<div style="position:fixed; top:100px; left:100px; width:80%; max-height:80%; background-color: white; border-bottom: 1px solid black; border-radius: 5px; box-shadow: 5px 5px 20px #333; z-index:401; overflow:auto; " >
													<div style=" padding: 10px; background-color: #f0f0f0; border-bottom:1px solid #333;"><b>DynamicTable</b><input type="button" value="Close" class="btn btn-dark btn-sm float-right pull-right mr-3" v-on:click="staged__['e']=false" ></div>
													<div style=" padding: 10px;" >
														<dynamic_table v-bind:ref="'stage_'+stagei__" v-bind:input_factors="all_factors_stage_wise__[stagei__]" v-bind:data="staged__['dynamic_table']" v-on:save_data="save_dynamicdb_data__(stagei__, $event)" ></dynamic_table>
													</div>
												</div>
											</div>
											<div v-if="staged__['type']=='Redis'" style="display:inline-block; width:100%;" >
												<db_redis v-bind:ref="'stage_'+stagei__" v-bind:is_locked__="is_locked__" v-bind:r_f__="redis_functions__" v-bind:input_factors="all_factors_stage_wise__[stagei__]" v-bind:api_tables="api_redis_tables__" v-bind:data="staged__['db']" v-on:save_data="save_redis_data__(stagei__, $event)" ></db_redis>
											</div>
											<div v-if="staged__['type']=='DynamoDB'" style="display:inline-block; width:100%;" >
												<db_dynamodb v-bind:ref="'stage_'+stagei__" v-bind:input_factors="all_factors_stage_wise__[stagei__]" v-bind:api_tables="api_tables__" v-bind:data="staged__['db']" v-on:save_data="save_dynamodb_data__(stagei__, $event)" ></db_dynamodb>
											</div>
											<div v-if="staged__['type']=='Thing'" style="display:inline-block; width:100%;" >
												<db_thing v-bind:ref="'stage_'+stagei__" v-bind:input_factors="all_factors_stage_wise__[stagei__]" v-bind:api_things="api_things__" v-bind:data="staged__['db']" v-on:save_data="save_thing_data__(stagei__, $event)" ></db_thing>
											</div>
											<div v-if="staged__['type']=='SMS'" style="display:inline-block; width:100%;" >
												<sms v-bind:ref="'stage_'+stagei__" v-bind:input_factors="all_factors_stage_wise__[stagei__]" v-bind:sms="staged__['sms']" v-on:save_data="save_sms_data__(stagei__, $event)" ></sms>
											</div>
											<div v-if="staged__['type']=='EMail'" style="display:inline-block; width:100%;" >
												<email v-bind:ref="'stage_'+stagei__" v-bind:input_factors="all_factors_stage_wise__[stagei__]" v-bind:email="staged__['email']" v-on:save_data="save_email_data__(stagei__, $event)" ></email>
											</div>
											<div v-if="staged__['type'] in stage_params__" style="display:inline-block; width:100%;" >
												<component v-bind:is="stage_params__[ staged__['type'] ]['cmp']" v-bind:ref="'stage_'+stagei__" v-bind:input_factors="all_factors_stage_wise__[stagei__]" v-bind:params="staged__['params']" v-on:save_data="save_common__(stagei__, $event)" ></component>
											</div>
											<div v-if="staged__['type']=='Procedure'" style="display:inline-block; width:100%;" >
												<procedure v-bind:ref="'stage_'+stagei__" v-bind:input_factors="all_factors_stage_wise__[stagei__]" v-bind:data="staged__['procedure']" v-on:save_data="save_procedure_data__(stagei__, $event)" ></procedure>
											</div>
											<div v-if="staged__['type']=='PageSettings'" style="display:inline-block; width:100%;">
										                <pagesettings v-bind:inputs="all_factors_stage_wise__[stagei__]" v-bind:settings="staged__['pagesettings']" v-bind:files_list="files_list__" v-on:edited="save_pagesettings__(stagei__, $event)"></pagesettings>
											</div>
											<div v-if="staged__['type']=='RenderBlock'" style="display:inline-block; width:100%;">
										                <renderblock v-bind:data="staged__['renderblock']" v-bind:blocks="api_blocks__" v-bind:inputs="all_factors_stage_wise__[stagei__]"  v-on:edited="save_renderblock__(stagei__, $event)"></renderblock>
											</div>
											<div v-if="staged__['type']=='RenderArticle'" style="display:inline-block; width:100%;">
										                <renderarticle v-bind:data="staged__['renderarticle']" v-bind:articles="api_articles__" v-bind:inputs="all_factors_stage_wise__[stagei__]"  v-on:edited="save_renderarticle__(stagei__, $event)"></renderarticle>
											</div>
											<div v-if="staged__['type']=='RenderHTML'" style="display:inline-block; width:100%;">
												<div><input type="button" value="Open Html Designer" v-on:click="engine__['stages'][stagei__]['renderhtml']['d']=true"></div>
												<textarea v-if="engine__['stages'][stagei__]['renderhtml']['d']==false" v-model="engine__['stages'][stagei__]['renderhtml']['html_body']" placeholder="Enter HTML" style="width:99%;height:120px;resize:both;white-space:pre;"></textarea>
												<textarea v-if="engine__['stages'][stagei__]['renderhtml']['d']==false" v-model="engine__['stages'][stagei__]['renderhtml']['style_body']" placeholder="Enter Stylesheet" style="width:99%;height:60px;resize:both;white-space:pre;"></textarea>
										        <renderhtml v-if="engine__['stages'][stagei__]['renderhtml']['d']"  v-bind:html_body="staged__['renderhtml']['html_body']" v-bind:style_body="staged__['renderhtml']['style_body']" v-on:save_html="save_renderhtml__(stagei__, $event)"></renderhtml>
											</div>
											<div v-if="staged__['type']=='HTTPRequest'" style="display:inline-block; width:100%;">
										                <httprequest v-bind:httprequest="staged__['httprequest']" v-bind:inputs="all_factors_stage_wise__[stagei__]"  v-on:edited="save_httprequest__(stagei__, $event)"></httprequest>
											</div>
											<div v-if="staged__['type']=='QueuePush'" style="display:inline-block; width:100%;">
												<queue_push v-bind:queue="staged__['queue']" v-bind:inputs="all_factors_stage_wise__[stagei__]"  v-on:edited="save_queuepush__(stagei__, $event)"></queue_push>
											</div>
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>	
					<div class="myrow1" >
						<div class="mycol1" >&nbsp;</div>
						<div class="mycol1" >
							<input type="button"  v-if="checked_items__==0" value="+" v-on:click="add_stage__('last')" style="padding:0px 5px;" v-bind:disabled="is_locked__" >
						</div>
						<div class="mycol2" >&nbsp;</div>
						<div class="mycol3" v-on:click.stop="hide_edit_stage__(-1, 'all')"></div>
					</div>
					<div style="clear:both;"></div>
					<template v-if="'output_vars' in engine__ && (api__['type']=='function'||api__['type']=='api')">
						<div>&nbsp;</div>
						<div>Output Variables</div>
						<table class="table table-bordered table-sm w-auto">
						<tr>
							<td>Name</td>
							<td>Type</td>
							<td>Schema</td>
							<td>Default Type</td>
							<td>Default Value</td>
							<td>As</td>
							<td>Output</td>
						</tr>
						<tr v-for="ov,oi in engine__['output_vars']">
							<td>{{ oi }}</td>
							<td>{{ ov['type'] }}</td>
							<td><pre>{{ get_output_var_dump(oi, ov['sch']) }}</pre></td>
							<td>
								<select v-bind:disabled="is_locked__" v-model="ov['d_t']" >
									<option value="text" title="Text">Text</option>
									<option value="number" title="Number">Number</option>
									<option value="null" title="Null or Zero or Empty">Null/Zero</option>
									<option value="boolean">Boolean</option>
								</select>
							</td>
							<td>
								<input v-bind:disabled="is_locked__" v-if="ov['d_t']=='text'||ov['d_t']=='number'" v-model="ov['d_v']" v-bind:type="ov['d_t']">
								<select v-bind:disabled="is_locked__" v-if="ov['d_t']=='boolean'" v-model="ov['d_v']" title="Boolean to Value" >
									<option value="true">True</option>
									<option value="false">False</option>
								</select>
							</td>
							<td>{{ ov['as'] }}</td>
							<td><input type="checkbox" v-model="ov['checked']" ></td>
						</tr>
						</table>
					</template>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<?php if( $_GET['show']=="debug" ){ ?>
						<p><B>Debug</b></p>
						<p>Engine:</p>
						<pre v-text="engine__"></pre>
						<pre v-text="api__"></pre>
						<p>Test:</p>
						<pre v-if="json_view__" v-text="test__"></pre>
					<?php } ?>
				</div>

					
			<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>