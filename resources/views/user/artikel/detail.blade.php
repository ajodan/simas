@extends('user.layouts.layout')
@section('content')
    <section>
        <div class="gap black-layer opc7">
            <div style="background-image: url({{ asset('assets-landing/images/pg-tp-bg.jpg') }});"></div>
            <div class="container">
                <div class="pg-tp-wrp text-center">
                    <div class="pg-tp-inr">
                        <h1 itemprop="headline">{{ $artikel->judul }}</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title="" itemprop="url">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('landing-artikel') }}" title="" itemprop="url">Artikel</a></li>
                            <li class="breadcrumb-item active">{{ $artikel->judul }}</li>
                        </ol>
                    </div>
                </div><!-- Page Top Wrap -->
            </div>
        </div>
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="blog-detail">
                            @if ($artikel->photo)
                                <div class="blog-thumb">
                                    <img src="{{ asset('storage/artikel/' . $artikel->photo) }}" alt="{{ $artikel->judul }}" class="img-fluid">
                                </div><br>
                            @endif
                            <div class="blog-info">
                                <span class="theme-clr"><i class="far fa-calendar-alt"></i>{{ $artikel->created_at->format('M d, Y') }}</span>
                                <span class="theme-clr"><i class="fas fa-tag"></i>{{ $artikel->kategori->nama_kategori ?? 'Uncategorized' }}</span>
                            </div>
                            <div class="blog-content">
                                {!! $artikel->isi_artikel !!}
                            </div>
                        </div>
                    </div><br>
                    <div class="col-md-4">
                        <div class="sidebar">
                            <div class="widget">
                                <h5>Kategori Artikel</h5>
                                <ul class="list-group">
                                    @foreach (\App\Models\KategoriArtikel::all() as $kategori)
                                        <li class="list-group-item"><a href="#">{{ $kategori->nama_kategori }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
