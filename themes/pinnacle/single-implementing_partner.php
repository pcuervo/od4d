<?php
	global $post;
	get_header();
?>
	<div class="[ container ]">
		<div class="[ rowtight ][ postclass pageclass clearfix entry-content ]">
			<div class="[ tcol-ss-12 tcol-md-8 ]">
				<?php the_post_thumbnail( 'full', array( 'class' => '[ margin-bottom ][ image-responsive ]' ) ); ?>
				<div class="[ margin-bottom ]">
					<?php the_content(); ?>
				</div>
				<h4 class="[ hometitle ]">Recents Projects</h4>
			</div>
			<aside class="[ tcol-ss-12 tcol-md-4 ]">
				<div class="[ margin-bottom ]">
					<h4 class="[ hometitle ]">Site link</h4>
					<p><a href="">link</a></p>
				</div>
				<div class="[ margin-bottom ]">
					<h4 class="[ hometitle ]">Tweets</h4>
				</div>
				<div class="[ margin-bottom ]">
					<h4 class="[ hometitle ]">RSS</h4>
				</div>
			</aside>
		</div>
	</div>
<?php get_template_part('templates/implementing-partner', 'projects'); ?>
<?php get_footer(); ?>