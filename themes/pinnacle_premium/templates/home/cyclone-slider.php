<div class="sliderclass cyclone_home_slider">
<?php global $pinnacle;  echo do_shortcode( $pinnacle['home_cyclone_slider'] ); ?>
<?php if(isset($pinnacle['header_slider_arrow']) && $pinnacle['header_slider_arrow'] == 1) {
        echo '<div class="kad_fullslider_arrow"><a href="#kt-slideto"><i class="kt-icon-arrow-down"></i></a></div>';
      }?>
</div><!--sliderclass-->
<div id="kt-slideto"></div>