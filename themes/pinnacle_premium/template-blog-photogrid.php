<?php
/*
Template Name: Blog PhotoGrid
*/
?>
	<?php get_header(); ?>
			<?php get_template_part('templates/page', 'header'); ?>
	
   			<?php global $post, $pinnacle;
   			if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;} 
   			if(isset($pinnacle['blog_infinitescroll']) && $pinnacle['blog_infinitescroll'] == 1) {$infinitescroll = true;} else {$infinitescroll = false;}
   			$blog_grid_column = get_post_meta( $post->ID, '_kad_blog_columns', true );
   			$blog_grid_fullwidth = get_post_meta( $post->ID, '_kad_blog_photofullwidth', true );
   			if(!kadence_display_sidebar() && $blog_grid_fullwidth == 'yes') {
					$blog_fullwidth = true;
   			} else {
   				$blog_fullwidth = false;
   			}
   			if(isset($pinnacle['postexcerpt_hard_crop']) && $pinnacle['postexcerpt_hard_crop'] == 1) {
              $hardcrop = true;
            } else {
              $hardcrop = false;
            }
   			if ($blog_fullwidth) { 
	   			if ($blog_grid_column == '2') {
	   				$itemsize = 'tcol-sxl-3 tcol-xl-4 tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12';
	   				$postcolumn = '2';
	   				$image_width = 700;
	   				$image_height = 460;
	   				$titletag = "h4";
	   			} else if ($blog_grid_column == '3'){
			    	$itemsize = 'tcol-sxl-25 tcol-xl-3 tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12';
			    	$postcolumn = '3';
			    	$image_width = 460;
			    	$image_height = 300;
			    	$titletag = "h5";
			    } else {
			    	$itemsize = 'tcol-sxl-2 tcol-xl-25 tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12';
			    	$image_width = 360;
			    	$image_height = 240;
			    	$titletag = "h5";
			   	}
			    $contentclass = "kad-fullwidth";
			} else {
		    	if ($blog_grid_column == '2') {
		    		$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12';
		    		$postcolumn = '2'; 
		    		$image_width = 560;
		    		$image_height = 370;
		    		$titletag = "h4";
		    	} else if ($blog_grid_column == '3'){ 
		    		$itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; 
		    		$postcolumn = '3';
		    		$image_width = 380;
		    		$image_height = 250;
		    		$titletag = "h5";
		    	} else {
		    		$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12';
		    		$image_width = 340;
		    		$image_height = 225;
		    		$titletag = "h5";
		    	}
			    $contentclass = "";
		    }
      		$blog_category = get_post_meta( $post->ID, '_kad_blog_cat', true ); 
					$blog_cat= get_term_by ('id',$blog_category,'category');
					if($blog_category == '-1' || $blog_category == '') {
      					$blog_cat_slug = '';
					} else {
					$blog_cat = get_term_by ('id',$blog_category,'category');
					$blog_cat_slug = $blog_cat -> slug;
					}
					$blog_items = get_post_meta( $post->ID, '_kad_blog_items', true ); 
					if($blog_items == 'all') {$blog_items = '-1';} 
					?>
	<div id="content" class="container <?php echo $contentclass;?>">
   	  <div class="row">
      <div class="main <?php echo kadence_main_class();?>" role="main">
      	<div class="entry-content" itemprop="mainContentOfPage">
					<?php get_template_part('templates/content', 'page'); ?>
      	</div>
      	<div id="kad-blog-photo-grid" class="rowtight init-isotope" data-fade-in="<?php echo esc_attr($animate);?>"  data-iso-selector=".b_item" data-iso-style="masonry" data-iso-filter="false">
      		<?php   $temp = $wp_query; 
					$wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query(array(
						'paged' => $paged,
						'category_name'=>$blog_cat_slug,
						'posts_per_page' => $blog_items));
					$count =0;
					if ( $wp_query ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
						?>
						<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
                            <div id="post-<?php the_ID(); ?>" class="blog_item postclass kt_item_fade_in kad_blog_fade_in grid_item" style="max-width:<?php echo esc_attr($image_width);?>px">
                            <?php if(has_post_thumbnail( $post->ID )) {
                                $image_url = wp_get_attachment_image_src( 
                                get_post_thumbnail_id( $post->ID ), 'full' ); 
                                $thumbnailURL = $image_url[0];
                                if($hardcrop) {
                                    $image = aq_resize($thumbnailURL, $image_width, $image_height, true);
                                } else {
                                	$image = aq_resize($thumbnailURL, $image_width, false);
                                }
                                if(empty($image)) { $image = $thumbnailURL; }
                             } else {
                                   $thumbnailURL = pinnacle_post_default_placeholder();
                                if($hardcrop) {
                                    $image = aq_resize($thumbnailURL, $image_width, $image_height, true);
                                } else {
                                  $image = aq_resize($thumbnailURL, $image_width, false);
                              	}
                                  if(empty($image)) { $image = $thumbnailURL; } 
                                   } ?>
                                  <div class="imghoverclass img-margin-center">
                                    <a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
                                      <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" <?php if($hardcrop) {echo 'width="'.esc_attr($image_width).'" height="'.esc_attr($image_height).'"';}?> class="iconhover" style="display:block;">
                                    </a> 
                                  </div>
                              <?php $image = null; $thumbnailURL = null;   ?>
		                      	<div class="photo-postcontent">
		                          <header>
		                              <a href="<?php the_permalink() ?>"><?php echo '<'.$titletag.' class="entry-title">';  the_title(); echo '</'.$titletag.'>'; ?></a>
		                               <?php get_template_part('templates/entry', 'meta-subhead'); ?>
		                          </header>
		                        </div><!-- Text size -->
	              			</div> <!-- Blog Item -->
						</div>
						<?php 
                    endwhile; else: ?>
						<li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'pinnacle'); ?></li>
					<?php endif; ?>
                

                </div> <!-- Blog Grid -->
				<?php if ($wp_query->max_num_pages > 1) : ?>
        			<?php kad_wp_pagenavi(); ?>   
				<?php endif; ?>
				<?php $wp_query = null; $wp_query = $temp;  // Reset ?>
				<?php wp_reset_query(); ?>
				<?php if ($infinitescroll) { ?>
	<script type="text/javascript">
	jQuery(document).ready(function ($) {
		var $container = $('#kad-blog-photo-grid');
$('#kad-blog-photo-grid').infinitescroll({
    nextSelector: ".wp-pagenavi a.next",
    navSelector: ".wp-pagenavi",
    itemSelector: ".kad_blog_item",
    loading: {
    		msgText: "",
            finishedMsg: '',
            img: "<?php echo get_template_directory_uri() . '/assets/img/loader.gif'; ?>"
        }
    },
    	function( newElements ) {
         var $newElems = jQuery( newElements ).hide(); // hide to begin with
  			// ensure that images load before adding to masonry layout
		  $newElems.imagesLoadedn(function(){
		    $newElems.fadeIn(); // fade in when ready
		    $container.isotopeb( 'appended', $newElems );
		    if($container.attr('data-fade-in') == 1) {
					//fadeIn items one by one
						$newElems.each(function() {
					    $(this).find('.kad_blog_fade_in').delay($(this).attr('data-delay')).animate({'opacity' : 1, 'top' : 0},800,'swing');},{accX: 0, accY: -85},'easeInCubic');
					 
					} 
		  }); 

});	
				});
</script>
<?php } ?>
<?php do_action('kt_after_pagecontent'); ?>
</div><!-- /.main -->
  <?php get_footer(); ?>