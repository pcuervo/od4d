<?php

/*------------------------------------*\
	CUSTOM POST TYPES
\*------------------------------------*/

add_action('add_meta_boxes', function(){
	global $post;

	switch ( $post->post_type ) {
		case 'result':
			add_meta_box( 'abstract', 'Abstract', 'metabox_abstract', 'result', 'advanced', 'high' );
			add_meta_box( 'context', 'Context', 'metabox_context', 'result', 'advanced', 'high' );
			add_meta_box( 'year_of_publication', 'Year of Publication', 'metabox_year_of_publication', 'result', 'advanced', 'high' );
			add_meta_box( 'authors', 'Authors', 'metabox_authors', 'result', 'advanced', 'high' );
			add_meta_box( 'institution', 'Institution', 'metabox_institution', 'result', 'advanced', 'high' );
			add_meta_box( 'city', 'City', 'metabox_city', 'result', 'advanced', 'high' );
			add_meta_box( 'url', 'URL', 'metabox_url', 'result', 'advanced', 'high' );
			add_meta_box( 'is_recent', 'Recent Publications', 'metabox_is_recent', 'result', 'advanced', 'high' );
		case 'implementing_partner':
			add_meta_box( 'official_website', 'Official Website Url', 'metabox_official_website', 'implementing_partner', 'advanced', 'high' );
			add_meta_box( 'rss_link', 'RSS Link', 'metabox_rss_link', 'implementing_partner', 'advanced', 'high' );
			add_meta_box( 'twitter_username', 'Twitter Username', 'metabox_twitter_username', 'implementing_partner', 'advanced', 'high' );
			add_meta_box( 'city', 'City', 'metabox_city', 'implementing_partner', 'advanced', 'high' );

		default:
			
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

function metabox_city( $post ){
	$city 		= get_post_meta($post->ID, '_city_meta', true);
	$lat 	 	= get_post_meta($post->ID, '_lat_meta', true);
	$lng 		= get_post_meta($post->ID, '_lng_meta', true);

	$city_b     = get_post_meta($post->ID, '_city_meta_b', true);
	$lat_b	 	= get_post_meta($post->ID, '_lat_meta_b', true);
	$lng_b 		= get_post_meta($post->ID, '_lng_meta_b', true);

	$city_c     = get_post_meta($post->ID, '_city_meta_c', true);
	$lat_c	 	= get_post_meta($post->ID, '_lat_meta_c', true);
	$lng_c 		= get_post_meta($post->ID, '_lng_meta_c', true);

	$city_d     = get_post_meta($post->ID, '_city_meta_d', true);
	$lat_d	 	= get_post_meta($post->ID, '_lat_meta_d', true);
	$lng_d 		= get_post_meta($post->ID, '_lng_meta_d', true);

	$city_e     = get_post_meta($post->ID, '_city_meta_e', true);
	$lat_e	 	= get_post_meta($post->ID, '_lat_meta_e', true);
	$lng_e 		= get_post_meta($post->ID, '_lng_meta_e', true);


	wp_nonce_field(__FILE__, '_city_meta_nonce');
	wp_nonce_field(__FILE__, '_lat_meta_nonce');
	wp_nonce_field(__FILE__, '_lng_meta_nonce');

	if($post->post_type == 'result'){
		echo "<label>City 1 <small>This part is powered by Google Maps to save coordinates for the map.</small></label>";
		echo "<input type='text' class='[ widefat ]' id='geo-autocomplete-a' name='_city_meta' value='$city'>";
		echo "<input type='hidden' class='[ widefat ]' id='lat-a' name='_lat_meta' value='$lat' />";
		echo "<input type='hidden' class='[ widefat ]' id='lng-a' name='_lng_meta' value='$lng' /><br><br>";

		echo "<label>City 2 <small>This part is powered by Google Maps to save coordinates for the map.</small></label>";
		echo "<input type='text' class='[ widefat ]' id='geo-autocomplete-b' name='_city_meta_b' value='$city_b'>";
		echo "<input type='hidden' class='[ widefat ]' id='lat-b' name='_lat_meta_b' value='$lat_b' />";
		echo "<input type='hidden' class='[ widefat ]' id='lng-b' name='_lng_meta_b' value='$lng_b' /><br><br>";

		echo "<label>City 3 <small>This part is powered by Google Maps to save coordinates for the map.</small></label>";
		echo "<input type='text' class='[ widefat ]' id='geo-autocomplete-c' name='_city_meta_c' value='$city_c'>";
		echo "<input type='hidden' class='[ widefat ]' id='lat-c' name='_lat_meta_c' value='$lat_c' />";
		echo "<input type='hidden' class='[ widefat ]' id='lng-c' name='_lng_meta_c' value='$lng_c' /><br><br>";

		echo "<label>City 4 <small>This part is powered by Google Maps to save coordinates for the map.</small></label>";
		echo "<input type='text' class='[ widefat ]' id='geo-autocomplete-d' name='_city_meta_d' value='$city_d'>";
		echo "<input type='hidden' class='[ widefat ]' id='lat-d' name='_lat_meta_d' value='$lat_d' />";
		echo "<input type='hidden' class='[ widefat ]' id='lng-d' name='_lng_meta_d' value='$lng_d' /><br><br>";

		echo "<label>City 5 <small>This part is powered by Google Maps to save coordinates for the map.</small></label>";
		echo "<input type='text' class='[ widefat ]' id='geo-autocomplete-e' name='_city_meta_e' value='$city_e'>";
		echo "<input type='hidden' class='[ widefat ]' id='lat-e' name='_lat_meta_e' value='$lat_e' />";
		echo "<input type='hidden' class='[ widefat ]' id='lng-e' name='_lng_meta_e' value='$lng_e' /><br><br>";
	}else{
		echo "<label><small>This part is powered by Google Maps to save coordinates for the map.</small></label>";
		echo "<input type='text' class='[ widefat ]' id='geo-autocomplete-a' name='_city_meta' value='$city'>";
		echo "<input type='hidden' class='[ widefat ]' id='lat-a' name='_lat_meta' value='$lat' />";
		echo "<input type='hidden' class='[ widefat ]' id='lng-a' name='_lng_meta' value='$lng' /><br><br>";
	}
}// metabox_city

function metabox_url( $post ){
	$url = get_post_meta($post->ID, '_url_meta', true);

	wp_nonce_field(__FILE__, '_url_meta_nonce');

	echo "<label><small>URL format: http://google.com</small></label>";
	echo "<input type='text' class='[ widefat ]' name='_url_meta' value='$url'>";
}// metabox_url

function metabox_is_recent( $post ){
	$is_recent = get_post_meta($post->ID, '_is_recent_meta', true);

	wp_nonce_field(__FILE__, '_is_recent_meta_nonce');

	$checked_recent = $is_recent == 1 ? 'checked' : '';
	echo "<input id='free' type='checkbox' class='[ widefat ]' name='_is_recent_meta' value=1 $checked_recent />";
	echo "<label for='free'>Show in Recent Publications</label><br /><br />";
}// metabox_url

function metabox_official_website( $post ){
	$official_website = get_post_meta($post->ID, '_official_website_meta', true);

	wp_nonce_field(__FILE__, '_official_website_meta_nonce');

	echo "<label><small>URL format: http://google.com</small></label>";
	echo "<input type='text' class='[ widefat ]' name='_official_website_meta' value='$official_website'>";
}// metabox_official_website

function metabox_rss_link( $post ){
	$rss_link = get_post_meta($post->ID, '_rss_link_meta', true);

	wp_nonce_field(__FILE__, '_rss_link_meta_nonce');

	echo "<label><small>URL format: http://google.com</small></label>";
	echo "<input type='text' class='[ widefat ]' name='_rss_link_meta' value='$rss_link'>";
}// metabox_rss_link

function metabox_twitter_username( $post ){
	$twitter_username = get_post_meta($post->ID, '_twitter_username_meta', true);
	$widget_id = get_post_meta($post->ID, '_widget_id_meta', true);

	wp_nonce_field(__FILE__, '_twitter_username_meta_nonce');

	echo "<label><small>Do not include '@'.</small></label>";
	echo "<input type='text' class='[ widefat ]' name='_twitter_username_meta' value='$twitter_username'>";

	echo "<label>Widget ID</label>";
	echo "<input type='text' class='[ widefat ]' name='_widget_id_meta' value='$widget_id'>";
}// metabox_twitter_username


/*
 * Save metaboxes data
 */

add_action('save_post', function( $post_id ){

	// Save metaboxes for post type Result
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
	if ( isset($_POST['_city_meta']) and check_admin_referer(__FILE__, '_city_meta_nonce') ){
		update_post_meta($post_id, '_city_meta', $_POST['_city_meta']);
	}
	if ( isset($_POST['_lat_meta']) and check_admin_referer(__FILE__, '_lat_meta_nonce') ){
		update_post_meta($post_id, '_lat_meta', $_POST['_lat_meta']);
	}
	if ( isset($_POST['_lng_meta']) and check_admin_referer(__FILE__, '_lng_meta_nonce') ){
		update_post_meta($post_id, '_lng_meta', $_POST['_lng_meta']);
	}

	if ( isset($_POST['_city_meta_b']) and check_admin_referer(__FILE__, '_city_meta_nonce') ){
		update_post_meta($post_id, '_city_meta_a', $_POST['_city_meta_a']);
		update_post_meta($post_id, '_lat_meta_a', $_POST['_lat_meta_a']);
		update_post_meta($post_id, '_lng_meta_a', $_POST['_lng_meta_a']);

		update_post_meta($post_id, '_city_meta_b', $_POST['_city_meta_b']);
		update_post_meta($post_id, '_lat_meta_b', $_POST['_lat_meta_b']);
		update_post_meta($post_id, '_lng_meta_b', $_POST['_lng_meta_b']);

		update_post_meta($post_id, '_city_meta_c', $_POST['_city_meta_c']);
		update_post_meta($post_id, '_lat_meta_c', $_POST['_lat_meta_c']);
		update_post_meta($post_id, '_lng_meta_c', $_POST['_lng_meta_c']);

		update_post_meta($post_id, '_city_meta_d', $_POST['_city_meta_d']);
		update_post_meta($post_id, '_lat_meta_d', $_POST['_lat_meta_d']);
		update_post_meta($post_id, '_lng_meta_d', $_POST['_lng_meta_d']);

		update_post_meta($post_id, '_city_meta_e', $_POST['_city_meta_e']);
		update_post_meta($post_id, '_lat_meta_e', $_POST['_lat_meta_e']);
		update_post_meta($post_id, '_lng_meta_e', $_POST['_lng_meta_e']);

	}

	// Save metaboxes for post type Implementing Partners
	if ( isset($_POST['_official_website_meta']) and check_admin_referer(__FILE__, '_official_website_meta_nonce') ){
		update_post_meta($post_id, '_official_website_meta', $_POST['_official_website_meta']);
	}
	if ( isset($_POST['_rss_link_meta']) and check_admin_referer(__FILE__, '_rss_link_meta_nonce') ){
		update_post_meta($post_id, '_rss_link_meta', $_POST['_rss_link_meta']);
	}
	if ( isset($_POST['_twitter_username_meta']) and check_admin_referer(__FILE__, '_twitter_username_meta_nonce') ){
		update_post_meta($post_id, '_twitter_username_meta', $_POST['_twitter_username_meta']);
		update_post_meta($post_id, '_widget_id_meta', $_POST['_widget_id_meta']);

	}

	if ( isset($_POST['_is_recent_meta']) and check_admin_referer( __FILE__, '_is_recent_meta_nonce') ){
		update_post_meta($post_id, '_is_recent_meta', $_POST['_is_recent_meta']);
	} else {
		update_post_meta($post_id, '_is_recent_meta', 0);
	}

});
