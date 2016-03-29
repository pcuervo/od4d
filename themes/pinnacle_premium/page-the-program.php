<?php
global $post;
get_header();
the_post();
?>

<div id="pageheader" class="titleclass">
	<div class="header-color-overlay"></div>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-12">
					<h1 class="kad-page-title entry-title" itemprop="name headline">The Program</h1>
				</div>
			</div>
		</div>
	</div><!--container-->
</div><!--titleclass-->

<div id="content" class="[ container ]">
	<div class="[ rowtight ][ postclass pageclass clearfix entry-content ]">
		<article class="[ tcol-ss-12 ][ margin-top margin-bottom ]">
			<p class="[ text-right ]">
				<a class="[ kad-btn kad-btn--small kad-btn-border-primary ][ inline-block ]" href="http://pcuervo.com/od4d/le-programme">français</a><a class="[ kad-btn kad-btn--small kad-btn-border-primary ][ inline-block ]" href="http://pcuervo.com/od4d/el-programa">español</a>
			</p>
			<div id="map" class="[ network-map ][ margin-bottom ]" style="height: 350px"></div>
			<?php the_content(); ?>
		</article>
	</div><!-- /.row-->
</div><!-- /.content -->

<?php get_footer(); ?>