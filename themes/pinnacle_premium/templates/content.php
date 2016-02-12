        <?php global $post, $pinnacle, $kt_post_with_sidebar;
          if($kt_post_with_sidebar){
              $kt_feat_width = 848;
              $kt_portraittext = 'col-md-7';
              $kt_portraitimg_size = 'col-md-5';
          } else {
              $kt_feat_width = 1170;
              $kt_portraittext = 'col-md-8';
              $kt_portraitimg_size = 'col-md-4';
          }
         // Get summary setting
            $postsummery = kt_get_postsummary();

          ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('kad_blog_item postclass kad-animation'); ?> data-animation="fade-in" data-delay="0" itemscope="" itemtype="http://schema.org/BlogPosting">
                      <div class="row">
                      <?php if($postsummery == 'img_landscape') { 
                            $textsize = 'col-md-12';
                            get_template_part('templates/post', 'excerpt-landscapeimg');

                          } elseif($postsummery == 'img_portrait') { 
                            $textsize = $kt_portraittext;
                            get_template_part('templates/post', 'excerpt-portraitimg');

                          } elseif($postsummery == 'gallery_grid') {
                            $textsize = 'col-md-12'; ?>
                            <div class="col-md-12">
                            <?php get_template_part('templates/post', 'excerpt-gallerygrid'); ?>
                            </div>

                    <?php } elseif($postsummery == 'slider_landscape') {

                            $textsize = 'col-md-12'; ?>
                            <div class="col-md-12">
                            <?php
                              $swidth = get_post_meta( $post->ID, '_kad_gallery_posthead_width', true );
                              $height = get_post_meta( $post->ID, '_kad_gallery_posthead_height', true ); 
                              if (!empty($swidth)) {$slidewidth = $swidth;} else {$slidewidth = $kt_feat_width;}
                              if (!empty($height)) {$slideheight = $height;} else {$slideheight = 400;}
                              if(function_exists('kt_create_flexslider')){
                                $speed = 7000;
                                $animationspeed = 400;
                                $animation = "fade";
                                $auto = "true";
                                $initdelay = 0;
                                $width = $slidewidth;
                                $height = $slideheight;
                                $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                                $link = 'post';
                                kt_create_flexslider($speed, $animationspeed, $animation, $auto, $initdelay, $width, $height, $image_gallery, $link);
                              }
                              ?>
                            </div>

                    <?php } elseif($postsummery == 'slider_portrait') { ?>

                             <?php $textsize = $kt_portraittext; ?>
                              <div class="<?php echo esc_attr($kt_portraitimg_size);?>">
                              <?php 
                              if(function_exists('kt_create_flexslider')){
                                $speed = 7000;
                                $animationspeed = 400;
                                $animation = "fade";
                                $auto = "true";
                                $initdelay = 0;
                                $width = 360;
                                $height = 360;
                                $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                                $link = 'post';
                                kt_create_flexslider($speed, $animationspeed, $animation, $auto, $initdelay, $width, $height, $image_gallery, $link);
                              }
                              ?>
                              </div>

                    <?php } elseif($postsummery == 'video') {

                           $textsize = 'col-md-12'; ?>
                            <div class="col-md-12">
                                <?php get_template_part('templates/post', 'excerpt-video'); ?>
                            </div>
                    <?php } else { 
                            $textsize = 'col-md-12'; 
                          }?>

                      <div class="<?php echo esc_attr($textsize);?> postcontent">
                      <?php 
                        /**
                        * @hooked pinnacle_post_before_header_authorimg - 10
                        */
                        do_action( 'kadence_post_excerpt_before_header' );
                        ?>
                          <header>
                          <?php 
                            /**
                            * @hooked pinnacle_post_excerpt_header_title - 10
                            * @hooked pinnacle_post_header_meta - 20
                            */
                            do_action( 'kadence_post_excerpt_header' );
                            ?>
                          </header>
                          <div class="entry-content" itemprop="articleBody">
                          <?php

                            do_action( 'kadence_post_excerpt_content_before' );
                            
                            the_excerpt();

                            do_action( 'kadence_post_excerpt_content_after' );
            
                          ?>
                          </div>
                        </div><!-- Text size -->
                        <div class="col-md-12 postfooterarea">
                        <footer class="clearfix">
                             <?php 
                              /**
                              * @hooked pinnacle_post_footer_meta - 10
                              */
                              do_action( 'kadence_post_excerpt_footer' );
                              ?>
                          </footer>
                        </div>
                  </div><!-- row-->
              </article> <!-- Article -->