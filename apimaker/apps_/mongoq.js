const mongoq =  { data(){ return { s2_meti_wen_dda: false, s2_eman_meti_wen: "", } }, props: ['datafor', 'v','datavar', 'refname', 'rootdata', 'vars'], mounted: function(){ if( typeof(this.v) != "object" ){ this.v = []; }else if( "length" in this.v == false ){ this.v = []; } if( this.v.length > 0 ){ if( this.v[0]['v']['t'] == "L" ){ if( typeof(this.v[0]['v']['v']) != "object" ){ this.v[0]['v']['v'] = []; }else if( "length" in this.v[0]['v']['v'] == false ){ this.v[0]['v']['v'] = []; } }else if( "length" in this.v == false ){ this.v = []; } } }, methods: { s2_ooooooohce: function(s2_vvvvvvvvvv){ if( typeof(s2_vvvvvvvvvv)=="object" ){ console.log( JSON.stringify(s2_vvvvvvvvvv,null,4) ); }else{ console.log( s2_vvvvvvvvvv ); } }, s2_ttttttidda: function(){ this.v.push({ "f": { "t": "T", "v": "field" }, "c": { "t": "T", "v": "$eq" }, "v": { "t": "T", "v": "value" }, }); }, s2_bbbbus_dda: function(vi){ this.v[vi]['v']['v'].push({"t":"L", "v":[{ "f":{"t":"T", "v":"field"}, "c":{"t":"T", "v":'$eq'}, "v":{"t":"T", "v":"value"}, }] }); }, s2_edoneteled: function( k, e ){ if( e.ctrlkey ){ this.v.splice(k,1); }else if( confirm("are you sure?\nctrl+click to avoid prompt") ){ this.v.splice(k,1); } }, s2_edon_bus_eteled: function( vk, vkk ){ this.v[vk]['v']['v'].splice(vkk,1); }, s2_kkkcabllac: function( c ){ this.s2_ooooooohce( "s2_kkkcabllac: "+ c ); var x = c.split(/\:/g); if( x[0] == "s2_ttes_dleif" ){ if( this.v[ Number(x[1]) ]['f']['v'] == '$and' || this.v[ Number(x[1]) ]['f']['v'] == '$or' ){ this.v[ Number(x[1]) ]['v'] = { 't':"L",  'v':[{"t":"L", "v":[{ "f":{"t":"T", "v":"field"}, "c":{"t":"T", "v":'$eq'}, "v":{"t":"T", "v":"value"}, }] }] } }else if( this.v[ Number(x[1]) ]['v']['t'] == "L" ){ this.v[ Number(x[1]) ]['v'] = { 't':"T",  'v':"" } } }else{ console.log("Callback: " + c + " not defined!"); } }, s2_tsil_eraperp: function(){ var vv = []; if( typeof(this.rootdata)=="object" ){ if( 'data' in this.rootdata ){ if( 'schema' in this.rootdata['data'] ){ if( 'fields' in this.rootdata['data']['schema'] ){ vv = this.s2_tsil_sdleif_ot_tcejbo(this.rootdata['data']['schema']['fields']['v']); } } } } vv.push({"k":'$and', 't':'cond'}); vv.push({"k":'$or', 't':'cond'}); this.$root.s2_atad_labolg['list2'] = vv; }, s2_tsil_sdleif_ot_tcejbo: function(v, vp =""){ var vv = []; for( var k in v ){ vv.push({"k":vp+k+'',"t":v[k]['type']}); if( v[k]['type'] == "dict" ){ var d = this.s2_tsil_sdleif_ot_tcejbo( v[k]['sub'], vp + k + "->" ); for(var j=0;j<d.length;j++){ vv.push(d[j]); } } } return vv; } }, template: `<div> <div>{</div> <div v-if="typeof(v)!='object'||v==undefined||v==null" style="margin-left:30px;">vobject error</div> <div v-else style="margin-left:10px;"> <div v-for="vd,vkey in v" style="display:flex; margin-bottom:5px; column-gap:5px;" > <div><input type="button" class="btn btn-outline-danger btn-sm me-2" style="padding:0px 5px;" value="X" v-on:click="s2_edoneteled(vkey,$event)" ></div> <div style="display:flex;align-self:flex-start;"> <div title="Fields" data-type="dropdown" data-list="list2" v-bind:data-list-values="list2" v-bind:data-for="datafor" v-bind:data-var="datavar+':'+vkey+':f:v'" v-on:click="s2_tsil_eraperp" v-bind:data-context-callback="refname+':s2_ttes_dleif:'+vkey" >{{ vd['f']['v'] }}</div> </div> <template v-if="vd['f']['v']=='$and'||vd['f']['v']=='$or'" > <div v-if="typeof(vd['v']['v'])=='object'&&'length' in vd['v']['v']==false" > ERROR in value </div> <div> <div>[</div> <div v-for="vdd,vkeyy in vd['v']['v']" style="display:flex; margin-bottom:5px;margin-left:20px;"> <div><input type="button" class="btn btn-outline-danger btn-sm me-2" style="padding:0px 5px;" value="X" v-on:click="s2_edon_bus_eteled(vkey,vkeyy)" ></div> <mongoq v-bind:v="vdd['v']" v-bind:ref="refname+'-'+vkey+'-'+vkeyy" v-bind:refname="refname+'-'+vkey+'-'+vkeyy"  v-bind:datafor="datafor" v-bind:datavar="datavar+':'+vkey+':v:v:'+vkeyy+':v'"  v-bind:rootdata="rootdata"  v-bind:vars="vars" ></mongoq></div><div style="margin-left:20px;margin-bottom:5px;"><input class="btn btn-outline-dark btn-sm" style="padding:0px 5px;" type='button' v-on:click="s2_bbbbus_dda(vkey)" value='+'></div><div>]</div></div> </template> <template v-else > <div v-if="vd['v']['t']=='L'" > ERROR in value </div> <template v-else > <div>&nbsp;:&nbsp;&nbsp;{&nbsp;</div> <div style="align-self:flex-start;"> <div class="codeline_thing_pop" data-type="dropdown" data-list="mongooperator" v-bind:data-for="datafor" v-bind:data-var="datavar+':'+vkey+':c:v'" title="Mongo Operator" v-bind:data-context-callback="refname+':s2_tttes_dnoc:'+vkey" >{{ vd['c']['v'] }}</div> </div> <div>&nbsp;:&nbsp;</div> <mongoq_field v-bind:v="vd['v']" v-bind:datafor="datafor" v-bind:rootdata="rootdata" v-bind:datavar="datavar+':'+vkey+':v'" v-bind:vars="vars" ></mongoq_field> <div>&nbsp;}&nbsp;</div> </template> </template> </div> <div><input class="btn btn-outline-dark btn-sm" style="padding:0px 5px;" type='button' v-on:click="s2_ttttttidda" value='+'></div> </div> <div>}</div> </div>` };