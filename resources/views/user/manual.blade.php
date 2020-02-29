@extends('user.user')
@section('title','Pemesanan')
@section('header')
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
      <a class="navbar-brand" href="index.html">ANIGATRAVEL</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="{{ route('cc') }}" class="nav-link">Layar Awal</a></li>
        <li class="nav-item active"><a href="{{route('manual')}}" class="nav-link">Manual</a></li>

        @if(session('level')=='user')
        <li class="nav-item"><a href="{{route('pemesanan')}}" class="nav-link">Keranjang</a></li>
        <li class="nav-item"><a href="{{route('dashboard_user')}}" class="nav-link">Pemesanan Saya</a></li>
        @endif

        @if(session('level')==null)
        <li class="nav-item"><a href="{{route('user_login')}}" class="nav-link">Login</a></li>
        <li class="nav-item"><a href="{{route('user_register')}}" class="nav-link">Daftar</a></li>
        @endif

        @if(session('level')=='user')
        <li class="nav-item dropdown no-arrow" id="app12">
          <a class="nav-link dropdown-toggle text-uppercase font-weight-bold" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{session('username')}}
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="{{route('profile')}}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" v-on:click="logout_user">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
              </a>
          </div>
        </li>
        @endif
        
      </ul>
      </div>
  </div>
</nav>
  <!-- END nav -->

  <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url('voyage/images/borobudur2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text align-items-center">
          <div class="col-md-7 col-sm-12 ftco-animate">
            <form class="user" method="post" id="app1" v-on:submit.prevent="login">
              <div class="form-group">
                <input type="text" class="form-control form-control-user" v-model="username" placeholder="Username">
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-user" v-model="password" placeholder="Password">
              </div>

              <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@section('content1')
  <section style="background-color:#007bff;color:white" class="ftco-section-2" id="app3" v-if="ada">
    <div ><h3 class="font font-weight-bold text-center text-uppercase" style="color:#007bff">Login</h3></div>
    <div class="container-fluid d-flex">
    </div>
  </section>
@endsection
@push('js')
    
@endpush