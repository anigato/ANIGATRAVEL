<?php

namespace App\Http\Controllers;

use App\Tempat;
use App\Transportasi;
use App\Type_transportasi;
use App\User;
use Illuminate\Http\Request;
use Validator;

class TempatController extends Controller
{
    public function index_flight(){
        return view('tempat.bandara'); 
    }
    public function index_train(){
        return view('tempat.statsiun');
    }
    public function getFlight(){
        $data = Tempat::orderby('id_tempat','DESC')->where('tipe_tempat','Bandara')->get();
        return $data;
    }
    public function getTrain(){
        $data = Tempat::orderby('id_tempat','DESC')->where('tipe_tempat','Statsiun')->get();
        return $data;
    }
    public function search_flight(Request $req){
        $cari = $req->cari;
        if ($cari == null) {
            $data = Tempat::Where('tipe_tempat','Bandara')
                ->get();
            return $data;
        } else {
            $data = Tempat::Where('tipe_tempat','Bandara')
                ->Where('nama_tempat','like','%'.$cari.'%')
                ->orWhere('kode_tempat','like','%'.$cari.'%')
                ->orWhere('wilayah','like','%'.$cari.'%')
                ->get();

            if ( $data == "[]" )  {
                return response(json_encode($data),422)->header('Content-Type','text/plain');
            } else {
                return $data;
            }
        }
    }
    public function search_train(Request $req){
        $cari = $req->cari;
        if ($cari == null) {
            $data = Tempat::Where('tipe_tempat','Statsiun')
                ->get();
            return $data;
        } else {
            $data = Tempat::Where('tipe_tempat','Statsiun')
                ->Where('nama_tempat','like','%'.$cari.'%')
                ->orWhere('kode_tempat','like','%'.$cari.'%')
                ->orWhere('wilayah','like','%'.$cari.'%')
                ->get();

            if ( $data == "[]" )  {
                return response(json_encode($data),422)->header('Content-Type','text/plain');
            } else {
                return $data;
            }
        }
    }
    public function create(Request $req){
        $data = User::where('username',session('username'))->first();
        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
            [
                'nama_tempat'=>'required|between:2,20|unique:tempats,nama_tempat|alpha',
                'wilayah'=>'required|between:2,20|alpha',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }
            
            if ($req['tipe_tempat']=="Bandara") {
                $kode = "AIR".strlen($req['nama_tempat']);
            } else if ($req['tipe_tempat']=="Statsiun") {
                $kode = "STA".strlen($req['nama_tempat']);
            }

            Tempat::create([
                'nama_tempat'=>$req['nama_tempat'],
                'kode_tempat'=>$kode,
                'wilayah'=>$req['wilayah'],
                'tipe_tempat'=>$req['tipe_tempat'],
            ]);

            $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }
    public function update(Request $req){
        $data = User::where('username',session('username'))->first();
        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
            [
                'nama_tempat'=>'required',
                'wilayah'=>'required',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            $txt = $req->nama_tempat;
            $pnj = 3;
            $txtl = strlen($txt)-1;
            $kode = '';
            for ($i=1; $i < $pnj; $i++) { 
                $kode .= $txtl;
            }

            Tempat::where('id_tempat',$req->id_tempat)
                ->update([
                    'nama_tempat'=>$req->nama_tempat,
                    'wilayah'=>$req->wilayah,
                    'kode_tempat'=>$kode,
                ]);

            $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }
    public function destroy(Request $req){
        $data = User::where('username',session('username'))->first();

        if (session('token')==$data->remember_token) {
            
            Tempat::where('id_tempat',$req->id_tempat)->delete();

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

}