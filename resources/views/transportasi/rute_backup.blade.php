@extends('layouts.main')
@section('content')

<div class="container" id="app3">
	<h1>Rute</h1>
	<a href="{{ route('home') }}">home</a>
	<form method="post" v-on:submit.prevent="create" v-if="baru">
		<div v-if="(status === 200)">Success</div>

		<label>tujuan</label>
		<input type="text" v-model="tujuan"> 
		<!-- <div v-if="checkError('tujuan')">@{{ errors.tujuan[0] }}</div> -->
	    <br>

	    <label>rute_awal</label>
		<input type="text" v-model="rute_awal"> 
		<!-- <div v-if="checkError('rute_awal')">@{{ errors.rute_awal[0] }}</div> -->
	    <br>
	
		<label>rute_akhir</label>
		<input type="text" v-model="rute_akhir"> 
		<!-- <div v-if="checkError('rute_akhir')">@{{ errors.rute_akhir[0] }}</div> -->
	    <br>


	    <label>id_transportasi</label>
		<select v-model="id_transportasi">
			<option v-for="tran in trans" :value="tran.id_transportasi">@{{tran.kode}} | @{{tran.keterangan}} | @{{tran.nama_type}} @{{tran.ket}}</option>
		</select>
		<!-- <div v-if="checkError('id_transportasi')">@{{ errors.id_transportasi[0] }}</div> -->
	    <br>

	    <button type="submit">Create</button>
	    <button type="button" v-on:click="batal" >Cancel</button>

	</form>

	<form method="post" v-on:submit.prevent="update" v-if="ubah">
		<div v-if="(status === 200)">Success</div>

		<label>tujuan</label>
		<input type="text" v-model="tujuan"> 
		<!-- <div v-if="checkError('tujuan')">@{{ errors.tujuan[0] }}</div> -->
	    <br>

	    <label>rute_awal</label>
		<input type="text" v-model="rute_awal"> 
		<!-- <div v-if="checkError('rute_awal')">@{{ errors.rute_awal[0] }}</div> -->
	    <br>
	
		<label>rute_akhir</label>
		<input type="text" v-model="rute_akhir"> 
		<!-- <div v-if="checkError('rute_akhir')">@{{ errors.rute_akhir[0] }}</div> -->
	    <br>


	    <label>id_transportasi</label>
		<select v-model="id_transportasi">
			<option v-for="tran in trans" :value="tran.id_transportasi">@{{tran.kode}} | @{{tran.keterangan}} | @{{tran.nama_type}} @{{tran.ket}}</option>
		</select>
		<!-- <div v-if="checkError('id_transportasi')">@{{ errors.id_transportasi[0] }}</div> -->
	    <br>

	    <button type="submit">update</button>
	    <button type="button" v-on:click="batal" >Cancel</button>

	</form>
	<br><br>

	<form v-on:submit.prevent="find" method="get">
		<input type="text" v-model="cari" @keyup="find" placeholder="Cari">
	</form>

	<button v-on:click="buat" v-if="buttonBaru">Create</button>

	<table border="1">
		<tr>
			<td>Tujuan</td>
			<td>Rute Awal</td>
			<td>Rute Akhir</td>
			<td>Id Transportasi</td>
			<td>Aksi</td>
		</tr>

		<tr v-for="i in ruteAll">
			<td>@{{i.tujuan}}</td>
			<td>@{{i.rute_awal}}</td>
			<td>@{{i.rute_akhir}}</td>
			<td>@{{i.kode}} | @{{i.keterangan}} | @{{i.nama_type}} @{{i.ket}}</td>
			<td>
				<button type="submit" v-on:click="edit(i.id_rute,i.tujuan,i.rute_awal,i.rute_akhir,i.id_transportasi,i.kode,i.keterangan,i.ket,i.nama_type)">Edit</button>
				<button type="submit" v-on:click="del(i.id_rute)" >
					Delete</button>	
			</td>
		</tr>

	</table>
	
</div>
@endsection

@push('js')
<script type="text/javascript">
var xhttp = new XMLHttpRequest();
var token = "<?= session('token') ?>";


var app = new Vue({
  	el: '#app3',
  	data: {
  		kode:'',
  		keterangan:'',
  		ket:'',
  		nama_type:'',
  		tujuan:'',
  		rute_awal:'',
  		rute_akhir:'',
    	id_transportasi:'',
    	id_rute:0,
    	cari:'',
    	baru:false,
    	ubah:false,
    	buttonBaru:true,
    	status:0,
    	ruteAll:[{"id_transportasi":10,"tujuan":10,"rute_awal":"miaw","tujuan":10,"rute_akhir":10}],
    	tran:'',
    	trans:[],
  	},
  	beforeMount : function(){
    	this.getAll();
 	},
  	methods : {
  		transportasi : function(){
  			var url = "{{route('rute_trans')}}";

			xhttp.onreadystatechange = function(){
				if (this.readyState == 4) {
					console.log(this.status,this.responseText)

					if (this.status == 401) {
						alert('Unauthorized User')
					}
					if (this.status == 422) {
						alert('Not Found')
					}
					if (this.status == 200) {
						app.trans = JSON.parse(this.responseText);
					}
				}
			}
			xhttp.open("GET",url, true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
  		},
  		find : function(){
  			var url = "{{route('rute_search')}}";
			var data_token = '?token='+token;
			var data = '&cari='+this.cari;

			xhttp.onreadystatechange = function(){
				if (this.readyState == 4) {
					console.log(this.status,this.responseText)

					if (this.status == 401) {
						alert('Unauthorized User')
					}
					if (this.status == 422) {
						alert('Not Found')
					}
					if (this.status == 200) {
						app.findone();
					}
				}
			}
			xhttp.open("GET", url+data_token+data, true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
  		},
  		findone : function(){
			var url = "{{route('rute_search')}}";
			var data_token = '?token='+token;
			var data = '&cari='+this.cari;

			xhttp.onreadystatechange = function(){
				if (this.readyState == 4) {
					console.log(this.status,this.responseText)

					if (this.status == 401) {
						alert('Unauthorized User')
					}
					if (this.status == 422) {
						alert('Invalid_transportasi Field')
					}
					if (this.status == 200) {
						app.ruteAll = JSON.parse(this.responseText);
					}
				}
			}
			xhttp.open("GET", url+data_token+data, true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
		}, 
		create : function(){
			var url 		= "{{ route('rute_create') }}";
			var data_token ='?token='+token;
			var data 		= 
				 "&tujuan="+this.tujuan
				+"&rute_awal="+this.rute_awal
				+"&rute_akhir="+this.rute_akhir
				+"&id_transportasi="+this.id_transportasi;

			xhttp.onreadystatechange = function() {
		        if (this.readyState == 4) {
		        	console.log(this.status,this.responseText)

		        	if (this.status == 401) {
		        		alert('Unauthorized User')
		        	}

		        	if (this.status == 422) {
		        		alert('Invalid_transportasi field');
		        	}

		        	if (this.status == 200) {
		        		app.batal();
		        		app.getAll();
		        		alert('Create rute success');
		        	}
		        }
		    }
		    xhttp.open("POST", url+data_token+data, true);
	        xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
	        xhttp.send();

		},
		checkError : function(key){
		 	return this.errors.hasOwnProperty(key);
		},

		getAll : function(){
			var url = "{{route('rute_all')}}";
			var data_token = '?token='+token;
			var data = '';

			xhttp.onreadystatechange = function(){
				if (this.readyState == 4) {
					console.log(this.status,this.responseText)

					if (this.status == 401) {
						alert('Unauthorized User')
					}
					if (this.status == 422) {
						alert('Invalid_transportasi Field')
					}
					if (this.status == 200) {
						app.ruteAll = JSON.parse(this.responseText);
					}
				}
			}
			xhttp.open("GET", url+data_token+data, true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
		}, 
		del : function(id_rute){
			var url = "/anigatravel/rute/";
			var data_token = "?token="+token;
			var data = id_rute+"/"+data_token;

			xhttp.onreadystatechange = function(){
				if (this.readyState == 4) {
					console.log(this.status,this.responseText)

					if (this.status == 401) {
						alert('Unauthorized User')
					}
					if (this.status == 200) {
						app.getAll();
						alert('Delete Rute Success');
					}
				}
			}
			xhttp.open("DELETE", url+data , true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
		},

		edit : function(id_rute,tujuan,rute_awal,rute_akhir,id_transportasi){
			this.id_rute = id_rute;
			this.baru = false;
			this.ubah = true;
			this.buttonBaru = false;
			this.tujuan = tujuan;
			this.rute_awal = rute_awal;
			this.rute_akhir = rute_akhir;
			this.id_transportasi = id_transportasi;
			app.transportasi();
		},
		buat : function(){
			this.baru = true;
			this.ubah = false;
			this.buttonBaru = false;
			app.transportasi();
		},

		batal : function(){
			this.baru = false;
			this.ubah = false;
			this.buttonBaru = true;
			this.rute_awal = '';
			this.id_transportasi = '';
			this.tujuan = '';
			this.id_rute = 0;
			this.rute_akhir = '';
		},

		update : function(){
			var url = "/anigatravel/rute/";
			var data_token = "?token="+token;
			var data = this.id_rute+"/"+data_token
				+"&rute_awal="+this.rute_awal
				+"&rute_akhir="+this.rute_akhir
				+"&tujuan="+this.tujuan
				+"&id_transportasi="+this.id_transportasi
				;

			xhttp.onreadystatechange = function(){
				if (this.readyState == 4) {
					console.log(this.status,this.responseText)

					if (this.status == 422) {
						alert('Invalid_transportasi Field')
					}
					if (this.status == 401) {
						alert('Unauthorized User')
					}
					if (this.status == 200) {
						app.getAll();
						app.batal();
						alert('Update rute Success');
					}
				}
			}
			xhttp.open("PUT", url+data,true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
		}
	},
});

function logout(){
	var url = "{{route('logot')}}";
	var data='?token='+token;

	xhttp.onreadystatechange = function() {
	    if (this.readyState == 4) {
	    	console.log(this.status,this.responseText)

	    	if (this.status == 401) {
	    		alert('Unauthorisez User');
	    	}

	    	if (this.status == 200) {
	    		alert('Logout Sukses')
	    		window.location.replace("{{ route('login') }}");
	    	}
	    }
    }

    xhttp.open("GET", url+data, true);
    xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
    xhttp.send();
}

</script>
@endpush