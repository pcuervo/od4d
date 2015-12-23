<?php
	global $post;
	get_header();

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
	$implementing_partner = get_implementing_partner( $post->ID ); //Implementing partner

	// $thumb = get_result_meta( $post->ID, '_abstract_meta' ); //File (PDF, Word, Excel, graphics)
	// $thumb = get_result_meta( $post->ID, '_abstract_meta' ); //Related projects
	// $thumb = get_result_meta( $post->ID, '_abstract_meta' ); //Categories
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
	<div <?php post_class('postclass'); ?>>
		<div class="[ main row single-article ]">
			<div class="col-lg-9 col-md-8" role="main">
				<article>
					<?php if($image) : ?>
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
			</div>
			<div class="[ col-lg-3 col-md-4 ][ margin-top ]">
				<p><strong>Context:</strong> <?php echo $context; ?></p>
				<p><strong>Year of publication:</strong> <?php echo $year_of_publication; ?></p>
				<p><strong>Authors:</strong> <?php echo $authors; ?></p>
				<p><strong>Institution:</strong> <?php echo $institution; ?></p>
				<p><strong>City:</strong> <?php echo $city; ?></p>
				<p><strong>URL:</strong> <a href="<?php echo $url; ?>"> link</a></p>
				<p><strong>Implementing partner:</strong> <?php echo $implementing_partner; ?></p>
			</div>
		</div>
	</div>
</div>

<?php get_footer() ?>