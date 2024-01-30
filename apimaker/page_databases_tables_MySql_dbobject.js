const dbobject_table_mysql = {
	data: function(){
		return {
			items2: [],
			level: 1,
			showit: false,
			add_new_item: false,
			new_item_name: "",
			primary_field: "",
		}
	},
	props: ['items', 'source_fields'],
	watch: {
		items2: {
			handler: function(){
				if( this.showit ){
					//this.$emit('edited', this.items);
					//this.informparent()
				}
			},
			deep:true,
		}
	},
	mounted: function(){
		setTimeout(this.ini,200);
		//this.ini();
	},
	methods: {
		informparent: function(){
			var v = {};
			for(var i=0;i<this.items2.length;i++){
				this.items2[i]['order'] = i;
				v[ this.items2[ i ]['key'] ] = this.items2[ i ];
			}
			this.items = JSON.parse( JSON.stringify( v ) );
			this.$emit("edited", v );
		},
		echo: function(v){
			if( typeof(v)=="object" ){
				console.log( JSON.stringify(v,null,4) );
			}else{
				console.log( v );
			}
		},
		ini: function(){
			if( this.items == undefined ){
				this.items = {};
			}else if( typeof(this.items) != "object" || this.items.hasOwnProperty("length") ){
				this.items = {};
			}
			var v2 = JSON.parse( JSON.stringify( this.items ) );
			var v = [];
			for( var i in v2 ){
				v.push( Number(v2[i]['order']) );
				v2[i]['key'] = i+'';
			}
			v.sort();
			var v = Array.from(new Set(v));
			var k = [];
			for( var i=0;i<v.length;i++){
				for( var j in v2 ){if( this.items[ j ]['order'] == v[i] ){
					k.push( this.items[ j ] );
				}}
			}
			this.items2 = k;
			for( var fn in this.source_fields ){
				if( this.source_fields[ fn ]['index'] == 'primary' ){
					this.primary_field = fn+'';
				}
			}
			setTimeout(function(v){v.showit = true;},200,this);
		},
		edited_name: function( vi ){
			this.items2[ vi ]['index'] = this.source_fields[ this.items2[ vi ]['key'] ]['index']+'';
			this.informparent();
		},
		addit: function(){
			if( this.new_item_name.trim() ){
				this.items2.push({
					"key": this.new_item_name+"",
					"type": this.source_fields[ this.new_item_name ]['type'],
					"m": true,
					"index": this.source_fields[ this.new_item_name ]['index'],
				});
				//this.$set( this.items2[ this.items2.length-1 ], "order" )
				this.new_item_name = "";
				this.add_new_item = false;
				this.informparent();
			}
		},
		deletenode: function(vkey){
			this.items2.splice( Number( vkey ), 1 );
			this.informparent( );
		},
		change_field_type: function( vkey ){
			this.informparent();
		},
		moveu: function( vi, vkey ){
			if( vi >= 1 ){
				var it = JSON.parse( JSON.stringify( this.items2[ vi ] ) );
				this.items2.splice( vi, 1 );
				this.items2.splice( vi-1, 0, it );
			}
			this.informparent();
		},
		moved: function( vi ){
			if( vi < this.items2.length-2 ){
				//console.log( "one" );
				var it = JSON.parse( JSON.stringify( this.items2[ vi ] ) );
				this.items2.splice( vi, 1 );
				this.items2.splice( vi+1, 0, it );
			}else if( vi < this.items2.length-1 ){
				//console.log( "two" );
				var it = JSON.parse( JSON.stringify( this.items2[ vi ] ) );
				this.items2.splice( vi, 1 );
				this.items2.push( it );
			}
			this.informparent();
		},
		listitemedited: function( vi, vsubi, vdata ){
			this.items2[vi]['sub'][vsubi] = vdata;
			this.informparent();
		}
	},
	template: `<div v-if="showit">
		<div>{</div>
		<div style="margin-left:30px;">
			<template v-for="vitem,vi in items2"  >
			<div style="white-space:nowrap; display:flex; column-gap:5px; margin-bottom:5px;">
					<select class="form-select form-select-sm" style=" display:inline; width:200px; " v-model="vitem['key']" v-on:change="edited_name(vi)" >
						<option value="" >-</option>
						<template v-if="typeof(source_fields)=='object'&&source_fields!=null" >
						<template v-if="Object.keys(source_fields).length>0" >
						<option v-for="vd,vf in source_fields" v-bind:value="vf" >{{ vf }} - {{ vd['type'] }} - {{ vd['index'] }}</option>
						</template>
						</template>
					</select>
					<select class="form-select form-select-sm" style=" display:inline; width:100px; " v-model="vitem['type']" v-on:change="change_field_type(vi)" >
						<option value='text'>Text</option>
						<option value='number'>Number</option>
						<option value='boolean'>Boolean</option>
						<option value='date'>Date</option>
						<option value='datetime'>Datetime</option>
					</select>
					<input v-if="vitem['type']!='primary'" type="checkbox" v-model="vitem['m']" title="Mandatory" >
					<div>
						<span>
						<button class="btn btn-default btn-sm" style="padding:2px;" v-on:click="moveu(vi)" >&#8593;</button>
						<button class="btn btn-default btn-sm" style="padding:2px;" v-on:click="moved(vi)" >&darr;</button>
						</span>
					</div>
					<div>
						<input v-if="vitem['index']!='primary'" class="btn btn-outline-danger btn-sm" style="padding:0px 3px;" type='button' v-on:click="deletenode(vi)" value='X' >
					</div>
			</div>
			</template>
			<div v-if="add_new_item==false">
				<input class="btn btn-outline-dark btn-sm" style="padding:0px 3px;" type='button' v-on:click="add_new_item=true" value='+'>
			</div>
			<div v-if="add_new_item" style="display:flex; column-gap:5px; margin-bottom:5px;">
				<select class="form-select form-select-sm" style="display:inline;width:150px;" v-model="new_item_name">
					<option value="" >-</option>
					<template v-if="typeof(source_fields)=='object'&&source_fields!=null" >
						<template v-if="Object.keys(source_fields).length>0" >
							<option v-for="vd,vf in source_fields" v-bind:value="vf" >{{ vf }} - {{ vd['type'] }} - {{ vd['index'] }}</option>
						</template>
					</template>
				</select>
				<input class="btn btn-outline-dark btn-sm"  style="padding:0px 3px;" type='button' v-on:click="addit" value='+'>
			</div>
		</div>
		<div>}</div>
	</div>`
};
