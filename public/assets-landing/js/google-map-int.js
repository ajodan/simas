$(document).ready(function () {
    'use strict';

    var marker;

    function initMap() {
        // Koordinat Makassar (yang kamu minta)
        var lokasi = { lat: -5.203562258748029, lng: 119.49655882538984 };

        var map = new google.maps.Map(document.getElementById('loc-mp'), {
            zoom: 15,
            center: lokasi
        });

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: lokasi
        });

        marker.addListener('click', toggleBounce);
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }

    // Ganti 'load' dengan 'DOMContentLoaded' (lebih aman dan cepat)
    google.maps.event.addDomListener(window, 'load', initMap);
});
