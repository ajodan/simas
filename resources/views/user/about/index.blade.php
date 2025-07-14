@extends('user.layouts.layout')
@section('content')
    <section>
        <div class="gap black-layer opc7">
            <div class="fixed-bg2" style="background-image: url({{ asset('assets-landing/images/pg-tp-bg.jpg') }});"></div>
            <div class="container">
                <div class="pg-tp-wrp text-center">
                    <div class="pg-tp-inr">
                        <h1 itemprop="headline">Tentang Masjid Agung Sultan Alauddin</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title=""
                                    itemprop="url">Home</a></li>
                            <li class="breadcrumb-item active">About</li>
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
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <div class="abt-vdo brd-rd5">
                                <img src="{{ asset('backround.png') }}" class="w-100" alt="abt-img.jpg" itemprop="image">
                                <a href="" title="Click To Play" data-fancybox="" itemprop="url"><i
                                        class="flaticon-play-button"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            <div class="abt-desc">
                                <div class="sec-tl">
                                    <span class="theme-clr">Sejarah</span>
                                    <h2 itemprop="headline">Tentang Masjid Agung Sultan Aluddin</h2>
                                </div>
                                @if ($sejarah)
                                    <p itemprop="description">{!! $sejarah->isi !!}</p>
                                @else
                                    <p itemprop="description">Belum ada data.</p>
                                @endif
                                {{-- <a class="theme-btn theme-bg brd-rd5" href="#" title="" itemprop="url">READ
                                    MORE</a> --}}
                            </div>
                        </div>
                    </div>
                </div><!-- About Sec Wrap -->
            </div>
        </div>
    </section>

    <section>
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
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="sec-tl text-center">
                    <span class="theme-clr">Struktur Organisasi</span>
                    <h2 itemprop="headline">Nama Pengurus Masjid Sultan Alauddin</h2>
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
                                    <p class="mb-1 font-weight-bold">{{ $jabatan }}:</p>
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
                            Tidak ada anggota untuk unit ini.
                        </div>
                    @endforelse
                </div><!-- Team Sec -->
            </div>
        </div>
    </section>

    <section>
        <div class="gap pt-0">
            <div class="container">
                <div class="remove-ext3">
                    <div class="embed-responsive embed-responsive-16by9 mt-6 rounded">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.366767239663!2d119.49635211011523!3d-5.204917679738017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee33c061a2f93%3A0x5520dae652991f7a!2sMasjid%20Agung%20Sultan%20Alauddin!5e0!3m2!1sid!2sid!4v1748535526912!5m2!1sid!2sid"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
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
