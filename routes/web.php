<?php

use App\Models\lokasi;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengaduanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('beranda', [
        'lokasi' => Lokasi::where('validasi', 'diterima')->get(),
    ]);
})->name('beranda');

Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
Route::post('/pengaduan/store', [PengaduanController::class, 'store'])->name('pengaduan.store');

Route::get('/dashboard', function () {
    $total_pengajuan = Lokasi::count();
    $total_valid = Lokasi::where('validasi', 'diterima')->count();
    $total_diterima = Lokasi::where('validasi', 'diajukan')->count();

    $pengajuan_masuk = Lokasi::where('validasi', 'diajukan')
        ->whereDate('created_at', today())
        ->orderBy('created_at', 'desc')
        ->get();

    return view('dashboard', [
        'total_pengajuan' => $total_pengajuan,
        'total_valid' => $total_valid,
        'total_diterima' => $total_diterima,
        'pengajuan_masuk' => $pengajuan_masuk
    ]);
})->name('dashboard');

Route::get('/dashboard/pengajuan', [PengaduanController::class, 'pengajuan'])->name('dashboard.pengajuan');
Route::put('/dashboard/pengajuan/{id_lokasi}/terima', [PengaduanController::class, 'terima'])->name('terima_pengajuan');
Route::delete('/dashboard/pengajuan/{id_lokasi}/tolak', [PengaduanController::class, 'tolak'])->name('tolak_pengajuan');

require __DIR__ . '/auth.php';
