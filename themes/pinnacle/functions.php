<?php

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

/*------------------------------------*\
	#CONSTANTS
\*------------------------------------*/

/**
* Define paths to javascript, styles, theme and site.
**/
define( 'JSPATH', get_template_directory_uri() . '/assets/js/' );
define( 'THEMEPATH', get_template_directory_uri() . '/' );
define( 'SITEURL', site_url('/') );

/*------------------------------------*\
	#INCLUDES
\*------------------------------------*/

include( 'inc/cuztom/cuztom.php' );
require_once( 'inc/custom-post-types.php' );
require_once( 'inc/metaboxes.php' );
require_once( 'inc/functions-js-footer.php' );
require_once( 'inc/functions-js-footer-admin.php' );



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
	wp_localize_script( 'functions', 'implementingPartnersCoordinates', get_implementing_partners_coordinates() );

});
/**
* Enqueue admin scripts and styles.
**/
add_action( 'admin_enqueue_scripts', function(){

	// scripts
	wp_enqueue_script( 'gmaps', JSPATH.'gmaps.min.js', array('jquery'), '1.0' );
	wp_enqueue_script( 'geo-autocomplete', JSPATH.'geocomplete.min.js', array('gmaps'), '1.0' );

});

/**
* Add javascript to the footer of pages and admin.
**/
add_action( 'wp_footer', 'footer_scripts', 21 );
add_action( 'admin_footer', 'footer_admin_scripts', 22 );

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

	echo '<div class="[ button-group ]" data-filter-group="' . $taxonomy . '">';
	echo '<a class="[ kad-btn kad-btn-small kad-btn-border-primary ]" href="#" data-filter="">All</a>';
	foreach ( $filters as $filter ) {
		echo '<a class="[ kad-btn kad-btn-small kad-btn-border-primary ]" href="#" data-filter=".' . $filter->slug . '">' . $filter->name . '</a>';
	}
	echo '</div>';
}

/*
 * Insert dynamic taxonomy terms after a post has been created/saved.
 */
function update_dynamic_taxonomies( $post_id ){
	global $post;

	if( ! isset( $post ) ) return; 

	if( 'implementing_partner' == $post->post_type )

		insert_implementing_partner_taxonomy_term( $post->post_title );

}// update_dynamic_taxonomies
add_action( 'save_post', 'update_dynamic_taxonomies' );

function insert_implementing_partner_taxonomy_term( $implementing_partner ){

	$term = term_exists( $implementing_partner, 'implementing_partner' );
	if ($term !== 0 && $term !== null) return;

	wp_insert_term( $implementing_partner, 'implementing_partner' );
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

/**
 * Get meta from post type Results
 * @param integer $post_id
 * @param string $meta_field
 * @return string $meta
 */
function get_result_meta( $post_id, $meta_field ){
	return get_post_meta( $post_id, $meta_field, true );
}// get_result_meta

/**
 * Get name of implementing partner for a given result
 * @param integer $post_id
 * @return string $implementing_partner
 */
function get_implementing_partner( $post_id ){
	
	$terms = wp_get_post_terms( $post_id, 'implementing_partner' );

	if( empty( $terms ) ) return '';

	return $terms[0]->name;

}// get_implementing_partner

/**
 * Get name of implementing partner for a given result
 * @param integer $post_id
 * @return string $sector
 */
function get_sector( $post_id ){
	
	$terms = wp_get_post_terms( $post_id, 'sector' );

	if( empty( $terms ) ) return '';

	return $terms[0]->name;

}// get_sector

/**
 * Get name of implementing partner for a given result
 * @param integer $post_id
 * @return string $region
 */
function get_region( $post_id ){
	
	$terms = wp_get_post_terms( $post_id, 'region' );

	if( empty( $terms ) ) return '';

	return $terms[0]->name;

}// get_region

/**
 * Get name of implementing partner for a given result
 * @param integer $post_id
 * @return string $focus_areas_of_impact
 */
function get_focus_areas_of_impact( $post_id ){
	
	$terms = wp_get_post_terms( $post_id, 'focus_areas_of_impact' );

	if( empty( $terms ) ) return '';

	return $terms[0]->name;

}// get_focus_areas_of_impact

/**
 * Extracts latitude and longitude from
 * Implementing Partners' posts
 * @return JSON $ip_coordinates
 */
function get_implementing_partners_coordinates(){

	$ip_coordinates = array();
	$args_implementing_partners = array(
		'post_type' 		=> 'result',
		'posts_per_page' 	=> -1
	);

	$query_implementing_partners = new WP_Query( $args_implementing_partners );
	if ( $query_implementing_partners->have_posts() ) : while ( $query_implementing_partners->have_posts() ) : $query_implementing_partners->the_post();
		global $post;

		$lat = get_lat( $post->ID );
		$lng = get_lng( $post->ID );
		$ip_coordinates[$post->post_name] = array(
			'lat'					=> $lat,
			'lng'					=> $lng,
			'permalink'				=> get_permalink( $post->ID ),
			'implementingPartner'	=> get_the_title(),
			);

	endwhile; endif; wp_reset_query();

	return json_encode( $ip_coordinates );

}// get_implementing_partners_coordinates

/**
 * Get latitude from project (Result)
 * @param int $post_id
 * @return int $lat
 */
function get_lat( $post_id ){
	return get_post_meta( $post_id, '_lat_meta', true );
}// get_lat

/**
 * Get longitude from project (Result)
 * @param int $post_id
 * @return int $lng
 */
function get_lng( $post_id ){
	return get_post_meta( $post_id, '_lng_meta', true );
}// get_lng

/**
 * Get related projects (Results) based on Implementing Partner
 * Region or Sector
 * @param string $implementing_partner
 * @param string $region
 * @param string $sector
 * @param string $num_posts
 * @return mixed $related_projects
 */
function get_related_projects( $implementing_partner, $region, $sector, $num_posts ){

	global $post;
	$related_projects = array();
	$projects_args = array(
		'post_type' 		=> 'result',
		'posts_per_page' 	=> $num_posts,
		'orderby'			=> 'rand',
		'tax_query' => array(
			'relation'	=> 'OR',
			array(
				'taxonomy' => 'implementing_partner',
				'field'    => 'name',
				'terms'    => array( $implementing_partner ),
			),
			array(
				'taxonomy' => 'region',
				'field'    => 'name',
				'terms'    => array( $region ),
			),
		),
	);
	$query_projects = new WP_Query( $projects_args );

	if ( $query_projects->have_posts() ) : while( $query_projects->have_posts() ) : $query_projects->the_post();
		$img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); 
		$related_projects[$post->post_title] = array(
			'img_url'	=> $img_url[0],
			'permalink'	=> get_permalink( $post->ID ),
			);
	endwhile; endif; wp_reset_query();

	return $related_projects;

}// get_related_projects

/**
 * Get latest projects (Results) 
 * @param string $num_posts
 * @return mixed $latest_projects
 */
function get_latest_projects( $num_posts ){

	global $post;
	$latest_projects = array();
	$projects_args = array(
		'post_type' 		=> 'result',
		'posts_per_page' 	=> $num_posts
	);
	$query_projects = new WP_Query( $projects_args );
	if ( $query_projects->have_posts() ) : while( $query_projects->have_posts() ) : $query_projects->the_post();
		$img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); 
		$latest_projects[$post->post_title] = array(
			'img_url'	=> $img_url[0],
			'permalink'	=> get_permalink( $post->ID ),
			);
	endwhile; endif; wp_reset_query();

	return $latest_projects;

}// get_latest_projects


/*------------------------------------*\
	#HELPER FUNCTIONS
\*------------------------------------*/


/*------------------------------------*\
	#FORMAT FUNCTIONS
\*------------------------------------*/

/*------------------------------------*\
	#AJAX FUNCTIONS
\*------------------------------------*/





