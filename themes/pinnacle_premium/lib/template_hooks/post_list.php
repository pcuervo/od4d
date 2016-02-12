<?php

/**
 *  Post list Hooks
 */
add_action( 'kadence_post_excerpt_header', 'pinnacle_post_excerpt_header_title', 10 );
function pinnacle_post_excerpt_header_title() {
	echo '<a href="'.get_the_permalink().'">';
    	echo '<h3 class="entry-title" itemprop="name headline">';
          		the_title();
    	echo '</h3>';
    echo '</a>';
}

function kt_get_postsummary() {
	global $post;
	if ( has_post_format( 'video' )) {
              $postsummery = get_post_meta( $post->ID, '_kad_video_post_summery', true );
              if(empty($postsummery) || $postsummery == 'default') {
                  if(!empty($pinnacle['video_post_summery_default'])) {
                            $postsummery = $pinnacle['video_post_summery_default'];
                    } else {
                              $postsummery = 'video';
                    }
              }
              
            } else if (has_post_format( 'gallery' )) {
              $postsummery = get_post_meta( $post->ID, '_kad_gallery_post_summery', true );
              if(empty($postsummery) || $postsummery == 'default') {
                  if(!empty($pinnacle['gallery_post_summery_default'])) {
                          $postsummery = $pinnacle['gallery_post_summery_default'];
                    } else {
                          $postsummery = 'slider_landscape';
                    }
              }

            } elseif (has_post_format( 'image' )) {
               $postsummery = get_post_meta( $post->ID, '_kad_image_post_summery', true );
              if(empty($postsummery) || $postsummery == 'default') {
                  if(!empty($pinnacle['image_post_summery_default'])) {
                          $postsummery = $pinnacle['image_post_summery_default'];
                    } else {
                          $postsummery = 'img_portrait';
                    }
              }

            } else {
              $postsummery = get_post_meta( $post->ID, '_kad_post_summery', true );
              if(empty($postsummery) || $postsummery == 'default') {
                  if(!empty($pinnacle['post_summery_default'])) {
                      $postsummery = $pinnacle['post_summery_default'];
                  } else {
                    $postsummery = 'img_landscape';
                  }
                }
            }

            return $postsummery;
}