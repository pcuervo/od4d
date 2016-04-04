<?php get_header(); ?>

<div id="pageheader" class="titleclass">
	<div class="header-color-overlay"></div>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-12">
					<h1 class="kad-page-title entry-title" itemprop="name headline">Results</h1>
				</div>
			</div>
		</div>
	</div><!--container-->
</div>

<div class="[ container ]">
	<div class="[ rowtight ][ postclass pageclass clearfix entry-content ]">
		<aside class="[ tcol-ss-12 tcol-md-3 ][ filtros ]">
			<h4 class="[ no-margin-top ]">Sort</h4>
			<div class="[ rowtight ]">
				<div class="[ tcol-ss-12 ]">
					<select name="sort" id="select-sort">
						<option value="" disabled="disabled" selected="selected">Sort by:</option>
						<option value="title" data-order="asc">Title (ascending)</option>
						<option value="title" data-order="desc">Title (descending)</option>
						<option value="implementingPartner" data-order="asc">Implementing Partner (ascending)</option>
						<option value="implementingPartner" data-order="desc">Implementing (descending)</option>
						<option value="publishedDate" data-order="asc">Most Recent</option>
						<option value="publishedDate" data-order="desc">Oldest</option>
					</select>
				</div>
			</div>
			<h4>Filters</h4>
			<div class="[ rowtight ][ js-filter-container ]">
				<div class="[ tcol-ss-12 tcol-xs-4 tcol-md-12 ][ js-filter ]">
					<h5>Sector:</h5>
					<?php show_filters( 'sector' ); ?>
				</div>
				<div class="[ tcol-ss-12 tcol-xs-4 tcol-md-12 ][ js-filter ]">
					<h5>Region:</h5>
					<?php show_filters( 'region' ); ?>
				</div>
				<div class="[ tcol-ss-12 tcol-xs-4 tcol-md-12 ][ js-filter ]">
					<h5>Focus / Areas of impact:</h5>
					<?php show_filters( 'focus_areas_of_impact' ); ?>
				</div>
				<div class="[ tcol-ss-12 tcol-xs-4 tcol-md-12 ][ js-filter ]">
					<h5>Publication Type:</h5>
					<?php show_filters( 'publication_type' ); ?>
				</div>
				<div class="[ tcol-ss-12 tcol-xs-4 tcol-md-12 ][ js-filter ]">
					<h5>Implementing Partner:</h5>
					<?php show_filters( 'implementing_partner' ); ?>
				</div>
			</div>
		</aside>
		<section class="[ tcol-ss-12 tcol-md-9 ][ posts-container ]">
			<div class="[ isotope-container ]">
				<div class="[ rowtight ]">
					<?php
					if ( have_posts()) : while ( have_posts() ) : the_post();
						$result_filter_info = get_result_filter_info( $post->ID );
						$result_filter_classes = '';
						foreach ( $result_filter_info as $key => $value ) {
							$result_filter_classes .= $value . ' ';
						}
					?>
						<div class="[ post ][ tcol-ss-12 tcol-sm-6 tcol-md-4 tcol-lg-3 ][ <?php echo $result_filter_classes; ?>]">
							<div class="[ post__card ]">
								<h4 class="[ post__title ]">
									<a href="<?php the_permalink(); ?>">
										<?php the_title() ?>
									</a>
								</h4>
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'medium', array( 'class' => '[ post__image ][ image-responsive ]' ) ); ?>
								</a>
								<p class="[ post__implementing-partner ]">Implementing partner: <?php echo get_implementing_partner( $post->ID ); ?></p>
								<p class="title [ hidden ]"><?php the_title() ?></p>
								<!-- <p class="[ post__type ]">Publication type: Magazine </p> -->
							</div>
						</div>

					<?php endwhile; endif; ?>
				</div>
			</div>
		</section>
	</div>
</div><!--container-->

<?php get_footer(); ?>