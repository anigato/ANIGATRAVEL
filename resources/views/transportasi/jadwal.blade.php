@extends('admin.admin')
@section('content')
    <!-- Begin Page Content -->
    <div id="app3" class="container-fluid">

      <!-- Page Heading -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" v-on:submit.prevent="find" method="get">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search Jadwal..." aria-label="Search" aria-describedby="basic-addon2" v-model="cari" @keyup="find">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>
      <hr>

      <form class="user" method="post" v-on:submit.prevent="create" v-if="baru">
        
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="time" class="form-control form-control-user" v-model="waktu_berangkat" placeholder="Waktu Berangkat">
          </div>
          <div class="col-sm-6">
            <input type="date" class="form-control form-control-user" v-model="tanggal_berangkat" placeholder="Tanggal Berangkat">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="time" class="form-control form-control-user" v-model="waktu_sampai" placeholder="Waktu Sampai">
          </div>
          <div class="col-sm-6">
            <input type="date" class="form-control form-control-user" v-model="tanggal_sampai" placeholder="Tanggal Sampai">
          </div>
        </div>

        <div class="form-group">
          <input type="number" class="form-control form-control-user" v-model="harga" placeholder="Harga">
        </div>

        <div class="form-group">
          <select v-model="id_rute" class="form-control form-control-user" searchable="Search here..">
            <option v-for="rute in rutes" :value="rute.id_rute">@{{rute.tujuan}} | @{{rute.rute_awal}} -> @{{rute.rute_akhir}}</option>
          </select>
        </div>
        <button class="btn btn-primary btn-user btn-block ">
          <i class="fas fa-plus"></i>
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal"><i class="fas fa-window-close"></i></button>
      </form>

      <form class="user" method="post" v-on:submit.prevent="update" v-if="ubah">
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="time" class="form-control form-control-user" v-model="waktu_berangkat" placeholder="Waktu Berangkat">
          </div>
          <div class="col-sm-6">
            <input type="date" class="form-control form-control-user" v-model="tanggal_berangkat" placeholder="Tanggal Berangkat">
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="time" class="form-control form-control-user" v-model="waktu_sampai" placeholder="Waktu Sampai">
          </div>
          <div class="col-sm-6">
            <input type="date" class="form-control form-control-user" v-model="tanggal_sampai" placeholder="Tanggal Sampai">
          </div>
        </div>

        <div class="form-group">
          <input type="number" class="form-control form-control-user" v-model="harga" placeholder="Harga">
        </div>

        <div class="form-group">
          <select v-model="id_rute" class="form-control form-control-user" searchable="Search here..">
            <option v-for="rute in rutes" :value="rute.id_rute">@{{rute.tujuan}} | @{{rute.rute_awal}} -> @{{rute.rute_akhir}}</option>
          </select>
        </div>

        <button class="btn btn-primary btn-user btn-block">
          <i class="fas fa-check"></i>
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal">
          <i class="fas fa-window-close"></i>
        </button>

        <hr>
        
      </form>


      <button class="btn btn-success btn-user btn-block" v-on:click="buat" v-if="buttonBaru">
        <i class="fas fa-plus"></i>
      </button>
      <hr>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Table Transportation</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Tujuan</th>
                  <th>Berangkat</th>
                  <th>Sampai</th>
                  <th>Harga</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Tujuan</th>
                  <th>Berangkat</th>
                  <th>Sampai</th>
                  <th>Harga</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="i in jadwalAll">
                    <td>@{{i.tujuan}}</td>
                    <td>@{{i.rute_awal}} on @{{i.waktu_berangkat}} @{{i.tanggal_berangkat}}</td>
                    <td>@{{i.rute_akhir}} on @{{i.waktu_sampai}} @{{i.tanggal_sampai}}</td>
                    <td>@{{i.harga}}</td>
                    <td>
                    <button class="btn btn-primary" type="submit"v-on:click="edit(i.id_jadwal,i.id_rute,i.waktu_berangkat,i.tanggal_berangkat,i.waktu_sampai,i.tanggal_sampai,i.harga,i.tujuan,i.rute_awal,i.rute_akhir)">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger" type="submit" v-on:click="del(i.id_jadwal)" >
                      <i class="fas fa-backspace"></i>
                    </button> 
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->
@endsection
     
@push('js')
  <script type="text/javascript">
    var xhttp = new XMLHttpRequest();
    var token = "<?= session('token') ?>";


    var app = new Vue({
        el: '#app3',
        data: {
          tujuan:'',
          rute_awal:'',
          ket:'',
          rute_akhir:'',
          rute:'',
          waktu_berangkat:'',
          tanggal_berangkat:'',
          waktu_sampai:'',
          tanggal_sampai:'',
          harga:'',
          id_rute:0,
          cari:'',
          baru:false,
          ubah:false,
          buttonBaru:true,
          status:0,
          jadwalAll:[],
          rute:'',
          rutes:[],
        },
        beforeMount : function(){
          this.getAll();
      },
        methods : {
          tt : function(){
            var url = "{{route('jadwal_rute')}}";

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 422) {
                alert('Not Found')
              }
              if (this.status == 200) {
                app.rutes = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET",url, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
          },
          find : function(){
            var url = "{{route('jadwal_search')}}";
          var data_token = '?token='+token;
          var data = '&cari='+this.cari;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 422) {
                alert('Not Found')
              }
              if (this.status == 200) {
                app.findone();
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
          },
          findone : function(){
          var url = "{{route('jadwal_search')}}";
          var data_token = '?token='+token;
          var data = '&cari='+this.cari;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 422) {
                alert('Invalid_rute Field')
              }
              if (this.status == 200) {
                app.jadwalAll = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }, 
        create : function(){
          var url     = "{{ route('jadwal_create') }}";
          var data_token ='?token='+token;
          var data    = 
             "&harga="+this.harga
            +"&waktu_berangkat="+this.waktu_berangkat
            +"&tanggal_berangkat="+this.tanggal_berangkat
            +"&waktu_sampai="+this.waktu_sampai
            +"&tanggal_sampai="+this.tanggal_sampai
            +"&id_rute="+this.id_rute;

          xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                  console.log(this.status,this.responseText)

                  if (this.status == 401) {
                    alert('Unauthorized User')
                  }

                  if (this.status == 422) {
                    alert('Invalid_rute field');
                  }

                  if (this.status == 200) {
                    app.batal();
                    app.getAll();
                    alert('Create rute success');
                  }
                }
            }
            xhttp.open("POST", url+data_token+data, true);
              xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
              xhttp.send();

        },
        checkError : function(key){
          return this.errors.hasOwnProperty(key);
        },

        getAll : function(){
          var url = "{{route('jadwal_all')}}";
          var data_token = '?token='+token;
          var data = '';

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 422) {
                alert('Invalid_rute Field')
              }
              if (this.status == 200) {
                app.jadwalAll = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }, 
        del : function(id_jadwal){
          var url = "/anigatravel/jadwal/";
          var data_token = "?token="+token;
          var data = id_jadwal+"/"+data_token;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 200) {
                app.getAll();
                alert('Delete Rute Success');
              }
            }
          }
          xhttp.open("DELETE", url+data , true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        },

        edit : function(id_jadwal,id_rute,waktu_berangkat,tanggal_berangkat,waktu_sampai,tanggal_sampai,harga){
          this.id_jadwal = id_jadwal;
          this.id_rute = id_rute;
          this.baru = false;
          this.ubah = true;
          this.buttonBaru = false;
          this.harga = harga;
          this.waktu_berangkat = waktu_berangkat;
          this.tanggal_berangkat = tanggal_berangkat;
          this.waktu_sampai = waktu_sampai;
          this.tanggal_sampai = tanggal_sampai;
          app.tt();
        },
        buat : function(){
          this.baru = true;
          this.ubah = false;
          this.buttonBaru = false;
          app.tt();
        },

        batal : function(){
          this.baru = false;
          this.ubah = false;
          this.buttonBaru = true;
          this.harga = '';
          this.rute = '';
          this.id_rute = 0;
          this.tanggal_berangkat = '';
          this.waktu_berangkat = '';
          this.tanggal_sampai = '';
          this.waktu_sampai = '';
        },

        update : function(){
          var url = "/anigatravel/jadwal/";
          var data_token = "?token="+token;
          var data = this.id_jadwal+"/"+data_token
            +"&harga="+this.harga
            +"&waktu_berangkat="+this.waktu_berangkat
            +"&tanggal_berangkat="+this.tanggal_berangkat
            +"&waktu_sampai="+this.waktu_sampai
            +"&tanggal_sampai="+this.tanggal_sampai
            +"&id_rute="+this.id_rute
            ;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 422) {
                alert('Invalid_rute Field')
              }
              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 200) {
                app.getAll();
                app.batal();
                alert('Update rute Success');
              }
            }
          }
          xhttp.open("PUT", url+data,true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }
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