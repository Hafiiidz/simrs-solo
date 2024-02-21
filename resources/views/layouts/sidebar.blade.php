<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-header d-flex flex-stack d-none d-lg-flex pt-8 pb-2" id="kt_app_sidebar_header">
        <!--begin::Logo-->
        <a href="#" class="app-sidebar-logo fs-3x">
            {{-- <img alt="Logo" src="{{ asset('assets/media/logos/demo38.svg') }}" class="h-25px d-none d-sm-inline app-sidebar-logo-default theme-light-show" />
            <img alt="Logo" src="{{ asset('assets/media/logos/demo38-dark.svg') }}" class="h-20px h-lg-25px theme-dark-show" /> --}}
            MEDRONIC
        </a>
        <!--end::Logo-->
        <!--begin::Sidebar toggle-->
        <div id="kt_app_sidebar_toggle"
            class="app-sidebar-toggle btn btn-sm btn-icon bg-light btn-color-gray-700 btn-active-color-primary d-none d-lg-flex rotate"
            data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
            data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-outline ki-text-align-right rotate-180 fs-1"></i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--begin::Navs-->
    <div class="app-sidebar-navs flex-column-fluid py-6" id="kt_app_sidebar_navs">
        <div id="kt_app_sidebar_navs_wrappers" class="app-sidebar-wrapper hover-scroll-y my-2" data-kt-scroll="true"
            data-kt-scroll-activate="true" data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="#kt_app_sidebar_header" data-kt-scroll-wrappers="#kt_app_sidebar_navs"
            data-kt-scroll-offset="5px">
            <!--begin::Sidebar menu-->
            <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
                class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary">
                <!--begin::Heading-->
                <div class="menu-item mb-2">
                    <div class="menu-heading text-uppercase fs-7 fw-bold">Menu</div>
                    <!--begin::Separator-->
                    <div class="app-sidebar-separator separator"></div>
                    <!--end::Separator-->
                </div>
                <!--end::Heading-->
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ Request::is('dashboard') || Request::is('dashboard/*') ? 'active' : '' }}"
                        href="{{ url('dashboard/') }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-element-11 fs-2"></i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                {{-- @canany(['dokter', 'perawat', 'rekammedis']) --}}
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ Request::is('data-master') || Request::is('data-master/*') ? 'show' : '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-data fs-2"></i>
                        </span>
                        <span class="menu-title">Data Master</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item">
                            <!--begin:Menu link-->
                            <a class="menu-link {{ Request::is('data-master') || Request::is('data-master/*') ? 'active' : '' }}"
                                href="{{ url('/data-master/ruangan/') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Ruangan</span>
                            </a>
                            <!--end:Menu link-->
                        </div>
                        <!--end:Menu item-->
                    </div>
                    <!--end:Menu sub-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ Request::is('pasien') || Request::is('pasien/*') ? 'show' : '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-outline ki-profile-user fs-2"></i>
                        </span>
                        <span class="menu-title">Pasien</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <!--begin:Menu sub-->
                    @if (auth()->user()->detail->idpoli == null)
                        <!--User Lab-->
                        @if (auth()->user()->idpriv == 16)
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ Request::is('laboratorium') || Request::is('laboratorium/') ? 'active' : '' }}"
                                        href="{{ route('penunjang.antrian', 'Lab') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Antrian Lab</span>
                                    </a>
                                    <a class="menu-link {{ Request::is('laboratorium') || Request::is('laboratorium/') ? 'active' : '' }}"
                                        href="{{ route('laboratorium.list-pemeriksaan') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pemeriksaan Lab</span>
                                    </a>
                                    <a class="menu-link {{ Request::is('laboratorium') || Request::is('laboratorium/') ? 'active' : '' }}"
                                        href="{{ route('laboratorium.list-pasien', 'Lab') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">List Pasien</span>
                                    </a>
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endif
                        <!--End User Lab-->

                        <!--User Fisio-->
                        @if (auth()->user()->idpriv == 29)
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ Request::is('farmasi') || Request::is('farmasi/') ? 'active' : '' }}"
                                        href="{{ route('penunjang.antrian', 'Fisio') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Fisio Terapi</span>
                                    </a>
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endif
                        <!--End User Fisio-->

                        <!--User Radiologi-->
                        @if (auth()->user()->idpriv == 15)
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ Request::is('farmasi') || Request::is('farmasi/') ? 'active' : '' }}"
                                        href="{{ route('penunjang.antrian', 'Radiologi') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Antrian Radiologi</span>
                                    </a>
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endif
                        <!--End User Radiologi-->

                        <!--User Farmasi-->
                        @if (auth()->user()->idpriv == 10)
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->
                                    <a class="menu-link {{ Request::is('farmasi') || Request::is('farmasi/') ? 'active' : '' }}"
                                        href="{{ route('farmasi.list-pasien-rawat') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">List Pasien Rawat</span>
                                    </a>
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endif
                        <!--End User Farmasi-->

                        <!--User Rekam Medis-->
                        @if (auth()->user()->idpriv == 8)
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->

                                    <a class="menu-link {{ Request::is('pasien') || Request::is('pasien/') ? 'active' : '' }}"
                                        href="{{ url('/pasien') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">List Pasien</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endif
                        <!--End User Rekam Medis-->

                        <!--User Perawat Ruangan-->
                        @if (auth()->user()->idpriv == 11)
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->

                                    <a class="menu-link {{ Request::is('pasien') || Request::is('pasien/') ? 'active' : '' }}"
                                        href="{{ route('index.rawat-inap') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Keperawatan</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endif
                        <!--End User Perawat Ruangan-->
                        <!--User Bidan-->
                        @if (auth()->user()->idpriv == 20)
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->

                                <a class="menu-link {{ Request::is('rawat-jalan') || Request::is('rawat-jalan/poli') ? 'active' : '' }}"
                                    href="{{ route('poliklinik') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">List Pasien</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->

                                <a class="menu-link {{ Request::is('rawat-jalan') || Request::is('rawat-jalan/poli-semua') ? 'active' : '' }}"
                                    href="{{ route('poliklinik-semua') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Semua Pasien</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @endif
                        @if (auth()->user()->idpriv == 12)
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->

                                    <a class="menu-link {{ Request::is('pasien') || Request::is('pasien/') ? 'active' : '' }}"
                                        href="{{ route('index.rawat-inap') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Kebidanan</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endif
                        <!--End User Bidan-->
                    @else
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->

                                <a class="menu-link {{ Request::is('rawat-jalan') || Request::is('rawat-jalan/poli') ? 'active' : '' }}"
                                    href="{{ route('poliklinik') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">List Pasien</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->

                                <a class="menu-link {{ Request::is('rawat-jalan') || Request::is('rawat-jalan/poli-semua') ? 'active' : '' }}"
                                    href="{{ route('poliklinik-semua') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Semua Pasien</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        @if (auth()->user()->idpriv == 7 && auth()->user()->detail->idpoli != '')
                            <div class="menu-sub menu-sub-accordion">
                                <!--begin:Menu item-->
                                <div class="menu-item">
                                    <!--begin:Menu link-->

                                    <a class="menu-link {{ Request::is('rawat-jalan') || Request::is('rawat-jalan/poli-semua') ? 'active' : '' }}"
                                        href="{{ route('index.rawat-inap') }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Pasien Perawatan</span>
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                                <!--end:Menu item-->
                            </div>
                        @endif
                    @endif
                    @if (auth()->user()->idpriv == 13)
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->

                                <a class="menu-link {{ Request::is('pasien/operasi') || Request::is('pasien/operasi/*') ? 'active' : '' }}"
                                    href="{{ route('index.operasi') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Antrian Operasi</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->

                                <a class="menu-link {{ Request::is('pasien/template') || Request::is('pasien/template') ? 'active' : '' }}"
                                    href="{{ route('index.template') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Template Operasi</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item">
                                <!--begin:Menu link-->

                                <a class="menu-link {{ Request::is('pasien/template/template-anastesi') || Request::is('pasien/template/template-anastesi') ? 'active' : '' }}"
                                    href="{{ route('index.template-anastesi') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Template Anastesi</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <div class="menu-item">
                                <!--begin:Menu link-->

                                <a class="menu-link {{ Request::is('pasien/bhp') || Request::is('pasien/bhp') ? 'active' : '' }}"
                                    href="{{ route('index.bhp') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Master BHP</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                    @endif
                    @if (auth()->user()->idpriv == 6)
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->

                                <a class="menu-link {{ Request::is('pasien/gizi') || Request::is('pasien/gizi/*') ? 'active' : '' }}"
                                    href="{{ route('index.gizi') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Gizi</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                    @endif
                    <!--end:Menu sub-->
                </div>

                @if (auth()->user()->idpriv == 10)
                    <div data-kt-menu-trigger="click"
                        class="menu-item {{ Request::is('farmasi') || Request::is('farmasi/*') ? 'show' : '' }} menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                            <span class="menu-icon">
                                <i class="ki-outline ki-office-bag fs-2"></i>
                            </span>
                            <span class="menu-title">Farmasi</span>
                            <span class="menu-arrow"></span>
                        </span>
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->

                                <a class="menu-link {{ Request::is('farmasi.antrian-resep') || Request::is('farmasi/') ? 'active' : '' }}"
                                    href="{{ route('farmasi.antrian-resep') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Antrian Resep</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->

                                <a class="menu-link {{ Request::is('farmasi.list-resep') || Request::is('farmasi/') ? 'active' : '' }}"
                                    href="{{ route('farmasi.list-resep') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">List Resep</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <!--begin:Menu link-->

                                <a class="menu-link {{ Request::is('pasien') || Request::is('pasien/') ? 'active' : '' }}"
                                    href="{{ route('farmasi.list-obat') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Obat Obatan</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                    </div>
                @endif
                <!--end:Menu item-->
                {{-- @endcanany --}}
                <!--begin:Menu item-->
                {{-- <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ Request::is('laporan') || Request::is('laporan/*') ? 'active' : '' }}" href="{{ url('laporan/') }}">
                        <span class="menu-icon">
                            <i class="ki-outline ki-note-2 fs-2"></i>
                        </span>
                        <span class="menu-title">Laporan</span>
                    </a>
                    <!--end:Menu link-->
                </div> --}}
                <!--end:Menu item-->
            </div>
            <!--end::Sidebar menu-->
        </div>
    </div>
    <!--end::Navs-->
</div>
