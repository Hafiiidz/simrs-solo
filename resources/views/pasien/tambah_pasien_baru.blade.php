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
                        <form method="POST" id="form-create" action="{{ route('pasien.post-tambah-pasien') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <h5>Informasi Pasien</h5>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                    <div class="form-group row fw-row">
                                        <label for="noRM" class="col-sm-4 col-form-label text-end">No RM</label>
                                        <div class="col-sm-5">
                                            <div class="input-group mb-3">
                                                <input type="text" readonly name='no_rm' value="{{ $kodepasien }}"
                                                    class="form-control form-control-solid" id='pasien-kodepasien' required>
                                                <button class="btn btn-sm btn-warning" type="button"
                                                    id="btn-edit-rm">Edit</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">NIK</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" name='nik' id='nik' class="form-control"
                                                    required>
                                                <button class="btn btn-sm btn-success" type="button"
                                                    id="btn-cari-nik">Cari</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">BPJS</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="text" name='bpjs' id='bpjs' class="form-control"
                                                    required>
                                                <button class="btn btn-sm btn-primary" type="button"
                                                    id="btn-cari-bpjs">Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Nama Pasien</label>
                                        <div class="col-sm-8">
                                            <input type="text" name='nama_pasien' id='nama_pasien' class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">JK / Gol Darah</label>
                                        <div class="col-sm-4">
                                            <select name="jenis_kelamin" class="form-select" id="jenis_kelamin" required>
                                                <option value="">-- Jenis Kelamin --</option>
                                                <option value="L">Laki Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="golongan_darah" class="form-select" id="" required>
                                                <option value="">-- Gol Darah --</option>
                                                @foreach ($gol_darah as $gl)
                                                    <option value="{{ $gl->id }}">{{ $gl->golongan_darah }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Tempat Lahir</label>
                                        <div class="col-sm-8">
                                            <input type="text" name='tempat_lahir' class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Tgl.Lahir</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input class="form-control" name='tgl_lahir' id='tgl_lahir'
                                                    placeholder="Pilih Tanggal" />
                                                <div class="input-group-text">
                                                    <input class="form-check-input me-3" type="checkbox"
                                                        name='baru_lahir' value="1" id="flexCheckDefault" />
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Baru Lahir ?
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">No.Hp / Email</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="no_hp" id="no_hp"
                                                placeholder="No HP" required>
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name="email" id="email"
                                                placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Kepesertaan BPJS</label>
                                        <div class="col-sm-8">
                                            <input type="text" readonly class="form-control form-control-solid"
                                                name="kepesertaan_bpjs" id="kepesertaan_bpjs" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="form-group row fw-row mb-3">
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
                                    <div class="form-group row fw-row mb-3">
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
                                    <div class="form-group row fw-row mb-3">
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
                                    <div class="form-group row fw-row mb-3">
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
                                    <div class="form-group row fw-row mb-3">
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
                                    <div class="form-group row fw-row mb-3">
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
                                    <div class="form-group row fw-row mb-3">
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
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">NRP / Pengkat</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name='nrp' placeholder="NRP">
                                        </div>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" name='pangkat'
                                                placeholder="Pangkat">
                                        </div>
                                    </div>
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Kesatuan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name='kesatuan'>
                                        </div>
                                    </div>
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Keterangan</label>
                                        <div class="col-sm-8">
                                            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                                        </div>
                                    </div>

                                    <h5 class="mt-10">Informasi Alamat</h5>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Kelurahan</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="id_kel" id='id_kel'
                                                data-control="select2" data-placeholder="Pilih Kelurahan" required>
                                                <option></option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Alamat</label>
                                        <div class="col-sm-8">
                                            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <h5 class="mt-10">Penanggung Jawab</h5>
                                    <div class="separator separator-dashed border-secondary mt-5 mb-5"></div>
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Penanggung Jawab</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="penanggung_jawab" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row fw-row mb-3">
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
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">No Telp</label>
                                        <div class="col-sm-8">
                                            <input type="text" name="no_tlp_penanggung_jawab" class="form-control"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row fw-row mb-3">
                                        <label class="col-sm-4 col-form-label text-end">Alamat </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="alamat_penanggung_jawab" class="form-control"
                                                required>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row fw-row text-end mb-3">
                                    <div class="col-md-12">
                                        <button type="button" id='button-tambah' class="btn btn-primary">Simpan</button>
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
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.66.0-2013.10.09/jquery.blockUI.js"></script>
    <script>
        const form = document.getElementById('form-create');
        var validator = FormValidation.formValidation(
            form, {
                fields: {
                    id_pekerjaan: {
                        validators: {
                            notEmpty: {
                                message: 'is required'
                            }
                        }
                    },
                    id_kel: {
                        validators: {
                            notEmpty: {
                                message: 'is required'
                            }
                        }
                    },
                    alamat: {
                        validators: {
                            notEmpty: {
                                message: 'is required'
                            }
                        }
                    },
                    penanggung_jawab: {
                        validators: {
                            notEmpty: {
                                message: 'is required'
                            }
                        }
                    },
                    hubungan: {
                        validators: {
                            notEmpty: {
                                message: 'is required'
                            },
                            
                        }
                    },
                    no_tlp_penanggung_jawab: {
                        validators: {
                            notEmpty: {
                                message: 'is required'
                            },
                            
                        }
                    },
                    no_tlp_penanggung_jawab: {
                        validators: {
                            notEmpty: {
                                message: 'is required'
                            },
                            
                        }
                    },

                    nama_pasien: {
                        validators: {
                            notEmpty: {
                                message: 'Nama Pasien is required'
                            },
                            stringLength: {
                                max: 255,
                                message: 'Nama Pasien must be less than 255 characters'
                            }
                        }
                    },
                    jenis_kelamin: {
                        validators: {
                            notEmpty: {
                                message: 'Jenis Kelamin is required'
                            },
                            stringLength: {
                                max: 1,
                                message: 'Jenis Kelamin must be 1 character'
                            }
                        }
                    },
                    golongan_darah: {
                        validators: {
                            notEmpty: {
                                message: 'Golongan Darah is required'
                            },
                            stringLength: {
                                max: 2,
                                message: 'Golongan Darah must be less than 2 characters'
                            }
                        }
                    },
                    tempat_lahir: {
                        validators: {
                            notEmpty: {
                                message: 'Tempat Lahir is required'
                            },
                            stringLength: {
                                max: 255,
                                message: 'Tempat Lahir must be less than 255 characters'
                            }
                        }
                    },
                    tgl_lahir: {
                        validators: {
                            notEmpty: {
                                message: 'Tanggal Lahir is required'
                            },
                            date: {
                                format: 'YYYY-MM-DD',
                                message: 'Tanggal Lahir is not a valid date'
                            }
                        }
                    },
                    no_hp: {
                        validators: {
                            notEmpty: {
                                message: 'No HP is required'
                            },
                            stringLength: {
                                max: 15,
                                message: 'No HP must be less than 15 characters'
                            }
                        }
                    },


                    status_pasien: {
                        validators: {
                            notEmpty: {
                                message: 'Status Pasien is required'
                            },
                            stringLength: {
                                max: 1,
                                message: 'Status Pasien must be 1 character'
                            }
                        }
                    },
                    id_agama: {
                        validators: {
                            notEmpty: {
                                message: 'ID Agama is required'
                            },
                            integer: {
                                message: 'ID Agama must be an integer'
                            }
                        }
                    },
                    id_etnis: {
                        validators: {
                            notEmpty: {
                                message: 'ID Etnis is required'
                            },
                            integer: {
                                message: 'ID Etnis must be an integer'
                            }
                        }
                    },
                    id_pendidikan: {
                        validators: {
                            notEmpty: {
                                message: 'ID Pendidikan is required'
                            },
                            integer: {
                                message: 'ID Pendidikan must be an integer'
                            }
                        }
                    },
                    id_hubungan_pernikakan: {
                        validators: {
                            notEmpty: {
                                message: 'ID Hubungan Pernikakan is required'
                            },
                            integer: {
                                message: 'ID Hubungan Pernikakan must be an integer'
                            }
                        }
                    },
                    id_hambatan: {
                        validators: {
                            notEmpty: {
                                message: 'ID Hambatan is required'
                            },
                            integer: {
                                message: 'ID Hambatan must be an integer'
                            }
                        }
                    }
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fw-row'
                    })
                }
            }
        );

        // Assuming all your Select2 inputs have a common class 'select2_input'
        $(form.querySelectorAll('.form-select')).each(function() {
            $(this).on('change', function() {
                // Revalidate the field when its value changes
                validator.revalidateField($(this).attr('name'));
            });
        });


        const submitButton = document.getElementById('button-tambah');
        submitButton.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function(status) {
                    console.log('validated!');

                    if (status == 'Valid') {
                        // Show loading indication
                        submitButton.setAttribute('data-kt-indicator', 'on');

                        // Disable button to avoid multiple click
                        submitButton.disabled = true;

                        // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                        setTimeout(function() {
                            // Remove loading indication
                            submitButton.removeAttribute('data-kt-indicator');

                            // Enable button
                            submitButton.disabled = false;

                            // Show popup confirmation
                            Swal.fire({
                                text: "Form has been successfully submitted!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });

                            form.submit(); 
                            // Submit form
                        }, 2000);
                    }
                });
            }
        });

        @if ($message = session('gagal'))
            Swal.fire({
                text: '{{ $message }}',
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        @endif
        @if ($message = session('berhasil'))
            Swal.fire({
                text: '{{ $message }}',
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        @endif
        $(document).on('click', '#btn-edit-rm', function() {
            $('#pasien-kodepasien').prop('readonly', false);
            $('#pasien-kodepasien').val('P-');
            $('#pasien-kodepasien').focus();
            $('#pasien-kodepasien').removeClass('form-control-solid');
            $(this).attr("id", "auto-rm");
        });

        $(document).on('click', '#auto-rm', function() {
            $('#pasien-kodepasien').prop('readonly', true);
            $('#pasien-kodepasien').val('{{ $kodepasien }}');
            $('#pasien-kodepasien').addClass('form-control-solid');
            $(this).attr("id", "btn-edit-rm");
        });
        $(document).on('click', '#btn-cari-nik', function() {
            var nik = $('#nik').val();
            if (nik == null || nik == '') {
                toastr.error('Harap isi NIK');
            } else {
                $.ajax({
                    url: "{{ route('pasien.get-by-nik') }}",
                    type: 'GET',
                    data: {
                        nik: nik,
                        jenis: 'nik'
                    },
                    beforeSend: function() {
                        $.blockUI({
                            message: '<i class="fa fa-spinner fa-spin"></i> Loading ...',
                            css: {
                                border: 'none',
                                padding: '15px',
                                backgroundColor: '#000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: .5,
                                color: '#fff'
                            }
                        });
                    },
                    success: function(data) {
                        console.log(data);
                        $.unblockUI();
                        if (data.status == true) {
                            toastr.success(data.message);
                            $('#bpjs').val(data.data.peserta.noKartu);
                            $('#nama_pasien').val(data.data.peserta.nama);
                            $('#jenis_kelamin').val(data.data.peserta.sex);
                            $('#tgl_lahir').val(data.data.peserta.tglLahir);
                            $('#no_hp').val(data.data.peserta.mr.noTelepon);
                            $('#pasien-kodepasien').val("P-" + data.data.peserta.mr.noMR);
                            $('#kepesertaan_bpjs').val(data.data.peserta.jenisPeserta.keterangan);
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        $.unblockUI();
                        toastr.error('Terjadi kesalahan: ' + error);
                        console.error('Error details:', xhr, status, error);
                    }
                });
            }
        });
        $(document).on('click', '#btn-cari-bpjs', function() {
            var nik = $('#bpjs').val();
            if (nik == null || nik == '') {
                toastr.error('Harap isi NIK');
            } else {
                $.ajax({
                    url: "{{ route('pasien.get-by-nik') }}",
                    type: 'GET',
                    data: {
                        nik: nik,
                        jenis: 'bpjs'
                    },
                    beforeSend: function() {
                        $.blockUI({
                            message: '<i class="fa fa-spinner fa-spin"></i> Loading ...',
                            css: {
                                border: 'none',
                                padding: '15px',
                                backgroundColor: '#000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: .5,
                                color: '#fff'
                            }
                        });
                    },
                    success: function(data) {
                        console.log(data);
                        $.unblockUI();
                        if (data.status == true) {
                            toastr.success(data.message);
                            $('#nik').val(data.data.peserta.nik);
                            $('#bpjs').val(data.data.peserta.noKartu);
                            $('#nama_pasien').val(data.data.peserta.nama);
                            $('#jenis_kelamin').val(data.data.peserta.sex);
                            $('#tgl_lahir').val(data.data.peserta.tglLahir);
                            $('#no_hp').val(data.data.peserta.mr.noTelepon);
                            if (data.data.peserta.mr.noMR != null) {
                                $('#pasien-kodepasien').val("P-" + data.data.peserta.mr.noMR);
                            }

                            $('#kepesertaan_bpjs').val(data.data.peserta.jenisPeserta.keterangan);
                        } else {
                            toastr.error(data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        $.unblockUI();
                        toastr.error('Terjadi kesalahan: ' + error);
                        console.error('Error details:', xhr, status, error);
                    }
                });
            }
        });




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

        $("#tgl_lahir").flatpickr({
            maxDate: "{{ date('Y-m-d') }}"
        });
    </script>
@endsection
