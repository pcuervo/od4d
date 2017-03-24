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
				<div class="[ margin-bottom ]">
					<?php the_content(); ?>
				</div>
				<?php
				$projects_args = array(
					'post_type' 		=> 'result',
					'posts_per_page' 	=> 3,
				);
				$query_projects = new WP_Query( $projects_args );
				if ( $query_projects->have_posts() ) : ?>
					<div class="[ row ][ margin-top--xxlarge ]">
						<h4 class="[ hometitle ]">Related Results</h4>
						<?php while ( $query_projects->have_posts() ) : $query_projects->the_post(); ?>
							<div class="[ col-sm-12 col-md-6 col-lg-4 ][ implementing-partner ]">
						   		<a href="<?php echo the_permalink(); ?>">
							   		<?php echo get_the_title(); ?>
							   	</a>
							</div>
						<?php endwhile; wp_reset_query(); ?>
					</div>
				<?php endif; ?>
			</div>				

			
		</div>

</div><!-- /.main -->
  <?php get_footer(); ?>