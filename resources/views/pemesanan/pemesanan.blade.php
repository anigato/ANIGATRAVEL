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

        @if(session('level')=='user')
        <li class="nav-item active"><a href="{{route('pemesanan')}}" class="nav-link">Keranjang</a></li>
        <li class="nav-item"><a href="{{route('dashboard_user')}}" class="nav-link">Pemesanan Saya</a></li>
        @endif

        @if(session('level')==null)
        <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Login</a></li>
        <li class="nav-item"><a href="{{route('user_register')}}" class="nav-link">Daftar</a></li>
        @endif

        @if(session('level')=='user')
        <li class="nav-item dropdown no-arrow" id="app12">
          <a class="nav-link dropdown-toggle text-uppercase font-weight-bold" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{session('username')}}
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="{{route('profile')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" v-on:click="logout_user">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
              </a>
          </div>
        </li>
        @endif
        
      </ul>
      </div>
  </div>
</nav>
  <!-- END nav -->

  <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url('voyage/images/borobudur2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text align-items-center">
          <div class="col-md-7 col-sm-12 ftco-animate">
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Layar Awal</a></span> <span>Keranjang</span></p>
            <h1 class="mb-3">Keranjang</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@section('content1')
  <section style="background-color:#007bff;color:white" class="ftco-section-2" id="app3" v-if="ada">
    <div ><h3 class="font font-weight-bold text-center text-uppercase" style="color:#fff">Keranjang</h3></div>
    <div class="container-fluid d-flex">
      <table class="table table-hover table-condensed">
        <thead>
          <tr class="text-center">
            <td style="width: 5%"></td>
            <td style="width: 40%"><h6 class="font-weight-bold">Tiket</h6></td>
            <td style="width: 25%"><h6 class="font-weight-bold">Harga</h6></td>
            <td style="width: 15%"><h6 class="font-weight-bold">No Kursi</h6></td>
            <td style="width: 10%"><h6 class="font-weight-bold"></h6></td>
            <td style="width: 5%"></td>
          </tr>
        </thead>
        <tbody v-model="id_tiket">
          <tr v-for="tik in tikets" :value="tik.id_tiket">
            <td></td>
            <td>
              <div class="col-sm-10">
                <h6 class="font-weight-bold">@{{tik.nama_type}} @{{tik.keterangan}}</h6>
                <h6>@{{ tik.nama_tempat_awal }} (<span class="font-weight-bold">@{{tik.wilayah_awal}}</span>) <i class="fas fa-arrow-right"></i></h6>
                <h6>@{{ tik.nama_tempat_akhir }} (<span class="font-weight-bold">@{{tik.wilayah_akhir}}</span>)</h6>
                <p>@{{tik.tanggal_berangkat}} @{{tik.waktu_berangkat}}</p>
              </div>
            </td>
            <td class="text-center ">@{{tik.harga}}</td>
            <td class="text-center ">@{{tik.no_kursi}}</td>
            <td class="text-center actions">
              <button style="border-radius:8px" class="btn btn-danger btn-sm" type="submit" v-on:click="del(tik.id_tiket)">
                <i class="fas fa-trash"></i>
              </button>
            </td>
            <td></td>
          </tr>
        </tbody>
        <tfoot>
          <tr v-for="i in totals" :value="i.id_tiket">
            <td></td>
            <td></td>
            <td class="text-center"><strong>Total : <span class="text-center font-weight-bold text-danger text-uppercase mb-1">Rp. @{{i.total}},-</span></strong></td>
            <td class="col-span-2">
              <button v-on:click="checkout(i.id_tiket)" style="border-radius:8px;width:180%" class="btn btn-success">Lanjutkan <i class="fas fa-angle-right"></i></button>
            </td>
            <td></td>
            <td></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </section>
@endsection

@push('js')
  <script type="text/javascript">
    var xhttp = new XMLHttpRequest();
    var token = "<?= session('token') ?>";

    var app = new Vue({
        el: '#app3',
        data: {
          ada:true,
          tidak:false,
          status:0,
          tikets:[],
          totals:[],
        },

        beforeMount : function(){
          this.getTiket();
        },
        methods : {
          checkout : function(){
            var url = "{{route('checkout')}}";
            var data_token = '?token='+token;
            var data = '&id_tiket='+this.id_tiket;

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 422) {
                  swal({
                    title: "Maaf!",
                    text: "Anda belum melengkapi Profil! Silahkan lengkapi dulu",
                    icon: "warning",
                        buttons: true,
                        dangerMode: true,
                  })
                  .then((ya) => {
                    if (ya) {
                      window.location.replace("{{route('profile')}}");
                    } else {
                      window.location.replace("{{route('pemesanan')}}");
                    }
                  });
                  
                }
                if (this.status == 200) {
                  window.location.replace("{{route('index_checkout')}}");
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          getTiket : function(){
            var url = "{{route('get_tiket')}}";
            var data_token = '?token='+token;
            var data = '';

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
                }
                if (this.status == 422) {
                  swal({
                    title: "Maaf!",
                    text: "Anda belum memesan tiket apapun, silahkan pesan dulu!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((ok) => {
                    if (ok) {
                      window.location.replace("{{route('flight')}}");
                    } else {
                      window.location.replace("{{route('dashboard_user')}}");
                    }
                  });
                }
                if (this.status == 200) {
                  app.tikets = JSON.parse(this.responseText);
                  app.getTotal();
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },

          getTotal : function(){
            var url = "{{route('get_total')}}";
            var data_token = '?token='+token;
            var data = '';

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
                }
                if (this.status == 200) {
                  app.totals = JSON.parse(this.responseText);
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          del : function(id_tiket){
          var url = "/anigatravel/tiket/";
          var data_token = "?token="+token;
          var data = id_tiket+"/"+data_token;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 200) {
                app.getTiket();
              }
            }
          }
          xhttp.open("DELETE", url+data , true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        },

        },
    });
  </script>
@endpush