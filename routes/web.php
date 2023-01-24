<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('index');
// });



Route::get('/', 'OtentifikasiController@index')->name('login');

Route::post('/', 'OtentifikasiController@login');

Route::get('buatAkun', 'UsersController@index');

Route::post('tambahAkun', 'UsersController@create');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/beranda', 'Controller@index');

    Route::get('joinKelas', 'KelasController@join');

    Route::post('join', 'KelasController@store');

    Route::get('buatKelas', 'KelasController@index');

    Route::post('tambahKelas', 'KelasController@create');

    Route::get('lihatKelas/{id}', 'KelasController@show');

    Route::get('lihatTugas/{id}', 'KelasController@lihatTugas');

    Route::get('anggotaKelas/{id}', 'KelasController@anggotaKelas');

    Route::get('lihatNilai/{id}', 'KelasController@nilai');

    Route::post('buatPengumuman', 'KelasController@pengumuman');

    Route::get('tambahMateri/{id}', 'KelasController@tambahMateri');

    Route::post('tambahkanMateri', 'KelasController@tambahkanMateri');

    Route::get('buatTugas/{id}', 'KelasController@buatTugas');

    Route::post('buatkanTugas', 'KelasController@buatkanTugas');

    Route::get('tambahAnggota/{id}', 'KelasController@tambahAnggota');

    Route::post('tambahkanAnggota', 'KelasController@tambahkanAnggota');

    Route::get('tugas/{id}', 'KelasController@tugas');

    Route::get('materi/{id}', 'KelasController@materi');

    Route::post('ubahNilai', 'KelasController@ubahNilai');

    Route::post('updateNilai', 'KelasController@updateNilai');

    Route::post('createNilai', 'KelasController@createNilai');

    Route::post('komentar', 'KelasController@komentar');

    Route::get('logout', 'OtentifikasiController@logout');

    Route::get('/daftarKelas', 'Controller@daftarKelas');

    Route::get('/nilaiKelas', 'Controller@nilaiKelas');
    });