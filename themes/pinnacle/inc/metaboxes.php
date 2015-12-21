<?php

/*------------------------------------*\
	CUSTOM POST TYPES
\*------------------------------------*/

add_action('add_meta_boxes', function(){
	global $post;

	switch ( $post->post_name ) {
		case 'info-general':
		default:
			add_meta_box( 'abstract', 'Abstract', 'metabox_abstract', 'result', 'advanced', 'high' );
			add_meta_box( 'context', 'Context', 'metabox_context', 'result', 'advanced', 'high' );
			add_meta_box( 'year_of_publication', 'Year of Publication', 'metabox_year_of_publication', 'result', 'advanced', 'high' );
			add_meta_box( 'authors', 'Authors', 'metabox_authors', 'result', 'advanced', 'high' );
			add_meta_box( 'institution', 'Institution', 'metabox_institution', 'result', 'advanced', 'high' );
			add_meta_box( 'url', 'URL', 'metabox_url', 'result', 'advanced', 'high' );
	}
});


/*
 * Metaboxes callback functions
 */

function metabox_abstract( $post ){
	$abstract = get_post_meta($post->ID, '_abstract_meta', true);

	wp_nonce_field(__FILE__, '_abstract_meta_nonce');

	echo "<textarea type='text' class='[ widefat ]' name='_abstract_meta'>$abstract</textarea>";
}// metabox_abstract

function metabox_context( $post ){
	$context = get_post_meta($post->ID, '_context_meta', true);

	wp_nonce_field(__FILE__, '_context_meta_nonce');

	echo "<input type='text' class='[ widefat ]' name='_context_meta' value='$context'>";
}// metabox_context

function metabox_year_of_publication( $post ){
	$year_of_publication = get_post_meta($post->ID, '_year_of_publication_meta', true);

	wp_nonce_field(__FILE__, '_year_of_publication_meta_nonce');

	echo "<input type='text' class='[ widefat ]' name='_year_of_publication_meta' value='$year_of_publication'>";
}// metabox_year_of_publication

function metabox_authors( $post ){
	$authors = get_post_meta($post->ID, '_authors_meta', true);

	wp_nonce_field(__FILE__, '_authors_meta_nonce');

	echo "<label><small>Please write names of authors separated by commas. Example: William Shakespeare, Miguel de Cervantes, Sir Walter Raleigh</small></label>";
	echo "<input type='text' class='[ widefat ]' name='_authors_meta' value='$authors'>";
}// metabox_authors

function metabox_institution( $post ){
	$institution = get_post_meta($post->ID, '_institution_meta', true);

	wp_nonce_field(__FILE__, '_institution_meta_nonce');

	echo "<input type='text' class='[ widefat ]' name='_institution_meta' value='$institution'>";
}// metabox_institution

function metabox_url( $post ){
	$url = get_post_meta($post->ID, '_url_meta', true);

	wp_nonce_field(__FILE__, '_url_meta_nonce');

	echo "<input type='text' class='[ widefat ]' name='_url_meta' value='$url'>";
}// metabox_url


/*
 * Save metaboxes data
 */

add_action('save_post', function($post_id){
	if ( ! current_user_can('edit_page', $post_id))
		return $post_id;

	if ( defined('DOING_AUTOSAVE') and DOING_AUTOSAVE )
		return $post_id;

	if ( wp_is_post_revision($post_id) OR wp_is_post_autosave($post_id) )
		return $post_id;

	if ( isset($_POST['_abstract_meta']) and check_admin_referer(__FILE__, '_abstract_meta_nonce') ){
		update_post_meta($post_id, '_abstract_meta', $_POST['_abstract_meta']);
	}
	if ( isset($_POST['_context_meta']) and check_admin_referer(__FILE__, '_context_meta_nonce') ){
		update_post_meta($post_id, '_context_meta', $_POST['_context_meta']);
	}
	if ( isset($_POST['_year_of_publication_meta']) and check_admin_referer(__FILE__, '_year_of_publication_meta_nonce') ){
		update_post_meta($post_id, '_year_of_publication_meta', $_POST['_year_of_publication_meta']);
	}
	if ( isset($_POST['_authors_meta']) and check_admin_referer(__FILE__, '_authors_meta_nonce') ){
		update_post_meta($post_id, '_authors_meta', $_POST['_authors_meta']);
	}
	if ( isset($_POST['_institution_meta']) and check_admin_referer(__FILE__, '_institution_meta_nonce') ){
		update_post_meta($post_id, '_institution_meta', $_POST['_institution_meta']);
	}
	if ( isset($_POST['_url_meta']) and check_admin_referer(__FILE__, '_url_meta_nonce') ){
		update_post_meta($post_id, '_url_meta', $_POST['_url_meta']);
	}

});