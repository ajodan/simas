$(document).ready(function () {
    'use strict';
    // Panggil langsung saat halaman dimuat
    get_azan_time();
});

function get_azan_time() {
    var country = $('#comboA').val() || 'Indonesia';
    var city = $('#comboB').val() || 'Makassar';

    var azan_time_url = `https://api.aladhan.com/v1/timingsByCity?city=${city}&country=${country}&method=8`;
    var namaz_time_url = `${azan_time_url}&tune=2,10,10,10,10,10,10,10,10`;

    // Waktu Azan
    $.getJSON(azan_time_url, function (data) {
        if (data.code === 200) {
            var t = data.data.timings;
            $(".fajr-azan-time").html(get_meridian(t.Fajr));
            $(".sunrise-azan-time").html(get_meridian(t.Sunrise));
            $(".zohar-azan-time").html(get_meridian(t.Dhuhr));
            $(".asr-azan-time").html(get_meridian(t.Asr));
            $(".maghrib-azan-time").html(get_meridian(t.Maghrib));
            $(".isha-azan-time").html(get_meridian(t.Isha));
            $(".juma-azan-time").html(get_meridian(t.Sunset));
        }
    });

    // Waktu Sholat (dengan offset)
    $.getJSON(namaz_time_url, function (data) {
        if (data.code === 200) {
            var t = data.data.timings;
            $("#result-update").html(
                'Menampilkan Waktu Sholat untuk <span class="country">' + city + ', ' + country + '</span>'
            );
            $(".fajr-azan-prayer").html(get_meridian(t.Fajr));
            $(".sunrise-azan-prayer").html(get_meridian(t.Sunrise));
            $(".zohar-azan-prayer").html(get_meridian(t.Dhuhr));
            $(".asr-azan-prayer").html(get_meridian(t.Asr));
            $(".maghrib-azan-prayer").html(get_meridian(t.Maghrib));
            $(".isha-azan-prayer").html(get_meridian(t.Isha));
            $(".juma-azan-prayer").html(get_meridian(t.Sunset));
        }
    });
}

function get_meridian(timeStr) {
    const timeString = timeStr + ':00';
    const timeFormatted = new Date('1970-01-01T' + timeString + 'Z').toLocaleTimeString(
        {},
        { timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric' }
    );
    return timeFormatted;
}
