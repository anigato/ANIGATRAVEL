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
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="diskon">Diskon %</label>
            <input type="number" max="100" min="1" maxlength="3" minlength="1" class="form-control form-control-user" v-model="diskon" placeholder="Diskon %">
          </div>
          <div class="col-sm-6">
            <label for="diskon">Maximal Diskon</label>
            <input type="number" max="1000000" min="1000" maxlength="7" minlength="4" class="form-control form-control-user" v-model="maximal_diskon" placeholder="Maximal Diskon">
          </div>
        </div>
        
        <div class="form-group">
            <label for="status"></label>
            <select v-model="status" class="form-control">
                <option value="null" selected disabled>Pilih Status</option>
                <option value="on">ON</option>
                <option value="off">OFF</option>
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
            <label for="diskon">Diskon %</label>
            <input type="number" max="100" min="1" maxlength="3" minlength="1" class="form-control form-control-user" v-model="diskon" placeholder="Diskon %">
          </div>
          <div class="col-sm-6">
            <label for="diskon">Maximal Diskon</label>
            <input type="number" max="1000000" min="1000" maxlength="7" minlength="4" class="form-control form-control-user" v-model="maximal_diskon" placeholder="Maximal Diskon">
          </div>
        </div>
        
        <div class="form-group">
            <label for="status"></label>
            <select v-model="status" class="form-control">
                <option value="null" selected disabled>Pilih Status</option>
                <option value="on">ON</option>
                <option value="off">OFF</option>
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
          <h6 class="m-0 font-weight-bold text-primary">Diskon</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Diskon</th>
                  <th>Kode Diskon</th>
                  <th>Maximal Diskon</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Diskon</th>
                  <th>Kode Diskon</th>
                  <th>Maximal Diskon</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="i in diskonAll">
                    <td>@{{i.diskon}}%</td>
                    <td>@{{i.kode_diskon }} </td>
                    <td>@{{ i.maximal_diskon }}</td>
                    <td>@{{i.status}}</td>
                    <td>
                        <button class="btn btn-primary" type="submit" v-on:click="edit(i.id_diskon,i.diskon,i.maximal_diskon,i.status,i.kode_diskon)">
                        <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-danger" type="submit" v-on:click="del(i.id_diskon)" >
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
          id_diskon:0,
          diskon:'',
          maximal_diskon:'',
          status:'',
          baru:false,
          ubah:false,
          buttonBaru:true,
          status:0,
          diskonAll:[],
        },
        beforeMount : function(){
          this.getAll();
      },
        methods : {
          find : function(){
            var url = "{{route('diskon_search')}}";
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
          var url = "{{route('diskon_search')}}";
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
                app.diskonAll = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }, 
        create : function(){
          var url     = "{{ route('diskon_create') }}";
          var data_token ='?token='+token;
          var data    = 
             "&diskon="+this.diskon
            +"&maximal_diskon="+this.maximal_diskon
            +"&status="+this.status;

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
                    alert('Create diskon success');
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
          var url = "{{route('diskon_all')}}";
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
                app.diskonAll = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }, 
        del : function(id_diskon){
          var url = "/anigatravel/diskon/";
          var data_token = "?token="+token;
          var data = id_diskon+"/"+data_token;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText)

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 200) {
                app.getAll();
                alert('Delete diskon Success');
              }
            }
          }
          xhttp.open("DELETE", url+data , true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        },

        edit : function(id_diskon,diskon,maximal_diskon,status){
          this.id_diskon = id_diskon;
          this.baru = false;
          this.ubah = true;
          this.buttonBaru = false;
          this.diskon = diskon;
          this.maximal_diskon = maximal_diskon;
          this.status = status;
        },
        buat : function(){
          this.baru = true;
          this.ubah = false;
          this.buttonBaru = false;
        },

        batal : function(){
          this.baru = false;
          this.ubah = false;
          this.buttonBaru = true;
          this.id_diskon = '';
          this.diskon = '';
          this.maximal_diskon = '';
          this.status = '';
          
        },

        update : function(){
          var url = "/anigatravel/diskon/";
          var data_token = "?token="+token;
          var data = this.id_diskon+"/"+data_token
            +"&diskon="+this.diskon
            +"&status="+this.status
            +"&maximal_diskon="+this.maximal_diskon
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
                alert('Update Dikson Success');
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