<?php get_template_part('templates/post', 'header'); ?>

<?php global $post, $pinnacle, $kt_feat_width;
    if(kadence_display_sidebar()) {
      $kt_feat_width = 848;
    } else {
      $kt_feat_width = 1170;
    }
    $headcontent = kt_get_post_head_content();
    
      if ($headcontent == 'carousel') {
        get_template_part('templates/post', 'head-imgcarousel');
      } ?>
<div id="content" class="container">
  <div id="post-<?php the_ID(); ?>" class="row single-article" itemscope="" itemtype="http://schema.org/BlogPosting">
    <div class="main <?php echo kadence_main_class(); ?>" role="main">
        <?php while (have_posts()) : the_post();

        do_action( 'kadence_single_post_before' ); 
        ?>

        <article <?php post_class('postclass'); ?>>

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
            * @hooked pinnacle_post_header_title - 10
            * @hooked pinnacle_post_header_meta - 20
            */
            do_action( 'kadence_single_post_header' );
            ?>
          </header>
          <div class="entry-content clearfix" itemprop="description articleBody">
            <?php

              do_action( 'kadence_single_post_content_before' );
            
            ?>
            <?php the_content(); ?>
            <?php wp_link_pages(array('before' => '<nav id="page-nav" class="kt-page-pagnation">', 'after' => '</nav>','link_before'=> '<span>','link_after'=> '</span>')); ?>

            <?php

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
      <?php 
      /**
      * @hooked pinnacle_post_nav - 10
      * @hooked pinnacle_post_authorbox - 20
      * @hooked pinnacle_post_bottom_carousel - 30
      * @hooked pinnacle_post_comments - 40
      */
      do_action( 'kadence_single_post_after' );
      
      endwhile; ?>
    </div>

