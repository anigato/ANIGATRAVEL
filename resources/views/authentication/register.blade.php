@extends('layouts.auth')

@section('content')

<div class="container" >
	<form method="post" id="app2" v-on:submit.prevent="simpan">

		<div v-if="(status === 200)">Success</div>

		<label>Username</label>
		<input type="text" v-model="username"> 
		<div v-if="checkError('username')">@{{ errors.username[0] }}</div>
	    <br>

		<label>First Name</label>
		<input type="text" v-model="first_name">
		<div v-if="checkError('first_name')">@{{ errors.first_name[0] }}</div>
	    <br>


		<label>Last Name</label>
		<input type="text" v-model="last_name">
		<div v-if="checkError('last_name')">@{{ errors.last_name[0] }}</div>
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
    first_name:'',
    last_name:'',
    password:'',
    confirm_password:'',
    status:0,
    errors:{},
  },
  methods : {
  		simpan : function(){
  			var url = "{{route('daftar')}}";
  			var data='?username='+this.username
  			+'&first_name='+this.first_name
  			+'&last_name='+this.last_name
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