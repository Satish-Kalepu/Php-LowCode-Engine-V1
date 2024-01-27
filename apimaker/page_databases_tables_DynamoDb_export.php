<?php 	$fields = [];
	foreach($table["schema"]["default"]["fields"] as $field => $fn ){
		if( $fn["type"] != "_id" && $fn["type"] != "text" && $fn["type"] != "number"){
			$fields[] = $field;
		}
	}
?>
<div class="container-fluid" id="db_list_app" >
	<form method="post" id="dynamodb_export">
		<?php if($_SESSION["export_error"] != ""){?>
		<div class="alert alert-danger"><?=$_SESSION["export_error"]?></div>
		<?php }?>
		<input type="hidden" name="security_token" id="security_token" value="<?=get_new_token( 'database_dynamodb_export',$config_param3 )?>">
		<h3>Export</h3>
		<div class="text-danger" v-if=" export_type == 'csv' && fields.length >0 "><span class="text-danger">Fields that can't be import </span>{{fields.join()}}</div>
		<div class="row mb-1">
			<div class="col-2">Schema</div>
			<div class="col-8" >
				<select v-model="selected_schema" name="selected_schema" id="selected_schema" class="form-control form-control-sm" style="width:150px;display:inline;">
					<option v-for="vs,vi in table['schema']" v-bind:value="vi" >{{ vs['name'] }}</option>
				</select>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-2">Filter</div>
			<div class="col-8" >
				<table>
					<tr>
						<td>
							<select v-model="s['t']" class="form-control form-control-sm" style="width:100px;display:inline;" >
								<option value="scan">Scan</option>
								<option value="query">Query</option>
							</select>
						</td>
						
						<td>
							<select v-model="s['i']" class="form-control form-control-sm" style="width:150px;display:inline;" v-on:change="change_index">
								<option value="i_p">Primary Index</option>
								<option v-for="v,indexname in table['keys']" v-bind:value="indexname">{{ indexname }}</option>
							</select>
						</td>
						<td v-if="s['t']=='query'">
							<div v-if="s['i']=='i_p'">
								<table>
									<tr>
										<td><span style="padding: 0px 10px;" >{{ table['pk']['field'] }} = </span></td>
										<td>
											<select v-model="s['a']['c']" class="form-control form-control-sm" style="width:70px;display:inline;">
												<option value="=" >=</option>
											</select>
										</td>
										<td>
											<input v-bind:type="get_type('a')" autocomplete="off" v-model="s['a']['v']" placeholder="Search"  v-bind:class="{'form-control form-control-sm':true,'border-danger':av}"  style="width:150px;display:inline;" >
										</td>
									</tr>
									<tr v-if="table['sk']['enable']">
										<td><span style="padding: 0px 10px;" >{{ table['sk']['field'] }} = </span></td>
										<td>
											<select v-model="s['b']['c']" class="form-control form-control-sm" style="width:70px;display:inline;">
												<option v-for="f,i in filters" v-bind:value="i" >{{ f }}</option>
											</select>
										</td>
										<td>
											<template v-if="s['b']['c']!='><'">
												<input v-bind:type="get_type('b')" autocomplete="off" v-model="s['b']['v']" placeholder="Search"  v-bind:class="{'form-control form-control-sm':true,'border-danger':av}"  style="width:150px;display:inline;" >
											</template>
											<template v-else>
												<input v-bind:type="get_type('b')" autocomplete="off" v-model="s['b']['v']" placeholder="From"  v-bind:class="{'form-control form-control-sm':true,'border-danger':av}"  style="width:80px;display:inline;" >
												<input v-bind:type="get_type('b')" autocomplete="off" v-model="s['b']['v2']" placeholder="To"  v-bind:class="{'form-control form-control-sm':true,'border-danger':av2}"  style="width:80px;display:inline;" >
											</template>
										</td>
									</tr>
								</table>
							</div>
							<div v-else-if="s['i'] in table['keys']">
								<div>
									<table>
										<tr>
											<td><span style="padding: 0px 10px;" >{{ table['keys'][ s['i'] ]['pk']['field'].replace(".","->") }}</span></td>
											<td>
												<select v-model="s['a']['c']" class="form-control form-control-sm" style="width:70px;display:inline;">
													<option value="=" >=</option>
												</select>
											</td>
											<td>
												<input v-bind:type="get_type('a')" autocomplete="off" v-model="s['a']['v']" placeholder="Search" v-bind:class="{'form-control form-control-sm':true,'border-danger':av}" style="width:150px;display:inline;" >
											</td>
										</tr>
									</table>
								</div>
								<div v-if="table['keys'][ s['i'] ]['sk']['enable']">
									<table>
										<tr>
											<td><span style="padding: 0px 10px;" >{{ table['keys'][ s['i'] ]['sk']['field'].replace(".","->") }}</span></td>
											<td>
												<select v-model="s['b']['c']" class="form-control form-control-sm" style="width:70px;display:inline;">
													<option v-for="f,i in filters" v-bind:value="i" >{{f}}</option>
												</select>
											</td>
											<td>
												<template v-if="s['b']['c']!='><'">
													<input v-bind:type="get_type('b')" autocomplete="off" v-model="s['b']['v']" placeholder="Search" v-bind:class="{'form-control form-control-sm':true,'border-danger':bv}"  style="width:150px;display:inline;" >
												</template>
												<template v-else>
													<input v-bind:type="get_type('b')" autocomplete="off" v-model="s['b']['v']" placeholder="From" v-bind:class="{'form-control form-control-sm':true,'border-danger':bv}"  style="width:80px;display:inline;" >
													<input v-bind:type="get_type('b')" autocomplete="off" v-model="s['b']['v2']" placeholder="To" v-bind:class="{'form-control form-control-sm':true,'border-danger':bv2}"  style="width:80px;display:inline;" >
												</template>
											</td>
										</tr>
									</table>
								</div>
							</div>
						</td>
						<td>
							<select v-model="s['sort']" class="form-control form-control-sm" style="width:100px;display:inline;">
								<option value="asc" >Ascending</option>
								<option value="desc" >Descending</option>
							</select>
							
						</td>
					</tr>
				</table>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-2">Limit</div>
			<div class="col-8" >
				<input autocomplete="off" name="limit" id="limit" v-model="limit" class="form-control form-control-sm" style="width:150px;display:inline;">
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-2">Delimeter</div>
			<div class="col-8" >
				<select v-model="s['delimeter']" class="form-control form-control-sm" style="width:150px;display:inline;">
					<option v-bind:value='i__' v-for="v__,i__ in delimeter_list">{{v__}}({{i__}})</option>
				</select>
			</div>
		</div>
		<div class="row mb-1">
			<div class="col-2">Export Type</div>
			<div class="col-8" >
				<input type="radio" id="export_csv"  value="csv" v-model="export_type">
				<label for="export_csv">Download Csv File</label>
				<input type="radio" id="export_json" value="json" v-model="export_type">
				<label for="export_json">Download Json File</label>
			</div>
		</div>		
		<input type="hidden" name="action" id="action" value="export_dynamodb_data">
		<input type="hidden" name="table_id" id="table_id" v-model=" table['_id'] ">
		<input type="hidden" name="db_id" id="db_id" v-model=" table['db_id'] ">
		<input type="hidden" name="s" id="s_data">
		<input type="hidden" name="export_type" id="export_type" v-model="export_type">
		<button class="btn btn-sm btn-primary" type="button" v-on:click="load_records" >Export</button>
	</form>
</div>
<script type="text/javascript">
	var db_list_app = new Vue({
		"el"	: "#db_list_app",
		"data"	: {
			"export_type"		: "csv",
			"table"			: <?=json_encode($table,JSON_PRETTY_PRINT) ?>,
			"fields"		: <?=json_encode($fields,JSON_PRETTY_PRINT) ?>,
			"selected_schema"	: "default",
			"av"			: false,
			"av2"			: false,
			"bv"			: false,
			"bv2"			: false,
			"error"			: "",
			"limit"			: "<?=$total_cnt?$total_cnt:500?>",
			"delimeter_list"	: {
							",": "Comma",
							".": "Dot",
							"/": "Slash",
							"-": "Hyphen",
							"$": "Dollor",
							"_": "Underscore",
							"#": "Hash",
							"'": "Single Qutote",
							'"': "Double Qutote",
							':': "Colon",
						},
			"filters"		: {
							"="	: "=",
							"!="	: "!=",
							"<"  	: "<",
							"<="	: "<=",
							">"	: ">",
							">="	: ">=",
							"><"	: "><",
							"^."  : "^...",
						},
			"s"			: {
							"t": "scan",
							"delimeter":",",
							"sort": "asc",
							"i": "i_p",
							"a":{"f":"", "c":"=","v":"", "v2":""},
							"b":{"f":"", "c":"=","v":"", "v2":""}
						},
		},
		mounted : function(){
		},
		methods : {
		        echo__: function(v__){
				if( typeof(v__) == "object" ){
					console.log( JSON.stringify(v__,null,4) );
				}else{
					console.log( v__ );
				}
			},
			get_type: function( v ){
				if( this.s['i'] == "i_p" ){
					if( v== 'a' ){
						return this.table['pk']['type']+''
					}else if( v== 'b' ){
						return this.table['sk']['type']+''
					}
					return "text";
				}else if( this.s['i'] in this.table['keys'] ){
					if( v == "a" ){
						return this.table['keys'][ this.s['i'] ]['pk']['type']+'';
					}else if( v == "b" ){
						return this.table['keys'][ this.s['i'] ]['sk']['type']+'';
					}else{
						return "text";
					}
				}else{
					return "text";
				}
			},
			change_index: function(){
				this.$set( this.s['a'], 'f', "" );this.$set( this.s['a'],'v', "" );this.$set( this.s['a'],'v2', "" );
				this.$set( this.s['b'], 'f', "" );this.$set( this.s['b'],'v', "" );this.$set( this.s['b'],'v2', "" );
				if( this.s['i'] == "i_p"){
					this.$set( this.s['a'], 'f', this.table['pk']['field']+'' );
					this.$set( this.s['a'], 'f', this.table['sk']['field']+'' );
				}else{
					this.$set( this.s['a'], 'f', this.table['keys'][ this.s['i'] ]['pk']['field'] );
					this.$set( this.s['b'], 'f', this.table['keys'][ this.s['i'] ]['sk']['field'] );
				}
			},
			search_filter_cond:function(v){
				this.av = false;this.av2 = false;this.bv = false;this.bv2 = false;
				if( this.s['t'] == 'query' ){
					if( this.s['i'] == "i_p" ){
						if( this.s['a']['v'] == "" ){
							this.av = true;
							return false;
						}
						if( this.table['sk']['enable'] ){
						if( this.s['a']['c'] == "><" ){
							if( this.s['a']['v'] == "" ){
								this.av = true;
							}
							if( this.s['a']['v2'] == "" ){
								this.av2 = true;
							}
							if( this.av || this.av2 ){
								return false;
							}
						}
						}
					}else{
						if( this.s['a']['v'] == "" ){
							this.av = true;
						}
						if( this.table['keys'][ this.s['i'] ]['enable'] ){
							if( this.s['b']['c'] == "><" ){
								if( this.s['b']['v'] == "" ){
									this.bv = true;
								}
								if( this.s['b']['v2'] == "" ){
									this.bv2 = true;
								}
							}
						}
					}
				}
				if( this.av || this.av2 || this.bv || this.bv2 ){
					return false;
				}
				this.last_key = false;
			},
			load_records: function(){
				this.search_filter_cond();
				document.getElementById('s_data').value = (JSON.stringify(this.s));
				document.getElementById("dynamodb_export").submit();
			}
		}
	});
</script>