// Initialize and add the map
function initMap() {
    // The location of Uluru
    var Torre = {lat: 45.411473, lng: 11.887478};
    // The map, centered at Uluru
    var map = new google.maps.Map(
        document.getElementById('mapContatti'), {zoom: 16, center: Torre});
    // The marker, positioned at Uluru
    var marker = new google.maps.Marker({position: Torre, map: map});
}