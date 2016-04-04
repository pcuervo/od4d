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
	$cityb = get_result_meta( $post->ID, '_city_meta_b' );
	$cityc = get_result_meta( $post->ID, '_city_meta_c' );
	$cityd = get_result_meta( $post->ID, '_city_meta_d' );
	$citye = get_result_meta( $post->ID, '_city_meta_e' );
	$url = get_result_meta( $post->ID, '_url_meta' ); //URL
	$implementing_partner = get_implementing_partner( $post->ID ); //Implementing partner
	$region = get_region( $post->ID ); //Implementing partner
	$sector = get_sector( $post->ID ); //Implementing partner
?>

<div id="pageheader" class="titleclass">
	<div class="header-color-overlay"></div>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-12">
					<h1 class="post_page_title entry-title" itemprop="name headline">Result - <?php echo get_the_title(); ?></h1>
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
						<?php
							the_content();
							$pdfs = get_result_pdfs( $post->ID );
							if( ! empty( $pdfs ) ) : ?>
							<h5>Documentos</h5>
							<div class="[ isotope-container ]">
								<div class="[ rowtight ]">
									<?php foreach ( $pdfs as $key => $pdf ) : ?>
										<div class="[ post ][ tcol-ss-12 tcol-sm-6 tcol-md-4 ][ margin-bottom ]">
											<div class="[ post__card ]">
												<a class="[ text-ellipsis ]" href="<?php echo $pdf['url'] ?>" target="_blank"><?php echo $pdf['title'] ?></a>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
						<?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'pinnacle'), 'after' => '</p></nav>')); ?>
					</div>
				</article>

				<?php
				$related_projects = get_related_projects( $implementing_partner, $region, $sector, 3 );
				if( $related_projects ) : ?>
					<article>
						<h4 class="[ hometitle ]">Related Work</h4>
						<div class="[ row ]">
							<?php foreach ( $related_projects as $name => $project ) : ?>
								<div class="[ col-sm-12 col-md-4 ][ related-project ]">
									<a href="<?php echo $project['permalink'] ?>">
										<?php echo $name; ?>
									</a>
								</div>
							<?php endforeach; ?>
						</div>
					</article>
				<?php else :
					$latest_projects = get_latest_projects( 3 ); ?>
					<article>
						<h4 class="[ hometitle ]">Latest projects</h4>
						<div class="[ row ]">
							<?php foreach ( $latest_projects as $name => $project ) : ?>
								<div class="[ col-sm-12 col-md-6 col-lg-4 ][ related-project ]">
									<a href="<?php echo $project['permalink'] ?>">
										<?php echo $name; ?>
									</a>
								</div>
							<?php endforeach; ?>
						</div>
					</article>
				<?php endif; ?>
				<div class="[ related-projects ]"></div>
			</div>
			<div class="[ col-lg-3 col-md-4 ][ margin-top ]">
				<?php if ( ! empty( $year_of_publication ) ) { ?>
					<p><strong>Year of publication:</strong> <?php echo $year_of_publication; ?></p>
				<?php } ?>
				<?php if ( ! empty( $authors ) ) { ?>
					<p><strong>Authors:</strong> <?php echo $authors; ?></p>
				<?php } ?>
				<?php if ( ! empty( $institution ) ) { ?>
					<p><strong>Institution:</strong> <?php echo $institution; ?></p>
				<?php } ?>
				<?php if ( ! empty( $region ) ) { ?>
					<p><strong>Region:</strong> <?php echo $region; ?></p>
				<?php } ?>
				<?php if ( ! empty( $sector ) ) { ?>
					<p><strong>Sector:</strong> <?php echo $sector; ?></p>
				<?php } ?>
				<?php if ( ! empty( $city ) ) { ?>
					<p><strong>City:</strong> <?php echo $city; ?></p>
				<?php } ?>
				<?php if ( ! empty( $cityb ) ) { ?>
					<p><strong>City 2:</strong> <?php echo $cityb; ?></p>
				<?php } ?>
				<?php if ( ! empty( $cityc ) ) { ?>
					<p><strong>City 3:</strong> <?php echo $cityc; ?></p>
				<?php } ?>
				<?php if ( ! empty( $cityd ) ) { ?>
					<p><strong>City 4:</strong> <?php echo $cityd; ?></p>
				<?php } ?>
				<?php if ( ! empty( $citye ) ) { ?>
					<p><strong>City 5:</strong> <?php echo $citye; ?></p>
				<?php } ?>
				<?php if ( ! empty( $url ) ) { ?>
					<p><strong>URL:</strong> <a href="<?php echo $url; ?>"> click here</a></p>
				<?php } ?>
				<?php if ( ! empty( $implementing_partner ) ) { ?>
					<p><strong>Implementing partner:</strong> <?php echo $implementing_partner; ?></p>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<?php get_footer() ?>