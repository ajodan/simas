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
                        <h1 itemprop="headline">Artikel Masjid Jami' Al Furqaan</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title=""
                                    itemprop="url">Home</a></li>
                            <li class="breadcrumb-item active">Artikel</li>
                        </ol>
                    </div>
                </div><!-- Page Top Wrap -->
            </div>
        </div>
    </section>

    <section>
        <style>
            .fixed-img {
            width: 100%;
            height: 220px; /* bebas, bisa 200px/250px sesuai desain */
            object-fit: cover; /* gambar terpotong rapi */
            object-position: center; /* fokus tengah */
            border-top-left-radius: 0.5rem; 
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
                {{ $artikels->links() }}
            </div>
        </div>
    </section>
@endsection
