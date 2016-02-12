<?php 
//Shortcode for Custom Carousels
function kad_custom_carousel_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'columns' => '',
		'speed' => '',
		'scroll' => ''
), $atts));
	$carousel_rn = (rand(10,100));
	if(empty($columns)) {$columns = '4';}
	if(empty($speed)) {$speed = '9000';}
	if(empty($scroll) || $scroll == 1) {$scroll = 'items:1,';} else {$scroll = '';}

ob_start(); ?>
				<div class="carousel_outerrim kad-animation" data-animation="fade-in" data-delay="0">
				<div class="home-margin fredcarousel">
				<div id="carouselcontainer-<?php echo $carousel_rn; ?>" class="rowtight fadein-carousel">
				<div id="carousel-<?php echo $carousel_rn; ?>" class="clearfix caroufedselclass">
						<?php if ($columns == '2') {$itemsize = 'tcol-lg-6 tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 560; $slideheight = 560; $md = 2; $sm = 2; $xs = 1; $ss = 1;} 
						else if ($columns == '1') {$itemsize = 'tcol-lg-12 tcol-md-12 tcol-sm-12 tcol-xs-12 tcol-ss-12'; $slidewidth = 560; $slideheight = 560; $md = 1; $sm = 1; $xs = 1; $ss = 1;} 
		                else if ($columns == '3'){ $itemsize = 'tcol-lg-4 tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 366; $slideheight = 366; $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
		                else if ($columns == '6'){ $itemsize = 'tcol-lg-2 tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 240; $slideheight = 240; $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
		                else if ($columns == '5'){ $itemsize = 'tcol-lg-25 tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 240; $slideheight = 240; $md = 5; $sm = 4; $xs = 3; $ss = 2;} 
		                else {$itemsize = 'tcol-lg-3 tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 269; $slideheight = 269; $md = 4; $sm = 3; $xs = 2; $ss = 1;} ?>
								<?php echo do_shortcode($content); ?>
            		</div>
            	</div>
			<div class="clearfix"></div>
            <a id="prevport-<?php echo $carousel_rn; ?>" class="prev_carousel kt-icon-arrow-left" href="#"></a>
			<a id="nextport-<?php echo $carousel_rn; ?>" class="next_carousel kt-icon-arrow-right" href="#"></a>
			</div></div>
			<script type="text/javascript"> jQuery( window ).load(function () {var $wcontainer = jQuery('#carouselcontainer-<?php echo $carousel_rn; ?>'); var $container = jQuery('#carousel-<?php echo $carousel_rn; ?>');
	 				setWidths(); 
	 				function initCarousel_custom() {
	 					$container.carouFredSel({
							scroll: { <?php echo $scroll; ?> easing: "swing", duration: 700, pauseOnHover : true}, auto: {play: true, timeoutDuration: <?php echo $speed; ?>},
							prev: '#prevport-<?php echo $carousel_rn; ?>', next: '#nextport-<?php echo $carousel_rn; ?>', pagination: false, swipe: true, items: {visible: null}
						});
	 				}
	 				initCarousel_custom();
		 				jQuery(window).on("debouncedresize", function( event ) { 
		 					$container.trigger("destroy"); setWidths();
							initCarousel_custom();
						});
		 			$wcontainer.animate({'opacity' : 1});
					function getUnitWidth() {var width;
					if(jQuery(window).width() <= 480) {
					width = $wcontainer.width() / <?php echo $ss;?>;
					} else if(jQuery(window).width() <= 768) {
					width = $wcontainer.width() / <?php echo $xs;?>;
					} else if(jQuery(window).width() <= 990) {
					width = $wcontainer.width() / <?php echo $sm;?>;
					} else {
					width = $wcontainer.width() / <?php echo $md;?>;
					}
					return width;
					}
					function setWidths() {
					var unitWidth = getUnitWidth() -1;
					$container.children().css({ width: unitWidth });
					} });
			</script>				

	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}

//Shortcode for Custom Carousel Items
function kad_custom_carousel_item_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'columns' => '',
), $atts));
	if(empty($columns)) {$columns = '4';}

ob_start(); ?>
						<?php if ($columns == '2') {$itemsize = 'tcol-lg-6 tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 560; $slideheight = 560; $md = 2; $sm = 2; $xs = 1; $ss = 1;}
						else if ($columns == '1') {$itemsize = 'tcol-lg-12 tcol-md-12 tcol-sm-12 tcol-xs-12 tcol-ss-12'; $slidewidth = 560; $slideheight = 560; $md = 1; $sm = 1; $xs = 1; $ss = 1;} 
		                else if ($columns == '3'){ $itemsize = 'tcol-lg-4 tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 366; $slideheight = 366; $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
		                else if ($columns == '6'){ $itemsize = 'tcol-lg-2 tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 240; $slideheight = 240; $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
		                else if ($columns == '5'){ $itemsize = 'tcol-lg-25 tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 240; $slideheight = 240; $md = 5; $sm = 4; $xs = 3; $ss = 2;} 
		                else {$itemsize = 'tcol-lg-3 tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 269; $slideheight = 269; $md = 4; $sm = 3; $xs = 2; $ss = 1;} ?>
							<div class="<?php echo $itemsize; ?> kad_customcarousel_item">
								<div class="carousel_item grid_item">
								<?php echo do_shortcode($content); ?>
								</div>
							</div>
	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}