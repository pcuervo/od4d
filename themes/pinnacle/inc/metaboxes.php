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
			//add_meta_box( 'year_of_publication', 'Year of Publication', 'metabox_year_of_publication', 'result', 'advanced', 'high' );
			add_meta_box( 'authors', 'Authors', 'metabox_authors', 'result', 'advanced', 'high' );
			add_meta_box( 'institution', 'Institution', 'metabox_institution', 'result', 'advanced', 'high' );
			add_meta_box( 'city', 'Cities', 'metabox_city', 'result', 'advanced', 'high' );
			add_meta_box( 'url', 'URL', 'metabox_url', 'result', 'advanced', 'high' );
		case 'implementing_partner':
			add_meta_box( 'official_website', 'Official Website Url', 'metabox_official_website', 'implementing_partner', 'advanced', 'high' );
			add_meta_box( 'rss_link', 'RSS Link', 'metabox_rss_link', 'implementing_partner', 'advanced', 'high' );
			add_meta_box( 'twitter_username', 'Twitter Username', 'metabox_twitter_username', 'implementing_partner', 'advanced', 'high' );
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
	$city2 		= get_post_meta($post->ID, '_city2_meta', true);
	$city3 		= get_post_meta($post->ID, '_city3_meta', true);
	$city4 		= get_post_meta($post->ID, '_city4_meta', true);
	$city5 		= get_post_meta($post->ID, '_city5_meta', true);
	$lat 	 	= get_post_meta($post->ID, '_lat_meta', true);
	$lng 		= get_post_meta($post->ID, '_lng_meta', true);
	$lat2 	 	= get_post_meta($post->ID, '_lat2_meta', true);
	$lng2 		= get_post_meta($post->ID, '_lng2_meta', true);
	$lat3 	 	= get_post_meta($post->ID, '_lat3_meta', true);
	$lng3 		= get_post_meta($post->ID, '_lng3_meta', true);
	$lat4 	 	= get_post_meta($post->ID, '_lat4_meta', true);
	$lng4 		= get_post_meta($post->ID, '_lng4_meta', true);
	$lat5 	 	= get_post_meta($post->ID, '_lat5_meta', true);
	$lng5 		= get_post_meta($post->ID, '_lng5_meta', true);

	wp_nonce_field(__FILE__, '_city_meta_nonce');
	wp_nonce_field(__FILE__, '_city2_meta_nonce');
	wp_nonce_field(__FILE__, '_city3_meta_nonce');
	wp_nonce_field(__FILE__, '_city4_meta_nonce');
	wp_nonce_field(__FILE__, '_city5_meta_nonce');
	wp_nonce_field(__FILE__, '_lat_meta_nonce');
	wp_nonce_field(__FILE__, '_lng_meta_nonce');
	wp_nonce_field(__FILE__, '_lat2_meta_nonce');
	wp_nonce_field(__FILE__, '_lng2_meta_nonce');
	wp_nonce_field(__FILE__, '_lat3_meta_nonce');
	wp_nonce_field(__FILE__, '_lng3_meta_nonce');
	wp_nonce_field(__FILE__, '_lat4_meta_nonce');
	wp_nonce_field(__FILE__, '_lng4_meta_nonce');
	wp_nonce_field(__FILE__, '_lat5_meta_nonce');
	wp_nonce_field(__FILE__, '_lng5_meta_nonce');

	echo "<label><small>City 1</small></label>";
	echo "<div class='details'>";
	echo "<input type='text' class='[ widefat ]' id='geo-autocomplete' name='_city_meta' value='$city'>";
	echo "<input type='text' class='[ widefat ]' id='lat' name='_lat_meta' value='$lat' data-geo='lat' />";
	echo "<input type='text' class='[ widefat ]' id='lng' name='_lng_meta' value='$lng' data-geo='lng' />";
	echo "</div>";

	echo "<label><small>City 2</small></label>";
	echo "<div class='details'>";
	echo "<input type='text' class='[ widefat ]' id='geo-autocomplete-2' name='_city2_meta' value='$city2'>";
	echo "<input type='text' class='[ widefat ]' id='lat2' name='_lat2_meta' value='$lat2' data-geo='lat2' />";
	echo "<input type='text' class='[ widefat ]' id='lng2' name='_lng2_meta' value='$lng2' data-geo='lng2' />";
	echo "</div>";

	// echo "<label><small>City 3</small></label>";
	// echo "<input type='text' class='[ widefat ]' id='geo-autocomplete-3' name='_city3_meta' value='$city3'>";
	// echo "<input type='text' class='[ widefat ]' id='lat3' name='_lat3_meta' value='$lat3' data-geo='lat3' />";
	// echo "<input type='text' class='[ widefat ]' id='lng3' name='_lng3_meta' value='$lng3' data-geo='lng3' />";

	// echo "<label><small>City 4</small></label>";
	// echo "<input type='text' class='[ widefat ]' id='geo-autocomplete-4' name='_city4_meta' value='$city4'>";
	// echo "<input type='hidden' class='[ widefat ]' id='lat4' name='_lat4_meta' value='$lat4' data-geo='lat4' />";
	// echo "<input type='hidden' class='[ widefat ]' id='lng4' name='_lng4_meta' value='$lng4' data-geo='lng4' />";

	// echo "<label><small>City 5</small></label>";
	// echo "<input type='text' class='[ widefat ]' id='geo-autocomplete-5' name='_city5_meta' value='$city5'>";
	// echo "<input type='hidden' class='[ widefat ]' id='lat5' name='_lat5_meta' value='$lat5' data-geo='lat5' />";
	// echo "<input type='hidden' class='[ widefat ]' id='lng5' name='_lng5_meta' value='$lng5' data-geo='lng5' />";
}// metabox_city

function metabox_url( $post ){
	$url = get_post_meta($post->ID, '_url_meta', true);

	wp_nonce_field(__FILE__, '_url_meta_nonce');

	echo "<label><small>URL format: http://google.com</small></label>";
	echo "<input type='text' class='[ widefat ]' name='_url_meta' value='$url'>";
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

	wp_nonce_field(__FILE__, '_twitter_username_meta_nonce');

	echo "<label><small>Do not include '@'.</small></label>";
	echo "<input type='text' class='[ widefat ]' name='_twitter_username_meta' value='$twitter_username'>";
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
	if ( isset($_POST['_city2_meta']) and check_admin_referer(__FILE__, '_city2_meta_nonce') ){
		update_post_meta($post_id, '_city2_meta', $_POST['_city2_meta']);
	}
	if ( isset($_POST['_city3_meta']) and check_admin_referer(__FILE__, '_city3_meta_nonce') ){
		update_post_meta($post_id, '_city3_meta', $_POST['_city3_meta']);
	}
	if ( isset($_POST['_city4_meta']) and check_admin_referer(__FILE__, '_city4_meta_nonce') ){
		update_post_meta($post_id, '_city4_meta', $_POST['_city4_meta']);
	}
	if ( isset($_POST['_city5_meta']) and check_admin_referer(__FILE__, '_city5_meta_nonce') ){
		update_post_meta($post_id, '_city5_meta', $_POST['_city5_meta']);
	}
	if ( isset($_POST['_lat_meta']) and check_admin_referer(__FILE__, '_lat_meta_nonce') ){
		update_post_meta($post_id, '_lat_meta', $_POST['_lat_meta']);
	}
	if ( isset($_POST['_lng_meta']) and check_admin_referer(__FILE__, '_lng_meta_nonce') ){
		update_post_meta($post_id, '_lng_meta', $_POST['_lng_meta']);
	}
	if ( isset($_POST['_lat2_meta']) and check_admin_referer(__FILE__, '_lat2_meta_nonce') ){
		update_post_meta($post_id, '_lat2_meta', $_POST['_lat2_meta']);
	}
	if ( isset($_POST['_lng2_meta']) and check_admin_referer(__FILE__, '_lng2_meta_nonce') ){
		update_post_meta($post_id, '_lng2_meta', $_POST['_lng2_meta']);
	}
	if ( isset($_POST['_lat3_meta']) and check_admin_referer(__FILE__, '_lat3_meta_nonce') ){
		update_post_meta($post_id, '_lat3_meta', $_POST['_lat3_meta']);
	}
	if ( isset($_POST['_lng3_meta']) and check_admin_referer(__FILE__, '_lng3_meta_nonce') ){
		update_post_meta($post_id, '_lng3_meta', $_POST['_lng3_meta']);
	}
	if ( isset($_POST['_lat4_meta']) and check_admin_referer(__FILE__, '_lat4_meta_nonce') ){
		update_post_meta($post_id, '_lat4_meta', $_POST['_lat4_meta']);
	}
	if ( isset($_POST['_lng4_meta']) and check_admin_referer(__FILE__, '_lng4_meta_nonce') ){
		update_post_meta($post_id, '_lng4_meta', $_POST['_lng4_meta']);
	}
	if ( isset($_POST['_lat5_meta']) and check_admin_referer(__FILE__, '_lat5_meta_nonce') ){
		update_post_meta($post_id, '_lat5_meta', $_POST['_lat5_meta']);
	}
	if ( isset($_POST['_lng5_meta']) and check_admin_referer(__FILE__, '_lng5_meta_nonce') ){
		update_post_meta($post_id, '_lng5_meta', $_POST['_lng5_meta']);
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
	}

});
