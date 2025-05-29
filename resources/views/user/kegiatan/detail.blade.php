<!-- meta tags and other links -->
@php
    use Carbon\Carbon;

    $sisaHari = Carbon::now()->diffInDays(Carbon::parse($data->tanggal_selesai), false);
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
            <img src="{{ asset('/public/kegiatan/' . $data->banner) }}" alt="Banner Donasi"
                class="w-full !h-[250px] block rounded-lg" loading="lazy">
            <h1 class="text-2xl font-bold mt-4">{{ $data->nama_kegiatan }}</h1>
            <p class="text-gray-600 text-xs mt-3 mb-0 italic">Terpublish:
                {{ Carbon::parse($data->created_at)->format('d-m-Y') }}</p>
            <p class="text-gray-900">{{ $data->deskripsi }}</p>
            <div class="mt-4">
                <h2 class="text-xl font-semibold">Lokasi dan Waktu</h2>
                <table class="text-sm text-gray-700 mt-2">
                    <tr>
                        <td class="text-sm font-semibold flex items-center gap-2"><iconify-icon width="18"
                                height="18" class="text-red-500" icon="codicon:location"></iconify-icon> Lokasi</td>
                        <td class="px-3"></td>
                        <td class="text-sm font-bold">{{ $data->tempat }}</td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold py-1 flex items-center gap-2"><iconify-icon class="text-dark"
                                width="18" height="18"
                                icon="healthicons:i-schedule-school-date-time-outline"></iconify-icon> Tanggal dan Waktu
                        </td>
                        <td class="px-3"></td>
                        <td class="text-sm font-bold">{{ Carbon::parse($data->tanggal)->translatedFormat('l, d F Y') }}
                            {{ Carbon::parse($data->waktu)->format('H:i') }}</td>
                    </tr>
                </table>
            </div>

            @include('user.layouts._footer')
            @include('user.layouts._sidebar')
        </div>
    </div>
</div>

@include('user.partial-html._template-bottom')

</body>

</html>
