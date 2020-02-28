<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penumpang;
use Illuminate\Support\Str;
use Validator;
use Hash;
use DB;
use App\Profile;


class PenumpangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('authUser.register');
    }
    public function profile()
    {
        return view('authUser.profile');
    }

    public function data()
    {
        $data = Penumpang::leftJoin('profiles','profiles.id_penumpang','penumpangs.id_penumpang')
                        ->where('username',session('username'))
                        ->selectRaw('
                            penumpangs.id_penumpang,
                            penumpangs.username,
                            penumpangs.nama_penumpang,
                            penumpangs.jenis_kelamin,
                            penumpangs.alamat_penumpang,
                            penumpangs.telepone,
                            profiles.email,
                            profiles.no_ktp
                            ')
                        ->get();

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daftar(Request $req)
    {
        $validator = Validator::make($req->all(),
            [
                'username' => 'required|unique:users,username|unique:penumpangs,username|regex:/^[A-Za-z0-9_.]{5,12}$/',
                'nama_penumpang' => 'required|between:2,20',
                'password' => 'required|between:5,12|same:confirm_password'
            ]);

        if ($validator->fails()) {
            $data = $validator->errors();
            return response(json_encode($data),422)
            ->header('Content-Type', 'text/plain');
        }

        $token = Str::random(60);

        Penumpang::create([
            'username' => $req['username'],
            'nama_penumpang' => $req['nama_penumpang'],
            'password' => bcrypt($req['password']),
            'token' => $token,
        ]);

        $hashedPassword = bcrypt($req->password);

        if (Hash::check($req->password,$hashedPassword)) {
            session(['username'=>$req->username]);
            session(['token'=>$token]);
            session(['level'=>'user']);

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');
        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),422)->header('Content-Type','text/plain');
        }
    }

    public function login()
    {
        return view('authUser.login');
    }
    public function masuk(Request $req)
    {
       $check = Penumpang::where('username',$req->username)->count();

       if ($check<=0) {
          $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
       }

       $data = Penumpang::where('username',$req->username)->first();

        if (Hash::check($req->password,$data->password)) {

            $tokens = Str::random(60);

            Penumpang::where('username',$req->username)->update([
                'token'=>$tokens
            ]);

            session(['username'=>$req->username]);
            session(['token'=>$tokens]);
            session(['level'=>'user']);

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');
        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),421)->header('Content-Type','text/plain');
        }
    }
    public function logout(Request $req){

        $data = Penumpang::where('username',session('username'))->first();

        if (session('token')==$data->token) {

            Penumpang::where('username',$req->username)->update([
                'token'=>null
            ]);

            session()->forget('username');
            session()->forget('token');
            session()->forget('level');

            return view('authUser.login');

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {

        $data = Penumpang::where('username',session('username'))->first();


        if (session('token')==$data->token) {
            $validator = Validator::make($req->all(),
            [
                'username'=>'required|regex:/^[A-Za-z0-9_.]{5,12}$/',
                'nama_penumpang'=>'required|between:3,50',
                'no_ktp'=>'required|between:15,17',
                'jenis_kelamin'=>'required',
                'alamat_penumpang'=>'required|min:3',
                'email'=>'required|email',
                'telepone'=>'required|between:9,13',
            ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }
            Penumpang::where('id_penumpang',$id)
                ->update([
                    'username'=>$req->username,
                    'nama_penumpang'=>$req->nama_penumpang,
                    'jenis_kelamin'=>$req->jenis_kelamin,
                    'alamat_penumpang'=>$req->alamat_penumpang,
                    'telepone'=>$req->telepone,
                ]);
            $cek = DB::table('profiles')->where('id_penumpang',$id)->get();
            if ($cek == "[]") {
                Profile::create([
                    'id_penumpang'=>$id,
                    'no_ktp'=>$req->no_ktp,
                    'email'=>$req->email,]);
            }else{
                Profile::where('id_penumpang',$id)->update([
                    'no_ktp'=>$req->no_ktp,
                    'email'=>$req->email,]);
            }
            

            session()->forget('username');
            session(['username'=>$req->username]);
            

            $data = ['body'=>'berhasil'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
