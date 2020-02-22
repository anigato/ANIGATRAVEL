<?php

namespace App\Http\Controllers;

use App\Driver;
use App\User;
use App\Transportasi;
use App\Type_transportasi;
use Illuminate\Http\Request;
use Validator;
use Hash;

class DriverController extends Controller
{
    public function page_flight(){
        return view('driver.flight');
    }
    public function page_train(){
        return view('driver.train');
    }

    public function id_transportasi_flight(){
        $data = Type_transportasi::join('transportasis','transportasis.id_type_transportasi','type_transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Pesawat')
            ->selectRaw('
                transportasis.id_transportasi,
                transportasis.kode as tipe_transportasi,
                transportasis.keterangan as tipe_penumpang,
                type_transportasis.nama_type,
                type_transportasis.keterangan as nama_transportasi
                ')
            ->get();

        return $data;
    }

    public function id_transportasi_train(){
        $data = Type_transportasi::join('transportasis','transportasis.id_type_transportasi','type_transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Kereta')
            ->selectRaw('
                transportasis.id_transportasi,
                transportasis.kode as tipe_transportasi,
                transportasis.keterangan as tipe_penumpang,
                type_transportasis.nama_type,
                type_transportasis.keterangan as nama_transportasi
                ')
            ->get();

        return $data;
    }

    public function driverAll_flight(){
        $data = Driver::join('transportasis','transportasis.id_transportasi','drivers.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Pesawat')
            ->selectRaw('
                drivers.id_driver,
                drivers.nama_lengkap,
                drivers.no_ktp,
                drivers.no_sim,
                transportasis.id_transportasi,
                transportasis.kode as tipe_transportasi,
                transportasis.keterangan as tipe_penumpang,
                type_transportasis.nama_type,
                type_transportasis.keterangan as nama_transportasi
                ')
            ->orderby('drivers.id_driver','DESC')
            ->get();
        return $data;
    }
    public function driverAll_train(){
        $data = Driver::join('transportasis','transportasis.id_transportasi','drivers.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('type_transportasis.nama_type','Kereta')
            ->selectRaw('
                drivers.id_driver,
                drivers.nama_lengkap,
                drivers.no_ktp,
                drivers.no_sim,
                transportasis.id_transportasi,
                transportasis.kode as tipe_transportasi,
                transportasis.keterangan as tipe_penumpang,
                type_transportasis.nama_type,
                type_transportasis.keterangan as nama_transportasi
                ')
            ->orderby('drivers.id_driver','DESC')
            ->get();
        return $data;
    }
    public function create(Request $req){
        $data = User::where('username',session('username'))->first();
        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
                [
                    'nama_lengkap'=>'required|between:5,20',
                    'no_ktp'=>'required|between:5,16',
                    'no_sim'=>'required|between:5,16',
                    'id_transportasi'=>'required',
                ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            Driver::create([
                'nama_lengkap' => $req['nama_lengkap'],
                'no_ktp' => $req['no_ktp'],
                'no_sim' => $req['no_sim'],
                'id_transportasi'=>$req['id_transportasi'],
            ]);

            $hashedPassword = bcrypt($req->password);

            if (Hash::check($req->password,$hashedPassword)) {
                $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');
            } else {
                $data = ['body'=>'gagal'];
                return response(json_encode($data),422)->header('Content-Type','text/plain');
            }

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

    public function update(Request $req)
    {
        $data = User::where('username',session('username'))->first();


        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
                [
                    'nama_lengkap'=>'required',
                    'no_ktp'=>'required',
                    'no_sim'=>'required',
                    'id_transportasi'=>'required',
                ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }



            Driver::where('id_driver',$req->id_driver)
                ->update([
                    'nama_lengkap'=>$req->nama_lengkap,
                    'no_ktp'=>$req->no_ktp,
                    'no_sim'=>$req->no_sim,
                    'id_transportasi'=>$req->id_transportasi,
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
            
            Driver::where('id_driver',$req->id_driver)->delete();

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }
    public function search_flight(Request $req){
        $cari = $req->cari;
        if ($cari == null) {
            $data = Driver::join('transportasis','transportasis.id_transportasi','drivers.id_transportasi')
                ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                ->where('type_transportasis.nama_type','Pesawat')
                ->selectRaw('
                    drivers.id_driver,
                    drivers.nama_lengkap,
                    drivers.no_ktp,
                    drivers.no_sim,
                    transportasis.id_transportasi,
                    transportasis.kode as tipe_transportasi,
                    transportasis.keterangan as tipe_penumpang,
                    type_transportasis.nama_type,
                    type_transportasis.keterangan as nama_transportasi
                    ')
                ->get();
            return $data;
        } else {
            $data = Driver::join('transportasis','transportasis.id_transportasi','drivers.id_transportasi')
                ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                ->where('type_transportasis.nama_type','Pesawat')
                ->where('nama_lengkap','like','%'.$cari.'%')
                ->selectRaw('
                    drivers.id_driver,
                    drivers.nama_lengkap,
                    drivers.no_ktp,
                    drivers.no_sim,
                    transportasis.id_transportasi,
                    transportasis.kode as tipe_transportasi,
                    transportasis.keterangan as tipe_penumpang,
                    type_transportasis.nama_type,
                    type_transportasis.keterangan as nama_transportasi
                    ')
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
            $data = Driver::join('transportasis','transportasis.id_transportasi','drivers.id_transportasi')
                ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                ->where('type_transportasis.nama_type','Kereta')
                ->selectRaw('
                    drivers.id_driver,
                    drivers.nama_lengkap,
                    drivers.no_ktp,
                    drivers.no_sim,
                    transportasis.id_transportasi,
                    transportasis.kode as tipe_transportasi,
                    transportasis.keterangan as tipe_penumpang,
                    type_transportasis.nama_type,
                    type_transportasis.keterangan as nama_transportasi
                    ')
                ->get();
            return $data;
        } else {
            $data = Driver::join('transportasis','transportasis.id_transportasi','drivers.id_transportasi')
                ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                ->where('type_transportasis.nama_type','Kereta')
                ->where('nama_lengkap','like','%'.$cari.'%')
                ->selectRaw('
                    drivers.id_driver,
                    drivers.nama_lengkap,
                    drivers.no_ktp,
                    drivers.no_sim,
                    transportasis.id_transportasi,
                    transportasis.kode as tipe_transportasi,
                    transportasis.keterangan as tipe_penumpang,
                    type_transportasis.nama_type,
                    type_transportasis.keterangan as nama_transportasi
                    ')
                ->get();
            if ( $data == "[]" )  {
                return response(json_encode($data),422)->header('Content-Type','text/plain');
            } else {
                return $data;
            }
        }
            
    }
    

    
}
