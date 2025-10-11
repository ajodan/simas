@extends('user.layouts.layout')
@php
    use Carbon\Carbon;
@endphp
@section('content')
    <section>
        <div class="gap no-gap">
            <img class="botm-shp shp-img" src="assets/images/shp1.png" alt="shp1.png">
            <div class="featured-area-wrap slider2 text-center">
                <div class="featured-area owl-carousel">
                    @foreach ($artikels as $artikel)
                        <div class="featured-item"
                            style="background-image: url({{ asset('public/artikel/' . $artikel->photo) }});">
                            <div class="featured-cap" style="border: 3px solid white; padding: 15px; background-color: rgba(0,0,0,0.5); border-radius: 10px;">
                                <h3>{{ $artikel->judul }}</h3>
                                <p class="theme-clr">{{ \Illuminate\Support\Str::words(strip_tags($artikel->isi_artikel), 50, '...') }}</p>
                                <span class="theme-clr">{{ Carbon::parse($artikel->created_at)->format('d M Y') }}, {{ Carbon::parse($artikel->created_at)->format('H:i') }} WIB - {{ $artikel->kategori ? $artikel->kategori->nama_kategori : '' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div><!-- Featured Area Wrap -->
        </div>
    </section><!-- Slider Area -->
    <section>
        <style>
            .fixed-img {
                width: 100%;
                height: 200px; /* ubah sesuai tinggi yang kamu mau */
                object-fit: cover; /* jaga rasio gambar, crop bagian berlebih */
                border-top-left-radius: 0.5rem; /* sesuaikan dengan card */
                border-top-right-radius: 0.5rem;
            }
        </style>
        <div class="gap">
            <div class="container">
                <div class="row">
                    @forelse ($artikels as $artikel)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card shadow-sm h-100 border-0">
                                @if ($artikel->photo)
                                    <img src="{{ asset('public/artikel/' . $artikel->photo) }}" class="card-img-top fixed-img" alt="{{ $artikel->judul }}">
                                @endif
                                <div class="card-body">
                                    <p class="card-text"><small class="text-muted">{{ Carbon::parse($artikel->created_at)->format('d M Y') }}, {{ $artikel->kategori->nama_kategori ?? '-' }}</small></p>
                                    <h5 class="card-title">{{ $artikel->judul }}</h5>
                                    <p class="card-text">{{ Str::limit(strip_tags($artikel->isi_artikel), 100) }}</p>
                                    <a href="{{ url('/artikel/' . $artikel->slug) }}" class="btn btn-primary">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                <strong>Perhatian!</strong> Data artikel belum tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="abt-sec-wrp style2">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <div class="abt-vdo style2 brd-rd5">
                                <img src="{{ asset('masjid-lama3.jpg') }}" alt="abt-img2.jpg" itemprop="image">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <div class="abt-desc">
                                <div class="sec-tl">
                                    <span class="theme-clr">Sejarah</span>
                                    <h2 itemprop="headline">Masjid Jami' Al Furqaan</h2>
                                    <img src="{{ asset('assets-landing/images/pshape.png') }}" alt="">
                                </div>
                                <p itemprop="description">
                                    @if ($sejarah)
                                        {!! \Illuminate\Support\Str::words(strip_tags($sejarah->isi), 60, '...') !!}
                                    @else
                                        Belum ada data
                                    @endif
                                </p>
                                <a class="theme-btn theme-bg brd-rd5" href="{{ route('about') }}" title=""
                                    itemprop="url">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div><!-- About Sec Wrap -->
            </div>
        </div>
    </section>

    <section>
        <div class="gap white-layer opc7">
            <div class="fixed-bg" style="background-image: url(assets/images/parallax1.jpg);"></div>
            <div class="container">
                <div class="sec-tl">
                    <span class="theme-clr">Pilih Negara & Kota Untuk</span>
                    <h2 itemprop="headline">Waktu Sholat</h2>
                    <img src="assets/images/pshape.png" alt="">
                </div>
                <div class="prayer-timing-wrp">
                    <div class="row">
                        <div class="col-md-5 col-sm-12 col-lg-5">
                            <div class="timing-mockp"><img
                                    src="{{ asset('orang-sholat.jpg') }}"
                                    alt="prayer-time-mockp.png" itemprop="image"></div>
                        </div>
                        <div class="col-md-7 col-sm-12 col-lg-7">
                            <div class="timing-data">
                                <div class="cntry-selc">
                                    <div class="selec-wrp brd-rd5">
                                        <select id="comboA" onchange="get_azan_time()">
                                            <option value="Indonesia">Indonesia</option>
                                        </select>
                                    </div>
                                    <div class="selec-wrp brd-rd5">
                                        <select id="comboB" onchange="get_azan_time()">
                                            <option value="Jakarta">Jakarta</option>
                                        </select>
                                    </div>
                                </div>
                                <div id ="result-update"></div>
                                <div class="prayer-timings text-center">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th><span>Nama Sholat</span><img
                                                        src="{{ asset('assets-landing/images/pshape.png') }}"
                                                        alt=""></th>
                                                <th><span>Waktu Azan</span><img
                                                        src="{{ asset('assets-landing/images/pshape.png') }}"
                                                        alt=""></th>
                                                <th><span>Waktu Sholat</span><img
                                                        src="{{ asset('assets-landing/images/pshape.png') }}"
                                                        alt=""></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class = "">
                                                <td><span>Fajar</span></td>
                                                <td class ="fajr-azan-time">{{ $azanTimes['Fajr'] ?? '--:--' }}</td>
                                                <td class ="fajr-azan-prayer">{{ $azanTimes['Fajr'] ?? '--:--' }}</td>
                                            </tr>
                                            <tr>
                                                <td><span>Subuh</span></td>
                                                <td class ="sunrise-azan-time">{{ $azanTimes['Sunrise'] ?? '--:--' }}</td>
                                                <td class ="sunrise-azan-prayer">{{ $azanTimes['Sunrise'] ?? '--:--' }}</td>
                                            </tr>
                                            <tr>
                                                <td><span>Dzuhur</span></td>
                                                <td class ="zohar-azan-time">{{ $azanTimes['Dhuhr'] ?? '--:--' }}</td>
                                                <td class ="zohar-azan-prayer">{{ $azanTimes['Dhuhr'] ?? '--:--' }}</td>
                                            </tr>
                                            <tr>
                                                <td><span>Asar</span></td>
                                                <td class ="asr-azan-time">{{ $azanTimes['Asr'] ?? '--:--' }}</td>
                                                <td class ="asr-azan-prayer">{{ $azanTimes['Asr'] ?? '--:--' }}</td>
                                            </tr>
                                            <tr>
                                                <td><span>Maghrib</span></td>
                                                <td class ="maghrib-azan-time">{{ $azanTimes['Maghrib'] ?? '--:--' }}</td>
                                                <td class ="maghrib-azan-prayer">{{ $azanTimes['Maghrib'] ?? '--:--' }}</td>
                                            </tr>
                                            <tr>
                                                <td><span>Isha</span></td>
                                                <td class ="isha-azan-time">{{ $azanTimes['Isha'] ?? '--:--' }}</td>
                                                <td class ="isha-azan-prayer">{{ $azanTimes['Isha'] ?? '--:--' }}</td>
                                            </tr>
                                            {{-- <tr>
                                                <td><span>SunSet</span></td>
                                                <td class ="juma-azan-time">--:--</td>
                                                <td class ="juma-azan-prayer">--:--</td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Prayer Timing Wrap -->
            </div>
        </div>
    </section>

    <section>
        <div class="gap white-layer opc7">
            <img class = "vector-bg-service" src="{{ asset('assets-landing/images/bg-vector-3.png') }}" alt="vector-bg"
                itemprop="image">
            <div class="container">
                <div class="sec-tl text-center">
                    <span class="theme-clr">Jadwal Jumat</span>
                    <h2 itemprop="headline">Petugas Jumat</h2>
                    <img src="assets/images/pshape.png" alt="">
                </div>
                <div class="serv-wrp remove-ext3">
                    <div class="row">
                        <div class="col-12">
                            <div class="serv-bx text-center">
                                <i class="flaticon-mosque theme-clr"></i>
                                <div class="srv-inf theme-bg brd-rd10">
                                    <div class="d-flex justify-content-center">
                                <div class="d-flex justify-content-center align-items-center mt-4 theme-bg rounded pt-3 px-3"
                                    style="gap:10px; text-align: -webkit-center; width: max-content">
                                    <!-- Gambar Banner -->
                                    @if ($jadwalJumat)
                                        <!-- Gambar Banner -->
                                        <div>
                                            <h6 class="fw-bold text-white">Jadwal Jumat
                                                {{ $jadwalJumat ? $jadwalJumat->tanggal : 'Belum Ada Jadwal' }}</h6>

                                            <table class="table table-sm text-white">
                                                <tbody>
                                                    <tr>
                                                        <th>Tempat</th>
                                                        <td class="px-2">:</td>
                                                        <td>Masjid Jami' Al Furqaan</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Khatib</th>
                                                        <td class="px-2">:</td>
                                                        <td>{{ $jadwalJumat->nama_khatib }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Imam</th>
                                                        <td class="px-2">:</td>
                                                        <td>{{ $jadwalJumat->nama_imam }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Muadzin</th>
                                                        <td class="px-2">:</td>
                                                        <td>{{ $jadwalJumat->nama_muadzin }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <!-- Tombol opsional -->
                                            <!-- <a href="#" class="btn btn-warning mt-2 fw-bold px-4">Lihat Detail</a> -->
                                        </div>
                                    @else
                                        <div>
                                            <h6 class="fw-bold text-white">Belum ada Jadwal</h6>
                                            <!-- Tombol opsional -->
                                            <!-- <a href="#" class="btn btn-warning mt-2 fw-bold px-4">Lihat Detail</a> -->
                                        </div>
                                    @endif
                                </div>
                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Services Wrap -->
            </div>
        </div>
    </section>

    <section>
        <div class="gap black-layer opc8">
            <div class="fixed-bg" style="background-image: url({{ asset('assets-landing/images/parallax2.jpg') }});">
            </div>
            <div class="container">
                <div class="sec-tl text-center">
                    <span class="theme-clr">Video Kegiatan Terbaru</span>
                    <h2 itemprop="headline"></h2>
                    <img src="{{ asset('assets-landing/images/pshape.png') }}" alt="">
                </div>
                {{-- <div class="remove-ext3">
                    <ul class="plrs-wrp text-center">
                        <li>
                            <div class="plr-bx">
                                <i class="flaticon-clicker brd-rd50"></i>
                                <h5 itemprop="headline">Syahadat</h5>
                                <span class="theme-clr">(Keyakinan)</span>
                            </div>
                        </li>
                        <li>
                            <div class="plr-bx">
                                <i class="flaticon-muslim-man-praying brd-rd50"></i>
                                <h5 itemprop="headline">Sholat</h5>
                                <span class="theme-clr">(Doa)</span>
                            </div>
                        </li>
                        <li>
                            <div class="plr-bx">
                                <i class="flaticon-islamic-ramadan brd-rd50"></i>
                                <h5 itemprop="headline">Puasa</h5>
                                <span class="theme-clr">(Menahan Dahaga dan Hawa Nafsu)</span>
                            </div>
                        </li>
                        <li>
                            <div class="plr-bx">
                                <i class="flaticon-money brd-rd50"></i>
                                <h5 itemprop="headline">Zakat</h5>
                                <span class="theme-clr">(sedekah)</span>
                            </div>
                        </li>
                        <li>
                            <div class="plr-bx">
                                <i class="flaticon-kaaba-building brd-rd50"></i>
                                <h5 itemprop="headline">Haji</h5>
                                <span class="theme-clr">(Ziarah)</span>
                            </div>
                        </li>
                    </ul><!-- Pillars Wrap -->
                </div> --}}
                <div class="row">
                    @forelse($kegiatans_you as $kg)
                        @php
                            $videoId = '';
                            if ($kg->link_youtube) {
                                $url = parse_url($kg->link_youtube);
                                if (isset($url['query'])) {
                                    parse_str($url['query'], $query);
                                    if (isset($query['v'])) {
                                        $videoId = $query['v'];
                                    }
                                } else {
                                    // format share (youtu.be/xxxx)
                                    $path = explode('/', $url['path']);
                                    $videoId = end($path);
                                }
                            }
                        @endphp

                        @if($videoId)
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-6">
                                <div class="ratio ratio-16x9">
                                    <iframe width="100%" src="https://www.youtube.com/embed/{{ $videoId }}"
                                            title="YouTube video"
                                            frameborder="0"
                                            width="640" height="460"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                <strong>Perhatian!</strong> Data kegiatan belum tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>
                       
            </div>
        </div>
    </section>
    <section>
        <div class="gap">
            <div class="container">
                <div class="sec-tl text-center">
                    <span class="theme-clr">Terbaru & Terkini</span>
                    <h2 itemprop="headline">Donasi & Kegiatan</h2>
                    <img src="assets/images/pshape.png" alt="">
                </div>
                <div class="remove-ext3">
                    <div class="row">
                        <div class="col-md-7 col-sm-12 col-lg-7">
                            @forelse ($donasis as $dn)
                                <div class="post-bx lst brd-rd5">
                                    <div class="post-thmb">
                                        <a href="{{ route('detail-donasi-campaign', ['params' => $dn->uuid]) }}"
                                            title="" itemprop="url">
                                            <img src="{{ asset('/public/campaign/' . $dn->gambar) }}"
                                                alt="post-img1-1.jpg" itemprop="image" class="img-fit-container">
                                        </a>
                                    </div>
                                    <div class="post-inf">
                                        <h5 itemprop="headline"><a
                                                href="{{ route('detail-donasi-campaign', ['params' => $dn->uuid]) }}"
                                                title=""
                                                itemprop="url">{{ \Illuminate\Support\Str::limit(strip_tags($dn->judul), 25, '...') }}</a>
                                        </h5>
                                        @php
                                            $sisaHari = \Carbon\Carbon::now()->diffInDays(
                                                \Carbon\Carbon::parse($dn->tanggal_selesai),
                                                false,
                                            );
                                        @endphp
                                        <ul class="pst-mta">
                                            <li>🎯 Target Dana Rp {{ number_format($dn->target_dana, 0, ',', '.') }}</li>
                                            <li>💰 Terkumpul Rp {{ number_format($dn->total_donasi, 0, ',', '.') }}</li>
                                            <li>⏳ Sisa Waktu
                                                {{ $sisaHari > 0 ? "Tinggal $sisaHari hari lagi" : 'Berakhir' }}</li>
                                        </ul>
                                        <p itemprop="description">{!! \Illuminate\Support\Str::limit(strip_tags($dn->deskripsi), 40, '...') !!}
                                        </p>
                                        <a href="{{ route('detail-donasi-campaign', ['params' => $dn->uuid]) }}"
                                            title="" itemprop="url">Lihat Detail</a>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning text-center">
                                        <strong>Perhatian!</strong> Data donasi belum tersedia.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                        <div class="col-md-5 col-sm-12 col-lg-5">
                            @forelse ($kegiatans as $kg)
                                <div class="event-bx brd-rd5"
                                    style="background-image: url({{ asset('/public/kegiatan/' . $kg->banner) }});">
                                    <span class="theme-clr">{{ Carbon::parse($kg->tanggal)->translatedFormat('d') }}
                                        <i>{{ Carbon::parse($kg->tanggal)->translatedFormat('F') }}</i></span>
                                    <h5 itemprop="headline"><a
                                            href="{{ route('detail-kegiatan', ['params' => $kg->uuid]) }}" title=""
                                            itemprop="url">{{ \Illuminate\Support\Str::limit(strip_tags($kg->nama_kegiatan), 60, '...') }}</a>
                                    </h5>
                                    <ul class="pst-mta">
                                        <li><i class="fas fa-calendar-alt theme-clr"></i> {{ $kg->jenisKegiatan->jenis_kegiatan
                                         }}</li>
                                         <li><i class="fas fa-map-marker-alt theme-clr"></i> {{ $kg->tempat }}</li>
                                        <li><i class="far fa-clock theme-clr"></i>
                                            {{ $kg->jam }} WIB - Selesai</li>
                                        <li><i class="far fa-sun theme-clr"></i>
                                            {{ $kg->tema }}</li>
                                        <li><i class="far fa-user theme-clr"></i>
                                            {{ $kg->jumlah_hadir }}</li>
                                        <li><i class="far fa-clipboard theme-clr"></i>
                                            {{ Illuminate\Support\Str::limit(strip_tags($kg->deskripsi),64,'...') }}</li>
                                    </ul>
                                    @php
                                        $videoId = '';
                                        if ($kg->link_youtube) {
                                            $url = parse_url($kg->link_youtube);
                                            if (isset($url['query'])) {
                                                parse_str($url['query'], $query);
                                                if (isset($query['v'])) {
                                                    $videoId = $query['v'];
                                                }
                                            }
                                        }
                                    @endphp
                                    {{-- @if($videoId)
                                        <div class="mt-3">
                                            <iframe width="100%" height="200" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    @endif --}}
                                    <a href="{{ route('detail-kegiatan', ['params' => $kg->uuid]) }}" title=""
                                        itemprop="url">Lihat Detail</a>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning text-center">
                                        <strong>Perhatian!</strong> Data kegiatan belum tersedia.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="sec-tl text-center">
                    <span class="theme-clr">Galeri</span>
                    <h2 itemprop="headline">Dokumentasi Kegiatan</h2>
                    <img src="{{ asset('assets-landing/images/pshape.png') }}" alt="">
                </div>
                <div class="gallery-wrap">
                   <div class="row mrg10">
                        <div class="row">
                        @forelse ($dokumentasis as $dk)
                                @php
                                    $allFotos = [];
                                    if ($dk->foto) {
                                        $allFotos[] = $dk->foto;
                                    }
                                    if ($dk->subDokumentasis) {
                                        foreach ($dk->subDokumentasis as $sub) {
                                            if ($sub->foto) {
                                                $allFotos[] = $sub->foto;
                                            }
                                        }
                                    }
                                @endphp
                                @if(count($allFotos) > 0)
                                    <div class="col-md-6 col-lg-4 mb-4">
                                        <div class="card shadow-sm h-100 border-0">
                                            <!-- Carousel -->
                                            <div id="carousel-{{ $dk->uuid }}" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach($allFotos as $index => $foto)
                                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                            <a href="{{ asset('/public/dokumentasi/' . $foto) }}" data-fancybox="gallery-{{ $dk->uuid }}">
                                                                <img src="{{ asset('/public/dokumentasi/' . $foto) }}" class="d-block w-100" alt="{{ $dk->judul }}">
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $dk->uuid }}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $dk->uuid }}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                            </div>
                                            <!-- Thumbnails grid -->
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <h5 class="card-title mb-1">{{ $dk->judul }}</h5>
                                                    @if($dk->keterangan)
                                                        <p class="card-text">{{ $dk->keterangan }}</p>
                                                    @endif
                                                    @if($dk->kegiatan)
                                                        <small class="text-muted">{{ $dk->kegiatan->nama_kegiatan }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-warning text-center">
                                        <strong>Perhatian!</strong> Data dokumentasi belum tersedia.
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    {{-- <section>
        <div class="gap">
            <div class="container">
                <div class="sec-tl text-center">
                    <span class="theme-clr">Rekap Laporan</span>
                    <h2 itemprop="headline">Laporan Keuangan</h2>
                    <img src="{{ asset('assets-landing/images/pshape.png') }}" alt="">
                </div>
                <div class="team-sec remove-ext7">
                    @php
                        $totalSaldo = $donaturTetaps->sum('total_donasi');
                    @endphp

                    <table class="table table-bordered table-sm text-left">
                        <thead class="thead-light text-uppercase text-xs">
                            <tr>
                                <th scope="col" class="w-25">Nama</th>
                                <th scope="col" class="w-25">Nominal</th>
                                <th scope="col" class="w-25">Frekuensi</th>
                                <th scope="col" class="w-25">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($donaturTetaps as $donaturTetap)
                                <tr class="bg-white">
                                    <td>{{ $donaturTetap->nama }}</td>
                                    <td>{{ $donaturTetap->nominal }}</td>
                                    <td>{{ $donaturTetap->frekuensi }}</td>
                                    <td>Rp {{ number_format($donaturTetap->total_donasi, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center font-weight-bold text-muted" colspan="4">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                        @if ($donaturTetaps->count())
                            <tfoot>
                                <tr class="bg-light font-weight-bold">
                                    <td colspan="3" class="text-right">Total Saldo</td>
                                    <td>Rp {{ number_format($totalSaldo, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>

                </div><!-- Team Sec -->
            </div>
        </div>
    </section> --}}
    <section>
        <div class="gap">
            <div class="container">
                <div class="sec-tl text-center">
                    <span class="theme-clr">Laporan Keuangan</span>
                    <h2 itemprop="headline">Laporan Keuangan Terbaru</h2>
                    <img src="{{ asset('assets-landing/images/pshape.png') }}" alt="">
                </div>
                <div class="row">
                    @forelse ($laporan_keuangans as $laporan)
                        <div class="col-md-4 col-sm-6 col-lg-4 mb-4">
                            <div class="card shadow-sm h-100 border-0">
                                <div class="card-body text-center">
                                    <h4 class="card-title color-theme font-weight-bold  text-uppercase
                                    mb-2">{{ $laporan->jenisLaporan ? $laporan->jenisLaporan->jenis_laporan : 'Jenis Laporan' }}</h4>
                                    <h5 class="card-title mb-2">{{ $laporan->jenisLaporan ? $laporan->jenis_laporan : 'Jenis Laporan' }}</h5>
                                    <p class="card-text mb-2">Saldo Akhir: Rp {{ number_format($laporan->saldo_akhir, 0, ',', '.') }}</p>
                                    @if ($laporan->upload_file)
                                        <div class="mb-2">
                                            <i class="fas fa-file-alt fa-3x text-primary"></i>
                                        </div>
                                        <a href="{{ asset('public/laporan-keuangan/' . $laporan->upload_file) }}" target="_blank" class="btn btn-primary btn-sm">
                                            <i class="fas fa-download"></i> Download File
                                        </a>
                                    @else
                                        <p>Tidak ada file</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                <strong>Perhatian!</strong> Data laporan keuangan belum tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <section id="inventaris">
        <div class="gap">
            <div class="container">
                <div class="sec-tl text-center">
                    <span class="theme-clr">Inventaris</span>
                    <h2 itemprop="headline">Data Inventaris Masjid</h2>
                    <img src="{{ asset('assets-landing/images/pshape.png') }}" alt="">
                </div>
                <div class="row">
                    @forelse ($inventaris as $item)
                        <div class="col-md-4 col-sm-6 col-lg-4 mb-4">
                            <div class="card shadow-sm h-100 border-0">
                                @if($item->photo)
                                    <img src="{{ asset('public/inventaris/' . $item->photo) }}" class="card-img-top img-fluid" width="50%" height="50%" alt="{{ $item->nama_inventaris }}">
                                @endif
                                <div class="card-body text-center">
                                    <h5 class="card-title mb-2">{{ $item->nama_inventaris }}</h5>
                                    <p class="card-text mb-2">Jumlah : {{ $item->jumlah }} {{ $item->satuan }}</p>
                                    <p class="card-text mb-2">Kondisi : {{ $item->kondisi }}</p>
                                    <p class="card-text mb-2">Lokasi : {{ $item->keterangan }}</p>
                                    <p class="card-text mb-2">Tahun Perolehan : {{ $item->tahun_perolehan }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                <strong>Perhatian!</strong> Data inventaris belum tersedia.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</section>
@section('scripts')
    <script>
        function get_azan_time() {
            const country = document.getElementById("comboA").value;
            const city = document.getElementById("comboB").value;

            fetch(`/waktu-azan?negara=${country}&kota=${city}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        document.getElementById("result-update").innerHTML = "<p class='text-danger'>" + data.error +
                            "</p>";
                    } else {
                        document.querySelector(".fajr-azan-time").textContent = data.Fajr;
                        document.querySelector(".fajr-azan-prayer").textContent = data.Fajr;

                        document.querySelector(".sunrise-azan-time").textContent = data.Sunrise;
                        document.querySelector(".sunrise-azan-prayer").textContent = data.Sunrise;

                        document.querySelector(".zohar-azan-time").textContent = data.Dhuhr;
                        document.querySelector(".zohar-azan-prayer").textContent = data.Dhuhr;

                        document.querySelector(".asr-azan-time").textContent = data.Asr;
                        document.querySelector(".asr-azan-prayer").textContent = data.Asr;

                        document.querySelector(".maghrib-azan-time").textContent = data.Maghrib;
                        document.querySelector(".maghrib-azan-prayer").textContent = data.Maghrib;

                        document.querySelector(".isha-azan-time").textContent = data.Isha;
                        document.querySelector(".isha-azan-prayer").textContent = data.Isha;
                    }
                }).catch(error => {
                    document.getElementById("result-update").innerHTML =
                        "<p class='text-danger'>Terjadi kesalahan saat memuat data.</p>";
                    console.error(error);
                });
        }

        // Data waktu azan sudah dimuat dari server, hanya update saat select berubah

        // Change Password Form Submission
        document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const messageDiv = document.getElementById('message');

            fetch('/user/change-password', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageDiv.innerHTML = '<div class="alert alert-success">Password berhasil diubah!</div>';
                    this.reset();
                } else {
                    messageDiv.innerHTML = '<div class="alert alert-danger">' + (data.message || 'Terjadi kesalahan') + '</div>';
                }
            })
            .catch(error => {
                messageDiv.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan saat mengubah password.</div>';
                console.error(error);
            });
        });
    </script>
@endsection
