<div class="sliderclass">
<?php global $pinnacle;
if( function_exists('putRevSlider') ) {
	if(!empty($pinnacle['rev_slider_shop'])){
	putRevSlider( $pinnacle['rev_slider_shop'] );
	}
} ?>
</div><!--sliderclass-->