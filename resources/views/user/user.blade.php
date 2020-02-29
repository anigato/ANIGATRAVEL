    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>ANIGATRAVEL</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link href="https://fonts.googleapis.com/css?family=Muli:300,400,600,700" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('voyage/css/open-iconic-bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('voyage/css/animate.css')}}">
        
        <link rel="stylesheet" href="{{asset('voyage/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('voyage/css/owl.theme.default.min.css')}}">
        <link rel="stylesheet" href="{{asset('voyage/css/magnific-popup.css')}}">

        <link rel="stylesheet" href="{{asset('voyage/css/aos.css')}}">

        <link rel="stylesheet" href="{{asset('voyage/css/ionicons.min.css')}}">

        <link rel="stylesheet" href="{{asset('voyage/css/bootstrap-datepicker.css')}}">
        <link rel="stylesheet" href="{{asset('voyage/css/jquery.timepicker.css')}}">

        
        <link rel="stylesheet" href="{{asset('voyage/css/flaticon.css')}}">
        <link rel="stylesheet" href="{{asset('voyage/css/icomoon.css')}}">
        <link rel="stylesheet" href="{{asset('voyage/css/style.css')}}">
        <link href="{{ asset('tema/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <body>
        @yield('header')
        <!-- END slider -->

        @yield('content1')

        <section style="background-color:#007bff;color:white" class="ftco-section-2" id="app3" v-if="ada">
            <div ><h3 class="font font-weight-bold text-center text-uppercase" style="color:#007bff">Login</h3></div>
            <div class="container-fluid d-flex">
            </div>
        </section>

        {{-- @include('user.content3')

        @include('user.content4')

        @include('user.content5') --}}

        @include('user.footer')
        
    

    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


    <script src="{{asset('voyage/js/jquery.min.js')}}"></script>
    <script src="{{asset('voyage/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('voyage/js/popper.min.js')}}"></script>
    <script src="{{asset('voyage/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('voyage/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('voyage/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('voyage/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('voyage/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('voyage/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('voyage/js/aos.js')}}"></script>
    <script src="{{asset('voyage/js/jquery.animateNumber.min.js')}}"></script>
    <script src="{{asset('voyage/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('voyage/js/jquery.timepicker.min.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{asset('voyage/js/google-map.js')}}"></script>
    <script src="{{asset('voyage/js/main.js')}}"></script>
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
                            window.location.replace("{{route('admin_login')}}");
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