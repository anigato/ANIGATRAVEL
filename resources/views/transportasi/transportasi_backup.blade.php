@extends('layouts.main')
@section('content')

<div class="container" id="app3">
	<h1>Transportasi</h1>
	<a href="{{ route('home') }}">home</a>
	<form method="post" v-on:submit.prevent="create" v-if="baru">
		<div v-if="(status === 200)">Success</div>

		<label>kode</label>
		<input type="text" v-model="kode" maxlength="4"> 
		<!-- <div v-if="checkError('kode')">@{{ errors.kode[0] }}</div> -->
	    <br>

	    <label>jumlah_kursi</label>
		<input type="text" v-model="jumlah_kursi"> 
		<!-- <div v-if="checkError('jumlah_kursi')">@{{ errors.jumlah_kursi[0] }}</div> -->
	    <br>
	
		<label>keterangan</label>
		<input type="text" v-model="keterangan"> 
		<!-- <div v-if="checkError('keterangan')">@{{ errors.keterangan[0] }}</div> -->
	    <br>

	    <label>id_type_transportasi</label>
		<select v-model="id_type_transportasi">
			<option v-for="tipe in tipes" v-bind:value="tipe.id_type_transportasi">@{{tipe.nama_type}} @{{tipe.keterangan}}</option>
		</select>
		<!-- <div v-if="checkError('id_type_transportasi')">@{{ errors.id_type_transportasi[0] }}</div> -->
	    <br>	

	    <button type="submit">Create</button>
	    <button type="button" v-on:click="batal" >Cancel</button>

	</form>

	<form method="post" v-on:submit.prevent="update" v-if="ubah">
		<div v-if="(status === 200)">Success</div>

		<label>kode</label>
		<input type="text" v-model="kode" maxlength="4"> 
		<!-- <div v-if="checkError('kode')">@{{ errors.kode[0] }}</div> -->
	    <br>

	    <label>jumlah_kursi</label>
		<input type="text" v-model="jumlah_kursi"> 
		<!-- <div v-if="checkError('jumlah_kursi')">@{{ errors.jumlah_kursi[0] }}</div> -->
	    <br>
	
		<label>keterangan</label>
		<input type="text" v-model="keterangan"> 
		<!-- <div v-if="checkError('keterangan')">@{{ errors.keterangan[0] }}</div> -->
	    <br>

	    <label>id_type_transportasi</label>
		<select v-model="id_type_transportasi">
			<option v-for="tipe in tipes" :value="tipe.id_type_transportasi">@{{tipe.nama_type}} @{{tipe.keterangan}}</option>
		</select>
		<!-- <div v-if="checkError('id_type_transportasi')">@{{ errors.id_type_transportasi[0] }}</div> -->
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
			<td>Kode</td>
			<td>Jumlah Kursi</td>
			<td>Keterangan</td>
			<td>tipe</td>
			<td>Action</td>
		</tr>

		<tr v-for="i in transportasiAll">
			<td>@{{i.kode}}</td>
			<td>@{{i.jumlah_kursi}}</td>
			<td>@{{i.keterangan}}</td>
			<td>@{{i.nama_type}} @{{i.ket}}</td>
			<td>
				<button type="submit" v-on:click="edit(i.id_transportasi,i.kode,i.jumlah_kursi,i.keterangan,i.id_type_transportasi,i.nama_type)">Edit</button>
				<button type="submit" v-on:click="del(i.id_transportasi)" >
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
  		jumlah_kursi:'',
  		keterangan:'',
    	kode:'',
    	id_transportasi:0,
    	cari:'',
    	baru:false,
    	ubah:false,
    	buttonBaru:true,
    	status:0,
    	nama_type:'',
    	transportasiAll:[{"id_transportasi":null,"kode":null,"jumlah_kursi":null,"keterangan":null,"id_type_transportasi":null,"nama_type":null}],
    	tipe:'',
    	tipes:[],
  	},
  	beforeMount : function(){
    	this.getAll();
 	},
  	methods : {
  		type : function(){
  			var url = "{{route('type')}}";

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
						app.tipes = JSON.parse(this.responseText);
					}
				}
			}
			xhttp.open("GET",url, true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
  		},
  		find : function(){
  			var url = "{{route('transportasi_search')}}";
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
			var url = "{{route('transportasi_search')}}";
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
						app.transportasiAll = JSON.parse(this.responseText);
					}
				}
			}
			xhttp.open("GET", url+data_token+data, true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
		}, 
		create : function(){
			var url 		= "{{ route('create_transportasi') }}";
			var data_token ='?token='+token;
			var data 		= 
				 "&kode="+this.kode
				+"&jumlah_kursi="+this.jumlah_kursi
				+"&keterangan="+this.keterangan
				+"&id_type_transportasi="+this.id_type_transportasi;

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
		        		alert('Create Transportasi success');
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
			var url = "{{route('transportasi_all')}}";
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
						app.transportasiAll = JSON.parse(this.responseText);
					}
				}
			}
			xhttp.open("GET", url+data_token+data, true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
		}, 
		del : function(id_transportasi){
			var url = "/anigatravel/transportasi/";
			var data_token = "?token="+token;
			var data = id_transportasi+"/"+data_token;

			xhttp.onreadystatechange = function(){
				if (this.readyState == 4) {
					console.log(this.status,this.responseText)

					if (this.status == 401) {
						alert('Unauthorized User')
					}
					if (this.status == 200) {
						app.getAll();
						alert('Delete Board Success');
					}
				}
			}
			xhttp.open("DELETE", url+data , true);
			xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
			xhttp.send();
		},

		edit : function(id_transportasi,kode,jumlah_kursi,keterangan,id_type_transportasi){
			this.id_transportasi = id_transportasi;
			this.baru = false;
			this.ubah = true;
			this.buttonBaru = false;
			this.kode = kode;
			this.jumlah_kursi = jumlah_kursi;
			this.keterangan = keterangan;
			this.id_type_transportasi = id_type_transportasi;
			this.type();
		},

		buat : function(){
			this.baru = true;
			this.ubah = false;
			this.buttonBaru = false;
			app.type();
		},

		batal : function(){
			this.baru = false;
			this.ubah = false;
			this.buttonBaru = true;
			this.kode = '';
			this.keterangan = '';
			this.id_type_transportasi = '';
			this.jumlah_kursi = '';
			this.id_transportasi = 0;
		},

		update : function(){
			var url = "/anigatravel/transportasi/";
			var data_token = "?token="+token;
			var data = this.id_transportasi+"/"+data_token
				+"&kode="+this.kode
				+"&keterangan="+this.keterangan
				+"&jumlah_kursi="+this.jumlah_kursi
				+"&id_type_transportasi="+this.id_type_transportasi
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
						alert('Update transportasi Success');
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