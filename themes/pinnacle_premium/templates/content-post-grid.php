            <?php global $post, $pinnacle, $postcolumn; 
            if(!empty($postcolumn)) {
              if($postcolumn == '3') {
                $image_width = 370;
                $image_height = 246;
                $titletag = "h5";
              } else if($postcolumn == '2') {
                $image_width = 560;
                $image_height = 370;
                $titletag = "h4";
              } else {
                $image_width = 340;
                $image_height = 226;
                $titletag = "h5";
              }
            } else {
              $image_width = 340;
              $image_height = 226;
              $titletag = "h5";
            }
            if(isset($pinnacle['postexcerpt_hard_crop']) && $pinnacle['postexcerpt_hard_crop'] == 1) {
              $hardcrop = true;
            } else {
              $hardcrop = false;
            }
            if ( has_post_format( 'video' )) {
              // Get summary setting
              $postsummery = get_post_meta( $post->ID, '_kad_video_post_summery', true );
              if(empty($postsummery) || $postsummery == 'default') {
                  if(!empty($pinnacle['video_post_summery_default'])) {
                            $postsummery = $pinnacle['video_post_summery_default'];
                    } else {
                              $postsummery = 'video';
                    }
              }
              
            } else if (has_post_format( 'gallery' )) {
              $postsummery = get_post_meta( $post->ID, '_kad_gallery_post_summery', true );
              if(empty($postsummery) || $postsummery == 'default') {
                  if(!empty($pinnacle['gallery_post_summery_default'])) {
                          $postsummery = $pinnacle['gallery_post_summery_default'];
                    } else {
                          $postsummery = 'slider_landscape';
                    }
              }

            } elseif (has_post_format( 'image' )) {
               $postsummery = get_post_meta( $post->ID, '_kad_image_post_summery', true );
              if(empty($postsummery) || $postsummery == 'default') {
                  if(!empty($pinnacle['image_post_summery_default'])) {
                          $postsummery = $pinnacle['image_post_summery_default'];
                    } else {
                          $postsummery = 'img_portrait';
                    }
              }

            } else {
                if(!empty($pinnacle['post_summery_default'])) {
                    $postsummery = $pinnacle['post_summery_default'];
                } else {
                  $postsummery = 'img_landscape';
                }
            
            }

                if($postsummery == 'img_landscape' || $postsummery == 'img_portrait') { ?>
                <div id="post-<?php the_ID(); ?>" class="blog_item postclass kt_item_fade_in kad_blog_fade_in grid_item" itemscope="" itemtype="http://schema.org/BlogPosting">
                            <?php if(has_post_thumbnail( $post->ID ) ){
                                  $image_url = wp_get_attachment_image_src( 
                                  get_post_thumbnail_id( $post->ID ), 'full' ); 
                                  $thumbnailURL = $image_url[0];
                                  if($hardcrop) {
                                    $image = aq_resize($thumbnailURL, $image_width, $image_height, true);
                                  } else {
                                    $image = aq_resize($thumbnailURL, $image_width, false);
                                  }
                                  if(empty($image)) { $image = $thumbnailURL; }
                                  ?>
                                      <div class="imghoverclass img-margin-center" itemprop="image">
                                        <a href="<?php the_permalink()  ?>" title="<?php echo esc_attr(get_the_title() ); ?>">
                                          <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr(get_the_title() ); ?>" <?php if($hardcrop) {echo 'width="'.esc_attr($image_width).'" height="'.esc_attr($image_height).'"';}?> class="iconhover" style="display:block;">
                                        </a> 
                                      </div>
                                  <?php $image = null; $thumbnailURL = null;   
                                  } else {
                                    $thumbnailURL = pinnacle_post_default_placeholder();
                                  if($hardcrop) {
                                    $image = aq_resize($thumbnailURL, $image_width, $image_height, true);
                                  } else {
                                    $image = aq_resize($thumbnailURL, $image_width, false);
                                  }
                                  if(empty($image)) { $image = $thumbnailURL; } 
                                    ?> 
                                      <div class="imghoverclass img-margin-center" itemprop="image">
                                        <a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
                                          <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" <?php if($hardcrop) {echo 'width="'.esc_attr($image_width).'" height="'.esc_attr($image_height).'"';}?> class="iconhover" style="display:block;">
                                        </a> 
                                      </div>
                                  <?php $image = null; $thumbnailURL = null;
                                   } ?>

                      <?php } elseif($postsummery == 'slider_landscape' || $postsummery == 'slider_portrait' || $postsummery == 'gallery_grid') {?>
                          <div id="post-<?php the_ID(); ?>" class="blog_item kt_item_fade_in postclass kad_blog_fade_in grid_item" itemscope="" itemtype="http://schema.org/BlogPosting">
                              <?php
                              if(function_exists('kt_create_flexslider')){
                                  $speed = 7000;
                                  $animationspeed = 400;
                                  $animation = "fade";
                                  $auto = "true";
                                  $initdelay = (rand(10,2000));
                                  $width = $image_width;
                                  $height = $image_height;
                                  $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                                  $link = 'post';
                                  kt_create_flexslider($speed, $animationspeed, $animation, $auto, $initdelay, $width, $height, $image_gallery, $link);
                              }
                              ?>

                    <?php } elseif($postsummery == 'video') {?>
                          <div id="post-<?php the_ID(); ?>" class="blog_item kt_item_fade_in postclass kad_blog_fade_in grid_item" itemscope="" itemtype="http://schema.org/BlogPosting">
                                <div class="videofit">
                                    <?php $video = get_post_meta( $post->ID, '_kad_post_video', true ); echo $video; ?>
                                </div>

                    <?php } else {?>
                          <div id="post-<?php the_ID(); ?>" class="blog_item kt_item_fade_in postclass kad_blog_fade_in grid_item" itemscope="" itemtype="http://schema.org/BlogPosting">
                        <?php }?>

                      <div class="postcontent">
                          <header>
                              <a href="<?php the_permalink() ?>"><?php echo '<'.$titletag.' class="entry-title" itemprop="name headline">';  the_title(); echo '</'.$titletag.'>'; ?></a>
                               <?php get_template_part('templates/entry', 'meta-subhead'); ?>
                          </header>
                          <div class="entry-content" itemprop="description articleBody">
                              <?php the_excerpt(); ?>
                          </div>
                          <footer class="clearfix">
                             <?php get_template_part('templates/entry', 'meta-footer'); ?>
                          </footer>
                        </div><!-- Text size -->
              </div> <!-- Blog Item -->