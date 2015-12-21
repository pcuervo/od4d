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

    // change is-checked class on buttons
    $('.button-group').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'a', function() {
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