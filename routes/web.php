<?php

use App\Helpers\VclaimHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RekapMedisController;
use App\Http\Controllers\DetailRekapMedisController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmasiController;
use App\Http\Controllers\FisioTerapiController;
use App\Http\Controllers\PenunjangController;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\RawatInapController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\RuanganBedController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\LaporanOperasiController;
use App\Http\Controllers\GiziController;
use App\Http\Controllers\LaboratoriumController;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

Route::get('/obat-tes',function(){
    $resep_dokter = DB::table('demo_resep_dokter')->where('idrawat', 39070)->get();
    $non_racik = [];
    $racikan = [];
    foreach($resep_dokter as $rd){
        if($rd->jenis == 'Racik'){
            $data_obat = [];
            $jumlah_obat = [];
            $obat = json_decode($rd->nama_obat);
            foreach($obat->obat as $o){
                $data_obat[] = [
                    'obat'=>$o,
                ];
            }
            foreach($obat->jumlah as $o){
                $jumlah_obat[] = [
                    'jumlah_obat'=>$o,
                ];
            }

            $obatData= json_encode(array_merge($data_obat,$jumlah_obat));
            $data = json_decode($obatData, true);

            // Inisialisasi array 2 dimensi
            $result = [];
            $finalResult = array();
            // Mengelompokkan elemen berdasarkan kunci
            foreach ($data as $item) {
                foreach ($item as $key => $value) {
                    if (!isset($finalResult[$key])) {
                        $finalResult[$key] = array();
                    }
                    $finalResult[$key][] = $value;
                }
            }
            
            // Menggabungkan hasil menjadi array sesuai format yang diinginkan
            $combinedArray = array();
            for ($i = 0; $i < count($finalResult['obat']); $i++) {
                $combinedArray[] = array(
                    'obat' => $finalResult['obat'][$i],
                    'jumlah_obat' => $finalResult['jumlah_obat'][$i]
                );
            }
            
            // return $combinedArray;

            $racikan[] = [
                'obat'=>$combinedArray,
                'jumlah_obat'=>$jumlah_obat,
                'takaran'=>$rd->takaran,
                'dosis'=>$rd->dosis,
                'signa'=>$rd->signa,
                'diminum'=>$rd->diminum,
                'catatan'=>$rd->catatan
            ];
        }else{
            $non_racik[] = [
                'obat'=>$rd->idobat,
                'takaran'=>$rd->takaran,
                'jumlah'=>$rd->jumlah,
                'dosis'=>$rd->dosis,
                'signa'=>$rd->signa,
                'diminum'=>$rd->diminum,
                'catatan'=>$rd->catatan
            ];
        }
    }

 
    DB::table('demo_antrian_resep')->insert([
        'idrawat'=>39070,
        'idbayar'=>2,
        'status_antrian'=>'Antrian',
        'obat'=>json_encode($non_racik),
        'racikan'=>json_encode($racikan),
    ]);
    return [
        'racikan'=>$racikan,
        'non_racik'=>$non_racik
    ];


});

Route::get('/faskes', function (HttpRequest $request) {
    return VclaimHelper::getFaskes($request->q);
})->name('list-faskes');


Route::get('/sarana-faskes/{id}', function ($id) {
    $sarana = VclaimHelper::getFaskesSarana($id);
    foreach ($sarana['list'] as $key => $value) {
        echo "<option value='" . $value['kodeSarana'] . "'>" . $value['namaSarana'] . "</option>";
    }
})->name('sarana-faskes');

Route::get('/spesialistik-faskes/{id}/{tgl}', function ($id, $tgl) {
    $sarana = VclaimHelper::getFaskesSpesialistik($id, $tgl);

    if (isset($sarana['list'])) {
        foreach ($sarana['list'] as $key => $value) {
            if ($value['kapasitas'] < 1) {
                echo "<option disabled value='" . $value['kodeSpesialis'] . "'>" . $value['namaSpesialis'] . " - Kapasitas = " . $value['kapasitas'] . "</option>";
            } else {
                echo "<option  value='" . $value['kodeSpesialis'] . "'>" . $value['namaSpesialis'] . " - Kapasitas = " . $value['kapasitas'] . "</option>";
            }
        }
    }
})->name('spesialistik-faskes');
Route::get('/', function () {
    return view('auth.login');
})->name('login');


Route::get('/chart', function () {
    return view('chart.index');
})->name('chart');


Route::get('/signature/{consid}/{secretkey}/', function ($consid, $secretkey) {
    date_default_timezone_set('UTC');
    $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
    $signature = hash_hmac('sha256', $consid . "&" . $tStamp, $secretkey, true);
    $encodedSignature = base64_encode($signature);
    echo "X-cons-id:" . $consid . " \n";
    echo "X-timestamp:" . $tStamp . "\n ";
    echo "X-signature:" . $encodedSignature;
    // return $encodedSignature;
})->name('signature');

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
Route::prefix('data-master')->group(function () {
    //Ruangan
    Route::prefix('/ruangan')->group(function () {
        Route::get('/', [RuanganController::class, 'index'])->name('index.ruangan');
        Route::post('/store', [RuanganController::class, 'store'])->name('store.ruangan');
        //BED
        Route::prefix('/bed')->group(function () {
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

//lab
Route::prefix('/laboratorium')->group(function () {
    Route::get('/list-pemeriksaan', [LaboratoriumController::class, 'index'])->middleware('auth')->name('laboratorium.list-pemeriksaan');
    Route::get('/list-pasien', [LaboratoriumController::class, 'pasien'])->middleware('auth')->name('laboratorium.list-pasien');
    Route::get('/view-hasil', [LaboratoriumController::class, 'hasil'])->middleware('auth')->name('laboratorium.view-hasil');
    Route::get('/view-hasil-pasien', [LaboratoriumController::class, 'hasilPasien'])->middleware('auth')->name('laboratorium.view-hasil-pasien');
    Route::get('/hapus-pemeriksaan/{id}', [LaboratoriumController::class, 'hapus_pemeriksaan'])->middleware('auth')->name('laboratorium.hapus-pemeriksaan');
    Route::post('/tambah-pemeriksaan/{id}', [LaboratoriumController::class, 'tambah_pemeriksaan'])->middleware('auth')->name('laboratorium.tambah-pemeriksaan');
    Route::post('/tambah-pemeriksaan-lab/{id}', [LaboratoriumController::class, 'tambah_pemeriksaan_lab'])->middleware('auth')->name('laboratorium.tambah-pemeriksaan-lab');
    Route::post('/edit-tgl-hasil/{id}', [LaboratoriumController::class, 'edit_tgl_hasil'])->middleware('auth')->name('laboratorium.edit-tgl');
    Route::post('/hapus-hasil/{id}', [LaboratoriumController::class, 'hapus_hasil'])->middleware('auth')->name('laboratorium.hapus-hasil');
});
//fisio
Route::prefix('/fisio')->group(function () {
    Route::get('/', [FisioTerapiController::class, 'index'])->middleware('auth')->name('fisio.index');
    Route::get('/input-asesmen/{id}', [FisioTerapiController::class, 'input_asesmen'])->middleware('auth')->name('fisio.input-asesmen');
    Route::get('/show-asesmen/{id}', [FisioTerapiController::class, 'show_asesmen'])->middleware('auth')->name('fisio.show-asesmen');
    Route::post('/post-asesmen/{id}', [FisioTerapiController::class, 'post_asesmen'])->middleware('auth')->name('fisio.post-asesmen');
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
    Route::get('/cetak-radiologi/{id}', [PenunjangController::class, 'cetakRadiologi'])->middleware('auth')->name('penunjang.cetak-radiologi');
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
    Route::get('/update-resep', [FarmasiController::class, 'updateResep'])->middleware('auth')->name('farmasi.update-resep');
    Route::get('/cetak-resep-tempo/{id}', [FarmasiController::class, 'cetakResepTempo'])->middleware('auth')->name('farmasi.cetak-resep-tempo');
    Route::get('/cetak-faktur-tempo/{id}', [FarmasiController::class, 'cetakFakturTempo'])->middleware('auth')->name('farmasi.cetak-faktur-tempo');
    Route::get('/cetak-resep/{id}', [FarmasiController::class, 'cetakResep'])->middleware('auth')->name('farmasi.cetak-resep');
    Route::get('/cetak-tiket/{id}', [FarmasiController::class, 'cetakTiket'])->middleware('auth')->name('farmasi.cetak-tiket');
    Route::get('/cetak-tiket-tempo/{id}', [FarmasiController::class, 'cetakTiketTempo'])->middleware('auth')->name('farmasi.cetak-tiket-tempo');
});
Route::prefix('/rawat-jalan')->group(function () {
    Route::get('/poli', [PoliklinikController::class, 'index'])->middleware('auth')->name('poliklinik');
    Route::get('/poli-semua', [PoliklinikController::class, 'index_semua'])->middleware('auth')->name('poliklinik-semua');
    Route::prefix('/tindak-lanjut')->group(function () {
        Route::post('/', [TindakLanjutController::class, 'index'])->name('tindak-lanjut.index');
        Route::get('/aksi-tindak-lanjut/{id}', [TindakLanjutController::class, 'aksi_tindak_lanjut'])->middleware('auth')->name('tindak-lanjut.aksi_tindak_lanjut');
        Route::get('/edit-tindak-lanjut/{id}', [TindakLanjutController::class, 'edit_tindak_lanjut'])->middleware('auth')->name('tindak-lanjut.edit_tindak_lanjut');
        Route::post('/post-tindak-lanjut/{id}', [TindakLanjutController::class, 'post_tindak_lanjut'])->middleware('auth')->name('tindak-lanjut.post_tindak_lanjut');
        Route::post('/hapus-tindak-lanjut', [TindakLanjutController::class, 'hapus_tindak_lanjut'])->middleware('auth')->name('tindak-lanjut.hapus_tindak_lanjut');
        Route::post('/edit-tindak-lanjut/{id}', [TindakLanjutController::class, 'post_edit_tindak_lanjut'])->middleware('auth')->name('tindak-lanjut.post_edit_tindak_lanjut');
    });
    Route::prefix('/rekam-medis')->group(function () {
        Route::get('/{id_pasien}/update-template', [RekapMedisController::class, 'update_template'])->name('update-template');
        Route::get('/{id_pasien}/show', [RekapMedisController::class, 'index_poli'])->name('rekam-medis-poli');
        Route::get('/{no_rm}/data-resep', [RekapMedisController::class, 'data_resep_pasien'])->name('rekam-medis-poli.data-resep');
        Route::post('/post-resume', [RekapMedisController::class, 'input_resume_poli'])->name('post.resume-poli');
        Route::get('/get-hasil/{id}', [RekapMedisController::class, 'get_hasil'])->name('get-hasil');
        Route::get('/get-hasil-rad/{id}', [RekapMedisController::class, 'get_hasil_rad'])->name('get-hasil-rad');
        Route::get('/get-hasil-lab/{id}', [RekapMedisController::class, 'get_hasil_lab'])->name('get-hasil-lab');
        Route::get('/get-data-obat/{id}', [RekapMedisController::class, 'get_data_obat'])->name('get-data-obat');
        Route::get('/get-data-racik-obat/{id}', [RekapMedisController::class, 'get_data_racik_obat'])->name('get-data-racik-obat');
        Route::post('/post-tindakan/{id}', [RekapMedisController::class, 'input_tindakan'])->name('post.tindakan');
        Route::post('/post-copy/{id}', [RekapMedisController::class, 'copy_data'])->name('post.copy-data');
        Route::post('/update-resep/{id}', [RekapMedisController::class, 'post_resep_update_non_racikan'])->name('update-resep-obat');
        Route::post('/post-upload-pengantar/{id}', [RekapMedisController::class, 'upload_file_pengatar'])->name('post.upload-pengantar');
        Route::post('/post-delete-pengantar', [RekapMedisController::class, 'delete_file_pengatar'])->name('post.delete-pengantar');
    });
});
Route::prefix('/rawat-inap')->group(function () {
    Route::get('/', [RawatInapController::class, 'index'])->name('index.rawat-inap');
    Route::get('{id}/view', [RawatInapController::class, 'view'])->name('view.rawat-inap');
    Route::get('{id}/detail', [RawatInapController::class, 'detail'])->name('detail.rawat-inap');
    Route::get('{id}/pengkajian-kebidanan', [RawatInapController::class, 'pengkajian_kebidanan'])->name('detail.rawat-inap.pengkajian-kebidanan');
    Route::post('{id}/ringkasan-masuk', [RawatInapController::class, 'postRingkasan'])->name('postRingkasanmasuk.rawat-inap');
    Route::post('{id}/pemeriksaan-fisik', [RawatInapController::class, 'postPemeriksaanFisik'])->name('postPemeriksaanFisik.rawat-inap');
    Route::post('{id}/order-obat', [RawatInapController::class, 'postOrderObat'])->name('postOrderObat.rawat-inap');
    Route::post('{id}/order-penunjang', [RawatInapController::class, 'postOrderPenunjang'])->name('postOrderPenunjang.rawat-inap');
    Route::post('{id}/post-cppt', [RawatInapController::class, 'post_cppt'])->name('post_cppt.rawat-inap');
    Route::post('{id}/post-implementasi', [RawatInapController::class, 'post_implementasi'])->name('post_implementasi.rawat-inap');    
    Route::post('{id}/post-diagnosa-akhir', [RawatInapController::class, 'post_diagnosa_akhir'])->name('post-diagnosa-akhir.rawat-inap');
    Route::post('{id}/post-tindakan', [RawatInapController::class, 'post_tindakan'])->name('post_tindakan.rawat-inap');
    Route::post('post-ranap-pulang', [RawatInapController::class, 'postRanap'])->name('post_pulang.rawat-inap');
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
        Route::post('/post-racikan/{id}', [RekapMedisController::class, 'post_resep_racikan'])->name('rekap-medis.post_resep_racikan');
        Route::post('/post-non-racikan/{id}', [RekapMedisController::class, 'post_resep_non_racikan'])->name('rekap-medis.post_resep_non_racikan');
        Route::post('/post-delete-resep', [RekapMedisController::class, 'post_delete_resep'])->name('post.delete-resep');
        Route::prefix('/detail')->group(function () {
            Route::get('/{id_rekapmedis}/index', [DetailRekapMedisController::class, 'index'])->name('detail-rekap-medis-index');
            Route::get('/create', [DetailRekapMedisController::class, 'create'])->name('detail-rekap-medis-create');
            Route::post('/{id_rekapmedis}/store', [DetailRekapMedisController::class, 'store'])->name('detail-rekap-medis-store');
            Route::get('/show/{id}', [DetailRekapMedisController::class, 'show'])->name('detail-rekap-medis-show');
            Route::post('/{id_pasien}/update', [DetailRekapMedisController::class, 'update'])->name('detail-rekap-medis-update');
            Route::post('/{id}/post-sbar', [DetailRekapMedisController::class, 'post_sbar'])->name('detail-rekap-medis.post_sbar');
            Route::get('/cetak/{id}', [DetailRekapMedisController::class, 'cetak'])->name('detail-rekap-medis-cetak');
            Route::get('/cetak-resep/{id}', [DetailRekapMedisController::class, 'cetak_resep'])->name('resep-rekap-medis-cetak');
        });
    });

    //operasi
    Route::prefix('/operasi')->group(function () {
        Route::get('/', [LaporanOperasiController::class, 'index'])->name('index.operasi');
        Route::get('/bhp/{id}', [LaporanOperasiController::class, 'bhp'])->name('bhp.operasi');
        Route::post('/store', [LaporanOperasiController::class, 'store'])->name('store.operasi');
        Route::get('{id}/show', [LaporanOperasiController::class, 'show'])->name('show.operasi');
        Route::get('{id}/edit', [LaporanOperasiController::class, 'edit'])->name('edit.operasi');
        Route::post('{id}/update', [LaporanOperasiController::class, 'update'])->name('update.operasi');
        Route::post('{id}/update-status', [LaporanOperasiController::class, 'updateStatus'])->name('update-status.operasi');
        Route::post('{id}/post-tindakan', [LaporanOperasiController::class, 'post_tindakan_ok'])->name('post_tindakan_ok.operasi');
        Route::post('{id}/post-bhp', [LaporanOperasiController::class, 'post_bhp_ok'])->name('post_bhp_ok.operasi');
        Route::get('{id}/cetak-laporan', [LaporanOperasiController::class, 'cetakLaporan'])->name('cetak-laporan.operasi');
    });

    //gizi
    Route::prefix('/gizi')->group(function () {
        Route::get('/', [GiziController::class, 'index'])->name('index.gizi');
        Route::get('{id}/show', [GiziController::class, 'show'])->name('show.gizi');
        Route::post('/store/evaluasi-gizi', [GiziController::class, 'storeEvaluasi'])->name('store.evaluasi-gizi');
        Route::post('/store/asuhan-gizi', [GiziController::class, 'storeAsuhan'])->name('store.asuhan-gizi');
        Route::post('/store/cppt-gizi', [GiziController::class, 'storeCppt'])->name('store.cppt-gizi');
        Route::post('/store/skrining-gizi', [GiziController::class, 'storeSkrining'])->name('store.skrining-gizi');
    });
})->middleware('auth');

//Ajax
Route::prefix('ajax')->group(function () {
    Route::get('bed/edit', [RuanganBedController::class, 'edit'])->name('edit.ruangan-bed-ajax');
});
