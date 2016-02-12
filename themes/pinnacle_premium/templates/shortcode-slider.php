<div class="sliderclass">
<?php global $post; $shortcode = get_post_meta( $post->ID, '_kad_feature_shortcode_slider', true );
if(!empty($shortcode)) { echo do_shortcode( $shortcode ); } ?>
</div><!--sliderclass-->
