@extends('admin.admin')
@section('title','Dashboard')
@section('proses')
  <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="{{route('konfirmasi_admin_index')}}">
      <i class="fas fa-bell fa-fw"></i>
      <!-- Counter - Alerts -->
      <span class="badge badge-danger badge-counter">{{$proses}}</span>
    </a>
  </li>
@endsection
@section('content')
  <div id="content" id="app">

    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard admin</h1>
        <a target="blank" href="{{ route('export_admin') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
      </div>

      <!-- Content Row -->
      <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Petugas</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $petugas }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah User</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $user }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-users fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="{{ route('konfirmasi_user_index') }}" style="text-decoration:none">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pesanan Baru</div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $baru }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <a href="{{ route('konfirmasi_admin_index') }}" style="text-decoration:none">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pesanan Untuk Diproses</div>
                  <div class="h5 mb-0 font-weight-bold text-gray-800">{{$proses}}</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-exclamation fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>

      <!-- Content Row -->

      <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Penjualan Tiket 4 Minggu Terakhir</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="chart-area">
                <canvas id="earning"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Total Penjualan Tiket</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="chart-pie pt-4 pb-2">
                <canvas id="tiket"></canvas>
              </div>
              <div class="mt-4 text-center small">
                <span class="mr-2">
                  <i class="fas fa-circle text-primary"></i> Pesawat
                </span>
                <span class="mr-2">
                  <i class="fas fa-circle text-success"></i> Kereta
                </span>
                <span class="mr-2">
                  <i class="fas fa-circle text-info"></i> Total
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Content Row -->
      <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

          <!-- Project Card Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
            </div>
            <div class="card-body">
              <h4 class="small font-weight-bold">Pesanan Baru <span class="float-right">{{number_format($perbaru,2)}}%</span></h4>
              <div class="progress mb-4">
                <div class="progress-bar bg-info" role="progressbar" style="width: {{$perbaru}}%" aria-valuenow="{{$perbaru}}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <h4 class="small font-weight-bold">Perlu Diproses <span class="float-right">{{number_format($perproses,2)}}%</span></h4>
              <div class="progress mb-4">
                <div class="progress-bar bg-warning" role="progressbar" style="width: {{$perproses}}%" aria-valuenow="{{$perproses}}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <h4 class="small font-weight-bold">Sukses <span class="float-right">{{number_format($persukses,2)}}%</span></h4>
              <div class="progress mb-4">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{$persukses}}%" aria-valuenow="{{$persukses}}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <h4 class="small font-weight-bold">Batal <span class="float-right">{{number_format($perbatal,2)}}%</span></h4>
              <div class="progress mb-4">
                <div class="progress-bar bg-danger" role="progressbar" style="width: {{$perbatal}}%" aria-valuenow="{{$perbatal}}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <h4 class="small font-weight-bold">Total <span class="float-right">100%</span></h4>
              <div class="progress mb-4">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6 mb-4">
          <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Total Pendapatan 4 Minggu Terakhir</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <div class="chart-area">
                <canvas id="total"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->

  </div>
@endsection
@push('js')
  <script type="text/javascript">
    var ctx = document.getElementById('tiket');
    var tiket = new Chart(ctx,{
      type:'doughnut',
      data: {
        labels: ["Pesawat", "Kereta", "Total"],
        datasets: [{
          data: [{!! json_encode($tiket_pesawat) !!}, {!! json_encode($tiket_kereta) !!}, {!! json_encode($total_tiket) !!}],
          backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
          hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(3, 144, 252)",
          bodyFontColor: "#fff",
          borderColor: '#fff',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });

    var ctx = document.getElementById('earning');
    var earning = new Chart(ctx,{
      type:'line',
      data: {
        labels:['Minggu 1','Minggu 2','Minggu 3','Minggu 4'],
        datasets:[
          {
            label: "Pesawat",
            backgroundColor:"rgba(17, 205, 212,0.31)",
            borderColor:"rgba(17, 205, 212,0.7)",
            PointBorderColor:"rgba(10, 136, 140,0.7)",
            pointBackgroundColor:"rbga(17, 205, 212,0.7)",
            pointHoverBackgroundColor:"rgba(0, 247, 255,1)",
            pointHoverBorderColor:"rgba(0, 247, 255,1)",
            pointBorderWidth:1,
            data:[{!! json_encode($p_4) !!},{!! json_encode($p_3) !!},{!! json_encode($p_2) !!},{!! json_encode($p_1) !!}],
          },{
            label: "Kereta",
            backgroundColor:"rgba(34, 201, 22,0.31)",
            borderColor:"rgba(34, 201, 22,0.7)",
            PointBorderColor:"rgba(8, 125, 0,0.7)",
            pointBackgroundColor:"rbga(34, 201, 22,0.7)",
            pointHoverBackgroundColor:"rgba(16, 255, 0,1)",
            pointHoverBorderColor:"rgba(16, 255, 0,1)",
            pointBorderWidth:1,
            data:[{!! json_encode($k_4) !!},{!! json_encode($k_3) !!},{!! json_encode($k_2) !!},{!! json_encode($k_1) !!}],
          },{
            label: "Total",
            backgroundColor:"rgba(0, 79, 189,0.31)",
            borderColor:"rgba(0, 79, 189,0.7)",
            PointBorderColor:"rgba(1, 62, 145,0.7)",
            pointBackgroundColor:"rbga(0, 79, 189,0.7)",
            pointHoverBackgroundColor:"rgba(5, 111, 255,1)",
            pointHoverBorderColor:"rgba(5, 111, 255,1)",
            pointBorderWidth:1,
            data:[{!! json_encode($t_4) !!},{!! json_encode($t_3) !!},{!! json_encode($t_2) !!},{!! json_encode($t_1) !!}],
          },
        ]
      },
      options: {
        maintainAspectRatio: false,
        scales: {
          xAxes: [{
            time: {
              unit: 'month'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 6
            },
            maxBarThickness: 25,
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        tooltips: {
          titleMarginBottom: 10,
          titleFontColor: '#fff',
          titleFontSize: 14,
          backgroundColor: "rgb(3, 144, 252)",
          bodyFontColor: "#fff",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
      }
    });

    var ctx = document.getElementById("total");
    var total = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Minggu 1","Minggu 2","Minggu 3","Minggu 4"],
        datasets: [{
          label: "Earnings",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.05)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: [{!! json_encode($e_4) !!}, {!! json_encode($e_3) !!}, {!! json_encode($e_2) !!}, {!! json_encode($e_1) !!}],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
        }
      }
    });

  </script>
@endpush