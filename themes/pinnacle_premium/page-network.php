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
					<h1 class="kad-page-title entry-title" itemprop="name headline">Network</h1>
					<div class="subtitle"> Active OD4D Projects </div>
				</div>
			</div>
		</div>
	</div><!--container-->
</div><!--titleclass-->

<div id="content" class="[ container ]">
	<div class="[ rowtight ][ postclass pageclass clearfix entry-content ]">
		<article class="[ tcol-ss-12 tcol-md-6 ][ margin-top margin-bottom ]">
			<div id="map" class="[ network-map ][ margin-bottom ]" style="height: 350px"></div>
			<?php the_content(); ?>
		</article>
		<aside class="[ tcol-ss-12 tcol-md-6 ][ our-partners ]">
			<?php get_template_part('templates/implementing-partners', 'logos'); ?>
		</aside>
	</div><!-- /.row-->
</div><!-- /.content -->

<?php get_footer(); ?>