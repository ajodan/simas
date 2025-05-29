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
            <img src="{{ asset('/public/campaign/' . $data->gambar) }}" alt="Banner Donasi"
                class="w-full !h-[250px] block rounded-lg" loading="lazy">
            <h1 class="text-2xl font-bold mt-4">{{ $data->judul }}</h1>
            <p class="text-gray-600 text-xs mt-3 mb-0 italic">Terpublish:
                {{ Carbon::parse($data->created_at)->format('d-m-Y') }}</p>
            <p class="text-gray-900">{{ $data->deskripsi }}</p>
            <div class="mt-4">
                <h2 class="text-xl font-semibold">Detail Donasi</h2>
                <table class="text-sm text-gray-700 mt-2">
                    <tr>
                        <td class="text-sm font-semibold">Target</td>
                        <td class="px-3">:</td>
                        <td class="text-sm font-bold">Rp {{ number_format($data->target_dana, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold py-1">Terkumpul</td>
                        <td class="px-3">:</td>
                        <td class="text-sm font-bold">Rp {{ number_format($totalDonasi, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td class="text-sm font-semibold">Sisa Waktu</td>
                        <td class="px-3">:</td>
                        <td class="text-sm font-bold">{{ $sisaHari > 0 ? "Tinggal $sisaHari hari lagi" : 'Berakhir' }}
                        </td>
                    </tr>
                </table>

                @if ($sisaHari > 0)
                    <div class="mt-4 grid gap-2">
                        <h2 class="text-lg font-semibold">Lakukan Pembayaran</h2>
                        <div class="grid justify-items-center bg-white rounded-lg shadow-md p-4 pt-2">
                            <img id="qr-card" src="{{ asset('qris.png') }}" class="!w-[200px]" alt="">
                            <button onclick="downloadImage()"
                                class="flex items-center gap-2 btn hover:!bg-sky-500 text-white bg-sky-700 py-2 px-3 text-sm max-w-max">
                                <iconify-icon icon="material-symbols:download" class="text-white" width="20"
                                    height="20"></iconify-icon> <span>Download
                                    Qris</span>
                            </button>
                        </div>
                        <p class="text-sm text-gray-600">Silakan scan QR Code di atas untuk melakukan pembayaran
                            donasi.
                            Pastikan untuk mengisi nama pendonasi dan jumlah donasi dengan benar. atau transfer melalui
                            rekenin <span class="font-bold italic text-dark">BCA NOREK 123456789 A.N Wahyu</span></p>
                        <p class="text-sm text-gray-600">Setelah melakukan pembayaran, klik tombol "Donasi Sekarang"
                            di bawah ini untuk mengirimkan informasi donasi Anda.</p>
                    </div>
                    <div class="flex mt-4">
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                            type="button"
                            class="flex items-center justify-center gap-2 w-full btn hover:!bg-green-500 text-white bg-[#DC7633]">
                            <iconify-icon icon="mdi:donation" class="menu-icon"></iconify-icon>
                            <span class="text-md font-semibold">Donasi Sekarang</span>
                        </button>
                    </div>
                @endif

                <!-- Main modal -->
                <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal body -->
                            <div class="p-4 md:p-5">
                                <form id="form-submit" class="space-y-4 grid grid-cols-2 gap-1">
                                    <input type="hidden" name="uuid_campaign" value="{{ $data->uuid }}">
                                    <div class="col-span-2">
                                        <label for="nama-pendonasi"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                            Pendonasi (defaul anonim)</label>
                                        <input type="text" id="nama-pendonasi" name="nama_pendonasi"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Masukkan nama pendonasi">
                                        <div class="text-danger-600 text-sm nama_pendonasi_error"></div>
                                    </div>
                                    <div class="col-span-2">
                                        <label for="jumlah-donasi"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                                            Donasi</label>
                                        <input type="text" id="jumlah-donasi" name="nominal_donasi"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                            placeholder="Masukkan jumlah donasi">
                                        <div class="text-danger-600 text-sm nominal_donasi_error"></div>
                                    </div>
                                    <div
                                        class="col-span-2 !border-2 !border-dashed !border-[#096B5A] rounded-lg p-6 text-center grid justify-center relative">
                                        <div id="image-preview"
                                            class="absolute w-full h-full -z-0 rounded-lg p-6 bg-no-repeat bg-cover bg-center opacity-80">
                                        </div>
                                        <iconify-icon icon="line-md:cloud-alt-upload-twotone-loop"
                                            class="menu-icon text-5xl text-[#096B5A] mx-auto z-[1]"></iconify-icon>
                                        <div class="text-[#096B5A] text-sm font-normal z-[1]">Upload Bukti Transaksi
                                        </div>
                                        <label
                                            class="flex items-center w-max mt-4 px-4 py-2 bg-teal-100 text-teal-700 border rounded-md cursor-pointer hover:bg-teal-200 z-[1]">
                                            <input id="image-upload" type="file" name="bukti_transfer" class="hidden"
                                                accept=".png, .jpg, .jpeg">
                                            <iconify-icon icon="line-md:upload-loop" class="mr-2"></iconify-icon>
                                            <span>BROWSE FILE</span>
                                        </label>
                                    </div>
                                    <div class="text-danger-600 !mt-0 col-span-2 text-sm bukti_transfer_error"></div>
                                    <div class="col-span-2 flex justify-between">
                                        <button data-modal-hide="authentication-modal" type="button"
                                            class="text-[#096B5A] bg-red-200 btn font-medium text-sm px-3 py-2.5 text-center uppercase">
                                            batalkan
                                        </button>
                                        <button type="button" id="submit-form"
                                            class="flex items-center gap-2 text-white bg-[#096B5A] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center uppercase">
                                            <iconify-icon icon="material-symbols:save" class="menu-icon"
                                                style="font-size: 20px;"></iconify-icon>
                                            <span>Kirim</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if ($dataPendonasis)
                <h2 class="text-xl font-semibold mt-6">Daftar Pendonasi</h2>
                @foreach ($dataPendonasis as $dataPendonasi)
                    <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700 mt-2">
                        <li class="pb-3 sm:pb-4">
                            <div class="flex gap-2 items-center space-x-4 rtl:space-x-reverse">
                                <div class="shrink-0">
                                    <img class="w-10 h-10 rounded-full"
                                        src="{{ asset('assets-user/images/user.png') }}" alt="Neil image">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm m-0 font-medium text-gray-900">
                                        {{ $dataPendonasi->nama_pendonasi }}</p>
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ Carbon::parse($dataPendonasi->created_at)->format('d-m-Y H:i') }}</p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    Rp {{ number_format($dataPendonasi->nominal_donasi, 0, ',', '.') }}
                                </div>
                            </div>
                        </li>
                    </ul>
                @endforeach
            @endif

            @include('user.layouts._footer')
            @include('user.layouts._sidebar')
        </div>
    </div>
</div>

@include('user.partial-html._template-bottom')

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function downloadImage() {
        const element = document.getElementById('qr-card'); // Elemen yang ingin di-download
        html2canvas(element).then(canvas => {
            const link = document.createElement('a');
            link.download = 'qr-code.png'; // Nama file
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
    }
    $(document).ready(function() {
        $("#jumlah-donasi").on("input", function() {
            let input = $(this).val();

            // Hapus semua karakter non-angka
            input = input.replace(/[^,\d]/g, "");

            // Format angka dengan pemisah ribuan
            if (input) {
                const numberFormat = new Intl.NumberFormat("id-ID");
                const formatted = numberFormat.format(parseInt(input.replace(/\./g, ""),
                    10));
                $(this).val('Rp ' + formatted);
            }
        });

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        // Submit Form
        $("#submit-form").click(function(e) {
            e.preventDefault(); // Mencegah reload halaman

            let formData = new FormData($("#form-submit")[
                0]); // Gunakan FormData untuk menyertakan file upload

            $.ajax({
                type: "POST",
                url: "{{ route('donasi-campaign') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $(".text-danger-600").html(""); // Hapus pesan error sebelumnya
                    if (response.success) {
                        Swal.fire({
                            title: "Berhasil",
                            text: response.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500,
                        }).then(() => {
                            location.reload(); // Reload halaman setelah alert
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
                    $(".text-danger-600").html(""); // Hapus pesan error sebelumnya
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        $(`.${key}_error`).html(
                            value); // Tampilkan pesan error dari backend
                    });
                },
            });
        });
    });

    // Fungsi untuk menangani pratinjau gambar
    function readURL(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];

            // Membaca file dan menampilkan pratinjau
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = $(input).closest("div").find("#image-preview")[0]; // Elemen pratinjau terkait

                if (preview) {
                    preview.style.backgroundImage = `url(${e.target.result})`;
                    preview.style.backgroundSize = "cover"; // Menyesuaikan ukuran pratinjau
                    preview.style.backgroundPosition = "center"; // Menyesuaikan posisi
                }
            };
            reader.readAsDataURL(file); // Membaca file sebagai data URL
        } else {
            console.warn("No file selected or browser does not support FileReader.");
        }
    }

    // Event listener dinamis untuk elemen input
    $(document).on("change", "#image-upload", function() {
        readURL(this);
    });
</script>

</body>

</html>
