<?php

namespace App\Http\Controllers;

use App\Jadwal;
use Illuminate\Http\Request;
use App\Rute;
use App\Transportasi;
use Validator;
use DB;
use App\User;
use Hash;
use App\Type_transportasi;

class JadwalController extends Controller
{
    public function jadwal_flight_index(){
        return view('jadwal.jadwal_flight');
    }
    public function jadwal_train_index(){
        return view('jadwal.jadwal_train');
    }

    public function jadwal_flight_rute(){
        $data = Rute::join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Pesawat')
            ->get();
        return $data;
    }
    public function jadwal_train_rute(){
        $data = Rute::join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Kereta')
            ->get();
        return $data;
    }

    public function jadwal_flight_All(){
        $data = Jadwal::join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Pesawat')
            ->selectRaw('
                rutes.id_rute,
                rutes.tujuan,
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
                jadwals.harga
                ')
            ->orderby('jadwals.id_jadwal','DESC')
            ->get();
        return $data;
    }
    public function jadwal_train_All(){
        $data = Jadwal::join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Kereta')
            ->selectRaw('
                rutes.id_rute,
                rutes.tujuan,
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
                jadwals.harga
                ')
            ->orderby('jadwals.id_jadwal','DESC')
            ->get();
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jadwal_create(Request $req)
    {
        $data = User::where('username',session('username'))->first();
        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
            [
                'waktu_berangkat'=>'required',
                'tanggal_berangkat'=>'required',
                'waktu_sampai'=>'required',
                'tanggal_sampai'=>'required',
                'id_rute'=>'required',
                'harga'=>'required|between:5,8',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            Jadwal::create([
                'waktu_berangkat'=>$req['waktu_berangkat'],
                'tanggal_berangkat'=>$req['tanggal_berangkat'],
                'waktu_sampai'=>$req['waktu_sampai'],
                'tanggal_sampai'=>$req['tanggal_sampai'],
                'id_rute'=>$req['id_rute'],
                'harga'=>$req['harga'],
            ]);

            $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function jadwal_update(Request $req)
    {
        $data = User::where('username',session('username'))->first();
        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
            [
                'waktu_berangkat'=>'required',
                'tanggal_berangkat'=>'required',
                'waktu_sampai'=>'required',
                'tanggal_sampai'=>'required',
                'id_rute'=>'required',
                'harga'=>'required|between:5,8',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            Jadwal::where('id_jadwal',$req->id_jadwal)
                ->update([
                    'waktu_berangkat'=>$req->waktu_berangkat,
                    'tanggal_berangkat'=>$req->tanggal_berangkat,
                    'waktu_sampai'=>$req->waktu_sampai,
                    'tanggal_sampai'=>$req->tanggal_sampai,
                    'id_rute'=>$req->id_rute,
                    'harga'=>$req->harga,
                ]);

            $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function jadwal_destroy(Request $req)
    {
        $data = User::where('username',session('username'))->first();

        if (session('token')==$data->remember_token) {
            
            Jadwal::where('id_jadwal',$req->id_jadwal)->delete();

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

    public function jadwal_flight_search(Request $req){
        $cari = $req->cari;

        if ($cari == null) {
            $data = $data = Jadwal::join('rutes','rutes.id_rute','jadwals.id_rute')
                ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
                ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                ->where('type_transportasis.nama_type','Pesawat')
                ->get();
            return $data;
        } else {
            $data = Jadwal::join('rutes','rutes.id_rute','jadwals.id_rute')
                ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
                ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                ->where('type_transportasis.nama_type','Pesawat')
                ->where('tujuan','like','%'.$cari.'%')
                ->orWhere('harga','like','%'.$cari.'%')
                ->orWhere('nama_tempat_awal','like','%'.$cari.'%')
                ->orWhere('wilayah_awal','like','%'.$cari.'%')
                ->orWhere('nama_tempat_akhir','like','%'.$cari.'%')
                ->orWhere('wilayah_akhir','like','%'.$cari.'%')
                ->get();
            if ( $data == "[]" )  {
                return response(json_encode($data),422)->header('Content-Type','text/plain');
            } else {
                return $data;
            }
        }
    }
    public function jadwal_train_search(Request $req){
        $cari = $req->cari;

        if ($cari == null) {
            $data = $data = Jadwal::join('rutes','rutes.id_rute','jadwals.id_rute')
                ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
                ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                ->where('type_transportasis.nama_type','Kereta')
                ->get();
            return $data;
        } else {
            $data = Jadwal::join('rutes','rutes.id_rute','jadwals.id_rute')
                ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
                ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                ->where('type_transportasis.nama_type','Kereta')
                ->where('tujuan','like','%'.$cari.'%')
                ->orWhere('harga','like','%'.$cari.'%')
                ->orWhere('nama_tempat_awal','like','%'.$cari.'%')
                ->orWhere('wilayah_awal','like','%'.$cari.'%')
                ->orWhere('nama_tempat_akhir','like','%'.$cari.'%')
                ->orWhere('wilayah_akhir','like','%'.$cari.'%')
                ->get();
            if ( $data == "[]" )  {
                return response(json_encode($data),422)->header('Content-Type','text/plain');
            } else {
                return $data;
            }
        }
    }
}
