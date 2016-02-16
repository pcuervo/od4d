  <?php get_header(); ?>
      <?php get_template_part('templates/blog-page', 'header'); ?>
  
    <div id="content" class="container">
      <div class="row">

      <?php if(kadence_display_sidebar()) {
        $display_sidebar = true; 
        $fullclass = '';
      } else {
        $display_sidebar = false;
        $fullclass = 'fullwidth';
      }
      $homeid = get_option( 'page_for_posts' );
      if(get_post_meta( $homeid, '_kad_blog_summery', true ) == 'full') {
        $summery = 'full';
        $postclass = "single-article fullpost";
      } else {
        $summery = 'normal';
        $postclass = 'postlist';
      } ?>

      <div class="main <?php echo esc_attr( kadence_main_class() ); ?>  <?php echo esc_attr($postclass) .' '. esc_attr($fullclass); ?>" role="main">

<?php if (!have_posts()) : ?>
  <div class="alert">
    <?php _e('Sorry, no results were found.', 'pinnacle'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

    <?php while (have_posts()) : the_post();
            if($summery == 'full') {
              global $kt_feat_width; 
                $kt_feat_width = 848;
                get_template_part('templates/content', 'fullpost'); 
            } else {
              global $kt_post_with_sidebar; 
                $kt_post_with_sidebar = true;
              get_template_part('templates/content', get_post_format()); 
            }
        endwhile; ?>
                

<?php if ($wp_query->max_num_pages > 1) :
        kad_wp_pagenavi(); 
      endif; ?>

</div><!-- /.main -->
  <?php get_footer(); ?>