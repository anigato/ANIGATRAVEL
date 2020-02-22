@extends('admin.admin')
@section('title','Tiket Pesawat')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid" id="app3">
      <h6 class="text-center font-weight-bold text-primary text-uppercase mb-1">Tiket Pesawat</h6>
      <form class="user" method="post" v-on:submit.prevent="form_rute_p" v-if="Rute">
        <div class="row">
          <div class="col-sm-6">
            <label for="">Berangkat</label>
            <div class="input-container">
              <i class="fas fa-plane-departure icon"></i>
              <select id="rute_awal" v-model="rute_awal" class="form-control selectpicker" data-style="btn-info">
                <option v-for="rute in rute_p" :value="rute.id_tempat">@{{ rute.wilayah }} (@{{rute.nama_tempat}})</option>
              </select>
            </div>
          </div>
          <div class="col-sm-6">
            <label for="">Tujuan</label>
            <div class="input-container">
              <i class="fas fa-plane-arrival icon"></i>
              <select id="rute_akhir" v-model="rute_akhir" class="form-control">
                <option v-for="rute in rute_p" :value="rute.id_tempat">@{{ rute.wilayah }} (@{{rute.nama_tempat}})</option>
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
          <i class="fas fa-search"></i> Cari Penerbangan 
        </button>
      </form>
      
      <div v-if="Jadwal" class="table table-responsive table-borderless table-sm">
        <table style="width:100%" v-model="id_jadwal">
          <tr v-for="i in jadwal_p" :value="i.id_jadwal">
            <td>
              <table style="width:100%;" class="table-light">
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
                    <button style="width:100%" class="btn btn-primary btn-sm" type="submit" v-on:click="form_jadwal_p(i.id_jadwal,i.tipe,i.ket,i.waktu_berangkat,i.tanggal_berangkat,i.waktu_sampai,i.tanggal_sampai,i.harga)" >Pilih</button>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </div>

      <div v-if="Detail" class="table table-responsive card">
        <div class="card-body">
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
          status:0,
          rute_p:[],
          detail_p:[],
          jadwal_p:[],
        },

        beforeMount : function(){
          this.getRute_p();
        },
        methods : {
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