<!-- meta tags and other links -->
@section('title', $module)

@include('user.partial-html._template-top')

<div class="flex justify-center">
    <!-- Kontainer utama -->
    <div id="card-overflow" class="w-[460px] bg-[#f5fbf7] h-screen pb-[100px] relative overflow-y-auto">

        <div class="flex bg-[#DC7633] p-6 items-center">
            <div class="text-[20px] font-bold absolute text-white w-full text-center left-0 z-[0] capitalize">
                {{ $module }}
            </div>
        </div>


        <!-- Konten Detail Donasi -->
        <div class="p-4">
            <div class="">
                <div class="grid gap-2">
                    <h2 class="text-lg font-semibold">Lakukan Pembayaran</h2>
                    <h2 class="text-sm font-bold">Jumlah Donasi Yang Perlu DI Bayarkan {{ $donaturTetap->nominal }}</h2>
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
                    <p class="text-sm text-gray-600">Setelah melakukan pembayaran, Isi form
                        di bawah ini untuk mengirimkan informasi donasi Anda.</p>
                </div>

                <form id="form-submit" class="space-y-4 grid grid-cols-2 gap-1">
                    <input type="hidden" name="uuid_donatur" value="{{ $donaturTetap->uuid }}">
                    <div class="col-span-2">
                        <label for="nama-pendonasi"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Pendonasi</label>
                        <input type="text" id="nama-pendonasi" name="nama_pendonasi" readonly
                            value="{{ $donaturTetap->nama }}"
                            class="bg-gray-50 border border-gray-300 text-gray-500 cursor-not-allowed text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            placeholder="Masukkan nama pendonasi">
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
                        <button type="button" id="submit-form"
                            class="flex items-center justify-center gap-2 w-full btn hover:!bg-green-500 text-white bg-[#DC7633]">
                            <iconify-icon icon="mdi:donation" class="menu-icon"></iconify-icon>
                            <span class="text-md font-semibold">Donasi Sekarang</span>
                        </button>
                    </div>
                </form>

            </div>

            <div class="mt-5 flex justify-center">
                <img src="{{ asset('logo-user.png') }}" alt="site logo" class="opacity-[0.5]"
                    style="width: 200px; height: 135px">
            </div>
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
                url: "{{ route('donatur-tetap-donasi') }}",
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
