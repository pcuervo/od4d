<?php global $pinnacle; if(isset($pinnacle['sitewide_calltoaction']) && $pinnacle['sitewide_calltoaction'] == 1) { get_template_part('templates/sitewide', 'action'); } ?>
<footer id="containerfooter" class="footerclass">
  <div class="container">
  	<div class="row">
  		<?php if(isset($pinnacle['footer_layout'])) { $footer_layout = $pinnacle['footer_layout']; } else { $footer_layout = 'fourc'; }
  			if ($footer_layout == "fourc") {
  				if (is_active_sidebar('footer_1') ) { ?>
					<div class="col-md-3 col-sm-6 footercol1">
					<?php dynamic_sidebar('footer_1'); ?>
					</div>
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_2') ) { ?>
					<div class="col-md-3 col-sm-6 footercol2">
					<?php dynamic_sidebar('footer_2'); ?>
					</div>
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_3') ) { ?>
					<div class="col-md-3 col-sm-6 footercol3">
					<?php dynamic_sidebar('footer_3'); ?>
					</div>
	            <?php }; ?>
				<?php if (is_active_sidebar('footer_4') ) { ?>
					<div class="col-md-3 col-sm-6 footercol4">
					<?php dynamic_sidebar('footer_4'); ?>
					</div>
		        <?php }; ?>
		    <?php } else if($footer_layout == "five") {
  				if (is_active_sidebar('footer_1') ) { ?>
					<div class="col-md-12 col-sm-12 footercol1">
					<?php dynamic_sidebar('footer_1'); ?>
					</div>
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_2') ) { ?>
					<div class="col-md-4 footercol2">
					<?php dynamic_sidebar('footer_2'); ?>
					</div>
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_3') ) { ?>
					<div class="col-md-4 footercol3">
					<?php dynamic_sidebar('footer_3'); ?>
					</div>
	            <?php }; ?>
				<?php if (is_active_sidebar('footer_4') ) { ?>
					<div class="col-md-4 footercol4">
					<?php dynamic_sidebar('footer_4'); ?>
					</div>
		        <?php }; ?>
		    <?php } else if($footer_layout == "threec") {
		    	if (is_active_sidebar('footer_third_1') ) { ?>
					<div class="col-md-4 footercol1">
					<?php dynamic_sidebar('footer_third_1'); ?>
					</div>
            	<?php }; ?>
				<?php if (is_active_sidebar('footer_third_2') ) { ?>
					<div class="col-md-4 footercol2">
					<?php dynamic_sidebar('footer_third_2'); ?>
					</div>
		        <?php }; ?>
		        <?php if (is_active_sidebar('footer_third_3') ) { ?>
					<div class="col-md-4 footercol3">
					<?php dynamic_sidebar('footer_third_3'); ?>
					</div>
	            <?php }; ?>
	        <?php } else if($footer_layout == "six") {
					if (is_active_sidebar('footer_double_1') ) { ?>
					<div class="col-md-12 footercol1 kt-center-foot">
					<?php dynamic_sidebar('footer_double_1'); ?>
					</div>
		            <?php }; ?>
		        <?php if (is_active_sidebar('footer_double_2') ) { ?>
					<div class="col-md-12 footercol2 kt-center-foot">
					<?php dynamic_sidebar('footer_double_2'); ?>
					</div>
		            <?php }; ?>
			<?php } else {
					if (is_active_sidebar('footer_double_1') ) { ?>
					<div class="col-md-6 footercol1">
					<?php dynamic_sidebar('footer_double_1'); ?>
					</div>
		            <?php }; ?>
		        <?php if (is_active_sidebar('footer_double_2') ) { ?>
					<div class="col-md-6 footercol2">
					<?php dynamic_sidebar('footer_double_2'); ?>
					</div>
		            <?php }; ?>
		        <?php } ?>
        </div> <!-- Row -->
        <div class="footercredits clearfix">

    		<?php if (has_nav_menu('footer_navigation')) :
        	?><div class="footernav clearfix"><?php
              wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'footermenu'));
            ?></div><?php
        	endif;?>
        	<?php if(!empty($pinnacle['footer_text'])) { echo '<p>'. do_shortcode($pinnacle['footer_text']).'</p>';} ?>
    	</div><!-- credits -->
    </div><!-- container -->
</footer>

<?php wp_footer(); ?>
