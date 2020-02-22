@extends('admin.admin')
@section('title','Jadwal Penerbangan')
@section('content')
    <!-- Begin Page Content -->
    <div id="app3" class="container-fluid">
      <!-- Page Heading -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" v-on:submit.prevent="find" method="get">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Jadwal Penerbangan" aria-label="Search" aria-describedby="basic-addon2" v-model="cari" @keyup="find">
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
            <label for="">Waktu Berangkat</label>
            <input type="time" class="form-control" style="border-radius:20px" v-model="waktu_berangkat" placeholder="Waktu Berangkat">
            <div v-if="checkError('waktu_berangkat')" style="color:red">
              <strong>Warning!</strong> @{{ errors.waktu_berangkat[0] }}.
            </div>
          </div>
          <div class="col-sm-6">
            <label for="">Tanggal Berangkat</label>
            <input type="date" class="form-control" style="border-radius:20px" v-model="tanggal_berangkat" placeholder="Tanggal Berangkat">
            <div v-if="checkError('tanggal_berangkat')" style="color:red">
              <strong>Warning!</strong> @{{ errors.tanggal_berangkat[0] }}.
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Waktu Sampai</label>
            <input type="time" class="form-control" style="border-radius:20px" v-model="waktu_sampai" placeholder="Waktu Sampai">
            <div v-if="checkError('waktu_sampai')" style="color:red">
              <strong>Warning!</strong> @{{ errors.waktu_sampai[0] }}.
            </div>
          </div>
          <div class="col-sm-6">
            <label for="">Tanggal Sampai</label>
            <input type="date" class="form-control" style="border-radius:20px" v-model="tanggal_sampai" placeholder="Tanggal Sampai">
            <div v-if="checkError('tanggal_sampai')" style="color:red">
              <strong>Warning!</strong> @{{ errors.tanggal_sampai[0] }}.
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Harga</label>
            <input type="number" class="form-control" style="border-radius:20px" v-model="harga" placeholder="Harga">
            <div v-if="checkError('harga')" style="color:red">
              <strong>Warning!</strong> @{{ errors.harga[0] }}.
            </div>
          </div>
          <div class="col-sm-6">
            <label for="">Rute Penerbangan</label>
            <select v-model="id_rute" class="form-control" style="border-radius:20px" searchable="Search here..">
              <option v-for="rute in rutes" :value="rute.id_rute">@{{rute.nama_tempat_awal}} (@{{rute.wilayah_awal}}) -> @{{rute.nama_tempat_akhir}} (@{{rute.wilayah_akhir}})</option>
            </select>
            <div v-if="checkError('id_rute')" style="color:red">
              <strong>Warning!</strong> @{{ errors.id_rute[0] }}.
            </div>
          </div>
        </div>

        <button class="btn btn-primary btn-user btn-block ">
          <i class="fas fa-plus"></i>
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal"><i class="fas fa-window-close"></i></button>
      </form>

      <form class="user" method="post" v-on:submit.prevent="update" v-if="ubah">
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Waktu Berangkat</label>
            <input type="time" class="form-control" style="border-radius:20px" v-model="waktu_berangkat" placeholder="Waktu Berangkat">
            <div v-if="checkError('waktu_berangkat')" style="color:red">
              <strong>Warning!</strong> @{{ errors.waktu_berangkat[0] }}.
            </div>
          </div>
          <div class="col-sm-6">
            <label for="">Tanggal Berangkat</label>
            <input type="date" class="form-control" style="border-radius:20px" v-model="tanggal_berangkat" placeholder="Tanggal Berangkat">
            <div v-if="checkError('tanggal_berangkat')" style="color:red">
              <strong>Warning!</strong> @{{ errors.tanggal_berangkat[0] }}.
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Waktu Sampai</label>
            <input type="time" class="form-control" style="border-radius:20px" v-model="waktu_sampai" placeholder="Waktu Sampai">
            <div v-if="checkError('waktu_sampai')" style="color:red">
              <strong>Warning!</strong> @{{ errors.waktu_sampai[0] }}.
            </div>
          </div>
          <div class="col-sm-6">
            <label for="">Tanggal Sampai</label>
            <input type="date" class="form-control" style="border-radius:20px" v-model="tanggal_sampai" placeholder="Tanggal Sampai">
            <div v-if="checkError('tanggal_sampai')" style="color:red">
              <strong>Warning!</strong> @{{ errors.tanggal_sampai[0] }}.
            </div>
          </div>
        </div>

        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Harga</label>
            <input type="number" class="form-control" style="border-radius:20px" v-model="harga" placeholder="Harga">
            <div v-if="checkError('harga')" style="color:red">
              <strong>Warning!</strong> @{{ errors.harga[0] }}.
            </div>
          </div>
          <div class="col-sm-6">
            <label for="">Rute Penerbangan</label>
            <select v-model="id_rute" class="form-control" style="border-radius:20px" searchable="Search here..">
              <option v-for="rute in rutes" :value="rute.id_rute">@{{rute.nama_tempat_awal}} (@{{rute.wilayah_awal}}) -> @{{rute.nama_tempat_akhir}} (@{{rute.wilayah_akhir}})</option>
            </select>
            <div v-if="checkError('id_rute')" style="color:red">
              <strong>Warning!</strong> @{{ errors.id_rute[0] }}.
            </div>
          </div>
        </div>

        <button class="btn btn-primary btn-user btn-block ">
          <i class="fas fa-plus"></i>
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal"><i class="fas fa-window-close"></i></button>
      </form>


      <button class="btn btn-success btn-user btn-block" v-on:click="buat" v-if="buttonBaru">
        <i class="fas fa-plus"></i>
      </button>
      <hr>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Table Jadwal Penerbangan</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Berangkat</th>
                  <th>Sampai</th>
                  <th>Harga</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Berangkat</th>
                  <th>Sampai</th>
                  <th>Harga</th>
                  <th></th>
                </tr>
              </tfoot>
              <tbody>
                <tr v-for="i in jadwalAll">
                    <td>@{{i.nama_tempat_awal}} (@{{i.wilayah_awal}}) on @{{i.waktu_berangkat}} @{{i.tanggal_berangkat}}</td>
                    <td>@{{i.nama_tempat_akhir}} (@{{i.wilayah_akhir}}) on @{{i.waktu_sampai}} @{{i.tanggal_sampai}}</td>
                    <td>@{{i.harga}}</td>
                    <td>
                    <button class="btn btn-primary" type="submit"v-on:click="edit(i.id_jadwal,i.id_rute,i.waktu_berangkat,i.tanggal_berangkat,i.waktu_sampai,i.tanggal_sampai,i.harga,i.rute_awal,i.rute_akhir)">
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
          errors:{},
        },
        beforeMount : function(){
          this.getAll();
      },
        methods : {
          tt : function(){
            var url = "{{route('jadwal_flight_rute')}}";

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText);
                app.errors = {};
	              app.status = this.status;

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
            var url = "{{route('jadwal_flight_search')}}";
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
                  text: "Jadwal Penerbangan yang anda cari tidak ada!",
                  icon: "error",
                  button: "OK",
                });
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
                      text: "Anda telah berhasil menambahkan Jadwal Penerbangan baru!",
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

        getAll : function(){
          var url = "{{route('jadwal_flight_all')}}";
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
          swal({
            title: "Yakin mau hapus Jadwal Penerbangan ini?",
            text: "Jika sudah dihapus, data tidak bisa dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              var url = "/jadwal/";
              var data_token = "?token="+token;
              var data = id_jadwal+"/"+data_token;

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
                    swal("Berhasil! Anda telah menghapus salah satu Jadwal Penerbangan!", {
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
          var url = "/jadwal/";
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
                  text: "Anda telah berhasil mengubah data Jadwal Penerbangan!",
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