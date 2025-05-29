<!-- meta tags and other links -->
@php
    use Carbon\Carbon;
@endphp

@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen px-4 pt-1 pb-[100px] relative overflow-y-auto">
        <!-- Header dengan gradasi -->
        <div class="absolute top-[-200px] right-0 w-[100%]">
            <img src="{{ asset('backround.png') }}" class="w-[100%] rounded-b-[35px]"
                style="--tw-brightness: brightness(95%) !important;
    filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow);"
                alt="">
        </div>

        <!-- Header konten -->
        <div class="flex justify-between relative mt-4 z-10">
            <div class="grid justify-items-start">
                <img src="{{ asset('logo-user-white.png') }}" alt="site logo" style="width: 100px; height: 55px">
            </div>
            <div class="text-end">
                <div class="text-[15px] text-white font-bold" id="clock"></div>
                <div class="text-[13px] text-white" id="hijri-date"></div>
            </div>
        </div>

        <div
            class="max-w-xl mx-auto mt-7 bg-white/40 backdrop-blur-lg shadow-lg rounded-xl overflow-hidden z-10 relative">
            <div class="!bg-[#DC7633] backdrop-blur-lg text-white text-center py-3 text-[15px] font-extrabold">
                Masjid Agung UIN Alauddin Makassar
                <div class="my-2 text-center text-[15px] font-bold">
                    Waktu Sholat Berikutnya: <span id="nextPrayer">--</span>
                </div>
            </div>
            <div class="grid grid-cols-5 gap-2 p-2 text-center">
                <div class="bg-green-100 text-green-900 rounded-lg shadow p-2">
                    <div class="text-xs font-semibold">Subuh</div>
                    <div id="subuh" class="text-sm font-bold">--:--</div>
                </div>
                <div class="bg-yellow-100 text-yellow-900 rounded-lg shadow p-2">
                    <div class="text-xs font-semibold">Dzuhur</div>
                    <div id="dzuhur" class="text-sm font-bold">--:--</div>
                </div>
                <div class="bg-blue-100 text-blue-900 rounded-lg shadow p-2">
                    <div class="text-xs font-semibold">Ashar</div>
                    <div id="ashar" class="text-sm font-bold">--:--</div>
                </div>
                <div class="bg-orange-100 text-orange-900 rounded-lg shadow p-2">
                    <div class="text-xs font-semibold">Maghrib</div>
                    <div id="maghrib" class="text-sm font-bold">--:--</div>
                </div>
                <div class="bg-purple-100 text-purple-900 rounded-lg shadow p-2">
                    <div class="text-xs font-semibold">Isya</div>
                    <div id="isya" class="text-sm font-bold">--:--</div>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto no-scrollbar relative z-10">

            <div class="overflow-hidden bg-white shadow rounded-lg mt-6">
                <div class="px-4 py-5">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Jadwal Juma'at
                        {{ $jadwalJumat ? $jadwalJumat->tanggal : 'Belum Ada Jadwal' }}</h3>
                    @if ($jadwalJumat)
                        <div class="flex items-start gap-2 mt-4">
                            <img src="{{ asset('/public/banner/' . $jadwalJumat->banner) }}" alt="Logo Masjid"
                                class="object-contain rounded" style="height: 110px">
                            <table class="text-sm text-gray-700">
                                <tr>
                                    <td class="text-[13px] font-semibold">Tema Khutbah</td>
                                    <td class="px-1">:</td>
                                    <td class="text-[13px]">{{ $jadwalJumat->tema_khutbah }}</td>
                                </tr>
                                <tr>
                                    <td class="text-[13px] font-semibold">Khatib</td>
                                    <td class="px-1">:</td>
                                    <td class="text-[13px]">{{ $jadwalJumat->nama_khatib }}</td>
                                </tr>
                                <tr>
                                    <td class="text-[13px] font-semibold">Imam</td>
                                    <td class="px-1">:</td>
                                    <td class="text-[13px]">{{ $jadwalJumat->nama_imam }}</td>
                                </tr>
                                <tr>
                                    <td class="text-[13px] font-semibold">Muadzim</td>
                                    <td class="px-1">:</td>
                                    <td class="text-[13px]">{{ $jadwalJumat->nama_muadzin }}</td>
                                </tr>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="overflow-hidden mt-6">
                <div class="flex justify-between items-center">
                    <h3 class="!text-[18px] font-bold leading-6 text-gray-900">Donasi Masjid</h3>
                    <a href="{{ route('donasi-campaign-user') }}"
                        class="text-xs !text-[#DC7633] hover:!text-green-900 font-semibold">Lihat
                        Semua</a>
                </div>
                <div class="grid grid-cols-2 gap-2 mt-2">
                    @forelse ($donasis as $donasi)
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
            </div>

            <div class="overflow-hidden mt-6">
                <div class="flex justify-between items-center">
                    <h3 class="!text-[18px] font-bold leading-6 text-gray-900">Kegiatan Masjid</h3>
                </div>
                {{-- Hapus class grid dan col-span --}}
                <div class="kegiatan-carousel mt-2">
                    @forelse ($kegiatans as $kegiatan)
                        <div class="px-1">
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
                        </div>
                    @empty
                        <p class="text-center text-gray-500">Tidak ada kegiatan tersedia saat ini.</p>
                    @endforelse
                </div>
            </div>

            <div class="overflow-hidden mt-6">
                <div class="flex justify-center items-center">
                    <h3 class="!text-[22px] font-bold leading-6 text-gray-900">Donatur Tetap</h3>
                </div>
                <!-- Tabel Full Width -->
                <div id="card-overflow" class="overflow-x-auto mt-3">
                    <table
                        class="min-w-full table-fixed text-sm text-left text-gray-700 border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="px-4 py-2 border-b w-1/2">Nama</th>
                                <th class="px-4 py-2 border-b w-1/2">Nominal</th>
                                <th class="px-4 py-2 border-b w-1/2">Frekuensi</th>
                                <th class="px-4 py-2 border-b w-1/2">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($donaturTetaps as $donaturTetap)
                                <tr class="bg-white">
                                    <td class="px-4 py-2">{{ $donaturTetap->nama }}</td>
                                    <td class="px-4 py-2">
                                        {{ $donaturTetap->nominal }}
                                    </td>
                                    <td class="px-4 py-2">{{ $donaturTetap->frekuensi }}</td>
                                    <td class="px-4 py-2">Rp
                                        {{ number_format($donaturTetap->total_donasi, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <td class="px-4 py-2 text-gray-500 font-bold text-center" colspan="4">Tidak ada
                                    data
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @include('user.layouts._footer')

            @include('user.layouts._sidebar')
        </div>
    </div>
</div>

@include('user.partial-html._template-bottom')

<!-- Moment dan Moment Hijri -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>

<script>
    // Atur locale Indonesia
    moment.locale('id');

    const hijriMonths = [
        'Muharram', 'Safar', 'Rabiul Awal', 'Rabiul Akhir',
        'Jumadil Awal', 'Jumadil Akhir', 'Rajab', 'Syaban',
        'Ramadhan', 'Syawal', 'Zulkaidah', 'Zulhijjah'
    ];

    function updateClock() {
        const now = moment();

        // Format waktu
        const timeString = now.format("HH:mm:ss");

        // Tanggal Masehi (Indonesia)
        const dateString = now.format("dddd, D MMMM YYYY");

        // Tanggal Hijriah manual pakai array
        const hijriDate = now.clone().locale('en').format("iD-iM-iYYYY").split("-");
        const hijriFormatted = `${hijriDate[0]} ${hijriMonths[parseInt(hijriDate[1]) - 1]} ${hijriDate[2]} H`;

        // Tampilkan
        document.getElementById("clock").innerHTML = timeString;
        document.getElementById("hijri-date").innerHTML = hijriFormatted;
    }

    updateClock();
    setInterval(updateClock, 1000);

    async function loadJadwalSholat() {
        const response = await fetch(
            "https://api.aladhan.com/v1/timingsByCity?city=Makassar&country=Indonesia&method=2");
        const result = await response.json();
        const jadwal = result.data.timings;

        // Set waktu sholat ke HTML
        document.getElementById("subuh").innerText = jadwal.Fajr;
        document.getElementById("dzuhur").innerText = jadwal.Dhuhr;
        document.getElementById("ashar").innerText = jadwal.Asr;
        document.getElementById("maghrib").innerText = jadwal.Maghrib;
        document.getElementById("isya").innerText = jadwal.Isha;

        // Simpan waktu ke dalam objek
        const prayerTimes = {
            Subuh: jadwal.Fajr,
            Dzuhur: jadwal.Dhuhr,
            Ashar: jadwal.Asr,
            Maghrib: jadwal.Maghrib,
            Isya: jadwal.Isha
        };

        function getNextPrayer() {
            const now = new Date();
            const currentMinutes = now.getHours() * 60 + now.getMinutes();

            let nearestName = "Subuh (besok)";
            let nearestTime = 24 * 60 + 1; // waktu besar untuk perbandingan default

            for (const [name, timeStr] of Object.entries(prayerTimes)) {
                const [hour, minute] = timeStr.split(":").map(Number);
                const prayerMinutes = hour * 60 + minute;
                if (prayerMinutes > currentMinutes && prayerMinutes < nearestTime) {
                    nearestTime = prayerMinutes;
                    nearestName = name;
                }
            }

            document.getElementById("nextPrayer").innerText = nearestName;
        }

        // Jalankan dan perbarui tiap menit
        getNextPrayer();
        setInterval(getNextPrayer, 60000);
    }

    loadJadwalSholat();
</script>

<script>
    $(document).ready(function() {
        $('.kegiatan-carousel').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [{
                // breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            }]
        });
    });
</script>


{{-- <script>
    $(document).ready(function() {
        // Event saat file dipilih
        $(document).on('change', '#input-foto', function(e) {
            e.preventDefault();

            var file = this.files[0]; // Ambil file yang dipilih
            var formData = new FormData(); // Buat objek FormData
            formData.append('foto', file);

            var uuid = $(this).closest('label').attr('data-uuid');

            // Tampilkan pesan loading (opsional)
            Swal.fire({
                title: 'Mengunggah...',
                text: 'Mohon tunggu.',
                icon: 'info',
                showConfirmButton: false,
                allowOutsideClick: false,
            });

            const route = "{{ route('user.upload-bukti', ['uuid' => ':uuid']) }}".replace(
                ":uuid",
                uuid
            );

            // Kirim AJAX
            $.ajax({
                url: route,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            text: "Data Sedang Di Proses",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: response.message,
                            text: response.data,
                            icon: "warning",
                            showConfirmButton: false,
                            timer: 1500,
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Gagal',
                        text: xhr.responseJSON.message || 'Terjadi kesalahan.',
                        icon: 'error',
                        showConfirmButton: true,
                    });
                },
            });
        });
    });
</script> --}}

</body>

</html>
