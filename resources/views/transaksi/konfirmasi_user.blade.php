@extends('admin.admin')
@section('title','Transaksi Menunggu Pembayaran')
@section('content')

    <div id="app3" class="container-fluid">
      <h6 class="text-center font-weight-bold text-primary text-uppercase">Menunggu Pembayaran</h6>
      <table class="table table-hover table-condensed">
        <thead>
          <tr>
            <td class="font-weight-bold">Username</td>
            <td class="font-weight-bold">Kode Pemesanan</td>
            <td class="font-weight-bold">Total</td>
            <td class="font-weight-bold">Dipesan Pada</td>
            <td></td>
          </tr>
        </thead>
        <tbody>
          <tr v-for="tik in pems">
            <td>@{{tik.username}}</td>
            <td>@{{tik.kode_pemesanan }}</td>
            <td>@{{tik.total}}</td>
            <td>@{{tik.created_at}}</td>
          </tr>
        </tbody>
      </table>
    </div>

@endsection
     
@push('js')
  <script type="text/javascript">
    var xhttp = new XMLHttpRequest();
    var token = "<?= session('token') ?>";


    var app = new Vue({
        el: '#app3',
        data: {
          status:0,
          pems:[],
        },

        beforeMount : function(){
          this.get_pemesanan();
        },
        methods : {
          
          get_pemesanan : function(){
            var url = "{{route('konfirmasi_user')}}";
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

        },
    });
  </script>
@endpush