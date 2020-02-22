@extends('admin.admin')
@section('title','Transaksi Perlu Diproses')
@section('content')

    <div id="app3" class="container-fluid">
      <div v-if="Konfirmasi">
        <h6 class="font font-weight-bold text-center text-info text-uppercase">Menunggu Konfirmasi Admin</h6>
        <table class="table table-hover table-condensed">
          <thead>
            <tr class="font-weight-bold">
              <td >Username</td>
              <td>Kode Pemesanan</td>
              <td>Total</td>
              <td>Status</td>
              <td>Dipesan Pada</td>
              <td></td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="tik in pems">
              <td>@{{tik.username}}</td>
              <td>@{{tik.kode_pemesanan }}</td>
              <td>@{{tik.total}}</td>
              <td>@{{tik.status}}</td>
              <td>@{{tik.created_at}}</td>
              <td>
                <button class="btn btn-success btn-block" type="submit" v-on:click="lihat(tik.kode_pemesanan)" >
                  Lihat
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-if="Lihat" class="card">
        <div class="form-group card-body" v-for="i in confirms" >
          <img :src="'/storage/images/'+i.nama_foto" alt="" width="100%^">
          <div class="card-body">
            <h6 class="font font-weight-bold text-danger">Total Transfer</h6>
            <div class="form-control" v-for="i in totals">
              @{{ i.total }}
            </div>
          </div>
          <div class="card-body">
            <button class="btn btn-info" v-on:click="daftar">Back</button>
            <button class="btn btn-success" v-on:click="konfir(i.kode_pemesanan)">Konfirmasi</button>
            <button class="btn btn-danger" v-if="btn_btl" v-on:click="batalkan">Batalkan</button>
          </div>
          <div class="card-body" v-if="dibatalkan">
            <form action="" v-on:submit.prevent="batal(i.kode_pemesanan)">
              <textarea class="form-control" v-model="ket_batal" id="" required cols="30" rows="5" placeholder="Alasan Pembatalan"></textarea>
              <div class="form-group"></div>
              <button class="btn btn-danger" type="submit">Batalkan</button>
            </form>
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
          Konfirmasi:true,
          Lihat:false,
          dibatalkan:false,
          btn_btl:false,
          status:0,
          pems:[],
          confirms:[],
          totals:[],
        },

        beforeMount : function(){
          this.get_pemesanan();
        },
        methods : {
          
          get_pemesanan : function(){
            var url = "{{route('konfirmasi_admin')}}";
            var data_token = '?token='+token;
            var data = '';

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
                }
                if (this.status == 200) {
                  app.pems = JSON.parse(this.responseText);
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          batalkan : function(){
            this.dibatalkan = true;
            this.btn_btl = false;
          },
          look : function(){
            this.Konfirmasi=false;
            this.Lihat = true;
            this.dibatalkan = false;
            this.btn_btl = true;
          },
          daftar : function(){
            this.Konfirmasi = true;
            this.Lihat=false;
            this.dibatalkan = false;
            this.btn_btl = false;
          },
          lihat : function(kode_pemesanan){
            var url = "{{route('lihat')}}";
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
                  app.look();
                  app.getTotal(kode_pemesanan);
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          getTotal : function(kode_pemesanan){
            var url = "{{route('total_konfirmasi_admin')}}";
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
          konfir : function(kode_pemesanan){
            var url = "{{route('konfirmasi_pemesanan_admin')}}";
            var data_token = '?token='+token;
            var data = '&kode_pemesanan='+kode_pemesanan;

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
                }
                if (this.status == 200) {
                  alert('berhasil dkonfirmasi')
                }
              }
            }
            xhttp.open("POST", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          batal : function(kode_pemesanan){
            var url = "{{route('konfirmasi_pemesanan_batal')}}";
            var data_token = '?token='+token;
            var data = '&kode_pemesanan='+kode_pemesanan+'&ket_batal='+this.ket_batal;

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
                }
                if (this.status == 200) {
                  swal({
                    title: "Berhasil!",
                    text: "Pesanan berhasil dibatalkan!",
                    icon: "success",
                    button: "OK",
                  });
                  window.location.replace("{{ route('dashboard_admin') }}");
                }
              }
            }
            xhttp.open("POST", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },

        },
    });
  </script>
@endpush