@extends('user.layouts.layout')
@section('content')
    <section>
        <div class="gap black-layer opc7">
            <div class="fixed-bg2" style="background-image: url({{ asset('assets-landing/images/pg-tp-bg.jpg') }});"></div>
            <div class="container">
                <div class="pg-tp-wrp text-center">
                    <div class="pg-tp-inr">
                        <h1 itemprop="headline">Dokumentasi Kegiatan dan acara Masjid Agung Sultang Alauddin</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title=""
                                    itemprop="url">Home</a></li>
                            <li class="breadcrumb-item active">Dokumentasi</li>
                        </ol>
                    </div>
                </div><!-- Page Top Wrap -->
            </div>
        </div>
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="gallery-wrap">
                    <div class="row mrg10">
                        <div class="row">
                            @forelse ($data as $dk)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card shadow-sm h-100 border-0">
                                        <a href="{{ asset('/public/dokumentasi/' . $dk->foto) }}" data-fancybox="gallery">
                                            <img src="{{ asset('/public/dokumentasi/' . $dk->foto) }}"
                                                class="card-img-top rounded-top" alt="{{ $dk->judul }}">
                                        </a>
                                        <div class="card-body text-center">
                                            <h5 class="card-title mb-0">{{ $dk->judul }}</h5>
                                        </div>
                                    </div>
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
                </div><!-- Gallery Wrap -->
            </div>
        </div>
    </section>
@endsection
