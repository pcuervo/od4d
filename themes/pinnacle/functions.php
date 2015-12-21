<?php
function pinnacle_lang_setup() {
load_theme_textdomain('pinnacle', get_template_directory() . '/languages');
}
add_action( 'after_setup_theme', 'pinnacle_lang_setup' );

/*
 * Init Customizer Options
 */
require_once locate_template('/themeoptions/redux/framework.php');          			// Customizer framework
require_once locate_template('/themeoptions/theme_options.php');          				// Customizer framework
require_once locate_template('/themeoptions/options_assets/pinnacle_extension.php'); 	// Customizer framework

/*
 * Init Theme Startup/Core utilities
 */
require_once locate_template('/lib/utils.php');           								// Utility functions
require_once locate_template('/lib/init.php');            								// Initial theme setup and constants
require_once locate_template('/lib/aq_resizer.php');      								// Resize on the fly
require_once locate_template('/lib/sidebar.php');         								// Sidebar class
require_once locate_template('/lib/config.php');          								// Configuration
require_once locate_template('/lib/cleanup.php');        								// Cleanup
require_once locate_template('/lib/nav.php');            								// Custom nav modifications
require_once locate_template('/lib/custom.php');          								// Custom functions
require_once locate_template('/lib/metaboxes.php');     								// Custom metaboxes
require_once locate_template('/lib/plugin-activate.php');   							// Plugin Activation

/*
 * Init Widget areas
 */
require_once locate_template('/lib/widgets.php');         								// Sidebars and widgets

/*
 * Template Hooks
 */
require_once locate_template('/lib/comments.php');        								// Custom comments modifications
require_once locate_template('/lib/authorbox.php');         							// Author box
require_once locate_template('/lib/custom-woocommerce.php'); 							// Woocommerce functions
require_once locate_template('/lib/template-actions.php');         					    // Template actions

/*
 * Load Scripts
 */
require_once locate_template('/lib/admin_scripts.php');    								// Admin Scripts functions
require_once locate_template('/lib/scripts.php');        								// Scripts and stylesheets
require_once locate_template('/lib/output_css.php'); 									// Fontend Custom CSS


/*
 * Cuervo functions start here bruh!
 */

define( 'JSPATH', get_template_directory_uri() . '/assets/js/' );

/*------------------------------------*\
	#INCLUDES
\*------------------------------------*/

include( 'inc/cuztom/cuztom.php' );
require_once( 'inc/custom-post-types.php' );
require_once( 'inc/metaboxes.php' );
require_once( 'inc/functions-js-footer.php' );



/*------------------------------------*\
	#GENERAL FUNCTIONS
\*------------------------------------*/

add_theme_support('post-thumbnails');

/**
* Enqueue frontend scripts and styles
**/
add_action( 'wp_enqueue_scripts', function(){

	// scripts
	wp_enqueue_script( 'plugins', JSPATH.'plugins.js', array('jquery'), '1.0', true );
	wp_enqueue_script( 'functions', JSPATH.'functions.js', array('plugins'), '1.0', true );

});

/**
* Add javascript to the footer of pages.
**/
add_action( 'wp_footer', 'footer_scripts', 21 );

/**
 * Show filters
 * @param $taxonomy
*/
function show_filters( $taxonomy ){

	$args = array(
	    'orderby'                => 'name',
	    'hide_empty'             => true,
	); 
	$filters = get_terms( $taxonomy, $args );
	if( empty( $filters ) ) return;

	echo '<ul class="[ button-group ]" data-filter-group="' . $taxonomy . '">';
	echo '<li><a class="[ btn ]" href="#" data-filter="">All</a></li>';
	foreach ( $filters as $filter ) {
		echo '<li><a class="[ btn ]" href="#" data-filter=".' . $filter->slug . '">' . $filter->name . '</a></li>';
	}
	echo '</ul>';
}


/*------------------------------------*\
	#SET/GET FUNCTIONS
\*------------------------------------*/

/**
 * Get result info for filters.
 * @param integer $post_id
 * @return mixed $brand_info
 */
function get_result_filter_info( $post_id ){

	$result_info = array(
		'region'				=> get_result_slug( $post_id, 'region' ),
		'area'					=> get_result_slug( $post_id, 'focus_areas_of_impact' ),
		'sector'				=> get_result_slug( $post_id, 'sector' ),
		'publication_type'		=> get_result_slug( $post_id, 'publication_type' ),
		'implementing_partner'	=> get_result_slug( $post_id, 'implementing_partner' ),
		);
	return $result_info;
}// get_result_filter_info

/**
 * Get region slug for a given result.
 * @param integer $post_id
 * @param string $taxonomy
 * @return string $slug
 */
function get_result_slug( $post_id, $taxonomy ){
	$term = wp_get_post_terms( $post_id, $taxonomy );
	$slug = empty( $term ) ? '' : $term[0]->slug;
	return $slug;
}// get_result_slug

function get_abstract( $post_id ){
	return get_post_meta( $post_id, '_abstract_meta', true );
}


/*------------------------------------*\
	#HELPER FUNCTIONS
\*------------------------------------*/


/*------------------------------------*\
	#FORMAT FUNCTIONS
\*------------------------------------*/

/*------------------------------------*\
	#AJAX FUNCTIONS
\*------------------------------------*/


