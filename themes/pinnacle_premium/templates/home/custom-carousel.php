<div class="home-custom-carousel-wrap home-margin carousel_outerrim home-padding kad-animation" data-animation="fade-in" data-delay="0">
    <?php global $pinnacle; 
    $cc_items = $pinnacle['home_custom_carousel_items'];
    if(!empty($pinnacle['custom_carousel_title'])) {$cctitle = $pinnacle['custom_carousel_title']; } else { $cctitle = __('Featured News', 'virtue'); }
    if(!empty($pinnacle['home_custom_speed'])) {$hc_speed = $pinnacle['home_custom_speed'].'000';} else {$hc_speed = '9000';}
    if(isset($pinnacle['home_custom_carousel_scroll']) && $pinnacle['home_custom_carousel_scroll'] == 'all' ) {$hc_scroll = '';} else {$hc_scroll = '1';}
    if(!empty($pinnacle['home_custom_carousel_column'])) {$custom_column = $pinnacle['home_custom_carousel_column'];} else {$custom_column = 4;} 
    if ($custom_column == '2') {
      $itemsize = 'tcol-lg-6 tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; 
      $slidewidth = 559;  
      $sxl = 2; $xl = 2; $md = 2; $sm = 2; $xs = 1; $ss = 1;
    } else if ($custom_column == '3'){
      $itemsize = 'tcol-lg-4 tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12';
      $slidewidth = 366; 
      $sxl = 3; $xl = 3; $md = 3; $sm = 3; $xs = 2; $ss = 1;
    } else if ($custom_column == '6'){
      $itemsize = 'tcol-lg-2 tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; 
      $slidewidth = 240;
      $sxl = 6; $xl = 6; $md = 6; $sm = 4; $xs = 3; $ss = 2;
    } else if ($custom_column == '5'){
      $itemsize = 'tcol-lg-25 tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6';
      $slidewidth = 240;
      $sxl = 6; $xl = 6; $md = 5; $sm = 4; $xs = 3; $ss = 2;
    } else {
      $itemsize = 'tcol-lg-3 tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; 
      $slidewidth = 267; 
      $sxl = 4; $xl = 4; $md = 4; $sm = 3; $xs = 2; $ss = 1;
  } 

  $slideheight = $slidewidth;
                    ?>

    <div class="clearfix">
      <h3 class="hometitle"><?php echo $cctitle; ?></h3>
    </div>
    
    <div class=" fredcarousel">
      <div id="carouselcontainer-custom" class="rowtight">
        <div id="home-custom-carousel" class="clearfix caroufedselclass initcaroufedsel clearfix" data-carousel-container="#carouselcontainer-custom" data-carousel-transition="700" data-carousel-scroll="<?php echo esc_attr($hc_scroll); ?>" data-carousel-auto="true" data-carousel-speed="<?php echo esc_attr($hc_speed); ?>" data-carousel-id="custom" data-carousel-sxl="<?php echo esc_attr($sxl);?>" data-carousel-xl="<?php echo esc_attr($xl);?>" data-carousel-md="<?php echo esc_attr($md);?>" data-carousel-sm="<?php echo esc_attr($sm);?>" data-carousel-xs="<?php echo esc_attr($xs);?>" data-carousel-ss="<?php echo esc_attr($ss);?>">
          <?php foreach ($cc_items as $c_item) : 
              if(!empty($c_item['target']) && $c_item['target'] == 1) {$target = '_blank';} else {$target = '_self';}
              $image = array();
              if(isset($pinnacle['home_custom_carousel_imageratio']) && $pinnacle['home_custom_carousel_imageratio'] == '1' ) {
                  $image = aq_resize($c_item['url'], $slidewidth, null, false, false);
                    if(empty($image[0])) {$image[0] = $c_item['url']; $image[1] = null; $image[2] = null;}
              } else {
                    $image = aq_resize($c_item['url'], $slidewidth, $slideheight, true, false);
                    if(empty($image[0])) {$image[0] = $c_item['url']; $image[1] = null; $image[2] = null;}
              }?>
                    <div class="<?php echo esc_attr($itemsize); ?> kad_customcarousel_item">
                    <div class="grid_item product product_item custom_carousel_item all postclass">
                        <a href="<?php if($c_item['link']) echo esc_url($c_item['link']); ?>" class="custom_carousel_item_link" target="<?php echo esc_attr($target); ?>">
                          <img src="<?php echo esc_url($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" alt="<?php if($c_item['title']) echo esc_attr($c_item['title']);?>" />
                        </a>
                          <div class="custom_carousel_details">
                            <a href="<?php if($c_item['link']) echo $c_item['link']; ?>">
                             <?php if ($c_item['title']) echo '<h5>'.$c_item['title'].'</h5>'; ?>
                            </a>
                          <div class="ccarousel_excerpt"><?php if($c_item['description']) echo $c_item['description'];?></div>
                          </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
      </div>
    <div class="clearfix"></div>
                <a id="prevport-custom" class="prev_carousel kt-icon-arrow-left" href="#"></a>
          <a id="nextport-custom" class="next_carousel kt-icon-arrow-right" href="#"></a>
    </div>
  </div>
  </div>
