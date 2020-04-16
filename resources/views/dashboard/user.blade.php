@extends('user.user')
@section('title','Pemesanan Saya')
@section('header')
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
      <a class="navbar-brand" href="{{route('cc')}}">ANIGATRAVEL</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="{{ route('cc') }}" class="nav-link">Layar Awal</a></li>
          <li class="nav-item"><a href="{{route('pemesanan')}}" class="nav-link">Keranjang</a></li>
          <li class="nav-item active"><a href="{{route('dashboard_user')}}" class="nav-link">Pemesanan Saya</a></li>
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
  <div class="slider-item" style="background-image: url('../../voyage/images/danau toba.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row slider-text align-items-center">
        <div class="col-md-7 col-sm-12 ftco-animate">
          <p class="breadcrumbs"><span class="mr-2"><a href="{{route('cc')}}">Layar Awal</a></span> <span>Riwayat Pemesanan Saya</span></p>
          <h1 class="mb-3">Riwayat Pemesanan Saya</h1>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('content1')
<section style="background-color:#007bff;color:white" class="ftco-section-2" v-if="Detail">
  <div ><h3 class="font font-weight-bold text-center text-uppercase" style="color:#fff">Riwayat Pemesanan Saya</h3></div>
  <div class="container-fluid d-flex">
    <table style="width:100%">
      <tr>
        <td style="width:5%"></td>
        <td style="width:90%">
          <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
              <a href="{{ route('index_menunggu_konfirmasi') }}" style="text-decoration:none">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Menunggu Pembayaran</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{session('konfir_user')}}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <a href="{{ route('index_sudah_konfirmasi') }}" style="text-decoration:none">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sedang Diproses</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{session('konfir_admin')}}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-spinner fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <a href="{{ route('index_sukses') }}" style="text-decoration:none">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sukses</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{session('sukses')}}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-check-double fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
              <a href="{{ route('index_batal') }}" style="text-decoration:none">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Dibatalkan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{session('batal')}}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-times fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
          
          <div>
            @yield('pemesanan')
          </div>
        </td>
        <td style="width:5%"></td>
      </tr>
    </table>
  </div>
</section>

@endsection
      