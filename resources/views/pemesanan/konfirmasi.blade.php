@extends('dashboard.user')
@section('title','Menunggu Pembayaran')
@section('pemesanan')
    <div id="app3" class="container-fluid">
      <h4 class="text-center font-weight-bold text-white text-uppercase mb-1">Menunggu Pembayaran</h4>
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
              <td class="actions text-right">
                <button style="border-radius:20px;border-color:white" class="btn btn-primary" type="submit" v-on:click="upload(tik.kode_pemesanan)">
                  Konfirmasi
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
        <table v-for="i in totals" class="table table-borderless">
          <tr>
            <td style="width:45%">
              <h6>Silahkan Bayar Pesanan Sebesar</h6>
              <div class="text-center" style="width:100%;;border:2px solid white;border-radius:10px;background-color:rgba(0, 81, 255,0.5)"> @{{i.total}} </div>
            </td>
            <td style="width:45%">
              <h6>Ke No Rekening Atas Nama "Khoerul Anam"</h6>
              <div class="text-center" style="width:100%;;border:2px solid white;border-radius:10px;background-color:rgba(0, 81, 255,0.5)"> 6782-01-01-98-72-53-9 </div>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <p class="font font-weight-bold"> Perhatian!! </p>
              <ul>
                <li>Harap transfer sesuai dengan nominal diatas untuk mempercepat proses</li>
                <li>Jika lebih dari nominal diatas, dana tidak akan dikembalikan!</li>
                <li>Jika kurang dari nominal diatas, pemesanan tidak akan diproses kecuali jika melakukan transfer ulang sisa pembayaran!</li>
                <li><h6 class="font-weight-bold text-white">Mohon Untuk Segera Upload Bukti Pembayaran!!</h6></li>
                <li><h6 class="font-weight-bold text-white">Harap Langsung Cek Bukti Pembayaran di Tab "Sedang Diproses" Untuk Menghindari Kesalahan!!</h6></li>
                <li><h6 class="font-weight-bold text-white">Kami Tidak Bertanggung Jawab Jika Ada Kesalahan Pada Bukti Transfer!!</h6></li>
              </ul>
            </td>
          </tr>
          <tr>
            <td>
              <form action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
                <div class="form-group" v-for="i in confirms" hidden>
                  <img :src="'/storage/images/245/'+i.nama_foto" alt="">
                </div>
                <div class="form-group">
                  <input class="btn-primary" type="file" name="image" v-model="image">
                </div>
                <div class="row">
                  <div class="col-lg-3"><button style="border-radius:10px;border-color:greenyellow" type="submit" class="btn btn-primary btn-block">Upload</button></div>
                  <div class="col-lg-3"><button style="border-radius:10px;border-color:red" v-on:click="konfirmasi" class="btn btn-primary btn-block">Kembali</button></div>
                </div>
              </form>
            </td>
          </tr>
        </table>
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
            var url = "{{route('tiket_menunggu_konfirmasi')}}";
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