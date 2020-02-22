<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ANIGATRAVEL - Login</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('tema/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('tema/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" method="post" id="app1" v-on:submit.prevent="login">
                   
                    <div v-if="(status === 401)">Username & Password Salah</div>
                    <div v-if="(status === 421)">Password Salah</div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" v-model="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" v-model="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                    <hr>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{asset('tema/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('tema/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{asset('tema/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{asset('tema/js/sb-admin-2.min.js')}}"></script>
  <!-- vue -->
  <script type="text/javascript" src="{{ asset('js/vue.js') }}"></script>
  
	<script type="text/javascript">
		var xhttp = new XMLHttpRequest();
		var app = new Vue({
		  el: '#app1',
		  data: {
		    username:'',
		    password:'',
		    status:0,
		    errors:{},
		  },
		  methods : {
		  		login : function(){
		  			var url = "{{route('login')}}";
		  			var data='?username='+this.username+'&password='+this.password;

		  			xhttp.onreadystatechange = function() {
				        if (this.readyState == 4) {
				        	console.log(this.status,this.responseText)
				        	app.errors = {}
				        	app.status = this.status;

				        	if (this.status == 401) {
				        		app.errors = JSON.parse(this.responseText);
				        		console.log(1);
                  }
                  if (this.status == 421) {
				        		app.errors = JSON.parse(this.responseText);
				        		console.log(1);
				        	}

				        	if (this.status == 200) {
				        		window.location.replace("{{ route('dashboard_admin') }}");
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

</body>

</html>
