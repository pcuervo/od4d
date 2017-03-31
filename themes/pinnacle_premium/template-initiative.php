<?php
/*
Template Name: Initiative
*/
?>
<?php get_header(); ?>
	<?php get_template_part('templates/page', 'header'); ?>
	
    <div id="content" class="container">
   	<div class="row">
		<div class="main <?php echo kadence_main_class(); ?>" role="main">
			<div class="postclass pageclass clearfix entry-content" itemprop="mainContentOfPage">

				<div class="[ tcol-ss-12 tcol-lg-offset-2 tcol-lg-8  ]">
					<?php the_post_thumbnail( 'full', array( 'class' => '[ margin-bottom ][ image-responsive image-centered ][ padding ]' ) ); ?>
					<div class="[ content-initiative ][ margin-bottom ]">
						<?php the_content(); ?>
					</div>
					<?php get_template_part('templates/related-results'); ?>
				</div>				

				
			</div>
		</div><!-- /.main -->
  <?php get_footer(); ?>