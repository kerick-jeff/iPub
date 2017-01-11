function initMap(lat, lon, editHolder){
    var holder;

    if(editHolder == true) {
        holder = document.getElementById("edit-geolocation").getElementsByClassName("map-canvas")[0];
    } else {
        holder = document.getElementById("map-canvas");
    }

    var position = new google.maps.LatLng(lat, lon);
    var mapOptions = {
        zoom: 10,
        minZoom: 3,
        maxZoom: 18,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.DEFAULT
        },
        center: position,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        //all of the below are set to to true by default
        panControl: false,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: false,
        overviewMapControl: false,
        rotateControl: false
    };

    var map = new google.maps.Map(
        holder,
        mapOptions
    );

    var marker = new google.maps.Marker({
        position: position,
        map: map,
    });

    var infoWindow = new google.maps.infoWindow({});

    google.maps.event.addListener(marker, 'click', function() {
      infoWindow.setContent("set your location");
      infoWindow.open(map,marker);
    });
}

function displayMap(locations, hLatLon){
    if(hLatLon == null) {
        hLatLon = new Array(0, 0);
    }

    var locationIndex = (parseInt(Math.random() * 10) % locations.length);

    var mapOptions = {
        zoom: 1,
        minZoom: 0,
        maxZoom: 18,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.DEFAULT
        },
        center: new google.maps.LatLng(locations[locationIndex]['lat'], locations[locationIndex]['lon']),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

    var infoWindow = new google.maps.InfoWindow({});

    for(var i = 0; i < locations.length; i++){
        var location = locations[i];
        var marker;

        if(location['lat'] == hLatLon[0] && location['lon'] == hLatLon[1]) {
            marker = new google.maps.Marker({
                icon: {
                    url: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
                    scaledSize: new google.maps.Size(37, 40)
                },
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(location['lat'], location['lon']),
                map: map,
                title: location['info'].replace(/<(?:.|\n)*?>/gm, '')
            });
        } else {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(location['lat'], location['lon']),
                map: map,
                title: location['info'].replace(/<(?:.|\n)*?>/gm, '')
            });
        }

        // passing data in the loop into the closure (marker, location)
        (function(marker, location) {
            var geocoder = new google.maps.Geocoder();
            var directionsDisplay = new google.maps.DirectionsRenderer({draggable: true});
            var directionsService = new google.maps.DirectionsService();

            directionsDisplay.setMap(map);
            directionsDisplay.setPanel(document.getElementById('map-canvas'), mapOptions);

            google.maps.event.addListener(directionsDisplay, "directions_changed", function(){
                //do what you wanna do here i.e. get the modified path of the direction
            });

            geocoder.geocode({'latLng' : new google.maps.LatLng(location['lat'], location['lon'])}, function(results, status){
                if(status == google.maps.GeocoderStatus.OK){
                    if(results[1]){
                        location['info'] += results[1].formatted_address + "<br />" + "<a href='https://www.google.com/maps/dir/Current+Location/" + location['lat'] + "," + location['lon'] + "' target='_blank'>Get Directions</a>";
                        // attach a click event to the current marker
                        google.maps.event.addListener(marker, "click", function(e){
                            infoWindow.setContent(location['info']);
                            infoWindow.open(map, marker);
                        });
                    }
                }
            });
        })(marker, location);
    }
}
