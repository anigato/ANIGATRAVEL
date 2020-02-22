@extends('admin.admin')
@section('title','Daftar Petugas')
@section('content')
    <!-- Begin Page Content -->
    <div id="app" class="container-fluid">
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <div class="row">
            <div class="col-sm-6">
              <h6 class="m-0 font-weight-bold text-primary">Tabel Petugas</h6>
            </div>
            <div class="col-sm-6 text-right">
              <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" v-on:submit.prevent="find" method="get">
                <div class="input-group">
                  <input autofocus type="text" class="form-control bg-light border-0 small" placeholder="Cari Data Petugas" aria-label="Search" aria-describedby="basic-addon2" v-model="cari" @keyup="find">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                      <i class="fas fa-search fa-sm"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-condensed" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Nama Depan</th>
                  <th>Nama Belakang</th>
                  <th>Level</th>
                  <th>
                    <div class="row">
                      <div class="col-sm-12" v-on:click="BTN_tambah" v-if="btn_tambah"><button class="btn btn-success btn-block"><i class="fas fa-user-plus"></i></button></div>
                      <div class="col-sm-12">
                        <form action="" method="post" v-on:submit.prevent="create" v-if="btn_add" class="row">
                          <div class="col-sm-6"><button class="btn btn-info btn-block" type="submit">Add</button></div>
                          <div class="col-sm-6"  v-on:click="BTL"><button class="btn btn-danger btn-block">Cancel</button></div>
                        </form>
                        <form action="" method="post" v-on:submit.prevent="update" v-if="btn_edit" class="row">
                          <div class="col-sm-6"><button class="btn btn-info btn-block" type="submit">Edit</button></div>
                          <div class="col-sm-6" v-on:click="BTL"><button class="btn btn-danger btn-block">Cancel</button></div>
                        </form>
                      </div>
                    </div>
                  </th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Username</th>
                  <th>Nama Depan</th>
                  <th>Nama Belakang</th>
                  <th>Level</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                <tr class="form-group" v-if="btn_add">
                  <form action="" method="post" v-on:submit.prevent="create">
                    <td>
                      <input required type="text" class="form-control" style="border-radius:20px" v-model="username">
                      <div v-if="checkError('username')" style="color:red">
                        <strong>Warning!</strong> @{{ errors.username[0] }}.
                      </div>
                    </td>
                    <td>
                      <input required type="text" class="form-control" style="border-radius:20px" v-model="first_name">
                      <div v-if="checkError('first_name')" style="color:red">
                        <strong>Warning!</strong> @{{ errors.first_name[0] }}.
                      </div>
                    </td>
                    <td>
                      <input required type="text" class="form-control" style="border-radius:20px" v-model="last_name">
                      <div v-if="checkError('last_name')" style="color:red">
                        <strong>Warning!</strong> @{{ errors.last_name[0] }}.
                      </div>
                    </td>
                    <td>
                      <select v-model="level" class="form-control" style="border-radius:20px">
                        <option value="operator">Operator</option>
                        <option value="admin">Admin</option>
                      </select>
                      <div v-if="checkError('level')" style="color:red">
                        <strong>Warning!</strong> @{{ errors.level[0] }}.
                      </div>
                    </td>
                    <td>
                      <input required type="password" class="form-control" style="border-radius:20px" v-model="password" placeholder="Password">
                      <div v-if="checkError('password')" style="color:red">
                        <strong>Warning!</strong> @{{ errors.password[0] }}.
                      </div>
                    </td>
                  </form>
                </tr>
                <tr class="form-group" v-if="btn_edit">
                  <form action="" method="post" v-on:submit.prevent="update">
                    <td>
                      <input required type="text" class="form-control" style="border-radius:20px" v-model="username">
                      <div v-if="checkError('username')" style="color:red">
                        <strong>Warning!</strong> @{{ errors.username[0] }}.
                      </div>
                    </td>
                    <td>
                      <input required type="text" class="form-control" style="border-radius:20px" v-model="first_name">
                      <div v-if="checkError('first_name')" style="color:red">
                        <strong>Warning!</strong> @{{ errors.first_name[0] }}.
                      </div>
                    </td>
                    <td>
                      <input required type="text" class="form-control" style="border-radius:20px" v-model="last_name">
                      <div v-if="checkError('last_name')" style="color:red">
                        <strong>Warning!</strong> @{{ errors.last_name[0] }}.
                      </div>
                    </td>
                    <td>
                      <select v-model="level" class="form-control" style="border-radius:20px">
                        <option value="operator">Operator</option>
                        <option value="admin">Admin</option>
                      </select>
                      <div v-if="checkError('level')" style="color:red">
                        <strong>Warning!</strong> @{{ errors.level[0] }}.
                      </div>
                    </td>
                    <td>
                      <input placeholder="Password" type="password" class="form-control" style="border-radius:20px" v-model="password">
                      <div v-if="checkError('password')" style="color:red">
                        <strong>Warning!</strong> @{{ errors.password[0] }}.
                      </div>
                    </td>
                  </form>
                </tr>
                <tr v-for="i in userAll">
                  <td>@{{i.username}}</td>
                  <td>@{{i.first_name}}</td>
                  <td>@{{i.last_name}}</td>
                  <td>@{{i.level}}</td>
                  <td class="row">
                    <div class="col-sm-6">
                      <button class="btn btn-info btn-block" v-on:click="edit(i.id,i.username,i.first_name,i.last_name,i.level)"><i class="fas fa-user-edit"></i></button>
                    </div>
                    <div class="col-sm-6">
                      <button class="btn btn-danger btn-block" type="submit" v-on:click="del(i.id)" ><i class="fas fa-user-times"></i></button> 
                    </div>
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
        el: '#app',
        data: {
          username:'',
          first_name:'',
          last_name:'',
          password:'',
          level:'',
          id:0,
          cari:'',
          status:0,
          userAll:[],
          errors:{},
          btn_tambah:true,
          btn_add:false,
          btn_edit:false,
        },
        beforeMount : function(){
          this.getAll();
      },
        methods : {
          BTN_tambah : function(){
            this.btn_tambah = false;
            this.btn_add = true;
            this.btn_edit = false;
          },
          BTN_add : function(){
            this.btn_tambah = true;
            this.btn_add = false;
            this.btn_edit = false;
          },
          BTN_edit : function(){
            this.btn_tambah = true;
            this.btn_add = false;
            this.btn_edit = false;
          },
          BTL : function(){
            this.errors = {};
            this.btn_tambah = true;
            this.btn_add = false;
            this.btn_edit = false;
            this.username = '';
            this.first_name = '';
            this.last_name = '';
            this.level = '';
            this.password = '';
          },
          find : function(){
            var url = "{{route('user_search')}}";
            var data_token = '?token='+token;
            var data = '&cari='+this.cari;

            xhttp.onreadystatechange = function(){
              if (this.readyState == 4) {
                console.log(this.status,this.responseText);
                app.errors = {};
	              app.status = this.status;
                if (this.status == 401) {
                  alert('Unauthorized User')
                }
                if (this.status == 422) {
                  swal({
                    title: "Maaf!",
                    text: "Petugas yang anda cari tidak ada!",
                    icon: "error",
                    button: "OK",
                  });
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
          var url = "{{route('user_all')}}";
          var data_token = '?token='+token;
          var data = '';

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText);
              app.errors = {};
	              app.status = this.status;

              if (this.status == 401) {
                alert('Unauthorized User')
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
        create : function(){
          var url     = "{{ route('user_add') }}";
          var data_token ='?token='+token;
          var data =
             "&level="+this.level
            +"&username="+this.username
            +"&first_name="+this.first_name
            +"&last_name="+this.last_name
            +"&password="+this.password;

          xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                  console.log(this.status,this.responseText);
                  app.errors = {};
	                app.status = this.status;

                  if (this.status == 401) {
                    alert('Unauthorized User')
                  }

                  if (this.status == 422) {
                    app.errors= JSON.parse(this.responseText);
                  }

                  if (this.status == 200) {
                    app.BTN_add();
                    app.getAll();
                    swal({
                      title: "Berhasil!",
                      text: "Anda telah berhasil menambahkan petugas baru!",
                      icon: "success",
                      button: "OK",
                    });
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

        
        del : function(id){
          swal({
            title: "Yakin mau hapus petugas ini?",
            text: "Jika sudah dihapus, data tidak bisa dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              var url = "/petugas/";
              var data_token = "?token="+token;
              var data = id+"/"+data_token;

              xhttp.onreadystatechange = function(){
                if (this.readyState == 4) {
                  console.log(this.status,this.responseText);
                  app.errors = {};
	              app.status = this.status;

                  if (this.status == 401) {
                    alert('Unauthorized User')
                  }
                  if (this.status == 200) {
                    app.getAll();
                    swal("Berhasil! Anda telah menghapus salah satu petugas!", {
                      icon: "success",
                    });
                  }
                }
              }
              xhttp.open("DELETE", url+data , true);
              xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
              xhttp.send();
              
            } else {
              swal("Data masih aman!");
            }
          });
          
        },

        edit : function(id,username,first_name,last_name,level){
          this.id = id;
          this.btn_tambah = false;
          this.btn_add = false;
          this.btn_edit = true;
          this.username = username;
          this.first_name = first_name;
          this.last_name = last_name;
          this.level = level;
          this.password = '';
        },

        update : function(){
          var url = "/petugas/";
          var data_token = "?token="+token;
          var data = this.id+"/"+data_token
            +"&username="+this.username
            +"&first_name="+this.first_name
            +"&last_name="+this.last_name
            +"&password="+this.password
            +"&level="+this.level;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText);
              app.errors = {};
	            app.status = this.status;

              if (this.status == 422) {
                app.errors= JSON.parse(this.responseText);
              }
              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 200) {
                swal({
                  title: "Berhasil!",
                  text: "Anda telah berhasil mengubah data petugas!",
                  icon: "success",
                  button: "OK",
                });
                app.BTN_edit();
                app.getAll();
              }
            }
          }
          xhttp.open("PUT", url+data,true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }
      },
    });

  </script>
@endpush