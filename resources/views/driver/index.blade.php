{{-- @extends('admin.admin')
@section('content')
    <!-- Begin Page Content -->
    <div id="app" class="container-fluid">

      <!-- Page Heading -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" v-on:submit.prevent="find" method="get">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Search Drivers..." aria-label="Search" aria-describedby="basic-addon2" v-model="cari" @keyup="find">
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
          <input type="text" class="form-control form-control-user" v-model="nama_lengkap" placeholder="Nama Lengkap">
        </div>

        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <input type="text" class="form-control form-control-user" v-model="no_ktp" placeholder="NO KTP">
          </div>
          <div class="col-sm-6">
            <input type="text" class="form-control form-control-user" v-model="no_sim" placeholder="NO SIM">
          </div>
        </div>
        <div class="form-group">
          <select v-model="id_transportasi" class="form-control form-control-user" searchable="Search here..">
            <option v-for="tran in trans" :value="tran.id_transportasi">@{{tran.tipe_transportasi}} | @{{tran.tipe_penumpang}} | @{{tran.nama_type}} @{{tran.nama_transportasi}}</option>
          </select>
        </div>

        <button class="btn btn-primary btn-user btn-block ">
          <i class="fas fa-user-plus"></i>
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal"><i class="fas fa-window-close"></i></button>
      </form>

        <form class="user" method="post" v-on:submit.prevent="update" v-if="ubah">
          <div class="form-group">
            <input type="text" class="form-control form-control-user" v-model="nama_lengkap" placeholder="Nama Lengkap">
          </div>

          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <input type="text" class="form-control form-control-user" v-model="no_ktp" placeholder="NO KTP">
            </div>
            <div class="col-sm-6">
              <input type="text" class="form-control form-control-user" v-model="no_sim" placeholder="NO SIM">
            </div>
          </div>
          <div class="form-group">
          <select v-model="id_transportasi" class="form-control form-control-user" searchable="Search here..">
            <option v-for="tran in trans" :value="tran.id_transportasi">@{{tran.tipe_transportasi}} | @{{tran.tipe_penumpang}} | @{{tran.nama_type}} @{{tran.nama_transportasi}}</option>
          </select>
        </div>

          <button class="btn btn-primary btn-user btn-block">
            <i class="fas fa-user-check"></i>
          </button>
          <button class="btn btn-danger btn-user btn-block" v-on:click="batal">
            <i class="fas fa-window-close"></i>
          </button>

          <hr>
          
        </form>


      <button class="btn btn-success btn-user btn-block" v-on:click="buat" v-if="buttonBaru">
        <i class="fas fa-user-plus"></i>
      </button>
      <hr>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Table Drivers</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nama Lengkap</th>
                  <th>Transportasi</th>
                  <th>NO KTP</th>
                  <th>NO SIM</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Nama Lengkap</th>
                  <th>Transportasi</th>
                  <th>NO KTP</th>
                  <th>NO SIM</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="i in userAll">
                  <td>@{{i.nama_lengkap}}</td>
                  <td>@{{i.tipe_transportasi}} | @{{i.tipe_penumpang}} | @{{i.nama_type}} @{{i.nama_transportasi}}</td>
                  <td>@{{i.no_ktp}}</td>
                  <td>@{{i.no_sim}}</td>
                  <td>
                    <button class="btn btn-primary" type="submit" v-on:click="edit(i.id_driver,i.nama_lengkap,i.no_ktp,i.no_sim)">
                      <i class="fas fa-user-edit"></i>
                    </button>
                    <button class="btn btn-danger" type="submit" v-on:click="del(i.id_driver)" >
                      <i class="fas fa-user-times"></i>
                    </button> 
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid_driver -->
@endsection
     
@push('js')
  <script type="text/javascript">
    var xhttp = new XMLHttpRequest();
    var token = "<?= session('token') ?>";


    var app = new Vue({
        el: '#app',
        data: {
          nama_lengkap:'',
          no_ktp:'',
          no_sim:'',
          baru:false,
          ubah:false,
          buttonBaru:true,
          cari:'',
          status:0,
          userAll:[],
          trans:[],
        },
        beforeMount : function(){
          this.getAll();
      },
        methods : {
          find : function(){
            var url = "{{route('driver_search')}}";
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
          var url = "{{route('driver_search')}}";
          var data_token = '?token='+token;
          var data = '&cari='+this.cari;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 422) {
                alert('Invalid_driver_transportasi Field')
              }
              if (this.status == 200) {
                app.userAll = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }, 
        getAll : function(){
          var url = "{{route('driver_all')}}";
          var data_token = '?token='+token;
          var data = '';

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 422) {
                alert('Invalid_driver Field')
              }
              if (this.status == 200) {
                app.userAll = JSON.parse(this.responseText);
                app.getId();
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }, 
        getId : function(){
          var url = "{{route('id_transportasi')}}";
          var data_token = '?token='+token;
          var data = '';

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 422) {
                alert('Invalid_driver Field')
              }
              if (this.status == 200) {
                app.trans = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }, 
        create : function(){
          var url     = "{{ route('driver_add') }}";
          var data_token ='?token='+token;
          var data =
            "&nama_lengkap="+this.nama_lengkap
            +"&no_ktp="+this.no_ktp
            +"&no_sim="+this.no_sim
            +"&id_transportasi="+this.id_transportasi;

          xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                  console.log(this.status,this.responseText)

                  if (this.status == 401) {
                    alert('Unauthorized User')
                  }

                  if (this.status == 422) {
                    alert('Invalid_driver field');
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

        
        del : function(id_driver){
          var url = "/anigatravel/driver/";
          var data_token = "?token="+token;
          var data = id_driver+"/"+data_token;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 200) {
                app.getAll();
                alert('Delete user Success');
              }
            }
          }
          xhttp.open("DELETE", url+data , true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        },

        edit : function(id_driver,nama_lengkap,no_ktp,no_sim,password,level){
          this.id_driver = id_driver;
          this.baru = false;
          this.ubah = true;
          this.buttonBaru = false;
          this.nama_lengkap = nama_lengkap;
          this.no_ktp = no_ktp;
          this.no_sim = no_sim;
          this.level = level;
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
          this.nama_lengkap = '';
          this.no_ktp = '';
          this.no_sim = '';
          this.level = '';
          this.id_driver = 0;
        },

        update : function(){
          var url = "/anigatravel/driver/";
          var data_token = "?token="+token;
          var data = this.id_driver+"/"+data_token
            +"&nama_lengkap="+this.nama_lengkap
            +"&no_ktp="+this.no_ktp
            +"&no_sim="+this.no_sim
            +"&id_transportasi="+this.id_transportasi;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 422) {
                alert('Invalid Field')
              }
              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 200) {
                app.getAll();
                app.batal();
                alert('Update type Success');
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
@endpush --}}