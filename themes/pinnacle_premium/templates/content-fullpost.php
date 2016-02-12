<?php global $post, $pinnacle;
  
      $headcontent = kt_get_post_head_content();
      if ($headcontent == 'carousel') { 
       get_template_part('templates/post', 'head-imgcarousel');
      } ?>
    <div class="single-article">
          <article <?php post_class('postclass'); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

          <?php if ($headcontent == 'flex') {
              get_template_part('templates/post', 'head-flexslider');
          } else if ($headcontent == 'shortcode') { 
              get_template_part('templates/post', 'head-shortcode');
          } else if ($headcontent == 'carouselslider') {
              get_template_part('templates/post', 'head-carouselslider');
          } else if ($headcontent == 'video') { 
              get_template_part('templates/post', 'head-video');
          } else if ($headcontent == 'image') {           
                get_template_part('templates/post', 'head-image');
          }

         /**
          * @hooked pinnacle_post_before_header_authorimg - 10
          */
          do_action( 'kadence_single_post_before_header' );
          ?>
    <header>
        <?php 
            /**
            * @hooked pinnacle_post_header_title_link - 10
            * @hooked pinnacle_post_header_meta - 20
            */
            do_action( 'kadence_fulllist_post_header' );
            ?>
    </header>
    <div class="entry-content clearfix" itemprop="description articleBody">
    <?php

              do_action( 'kadence_single_post_content_before' );
            
              global $more, $pinnacle;
              $more = 0; 
              if(!empty($pinnacle['post_readmore_text'])) {
                $readmore = $pinnacle['post_readmore_text'];
              } else { 
                $readmore =  __('Read More', 'pinnacle');
              }
              the_content($readmore);
    

              do_action( 'kadence_single_post_content_after' );
            
            ?>
    </div>
    <footer class="single-footer clearfix">
      <?php 
            /**
            * @hooked pinnacle_post_footer_meta - 10
            */
            do_action( 'kadence_single_post_footer' );
            ?>
    </footer>
  </article>
</div>
