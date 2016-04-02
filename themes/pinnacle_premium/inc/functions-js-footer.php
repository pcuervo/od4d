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

					$('select[name="sort"]').change( function(){
						$sortAttribute =  $( "option:selected" ).val();
						$sortOrder = $( "option:selected" ).data( 'order' );
						console.log( $sortOrder );
						sortResults( '.isotope-container', $sortAttribute, $sortOrder );
					})

				<?php endif; ?>

				<?php if( is_front_page() ) : ?>
					initMapProjects();
				<?php endif; ?>

				<?php if( is_page() ) : ?>
					if ( $('.isotope-container').length > 0 ){
						runIsotope('.isotope-container', '.post');
					}

				<?php endif; ?>

			});
		</script>
<?php
	endif;
}// footer_scripts
?>