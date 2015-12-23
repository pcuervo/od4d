<?php

/**
* Here we add all the javascript that needs to be run on the footer.
**/
function footer_scripts(){
	global $post;

	if( wp_script_is( 'functions', 'done' ) ) :

?>
		<script type="text/javascript">
			$( document ).ready(function() {

				<?php if( is_archive( 'results' ) ) : ?>
					runIsotope('.js-filter-container', '.js-filter');
					runIsotope('.isotope-container', '.post');
					filterIsotope('.isotope-container', '.post');
				<?php endif; ?>

				<?php if( is_page( 'network' ) ) : ?>
					addAllMarkers();
				<?php endif; ?>

			});
		</script>
<?php
	endif;
}// footer_scripts
?>