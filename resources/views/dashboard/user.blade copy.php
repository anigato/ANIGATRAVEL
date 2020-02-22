@extends('admin.admin')
@section('title','Riwayat Pemesanan')
@section('content')
<div id="content">
  <div class="container-fluid">
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
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Dibatalkan</div>
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
  </div>
</div>
@endsection
      