<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../" />
    <title>Verifikasi Satusehat</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Blazor, Django, Flask & Laravel versions. Grab your copy now and get life-time updates for free." />
    <meta name="keywords"
        content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Blazor, Django, Flask & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="Metronic | Bootstrap HTML, VueJS, React, Angular, Asp.Net Core, Blazor, Django, Flask & Laravel Admin Dashboard Theme" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>

<body id="kt_body" class="app-blank app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('image/rsaubackground.jpg');
            }

            [data-theme="dark"] body {
                background-image: url('image/rsaubackground.jpg');
            }
        </style>
        <!--end::Page bg image-->
        <!--begin::Authentication - Signup Welcome Message -->
        <div class="d-flex flex-column flex-center flex-column-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center  p-10">
                <div class="card card-flush w-md-350px ">
                    <div class="card-body py-15 py-lg-20">
                        <div class="mb-7 text-center">
                            <a href="#" class="">
                                <img alt="Logo" src="{{ asset('image/logosiswanto.png') }}" class="h-100px" />
                            </a>
                        </div>
                        <h2 class="">User Validasi Satusehat</h2>
                        <form id="dataForm">
                            @csrf
                            <div class="form-group">
                                <label for="nik">NIK:</label>
                                <input type="number" maxlength="16" class="form-control" id="nik" name="nik"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mt-5">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery -->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset("assets/plugins/global/plugins.bundle.js") }}"></script>
    <script src="{{ asset("assets/js/scripts.bundle.js") }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('#dataForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah form untuk melakukan submit secara default

                var nik = $('#nik').val();
                var nama = $('#nama').val();

                // Placeholder untuk domain yang akan diakses
                var domain = '{{ env('API_URL').'/api/login-satset' }}';

                // Contoh penggunaan AJAX untuk mengirim data ke domain tertentu
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $.ajax({
                    url: domain,
                    type: 'POST',
                    data: {
                        nik: nik,
                        nama: nama
                    },
                    success: function(response) {
                        toastr.success('Data berhasil dikirim!');
                        if (response.status == 'success') {
                            window.open(response.url, '_blank');
                        }
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Terjadi kesalahan saat mengirim data.');
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>

</html>
