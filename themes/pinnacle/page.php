<?php get_header(); ?>
	<?php get_template_part('templates/page', 'header'); ?>
	<div id="content" class="container">
		<div class="row">
			<div class="main <?php echo esc_attr( pinnacle_main_class() ); ?>" role="main">
				<div class="postclass pageclass clearfix entry-content" temprop="mainContentOfPage">
					<?php get_template_part('templates/content', 'page'); ?>
				</div>
				<?php do_action('kt_after_pagecontent'); ?>
			</div><!-- /.main -->
			<?php get_sidebar(); ?>
		</div><!-- /.row-->
		<?php if ( is_page() && $post->post_parent ) : ?>
			<?php get_template_part('templates/open-data-for', 'sector'); ?>
		<?php endif; ?>
	</div><!-- /.content -->
</div><!-- /.wrap -->
<?php get_footer(); ?>


