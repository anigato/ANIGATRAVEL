<?php

namespace App\Http\Controllers;

use App\Tiket;
use App\Penumpang;
use App\User;
use Illuminate\Http\Request;
use Validator;
use strlen;
use rand;


class TiketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tiket_create(Request $req)
    {
        

        $data = Penumpang::Where('username',session('username'))
                            ->first();

        // $text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123457890';
        // $panj = 4;
        // $txtl = strlen($text)-1;
        // $kode_tiket = '';
        // for($i=1; $i<=$panj; $i++){
        //  $kode_tiket .= $text[rand(0, $txtl)];
        // }

        


        if (session('token')==$data->token) {
            $validator = Validator::make($req->all(),
            [
                'id_jadwal'=>'required',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            $tiket = Tiket::select('no_kursi')
                ->where('no_kursi',$req['no_kursi'])
                ->where('id_jadwal',$req['id_jadwal'])
                ->where('status','!=','Batal')
                ->get();

            $kode = 'TIK'.$req['id_jadwal'].$req['no_kursi'];
            
            if ( $tiket == "[]" )  {
                Tiket::create([
                    'id_jadwal'=>$req['id_jadwal'],
                    'username'=>$data->username,
                    'kode_tiket'=>$kode,
                    'no_kursi'=>$req['no_kursi'],
                ]);
            } else {
                return response(json_encode($data),432)->header('Content-Type','text/plain');
            }
            $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');
            
        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

    Public function tiketAll(Request $req){
        $user = Penumpang::Where('username',session('username'))
                            ->first();
        $data = Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
                        ->join('rutes','rutes.id_rute','jadwals.id_rute')
                        ->where('tikets.username',$user->username)
                        ->get();
        return $data;


    }

    public function tiket_destroy(Request $req)
    {
        $data = Penumpang::where('username',session('username'))->first();
        if (session('token')==$data->token) {
            
            Tiket::where('id_tiket',$req->id_tiket)->where('username',$data->username)->delete();

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }
}
