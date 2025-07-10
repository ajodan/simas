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
                        <h1 itemprop="headline">Kegiatan Masjid Agung Sultan Alauddin</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title=""
                                    itemprop="url">Home</a></li>
                            <li class="breadcrumb-item active">Kegiatan</li>
                        </ol>
                    </div>
                </div><!-- Page Top Wrap -->
            </div>
        </div>
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="event-sec remove-ext5">
                    <div class="row">
                        @forelse ($data as $kg)
                            <div class="col-md-4 col-sm-6 col-lg-4">
                                <div class="event-bx2 brd-rd5">
                                    <div class="event-thmb">
                                        <span>{{ Carbon::parse($kg->tanggal)->translatedFormat('d') }}
                                            <i>{{ Carbon::parse($kg->tanggal)->translatedFormat('F') }}</i></span>
                                        <a href="{{ route('detail-kegiatan', ['params' => $kg->uuid]) }}" title=""
                                            itemprop="url"><img src="{{ asset('/public/kegiatan/' . $kg->banner) }}"
                                                alt="event-img1.jpg" style="height: 296px" itemprop="image"></a>
                                        <ul class="countdown d-flex justify-content-center align-items-center text-center"
                                            data-countdown="{{ \Carbon\Carbon::parse($kg->tanggal)->format('Y-m-d\TH:i:s') }}">
                                            <li>
                                                <span class="hari">0</span>
                                                <p class="hari_ref">hari</p>
                                            </li>
                                            <li>
                                                <span class="jam">0</span>
                                                <p class="jam_ref">jam</p>
                                            </li>
                                            <li>
                                                <span class="menit">0</span>
                                                <p class="menit_ref">menit</p>
                                            </li>
                                            <li>
                                                <span class="detik">0</span>
                                                <p class="detik_ref">detik</p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="event-inf">
                                        <h5 itemprop="headline"><a
                                                href="{{ route('detail-kegiatan', ['params' => $kg->uuid]) }}"
                                                title="" itemprop="url">{{ $kg->nama_kegiatan }}</a></h5>
                                        <ul class="pst-mta">
                                            <li><i class="fas fa-map-marker-alt theme-clr"></i> {{ $kg->tempat }}</li>
                                            <li><i class="far fa-clock theme-clr"></i>
                                                {{ $kg->jam }} - Selesai</li>
                                        </ul>
                                        <p itemprop="description">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($kg->deskripsi), 33, '...') }}</p>
                                        <a href="{{ route('detail-kegiatan', ['params' => $kg->uuid]) }}" title=""
                                            itemprop="url">Lihat Detail</a>
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
                </div><!-- Events Sec -->
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
@section('scripts')
    <script>
        function updateCountdowns() {
            const countdowns = document.querySelectorAll('.countdown');

            countdowns.forEach(function(countdown) {
                const targetDateStr = countdown.getAttribute('data-countdown');
                const targetDate = new Date(targetDateStr);
                const now = new Date();
                const diff = targetDate - now;

                if (diff <= 0) {
                    // Jika waktu telah lewat
                    countdown.innerHTML = `
                    <li><span class="hari">0</span><p class="hari_ref">hari</p></li>
                    <li><span class="jam">0</span><p class="jam_ref">jam</p></li>
                    <li><span class="menit">0</span><p class="menit_ref">menit</p></li>
                    <li><span class="detik">0</span><p class="detik_ref">detik</p></li>
                `;
                    return;
                }

                const totalSeconds = Math.floor(diff / 1000);
                const hari = Math.floor(totalSeconds / 86400);
                const jam = Math.floor((totalSeconds % 86400) / 3600);
                const menit = Math.floor((totalSeconds % 3600) / 60);
                const detik = totalSeconds % 60;

                countdown.querySelector(".hari").textContent = hari;
                countdown.querySelector(".jam").textContent = jam;
                countdown.querySelector(".menit").textContent = menit;
                countdown.querySelector(".detik").textContent = detik;
            });
        }

        // Jalankan awal, lalu per detik
        updateCountdowns();
        setInterval(updateCountdowns, 1000);
    </script>
@endsection
