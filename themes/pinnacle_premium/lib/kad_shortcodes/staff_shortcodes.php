<?php 
//Shortcode for staff Posts
function kad_staff_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'orderby' => 'menu_order',
		'cat' => '',
		'columns' => '3',
		'limit_content' => 'true',
		'link' => 'true',
		'masonry' => false,
		'ratio' => 'square',
		'offset' => null,
		'id' => (rand(10,100)),
		'items' => '4'
), $atts));
	if($orderby == 'menu_order') {$order = 'ASC';} else {$order = 'DESC';} 
	if(empty($cat)) {$cat = '';}
		if ($columns == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 560;} 
		                   else if ($columns == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 400;} 
		                   else if ($columns == '6'){ $itemsize = 'tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 270;} 
		                   else if ($columns == '5'){ $itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 270;} 
		                   else {$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 370;} 
		            if($ratio == 'portrait') {
									$temppimgheight = $slidewidth * 1.35;
									$slideheight = floor($temppimgheight);
						} else if($ratio == 'landscape') {
									$temppimgheight = $slidewidth / 1.35;
									$slideheight = floor($temppimgheight);
						} else if($ratio == 'widelandscape') {
									$temppimgheight = $slidewidth / 2;
									$slideheight = floor($temppimgheight);
						} else {
									$slideheight = $slidewidth;
						}
                   if ($masonry) $slideheight = null; 
					global $pinnacle; if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;}
ob_start(); ?>
			<div class="staff-shortcode">
						<div id="staffwrapper-<?php echo esc_attr($id);?>" class="rowtight init-isotope" data-fade-in="<?php echo esc_attr($animate);?>" data-iso-selector=".s_item" data-iso-filter="false" data-iso-style="masonry"> 
            <?php $wp_query = null; 
				  $wp_query = new WP_Query();
				  $wp_query->query(array('orderby' => $orderby,'order' => $order,'offset' => $offset,'post_type' => 'staff','staff-group'=>$cat,'posts_per_page' => $items));
					$count =0;
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
										<?php if($link == 'true') {?><a href="<?php the_permalink(); ?>"> <?php }?>
	                                       <img src="<?php echo esc_url($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" alt="<?php the_title(); ?>" class="" style="display: block;">
	                                   <?php if($link == 'true') {?></a> <?php } ?>
	                                </div>
                           				<?php $image = null; $thumbnailURL = null;?>
                            <?php } ?>
                            <header class="kt-staff-header">
                            	<?php if($link == 'true') {?><a href="<?php the_permalink(); ?>"> <?php }?>
                              <h3><?php the_title();?></h3>
                              <?php if($link == 'true') {?></a> <?php } ?>
			                	<?php $staff_job_title = get_post_meta( $post->ID, '_kad_staff_job_title', true );
			                	if(!empty($staff_job_title)) echo '<div class="kt-staff-title">'.$staff_job_title.'</div>'; ?>
                          	</header>
                          	<div class="entry-content staff-entry-content">
                              <?php if($limit_content == 'true') {
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
									<a href="<?php echo esc_attr($staff_facebook);?>" class="facebook_link" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Facebook', 'pinnacle');?>" title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Facebook', 'pinnacle');?>"><i class="kt-icon-facebook3"></i></a>
								<?php } if(!empty($staff_twitter)) { ?>
                             		<a href="<?php echo esc_attr($staff_twitter);?>" class="twitter_link" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Twitter', 'pinnacle');?>" title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Twitter', 'pinnacle');?>"><i class="kt-icon-twitter2"></i></a>
								<?php } if(!empty($staff_instagram)) { ?>
                             		<a href="<?php echo esc_attr($staff_instagram);?>" class="instagram_link" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Instagram', 'pinnacle');?>" title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Instagram', 'pinnacle');?>"><i class="kt-icon-instagram"></i></a>
								<?php } if(!empty($staff_linkedin)) { ?>
                             		<a href="<?php echo esc_attr($staff_linkedin);?>" class="linkedin_link" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Linkedin', 'pinnacle');?>" title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Linkedin', 'pinnacle');?>"><i class="kt-icon-linkedin2"></i></a>
								<?php } ?>
							</div>
                          </footer>
                	</div>
                </div>
					<?php endwhile; else: ?>
					<li class="error-not-found"><?php _e('Sorry, no staff entries found.', 'pinnacle');?></li>
				<?php endif; ?>
                </div> <!-- staffwrapper -->
                    <?php $wp_query = null; wp_reset_query(); ?>
		</div><!-- /.home-staff -->		
	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}