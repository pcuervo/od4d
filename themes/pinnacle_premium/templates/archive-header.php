
<?php
global $pinnacle; 
if(!kadence_hide_pagetitle()) { ?>
<?php } else { 


		$cat_term_id = get_queried_object()->term_id;
		
		if(is_category()) {
		 	$bsub = category_description($cat_term_id);
		} else if(is_tag()) {
			$bsub = tag_description($cat_term_id);
		} else if (class_exists('woocommerce')) {
				if(is_product_category()) { 
				$pcat_term = get_term($cat_term_id,'product_cat');
				$bsub = $pcat_term->description;
			} else if(is_product_tag()) { 
				$pcat_term = get_term($cat_term_id,'product_tag');
				$bsub = $pcat_term->description;
			}
		}
		$meta = get_option('product_cat_pageheader');
		if (empty($meta)) $meta = array();
		if (!is_array($meta)) $meta = (array) $meta;
		$meta = isset($meta[$cat_term_id]) ? $meta[$cat_term_id] : array();
		if(isset($meta['kad_pagetitle_title_color'])) {$title_color = $meta['kad_pagetitle_title_color'];}
		if(isset($meta['kad_pagetitle_sub_color'])) {$sub_color = $meta['kad_pagetitle_sub_color'];}
		if(isset($meta['kad_pagetitle_align'])) { $title_align = $meta['kad_pagetitle_align'];}
		if(isset($meta['kad_pagetitle_bg_color'])) {$bg_color = $meta['kad_pagetitle_bg_color']; }
		if(isset($meta['kad_pagetitle_bg_image'])) { $bg_image_array = $meta['kad_pagetitle_bg_image']; $src = wp_get_attachment_image_src($bg_image_array[0], 'full'); $bg_image = $src[0];}
		if(isset($meta['kad_pagetitle_bg_position'])) { $bg_position = $meta['kad_pagetitle_bg_position']; }
		if(isset($meta['kad_pagetitle_bg_repeat'])) {$bg_repeat = $meta['kad_pagetitle_bg_repeat']; }
		if(isset($meta['kad_pagetitle_bg_cover'])) {$bg_cover = $meta['kad_pagetitle_bg_cover']; }
		if(isset($meta['kad_pagetitle_bg_parallax'])) {$bg_parallax = $meta['kad_pagetitle_bg_parallax'];}
		if(isset($meta['kad_pagetitle_ptop'])) {$top_padding = $meta['kad_pagetitle_ptop'];}
		if(isset($meta['kad_pagetitle_pbottom'])) {$bottom_padding = $meta['kad_pagetitle_pbottom'];}
	if(!empty($title_color) && $title_color != '#') {$tcolor = 'color:'.$title_color.';';} else {$tcolor = '';}
	if(!empty($sub_color) && $sub_color != '#') {$scolor = 'color:'.$sub_color.';';} else {$scolor = '';}
	if(!empty($bg_color) && $bg_color != '#') {$bcolor = 'background-color:'.$bg_color.';';} else {$bcolor = '';}
	if(!empty($bg_image)) {
		$b_image = 'background:url('.$bg_image.');';
		if(isset($bg_position)) {$b_position = 'background-position:'.$bg_position.';'; }
		if(isset($bg_repeat) && $bg_repeat == '1') {$brepeat = 'background-repeat:repeat;';} else {$brepeat = 'background-repeat:no-repeat;';}
		if(isset($bg_cover) && $bg_cover == '1')  {$bcover = 'background-size:cover;';} else {$bcover = "";}
		if(isset($bg_parallax) && $bg_parallax == '1') {$b_parallax = 'kad-parallax kt-panel-row-parallax-stellar'; $b_parallax_data = 'data-stellar-background-ratio="0.5"'; } else {$b_parallax = ''; $b_parallax_data = '';}

		} else {
		$b_image = ''; $b_position = ""; $brepeat = ""; $bcover = ""; $b_parallax = '';
		if(!empty($bg_color) && $bg_color != '#') {$bcolor = 'background:'.$bg_color.';';} else {$bcolor = '';}}
	if(!empty($title_align) && $title_align != 'default') {$talign = 'text-align:'.$title_align.';';} else {$talign = '';}
	if(!empty($top_padding)) {$tpadding = 'padding-top:'.$top_padding.'px;';} else {$tpadding = '';}
	if(!empty($bottom_padding)) { $bpadding = 'padding-bottom:'.$bottom_padding.'px;';} else {$bpadding = '';}

?>
<div id="pageheader" class="titleclass <?php echo esc_attr($b_parallax);?>" <?php if(!empty($b_parallax_data)) {echo $b_parallax_data;}?> style="<?php echo $bcolor.' '.$b_image.' '.$b_position.' '.$brepeat.' '.$bcover;?>">
<div class="header-color-overlay"></div>
<?php do_action("kt_header_overlay"); ?>
	<div class="container">
		<div class="page-header" style="<?php echo $tpadding.' '.$bpadding.' '.$talign;?>">
			<div class="row">
				<div class="col-md-12">
				  	<h1 style="<?php echo $tcolor;?>"><?php echo kadence_title(); ?></h1>
					  <?php if(!empty($bsub)) { echo '<div class="subtitle" style="'.$scolor.'"> '.$bsub.' </div>'; } ?>
				</div>
				<div class="col-md-12">
				   	<?php if(kadence_display_archive_breadcrumbs()) { kadence_breadcrumbs(); } ?>
				</div>
			</div>
		</div>
	</div><!--container-->
</div><!--titleclass-->
<?php } ?>
<?php do_action('after_page_header');?>