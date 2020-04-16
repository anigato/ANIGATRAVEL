<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <img src="/storage/images/anigato.png" class="img-profile rounded" alt="" style="transform: rotate(14deg);" width="100%">
    </div>
    <div class="sidebar-brand-text mx-3">ANIGATRAVEL</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  @if(session('level')=='admin'||session('level')=='operator')
  <li class="nav-item">
    <a class="nav-link" href="{{route('dashboard_admin')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  @endif
  


  <!-- Nav Item - Pages Collapse Menu -->
  @if(session('level')=='admin')

    <li class="nav-item">
      <a class="nav-link" href="{{route('user_page')}}">
        <i class="fas fa-fw fa-user-tie"></i>
        <span>Petugas</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#driver" aria-expanded="true" aria-controls="driver">
        <i class="fas fa-fw fa-biking"></i>
        <span>Pengemudi</span>
      </a>
      <div id="driver" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Choose</h6>
          <a class="collapse-item" href="{{route('driver_page_flight')}}"><i class="fas fa-fw fa-plane"></i> Pilot</a>
          <a class="collapse-item" href="{{route('driver_page_train')}}"><i class="fas fa-fw fa-subway"></i> Masinis</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transportasi" aria-expanded="true" aria-controls="transportasi">
        <i class="fas fa-fw fa-paper-plane"></i>
        <span>Transportasi</span>
      </a>
      <div id="transportasi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Choose</h6>
          <a class="collapse-item" href="{{route('transportasi_flight')}}"><i class="fas fa-fw fa-plane"></i> Pesawat</a>
          <a class="collapse-item" href="{{route('transportasi_train')}}"><i class="fas fa-fw fa-subway"></i> Kereta</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#tempat" aria-expanded="true" aria-controls="tempat">
        <i class="fas fa-fw fa-city"></i>
        <span>Tempat</span>
      </a>
      <div id="tempat" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Choose</h6>
          <a class="collapse-item" href="{{route('tempat_flight')}}"><i class="fas fa-fw fa-plane"></i> Bandara</a>
          <a class="collapse-item" href="{{route('tempat_train')}}"><i class="fas fa-fw fa-subway"></i> Satsiun</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('transportasi_tipe_flight')}}">
        <i class="fas fa-fw fa-wheelchair"></i>
        <span>Tipe Transportasi</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#rute" aria-expanded="true" aria-controls="rute">
        <i class="fas fa-fw fa-road"></i>
        <span>rute</span>
      </a>
      <div id="rute" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Choose</h6>
          <a class="collapse-item" href="{{route('rute_for_flight')}}"><i class="fas fa-fw fa-plane"></i> Pesawat</a>
          <a class="collapse-item" href="{{route('rute_for_train')}}"><i class="fas fa-fw fa-subway"></i> Kereta</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#jadwal" aria-expanded="true" aria-controls="jadwal">
        <i class="fas fa-fw fa-calendar-alt"></i>
        <span>Jadwal</span>
      </a>
      <div id="jadwal" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Choose</h6>
          <a class="collapse-item" href="{{route('jadwal_flight')}}"><i class="fas fa-fw fa-plane"></i> Pesawat</a>
          <a class="collapse-item" href="{{route('jadwal_train')}}"><i class="fas fa-fw fa-subway"></i> Kereta</a>
        </div>
        <div>
          balalala
        </div>
      </div>
    </li>

    {{-- <li class="nav-item">
      <a class="nav-link" href="{{route('diskon')}}">
        <i class="fas fa-fw fa-percent"></i>
        <span>Diskon</span></a>
    </li> --}}

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi" aria-expanded="true" aria-controls="transaksi">
        <i class="fas fa-fw fa-store"></i>
        <span>Transactions</span>
      </a>
      <div id="transaksi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Choose</h6>
          <a class="collapse-item" href="{{route('konfirmasi_user_index')}}">Menunggu Pembayaran</a>
          <a class="collapse-item" href="{{route('konfirmasi_admin_index')}}">Perlu diproses</a>
          <a class="collapse-item" href="{{route('sukses_index')}}">Sukses</a>
          <a class="collapse-item" href="{{route('dibatalkan_index')}}">Dibatalkan</a>
        </div>
      </div>
    </li>

  @endif

  @if(session('level')=='operator')
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#rute" aria-expanded="true" aria-controls="rute">
        <i class="fas fa-fw fa-road"></i>
        <span>rute</span>
      </a>
      <div id="rute" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Choose</h6>
          <a class="collapse-item" href="{{route('rute_for_flight')}}"><i class="fas fa-fw fa-plane"></i> Pesawat</a>
          <a class="collapse-item" href="{{route('rute_for_train')}}"><i class="fas fa-fw fa-subway"></i> Kereta</a>
        </div>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#jadwal" aria-expanded="true" aria-controls="jadwal">
        <i class="fas fa-fw fa-calendar-alt"></i>
        <span>Jadwal</span>
      </a>
      <div id="jadwal" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Choose</h6>
          <a class="collapse-item" href="{{route('jadwal_flight')}}"><i class="fas fa-fw fa-plane"></i> Pesawat</a>
          <a class="collapse-item" href="{{route('jadwal_train')}}"><i class="fas fa-fw fa-subway"></i> Kereta</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#transaksi" aria-expanded="true" aria-controls="transaksi">
        <i class="fas fa-fw fa-store"></i>
        <span>Transactions</span>
      </a>
      <div id="transaksi" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Choose</h6>
          <a class="collapse-item" href="{{route('konfirmasi_user_index')}}">Menunggu Pembayaran</a>
          <a class="collapse-item" href="{{route('konfirmasi_admin_index')}}">Perlu diproses</a>
          <a class="collapse-item" href="{{route('sukses_index')}}">Sukses</a>
          <a class="collapse-item" href="{{route('dibatalkan_index')}}">Dibatalkan</a>
        </div>
      </div>
    </li>
  @endif  <!--  -->

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>