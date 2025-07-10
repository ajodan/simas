@extends('user.layouts.layout')
@php
    use Carbon\Carbon;
@endphp
@section('content')
    <section>
        <div class="gap no-gap">
            <!--<img class="botm-shp shp-img" src="assets/images/shp1.png" alt="shp1.png">-->
            <div class="featured-area-wrap slider2 text-center">
                <div class="featured-area owl-carousel">
                    <div class="featured-item"
                        style="background-image: url({{ asset('assets-landing/images/resources/slide-4.jpg') }});">
                        <div class="featured-cap">
                            <img src="{{ asset('assets-landing/images/resources/bsml-txt.png') }}" alt="bsml-txt.png">
                            <h3><img src="{{ asset('assets-landing/images/resources/ayat-txt.png') }}" alt="ayat-txt.png">
                            </h3>
                            <img class = "before-imge" src="{{ asset('assets-landing/images/pshape.png') }}" alt="">
                            <h3>Dia meninggikan langit dan mengatur keseimbangan</h3>
                            <span>(Surat Ar-Rahman Ayat 7)</span>
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
                                                        <td>Masjid Agung Sultan Alauddin</td>
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
                    <div class="featured-item"
                        style="background-image: url({{ asset('assets-landing/images/resources/slide2.jpg') }});">
                        <div class="featured-cap">
                            <img src="{{ asset('assets-landing/images/resources/bsml-txt.png') }}" alt="bsml-txt2.png">
                            <h1><img src="{{ asset('assets-landing/images/resources/ayat-txt.png') }}" alt="ayat-txt2.png">
                            </h1>
                            <img class = "before-imge" src="{{ asset('assets-landing/images/pshape.png') }}"
                                alt="">
                            <h3>Dia meninggikan langit dan mengatur keseimbangan</h3>
                            <span>(Surat Ar-Rahman Ayat 7)</span>
                            <div class="d-flex justify-content-center">
                                <div class="d-flex justify-content-center align-items-center mt-4 theme-bg rounded pt-3 px-3"
                                    style="gap:10px; text-align: -webkit-center; width: max-content">


                                    <!-- Konten Teks -->
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
                                                        <td>Masjid Agung Sultan Alauddin</td>
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
            </div><!-- Featured Area Wrap -->
        </div>
    </section><!-- Slider Area -->

    <section>
        <div class="gap">
            <div class="container">
                <div class="abt-sec-wrp style2">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <div class="abt-vdo style2 brd-rd5">
                                <img src="{{ asset('backround.png') }}" alt="abt-img2.jpg" itemprop="image">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <div class="abt-desc">
                                <div class="sec-tl">
                                    <span class="theme-clr">Sejarah</span>
                                    <h2 itemprop="headline">Masjid Agung Sultan</h2>
                                    <img src="{{ asset('assets-landing/images/pshape.png') }}" alt="">
                                </div>
                                <p itemprop="description">
                                    @if ($sejarah)
                                        {!! \Illuminate\Support\Str::words(strip_tags($sejarah->isi), 50, '...') !!}
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
                                    src="{{ asset('assets-landing/images/resources/prayer-time-mockp.png') }}"
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
                                            <option value="Makassar">Makassar</option>
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
                                                <td class ="fajr-azan-time">--:--</td>
                                                <td class ="fajr-azan-prayer">--:--</td>
                                            </tr>
                                            <tr>
                                                <td><span>Subuh</span></td>
                                                <td class ="sunrise-azan-time">--:--</td>
                                                <td class ="sunrise-azan-prayer">--:--</td>
                                            </tr>
                                            <tr>
                                                <td><span>Dzuhur</span></td>
                                                <td class ="zohar-azan-time">--:--</td>
                                                <td class ="zohar-azan-prayer">--:--</td>
                                            </tr>
                                            <tr>
                                                <td><span>Asar</span></td>
                                                <td class ="asr-azan-time">--:--</td>
                                                <td class ="asr-azan-prayer">--:--</td>
                                            </tr>
                                            <tr>
                                                <td><span>Maghrib</span></td>
                                                <td class ="maghrib-azan-time">--:--</td>
                                                <td class ="maghrib-azan-prayer">--:--</td>
                                            </tr>
                                            <tr>
                                                <td><span>Isha</span></td>
                                                <td class ="isha-azan-time">--:--</td>
                                                <td class ="isha-azan-prayer">--:--</td>
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
    {{-- <section>
        <div class="gap white-layer opc7">
            <img class = "vector-bg-service" src="{{ asset('assets-landing/images/bg-vector-3.png') }}" alt="vector-bg"
                itemprop="image">
            <div class="container">
                <div class="sec-tl text-center">
                    <span class="theme-clr">Jadwal Juma'at</span>
                    <h2 itemprop="headline">Petugas Jumat</h2>
                    <img src="assets/images/pshape.png" alt="">
                </div>
                <div class="serv-wrp remove-ext3">
                    <div class="row">
                        <div class="col-12">
                            <div class="serv-bx text-center">
                                <i class="flaticon-mosque theme-clr"></i>
                                <h5 itemprop="headline"><a href="service-detail.html" title=""
                                        itemprop="url">Mosque Development</a></h5>
                                <div class="srv-inf theme-bg brd-rd10">
                                    <p itemprop="description">Renovation of mosques sit amet, consectetur elit, sed
                                        do eiusmod tempor incididunt</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- Services Wrap -->
            </div>
        </div>
    </section> --}}

    <section>
        <div class="gap black-layer opc8">
            <div class="fixed-bg" style="background-image: url({{ asset('assets-landing/images/parallax2.jpg') }});">
            </div>
            <div class="container">
                <div class="sec-tl text-center">
                    <span class="theme-clr">Tentang Islam</span>
                    <h2 itemprop="headline">Rukun Islam</h2>
                    <img src="{{ asset('assets-landing/images/pshape.png') }}" alt="">
                </div>
                <div class="remove-ext3">
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
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="gap">
            <div class="container">
                <div class="sec-tl text-center">
                    <span class="theme-clr">Terbaru & Terupdate</span>
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
                                            itemprop="url">{{ \Illuminate\Support\Str::limit(strip_tags($kg->nama_kegiatan), 33, '...') }}</a>
                                    </h5>
                                    <ul class="pst-mta">
                                        <li><i class="fas fa-map-marker-alt theme-clr"></i> {{ $kg->tempat }}</li>
                                        <li><i class="far fa-clock theme-clr"></i>
                                            {{ $kg->waktu }} - Selesai</li>
                                    </ul>
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
                    <span class="theme-clr">Donatur Tetap</span>
                    <h2 itemprop="headline">Nama Yang Menjadi Donatur</h2>
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
    </section>
@endsection
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

        // Panggil saat halaman load pertama kali
        document.addEventListener('DOMContentLoaded', get_azan_time);
    </script>
@endsection
