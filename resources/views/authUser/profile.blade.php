@extends('admin.admin')
@section('title','User Profile')
@section('content')
    <!-- Begin Page Content -->
    <div id="app3" class="container-fluid">

      <div class="card shadow mb-4" >
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Profile Anda</h6>
        </div>
        <div class="card-body">
          <div class="user" v-for="i in profiles" v-if="profile">
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="username">Username</label>
                <div class="form-control" style="border-radius:20px">@{{i.username}}</div>
              </div>
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="nama_penumpang">Nama Lengkap</label>
                <div class="form-control" style="border-radius:20px">@{{i.nama_penumpang}}</div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <div class="form-control" style="border-radius:20px">@{{i.jenis_kelamin}}</div>
              </div>
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="no_ktp">No KTP / No NIK</label>
                <div class="form-control" style="border-radius:20px">@{{i.no_ktp}}</div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="email">Email</label>
                <div class="form-control" style="border-radius:20px">@{{i.email}}</div>
              </div>
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="telepone">No Telepon / No HP</label>
                <div class="form-control" style="border-radius:20px">@{{i.telepone}}</div>
              </div>
            </div>
            <div class="form-group">
              <label for="alamat_penumpang">Alamat Penumpang</label>
              <textarea readonly class="form-control" style="border-radius:20px" rows="3">@{{i.alamat_penumpang}}</textarea readonly>
            </div>
            <button class="btn btn-success btn-user btn-block" v-if="buttonBaru" v-on:click="edit(i.id_penumpang,i.id_profile,i.username,i.password,i.nama_penumpang,i.no_ktp,i.jenis_kelamin,i.alamat_penumpang,i.email,i.telepone)">Ubah Profile</button>
          </div>
          
          <form class="user" method="post" v-on:submit.prevent="update" v-if="baru">
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="username">Username</label>
                <input required type="text" class="form-control" style="border-radius:20px" v-model="username" placeholder="Username" id="username">
                <div v-if="checkError('username')" style="color:red">
                  <strong>Warning!</strong> @{{ errors.username[0] }}.
                </div>
              </div>
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="nama_penumpang">Nama Lengkap</label>
                <input required type="text" class="form-control" style="border-radius:20px" v-model="nama_penumpang" placeholder="Nama Lengkap" id="nama_penumpang">
                <div v-if="checkError('nama_penumpang')" style="color:red">
                  <strong>Warning!</strong> @{{ errors.nama_penumpang[0] }}.
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select required v-model="jenis_kelamin" class="form-control" style="border-radius:20px">
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
                <div v-if="checkError('jenis_kelamin')" style="color:red">
                  <strong>Warning!</strong> @{{ errors.jenis_kelamin[0] }}.
                </div>
              </div>
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="no_ktp">No KTP / No NIK</label>
                <input required type="number" class="form-control" style="border-radius:20px" v-model="no_ktp" placeholder="No KTP / No NIK" id="no_ktp">
                <div v-if="checkError('no_ktp')" style="color:red">
                  <strong>Warning!</strong> @{{ errors.no_ktp[0] }}.
                </div>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="email">Email</label>
                <input required type="email" class="form-control" style="border-radius:20px" v-model="email" placeholder="Email" id="email">
                <div v-if="checkError('email')" style="color:red">
                  <strong>Warning!</strong> @{{ errors.email[0] }}.
                </div>
              </div>
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="telepone">No Telepon / No HP</label>
                <input required type="number" class="form-control" style="border-radius:20px" v-model="telepone" placeholder="No Telepon / No HP" id="telepone">
                <div v-if="checkError('telepone')" style="color:red">
                  <strong>Warning!</strong> @{{ errors.telepone[0] }}.
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="alamat_penumpang">Alamat Penumpang</label>
              <textarea required class="form-control" style="border-radius:20px" v-model="alamat_penumpang" placeholder="Alamat Penumpang" id="alamat_penumpang" rows="3"></textarea>
              <div v-if="checkError('alamat_penumpang')" style="color:red">
                <strong>Warning!</strong> @{{ errors.alamat_penumpang[0] }}.
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <button class="btn btn-primary btn-user btn-block"><i class="fas fa-check"></i> Ubah</button>
              </div>
              <div class="col-sm-6">
                <button class="btn btn-danger btn-user btn-block" v-on:click="batal"><i class="fas fa-window-close"></i> Batal</button>
              </div>
            </div>
          </form>
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
          id_penumpang:'',
          id_profile:'',
          username:'',
          nama_penumpang:'',
          no_ktp:'',
          jenis_kelamin:'',
          alamat_penumpang:'',
          email:'',
          telepone:'',
          baru:false,
          profile:true,
          buttonBaru:true,
          status:0,
          profiles:[],
          errors:{},
        },
        beforeMount : function(){
          this.getAll();
      },
        methods : {
          
        getAll : function(){
          var url = "{{route('data')}}";
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
              if (this.status == 422) {
                alert('Invalid_type_transportasi Field')
              }
              if (this.status == 200) {
                app.profiles = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET", url+data_token+data, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
        }, 
        
        checkError : function(key){
          return this.errors.hasOwnProperty(key);
        },

        

        batal : function(){
          this.buttonBaru = true;
          this.baru = false;
          this.profile = true;
        },
        edit : function(id_penumpang,id_profile,username,password,nama_penumpang,no_ktp,jenis_kelamin,alamat_penumpang,email,telepone){
              this.id_penumpang = id_penumpang;
              this.id_profile = id_profile;
              this.username = username;
              this.nama_penumpang = nama_penumpang;
              this.no_ktp = no_ktp;
              this.jenis_kelamin = jenis_kelamin;
              this.alamat_penumpang = alamat_penumpang;
              this.email = email;
              this.telepone = telepone;
              this.baru = true;
              this.profile = false;
              this.buttonBaru = false;
              app.type();
            },

        update : function(){
          var url = "/anigatravel/user/";
          var data_token = "?token="+token;
          var data = this.id_penumpang+"/"+data_token
            +"&id_penumpang="+this.id_penumpang
            +"&id_profile="+this.id_profile
            +"&username="+this.username
            +"&nama_penumpang="+this.nama_penumpang
            +"&no_ktp="+this.no_ktp
            +"&jenis_kelamin="+this.jenis_kelamin
            +"&alamat_penumpang="+this.alamat_penumpang
            +"&email="+this.email
            +"&telepone="+this.telepone
            ;

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
                app.getAll();
                app.batal();
                swal({
                  title: "Berhasil!",
                  text: "Anda telah berhasil melengkapi Profil anda!",
                  icon: "success",
                  button: "OK",
                });
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