<?php

/**
* Here we add all the javascript that needs to be run on the footer.
**/
function footer_scripts(){
	global $post;

	if( wp_script_is( 'functions', 'done' ) ) : ?>
		<script type="text/javascript">
			$( document ).ready(function() {

				<?php if( is_archive( 'results' ) ) : ?>
					runIsotope('.js-filter-container', '.js-filter');
					runIsotope('.isotope-container', '.post');
					filterIsotope('.isotope-container', '.post');

					$('select[name="sort"]').change( function(){
						$sortAttribute =  $( "option:selected" ).val();
						$sortOrder = $( "option:selected" ).data( 'order' );
						sortResults( '.isotope-container', $sortAttribute, $sortOrder );
					});

				<?php endif; ?>

				<?php if( is_front_page() ) : ?>
					initMapProjects();
				<?php endif; ?>

				<?php if( is_page( 'the-program' ) OR is_page( 'le-programme' ) OR is_page( 'el-programa' ) ) : ?>
					initMapProjects();
				<?php endif; ?>

				<?php if( is_page( 'network' ) ) : ?>
					addAllMarkersPartners();
				<?php endif; ?>

				<?php if( is_singular() ) : ?>
					if ( $('.isotope-container').length > 0 ){
						runIsotope('.isotope-container', '.post');
					}
				<?php endif; ?>

			});
		</script>
	<?php endif;
	} // footer_scripts
?>