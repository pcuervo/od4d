<?php
	
	$pagename = get_query_var('pagename'); 
	switch ( $pagename ) {
		case 'catalyzing-action':
			$tax_term = array( 'agenda-setting', 'standards' );
			break;
		case 'support-to-governments':
			$tax_term = 'policy';
			break;
		case 'scale-effective-use':
			$tax_term = 'innovation';
			break;
		case 'monitor-impact':
			$tax_term = 'research';
			break;
	}

	$results_args = array(
		'post_type' 		=> 'result',
		'tax_query' => array(
			array(
				'taxonomy' => 'focus_areas_of_impact',
				'field'    => 'slug',
				'terms'    => $tax_term,
			),
		),
		'posts_per_page' 	=> 3,
		'orderby'			=>'rand'
	);
	$query_results = new WP_Query( $results_args );
	if ( $query_results->have_posts() ) : ?>
		<div class="[ row ][ margin-top--xxlarge ]">
			<h4 class="[ hometitle ]">Related Results</h4>
			<?php while ( $query_results->have_posts() ) : $query_results->the_post(); ?>
				<div class="[ col-sm-12 col-md-6 col-lg-4 ][ implementing-partner ]">
			   		<a href="<?php echo the_permalink(); ?>">
				   		<?php echo get_the_title(); ?>
				   	</a>
				</div>
			<?php endwhile; wp_reset_query(); ?>
		</div>
	<?php endif; ?>