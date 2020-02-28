<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ANIGATRAVEL - Register</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('tema/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{asset('tema/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row-lg">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
            </div>
            <form class="user" method="post" id="app2" v-on:submit.prevent="simpan">
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="text" class="form-control form-control-user" v-model="username" placeholder="Username">
                  <div v-if="checkError('username')" style="color:red">
                    <strong>Warning!</strong> @{{ errors.username[0] }}.
                  </div>
                </div>
                <div class="col-sm-6">
                  <input type="text" class="form-control form-control-user" v-model="nama_penumpang" placeholder="Full name">
                  <div v-if="checkError('nama_penumpang')" style="color:red">
                    <strong>Warning!</strong> @{{ errors.nama_penumpang[0] }}.
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                  <input type="password" class="form-control form-control-user" v-model="password" placeholder="Password">
                  <div v-if="checkError('password')" style="color:red">
                    <strong>Warning!</strong> @{{ errors.password[0] }}.
                  </div>
                </div>
                <div class="col-sm-6">
                  <input type="password" class="form-control form-control-user" v-model="confirm_password" placeholder="Repeat Password">
                  <div v-if="checkError('confirm_password')" style="color:red">
                    <strong>Warning!</strong> @{{ errors.confirm_password[0] }}.
                  </div>
                </div>
              </div>
              <button class="btn btn-primary btn-user btn-block">
                Register Account
              </button>
              <hr>
            </form>
            <hr>
            <div class="text-center">
              <p>Udah Punya Akun? Silahkan <a class="small" href="{{route('user_login')}}">Login!</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>
    <!-- vue -->
  <script type="text/javascript" src="{{ url('js/vue.js') }}"></script>
  
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
                    // window.location.replace("{{ route('flight') }}");
                    window.location.replace("{{ route('cc') }}");
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
