<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RekapMedisController;
use App\Http\Controllers\DetailRekapMedisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmasiController;
use App\Http\Controllers\PenunjangController;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\RawatInapController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\RuanganBedController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\LaporanOperasiController;
use App\Http\Controllers\GiziController;

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
    return view('auth.login');
})->name('login');

//auth
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/index', function () {
    return view('layouts.index');
})->middleware('auth');

//Dasboard
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
});

//Data Master
Route::prefix('data-master')->group(function() {
    //Ruangan
    Route::prefix('/ruangan')->group(function() {
        Route::get('/', [RuanganController::class, 'index'])->name('index.ruangan');
        Route::post('/store', [RuanganController::class, 'store'])->name('store.ruangan');
            //BED
            Route::prefix('/bed')->group(function() {
                Route::get('/{id_ruangan}', [RuanganBedController::class, 'index'])->name('index.ruangan-bed');
                Route::post('/store', [RuanganBedController::class, 'store'])->name('store.ruangan-bed');
                Route::post('/update', [RuanganBedController::class, 'update'])->name('update.ruangan-bed');
        });
    });
});

//Laporan
Route::prefix('/laporan')->group(function () {
    Route::get('/', [LaporanController::class, 'index']);
});

//pasien
Route::prefix('/penunjang')->group(function () {
    Route::get('/antrian/{jenis}', [PenunjangController::class, 'antrian'])->middleware('auth')->name('penunjang.antrian');
    Route::get('/detail-penunjang/{id}/{jenis}', [PenunjangController::class, 'detail_penunjang'])->middleware('auth')->name('penunjang.detail');
    Route::get('/input-hasil-radiologi/{id}/{idpemeriksaan}', [PenunjangController::class, 'input_hasil_radiologi'])->middleware('auth')->name('penunjang.input-hasil-radiologi');
    Route::get('/input-hasil/{id}/{idpemeriksaan}', [PenunjangController::class, 'input_hasil_lab'])->middleware('auth')->name('penunjang.input-hasil');
    Route::get('/input-hasil-fisio/{id}/{idpemeriksaan}', [PenunjangController::class, 'input_hasil_fisio'])->middleware('auth')->name('penunjang.input-hasil-fisio');
    Route::get('/lihat-hasil/{id}/{idpemeriksaan}', [PenunjangController::class, 'lihat_hasil_lab'])->middleware('auth')->name('penunjang.lihat-hasil');

    Route::post('/post-lab-hasil/{id}', [PenunjangController::class, 'post_data_hasil_lab'])->middleware('auth')->name('penunjang.lab-post-hasil');
    Route::post('/post-rad-hasil/{id}', [PenunjangController::class, 'post_data_hasil_rad'])->middleware('auth')->name('penunjang.rad-post-hasil');
    Route::post('/post-fisio-hasil/{id}', [PenunjangController::class, 'post_data_hasil_fisio'])->middleware('auth')->name('penunjang.fisio-post-hasil');
    Route::post('/post-lab/{id}', [PenunjangController::class, 'kerjakan_lab'])->middleware('auth')->name('penunjang.lab-post');
    Route::post('/post-rad/{id}', [PenunjangController::class, 'kerjakan_rad'])->middleware('auth')->name('penunjang.rad-post');
    Route::post('/post-fisio/{id}', [PenunjangController::class, 'kerjakan_fisio'])->middleware('auth')->name('penunjang.fisio-post');
    Route::post('/post-foto/{id}', [PenunjangController::class, 'post_foto_rad'])->middleware('auth')->name('penunjang.rad-post-foto');
});
Route::prefix('/farmasi')->group(function () {
    Route::get('/antrian', [FarmasiController::class, 'antrian_resep'])->middleware('auth')->name('farmasi.antrian-resep');
    Route::get('/status-rajal/{id}', [FarmasiController::class, 'status_rajal'])->middleware('auth')->name('farmasi.status-rajal');
    Route::get('/status-ranap/{id}', [FarmasiController::class, 'status_ranap'])->middleware('auth')->name('farmasi.status-ranap');
    Route::get('/list-pasien-rawat', [FarmasiController::class, 'list_pasien_rawat'])->middleware('auth')->name('farmasi.list-pasien-rawat');
    Route::get('/list-resep', [FarmasiController::class, 'list_resep'])->middleware('auth')->name('farmasi.list-resep');
    Route::get('/list-obat', [FarmasiController::class, 'list_obat'])->middleware('auth')->name('farmasi.list-obat');
    Route::post('/post-resep/{id}', [FarmasiController::class, 'post_resep'])->middleware('auth')->name('farmasi.post-resep');
    Route::post('/post-pemberian/{id}', [FarmasiController::class, 'post_pemberian'])->middleware('auth')->name('farmasi.post-pemberian');
});
Route::prefix('/rawat-jalan')->group(function () {
    Route::get('/poli', [PoliklinikController::class, 'index'])->middleware('auth')->name('poliklinik');
    Route::get('/poli-semua', [PoliklinikController::class, 'index_semua'])->middleware('auth')->name('poliklinik-semua');
    Route::prefix('/tindak-lanjut')->group(function () {
        Route::post('/', [TindakLanjutController::class, 'index'])->name('tindak-lanjut.index');
        Route::get('/aksi-tindak-lanjut/{id}', [TindakLanjutController::class, 'aksi_tindak_lanjut'])->name('tindak-lanjut.aksi_tindak_lanjut');
        Route::post('/post-tindak-lanjut/{id}', [TindakLanjutController::class, 'post_tindak_lanjut'])->name('tindak-lanjut.post_tindak_lanjut');
    });
    Route::prefix('/rekam-medis')->group(function () {
        Route::get('/{id_pasien}/show', [RekapMedisController::class, 'index_poli'])->name('rekam-medis-poli');
        Route::post('/post-resume', [RekapMedisController::class, 'input_resume_poli'])->name('post.resume-poli');
        Route::get('/get-hasil/{id}', [RekapMedisController::class, 'get_hasil'])->name('get-hasil');
        Route::get('/get-hasil-rad/{id}', [RekapMedisController::class, 'get_hasil_rad'])->name('get-hasil-rad');
        Route::get('/get-hasil-lab/{id}', [RekapMedisController::class, 'get_hasil_lab'])->name('get-hasil-lab');
        Route::post('/post-tindakan/{id}', [RekapMedisController::class, 'input_tindakan'])->name('post.tindakan');
        Route::post('/post-copy/{id}', [RekapMedisController::class, 'copy_data'])->name('post.copy-data');
        Route::post('/post-upload-pengantar/{id}', [RekapMedisController::class, 'upload_file_pengatar'])->name('post.upload-pengantar');
    });
});
Route::prefix('/rawat-inap')->group(function () {
    Route::get('/', [RawatInapController::class, 'index'])->name('index.rawat-inap');
    Route::get('{id}/view', [RawatInapController::class, 'view'])->name('view.rawat-inap');
    Route::get('{id}/detail', [RawatInapController::class, 'detail'])->name('detail.rawat-inap');
    Route::post('{id}/ringkasan-masuk', [RawatInapController::class, 'postRingkasan'])->name('postRingkasanmasuk.rawat-inap');
    Route::post('{id}/order-obat', [RawatInapController::class, 'postOrderObat'])->name('postOrderObat.rawat-inap');
    Route::post('{id}/order-penunjang', [RawatInapController::class, 'postOrderPenunjang'])->name('postOrderPenunjang.rawat-inap');
});
Route::prefix('/pasien')->group(function () {
    Route::get('/', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('/create', [PasienController::class, 'tambah_pasien_baru'])->name('pasien.tambah-pasien');
    Route::get('/cari-kelurahan', [PasienController::class, 'cari_kelurahan'])->name('pasien.cari-kelurahan');

    //Rekam Medis
    Route::prefix('/rekap-medis')->group(function () {
        Route::get('/{id_pasien}/show', [RekapMedisController::class, 'index'])->name('rekap-medis-index');
        Route::post('/store}', [RekapMedisController::class, 'store'])->name('rekap-medis-store');
        Route::post('/selesai/{id}', [RekapMedisController::class, 'selesai_poli'])->name('rekap-medis-selesai');
        Route::prefix('/detail')->group(function () {
            Route::get('/{id_rekapmedis}/index', [DetailRekapMedisController::class, 'index'])->name('detail-rekap-medis-index');
            Route::get('/create', [DetailRekapMedisController::class, 'create'])->name('detail-rekap-medis-create');
            Route::post('/{id_rekapmedis}/store', [DetailRekapMedisController::class, 'store'])->name('detail-rekap-medis-store');
            Route::get('/show/{id}', [DetailRekapMedisController::class, 'show'])->name('detail-rekap-medis-show');
            Route::post('/{id_pasien}/update', [DetailRekapMedisController::class, 'update'])->name('detail-rekap-medis-update');
            Route::get('/cetak/{id}', [DetailRekapMedisController::class, 'cetak'])->name('detail-rekap-medis-cetak');
            Route::get('/cetak-resep/{id}', [DetailRekapMedisController::class, 'cetak_resep'])->name('resep-rekap-medis-cetak');
        });
    });

    //operasi
    Route::prefix('/operasi')->group(function () {
        Route::get('/', [LaporanOperasiController::class, 'index'])->name('index.operasi');
        Route::post('/store', [LaporanOperasiController::class, 'store'])->name('store.operasi');
        Route::get('{id}/show', [LaporanOperasiController::class, 'show'])->name('show.operasi');
        Route::get('{id}/edit', [LaporanOperasiController::class, 'edit'])->name('edit.operasi');
        Route::post('{id}/update', [LaporanOperasiController::class, 'update'])->name('update.operasi');
        Route::post('{id}/update-status', [LaporanOperasiController::class, 'updateStatus'])->name('update-status.operasi');
    });

    //gizi
    Route::prefix('/gizi')->group(function () {
        Route::get('/', [GiziController::class, 'index'])->name('index.gizi');
        Route::get('{id}/show', [GiziController::class, 'show'])->name('show.gizi');
        Route::post('/store/evaluasi-gizi', [GiziController::class, 'storeEvaluasi'])->name('store.evaluasi-gizi');
        Route::post('/store/asuhan-gizi', [GiziController::class, 'storeAsuhan'])->name('store.asuhan-gizi');
    });

})->middleware('auth');

//Ajax
Route::prefix('ajax')->group(function() {
    Route::get('bed/edit', [RuanganBedController::class, 'edit'])->name('edit.ruangan-bed-ajax');
});

