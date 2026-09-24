/**
 * Google map for the map widget (#googleMap): a grayscale map centred on the
 * geocoded data-address (data-lat / data-lng until then), with a marker.
 * No jQuery.
 */
(function () {
    'use strict';

    var mapElement = document.getElementById('googleMap');
    if (!mapElement || !window.google || !google.maps) return;

    function data(name) {
        var el = document.querySelector('[data-' + name + ']');
        return el ? el.getAttribute('data-' + name) : undefined;
    }

    var map,
        lat = data('lat'),
        lng = data('lng'),
        address = data('address');

    var latlng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
    var stylez = [{
        featureType: "all",
        elementType: "all",
        stylers: [{
            saturation: -10
        }]
    }];
    var mapOptions = {
        zoom: 15,
        center: latlng,
        scrollwheel: false,
        scaleControl: false,
        disableDefaultUI: true,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'gMap']
        }
    };
    map = new google.maps.Map(mapElement, mapOptions);
    var geocoder_map = new google.maps.Geocoder();
    geocoder_map.geocode({
        'address': address
    }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            new google.maps.Marker({
                map: map,
                position: map.getCenter()
            });
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
    var mapType = new google.maps.StyledMapType(stylez, {
        name: "Grayscale"
    });
    map.mapTypes.set('gMap', mapType);
    map.setMapTypeId('gMap');
}());
