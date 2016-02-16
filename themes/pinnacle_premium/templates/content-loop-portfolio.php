<?php
/**
 * Portfolio Summary Content Loop
 *
 * @author    KadenceThemes
 *
 */
?>
<?php global $post, $kt_portfolio_loop; 

$postsummery = get_post_meta( $post->ID, '_kad_post_summery', true );

?>

  <div class="portfolio-item grid_item postclass kad-light-gallery">
      <?php if ($postsummery == 'slider') { ?>
        <div class="portfolio-imagepadding">
            <div class="flexslider kt-flexslider loading imghoverclass clearfix" data-flex-speed="7000" data-flex-initdelay="<?php echo (rand(10,2000));?>" data-flex-anim-speed="400" data-flex-animation="fade" data-flex-auto="true">
                <ul class="slides kad-light-gallery">
                    <?php 
                    $image_gallery = get_post_meta( $post->ID, '_kad_image_gallery', true );
                      $attachments = array_filter( explode( ',', $image_gallery ) );
                      if ($attachments) {
                        foreach ($attachments as $attachment) {
                          $thumbnailURL = wp_get_attachment_url($attachment , 'full');
                            $image = aq_resize($thumbnailURL, $kt_portfolio_loop['slidewidth'], $kt_portfolio_loop['slideheight'], true, false);
                            if(empty($image[0])) {$image[0] = $thumbnailURL; $image[1] = null; $image[2] = null;} ?>
                              <li>
                                <a href="<?php the_permalink() ?>" class="portfolio_slider_link">
                                  <img src="<?php echo esc_url($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" class="portfolio_img_slider portfolio_img" />
                                  <div class="portfolio-hoverover"></div>
                                  <div class="portfolio-table">
                                      <div class="portfolio-cell">
                                        <?php if($kt_portfolio_loop['pstyleclass'] == "padded_style" ) { ?>

                                              <a href="<?php the_permalink() ?>" class="kad-btn kad-btn-primary">
                                                <?php echo $kt_portfolio_loop['viewdetails'];?>
                                              </a>
                                              
                                              <?php if($kt_portfolio_loop['lightbox'] == 'true') { ?>
                                                <a href="<?php echo esc_url($thumbnailURL); ?>" class="kad-btn kad-btn-primary plightbox-btn" title="<?php the_title();?>" rel="lightbox">
                                                  <i class="kt-icon-search4"></i>
                                                </a>
                                              <?php } 
                                        } elseif($kt_portfolio_loop['pstyleclass'] == "flat-no-margin" || $kt_portfolio_loop['pstyleclass'] == "flat-w-margin" ) { ?>
                                              <h5><?php the_title();?></h5>
                                              
                                              <?php if($kt_portfolio_loop['showtypes'] == 'true') {
                                                  $terms = get_the_terms( $post->ID, 'portfolio-type' );
                                                  if ($terms) {?> 
                                                    <p class="cportfoliotag">
                                                      <?php $output = array(); foreach($terms as $term){ $output[] = $term->name;} echo implode(', ', $output); ?>
                                                    </p>
                                                  <?php } 
                                              }

                                              if($kt_portfolio_loop['showexcerpt'] == 'true') {?> 
                                                  <p class="p_excerpt">
                                                    <?php echo pinnacle_excerpt(16); ?>
                                                  </p>
                                              <?php } 

                                              if($kt_portfolio_loop['lightbox'] == 'true') {?>
                                                <a href="<?php echo esc_url($thumbnailURL); ?>" class="kad-btn kad-btn-primary plightbox-btn" title="<?php the_title();?>" rel="lightbox">
                                                <i class="kt-icon-search4"></i>
                                                </a>
                                              <?php }
                                        } ?>
                                      </div>
                                  </div>
                                </a>
                              </li>
                        <?php }
                      }  ?>                            
                </ul>
          </div> <!--Flex Slides-->
      </div>

    <?php } else if($postsummery == 'videolight') { 
      
      if (has_post_thumbnail( $post->ID ) ) {
                  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
                  $thumbnailURL = $image_url[0]; 
                  $image = array();
                  $image = aq_resize($thumbnailURL, $kt_portfolio_loop['slidewidth'], $kt_portfolio_loop['slideheight'], true, false);
                  $video_string = get_post_meta( $post->ID, '_kad_post_video_url', true );
                  if(!empty($video_string)) {$video_url = $video_string;} else {$video_url = $thumbnailURL;}
                  if(empty($image[0])) {$image[0] = $thumbnailURL; $image[1] = null; $image[2] = null;} ?>
                  <div class="portfolio-imagepadding kt-portfolio-video">
                    <div class="portfolio-hoverclass">
                      <a href="<?php the_permalink() ?>" class="">
                          <img src="<?php echo esc_url($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" alt="<?php the_title(); ?>" class="kad-lightboxhover">
                            <div class="portfolio-hoverover"></div>
                            <div class="portfolio-table">
                              <div class="portfolio-cell">
                                  <?php if($kt_portfolio_loop['pstyleclass'] == "padded_style" ) { ?>
                                      
                                      <a href="<?php the_permalink() ?>" class="kad-btn kad-btn-primary">
                                      <?php echo $kt_portfolio_loop['viewdetails'];?>
                                      </a>
                                      
                                      <?php if($kt_portfolio_loop['lightbox'] == 'true') {?>
                                          <a href="<?php echo esc_url($video_url); ?>" class="kad-btn kad-btn-primary plightbox-btn pvideolight" title="<?php the_title();?>" rel="lightbox">
                                            <i class="kt-icon-search4"></i>
                                          </a>
                                      <?php }

                                  } elseif($kt_portfolio_loop['pstyleclass'] == "flat-no-margin" || $kt_portfolio_loop['pstyleclass'] == "flat-w-margin" ) { ?>
                                      <h5><?php the_title();?></h5>

                                          <?php if($kt_portfolio_loop['showtypes'] == 'true') {
                                                  $terms = get_the_terms( $post->ID, 'portfolio-type' );
                                                  if ($terms) {?> 
                                                    <p class="cportfoliotag">
                                                      <?php $output = array(); foreach($terms as $term){ $output[] = $term->name;} echo implode(', ', $output); ?>
                                                    </p>
                                                  <?php } 
                                              }

                                               if($kt_portfolio_loop['showexcerpt'] == 'true') {?> 
                                                  <p class="p_excerpt">
                                                    <?php echo pinnacle_excerpt(16); ?>
                                                  </p>
                                              <?php } 
                                              if($kt_portfolio_loop['lightbox'] == 'true') {?>
                                                <a href="<?php echo esc_url($video_url); ?>" class="kad-btn kad-btn-primary plightbox-btn pvideolight" title="<?php the_title();?>" rel="lightbox">
                                                <i class="kt-icon-search4"></i>
                                                </a>
                                              <?php }
                                  } ?>
                                </div>
                              </div>
                      </a>
                    </div>
                  </div>
                  <?php $image = null; $thumbnailURL = null;
      }
    } else {
      if (has_post_thumbnail( $post->ID ) ) {
                  $image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); 
                  $thumbnailURL = $image_url[0];
                  $image = array();
                  $image = aq_resize($thumbnailURL, $kt_portfolio_loop['slidewidth'], $kt_portfolio_loop['slideheight'], true, false);
                  if(empty($image[0])) {$image[0] = $thumbnailURL; $image[1] = null; $image[2] = null;} ?>
                    <div class="portfolio-imagepadding">
                      <div class="portfolio-hoverclass">
                        <a href="<?php the_permalink() ?>" class="">
                          <img src="<?php echo esc_url($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" alt="<?php the_title(); ?>" class="kad-lightboxhover">
                          <div class="portfolio-hoverover"></div>
                          <div class="portfolio-table">
                            <div class="portfolio-cell">
                              <?php if($kt_portfolio_loop['pstyleclass'] == "padded_style" ) { ?>
                                      
                                      <a href="<?php the_permalink() ?>" class="kad-btn kad-btn-primary">
                                      <?php echo $kt_portfolio_loop['viewdetails'];?>
                                      </a>
                                      
                                      <?php if($kt_portfolio_loop['lightbox'] == 'true') {?>
                                          <a href="<?php echo esc_url($thumbnailURL); ?>" class="kad-btn kad-btn-primary plightbox-btn  " title="<?php the_title();?>" rel="lightbox">
                                            <i class="kt-icon-search4"></i>
                                          </a>
                                      <?php }

                              } elseif($kt_portfolio_loop['pstyleclass'] == "flat-no-margin" || $kt_portfolio_loop['pstyleclass'] == "flat-w-margin" ) { ?>
                                      <h5><?php the_title();?></h5>

                                          <?php if($kt_portfolio_loop['showtypes'] == 'true') {
                                                  $terms = get_the_terms( $post->ID, 'portfolio-type' );
                                                  if ($terms) {?> 
                                                    <p class="cportfoliotag">
                                                      <?php $output = array(); foreach($terms as $term){ $output[] = $term->name;} echo implode(', ', $output); ?>
                                                    </p>
                                                  <?php } 
                                              }

                                               if($kt_portfolio_loop['showexcerpt'] == 'true') {?> 
                                                  <p class="p_excerpt">
                                                    <?php echo pinnacle_excerpt(16); ?>
                                                  </p>
                                              <?php } 
                                              if($kt_portfolio_loop['lightbox'] == 'true') {?>
                                                <a href="<?php echo esc_url($thumbnailURL); ?>" class="kad-btn kad-btn-primary plightbox-btn" title="<?php the_title();?>" rel="lightbox">
                                                <i class="kt-icon-search4"></i>
                                                </a>
                                              <?php }
                              } ?>
                            </div>
                          </div>
                        </a>
                      </div>
                    </div>
                    <?php $image = null; $thumbnailURL = null;
    } 
  } ?>

          <?php if($kt_portfolio_loop['pstyleclass'] == "padded_style" ) { ?>
                  <a href="<?php the_permalink() ?>" class="portfoliolink">
                    <div class="piteminfo">   
                        <h5><?php the_title();?></h5>
                            
                            <?php if($kt_portfolio_loop['showtypes'] == 'true') {
                              $terms = get_the_terms( $post->ID, 'portfolio-type' ); 
                              if ($terms) {?> 
                              <p class="cportfoliotag">
                                <?php $output = array(); foreach($terms as $term){ $output[] = $term->name;} echo implode(', ', $output); ?>
                              </p>
                              <?php } 
                            } 

                            if($kt_portfolio_loop['showexcerpt'] == 'true') {?> 
                                <p class="p_excerpt">
                                    <?php echo pinnacle_excerpt(16); ?>
                                </p>
                            <?php } ?>
                    </div>
                  </a>
          <?php } ?>
</div>

