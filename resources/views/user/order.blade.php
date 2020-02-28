@extends('user.user')
@section('header')
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            @if(session('level')=='user')
            <a class="navbar-brand" href="index.html">ANIGATRAVEL</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="oi oi-menu"></span> Menu
            </button>
            @endif

            <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
              @if(session('level')=='user')
                <li class="nav-item active"><a href="{{ route('cc') }}" class="nav-link">Layar Awal</a></li>
                <li class="nav-item"><a href="{{route('pemesanan')}}" class="nav-link">Keranjang</a></li>
                <li class="nav-item"><a href="{{route('dashboard_user')}}" class="nav-link">Pemesanan Saya</a></li>
                <li class="nav-item"><a href="{{route('manual')}}" class="nav-link">Manual</a></li>
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
              @if(session('level')==null)
              <li class="nav-item"><a href="{{route('login')}}" class="nav-link">Login</a></li>
              <li class="nav-item"><a href="{{route('user_register')}}" class="nav-link">Daftar</a></li>
              @endif
            </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image: url('../voyage/images/komodo2.jpg');">
            <div class="overlay"></div>
            <div class="container">
              <div class="row slider-text align-items-center">
                  <div class="col-md-7 col-sm-12 ftco-animate">
                    <div style="background-color:rgba(0,0,0,0.5);border-radius:10px;padding:20px">
                      <h1 class="mb-3">Selamat datang di ANIGATRAVEL</h1>
                    </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="slider-item" style="background-image: url('../voyage/images/lombok2.jpg');">
          <div class="overlay"></div>
          <div class="container">
          <div class="row slider-text align-items-center">
              <div class="col-md-7 col-sm-12 ftco-animate">
                <div style="background-color:rgba(0,0,0,0.5);border-radius:10px;padding:20px">
                  <h1 class="mb-3">Buat perjalananmu menyenangkan</h1>
                </div>
              </div>
          </div>
          </div>
      </div>

      <div class="slider-item" style="background-image: url('../voyage/images/bali.jpg');">
          <div class="overlay"></div>
          <div class="container">
          <div class="row slider-text align-items-center">
              <div class="col-md-7 col-sm-12 ftco-animate">
                <div style="background-color:rgba(0,0,0,0.5);border-radius:10px;padding:20px">
                  <h1 class="mb-3">Gabung bersama kami</h1>
                </div>
              </div>
          </div>
          </div>
      </div>
    </section>

@endsection
@section('content1')
<div id="apporder">
    <div class="ftco-section-search" v-if="Rute" >
        <div class="container">
            <div class="row">
                <div class="col-md-12 tabulation-search">
                    <div class="element-animate">
                        <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link p-3 active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><span>Tiket</span> Pesawat</a>
                            <a class="nav-link p-3" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><span>Tiket</span> Kereta</a>
                        </div>
                    </div>
                
                <div class="tab-content py-5" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <div class="block-17">
                            <form action="" method="post" v-on:submit.prevent="form_rute_p" class="d-block d-lg-flex row">
                                <div class="fields d-block d-lg-flex">
                                    <div class="col-lg-4">
                                        <label for="" class="text-white">Bandara Pemberangkatan</label>
                                            <div class="select-wrap">
                                            <select  id="rute_awal" v-model="rute_awal" class="form-control selectpicker" data-style="btn-info">
                                                <option style="background-color:#007bff" v-for="rute in rute_p" :value="rute.id_tempat">@{{ rute.wilayah }} (@{{rute.nama_tempat}})</option>
                                            </select>
                                            <span class="icon text-white"><i class="fas fa-plane-departure"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="" class="text-white">Bandara Tujuan</label>
                                        <div class="select-wrap">
                                            <select id="rute_akhir" v-model="rute_akhir" class="form-control">
                                                <option style="background-color:#007bff" v-for="rute in rute_p" :value="rute.id_tempat">@{{ rute.wilayah }} (@{{rute.nama_tempat}})</option>
                                            </select>
                                            <span class="icon text-white"><i class="fas fa-plane-arrival"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="" class="text-white">Tanggal Pemberangkatan</label>
                                        <div class="select-wrap">
                                            <div class="check-in" id="start-date">
                                                <input type="date" v-model="tanggal_berangkat" class="form-control" placeholder="Start date">
                                                <span class="icon text-white"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="search-submit btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <div class="block-17">
                            <form action="" method="post" v-on:submit.prevent="form_rute_t" class="d-block d-lg-flex row">
                                <div class="fields d-block d-lg-flex">
                                    <div class="col-lg-4">
                                        <label for="" class="text-white">Statsiun Pemberangkatan</label>
                                            <div class="select-wrap">
                                            <select  id="rute_awal" v-model="rute_awal" class="form-control selectpicker" data-style="btn-info">
                                                <option style="background-color:#007bff" v-for="rute in rute_t" :value="rute.id_tempat">@{{ rute.wilayah }} (@{{rute.nama_tempat}})</option>
                                            </select>
                                            <span class="icon text-white"><i class="fas fa-subway"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="" class="text-white">Sttasiun Tujuan</label>
                                        <div class="select-wrap">
                                            <select id="rute_akhir" v-model="rute_akhir" class="form-control">
                                                <option style="background-color:#007bff" v-for="rute in rute_t" :value="rute.id_tempat">@{{ rute.wilayah }} (@{{rute.nama_tempat}})</option>
                                            </select>
                                            <span class="icon text-white"><i class="fas fa-plane-arrival"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label for="" class="text-white">Tanggal Pemberangkatan</label>
                                        <div class="select-wrap">
                                            <div class="check-in" id="start-date">
                                                <input type="date" v-model="tanggal_berangkat" class="form-control" placeholder="Start date">
                                                <span class="icon text-white"><i class="fas fa-calendar-alt"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="search-submit btn btn-primary"><i class="fas fa-search"></i> Cari</button>
                            </form>
                        </div>
                      </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    
    <section style="background-color:#007bff" class="ftco-section-2" v-if="Jadwal">
        <div ><h3 class="font font-weight-bold text-center text-uppercase" style="color:#fff">pilih tiket</h3></div>
        <div class="container-fluid d-flex">
            <table v-model="id_jadwal" class="table table-borderless">
                <tr v-for="i in jadwal_p" :value="i.id_jadwal">
                    <td>
                        <table style="width:100%;border-radius:10px;" class="table-light">
                            <tr class="text-center">
                                <td class="font-weight-bold" style="width:20%">@{{i.tipe}}</td>
                                <td class="font-weight-bold" style="width:20%">@{{i.waktu_berangkat}}</td>
                                <td  style="width:20%"><i class="fas fa-plane"></i></td>
                                <td class="font-weight-bold" style="width:20%">@{{i.waktu_sampai}}</td>
                                <td class="font-weight-bold text-warning mb-1" style="width:20%">Rp. @{{i.harga}},-</td></td>
                            </tr>
                            <tr class="text-center">
                                <td style="width:20%">@{{i.ket}} <span class="font-weight-bold">@{{i.kode}}</span></td>
                                <td style="width:20%">@{{i.tanggal_berangkat}}</td>
                                <td style="width:20%"><i class="fas fa-arrow-right"></i></td>
                                <td style="width:20%">@{{i.tanggal_sampai}} </td>
                                <td style="width:20%">
                                <button style="border-radius:20px;" class="btn btn-primary btn-block" type="submit" v-on:click="form_jadwal_p(i.id_jadwal,i.tipe,i.ket,i.waktu_berangkat,i.tanggal_berangkat,i.waktu_sampai,i.tanggal_sampai,i.harga)" >Pilih</button>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </section>

    <section style="background-color:#007bff;color:white" class="ftco-section-2" v-if="Detail">
        <div ><h3 class="font font-weight-bold text-center text-uppercase" style="color:#fff">Pilih No Kursi</h3></div>
        <div class="container-fluid d-flex">
            <table class="text-center" style="width:100%" v-model="id_tiket" v-for="i in detail_p">
                <thead :value="i.id_tiket">
                  <tr>
                    <td colspan="3"><h6 class="font-weight-bold">@{{i.tipe}} (@{{i.ket}})</h6></td>
                  </tr>
                </thead>
                <tbody :value="i.id_tiket">
                  <tr>
                    <td style="width:45%">
                      <div>
                        <h6 class="font-weight-bold">@{{i.nama_tempat_awal}} (@{{ i.wilayah_awal }})</h6>
                        <p>@{{i.waktu_berangkat}}</p>
                      </div>
                    </td>
                    <td style="width:10%">
                      <i class="fas fa-plane"></i>
                    </td>
                    <td style="width:45%">
                      <div>
                        <h6 class="font-weight-bold">@{{i.nama_tempat_akhir}} (@{{ i.wilayah_akhir }})</h6>
                        <p>@{{i.waktu_sampai}}</p>
                      </div>
                    </td>
                  </tr>
                </tbody>
                <tfoot :value="i.id_tiket">
                  <tr>
                    <td style="width: 20%">Harga : <span class="font-weight-bold text-warning mb-1">Rp. @{{i.harga}},-</span></td>
                    <td style="width:10%">
                      <i class="fas fa-arrow-right"></i>
                    </td>
                    <td style="width: 20%">
                      <label for="no_kursi">No Kursi</label> <br>
                      <input required type="number" class="form-control" style="border-radius:20px;" v-model="no_kursi" min="1">
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td>
                      <button style="border-radius:20px;border-color:white" class="btn btn-primary" type="submit" v-on:click="form_detail_p(i.id_jadwal,no_kursi)" >
                        Pesan <i class="fas fa-check"></i>
                      </button>
                    </td>
                  </tr>
                </tfoot>
              </table>
        </div>
    </section>
</div>
@include('user.about')
@endsection

@push('js')
  <script type="text/javascript">
    var xhttp = new XMLHttpRequest();
    var token = "<?= session('token') ?>";

    var app = new Vue({
        el: '#apporder',
        data: {
          id_rute:0,
          Rute:true,
          Jadwal:false,
          Detail:false,
          status:0,
          rute_p:[],
          detail_p:[],
          jadwal_p:[],
          rute_t:[],
          detail_t:[],
          jadwal_t:[],
        },

        beforeMount : function(){
          this.getRute_p();
        },
        methods : {
          form_detail_p : function(id_jadwal,no_kursi){
            var url     = "{{ route('tiket_create') }}";
            var data_token ='?token='+token;
            var data    = 
                          "&id_jadwal="+id_jadwal+
                          "&no_kursi="+no_kursi
                          ;

            xhttp.onreadystatechange = function() {
                  if (this.readyState == 4) {
                    console.log(this.status,this.responseText)

                    if (this.status == 401) {
                      alert('Unauthorized User')
                    }

                    if (this.status == 432) {
                      swal({
                        title: "Opps!",
                        text: "Tiket sudah dipesan!",
                        icon: "warning",
                        button: "OK",
                      });
                    }

                    if (this.status == 200) {
                      
                      swal({
                        title: "Berhasil dimasukan ke keranjang",
                        text: "Mau pesan lagi?",
                        icon: "success",
                        buttons: true,
                        dangerMode: true,
                      })
                      .then((ya) => {
                        if (ya) {
                          swal("Baik!!","Silahkan Pilih No Kursi Lagi",'success');
                        } else {
                          window.location.replace("{{route('pemesanan')}}");
                        }
                      });
                    }
                  }
              }
              xhttp.open("POST", url+data_token+data, true);
              xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
              xhttp.send();

          },
          form_rute_p : function(){
            var url     = "{{ route('rute_flight') }}";
            var data_token ='?token='+token;
            var data    = "&rute_awal="+this.rute_awal+"&rute_akhir="+this.rute_akhir+"&tanggal_berangkat="+this.tanggal_berangkat;

            xhttp.onreadystatechange = function() {
                  if (this.readyState == 4) {
                    console.log(this.status,this.responseText)

                    if (this.status == 401) {
                      alert('Unauthorized User')
                    }

                    if (this.status == 422) {
                      swal({
                        title: "Maaf!",
                        text: "Jadwal Penerbangan tidak ada!",
                        icon: "error",
                        button: "OK",
                      });
                    }

                    if (this.status == 200) {
                      app.jadwal_p = JSON.parse(this.responseText);
                      app.jadwal();
                      swal({
                        title: "Ada!",
                        text: "Jadwal Penerbangan siap ditampilkan!",
                        icon: "success",
                        button: "OK",
                      });
                    }
                  }
              }
              xhttp.open("POST", url+data_token+data, true);
              xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
              xhttp.send();

          },
          form_jadwal_p : function(id_jadwal){
            var url     = "{{ route('detail_flight') }}";
            var data_token ='?token='+token;
            var data    = 
                          "&id_jadwal="+id_jadwal
                          ;

            xhttp.onreadystatechange = function() {
                  if (this.readyState == 4) {
                    console.log(this.status,this.responseText)

                    if (this.status == 401) {
                      alert('Unauthorized User')
                    }

                    if (this.status == 200) {
                      app.detail_p = JSON.parse(this.responseText);
                      app.detail();
                      this.Detail = true;
                    }
                  }
              }
              xhttp.open("POST", url+data_token+data, true);
              xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
              xhttp.send();

          },
          getRute_p : function(){
            var url = "{{route('data_flight')}}";
            var data_token = '?token='+token;
            var data = '';

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
                }
                if (this.status == 200) {
                  app.rute_p = JSON.parse(this.responseText);
                  app.getRute_t();
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          form_detail_t : function(id_jadwal,no_kursi){
            var url     = "{{ route('tiket_create') }}";
            var data_token ='?token='+token;
            var data    = 
                          "&id_jadwal="+id_jadwal+
                          "&no_kursi="+no_kursi
                          ;

            xhttp.onreadystatechange = function() {
                  if (this.readyState == 4) {
                    console.log(this.status,this.responseText)

                    if (this.status == 401) {
                      alert('Unauthorized User')
                    }

                    if (this.status == 432) {
                      swal({
                        title: "Opps!",
                        text: "Tiket sudah dipesan!",
                        icon: "warning",
                        button: "OK",
                      });
                    }

                    if (this.status == 200) {
                      
                      swal({
                        title: "Berhasil dimasukan ke keranjang",
                        text: "Mau pesan lagi?",
                        icon: "success",
                        buttons: true,
                        dangerMode: true,
                      })
                      .then((ya) => {
                        if (ya) {
                          swal("Baik!!","Silahkan Pilih No Kursi Lagi",'success');
                        } else {
                          window.location.replace("{{route('pemesanan')}}");
                        }
                      });
                    }
                  }
              }
              xhttp.open("POST", url+data_token+data, true);
              xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
              xhttp.send();

          },
          form_rute_t : function(){
            var url     = "{{ route('rute_train') }}";
            var data_token ='?token='+token;
            var data    = "&rute_awal="+this.rute_awal+"&rute_akhir="+this.rute_akhir+"&tanggal_berangkat="+this.tanggal_berangkat;

            xhttp.onreadystatechange = function() {
                  if (this.readyState == 4) {
                    console.log(this.status,this.responseText)

                    if (this.status == 401) {
                      alert('Unauthorized User')
                    }

                    if (this.status == 422) {
                      swal({
                        title: "Maaf!",
                        text: "Jadwal Pemberangkatan tidak ada!",
                        icon: "error",
                        button: "OK",
                      });
                    }

                    if (this.status == 200) {
                      app.jadwal_p = JSON.parse(this.responseText);
                      app.jadwal();
                      swal({
                        title: "Ada!",
                        text: "Jadwal Pemberangkatan siap ditampilkan!",
                        icon: "success",
                        button: "OK",
                      });
                    }
                  }
              }
              xhttp.open("POST", url+data_token+data, true);
              xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
              xhttp.send();

          },
          form_jadwal_t : function(id_jadwal){
            var url     = "{{ route('detail_train') }}";
            var data_token ='?token='+token;
            var data    = 
                          "&id_jadwal="+id_jadwal
                          ;

            xhttp.onreadystatechange = function() {
                  if (this.readyState == 4) {
                    console.log(this.status,this.responseText)

                    if (this.status == 401) {
                      alert('Unauthorized User')
                    }

                    if (this.status == 200) {
                      app.detail_p = JSON.parse(this.responseText);
                      app.detail();
                      this.Detail = true;
                    }
                  }
              }
              xhttp.open("POST", url+data_token+data, true);
              xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
              xhttp.send();

          },
          getRute_t : function(){
            var url = "{{route('data_train')}}";
            var data_token = '?token='+token;
            var data = '';

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
                }
                if (this.status == 200) {
                  app.rute_t = JSON.parse(this.responseText);
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          rute : function(){
            this.Rute = true;
            this.Jadwal = false;
            this.Detail = false
          },
          jadwal : function(){
            this.Rute = true;
            this.Jadwal = true;
            this.Detail = false
          },
          detail : function(){
            this.Rute = true;
            this.Jadwal = true;
            this.Detail = true;
          },
        },
    });
  </script>
@endpush