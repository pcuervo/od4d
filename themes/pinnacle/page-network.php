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

<div id="content" class="container">
	<div class="row">
			<div id="main" class="main col-md-12" role="main">
				<div class="postclass pageclass">
					<div id="map" class="[ network-map ]" style="height: 500px"></div>
					<?php the_content(); ?>
				</div>
				<div class="[ our-partners ]">
					<?php get_template_part('templates/implementing-partners', 'logos'); ?>
				</div>
			</div>
	</div><!-- /.row-->
</div><!-- /.content -->

<?php get_footer(); ?>