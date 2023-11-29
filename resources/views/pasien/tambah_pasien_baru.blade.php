@extends('layouts.index')
@section('css')
@endsection
@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-7 pt-lg-10">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0">Tambah
                            Pasien</h1>
                        <!--end::Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0">
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">
                                <a href="#" class="text-muted text-hover-primary">Menu</a>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <li class="breadcrumb-item text-muted">Tambah Pasien</li>
                            <!--end::Item-->
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page title-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::FAQ card-->
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5 class="card-title">Pasien Baru</h5>
                        </div>
                    </div>
                    <!--begin::Body-->
                    <div class="card-body p-lg-15">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Informasi Pasien</h5>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                    <div class="form-group row">
                                        <label for="noRM" class="col-sm-4 col-form-label text-end">No RM</label>
                                        <div class="col-sm-5">
                                            <div class="input-group mb-3">
                                                <input type="text" name='no_rm' class="form-control" required
                                                    id="noRM">
                                                <button class="btn btn-sm btn-warning" type="button"
                                                    id="btn-edit">Edit</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">NIK</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" name='nik' class="form-control" required>
                                                <button class="btn btn-sm btn-success" type="button"
                                                    id="btn-cari-nik">Cari</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">BPJS</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" name='bpjs' class="form-control" required>
                                                <button class="btn btn-sm btn-primary" type="button"
                                                    id="btn-cari-bpjs">Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Nama Pasien</label>
                                        <div class="col-sm-8">
                                            <input type="text" name='nama_pasien' class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">JK / Gol Darah</label>
                                        <div class="col-sm-4">
                                            <select name="" class="form-select" id="" required>
                                                <option value="">-- Jenis Kelamin --</option>
                                                <option value="L">Laki Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="" class="form-select" id="" required>
                                                <option value="">-- Gol Darah --</option>
                                                @foreach ($gol_darah as $gl)
                                                    <option value="{{ $gl->id }}">{{ $gl->golongan_darah }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Tempat Lahir</label>
                                        <div class="col-sm-8">
                                            <input type="text" name='tempat_lahir' class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Tgl.Lahir</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control" name='tgl_lahir' placeholder="Pilih Tanggal"
                                                    id="kt_datepicker_1" />
                                                <div class="input-group-text">
                                                    <input class="form-check-input me-3" type="checkbox" name='baru_lahir'
                                                        value="1" id="flexCheckDefault" />
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Baru Lahir ?
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">No.Hp / Email</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="no_hp" id=""
                                                placeholder="No HP" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="email" id=""
                                                placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Kepesertaan BPJS</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control form-control-solid"
                                                name="kepesertaan_bpjs" id="" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Status Pasien</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <select name="status_pasien" class="form-select" id="" required>
                                                    <option value="">-- Status Pasien --</option>
                                                    @foreach ($data_status as $ds)
                                                        <option value="{{ $ds->id }}">{{ $ds->d_status }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="input-group-text">
                                                    <input class="form-check-input me-2" type="checkbox"
                                                        name='pasien_lama' value="1" id="flexCheckDefault" />
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Pasien Lama ?
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="mt-10">Informasi Tambahan</h5>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Agama</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="id_agama" data-control="select2"
                                                data-placeholder="Pilih Agama" required>
                                                <option></option>
                                                @foreach ($data_agama as $da)
                                                    <option value="{{ $da->id }}">{{ $da->agama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Etnis / Suku</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="id_etnis" data-control="select2"
                                                data-placeholder="Pilih Etnis / Suku" required>
                                                <option></option>
                                                @foreach ($data_etnis as $de)
                                                    <option value="{{ $de->id }}">{{ $de->etnis }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Pendidikan</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="id_pendidikan" data-control="select2"
                                                data-placeholder="Pilih Pendidikan" required>
                                                <option></option>
                                                @foreach ($data_pendidikan as $dp)
                                                    <option value="{{ $dp->id }}">{{ $dp->pendidikan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Status Pernikahan</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="id_hubungan_pernikakan"
                                                data-control="select2" data-placeholder="Pilih Status Pernikahan"
                                                required>
                                                <option></option>
                                                @foreach ($data_hubungan as $dh)
                                                    <option value="{{ $dh->id }}">{{ $dh->hubungan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Hambatan Komunikasi</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="id_hambatan" data-control="select2"
                                                data-placeholder="Pilih Hambatan Komunikasi" required>
                                                <option></option>
                                                @foreach ($data_hambatan as $dh)
                                                    <option value="{{ $dh->id }}">{{ $dh->hambatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <h5>Informasi Pekerjaan</h5>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Pekerjaan</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="id_pekerjaan" data-control="select2"
                                                data-placeholder="Pilih Pekerjaan" required>
                                                <option></option>
                                                @foreach ($data_pekerjaan as $dp)
                                                    <option value="{{ $dp->id }}">{{ $dp->pekerjaan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">NRP / Pengkat</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name='nrp' placeholder="NRP">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name='pangkat'
                                                placeholder="Pangkat">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Kesatuan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name='kesatuan'>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Keterangan</label>
                                        <div class="col-sm-8">
                                            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <h5 class="mt-10">Informasi Alamat</h5>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Kelurahan</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="id_kel" id='id_kel'
                                                data-control="select2" data-placeholder="Pilih Kelurahan" required>
                                                <option></option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Alamat</label>
                                        <div class="col-sm-8">
                                            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <h5 class="mt-10">Penanggung Jawab</h5>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Penanggung Jawab</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="penanggung_jawab" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Hubungan</label>
                                        <div class="col-sm-8">
                                            <select name="hubungan" class="form-select" data-control="select2"
                                                data-placeholder="Pilih Penanggung Jawab">
                                                <option value="">-- Hubungan --</option>
                                                @foreach ($pasien_penanggungjawab as $dh)
                                                    <option value="{{ $dh->id }}">{{ $dh->penaggungjawab }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">No Telp</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="no_tlp_penanggung_jawab" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Alamat </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="alamat_penanggung_jawab" class="form-control"
                                                required>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row text-end mb-3">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('pasien.index') }}" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::FAQ card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@endsection
@section('js')
    <script>
        $(function() {
            $("#id_kel").select2({
                ajax: {
                    url: " {{ route('pasien.cari-kelurahan') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {

                        return {
                            q: params.term, // search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.result.map(function(user) {
                                return {
                                    id: user.id,
                                    text: user.text
                                };
                            })
                        };
                    },
                    cache: true
                },
                minimumInputLength: 1,
                placeholder: 'Search for a user...'
            });
        })

        $("#kt_datepicker_1").flatpickr({
            maxDate: "{{ date('Y-m-d') }}"
        });
    </script>
@endsection
