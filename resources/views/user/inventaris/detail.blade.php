@extends('user.layouts.layout')

@section('content')
<section>
    <div class="gap black-layer opc7">
        <div style="background-image: url({{ asset('assets-landing/images/pg-tp-bg.jpg') }});"></div>
        <div class="container">
            <div class="pg-tp-wrp text-center">
                <div class="pg-tp-inr">
                    <h1 itemprop="headline">{{ $data->nama_inventaris }}</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title="" itemprop="url">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('inventaris-user') }}" title="" itemprop="url">Inventaris</a></li>
                        <li class="breadcrumb-item active">{{ $data->nama_inventaris }}</li>
                    </ol>
                </div>
            </div><!-- Page Top Wrap -->
        </div>
    </div>
</section>

<section>
    <div class="gap">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="blog-detail">
                        @if ($data->photo)
                            <div class="blog-thumb">
                                <img src="{{ asset('storage/public/inventaris/' . $data->photo) }}" alt="{{ $data->nama_inventaris }}" class="img-fluid">
                            </div><br>
                        @endif
                        <div class="blog-info">
                            <span class="theme-clr"><i class="far fa-calendar-alt"></i>{{ $data->created_at->format('M d, Y') }}</span>
                            <span class="theme-clr"><i class="fas fa-tag"></i>{{ $data->jenisInventaris->jenis_inventaris ?? 'Tidak ada jenis' }}</span>
                        </div>
                        <div class="inventaris-details">
                            <h3>Detail Inventaris</h3>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Kode Inventaris</th>
                                    <td>{{ $data->kode_inventaris }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Inventaris</th>
                                    <td>{{ $data->nama_inventaris }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah</th>
                                    <td>{{ $data->jumlah }} {{ $data->satuan }}</td>
                                </tr>
                                <tr>
                                    <th>Kondisi</th>
                                    <td>{{ $data->kondisi }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Perolehan</th>
                                    <td>{{ $data->tahun_perolehan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan</th>
                                    <td>{{ $data->keterangan ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sidebar">
                        <div class="widget">
                            <h5>Jenis Inventaris</h5>
                            <ul class="list-group">
                                @foreach (\App\Models\JenisInventaris::all() as $jenis)
                                    <li class="list-group-item"><a href="#">{{ $jenis->nama_jenis_inventaris }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
