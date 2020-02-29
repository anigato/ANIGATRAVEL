@extends('user.user')
@section('title','Pemesanan')
@section('header')
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
      <a class="navbar-brand" href="index.html">ANIGATRAVEL</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="{{ route('cc') }}" class="nav-link">Layar Awal</a></li>
        <li class="nav-item"><a href="{{route('manual')}}" class="nav-link">Manual</a></li>

        <li class="nav-item active"><a href="{{route('login')}}" class="nav-link">Login</a></li>
        <li class="nav-item"><a href="{{route('user_register')}}" class="nav-link">Daftar</a></li>
        
      </ul>
      </div>
  </div>
</nav>
  <!-- END nav -->

  <section class="home-slider owl-carousel" id="app1" >
    <div class="slider-item" style="background-image: url('../voyage/images/perahu.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text align-items-center">
          <div class="col-md-7 col-sm-12 ftco-animate">
            <div style="background-color:rgba(0,0,0,0.5);border-radius:10px;padding:20px">
              <h1 class="mb-3">Login</h1>
              <form class="user" method="post"v-on:submit.prevent="login">
                <div class="form-group">
                  <input style="border-radius:20px" type="text" class="form-control form-control-user" v-model="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input style="border-radius:20px" type="password" class="form-control form-control-user" v-model="password" placeholder="Password">
                </div>

                <button style="border-radius:10px;border: 2px solid white; background:rgba(0, 123, 255, 0.3)" type="submit" class="btn btn-primary btn-user btn-block">Login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@push('js')
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
                  swal({
                    title: "Gagal!",
                    text: "Username dan Password salah! Silahkan cek lagi",
                    icon: "error",
                    button: "OK",
                  });
                }
                if (this.status == 421) {
                  swal({
                    title: "Gagal!",
                    text: "Password salah! Silahkan cek lagi",
                    icon: "error",
                    button: "OK",
                  });
                }

                if (this.status == 200) {
                  // window.location.replace("{{ route('dashboard_user') }}");
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
@endpush
