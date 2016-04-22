<?php

$projects_args = array(
	'post_type' 		=> 'result',
	'posts_per_page' 	=> 3,
	'tax_query' => array(
		array(
			'taxonomy' => 'implementing_partner',
			'field'    => 'name',
			'terms'    => array( $post->post_title ),
		),
	),
);
$query_projects = new WP_Query( $projects_args );
if ( $query_projects->have_posts() ) : ?>
	<h4 class="[ hometitle ]">Recent Results</h4>
	<div class="row">
		<?php while ( $query_projects->have_posts() ) : $query_projects->the_post(); ?>
			<div class="[ col-sm-12 col-md-6 col-lg-4 ][ implementing-partner ]">
		   		<a href="<?php echo the_permalink(); ?>">
			   		<?php echo get_the_title(); ?>
			   	</a>
			</div>
		<?php endwhile; wp_reset_query(); ?>
	</div>
<?php endif; ?>
