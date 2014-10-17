var map;
jQuery(document).ready(function($){
    //Parametros de google
    var $latitude = 4.598056000000001,
        $longitude = -74.07583299999999,
        $map_zoom = 14;

    //google map custom marker icon - .png fallback for IE11
    var is_internetExplorer11= navigator.userAgent.toLowerCase().indexOf('trident') > -1;
    var $marker_url = ( is_internetExplorer11 ) ? 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/148866/cd-icon-location.png' : 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/148866/cd-icon-location_1.svg';

    //define the basic color of your map, plus a value for saturation and brightness
    var	$main_color = '#2d313f',
        $saturation= -20,
        $brightness= 5;

    //we define here the style of the map
    var style= [
        {
            //set saturation for the labels on the map
            elementType: "labels",
            stylers: [
                {saturation: $saturation}
            ]
        },
        {	//poi stands for point of interest - don't show these lables on the map
            featureType: "poi",
            elementType: "labels",
            stylers: [
                {visibility: "off"}
            ]
        },
        {
            //don't show highways lables on the map
            featureType: 'road.highway',
            elementType: 'labels',
            stylers: [
                {visibility: "off"}
            ]
        },
        {
            //don't show local road lables on the map
            featureType: "road.local",
            elementType: "labels.icon",
            stylers: [
                {visibility: "off"}
            ]
        },
        {
            //don't show arterial road lables on the map
            featureType: "road.arterial",
            elementType: "labels.icon",
            stylers: [
                {visibility: "off"}
            ]
        },
        {
            //don't show road lables on the map
            featureType: "road",
            elementType: "geometry.stroke",
            stylers: [
                {visibility: "off"}
            ]
        },
        //style different elements on the map
        {
            featureType: "transit",
            elementType: "geometry.fill",
            stylers: [
                { hue: $main_color },
                { visibility: "on" },
                { lightness: $brightness },
                { saturation: $saturation }
            ]
        },
        {
            featureType: "poi",
            elementType: "geometry.fill",
            stylers: [
                { hue: $main_color },
                { visibility: "on" },
                { lightness: $brightness },
                { saturation: $saturation }
            ]
        },
        {
            featureType: "poi.government",
            elementType: "geometry.fill",
            stylers: [
                { hue: $main_color },
                { visibility: "on" },
                { lightness: $brightness },
                { saturation: $saturation }
            ]
        },
        {
            featureType: "poi.sport_complex",
            elementType: "geometry.fill",
            stylers: [
                { hue: $main_color },
                { visibility: "on" },
                { lightness: $brightness },
                { saturation: $saturation }
            ]
        },
        {
            featureType: "poi.attraction",
            elementType: "geometry.fill",
            stylers: [
                { hue: $main_color },
                { visibility: "on" },
                { lightness: $brightness },
                { saturation: $saturation }
            ]
        },
        {
            featureType: "poi.business",
            elementType: "geometry.fill",
            stylers: [
                { hue: $main_color },
                { visibility: "on" },
                { lightness: $brightness },
                { saturation: $saturation }
            ]
        },
        {
            featureType: "transit",
            elementType: "geometry.fill",
            stylers: [
                { hue: $main_color },
                { visibility: "on" },
                { lightness: $brightness },
                { saturation: $saturation }
            ]
        },
        {
            featureType: "transit.station",
            elementType: "geometry.fill",
            stylers: [
                { hue: $main_color },
                { visibility: "on" },
                { lightness: $brightness },
                { saturation: $saturation }
            ]
        },
        {
            featureType: "landscape",
            stylers: [
                { hue: $main_color },
                { visibility: "on" },
                { lightness: $brightness },
                { saturation: $saturation }
            ]

        },
        {
            featureType: "road",
            elementType: "geometry.fill",
            stylers: [
                { hue: $main_color },
                { visibility: "on" },
                { lightness: $brightness },
                { saturation: $saturation }
            ]
        },
        {
            featureType: "road.highway",
            elementType: "geometry.fill",
            stylers: [
                { hue: $main_color },
                { visibility: "on" },
                { lightness: $brightness },
                { saturation: $saturation }
            ]
        },
        {
            featureType: "water",
            elementType: "geometry",
            stylers: [
                { hue: $main_color },
                { visibility: "on" },
                { lightness: $brightness },
                { saturation: $saturation }
            ]
        }
    ];

    //set google map options
    var map_options = {
        center: new google.maps.LatLng($latitude, $longitude),
        zoom: $map_zoom,
        panControl: false,
        zoomControl: false,
        mapTypeControl: false,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        styles: style,
    }
    //inizialize the map
    map = new google.maps.Map(document.getElementById('google-container'), map_options);
    //add a custom marker to the map
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng($latitude, $longitude),
        map: map,
        visible: true,
        icon: $marker_url,
    });

    var marker2 = new google.maps.Marker({
        position: new google.maps.LatLng('4.5975576', '-74.1011196'),
        map: map,
        visible: true,
        animation: google.maps.Animation.DROP,
        icon: $marker_url,
    });
    google.maps.event.addListener(marker2, "click", function() {
        marker.setMap(null);

    });
    //add custom buttons for the zoom-in/zoom-out on the map
    function CustomZoomControl(controlDiv, map) {
        //grap the zoom elements from the DOM and insert them in the map
        var controlUIzoomIn= document.getElementById('cd-zoom-in'),
            controlUIzoomOut= document.getElementById('cd-zoom-out');
        controlDiv.appendChild(controlUIzoomIn);
        controlDiv.appendChild(controlUIzoomOut);

        // Setup the click event listeners and zoom-in or out according to the clicked element
        google.maps.event.addDomListener(controlUIzoomIn, 'click', function() {
            map.setZoom(map.getZoom()+1)
        });
        google.maps.event.addDomListener(controlUIzoomOut, 'click', function() {
            map.setZoom(map.getZoom()-1)
        });
    }

    var zoomControlDiv = document.createElement('div');
    var zoomControl = new CustomZoomControl(zoomControlDiv, map);

    //insert the zoom div on the top left of the map
    map.controls[google.maps.ControlPosition.LEFT_TOP].push(zoomControlDiv);


    $("#select").click(function() {
        var coordenadas = $("#select").val().split(",");
        map.setCenter(new google.maps.LatLng(coordenadas[0], coordenadas[1]));
        console.log(this.options[this.selectedIndex].value);
        map.setZoom(15)

    });
});

