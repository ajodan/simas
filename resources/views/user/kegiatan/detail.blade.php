@extends('user.layouts.layout')
@php
    use Carbon\Carbon;
@endphp
@section('content')
    <section>
        <div class="gap black-layer opc7">
            <div class="fixed-bg2" style="background-image: url({{ asset('assets-landing/images/pg-tp-bg.jpg') }});"></div>
            <div class="container">
                <div class="pg-tp-wrp text-center">
                    <div class="pg-tp-inr">
                        <h1 itemprop="headline">{{ $module }}</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title=""
                                    itemprop="url">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('kegiatan') }}" title=""
                                    itemprop="url">Kegiatamn</a></li>
                            <li class="breadcrumb-item active">Detail Kegiatan</li>
                        </ol>
                    </div>
                </div><!-- Page Top Wrap -->
            </div>
        </div>
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="event-detail-wrp">
                    <div class="row">
                        <div class="col-md-9 col-sm-12 col-lg-9">
                            <div class="event-detail">
                                <div class="event-detail-img brd-rd5">
                                    <span>{{ Carbon::parse($data->tanggal)->translatedFormat('d') }}
                                        <i>{{ Carbon::parse($data->tanggal)->translatedFormat('F') }}</i></span>
                                    <img src="{{ asset('/storage/public/kegiatan/' . $data->banner) }}" class="w-100"
                                        alt="event-detail-img.jpg" itemprop="image">
                                    <ul class="countdown d-flex justify-content-center align-items-center text-center"
                                        data-countdown="{{ \Carbon\Carbon::parse($data->tanggal)->format('Y-m-d\TH:i:s') }}">
                                        <li>
                                            <span class="hari">{{ Carbon::parse($data->tanggal)->translatedFormat('d') }}</span>
                                            <p class="hari_ref">hari</p>
                                        </li>
                                        <li>
                                            <span class="jam">{{ Carbon::parse($data->tanggal)->translatedFormat('H') }}</span>
                                            <p class="jam_ref">jam</p>
                                        </li>
                                        <li>
                                            <span class="menit">{{ Carbon::parse($data->tanggal)->translatedFormat('i') }}</span>
                                            <p class="menit_ref">menit</p>
                                        </li>
                                        <li>
                                            <span class="detik">{{ Carbon::parse($data->tanggal)->translatedFormat('s') }}</span>
                                            <p class="detik_ref">detik</p>
                                        </li>
                                    </ul>
                                </div>
                                <div class="event-detail-inf-inr">
                                    <ul class="pst-mta">
                                        <li><i class="fas fa-map-marker-alt theme-clr"></i> {{ $data->tempat }}</li>
                                        <li><i class="far fa-clock theme-clr"></i>
                                            {{ $data->jam }} - Selesai</li>
                                        <li><i class="far fa-sun theme-clr"></i>
                                            {{ $data->tema }}</li>
                                        <li><i class="far fa-user theme-clr"></i>
                                            {{ $data->jumlah_hadir }} Orang</li>
                                    </ul>
                                </div>
                                <div class="event-detail-desc">
                                    <p itemprop="description">{!! $data->deskripsi !!}</p>
                                </div>

                                @if($data->link_youtube)
                                <div class="event-detail-youtube mt-4">
                                    <h6>Video Kegiatan</h6>
                                    <a href="{{ $data->link_youtube }}" target="_blank" class="btn btn-primary">Tonton di YouTube</a>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-lg-3">
                            <div class="sidebar-wrp">
                                <div class="widget">
                                    <h5 itemprop="headline">Cari Kegiatan</h5>
                                    <form class="srch-frm brd-rd5">
                                        <input type="text" placeholder="Cari" />
                                        <button type="submit" class="theme-clr"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                                <div class="widget">
                                    <h5 itemprop="headline">Kegiatan Lainnya</h5>
                                    <div class="rcnt-wrp">
                                        @foreach ($kegiatanLainnya as $kl)
                                            <div class="rcnt-bx">
                                                <a class="brd-rd5"
                                                    href="{{ route('detail-kegiatan', ['params' => $kl->uuid]) }}"
                                                    title="" itemprop="url"><img
                                                        src="{{ asset('/storage/public/kegiatan/' . $kl->banner) }}"
                                                        alt="rcnt-img1.jpg" style="height: 66px" itemprop="image"></a>
                                                <div class="rcnt-inf">
                                                    <h6 itemprop="headline"><a
                                                            href="{{ route('detail-kegiatan', ['params' => $kl->uuid]) }}"
                                                            title=""
                                                            itemprop="url">{{ \Illuminate\Support\Str::limit(strip_tags($kl->nama_kegiatan), 20, '...') }}</a>
                                                    </h6>
                                                    <span class="theme-clr"><i
                                                            class="far fa-calendar-alt"></i>{{ Carbon::parse($kl->tanggal)->translatedFormat('d m Y') }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div><!-- Sidebar Wrap -->
                        </div>
                    </div>
                </div><!-- Event Detail Wrap -->
            </div>
        </div>
    </section>
@endsection
