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
                        <h1 itemprop="headline">Donasi Untuk Pembangunan Masjid</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title=""
                                    itemprop="url">Home</a></li>
                            <li class="breadcrumb-item active">Donasi Campaign</li>
                        </ol>
                    </div>
                </div><!-- Page Top Wrap -->
            </div>
        </div>
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="remove-ext3">
                    <div class="row">
                        @forelse ($data as $dn)
                            <div class="col-md-4 col-sm-6 col-lg-4">
                                <div class="post-bx brd-rd5 blog-grid-cont">
                                    <div class="post-thmb"><a
                                            href="{{ route('detail-donasi-campaign', ['params' => $dn->uuid]) }}"
                                            title="" itemprop="url"><img
                                                src="{{ asset('/storage/campaign/' . $dn->gambar) }}" alt="post-img2-1.jpg"
                                                itemprop="image"></a></div>
                                    <div class="post-inf">
                                        <h5 itemprop="headline"><a
                                                href="{{ route('detail-donasi-campaign', ['params' => $dn->uuid]) }}"
                                                title="" itemprop="url">{{ $dn->judul }}</a></h5>
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
                                        <p itemprop="description">{!! \Illuminate\Support\Str::words(strip_tags($dn->deskripsi), 20, '...') !!}</p>
                                        <a href="{{ route('detail-donasi-campaign', ['params' => $dn->uuid]) }}"
                                            title="" itemprop="url">Lihat Detail</a>
                                    </div>
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
                </div>
                @if ($data->lastPage() > 1)
                    <div class="pagination-wrap text-center">
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            <li class="page-item brd-rd5 {{ $data->onFirstPage() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $data->previousPageUrl() ?? '#' }}" aria-label="Previous">
                                    <i class="fas fa-angle-left"></i>
                                </a>
                            </li>

                            {{-- Pagination Elements --}}
                            @for ($i = 1; $i <= $data->lastPage(); $i++)
                                <li class="page-item brd-rd5 {{ $data->currentPage() == $i ? 'active' : '' }}">
                                    @if ($data->currentPage() == $i)
                                        <span>{{ $i }}</span>
                                    @else
                                        <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
                                    @endif
                                </li>
                            @endfor

                            {{-- Next Page Link --}}
                            <li class="page-item brd-rd5 {{ !$data->hasMorePages() ? 'disabled' : '' }}">
                                <a class="page-link" href="{{ $data->nextPageUrl() ?? '#' }}" aria-label="Next">
                                    <i class="fas fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
