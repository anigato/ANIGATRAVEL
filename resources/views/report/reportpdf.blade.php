@extends('report.master')
@section('content')
    <div id="invoice">
        {{-- <div class="toolbar hidden-print">
            <div class="text-right">
                <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            </div>
            <hr>
        </div> --}}
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <img src="/storage/images/anigato.png" alt="" width="20%" data-holder-rendered="true" />
                        </div>
                        <div class="col company-details text-dark">
                            <h2 class="name font-weight-bold text-info">ANIGATRAVEL</h2>
                            <div>Padaherang, Pangandaran, Jawa Barat 46384</div>
                            <div>0852 1066 5025</div>
                            <div><a class="text-info" style="text-decoration:none;" href="mailto:anigato.net@gmail.com">anigato.net@gmail.com</a></div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="row">
                                <div class="col-lg-12">
                                    <table style="width:100%;">
                                        @foreach ($user as $u)
                                        <tr>
                                            <td style="width:20%;" class="font-weight-bold"><h4>Nama</h4></td>
                                            <td style="width:2%;">:</td>
                                            <td style="width:78%" class="font to"><h4>{{ $u->nm }}</h4></td>
                                            <td rowspan="6">
                                                <div class="col invoice-details text-center">
                                                    @foreach ($gt as $t)
                                                    <h1 style="position: relative;right:0%;z-index: 2;" class="invoice-id font font-weight-bold">{{ $t->kode_pemesanan }}</h1>
                                                    <div style="position: relative;z-index: 1;top: -15%;">{!! QrCode::size(250)->generate($t->kode_pemesanan); !!}</div>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:20%;" class="font-weight-bold"><h4>KTP</h4></td>
                                            <td style="width:2%;">:</td>
                                            <td style="width:78%" class="font to"><h4>{{ $u->no_ktp }}</h4></td>
                                        </tr>
                                        <tr>
                                            <td style="width:20%;" class="font-weight-bold"><h4>Alamat</h4></td>
                                            <td style="width:2%;">:</td>
                                            <td style="width:78%" class="font address"><h4>{{ $u->almt }}</h4></td>
                                        </tr>
                                        <tr>
                                            <td style="width:20%;" class="font-weight-bold"><h4>Telepon</h4></td>
                                            <td style="width:2%;">:</td>
                                            <td style="width:78%" class="font email"><h4>{{ $u->telp }}</h4></td>
                                        </tr>
                                        <tr>
                                            <td style="width:20%;" class="font-weight-bold"><h4>Email</h4></td>
                                            <td style="width:2%;">:</td>
                                            <td style="width:78%" class="font email"><h4><a class="text-info" style="text-decoration:none;" href="mailto:{{ $u->email }}">{{ $u->email }}</a></h4></td>
                                        </tr>
                                        @endforeach
                                        @foreach ($gt as $t)
                                        <tr>
                                            <td style="width:20%;" class="font-weight-bold"><h4>Tanggal Pesan</h4></td>
                                            <td style="width:2%;">:</td>
                                            <td style="width:78%" class="date"><h4>{{ $t->created_at }}</h4></td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="font-weight-bold"><h4>Nama</h4></div>
                                            <div class="font-weight-bold"><h4>KTP</h4></div>
                                            <div class="font-weight-bold"><h4>Alamat</h4></div>
                                            <div class="font-weight-bold"><h4>Telepon</h4></div>
                                            <div class="font-weight-bold"><h4>Email</h4></div>
                                            <div class="font-weight-bold"><h4>Tanggal Pesan</h4></div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div><h4>:</h4></div>
                                            <div><h4>:</h4></div>
                                            <div><h4>:</h4></div>
                                            <div><h4>:</h4></div>
                                            <div><h4>:</h4></div>
                                            <div><h4>:</h4></div>
                                        </div>
                                        <div class="col-sm-6 text-dark">
                                            @foreach ($user as $u)
                                            <div class="font to"><h4>{{ $u->nm }}</h4></div>
                                            <div class="font to"><h4>{{ $u->no_ktp }}</h4></div>
                                            <div class="font address"><h4>{{ $u->almt }}</h4></div>
                                            <div class="font email"><h4>{{ $u->telp }}</h4></div>
                                            <div class="font email"><h4><a class="text-info" style="text-decoration:none;" href="mailto:{{ $u->email }}">{{ $u->email }}</a></h4></div>
                                            @endforeach
                                            @foreach ($gt as $t)
                                            <div class="date"><h4>{{ $t->created_at }}</h4></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2"></div>
                                <div class="col-sm-5">
                                    <div class="row">
                                        <div class="col-sm-12 col invoice-details">
                                            @foreach ($gt as $t)
                                            <h1 style="position: relative;right:0%;z-index: 2;" class="invoice-id">{{ $t->kode_pemesanan }}</h1>
                                            <div style="position: relative;z-index: 1;top: -15%;">{!! QrCode::size(250)->generate($t->kode_pemesanan); !!}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div style="position: relative;z-index: 2;top: -15%">
                        <h3 class="font-weight-bold text-info">Detail Tiket</h3>
                        <table cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th>BARCODE TIKET</th>
                                    <th class="text-left">KODE TIKET</th>
                                    <th class="text-left">DETAIL TIKET</th>
                                    <th class="text-center">NO KURSI</th>
                                    <th class="text-right">HARGA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{!! QrCode::size(200)->generate($d->kode_tiket); !!}</td>
                                    <td class="no font font-weight-bold">{{ $d->kode_tiket }}</td>
                                    <td class="text-left">
                                        <h3>{{ $d->pt }} {{ $d->nm }}</h3>
                                        <h4>{{ $d->w_awal }} ({{ $d->nm_awal }}) <i class="fas fa-arrow-right"></i> {{ $d->w_awal }} ({{ $d->w_akhir }})</h4>
                                        <h5>{{ $d->tb }} {{ $d->wb }} <i class="fas fa-arrow-right"></i> {{ $d->ts }} {{ $d->ws }}</h5>
                                    </td>
                                    <td class="qty text-center">{{ $d->no_kursi }}</td>
                                    <td class="total">Rp. {{number_format($d['harga']),0,',','.'}},-</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">BIAYA ADMIN</td>
                                    <td>Rp. 7.000,-</td>
                                </tr>
                                <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2">TOTAL</td>
                                    @foreach ($gt as $t)
                                    <td>Rp. {{number_format($t['total']),0,',','.'}},-</td>
                                    @endforeach
                                </tr>
                            </tfoot>
                        </table>
                        <div class="thanks">Terimakasih!</div>
                        <div class="notices">
                            <div>Perhatian:</div>
                            <div class="notice">Jika ada pertanyaan silahkan hubungi kami di <a class="text-info" style="text-decoration:none;" href="mailto:anigato.net@gmail.com">anigato.net@gmail.com</a></div>
                        </div>
                    </div>
                </main>
                <footer>
                    <div class="text-left">
                        <h4>Syarat dan Ketentuan</h4>
                        <ol>
                            <li>Bukti pemesanan ini harus ditukarkan dengan Boarding Pass mulai 7x24 jam sebelum keberangkatan pada mesin check-in di Statsiun/Bandara keberangkatan</li>
                            <li>Untuk boarding, pastikan anda membawa tanda pengenal resmi (KTP, SIM, Paspor) jika lebih dari 17 tahun. Apabila penumpang masih di bawah umur 17 tahun disarankan untuk membawa Kartu Pelajar atau Kartu Keluarga</li>
                            <li>Mohon tiba di Statsiun/Bandara setidaknya 60 menit sebelum keberangkatan</li>
                            <li>Untuk informasi lebih lanjut tentang ketentuan ain silahkan klik di <a class="text-info" style="text-decoration:none;" href="http://www.kai.id">www.kai.id</a> untuk kereta dan silahkan ke website resmi maskapai pilihan anda.</li>
                        </ol>
                    </div>
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>
@endsection