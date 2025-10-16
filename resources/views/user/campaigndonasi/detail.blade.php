@extends('user.layouts.layout')
@php
    use Carbon\Carbon;

    $sisaHari = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($data->tanggal_selesai), false);
@endphp
@section('content')
    <section>
        <div class="gap black-layer opc7">
            <div class="fixed-bg2" style="background-image: url({{ asset('assets-landing/images/pg-tp-bg.jpg') }});"></div>
            <div class="container">
                <div class="pg-tp-wrp text-center">
                    <div class="pg-tp-inr">
                        <h1 itemprop="headline">{{ $module }}</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title=""
                                    itemprop="url">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('donasi-campaign') }}" title=""
                                    itemprop="url">Donasi</a></li>
                            <li class="breadcrumb-item active">Detail Donasi</li>
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
                    <div class="row">
                        <div class="col-md-9 col-sm-12 col-lg-9">
                            <div class="blog-detail">
                                <div class="blog-detail-inf brd-rd5">
                                    <img src="{{ asset('/storage/public/campaign/' . $data->gambar) }}" alt="blog-detail-img.jpg"
                                        itemprop="image">
                                    <div class="blog-detail-inf-inr">
                                        <ul class="d-flex pst-mta" style="gap: 15px"><br>
                                            <li>🎯 Target Dana Rp.  {{ number_format($data->target_dana, 0, ',', '.') }}</li><br>
                                            <li>💰 Terkumpul Rp {{ number_format($totalDonasi, 0, ',', '.') }}</li><br>
                                            <li>⏳ Sisa Waktu
                                                {{ $sisaHari > 0 ? "Tinggal $sisaHari hari lagi" : 'Berakhir' }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="blog-detail-desc">
                                    <p itemprop="description">{!! $data->deskripsi !!}</p>
                                    @if ($sisaHari > 0)
                                        <div class="mt-4">
                                            <h2 class="h5 font-weight-semibold mb-3">Lakukan Pembayaran</h2>

                                            {{-- <div class="bg-white rounded shadow-sm p-4 text-center"
                                                style="display: grid; justify-items: center">
                                                <img id="qr-card" src="{{ asset('qris.png') }}" class="mb-3"
                                                    style="width: 200px;" alt="QR Code">

                                                <button onclick="downloadImage()"
                                                    class="btn btn-sm btn-primary d-inline-flex align-items-center">
                                                    <i class="material-icons mr-1">download</i> Qris
                                                </button>
                                            </div> --}}

                                            <p class="small text-muted mt-3">
                                                Silakan Transfer melalui rekening MUAMALAT NOREK 369 001 3830 an Masjid Al-Furqaan untuk melakukan pembayaran donasi.
                                                Pastikan untuk mengisi nama pendonasi dan jumlah donasi dengan benar. 
                                                <span class="font-weight-bold font-italic text-dark">BANK MUAMALAT NOREK 369 001 3830 an
                                                    Masjid Al-Furqaan</span>
                                            </p>
                                            <p class="small text-muted">
                                                Setelah melakukan pembayaran, klik tombol "Donasi Sekarang" di bawah ini
                                                untuk engirimkan informasi donasi Anda.
                                            </p>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="authentication-modal" tabindex="-1" role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <!-- Modal Header (Optional) -->
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Form Donasi</h5>
                                                        <button type="button" id="close-modal" class="close"
                                                            data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <!-- Modal Body -->
                                                    <div class="modal-body">
                                                        <form id="form-submit-donasi-campaign">
                                                            <input type="hidden" name="uuid_campaign"
                                                                value="{{ $data->uuid }}">

                                                            <div class="form-group">
                                                                <label for="nama-pendonasi">Nama Pendonasi (default
                                                                    anonim)</label>
                                                                <input type="text" id="nama-pendonasi"
                                                                    name="nama_pendonasi" class="form-control"
                                                                    placeholder="Masukkan nama pendonasi">
                                                                <div class="text-danger nama_pendonasi_error small mt-1">
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="jumlah-donasi">Jumlah Donasi</label>
                                                                <input type="text" id="jumlah-donasi"
                                                                    name="nominal_donasi" class="form-control"
                                                                    placeholder="Masukkan jumlah donasi">
                                                                <div class="text-danger nominal_donasi_error small mt-1">
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="form-group text-center position-relative border border-success rounded p-4 overflow-hidden">
                                                                <!-- Preview background -->
                                                                <div id="image-preview"
                                                                    class="position-absolute w-100 h-100"
                                                                    style="top: 0; left: 0; opacity: 0.2; background-color: #f8f9fa; border-radius: .25rem; background-size: cover; background-position: center; z-index: 1;">
                                                                </div>

                                                                <!-- Upload section -->
                                                                <div class="position-relative" style="z-index: 2;">
                                                                    <i class="material-icons text-success mb-2"
                                                                        style="font-size: 40px;">cloud_upload</i>
                                                                    <div class="text-success small">Upload Bukti Transaksi
                                                                    </div>

                                                                    <label class="btn btn-outline-success mt-3">
                                                                        <input id="image-upload" type="file"
                                                                            name="bukti_transfer" class="d-none"
                                                                            accept=".png, .jpg, .jpeg">
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
                                                                <button type="button" id="submit-form-donasi-campaign"
                                                                    class="btn btn-success d-flex align-items-center">
                                                                    <i class="material-icons mr-1"
                                                                        style="font-size: 20px;">save</i> Kirim
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button data-toggle="modal" data-target="#authentication-modal"
                                                type="button" class="btn btn-block text-white"
                                                style="background-color: #DC7633;">
                                                <i class="mdi mdi-donation mr-2"></i>
                                                <span class="font-weight-semibold">Donasi Sekarang</span>
                                            </button>
                                        </div>
                                    @endif

                                    <div class="pst-shr-tgs">
                                        <div class="scl1 float-left">
                                            <span>Bagikan ke:</span>
                                            <a href="#" title="Twitter" itemprop="url" target="_blank"><i
                                                    class="fab fa-twitter"></i></a>
                                            <a href="#" title="Facebook" itemprop="url" target="_blank"><i
                                                    class="fab fa-facebook-f"></i></a>
                                            <a href="#" title="Linkedin" itemprop="url" target="_blank"><i
                                                    class="fab fa-linkedin-in"></i></a>
                                            <a href="#" title="Google Plus" itemprop="url" target="_blank"><i
                                                    class="fab fa-google-plus-g"></i></a>
                                            <a href="#" title="Youtube" itemprop="url" target="_blank"><i
                                                    class="fab fa-youtube"></i></a>
                                        </div>
                                        {{-- <div class="tag-clouds float-right">
                                            <span>Tags:</span>
                                            <a href="#" title="" itemprop="url">Namaz</a>, <a href="#"
                                                title="" itemprop="url">Roza</a>, <a href="#" title=""
                                                itemprop="url">Hajj</a>, <a href="#" title=""
                                                itemprop="url">Zakat</a>
                                        </div> --}}
                                    </div>
                                    @if ($dataPendonasis)
                                        <div class="cmts-wrp">
                                            <h4 itemprop="headline">Daftar Pendonasi</h4>
                                            <ul class="cmt-thrd">
                                                @foreach ($dataPendonasis as $dataPendonasi)
                                                    <li>
                                                        <div class="cmt-bx">
                                                            <img class="brd-rd50"
                                                                src="{{ asset('assets-user/images/user.png') }}"
                                                                alt="cmt-img1.jpg" itemprop="image" style="width: 83px">
                                                            <div class="cmt-inf">
                                                                <h6 itemprop="headline">
                                                                    {{ $dataPendonasi->nama_pendonasi }}
                                                                </h6>
                                                                <span><i
                                                                        class="theme-clr far fa-calendar-alt"></i>{{ Carbon::parse($dataPendonasi->created_at)->format('d-m-Y H:i') }}</span>
                                                                <p itemprop="description">Telah mendonasikan sebanyak
                                                                    <strong>Rp
                                                                        {{ number_format($dataPendonasi->nominal_donasi, 0, ',', '.') }}</strong>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul><!-- Comment Thread -->
                                        </div><!-- Comments Wrap -->
                                    @endif
                                    {{-- <div class="cnt-frm cmt-frm">
                                        <h4 itemprop="headline">Leave Your Comments</h4>
                                        <p itemprop="description">Spam are not sunt in culpa qui officia.vero eos et
                                            accusamus.</p>
                                        <form>
                                            <div class="row mrg10">
                                                <div class="col-md-4 col-sm-6 col-lg-4">
                                                    <input class="brd-rd5" type="text" placeholder="Name">
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-lg-4">
                                                    <input class="brd-rd5" type="email" placeholder="Email">
                                                </div>
                                                <div class="col-md-4 col-sm-12 col-lg-4">
                                                    <input class="brd-rd5" type="text" placeholder="Subject">
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-lg-12">
                                                    <textarea class="brd-rd5" placeholder="Message"></textarea>
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-lg-12">
                                                    <button type="submit" class="theme-btn theme-bg brd-rd5">POST
                                                        COMMENT</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-lg-3">
                            <div class="sidebar-wrp">
                                <div class="widget">
                                    <h5 itemprop="headline">Search</h5>
                                    <form class="srch-frm brd-rd5">
                                        <input type="text" placeholder="Search">
                                        <button type="submit" class="theme-clr"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                                {{-- <div class="widget">
                                    <h5 itemprop="headline">Categories</h5>
                                    <ul class="cat-lst">
                                        <li><a href="#" title="" itemprop="url">House Accommodation</a>(10)
                                        </li>
                                        <li><a href="#" title="" itemprop="url">Health Events</a>(06)</li>
                                        <li><a href="#" title="" itemprop="url">Donation Event</a>(03)</li>
                                        <li><a href="#" title="" itemprop="url">Education</a>(07)</li>
                                        <li><a href="#" title="" itemprop="url">Food</a>(12)</li>
                                        <li><a href="#" title="" itemprop="url">Health Care</a>(02)</li>
                                    </ul>
                                </div> --}}
                                {{-- <div class="widget">
                                    <h5 itemprop="headline">Latest Causes</h5>
                                    <div class="ltst-car lst-caus text-center owl-carousel owl-loaded owl-drag">


                                        <div class="owl-stage-outer">
                                            <div class="owl-stage"
                                                style="transform: translate3d(-810px, 0px, 0px); transition: all 0s ease 0s; width: 1620px;">
                                                <div class="owl-item cloned" style="width: 270px;">
                                                    <div class="lst-cas">
                                                        <img class="brd-rd5" src="assets/images/resources/lst-cas-img1.jpg"
                                                            alt="lst-cas-img1.jpg" itemprop="image">
                                                        <h6 itemprop="headline"><a href="#" title=""
                                                                itemprop="url">Water For All Cause</a></h6>
                                                    </div>
                                                </div>
                                                <div class="owl-item cloned" style="width: 270px;">
                                                    <div class="lst-cas">
                                                        <img class="brd-rd5"
                                                            src="assets/images/resources/lst-cas-img2.jpg"
                                                            alt="lst-cas-img2.jpg" itemprop="image">
                                                        <h6 itemprop="headline"><a href="#" title=""
                                                                itemprop="url">Help For Education</a></h6>
                                                    </div>
                                                </div>
                                                <div class="owl-item" style="width: 270px;">
                                                    <div class="lst-cas">
                                                        <img class="brd-rd5"
                                                            src="assets/images/resources/lst-cas-img1.jpg"
                                                            alt="lst-cas-img1.jpg" itemprop="image">
                                                        <h6 itemprop="headline"><a href="#" title=""
                                                                itemprop="url">Water For All Cause</a></h6>
                                                    </div>
                                                </div>
                                                <div class="owl-item active" style="width: 270px;">
                                                    <div class="lst-cas">
                                                        <img class="brd-rd5"
                                                            src="assets/images/resources/lst-cas-img2.jpg"
                                                            alt="lst-cas-img2.jpg" itemprop="image">
                                                        <h6 itemprop="headline"><a href="#" title=""
                                                                itemprop="url">Help For Education</a></h6>
                                                    </div>
                                                </div>
                                                <div class="owl-item cloned" style="width: 270px;">
                                                    <div class="lst-cas">
                                                        <img class="brd-rd5"
                                                            src="assets/images/resources/lst-cas-img1.jpg"
                                                            alt="lst-cas-img1.jpg" itemprop="image">
                                                        <h6 itemprop="headline"><a href="#" title=""
                                                                itemprop="url">Water For All Cause</a></h6>
                                                    </div>
                                                </div>
                                                <div class="owl-item cloned" style="width: 270px;">
                                                    <div class="lst-cas">
                                                        <img class="brd-rd5"
                                                            src="assets/images/resources/lst-cas-img2.jpg"
                                                            alt="lst-cas-img2.jpg" itemprop="image">
                                                        <h6 itemprop="headline"><a href="#" title=""
                                                                itemprop="url">Help For Education</a></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="owl-nav"><button type="button" role="presentation"
                                                class="owl-prev"><i class="fa fa-angle-left"></i></button><button
                                                type="button" role="presentation" class="owl-next"><i
                                                    class="fa fa-angle-right"></i></button></div>
                                        <div class="owl-dots disabled"></div>
                                    </div>
                                </div> --}}
                                <div class="widget">
                                    <h5 itemprop="headline">Donasi Lainnya</h5>
                                    <div class="rcnt-wrp">
                                        @foreach ($dataDonasiTerbaru as $dt)
                                            <div class="rcnt-bx">
                                                <a class="brd-rd5"
                                                    href="{{ route('detail-donasi-campaign', ['params' => $dt->uuid]) }}"
                                                    title="" itemprop="url"><img
                                                        src="{{ asset('/storage/campaign/' . $dt->gambar) }}"
                                                        style="height: 66px" alt="rcnt-img1.jpg" itemprop="image"></a>
                                                <div class="rcnt-inf">
                                                    <h6 itemprop="headline"><a
                                                            href="{{ route('detail-donasi-campaign', ['params' => $dt->uuid]) }}"
                                                            title=""
                                                            itemprop="url">{{ \Illuminate\Support\Str::limit(strip_tags($dt->judul), 20, '...') }}</a>
                                                    </h6>
                                                    @php
                                                        $sisaHariTerbaru = \Carbon\Carbon::now()->diffInDays(
                                                            \Carbon\Carbon::parse($dt->tanggal_selesai),
                                                            false,
                                                        );
                                                    @endphp
                                                    <span class="theme-clr"><i
                                                            class="far fa-calendar-alt"></i>{{ $sisaHariTerbaru > 0 ? "Tinggal $sisaHariTerbaru hari lagi" : 'Berakhir' }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div><!-- Sidebar Wrap -->
                        </div>
                    </div>
                </div><!-- Blog Detail Wrap -->
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
            $("#submit-form-donasi-campaign").click(function(e) {
                e.preventDefault(); // Mencegah reload halaman

                let formData = new FormData($("#form-submit-donasi-campaign")[
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
