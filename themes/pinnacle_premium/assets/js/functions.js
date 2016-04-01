var $=jQuery.noConflict();

/**
 * Run Isotope plugin
 * @container element cointaining items
 * @item element inside the container
**/
function runIsotope( container, item ){
    var $container = $(container);
    $container.imagesLoaded( function(){
        $container.isotope({
            itemSelector : item,
            layoutMode: 'masonry',
            masonry: {
                columnWidth: item
            }
        });
    });
}// runIsotope


/**
 * Filster in Isotope plugin
 * @container element cointaining items
 * @item element inside the container
**/
function filterIsotope( container, item ){
    var $grid = $(container);
    $grid.imagesLoaded( function(){
        $grid.isotope({
            itemSelector : item,
            layoutMode: 'masonry',
            masonry: {
                columnWidth: item
            }
        });
    });

    // store filter for each group
    var filters = {};

    $('.filtros').on( 'click', '.button-group a', function() {
        var $this = $(this);
        console.log($this);
        // get group key
        var $buttonGroup = $this.parents('.button-group');
        var filterGroup = $buttonGroup.attr('data-filter-group');
        // set filter for group
        filters[ filterGroup ] = $this.attr('data-filter');
        // combine filters
        var filterValue = concatValues( filters );
        // set filter for Isotope
        $grid.isotope({ filter: filterValue });
    });

    // add an active class to active filters
    $('.button-group').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'a', function( e ) {
            e.preventDefault();
            $buttonGroup.find('.active').removeClass('active');
            $( this ).addClass('active');
        });
    });
}// filterIsotope

// flatten object by concatting values
function concatValues( obj ) {
    var value = '';
    for ( var prop in obj ) value += obj[ prop ];
    return value;
}

/**
 * Creates a Google Map without Markers
 * @param string id
 * @return obj map
**/
function createEmptyMap( id ){

    var map = new google.maps.Map(document.getElementById( id ), {
        zoom: 20,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,
        streetViewControl: false,
        panControl: false,
        scrollwheel: false,
        zoomControlOptions: {
            position: google.maps.ControlPosition.RIGHT_BOTTOM
        }
    });

    //var styles = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#dcdcdc"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#dcdcdc"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}];
    var styles = [{"featureType": "all","elementType": "all","stylers": [{"hue": "#00a5b1"}]}];
    var styledMap = new google.maps.StyledMapType( styles, { name: "Styled Map" } );
    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');

    return map;

}// createEmptyMap

/**
 * Add Markers of Implementing Partners to an empty map
**/
function initMapProjects(){

    var map = createEmptyMap( 'map' );
    var markers = [];
    // implementingPartnersCoordinates comes from WP functions.php
    var coordinates = $.parseJSON( implementingPartnersCoordinates );
    $.each( coordinates, function( slug, coord ){

        // Skip if Implementing Partner doesn't have coordinates
        if( '' === coord.lat ) return true;

        var marker = createMarker( map, coord.lat, coord.lng );
        createInfoWindow( map, marker, coord.implementingPartner, coord.permalink );
        markers.push( marker );
    });
    autoCenter( map, markers );

}// initMapProjects

/**
 * Creates a new markers
 * @param GoogleMap map
 * @param float lat
 * @param float lng
 * @return Marker marker
**/
function createMarker( map, lat, lng ){

    var marker = new google.maps.Marker({
        position: new google.maps.LatLng( lat, lng ),
        map: map
    });
    return marker;

}// createMarker

/**
 * Centers the map based on the existing markers
 * @param GoogleMap map
 * @param array markers
**/
function autoCenter( map, markers ) {

    var bounds = new google.maps.LatLngBounds();
    $.each(markers, function (index, marker) { bounds.extend(marker.position); });
    map.fitBounds(bounds);
    var listener = google.maps.event.addListener(map, "idle", function() {
        if (map.getZoom() > 16) map.setZoom(16);
        google.maps.event.removeListener(listener);
    });

} // autoCenter

/**
 * Creates an InfoWindow for a given Marker
 * @param GoogleMap map
 * @param Marker marker
 * @param string title
 * @param string permalink
**/
function createInfoWindow( map, marker, title, permalink ){

    var infoWindow = new google.maps.InfoWindow({ maxWidth: 200 });
    infoWindow.setContent( '<a class="" href="' + permalink + '">' + title + '<a/>' );

    //infoWindows.push( infoWindow );

    google.maps.event.addListener( marker, 'click', function() {
        infoWindow.open( map, this );
        //styleInfoWindow();
     });

}// createInfoWindow