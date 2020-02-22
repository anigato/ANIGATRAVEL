<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transportasi;
use Validator;
use DB;
use App\User;
use Hash;
use App\Type_transportasi;
use Auth;

class TransportasiController extends Controller
{
    public function index(){
        return view('authentication.index');
    }
    public function indexs_flight()
    {
        return view('transportasi.transportasi_flight');
    }

    public function indexs_train()
    {
        return view('transportasi.transportasi_train');
    }

    public function type_transportasi_flight(){
        $data = Type_transportasi::where('nama_type','Pesawat')->get();
        return $data;
    }
    public function type_transportasi_train(){
        $data = Type_transportasi::where('nama_type','Kereta')->get();
        return $data;
    }

    public function transportasiAll_flight(){
        $data = Transportasi::join('type_transportasis','transportasis.id_type_transportasi','type_transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Pesawat')
            ->selectRaw('
                transportasis.id_transportasi,
                transportasis.kode,
                transportasis.keterangan,
                transportasis.jumlah_kursi,
                type_transportasis.id_type_transportasi as id_type_transportasi,
                type_transportasis.nama_type,
                type_transportasis.keterangan as ket
            ')
            ->orderby('transportasis.id_transportasi','DESC')
            ->get();
        return $data;
    }
    public function transportasiAll_train(){
        $data = Transportasi::join('type_transportasis','transportasis.id_type_transportasi','type_transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Kereta')
            ->selectRaw('
                transportasis.id_transportasi,
                transportasis.kode,
                transportasis.keterangan,
                transportasis.jumlah_kursi,
                type_transportasis.id_type_transportasi as id_type_transportasi,
                type_transportasis.nama_type,
                type_transportasis.keterangan as ket
            ')
            ->orderby('transportasis.id_transportasi','DESC')
            ->get();
        return $data;
    }
    public function create(Request $req)
    {
        $data = User::where('username',session('username'))->first();
        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
            [
                'keterangan'=>'required',
                'jumlah_kursi'=>'required|between:2,3',
                'id_type_transportasi'=>'required',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            $text = '123457890';
            $panj = 3;
            $txtl = strlen($text)-1;
            $kd = '';
            for($i=1; $i<=$panj; $i++){
                $kd .= $text[rand(0, $txtl)];
            }

            $kode = 'TRN'.$req['id_type_transportasi'].$kd;

            Transportasi::create([
                'kode'=>$kode,
                'keterangan'=>$req['keterangan'],
                'jumlah_kursi'=>$req['jumlah_kursi'],
                'id_type_transportasi'=>$req['id_type_transportasi'],
            ]);

            $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }
    public function search_flight(Request $req)
    {
        $cari = $req->cari;
        if ($cari == null) {
           $data = Transportasi::join('type_transportasis','transportasis.id_type_transportasi','type_transportasis.id_type_transportasi')
                ->selectRaw('
                    transportasis.id_transportasi,
                    transportasis.kode,
                    transportasis.keterangan,
                    transportasis.jumlah_kursi,
                    type_transportasis.id_type_transportasi as id_type_transportasi,
                    type_transportasis.nama_type,
                    type_transportasis.keterangan as ket
                ')
                ->Where('nama_type','Pesawat')
                ->get();
            return $data;
        } else {
            $data = Transportasi::join('type_transportasis','transportasis.id_type_transportasi','type_transportasis.id_type_transportasi')
                ->selectRaw('
                    transportasis.id_transportasi,
                    transportasis.kode,
                    transportasis.keterangan,
                    transportasis.jumlah_kursi,
                    type_transportasis.id_type_transportasi as id_type_transportasi,
                    type_transportasis.nama_type,
                    type_transportasis.keterangan as ket
                ')
                ->Where('nama_type','Pesawat')
                ->Where('transportasis.keterangan','like','%'.$cari.'%')
                ->orWhere('type_transportasis.keterangan','like','%'.$cari.'%')
                ->get();

            if ( $data == "[]" )  {
                return response(json_encode($data),422)->header('Content-Type','text/plain');
            } else {
                return $data;
            }
        }
        
        
    }
    public function search_train(Request $req)
    {
        $cari = $req->cari;

        if ($cari == null) {
           $data = Transportasi::join('type_transportasis','transportasis.id_type_transportasi','type_transportasis.id_type_transportasi')
                ->selectRaw('
                    transportasis.id_transportasi,
                    transportasis.kode,
                    transportasis.keterangan,
                    transportasis.jumlah_kursi,
                    type_transportasis.id_type_transportasi as id_type_transportasi,
                    type_transportasis.nama_type,
                    type_transportasis.keterangan as ket
                ')
                ->Where('nama_type','Kereta')
                ->get();
            return $data;
        } else {
            $data = Transportasi::join('type_transportasis','transportasis.id_type_transportasi','type_transportasis.id_type_transportasi')
                ->selectRaw('
                    transportasis.id_transportasi,
                    transportasis.kode,
                    transportasis.keterangan,
                    transportasis.jumlah_kursi,
                    type_transportasis.id_type_transportasi as id_type_transportasi,
                    type_transportasis.nama_type,
                    type_transportasis.keterangan as ket
                ')
                ->Where('nama_type','Kereta')
                ->Where('transportasis.keterangan','like','%'.$cari.'%')
                ->orWhere('type_transportasis.keterangan','like','%'.$cari.'%')
                ->get();

            if ( $data == "[]" )  {
                return response(json_encode($data),422)->header('Content-Type','text/plain');
            } else {
                return $data;
            }
        }

        
        
        
    }

    public function update(Request $req)
    {
        $data = User::where('username',session('username'))->first();


        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
            [
                'keterangan'=>'required',
                'jumlah_kursi'=>'required',
                'id_type_transportasi'=>'required',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            Transportasi::where('id_transportasi',$req->id_transportasi)
                ->update([
                    'keterangan'=>$req->keterangan,
                    'jumlah_kursi'=>$req->jumlah_kursi,
                    'id_type_transportasi'=>$req->id_type_transportasi,
                ]);

            $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }
    public function destroy(Request $req)
    {
        $data = User::where('username',session('username'))->first();

        if (session('token')==$data->remember_token) {
            
            Transportasi::where('id_transportasi',$req->id_transportasi)->delete();

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }




    public function type_index_flight(){
        return view('type_transportasi.tipe_flight');
    }
    public function type_flight_all(){
        $data = Type_transportasi::where('nama_type','Pesawat')->orderby('id_type_transportasi','DESC')->get()->all();
        return $data;
    }
    public function type_train_all(){
        $data = Type_transportasi::where('nama_type','Kereta')->orderby('id_type_transportasi','DESC')->get()->all();
        return $data;
    }
    public function type_create(Request $req){
        $data = User::where('username',session('username'))->first();
        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
            [
                'nama_type'=>'required',
                'keterangan'=>'required|between:2,20|alpha',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            Type_transportasi::create([
                'nama_type'=>$req['nama_type'],
                'keterangan'=>$req['keterangan'],
            ]);

            $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }
    
    public function type_update(Request $req){
        $data = User::where('username',session('username'))->first();


        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
            [
                'nama_type'=>'required',
                'keterangan'=>'required|between:2,20|alpha',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }



            Type_transportasi::where('id_type_transportasi',$req->id_type_transportasi)
                ->update([
                    'nama_type'=>$req->nama_type,
                    'keterangan'=>$req->keterangan,
                ]);

            $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }
    public function type_destroy(Request $req){
        $data = User::where('username',session('username'))->first();

        if (session('token')==$data->remember_token) {
            
            Type_transportasi::where('id_type_transportasi',$req->id_type_transportasi)->delete();

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }
    public function type_flight_search(Request $req){
        $cari = $req->cari;

        if ($cari == null) {
            $data = Type_transportasi::where('nama_type','Pesawat')
                ->get();
            return $data;
        } else {
            $data = Type_transportasi::where('nama_type','Pesawat')
                ->where('keterangan','like','%'.$cari.'%')
                ->get();
            if ( $data == "[]" )  {
                return response(json_encode($data),422)->header('Content-Type','text/plain');
            } else {
                return $data;
            }
        }
    }
    public function type_train_search(Request $req){
        $cari = $req->cari;

        if ($cari == null) {
            $data = Type_transportasi::where('nama_type','Kereta')
                ->get();
            return $data;
        } else {
            $data = Type_transportasi::where('nama_type','Kereta')
                ->where('keterangan','like','%'.$cari.'%')
                ->get();
            if ( $data == "[]" )  {
                return response(json_encode($data),422)->header('Content-Type','text/plain');
            } else {
                return $data;
            }
        }
    }
    
}
