<?php

/**
 * Single Post Hooks
 */
// Author Image
add_action( 'kadence_single_post_before_header', 'pinnacle_post_before_header_authorimg', 10 );
add_action( 'kadence_post_excerpt_before_header', 'pinnacle_post_before_header_authorimg', 10 );
function pinnacle_post_before_header_authorimg() {
	 global $pinnacle;
	if(isset($pinnacle['hide_author_img']) && $pinnacle['hide_author_img'] == '1') {
		get_template_part('templates/entry', 'meta-author'); 
	} 
}

add_action( 'kadence_single_post_header', 'pinnacle_post_header_title', 10 );
function pinnacle_post_header_title() {
  global $pinnacle;
  if(isset($pinnacle['single_post_title_output']) && $pinnacle['single_post_title_output'] == 'h2' ) {
    echo '<h2 class="entry-title" itemprop="name headline">';
      the_title();
    echo '</h2>';
  } else if(isset($pinnacle['single_post_title_output']) && $pinnacle['single_post_title_output'] == 'none' ) {
      // Do nothing
  } else {
	 echo '<h1 class="entry-title" itemprop="name headline">';
    	the_title();
    echo '</h1>';
  }
}

add_action( 'kadence_fulllist_post_header', 'pinnacle_post_header_title_link', 10 );
function pinnacle_post_header_title_link() {
	echo '<a href="'.get_the_permalink().'">';
    	echo '<h2 class="entry-title" itemprop="name headline">';
          		the_title();
    	echo '</h2>';
    echo '</a>';
}

add_action( 'kadence_single_post_header', 'pinnacle_post_header_meta', 20 );
add_action( 'kadence_fulllist_post_header', 'pinnacle_post_header_meta', 20 );
add_action( 'kadence_post_excerpt_header', 'pinnacle_post_header_meta', 20 );
function pinnacle_post_header_meta() {
get_template_part('templates/entry', 'meta-subhead');
}

add_action( 'kadence_single_post_footer', 'pinnacle_post_footer_meta', 10 );
add_action( 'kadence_post_excerpt_footer', 'pinnacle_post_footer_meta', 10 );
function pinnacle_post_footer_meta() {
get_template_part('templates/entry', 'meta-footer');
}

add_action( 'kadence_single_post_after', 'pinnacle_post_nav', 10 );
function pinnacle_post_nav() {
 global $pinnacle;
 if(isset($pinnacle['show_postlinks']) &&  $pinnacle['show_postlinks'] == 1) {
 	get_template_part('templates/entry', 'post-links');
 }
}

add_action( 'kadence_single_post_after', 'pinnacle_post_authorbox', 20 );
function pinnacle_post_authorbox() {
 global $pinnacle, $post;
 $authorbox = get_post_meta( $post->ID, '_kad_blog_author', true );
 if(empty($authorbox) || $authorbox == 'default') {
 	if(isset($pinnacle['post_author_default']) && ($pinnacle['post_author_default'] == 'yes')) {
 		 pinnacle_author_box(); 
 	}
 } else if($authorbox == 'yes'){
 	pinnacle_author_box(); 
 }
}

add_action( 'kadence_single_post_after', 'pinnacle_post_bottom_carousel', 30 );
function pinnacle_post_bottom_carousel() {
 global $pinnacle, $post;
	$blog_carousel_recent = get_post_meta( $post->ID, '_kad_blog_carousel_similar', true ); 
     
    if(empty($blog_carousel_recent) || $blog_carousel_recent == 'default' ) { 
        if(isset($pinnacle['post_carousel_default'])) {
        	$blog_carousel_recent = $pinnacle['post_carousel_default'];
        }
    }
    if ($blog_carousel_recent == 'similar') {
    	get_template_part('templates/similarblog', 'carousel'); 
    } else if( $blog_carousel_recent == 'recent') {
    	get_template_part('templates/recentblog', 'carousel');
    }
}

add_action( 'kadence_single_post_after', 'pinnacle_post_comments', 40 );
function pinnacle_post_comments() {
	comments_template('/templates/comments.php');
}

function kt_get_post_head_content() {
	global $post, $pinnacle;
	if ( has_post_format( 'video' )) {
              // Get Post Head settings
              $headcontent = get_post_meta( $post->ID, '_kad_video_blog_head', true );
              if(empty($headcontent) || $headcontent == 'default') {
                  if(!empty($pinnacle['video_post_blog_default'])) {
                            $headcontent = $pinnacle['video_post_blog_default'];
                    } else {
                              $headcontent = 'video';
                    }
              }
              
            } else if (has_post_format( 'gallery' )) {
              $headcontent = get_post_meta( $post->ID, '_kad_gallery_blog_head', true );
              if(empty($headcontent) || $headcontent == 'default') {
                  if(!empty($pinnacle['gallery_post_blog_default'])) {
                          $headcontent = $pinnacle['gallery_post_blog_default'];
                    } else {
                          $headcontent = 'carouselslider';
                    }
              }

            } elseif (has_post_format( 'image' )) {
               $headcontent = get_post_meta( $post->ID, '_kad_image_blog_head', true );
              if(empty($headcontent) || $headcontent == 'default') {
                  if(!empty($pinnacle['image_post_blog_default'])) {
                          $headcontent = $pinnacle['image_post_blog_default'];
                    } else {
                          $headcontent = 'image';
                    }
              }

            } else {
                  $headcontent = 'none';
            }
            return $headcontent;
        }