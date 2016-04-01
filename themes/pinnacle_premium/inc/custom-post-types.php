<?php

/*------------------------------------*\
	CUSTOM POST TYPES
\*------------------------------------*/

add_action('init', function(){

	// RESULTS
	$results_pt = register_cuztom_post_type( 'Result' );
	// Add taxonomies
	$results_pt->add_taxonomy( 'Region' );
	insert_region_taxonomy_terms();
	$results_pt->add_taxonomy( 'Implementing Partner' );
	insert_implementing_partner_taxonomy_terms();
	$results_pt->add_taxonomy( 'Focus / Areas of Impact' );	
	insert_focus_area_impact_taxonomy_terms();
	$results_pt->add_taxonomy( 'Sector' );	
	insert_sector_taxonomy_terms();
	$results_pt->add_taxonomy( 'Publication Type' );	
	insert_publication_type_taxonomy_terms();
	$results_pt->add_taxonomy( 'Proyecto' );	


	// IMPLEMENTING PARTNERS
	$implementin_partners_pt = register_cuztom_post_type( 'Implementing Partner' );

	$implementin_partners_pt = register_cuztom_post_type( 'Proyecto' );

});

/*
 * Insert region taxonomy terms
 */
function insert_region_taxonomy_terms(){
	$regions = array( 'Global Initiatives', 'Africa', 'Asia', 'Eastern Europe & Central Asia', 'Caribbean', 'Latin America' );
	foreach ( $regions as $region ) {
		$term = term_exists( $region, 'region' );
		if ( FALSE !== $term && NULL !== $term ) continue;

		wp_insert_term( $region, 'region' );
	}
}// insert_region_taxonomy_terms

/*
 * Insert region taxonomy terms
 */
function insert_implementing_partner_taxonomy_terms(){
	// $regions = array( 'Global Initiatives', 'Africa', 'Asia', 'Eastern Europe & Central Asia', 'Caribbean', 'Latin America' );
	// foreach ( $regions as $region ) {
	// 	$term = term_exists( $region, 'region' );
	// 	if ( FALSE !== $term && NULL !== $term ) continue;

	// 	wp_insert_term( $region, 'region' );
	// }
}// insert_implementing_partner_taxonomy_terms

/*
 * Insert region taxonomy terms
 */
function insert_focus_area_impact_taxonomy_terms(){
	$areas = array( 'Standards', 'Capacity building', 'Research', 'Innovation', 'Policy' );
	foreach ( $areas as $area ) {
		$term = term_exists( $area, 'focus_areas_of_impact' );
		if ( FALSE !== $term && NULL !== $term ) continue;

		wp_insert_term( $area, 'focus_areas_of_impact' );
	}
}// insert_focus_area_impact_taxonomy_terms

/*
 * Insert sector taxonomy terms
 */
function insert_sector_taxonomy_terms(){
	$sectors = array( 'Statistics', 'Agriculture', 'Cities', 'Health', 'Governance' );
	foreach ( $sectors as $sector ) {
		$term = term_exists( $sector, 'sector' );
		if ( FALSE !== $term && NULL !== $term ) continue;

		wp_insert_term( $sector, 'sector' );
	}
}// insert_sector_taxonomy_terms

/*
 * Insert sector taxonomy terms
 */
function insert_publication_type_taxonomy_terms(){
	// $sectors = array( 'Statistics', 'Agriculture', 'Cities', 'Health', 'Governance' );
	// foreach ( $sectors as $sector ) {
	// 	$term = term_exists( $sector, 'sector' );
	// 	if ( FALSE !== $term && NULL !== $term ) continue;

	// 	wp_insert_term( $sector, 'sector' );
	// }
}// insert_publication_type_taxonomy_terms


function create_terms_proyecto( $post_id, $post ) {

	if ($post->post_type != 'proyecto' )
		return '';

	if ($post->post_status == 'trash') {
		$category = get_term_by('slug', $post->post_name, 'proyecto');
		wp_delete_term( $category->term_id, 'proyecto' );
		return '';
	}

	$term_name = trim($post->post_title);

	if ( ! term_exists( $post->post_name, 'proyecto' ) ){
		wp_insert_term( $term_name, 'proyecto', array('slug' => $post->post_name) );
	}

}
add_action( 'wp_insert_post', 'create_terms_proyecto', 10, 3 );




