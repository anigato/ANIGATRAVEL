@extends('user.user')
@section('title','Pemesanan')
@section('header')
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
      <a class="navbar-brand" href="{{ route('cc') }}">ANIGATRAVEL</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="{{ route('cc') }}" class="nav-link">Layar Awal</a></li>
        <li class="nav-item"><a href="{{route('manual')}}" class="nav-link">Manual</a></li>

        @if(session('level')==null)
        <li class="nav-item"><a href="{{route('user_login')}}" class="nav-link">Login</a></li>
        <li class="nav-item active"><a href="{{route('user_register')}}" class="nav-link">Daftar</a></li>
        @endif

      </ul>
      </div>
  </div>
</nav>
  <!-- END nav -->

  <section class="home-slider owl-carousel" id="app2">
    <div class="slider-item" style="background-image: url('../voyage/images/borobudur2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text align-items-center">
          <div class="col-md-7 col-sm-12 ftco-animate">
            <div style="background-color:rgba(0,0,0,0.5);border-radius:10px;padding:20px">
              <h1 class="mb-3">Daftar</h1>
              <form class="user" method="post" v-on:submit.prevent="simpan">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input style="border-radius:10px;" type="text" class="form-control" v-model="username" placeholder="Username">
                    <div v-if="checkError('username')" style="color:white">
                      <div>
                        <strong>Warning!</strong> @{{ errors.username[0] }}.
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <input style="border-radius:10px;" type="text" class="form-control" v-model="nama_penumpang" placeholder="Nama Lengkap">
                    <div v-if="checkError('nama_penumpang')" style="color:white">
                      <div>
                        <strong>Warning!</strong> @{{ errors.nama_penumpang[0] }}.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input style="border-radius:10px;" type="password" class="form-control" v-model="password" placeholder="Password">
                    <div v-if="checkError('password')" style="color:white">
                      <div>
                        <strong>Warning!</strong> @{{ errors.password[0] }}.
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <input style="border-radius:10px;" type="password" class="form-control" v-model="confirm_password" placeholder="Konfirmasi Password">
                    <div v-if="checkError('confirm_password')" style="color:white">
                      <div>
                        <strong>Warning!</strong> @{{ errors.confirm_password[0] }}.
                      </div>
                    </div>
                  </div>
                </div>
                <button style="border-radius:10px;border: 2px solid white; background:rgba(0, 123, 255, 0.3)" type="submit" class="btn btn-block text-white">Daftar</button>
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
@endpush