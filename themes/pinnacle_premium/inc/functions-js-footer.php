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
						console.log( $sortOrder );
						sortResults( '.isotope-container', $sortAttribute, $sortOrder );
					});

				<?php endif; ?>

				<?php if( is_front_page() ) : ?>
					initMapProjects();
				<?php endif; ?>

				<?php if( is_page( 'the-program' ) OR is_page( 'le-programme' ) OR is_page( 'el-programa' ) OR is_page( 'network' ) OR is_page('regions') ) : ?>
					addAllMarkersPartners();
				<?php endif; ?>

				<?php if( is_page( 'africa' ) ) : ?>
					initMapProjects( 5.249129, 20.849410 );
				<?php endif; ?>

				<?php if( is_page( 'asia' ) ) : ?>
					initMapProjects( 41.383236, 83.047808 );
				<?php endif; ?>

				<?php if( is_page( 'latin-america' ) ) : ?>
					initMapProjects( 0.519690, -60.786332 );
				<?php endif; ?>

				<?php if( is_page( 'eastern-europe-central' ) ) : ?>
					initMapProjects( 55.283516, 38.874491 );
				<?php endif; ?>

				<?php if( is_page( 'middle-east-and-northern-africa' ) ) : ?>
					initMapProjects( 31.380724, 42.684882 );
				<?php endif; ?>

				<?php if( is_page( 'caribbean' ) ) : ?>
					initMapProjects( 22.731635, -78.337274 );
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