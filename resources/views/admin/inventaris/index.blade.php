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
                                            <th>Kode Inventaris</th>
                                            <th>Nama Inventaris</th>
                                            <th>Jumlah</th>
                                            <th>Satuan</th>
                                            <th>Kondisi</th>
                                            <th>Photo</th>
                                            <th>Tahun Perolehan</th>
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
                        <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1 title_side_form"></a>
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
                <form class="form-data">
                    <input type="hidden" name="id">
                    <input type="hidden" name="uuid">

                    <div class="mb-10">
                        <label class="form-label">Jenis Inventaris</label>
                        <select id="jenisinventaris_id" class="form-control" name="jenisinventaris_id">
                            <option value="">Pilih Jenis Inventaris</option>
                            @foreach ($jenisInventaris as $jenis)
                                <option value="{{ $jenis->id }}">{{ $jenis->jenis_inventaris }}</option>
                            @endforeach
                        </select>
                        <small class="text-danger jenisinventaris_id_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Kode Inventaris</label>
                        <input type="text" id="kode_inventaris" class="form-control" name="kode_inventaris">
                        <small class="text-danger kode_inventaris_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Nama Inventaris</label>
                        <input type="text" id="nama_inventaris" class="form-control" name="nama_inventaris">
                        <small class="text-danger nama_inventaris_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Jumlah</label>
                        <input type="number" id="jumlah" class="form-control" name="jumlah" min="1">
                        <small class="text-danger jumlah_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Satuan</label>
                        <input type="text" id="satuan" class="form-control" name="satuan">
                        <small class="text-danger satuan_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Kondisi</label>
                        <input type="text" id="kondisi" class="form-control" name="kondisi">
                        <small class="text-danger kondisi_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Keterangan</label>
                        <textarea id="keterangan" class="form-control" name="keterangan" rows="3"></textarea>
                        <small class="text-danger keterangan_error"></small>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Photo</label>
                        <input type="file" id="photo" class="form-control" name="photo" accept="image/*">
                        <small class="text-danger photo_error"></small>
                        <div id="current_photo" style="display: none;">
                            <img id="photo_preview" src="" alt="Current Photo" width="430" class="mt-2">
                        </div>
                    </div>

                    <div class="mb-10">
                        <label class="form-label">Tahun Perolehan</label>
                        <input type="number" id="tahun_perolehan" class="form-control" name="tahun_perolehan" min="1900" max="{{ date('Y') }}">
                        <small class="text-danger tahun_perolehan_error"></small>
                    </div>

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

        $(document).on('click', '#button-side-form', function() {
            control.overlay_form('Tambah', 'Inventaris');
            $(".form-data").attr('data-type', 'add');
            $(".form-data")[0].reset();
            $(".text-danger").html("");
            $("input[name='uuid']").val("");
            $("#current_photo").hide();
        });

        $(document).on('click', '.button-update', function(e) {
            e.preventDefault();
            $(".title_side_form").html(`Update Inventaris`);
            $(".text-danger").html("");
            $(".form-data").attr('data-type', 'update');
            $(".form-data")[0].reset();
            let uuid = $(this).attr('data-uuid');
            let url = '/admin/inventaris-show/' + uuid;
            $.ajax({
                url: url,
                method: "GET",
                success: function(res) {
                    if (res.success == true) {
                        $.each(res.data, function(x, y) {
                            if (x === 'jenisinventaris_id') {
                                $("select[name='" + x + "']").val(y);
                            } else if (x === 'photo' && y) {
                                $("#photo_preview").attr('src', '/storage/public/inventaris/' + y);
                                $("#current_photo").show();
                            } else {
                                $("input[name='" + x + "']").val(y);
                                $("textarea[name='" + x + "']").val(y);
                            }
                        });
                    }
                },
                error: function(xhr) {
                    alert("Gagal mengambil data");
                },
            });
        });

        $(document).on('submit', ".form-data", function(e) {
            e.preventDefault();
            let type = $(this).attr('data-type');
            if (type == 'add') {
                control.submitFormMultipartData('/admin/inventaris-add', 'Tambah',
                    'Inventaris',
                    'POST');
            } else {
                let uuid = $("input[name='uuid']").val();
                control.submitFormMultipartData('/admin/inventaris-update/' + uuid,
                    'Update',
                    'Inventaris', 'POST');
            }
        });

        $(document).on('click', '.button-delete', function(e) {
            e.preventDefault();
            let url = '/admin/inventaris-delete/' + $(this).attr('data-uuid');
            let label = $(this).attr('data-label');
            control.ajaxDelete(url, label)
        });

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
                ajax: '/admin/inventaris-get',
                columns: [{
                        data: null,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    // {
                    //     data: 'jenis_inventaris',
                    //     className: 'text-center',
                    //     render: function(data, type, row, meta) {
                    //         return row.jenis_inventaris.jenis_inventaris;
                    //     }
                    // },
                    {
                        data: 'kode_inventaris',
                        className: 'text-center',
                    },
                    {
                        data: 'nama_inventaris',
                        className: 'text-center',
                    },
                    {
                        data: 'jumlah',
                        className: 'text-center',
                    },
                    {
                        data: 'satuan',
                        className: 'text-center',
                    },
                    {
                        data: 'kondisi',
                        className: 'text-center',
                    },
                    // {
                    //     data: 'keterangan',
                    //     className: 'text-center',
                    // },
                    {
                        data: 'photo',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return `<a href="/storage/public/inventaris/${data}" data-fancybox="inventaris"><img src="/storage/public/inventaris/${data}" alt="Photo" style="max-width: 80px; max-height: 80px;" /></a>`;
                            }
                            return '-';
                        }
                    },
                    {
                        data: 'tahun_perolehan',
                        className: 'text-center',
                        render: function(data, type, row, meta) {
                            return data ? data : '-';
                        }
                    },
                    {
                        data: 'uuid',
                    }
                ],
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

                            <a href="javascript:;" type="button" data-uuid="${data}" data-label="inventaris" class="btn btn-danger button-delete btn-icon btn-sm">
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
