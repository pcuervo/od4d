<div class="sliderclass">
   <?php  global $pinnacle; 
         if(isset($pinnacle['mobile_slider_size'])) {$slideheight = $pinnacle['mobile_slider_size'];} else { $slideheight = 300; }
        if(isset($pinnacle['mobile_slider_size_width'])) {$slidewidth = $pinnacle['mobile_slider_size_width'];} else { $slidewidth = 480; }
        if(isset($pinnacle['mobile_slider_captions'])) { $captions = $pinnacle['mobile_slider_captions']; } else {$captions = '';}
        if(isset($pinnacle['home_mobile_slider'])) {$slides = $pinnacle['home_mobile_slider']; } else {$slides = '';}
                ?>
<div id="imageslider" class="container">
                   <div class="flexslider loading" style="max-width:<?php echo $slidewidth;?>px; margin-left: auto; margin-right:auto;">
                       <ul class="slides">
                        <?php foreach ($slides as $slide) : 
                          $image = aq_resize($slide['url'], $slidewidth, $slideheight, true);
                          if(empty($image)) {$image = $slide['url'];} ?>
                            <li> 
                            <?php if($slide['link'] != '') echo '<a href="'.$slide['link'].'">'; ?>
                              <img src="<?php echo $image; ?>" alt="<?php echo $slide['description']?>" title="<?php echo $slide['title'] ?>" />
                                  <?php if ($captions == '1') { ?> 
                                    <div class="flex-caption">
                                    <?php if ($slide['title'] != '') echo '<div class="captiontitle headerfont">'.$slide['title'].'</div>'; ?>
                                    <?php if ($slide['description'] != '') echo '<div><div class="captiontext headerfont"><p>'.$slide['description'].'</p></div></div>';?>
                                    </div> 
                              <?php } ?>
                        <?php if($slide['link'] != '') echo '</a>'; ?>
                      </li>
                  <?php endforeach; ?>
                       </ul>
              </div> <!--Flex Slides-->
              </div><!--Container-->
              </div><!--feat-->
               <?php  global $pinnacle; 
          $transtype = $pinnacle['mobile_trans_type']; if ($transtype == '') $transtype = 'slide';
          $transtime = $pinnacle['mobile_slider_transtime']; if ($transtime == '') $transtime = '300'; 
          $autoplay = $pinnacle['mobile_slider_autoplay']; if ($autoplay == '') $autoplay = 'true'; 
          $pausetime = $pinnacle['mobile_slider_pausetime']; if ($pausetime == '') $pausetime = '7000'; 
      ?>
      <script type="text/javascript">
            jQuery(window).load(function () {
                jQuery('.flexslider').flexslider({
                    animation: "<?php echo $transtype ?>",
                    animationSpeed: <?php echo $transtime ?>,
                    slideshow: <?php echo $autoplay ?>,
                    slideshowSpeed: <?php echo $pausetime ?>,
                    smoothHeight: true,

                    before: function(slider) {
                      slider.removeClass('loading');
                    }  
                  });
                });
      </script>