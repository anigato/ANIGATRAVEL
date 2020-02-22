@extends('layouts.auth')

@section('content')

<div class="container" >
	<form method="post" id="app2" v-on:submit.prevent="simpan">

		<div v-if="(status === 200)">Success</div>

		<label>Username</label>
		<input type="text" v-model="username"> 
		<div v-if="checkError('username')">@{{ errors.username[0] }}</div>
	    <br>

		<label>Name</label>
		<input type="text" v-model="nama_penumpang">
		<div v-if="checkError('nama_penumpang')">@{{ errors.nama_penumpang[0] }}</div>
	    <br>

		<label>Alamat</label>
		<input type="text" v-model="alamat_penumpang">
		<div v-if="checkError('alamat_penumpang')">@{{ errors.alamat_penumpang[0] }}</div>
	    <br>

	    <label>Tanggal Lahir</label>
		<input type="date" v-model="tanggal_lahir">
		<div v-if="checkError('tanggal_lahir')">@{{ errors.tanggal_lahir[0] }}</div>
	    <br>

	    <label>Jenis Kelamin</label>
		<select v-model="jenis_kelamin">
			<option value="Laki-Laki">Laki-Laki</option>
			<option value="Perempuan">Perempuan</option>
		</select>
		<div v-if="checkError('jenis_kelamin')">@{{ errors.jenis_kelamin[0] }}</div>
	    <br>

	    <label>Telephone</label>
		<input type="number" v-model="telepone">
		<div v-if="checkError('telepone')">@{{ errors.telepone[0] }}</div>
	    <br>

		<label>Password</label>
		<input type="password" v-model="password">
		<div v-if="checkError('password')">@{{ errors.password[0] }}</div>
	    <br>

		<label>Confirm Password</label>
		<input type="password" v-model="confirm_password" >
		<div v-if="checkError('confirm_password')">@{{ errors.confirm_password[0] }}</div>
	    <br>

		<button type="submit">Register</button>

	</form>

</div>

@endsection

@push('js')
<script type="text/javascript">
var xhttp = new XMLHttpRequest();

var app = new Vue({
  el: '#app2',
  data: {
    username:'',
    nama_penumpang:'',
    alamat_penumpang:'',
    tanggal_lahir:'',
    jenis_kelamin:'',
    telepone:'',
    password:'',
    confirm_password:'',
    status:0,
    errors:{},
  },
  methods : {
  		simpan : function(){
  			var url = "{{route('user_daftar')}}";
  			var data='?username='+this.username
  			+'&nama_penumpang='+this.nama_penumpang
  			+'&alamat_penumpang='+this.alamat_penumpang
  			+'&tanggal_lahir='+this.tanggal_lahir
  			+'&jenis_kelamin='+this.jenis_kelamin
  			+'&telepone='+this.telepone
  			+'&password='+this.password
  			+'&confirm_password='+this.confirm_password;

  			xhttp.onreadystatechange = function() {
		        if (this.readyState == 4) {
		        	console.log(this.status,this.responseText)
		        	app.errors = {}
		        	app.status = this.status;

		        	if (this.status == 422) {
		        		app.errors = JSON.parse(this.responseText);
		        		console.log(1);
		        	}

		        	if (this.status == 200) {
		        		alert('Register success');
		        		window.location.replace("{{ route('home') }}");
		        	}
		        }
		    }

	        xhttp.open("POST", url+data, true);
	        xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
	        xhttp.send();
		},

		checkError : function(key){
		 	return this.errors.hasOwnProperty(key);
		}
  },
});
</script>
@endpush