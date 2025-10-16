@extends('layouts.layout')
@section('button')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <button class="btn btn-info btn-sm " data-kt-drawer-show="true" data-kt-drawer-target="#side_form"
                id="button-side-form"><i class="fa fa-plus-circle" style="color:#ffffff" aria-hidden="true"></i> Tambah
                Data</button>
        </div>
    </div>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="row">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="container">
                            <div class="py-5 table-responsive">
                                <table id="kt_table_data"
                                    class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300">
                                    <thead class="text-center">
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Kegiatan</th>
                                            <th>Foto</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('side-form')
    <div id="side_form" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
        data-kt-drawer-toggle="#side_form_button" data-kt-drawer-close="#side_form_close" data-kt-drawer-width="500px">
        <div class="card w-100">
            <div class="card-header pe-5">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <a href="#"
                            class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1 title_side_form"></a>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-active-light-primary" id="side_form_close">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.5"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body hover-scroll-overlay-y">
                <form class="form-data" enctype="multipart/form-data">

                    <input type="hidden" name="id">
                    <input type="hidden" name="uuid">

                    <div class="mb-10">
                        <label class="form-label">Judul</label>
                        <input type="text" id="judul" class="form-control" name="judul">
                        <small class="text-danger judul_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Kegiatan</label>
                        <select id="kegiatan_id" class="form-control" name="kegiatan_id">
                            <option value="">Pilih Kegiatan</option>
                        </select>
                        <small class="text-danger kegiatan_id_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Foto</label>
                        <input type="file" accept="image/*" id="foto" class="form-control" name="foto">
                        <small class="text-danger foto_error"></small>

                        <div class="mt-3" id="fotoInfoContainer"></div>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Keterangan</label>
                        <textarea id="keterangan" class="form-control" name="keterangan" rows="3"></textarea>
                        <small class="text-danger keterangan_error"></small>
                    </div>

                    <div class="separator separator-dashed mt-8 mb-5"></div>
                    <div class="d-flex gap-5">
                        <button type="submit" class="btn btn-success btn-sm btn-submit d-flex align-items-center"><i
                                class="bi bi-file-earmark-diff"></i> Simpan</button>
                        <button type="reset" id="side_form_close"
                            class="btn mr-2 btn-light btn-cancel btn-sm d-flex align-items-center"
                            style="background-color: #ea443e65; color: #EA443E"><i class="bi bi-trash-fill"
                                style="color: #EA443E"></i>Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let control = new Control();

        function loadKegiatanOptions() {
            return $.ajax({
                url: '/admin/kegiatan/kegiatan-get',
                method: 'GET',
                success: function(response) {
                    if (response.success) {
                        let options = '<option value="">Pilih Kegiatan</option>';
                        response.data.forEach(function(item) {
                            options += `<option value="${item.id}">${item.nama_kegiatan}</option>`;
                        });
                        $('#kegiatan_id').html(options);
                    }
                },
                error: function() {
                    alert('Gagal memuat kegiatan');
                }
            });
        }

        $(document).on('click', '#button-side-form', function() {
            control.overlay_form('Tambah', 'Dokumentasi');
            loadKegiatanOptions();
            $(".btn-submit").html('<i class="bi bi-file-earmark-diff"></i> Tambah');
        })

        $('#foto').change(function() {
            previewImage(this);
        });

        function previewImage(input) {
            var fotoInfoContainer = $('#fotoInfoContainer');
            var fotoError = $('.foto_error');

            fotoError.text('');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    fotoInfoContainer.html('<img id="img-foto" src="' + e.target.result + '" style="max-width:100%;">');
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                fotoError.text('Pilih file gambar yang valid.');
                fotoInfoContainer.html('');
            }
        }

        $(document).on('submit', ".form-data", function(e) {
            e.preventDefault();
            let type = $(this).attr('data-type');
            if (type == 'add') {
                control.submitFormMultipartData('/admin/dokumentasi-add', 'Tambah',
                    'Dokumentasi',
                    'POST');
            } else {
                let uuid = $("input[name='uuid']").val();
                control.submitFormMultipartData('/admin/dokumentasi-update/' + uuid,
                    'Update',
                    'Dokumentasi', 'POST');
            }
        });

        $(document).on('click', '.button-update', function(e) {
            e.preventDefault();
            $(".title_side_form").html(`Update Dokumentasi`);
            $(".text-danger").html("");
            $(".form-data").attr("data-type", "update");
            $(".btn-submit").html('<i class="bi bi-file-earmark-diff"></i> Simpan');
            let url = '/admin/dokumentasi-show/' + $(this).attr('data-uuid');
            loadKegiatanOptions().then(function() {
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(res) {
                        if (res.success == true) {
                            $.each(res.data, function(x, y) {
                                if ($("input[name='" + x + "']").is(":radio")) {
                                    $("input[name='" + x + "'][value='" + y + "']").prop(
                                        "checked",
                                        true
                                    );
                                } else if ($("input[name='" + x + "']").attr("type") === "file") {
                                    const fotoInfoContainer = $('#fotoInfoContainer');
                                    fotoInfoContainer.html(
                                        `<img id="img-foto" src="/storage/dokumentasi/${y}" style="max-width:100%;">`
                                    );
                                } else {
                                    $("input[name='" + x + "']").val(y);
                                    $("select[name='" + x + "']").val(y);
                                    $("textarea[name='" + x + "']").val(y);
                                    $("select[name='" + x + "']").trigger("change");
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        alert("Gagal memuat data");
                    },
                });
            });
        })

        $(document).on('click', '.button-delete', function(e) {
            e.preventDefault();
            let url = '/admin/dokumentasi-delete/' + $(this).attr('data-uuid');
            let label = $(this).attr('data-label');
            control.ajaxDelete(url, label)
        })

        $(document).on('keyup', '#search_', function(e) {
            e.preventDefault();
            control.searchTable(this.value);
        })

        const initDatatable = async () => {
            if ($.fn.DataTable.isDataTable('#kt_table_data')) {
                $('#kt_table_data').DataTable().clear().destroy();
            }

            $('#kt_table_data').DataTable({
                responsive: true,
                pageLength: 10,
                order: [
                    [0, 'asc']
                ],
                processing: true,
                ajax: '/admin/dokumentasi-get',
                columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }, {
                    data: 'judul',
                    className: 'text-center',
                }, {
                    data: 'kegiatan.nama_kegiatan',
                    className: 'text-center',
                }, {
                    data: 'foto',
                    className: 'text-center',
                    render: function(data, type, row, meta) {
                        if (data) {
                            return `<img src="/storage/dokumentasi/${data}" style="width: 100px; height: 100px; object-fit: cover;">`;
                        } else {
                            return '-';
                        }
                    }
                }, {
                    data: 'keterangan',
                    className: 'text-center',
                }, {
                    data: 'uuid',
                }],
                columnDefs: [{
                    targets: -1,
                    title: 'Aksi',
                    width: '8rem',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        return `
                            <a href="javascript:;" type="button" data-uuid="${data}" data-kt-drawer-show="true" data-kt-drawer-target="#side_form" class="btn btn-warning button-update btn-icon btn-sm">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="javascript:;" type="button" data-uuid="${data}" data-label="Dokumentasi" class="btn btn-danger button-delete btn-icon btn-sm">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        `;
                    },
                }],
                rowCallback: function(row, data, index) {
                    var api = this.api();
                    var startIndex = api.context[0]._iDisplayStart;
                    var rowIndex = startIndex + index + 1;
                    $('td', row).eq(0).html(rowIndex);
                },
            });
        };

        $(function() {
            initDatatable();
        });
    </script>
@endsection
