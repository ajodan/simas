<!DOCTYPE html>
<html>

<head>
    <title>Pengingat Donasi Rutin</title>
</head>

<body>
    <h2>Assalamu'alaikum, {{ $donatur->nama }}</h2>
    <p>Ini adalah pengingat untuk melakukan donasi rutin sebesar <strong>{{ $donatur->nominal }}</strong> dengan
        frekuensi <strong>{{ $donatur->frekuensi }}</strong>.</p>
    <p>Klik Tombol Berikut untuk Melaukan Donasi <a
            style="padding: 10px; border-radius: 8px; background-color: green: color: white"
            href="{{ route('donatur-tetap', ['params' => $donatur->uuid]) }}">Donasi
            Sekarang</a></p>
    <p>Semoga Allah membalas kebaikan Anda.</p>
</body>

</html>
