<?php
	global $post;
	get_header();
?>

<div id="pageheader" class="titleclass">
	<div class="header-color-overlay"></div>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-12">
					<h1 class="post_page_title entry-title" itemprop="name headline"><?php echo get_the_title(); ?></h1>
				</div>
			</div>
		</div>
	</div><!--container-->
</div><!--titleclass-->

<div id="content" class="container">
	<div class="row single-article" itemscope="">
		<div class="main col-lg-9 col-md-8" role="main">
			<?php while ( have_posts()) : the_post(); ?>
				<article <?php post_class('postclass'); ?>
					<?php
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url( $thumb,'full' );
					$image = $img_url;

					$abstract = get_result_meta( $post->ID, '_abstract_meta' ); // Abstract
					$context = get_result_meta( $post->ID, '_context_meta' ); //Context
					$year_of_publication = get_result_meta( $post->ID, '_year_of_publication_meta' ); //Year of Publicaction
					$authors = get_result_meta( $post->ID, '_authors_meta' ); //Authors
					$institution = get_result_meta( $post->ID, '_institution_meta' ); //Institution
					$city = get_result_meta( $post->ID, '_city_meta' ); //City
					$url = get_result_meta( $post->ID, '_url_meta' ); //URL
					$sector = get_sector( $post->ID ); 
					$region = get_region( $post->ID ); 
					$focus_areas_of_impact = get_focus_areas_of_impact( $post->ID ); 

					// $thumb = get_implementing_partner( $post->ID, '_abstract_meta' ); //Implementing partner
					// $thumb = get_result_meta( $post->ID, '_abstract_meta' ); //File (PDF, Word, Excel, graphics)
					// $thumb = get_result_meta( $post->ID, '_abstract_meta' ); //Related projects
					// $thumb = get_result_meta( $post->ID, '_abstract_meta' ); //Categories

					if($image) : ?>
						<section class="postfeat">
							<div class="imghoverclass post-single-img" itemprop="image">
								<a href="<?php echo esc_url($img_url); ?>" data-rel="lightbox" class="">
									<img src="<?php echo esc_url($image); ?>" itemprop="image" alt="<?php the_title(); ?>" />
								</a>
							</div>
						</section>
					<?php endif; ?>

					<?php get_template_part('templates/entry', 'meta-subhead'); ?>

					<?php
						$abstract = get_result_meta( $post->ID, '_abstract_meta' );
						if( $abstract ){
							echo '<p><strong>' . $abstract . '</strong></p>';
						}
					?>

					<div class="entry-content clearfix" itemprop="description articleBody">
						<?php the_content(); ?>
						<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'pinnacle'), 'after' => '</p></nav>')); ?>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="main col-lg-3 col-md-4">
			<p>Abstract: <?php echo $abstract; ?></p>
			<p><?php echo $context; ?></p>
			<p><?php echo $year_of_publication; ?></p>
			<p><?php echo $authors; ?></p>
			<p><?php echo $institution; ?></p>
			<p><?php echo $city; ?></p>
			<p><?php echo $url; ?></p>
			<p><?php echo $sector; ?></p>
			<p><?php echo $region; ?></p>
			<p><?php echo $focus_areas_of_impact; ?></p>
		</div>
	</div>
</div>

<?php get_footer() ?>