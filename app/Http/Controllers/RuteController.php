<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rute;
use App\Transportasi;
use Validator;
use DB;
use App\User;
use Hash;
use App\Type_transportasi;
use App\Tempat;

class RuteController extends Controller
{
    public function rute_index_flight()
    {
        return view('rute.rute_flight');
    }
    public function rute_index_train()
    {
        return view('rute.rute_train');
    }

    public function bandara(){
        $data = Tempat::orderby('id_tempat','DESC')->where('tipe_tempat','Bandara')->get();
        return $data;
    }

    public function statsiun(){
        $data = Tempat::orderby('id_tempat','DESC')->where('tipe_tempat','Statsiun')->get();
        return $data;
    }

    public function rute_trans_flight(){
        $data = Transportasi::join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Pesawat')
            ->selectRaw('
                transportasis.id_transportasi as id_transportasi,
                transportasis.kode,
                transportasis.keterangan,
                type_transportasis.id_type_transportasi as id_type_transportasi,
                type_transportasis.nama_type,
                type_transportasis.keterangan as ket
                ')
            ->get();
        return $data;
    }
    public function rute_trans_train(){
        $data = Transportasi::join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Kereta')
            ->selectRaw('
                transportasis.id_transportasi as id_transportasi,
                transportasis.kode,
                transportasis.keterangan,
                type_transportasis.id_type_transportasi as id_type_transportasi,
                type_transportasis.nama_type,
                type_transportasis.keterangan as ket
                ')
            ->get();
        return $data;
    }
    public function ruteAll_flight(){
        $data = Rute::join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Pesawat')
            ->selectRaw('
                rutes.id_rute,
                rutes.tujuan,
                rutes.nama_tempat_awal,
                rutes.wilayah_awal,
                rutes.nama_tempat_akhir,
                rutes.wilayah_akhir,
                rutes.rute_awal,
                rutes.rute_akhir,
                transportasis.id_transportasi as id_transportasi,
                transportasis.kode,
                transportasis.keterangan,
                type_transportasis.id_type_transportasi as id_type_transportasi,
                type_transportasis.nama_type,
                type_transportasis.keterangan as ket
            ')
            ->get();
        return $data;
    }
    public function ruteAll_train(){
        $data = Rute::join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Kereta')
            ->selectRaw('
                rutes.id_rute,
                rutes.tujuan,
                rutes.nama_tempat_awal,
                rutes.wilayah_awal,
                rutes.nama_tempat_akhir,
                rutes.wilayah_akhir,
                rutes.rute_awal,
                rutes.rute_akhir,
                transportasis.id_transportasi as id_transportasi,
                transportasis.kode,
                transportasis.keterangan,
                type_transportasis.id_type_transportasi as id_type_transportasi,
                type_transportasis.nama_type,
                type_transportasis.keterangan as ket
            ')
            ->get();
        return $data;
    }

    public function rute_create(Request $req)
    {
        $data = User::where('username',session('username'))->first();
        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
            [
                'rute_awal'=>'required',
                'rute_akhir'=>'required',
                'id_transportasi'=>'required',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }
            $tempat_awal = Tempat::where('id_tempat',$req['rute_awal'])
                ->selectRaw('id_tempat,nama_tempat,wilayah')
                ->first();
            $tempat_akhir = Tempat::where('id_tempat',$req['rute_akhir'])
                ->selectRaw('id_tempat,nama_tempat,wilayah')
                ->first();

            Rute::create([
                'tujuan'=>$req['tujuan'],
                'nama_tempat_awal'=>$tempat_awal->nama_tempat,
                'wilayah_awal'=>$tempat_awal->wilayah,
                'nama_tempat_akhir'=>$tempat_akhir->nama_tempat,
                'wilayah_akhir'=>$tempat_akhir->wilayah,
                'id_transportasi'=>$req['id_transportasi'],
                'rute_awal'=>$req['rute_awal'],
                'rute_akhir'=>$req['rute_akhir'],
            ]);

            $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

    public function rute_update(Request $req)
    {
        $data = User::where('username',session('username'))->first();
        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
            [
                'rute_awal'=>'required',
                'rute_akhir'=>'required',
                'id_transportasi'=>'required',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            $tempat_awal = Tempat::where('id_tempat',$req['rute_awal'])
                ->selectRaw('id_tempat,nama_tempat,wilayah')
                ->first();
            $tempat_akhir = Tempat::where('id_tempat',$req['rute_akhir'])
                ->selectRaw('id_tempat,nama_tempat,wilayah')
                ->first();

            Rute::where('id_rute',$req->id_rute)
                ->update([
                    'tujuan'=>$req->tujuan,
                    'nama_tempat_awal'=>$tempat_awal->nama_tempat,
                    'wilayah_awal'=>$tempat_awal->wilayah,
                    'nama_tempat_akhir'=>$tempat_akhir->nama_tempat,
                    'wilayah_akhir'=>$tempat_akhir->wilayah,
                    'rute_awal'=>$req->rute_awal,
                    'rute_akhir'=>$req->rute_akhir,
                    'id_transportasi'=>$req->id_transportasi,
                ]);

            $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

    public function rute_destroy(Request $req)
    {
        $data = User::where('username',session('username'))->first();

        if (session('token')==$data->remember_token) {
            
            Rute::where('id_rute',$req->id_rute)->delete();

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

    public function rute_search_flight(Request $req)
    {
        $cari = $req->cari;

        if ($cari == null) {
            $data = Rute::join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
                ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                ->where('type_transportasis.nama_type','Pesawat')
                ->selectRaw('
                    rutes.id_rute,
                    rutes.tujuan,
                    rutes.nama_tempat_awal,
                    rutes.wilayah_awal,
                    rutes.nama_tempat_akhir,
                    rutes.wilayah_akhir,
                    rutes.rute_awal,
                    rutes.rute_akhir,
                    transportasis.id_transportasi as id_transportasi,
                    transportasis.kode,
                    transportasis.keterangan,
                    type_transportasis.id_type_transportasi as id_type_transportasi,
                    type_transportasis.nama_type,
                    type_transportasis.keterangan as ket
                ')->get();
            return $data;
        } else {
            $data = Rute::join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
                ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                ->where('type_transportasis.nama_type','Pesawat')
                ->selectRaw('
                    rutes.id_rute,
                    rutes.tujuan,
                    rutes.nama_tempat_awal,
                    rutes.wilayah_awal,
                    rutes.nama_tempat_akhir,
                    rutes.wilayah_akhir,
                    rutes.rute_awal,
                    rutes.rute_akhir,
                    transportasis.id_transportasi as id_transportasi,
                    transportasis.kode,
                    transportasis.keterangan,
                    type_transportasis.id_type_transportasi as id_type_transportasi,
                    type_transportasis.nama_type,
                    type_transportasis.keterangan as ket
                ')
                ->where('tujuan','like','%'.$cari.'%')
                ->orWhere('nama_tempat_awal','like','%'.$cari.'%')
                ->orWhere('nama_tempat_akhir','like','%'.$cari.'%')
                ->orWhere('wilayah_awal','like','%'.$cari.'%')
                ->orWhere('wilayah_akhir','like','%'.$cari.'%')
                ->orWhere('transportasis.keterangan','like','%'.$cari.'%')
                ->orWhere('type_transportasis.keterangan','like','%'.$cari.'%')
                ->get();

            if ( $data == "[]" )  {
                return response(json_encode($data),422)->header('Content-Type','text/plain');
            } else {
                return $data;
            }
        }
        
        
    }
    public function rute_search_train(Request $req)
    {
        $cari = $req->cari;

        if ($cari == null) {
            $data = Rute::join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
                ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                ->where('type_transportasis.nama_type','Kereta')
                ->selectRaw('
                    rutes.id_rute,
                    rutes.tujuan,
                    rutes.nama_tempat_awal,
                    rutes.wilayah_awal,
                    rutes.nama_tempat_akhir,
                    rutes.wilayah_akhir,
                    rutes.rute_awal,
                    rutes.rute_akhir,
                    transportasis.id_transportasi as id_transportasi,
                    transportasis.kode,
                    transportasis.keterangan,
                    type_transportasis.id_type_transportasi as id_type_transportasi,
                    type_transportasis.nama_type,
                    type_transportasis.keterangan as ket
                ')->get();
            return $data;
        } else {
            $data = Rute::join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
                ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                ->where('type_transportasis.nama_type','Kereta')
                ->selectRaw('
                    rutes.id_rute,
                    rutes.tujuan,
                    rutes.nama_tempat_awal,
                    rutes.wilayah_awal,
                    rutes.nama_tempat_akhir,
                    rutes.wilayah_akhir,
                    rutes.rute_awal,
                    rutes.rute_akhir,
                    transportasis.id_transportasi as id_transportasi,
                    transportasis.kode,
                    transportasis.keterangan,
                    type_transportasis.id_type_transportasi as id_type_transportasi,
                    type_transportasis.nama_type,
                    type_transportasis.keterangan as ket
                ')
                ->where('tujuan','like','%'.$cari.'%')
                ->orWhere('nama_tempat_awal','like','%'.$cari.'%')
                ->orWhere('nama_tempat_akhir','like','%'.$cari.'%')
                ->orWhere('wilayah_awal','like','%'.$cari.'%')
                ->orWhere('wilayah_akhir','like','%'.$cari.'%')
                ->orWhere('transportasis.keterangan','like','%'.$cari.'%')
                ->orWhere('type_transportasis.keterangan','like','%'.$cari.'%')
                ->get();

            if ( $data == "[]" )  {
                return response(json_encode($data),422)->header('Content-Type','text/plain');
            } else {
                return $data;
            }
        }
        
        
    }

}
