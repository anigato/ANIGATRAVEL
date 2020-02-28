<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Validator;
use Hash;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('authentication.register');
    }

    public function register(Request $req)
    {
        $validator = Validator::make($req->all(),
            [
                'username' => 'required|unique:users,username|unique:penumpangs,username|regex:/^[A-Za-z0-9_.]{5,12}$/',
                'first_name' => 'required|between:2,20|alpha',
                'last_name' => 'required|between:2,20|alpha',
                'password' => 'required|between:5,12|same:confirm_password'
            ]);

        if ($validator->fails()) {
            $data = $validator->errors();
            return response(json_encode($data),422)
            ->header('Content-Type', 'text/plain');
        }

        $token = Str::random(60);

        User::create([
            'username' => $req['username'],
            'first_name' => $req['first_name'],
            'last_name' => $req['last_name'],
            'password' => bcrypt($req['password']),
            'remember_token' => $token,
        ]);

        $hashedPassword = bcrypt($req->password);

        if (Hash::check($req->password,$hashedPassword)) {
            session(['username'=>$req->username]);
            session(['token'=>$token]);

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');
        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),422)->header('Content-Type','text/plain');
        }
    }
    public function page(){
        $data = User::get()->all();
        return view('authentication.index',['data'=>$data]);
    }

    public function userAll(){
        $data = User::orderby('id','DESC')->get()->all();
        return $data;
    }
    public function create(Request $req){
        $data = User::where('username',session('username'))->first();
        if (session('token')==$data->remember_token) {
            $validator = Validator::make($req->all(),
                [
                    'username' => 'required|unique:users,username|regex:/^[A-Za-z0-9_.]{5,12}$/',
                    'first_name' => 'required|between:2,20',
                    'last_name' => 'required|between:2,20',
                    'password' => 'required|between:5,12'
                ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            $token = Str::random(60);

            User::create([
                'username' => $req['username'],
                'first_name' => $req['first_name'],
                'last_name' => $req['last_name'],
                'password' => bcrypt($req['password']),
                'remember_token' => $token,
                'level' => $req['level'],
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
                    'username' => 'required|regex:/^[A-Za-z0-9_.]{5,12}$/',
                    'first_name' => 'required|between:2,20',
                    'last_name' => 'required|between:2,20',
                ]);

            if ($validator->fails()) {
                $data = $validator->errors();
                return response(json_encode($data),422)
                ->header('Content-Type', 'text/plain');
            }

            if ($req['password']==null) {
                User::where('id',$req->id)
                    ->update([
                        'username'=>$req->username,
                        'first_name'=>$req->first_name,
                        'last_name'=>$req->last_name,
                        'level'=>$req->level,
                    ]);

                $data = ['body'=>'berhasil ubah tanpa password'];
                return response(json_encode($data),200)->header('Content-Type','text/plain');
            } else {
                User::where('id',$req->id)
                    ->update([
                        'username'=>$req->username,
                        'first_name'=>$req->first_name,
                        'last_name'=>$req->last_name,
                        'password'=>bcrypt($req['password']),
                        'level'=>$req->level,
                    ]);

                $hashedPassword = bcrypt($req->password);

                if (Hash::check($req->password,$hashedPassword)) {
                    $data = ['body'=>'berhasil'];
                    return response(json_encode($data),200)->header('Content-Type','text/plain');
                } else {
                    $data = ['body'=>'gagal'];
                    return response(json_encode($data),422)->header('Content-Type','text/plain');
                }
            }
        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

    public function destroy(Request $req)
    {
        $data = User::where('username',session('username'))->first();

        if (session('token')==$data->remember_token) {
            
            User::where('id',$req->id)->delete();

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }
    public function search(Request $req){
        $cari = $req->cari;
        $data = User::where('username','like','%'.$cari.'%')
            ->orWhere('first_name','like','%'.$cari.'%')
            ->orWhere('last_name','like','%'.$cari.'%')
            ->get();

        if ( $data == "[]" )  {
            return response(json_encode($data),422)->header('Content-Type','text/plain');
        } else {
            return $data;
        }
    }
}
