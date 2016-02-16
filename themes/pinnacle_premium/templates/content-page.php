<?php while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>
  <?php wp_link_pages(array('before' => '<nav id="page-nav" class="kt-page-pagnation">', 'after' => '</nav>','link_before'=> '<span>','link_after'=> '</span>')); ?>
<?php endwhile; ?>