
<?php
global $pinnacle; 
if(!kadence_hide_pagetitle()) { ?>
<?php } else { 
		$shop_page_id = woocommerce_get_page_id('shop');
		$bsub = get_post_meta( $shop_page_id, '_kad_subtitle', true );
		$hide = get_post_meta( $shop_page_id, '_kad_pagetitle_hide', true );
		$title_color = get_post_meta( $shop_page_id, '_kad_pagetitle_title_color', true );
		$sub_color = get_post_meta( $shop_page_id, '_kad_pagetitle_sub_color', true );
		$title_align = get_post_meta( $shop_page_id, '_kad_pagetitle_align', true );
		$bg_color = get_post_meta( $shop_page_id, '_kad_pagetitle_bg_color', true );
		$bg_image = get_post_meta( $shop_page_id, '_kad_pagetitle_bg_image', true );
		$bg_position = get_post_meta( $shop_page_id, '_kad_pagetitle_bg_position', true );
		$bg_repeat = get_post_meta( $shop_page_id, '_kad_pagetitle_bg_repeat', true );
		$bg_cover = get_post_meta( $shop_page_id, '_kad_pagetitle_bg_cover', true );
		$bg_parallax = get_post_meta( $shop_page_id, '_kad_pagetitle_bg_parallax', true );
		$top_padding = get_post_meta( $shop_page_id, '_kad_pagetitle_ptop', true );
		$bottom_padding = get_post_meta( $shop_page_id, '_kad_pagetitle_pbottom', true );
		
	if(!empty($title_color) && $title_color != '#') {$tcolor = 'color:'.$title_color.';';} else {$tcolor = '';}
	if(!empty($sub_color) && $sub_color != '#') {$scolor = 'color:'.$sub_color.';';} else {$scolor = '';}
	if(!empty($bg_color) && $bg_color != '#') {$bcolor = 'background-color:'.$bg_color.';';} else {$bcolor = '';}
	if(!empty($bg_image)) {
		$b_image = 'background:url('.$bg_image.');';
		if(isset($bg_position)) {$b_position = 'background-position:'.$bg_position.';'; }
		if(isset($bg_repeat) && $bg_repeat == '1') {$brepeat = 'background-repeat:repeat;';} else {$brepeat = 'background-repeat:no-repeat;';}
		if(isset($bg_cover) && $bg_cover == '1')  {$bcover = 'background-size:cover;';} else {$bcover = "";}
		if(isset($bg_parallax) && $bg_parallax == '1') {$b_parallax = 'kad-parallax';} else {$b_parallax = '';}

		} else {
		$b_image = ''; $b_position = ""; $brepeat = ""; $bcover = ""; $b_parallax = '';
		if(!empty($bg_color) && $bg_color != '#') {$bcolor = 'background:'.$bg_color.';';} else {$bcolor = '';}}
	if(!empty($title_align) && $title_align != 'default') {$talign = 'text-align:'.$title_align.';';} else {$talign = '';}
	if(!empty($top_padding)) {$tpadding = 'padding-top:'.$top_padding.'px;';} else {$tpadding = '';}
	if(!empty($bottom_padding)) { $bpadding = 'padding-bottom:'.$bottom_padding.'px;';} else {$bpadding = '';}

?>
<div id="pageheader" class="titleclass <?php echo $b_parallax;?>" style="<?php echo $bcolor.' '.$b_image.' '.$b_position.' '.$brepeat.' '.$bcover;?>">
<div class="header-color-overlay"></div>
	<div class="container">
		<div class="page-header" style="<?php echo $tpadding.' '.$bpadding.' '.$talign;?>">
			<div class="row">
				<div class="col-md-12">
				  	<h1 class="entry-title" itemprop="name" style="<?php echo $tcolor;?>"><?php woocommerce_page_title(); ?></h1>
					  <?php if(!empty($bsub)) { echo '<div class="subtitle" style="'.$scolor.'"> '.$bsub.' </div>'; } ?>
				</div>
				<div class="col-md-12">
				   	<?php if(kadence_display_shop_breadcrumbs()) { kadence_breadcrumbs(); } ?>
				</div>
			</div>
		</div>
	</div><!--container-->
</div><!--titleclass-->
<?php } ?>
<?php do_action('after_page_header');?>