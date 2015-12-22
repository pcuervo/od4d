<?php get_header(); ?>


<div id="pageheader" class="titleclass">
	<div class="header-color-overlay"></div>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-12">
					<h1 class="kad-page-title entry-title" itemprop="name headline">Results</h1>
					<div class="subtitle"> Lorem ipsum</div>
				</div>
			</div>
		</div>
	</div><!--container-->
</div>
<br />
<div class="[ container ]">
	<div class="[ row ]">
		<aside class="[ col-md-3 ][ filtros ]">
			<p>Filter by Publication Type:</p>
		  	<?php show_filters( 'publication_type' ); ?>
		  	<p>Filter by Region:</p>
		  	<?php show_filters( 'region' ); ?>
		  	<p>Filter by Implementing Partner:</p>
		  	<?php show_filters( 'implementing_partner' ); ?>
		  	<p>Filter by Focus / Areas of impact:</p>
		  	<?php show_filters( 'focus_areas_of_impact' ); ?>
		  	<p>Filter by Sector:</p>
		  	<?php show_filters( 'sector' ); ?>
		</aside>
		<section class="[ col-md-9 ]">
			<div class="[ isotope-container ]">
				<div class="[ row ]">
					<?php
					if ( have_posts()) : while ( have_posts() ) : the_post();
						$result_filter_info = get_result_filter_info( $post->ID );
						$result_filter_classes = '';
						foreach ( $result_filter_info as $key => $value ) {
							$result_filter_classes .= $value . ' ';
						}
					?>
						<div class="[ post ][ col-md-4 ][ <?php echo $result_filter_classes; ?>]">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'medium', array( 'class' => '[ image-responsive ]' ) ); ?>
								<p class="[ post-title ]"><?php the_title() ?></p>
							</a>
						</div>
					<?php endwhile; endif; ?>
				</div>
			</div>
		</section>
	</div>
</div><!--container-->


<?php get_footer(); ?>