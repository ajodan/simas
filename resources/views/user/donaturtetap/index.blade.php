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
                        <h1 itemprop="headline">Donasi Donatur Tetap</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title=""
                                    itemprop="url">Home</a></li>
                            <li class="breadcrumb-item active">Donasi</li>
                        </ol>
                    </div>
                </div><!-- Page Top Wrap -->
            </div>
        </div>
    </section>

    <section>
        <div class="gap">
            <div class="container">
                <div class="blog-detail-wrp">
                    <div class="mt-4">
                        <h2 class="h5 font-weight-semibold mb-3">Lakukan Pembayaran</h2>

                        <div class="bg-white rounded shadow-sm p-4 text-center"
                            style="display: grid; justify-items: center">
                            <img id="qr-card" src="{{ asset('qris.png') }}" class="mb-3" style="width: 200px;"
                                alt="QR Code">

                            <button onclick="downloadImage()"
                                class="btn btn-sm btn-primary d-inline-flex align-items-center">
                                <i class="material-icons mr-1">download</i> Download Qris
                            </button>
                        </div>

                        <p class="small text-muted mt-3">
                            Silakan scan QR Code di atas untuk melakukan pembayaran donasi.
                            Pastikan untuk mengisi nama pendonasi dan jumlah donasi dengan benar. Atau
                            transfer melalui rekening
                            <span class="font-weight-bold font-italic text-dark">BCA NOREK 123456789 A.N
                                Wahyu</span>
                        </p>
                        <p class="small text-muted">
                            Setelah melakukan pembayaran, klik tombol "Donasi Sekarang" di bawah ini
                            untuk
                            mengirimkan informasi donasi Anda.
                        </p>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="authentication-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <!-- Modal Header (Optional) -->
                                <div class="modal-header">
                                    <h5 class="modal-title">Form Donasi</h5>
                                    <button type="button" id="close-modal" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <form id="form-submit">
                                        <input type="hidden" name="uuid_donatur" value="{{ $donaturTetap->uuid }}">

                                        <div class="form-group">
                                            <label for="nama-pendonasi">Nama Pendonasi</label>
                                            <input type="text" id="nama-pendonasi" name="nama_pendonasi" readonly
                                                value="{{ $donaturTetap->nama }}" class="form-control"
                                                placeholder="Masukkan nama pendonasi">
                                            <div class="text-danger nama_pendonasi_error small mt-1">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="jumlah-donasi">Jumlah Donasi</label>
                                            <input type="text" id="jumlah-donasi" name="nominal_donasi"
                                                class="form-control" placeholder="Masukkan jumlah donasi">
                                            <div class="text-danger nominal_donasi_error small mt-1">
                                            </div>
                                        </div>

                                        <div
                                            class="form-group text-center position-relative border border-success rounded p-4 overflow-hidden">
                                            <!-- Preview background -->
                                            <div id="image-preview" class="position-absolute w-100 h-100"
                                                style="top: 0; left: 0; opacity: 0.2; background-color: #f8f9fa; border-radius: .25rem; background-size: cover; background-position: center; z-index: 1;">
                                            </div>

                                            <!-- Upload section -->
                                            <div class="position-relative" style="z-index: 2;">
                                                <i class="material-icons text-success mb-2"
                                                    style="font-size: 40px;">cloud_upload</i>
                                                <div class="text-success small">Upload Bukti Transaksi
                                                </div>

                                                <label class="btn btn-outline-success mt-3">
                                                    <input id="image-upload" type="file" name="bukti_transfer"
                                                        class="d-none" accept=".png, .jpg, .jpeg">
                                                    <i class="material-icons mr-1">file_upload</i>
                                                    BROWSE
                                                    FILE
                                                </label>
                                            </div>
                                        </div>


                                        <div class="text-danger bukti_transfer_error small mb-3"></div>

                                        <div class="d-flex justify-content-between">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Batalkan</button>
                                            <button type="button" id="submit-form"
                                                class="btn btn-success d-flex align-items-center">
                                                <i class="material-icons mr-1" style="font-size: 20px;">save</i> Kirim
                                            </button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button data-toggle="modal" data-target="#authentication-modal" type="button"
                            class="btn btn-block text-white" style="background-color: #DC7633;">
                            <i class="mdi mdi-donation mr-2"></i>
                            <span class="font-weight-semibold">Donasi Sekarang</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
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
                                $("#close-modal").trigger("click");
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

        function readURL(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Hanya lanjutkan jika file gambar
                if (!file.type.startsWith("image/")) {
                    alert("Harap unggah file gambar (.jpg, .jpeg, .png)");
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const $formGroup = $(input).closest(".form-group");
                    const $preview = $formGroup.find("#image-preview");

                    if ($preview.length) {
                        $preview.css({
                            "background-image": `url(${e.target.result})`,
                            "background-size": "cover",
                            "background-position": "center",
                            "opacity": "0.6",
                            "transition": "background-image 0.3s ease-in-out"
                        });
                    }
                };
                reader.readAsDataURL(file);
            } else {
                console.warn("No file selected or FileReader not supported.");
            }
        }

        // Event listener
        $(document).on("change", "#image-upload", function() {
            readURL(this);
        });
    </script>
@endsection
