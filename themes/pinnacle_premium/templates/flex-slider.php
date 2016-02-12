<section class="pagefeat container">
  <?php global $post; 
    $height = get_post_meta( $post->ID, '_kad_posthead_height', true ); if (!empty($height)) $slideheight = $height; else $slideheight = 400; 
    $swidth = get_post_meta( $post->ID, '_kad_posthead_width', true ); if (!empty($swidth)) $slidewidth = $swidth; else $slidewidth = 1170;
                          ?>
    <div class="flexslider" style="max-width:<?php echo $slidewidth;?>px;">
        <ul class="slides">
            <?php $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                  if(!empty($image_gallery)) {
                      $attachments = array_filter( explode( ',', $image_gallery ) );
                          if ($attachments) {
                              foreach ($attachments as $attachment) {
                                $attachment_url = wp_get_attachment_url($attachment , 'full');
                                $image = aq_resize($attachment_url, $slidewidth, $slideheight, true);
                                  if(empty($image)) {$image = $attachment_url;}
                                echo '<li><img src="'.$image.'"/></li>';
                              }
                            }
                          } ?>                  
                </ul>
          </div> <!--Flex Slides-->
          <script type="text/javascript">
            jQuery(window).load(function () {
                jQuery('.flexslider').flexslider({
                    animation: "fade",
                    animationSpeed: 400,
                    slideshow: true,
                    slideshowSpeed: 7000,

                    before: function(slider) {
                      slider.removeClass('loading');
                    }  
                  });
                });
      </script>
        </section>