<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> ANIGATRAVEL - @yield('title') </title> 
  <link rel="icon" href="/storage/images/anigato.png">

  <!-- Custom fonts for this template-->
  <link href="{{ asset('tema/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> --}}

  <!-- Custom styles for this template-->
  <link href="{{ asset('tema/css/sb-admin-2.min.css') }}" rel="stylesheet">

  {{-- <script src="{{ asset('sweetalert/src/sweetalert.css') }}"></script> --}}
  <style>
    .swal-overlay {
      background-color: rgba(50, 165, 137, 0.45);
    }
    .tombol {
      width:100%;
      background-color: Transparent;
      background-repeat:no-repeat;
      border: none;
      cursor:pointer;
      overflow: hidden;
    }
    .input-container {
      display: -ms-flexbox; /* IE10 */
      display: flex;
      width: 100%;
      margin-bottom: 15px;
    }

    .icon {
      padding: 10px;
      background: dodgerblue;
      color: white;
      min-width: 50px;
      text-align: center;
    }

    .input-field {
      width: 100%;
      padding: 10px;
      outline: none;
    }

    .input-field:focus {
      border: 2px solid dodgerblue;
    }
  </style>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('admin/sidebar')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('admin/header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('admin/footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('tema/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('tema/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('tema/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('tema/js/sb-admin-2.min.js') }}"></script>
  <script src="{{ asset('tema/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('sweetalert/docs/assets/sweetalert/sweetalert.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('js/vue.js') }}"></script>
  <script type="text/javascript">
    var xhttp = new XMLHttpRequest();
    var token = "<?= session('token') ?>";

    var app = new Vue({
        el: '#app12',
        methods : {
          logout_admin : function(){
            swal({
              title: "Yakin mau logout sekarang?",
              text: "Nanti harus login lagi loh!",
              icon: "info",
              buttons: true,
              dangerMode: true,
            })
            .then((logot) => {
              if (logot) {
                  var url = "{{route('logot')}}";
                  var data='?token='+token;

                  xhttp.onreadystatechange = function() {
                      if (this.readyState == 4) {
                        console.log(this.status,this.responseText)
                        if (this.status == 200) {
                          swal({
                            title: "Berhasil",
                            text: "Anda berhasil logout!",
                            icon: "success",
                            button: false,
                          });
                          window.location.replace("{{route('user_login')}}");
                          // window.location.replace("{{route('admin_login')}}");
                        }
                      }
                    }
                  xhttp.open("GET", url+data, true);
                  xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
                  xhttp.send();
              } else {
                swal({
                  title: "Mantap!",
                  text: "Tidak jadi logout sekarang",
                });
              }
            });
          },
          logout_user : function(){
            swal({
              title: "Yakin mau logout sekarang?",
              text: "Nanti harus login lagi loh!",
              icon: "info",
              buttons: true,
              dangerMode: true,
            })
            .then((logot) => {
              if (logot) {
                  var url = "{{route('user_logot')}}";
                  var data='?token='+token;

                  xhttp.onreadystatechange = function() {
                      if (this.readyState == 4) {
                        console.log(this.status,this.responseText)
                        if (this.status == 200) {
                          swal({
                            title: "Berhasil",
                            text: "Anda berhasil logout!",
                            icon: "success",
                            button: false,
                          });
                          window.location.replace("{{route('user_login')}}");
                        }
                      }
                    }
                  xhttp.open("GET", url+data, true);
                  xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
                  xhttp.send();
              } else {
                swal({
                  title: "Mantap!",
                  text: "Tidak jadi logout sekarang",
                });
              }
            });
          }
        }
      });

  </script>
  @stack('js')


</body>

</html>
