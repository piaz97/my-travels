//INDIRIZZO SARA' UN CAMPO DEL FORM NON MODIFICABILE COSI GARANTIAMO LA CORRETTEZZA DELLE COORDINATE
var map;
var marker;

//map initialize
function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 41.89193, lng: 12.51133},
            zoom: 8,
            disableDefaultUI: true,
            gestureHandling: 'greedy'
        });

    // -----------------------PARTE BARRA DI RICERCA-----------------

    //nel caso non ci sia la posizione iniziale nascosto per inizializzare la ricerca
    var initialpos=new google.maps.LatLng(-82.862752, 135);
    placeMarker(initialpos);
    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });

    //Add listener for the searchbox results
    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }
        // Get only one place from the list (default more important first) and place a marker
        var bounds = new google.maps.LatLngBounds();
        places.length=1;  //limit to the first result
        places.forEach(function(place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }

            // Change positon of the marker to the place found
            marker.setPosition(place.geometry.location);

            //get information from the place id and name
            document.getElementById("PlaceName").value=place.name;

            //save address
            document.getElementById("PlaceAddress").value=place.formatted_address;

            //save latitude and longitude //-----------------FIXARE------------------//
            document.getElementById("PlaceLatitude").value=place.geometry.location.lat();
            document.getElementById("PlaceLongitude").value=place.geometry.location.lng();

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds); //sposta la mappa basandosi sulla geometry
    });


    // -----------------------PARTE CLICK UTENTE-----------------
    //listener per il marker onclick
    map.addListener('click', function(event) {
        placeMarker(event.latLng);
        var geocoder = new google.maps.Geocoder;
        geocodeLatLng(geocoder,map,event.latLng);
        //save latitude and longitude
        document.getElementById("PlaceLatitude").value=event.latLng.lat();
        document.getElementById("PlaceLongitude").value=event.latLng.lng();

    });

    // -----------------------PARTE POSIZIONE INIZIALE-----------------
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            placeMarker(pos); //setto il marker
            var geocoder = new google.maps.Geocoder;
            geocodeLatLng(geocoder,map,pos);
            map.setCenter(pos); //setto il centro sul marker
            map.setZoom(18); //setto lo zoom

            //save latitude and longitude
            document.getElementById("PlaceLatitude").value=pos.lat;
            document.getElementById("PlaceLongitude").value=pos.lng;

        }, function() {
            handleLocationError(true);
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false);
    }


}

// -----------------------PARTE SCRIPT PER MARKER E GEOCODING-----------------
//set markers on user click
function placeMarker(location) {
    if(marker) {
        marker.setPosition(location);
    }
    else { //marker initialize
        marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }
}

//reverse geocoder from coordinates to address
function geocodeLatLng(geocoder, map, latlng) {
    geocoder.geocode({'location': latlng}, function(results, status) {
        if (status === 'OK') {
            if (results[0]) {
                placeMarker(latlng); //prima posiziono il marker poi guardo che tipologia di luogo ho selezionato
                //TRY TO GET PLACE NAME BASED ON A QUERY WITH THE ADDRESS
                var request = {
                    location: latlng,
                    radius: '3',
                    type: 'point_of_interest' //restringo la ricerca solo a punti di interesse
                };

                service = new google.maps.places.PlacesService(map);
                service.nearbySearch(request, getplacename);

                //save address
                document.getElementById("PlaceAddress").value=results[0].formatted_address;


            } else {
                //posizione non valida, setto l'indirizzo a zero provocando un errore nell'inserimento
                document.getElementById("PlaceAddress").value='';
            }
        } else {
            //posizione non valida, setto l'indirizzo a zero provocando un errore nell'inserimento
            document.getElementById("PlaceAddress").value='';
        }
    });
}

function getplacename (results, status) {
    var named=false; // ad ogni nuova posizione selezionata dall'utente imposto named a zero prima del controllo
    if (status == google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < results.length; i++) {
            var place = results[i];
            document.getElementById("PlaceName").value=place.name;
            named=true; //se è stato trovato un point of interest devo riportare il nome

        }
    }
    if (named === false) {
        document.getElementById("PlaceName").placeholder="aggiungi un nome a questo luogo!";
        document.getElementById("PlaceName").value="";
    }
}


function handleLocationError(browserHasGeolocation) {return;}