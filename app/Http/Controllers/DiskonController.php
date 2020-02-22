<?php

namespace App\Http\Controllers;

use App\Diskon;
use App\User;
use Validator;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    
    public function index()
    {
        return view('diskon.diskon');
    }

    
    public function get_All()
    {
        return Diskon::all();
    }
    public function create(Request $req){
        $data = User::where('username',session('username'))->first();
        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
            [
                'diskon'=>'required',
                'status'=>'required',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            $text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123457890';
            $panj = 6;
            $txtl = strlen($text)-1;
            $kode = '';
            for($i=1; $i<=$panj; $i++){
                $kode .= $text[rand(0, $txtl)];
            }

            Diskon::create([
                'kode_diskon'=>$kode,
                'diskon'=>$req['diskon'],
                'status'=>$req['status'],
                'maximal_diskon'=>$req['maximal_diskon'],
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
                'diskon'=>'required',
                'status'=>'required',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            $text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123457890';
            $panj = 6;
            $txtl = strlen($text)-1;
            $kode = '';
            for($i=1; $i<=$panj; $i++){
                $kode .= $text[rand(0, $txtl)];
            }

            Diskon::where('id_diskon',$req->id_diskon)
                ->update([
                    'kode_diskon'=>$kode,
                    'diskon'=>$req->diskon,
                    'maximal_diskon'=>$req->maximal_diskon,
                    'status'=>$req->status,
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
            
            Diskon::where('id_diskon',$req->id_diskon)->delete();

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

    public function search(Request $req){
        $cari = $req->cari;
        $data = Diskon::where('diskon','like','%'.$cari.'%')
            ->orWhere('status','like','%'.$cari.'%')
            ->orWhere('maximal_diskon','like','%'.$cari.'%')
            ->get();

        if ( $data == "[]" )  {
            return response(json_encode($data),422)->header('Content-Type','text/plain');
        } else {
            return $data;
        }     
    }
}
