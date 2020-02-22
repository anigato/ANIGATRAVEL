@extends('layouts.main')
@section('content')

<div class="container" id="app3">
	<h1>jadwal</h1>
	<a href="{{ route('home') }}">home</a>
	<form method="post" v-on:submit.prevent="create" v-if="baru">
		<div v-if="(status === 200)">Success</div>

	    <label>waktu_berangkat</label>
		<input type="time" v-model="waktu_berangkat"> 
		<!-- <div v-if="checkError('waktu_berangkat')">@{{ errors.waktu_berangkat[0] }}</div> -->
	    <br>

	
		<label>tanggal_berangkat</label>
		<input type="date" v-model="tanggal_berangkat"> 
		<!-- <div v-if="checkError('tanggal_berangkat')">@{{ errors.tanggal_berangkat[0] }}</div> -->
	    <br>

	    <label>waktu_sampai</label>
		<input type="time" v-model="waktu_sampai"> 
		<!-- <div v-if="checkError('waktu_sampai')">@{{ errors.waktu_sampai[0] }}</div> -->
	    <br>
	
		<label>tanggal_sampai</label>
		<input type="date" v-model="tanggal_sampai"> 
		<!-- <div v-if="checkError('tanggal_sampai')">@{{ errors.tanggal_sampai[0] }}</div> -->
	    <br>

	    <label>harga</label>
		<input type="number" v-model="harga"> 
		<!-- <div v-if="checkError('harga')">@{{ errors.harga[0] }}</div> -->
	    <br>

	    <label>id_rute</label>
		<select v-model="id_rute">
			<option v-for="rute in rutes" :value="rute.id_rute">@{{rute.tujuan}} | @{{rute.rute_awal}} -> @{{rute.rute_akhir}}</option>
		</select>
		<!-- <div v-if="checkError('id_rute')">@{{ errors.id_rute[0] }}</div> -->
	    <br>

	    <button type="submit">Create</button>
	    <button type="button" v-on:click="batal" >Cancel</button>

	</form>

	<form method="post" v-on:submit.prevent="update" v-if="ubah">
		<div v-if="(status === 200)">Success</div>

	    <label>waktu_berangkat</label>
		<input type="time" v-model="waktu_berangkat"> 
		<!-- <div v-if="checkError('waktu_berangkat')">@{{ errors.waktu_berangkat[0] }}</div> -->
	    <br>
	
		<label>tanggal_berangkat</label>
		<input type="date" v-model="tanggal_berangkat"> 
		<!-- <div v-if="checkError('tanggal_berangkat')">@{{ errors.tanggal_berangkat[0] }}</div> -->
	    <br>

	    <label>waktu_sampai</label>
		<input type="time" v-model="waktu_sampai"> 
		<!-- <div v-if="checkError('waktu_sampai')">@{{ errors.waktu_sampai[0] }}</div> -->
	    <br>
	
		<label>tanggal_sampai</label>
		<input type="date" v-model="tanggal_sampai"> 
		<!-- <div v-if="checkError('tanggal_sampai')">@{{ errors.tanggal_sampai[0] }}</div> -->
	    <br>

	    <label>harga</label>
		<input type="number" v-model="harga"> 
		<!-- <div v-if="checkError('harga')">@{{ errors.harga[0] }}</div> -->
	    <br>

	    <label>id_rute</label>
		<select v-model="id_rute">
			<option v-for="rute in rutes" :value="rute.id_rute">@{{rute.tujuan}} | @{{rute.rute_awal}} -> @{{rute.rute_akhir}}</option>
		</select>
		<!-- <div v-if="checkError('id_rute')">@{{ errors.id_rute[0] }}</div> -->
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
			<td>berangkat</td>
			<td>sampai</td>
			<td>Harga</td>
			<td>Aksi</td>
		</tr>

		<tr v-for="i in jadwalAll">
			<td>@{{i.tujuan}}</td>
			<td>@{{i.rute_awal}} on @{{i.waktu_berangkat}} @{{i.tanggal_berangkat}}</td>
			<td>@{{i.rute_akhir}} on @{{i.waktu_sampai}} @{{i.tanggal_sampai}}</td>
			<td>@{{i.harga}}</td>
			<td>
				<button type="submit" v-on:click="edit(i.id_jadwal,i.id_rute,i.waktu_berangkat,i.tanggal_berangkat,i.waktu_sampai,i.tanggal_sampai,i.harga,i.tujuan,i.rute_awal,i.rute_akhir)">Edit</button>
				<button type="submit" v-on:click="del(i.id_jadwal)" >
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
  		tujuan:'',
  		rute_awal:'',
  		ket:'',
  		rute_akhir:'',
  		rute:'',
  		waktu_berangkat:'',
  		tanggal_berangkat:'',
  		waktu_sampai:'',
  		tanggal_sampai:'',
    	harga:'',
    	id_rute:0,
    	cari:'',
    	baru:false,
    	ubah:false,
    	buttonBaru:true,
    	status:0,
    	jadwalAll:[],
    	rute:'',
    	rutes:[],
  	},
  	beforeMount : function(){
    	this.getAll();
 	},
  	methods : {
  		tt : function(){
  			var url = "{{route('jadwal_rute')}}";

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
						app.rutes = JSON.parse(this.responseText);
					}
				}
			}
			xhttp.open("GET",url, true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
  		},
  		find : function(){
  			var url = "{{route('jadwal_search')}}";
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
			var url = "{{route('jadwal_search')}}";
			var data_token = '?token='+token;
			var data = '&cari='+this.cari;

			xhttp.onreadystatechange = function(){
				if (this.readyState == 4) {
					console.log(this.status,this.responseText)

					if (this.status == 401) {
						alert('Unauthorized User')
					}
					if (this.status == 422) {
						alert('Invalid_rute Field')
					}
					if (this.status == 200) {
						app.jadwalAll = JSON.parse(this.responseText);
					}
				}
			}
			xhttp.open("GET", url+data_token+data, true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
		}, 
		create : function(){
			var url 		= "{{ route('jadwal_create') }}";
			var data_token ='?token='+token;
			var data 		= 
				 "&harga="+this.harga
				+"&waktu_berangkat="+this.waktu_berangkat
				+"&tanggal_berangkat="+this.tanggal_berangkat
				+"&waktu_sampai="+this.waktu_sampai
				+"&tanggal_sampai="+this.tanggal_sampai
				+"&id_rute="+this.id_rute;

			xhttp.onreadystatechange = function() {
		        if (this.readyState == 4) {
		        	console.log(this.status,this.responseText)

		        	if (this.status == 401) {
		        		alert('Unauthorized User')
		        	}

		        	if (this.status == 422) {
		        		alert('Invalid_rute field');
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
			var url = "{{route('jadwal_all')}}";
			var data_token = '?token='+token;
			var data = '';

			xhttp.onreadystatechange = function(){
				if (this.readyState == 4) {
					console.log(this.status,this.responseText)

					if (this.status == 401) {
						alert('Unauthorized User')
					}
					if (this.status == 422) {
						alert('Invalid_rute Field')
					}
					if (this.status == 200) {
						app.jadwalAll = JSON.parse(this.responseText);
					}
				}
			}
			xhttp.open("GET", url+data_token+data, true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
		}, 
		del : function(id_jadwal){
			var url = "/anigatravel/jadwal/";
			var data_token = "?token="+token;
			var data = id_jadwal+"/"+data_token;

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

		edit : function(id_jadwal,id_rute,waktu_berangkat,tanggal_berangkat,waktu_sampai,tanggal_sampai,harga){
			this.id_jadwal = id_jadwal;
			this.id_rute = id_rute;
			this.baru = false;
			this.ubah = true;
			this.buttonBaru = false;
			this.harga = harga;
			this.waktu_berangkat = waktu_berangkat;
			this.tanggal_berangkat = tanggal_berangkat;
			this.waktu_sampai = waktu_sampai;
			this.tanggal_sampai = tanggal_sampai;
			app.tt();
		},
		buat : function(){
			this.baru = true;
			this.ubah = false;
			this.buttonBaru = false;
			app.tt();
		},

		batal : function(){
			this.baru = false;
			this.ubah = false;
			this.buttonBaru = true;
			this.harga = '';
			this.rute = '';
			this.id_rute = 0;
			this.tanggal_berangkat = '';
			this.waktu_berangkat = '';
			this.tanggal_sampai = '';
			this.waktu_sampai = '';
		},

		update : function(){
			var url = "/anigatravel/jadwal/";
			var data_token = "?token="+token;
			var data = this.id_jadwal+"/"+data_token
				+"&harga="+this.harga
				+"&waktu_berangkat="+this.waktu_berangkat
				+"&tanggal_berangkat="+this.tanggal_berangkat
				+"&waktu_sampai="+this.waktu_sampai
				+"&tanggal_sampai="+this.tanggal_sampai
				+"&id_rute="+this.id_rute
				;

			xhttp.onreadystatechange = function(){
				if (this.readyState == 4) {
					console.log(this.status,this.responseText)

					if (this.status == 422) {
						alert('Invalid_rute Field')
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