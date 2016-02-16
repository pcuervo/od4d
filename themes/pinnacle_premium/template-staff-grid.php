<?php
/*
Template Name: Staff Grid
*/
?>
	<?php get_header(); ?>
			<?php get_template_part('templates/page', 'header'); ?>	
    <div id="content" class="container">
   		<div class="row">
      <div class="main <?php echo kadence_main_class(); ?> stafflist" role="main">
			<div class="entry-content" itemprop="mainContentOfPage">
					<?php get_template_part('templates/content', 'page'); ?>
		</div>
      		<?php global $post, $pinnacle; 
      		if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;}
      			$staff_category = get_post_meta( $post->ID, '_kad_staff_type', true ); 
			   	$staff_items = get_post_meta( $post->ID, '_kad_staff_items', true );
			   	$staff_column = get_post_meta( $post->ID, '_kad_staff_columns', true );
			   	$staff_masonry = get_post_meta( $post->ID, '_kad_staff_masonry', true );
			   	$staff_limit_content = get_post_meta( $post->ID, '_kad_staff_wordlimit', true );
			   	$staff_single_link = get_post_meta( $post->ID, '_kad_staff_single_link', true );
			   	$staff_ratio = get_post_meta( $post->ID, '_kad_staff_img_ratio', true );
			   		if($staff_category == '-1' || empty($staff_category)) { $staff_cat_slug = ''; $staff_cat_ID = ''; } else {
						$staff_cat = get_term_by ('id',$staff_category,'staff-group' );
						$staff_cat_slug = $staff_cat -> slug;
					}
					if($staff_items == 'all') { $staff_items = '-1'; }
                    if ($staff_column == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 560;} 
		                   else if ($staff_column == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 400;} 
		                   else if ($staff_column == '6'){ $itemsize = 'tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 270;} 
		                   else if ($staff_column == '5'){ $itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 270;} 
		                   else {$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 370;} 
		            if($staff_ratio == 'portrait') {
									$temppimgheight = $slidewidth * 1.35;
									$slideheight = floor($temppimgheight);
						} else if($staff_ratio == 'landscape') {
									$temppimgheight = $slidewidth / 1.35;
									$slideheight = floor($temppimgheight);
						} else if($staff_ratio == 'widelandscape') {
									$temppimgheight = $slidewidth / 2;
									$slideheight = floor($temppimgheight);
						} else {
									$slideheight = $slidewidth;
						}
                   if ($staff_masonry == "true") {$slideheight = null;}
                  ?>
               <div id="staffwrapper" class="rowtight init-isotope" data-fade-in="<?php echo esc_attr($animate);?>" data-iso-selector=".s_item" data-iso-style="masonry" data-iso-filter="false"> 
				<?php $temp = $wp_query; $wp_query = null; $wp_query = new WP_Query();
				  $wp_query->query(array('paged' => $paged,'post_type' => 'staff','orderby' => 'menu_order','order' => 'ASC','staff-group'=>$staff_cat_slug,'posts_per_page' => $staff_items));
					if ( $wp_query ) : 	 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
				<div class="<?php echo esc_attr($itemsize);?> s_item">
                	<div class="grid_item staff_item kt_item_fade_in kad_staff_fade_in postclass">
					
							<?php global $post; if (has_post_thumbnail( $post->ID ) ) {
									$image_url = wp_get_attachment_image_src( 
									get_post_thumbnail_id( $post->ID ), 'full' ); 
									$thumbnailURL = $image_url[0];
									$image = array();
									$image = aq_resize($thumbnailURL, $slidewidth,$slideheight, true, false);
									if(empty($image[0])) {$image[0] = $thumbnailURL; $image[1] = null; $image[2] = null;} ?>

									<div class="imghoverclass">
										<?php if($staff_single_link == 'true') {?><a href="<?php the_permalink(); ?>"> <?php }?>
	                                       <img src="<?php echo esc_url($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" alt="<?php the_title(); ?>" class="" style="display: block;">
	                                   <?php if($staff_single_link == 'true') {?></a> <?php } ?>
	                                </div>
                           				<?php $image = null; $thumbnailURL = null;?>
                            <?php } ?>
                            <header class="kt-staff-header">
                            	<?php if($staff_single_link == 'true') {?><a href="<?php the_permalink(); ?>"> <?php }?>
                              <h3><?php the_title();?></h3>
                              <?php if($staff_single_link == 'true') {?></a> <?php } ?>
			                	<?php $staff_job_title = get_post_meta( $post->ID, '_kad_staff_job_title', true );
			                	if(!empty($staff_job_title)) echo '<div class="kt-staff-title">'.$staff_job_title.'</div>'; ?>
                          	</header>
                          	<div class="entry-content staff-entry-content">
                              <?php if($staff_limit_content == 'false') {
			                	 the_excerpt();
				                } else {
				                  the_content(); 
				                } ?>
                          	</div>
                          <footer class="clearfix staff-footer">
                          	<div class="kadence_social_widget">
                             <?php $staff_facebook = get_post_meta( $post->ID, '_kad_staff_facebook', true );
                             $staff_twitter = get_post_meta( $post->ID, '_kad_staff_twitter', true );
                             $staff_instagram = get_post_meta( $post->ID, '_kad_staff_instagram', true );
                             $staff_linkedin = get_post_meta( $post->ID, '_kad_staff_linkedin', true ); 
                             if(!empty($staff_facebook)) { ?>
									<a href="<?php echo esc_url($staff_facebook);?>" target="_blank" class="facebook_link" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Facebook', 'pinnacle');?>" title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Facebook', 'pinnacle');?>"><i class="kt-icon-facebook3"></i></a>
								<?php } if(!empty($staff_twitter)) { ?>
                             		<a href="<?php echo esc_url($staff_twitter);?>" target="_blank"class="twitter_link" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Twitter', 'pinnacle');?>" title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Twitter', 'pinnacle');?>"><i class="kt-icon-twitter2"></i></a>
								<?php } if(!empty($staff_instagram)) { ?>
                             		<a href="<?php echo esc_url($staff_instagram);?>" target="_blank" class="instagram_link" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Instagram', 'pinnacle');?>" title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Instagram', 'pinnacle');?>"><i class="kt-icon-instagram"></i></a>
								<?php } if(!empty($staff_linkedin)) { ?>
                             		<a href="<?php echo esc_url($staff_linkedin);?>" target="_blank" class="linkedin_link" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Linkedin', 'pinnacle');?>" title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Linkedin', 'pinnacle');?>"><i class="kt-icon-linkedin2"></i></a>
								<?php } ?>
							</div>
                          </footer>
                	</div>
                </div>
					<?php endwhile; else: ?>
					 
					<li class="error-not-found"><?php _e('Sorry, no staff entries found.', 'pinnacle');?></li>
						
				<?php endif; ?>
                </div> <!--portfoliowrapper-->
                    <?php if ($wp_query->max_num_pages > 1) : ?>
                            <?php if(function_exists('kad_wp_pagenavi')) { ?>
                            <?php kad_wp_pagenavi(); ?>   
                            <?php } else { ?>      
                            <nav id="post-nav" class="pager">
                                <div class="previous"><?php next_posts_link(__('&larr; Older posts', 'pinnacle')); ?></div>
                                <div class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'pinnacle')); ?></div>
                              </nav>
                            <?php } ?> 
                    <?php endif; ?>
                    <?php $wp_query = null; $wp_query = $temp; ?>
                    <?php wp_reset_query(); ?>
                    <?php do_action('kt_after_pagecontent'); ?>
</div><!-- /.main -->
  <?php get_footer(); ?>