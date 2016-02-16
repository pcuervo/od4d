  <?php  
  if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

global $pinnacle; 
        if(isset($pinnacle['slider_size'])) {
          $slideheight = $pinnacle['slider_size'];
        } else { 
          $slideheight = 400; 
        }
        if(isset($pinnacle['slider_size_width'])) {
          $slidewidth = $pinnacle['slider_size_width'];
        } else {
          $slidewidth = 400;
        }
        if(isset($pinnacle['home_slider'])) {
          $slides = $pinnacle['home_slider']; 
        } else {
          $slides = '';
        }
        if(isset($pinnacle['slider_autoplay']) && $pinnacle['slider_autoplay'] == "1" ) {
          $autoplay ='true';
        } else {
          $autoplay = 'false';
        }
        if(isset($pinnacle['slider_pausetime'])) {
          $pausetime = $pinnacle['slider_pausetime'];
        } else {
          $pausetime = '7000';
        } 

          ?>
<div class="sliderclass carousel_outerrim">
    <div id="img-carousel-gallery" class="fredcarousel fadein-carousel" style="overflow:hidden; height: <?php echo esc_attr($slideheight);?>px">
        <div class="gallery-carousel initimagecarousel" data-carousel-container="#img-carousel-gallery" data-carousel-transition="300" data-carousel-height="<?php echo esc_attr($slideheight);?>" data-carousel-auto="<?php echo esc_attr($autoplay); ?>" data-carousel-speed="<?php echo esc_attr($pausetime);?>" data-carousel-id="himgcarousel">
                  <?php foreach ($slides as $slide) {
                    if(!empty($slide['target']) && $slide['target'] == 1) {
                        $target = '_blank';
                    } else {
                        $target = '_self';
                    }
                    $image = aq_resize($slide['url'], null, $slideheight, false, false);
                    if(empty($image)) {
                      $image = array();
                      $image[0] = $slide['url'];
                      $image[1] = 400;
                      $image[2] = $slideheight;
                    } ?>
                    <div class="carousel_gallery_item" style="float:left; margin: 0 5px; width:<?php echo esc_attr($image[1]);?>px; height:<?php echo esc_attr($image[2]);?>px;">
                    <?php if(!empty($slide['link'])){
                      echo '<a href="'.esc_url($slide['link']).'" class="homepromolink" target="'.esc_attr($target).'">'; 
                    } ?>
                    <img src="<?php echo esc_url($image[0]);?>" width="<?php echo esc_attr($image[1]);?>" height="<?php echo esc_attr($image[2]);?>" alt="<?php echo esc_attr($slide['title']); ?>" />
                    <?php if(!empty($slide['link'])) {
                     echo '</a>'; 
                    }?>
                    </div>
                  
                  <?php } ?>  
              </div> <!-- Image gallery carousel-->

            <div class="clearfix"></div>
              <a id="prevport-himgcarousel" class="prev_carousel kt-icon-arrow-left" href="#"></a>
              <a id="nextport-himgcarousel" class="next_carousel kt-icon-arrow-right" href="#"></a>
   </div> <!--fredcarousel-->
</div> <!--sliderclass -->
        