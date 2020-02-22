@extends('admin.admin')
@section('title','Daftar Pesawat & Kereta')
@section('content')
<div id="app3" class="container-fluid">
  <div class="row">
    <div class="col-sm-6">
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" v-on:submit.prevent="find" method="get">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Pesawat" aria-label="Search" aria-describedby="basic-addon2" v-model="cari" @keyup="find_p">
          
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>
      <hr>
  
      <form class="user" method="post" v-on:submit.prevent="create_p" v-if="baru_p">
        
        <div class="form-group row">
          <label for="">Nama Transportasi</label>
          <input required type="text" style="border-radius:20px" class="form-control" v-model="keterangan" placeholder="Nama Tranpsortasi">
          <div v-if="checkError('keterangan')" style="color:red">
            <strong>Warning!</strong> @{{ errors.keterangan[0] }}.
          </div>
        </div>
  
        <button class="btn btn-primary btn-user btn-block ">
          <i class="fas fa-plus"></i> Tambahkan
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal_p"><i class="fas fa-window-close"></i> Batal_p</button>
      </form>
  
      <form class="user" method="post" v-on:submit.prevent="update_p" v-if="ubah_p">
        <div class="form-group row">
          <label for="">Nama Transportasi</label>
          <input required type="text" style="border-radius:20px" class="form-control" v-model="keterangan" placeholder="Nama Tranpsortasi">
          <div v-if="checkError('keterangan')" style="color:red">
            <strong>Warning!</strong> @{{ errors.keterangan[0] }}.
          </div>
        </div>
  
        <button class="btn btn-primary btn-user btn-block">
          <i class="fas fa-check"></i> Ubah
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal_p">
          <i class="fas fa-window-close"></i> Batal_p
        </button>
  
        <hr>
        
      </form>
  
      <button class="btn btn-success btn-user btn-block" v-on:click="buat_p" v-if="buttonBaru_p">
        <i class="fas fa-plus"></i> Tambahkan Pesawat Baru
      </button>
      <hr>
  
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Table Pesawat</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-condensed" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Pesawat</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Pesawat</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="i in flightAll">
                    <td>@{{ i.nama_type }} @{{i.keterangan}}</td>
                    <td>
                    <button class="btn btn-primary" type="submit" v-on:click="edit_p(i.id_type_transportasi,i.nama_type,i.keterangan)">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger" type="submit" v-on:click="del(i.id_type_transportasi)">
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

    <div class="col-sm-6">
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" v-on:submit.prevent="find" method="get">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Kereta" aria-label="Search" aria-describedby="basic-addon2" v-model="cari_t" @keyup="find_t">
          
          <div class="input-group-append">
            <button class="btn btn-primary" type="button">
              <i class="fas fa-search fa-sm"></i>
            </button>
          </div>
        </div>
      </form>
      <hr>
  
      <form class="user" method="post" v-on:submit.prevent="create_t" v-if="baru_t">
        
        <div class="form-group row">
          <label for="">Nama Transportasi</label>
          <input required type="text" style="border-radius:20px" class="form-control" v-model="keterangan_t" placeholder="Nama Tranpsortasi">
          <div v-if="checkError('keterangan')" style="color:red">
            <strong>Warning!</strong> @{{ errors.keterangan[0] }}.
          </div>
        </div>
  
        <button class="btn btn-primary btn-user btn-block ">
          <i class="fas fa-plus"></i> Tambahkan
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal_t"><i class="fas fa-window-close"></i> Batal_p</button>
      </form>
  
      <form class="user" method="post" v-on:submit.prevent="update_t" v-if="ubah_t">
        <div class="form-group row">
          <label for="">Nama Transportasi</label>
          <input required type="text" style="border-radius:20px" class="form-control" v-model="keterangan_t" placeholder="Nama Tranpsortasi">
          <div v-if="checkError('keterangan')" style="color:red">
            <strong>Warning!</strong> @{{ errors.keterangan[0] }}.
          </div>
        </div>
  
        <button class="btn btn-primary btn-user btn-block">
          <i class="fas fa-check"></i> Ubah
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal_t">
          <i class="fas fa-window-close"></i> Batal_p
        </button>
  
        <hr>
        
      </form>
  
      <button class="btn btn-success btn-user btn-block" v-on:click="buat_t" v-if="buttonBaru_t">
        <i class="fas fa-plus"></i> Tambahkan Kereta Baru
      </button>
      <hr>
  
      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Table Kereta</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-condensed" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Kereta</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Kereta</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="i in trainAll">
                    <td>@{{ i.nama_type }} @{{i.keterangan}}</td>
                    <td>
                    <button class="btn btn-primary" type="submit" v-on:click="edit_t(i.id_type_transportasi,i.nama_type,i.keterangan)">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger" type="submit" v-on:click="del(i.id_type_transportasi)">
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
    keterangan:'',
    nama_type:'',
    id_type_transportasi:0,
    baru_p:false,
    ubah_p:false,
    buttonBaru_p:true,
    baru_t:false,
    ubah_t:false,
    buttonBaru_t:true,
    cari:'',
    status:0,
    errors:{},
    flightAll:[],
    trainAll:[],
  },
  beforeMount : function(){
    this.getAll_p();
  },
  methods : {
    find_p : function(){
      var url = "{{route('type_flight_search')}}";
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
              text: "Pesawat yang anda cari tidak ada!",
              icon: "error",
              button: "OK",
            });
          }
          if (this.status == 200) {
            app.flightAll = JSON.parse(this.responseText);
          }
        }
      }
      xhttp.open("GET", url+data_token+data, true);
      xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
      xhttp.send();
    },
    find_t : function(){
      var url = "{{route('type_train_search')}}";
      var data_token = '?token='+token;
      var data = '&cari='+this.cari_t;

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
              text: "Kereta yang anda cari tidak ada!",
              icon: "error",
              button: "OK",
            });
          }
          if (this.status == 200) {
            app.trainAll = JSON.parse(this.responseText);
          }
        }
      }
      xhttp.open("GET", url+data_token+data, true);
      xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
      xhttp.send();
    },
    getAll_p : function(){
      var url = "{{route('type_flight_all')}}";
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
            app.flightAll = JSON.parse(this.responseText);
            app.getAll_t();
          }
        }
      }
      xhttp.open("GET", url+data_token+data, true);
      xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
      xhttp.send();
    }, 
    getAll_t : function(){
      var url = "{{route('type_train_all')}}";
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
            app.trainAll = JSON.parse(this.responseText);
          }
        }
      }
      xhttp.open("GET", url+data_token+data, true);
      xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
      xhttp.send();
    }, 
    create_p : function(){
      var url     = "{{ route('type_create') }}";
      var data_token ='?token='+token;
      var data    = 
         "&nama_type=Pesawat"
        +"&keterangan="+this.keterangan;

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
            app.batal_p();
            app.getAll_p();
            swal({
              title: "Berhasil!",
              text: "Anda telah berhasil menambahkan Pesawat baru!",
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
    create_t : function(){
      var url     = "{{ route('type_create') }}";
      var data_token ='?token='+token;
      var data    = 
         "&nama_type=Kereta"
        +"&keterangan="+this.keterangan_t;

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
            app.batal_t();
            app.getAll_t();
            swal({
              title: "Berhasil!",
              text: "Anda telah berhasil menambahkan Kereta baru!",
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
    
    del : function(id_type_transportasi){
      swal({
        title: "Yakin mau hapus Transportasi ini?",
        text: "Jika sudah dihapus, data tidak bisa dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var url = "/type_transportasi/";
          var data_token = "?token="+token;
          var data = id_type_transportasi+"/"+data_token;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText);
              app.errors = {};
                    app.status = this.status;

              if (this.status == 401) {
                alert('Unauthorized User')
              }
              if (this.status == 200) {
                app.getAll_p();
                swal("Berhasil!","Anda telah menghapus salah satu Pesawat!", {
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

    edit_p : function(id_type_transportasi,nama_type,keterangan){
      this.id_type_transportasi = id_type_transportasi;
      this.baru_p = false;
      this.ubah_p = true;
      this.buttonBaru_p = false;
      this.nama_type = nama_type;
      this.keterangan = keterangan;
    },
    edit_t : function(id_type_transportasi,nama_type,keterangan){
      this.id_type_transportasi_t = id_type_transportasi;
      this.baru_t = false;
      this.ubah_t = true;
      this.buttonBaru_t = false;
      this.nama_type_t = nama_type;
      this.keterangan_t = keterangan;
    },

    buat_p : function(){
      this.baru_p = true;
      this.ubah_p = false;
      this.buttonBaru_p = false;
    },
    buat_t : function(){
      this.baru_t = true;
      this.ubah_t = false;
      this.buttonBaru_t = false;
    },

    batal_p : function(){
      this.baru_p = false;
      this.ubah_p = false;
      this.buttonBaru_p = true;
      this.nama_type = '';
      this.keterangan = '';
      this.id_type_transportasi = 0;
    },
    batal_t : function(){
      this.baru_t = false;
      this.ubah_t = false;
      this.buttonBaru_t = true;
      this.nama_type_t = '';
      this.keterangan_t = '';
      this.id_type_transportasi_t = 0;
    },

    update_p : function(){
      var url = "/type_transportasi/";
      var data_token = "?token="+token;
      var data = this.id_type_transportasi+"/"+data_token
        +"&nama_type=Pesawat"
        +"&keterangan="+this.keterangan;

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
            app.getAll_p();
            app.batal_p();
            swal({
              title: "Berhasil!",
              text: "Anda telah berhasil mengubah data Pesawat!",
              icon: "success",
              button: "OK",
            });
          }
        }
      }
      xhttp.open("PUT", url+data,true);
      xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
      xhttp.send();
    },
    update_t : function(){
      var url = "/type_transportasi/";
      var data_token = "?token="+token;
      var data = this.id_type_transportasi+"/"+data_token
        +"&nama_type=Kereta"
        +"&keterangan="+this.keterangan_t;

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
            app.getAll_t();
            app.batal_t();
            swal({
              title: "Berhasil!",
              text: "Anda telah berhasil mengubah data Pesawat!",
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