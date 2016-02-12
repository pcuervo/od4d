<?php 
//Shortcode for Carousels
function kad_latest_posts_carousel_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'id' => (rand(10,100)),
		'columns' => '3',
		'orderby' => 'date',
		'order' => 'DESC',
		'speed' => '9000',
		'offset' => null,
		'cat' => '',
		'scroll' => '',
		'fullwidth' => 'true',
		'items' => '6'
), $atts));
	if(empty($scroll) || $scroll == 1 ) {
		$scroll = '1';
	} else {
		$scroll = null;
	}
	$carousel_rn = (rand(10,100));
	if(empty($cat)) {$cat = '';}
	if($fullwidth == 'true') {
        if ($columns == '2') {
        	$itemsize = 'tcol-sxl-3 tcol-xl-4 tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; 
        	$slidewidth = 700; $sxl = 4;  $xl = 3; $md = 2; $sm = 2; $xs = 1; $ss = 1;
        } else if ($columns == '3'){
        	$itemsize = 'tcol-sxl-25 tcol-xl-3 tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; 
        	$slidewidth = 460; $sxl = 5;  $xl = 4; $md = 3; $sm = 3; $xs = 2; $ss = 1;
        } else if ($columns == '6'){ 
        	$itemsize = 'tcol-sxl-2 tcol-xl-2 tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; 
        	$slidewidth = 300; $sxl = 6; $xl = 6; $md = 6; $sm = 4; $xs = 3; $ss = 2;
        } else if ($columns == '5'){
        	$itemsize = 'tcol-sxl-2 tcol-xl-2 tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; 
        	$slidewidth = 300; $sxl = 6;  $xl = 6; $md = 5; $sm = 4; $xs = 3; $ss = 2;
        } else {
        	$itemsize = 'tcol-sxl-2 tcol-xl-25 tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; 
        	$slidewidth = 360; $sxl = 6; $xl = 5; $md = 4; $sm = 3; $xs = 2; $ss = 1;
        }
    } else {
        if ($columns == '2') {
        	$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; 
        	$slidewidth = 600; $sxl = 2; $xl = 2; $md = 2; $sm = 2; $xs = 1; $ss = 1;
        } else if ($columns == '3'){
        	$itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; 
        	$slidewidth = 400; $sxl = 3; $xl = 3; $md = 3; $sm = 3; $xs = 2; $ss = 1;
        } else if ($columns == '6'){
        	$itemsize = 'tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; 
        	$slidewidth = 300;  $sxl = 6; $xl = 6; $md = 6; $sm = 4; $xs = 3; $ss = 2;
        } else if ($columns == '5'){ 
        	$itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; 
        	$slidewidth = 300; $sxl = 5; $xl = 5; $md = 5; $sm = 4; $xs = 3; $ss = 2;
        } else {
        	$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; 
        	$slidewidth = 300; $sxl = 4; $xl = 4; $md = 4; $sm = 3; $xs = 2; $ss = 1;
        }
    }
    	
    	$temppimgheight = $slidewidth / 1.35;
        $slideheight = floor($temppimgheight);
ob_start(); ?>
<div class="carousel_outerrim kt-home-blog-carousel-outer kad-animation" data-animation="fade-in" data-delay="0">
  <div class="home-margin fredcarousel">
      <div id="latestcarouselcontainer" class="rowtight kt-caroufedsel-container fadein-carousel">
        <div id="kad-blog-photo-grid" class="blog_carousel initcaroufedsel caroufedselclass kt-home-blog-carousel clearfix" data-carousel-container=".kt-caroufedsel-container" data-carousel-auto="true" data-carousel-speed="<?php echo esc_attr($speed);?>" data-carousel-scroll="<?php echo esc_attr($scroll);?>" data-carousel-transition="700" data-carousel-id="latest" data-carousel-ss="<?php echo esc_attr($ss);?>" data-carousel-xs="<?php echo esc_attr($xs);?>" data-carousel-sm="<?php echo esc_attr($sm);?>" data-carousel-md="<?php echo esc_attr($md);?>" data-carousel-xl="<?php echo esc_attr($xl);?>" data-carousel-sxl="<?php echo esc_attr($sxl);?>">
        <?php 
          $wp_query = null; 
          $wp_query = new WP_Query();
          $wp_query->query(array(
          	'orderby' => $orderby,
          	'order' => $order,
          	'order' => $order,
          	'offset' => $offset,
          	'post_type' => 'post',
          	'category_name'=>$cat,
            'posts_per_page' => $items
            )
          );
        if ( $wp_query ) :  while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
        <?php global $post;?>
                                  <div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
                                        <div id="post-<?php the_ID(); ?>" class="blog_item postclass grid_item" style="max-width:<?php echo esc_attr($slidewidth);?>px">
                                        <?php if(has_post_thumbnail( $post->ID )) {
                                            $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
                                            $thumbnailURL = $image_url[0];
                                            $image = aq_resize($thumbnailURL, $slidewidth, $slideheight, true);
                                            if(empty($image)) { $image = $thumbnailURL; }
                                        } else {   
                                          $thumbnailURL = pinnacle_post_default_placeholder();
                                              $image = aq_resize($thumbnailURL, $slidewidth, $slideheight, true);
                                              if(empty($image)) { $image = $thumbnailURL; } 
                                          } ?>
                                              <div class="imghoverclass img-margin-center">
                                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                  <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" <?php echo 'width="'.esc_attr($slidewidth).'" height="'.esc_attr($slideheight).'"';?> class="iconhover" style="display:block;">
                                                </a> 
                                              </div>
                                          <?php $image = null; $thumbnailURL = null;   ?>
                                        <div class="photo-postcontent">
                                          <header>
                                              <a href="<?php the_permalink() ?>"><?php echo '<h4 class="entry-title">';  the_title(); echo '</h4>'; ?></a>
                                               <?php get_template_part('templates/entry', 'meta-subhead'); ?>
                                          </header>
                                        </div><!-- Text size -->
                                  </div> <!-- Blog Item -->
                              </div>
        <?php endwhile; else: ?>
        <div class="error-not-found"><?php _e('Sorry, no post entries found.', 'pinnacle');?></div>
        <?php endif; $wp_query = null; wp_reset_query(); ?>
        </div> <!-- Carouselinit -->
        </div> <!-- Carouselcontain -->
        <a id="prevport-latest" class="prev_carousel kt-icon-arrow-left" href="#" style="display:none;"></a>
        <a id="nextport-latest" class="next_carousel kt-icon-arrow-right" href="#" style="display:none;"></a>   
        </div>
        </div>

	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}