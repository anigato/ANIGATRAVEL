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
            <li class="nav-item active"><a href="{{route('pemesanan')}}" class="nav-link">Keranjang</a></li>
            <li class="nav-item"><a href="{{route('dashboard_user')}}" class="nav-link">Pemesanan Saya</a></li>
            <li class="nav-item"><a href="{{route('manual')}}" class="nav-link">Manual</a></li>
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
            <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Layar Awal</a></span> <span>Keranjang</span></p>
            <h1 class="mb-3">Keranjang</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@section('content1')
  <section style="background-color:#007bff;color:white" class="ftco-section-2" id="app3" v-if="ada">
    <div ><h3 class="font font-weight-bold text-center text-uppercase" style="color:#fff">Keranjang</h3></div>
    <div class="container-fluid d-flex">
      balalala
    </div>
  </section>
@endsection