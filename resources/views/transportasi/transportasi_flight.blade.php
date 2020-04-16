@extends('admin.admin')
@section('title','Daftar Pesawat')
@section('content')
    <!-- Begin Page Content -->
    <div id="app3" class="container-fluid">
      <!-- Page Heading -->
      <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" v-on:submit.prevent="find" method="get">
        <div class="input-group">
          <input type="text" class="form-control bg-light border-0 small" placeholder="Cari Pesawat" aria-label="Search" aria-describedby="basic-addon2" v-model="cari" @keyup="find">
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
          <label for="">Jumlah Kursi</label>
          <input type="number" class="form-control" style="border-radius:20px" required v-model="jumlah_kursi" placeholder="Jumlah Kursi">
          <div v-if="checkError('jumlah_kursi')" style="color:red">
            <strong>Warning!</strong> @{{ errors.jumlah_kursi[0] }}.
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Kelas</label>
            <select v-model="keterangan" class="form-control" style="border-radius:20px" required>
              <option value="Ekonomi">Ekonomi</option>
              <option value="Eksekutif">Eksekutif</option>
              <option value="Bisnis">Bisnis</option>
            </select>
            <div v-if="checkError('keterangan')" style="color:red">
              <strong>Warning!</strong> @{{ errors.keterangan[0] }}.
            </div>
          </div>
          <div class="col-sm-6">
            <label for="">Pesawat</label>
            <select v-model="id_type_transportasi" class="form-control" style="border-radius:20px" required searchable="Search here..">
              <option v-for="tipe in tipes" v-bind:value="tipe.id_type_transportasi">@{{tipe.nama_type}} @{{tipe.keterangan}}</option>
            </select>
            <div v-if="checkError('id_type_transportasi')" style="color:red">
              <strong>Warning!</strong> @{{ errors.id_type_transportasi[0] }}.
            </div>
          </div>
        </div>

        <button class="btn btn-primary btn-user btn-block ">
          <i class="fas fa-plus"></i> Tambahkan
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal">
          <i class="fas fa-window-close"></i> Batal
        </button>
      </form>

      <form class="user" method="post" v-on:submit.prevent="update" v-if="ubah">
        <div class="form-group row">
          <label for="">Jumlah Kursi</label>
          <input type="number" class="form-control" style="border-radius:20px" required v-model="jumlah_kursi" placeholder="Jumlah Kursi">
          <div v-if="checkError('jumlah_kursi')" style="color:red">
            <strong>Warning!</strong> @{{ errors.jumlah_kursi[0] }}.
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-6 mb-3 mb-sm-0">
            <label for="">Kelas</label>
            <select v-model="keterangan" class="form-control" style="border-radius:20px" required>
              <option value="Ekonomi">Ekonomi</option>
              <option value="Eksekutif">Eksekutif</option>
              <option value="Bisnis">Bisnis</option>
            </select>
            <div v-if="checkError('keterangan')" style="color:red">
              <strong>Warning!</strong> @{{ errors.keterangan[0] }}.
            </div>
          </div>
          <div class="col-sm-6">
            <label for="">Pesawat</label>
            <select v-model="id_type_transportasi" class="form-control" style="border-radius:20px" required searchable="Search here..">
              <option v-for="tipe in tipes" v-bind:value="tipe.id_type_transportasi">@{{tipe.nama_type}} @{{tipe.keterangan}}</option>
            </select>
            <div v-if="checkError('id_type_transportasi')" style="color:red">
              <strong>Warning!</strong> @{{ errors.id_type_transportasi[0] }}.
            </div>
          </div>
        </div>

        <button class="btn btn-primary btn-user btn-block ">
          <i class="fas fa-plus"></i> Ubah
        </button>
        <button class="btn btn-danger btn-user btn-block" v-on:click="batal">
          <i class="fas fa-window-close"></i> Batal
        </button>
      </form>


      <button class="btn btn-success btn-user btn-block" v-on:click="buat" v-if="buttonBaru">
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
                  <th>Kode</th>
                  <th>Jumlah Kursi</th>
                  <th>Kelas</th>
                  <th>Pesawat</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Kode</th>
                  <th>Jumlah Kursi</th>
                  <th>Kelas</th>
                  <th>Pesawat</th>
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
          errors:{},
        },
        beforeMount : function(){
          this.getAll();
      },
        methods : {
          type : function(){
            var url = "{{route('type_flight')}}";

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
                app.tipes = JSON.parse(this.responseText);
              }
            }
          }
          xhttp.open("GET",url, true);
          xhttp.setRequestHeader("X-CSRF-TOKEN","{{ csrf_token() }}");
          xhttp.send();
          },
          find : function(){
            var url = "{{route('transportasi_search_flight')}}";
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
        checkError : function(key){
          return this.errors.hasOwnProperty(key);
        },

        getAll : function(){
          var url = "{{route('transportasi_all_flight')}}";
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
          swal({
            title: "Yakin mau hapus Pesawat ini?",
            text: "Jika sudah dihapus, data tidak bisa dikembalikan!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              var url = "/transportasi/";
              var data_token = "?token="+token;
              var data = id_transportasi+"/"+data_token;

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
                    swal({
                      title: "Berhasil!",
                      text: "Anda telah berhasil menghapus salah satu Pesawat!",
                      icon: "success",
                      button: "OK",
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
          var url = "/transportasi/";
          var data_token = "?token="+token;
          var data = this.id_transportasi+"/"+data_token
            +"&kode="+this.kode
            +"&keterangan="+this.keterangan
            +"&jumlah_kursi="+this.jumlah_kursi
            +"&id_type_transportasi="+this.id_type_transportasi
            ;

          xhttp.onreadystatechange = function(){
            if (this.readyState == 4) {
              console.log(this.status,this.responseText);
              app.errors = {};
	            app.status = this.status;

              if (this.status == 422) {
                alert('Invalid_transportasi Field')
              }
              if (this.status == 401) {
                app.errors= JSON.parse(this.responseText);
              }
              if (this.status == 200) {
                app.getAll();
                app.batal();
                swal({
                  title: "Berhasil!",
                  text: "Anda telah berhasil mengubah salah satu Pesawat!",
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