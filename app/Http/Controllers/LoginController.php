<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Hash;
use Illuminate\Support\Str;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('authentication.login');
    }
    public function login(Request $req)
    {
       $check = User::where('username',$req->username)->count();

       if ($check<=0) {
          $data = ['body'=>'Nothing User'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
       }

       $data = User::where('username',$req->username)->first();


        if (Hash::check($req->password,$data->password)) {

            $token = Str::random(60);

            User::where('username',$req->username)->update([
                'remember_token'=>$token
            ]);

            $level  = User::where('username',$req->username)->first();

            session(['username'=>$req->username]);
            session(['token'=>$token]);
            session(['level'=>$level->level]);

            $data = ['body'=>'Success'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');
        } else {
            $data = ['body'=>'Password Wrong'];
            return response(json_encode($data),421)->header('Content-Type','text/plain');
        }
    }
    public function logout(Request $req){

        $data = User::where('username',session('username'))->first();

        if (session('token')==$data->remember_token) {

            User::where('username',$req->username)->update([
                'remember_token'=>null
            ]);

            session()->forget('username');
            session()->forget('token');
            session()->forget('level');

            return view('authentication.login');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }

    }

}
