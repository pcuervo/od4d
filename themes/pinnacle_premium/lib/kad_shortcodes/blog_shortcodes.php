<?php 
//Shortcode for Blog Posts
function kad_blog_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'orderby' => 'date',
		'type' =>'normal',
		'speed' =>'7000',
		'columns' =>'3',
		'id' => (rand(10,100)),
		'height' =>'400',
		'width' =>'',
		'offset' =>null,
		'cat' => '',
		'items' => '4'
), $atts));
	if($orderby == 'menu_order') {$order = 'ASC';} else {$order = 'DESC';} 
	if(empty($cat)) {$cat = '';}

	if($type == 'slider') {
ob_start(); ?>
	<div class="sliderclass">
 		<?php if(kadence_display_sidebar()) {if(!empty($width)) {$slidewidth = $width;} else {$slidewidth = 848;}} else {if(!empty($width)) {$slidewidth = $width;} else {$slidewidth = 1140;}} ?>
        <div class="flexslider kt-flexslider loading" style="max-width:<?php echo esc_attr($slidewidth);?>px; margin-left: auto; margin-right:auto;" data-flex-speed="<?php echo esc_attr($speed); ?>" data-flex-anim-speed="400" data-flex-animation="fade" data-flex-auto="true">
        <ul class="slides">
    		<?php $wp_query = null; 
				$wp_query = new WP_Query();
				$wp_query->query(array('orderby' => $orderby,'order' => $order,'offset' => $offset,'post_type' => 'post','category_name'=>$cat,'posts_per_page' => $items));
					if ( $wp_query ) :  while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
                  			global $post; if (has_post_thumbnail( $post->ID ) ) {
                              $image_url = wp_get_attachment_image_src( 
                              get_post_thumbnail_id( $post->ID ), 'full' ); 
                              $thumbnailURL = $image_url[0]; 
                              $image = aq_resize($thumbnailURL, $slidewidth, $height, true);
                              if(empty($image)) { $image = $thumbnailURL; } ?>
                    <li> 
                        <a href="<?php the_permalink(); ?>">
                          	<img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" />
                            <div class="flex-caption">
                            	<div class="captiontitle headerfont"><?php the_title(); ?></div>
                            </div> 
                        </a>
                    </li>
                  <?php } endwhile; else: ?>
            <li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'pinnacle'); ?></li>
          <?php endif; ?>
        <?php $wp_query = null; // Reset ?>
        <?php wp_reset_query(); ?>
        </ul>
      </div> <!--Flex Slides-->
  </div> <!--Slider Class-->
<?php  	$output = ob_get_contents();
		ob_end_clean();
			return $output;
	}  elseif ($type == "grid") {
ob_start(); ?>
		<?php global $pinnacle, $postcolumn; 
		if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;} 
		if ($columns == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $postcolumn = '2';} 
		    else if ($columns == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $postcolumn = '3';} 
		    else if ($columns == '5'){ $itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $postcolumn = '5';}
		    else if ($columns == '6'){ $itemsize = 'tcol-md-2 tcol-sm-25 tcol-xs-3 tcol-ss-6'; $postcolumn = '6';} 
		    else {$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $postcolumn = '4';} ?>
		<div id="kad-blog-grid" class="rowtight init-isotope" data-fade-in="<?php echo esc_attr($animate);?>" data-iso-selector=".b_item" data-iso-style="masonry">
					<?php 
					$wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query(array('category_name'=>$cat,'offset' => $offset,'posts_per_page' => $items));
					if ( $wp_query ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
						<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
							<?php get_template_part('templates/content', 'post-grid');?>
						</div>
                    <?php endwhile; else: ?>
						<li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'pinnacle');?></li>
					<?php endif; ?>
				<?php $wp_query = null; wp_reset_query(); ?>
		</div> <!-- postlist -->
<?php  	$output = ob_get_contents();
			ob_end_clean();
				return $output;

	} else if ($type == "photo") {
ob_start(); ?>
		<?php global $pinnacle, $postcolumn; 
		if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;} 
		if ($columns == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $postcolumn = '2'; $image_width = 560; $titletag = "h4";} 
			    else if ($columns == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $postcolumn = '3'; $image_width = 380; $titletag = "h5";} 
			    else if ($columns == '5'){ $itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $postcolumn = '5'; $image_width = 300; $titletag = "h5";} 
			    else if ($columns == '6'){ $itemsize = 'tcol-md-2 tcol-sm-25 tcol-xs-4 tcol-ss-6'; $postcolumn = '6'; $image_width = 300; $titletag = "h5";} 
			    else {$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $image_width = 340; $titletag = "h5";} ?>
		<div id="kad-blog-photo-grid" class="rowtight init-isotope" data-fade-in="<?php echo esc_attr($animate);?>" data-iso-selector=".b_item" data-iso-style="masonry">
					<?php 
					$wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query(array('category_name'=>$cat,'offset' => $offset,'posts_per_page' => $items));
					if ( $wp_query ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
					global $post;?>
						<div class="<?php echo esc_attr($itemsize); ?> b_item kad_blog_item">
							<div id="post-<?php the_ID(); ?>" class="blog_item postclass kt_item_fade_in kad_blog_fade_in grid_item" style="max-width:<?php echo esc_attr($image_width);?>px">
                            <?php if(has_post_thumbnail( $post->ID )) {
                                $image_url = wp_get_attachment_image_src( 
                                get_post_thumbnail_id( $post->ID ), 'full' ); 
                                $thumbnailURL = $image_url[0];
                                $image = aq_resize($thumbnailURL, $image_width, false);
                                if(empty($image)) { $image = $thumbnailURL; }
                            } else {
                                    $image = pinnacle_img_placeholder(); 
                            }?>
                                  <div class="imghoverclass img-margin-center">
                                    <a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
                                      <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" class="iconhover" style="display:block;">
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
                    <?php endwhile; else: ?>
						<li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'pinnacle');?></li>
					<?php endif; ?>
				<?php $wp_query = null; wp_reset_query(); ?>
		</div> <!-- postlist -->
	<?php  	$output = ob_get_contents();
			ob_end_clean();
				return $output;

	} else if ($type == "full") {
ob_start(); ?>
		<?php if(kadence_display_sidebar()) {$display_sidebar = true; $fullclass = '';} else {$display_sidebar = false; $fullclass = 'fullwidth';} ?>
		<div class="single-article fullpost <?php echo esc_attr($fullclass);?>">
					<?php 
					$wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query(array('category_name'=>$cat,'offset' => $offset,'posts_per_page' => $items));
					if ( $wp_query ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
							if($display_sidebar){
					            global $kt_feat_width; 
					            $kt_feat_width = 848;
					        } else {
					            global $kt_feat_width; 
					            $kt_feat_width = 1170;
					        }
								get_template_part('templates/content', 'fullpost'); 
                    endwhile; else: ?>
						<li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'pinnacle');?></li>
					<?php endif; ?>
				<?php $wp_query = null; wp_reset_query(); ?>
		</div> <!-- postlist -->
	<?php  	$output = ob_get_contents();
			ob_end_clean();
				return $output;
	} else {
ob_start(); ?>
		<?php if(kadence_display_sidebar()) {$display_sidebar = true; $fullclass = '';} else {$display_sidebar = false; $fullclass = 'fullwidth';} ?>
		<div class="postlist <?php echo esc_attr($fullclass);?>">
					<?php 
					$wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query(array('category_name'=>$cat,'offset' => $offset,'posts_per_page' => $items));
					if ( $wp_query ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
					if($display_sidebar){
								global $kt_post_with_sidebar; 
                				$kt_post_with_sidebar = true;
					        } else {
					            global $kt_feat_width; 
					            $kt_post_with_sidebar = false;
					        }
						 	get_template_part('templates/content', get_post_format()); 
                    endwhile; else: ?>
						<li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'pinnacle');?></li>
					<?php endif; ?>
				<?php $wp_query = null; wp_reset_query(); ?>
		</div> <!-- postlist -->
	<?php  	$output = ob_get_contents();
			ob_end_clean();
				return $output;
	}
}