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
                        @forelse ($data as $dk)
                            <div class="col-md-4 col-sm-6 col-lg-4">
                                <div class="gallery-item brd-rd5">
                                    <a href="{{ asset('/public/dokumentasi/' . $dk->foto) }}" data-fancybox="gallery"
                                        title="" itemprop="url"><img
                                            src="{{ asset('/public/dokumentasi/' . $dk->foto) }}" alt="gallery-img1-1.jpg"
                                            itemprop="image"></a>
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
                </div><!-- Gallery Wrap -->
            </div>
        </div>
    </section>
@endsection
