@extends('user.layouts.layout')

@section('content')
<section>
        <div class="gap black-layer opc7">
            <div class="fixed-bg2" style="background-image: url({{ asset('assets-landing/images/pg-tp-bg.jpg') }});"></div>
            <div class="container">
                <div class="pg-tp-wrp text-center">
                    <div class="pg-tp-inr">
                        <h1 itemprop="headline">Inventaris Masjid Jami' Al Furqaan</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard-user') }}" title=""
                                    itemprop="url">Home</a></li>
                            <li class="breadcrumb-item active">Inventaris</li>
                        </ol>
                    </div>
                </div><!-- Page Top Wrap -->
            </div>
        </div>
</section>
<section>
    <div class="gap">
        <div class="container">
            <div class="sec-tl text-center">
                <span class="theme-clr">Inventaris</span>
                <h2 itemprop="headline">Daftar Inventaris Masjid</h2>
                <img src="{{ asset('assets-landing/images/pshape.png') }}" alt="">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Kode Inventaris</th>
                            <th>Nama Inventaris</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Kondisi</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inventaris as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_inventaris }}</td>
                            <td><a href="{{ route('detail-inventaris', $item->uuid) }}">{{ $item->nama_inventaris }}</a></td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->satuan }}</td>
                            <td>{{ $item->kondisi }}</td>
                            <td>{{ $item->keterangan }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">Data inventaris belum tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
