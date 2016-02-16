<?php global $post, $pinnacle, $postcolumn; 
    if(!empty($postcolumn)) {
      if($postcolumn == '3') {
        $image_width = 372; 
        $image_height = 246; 
      } else if($postcolumn == '2') {
        $image_width = 560; 
        $image_height = 370;
      } else if($postcolumn == '6') {
        $image_width = 240; 
        $image_height = 159;
      } else if($postcolumn == '5') {
        $image_width = 240; 
        $image_height = 159;
      } else {
        $image_width = 340; 
        $image_height = 226;
      }
    } else {
      $image_width = 340;
      $image_height = 226; 
    } ?>
                          <div id="post-<?php the_ID(); ?>" class="blog_item postclass grid_item" itemscope="" itemtype="http://schema.org/BlogPosting">
                            <?php if(has_post_thumbnail( $post->ID )) {
                                    $image_url = wp_get_attachment_image_src( 
                                    get_post_thumbnail_id( $post->ID ), 'full' ); 
                                    $thumbnailURL = $image_url[0];
                                    $image = aq_resize($thumbnailURL, $image_width, $image_height, true);
                                    if(empty($image)) { $image = $thumbnailURL; }
                               } else {
                                    $thumbnailURL = pinnacle_post_default_placeholder();
                                  $image = aq_resize($thumbnailURL, $image_width, $image_height, true);
                                  if(empty($image)) { $image = $thumbnailURL; } 
                                   } ?>
                                  <div class="imghoverclass img-margin-center" itemprop="image">
                                    <a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
                                      <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>" <?php echo 'width="'.esc_attr($image_width).'" height="'.esc_attr($image_height).'"';?> class="iconhover" style="display:block;">
                                    </a> 
                                  </div>
                              <?php $image = null; $thumbnailURL = null;   ?>
                      <div class="postcontent">
                          <header>
                              <a href="<?php the_permalink() ?>"><h5 class="entry-title" itemprop="name headline"><?php the_title();?> </h5></a>
                               <?php get_template_part('templates/entry', 'meta-subhead'); ?>
                          </header>
                          <div class="entry-content color_body" itemprop="description articleBody">
                                  <?php if(function_exists('the_advanced_excerpt') ) {
                                    the_excerpt();
                                    } else { ?>
                                  <p><?php echo pinnacle_excerpt(16); ?> <a href="<?php the_permalink() ?>"><?php global $pinnacle; if(!empty($pinnacle['post_readmore_text'])) {$readmore = $pinnacle['post_readmore_text'];} else {$readmore = __('Read More', 'virtue');} echo $readmore; ?></a></p>
                                  <?php } ?> 
                              </div>
                          <footer class="clearfix">
                          </footer>
                        </div><!-- Text size -->
              </div> <!-- Blog Item -->