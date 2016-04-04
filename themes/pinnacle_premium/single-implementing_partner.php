<?php
	global $post;
	get_header();

	$website_link = get_implementing_partner_meta( $post->ID, '_official_website_meta' );
	$twitter_username = get_implementing_partner_meta( $post->ID, '_twitter_username_meta' );
	$rss_link = get_implementing_partner_meta( $post->ID, '_rss_link_meta' );
	$widget_id = get_post_meta($post->ID, '_widget_id_meta', true);
?>

	<div id="pageheader" class="titleclass">
		<div class="header-color-overlay"></div>
		<div class="container">
			<div class="page-header">
				<div class="row">
					<div class="col-md-12">
						<h1 class="kad-page-title entry-title" itemprop="name headline"><?php the_title( ); ?></h1>
					</div>
				</div>
			</div>
		</div><!--container-->
	</div>
	<br />
	<div class="[ container ]">
		<div class="[ rowtight ][ postclass pageclass clearfix entry-content ]">
			<div class="[ tcol-ss-12 tcol-md-8 ]">
				<?php the_post_thumbnail( 'full', array( 'class' => '[ margin-bottom ][ image-responsive image-centered ][ padding ]' ) ); ?>
				<div class="[ margin-bottom ]">
					<?php the_content(); ?>
				</div>
				<h4 class="[ hometitle ]">Recents Results</h4>
				<?php get_template_part('templates/implementing-partner', 'projects'); ?>
			</div>
			<aside class="[ tcol-ss-12 tcol-md-4 ]">
				<?php if ( $website_link != '' ){ ?>
					<div class="[ margin-bottom ]">
						<h4 class="[ hometitle ]">Official website</h4>
						<p class="[ text-center ]"><a href="<?php echo $website_link; ?>"><?php echo $website_link; ?></a></p>
					</div>
				<?php } ?>
				<?php if ( $twitter_username != '' AND $widget_id != ''){ ?>
					<div class="[ margin-bottom ]">
						<h4 class="[ hometitle ]">Twitter feed</h4>
						<a href="https://twitter.com/<?php echo $twitter_username; ?>" target="_blank">@<?php echo $twitter_username; ?></a>

						<div id="post-85" class="blog_item postclass" itemscope="" itemtype="http://schema.org/BlogPosting">
							<?php if ($widget_id != ''): ?>
								<a class="twitter-timeline" href="https://twitter.com/<?php echo $twitter_username; ?>" data-widget-id="716012088699686912">Tweets por el @<?php echo $twitter_username; ?>.</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							<?php endif; ?>
						</div> <!-- Blog Item -->
					</div>
				<?php } ?>
				<div class="[ margin-bottom ]">
					<h4 class="[ hometitle ]">Accountability</h4>
				</div>

			</aside>
		</div>
	</div>

<script>//!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<script>function twit(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}
twit(document,"script","twitter-wjs");</script>
<?php get_footer(); ?>