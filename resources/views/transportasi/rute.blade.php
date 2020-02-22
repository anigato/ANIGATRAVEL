@extends('admin.admin')
@section('content')
    <!-- Begin Page Content -->
    <div id="app3" class="container-fluid">

      <!-- Page Heading -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" v-on:submit.prevent="find" method="get">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search Rute..." aria-label="Search" aria-describedby="basic-addon2" v-model="cari" @keyup="find">
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>
      <hr>

      <form class="user" method="post" v-on:submit.prevent="create" v-if="baru">
        <div class="form-group">
          <input type="text" class="form-control form-control-user" v-model="tujuan" placeholder="Tujuan">
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="text" class="form-control form-control-user" v-model="rute_awal" placeholder="Rute Awal" >
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control form-control-user" v-model="rute_akhir" placeholder="Rute Akhir">
          </div>
        </div>

        

        <div class="form-group">
          <select v-model="id_transportasi" class="form-control form-control-user" searchable="Search here..">
            <option v-for="tran in trans" :value="tran.id_transportasi">@{{tran.kode}} | @{{tran.keterangan}} | @{{tran.nama_type}} @{{tran.ket}}</option>
          </select>
        </div>
        <button class="btn btn-primary btn-user btn-block ">
          <i class="fas fa-plus"></i>
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal"><i class="fas fa-window-close"></i></button>
      </form>

      <form class="user" method="post" v-on:submit.prevent="update" v-if="ubah">
        <div class="form-group">
          <input type="text" class="form-control form-control-user" v-model="tujuan" placeholder="Tujuan">
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="text" class="form-control form-control-user" v-model="rute_awal" placeholder="Rute Awal" >
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control form-control-user" v-model="rute_akhir" placeholder="Rute Akhir">
          </div>
        </div>

        

        <div class="form-group">
          <select v-model="id_transportasi" class="form-control form-control-user" searchable="Search here..">
            <option v-for="tran in trans" :value="tran.id_transportasi">@{{tran.kode}} | @{{tran.keterangan}} | @{{tran.nama_type}} @{{tran.ket}}</option>
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
                  <th>Rute Awal</th>
                  <th>Rute Akhir</th>
                  <th>Transportasi</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Tujuan</th>
                  <th>Rute Awal</th>
                  <th>Rute Akhir</th>
                  <th>Transportasi</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="i in ruteAll">
                    <td>@{{i.tujuan}}</td>
                    <td>@{{i.rute_awal}}</td>
                    <td>@{{i.rute_akhir}}</td>
                    <td>@{{i.kode}} | @{{i.keterangan}} | @{{i.nama_type}} @{{i.ket}}</td>
                    <td>
                    <button class="btn btn-primary" type="submit" v-on:click="edit(i.id_rute,i.tujuan,i.rute_awal,i.rute_akhir,i.id_transportasi,i.kode,i.keterangan,i.ket,i.nama_type)">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger" type="submit" v-on:click="del(i.id_rute)" >
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
          kode:'',
          keterangan:'',
          ket:'',
          nama_type:'',
          tujuan:'',
          rute_awal:'',
          rute_akhir:'',
          id_transportasi:'',
          id_rute:0,
          cari:'',
          baru:false,
          ubah:false,
          buttonBaru:true,
          status:0,
          ruteAll:[{"id_transportasi":10,"tujuan":10,"rute_awal":"miaw","tujuan":10,"rute_akhir":10}],
          tran:'',
          trans:[],
        },
        beforeMount : function(){
          this.getAll();
      },
        methods : {
          transportasi : function(){
            var url = "{{route('rute_trans')}}";

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
                app.trans = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET",url, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
          },
          find : function(){
            var url = "{{route('rute_search')}}";
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
          var url = "{{route('rute_search')}}";
          var data_token = '?token='+token;
          var data = '&cari='+this.cari;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 422) {
                alert('Invalid_transportasi Field')
              }
              if (this.status == 200) {
                app.ruteAll = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }, 
        create : function(){
          var url     = "{{ route('rute_create') }}";
          var data_token ='?token='+token;
          var data    = 
             "&tujuan="+this.tujuan
            +"&rute_awal="+this.rute_awal
            +"&rute_akhir="+this.rute_akhir
            +"&id_transportasi="+this.id_transportasi;

          xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                  console.log(this.status,this.responseText)

                  if (this.status == 401) {
                    alert('Unauthorized User')
                  }

                  if (this.status == 422) {
                    alert('Invalid_transportasi field');
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
          var url = "{{route('rute_all')}}";
          var data_token = '?token='+token;
          var data = '';

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 422) {
                alert('Invalid_transportasi Field')
              }
              if (this.status == 200) {
                app.ruteAll = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }, 
        del : function(id_rute){
          var url = "/anigatravel/rute/";
          var data_token = "?token="+token;
          var data = id_rute+"/"+data_token;

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

        edit : function(id_rute,tujuan,rute_awal,rute_akhir,id_transportasi){
          this.id_rute = id_rute;
          this.baru = false;
          this.ubah = true;
          this.buttonBaru = false;
          this.tujuan = tujuan;
          this.rute_awal = rute_awal;
          this.rute_akhir = rute_akhir;
          this.id_transportasi = id_transportasi;
          app.transportasi();
        },
        buat : function(){
          this.baru = true;
          this.ubah = false;
          this.buttonBaru = false;
          app.transportasi();
        },

        batal : function(){
          this.baru = false;
          this.ubah = false;
          this.buttonBaru = true;
          this.rute_awal = '';
          this.id_transportasi = '';
          this.tujuan = '';
          this.id_rute = 0;
          this.rute_akhir = '';
        },

        update : function(){
          var url = "/anigatravel/rute/";
          var data_token = "?token="+token;
          var data = this.id_rute+"/"+data_token
            +"&rute_awal="+this.rute_awal
            +"&rute_akhir="+this.rute_akhir
            +"&tujuan="+this.tujuan
            +"&id_transportasi="+this.id_transportasi
            ;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 422) {
                alert('Invalid_transportasi Field')
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