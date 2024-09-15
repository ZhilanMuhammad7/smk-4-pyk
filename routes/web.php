<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UlasanController;

Route::get('/master', function () {
    return view('layouts.master');
});

Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
});

//auth
Route::prefix('/')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/postlogin', [AuthController::class, 'postlogin'])->name('auth.postlogin');
    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/postRegister', [AuthController::class, 'postRegister'])->name('auth.postRegister');
});

//Pengajuan
Route::prefix('pengajuan')->group(function () {
    Route::get('/', [SiswaController::class, 'index'])->name('pengajuan.index');
    Route::post('/store', [SiswaController::class, 'store'])->name('pengajuan.store');
    Route::get('/edit/{id}', [SiswaController::class, 'edit'])->name('pengajuan.edit');
    Route::post('/update', [SiswaController::class, 'update'])->name('pengajuan.update');
    Route::delete('/{id}', [SiswaController::class, 'destroy'])->name('pengajuan.destroy');
    Route::get('/detail/{id}', [SiswaController::class, 'detail'])->name('pengajuan.detail');
    Route::get('/status', [SiswaController::class, 'statusSurat'])->name('status.statusSurat');

    Route::post('/pengajuan/update-status', [SiswaController::class, 'updateStatus'])->name('pengajuan.updateStatus');

});

//Aprove Pengajuan
Route::prefix('data-pengajuan')->group(function () {
    Route::get('/', [GuruController::class, 'index'])->name('data-pengajuan.index');
    Route::post('/store', [GuruController::class, 'store'])->name('data-pengajuan.store');
    Route::get('/edit/{id}', [GuruController::class, 'edit'])->name('data-pengajuan.edit');
    Route::post('/update', [GuruController::class, 'update'])->name('data-pengajuan.update');
    Route::delete('/{id}', [GuruController::class, 'destroy'])->name('data-pengajuan.destroy');
    Route::get('/konfirmasi', [GuruController::class, 'konfirmasi'])->name('data-pengajuan.konfirmasi');
    Route::post('/approval', [GuruController::class, 'approval'])->name('data-pengajuan.approval');
    Route::get('/approvalPKL/{id}', [GuruController::class, 'updateStatus'])->name('data-pengajuan.approvalPKL');
});



Route::get('/bankpkl', [SiswaController::class, 'bankpkl'])->name('bankpkl.index');
Route::get('/surat-pkl', [SiswaController::class, 'surat'])->name('surat-pkl.index');
Route::get('/formSurat', [SiswaController::class, 'formSurat'])->name('formSurat.index');
Route::get('/mitra', [MitraController::class, 'mitraSiswa'])->name('mitra.index');
Route::get('/formPengajuanMitra/{id}', [SiswaController::class, 'formPengajuanMitra'])->name('formPengajuanMitra');
Route::post('/addPengajuanMitra', [SiswaController::class, 'create'])->name('pengajuan.create');
Route::get('/statusPengajuanMitra', [SiswaController::class, 'statusPengajuanMitra'])->name('statusPengajuanMitra');
Route::get('/formPengajuanPKL', [SiswaController::class, 'formPengajuanPKL']);


//Login Google
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle')->name('auth.google');
// Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

//Guru
Route::get('/formMitra', [MitraController::class, 'formMitra'])->name('mitra.formMitra');
Route::get('/suratPKL', [MitraController::class, 'suratPKL']);
Route::get('/dataPengajuan', [MitraController::class, 'dataPengajuan']);
Route::get('/mitra_pkl', [MitraController::class, 'mitra'])->name('Guru.mitraPKL');
Route::get('/lihatPengajuan/{id}', [MitraController::class, 'lihatPengajuan'])->name('Guru.lihatPengajuan');
Route::get('/konfirmasi/{id}', [MitraController::class, 'konfirmasi'])->name('Guru.konfirmasi');
Route::get('/tolak/{id}', [MitraController::class, 'tolak'])->name('Guru.tolak');



//TambahMitra
Route::post('/Tambahmitra', [MitraController::class, 'store'])->name(('mitra.store'));
Route::post('/ulasan', [MitraController::class, 'ulasan'])->name('mitra.ulasan');
//EditMitra
Route::get('/editMitra/{id}', [MitraController::class, 'edit'])->name('Guru.editMitra');
Route::PUT('/updateMitra/{id}', [MitraController::class, 'update'])->name('Guru.updateMitra');

//deleteMitra
Route::get('/deleteMitra/{id}', [MitraController::class, 'delete'])->name('Guru.deleteMitra');

//layanan Akadedmik
Route::prefix('layanan-akademik')->group(function () {
    Route::get('/', [SuratController::class, 'index'])->name('layanan-akademik.index');
    Route::post('/store', [SuratController::class, 'store'])->name('layanan-akademik.store');
    Route::get('/edit/{id}', [SuratController::class, 'edit'])->name('layanan-akademik.edit');
    Route::post('/update', [SuratController::class, 'update'])->name('layanan-akademik.update');
    Route::delete('/{id}', [SuratController::class, 'destroy'])->name('layanan-akademik.destroy');
    Route::get('/detail/{id}', [SuratController::class, 'detail'])->name('layanan-akademik.detail');
    Route::get('/konfirm-surat', [SuratController::class, 'konfirmSurat'])->name('layanan-akademik.konfirmSurat');
    Route::get('/konfirmSurat/{id}', [SuratController::class, 'aprovalSurat'])->name('layanan-akademik.aprovalSurat');
    Route::get('/downloadSurat/{id}', [SuratController::class, 'downloadSurat'])->name('layanan-akademik.downloadSurat');
});

Route::prefix('ulasan')->group(function () {
    Route::get('/', [UlasanController::class, 'index'])->name('ulasan.index');
    Route::post('/store', [UlasanController::class, 'store'])->name('ulasan.store');
    Route::get('/edit/{id}', [UlasanController::class, 'edit'])->name('ulasan.edit');
    Route::post('/update', [UlasanController::class, 'update'])->name('ulasan.update');
    Route::delete('/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');


});


Route::get('/penilaian-ulasan', [UlasanController::class, 'getUlasanData'])->name('penilaian.ulasan');
Route::post('/penilaian-ulasan-submit', [UlasanController::class, 'submitUlasan'])->name('penilaian.ulasan.submit');
Route::get('/ulasan/list', [UlasanController::class, 'showAllUlasan'])->name('ulasan.list');
