@extends('admin.admin')
@section('title','User')
@section('content')
<div class="container-fluid" id="app3">
  <div class="row">
    <div class="card shadow h-100 py-2 col-sm-12">
      <div class="card-body">
        <div class="row">
          <div class="col-sm-2">
            <div class="row">
              <div class="col-sm-12">
                <button class="tombol" style="outline: none;" v-on:click="riw">
                  <div class="card border-left-warning shadow h-100 py-2">
                    Riwayat
                  </div>
                </button>
              </div>
              <div class="col-sm-12">
                <button class="tombol" style="outline: none;" v-on:click="pes">
                  <div class="card border-left-warning shadow h-100 py-2">
                    Pesawat
                  </div>
                </button>
              </div>
              <div class="col-sm-12">
                <button class="tombol" style="outline: none;" v-on:click="ker">
                  <div class="card border-left-warning shadow h-100 py-2">
                    Kereta
                  </div>
                </button>
              </div>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="row">
              <div class="col-sm-12">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div>
                    @yield('pemesanan')
                  </div>
                  <div v-if="riwayat">
                    <div class="card-body">
                      <h3 class="text-center">Riwayat Pemesanan</h3>
                      @yield('riwayat')
                    </div>
                  </div>
                  <div v-if="pesawat">
                    <div class="card-body">
                      <h3 class="text-center">Tiket Pesawat</h3>
                      <form class="user" method="post" v-on:submit.prevent="form_rute_p" v-if="Rute">
                        <div class="row">
                          <div class="col-sm-6">
                            <label for="">Berangkat</label>
                            <div class="input-container">
                              <i class="fas fa-plane-departure icon"></i>
                              <select id="rute_awal" v-model="rute_awal" class="form-control selectpicker" data-style="btn-info">
                                <option v-for="rute in rute_p" :value="rute.rute_awal">@{{ rute.wilayah_awal }} (@{{rute.nama_tempat_awal}})</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <label for="">Tujuan</label>
                            <div class="input-container">
                              <i class="fas fa-plane-arrival icon"></i>
                              <select id="rute_akhir" v-model="rute_akhir" class="form-control">
                                <option v-for="rute in rute_p" :value="rute.rute_akhir">@{{ rute.wilayah_akhir }} (@{{rute.nama_tempat_akhir}})</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        
                        <label for="">Tanggal Penerbangan</label>
                        <div class="form-group input-container">
                          <i class="fas fa-calendar-alt icon"></i>
                          <input class="form-control" type="date" v-model="tanggal_berangkat">
                        </div>
                        
                
                        <button type="submit" class="btn btn-primary btn-user btn-block ">
                          <i class="fas fa-plus"></i>
                        </button>
                      </form>
                
                      <div v-if="Jadwal" class="table table-responsive table-hover table-condensed">
                        <table style="width:100%" v-model="id_jadwal">
                          <tr v-for="i in jadwal_p" :value="i.id_jadwal">
                            <td>@{{i.tipe}} : @{{i.ket}} -> 
                            @{{i.waktu_berangkat}} @{{i.tanggal_berangkat}} Sampai @{{i.waktu_sampai}} @{{i.tanggal_sampai}}  
                            Harga @{{i.harga}}</td>
                            <td>
                              <button class="btn btn-primary" type="submit" v-on:click="form_jadwal_p(i.id_jadwal,i.tipe,i.ket,i.waktu_berangkat,i.tanggal_berangkat,i.waktu_sampai,i.tanggal_sampai,i.harga)" >
                                <i class="fas fa-check"></i>
                              </button>
                            </td>
                          </tr>
                        </table>
                      </div>
                
                      <div v-if="Detail" class="table table-responsive">
                        <table style="width:100%" v-model="id_tiket">
                          <thead v-for="i in detail_p" :value="i.id_tiket">
                            <tr>
                              <td><h4>@{{i.tipe}} (@{{i.ket}})</h4></td>
                            </tr>
                          </thead>
                          <tbody v-for="i in detail_p" :value="i.id_tiket">
                            <tr>
                              <td style="width:45%">
                                <div>
                                  <h4>@{{i.nama_tempat_awal}} (@{{ i.wilayah_awal }})</h4>
                                  <p>@{{i.waktu_berangkat}}</p>
                                </div>
                              </td>
                              <td style="width:10%;text-align:center">
                                <i class="fas fa-angle-right"></i>
                              </td>
                              <td style="width:45%">
                                <div>
                                  <h4>@{{i.nama_tempat_akhir}} (@{{ i.wilayah_akhir }})</h4>
                                  <p>@{{i.waktu_sampai}}</p>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                          <tfoot v-for="i in detail_p" :value="i.id_tiket">
                            <tr>
                              <td style="width: 20%">Harga : @{{i.harga}}</td>
                              <td></td>
                              <td style="width: 20%">
                                <label for="no_kursi">No Kursi</label> <br>
                                <input type="number" v-model="no_kursi" min="1">
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <button class="btn btn-primary" type="submit" v-on:click="form_detail(i.id_jadwal,no_kursi)" >
                                  Check Out <i class="fas fa-check"></i>
                                </button>
                            </td>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div v-if="kereta">
                    <div class="card-body">
                      <h3 class="text-center">Tiket Kereta</h3>
                      <form class="user" method="post" v-on:submit.prevent="form_rute_t" v-if="Rute">
                        <div class="row">
                          <div class="col-sm-6">
                            <label for="">Berangkat</label>
                            <div class="input-container">
                              <i class="fas fa-plane-departure icon"></i>
                              <select id="rute_awal" v-model="rute_awal" class="form-control selectpicker" data-style="btn-info">
                                <option v-for="rute in rute_t" :value="rute.rute_awal">@{{ rute.wilayah_awal }} (@{{rute.nama_tempat_awal}})</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <label for="">Tujuan</label>
                            <div class="input-container">
                              <i class="fas fa-plane-arrival icon"></i>
                              <select id="rute_akhir" v-model="rute_akhir" class="form-control">
                                <option v-for="rute in rute_t" :value="rute.rute_akhir">@{{ rute.wilayah_akhir }} (@{{rute.nama_tempat_akhir}})</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        
                        <label for="">Tanggal Pemberangkatan</label>
                        <div class="form-group input-container">
                          <i class="fas fa-calendar-alt icon"></i>
                          <input type="date" class="form-control" v-model="tanggal_berangkat">
                        </div>
                
                        <button type="submit" class="btn btn-primary btn-user btn-block ">
                          <i class="fas fa-plus"></i>
                        </button>
                      </form>
                
                      <div v-if="Jadwal" class="table table-responsive table-hover table-condensed">
                        <table style="width:100%" v-model="id_jadwal">
                          <tr v-for="i in jadwal_t" :value="i.id_jadwal">
                            <td>@{{i.tipe}} : @{{i.ket}} -> 
                            @{{i.waktu_berangkat}} @{{i.tanggal_berangkat}} Sampai @{{i.waktu_sampai}} @{{i.tanggal_sampai}}  
                            Harga @{{i.harga}}</td>
                            <td>
                              <button class="btn btn-primary" type="submit" v-on:click="form_jadwal_t(i.id_jadwal,i.tipe,i.ket,i.waktu_berangkat,i.tanggal_berangkat,i.waktu_sampai,i.tanggal_sampai,i.harga)" >
                                <i class="fas fa-check"></i>
                              </button>
                            </td>
                          </tr>
                        </table>
                      </div>
                
                      <div v-if="Detail" class="table table-responsive">
                        <table style="width:100%" v-model="id_tiket">
                          <thead v-for="i in detail_t" :value="i.id_tiket">
                            <tr>
                              <td><h4>@{{i.tipe}} (@{{i.ket}})</h4></td>
                            </tr>
                          </thead>
                          <tbody v-for="i in detail_t" :value="i.id_tiket">
                            <tr>
                              <td style="width:45%">
                                <div>
                                  <h4>@{{i.nama_tempat_awal}} (@{{ i.wilayah_awal }})</h4>
                                  <p>@{{i.waktu_berangkat}}</p>
                                </div>
                              </td>
                              <td style="width:10%;text-align:center">
                                <i class="fas fa-angle-right"></i>
                              </td>
                              <td style="width:45%">
                                <div>
                                  <h4>@{{i.nama_tempat_akhir}} (@{{ i.wilayah_akhir }})</h4>
                                  <p>@{{i.waktu_sampai}}</p>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                          <tfoot v-for="i in detail_t" :value="i.id_tiket">
                            <tr>
                              <td style="width: 20%">Harga : @{{i.harga}}</td>
                              <td style="width: 20%">
                                <label for="no_kursi">No Kursi</label> <br>
                                <input type="number" v-model="no_kursi" min="1">
                              </td>
                            </tr>
                            <tr>
                              <td>
                                <button class="btn btn-primary" type="submit" v-on:click="form_detail(i.id_jadwal,no_kursi)" >
                                  Check Out <i class="fas fa-check"></i>
                                </button>
                            </td>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
  <script type="text/javascript">
    var xhttp = new XMLHttpRequest();
    var token = "<?= session('token') ?>";

    var app = new Vue({
        el: '#app3',
        data: {
          id_rute:0,
          Rute:true,
          Jadwal:false,
          Detail:false,
          pesawat:false,
          kereta:false,
          riwayat:true,
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
          riw : function(){
            this.pesawat = false;
            this.kereta = false;
            this.riwayat = true;
            window.location.replace("{{route('dashboard_user')}}");
          },
          pes : function(){
            this.pesawat = true;
            this.kereta = false;
            this.riwayat = false;
          },
          ker : function(){
            this.pesawat = false;
            this.kereta = true;
            this.riwayat = false;
          },  
          form_detail : function(id_jadwal,no_kursi){
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
                          swal("Silahkan pesan lagi!");
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
                        text: "Jadwal Penerbangan tidak ada!",
                        icon: "error",
                        button: "OK",
                      });
                    }

                    if (this.status == 200) {
                      app.jadwal_t = JSON.parse(this.responseText);
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
                      app.detail_t = JSON.parse(this.responseText);
                      app.detail();
                      this.Detail = true;
                    }
                  }
              }
              xhttp.open("POST", url+data_token+data, true);
              xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
              xhttp.send();

          },
          rute : function(){
            this.Rute = true;
            this.Jadwal = false;
            this.Detail = false
          },
          jadwal : function(){
            this.Rute = false;
            this.Jadwal = true;
            this.Detail = false
          },
          detail : function(){
            this.Rute = false;
            this.Jadwal = false;
            this.Detail = true;
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
        },
    });
  </script>
@endpush