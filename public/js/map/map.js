function initMap(lat, lon){
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
        document.getElementById("map_canvas"),
        mapOptions
    );

    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title: "{{ Auth::user()->name }}"
    });

    var contentString = 'Set your location';
    var infoWindow = new google.maps.infoWindow({
        content: contentString
    });

    google.maps.event.addListener(marker, 'click', function() {
      infoWindow.open(map,marker);
    });
}

function displayMap(locations){
    var mapOptions = {
        zoom: 1,
        minZoom: 0,
        maxZoom: 18,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.DEFAULT
        },
        center: new google.maps.LatLng(locations[0]['lat'], locations[0]['lon']),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

    var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    var infoWindow = new google.maps.InfoWindow();

    for(var i = 0; i < locations.length; i++){
        var location = locations[i];
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(location['lat'], location['lon']),
            map: map,
            title: location['info']
        });

        // passing data in the loop into the closure (marker, location)
        (function(marker, location) {
            var geocoder = new google.maps.Geocoder();
            var directionsDisplay = new google.maps.DirectionsRenderer({draggable: true});
            var directionsService = new google.maps.DirectionsService();

            directionsDisplay.setMap(map);
            directionsDisplay.setPanel(document.getElementById('map_canvas'), mapOptions);

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

function getAddress(lat, lon){
    var latLng = new google.maps.LatLng(lat, lon);
    var geocoder = new google.maps.Geocoder();
    var address = "";

    function reverseGeocode(){
        geocoder.geocode({'latLng' :  latLng}, function(results, status){
            if(status == google.maps.GeocoderStatus.OK){
                if(results[1]){
                    address = results[1].formatted_address;
                }
            }
        });
    }

    reverseGeocode();
}
