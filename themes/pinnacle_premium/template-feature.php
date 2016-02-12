<?php
/*
Template Name: Feature
*/
?>
	<?php get_header(); ?>
	<?php
 global $post; 
 	$headoption = get_post_meta( $post->ID, '_kad_page_head', true ); if(isset($headoption)) {$headoption = $headoption;} else {$headoption = 'pagetitle';}
				if ($headoption == 'flex') {
					get_template_part('templates/flex', 'slider');
				}
				else if ($headoption == 'shortcode') {
					get_template_part('templates/shortcode', 'slider');
				}
				else if ($headoption == 'carousel') {
					get_template_part('templates/carousel', 'slider');
				}
				else if ($headoption == 'imgcarousel') {
					get_template_part('templates/image', 'carousel');
				}
				else if ($headoption == 'video') { ?>
					 <section class="postfeat container">
				          <div class="videofit">
				              <?php global $post; $video = get_post_meta( $post->ID, '_kad_post_video', true ); echo $video; ?>
				          </div>
				        </section>
				<?php } else {
					get_template_part('templates/page', 'header');
				}?>
    <div id="content" class="container">
   		<div class="row">
     		<div class="main <?php echo kadence_main_class(); ?>" role="main">
     		 	<div class="postclass pageclass clearfix entry-content" itemprop="mainContentOfPage">
				<?php get_template_part('templates/content', 'page'); ?>
				</div>
				<?php do_action('kt_after_pagecontent'); ?>
			</div><!-- /.main -->
			  <?php get_footer(); ?>