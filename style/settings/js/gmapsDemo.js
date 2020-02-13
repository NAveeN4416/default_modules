new GMaps({
    div: "#demo_map_normal",
    lat: 2, lng: 2, zoom: 1, scrollwheel: !1
}).setMapTypeId(google.maps.MapTypeId.ROADMAP);

new GMaps({
    div: "#demo_map_sat",
    lat: 2, lng: 2, zoom: 1, scrollwheel: false
}).setMapTypeId(google.maps.MapTypeId.SATELLITE);

new GMaps({
    div: "#demo_map_hyp",
    lat: 2, lng: 2, zoom: 1, scrollwheel: false
}).setMapTypeId(google.maps.MapTypeId.HYBRID);

new GMaps({
    div: "#demo_map_ter",
    lat: 2, lng: 2, zoom: 1, scrollwheel: false
}).setMapTypeId(google.maps.MapTypeId.TERRAIN);

var GeoMap = new GMaps({
    div: "#demo_map_geo",
    lat: 2, lng: 2, scrollwheel: false
});
GMaps.geolocate({
    success: function(e) {
        GeoMap.setCenter(e.coords.latitude, e.coords.longitude), GeoMap.addMarker({
            lat: e.coords.latitude, lng: e.coords.longitude, animation: google.maps.Animation.DROP,
            title: "Geolocation Map",
            infoWindow: {
                content: '<div class="txt-success"><i class="fa fa-map-marker"></i> This is you !</div>'
            }
        })
    },
    error: function(e) {
        alert("Geolocation failed: " + e.message)
    },
    not_supported: function() {
        alert("Your browser does not support Geolocation")
    },
    always: function() {}
});

new GMaps({
    div: "#demo_map_marker",
    lat: 38.7577, lng: -120.4376, zoom: 10, scrollwheel: false
}).addMarkers([{
    lat: 38.7, lng: -120.49, title: "This is a marker",
    animation: google.maps.Animation.DROP,
    infoWindow: {
        content: "<strong>Marker 1</strong>"
    }
},
{
	lat: 38.9, lng: -120.69, title: "This is a marker",
    animation: google.maps.Animation.DROP,
    infoWindow: {
        content: "<strong>Marker 2</strong>"
    }
}]);