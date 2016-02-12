<?php
/*
- Force plugins to stop stating incorrect errors -
wp_footer();
*/
			if (kadence_display_sidebar()) : ?>
				<aside class="<?php echo kadence_sidebar_class(); ?>" role="complementary">
					<div class="sidebar">
						<?php get_template_part('templates/sidebar'); ?>
					</div><!-- /.sidebar -->
				</aside><!-- /aside -->
			<?php endif; ?>
			</div><!-- /.row-->
		</div><!-- /.content -->
	</div><!-- /.wrap -->

	<?php do_action('get_footer');
	get_template_part('templates/footer'); ?>
</div><!--Wrapper-->
</body>
</html>