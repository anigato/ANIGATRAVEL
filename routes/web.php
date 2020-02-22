<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/','PenumpangController@login')->name('user_login');

Route::get('/admin','AdminController@index');

Auth::routes();
Route::get('/layar/awal',function(){
	return view('user.order');
})->name('cc');
Route::get('/tentang',function(){
	return view('user.content3');
})->name('tentang');
Route::get('/manual',function(){
	return view('user.manual');
})->name('manual');

Route::prefix('/admin')->group(function(){
	Route::get('/register','RegisterController@index')->name('page_register');
	Route::post('/register','RegisterController@register')->name('daftar');
	Route::get('/login','LoginController@index')->name('admin_login');
	Route::post('/login','LoginController@login')->name('login');
	Route::get('/logout','LoginController@logout')->name('logot');

	Route::get('/','TransportasiController@index')->name('home')->middleware('authuser');
});

Route::get('/qr', function () {
	\QrCode::size(500)
		->format('png')
		->generate(public_path('images/qrcode.png'));
	return view('qrCode');
});

Route::group(['middleware'=>['admin']], function(){

	Route::get('/','HomeController@index')->name('home')->middleware('authuser');

	Route::prefix('/driver')->group(function(){
		Route::get('/flight','DriverController@page_flight')->name('driver_page_flight');
		Route::get('/train','DriverController@page_train')->name('driver_page_train');

		Route::post('/','DriverController@create')->name('driver_add');

		Route::get('/all_flight','DriverController@driverAll_flight')->name('driver_all_flight');
		Route::get('/all_train','DriverController@driverAll_train')->name('driver_all_train');

		Route::get('/search_flight','DriverController@search_flight')->name('driver_search_flight');
		Route::get('/search_train','DriverController@search_train')->name('driver_search_train');

		Route::get('/transportasi_flight','DriverController@id_transportasi_flight')->name('id_transportasi_flight');
		Route::get('/transportasi_train','DriverController@id_transportasi_train')->name('id_transportasi_train');

		Route::put('/{id_driver}','DriverController@update')->name('driver_update');
		Route::delete('/{id_driver}','DriverController@destroy')->name('driver_delete');
	});

	Route::prefix('/petugas')->group(function(){
		Route::get('/','RegisterController@page')->name('user_page');
		Route::post('/','RegisterController@create')->name('user_add');
		Route::get('/all','RegisterController@userAll')->name('user_all');
		Route::get('/search','RegisterController@search')->name('user_search');

		Route::get('/{id}','RegisterController@edit')->name('user_edit');
		Route::put('/{id}','RegisterController@update')->name('user_update');
		Route::delete('/{id}','RegisterController@destroy')->name('user_delete');
	});

	Route::prefix('/transportasi')->group(function(){
		Route::get('/flight','TransportasiController@indexs_flight')->name('transportasi_flight');
		Route::get('/train','TransportasiController@indexs_train')->name('transportasi_train');

		Route::post('/','TransportasiController@create')->name('create_transportasi');
		Route::get('/all_flight','TransportasiController@transportasiAll_flight')->name('transportasi_all_flight');
		Route::get('/all_train','TransportasiController@transportasiAll_train')->name('transportasi_all_train');

		Route::get('/search_flight','TransportasiController@search_flight')->name('transportasi_search_flight');
		Route::get('/search_train','TransportasiController@search_train')->name('transportasi_search_train');

		Route::get('/{id_transportasi}','TransportasiController@edit')->name('edit_transportasi');
		Route::put('/{id_transportasi}','TransportasiController@update')->name('update_transportasi');
		Route::delete('/{id_transportasi}','TransportasiController@destroy')->name('delete_transportasi');
	});

	Route::prefix('/type_transportasi')->group(function(){
		Route::get('/flight','TransportasiController@type_index_flight')->name('transportasi_tipe_flight');

		Route::get('/tipe/flight/all','TransportasiController@type_flight_all')->name('type_flight_all');
		Route::get('/tipe/train/all','TransportasiController@type_train_all')->name('type_train_all');

		Route::get('/tipe/flight/search','TransportasiController@type_flight_search')->name('type_flight_search');
		Route::get('/tipe/train/search','TransportasiController@type_train_search')->name('type_train_search');

		Route::get('/type_flight','TransportasiController@type_transportasi_flight')->name('type_flight');
		Route::get('/type_train','TransportasiController@type_transportasi_train')->name('type_train');

		Route::post('/','TransportasiController@type_create')->name('type_create');
		Route::put('/{id_type_transportasi}','TransportasiController@type_update')->name('type_update');
		Route::delete('/{id_type_transportasi}','TransportasiController@type_destroy')->name('type_delete');
	});

	Route::prefix('/anigatravel/diskon')->group(function(){
		Route::get('/', 'DiskonController@index')->name('diskon');
		Route::post('/', 'DiskonController@create')->name('diskon_create');
		Route::get('/all', 'DiskonController@get_all')->name('diskon_all');
		Route::get('/search','DiskonController@search')->name('diskon_search');
		Route::put('/{id_diskon}', 'DiskonController@update')->name('diskon_update');
		Route::delete('/{id_diskon}', 'DiskonController@destroy')->name('diskon_delete');
	});

	Route::prefix('/tempat')->group(function(){
		Route::get('/flight', 'TempatController@index_flight')->name('tempat_flight');
		Route::get('/train', 'TempatController@index_train')->name('tempat_train');
		
		Route::get('/flight/All', 'TempatController@getFLight')->name('get_flight');
		Route::get('/train/All', 'TempatController@getTrain')->name('get_train');
		
		Route::get('/search/flight', 'TempatController@search_flight')->name('search_flight');
		Route::get('/search/train', 'TempatController@search_train')->name('search_train');
		
		Route::post('/', 'TempatController@create')->name('tempat_create');
		Route::put('/{id_tempat}', 'TempatController@update')->name('tempat_update');
		Route::delete('/{id_tempat}', 'TempatController@destroy')->name('tempat_delete');
	});
});

Route::group(['middleware'=>['operator']], function(){
	Route::get('/dashboard','DashboardController@admin')->name('dashboard_admin');
	Route::get('/total_konfirmasi_admin','PemesananController@total_konfirmasi_admin')->name('total_konfirmasi_admin');

	Route::prefix('/transaksi')->group(function(){
		Route::get('/menunggu_konfirmasi_user','PemesananController@menunggu_konfirmasi_user_index')->name('konfirmasi_user_index');
		Route::get('/get_menunggu_konfirmasi_user','PemesananController@get_menunggu_konfirmasi_user')->name('konfirmasi_user');

		Route::get('/menunggu_konfirmasi_admin','PemesananController@menunggu_konfirmasi_admin_index')->name('konfirmasi_admin_index');
		Route::get('/get_menunggu_konfirmasi_admin','PemesananController@get_menunggu_konfirmasi_admin')->name('konfirmasi_admin');
		
		Route::get('/on/proses','PemesananController@on_proses')->name('on_proses');
		Route::get('/lihat','PemesananController@get_upload')->name('lihat');

		Route::get('/sukses','PemesananController@sukses_index')->name('sukses_index');
		Route::get('/get_sukses','PemesananController@get_sukses')->name('sukses');

		Route::get('/dibatalkan','PemesananController@dibatalkan_index')->name('dibatalkan_index');
		Route::get('/get_dibatalkan','PemesananController@get_dibatalkan')->name('dibatalkan');

		Route::post('/','PemesananController@konfirmasi_pemesanan_admin')->name('konfirmasi_pemesanan_admin');
		Route::post('/batal','PemesananController@konfirmasi_pemesanan_batal')->name('konfirmasi_pemesanan_batal');
	});

	Route::prefix('/jadwal')->group(function(){
		Route::get('/flight','JadwalController@jadwal_flight_index')->name('jadwal_flight');
		Route::get('/train','JadwalController@jadwal_train_index')->name('jadwal_train');

		Route::post('/','JadwalController@jadwal_create')->name('jadwal_create');

		Route::get('/flight/all','JadwalController@jadwal_flight_All')->name('jadwal_flight_all');
		Route::get('/train/all','JadwalController@jadwal_train_All')->name('jadwal_train_all');

		Route::get('/flight/search','JadwalController@jadwal_flight_search')->name('jadwal_flight_search');
		Route::get('/train/search','JadwalController@jadwal_train_search')->name('jadwal_train_search');

		Route::get('/flight/rute','JadwalController@jadwal_flight_rute')->name('jadwal_flight_rute');
		Route::get('/train/rute','JadwalController@jadwal_train_rute')->name('jadwal_train_rute');

		Route::put('/{id_jadwal}','JadwalController@jadwal_update')->name('jadwal_update');
		Route::delete('/{id_jadwal}','JadwalController@jadwal_destroy')->name('jadwal_delete');
	});

	Route::prefix('/rute')->group(function(){
		Route::get('/flight','RuteController@rute_index_flight')->name('rute_for_flight');
		Route::get('/train','RuteController@rute_index_train')->name('rute_for_train');
		
		Route::get('/bandara','RuteController@bandara')->name('rute_for_bandara');
		Route::get('/statsiun','RuteController@statsiun')->name('rute_for_statsiun');

		Route::post('/','RuteController@rute_create')->name('rute_create');

		Route::get('/all_flight','RuteController@ruteAll_flight')->name('rute_all_flight');
		Route::get('/all_train','RuteController@ruteAll_train')->name('rute_all_train');

		Route::get('/tampil_bandara','RuteController@tampil_bandara')->name('tampil_bandara');
		Route::get('/tampil_statsiun','RuteController@tampil_statsiun')->name('tampil_statsiun');

		Route::get('/search_flight','RuteController@rute_search_flight')->name('rute_search_flight');
		Route::get('/search_train','RuteController@rute_search_train')->name('rute_search_train');

		Route::get('/trans_flight','RuteController@rute_trans_flight')->name('rute_trans_flight');
		Route::get('/trans_train','RuteController@rute_trans_train')->name('rute_trans_train');

		Route::get('/{id_rute}','RuteController@rute_edit')->name('rute_edit');
		Route::put('/{id_rute}','RuteController@rute_update')->name('rute_update');
		Route::delete('/{id_rute}','RuteController@rute_destroy')->name('rute_delete');
	});

});

Route::group(['middleware'=>['user']], function(){
	Route::get('/riwayat/pemesanan','DashboardController@user')->name('dashboard_user');
	Route::prefix('/anigatravel/order')->group(function(){
		Route::get('/flight','OrderController@index_flight')->name('flight');
		Route::get('/train','OrderController@index_train')->name('train');

		Route::post('/flight','OrderController@rute_flight')->name('rute_flight');
		Route::post('/train','OrderController@rute_train')->name('rute_train');

		Route::post('/detail_flight','OrderController@detail_flight')->name('detail_flight');
		Route::post('/detail_train','OrderController@detail_train')->name('detail_train');

		Route::get('/flight/rute','OrderController@flight')->name('data_flight');
		Route::get('/train/rute','OrderController@train')->name('data_train');

		Route::delete('/{id_order}','OrderController@order_destroy')->name('jadwal_delete');
	});

	Route::prefix('/pemesanan')->group(function(){
		Route::get('/','PemesananController@pemesanan_index')->name('pemesanan');
		Route::get('/all','PemesananController@get_tiket')->name('get_tiket');
		Route::get('/tiket','PemesananController@get_tiket_checkout')->name('get_tiket_checkout');
		Route::get('/detail','PemesananController@get_tiket_detail')->name('get_tiket_detail');
		Route::post('/bayar','PemesananController@bayar')->name('bayar');
		Route::get('/total','PemesananController@get_total')->name('get_total');
		Route::get('/total_bayar','PemesananController@get_total_bayar')->name('get_total_bayar');

		Route::get('/checkout','PemesananController@checkout')->name('checkout');
		Route::get('/index/checkout','PemesananController@index_checkout')->name('index_checkout');

		Route::get('/cek/diskon','PemesananController@cek_diskon')->name('cek_diskon');

		Route::post('/','PemesananController@pemesanan_create')->name('pemesanan_create');
		Route::delete('/{id_pemesanan}','PemesananController@pemesanan_destroy');
	});

	Route::prefix('/anigatravel/konfirmasi')->group(function(){
		Route::get('/menunggu_konfirmasi','PemesananController@index_menunggu_konfirmasi')->name('index_menunggu_konfirmasi');
		Route::get('/sudah_konfirmasi','PemesananController@index_sudah_konfirmasi')->name('index_sudah_konfirmasi');
		Route::get('/sukses','PemesananController@index_sukses')->name('index_sukses');
		Route::get('/batal','PemesananController@index_batal')->name('index_batal');

		Route::get('/total_menunggu_konfirmasi','PemesananController@total_menunggu_konfirmasi')->name('total_menunggu_konfirmasi');
		Route::get('/tiket_menunggu_konfirmasi','PemesananController@tiket_menunggu_konfirmasi')->name('tiket_menunggu_konfirmasi');
		Route::get('/tiket_sudah_konfirmasi','PemesananController@tiket_sudah_konfirmasi')->name('tiket_sudah_konfirmasi');
		Route::get('/tiket_sukses','PemesananController@tiket_sukses')->name('tiket_sukses');
		Route::get('/tiket_batal','PemesananController@tiket_batal')->name('tiket_batal');
	
		Route::get('/get_detil','PemesananController@get_detail')->name('get_detil');

		Route::post('/upload','PemesananController@upload')->name('upload');
		Route::post('/update_foto','PemesananController@update_foto')->name('update_foto');
		Route::get('/get_upload','PemesananController@get_upload')->name('get_upload');

		Route::put('/{id_tiket}','PemesananController@konfirmasi_pemesanan')->name('konfirmasi_pemesanan');

		Route::post('/create','PemesananController@konfirmasi_create')->name('konfirmasi_create');
		Route::delete('/{id_konfirmasi}','PemesananController@konfirmasi_destroy');
	});

	Route::prefix('/anigatravel/tiket')->group(function(){
		Route::get('/','tiketController@tiket_index')->name('tiket');
		Route::post('/','tiketController@tiket_create')->name('tiket_create');
		Route::get('/all','tiketController@tiketAll')->name('tiket_all');
		Route::delete('/{id_tiket}','tiketController@tiket_destroy');
	});
		
	Route::prefix('/anigatravel/user')->group(function(){
		Route::get('/register','PenumpangController@register')->name('user_register');
		Route::post('/register','PenumpangController@daftar')->name('user_daftar');

		Route::get('/login','PenumpangController@login')->name('user_login');
		Route::post('/login','PenumpangController@masuk')->name('user_masuk');

		Route::get('/profile','PenumpangController@profile')->name('profile');
		Route::get('/data','PenumpangController@data')->name('data');

		Route::put('/{id_penumpang}','PenumpangController@update')->name('update');

		Route::get('/logout','PenumpangController@logout')->name('user_logot');
	});
});

Route::prefix('/export')->group(function(){
	Route::get('/pemesanan','ExportController@pemesanan', function () {
		\QrCode::size(500)
			->format('png')
			->generate(public_path('images/qrcode.png'));
	})->name('export_pemesanan');
	Route::get('/admin','ExportController@admin')->name('export_admin');
});


Route::get('/kirim/email','ExportController@email')->name('kirim_email');

Route::prefix('/user')->group(function(){
	Route::get('/register','PenumpangController@register')->name('user_register');
	Route::post('/register','PenumpangController@daftar')->name('user_daftar');

	Route::get('/login','PenumpangController@login')->name('user_login');
	Route::post('/login','PenumpangController@masuk')->name('user_masuk');

	Route::get('/profile','PenumpangController@profile')->name('profile');
	Route::get('/data','PenumpangController@data')->name('data');

	Route::put('/{id_penumpang}','PenumpangController@update')->name('update');

	Route::get('/logout','PenumpangController@logout')->name('user_logot');
});
