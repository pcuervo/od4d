	<?php
/*
Template Name: Testimonial Grid
*/
?>
	<?php get_header(); ?>
			<?php get_template_part('templates/page', 'header'); ?>
	
    <div id="content" class="container">
   		<div class="row">
      <div class="main <?php echo kadence_main_class(); ?>  testimoniallist" role="main">
			<div class="entry-content" itemprop="mainContentOfPage">
					<?php get_template_part('templates/content', 'page'); ?>
		</div>
      	<?php global $post, $pinnacle; 
      	if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;}
      						$testimonial_category = get_post_meta( $post->ID, '_kad_testimonial_type', true ); 
			   				   $testimonial_items = get_post_meta( $post->ID, '_kad_testimonial_items', true );
			   				   $limit_testimonial = get_post_meta( $post->ID, '_kad_limit_testimonial', true );
			   				   $testimonial_word_count = get_post_meta( $post->ID, '_kad_testimonial_word_count', true );
			   				   $single_testimonial_link = get_post_meta( $post->ID, '_kad_single_testimonial_link', true );
			   				   $testimonial_link_text = get_post_meta( $post->ID, '_kad_testimonial_link_text', true );
			   				   $testimonial_orderby		= get_post_meta( $post->ID, '_kad_testimonial_orderby', true );
			   				   if($testimonial_category == '-1' || empty($testimonial_category)) { $testimonial_cat_slug = ''; $testimonial_cat_ID = ''; } else {
								$testimonial_cat = get_term_by ('id',$testimonial_category,'testimonial-group' );
								$testimonial_cat_slug = $testimonial_cat -> slug;
							}
					   		$testimonial_category = $testimonial_cat_slug;
							if($testimonial_items == 'all') { $testimonial_items = '-1'; }
							if(isset($limit_testimonial) && $limit_testimonial == 'on') {$limit_text = true;} else {$limit_text = false;}
							if(!empty($testimonial_word_count)) {$wordcount = $testimonial_word_count;} else {$wordcount = '25';}
							if(isset($single_testimonial_link) && $single_testimonial_link == 'on') {$postlink = true;} else {$postlink = false;}
							if(!empty($testimonial_link_text)) {$thelinktext = $testimonial_link_text;} else {$thelinktext = __('Read More', 'pinnacle');}
					 $testimonial_column = get_post_meta( $post->ID, '_kad_testimonial_columns', true ); 
					 if(!empty($testimonial_orderby)) {
						$torderby = $testimonial_orderby;
					} else {
						$torderby = 'menu_order';
					}
					
					if($torderby == 'menu_order' || $torderby == 'title') {
						$torder = 'ASC';
					} else {
						$torder = 'DESC';
					}
                   if ($testimonial_column == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $imgwidth = 560; $imgheight = 560; $md = 2; $sm = 2; $xs = 1; $ss = 1;} 
		                   else if ($testimonial_column == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $imgwidth = 366; $imgheight = 366; $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
		                   else if ($testimonial_column == '6'){ $itemsize = 'tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $imgwidth = 240; $imgheight = 240; $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
		                   else if ($testimonial_column == '5'){ $itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $imgwidth = 240; $imgheight = 240; $md = 5; $sm = 4; $xs = 3; $ss = 2;} 
		                   else {$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $imgwidth = 270; $imgheight = 270; $md = 4; $sm = 3; $xs = 2; $ss = 1;}  ?>
                  
			<div id="testimonialwrapper" class="rowtight init-isotope" data-iso-selector=".t_item" data-iso-style="masonry" data-fade-in="<?php echo esc_attr($animate);?>" data-iso-filter="false"> 
   
            <?php $temp = $wp_query; 
				  $wp_query = null; 
				  $wp_query = new WP_Query();
				  $wp_query->query(array(
					'paged' => $paged,
					'post_type' => 'testimonial',
					'orderby' => $torderby,
					'order' => $torder,
					'testimonial-group'=>$testimonial_cat_slug,
					'posts_per_page' => $testimonial_items));
					$count =0;
					if ( $wp_query ) : 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<div class="<?php echo $itemsize;?> t_item">
                		<div class="grid_item testimonial_item kt_item_fade_in kad_testimonial_fade_in">
                			<div class="testimonialbox">
								<?php if (has_post_thumbnail( $post->ID ) ) {
									$image_url = wp_get_attachment_image_src( 
									get_post_thumbnail_id( $post->ID ), 'full' ); 
									$thumbnailURL = $image_url[0]; 
									$image = aq_resize($thumbnailURL, 80, 80, true); 
									if(empty($image)) {$image = $thumbnailURL;}?>
									<div class="alignleft testimonialimg">
	                                       <img src="<?php echo esc_url($image); ?>" alt="<?php esc_attr(the_title()); ?>" class="" style="display: block; max-width:80px;">
	                                </div>
                           				<?php $image = null; $thumbnailURL = null;?>
                                <?php } ?>
                                <?php if($limit_text) {
                                	echo esc_attr(strip_tags(pinnacle_content($wordcount))); 
                                } else {
			                         the_content(); 
			                     }
			                     if($postlink) {
			                     	echo '<a href="'.get_the_permalink().'" class="kadtestimoniallink">';
                                    echo $thelinktext;
                                    echo '</a>';
			                     }?>
			                    </div>
			                    <div class="testimonialbottom">
			                    	<div class="lipbg kad-arrow-down"></div>
			                    	<p><strong><?php the_title();?></strong>
			                    		<?php global $post; $location = get_post_meta( $post->ID, '_kad_testimonial_location', true ); 
				      						if($location != '') { echo ' - ' . $location;}
				      						?>
	      						</p>
			                </div>
			            </div>
                	</div>
					<?php endwhile; else: ?>
					<li class="error-not-found"><?php _e('Sorry, no testimonial entries found.', 'pinnacle');?></li>
				<?php endif; ?>
                </div> <!-- testimonialwrapper -->
                    <?php if ($wp_query->max_num_pages > 1) : ?>
                            <?php kad_wp_pagenavi(); ?>   
                    <?php endif; ?>
                    <?php $wp_query = null; 
                      	  $wp_query = $temp; ?>
                    <?php wp_reset_query(); ?>
                    <?php do_action('kt_after_pagecontent'); ?>
</div><!-- /.main -->
  <?php get_footer(); ?>