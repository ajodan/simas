@extends('user.layouts.layout')
@section('content')
    <section>
        <div class="gap black-layer opc7">
            <div class="fixed-bg2" style="background-image: url({{ asset('assets-landing/images/pg-tp-bg.jpg') }});"></div>
            <div class="container">
                <div class="pg-tp-wrp text-center">
                    <div class="pg-tp-inr">
                        <h1 itemprop="headline">Sejarah Masjid Jami' Al Furqaan</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title=""
                                    itemprop="url">Home</a></li>
                            <li class="breadcrumb-item active">Tentang Masjid</li>
                        </ol>
                    </div>
                </div><!-- Page Top Wrap -->
            </div>
        </div>
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="abt-sec-wrp">
                    <div class="row">
                        
                        <div class="col-md-12 col-sm-12 col-lg-12">
                            <div class="abt-desc">
                                <div class="sec-tl">
                                    <span class="theme-clr">Sejarah</span>
                                    <h2 itemprop="headline">Sejarah Masjid Jami' Al Furqaan</h2>
                                </div>
                                @if ($sejarah)
                                    <p itemprop="description">{!! $sejarah->isi !!}</p><br><br>
                                @else
                                    <p itemprop="description">Belum ada data.</p>
                                @endif
                                {{-- <a class="theme-btn theme-bg brd-rd5" href="#" title="" itemprop="url">READ
                                    MORE</a> --}}
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-lg-4">
                            <div class="abt-vdo brd-rd5">
                                <img src="{{ asset('assets-landing/images/masjid-lama1.jpg') }}" class="w-100" alt="abt-img.jpg" itemprop="image">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-lg-4">
                            <div class="abt-vdo brd-rd5">
                                <img src="{{ asset('assets-landing/images/masjid-lama2.jpg') }}" class="w-100" alt="abt-img.jpg" itemprop="image">
                            </div>
                        </div>
                         <div class="col-md-4 col-sm-12 col-lg-4">
                            <div class="abt-vdo brd-rd5">
                                <img src="{{ asset('assets-landing/images/masjid-lama3.jpg') }}" class="w-100" alt="abt-img.jpg" itemprop="image">

                            </div>
                        </div>
                    </div>
                </div><!-- About Sec Wrap -->
            </div>
        </div>
    </section>

    {{-- <section>
        <div class="gap pt-0">
            <div class="container">
                <div class="remove-ext3">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <div class="d-flex align-items-center mt-4">
                                <h2 itemprop="headline">Visi</h2>
                            </div>
                            <ul class="mt-2" style="list-style-type: disc;">
                                @foreach ($visi as $v)
                                    <li>{{ $v->item }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <div class="d-flex align-items-center mt-4">
                                <h2 itemprop="headline">Misi</h2>
                            </div>
                            <ul class="mt-2" style="list-style-type: disc;">
                                @foreach ($misi as $m)
                                    <li>{{ $m->item }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div><!-- About Sec Wrap -->
            </div>
        </div>
    </section> --}}

    {{-- <section>
        <div class="gap">
            <div class="container">
                <div class="sec-tl text-center">
                    <h2 itemprop="headline">Nama Pengurus Masjid Jami' Al Furqaan</h2>
                    <img src="{{ asset('assets-landing/images/pshape.png') }}" alt="">
                </div>
                <div class="team-sec remove-ext7">
                    @php
                        $grouped = $struktur_organisasi->groupBy('unit');
                    @endphp
                    @forelse ($grouped as $unit => $anggota)
                        <div class="card mb-4 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <strong>{{ $loop->iteration }}. {{ strtoupper($unit) }}</strong>
                            </div>
                            <div class="card-body">
                                @php
                                    $jabatanGrouped = $anggota->groupBy('posisi');
                                @endphp

                                @foreach ($jabatanGrouped as $jabatan => $personils)
                                    @if ($jabatan)
                                        <p class="mb-1 font-weight-bold">{{ $jabatan }}</p>
                                    @endif
                                    <ul class="mb-3">
                                        @foreach ($personils as $person)
                                            <li>{{ $person->nama }}</li>
                                        @endforeach
                                    </ul>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">
                            Tidak ada pengurus untuk unit ini.
                        </div>
                    @endforelse
                </div><!-- Team Sec -->
            </div>
        </div>
    </section> --}}

    <section>
        <div class="gap pt-0">
            <div class="container">
                <div class="remove-ext3">
                    <div class="embed-responsive embed-responsive-16by9 mt-6 rounded">
                       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.89729286637038!2d107.0455407205455!3d-6.216604666744997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698f001e4d2dc1%3A0xa847812afa0acd4c!2smasjid%20al%20furqaan!5e0!3m2!1sid!2sid!4v1759559260896!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <style>
                        .embed-responsive {
                            position: relative;
                            display: block;
                            width: 100%;
                            height: 55vh;
                            padding: 0;
                            overflow: hidden;
                        }

                        .embed-responsive::before {
                            content: "";
                            display: block;
                            padding-top: 56.25%;
                            /* 16:9 aspect ratio */
                        }

                        .embed-responsive .embed-responsive-item,
                        .embed-responsive iframe,
                        .embed-responsive embed,
                        .embed-responsive object,
                        .embed-responsive video {
                            position: absolute;
                            top: 0;
                            left: 0;
                            bottom: 0;
                            width: 100%;
                            height: 100%;
                            border: 0;
                        }
                    </style>
                </div>
            </div>
    </section>
@endsection
