@extends('dashboard.user')
@section('pemesanan')

    <div id="app3" class="container-fluid">
      <h4 class="text-center font-weight-bold text-white text-uppercase mb-1">Sukses</h4>
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
                <button style="border-radius:20px;border-color:white" class="btn btn-primary btn-block" type="submit" v-on:click="upload(tik.kode_pemesanan)">
                  Lihat
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div v-if="Upload">
        <table id="cart" class="table table-condensed">
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
        <table style="width:100%" v-for="i in totals">
          <tr>
            <td style="width:49%">
              <h6>Silahkan Bayar Pesanan Sebesar</h6>
              <div class="text-center" style="width:100%;border-radius:10px;height:33px;background-color:rgba(255,255,255,0.5);color:white"> @{{i.total}} </div>
            </td>
            <td style="width:2%"></td>
            <td style="width:49%">
              <h6>Ke No Rekening</h6>
              <div class="text-center" style="width:100%;border-radius:10px;height:33px;background-color:rgba(255,255,255,0.5);color:white"> 6782-01-01-98-72-53-9 </div>
            </td>
          </tr>
          <tr>
            <td>
              <div class="form-group row">
                <div class="col-sm-3"><a style="border-radius:10px;border-color:lightblue" class="btn btn-primary btn-block" target="blank" href="{{route('export_pemesanan')}}"><i class="fa fa-print"></i> Cetak</a></div>
                <div class="col-sm-3"><button style="border-radius:10px;border-color:greenyellow" class="btn btn-primary btn-block" v-on:click="lihat">Lihat Foto</button></div>
                <div class="col-sm-3"><button style="border-radius:10px;border-color:red" class="btn btn-primary btn-block" v-on:click="konfirmasi">back</button></div>
              </div>
            </td>
          </tr>
        </table>
        <div class="form-group"></div>
        
      </div>

      <div v-if="Lihat">
        <div class="form-group text-center" v-for="i in confirms">
          <img :src="'/storage/images/'+i.nama_foto" width="70%" style="border-radius:20px;" alt="">
          <div class="form-group"></div>
          <button style="border-radius:10px;border-color:red" class="btn btn-primary" v-on:click="kembali(i.kode_pemesanan)">Kembali</button>
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
          print : function(kode_pemesanan){
            var url = "{{route('export_pemesanan')}}";
            var data_token = '?token='+token;
            var data = '&kode_pemesanan='+kode_pemesanan;

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
                }
                if (this.status == 200) {

                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          getTiket : function(){
            var url = "{{route('tiket_sukses')}}";
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
  </script>
@endpush