<?php

namespace App\Http\Controllers;

use Model;
use App\Detail_pemesanan;
use App\Pemesanan;
use App\Jadwal;
use App\Tiket;
use App\Penumpang;
use App\Profile;
use Illuminate\Http\Request;
use App\Rute;
use App\Transportasi;
use Validator;
use DB;
use App\User;
use Hash;
use App\Type_transportasi;
use Carbon\Carbon;
use Image;
use File;
use App\Konfirmasi_pemesanan;

class PemesananController extends Controller
{
    public function pemesanan_index(){
        return view('pemesanan.pemesanan');   
    }
    public function get_total(){
        $username = session('username');
        $sum = DB::table('jadwals')
                    ->join('tikets','tikets.id_jadwal','jadwals.id_jadwal')
                    ->select(DB::raw("SUM(harga) as total"))
                    ->where('tikets.username',$username)
                    ->where('tikets.status','Menunggu Pembayaran')
                    ->get();
        return $sum;
    }
    public function get_total_bayar(){
        $username = session('username');
        $sum = DB::table('jadwals')
                    ->join('tikets','tikets.id_jadwal','jadwals.id_jadwal')
                    ->select(DB::raw("SUM(harga)+7000 as total"))
                    ->where('tikets.username',$username)
                    ->where('tikets.status','Menunggu Pembayaran')
                    ->get();
        return $sum;
    }
    public function get_tiket(){
        $username = session('username');

        $data = Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
                        ->join('rutes','rutes.id_rute','jadwals.id_rute')
                        ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
                        ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                        ->where('tikets.username',$username)
                        ->where('tikets.status','Menunggu Pembayaran')
                        ->selectRaw('
                            type_transportasis.nama_type,
                            type_transportasis.keterangan,
                            tikets.id_tiket,
                            tikets.no_kursi,
                            rutes.rute_awal,
                            rutes.rute_akhir,
                            rutes.nama_tempat_awal,
                            rutes.nama_tempat_akhir,
                            rutes.wilayah_awal,
                            rutes.wilayah_akhir,
                            jadwals.waktu_berangkat,
                            jadwals.tanggal_berangkat,
                            jadwals.harga
                            ')
                        ->get();
        if ( $data == "[]" )  {
            return response(json_encode($data),422)->header('Content-Type','text/plain');
        } else {
            return $data;

        }  
    }
    public function get_tiket_detail(){
        $data = Penumpang::join('profiles','profiles.id_penumpang','penumpangs.id_penumpang')
            ->where('penumpangs.username',session('username'))
            ->selectRaw('
                penumpangs.nama_penumpang,
                penumpangs.telepone,
                profiles.no_ktp,
                profiles.email
                ')
            ->get();
        return $data;
    }
    public function get_tiket_checkout(){
        $username = session('username');

        $data = Tiket::join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
            ->join('rutes','rutes.id_rute','jadwals.id_rute')
            ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
            ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
            ->where('tikets.username',$username)
            ->where('tikets.status','Menunggu Pembayaran')
            ->selectRaw('
                type_transportasis.nama_type,
                type_transportasis.keterangan,
                tikets.id_tiket,
                tikets.no_kursi,
                tikets.kode_tiket,
                rutes.rute_awal,
                rutes.rute_akhir,
                rutes.nama_tempat_awal,
                rutes.nama_tempat_akhir,
                rutes.wilayah_awal,
                rutes.wilayah_akhir,
                jadwals.waktu_berangkat,
                jadwals.tanggal_berangkat,
                jadwals.harga
                ')
            ->get();
        return $data;  
    }
    public function bayar(Request $req){

        $data = Penumpang::where('username',session('username'))->first();

        $sum1 = DB::table('jadwals')
                    ->join('tikets','tikets.id_jadwal','jadwals.id_jadwal')
                    ->where('tikets.username',$data->username)
                    ->where('tikets.status','Menunggu Pembayaran')
                    ->get()
                    ->sum('harga');
        $total = $sum1+'7000';

        if (session('token')==$data->token) {
            $text = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123457890';
            $panj = 5;
            $txtl = strlen($text)-1;
            $kode_pemesanan = '';
            for($i=1; $i<=$panj; $i++){
                $kode_pemesanan .= $text[rand(0, $txtl)];
            }

            $kode = 'PEMS00'.$kode_pemesanan;
            
            Pemesanan::create([
                'kode_pemesanan'=>$kode,
                'id_penumpang'=>$data->id_penumpang,
                'total'=>$total,
            ]);

            Tiket::where('username',$data->username)
                ->where('status','Menunggu Pembayaran')
                ->update([
                    'status'=>'Menunggu Konfirmasi User',
                    'kode_pemesanan'=>$kode,
                ]);

            return view('pemesanan.konfirmasi');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }



    
    public function pemesanan_destroy(Request $req){
        $data = User::where('username',session('username'))->first();

        if (session('token')==$data->remember_token) {
            
            Pemesanan::where('id_jadwal',$req->id_jadwal)->delete();

            $data = ['body'=>'berhasil'];
            return response(json_encode($data),200)->header('Content-Type','text/plain');

        } else {
            $data = ['body'=>'gagal'];
            return response(json_encode($data),401)->header('Content-Type','text/plain');
        }
    }

    public function menunggu_konfirmasi_user_index(){
        return view('transaksi.konfirmasi_user');   
    }
    public function get_menunggu_konfirmasi_user(){
        $data = Pemesanan::join('penumpangs','penumpangs.id_penumpang','pemesanans.id_penumpang')
            ->where('pemesanans.status','Menunggu Konfirmasi User')
            ->orderBy('id_pemesanan','DESC')
            ->selectRaw('pemesanans.status,penumpangs.username,pemesanans.total,pemesanans.kode_pemesanan,pemesanans.created_at')
            ->get();
        return $data;
    }

    public function on_proses(){
        $data = Pemesanan::where('status','Menunggu Konfirmasi Admin')
            ->select('kode_pemesanan')
            ->get();
        return $data; 
    }

    public function menunggu_konfirmasi_admin_index(){
        return view('transaksi.konfirmasi_admin');  
    }
    public function get_menunggu_konfirmasi_admin(){
        $data = Pemesanan::join('penumpangs','penumpangs.id_penumpang','pemesanans.id_penumpang')
            ->where('pemesanans.status','Menunggu Konfirmasi Admin')
            ->orderBy('id_pemesanan','DESC')
            ->selectRaw('pemesanans.status,penumpangs.username,pemesanans.total,pemesanans.kode_pemesanan,pemesanans.created_at')
            ->get();
        return $data; 
    }

    public function sukses_index(){
        return view('transaksi.sukses');  
    }
    public function get_sukses(){
        $data = Pemesanan::join('penumpangs','penumpangs.id_penumpang','pemesanans.id_penumpang')
            ->where('pemesanans.status','Sukses')
            ->orderBy('id_pemesanan','DESC')
            ->selectRaw('pemesanans.status,penumpangs.username,pemesanans.total,pemesanans.kode_pemesanan,pemesanans.created_at')
            ->get();
        return $data;
    }

    public function dibatalkan_index(){
        return view('transaksi.dibatalkan');  
    }
    public function get_dibatalkan(){
        $data = Pemesanan::join('penumpangs','penumpangs.id_penumpang','pemesanans.id_penumpang')
            ->where('pemesanans.status','Batal')
            ->orderBy('id_pemesanan','DESC')
            ->selectRaw('pemesanans.status,penumpangs.username,pemesanans.total,pemesanans.kode_pemesanan,pemesanans.created_at,pemesanans.ket_batal')
            ->get();
        return $data;
    }

    public function checkout(Request $req){
        $cek = Penumpang::join('profiles','profiles.id_penumpang','penumpangs.id_penumpang')
            ->where('penumpangs.username',session('username'))
            ->get();
        if ($cek == "[]") {
            return response(json_encode($cek),422)->header('Content-Type','text/plain');
        } else {
            return response(json_encode($cek),200)->header('Content-Type','text/plain');
        }
    }

    public function index_checkout(){
        return view('pemesanan.checkout');
    }

    public function index_menunggu_konfirmasi(Request $req){
        return view('pemesanan.konfirmasi');
    }
    public function index_sudah_konfirmasi(Request $req){
        return view('pemesanan.sudah_konfirmasi');
    }
    public function index_sukses(Request $req){
        return view('pemesanan.sukses');
    }
    public function index_batal(Request $req){
        return view('pemesanan.dibatalkan');
    }
    public function get_detail(Request $req){
        $username = session('username');
        $data = Pemesanan::join('tikets','tikets.kode_pemesanan','pemesanans.kode_pemesanan')
                        ->join('jadwals','jadwals.id_jadwal','tikets.id_jadwal')
                        ->join('rutes','rutes.id_rute','jadwals.id_rute')
                        ->join('transportasis','transportasis.id_transportasi','rutes.id_transportasi')
                        ->join('type_transportasis','type_transportasis.id_type_transportasi','transportasis.id_type_transportasi')
                        ->where('tikets.username',$username)
                        ->where('tikets.kode_pemesanan',$req->kode_pemesanan)
                        ->selectRaw('
                            type_transportasis.nama_type,
                            type_transportasis.keterangan,
                            tikets.id_tiket,
                            tikets.no_kursi,
                            rutes.rute_awal,
                            rutes.rute_akhir,
                            rutes.nama_tempat_awal,
                            rutes.nama_tempat_akhir,
                            rutes.wilayah_awal,
                            rutes.wilayah_akhir,
                            jadwals.waktu_berangkat,
                            jadwals.tanggal_berangkat,
                            jadwals.harga,
                            pemesanans.total,
                            pemesanans.ket_batal
                            ')
                        ->get();
        return $data;
    }
    public function total_menunggu_konfirmasi(Request $req){
        $data = Pemesanan::where('kode_pemesanan',$req->kode_pemesanan)
            ->select('total')
            ->get();
        return $data;
    } 
    public function tiket_menunggu_konfirmasi(Request $req){
        $user = Penumpang::where('username',session('username'))->first();
        $pemesanan = Pemesanan::orderBy('id_pemesanan','DESC')
            ->selectRaw('kode_pemesanan,created_at,status')
            ->where('status','Menunggu Konfirmasi User')
            ->where('id_penumpang',$user->id_penumpang)
            ->get();
        return $pemesanan;

    }
    public function tiket_sudah_konfirmasi(Request $req){
        $user = Penumpang::where('username',session('username'))->first();
        $pemesanan = Pemesanan::orderBy('id_pemesanan','DESC')
            ->selectRaw('kode_pemesanan,created_at,status')
            ->where('status','Menunggu Konfirmasi Admin')
            ->where('id_penumpang',$user->id_penumpang)
            ->get();
        return $pemesanan;

    }
    public function tiket_sukses(Request $req){
        $user = Penumpang::where('username',session('username'))->first();
        $pemesanan = Pemesanan::orderBy('id_pemesanan','DESC')
            ->selectRaw('kode_pemesanan,created_at,status')
            ->where('status','Sukses')
            ->where('id_penumpang',$user->id_penumpang)
            ->get();
        return $pemesanan;

    }
    public function tiket_batal(Request $req){
        $user = Penumpang::where('username',session('username'))->first();
        $pemesanan = Pemesanan::orderBy('id_pemesanan','DESC')
            ->selectRaw('kode_pemesanan,created_at,status,ket_batal')
            ->where('status','Batal')
            ->where('id_penumpang',$user->id_penumpang)
            ->get();
        return $pemesanan;

    }
    public function total_konfirmasi_admin(Request $req){
        $data = Pemesanan::where('kode_pemesanan',$req->kode_pemesanan)
            ->select('total','ket_batal')
            ->get();
        return $data;
    } 
    public function konfirmasi_pemesanan_admin(Request $req){
        $user = User::where('username',session('username'))->first();
        Tiket::where('kode_pemesanan',$req->kode_pemesanan)
            ->update(['status'=>"Sukses"]);
        Pemesanan::where('kode_pemesanan',$req->kode_pemesanan)
            ->update(['status'=>"Sukses",'id_petugas'=>$user->id]);
    }
    public function konfirmasi_pemesanan_batal(Request $req){
        $user = User::where('username',session('username'))->first();
        Tiket::where('kode_pemesanan',$req->kode_pemesanan)
            ->update(['status'=>"Batal"]);
        Pemesanan::where('kode_pemesanan',$req->kode_pemesanan)
            ->update(['status'=>"Batal",'ket_batal'=>$req->ket_batal,'id_petugas'=>$user->id]);
    }
    
    public function get_upload(Request $req){
        session()->forget('kode_pemesanan');
        $data = Pemesanan::join('konfirmasi_pemesanans','konfirmasi_pemesanans.kode_pemesanan','pemesanans.kode_pemesanan')
                ->where('pemesanans.kode_pemesanan',$req->kode_pemesanan)
                ->selectRaw('
                    pemesanans.kode_pemesanan,
                    konfirmasi_pemesanans.nama_foto,
                    konfirmasi_pemesanans.kode_pemesanan
                ')
                ->get();
        session(['kode_pemesanan'=>$req->kode_pemesanan]);
        return $data;
    }
        
    public $path;
    public $dimensions;
    
    public function __construct()
    {
        //DEFINISIKAN PATH
        $this->path = storage_path('app/public/images');
        //DEFINISIKAN DIMENSI
        $this->dimensions = ['245', '300', '500'];
    }

    public function update_foto(Request $request){
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg'
        ]);
        
        //JIKA FOLDERNYA BELUM ADA
        if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path);
        }
        
        //MENGAMBIL FILE IMAGE DARI FORM
        $file = $request->file('image');
        //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
        Image::make($file)->save($this->path . '/' . $fileName);
        
        //LOOPING ARRAY DIMENSI YANG DI-INGINKAN
        //YANG TELAH DIDEFINISIKAN PADA CONSTRUCTOR
        foreach ($this->dimensions as $row) {
            //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI YANG ADA DI DALAM ARRAY 
            $canvas = Image::canvas($row, $row);
            //RESIZE IMAGE SESUAI DIMENSI YANG ADA DIDALAM ARRAY 
            //DENGAN MEMPERTAHANKAN RATIO
            $resizeImage  = Image::make($file)->resize($row, $row, function($constraint) {
                $constraint->aspectRatio();
            });
            
            //CEK JIKA FOLDERNYA BELUM ADA
            if (!File::isDirectory($this->path . '/' . $row)) {
                //MAKA BUAT FOLDER DENGAN NAMA DIMENSI
                File::makeDirectory($this->path . '/' . $row);
            }
            
            //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
            $canvas->insert($resizeImage, 'center');
            //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
            $canvas->save($this->path . '/' . $row . '/' . $fileName);
        }
        //SIMPAN DATA IMAGE YANG TELAH DI-UPLOAD
        Konfirmasi_pemesanan::where('kode_pemesanan',session('kode_pemesanan'))
            ->update([
            'nama_foto' => $fileName,
            'dimensions' => implode('|', $this->dimensions),
            'path' => $this->path
        ]);
        return view('dashboard.user');
    }

    public function upload(Request $request){
        
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg'
        ]);
        
        //JIKA FOLDERNYA BELUM ADA
        if (!File::isDirectory($this->path)) {
            //MAKA FOLDER TERSEBUT AKAN DIBUAT
            File::makeDirectory($this->path);
        }
        
        //MENGAMBIL FILE IMAGE DARI FORM
        $file = $request->file('image');
        //MEMBUAT NAME FILE DARI GABUNGAN TIMESTAMP DAN UNIQID()
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        //UPLOAD ORIGINAN FILE (BELUM DIUBAH DIMENSINYA)
        Image::make($file)->save($this->path . '/' . $fileName);
        
        //LOOPING ARRAY DIMENSI YANG DI-INGINKAN
        //YANG TELAH DIDEFINISIKAN PADA CONSTRUCTOR
        foreach ($this->dimensions as $row) {
            //MEMBUAT CANVAS IMAGE SEBESAR DIMENSI YANG ADA DI DALAM ARRAY 
            $canvas = Image::canvas($row, $row);
            //RESIZE IMAGE SESUAI DIMENSI YANG ADA DIDALAM ARRAY 
            //DENGAN MEMPERTAHANKAN RATIO
            $resizeImage  = Image::make($file)->resize($row, $row, function($constraint) {
                $constraint->aspectRatio();
            });
            
            //CEK JIKA FOLDERNYA BELUM ADA
            if (!File::isDirectory($this->path . '/' . $row)) {
                //MAKA BUAT FOLDER DENGAN NAMA DIMENSI
                File::makeDirectory($this->path . '/' . $row);
            }
            
            //MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
            $canvas->insert($resizeImage, 'center');
            //SIMPAN IMAGE KE DALAM MASING-MASING FOLDER (DIMENSI)
            $canvas->save($this->path . '/' . $row . '/' . $fileName);
        }
        //SIMPAN DATA IMAGE YANG TELAH DI-UPLOAD
        Konfirmasi_pemesanan::create([
            'kode_pemesanan' =>session('kode_pemesanan'),
            'nama_foto' => $fileName,
            'dimensions' => implode('|', $this->dimensions),
            'path' => $this->path
        ]);
        Tiket::where('kode_pemesanan',session('kode_pemesanan'))
            ->update(['status'=>'Menunggu Konfirmasi Admin']);

        Pemesanan::where('kode_pemesanan',session('kode_pemesanan'))
            ->update(['status'=>'Menunggu Konfirmasi Admin']);
            
        return redirect(route('dashboard_user'));
        //return view('dashboard.user');
    }

}
