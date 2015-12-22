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

<div class="[ container ]">
	<div class="[ rowtight ][ postclass pageclass clearfix entry-content ]">
		<aside class="[ tcol-ss-12 tcol-md-3 ][ filtros ]">
			<h4>Filters</h4>
			<div class="[ rowtight ][ js-filter-container ]">
				<div class="[ tcol-ss-12 tcol-xs-4 ][ js-filter ]">
					<p>Publication Type:</p>
					<?php show_filters( 'publication_type' ); ?>
				</div>
				<div class="[ tcol-ss-12 tcol-xs-4 ][ js-filter ]">
					<p>Region:</p>
					<?php show_filters( 'region' ); ?>
				</div>
				<div class="[ tcol-ss-12 tcol-xs-4 ][ js-filter ]">
					<p>Implementing Partner:</p>
					<?php show_filters( 'implementing_partner' ); ?>
				</div>
				<div class="[ tcol-ss-12 tcol-xs-4 ][ js-filter ]">
					<p>Focus / Areas of impact:</p>
					<?php show_filters( 'focus_areas_of_impact' ); ?>
				</div>
				<div class="[ tcol-ss-12 tcol-xs-4 ][ js-filter ]">
					<p>Sector:</p>
					<?php show_filters( 'sector' ); ?>
				</div>
			</div>
		</aside>
		<section class="[ tcol-ss-12 tcol-md-9 ][ posts-container ]">
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
						<div class="[ post ][ tcol-ss-6 tcol-sm-4 tcol-lg-3 ][ <?php echo $result_filter_classes; ?>]">
							<a href="<?php the_permalink(); ?>">
								<h3 class="[ post-title ]"><?php the_title() ?></h3>
								<?php the_post_thumbnail( 'thumbnail', array( 'class' => '[ post-image ][ image-responsive ]' ) ); ?>
								<p class="[ post-implementing-partner ]"><?php the_title() ?></p>
								<p class="[ post-type ]"><?php the_title() ?></p>
							</a>
						</div>
					<?php endwhile; endif; ?>
				</div>
			</div>
		</section>
	</div>
</div><!--container-->

<?php get_footer(); ?>