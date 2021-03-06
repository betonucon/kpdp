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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('/about', 'AboutController@index');
    Route::post('/about/simpan_sekilas', 'AboutController@simpan_sekilas');
    Route::post('/about/simpan_visi', 'AboutController@simpan_visi');
    Route::post('/about/simpan_kontak', 'AboutController@simpan_kontak');
    Route::post('/about/simpan_corporate', 'AboutController@simpan_corporate');
    Route::post('/about/simpan_sertifikat', 'AboutController@simpan_sertifikat');
});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('/news', 'NewsController@index');
    Route::get('/news/ubah', 'NewsController@ubah');
    Route::get('/news/hapus', 'NewsController@hapus');
    Route::get('/news/hapus_gambar', 'NewsController@hapus_gambar');
    Route::get('/news/view_data', 'NewsController@view_data');
    Route::post('/news/simpan', 'NewsController@simpan');
    Route::post('/news/simpan_ubah', 'NewsController@simpan_ubah');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/struktur', 'StrukturController@index');
    Route::get('/struktur/ubah', 'StrukturController@ubah');
    Route::get('/struktur/hapus', 'StrukturController@hapus');
    Route::get('/struktur/hapus_gambar', 'StrukturController@hapus_gambar');
    Route::get('/struktur/view_data', 'StrukturController@view_data');
    Route::post('/struktur/simpan', 'StrukturController@simpan');
    Route::post('/struktur/simpan_ubah', 'StrukturController@simpan_ubah');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/barner', 'BarnerController@index');
    Route::get('/barner/ubah', 'BarnerController@ubah');
    Route::get('/barner/hapus', 'BarnerController@hapus');
    Route::get('/barner/hapus_gambar', 'BarnerController@hapus_gambar');
    Route::get('/barner/view_data', 'BarnerController@view_data');
    Route::post('/barner/simpan', 'BarnerController@simpan');
    Route::post('/barner/simpan_ubah', 'BarnerController@simpan_ubah');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/pengumuman', 'PengumumanController@index');
    Route::get('/pengumuman/ubah', 'PengumumanController@ubah');
    Route::get('/pengumuman/hapus', 'PengumumanController@hapus');
    Route::get('/pengumuman/hapus_gambar', 'PengumumanController@hapus_gambar');
    Route::get('/pengumuman/view_data', 'PengumumanController@view_data');
    Route::post('/pengumuman/simpan', 'PengumumanController@simpan');
    Route::post('/pengumuman/simpan_ubah', 'PengumumanController@simpan_ubah');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/produk', 'ProdukController@index');
    Route::get('/produk/ubah', 'ProdukController@ubah');
    Route::get('/produk/hapus', 'ProdukController@hapus');
    Route::get('/produk/hapus_gambar', 'ProdukController@hapus_gambar');
    Route::get('/produk/view_data', 'ProdukController@view_data');
    Route::post('/produk/simpan', 'ProdukController@simpan');
    Route::post('/produk/simpan_ubah', 'ProdukController@simpan_ubah');
});

Route::group(['middleware'    => 'auth'],function(){

});

Route::group(['middleware'    => 'auth'],function(){

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
