<?php while (have_posts()) : the_post(); ?>
  	<?php the_content(); ?>
  	<?php wp_link_pages(array('before' => '<nav id="page-nav" class="kt-page-pagnation">', 'after' => '</nav>','link_before'=> '<span>','link_after'=> '</span>')); ?>
<?php endwhile; ?>
<?php 
$name = $post->post_name;
$projects_args = array(
	'post_type' 		=> 'result',
	'posts_per_page' 	=> 4,
	'tax_query' => array(
		'relation' => 'OR',
		array(
			'taxonomy' => 'sector',
			'field'    => 'slug',
			'terms'    => $name,
		),
		array(
			'taxonomy' => 'focus_areas_of_impact',
			'field'    => 'slug',
			'terms'    => $name,
		)
	),
);
$posts = new WP_Query( $projects_args );
if (isset($posts->posts)):
	foreach ($posts->posts as $key => $post): ?>
		<div class="[ post ][ tcol-ss-6 tcol-sm-4 tcol-lg-3 ]">
			<div class="[ post__card ]">
				<h4 class="[ post__title ]">
					<a href="">
						<?php echo $post->post_title; ?>
					</a>
				</h4>
				<a href="">
					<?php //the_post_thumbnail( 'medium', array( 'class' => '[ post__image ][ image-responsive ]' ) ); ?>
				</a>
				<!-- <p class="[ post__type ]">Publication type: Magazine </p> -->
			</div>
		</div>
	<?php endforeach;
endif;
?>