<?php
/*
Template Name: Blog
*/
?>
		<?php get_header(); ?>
			<?php get_template_part('templates/page', 'header'); ?>
	
    <div id="content" class="container">
   		<div class="row">
   			<?php if(kadence_display_sidebar()) {$display_sidebar = true; $fullclass = '';} else {$display_sidebar = false; $fullclass = 'fullwidth';}
   			global $post; if(get_post_meta( $post->ID, '_kad_blog_summery', true ) == 'full') {$summery = 'full'; $postclass = "single-article fullpost";} else {$summery = 'normal'; $postclass = 'postlist';} ?>
      <div class="main <?php echo kadence_main_class();?> <?php echo esc_attr($postclass) .' '. esc_attr($fullclass); ?>" role="main">
      	<div class="entry-content" itemprop="mainContentOfPage">
					<?php get_template_part('templates/content', 'page'); ?>
		</div>
      		<?php  global $post, $pinnacle; $blog_category = get_post_meta( $post->ID, '_kad_blog_cat', true ); 
      		if(isset($pinnacle['blog_infinitescroll']) && $pinnacle['blog_infinitescroll'] == 1) {$infinitescroll = true;} else {$infinitescroll = false;}
					$blog_cat= get_term_by ('id',$blog_category,'category');
					if($blog_category == '-1' || $blog_category == '') {
      					$blog_cat_slug = '';
					} else {
					$blog_cat = get_term_by ('id',$blog_category,'category');
					$blog_cat_slug = $blog_cat -> slug;
					}

					$blog_items = get_post_meta( $post->ID, '_kad_blog_items', true ); 
					if($blog_items == 'all') {$blog_items = '-1';} 

					$temp = $wp_query; 
					$wp_query = null; 
					$wp_query = new WP_Query();
					$wp_query->query(array(
						'paged' => $paged,
						'category_name'=>$blog_cat_slug,
						'posts_per_page' => $blog_items));
					$count =0;
					if ( $wp_query ) : while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<?php if($summery == 'full') {
							if($display_sidebar){
					            global $kt_feat_width; 
					            $kt_feat_width = 848;
					        } else {
					            global $kt_feat_width; 
					            $kt_feat_width = 1170;
					        }
							get_template_part('templates/content', 'fullpost'); 
						} else {
							if($display_sidebar){
								global $kt_post_with_sidebar; 
                				$kt_post_with_sidebar = true;
					        } else {
					            global $kt_feat_width; 
					            $kt_post_with_sidebar = false;
					        }
						 	get_template_part('templates/content', get_post_format()); 
						} 
                    endwhile; else: ?>
						<li class="error-not-found"><?php _e('Sorry, no blog entries found.', 'pinnacle'); ?></li>
					<?php endif; ?>
                
				<?php if ($wp_query->max_num_pages > 1) : ?>
				<?php if(function_exists('kad_wp_pagenavi')) { ?>
        			<?php kad_wp_pagenavi(); ?>   
        		<?php } 

        		endif; 
				$wp_query = null; $wp_query = $temp;
				wp_reset_query(); 
				if ($infinitescroll) { ?>
				
<script type="text/javascript">jQuery(document).ready(function ($) {
$('.main').infinitescroll({
    nextSelector: ".wp-pagenavi a.next",
    navSelector: ".wp-pagenavi",
    itemSelector: ".post",
    loading: {
    		msgText: "",
            finishedMsg: '',
            img: "<?php echo get_template_directory_uri() . '/assets/img/loader.gif'; ?>"
        }
    },
        function( newElements ) {
         var $newElems = jQuery( newElements ); // hide to begin with
		    if($newElems.attr('data-animation') == 'fade-in') {
						//fadeIn items one by one
						$newElems.each(function() {
					    $(this).appear(function() {
					    $(this).delay($(this).attr('data-delay')).animate({'opacity' : 1, 'top' : 0},800,'swing');},{accX: 0, accY: -85},'easeInCubic');
					    });
					} 
    
		  }); 

});	
</script>
<?php } ?>
<?php do_action('kt_after_pagecontent'); ?>
</div><!-- /.main -->
  <?php get_footer(); ?>