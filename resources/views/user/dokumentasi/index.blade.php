@extends('user.layouts.layout')
@section('content')
    <section>
        <div class="gap black-layer opc7">
            <div class="fixed-bg2" style="background-image: url({{ asset('assets-landing/images/pg-tp-bg.jpg') }});"></div>
            <div class="container">
                <div class="pg-tp-wrp text-center">
                    <div class="pg-tp-inr">
                        <h1 itemprop="headline">Dokumentasi Kegiatan Masjid Jami' Al Furqaan</h1>
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
                </div><!-- Gallery Wrap -->
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('.carousel').on('slid.bs.carousel', function (e) {
        var carouselId = $(this).attr('id');
        var activeIndex = $(this).find('.carousel-item.active').index();
        // Remove active from all buttons in this card
        $(this).closest('.card').find('.card-body .btn').removeClass('active');
        // Add active to the corresponding button
        $(this).closest('.card').find('.card-body .btn').eq(activeIndex).addClass('active');
    });
});
</script>
@endsection
