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
                @forelse ($data as $kegiatan)
                    <a href="{{ route('detail-kegiatan', ['params' => $kegiatan->uuid]) }}"
                        class="bg-white shadow rounded-lg hover:!shadow-lg hover:!text-green-900 transition-shadow duration-200 block">
                        <img src="{{ asset('/public/kegiatan/' . $kegiatan->banner) }}" alt="Banner Kegiatan"
                            class="w-full !h-[150px] block rounded-t-lg" loading="lazy">
                        <div class="p-2">
                            <div class="text-sm font-semibold truncate">{{ $kegiatan->nama_kegiatan }}</div>
                            <div class="text-xs text-gray-500 mt-2">
                                {{ Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}
                                {{ Carbon::parse($kegiatan->waktu)->format('H:i') }}
                            </div>
                            <div class="text-xs text-gray-500 flex items-center gap-1 mb-1">
                                <iconify-icon class="text-red-500" icon="codicon:location"></iconify-icon>
                                {{ $kegiatan->tempat }}
                            </div>
                            <p class="text-xs">
                                {{ Str::words(strip_tags($kegiatan->deskripsi), 20, '...') }}
                            </p>
                        </div>
                    </a>
                @empty
                    <p class="text-center text-gray-500">Tidak ada kegiatan tersedia saat ini.</p>
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
