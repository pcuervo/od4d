<section class="pagefeat carousel_outerrim loading">
  <?php global $post; $height = get_post_meta( $post->ID, '_kad_posthead_height', true ); if (!empty($height)) $slideheight = $height; else $slideheight = 400;  ?>
        <div id="post-carousel-gallery" class="fredcarousel fadein-carousel" style="overflow:hidden; height: <?php echo $slideheight;?>px">
            <div class="gallery-carousel">
              <?php  $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                          if(!empty($image_gallery)) {
                            $attachments = array_filter( explode( ',', $image_gallery ) );
                              if ($attachments) {
                                foreach ($attachments as $attachment) {
                                $attachment_url = wp_get_attachment_url($attachment , 'full');
                                $image = aq_resize($attachment_url, null, $slideheight, false, false);
                                  if(empty($image)) {$image = $attachment_url;}
                                  echo '<div class="carousel_gallery_item" style="float:left; margin: 0 5px; width:'.$image[1].'px; height:'.$image[2].'px;"><img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" /></div>';
                                }
                              }
                          } ?>    
                <script type="text/javascript">
                jQuery( window ).load(function () {
                    var $wcontainer = jQuery('#post-carousel-gallery');
                    var $container = jQuery('#post-carousel-gallery .gallery-carousel');
                    function setWidths() {
                            if(jQuery(window).width() <= 768) {
                              align = 'center';
                            carheight = null;
                            var unitWidth = jQuery(window).width() -10;
                            $container.children().css({ width: unitWidth });
                            $container.children().css({ height: 'auto' });
                          }
                        }
                      var align = false;
                      var carheight = <?php echo $slideheight; ?>;
                          function initCarousel_page_slider() {
                            $container.carouFredSel({
                              width: '100%',
                              height: carheight,
                              align: align,
                              auto: {play: true, timeoutDuration: 7000},
                              scroll: {items : 1,easing: 'quadratic'},
                              items: {visible: 1,width: 'variable'},
                              prev: '#post-carousel-gallery .prev_carousel',
                              next: '#post-carousel-gallery .next_carousel',
                              swipe: {onMouse: true,onTouch: true},
                            });
                          }
                          initCarousel_page_slider();
                          setWidths();
                            jQuery(window).on("debouncedresize", function( event ) {
                            $container.trigger("destroy");
                            setWidths();
                            initCarousel_page_slider();
                            });
                          $wcontainer.animate({'opacity' : 1});
                          $wcontainer.css({ height: 'auto' });
                          $wcontainer.parent().removeClass('loading')
                });
                
              </script>      
             </div> <!--post gallery carousel-->
            <div class="clearfix"></div>
              <a id="prevport_bloggallery" class="prev_carousel kt-icon-arrow-left" href="#"></a>
              <a id="nextport_bloggallery" class="next_carousel kt-icon-arrow-right" href="#"></a>
          </div> <!--fredcarousel-->
        </section>              