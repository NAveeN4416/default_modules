var markercount = 0;
var markersArray = [];
var savedlocation;
var pos;
var map;

var AccommodationMap = {
    selectors: {
        txtLatitude: "Latitude",
        txtLongitude: "Longitude",
        mapDiv: "googleMap",
        infoWindoContent: "<h5>Current Location</h5>",
        btnResetMap: "#btnResetMap"

    },

    services: {
        controller: "Accommodation",
        userLocationApi: "http://ip-api.com/json",
        actions: {}
    },


    callbacks: {
        showMarker: function (location) {
            if (markersArray) {
                for (var i = 0; i < markersArray.length; i++) {
                    markersArray[i].setMap(null);
                }
                markersArray.length = 0;
            }

            var marker = new window.google.maps.Marker({
                position: location,
                map: map,
                animation: window.google.maps.Animation.BOUNCE
            });

            markersArray.push(marker);
            document.getElementById(AccommodationMap.selectors.txtLatitude).value = location.lat();
            document.getElementById(AccommodationMap.selectors.txtLongitude).value = location.lng();

            map.panTo(marker.getPosition());
            map.fitBounds(marker.getPosition());
            markercount = 1;
        },
        initMap: function () {
            var mapDiv = document.getElementById(AccommodationMap.selectors.mapDiv);
            map = new window.google.maps.Map(mapDiv, {
                zoom: 13,
                center: pos
            });

            var infowindow = new window.google.maps.InfoWindow({
                content: "<h5>Current Location</h5>"
            });

            infowindow.setPosition(pos);
            infowindow.open(map, null);

            window.google.maps.event.addListenerOnce(map, "idle", function () {
                if (savedlocation.latitude !== 38.685516) {
                    var location = new window.google.maps.LatLng(savedlocation.latitude, savedlocation.longitude);
                    AccommodationMap.callbacks.showMarker(location);
                }
            });

            window.google.maps.event.addListener(map, "click", function (event) {
                AccommodationMap.callbacks.showMarker(event.latLng);
            });
            //place a marker on Map

        },
        MapSetupSuccess: function (result) {
            GenericAlerts.toast(result);
            commonFunctions.calculateProgress();
        }
    },


    initEvents: function () {

        var savedLongitued = parseFloat(document.getElementById(AccommodationMap.selectors.txtLongitude).value);
        var savedlatitude = parseFloat(document.getElementById(AccommodationMap.selectors.txtLatitude).value);
        savedlocation = {
            latitude: savedlatitude ? savedlatitude : 38.685516,
            longitude: savedLongitued ? savedLongitued : -101.073324
        };

        $.get(AccommodationMap.services.userLocationApi, function (data) {
            pos = new window.google.maps.LatLng(data.lat, data.lon);
            AccommodationMap.callbacks.initMap();
        });

        $(AccommodationMap.selectors.btnResetMap + ":not(.bound)").addClass("bound").click(function () {
            AccommodationMap.callbacks.initMap();
        });


    }

}

