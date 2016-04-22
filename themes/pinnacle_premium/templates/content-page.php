<?php while (have_posts()) :
	the_post();
	if ( $post->post_parent == 602 ){ ?>
		<div class="[ rowtight ]">
			<div class="[ tcol-ss-12 tcol-md-8 ]">
				<?php the_content(); ?>
				<h4 class="[ hometitle ]">Highlights</h4>
				<!-- Aquí van los related posts -->
			</div>
			<div class="[ tcol-ss-12 tcol-md-4 ]">
				<?php
				$name = $post->post_name;
				show_related_results($name);
				?>
			</div>
		</div>
	<?php } else {
		the_content();
	}
endwhile; ?>