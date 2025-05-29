<!-- meta tags and other links -->
@php
    use Carbon\Carbon;
@endphp

@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[100%] bg-[#f5fbf7] h-screen relative overflow-y-auto">
        <!-- Header dengan gradasi -->
        <div class="absolute !h-screen w-[100%]">
            <video autoplay muted loop class="w-full h-full object-cover">
                <source src="{{ asset('backgroun-video.mp4') }}" type="video/mp4">
                Browser Anda tidak mendukung tag video.
            </video>
        </div>

        <!-- Header konten -->
        <div class="p-7 z-10 relative">
            <div class="grid grid-cols-3 gap-6 items-start">
                <!-- Info Masjid -->
                <div class="col-span-2 space-y-6 grid gap-3">
                    <div class="bg-white/30 backdrop-blur-xl shadow-md rounded-2xl flex items-center gap-4 px-6 py-4">
                        <iconify-icon icon="mdi:mosque-outline" class="text-[70px] text-[#DC7633]"></iconify-icon>
                        <div class="text-black text-[36px] font-bold" style="font-family: 'Times New Roman', serif;">
                            Masjid Sultan Agung UINAM
                        </div>
                    </div>

                    <!-- Jadwal Sholat -->
                    <div class="bg-white/20 backdrop-blur-xl shadow-md rounded-2xl p-6">
                        <!-- Waktu Sholat Berikutnya -->
                        <div class="text-center text-lg font-semibold text-black drop-shadow">
                            Waktu Sholat Berikutnya: <span id="nextPrayer" class="text-[#DC7633]">--</span>
                        </div>
                        <div class="grid grid-cols-5 gap-4 mt-4">
                            <!-- Subuh -->
                            <div class="bg-green-50/20 text-green-900 rounded-xl shadow p-3 text-center">
                                <div class="text-sm font-semibold">Subuh</div>
                                <div id="subuh" class="text-lg font-bold">05:03</div>
                            </div>

                            <!-- Dzuhur -->
                            <div class="bg-yellow-50/20 text-yellow-900 rounded-xl shadow p-3 text-center">
                                <div class="text-sm font-semibold">Dzuhur</div>
                                <div id="dzuhur" class="text-lg font-bold">12:00</div>
                            </div>

                            <!-- Ashar -->
                            <div class="bg-blue-50/20 text-blue-900 rounded-xl shadow p-3 text-center">
                                <div class="text-sm font-semibold">Ashar</div>
                                <div id="ashar" class="text-lg font-bold">15:23</div>
                            </div>

                            <!-- Maghrib -->
                            <div class="bg-orange-50/20 text-orange-900 rounded-xl shadow p-3 text-center">
                                <div class="text-sm font-semibold">Maghrib</div>
                                <div id="maghrib" class="text-lg font-bold">17:55</div>
                            </div>

                            <!-- Isya -->
                            <div class="bg-purple-50/20 text-purple-900 rounded-xl shadow p-3 text-center">
                                <div class="text-sm font-semibold">Isya</div>
                                <div id="isya" class="text-lg font-bold">18:56</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-black/40 backdrop-blur-xl shadow-md rounded-2xl p-6 !border-s-4 !border-[#DC7633]">
                        <p class="text-white italic !text-lg font-bold">“Tidak perlu menunggu mampu untuk beramal besar.
                            Lakukan
                            sekecil apa
                            pun
                            kebaikan, karena
                            bisa jadi amal kecil itulah yang mengantarkanmu ke surga. Allah mencintai amal yang sedikit
                            tapi dilakukan terus-menerus.”</p>
                        <p class="!text-sm text-white">🕌 HR. Bukhari no. 6465 dan Muslim no. 782</p>
                    </div>
                    <div class="bg-[#DC7633]/60 backdrop-blur-xl shadow-md rounded-2xl p-6 pb-4">
                        <marquee behavior="scroll" direction="left" scrollamount="5"
                            class="text-white italic font-semibold">
                            Yang membawakan khutbah jum'at tanggal {{ $jadwalJumat->tanggal }} oleh
                            {{ $jadwalJumat->nama_khatib }} dengan tema {{ $jadwalJumat->tema_khutbah }}. 🕌 Harap
                            Matikan HP Saat Sholat
                        </marquee>
                    </div>

                </div>

                <!-- Info Kegiatan -->
                <div class="col-span-1">
                    <div class="grid gap-6">
                        {{-- Jam dan Tanggal Hijriah --}}
                        <div class="bg-black/20 backdrop-blur-xl shadow-md rounded-2xl p-4 text-white text-center">
                            <div class="grid place-items-center">
                                <div class="text-[65px] font-bold" id="clock"></div>
                                <div class="text-[25px]" id="hijri-date"></div>
                            </div>
                        </div>

                        <div class="bg-white/20 backdrop-blur-xl shadow-md rounded-2xl p-4 text-white text-center">
                            <div class="grid place-items-center">
                                <div class="text-black text-[36px] font-bold"
                                    style="font-family: 'Times New Roman', serif;">Kas Masjid Saat Ini</div>
                                <div class="text-[25px] font-bold">
                                    Rp {{ number_format($kas, 0, ',', '.') }}</div>
                            </div>
                        </div>

                        <div class="overflow-hidden">
                            <div class="kegiatan-carousel">
                                @forelse ($kegiatans as $kegiatan)
                                    <div
                                        class="!flex items-center gap-4 bg-[#DC7633]/80 backdrop-blur-lg shadow-lg rounded-lg overflow-hidden p-2 w-full">
                                        <img src="{{ asset('/public/kegiatan/' . $kegiatan->banner) }}"
                                            alt="Banner Kegiatan" class="!w-[150] !h-[150px] object-cover rounded-xl"
                                            loading="lazy">

                                        <div class="flex-1 text-left">
                                            <h3 class="text-lg font-bold text-white mb-2">
                                                {{ $kegiatan->nama_kegiatan }}
                                            </h3>

                                            <div class="flex gap-1 items-center text-md text-white mb-1">
                                                <iconify-icon class="text-green-600 mr-1"
                                                    icon="mdi:calendar-clock"></iconify-icon>
                                                {{ Carbon::parse($kegiatan->tanggal)->translatedFormat('l, d F Y') }}
                                                {{ Carbon::parse($kegiatan->waktu)->format('H:i') }}
                                            </div>

                                            <div class="flex gap-1 items-center text-md text-white">
                                                <iconify-icon class="text-red-500 mr-1"
                                                    icon="mdi:map-marker"></iconify-icon>
                                                {{ $kegiatan->tempat }}
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-center text-gray-500 text-xl font-semibold py-10">
                                        Tidak ada kegiatan tersedia saat ini.
                                    </p>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>
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
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 8000, // 8 detik
            infinite: true,
            arrows: false,
            dots: false,
            pauseOnHover: false,
            fade: true, // Efek fade agar elegan
            cssEase: 'linear'
        });
    });
</script>

</body>

</html>
