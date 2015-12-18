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

});