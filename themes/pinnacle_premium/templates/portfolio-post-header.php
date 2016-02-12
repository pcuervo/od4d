
<?php
	 if(!kadence_hide_pagetitle()) { ?>
<?php } else { 
	global $post, $pinnacle; 

		$bsub = get_post_meta( $post->ID, '_kad_subtitle', true );
		$shortcode_slider = get_post_meta( $post->ID, '_kad_shortcode_slider', true );
		$post_header_title = get_post_meta( $post->ID, '_kad_post_header_title', true );
		$title_color = get_post_meta( $post->ID, '_kad_pagetitle_title_color', true );
		$sub_color = get_post_meta( $post->ID, '_kad_pagetitle_sub_color', true );
		$title_align = get_post_meta( $post->ID, '_kad_pagetitle_align', true );
		$bg_color = get_post_meta( $post->ID, '_kad_pagetitle_bg_color', true );
		$bg_image = get_post_meta( $post->ID, '_kad_pagetitle_bg_image', true );
		$bg_position = get_post_meta( $post->ID, '_kad_pagetitle_bg_position', true );
		$bg_repeat = get_post_meta( $post->ID, '_kad_pagetitle_bg_repeat', true );
		$bg_cover = get_post_meta( $post->ID, '_kad_pagetitle_bg_cover', true );
		$bg_parallax = get_post_meta( $post->ID, '_kad_pagetitle_bg_parallax', true );
		$top_padding = get_post_meta( $post->ID, '_kad_pagetitle_ptop', true );
		$bottom_padding = get_post_meta( $post->ID, '_kad_pagetitle_pbottom', true );

	if(!empty($title_color) && $title_color != '#') {$tcolor = 'color:'.$title_color.';';} else {$tcolor = '';}
	if(!empty($sub_color) && $sub_color != '#') {$scolor = 'color:'.$sub_color.';';} else {$scolor = '';}
	if(!empty($bg_color) && $bg_color != '#') {$bcolor = 'background-color:'.$bg_color.';';} else {$bcolor = '';}
	if(!empty($bg_image)) {
		$b_image = 'background:url('.$bg_image.');';
		if($bg_position) {$b_position = 'background-position:'.$bg_position.';'; }
		if($bg_repeat) {$brepeat = 'background-repeat:repeat;';} else {$brepeat = "background-repeat:no-repeat;";}
		if($bg_cover) {$bcover = 'background-size:cover;';} else {$bcover = "";}
		if($bg_parallax) {$b_parallax = 'kad-parallax';} else {$b_parallax = '';}

		} else {
		$b_image = ''; $b_position = ""; $brepeat = ""; $bcover = ""; $b_parallax = '';
		if(!empty($bg_color) && $bg_color != '#') {$bcolor = 'background:'.$bg_color.';';} else {$bcolor = '';}}
	if(!empty($title_align) && $title_align != 'default') {$talign = 'text-align:'.$title_align.';';} else {$talign = '';}
	if(!empty($top_padding)) {$tpadding = 'padding-top:'.$top_padding.'px;';} else {$tpadding = '';}
	if(!empty($bottom_padding)) { $bpadding = 'padding-bottom:'.$bottom_padding.'px;';} else {$bpadding = '';}

if(!empty($post_header_title)) {
	$page_title_title = $post_header_title;
} else {
	if(isset($pinnacle['single_portfolio_header_title']) && $pinnacle['single_portfolio_header_title'] == 'custom') {
		if(isset($pinnacle['portfolio_header_title_text'])) {$page_title_title = $pinnacle['portfolio_header_title_text']; } else { $page_title_title = '';}
		$bsub = $pinnacle['portfolio_header_subtitle_text'];
	} else if (isset($pinnacle['single_portfolio_header_title']) && $pinnacle['single_portfolio_header_title'] == 'posttitle') {
		$page_title_title =  get_the_title();
	} else {
		if ( $terms = wp_get_post_terms( $post->ID, 'portfolio-type', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
              $cat = $terms[0];
              $page_title_title = $cat->name;
            } else {
            	$page_title_title = '';
            }
	}
}


if(!empty($shortcode_slider)) { ?>
			<div class="sliderclass">
			<?php echo do_shortcode( $shortcode_slider); ?>
			</div><!--sliderclass-->
<?php } else {
?>
<div id="pageheader" class="titleclass <?php echo $b_parallax;?>" style="<?php echo $bcolor.' '.$b_image.' '.$b_position.' '.$brepeat.' '.$bcover;?>">
<div class="header-color-overlay"></div>
<?php do_action("kt_header_overlay"); ?>
	<div class="container">
		<div class="page-header" style="<?php echo $tpadding.' '.$bpadding.' '.$talign;?>">
			<div class="row">
				<div class="col-md-12">
				  	<h1 style="<?php echo $tcolor;?>" class="product_page_title entry-title"><?php echo $page_title_title; ?></h1>
					  <?php if(!empty($bsub)) { echo '<p class="subtitle" style="'.$scolor.'"> '.$bsub.' </p>'; } ?>
					  <?php if(isset($pinnacle['portfolio_header_nav']) && $pinnacle['portfolio_header_nav'] == '1') { ?>
					  	<div class="portfolionav">
				   		<?php if(!empty($pinnacle['portfolio_arrow_nav']) && ($pinnacle['portfolio_arrow_nav'] == 'cat') ) {$arrownav = true;} else {$arrownav = false;}
							previous_post_link_plus( array('order_by' => 'menu_order', 'loop' => true, 'in_same_tax' => $arrownav, 'format' => '%link', 'link' => '<i class="kt-icon-arrow-left9"></i>') );
				   			$parent_link = get_post_meta( $post->ID, '_kad_portfolio_parent', true ); if(!empty($parent_link) && ($parent_link != 'default')) {$parent_id = $parent_link;} else {$parent_id = $pinnacle['portfolio_link'];}
				   			if( !empty($parent_id)){ ?><a href="<?php echo get_page_link($parent_id); ?>" ><?php } ?><i class="kt-icon-grid6"></i></a> 
					   	<?php next_post_link_plus( array('order_by' => 'menu_order', 'loop' => true, 'in_same_tax' => $arrownav, 'format' => '%link', 'link' => '<i class="kt-icon-uniE63C"></i>') ); ?>
					   </div>
					   <?php } ?>
				</div>
				<div class="col-md-12">
				   	<?php if(kadence_display_portfolio_breadcrumbs()) { kadence_breadcrumbs(); } ?>
				</div>
			</div>
		</div>
	</div><!--container-->
</div><!--titleclass-->

<?php } } ?>
<?php if(!kadence_hide_pagetitle()) { if( kadence_display_portfolio_breadcrumbs()) { ?> <div class="container bc_nomargin"> <?php kadence_breadcrumbs(); ?> </div><!--container--><?php } }?>
<?php do_action('after_page_header');?>