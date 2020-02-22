<?php

namespace App\Http\Controllers;

use App\Order;
use App\Pemesanan;
use App\Jadwal;
use App\Penumpang;
use Illuminate\Http\Request;
use App\Rute;
use App\Transportasi;
use Validator;
use DB;
use App\User;
use Hash;
use App\Type_transportasi;
use Carbon;
use App\Tempat;

class OrderController extends Controller
{
    public function index_flight()
    {
        return view('order.order_flight');
    }
    public function index_train()
    {
        return view('order.order_train');
    }

    public function flight()
    {   $tanggal = Carbon\Carbon::now()->format('d-m-Y');
        $data = Tempat::where('tipe_tempat','Bandara')->orderby('id_tempat','DESC')->get();
        return $data;
    }
    public function train()
    {
        $data = Tempat::where('tipe_tempat','Statsiun')->orderby('id_tempat','DESC')->get();
        return $data;
    }

    public function rute_flight(Request $req){
        $now = Carbon\Carbon::now();
        $qty = $req->qty;
        $rute_awal = $req->rute_awal;
        $rute_akhir = $req->rute_akhir;
        $tanggal = $req->tanggal_berangkat;
        $data = Jadwal::join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('rutes.rute_awal',$rute_awal)
            ->where('rutes.rute_akhir',$rute_akhir)
            ->Where('jadwals.tanggal_berangkat',$tanggal)
            ->where('jadwals.tanggal_berangkat','>',$now)
            ->selectRaw('
                jadwals.id_jadwal,
                jadwals.waktu_berangkat,
                jadwals.tanggal_berangkat,
                jadwals.waktu_sampai,
                jadwals.tanggal_sampai,
                jadwals.harga,
                type_transportasis.keterangan as tipe,
                transportasis.keterangan as ket,
                transportasis.kode
                ')
            ->get();


        if ( $data == "[]" )  {
            return response(json_encode($data),422)->header('Content-Type','text/plain');
        } else {
            return $data;
        }
    }

    public function rute_train(Request $req){
        $now = Carbon\Carbon::now();
        $rute_awal = $req->rute_awal;
        $rute_akhir = $req->rute_akhir;
        $tanggal = $req->tanggal_berangkat;
        $data = Jadwal::join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('rutes.rute_awal',$rute_awal)
            ->where('rutes.rute_akhir',$rute_akhir)
            ->Where('jadwals.tanggal_berangkat',$tanggal)
            ->where('jadwals.tanggal_berangkat','>',$now)
            ->selectRaw('
                jadwals.id_jadwal,
                jadwals.waktu_berangkat,
                jadwals.tanggal_berangkat,
                jadwals.waktu_sampai,
                jadwals.tanggal_sampai,
                jadwals.harga,
                type_transportasis.keterangan as tipe,
                transportasis.keterangan as ket,
                transportasis.kode
                ')
            ->get();


        if ( $data == "[]" )  {
            return response(json_encode($data),422)->header('Content-Type','text/plain');
        } else {
            return $data;

        }
    }

    public function detail_flight(Request $req){
        $id_jadwal = $req->id_jadwal;
        $tanggal = $req->tanggal_berangkat;
        $data = Jadwal::join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->Where('jadwals.id_jadwal',$id_jadwal)
            ->selectRaw('
                transportasis.jumlah_kursi,
                rutes.rute_awal,
                rutes.rute_akhir,
                rutes.nama_tempat_awal,
                rutes.nama_tempat_akhir,
                rutes.wilayah_awal,
                rutes.wilayah_akhir,
                jadwals.id_jadwal,
                jadwals.waktu_berangkat,
                jadwals.tanggal_berangkat,
                jadwals.waktu_sampai,
                jadwals.tanggal_sampai,
                jadwals.harga,
                type_transportasis.keterangan as tipe,
                transportasis.keterangan as ket
                ')
            ->get();


        if ( $data == "[]" )  {
            return response(json_encode($data),422)->header('Content-Type','text/plain');
        } else {
            return $data;

        }
    }

    public function detail_train(Request $req){
        $id_jadwal = $req->id_jadwal;
        $tanggal = $req->tanggal_berangkat;
        $data = Jadwal::join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->Where('jadwals.id_jadwal',$id_jadwal)
            ->selectRaw('
                transportasis.jumlah_kursi,
                rutes.rute_awal,
                rutes.rute_akhir,
                rutes.nama_tempat_awal,
                rutes.nama_tempat_akhir,
                rutes.wilayah_awal,
                rutes.wilayah_akhir,
                jadwals.id_jadwal,
                jadwals.waktu_berangkat,
                jadwals.tanggal_berangkat,
                jadwals.waktu_sampai,
                jadwals.tanggal_sampai,
                jadwals.harga,
                type_transportasis.keterangan as tipe,
                transportasis.keterangan as ket
                ')
            ->get();


        if ( $data == "[]" )  {
            return response(json_encode($data),422)->header('Content-Type','text/plain');
        } else {
            return $data;

        }
    }
}
