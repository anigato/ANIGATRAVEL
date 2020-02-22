<?php

namespace App\Http\Controllers;

use App\Exports\AdminExport;
use Illuminate\Http\Request;
use App\Pemesanan;
use App\Penumpang;
use App\Mail\ReportEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Tiket;
use App\User;

class ExportController extends Controller
{
    public function pemesanan(Request $req){
        $data = Pemesanan::join('tikets','tikets.kode_pemesanan','pemesanans.kode_pemesanan')
            ->join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('pemesanans.kode_pemesanan',session('kode_pemesanan'))
            ->where('tikets.username',session('username'))
            ->selectRaw('
                pemesanans.kode_pemesanan,
                tikets.no_kursi,
                tikets.kode_tiket,
                rutes.nama_tempat_awal as nm_awal,
                rutes.nama_tempat_akhir as nm_akhir,
                rutes.wilayah_awal as w_awal,
                rutes.wilayah_akhir as w_akhir,
                jadwals.waktu_berangkat as wb,
                jadwals.tanggal_berangkat as tb,
                jadwals.waktu_sampai as ws,
                jadwals.tanggal_sampai as ts,
                jadwals.harga,
                type_transportasis.nama_type as pt,
                type_transportasis.keterangan as nm,
                transportasis.keterangan as seat
            ')
        ->get();
        $gt = Pemesanan::where('kode_pemesanan',session('kode_pemesanan'))->selectraw('total,kode_pemesanan,created_at')->get();
        
        $user = Penumpang::join('profiles','penumpangs.id_penumpang','profiles.id_penumpang')
            ->where('penumpangs.username',session('username'))
            ->selectRaw('
                penumpangs.nama_penumpang as nm,
                penumpangs.alamat_penumpang as almt,
                penumpangs.telepone as telp,
                profiles.email,
                profiles.no_ktp
            ')
        ->get();
        
        return view('report.reportpdf',['data'=>$data,'gt'=>$gt,'user'=>$user]);
        
        // $pdf = PDF::loadview('report.reportpdf',['data'=>$data,'gt'=>$gt,'user'=>$user]);
        // return $pdf->download('Invoice');
    }
    public function admin(){
        $start = Carbon::now()->subWeek()->addDay()->format('Y-m-d') . ' 00:00:01';
        $end = Carbon::now()->format('Y-m-d') . ' 23:59:00';
        $tp1 =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Pesawat')
            ->where('tikets.status','Sukses')
            ->wherebetween('tikets.created_at',[$start,$end])
            ->count('tikets.id_tiket')
        ;
        $tp2 =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Kereta')
            ->where('tikets.status','Sukses')
            ->wherebetween('tikets.created_at',[$start,$end])
            ->count('tikets.id_tiket')
        ;
        $tpt =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('tikets.status','Sukses')
            ->wherebetween('tikets.created_at',[$start,$end])
            ->count('tikets.id_tiket')
        ;
        $e1 = Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')->where('tikets.status','Sukses')->wherebetween('tikets.created_at',[$start,$end])->sum('harga');

        $sm2 = Carbon::now()->subWeek()->subWeek()->addDay()->format('Y-m-d') . ' 00:00:01';
        $pm2 =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Pesawat')
            ->where('tikets.status','Sukses')
            ->wherebetween('tikets.created_at',[$sm2,$start])
            ->count('tikets.id_tiket')
        ;
        $km2 =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Kereta')
            ->where('tikets.status','Sukses')
            ->wherebetween('tikets.created_at',[$sm2,$start])
            ->count('tikets.id_tiket')
        ;
        $tm2 =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('tikets.status','Sukses')
            ->wherebetween('tikets.created_at',[$sm2,$start])
            ->count('tikets.id_tiket')
        ;
        $e2 = Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')->where('tikets.status','Sukses')->wherebetween('tikets.created_at',[$sm2,$start])->sum('harga');

        $sm3 = Carbon::now()->subWeek()->subWeek()->subWeek()->addDay()->format('Y-m-d') . ' 00:00:01';
        $pm3 =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Pesawat')
            ->where('tikets.status','Sukses')
            ->wherebetween('tikets.created_at',[$sm3,$sm2])
            ->count('tikets.id_tiket')
        ;
        $km3 =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Kereta')
            ->where('tikets.status','Sukses')
            ->wherebetween('tikets.created_at',[$sm3,$sm2])
            ->count('tikets.id_tiket')
        ;
        $tm3 =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('tikets.status','Sukses')
            ->wherebetween('tikets.created_at',[$sm3,$sm2])
            ->count('tikets.id_tiket')
        ;
        $e3 = Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')->where('tikets.status','Sukses')->wherebetween('tikets.created_at',[$sm3,$sm2])->sum('harga');

        $sm4 = Carbon::now()->subWeek()->subWeek()->subWeek()->subweek()->addDay()->format('Y-m-d') . ' 00:00:01';
        $pm4 =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Pesawat')
            ->where('tikets.status','Sukses')
            ->wherebetween('tikets.created_at',[$sm4,$sm3])
            ->count('tikets.id_tiket')
        ;
        $km4 =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Kereta')
            ->where('tikets.status','Sukses')
            ->wherebetween('tikets.created_at',[$sm4,$sm3])
            ->count('tikets.id_tiket')
        ;
        $tm4 =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('tikets.status','Sukses')
            ->wherebetween('tikets.created_at',[$sm4,$sm3])
            ->count('tikets.id_tiket')
        ;
        $e4 = Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')->where('tikets.status','Sukses')->wherebetween('tikets.created_at',[$sm4,$sm3])->sum('harga');

        $tiket_pesawat_all =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Pesawat')
            ->where('tikets.status','Sukses')
            ->count('tikets.id_tiket');
        $tiket_kereta_all =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Kereta')
            ->where('tikets.status','Sukses')
            ->count('tikets.id_tiket');
        $total_tiket_all =  Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('tikets.status','Sukses')
            ->count('tikets.id_tiket');
            
        $petugas = User::count();
        $user = Penumpang::count();

        $a = Pemesanan::count();
        $b = Pemesanan::where('status','Menunggu Konfirmasi User')->count();
        $c = Pemesanan::where('status','Menunggu Konfirmasi Admin')->count();
        $d = Pemesanan::where('status','Batal')->count();
        $e = Pemesanan::where('status','sukses')->count();
        
        $bb = $b/$a*100;
        $cc = $c/$a*100;
        $dd = $d/$a*100;
        $ee = $e/$a*100;
        
        return view('report.report_admin',[
            'tiket_pesawat'=>$tiket_pesawat_all,
            'tiket_kereta'=>$tiket_kereta_all,
            'total_tiket'=>$total_tiket_all,
            'tiket_minggu_pesawat'=>$tp1,
            'tiket_minggu_kereta'=>$tp2,
            'tiket_minggu_total'=>$tpt,
            'p_1'=>$tp1,
            'k_1'=>$tp2,
            't_1'=>$tpt,
            'e_1'=>$e1,
            'p_2'=>$pm2,
            'k_2'=>$km2,
            't_2'=>$tm2,
            'e_2'=>$e2,
            'p_3'=>$pm3,
            'k_3'=>$km3,
            't_3'=>$tm3,
            'e_3'=>$e3,
            'p_4'=>$pm4,
            'k_4'=>$km4,
            't_4'=>$tm4,
            'e_4'=>$e4,
            'baru'=>$b,
            'proses'=>$c,
            'perbaru'=>$bb,
            'perproses'=>$cc,
            'perbatal'=>$dd,
            'persukses'=>$ee,
            'petugas'=>$petugas,
            'user'=>$user
        ]);
    }
    public function email(){
        Mail::to('khoerulanam0855@gmail.com')->send(new ReportEmail());
        return "Email Terkirim";
    }
    public function excel(){
        return (new AdminExport)->download('users.xlsx');
    }
}
