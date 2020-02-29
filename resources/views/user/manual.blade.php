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
        <li class="nav-item active"><a href="{{route('manual')}}" class="nav-link">Panduan</a></li>

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
            <p class="breadcrumbs"><span class="mr-2"><a href="{{ route('cc') }}">Layar Awal</a></span> <span>Panduan</span> <span>Penggunaan</span></p>
          <h1 class="mb-3">Panduan Penggunaan</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@section('content1')
  <section style="background-color:#007bff;color:white;padding:3%;" class="ftco-section-2" id="apppp">
    <div class="container-fluid d-flex">
      <div class="row">
        <div class="col-lg-2">
          <h3 class="text-white">Panduan</h3>
          <div v-if="Login">
            <button v-on:click="login" class="btn-block" style="background-color:#fff;border:2px solid white;color:#007bff" href="">Daftar dan Login</button>
            <button v-on:click="pemesanan" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pemesanan</button>
            <button v-on:click="keranjang" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Keranjang</button>
            <button v-on:click="bayar" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Upload Bukti Pemesanan</button>
            <button v-on:click="proses" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Diproses</button>
            <button v-on:click="sukses" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Sukses</button>
            <button v-on:click="batal" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Dibatalkan</button>
          </div>
          <div v-if="Pemesanan">
            <button v-on:click="login" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Daftar dan Login</button>
            <button v-on:click="pemesanan" class="btn-block" style="background-color:#fff;border:2px solid white;color:#007bff" href="">Pemesanan</button>
            <button v-on:click="keranjang" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Keranjang</button>
            <button v-on:click="bayar" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Upload Bukti Pemesanan</button>
            <button v-on:click="proses" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Diproses</button>
            <button v-on:click="sukses" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Sukses</button>
            <button v-on:click="batal" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Dibatalkan</button>
          </div>
          <div v-if="Keranjang">
            <button v-on:click="login" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Daftar dan Login</button>
            <button v-on:click="pemesanan" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pemesanan</button>
            <button v-on:click="keranjang" class="btn-block" style="background-color:#fff;border:2px solid white;color:#007bff" href="">Keranjang</button>
            <button v-on:click="bayar" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Upload Bukti Pemesanan</button>
            <button v-on:click="proses" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Diproses</button>
            <button v-on:click="sukses" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Sukses</button>
            <button v-on:click="batal" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Dibatalkan</button>
          </div>
          <div v-if="Pembayaran">
            <button v-on:click="login" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Daftar dan Login</button>
            <button v-on:click="pemesanan" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pemesanan</button>
            <button v-on:click="keranjang" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Keranjang</button>
            <button v-on:click="bayar" class="btn-block" style="background-color:#fff;border:2px solid white;color:#007bff" href="">Upload Bukti Pemesanan</button>
            <button v-on:click="proses" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Diproses</button>
            <button v-on:click="sukses" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Sukses</button>
            <button v-on:click="batal" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Dibatalkan</button>
          </div>
          <div v-if="Proses">
            <button v-on:click="login" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Daftar dan Login</button>
            <button v-on:click="pemesanan" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pemesanan</button>
            <button v-on:click="keranjang" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Keranjang</button>
            <button v-on:click="bayar" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Upload Bukti Pemesanan</button>
            <button v-on:click="proses" class="btn-block" style="background-color:#fff;border:2px solid white;color:#007bff" href="">Pesanan Diproses</button>
            <button v-on:click="sukses" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Sukses</button>
            <button v-on:click="batal" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Dibatalkan</button>
          </div>
          <div v-if="Sukses">
            <button v-on:click="login" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Daftar dan Login</button>
            <button v-on:click="pemesanan" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pemesanan</button>
            <button v-on:click="keranjang" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Keranjang</button>
            <button v-on:click="bayar" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Upload Bukti Pemesanan</button>
            <button v-on:click="proses" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Diproses</button>
            <button v-on:click="sukses" class="btn-block" style="background-color:#fff;border:2px solid white;color:#007bff" href="">Pesanan Sukses</button>
            <button v-on:click="batal" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Dibatalkan</button>
          </div>
          <div v-if="Batal">
            <button v-on:click="login" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Daftar dan Login</button>
            <button v-on:click="pemesanan" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pemesanan</button>
            <button v-on:click="keranjang" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Keranjang</button>
            <button v-on:click="bayar" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Upload Bukti Pemesanan</button>
            <button v-on:click="proses" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Diproses</button>
            <button v-on:click="sukses" class="text-white btn-block" style="background-color:#007bff;border:2px solid white;" href="">Pesanan Sukses</button>
            <button v-on:click="batal" class="btn-block" style="background-color:#fff;border:2px solid white;color:#007bff" href="">Pesanan Dibatalkan</button>
          </div>
        </div>
        <div class="col-lg-10">
          <div v-if="Login">
            <h3 class="text-center text-white font-weight-bold">Daftar dan Login</h3>
            <ol>
              <li>
                <p>Sebelum melakukan pemesanan, silahkan daftar dulu dengan pergi ke tab Daftar</p>
                <img src="{{asset('panduan/daftar-tab.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
              <li>
                <p>Lalu isi form pendaftaran</p>
                <img src="{{asset('panduan/daftar-hal.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
              <li>
                <p>Jika sudah punya akun,silahkan Login dengan pergi ke tab Login</p>
                <img src="{{asset('panduan/tab-login.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
              <li>
                <p>Kemudian silahkan isi Username dan Passwordnya sesuai data yang pernah anda masukan</p>
                <img src="{{asset('panduan/hal-login.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
            </ol>
          </div>
          <div v-if="Pemesanan">
            <h3 class="text-center text-white font-weight-bold">Pemesanan</h3>
            <ol>
              <li>
                <p>Untuk Melakukan Pemesanan, silahkan pergi ke halaman utama dan skrol ke bawah</p>
                <img src="{{asset('panduan/pems-skrol.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
              <li>
                <p>Jika ingin memesan tiket pesawat tinggal isi form pencarian jadwal penerbangan</p>
                <img src="{{asset('panduan/pems-p.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
              <li>
                <p>Jika ingin memesan tiket kereta, klik dulu tab kereta lalu isi form pencarian jadwal pemberangkatan</p>
                <img src="{{asset('panduan/pems-t.png')}}" alt="" width="70%" style="border-radius:20px;">
                <img src="{{asset('panduan/pems-t-f.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
              <li>
                <p>Setelah form diisi, silahkan klik cari untuk memulai pencarian</p>
                <img src="{{asset('panduan/pems-t-c.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
              <li>
                <p>Akan muncul alert "Ada" jika jadwal ditemukan dan alert "Maaf" jika jadwal tidak ditemukan</p>
                <img src="{{asset('panduan/pems-t-ok.png')}}" alt="" width="40%" style="border-radius:20px;">
                <img src="{{asset('panduan/pems-t-maaf.png')}}" alt="" width="40%" style="border-radius:20px;">
              </li>
              <li>
                <p>Silahkan ulangi pencarian jadwal jika jadwal tidak ditemukan</p>
              </li>
              <li>
                <p>Jika jadwal telah ditemukan, Pilih jadwal sesuai dengan keinginan</p>
                <img src="{{asset('panduan/pems-pilih.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
              <li>
                <p>Masukan no tiket / no tempat duduk lalu klik pesan</p>
                <img src="{{asset('panduan/pems-kursi.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
              <li>
                <p>Setelah klik tombol pesan akan muncul alert "Opps" berarti anda harus login terlebih dahulu</p>
                <img src="{{asset('panduan/pems-login.png')}}" alt="" width="40%" style="border-radius:20px;">
              </li>
              <li>
                <p>Setelah klik tombol pesan akan muncul alert "Berhasil" berarti anda sudak memesan tiket tersebut, tinggal melanjutkan transaksi. Klik "OK" untuk memesan tiket lagi dan klik "Cancel" untuk melanjutkan transaksi ke Keranjang.</p>
                <img src="{{asset('panduan/pems-berhasil.png')}}" alt="" width="40%" style="border-radius:20px;">
              </li>
              <li>
                <p>Setelah klik tombol pesan akan muncul alert "Opps" berarti tiket yang anda pilih sudah dipesan</p>
                <img src="{{asset('panduan/pems-gagal.png')}}" alt="" width="40%" style="border-radius:20px;">
              </li>
            </ol>
          </div>
          <div v-if="Keranjang">
            <h3 class="text-center text-white font-weight-bold">Keranjang</h3>
            <ol>
              <li>
                <p>Klik tab Keranjang untuk melanjutkan transaksi</p>
                <img src="{{asset('panduan/ker-tab.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
              <li>
                <p>Skrol ke bawah untuk melihat Keranjang</p>
                <img src="{{asset('panduan/ker-hal.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
              <li>
                <p>Setelah muncul keranjang, klik icon hapus untuk membatalkan tiket dan klik "lanjutkan" untuk melanjutkan transaksi</p>
                <img src="{{asset('panduan/ker-ker.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Jika muncul alert "Maaf" berarti anda belum melengkapi profil, silahkan lengkapi dulu dengan mengklik tombol OK</p>
                <img src="{{asset('panduan/ker-maaf.png')}}" alt="" width="40%" style="border-radius:20px;">
              </li>
              <li>
                <p>Jika profil sudah lengkap akan muncul detail pemesanan, silahkan cek lagi. Jika ada kesalahan pada profil atau tiket silahkan perbaiki. Klik "Pesan" jika dirasa profil dan tiket tidak ada kesalahan</p>
                <img src="{{asset('panduan/ker-cek.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Klik tombol OK untuk melakukan pemesanan</p>
                <img src="{{asset('panduan/ker-pesan.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Setelah muncul alert "Berhasil" dan anda akan dialihkan ke halaman pesanan saya</p>
                <img src="{{asset('panduan/ker-selesai.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
            </ol>
          </div>
          <div v-if="Pembayaran">
            <h3 class="text-center text-white font-weight-bold">Upload Bukti Pemesanan</h3>
            <ol>
              <li>
                <p>Setelah selesai melakukan pemesanan, harap upload bukti pemesanan dengan pergi ke tab "Pemesanan Saya" lalu skrol ke bawah untuk melihat opsi lain</p>
                <img src="{{asset('panduan/riw-tab.png')}}" alt="" width="70%" style="border-radius:20px;">
              </li>
              <li>
                <p>Akan ada 4 pilihan seperti gambar dibawah ini, Pilih "Menunggu Pembayaran" untuk melihat pemesanan yang harus dibayar. Pilih "Sedang Diproses" untuk melihat pemesanan yang sedang diproses oleh admin, kita tinggal menunggu sukses. Pilih "Sukses" untuk melihat pemesanan anda yang telah selesai diproses. Pilih "Dibatalkan" untuk melihat pemesanan anda yang dibatalkan oleh admin.</p>
                <img src="{{asset('panduan/riw-ops.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Pilh "Menunggu Pembayaran" untuk mengupload bukti pembayaran, dibawahnya ada angka yang artinya jumlah pesanan yang harus dibayar.</p>
                <img src="{{asset('panduan/riw-tab-pem.png')}}" alt="" width="40%" style="border-radius:20px;"><br>
              </li>
              <li>
                <p>Muncul tabel list pesanan yang harus dibayar, silahkan klik "Konfirmasi" untuk melihat detail pemesanan dan untuk mengupload bukti pemesanan.</p>
                <img src="{{asset('panduan/riw-pem-list.png')}}" alt="" width="100%" style="border-radius:20px;"><br>
              </li>
              <li>
                <p>Silahkan lihat lagi pesanan anda untuk bersiap melakukan transfer dan upload buktinya. Disana tertera nomimal yang harus dibayarkan dan no rekening tujuan. setelah melakukan transfer sesuai dengan ketentuan, silahkan screenshot atau foto bukti pembayarannya dengan Klik tombol "choose file" lalu upload foto bukti pembayaran. setelah dipilih tinggal klik "Upload" untuk memulai upload bukti pembayaran</p>
                <img src="{{asset('panduan/riw-pem-upload.png')}}" alt="" width="100%" style="border-radius:20px;"><br>
              </li>
              <li>
                <p>Anda pun sudah selesai melakukan transaksi, tinggal menunggu konfirmasi dari admin. jika anda salah mengirimkan bukti pembayaran, anda dapat mengubahnya sebelum admin mengkonfirmasi dengan mengikuti panduan setalah ini</p>
              </li>
            </ol>
          </div>
          <div v-if="Proses">
            <h3 class="text-center text-white font-weight-bold">Pesanan Diproses</h3>
            <ol>
              <li>
                <p>Pada tahap ini anda hanya menunggu admin untuk memproses pesanan anda, admin dapat menerima atau membatalkan pesanan anda. Dalam halaman ini anda dapat mengubah bukti pembayaran jika memang dirasa salah menguploadnya. Lakukan sebelum admin mengkonfirmasi pemesanan anda.</p>
              </li>
              <li>
                <p>Buka tab "Sedang Diproses" untuk meihat daftar pesanan anda yang sedang diproses. Angka dibawahnya adalah jumlah pesanan anda yang sedang diproses oleh admin</p>
                <img src="{{asset('panduan/riw-tab-proses.png')}}" alt="" width="40%" style="border-radius:20px;">
              </li>
              <li>
                <p>Setelah muncul list pesanan anda, klik tombol "Periksa" untuk melihat detail pesanan</p>
                <img src="{{asset('panduan/riw-proses-list.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Detail pesanan muncul, silahkan baca dengan seksama pesanan anda. kemudian klik "Lihat Foto" untu kmelihat bukti pembayarn yang telah anda kirimkan sebelumnya.</p>
                <img src="{{asset('panduan/riw-proses-detail.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Anda akan melihat bukti pembayaran yang telah anda upload sebelumnya. silahkan cek, jika benar tinggal tunggu admin menerima pesanan anda. Jika ada yang salah silahkan klik tombol "Kembali" untuk kembali ke Halaman detail pemesaanan.</p>
                <img src="{{asset('panduan/riw-proses-foto.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Silahkan pilih foto kembali dengan "Choose File" lalu upload untuk mengupload ulang bukti pembayaran</p>
                <img src="{{asset('panduan/riw-proses-detail.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Setelah terupload kembali, harap cek ulang untuk memastikan bukti pembayaran benar.</p>
              </li>
              <li>
                <p>Jika dirasa sudah benar semua, tunggu admin mengkonfirmasi pemesanan anda</p>
              </li>
            </ol>
          </div>
          <div v-if="Sukses">
            <h3 class="text-center text-white font-weight-bold">Pemesanan Sukses</h3>
            <ol>
              <li>
                <p>Halaman ini memuat data pemesanan anda yang telah selesai di proses, dan siap untuk print invoice untuk ditukarkan dengan tiket di loket Statsiun/Bandara</p>
              </li>
              <li>
                <p>Pilih "Sukses" dan anda akan diarahkan ke halaman Pesanan Sukses</p>
                <img src="{{asset('panduan/riw-sukses.png')}}" alt="" width="40%" style="border-radius:20px;">
              </li>
              <li>
                <p>Setelah muncul list pesanan anda yang telah sukses, silahkan klik tombol "Lihat" untuk melihat detail pemesanan dan untuk mencetak invoice</p>
                <img src="{{asset('panduan/riw-sukses-list.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Akan Muncul detail pemesanan anda. anda dapat melihat bukti pembayaran dengan mengklik "Lihat Foto". Untuk print invoice silahkan klik "Cetak"</p>
                <img src="{{asset('panduan/riw-sukses-detail.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Ini tampilan ketika anda melihat foto bukti pembayaran</p>
                <img src="{{asset('panduan/riw-sukses-foto.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Ini tampilan ketika anda mengklik "Print", anda dapat langsung print invoicenya ke pdf atau yang lainnya dengan klik tombol "Print" dan "Cancel" jika tidak jadi di print</p>
                <img src="{{asset('panduan/riw-sukses-print.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Untuk tampilan invoicenya ada Identitas anda di sebelah kiri dan Kode pemesanan serta barcodenya di sebelah kanan</p>
                <img src="{{asset('panduan/riw-sukses-invoice1.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Skrol ke bawah untu melihat detail tiket. di sebelah kiri ada Barcode tiket, silahkan scan dengan mesin pencetak tiket di bandara / ststaiun atau anda juga bisa mengetiknya dengan melihat kode tiket yang tertera disebelah kanan barcodenya. dan di paling ujung kanan ada keterangan tempat duduk sesuai tiket dan harganya. di sebelah kanan bawah ada total pembayaran yang anda transfer.</p>
                <img src="{{asset('panduan/riw-sukses-invoice2.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
            </ol>
          </div>
          <div v-if="Batal">
            <h3 class="text-center text-white font-weight-bold">Pemesanan Dibatalkan</h3>
            <ol>
              <li>
                <p>Halaman ini memuat data pemesanan anda yang telah dibatalkan oleh admin</p>
              </li>
              <li>
                <p>Pilih "Dibatalkan" dan anda akan diarahkan ke halaman Pesanan Dibatalkan</p>
                <img src="{{asset('panduan/riw-batal.png')}}" alt="" width="40%" style="border-radius:20px;">
              </li>
              <li>
                <p>Setelah muncul list pesanan anda yang telah dibatalkan, anda akan melihat alasan kenapa admin menolak pesanan anda, silahkan klik tombol "Lihat" untuk melihat detailnya</p>
                <img src="{{asset('panduan/riw-batal-list.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Disini anda hanya bisa melakukan 2 opsi, yaitu melihat bukti pembayaran dan kembali. anda dapat melihat bukti pembayaran dengan mengklik "Lihat Foto"</p>
                <img src="{{asset('panduan/riw-batal-detail.png')}}" alt="" width="100%" style="border-radius:20px;">
              </li>
              <li>
                <p>Anda tidak bisa melakukan apapun ketika pesanan anda dibatalkan oleh admin. anda hanya dapat memesan lagi dengan mengirimkan bukti pembayaran yang sebelumnya atau anda dapat komplain untuk mendapatkan uang anda kembali dengan potongan 5%</p>
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('js')
  <script type="text/javascript">
    var xhttp = new XMLHttpRequest();
    var app = new Vue({
        el: '#apppp',
        data: {
          Login:true,
          Pemesanan:false,
          Keranjang:false,
          Pembayaran:false,
          Proses:false,
          Sukses:false,
          Batal:false,
        },
        methods : {
          login : function(){
            this.Login = true;
            this.Pemesanan = false;
            this.Keranjang = false;
            this.Pembayaran = false;
            this.Proses = false;
            this.Sukses = false;
            this.Batal = false;
          },
          pemesanan : function(){
            this.Login = false;
            this.Pemesanan = true;
            this.Keranjang = false;
            this.Pembayaran = false;
            this.Proses = false;
            this.Sukses = false;
            this.Batal = false;
          },
          keranjang : function(){
            this.Login = false;
            this.Pemesanan = false;
            this.Keranjang = true;
            this.Pembayaran = false;
            this.Proses = false;
            this.Sukses = false;
            this.Batal = false;
          },
          bayar : function(){
            this.Login = false;
            this.Pemesanan = false;
            this.Keranjang = false;
            this.Pembayaran = true;
            this.Proses = false;
            this.Sukses = false;
            this.Batal = false;
          },
          proses : function(){
            this.Login = false;
            this.Pemesanan = false;
            this.Keranjang = false;
            this.Pembayaran = false;
            this.Proses = true;
            this.Sukses = false;
            this.Batal = false;
          },
          sukses : function(){
            this.Login = false;
            this.Pemesanan = false;
            this.Keranjang = false;
            this.Pembayaran = false;
            this.Proses = false;
            this.Sukses = true;
            this.Batal = false;
          },
          batal : function(){
            this.Login = false;
            this.Pemesanan = false;
            this.Keranjang = false;
            this.Pembayaran = false;
            this.Proses = false;
            this.Sukses = false;
            this.Batal = true;
          },
        },
    });
  </script>
@endpush