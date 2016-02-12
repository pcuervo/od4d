<?php
/*
Template Name: Blog Grid
*/
?>
	<?php get_header(); ?>
			<?php get_template_part('templates/page', 'header'); ?>
		<div id="content" class="container">
   		<div class="row">
   			<?php global $post, $pinnacle, $postcolumn;
   			if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;} 
   			if(isset($pinnacle['blog_infinitescroll']) && $pinnacle['blog_infinitescroll'] == 1) {$infinitescroll = true;} else {$infinitescroll = false;}
   			$blog_grid_column = get_post_meta( $post->ID, '_kad_blog_columns', true );
   			if ($blog_grid_column == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $postcolumn = '2';} 
		    else if ($blog_grid_column == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $postcolumn = '3';} 
		    else {$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $postcolumn = '4';}
      		$blog_category = get_post_meta( $post->ID, '_kad_blog_cat', true ); 
					$blog_cat= get_term_by ('id',$blog_category,'category');
					if($blog_category == '-1' || $blog_category == '') {
      					$blog_cat_slug = '';
					} else {
					$blog_cat = get_term_by ('id',$blog_category,'category');
					$blog_cat_slug = $blog_cat -> slug;
					}
					$blog_items = get_post_meta( $post->ID, '_kad_blog_items', true ); 
					if($blog_items == 'all') {$blog_items = '-1';} 
					?>
      <div class="main <?php echo kadence_main_class();?>" role="main">
      	<div class="entry-content" itemprop="mainContentOfPage">
					<?php get_template_part('templates/content', 'page'); ?>
		</div>
      	<div id="kad-blog-grid" class="rowtight init-isotope" data-fade-in="<?php echo esc_attr($animate);?>"  data-iso-selector=".b_item" data-iso-style="masonry" data-iso-filter="false">
      		<?php   $temp = $wp_query; 
					$wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query(array(
						'paged' => $paged,
						'category_name'=>$blog_cat_slug,
						'posts_per_page' => $blog_items));
					$count =0;
					if ( $wp_query ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
						?>
							<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
							<?php get_template_part('templates/content', 'post-grid');?>
							</div>
						<?php 
                    endwhile; else: ?>
						<li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'pinnacle'); ?></li>
					<?php endif; ?>
                

                </div> <!-- Blog Grid -->
				<?php if ($wp_query->max_num_pages > 1) : ?>
				<?php if(function_exists('kad_wp_pagenavi')) { ?>
        			<?php kad_wp_pagenavi(); ?>   
        		<?php } else { ?>      
			        <nav class="post-nav">
		                <ul class="pager">
		                  <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'pinnacle')); ?></li>
		                  <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'pinnacle')); ?></li>
		                </ul>
		              </nav>
        		<?php } ?> 
				<?php endif; ?>
				<?php $wp_query = null; $wp_query = $temp;  // Reset ?>
				<?php wp_reset_query(); ?>
				<?php if ($infinitescroll) { ?>
	<script type="text/javascript">
	jQuery(document).ready(function ($) {
		var $container = $('#kad-blog-grid');					
$('#kad-blog-grid').infinitescroll({
    nextSelector: ".wp-pagenavi a.next",
    navSelector: ".wp-pagenavi",
    itemSelector: ".kad_blog_item",
    loading: {
    		msgText: "",
            finishedMsg: '',
            img: "<?php echo get_template_directory_uri() . '/assets/img/loader.gif'; ?>"
        }
    },
    	function( newElements ) {
         var $newElems = jQuery( newElements ).hide(); // hide to begin with
  			// ensure that images load before adding to masonry layout
		  $newElems.imagesLoadedn(function(){
		    $newElems.fadeIn(); // fade in when ready
		    $container.isotopeb( 'appended', $newElems );
		    if($container.attr('data-fade-in') == 1) {
					//fadeIn items one by one
						$newElems.each(function() {
					    $(this).find('.kad_blog_fade_in').delay($(this).attr('data-delay')).animate({'opacity' : 1, 'top' : 0},800,'swing');},{accX: 0, accY: -85},'easeInCubic');
					 
					} 
		  }); 

});	
});
</script>
<?php } ?>
<?php do_action('kt_after_pagecontent'); ?>
</div><!-- /.main -->
  <?php get_footer(); ?>
  