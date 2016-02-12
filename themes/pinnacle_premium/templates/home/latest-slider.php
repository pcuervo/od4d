<div class="sliderclass">
  <?php  global $pinnacle; 
        if(isset($pinnacle['slider_size'])) {$slideheight = $pinnacle['slider_size'];} else { $slideheight = 400; }
        if(isset($pinnacle['slider_size_width'])) {$slidewidth = $pinnacle['slider_size_width'];} else { $slidewidth = 1140; }
          if(isset($pinnacle['trans_type'])) {$transtype = $pinnacle['trans_type'];} else { $transtype = 'slide';}
          if(isset($pinnacle['slider_transtime'])) {$transtime = $pinnacle['slider_transtime'];} else {$transtime = '300';}
          if(isset($pinnacle['slider_autoplay'])) {$autoplay = $pinnacle['slider_autoplay'];} else {$autoplay = 'true';}
          if(isset($pinnacle['slider_pausetime'])) {$pausetime = $pinnacle['slider_pausetime'];} else {$pausetime = '7000';}

        if(isset($pinnacle['choose_latest_slider_style'])) {$sliderstyle = $pinnacle['choose_latest_slider_style'];} else { $sliderstyle = 'flex'; }
        ?>
        <?php if($sliderstyle == 'flex') {?>
        <div id="imageslider" class="">
          <div class="flexslider kt-flexslider loading" style="max-width:<?php echo $slidewidth;?>px; margin-left: auto; margin-right:auto;" data-flex-speed="<?php echo $pausetime; ?>" data-flex-anim-speed="<?php echo $transtime; ?>" data-flex-animation="<?php echo $transtype; ?>" data-flex-auto="<?php echo $autoplay; ?>">
            <ul class="slides">
    <?php $temp = $wp_query; 
          $wp_query = null; 
          $wp_query = new WP_Query();
          $wp_query->query(array(
            'posts_per_page' => 4));
          $count =0;
          if ( $wp_query ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); 
                  if (has_post_thumbnail( $post->ID ) ) {
                              $image_url = wp_get_attachment_image_src( 
                              get_post_thumbnail_id( $post->ID ), 'full' ); 
                              $thumbnailURL = $image_url[0]; 
                              $image = aq_resize($thumbnailURL, $slidewidth, $slideheight, true);
                              if(empty($image)) { $image = $thumbnailURL; } 
                    ?>
                      <li> 
                        <a href="<?php the_permalink(); ?>">
                          <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" />
                                <div class="flex-caption">
                                <div class="captiontitle headerfont"><?php the_title(); ?></div>
                                </div> 
                        </a>
                      </li>
                  <?php } endwhile; else: ?>
            <li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'pinnacle'); ?></li>
          <?php endif; ?>
        <?php $wp_query = null; $wp_query = $temp;  // Reset ?>
        <?php wp_reset_query(); ?>
        </ul>
      </div> <!--Flex Slides-->
  </div><!--Container-->
      <?php } else if($sliderstyle == 'carousel') {
        if(isset($pinnacle['latest_carousel_style'])) {$columns = $pinnacle['latest_carousel_style'];} else {$columns = "3";}
        $fullwidth = 'fullwidth';
            if($fullwidth == 'fullwidth') {
                if ($columns == '2') {$itemsize = 'tcol-sxl-3 tcol-xl-4 tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 700; $sxl = 4;  $xl = 3; $md = 2; $sm = 2; $xs = 1; $ss = 1;} 
          else if ($columns == '3'){ $itemsize = 'tcol-sxl-25 tcol-xl-3 tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 460; $sxl = 5;  $xl = 4; $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
          else if ($columns == '6'){ $itemsize = 'tcol-sxl-2 tcol-xl-2 tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $sxl = 6; $xl = 6; $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
          else if ($columns == '5'){ $itemsize = 'tcol-sxl-2 tcol-xl-2 tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $sxl = 6;  $xl = 6; $md = 5; $sm = 4; $xs = 3; $ss = 2;} 
          else {$itemsize = 'tcol-sxl-2 tcol-xl-25 tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 360; $sxl = 6; $xl = 5; $md = 4; $sm = 3; $xs = 2; $ss = 1;}
            } else {
            if ($columns == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 600; $sxl = 2; $xl = 2; $md = 2; $sm = 2; $xs = 1; $ss = 1;} 
            else if ($columns == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 400; $sxl = 3; $xl = 3; $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
            else if ($columns == '6'){ $itemsize = 'tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300;  $sxl = 6; $xl = 6; $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
            else if ($columns == '5'){ $itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $sxl = 5; $xl = 5; $md = 5; $sm = 4; $xs = 3; $ss = 2;} 
            else {$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 300; $sxl = 4; $xl = 4; $md = 4; $sm = 3; $xs = 2; $ss = 1;}
        }
        $temppimgheight = $slidewidth / 1.35;
        $slideheight = floor($temppimgheight);
        ?>
<div class="carousel_outerrim kt-home-blog-carousel-outer kad-animation" data-animation="fade-in" data-delay="0">
  <div class="home-margin fredcarousel">
      <div id="latestcarouselcontainer" class="rowtight kt-caroufedsel-container fadein-carousel">
        <div id="kad-blog-photo-grid" class="blog_carousel initcaroufedsel caroufedselclass kt-home-blog-carousel clearfix" data-carousel-container=".kt-caroufedsel-container" data-carousel-auto="true" data-carousel-speed="9000" data-carousel-scroll="1" data-carousel-transition="700" data-carousel-id="latest" data-carousel-ss="<?php echo $ss;?>" data-carousel-xs="<?php echo $xs;?>" data-carousel-sm="<?php echo $sm;?>" data-carousel-md="<?php echo $md;?>" data-carousel-xl="<?php echo $xl;?>" data-carousel-sxl="<?php echo $sxl;?>">
        <?php
        $temp = $wp_query; 
          $wp_query = null; 
          $wp_query = new WP_Query();
          $wp_query->query(array(
            'posts_per_page' => 6));
            if ( $wp_query ) :  while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
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
     <?php } ?>
     </div><!--sliderclass-->