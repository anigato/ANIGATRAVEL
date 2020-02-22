<nav  class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('cc') }}">ANIGATO</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{ route('cc') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="rooms.html" class="nav-link">Rooms</a></li>
                <li class="nav-item"><a href="restaurant.html" class="nav-link">Restaurant</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                <li class="nav-item dropdown no-arrow" id="app12">
                    <a class="nav-link dropdown-toggle text-uppercase font-weight-bold" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{session('username')}}
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        @if(session('level')=='user')
                        <a class="dropdown-item" href="{{route('profile')}}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        @endif
                        @if(session('level')=='user')
                        <a class="dropdown-item" v-on:click="logout_user">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                        </a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->

<section class="home-slider owl-carousel">
<div class="slider-item" style="background-image:url(deluxe/images/bg_1.jpg);">
    <div class="overlay"></div>
    <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
    <div class="col-md-12 ftco-animate text-center">
        <div class="text mb-5 pb-3">
            <div style="background-color:rgba(0,0,0,0.5);border-radius:10px;">
                <h1 class="mb-3">Selamat Datang di ANIGATRAVVEL</h1>
            </div>
            <div style="background-color:rgba(0,0,0,0.5);border-radius:10px;">
                <h2>Tiket Pesawat &amp; Tiket Kereta</h2>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
<div class="slider-item" style="background-image:url(deluxe/images/bg_2.jpg);">
    <div class="overlay"></div>
    <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
    <div class="col-md-12 ftco-animate text-center">
        <div class="text mb-5 pb-3">
            <div style="background-color:rgba(0,0,0,0.5);border-radius:10px;">
                <h1 class="mb-3">Nikmati Perjalanan Anda</h1>
            </div>
            <div style="background-color:rgba(0,0,0,0.5);border-radius:10px;">
                <h2>Gabung Bersama Kami</h2>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
</section>

<section class="ftco-booking">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form action="#" class="booking-form">
                    <div class="row">
                        <div class="col-md-4 d-flex">
                            <div class="form-group p-4 align-self-stretch d-flex align-items-end">
                                <div class="wrap">
                                    <label for="#">Berangkat</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="" id="" class="form-control">
                                                <option value="">Suite</option>
                                                <option value="">Family Room</option>
                                                <option value="">Deluxe Room</option>
                                                <option value="">Classic Room</option>
                                                <option value="">Superior Room</option>
                                                <option value="">Luxury Room</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex">
                            <div class="form-group p-4 align-self-stretch d-flex align-items-end">
                                <div class="wrap">
                                    <label for="#">Sampai</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="" id="" class="form-control">
                                                <option value="">Suite</option>
                                                <option value="">Family Room</option>
                                                <option value="">Deluxe Room</option>
                                                <option value="">Classic Room</option>
                                                <option value="">Superior Room</option>
                                                <option value="">Luxury Room</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 d-flex">
                            <div class="form-group p-4 align-self-stretch d-flex align-items-end">
                                <div class="wrap">
                                        <label for="#">Tanggal Penerbangan</label>
                                        <input type="text" class="form-control checkout_date" placeholder="Check-out date">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md d-flex">
                            <div class="form-group p-4 align-self-stretch d-flex align-items-end">
                                <div class="wrap">
                                    <label for="#">Room</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="" id="" class="form-control">
                                                <option value="">Suite</option>
                                                <option value="">Family Room</option>
                                                <option value="">Deluxe Room</option>
                                                <option value="">Classic Room</option>
                                                <option value="">Superior Room</option>
                                                <option value="">Luxury Room</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex">
                            <div class="form-group p-4 align-self-stretch d-flex align-items-end">
                                <div class="wrap">
                                    <label for="#">Customer</label>
                                    <div class="form-field">
                                        <div class="select-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="" id="" class="form-control">
                                                <option value="">1 Adult</option>
                                                <option value="">2 Adult</option>
                                                <option value="">3 Adult</option>
                                                <option value="">4 Adult</option>
                                                <option value="">5 Adult</option>
                                                <option value="">6 Adult</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md d-flex">
                            <div class="form-group d-flex align-self-stretch">
                                <button type="submit" class="btn btn-primary py-3 px-4 align-self-stretch">
                                    <i class="fas fa-search"></i> Cari Penerbangan
                                </button>
                                <input type="submit" value="Check Availability" class="btn btn-primary py-3 px-4 align-self-stretch">
                            </div>
                        </div> --}}
                    </div>
                    <div class="form-group"></div>
                    <div class="col-md d-flex">
                        <div class="form-group d-flex align-self-stretch">
                            <button type="submit" class="btn btn-primary py-3 px-4 align-self-stretch">
                                <i class="fas fa-search"></i> Cari Penerbangan
                            </button>
                            {{-- <input type="submit" value="Check Availability" class="btn btn-primary py-3 px-4 align-self-stretch"> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>