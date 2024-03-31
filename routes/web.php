<?php

// use GuzzleHttp\Psr7\Request;
use App\Models\Rawat;
use Illuminate\Http\Request;
use App\Helpers\VclaimHelper;
use App\Models\Pasien\Pasien;
use Illuminate\Support\Facades\DB;
use App\Helpers\SatusehatAuthHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Helpers\SatusehatPasienHelper;
use App\Helpers\SatusehatKondisiHelper;
use App\Helpers\SatusehatResourceHelper;
use App\Http\Controllers\GiziController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\FarmasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterBhpController;
use App\Http\Controllers\PenunjangController;
use App\Http\Controllers\RadiologiController;
use App\Http\Controllers\RawatInapController;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\RekapMedisController;
use App\Http\Controllers\RuanganBedController;
use App\Http\Controllers\FisioTerapiController;
use App\Http\Controllers\LaboratoriumController;
use App\Http\Controllers\TindakLanjutController;
use App\Helpers\Satusehat\Resource\PatientHelper;
use App\Helpers\Satusehat\Resource\LocationHelper;
use App\Http\Controllers\LaporanOperasiController;
use App\Helpers\Satusehat\Resource\EncounterHelper;
use App\Http\Controllers\DetailRekapMedisController;

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

#SS
Route::get('/generate-token-ss', function () {
    return SatusehatAuthHelper::generate_token();
});
#Practitioner
Route::get('/practitioner-nik/{nik}', function ($nik) {
    return SatusehatResourceHelper::practitioner_nik($nik);
});
Route::get('/practitioner-search/{name}/{gender}/{birthdate}', function ($name, $gender, $birthdate) {
    return SatusehatResourceHelper::practitioner_search($name, $gender, $birthdate);
});
Route::get('/practitioner-id/{id}', function ($id) {
    return SatusehatResourceHelper::practitioner_id($id);
});

#Organizations
Route::get('/organizations', function () {
    return SatusehatResourceHelper::organization_create();
});
#Organizations by id
Route::get('/organizations-id/{id}', function ($id) {
    return SatusehatResourceHelper::organization_id($id);
});
#organization_search_partof
Route::get('/organizations-search-partof/{name}', function ($name) {
    return SatusehatResourceHelper::organization_search_partof($name);
});

#Pasien
Route::get('/search-pasien-by-nik/{nik}', function ($nik) {
    return SatusehatPasienHelper::searchPasienByNik($nik);
});
#add_pasien
Route::get('/add-pasien/{id}', function ($id) {
    return SatusehatPasienHelper::add_pasien($id);
});

#Location
Route::prefix('location')->group(function () {
    Route::get('/create', function () {
        return LocationHelper::create();
    });
    Route::get('/search-org-id', function () {
        $id = 100026489; //organization id
        return LocationHelper::searchOrgId($id);
    });
    Route::get('/search-id', function () {
        $id = '07db4207-060a-41ca-b037-a4a852fd0a40'; //location id
        return LocationHelper::searchId($id);
    });
    Route::get('/update', function () {
        $id = '359f5ff7-61cc-4d43-b11b-b947c3ff450e'; //location id
        $data = DB::table('organisasi_satusehat')->get();
        foreach($data as $d){
            LocationHelper::update($d->id_location);
        }
        return 'success';
    });
});

#Encounter
Route::prefix('encounter')->group(function () {
    Route::get('/create', function (Request $request) {
        $idrawat = $request->idrawat;
        $rawat = Rawat::find($idrawat);
        // return $rawat;
        $pasien = Pasien::where('no_rm', $rawat->no_rm)->first();
        $consent = SatusehatResourceHelper::consent_read($pasien->ihs);
        // return $consent;
        return EncounterHelper::create($idrawat);
    });
    Route::get('/find-id', function (Request $request) {
        $idrawat = $request->idrawat;
        $rawat = Rawat::find($idrawat);
        return EncounterHelper::searchId($rawat->id_encounter);
    });
    Route::get('/find-subject', function (Request $request) {
        $idrawat = $request->idrawat;
        $rawat = Rawat::find($idrawat);
        return EncounterHelper::searchSubject($rawat->id);
    });
    Route::get('/update-in-progres', function (Request $request) {
        $idrawat = $request->idrawat;
        $rawat = Rawat::find($idrawat);
        // return $rawat->id_encounter;
        return EncounterHelper::updateInProgress($rawat->id_encounter);
    });
    
});
#Kondisi
Route::prefix('condition')->group(function () {
    Route::get('/create', function (Request $request) {
        $idrawat = $request->idrawat;
        return SatusehatKondisiHelper::create_kondisi($idrawat);
    });
   
});

#Patient
Route::prefix('patient')->group(function () {
    Route::get('/create-nik', function () {
        return PatientHelper::createNik();
    });
    Route::get('/search-nik', function () {
        $nik = 123214213; //example nik
        return PatientHelper::searchNik($nik);
    });
    Route::get('/search-name-birth-nik', function () {
        $nik = 123214213; //example nik
        $nama = 'John';
        $birth = '1945-11-17';
        return PatientHelper::searchNameBirthNik($nama,$birth,$nik);
    });
    Route::get('/search-name-birth-gender', function () {
        $gender = 'female';
        $nama = 'John';
        $birth = '1945-11-17';
        return PatientHelper::searchNameBirthGender($nama,$birth,$gender);
    });
    Route::get('/search-id', function () {
        $id = 'P02029412619'; //example nik
        return PatientHelper::searchId($id);
    });
    Route::get('/create-mother-nik', function () {
        return PatientHelper::createMotherNik();
    });
    Route::get('/search-mother-nik', function () {
        $nik = 123214213; //example nik
        return PatientHelper::searchMotherNik($nik);
    });
});

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
    // $current_time = round(microtime(true) * 1000);
    // echo $current_time;
    return VclaimHelper::getlist_taks($request->kode);
})->name('list-faskes');
Route::get('/update-task', function (HttpRequest $request) {
    $current_time = round(microtime(true) * 1000);
    // echo $current_time;
    return VclaimHelper::update_task($request->kode,5,$current_time);
});


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
Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
});

//Data Master
Route::prefix('data-master')->middleware('auth')->group(function () {
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
Route::prefix('/laporan')->middleware('auth')->group(function () {
    Route::get('/', [LaporanController::class, 'index']);
});

//lab
Route::prefix('/laboratorium')->middleware('auth')->group(function () {
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
Route::prefix('/fisio')->middleware('auth')->group(function () {
    Route::get('/', [FisioTerapiController::class, 'index'])->middleware('auth')->name('fisio.index');
    Route::get('/input-asesmen/{id}', [FisioTerapiController::class, 'input_asesmen'])->middleware('auth')->name('fisio.input-asesmen');
    Route::get('/show-asesmen/{id}', [FisioTerapiController::class, 'show_asesmen'])->middleware('auth')->name('fisio.show-asesmen');
    Route::post('/post-asesmen/{id}', [FisioTerapiController::class, 'post_asesmen'])->middleware('auth')->name('fisio.post-asesmen');
});

//pasien

Route::prefix('/radiologi')->middleware('auth')->group(function () {
    #index
    Route::get('/', [RadiologiController::class, 'index_radiologi'])->name('radiologi.index');
    Route::get('/antrian-radiologi', [RadiologiController::class, 'antrian_radiologi'])->name('radiologi.antrian');
});
Route::prefix('/penunjang')->middleware('auth')->group(function () {
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
    Route::post('/rad-selesai', [PenunjangController::class, 'selesai_pemeriksaan'])->middleware('auth')->name('penunjang.rad-selesai');
    Route::get('/cetak-radiologi/{id}', [PenunjangController::class, 'cetakRadiologi'])->middleware('auth')->name('penunjang.cetak-radiologi');
});
Route::prefix('/farmasi')->middleware('auth')->group(function () {
    Route::get('/batalkan-resep/{id}', [FarmasiController::class, 'batalkan_resep'])->middleware('auth')->name('farmasi.batalkan-resep');
    Route::get('/tambah-resep/{id}', [FarmasiController::class, 'tambah_resep'])->middleware('auth')->name('farmasi.tambah-resep');
    Route::get('/delete-resep/{id}', [FarmasiController::class, 'delete_racikan'])->middleware('auth')->name('farmasi.delete-resep');
    Route::get('/singkron-resep/{id}', [FarmasiController::class, 'singkron_resep'])->middleware('auth')->name('farmasi.singkron-resep');
    Route::get('/antrian', [FarmasiController::class, 'antrian_resep'])->middleware('auth')->name('farmasi.antrian-resep');
    Route::get('/get-edit-farmasi/{id}/{idobat}', [FarmasiController::class, 'get_edit_farmasi'])->middleware('auth')->name('get-edit-farmasi');
    Route::get('/get-edit-racikan/{id}/{idobat}', [FarmasiController::class, 'get_edit_racikan'])->middleware('auth')->name('get-edit-racikan');
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
    Route::get('/cetak-faktur/{id}', [FarmasiController::class, 'cetakfaktur'])->middleware('auth')->name('farmasi.cetak-faktur');
    Route::get('/cetak-resep/{id}', [FarmasiController::class, 'cetakResep'])->middleware('auth')->name('farmasi.cetak-resep');
    Route::get('/cetak-tiket/{id}', [FarmasiController::class, 'cetakTiket'])->middleware('auth')->name('farmasi.cetak-tiket');
    Route::get('/cetak-tiket-tempo/{id}', [FarmasiController::class, 'cetakTiketTempo'])->middleware('auth')->name('farmasi.cetak-tiket-tempo');
    Route::get('/hapus-data-resep', [FarmasiController::class, 'hapus_obat'])->middleware('auth')->name('hapus-data-resep');
    Route::post('/tambah-obat', [FarmasiController::class, 'tambah_obat'])->middleware('auth')->name('farmasi.tambah-obat');
    Route::post('/edit-obat-farmasi', [FarmasiController::class, 'post_edit_farmasi'])->middleware('auth')->name('farmasi.edit-obat-farmasi');
    Route::post('/edit-obat-farmasi-racikan', [FarmasiController::class, 'post_edit_farmasi_racikan'])->middleware('auth')->name('farmasi.edit-obat-farmasi-racikan');
    Route::post('/post-resep-racikan-farmasi/{id}', [FarmasiController::class, 'post_resep_racikan'])->middleware('auth')->name('farmasi.post-resep-racikan');
});
Route::prefix('/rawat-jalan')->middleware('auth')->group(function () {
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
    Route::prefix('/rekam-medis')->middleware('auth')->group(function () {
        Route::get('/{idrawat}/{idrawatbaru}/copy-template', [RekapMedisController::class, 'copy_template'])->name('copy-template');
        Route::get('/{id_resep}/{idrawat}/copy-resep', [RekapMedisController::class, 'copy_resep'])->name('copy-resep');
        Route::get('/{id_pasien}/update-template', [RekapMedisController::class, 'update_template'])->name('update-template');
        Route::get('/{id_pasien}/show', [RekapMedisController::class, 'index_poli'])->name('rekam-medis-poli');
        Route::get('/{no_rm}/{idrawat}/data-resep', [RekapMedisController::class, 'data_resep_pasien'])->name('rekam-medis-poli.data-resep');
        Route::post('/post-resume', [RekapMedisController::class, 'input_resume_poli'])->name('post.resume-poli');
        Route::get('/get-icare/{id}/{bpjs}', [RekapMedisController::class, 'get_icare'])->name('get-icare');
        Route::get('/get-hasil/{id}', [RekapMedisController::class, 'get_hasil'])->name('get-hasil');
        Route::get('/get-hasil-rad/{id}', [RekapMedisController::class, 'get_hasil_rad'])->name('get-hasil-rad');
        Route::get('/get-hasil-lab/{id}', [RekapMedisController::class, 'get_hasil_lab'])->name('get-hasil-lab');
        Route::get('/get-hasil-lab-dua/{id}', [RekapMedisController::class, 'get_hasil_lab_dua'])->name('get-hasil-lab-dua');
        Route::get('/get-data-obat/{id}', [RekapMedisController::class, 'get_data_obat'])->name('get-data-obat');
        Route::get('/get-data-racik-obat/{id}', [RekapMedisController::class, 'get_data_racik_obat'])->name('get-data-racik-obat');
        Route::post('/post-tindakan/{id}', [RekapMedisController::class, 'input_tindakan'])->name('post.tindakan');
        Route::post('/post-copy/{id}', [RekapMedisController::class, 'copy_data'])->name('post.copy-data');
        Route::post('/update-resep/{id}', [RekapMedisController::class, 'post_resep_update_non_racikan'])->name('update-resep-obat');
        Route::post('/post-upload-pengantar/{id}', [RekapMedisController::class, 'upload_file_pengatar'])->name('post.upload-pengantar');
        Route::post('/post-delete-pengantar', [RekapMedisController::class, 'delete_file_pengatar'])->name('post.delete-pengantar');
    });
});
Route::prefix('/rawat-inap')->middleware('auth')->group(function () {
    Route::get('/', [RawatInapController::class, 'index'])->name('index.rawat-inap');
    Route::get('/raber', [RawatInapController::class, 'index_raber'])->name('index.rawat-bersama');
    Route::get('/pasien-pulang', [RawatInapController::class, 'index_pulang'])->name('index.rawat-inap-pulang');
    Route::get('/cetak-ringakasan-pulang/{id}', [RawatInapController::class, 'ringkasan_pulang'])->name('index.rawat-inap-cetak-ringkasan-pulang');
    Route::get('get-ruangan/{id}', [RawatInapController::class, 'get_ruangan'])->name('get-ruangan');
    Route::get('{id}/view', [RawatInapController::class, 'view'])->name('view.rawat-inap');
    Route::get('{id}/order-obat', [RawatInapController::class, 'orderObat'])->name('view.rawat-inap-order');
    Route::get('{id}/detail', [RawatInapController::class, 'detail'])->name('detail.rawat-inap');
    Route::get('{id}/detail-raber', [RawatInapController::class, 'detail_raber'])->name('detail.rawat-bersama');
    Route::get('get-penunjang/{id}', [RawatInapController::class, 'get_penunjang'])->name('detail.get-penunjang');
    Route::get('get-cppt/{id}', [RawatInapController::class, 'get_cppt'])->name('detail.get-cppt');
    Route::get('get-implementasi/{id}', [RawatInapController::class, 'get_implementasi'])->name('detail.get-implementasi');
    Route::get('get-hapus-cppt/{id}', [RawatInapController::class, 'hapus_cppt'])->name('detail.hapus-cppt');
    Route::get('get-hapus-implementasi/{id}', [RawatInapController::class, 'hapus_implementasi'])->name('detail.hapus-implementasi');
    Route::get('{id}/pengkajian-kebidanan', [RawatInapController::class, 'pengkajian_kebidanan'])->name('detail.rawat-inap.pengkajian-kebidanan');
    Route::get('hapus-penunjang/{id}', [RawatInapController::class, 'hapus_penunjang'])->name('detail.hapus-penunjang');
    Route::post('{id}/ringkasan-masuk', [RawatInapController::class, 'postRingkasan'])->name('postRingkasanmasuk.rawat-inap');
    Route::get('{id}/delete-tindakan', [RawatInapController::class, 'delete_tindakan'])->name('delete-tindakan.rawat-inap');
    Route::post('{id}/pemeriksaan-fisik', [RawatInapController::class, 'postPemeriksaanFisik'])->name('postPemeriksaanFisik.rawat-inap');
    Route::post('{id}/order-obat', [RawatInapController::class, 'postOrderObat'])->name('postOrderObat.rawat-inap');
    Route::post('{id}/order-penunjang', [RawatInapController::class, 'postOrderPenunjang'])->name('postOrderPenunjang.rawat-inap');
    Route::post('{id}/post-edit-cppt', [RawatInapController::class, 'post_edit_cppt'])->name('post_edit_cppt.rawat-inap');
    Route::post('{id}/post-cppt', [RawatInapController::class, 'post_cppt'])->name('post_cppt.rawat-inap');
    Route::post('{id}/post-implementasi', [RawatInapController::class, 'post_implementasi'])->name('post_implementasi.rawat-inap');
    Route::post('{id}/post-edit-implementasi', [RawatInapController::class, 'post_edit_implementasi'])->name('post_edit_implementasi.rawat-inap');
    Route::post('{id}/post-diagnosa-akhir', [RawatInapController::class, 'post_diagnosa_akhir'])->name('post-diagnosa-akhir.rawat-inap');
    Route::post('{id}/post-tindakan', [RawatInapController::class, 'post_tindakan'])->name('post_tindakan.rawat-inap');
    Route::post('post-ranap-pulang/{id}', [RawatInapController::class, 'postRanap'])->name('post_pulang.rawat-inap');
    Route::post('post-selesai-resep', [RawatInapController::class, 'postSelesaiObat'])->name('post-selesai-resep.rawat-inap');
    Route::post('post-pengakajian-data-subjektif/{id}', [RawatInapController::class, 'postPengkajianSubjektif'])->name('post.pengakajian-data-subjektif');
    Route::post('post-update-radiologi/{id}', [RawatInapController::class, 'update_radiologi'])->name('post-ranap.update-radiologi');
    Route::post('post-update-lab/{id}', [RawatInapController::class, 'update_lab'])->name('post-ranap.update-lab');
    Route::post('post-raber/{id}', [RawatInapController::class, 'post_raber'])->name('post-raber');
});
Route::prefix('/pasien')->middleware('auth')->group(function () {
    Route::get('/', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('/create', [PasienController::class, 'tambah_pasien_baru'])->name('pasien.tambah-pasien');
    Route::get('/cari-kelurahan', [PasienController::class, 'cari_kelurahan'])->name('pasien.cari-kelurahan');

    //Rekam Medis
    Route::prefix('/rekap-medis')->middleware('auth')->group(function () {
        Route::get('/{id_pasien}/show', [RekapMedisController::class, 'index'])->name('rekap-medis-index');
        Route::post('/store}', [RekapMedisController::class, 'store'])->name('rekap-medis-store');
        Route::post('/selesai/{id}', [RekapMedisController::class, 'selesai_poli'])->name('rekap-medis-selesai');
        Route::post('/post-racikan/{id}', [RekapMedisController::class, 'post_resep_racikan'])->name('rekap-medis.post_resep_racikan');
        Route::post('/post-non-racikan/{id}', [RekapMedisController::class, 'post_resep_non_racikan'])->name('rekap-medis.post_resep_non_racikan');
        Route::post('/post-delete-resep', [RekapMedisController::class, 'post_delete_resep'])->name('post.delete-resep');
        Route::post('/post-edit-jumlah', [RekapMedisController::class, 'edit_jumlah'])->name('post.edit-jumlah');
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
    Route::prefix('/bhp')->middleware('auth')->group(function () {
        Route::get('/', [MasterBhpController::class, 'index'])->name('index.bhp');
        Route::get('/create', [MasterBhpController::class, 'create'])->name('create.bhp');
        Route::post('/store', [MasterBhpController::class, 'store'])->name('store.bhp');
        Route::get('/edit/{id}', [MasterBhpController::class, 'edit'])->name('edit.bhp');
        Route::delete('/delete/{id}', [MasterBhpController::class, 'destroy'])->name('delete.bhp');
    });

    Route::prefix('/operasi')->middleware('auth')->group(function () {
        Route::get('/', [LaporanOperasiController::class, 'index'])->name('index.operasi');
        Route::get('/delete-ok/{id}', [LaporanOperasiController::class, 'delete_tindakan_ok'])->name('delete.operasi');
        Route::get('/bhp/{id}/{operasi}', [LaporanOperasiController::class, 'bhp'])->name('bhp.operasi');
        Route::post('/store', [LaporanOperasiController::class, 'store'])->name('store.operasi');
        Route::get('{id}/show', [LaporanOperasiController::class, 'show'])->name('show.operasi');
        Route::get('{id}/edit', [LaporanOperasiController::class, 'edit'])->name('edit.operasi');
        Route::post('{id}/update', [LaporanOperasiController::class, 'update'])->name('update.operasi');
        Route::post('{id}/update-status', [LaporanOperasiController::class, 'updateStatus'])->name('update-status.operasi');
        Route::post('{id}/post-tindakan', [LaporanOperasiController::class, 'post_tindakan_ok'])->name('post_tindakan_ok.operasi');
        Route::post('{id}/post-bhp', [LaporanOperasiController::class, 'post_bhp_ok'])->name('post_bhp_ok.operasi');
        Route::get('{id}/cetak-laporan', [LaporanOperasiController::class, 'cetakLaporan'])->name('cetak-laporan.operasi');
        Route::prefix('/anestesi')->group(function () {
            Route::post('/update-template/{id}', [TemplateController::class, 'update_anestesi'])->name('post-update-anestesi.operasi');
            Route::post('/catatan', [LaporanOperasiController::class, 'postAnestesi'])->name('post-catatan-anestesi.operasi');
            Route::get('/cetak/{id}', [LaporanOperasiController::class, 'cetakAnestesi'])->name('cetak-catatan-anestesi.operasi');
        });
    });

    //template
    Route::prefix('/template')->middleware('auth')->group(function () {
        Route::get('/', [TemplateController::class, 'index'])->name('index.template');
        Route::get('/template-anastesi', [TemplateController::class, 'index_template_anastesi'])->name('index.template-anastesi');
        Route::get('/create-anastesi', [TemplateController::class, 'create_anastesi'])->name('create.template-anastesi');
        Route::get('/create', [TemplateController::class, 'create'])->name('create.template');
        Route::post('/store', [TemplateController::class, 'store'])->name('store.template');
        Route::post('/store-anastesi', [TemplateController::class, 'store_anastesi'])->name('store.template-anastesi');
        Route::get('/edit/{id}', [TemplateController::class, 'edit'])->name('edit.template');
        Route::get('/edit-anastesi/{id}', [TemplateController::class, 'edit_anastesi'])->name('edit.edit_anastesi');
        Route::post('/update/{id}', [TemplateController::class, 'update'])->name('update.template');
        Route::get('/update-status/{id}/{status}', [TemplateController::class, 'updateStatus'])->name('update-status.template');
        Route::get('/show', [TemplateController::class, 'showTemplate'])->name('show.template');
        Route::get('/show-anastesi', [TemplateController::class, 'showTemplateAnastesi'])->name('show.template-anastesi');
    });

    //gizi
    Route::prefix('/gizi')->middleware('auth')->group(function () {
        Route::get('/{jenisrawat}', [GiziController::class, 'index'])->name('index.gizi');
        Route::get('{id}/show', [GiziController::class, 'show'])->name('show.gizi');
        Route::get('{id}/print-label', [GiziController::class, 'printLabel'])->name('label.gizi');
        Route::get('{id}/delete', [GiziController::class, 'delete'])->name('delete.gizi');
        Route::post('/store/evaluasi-gizi', [GiziController::class, 'storeEvaluasi'])->name('store.evaluasi-gizi');
        Route::post('/store/asuhan-gizi', [GiziController::class, 'storeAsuhan'])->name('store.asuhan-gizi');
        Route::post('/store/cppt-gizi', [GiziController::class, 'storeCppt'])->name('store.cppt-gizi');
        Route::post('/store/skrining-gizi', [GiziController::class, 'storeSkrining'])->name('store.skrining-gizi');
        Route::post('/store/diit', [GiziController::class, 'storeDiit'])->name('store.diit');
    });
})->middleware('auth');

//Ajax
Route::prefix('ajax')->middleware('auth')->group(function () {
    Route::get('bed/edit', [RuanganBedController::class, 'edit'])->name('edit.ruangan-bed-ajax');
    Route::get('get-dokter', [TemplateController::class, 'getDokter'])->name('get-dokter.ajax');
    Route::get('get-perawat', [TemplateController::class, 'getPerawat'])->name('get-perawat.ajax');
});
