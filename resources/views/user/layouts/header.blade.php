<header class="style1">
    <div class="topbar">
        <div class="container">
            <div class="scl1 float-left">
                <span class="mr-1"><i class="fas fa-clock theme-clr"></i></span>
                <span id="clock" class="m-0"></span>
                <span class="m-0">/</span>
                <span id="hijri-date"></span>
            </div>
            <ul class="float-right tp-lnks">
                <li><i class="fas fa-envelope theme-clr"></i><a href="#" title=""
                        itemprop="url">info@bismillah.com</a></li>
                <li><i class="flaticon-phone-volume theme-clr"></i>+(00) 123-345-11</li>
            </ul>
        </div>
    </div><!-- Topbar -->
    <div class="logo-menu-sec">
        <div class="container">
            <div class="logo"><a href="#" title="Logo" itemprop="url"><img
                        src="{{ asset('logo-user-white.png') }}" alt="logo1.png" itemprop="image"></a></div>
            <!-- Logo -->
            <nav>
                <div>
                    <ul>
                        <li><a href="{{ route('dashboard-user') }}" title="" itemprop="url">Home</a></li>
                        <li><a href="{{ route('donasi-campaign-user') }}" title="" itemprop="url">Donasi</a>
                        </li>
                        <li><a href="{{ route('kegiatan') }}" title="" itemprop="url">Kegiatan</a></li>
                        <li><a href="{{ route('dokumentasi') }}" title="" itemprop="url">Dokumentasi</a></li>
                        <li><a href="{{ route('about') }}" title="" itemprop="url">About</a></li>
                        <li><a class="py-0 px-2 theme-btn theme-bg brd-rd5" href="#" title="" itemprop="url"
                                data-toggle="modal" data-target="#modal-pengajuan">Peminjaman Fasilitas</a></li>

                        <!-- Modal -->
                        <div class="modal fade" id="modal-pengajuan" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <!-- Modal Header (Optional) -->
                                    <div class="modal-header">
                                        <h5 class="modal-title">Form Peminjaman Fasilitas</h5>
                                        <button type="button" id="close-modal" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">
                                        <form id="form-submit">
                                            <div class="form-group">
                                                <label for="organisasi">Nama Organisasi/Individu</label>
                                                <input type="text" id="organisasi" name="organisasi"
                                                    class="form-control"
                                                    placeholder="Masukkan nama organisasi/individu">
                                                <div class="text-danger organisasi_error small mt-1">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="penanggung-jawab">Penanggung Jawab</label>
                                                <input type="text" id="penanggung-jawab" name="penanggung_jawab"
                                                    class="form-control" placeholder="Masukkan penanggung jawab">
                                                <div class="text-danger penanggung_jawab_error small mt-1">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="barang">Nama Fasilitas</label>
                                                <input type="text" id="barang" name="barang" class="form-control"
                                                    placeholder="Masukkan nama fasilitas">
                                                <div class="text-danger barang_error small mt-1">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="nomor">Nomor Whatsapp</label>
                                                <input type="text" id="nomor" name="nomor" class="form-control"
                                                    placeholder="Masukkan nomor">
                                                <div class="text-danger nomor_error small mt-1">
                                                </div>
                                            </div>

                                            <div
                                                class="form-group text-center position-relative border border-success rounded p-4 overflow-hidden">
                                                <!-- Preview background -->
                                                <div id="file-preview"
                                                    class="position-absolute w-100 h-100 d-flex justify-content-center align-items-center"
                                                    style="top: 0; left: 0; opacity: 0.1; background-color: #f8f9fa; border-radius: .25rem; z-index: 1;">
                                                    <!-- Ikon atau teks akan ditampilkan melalui JS -->
                                                </div>

                                                <!-- Upload section -->
                                                <div class="position-relative" style="z-index: 2;">
                                                    <i class="material-icons text-success mb-2"
                                                        style="font-size: 40px;">cloud_upload</i>
                                                    <div class="text-success small">Upload Surat (PDF)</div>

                                                    <label class="btn btn-outline-success mt-3">
                                                        <input id="file-upload" type="file" name="surat"
                                                            class="d-none" accept=".pdf">
                                                        <i class="material-icons mr-1">file_upload</i> BROWSE FILE
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="text-danger surat_error small mb-3"></div>

                                            <div class="d-flex justify-content-between">
                                                <button type="button" class="btn btn-danger"
                                                    data-dismiss="modal">Batalkan</button>
                                                <button type="button" id="submit-form"
                                                    class="btn btn-success d-flex align-items-center">
                                                    <i class="material-icons mr-1" style="font-size: 20px;">save</i>
                                                    Kirim
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </ul>
                    <a class="srch-btn" href="#" title="" itemprop="url"><i
                            class="fas fa-search"></i></a>
                </div>
            </nav>
        </div>
    </div><!-- Logo Menu Sec -->
</header><!-- Header -->
<div class="header-search">
    <span class="srch-cls-btn brd-rd5"><i class="fas fa-times"></i></span>
    <form>
        <input type="text" placeholder="Search here...">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>
</div><!-- Header Search -->
<div class="rspn-hdr">
    <div class="rspn-mdbr">
        <ul class="rspn-scil">
            <li><a href="#" title="Twitter" itemprop="url" target="_blank"><i class="fab fa-twitter"></i></a>
            </li>
            <li><a href="#" title="Facebook" itemprop="url" target="_blank"><i
                        class="fab fa-facebook-f"></i></a>
            </li>
            <li><a href="#" title="Linkedin" itemprop="url" target="_blank"><i
                        class="fab fa-linkedin-in"></i></a>
            </li>
            <li><a href="#" title="Google Plus" itemprop="url" target="_blank"><i
                        class="fab fa-google-plus-g"></i></a></li>
        </ul>
        <form class="rspn-srch">
            <input type="text" placeholder="Enter Your Keyword" />
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
    <div class="lg-mn">
        <div class="logo"><a href="index.html" title="Logo" itemprop="url"><img src="assets/images/logo2.png"
                    alt="logo2.png" itemprop="image"></a></div>
        <div class="rspn-cnt">
            <span><i class="fas fa-envelope theme-clr"></i><a href="#" title=""
                    itemprop="url">info@bismillah.com</a></span>
            <span><i class="flaticon-phone-volume theme-clr"></i>+(00) 123-345-11</span>
        </div>
        <span class="rspn-mnu-btn"><i class="fa fa-list-ul"></i></span>
    </div>
    <div class="rsnp-mnu">
        <span class="rspn-mnu-cls"><i class="fa fa-times"></i></span>
        <ul>
            <li class="menu-item-has-children"><a href="#" title="" itemprop="url">Home</a>
                <ul>
                    <li><a href="index.html" title="" itemprop="url">Homepage 1</a></li>
                    <li><a href="index2.html" title="" itemprop="url">Homepage 2</a></li>
                    <li><a href="index3.html" title="" itemprop="url">Homepage 3</a></li>
                    <li><a href="index4.html" title="" itemprop="url">Homepage 4</a></li>
                    <li><a href="../bismillah-rtl/index.html" title="" itemprop="url">Arabic Version</a></li>
                </ul>
            </li>
            <li class="menu-item-has-children"><a href="#" title="" itemprop="url">Our Blog</a>
                <ul>
                    <li><a href="blog.html" title="" itemprop="url">Blog List Style</a></li>
                    <li><a href="blog2.html" title="" itemprop="url">Blog Grid Style</a></li>
                    <li><a href="blog-detail.html" title="" itemprop="url">Blog Detail</a></li>
                </ul>
            </li>
            <li class="menu-item-has-children"><a href="#" title="" itemprop="url">More Pages</a>
                <ul>
                    <li class="menu-item-has-children"><a href="#" title="" itemprop="url">Our
                            Events</a>
                        <ul>
                            <li><a href="events.html" title="" itemprop="url">Our Events</a></li>
                            <li><a href="event-detail.html" title="" itemprop="url">Event Detail</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children"><a href="#" title="" itemprop="url">Our
                            Products</a>
                        <ul>
                            <li><a href="product.html" title="" itemprop="url">Our Products</a></li>
                            <li><a href="product-detail.html" title="" itemprop="url">Product Detail</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children"><a href="#" title="" itemprop="url">Our Team</a>
                        <ul>
                            <li><a href="team.html" title="" itemprop="url">Our Team</a></li>
                            <li><a href="team-detail.html" title="" itemprop="url">Team Detail</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children"><a href="#" title="" itemprop="url">Gallery
                            Styles</a>
                        <ul>
                            <li><a href="gallery1.html" title="" itemprop="url">Gallery Style 1</a></li>
                            <li><a href="gallery2.html" title="" itemprop="url">Gallery Style 2</a></li>
                            <li><a href="gallery3.html" title="" itemprop="url">Gallery Style 3</a></li>
                        </ul>
                    </li>
                    <li><a href="404.html" title="" itemprop="url">Error Page</a></li>
                    <li><a href="search-found.html" title="" itemprop="url">Search Found</a></li>
                    <li><a href="search-not-found.html" title="" itemprop="url">Search Not Found</a></li>
                    <li><a href="islamic-teaching.html" title="" itemprop="url">Islamic Teaching</a></li>
                    <li><a href="about.html" title="" itemprop="url">About Us</a></li>
                </ul>
            </li>
            <li class="menu-item-has-children"><a href="#" title="" itemprop="url">Our Causes</a>
                <ul>
                    <li><a href="cause.html" title="" itemprop="url">Cause</a></li>
                    <li><a href="cause-detail.html" title="" itemprop="url">Cause Detail</a></li>
                </ul>
            </li>
            <li class="menu-item-has-children"><a href="#" title="" itemprop="url">Our Services</a>
                <ul>
                    <li><a href="service.html" title="" itemprop="url">Service Style 1</a></li>
                    <li><a href="service2.html" title="" itemprop="url">Service Style 2</a></li>
                    <li><a href="service-detail.html" title="" itemprop="url">Service Detail</a></li>
                </ul>
            </li>
            <li><a href="contact.html" title="" itemprop="url">Contact</a></li>
        </ul>
    </div><!-- Responsive Menu -->
</div><!-- Responsive Header -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>
<script src="{{ asset('assets-landing/js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</script>
<script>
    function previewFile(input) {
        const file = input.files[0];
        const preview = document.getElementById('file-preview');
        preview.innerHTML = ''; // Kosongkan isi sebelumnya

        if (!file) return;

        const fileType = file.type;

        if (fileType.startsWith("image/")) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.style.backgroundImage = `url(${e.target.result})`;
                preview.style.backgroundSize = "cover";
                preview.style.backgroundPosition = "center";
                preview.innerHTML = '';
            };
            reader.readAsDataURL(file);
        } else if (fileType === "application/pdf") {
            preview.style.backgroundImage = 'none';
            preview.innerHTML = `
                <i class="material-icons text-danger" style="font-size: 48px;">picture_as_pdf</i>
                <p class="text-dark small mt-2">${file.name}</p>
            `;
        } else {
            preview.innerHTML = `<p class="text-danger">File tidak didukung</p>`;
        }
    }

    document.getElementById('file-upload').addEventListener('change', function() {
        previewFile(this);
    });


    $(document).ready(function() {
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
                url: "{{ route('pengajuan') }}",
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
</script>
