<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Models\TemplateAnastesi;
use App\Http\Controllers\Controller;
use App\Models\Operasi\PerawatBedah;
use App\Models\Template\TemplateOperasi;
use Illuminate\Support\Collection;

class TemplateController extends Controller
{
    public function index_template_anastesi(){
        $data = TemplateAnastesi::all();
        return view('template.index-anastesi', compact('data'));
    }

    public function edit_anastesi($id)
    {
        $data = TemplateAnastesi::find($id);
        return view('template.edit-anastesi', compact('data'));
    }
    public function create_anastesi()
    {
        $perawatBedah = PerawatBedah::orderBy('nama','asc')->get();
        $dokter = Dokter::where('status',1)->where('kode_dpjp','!=',NULL)->orderBy('nama_dokter', 'asc')->get();

        return view('template.create-anastesi', compact('perawatBedah','dokter'));
    }

    public function index()
    {
        $data = TemplateOperasi::all();
        return view('template.index', compact('data'));
    }

    public function create()
    {
        $perawatBedah = PerawatBedah::orderBy('nama','asc')->get();
        $dokter = Dokter::where('status',1)->where('kode_dpjp','!=',NULL)->orderBy('nama_dokter', 'asc')->get();

        return view('template.create', compact('perawatBedah','dokter'));
    }

    public function update_anestesi(Request $request, $id)
    {
        $stadia = new Collection([
            'anestesi' => $request->anestesi,
            'operasi' => $request->operasi,
            'respirasi' => $request->respirasi
        ]);
        $data = TemplateAnastesi::find($id);

        $data->obat_anestesi =  json_encode($request->obat_anestesi_catatan);
        $data->nama = $request->nama;
        $data->teknik_anestesi = $request->teknik_anestesis;
        $data->premedikasi = $request->premedikasi;
        $data->pemberian = $request->pemberian;
        $data->posisi = $request->posisi;
        $data->efek = $request->efek;
        $data->stadia = $stadia;
        $data->catatan = $request->catatan;
        $data->lama_anestesi = $request->lama_anestesi;
        $data->pra_anestesi = $request->pra_anestesi;
        $data->post_anestesi = $request->post_anestesi;
        $data->status = 1;
        $data->save();

        return redirect()->back()->with('berhasil','Data Berhasil di Ubah!');
    }

    public function store_anastesi(Request $request){
        // return $request->all();
        $stadia = new Collection([
            'anestesi' => $request->anestesi,
            'operasi' => $request->operasi,
            'respirasi' => $request->respirasi
        ]);
        $data = new TemplateAnastesi;
        $data->obat_anestesi =  json_encode($request->obat_anestesi_catatan);
        $data->nama = $request->nama;
        $data->teknik_anestesi = $request->teknik_anestesis;
        $data->premedikasi = $request->premedikasi;
        $data->pemberian = $request->pemberian;
        $data->efek = $request->efek;
        $data->stadia = $stadia;
        $data->catatan = $request->catatan;
        $data->posisi = $request->posisi;
        $data->lama_anestesi = $request->lama_anestesi;
        $data->pra_anestesi = $request->pra_anestesi;
        $data->post_anestesi = $request->post_anestesi;
        $data->status = 1;
        $data->save();
        
        return redirect()->route('index.template-anastesi')->with('berhasil','Data Berhasil Ditambahkan!');
        

    }
    public function store(Request $request)
    {
        $data = new TemplateOperasi;

        $data->nama = $request->nama;
        $data->dokter_bedah = json_encode($request->dokter_bedah);
        $data->perawat_bedah = json_encode($request->perawat_bedah);
        $data->asisten = json_encode($request->asisten);
        $data->desinfektan_kulit = $request->desinfektan_kulit;
        $data->kamar_operasi = $request->kamar_operasi;
        $data->jenis_operasi = $request->jenis_operasi;
        $data->detail_operasi = $request->detail_operasi;
        $data->diagnosis_pasca_bedah = $request->diagnosis_pasca_bedah;
        $data->tindakan_bedah = json_encode($request->tindakan_bedah);
        $data->jenis_anestesi = $request->jenis_anestesi;
        $data->indikasi_operasi = $request->indikasi_operasi;
        $data->implant = $request->implant;
        $data->uraian_pembedahan = $request->uraian_pembedahan;
        $data->post_operasi = $request->post_operasi;

        $data->save();

        return redirect()->route('index.template')->with('berhasil','Data Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $data = TemplateOperasi::find($id);
        $perawatBedah = PerawatBedah::orderBy('nama','asc')->get();
        $dokter = Dokter::where('status',1)->where('kode_dpjp','!=',NULL)->orderBy('nama_dokter', 'asc')->get();

        return view('template.edit', compact('data','perawatBedah','dokter'));
    }

    public function update(Request $request, $id)
    {
        $data = TemplateOperasi::find($id);

        $data->nama = $request->nama;
        $data->dokter_bedah = json_encode($request->dokter_bedah);
        $data->perawat_bedah = json_encode($request->perawat_bedah);
        $data->asisten = json_encode($request->asisten);
        $data->desinfektan_kulit = $request->desinfektan_kulit;
        $data->kamar_operasi = $request->kamar_operasi;
        $data->jenis_operasi = $request->jenis_operasi;
        $data->detail_operasi = $request->detail_operasi;
        $data->diagnosis_pasca_bedah = $request->diagnosis_pasca_bedah;
        $data->tindakan_bedah = json_encode($request->tindakan_bedah);
        $data->jenis_anestesi = $request->jenis_anestesi;
        $data->indikasi_operasi = $request->indikasi_operasi;
        $data->implant = $request->implant;
        $data->uraian_pembedahan = $request->uraian_pembedahan;
        $data->post_operasi = $request->post_operasi;

        $data->save();

        return redirect()->back()->with('berhasil','Data Berhasil di Ubah!');
    }

    public function updateStatus($id,$status)
    {
        $data = TemplateOperasi::find($id);
        $data->status = $status;
        $data->save();

        return redirect()->back()->with('berhasil','Status Berhasil di Ubah!');
    }

    public function getDokter()
    {
        $dokter = Dokter::where('status',1)->where('kode_dpjp','!=',NULL)->orderBy('nama_dokter', 'asc')->get();
        $data = [];

        foreach ($dokter as $val) {
            $data[] = [
                'id' => $val->nama_dokter,
                'text' => $val->nama_dokter
            ];
        }

        return response()->json($data);
    }

    public function getPerawat()
    {
        $perawatBedah = PerawatBedah::orderBy('nama','asc')->get();
        $data = [];

        foreach ($perawatBedah as $val) {
            $data[] = [
                'id' => $val->nama,
                'text' => $val->nama
            ];
        }

        return response()->json($data);
    }

    public function showTemplateAnastesi(Request $request){
        $data = TemplateAnastesi::find($request->template_id);
        $obat_anastesi = '';
        // dd($data);
        if($data->obat_anestesi != 'null'){
            foreach(json_decode($data->obat_anestesi) as $val){
            $obat_anastesi .='
            <div class="col-md-4" data-repeater-item>                                                                
                <div class="form-group row mb-5">
                    <div class="col-md-10">
                        <input type="text"
                            name="obat_anestesi_catatan" value="'.$val->obat_anestesi_catatan.'"
                            class="form-control mb-2 mb-md-0 mt-5"
                            placeholder="Masukan Nama Obat" />
                    </div>
                    <div class="col-md-2">
                        <a href="javascript:;"
                            data-repeater-delete
                            class="btn btn-sm btn-light-danger mt-6">
                            <i class="ki-duotone ki-trash fs-5">
                                <span
                                    class="path1"></span><span
                                    class="path2"></span><span
                                    class="path3"></span><span
                                    class="path4"></span><span
                                    class="path5"></span>
                            </i>
                        </a>
                    </div>
                </div>
            </div>
            ';
        }
    }
        return response()->json([
            'status' => 'true',
            'template' => $data,
            'obat_anastesi' => $obat_anastesi,
        ]);
    }
    public function showTemplate(Request $request)
    {
        $data = TemplateOperasi::find($request->template_id);
        $dokter_bedah = '';
        if($data->dokter_bedah != 'null'){
        foreach(json_decode($data->dokter_bedah) as $val){
            $dokter_bedah .= '<div data-repeater-item> 
                                    <div class="form-group row mb-5"><div class="col-md-10">
                                        <label class="form-label">Dokter Bedah</label>
                                        <input type="text"
                                            name="dokter_bedah"
                                            class="form-control mb-2 mb-md-0"
                                            placeholder="Dokter Bedah" value="'. $val->dokter_bedah .'" required />
                                    </div>
                                    <div class="col-md-2">
                                        <a href="javascript:;"
                                            data-repeater-delete
                                            class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                        </a>
                                    </div>
                                </div>
                            </div>';
        }
        
        
    }

        $perawat_bedah = '';
        if($data->perawat_bedah != 'null'):
        foreach(json_decode($data->perawat_bedah) as $val){
            $perawat_bedah .= '<div data-repeater-item><div class="form-group row mb-5"><div class="col-md-10">
                                            <label class="form-label">Perawat Bedah</label>
                                            <input type="text"
                                                name="perawat_bedah"
                                                class="form-control mb-2 mb-md-0"
                                                placeholder="Masukan Nama" value="'. $val->perawat_bedah .'" required />
                                        </div>
                                        <div class="col-md-2">
                                            <a href="javascript:;"
                                                data-repeater-delete
                                                class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>';
        }
    endif;
        $asisten = '';
        if($data->asisten != 'null'):
        foreach(json_decode($data->asisten) as $val){
        $asisten .= '<div data-repeater-item><div class="form-group row mb-5"><div class="col-md-10">
                                <label class="form-label">Asisten</label>
                                <input type="text"
                                    name="asisten"
                                    class="form-control mb-2 mb-md-0"
                                    placeholder="Masukan Nama" value="'. $val->asisten .'" required />
                            </div>
                            <div class="col-md-2">
                                <a href="javascript:;"
                                    data-repeater-delete
                                    class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                    <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                </a>
                            </div>
                        </div>
                    </div>';
        }
    endif;
        $isi_tindakan = '';
        foreach(json_decode($data->tindakan_bedah) as $val){
            $isi_tindakan .= '<div data-repeater-item><div class="form-group row mb-5"><div class="col-md-10">
                                            <label class="form-label">Tindakan Bedah</label>
                                            <select name="tindakan_bedah"
                                                class="form-select"
                                                data-kt-repeater="tindakan_bedah_select"
                                                data-placeholder="Pilih Tindakan Bedah"
                                                required>
                                                <option value="'. $val->tindakan_bedah .'">'. $val->tindakan_bedah .'</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <a href="javascript:;"
                                                data-repeater-delete
                                                class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>';
        }

        return response()->json([
            'status' => 'true',
            'template' => $data,
            'dokter_bedah' => $dokter_bedah,
            'perawat_bedah' => $perawat_bedah,
            'asisten' => $asisten,
            'diagnosis_pasca_bedah' => $data->diagnosis_pasca_bedah,
            'tindakan_bedah' => $isi_tindakan,
        ]);
    }
}
