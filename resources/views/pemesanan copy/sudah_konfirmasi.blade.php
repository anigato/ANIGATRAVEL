@extends('dashboard.user')
@section('pemesanan')

    <div id="app3" class="container-fluid">
      <h6 class="text-center font-weight-bold text-info text-uppercase mb-1">Sedang Diproses</h6>
      <div v-if="Konfirmasi">
        <table id="cart" class="table table-hover table-condensed">
          <thead>
            <tr>
              <td><h6 class="font-weight-bold">Kode Pemesanan</h6></td>
              <td><h6 class="font-weight-bold">Status</h6></td>
              <td><h6 class="font-weight-bold">Waktu Pemesanan</h6></td>
              <td></td>
            </tr>
          </thead>
          <tbody v-model="id_tiket">
            <tr v-for="tik in tikets" :value="tik.id_tiket">
              <td>@{{tik.kode_pemesanan}}</td>
              <td>@{{ tik.status }}</td>
              <td>@{{tik.created_at}}</td>
              <td class="actions">
                <button class="btn btn-success btn-block" type="submit" v-on:click="upload(tik.kode_pemesanan)">
                  Periksa
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div v-if="Upload">
        <table id="cart" class="table table-hover table-condensed">
          <thead>
            <tr>
              <td class="text-center"><h6 class="font-weight-bold">Tiket</h6></td>
              <td class="text-center"><h6 class="font-weight-bold">No Kursi</h6></td>
              <td class="text-right"><h6 class="font-weight-bold">Harga</h6></td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tik in details">
              <td>
                <div class="col-sm-10">
                  <h6 class="font-weight-bold">@{{tik.nama_type}} @{{tik.keterangan}}</h6>
                  <h6>@{{ tik.nama_tempat_awal }} (<span class="font-weight-bold">@{{tik.wilayah_awal}}</span>) <i class="fas fa-angle-right"></i> @{{ tik.nama_tempat_akhir }} (<span class="font-weight-bold">@{{tik.wilayah_akhir}}</span>)</h6>
                  <p>@{{tik.tanggal_berangkat}} @{{tik.waktu_berangkat}}</p>
                </div>
              </td>
              <td class="text-center">@{{tik.no_kursi}}</td>
              <td class="text-right">@{{tik.harga}}</td>
            </tr>
          </tbody>
        </table>
        <div>
          <h6 class="font-weight-bold text-danger">Silahkan Cek Lagi! Langsung Ubah Bukti Pembayaran Jika Ada Kesalahan</h6>
          <div class="row" v-for="i in totals">
            <div class="col-sm-6">
              <h6>Total Pembayaran</h6>
              <div class="form-control">@{{i.total}}</div>
            </div>
            <div class="col-sm-6">
              <h6>No Rekening Tujuan</h6>
              <div class="form-control">6782-01-01-98-72-53-9</div>
            </div>
          </div>
        </div>
        <form action="{{route('update_foto')}}" method="POST" enctype="multipart/form-data">
          <div class="form-group"></div>
          <div class="form-group">
            <input type="file" name="image" v-model="image">
          </div>
          <div class="row">
            <div class="col-sm-2"><button type="submit" class="btn btn-success btn-block">Ubah Foto</button></div>
            <div class="col-sm-2"><button type="submit" class="btn btn-info btn-block" v-on:click="lihat">Lihat Foto</button></div>
            <div class="col-sm-2"><button v-on:click="konfirmasi" class="btn btn-danger btn-block">Kembali</button></div>
          </div>
        </form>
      </div>

      <div v-if="Lihat">
        <div class="form-group" v-for="i in confirms">
          <img :src="'/storage/images/'+i.nama_foto" alt="" width="100%">
          <div class="form-group"></div>
          <button class="btn btn-danger" v-on:click="kembali(i.kode_pemesanan)">Kembali</button>
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
          Konfirmasi:true,
          Upload:false,
          Lihat:false,
          status:0,
          tikets:[],
          totals:[],
          details:[],
          confirms:[],
        },

        beforeMount : function(){
          this.getTiket();
        },
        methods : {
          getTiket : function(){
            var url = "{{route('tiket_sudah_konfirmasi')}}";
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

          getTotal : function(kode_pemesanan){
            var url = "{{route('total_menunggu_konfirmasi')}}";
            var data_token = '?token='+token;
            var data = '&kode_pemesanan='+kode_pemesanan;

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
          
          getDetil : function(kode_pemesanan){
            var url = "{{route('get_detil')}}";
            var data_token = '?token='+token;
            var data = '&kode_pemesanan='+kode_pemesanan;

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
                }
                if (this.status == 200) {
                  app.details = JSON.parse(this.responseText);
                  app.getTotal(kode_pemesanan);
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },

          getUpload : function(kode_pemesanan){
            var url = "{{route('get_upload')}}";
            var data_token = '?token='+token;
            var data = '&kode_pemesanan='+kode_pemesanan;

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
                }
                if (this.status == 200) {
                  app.confirms = JSON.parse(this.responseText);
                  app.getDetil(kode_pemesanan);
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          kembali : function(kode_pemesanan){
            this.Konfirmasi = false;
            this.Upload = true;
            this.Lihat = false;
            this.kode_pemesanan = kode_pemesanan;
            app.getUpload(kode_pemesanan);
          },
          upload : function(kode_pemesanan){
            this.Konfirmasi = false;
            this.Upload = true;
            this.Lihat = false;
            this.kode_pemesanan = kode_pemesanan;
            app.getUpload(kode_pemesanan);
          },
          konfirmasi : function(){
            this.Konfirmasi = true;
            this.Upload = false;
            this.Lihat = false;
          },
          lihat : function(){
            this.Konfirmasi = false;
            this.Upload = false;
            this.Lihat = true;
          },
        },
    });

    function logout(){
      var url = "{{route('logot')}}";
      var data='?token='+token;

      xhttp.onreadystatechange = function() {
          if (this.readyState == 4) {
            console.log(this.status,this.responseText)

            if (this.status == 401) {
              alert('Unauthorisez User');
            }

            if (this.status == 200) {
              alert('Logout Sukses')
              window.location.replace("{{ route('login') }}");
            }
          }
        }

        xhttp.open("GET", url+data, true);
        xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
        xhttp.send();
    }

  </script>
@endpush