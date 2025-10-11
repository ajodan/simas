@php
    $path = explode('/', Request::path());
    $role = auth()->user()->role;

    $dashboardRoutes = [
        'admin' => 'admin.dashboard-admin',
        'pengurus' => 'admin.dashboard-pengurus',
    ];

    $isActive = in_array($role, array_keys($dashboardRoutes)) && isset($path[1]) && $path[1] === 'dashboard-' . $role;
    $activeColor = $isActive ? 'color: #F4BE2A' : 'color: #FFFFFF';
@endphp

<div class="aside-menu bg-primary flex-column-fluid" style="background-color: #087a08 !important;">
    <!--begin::Aside Menu-->
    <div class="hover-scroll-overlay-y mb-5 mb-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu"
        data-kt-scroll-offset="0">
        <script>
            // Ambil elemen menu menggunakan JavaScript
            var menu = document.getElementById('kt_aside_menu_wrapper');

            // Set tinggi maksimum dan penanganan overflow menggunakan JavaScript
            if (menu) {
                menu.style.maxHeight = '88vh'; // Set tinggi maksimum
            }
        </script>
        <!--begin::Menu-->
        <div class="menu menu-column mt-2 menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
            id="kt_aside_menu" data-kt-menu="true" style="gap: 3px;">

            <div class="menu-item">
                <a class="menu-link {{ $isActive ? 'active' : ($module = 'Persetujun PO') }}"
                    href="{{ route($dashboardRoutes[$role]) }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <img src="{{ $isActive ? url('assets/media/icons/aside/dashboardact.svg') : url('assets/media/icons/aside/dashboarddef.svg') }}"
                                alt="">
                        </span>
                    </span>
                    <span class="menu-title" style="{{ $activeColor }}">Dashboard</span>
                </a>
            </div>

            @if ($role === 'admin')
                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'users' ? 'active' : '' }}"
                        href="{{ route('admin.users') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                {!! isset($path[1]) && $path[1] === 'users'
                                    ? '<i class="fas fa-users" style="color: #F4BE2A; font-size: 16px"></i>'
                                    : '<i class="fas fa-users" style="color: #FFFFFF; font-size: 16px"></i>' !!}
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'users' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Data Pengguna</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'data-jamaah' ? 'active' : '' }}"
                        href="{{ route('admin.data-jamaah') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ isset($path[1]) && $path[1] === 'data-jamaah' ? url('assets/media/icons/aside/dataguruact.svg') : url('assets/media/icons/aside/datagurudef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'data-jamaah' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Data
                            Jamaah</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'data-ustadz' ? 'active' : '' }}"
                        href="{{ route('admin.data-ustadz') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ isset($path[1]) && $path[1] === 'data-ustadz' ? url('assets/media/icons/aside/dataguruact.svg') : url('assets/media/icons/aside/datagurudef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'data-ustadz' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Data
                            Ustadz</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'dokumentasi' ? 'active' : '' }}"
                        href="{{ route('admin.dokumentasi') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                {!! isset($path[1]) && $path[1] === 'dokumentasi'
                                    ? '<i class="fas fa-images" style="color: #F4BE2A; font-size: 16px"></i>'
                                    : '<i class="fas fa-images" style="color: #FFFFFF; font-size: 16px"></i>' !!}
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'dokumentasi' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Dokumentasi</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'sub-dokumentasi' ? 'active' : '' }}"
                        href="{{ route('admin.sub-dokumentasi') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                {!! isset($path[1]) && $path[1] === 'sub-dokumentasi'
                                    ? '<i class="fas fa-image" style="color: #F4BE2A; font-size: 16px"></i>'
                                    : '<i class="fas fa-image" style="color: #FFFFFF; font-size: 16px"></i>' !!}
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'sub-dokumentasi' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Sub Dokumentasi</span>
                    </a>
                </div>
                <!--end::Menu item-->

                 <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'kategori-artikel' ? 'active' : '' }}"
                        href="{{ route('admin.kategori-artikel') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                {!! isset($path[1]) && $path[1] === 'kategori-artikel'
                                    ? '<i class="fas fa-images" style="color: #F4BE2A; font-size: 16px"></i>'
                                    : '<i class="fas fa-images" style="color: #FFFFFF; font-size: 16px"></i>' !!}
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'kategori-artikel' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Kategori Artikel</span>
                    </a>
                </div>
                <!--end::Menu item-->
                 <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'jenisinventaris' ? 'active' : '' }}"
                        href="{{ route('admin.jenisinventaris') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                {!! isset($path[1]) && $path[1] === 'jenisinventaris'
                                    ? '<i class="fas fa-images" style="color: #F4BE2A; font-size: 16px"></i>'
                                    : '<i class="fas fa-images" style="color: #FFFFFF; font-size: 16px"></i>' !!}
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'jenisinventaris' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Jenis Inventaris</span>
                    </a>
                </div>
                <!--end::Menu item-->

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'inventaris' ? 'active' : '' }}"
                        href="{{ route('admin.inventaris') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                {!! isset($path[1]) && $path[1] === 'inventaris'
                                    ? '<i class="fas fa-boxes" style="color: #F4BE2A; font-size: 16px"></i>'
                                    : '<i class="fas fa-boxes" style="color: #FFFFFF; font-size: 16px"></i>' !!}
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'inventaris' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Inventaris</span>
                    </a>
                </div>

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'artikel' ? 'active' : '' }}"
                        href="{{ route('admin.artikel') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                {!! isset($path[1]) && $path[1] === 'artikel'
                                    ? '<i class="fas fa-images" style="color: #F4BE2A; font-size: 16px"></i>'
                                    : '<i class="fas fa-images" style="color: #FFFFFF; font-size: 16px"></i>' !!}
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'artikel' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Artikel</span>
                    </a>
                </div>
                <!--end::Menu item-->


                <div class="menu-item menu-link-indention menu-accordion {{ $path[1] == 'data-donasi' ? 'show' : '' }}"
                    data-kt-menu-trigger="click">
                    <!--begin::Menu link-->
                    <a href="#" class="menu-link py-3 {{ $path[1] == 'data-donasi' ? 'active' : '' }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ $path[1] == 'data-donasi' ? url('assets/media/icons/aside/masterdataact.svg') : url('/assets/media/icons/aside/masterdatadef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ $path[1] == 'data-donasi' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Keuangan</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <!--end::Menu link-->

                    <!--begin::Menu sub-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <!--begin::Menu item-->
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'donasi-manual' ? 'active' : '' }}"
                                href="{{ route('admin.donasi-manual') }}">
                                <span class="menu-icon">
                                    <span class="svg-icon svg-icon-2">
                                        {!! isset($path[2]) && $path[2] === 'donasi-manual'
                                            ? '<i class="fas fa-hand-holding-usd" style="color: #F4BE2A; font-size: 16px"></i>'
                                            : '<i class="fas fa-hand-holding-usd" style="color: #FFFFFF; font-size: 16px"></i>' !!}
                                    </span>
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'donasi-manual' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Pemasukan</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>

                    <!--begin::Menu sub-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <!--begin::Menu item-->
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'realisasi-dana' ? 'active' : '' }}"
                                href="{{ route('admin.realisasi-dana') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[1]) && $path[1] === 'realisasi-dana' ? url('assets/media/icons/aside/gajiact.svg') : url('assets/media/icons/aside/gajidef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'realisasi-dana' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Pengeluaran</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>

                    <!--begin::Menu sub-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <!--begin::Menu item-->
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'donatur-tetap' ? 'active' : '' }}"
                                href="{{ route('admin.donatur-tetap') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'donatur-tetap' ? url('assets/media/icons/aside/penjualanact.svg') : url('/assets/media/icons/aside/penjualandef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'donatur-tetap' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Donatur
                                    Tetap</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>

                    <!--begin::Menu sub-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <!--begin::Menu item-->
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'campaign-donasi' ? 'active' : '' }}"
                                href="{{ route('admin.campaign-donasi') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'campaign-donasi' ? url('assets/media/icons/aside/pengajuanact.svg') : url('/assets/media/icons/aside/pengajuandef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'campaign-donasi' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Campaign
                                    Donasi</span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                    </div>

                    <!--begin::Menu item-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'laporan' ? 'active' : '' }}"
                                href="{{ route('admin.laporan') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'laporan' ? url('assets/media/icons/aside/laporanact.svg') : url('assets/media/icons/aside/laporandef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'laporan' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Laporan</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[1]) && $path[1] === 'laporan-keuangan' ? 'active' : '' }}"
                                href="{{ route('admin.laporan-keuangan') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[1]) && $path[1] === 'laporan-keuangan' ? url('assets/media/icons/aside/laporanact.svg') : url('assets/media/icons/aside/laporandef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[1]) && $path[1] === 'laporan-keuangan' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Rekap Laporan</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu item-->
                </div>

                <div class="menu-item menu-link-indention menu-accordion {{ $path[1] == 'kegiatan' ? 'show' : '' }}"
                    data-kt-menu-trigger="click">
                    <!--begin::Menu link-->
                    <a href="#" class="menu-link py-3 {{ $path[1] == 'kegiatan' ? 'active' : '' }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ $path[1] == 'kegiatan' ? url('assets/media/icons/aside/masterdataact.svg') : url('/assets/media/icons/aside/masterdatadef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ $path[1] == 'kegiatan' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Kegiatan</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <!--end::Menu link-->

                    <!--begin::Menu item-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'jeniskegiatan' ? 'active' : '' }}"
                                href="{{ route('admin.jeniskegiatan') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'jeniskegiatan' ? url('assets/media/icons/aside/invoiceact.svg') : url('assets/media/icons/aside/invoicedef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'jeniskegiatan' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Jenis Kegiatan</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'jenislaporan' ? 'active' : '' }}"
                                href="{{ route('admin.jenislaporan') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'jenislaporan' ? url('assets/media/icons/aside/invoiceact.svg') : url('assets/media/icons/aside/invoicedef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'jenislaporan' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Jenis Laporan</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'agenda' ? 'active' : '' }}"
                                href="{{ route('admin.agenda') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'agenda' ? url('assets/media/icons/aside/invoiceact.svg') : url('assets/media/icons/aside/invoicedef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'agenda' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Agenda Kegiatan</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu item-->

                  
                     <!--begin::Menu item-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'kegiatan' ? 'active' : '' }}"
                                href="{{ route('admin.kegiatan') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'kegiatan' ? url('assets/media/icons/aside/invoiceact.svg') : url('assets/media/icons/aside/invoicedef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'kegiatan' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Kegiatan</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'jadwal-jumat' ? 'active' : '' }}"
                                href="{{ route('admin.jadwal-jumat') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'jadwal-jumat' ? url('assets/media/icons/aside/jamkerjaact.svg') : url('assets/media/icons/aside/jamkerjadef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'jadwal-jumat' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Jadwal
                                    Jum'at</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu item-->

                </div>

                <!--begin::Menu item-->
                <div class="menu-item">
                    <a class="menu-link {{ isset($path[1]) && $path[1] === 'pengajuan' ? 'active' : '' }}"
                        href="{{ route('admin.pengajuan') }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                {!! isset($path[1]) && $path[1] === 'pengajuan'
                                    ? '<i class="fas fa-box-tissue" style="color: #F4BE2A; font-size: 16px"></i>'
                                    : '<i class="fas fa-box-tissue" style="color: #FFFFFF; font-size: 16px"></i>' !!}
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ isset($path[1]) && $path[1] === 'pengajuan' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Peminjaman
                            Tempat</span>
                    </a>
                </div>
                <!--end::Menu item-->

                

                <div class="menu-item menu-link-indention menu-accordion {{ $path[1] == 'tentang' ? 'show' : '' }}"
                    data-kt-menu-trigger="click">
                    <!--begin::Menu link-->
                    <a href="#" class="menu-link py-3 {{ $path[1] == 'tentang' ? 'active' : '' }}">
                        <span class="menu-icon">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                            <span class="svg-icon svg-icon-2">
                                <img src="{{ $path[1] == 'tentang' ? url('assets/media/icons/aside/masterdataact.svg') : url('/assets/media/icons/aside/masterdatadef.svg') }}"
                                    alt="">
                            </span>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-title"
                            style="{{ $path[1] == 'tentang' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Tentang
                            Masjid</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <!--end::Menu link-->

                    <!--begin::Menu item-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'visimisi' ? 'active' : '' }}"
                                href="{{ route('admin.visimisi') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'visimisi' ? url('assets/media/icons/aside/visimisiact.svg') : url('assets/media/icons/aside/visimisidef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'visimisi' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Visi
                                    Misi</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'sejarah' ? 'active' : '' }}"
                                href="{{ route('admin.sejarah') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <img src="{{ isset($path[2]) && $path[2] === 'sejarah' ? url('assets/media/icons/aside/sejarahact.svg') : url('assets/media/icons/aside/sejarahdef.svg') }}"
                                            alt="">
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'sejarah' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Sejarah</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu item-->

                    <!--begin::Menu item-->
                    <div class="menu-sub gap-2 menu-sub-accordion my-2">
                        <div class="menu-item pe-0">
                            <a class="menu-link {{ isset($path[2]) && $path[2] === 'struktur-organisasi' ? 'active' : '' }}"
                                href="{{ route('admin.struktur-organisasi') }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        {!! isset($path[2]) && $path[2] === 'struktur-organisasi'
                                            ? '<i class="fas fa-sitemap" style="color: #F4BE2A; font-size: 16px"></i>'
                                            : '<i class="fas fa-sitemap" style="color: #FFFFFF; font-size: 16px"></i>' !!}
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title"
                                    style="{{ isset($path[2]) && $path[2] === 'struktur-organisasi' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Daftar
                                    Pengurus</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Menu item-->

                </div>
            @endif

            {{-- <div class="menu-item">
                <a class="menu-link  {{ $path[0] === 'change-password' ? 'active' : '' }}"
                    href="{{ route('user.change-password') }}">
                    <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-2">
                            <img src="{{ $path[0] === 'change-password' ? url('admin/assets/media/icons/aside/ubahpasswordact.svg') : url('/admin/assets/media/icons/aside/ubahpassworddef.svg') }}"
                                alt="">
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <span class="menu-title"
                        style="{{ $path[0] === 'change-password' ? 'color: #F4BE2A' : 'color: #FFFFFF' }}">Ubah
                        Password</span>
                </a>
            </div> --}}

        </div>
        <!--end::Menu-->
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            $(".menu-link").hover(function(){
                $(this).css("background", "#039311");
            }, function(){
                $(this).css("background", "none");
            });
        });
    </script>
@endsection
