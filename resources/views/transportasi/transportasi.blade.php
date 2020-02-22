@extends('admin.admin')
@section('content')
    <!-- Begin Page Content -->
    <div id="app3" class="container-fluid">

      <!-- Page Heading -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" v-on:submit.prevent="find" method="get">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search Transportation..." aria-label="Search" aria-describedby="basic-addon2" v-model="cari" @keyup="find">
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
            <input type="number" class="form-control form-control-user" v-model="kode" placeholder="Kode" maxlength="4">
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control form-control-user" v-model="jumlah_kursi" placeholder="Jumlah Kursi">
          </div>
        </div>

        <div class="form-group">
          <input type="text" class="form-control form-control-user" v-model="keterangan" placeholder="Keterangan">
        </div>

        <div class="form-group">
          <select v-model="id_type_transportasi" class="form-control form-control-user" searchable="Search here..">
            <option v-for="tipe in tipes" v-bind:value="tipe.id_type_transportasi">@{{tipe.nama_type}} @{{tipe.keterangan}}</option>
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
            <input type="number" class="form-control form-control-user" v-model="kode" placeholder="Kode" maxlength="4">
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control form-control-user" v-model="jumlah_kursi" placeholder="Jumlah Kursi">
          </div>
        </div>

        <div class="form-group">
          <input type="text" class="form-control form-control-user" v-model="keterangan" placeholder="Keterangan">
        </div>

        <div class="form-group">
          <select v-model="id_type_transportasi" class="form-control form-control-user" searchable="Search here..">
            <option v-for="tipe in tipes" v-bind:value="tipe.id_type_transportasi">@{{tipe.nama_type}} @{{tipe.keterangan}}</option>
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
                  <th>Kode</th>
                  <th>Jumlah Kursi</th>
                  <th>Keterangan</th>
                  <th>Tipe</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Kode</th>
                  <th>Jumlah Kursi</th>
                  <th>Keterangan</th>
                  <th>Tipe</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="i in transportasiAll">
                  <td>@{{i.kode}}</td>
                  <td>@{{i.jumlah_kursi}}</td>
                  <td>@{{i.keterangan}}</td>
                  <td>@{{i.nama_type}} @{{i.ket}}</td>
                  <td>
                    <button class="btn btn-primary" type="submit" v-on:click="edit(i.id_transportasi,i.kode,i.jumlah_kursi,i.keterangan,i.id_type_transportasi,i.nama_type)">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger" type="submit" v-on:click="del(i.id_transportasi)" >
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
          jumlah_kursi:'',
          keterangan:'',
          kode:'',
          id_transportasi:0,
          cari:'',
          baru:false,
          ubah:false,
          buttonBaru:true,
          status:0,
          nama_type:'',
          transportasiAll:[{"id_transportasi":null,"kode":null,"jumlah_kursi":null,"keterangan":null,"id_type_transportasi":null,"nama_type":null}],
          tipe:'',
          tipes:[],
        },
        beforeMount : function(){
          this.getAll();
      },
        methods : {
          type : function(){
            var url = "{{route('type')}}";

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
                app.tipes = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET",url, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
          },
          find : function(){
            var url = "{{route('transportasi_search')}}";
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
          var url = "{{route('transportasi_search')}}";
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
                app.transportasiAll = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }, 
        create : function(){
          var url     = "{{ route('create_transportasi') }}";
          var data_token ='?token='+token;
          var data    = 
             "&kode="+this.kode
            +"&jumlah_kursi="+this.jumlah_kursi
            +"&keterangan="+this.keterangan
            +"&id_type_transportasi="+this.id_type_transportasi;

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
                    alert('Create Transportasi success');
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
          var url = "{{route('transportasi_all')}}";
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
                app.transportasiAll = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }, 
        del : function(id_transportasi){
          var url = "/anigatravel/transportasi/";
          var data_token = "?token="+token;
          var data = id_transportasi+"/"+data_token;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 200) {
                app.getAll();
                alert('Delete Board Success');
              }
            }
          }
          xhttp.open("DELETE", url+data , true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        },

        edit : function(id_transportasi,kode,jumlah_kursi,keterangan,id_type_transportasi){
          this.id_transportasi = id_transportasi;
          this.baru = false;
          this.ubah = true;
          this.buttonBaru = false;
          this.kode = kode;
          this.jumlah_kursi = jumlah_kursi;
          this.keterangan = keterangan;
          this.id_type_transportasi = id_type_transportasi;
          this.type();
        },

        buat : function(){
          this.baru = true;
          this.ubah = false;
          this.buttonBaru = false;
          app.type();
        },

        batal : function(){
          this.baru = false;
          this.ubah = false;
          this.buttonBaru = true;
          this.kode = '';
          this.keterangan = '';
          this.id_type_transportasi = '';
          this.jumlah_kursi = '';
          this.id_transportasi = 0;
        },

        update : function(){
          var url = "/anigatravel/transportasi/";
          var data_token = "?token="+token;
          var data = this.id_transportasi+"/"+data_token
            +"&kode="+this.kode
            +"&keterangan="+this.keterangan
            +"&jumlah_kursi="+this.jumlah_kursi
            +"&id_type_transportasi="+this.id_type_transportasi
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
                alert('Update transportasi Success');
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