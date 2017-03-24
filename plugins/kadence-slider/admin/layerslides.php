<section id="ksp-slide-settings" class="ksp-tab-content" style="display:none;">
<div id="ksp-slides">
<div class="ksp-tab-title">
		<h3><?php echo __('Edit Slides', 'kadence-slider');?></h3>
	</div>
	<div class="ksp-slide-tabs ksp-small-tabs">
		<ul class="ksp-sortable ksp-clearfix">
			<?php
			if($edit) {
				$j = 0;
				$slides_num = count($slides);
				foreach($slides as $slide) {
					if($j == $slides_num - 1) {
						echo '<li class="kt-ui-default active">';
					}
					else {
						echo '<li class="kt-ui-default">';
					}
					echo '<a>' . __('Slide', 'kadence-slider') . ' <span class="ksp-slide-index">' . (($slide->position) + 1) . '</span></a>';
					echo '<span class="ksp-duplicate" title="'.__("Duplicate", "kadence-slider").'"></span>';
					echo '<span class="ksp-close" title="'.__("Delete", "kadence-slider").'"></span>';
					echo '</li>';
					
					$j++;
				}
			}
			?>
			<li class="kt-ui-default kt-ui-disabled"><a class="ksp-add-new"><?php _e('Add Slide', 'kadence-slider'); ?></a></li>
		</ul>
		
		<div class="ksp-slides-list">
			<?php
				if($edit) {
					foreach($slides as $slide) {
						echo '<div class="ksp-slide">';
						ksp_admin_output_Slide($slider, $slide, $edit);
						echo '</div>';
					}
				}
			?>
		</div>		
		<div class="ksp-void-slide"><?php ksp_admin_output_Slide($slider, false, $edit); ?></div>
		
		<div style="clear: both"></div>
	</div>
</div>
</section>

<?php
// Prints a slide. If the ID is not false, prints the values from MYSQL database, else prints a slide with default values. It has to receive the $edit variable because the elements.php file has to see it
function ksp_admin_output_Slide($slider, $slide, $edit) {
	$void = !$slide ? true : false;	
	$animations = array(
		'fade' => array(__('Fade', 'kadence-slider'), true),
		'fadeLeft' => array(__('Fade left', 'kadence-slider'), false),
		'fadeRight' => array(__('Fade right', 'kadence-slider'), false),
		'slideLeft' => array(__('Slide left', 'kadence-slider'), false),
		'slideRight' => array(__('Slide right', 'kadence-slider'), false),
		'slideUp' => array(__('Slide up', 'kadence-slider'), false),
		'slideDown' => array(__('Slide down', 'kadence-slider'), false),
	);
	$slider_background_options = array(
		'left top' => array(__('Left Top', 'kadence-slider'), false),
		'left center' => array(__('Left Center', 'kadence-slider'), false),
		'left bottom' => array(__('Left Bottom', 'kadence-slider'), false),
		'center top' => array(__('Center Top', 'kadence-slider'), false),
		'center center' => array(__('Center Center', 'kadence-slider'), true),
		'center bottom' => array(__('Center Bottom', 'kadence-slider'), false),
		'right top' => array(__('Right Top', 'kadence-slider'), false),
		'right center' => array(__('Right Center', 'kadence-slider'), false),
		'right bottom' => array(__('Right Bottom', 'kadence-slider'), false),
		);
	$slider_background_size_options = array(
		'cover' => array(__('Cover', 'kadence-slider'), false),
		'contain' => array(__('Contain', 'kadence-slider'), false),
		'auto' => array(__('Auto', 'kadence-slider'), false),
		);
	?>
	
	<div class="ksp-slide-settings-list ksp-table">
		<div class="ksp-list-title">
				<?php _e('Slide Options', 'kadence-slider'); ?>
		</div>
		
		<div class="ksp-row" style="padding:0;">
			<div class="ksp-column ksp-full">
				<div class="ksp-content ksp-bg-options">
					<?php if($void): ?>
							<div class="ksp-column ksp-odd">
								<span class="ksp-inner-row-label">
									<?php _e('Background image:', 'kadence-slider'); ?>
								</span>
								<form class="ksp-inner-row-form">
									<input type="radio" value="0" name="ksp-slide-background_type_image" checked /> <?php _e('None', 'kadence-slider'); ?> &nbsp;
									<label>
										<input type="radio" value="1" name="ksp-slide-background_type_image" />
										<span class="ksp-slide-background_type_image-upload-button ksp-button ksp-btn-imageupload"><?php _e('Select image', 'kadence-slider'); ?></span>
									</label>
								</form>
							</div>
							<div class="ksp-column ksp-even">
								<span class="ksp-inner-row-label">
								<?php _e('Background color:', 'kadence-slider'); ?>
								</span>
								<form class="ksp-inner-row-form">
									<input type="radio" value="0" name="ksp-slide-background_type_color" checked /> <?php _e('Transparent', 'kadence-slider'); ?> &nbsp;
									<input type="radio" value="1" name="ksp-slide-background_type_color" /> 
									<input class="ksp-slide-background_type_color-picker-input ksp-button ksp-btn-color" type="text" value="rgb(255, 255, 255)" />
								</form>
							</div>
							<div class="ksp-column ksp-col-3 ksp-odd">
								<span class="ksp-inner-row-label">
								<?php _e('Background position:', 'kadence-slider'); ?>
								</span>
								<select id="ksp-slide-background_position" class="ksp-slide-background_propriety_position">
								<?php
									foreach($slider_background_options as $key => $value) {
										echo '<option value="' . $key . '"';
										if(($void && $key == 'center center') || (!$void && $slide->background_propriety_position == $key)) {
											echo ' selected';
										}
										echo '>' . $value[0] . '</option>';
									}
								?>
								</select>
							</div>
							<div class="ksp-column ksp-col-3 ksp-even">
								<span class="ksp-inner-row-label">
								<?php _e('Background repeat:', 'kadence-slider'); ?>
								</span>
								<form class="ksp-inner-row-form">
									<?php if(!$void && $slide->background_repeat == 'repeat') { ?>
										<input type="radio" value="1" name="ksp-slide-background_repeat" /> <?php _e('Repeat', 'kadence-slider'); ?> &nbsp;
										<input type="radio" value="0" name="ksp-slide-background_repeat" checked /> <?php _e('No repeat', 'kadence-slider'); ?>
									<?php } else {?>
										<input type="radio" value="1" name="ksp-slide-background_repeat" /> <?php _e('Repeat', 'kadence-slider'); ?> &nbsp;
										<input type="radio" value="0" name="ksp-slide-background_repeat" checked /> <?php _e('No repeat', 'kadence-slider'); ?>
									<?php } ?>
								</form>
							</div>
							<div class="ksp-column ksp-col-3 ksp-odd">
								<span class="ksp-inner-row-label">
								<?php _e('Background size:', 'kadence-slider'); ?> 
								</span>
								<select id="ksp-slide-background_propriety_size" class="ksp-slide-background_propriety_size">
								<?php
									foreach($slider_background_size_options as $key => $value) {
										echo '<option value="' . $key . '"';
										if(($void && $key == 'cover') || (!$void && $slide->background_propriety_size == $key)) {
											echo ' selected';
										}
										echo '>' . $value[0] . '</option>';
									}
								?>
								</select>
							</div>
						</div>
					

					<?php else: ?>
							<div class="ksp-column ksp-odd">
								<span class="ksp-inner-row-label">
									<?php _e('Background image:', 'kadence-slider'); ?> 
								</span>
								<form class="ksp-inner-row-form">
									<?php if($slide->background_type_image == 'none' || $slide->background_type_image == 'undefined'): ?>
								<input type="radio" value="0" name="ksp-slide-background_type_image" checked /> <?php _e('None', 'kadence-slider'); ?> &nbsp;
								<label>
								<input type="radio" value="1" name="ksp-slide-background_type_image" />
									<span class="ksp-slide-background_type_image-upload-button ksp-button ksp-btn-imageupload"><?php _e('Select image', 'kadence-slider'); ?></span>
								</label>
									<?php else: ?>
								<input type="radio" value="0" name="ksp-slide-background_type_image" /> <?php _e('None', 'kadence-slider'); ?> &nbsp;
								<label>
								<input type="radio" value="1" name="ksp-slide-background_type_image" checked />
									<span class="ksp-slide-background_type_image-upload-button ksp-button ksp-btn-imageupload"><?php _e('Select image', 'kadence-slider'); ?></span>
								</label>
							<?php endif; ?>
								</form>
							</div>
							<div class="ksp-column ksp-even">
									<span class="ksp-inner-row-label">
									<?php _e('Background color:', 'kadence-slider'); ?>
									</span>
								<form class="ksp-inner-row-form">
								<?php if($slide->background_type_color == 'transparent'): ?>
									<input type="radio" value="0" name="ksp-slide-background_type_color" checked /> <?php _e('Transparent', 'kadence-slider'); ?> &nbsp;
										<input type="radio" value="1" name="ksp-slide-background_type_color" /> 
										<input class="ksp-slide-background_type_color-picker-input ksp-button ksp-btn-color" type="text" value="#ffffff" />
								<?php else: ?>
									<input type="radio" value="0" name="ksp-slide-background_type_color" /> <?php _e('Transparent', 'kadence-slider'); ?> &nbsp;
									<input type="radio" value="1" name="ksp-slide-background_type_color" checked /> 
									<input class="ksp-slide-background_type_color-picker-input ksp-button ksp-btn-color" type="text" value="<?php echo $slide->background_type_color; ?>" />
								<?php endif; ?>	
								</form>
							</div>
							<div class="ksp-column ksp-col-3 ksp-odd">
								<span class="ksp-inner-row-label">
								<?php _e('Background position:', 'kadence-slider'); ?>
								</span>
								<select id="ksp-slide-background_propriety_position" class="ksp-slide-background_propriety_position">
								<?php
									foreach($slider_background_options as $key => $value) {
										echo '<option value="' . $key . '"';
										if(($void && $key == "center center") || (!$void && $slide->background_propriety_position == $key)) {
											echo ' selected';
										}
										echo '>' . $value[0] . '</option>';
									}
								?>
								</select>
							</div>
							<div class="ksp-column ksp-col-3 ksp-even">
								<span class="ksp-inner-row-label">
								<?php _e('Background repeat:', 'kadence-slider'); ?>
								</span>
								<form class="ksp-inner-row-form">
									<?php if($slide->background_repeat == 'repeat'): ?>
										<input type="radio" value="1" name="ksp-slide-background_repeat" checked /> <?php _e('Repeat', 'kadence-slider'); ?> &nbsp;
										<input type="radio" value="0" name="ksp-slide-background_repeat" /> <?php _e('No repeat', 'kadence-slider'); ?>
									<?php else: ?>
										<input type="radio" value="1" name="ksp-slide-background_repeat" /> <?php _e('Repeat', 'kadence-slider'); ?> &nbsp;
										<input type="radio" value="0" name="ksp-slide-background_repeat" checked /> <?php _e('No repeat', 'kadence-slider'); ?>
									<?php endif; ?>
								</form>
							</div>
							<div class="ksp-column ksp-col-3 ksp-odd">
								<span class="ksp-inner-row-label">
								<?php _e('Background size:', 'kadence-slider'); ?>
								</span>
								<select id="ksp-slide-background_propriety_size" class="ksp-slide-background_propriety_size">
								<?php
									foreach($slider_background_size_options as $key => $value) {
										echo '<option value="' . $key . '"';
										if(($void && $key == "cover") || (!$void && $slide->background_propriety_size == $key)) {
											echo ' selected';
										}
										echo '>' . $value[0] . '</option>';
									}
								?>
								</select>
							</div>
						</div>
					<?php endif; ?>
			</div>
		</div>
	</div>

	
	<?php
	// If the slide is not void, select her elements
	if(!$void) {
		global $wpdb;
		$id = isset($_GET['id']) ? $_GET['id'] : NULL;
		$slide_parent = $slide->position;
		$layers = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'ksp_layers WHERE slider_parent = ' . $id . ' AND slide_parent = ' . $slide_parent);
	}
	else {
		$slide_id = NULL;
		$layers = NULL;
	}
	
	ksp_admin_output_layers($edit, $slider, $slide, $layers);
}
?>