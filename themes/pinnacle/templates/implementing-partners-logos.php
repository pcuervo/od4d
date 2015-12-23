<?php 

$ip_args = array(
	'post_type' 		=> 'implementing_partner',
	'posts_per_page' 	=> -1,
);
$query_ip = new WP_Query( $ip_args );
if ( $query_ip->have_posts() ) : ?>
<div class="row">
	<h2>Our Partners</h2>
	<?php while( $query_ip->have_posts() ) : $query_ip->the_post();
		$ip_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
	   	<div class="[ col-sm-12 col-md-6 col-lg-4 ][ implementing-partner ]">
	   		<a href="<?php echo the_permalink(); ?>">
		   		<img class="[ size-medium ][ wp-image-<?php echo get_the_id(); ?> ]" src="<?php echo $ip_img_url[0]; ?>" alt="<?php echo get_the_title(); ?>">
		   	</a>
		</div>
	<?php endwhile; ?>	
</div>
<?php endif; wp_reset_query(); ?>