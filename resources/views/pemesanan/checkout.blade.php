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
  <div class="slider-item" style="background-image: url('../../voyage/images/lombok1.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text align-items-center">
        <div class="col-md-7 col-sm-12 ftco-animate">
          <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Layar Awal</a></span> <span>Keranjang</span> <span>Pengecekan</span></p>
          <h1 class="mb-3">Pengecekan</h1>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('content1')
<div id="app3">
  <section style="background-color:#007bff;color:white" class="ftco-section-2" id="app3" v-if="Checkout">
    <div ><h3 class="font font-weight-bold text-center text-uppercase" style="color:#fff">Pengecekan</h3></div>
    <div class="container-fluid d-flex">
      <table style="width:100%" v-for="i in details" class="table table-borderless">
        <tr>
          <td></td>
          <td style="width:25%"><h6 class="text-center font-weight-bold">Nama Lengkap</h4></td>
          <td style="width:25%"><h6 class="text-center font-weight-bold">No Telepon</h4></td>
          <td style="width:25%"><h6 class="text-center font-weight-bold">No KTP</h4></td>
          <td style="width:25%"><h6 class="text-center font-weight-bold">Email</h6></td>
        <td></td>
        </tr>
        <tr>
          <td></td>
          <td style="width:25%"><div class="text-center" style="width:100%;border-radius:10px;background-color:rgba(255,255,255,0.5)">@{{i.nama_penumpang}}</div></td>
          <td style="width:25%"><div class="text-center" style="width:100%;border-radius:10px;background-color:rgba(255,255,255,0.5)">@{{i.telepone}}</div></td>
          <td style="width:25%"><div class="text-center" style="width:100%;border-radius:10px;background-color:rgba(255,255,255,0.5)">@{{i.no_ktp}}</div></td>
          <td style="width:25%"><div class="text-center" style="width:100%;border-radius:10px;background-color:rgba(255,255,255,0.5)">@{{i.email}}</div></td>
        <td></td>
        </tr>
      </table>
      
    </div>
  </section>
  <section style="background-color:#007bff;color:white" class="ftco-section-2" id="app3" v-if="Checkout">
    <div class="container-fluid d-flex">
      <hr>
      <table style="width:100%" id="cart" class="table table-hover table-condensed">
        <thead>
          <tr class="text-center">
            <td></td>
            <td style="width: 50%"><h6 class="font-weight-bold">Tiket</h6></td>
            <td style="width: 25%"><h6 class="font-weight-bold">Harga</h6></td>
            <td style="width: 25%"><h6 class="font-weight-bold">No Kursi</h6></td>
            <td></td>
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
            <td></td>
          </tr>
        </tbody>
        <tfoot>
          <tr v-for="tik in totals" :value="tik.id_tiket">
            <td></td>
            <td>
              <a href="{{route('pemesanan')}}" style="width:50%;border-radius:10px;" class="btn btn-warning"><i class="fas fa-angle-left"></i> Kembali</a>
            </td>
            <td class="text-center"><strong>Total+Admin : <span class="text-center font-weight-bold text-warning text-uppercase mb-1">Rp. @{{tik.total}},-</span></strong></td>
            <td>
              <button style="width:100%;border-radius:10px;" v-on:click="pembayaran(tik.total)" class="btn btn-success">Pesan <i class="fas fa-angle-right"></i></button>
            </td>
            <td></td>
          </tr>
        </tfoot>
      </table>
      
    </div>
  </section>


  <section style="background-color:#007bff;color:white" class="ftco-section-2" id="app3" v-if="Bayar">
    <div ><h3 class="font font-weight-bold text-center text-uppercase" style="color:#fff">Pengecekan</h3></div>
    <div class="container-fluid d-flex">
      <table v-for="i in totals" class="table table-borderless">
        <tr>
          <td style="width:5%"></td>
          <td style="width:45%">
            <h6>Silahkan Bayar Pesanan Sebesar</h6>
            <input class="text-center" type="number" style="width:100%;border-radius:10px;background-color:rgba(255,255,255,0.5);color:white" readonly v-model="total">
          </td>
          <td style="width:45%">
            <h6>Ke No Rekening</h6>
            <div class="text-center" style="width:100%;border-radius:10px;height:33px;background-color:rgba(255,255,255,0.5);color:white">6782-01-01-98-72-53-9</div>
          </td>
          <td style="width:5%"></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2">
            <p class="font font-weight-bold"> Perhatian!! </p>
            <ul>
              <li>Harap transfer sesuai dengan nominal diatas untuk mempercepat proses</li>
              <li>Jika lebih dari nominal diatas, dana tidak akan dikembalikan!</li>
              <li>Jika kurang dari nominal diatas, pemesanan tidak akan diproses kecuali jika melakukan transfer ulang sisa pembayaran!</li>
              <li><span class="font font-weight-bold">Klik "OK" untuk Memesan!!</span></li>
            </ul>
          </td>
          <td></td>
        </tr>
        <tr>
          <td></td>
          <td>
            <button style="width:20%;border-radius:10px;" v-on:click="bayar" class="btn btn-success btn-block">OK</button>
          </td>
        </tr>
      </table>
    </div>
  </section>
  
</div>

@endsection
     
@push('js')
  <script type="text/javascript">
    var xhttp = new XMLHttpRequest();
    var token = "<?= session('token') ?>";


    var app = new Vue({
        el: '#app3',
        data: {
          Checkout:true,
          Bayar:false,
          status:0,
          tikets:[],
          totals:[],
          details:[],
        },

        beforeMount : function(){
          this.getTiket();
        },
        methods : {
          bayar : function(){
            var url = "{{route('bayar')}}";
            var data_token = '?token='+token;
            var data = '';

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
                }
                if (this.status == 200) {
                  swal({
                    title: "Berhasil!",
                    text: "Anda telah berhasil memesan, silahkan konfirmasi pembayaran!",
                    icon: "success",
                    button: "OK",
                  });
                  window.location.replace("{{route('dashboard_user')}}");
                }
              }
            }
            xhttp.open("POST", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          pembayaran : function(total){
            this.Checkout = false;
            this.Bayar = true;
            this.total = total;
          },
          
          getDetail : function(){
            var url = "{{route('get_tiket_detail')}}";
            var data_token = '?token='+token;
            var data = '';

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)
                if (this.status == 200) {
                  app.details = JSON.parse(this.responseText);
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          getTiket : function(){
            var url = "{{route('get_tiket_checkout')}}";
            var data_token = '?token='+token;
            var data = '';

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
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
            var url = "{{route('get_total_bayar')}}";
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
                  app.getDetail();
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
        },
    });
  </script>
@endpush