@extends('admin.admin')
@section('title','Pemesanan')
@section('content')

    <div id="app3" class="container-fluid">
      <div v-if="ada">
        <table v-if="ada" class="table table-hover table-condensed">
          <thead>
            <tr class="text-center">
              <td style="width: 50%"><h6 class="font-weight-bold">Ticket</h6></td>
              <td style="width: 25%"><h6 class="font-weight-bold">Harga</h6></td>
              <td style="width: 15%"><h6 class="font-weight-bold">No Kursi</h6></td>
              <td style="width: 10%"><h6 class="font-weight-bold"></h6></td>
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
              <td class="text-center actions">
                <button class="btn btn-danger btn-sm" type="submit" v-on:click="del(tik.id_tiket)">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr v-for="i in totals" :value="i.id_tiket">
              <td></td>
              <td><strong>Total : <span class="text-center font-weight-bold text-primary text-uppercase mb-1">Rp. @{{i.total}},-</span></strong></td>
              <td>
                <button style="width:200%" v-on:click="checkout(i.id_tiket)" class="btn btn-success">Lanjutkan <i class="fas fa-angle-right"></i></button>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>

      <div v-if="tidak">
        <p>silahkan pesan</p>
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
          ada:true,
          tidak:false,
          status:0,
          tikets:[],
          totals:[],
        },

        beforeMount : function(){
          this.getTiket();
        },
        methods : {
          checkout : function(){
            var url = "{{route('checkout')}}";
            var data_token = '?token='+token;
            var data = '&id_tiket='+this.id_tiket;

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 422) {
                  swal({
                    title: "Maaf!",
                    text: "Anda belum melengkapi Profil! Silahkan lengkapi dulu",
                    icon: "warning",
                        buttons: true,
                        dangerMode: true,
                  })
                  .then((ya) => {
                    if (ya) {
                      window.location.replace("{{route('profile')}}");
                    } else {
                      window.location.replace("{{route('pemesanan')}}");
                    }
                  });
                  
                }
                if (this.status == 200) {
                  window.location.replace("{{route('index_checkout')}}");
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          getTiket : function(){
            var url = "{{route('get_tiket')}}";
            var data_token = '?token='+token;
            var data = '';

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText)

                if (this.status == 401) {
                  alert('Unauthorized User')
                
                }
                if (this.status == 422) {
                  swal({
                    title: "Maaf!",
                    text: "Anda belum memesan tiket apapun, silahkan pesan dulu!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((ok) => {
                    if (ok) {
                      window.location.replace("{{route('flight')}}");
                    } else {
                      window.location.replace("{{route('dashboard_user')}}");
                    }
                  });
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
            var url = "{{route('get_total')}}";
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
                }
              }
            }
            xhttp.open("GET", url+data_token+data, true);
            xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
            xhttp.send();
          },
          del : function(id_tiket){
          var url = "/anigatravel/tiket/";
          var data_token = "?token="+token;
          var data = id_tiket+"/"+data_token;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 200) {
                app.getTiket();
              }
            }
          }
          xhttp.open("DELETE", url+data , true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        },

        },
    });
  </script>
@endpush