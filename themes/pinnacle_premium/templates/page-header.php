
<?php
	 if(!kadence_hide_pagetitle()) { ?>
<?php } else { 
	global $post, $pinnacle;

	if(is_page()) {
		$shortcode_slider = get_post_meta( $post->ID, '_kad_shortcode_slider', true );
		$bsub = get_post_meta( $post->ID, '_kad_subtitle', true );
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
	} else if(is_category()) {
		$bsub = category_description();
		$shortcode_slider = '';
	} else if(is_tag()) {
		$bsub = tag_description();
		$shortcode_slider = '';
	} else {
		$shortcode_slider = '';
		$bsub = '';
	}
	if(!empty($title_color) && $title_color != '#') {$tcolor = 'color:'.$title_color.';';} else {$tcolor = '';}
	if(!empty($sub_color) && $sub_color != '#') {$scolor = 'color:'.$sub_color.';';} else {$scolor = '';}
	if(!empty($bg_color) && $bg_color != '#') {$bcolor = 'background-color:'.$bg_color.';';} else {$bcolor = '';}
	if(!empty($bg_image)) {
		$b_image = 'background:url('.$bg_image.');';
		$b_position = 'background-position:'.$bg_position.';';
		if($bg_repeat) {$brepeat = 'background-repeat:repeat;';} else {$brepeat = 'background-repeat:no-repeat;';}
		if($bg_cover) {$bcover = 'background-size:cover;';} else {$bcover = "";}
		if($bg_parallax) {$b_parallax = 'kad-parallax';} else {$b_parallax = '';}

		} else {
		$b_image = ''; $b_position = ""; $brepeat = ""; $bcover = ""; $b_parallax = '';
		if(!empty($bg_color) && $bg_color != '#') {$bcolor = 'background:'.$bg_color.';';} else {$bcolor = '';}}
	if(!empty($title_align) && $title_align != 'default') {$talign = 'text-align:'.$title_align.';';} else {$talign = '';}
	if(!empty($top_padding)) {$tpadding = 'padding-top:'.$top_padding.'px;';} else {$tpadding = '';}
	if(!empty($bottom_padding)) { $bpadding = 'padding-bottom:'.$bottom_padding.'px;';} else {$bpadding = '';}

if(!empty($shortcode_slider)) { ?>
			<div class="sliderclass">
			<?php echo do_shortcode( $shortcode_slider); ?>
			</div><!--sliderclass-->
<?php } else {
?>
<div id="pageheader" class="titleclass <?php echo $b_parallax;?>" style="<?php echo $bcolor.' '.$b_image.' '.$b_position.' '.$brepeat.' '.$bcover?>">
<div class="header-color-overlay"></div>
<?php do_action("kt_header_overlay"); ?>
	<div class="container">
		<div class="page-header" style="<?php echo $tpadding.' '.$bpadding.' '.$talign;?>">
			<div class="row">
				<div class="col-md-12">
				  	<h1 style="<?php echo $tcolor;?>" class="kad-page-title">
				  		<?php echo apply_filters('kadence_page_title', kadence_title() ); ?>
				  	</h1>
					  <?php if(!empty($bsub)) { echo '<p class="subtitle" style="'.$scolor.'"> '.$bsub.' </p>'; } ?>
				</div>
				<div class="col-md-12">
				   	<?php if(kadence_display_page_breadcrumbs()) { kadence_breadcrumbs(); } ?>
				</div>
			</div>
		</div>
	</div><!--container-->
</div><!--titleclass-->
<?php } }?>
<?php if(!kadence_hide_pagetitle()) { if( kadence_display_page_breadcrumbs()) { ?> <div class="container bc_nomargin"> <?php kadence_breadcrumbs(); ?> </div><!--container--><?php } }?>
<?php do_action('after_page_header');?>