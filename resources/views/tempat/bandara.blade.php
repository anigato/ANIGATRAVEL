@extends('admin.admin')
@section('title','Daftar Bandara')
@section('content')
    <!-- Begin Page Content -->
    <div id="app3" class="container-fluid">

      <!-- Page Heading -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" v-on:submit.prevent="find" method="get">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Bandara" aria-label="Search" aria-describedby="basic-addon2" v-model="cari" @keyup="find">
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
            <label for="">Nama Bandara</label>
            <input required type="text" v-model="nama_tempat" class="form-control form-control-user" placeholder="Nama Bandara">
            <div v-if="checkError('nama_tempat')" style="color:red">
              <strong>Warning!</strong> @{{ errors.nama_tempat[0] }}.
            </div>
          </div>
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Wilayah</label>
            <input required type="text" class="form-control form-control-user" v-model="wilayah" placeholder="wilayah">
            <div v-if="checkError('wilayah')" style="color:red">
              <strong>Warning!</strong> @{{ errors.wilayah[0] }}.
            </div>
          </div>
        </div>

        <button class="btn btn-primary btn-user btn-block ">
          <i class="fas fa-plus"></i> Tambahkan
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal"><i class="fas fa-window-close"></i> Batal</button>
      </form>

      <form class="user" method="post" v-on:submit.prevent="update" v-if="ubah">
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Nama Bandara</label>
            <input required type="text" v-model="nama_tempat" class="form-control form-control-user" placeholder="Nama Bandara">
            <div v-if="checkError('nama_tempat')" style="color:red">
              <strong>Warning!</strong> @{{ errors.nama_tempat[0] }}.
            </div>
          </div>
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Wilayah</label>
            <input required type="text" class="form-control form-control-user" v-model="wilayah" placeholder="wilayah">
            <div v-if="checkError('wilayah')" style="color:red">
              <strong>Warning!</strong> @{{ errors.wilayah[0] }}.
            </div>
          </div>
        </div>

        <button class="btn btn-primary btn-user btn-block">
          <i class="fas fa-check"></i> Ubah
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal">
          <i class="fas fa-window-close"></i> Batal
        </button>

        <hr>
        
      </form>


      <button class="btn btn-success btn-user btn-block" v-on:click="buat" v-if="buttonBaru">
        <i class="fas fa-plus"></i> Tambahkan Bandara Baru
      </button>
      <hr>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Daftar Bandara</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-condensed" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Nama Bandara</th>
                  <th>Wilayah</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Kode</th>
                  <th>Nama Bandara</th>
                  <th>Wilayah</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="i in tempatAll">
                    <td>@{{i.kode_tempat}}</td>
                    <td>@{{i.nama_tempat}}</td>
                    <td>@{{i.wilayah}}</td>
                    <td>
                    <button class="btn btn-primary" type="submit" v-on:click="edit(i.id_tempat,i.nama_tempat,i.wilayah)">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger" type="submit" v-on:click="del(i.id_tempat)">
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
      nama_tempat:'',
      wilayah:'',
      id_tempat:0,
      baru:false,
      ubah:false,
      buttonBaru:true,
      cari:'',
      status:0,
      tempatAll:[],
      errors:{},
    },
    beforeMount : function(){
      this.getAll();
  },
    methods : {
      find : function(){
        var url = "{{route('search_flight')}}";
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
              text: "Bandara yang anda cari tidak ada!",
              icon: "error",
              button: "OK",
            });
          }
          if (this.status == 200) {
            app.tempatAll = JSON.parse(this.responseText);
          }
        }
      }
      xhttp.open("GET", url+data_token+data, true);
      xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
      xhttp.send();
      }, 
    getAll : function(){
      var url = "{{route('get_flight')}}";
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
            alert('Invalid_tempat Field')
          }
          if (this.status == 200) {
            app.tempatAll = JSON.parse(this.responseText);
          }
        }
      }
      xhttp.open("GET", url+data_token+data, true);
      xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
      xhttp.send();
    }, 
    create : function(){
      var url     = "{{ route('tempat_create') }}";
      var data_token ='?token='+token;
      var data    = 
         "&nama_tempat="+this.nama_tempat
        +"&tipe_tempat=Bandara"
        +"&wilayah="+this.wilayah;

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
                app.batal();
                app.getAll();
                swal({
                  title: "Berhasil!",
                  text: "Anda telah berhasil menambahkan Bandara baru!",
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

    
    del : function(id_tempat){
      swal({
        title: "Yakin mau hapus Bandara ini?",
        text: "Jika sudah dihapus, data tidak bisa dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var url = "/tempat/";
          var data_token = "?token="+token;
          var data = id_tempat+"/"+data_token;

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
                swal("Berhasil! Anda telah menghapus salah satu Bandara!", {
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

    edit : function(id_tempat,nama_tempat,wilayah){
      this.id_tempat = id_tempat;
      this.baru = false;
      this.ubah = true;
      this.buttonBaru = false;
      this.nama_tempat = nama_tempat;
      this.wilayah = wilayah;
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
      this.nama_tempat = '';
      this.wilayah = '';
      this.id_tempat = 0;
    },

    update : function(){
      var url = "/tempat/";
      var data_token = "?token="+token;
      var data = this.id_tempat+"/"+data_token
        +"&nama_tempat="+this.nama_tempat
        +"&wilayah="+this.wilayah;

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
              text: "Anda telah berhasil mengubah data Bandara!",
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