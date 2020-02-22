@extends('admin.admin')
@section('title','Pemesanan')
@section('content')

    <div id="app3" class="container-fluid">
      <div v-if="Checkout">
        <div v-for="i in details">
          <div class="row">
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="font-weight-bold">Nama Lengkap</h4>
                  <div class="form-control">@{{i.nama_penumpang}}</div>
                </div>
                <div class="col-sm-6">
                  <h6 class="font-weight-bold">No Telepon</h4>
                  <div class="form-control">@{{i.telepone}}</div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-6">
                  <h6 class="font-weight-bold">No KTP</h4>
                  <div class="form-control">@{{i.no_ktp}}</div>
                </div>
                <div class="col-sm-6">
                  <h6 class="font-weight-bold">Email</h6>
                  <div class="form-control">@{{i.email}}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <table id="cart" class="table table-hover table-condensed">
          <thead>
            <tr class="text-center">
              <td style="width: 50%"><h6 class="font-weight-bold">Ticket</h6></td>
              <td style="width: 25%"><h6 class="font-weight-bold">Harga</h6></td>
              <td style="width: 25%"><h6 class="font-weight-bold">No Kursi</h6></td>
            </tr>
          </thead>
          <tbody v-model="id_tiket">
            <tr v-for="tik in tikets" :value="tik.id_tiket">
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
            </tr>
          </tbody>
          <tfoot>
            <tr v-for="tik in totals" :value="tik.id_tiket">
              <td>
                <a href="{{route('pemesanan')}}" class="btn btn-warning"><i class="fas fa-angle-left"></i> Kembali</a>
              </td>
              <td class="text-center"><strong>Total+Admin : <span class="text-center font-weight-bold text-primary text-uppercase mb-1">Rp. @{{tik.total}},-</span></strong></td>
              <td>
                <button style="width:100%" v-on:click="pembayaran(tik.total)" class="btn btn-success">Pesan <i class="fas fa-angle-right"></i></button>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>

      <div v-if="Bayar" v-for="i in totals" class="row">
        <div class="col-sm-6">
          <h6>Silahkan Bayar Pesanan Sebesar</h6>
          <input type="number" class="form-control" readonly v-model="total">
        </div>
        <div class="col-sm-6">
          <h6>Ke No Rekening</h6>
          <input class="form-control" type="number" readonly placeholder="6782-01-01-98-72-53-9">
        </div>
        <div class="col-sm-12">
          <p class="text-danger">Perhatian!!</p>
          <ul>
            <li>Harap transfer sesuai dengan nominal diatas untuk mempercepat proses</li>
            <li>Jika lebih dari nominal diatas, dana tidak akan dikembalikan!</li>
            <li>Jika kurang dari nominal diatas, pemesanan tidak akan diproses kecuali jika melakukan transfer ulang sisa pembayaran!</li>
            <li><span class="text-danger">Klik "OK" untuk Memesan!!</span></li>
          </ul>
        </div>
        <div class="col-sm-2">
          <button v-on:click="bayar" class="btn btn-success btn-block">OK</button>
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