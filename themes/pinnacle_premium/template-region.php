<?php
/*
Template Name: Region
*/
?>
<?php get_header(); ?>
	<?php get_template_part('templates/page', 'header'); ?>
	
    <div id="content" class="container">
   	<div class="row">
    <div class="main <?php echo kadence_main_class(); ?>" role="main">
    	<div class="postclass pageclass clearfix entry-content" itemprop="mainContentOfPage">
    		<div class="postclass pageclass clearfix entry-content [ margin-bottom ]" itemprop="mainContentOfPage">
			<?php get_template_part('templates/content', 'page'); ?> 
		</div>
		<?php do_action('kt_after_pagecontent'); ?>

			<!-- Mostrar el mapa que actualmente está en “The Program” y debajo, los recuadros por cada región que te llevan a dichas secciones -->
			

		</div>

</div><!-- /.main -->
  <?php get_footer(); ?>