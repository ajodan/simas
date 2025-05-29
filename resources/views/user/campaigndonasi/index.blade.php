<!-- meta tags and other links -->
@php
    use Carbon\Carbon;
@endphp

@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen pb-[100px] relative overflow-y-auto">

        @section('title-active')
            {{ $module }}</span>
        @endsection

        @include('user.layouts._nav')

        <!-- Konten Detail Donasi -->
        <div class="p-4">

            <div class="grid grid-cols-2 gap-2 mt-2">
                @forelse ($data as $donasi)
                    <a href="{{ route('detail-donasi-campaign', ['params' => $donasi->uuid]) }}" id="donasi-card"
                        class="bg-white shadow rounded-lg hover:!shadow-lg hover:!text-green-900 transition-shadow duration-200">
                        <img src="{{ asset('/public/campaign/' . $donasi->gambar) }}" alt="Banner Donasi"
                            class="w-full !h-[150px] block rounded-t-lg" loading="lazy">
                        <div class="p-2">
                            <h4 class="text-sm font-semibold">{{ $donasi->judul }}</h4>
                            <div class="mt-2 text-gray-800 text-xs sm:text-sm">
                                <div class="grid grid-cols-2 gap-2 border-b !py-[5px]">
                                    <div class="font-medium">🎯 Target Dana</div>
                                    <div class="text-right font-bold text-green-700">
                                        Rp {{ number_format($donasi->target_dana, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2 border-b !py-[5px]">
                                    <div class="font-medium">💰 Terkumpul</div>
                                    <div class="text-right font-bold text-blue-700">
                                        Rp {{ number_format($donasi->total_donasi, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-2 border-b !py-[5px]">
                                    <div class="font-medium">⏳ Sisa Waktu</div>
                                    @php
                                        $sisaHari = \Carbon\Carbon::now()->diffInDays(
                                            \Carbon\Carbon::parse($donasi->tanggal_selesai),
                                            false,
                                        );
                                    @endphp
                                    <div
                                        class="text-right font-bold {{ $sisaHari > 0 ? 'text-yellow-600' : 'text-red-600' }}">
                                        {{ $sisaHari > 0 ? "Tinggal $sisaHari hari lagi" : 'Berakhir' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    {{-- Tampilkan pesan jika kosong --}}
                    <p class="text-center text-gray-500 col-span-2">Tidak ada donasi tersedia saat ini.</p>
                @endforelse

            </div>

            @include('user.layouts._footer')
            @include('user.layouts._sidebar')
        </div>
    </div>
</div>

@include('user.partial-html._template-bottom')

</body>

</html>
