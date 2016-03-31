<?php

$ip_args = array(
	'post_type' 		=> 'implementing_partner',
	'posts_per_page' 	=> -1,
);
$query_ip = new WP_Query( $ip_args );
if ( $query_ip->have_posts() ) : ?>
	<h2>Our Partners</h2>
	<div class="[ rowtight ]">
		<?php while( $query_ip->have_posts() ) : $query_ip->the_post();
			$ip_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium_large' ); ?>
			<div class="[ tcol-ss-6 tcol-sm-4 tcol-md-6 ][ implementing-partner ]">
				<a class="[ block ]" href="<?php echo the_permalink(); ?>">
					<img class="[ image-responsive ]" src="<?php echo $ip_img_url[0]; ?>" alt="<?php echo get_the_title(); ?>">
				</a>
			</div>
		<?php endwhile; ?>
	</div>
<?php endif; wp_reset_query(); ?>