@extends('layouts.main')
@section('content')

<div class="container" id="app3">
	<h1>Transportasi</h1>
	<a href="{{ route('home') }}">home</a>
	<form method="post" v-on:submit.prevent="create" v-if="baru">
		<div v-if="(status === 200)">Success</div>

		<label>Nama Type</label> 
	    <select v-model="nama_type">
	    	<option value="Pesawat">Pesawat</option>
	    	<option value="Kereta">Kereta</option>
	    </select>
	    <!-- <div v-if="checkError('nama_type')">@{{ errors.nama_type[0] }}</div> -->
	    <br>

	    <label>keterangan</label>
		<input type="text" v-model="keterangan"> 
		<!-- <div v-if="checkError('keterangan')">@{{ errors.keterangan[0] }}</div> -->
	    <br>
	    <br>

	    <button type="submit">Create</button>
		<button type="button" v-on:click="batal" >Cancel</button>

	</form>

	<form method="post" v-on:submit.prevent="update" v-if="ubah">
		<div v-if="(status === 200)">Success</div>

		<label>Nama Type</label> 
	    <select v-model="nama_type">
	    	<option value="Pesawat">Pesawat</option>
	    	<option value="Kereta">Kereta</option>
	    </select>
	    <!-- <div v-if="checkError('nama_type')">@{{ errors.nama_type[0] }}</div> -->
	    <br>

	    <label>keterangan</label>
		<input type="text" v-model="keterangan"> 
		<!-- <div v-if="checkError('keterangan')">@{{ errors.keterangan[0] }}</div> -->
	    <br>
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
			<td>Nama Type</td>
			<td>Keterangan</td>
			<td>Action</td>
		</tr>

		<tr v-for="i in transportasiAll">
			<td>@{{i.nama_type}}</td>
			<td>@{{i.keterangan}}</td>
			<td>
				<button type="submit" v-on:click="edit(i.id_type_transportasi,i.nama_type,i.keterangan)">Edit</button>
				<button type="submit" v-on:click="del(i.id_type_transportasi)" >
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
  		keterangan:'',
    	nama_type:'',
    	id_type_transportasi:0,
    	baru:false,
    	ubah:false,
    	buttonBaru:true,
    	cari:'',
    	status:0,
    	transportasiAll:[{"id_type_transportasi":10,"nama_type":"aug","keterangan":"miaw"}],
  	},
  	beforeMount : function(){
    	this.getAll();
 	},
  	methods : {
  		find : function(){
  			var url = "{{route('type_search')}}";
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
			var url = "{{route('type_search')}}";
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
		getAll : function(){
			var url = "{{route('type_all')}}";
			var data_token = '?token='+token;
			var data = '';

			xhttp.onreadystatechange = function(){
				if (this.readyState == 4) {
					console.log(this.status,this.responseText)

					if (this.status == 401) {
						alert('Unauthorized User')
					}
					if (this.status == 422) {
						alert('Invalid_type_transportasi Field')
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
			var url 		= "{{ route('type_create') }}";
			var data_token ='?token='+token;
			var data 		= 
				 "&nama_type="+this.nama_type
				+"&keterangan="+this.keterangan;

			xhttp.onreadystatechange = function() {
		        if (this.readyState == 4) {
		        	console.log(this.status,this.responseText)

		        	if (this.status == 401) {
		        		alert('Unauthorized User')
		        	}

		        	if (this.status == 422) {
		        		alert('Invalid_type_transportasi field');
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

		
		del : function(id_type_transportasi){
			var url = "/anigatravel/type_transportasi/";
			var data_token = "?token="+token;
			var data = id_type_transportasi+"/"+data_token;

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

		edit : function(id_type_transportasi,nama_type,keterangan){
			this.id_type_transportasi = id_type_transportasi;
			this.baru = false;
			this.ubah = true;
			this.buttonBaru = false;
			this.nama_type = nama_type;
			this.keterangan = keterangan;
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
			this.nama_type = '';
			this.keterangan = '';
			this.id_type_transportasi = 0;
		},

		update : function(){
			var url = "/anigatravel/type_transportasi/";
			var data_token = "?token="+token;
			var data = this.id_type_transportasi+"/"+data_token
				+"&nama_type="+this.nama_type
				+"&keterangan="+this.keterangan;

			xhttp.onreadystatechange = function(){
				if (this.readyState == 4) {
					console.log(this.status,this.responseText)

					if (this.status == 422) {
						alert('Invalid_type_transportasi Field')
					}
					if (this.status == 401) {
						alert('Unauthorized User')
					}
					if (this.status == 200) {
						app.getAll();
						app.batal();
						alert('Update type Success');
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