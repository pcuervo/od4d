<?php

class KadenceSliderPro_Output {

	// Shortcode
	public static function shortcode($atts) {
		extract(shortcode_atts(array(
		'id' => ''
		), $atts));

		if(empty($id)) {
			return '<p class="error">' . __( 'Please specify a slider ID', 'kadence_slider' ) . '</p>';
		} else {
			return KadenceSliderPro_Output::output($id);
		}
	}

	public static function addShortcode() {
		add_shortcode('kadence_slider_pro', array( __CLASS__, 'shortcode'));
	}

	public static function output( $id ) {
			global $wpdb, $kadence_slider;
			$slider = $wpdb->get_row('SELECT * FROM ' . $wpdb->prefix . 'ksp_sliders WHERE id = \'' . $id . '\'');

			if(! $slider) {
				return '<p class="error">' . __( 'Could not find slider', 'kadence_slider' ) . '</p>';
			}
			$slider_id = $slider->id;
			$slides = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'ksp_slides WHERE slider_parent = ' . $slider_id . ' ORDER BY position');

				$max_height = $slider->maxHeight;
				$min_height = $slider->minHeight;
				$max_width = $slider->maxWidth;
				$fullwidth = $slider->fullWidth;
				$respect_ratio = $slider->responsive;
				$fullheight = $slider->fullHeight;
				$full_offset = $slider->full_offset;
				$pause_time = $slider->pauseTime;
				$auto_play = $slider->autoPlay;
				$slider_parallax = $slider->enableParallax;
				$hidecontrols = $slider->singleSlide;
				$pauseonhover = $slider->pauseonHover;
				$data_height = $max_height;
				$grid_width = $max_width;

				$slidecount = count($slides);
				if(!empty($pause_time)) {$pause_data = $pause_time;} else{$pause_data = '9000';} 
				if($auto_play == '1') {$auto_play_data = 'true';} else{$auto_play_data = 'false';} 
				if(isset($pauseonhover) && $pauseonhover == 1)  {$pause_on_hover = 'true';} else{$pause_on_hover = 'false';} 
				if($fullwidth) {$max_width = 'none';} else {$max_width = $max_width.'px';}
				if($fullheight) {$max_height = '600px'; $data_height_type = "full"; } else {$max_height = $max_height.'px'; $data_height_type = "normal";}
				if($slider_parallax) {$slider_parallax_class = 'kad-slider-parallax';} else {$slider_parallax_class = '';}
				$ratioclass = "";
				// ratio
				if(isset($respect_ratio) && $respect_ratio == 1) {
		 			$data_height_type = 'ratio';
		 			$ratioclass = "kt-ratio-slider";
		 			$min_height = '0';
		 		}

		            ob_start(); ?>
					  	<div class="ksp-slider-wrapper <?php if($slidecount == 1) {echo 'kt_slider_single_slide';}?> <?php if($hidecontrols == 1) {echo 'kt_slider_hide_controls';}?> kad-slider-<?php echo esc_attr($id);?> <?php echo esc_attr($ratioclass);?> <?php echo esc_attr($slider_parallax_class);?>" data-ktslider-id="<?php echo esc_attr($id);?>" data-ktslider-auto-play="<?php echo esc_attr($auto_play_data);?>" data-ktslider-pause-time="<?php echo esc_attr($pause_data);?>" data-ktslider-count="<?php echo esc_attr($slidecount);?>" data-ktslider-height="<?php echo esc_attr($data_height);?>" data-ktslider-pause-hover="<?php echo esc_attr($pause_on_hover);?>" data-ktslider-height-type="<?php echo esc_attr($data_height_type);?>" data-ktslider-height-offset="<?php echo esc_attr($full_offset);?>" data-ktslider-width="<?php echo esc_attr($slider->maxWidth);?>" style="max-width:<?php echo esc_attr($max_width);?>; margin-left: auto; margin-right:auto;">
					    	<div id="kad-slider-<?php echo esc_attr($id);?>" class="kad-slider kad-loading" style="margin-left: auto; margin-right:auto; height:<?php echo esc_attr($max_height);?>; min-height:<?php echo esc_attr($min_height);?>px">
					        	<ul class="kad-slider-canvas seq-canvas" style="height:<?php echo esc_attr($max_height);?>; min-height:<?php echo esc_attr($min_height);?>px">
					        	<?php $slidenumber = 1;
					        	if(!empty($slides)) {
					            	foreach ($slides as $slide) :

					            	// Aspect Ratio
					            	if(isset($respect_ratio) && $respect_ratio == 1) {
						            	if($slide->background_type_image == 'undefined' || $slide->background_type_image == 'none'){
						            		$slide_image = 'none';
						            	} else {
						            		$slide_image_id = ksp_get_image_id_by_link($slide->background_type_image);
						           			$slide_image = wp_get_attachment_image_src($slide_image_id, 'full');
						           			$alt = get_post_meta($slide_image_id, '_wp_attachment_image_alt', true);
						           		}
					            	 	?>
					                      <li> 
					                      	<div class="kad-slide kad-slide-<?php echo esc_attr($slidenumber);?>" style="background-color:<?php echo $slide->background_type_color; ?>;">
					                              <img src="<?php echo esc_url($slide->background_type_image);?>" alt="<?php echo esc_attr($alt);?>" width="<?php echo esc_attr($slide_image['1']);?>"  height="<?php echo esc_attr($slide_image['2']);?>" class="kt-ratio-img">
					                
					                <?php  } else { 
					                     	$background_type_image = $slide->background_type_image == 'undefined' || $slide->background_type_image == 'none' ? 'none;' : 'url(\'' . $slide->background_type_image . '\');';
					                  		?>
					                  		<li>
					                      	<div class="kad-slide kad-slide-<?php echo esc_attr($slidenumber);?>" style="background-image: <?php echo $background_type_image; ?>; background-size:<?php echo $slide->background_propriety_size; ?>;  background-color:<?php echo $slide->background_type_color; ?>;  background-position: <?php echo $slide->background_propriety_position;?>; background-repeat: <?php echo $slide->background_repeat; ?>;" >
					                <?php } ?>
					                              

					                           	<div class="kad-slider-layers-case" style="max-width:<?php echo esc_attr($grid_width);?>px">
					                              <?php $slide_parent = $slide->position;
													$layers = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'ksp_layers WHERE slider_parent = ' . $slider_id . ' AND slide_parent = ' . $slide_parent);	
													$output = '';
													$l = 1;
													foreach($layers as $layer) {
														// Layer Wrapper 
														$output .= '<div class="ksp-layer-wrap" style="top:' . $layer->data_y . 'px; left: ' . $layer->data_x . 'px;"';
																	$output .= ' data-top="' . $layer->data_y . '"' . "\n" .
																		'data-left="' . $layer->data_x . '"' . "\n" .
																		'>';
														
														// Type of layer
														switch($layer->type) {

															case 'text':
																// if Link 
																if(!empty($layer->link)) {
																	$target = $layer->link_new_tab == 1 ? 'target="_blank"' : '';
																	$output .= '<a href="' . stripslashes($layer->link) . '"' . $target . ' class="ksp-layer-link">';
																}
																if(isset($kadence_slider[$layer->font]['font-style'])) {
																	$fontstyleoutput = $kadence_slider[$layer->font]['font-style'];
																} else {
																	$fontstyleoutput = '';
																}
																$output .= '<div class="ksp-layer ksp-text-layer delay_'.$layer->data_delay.'ms animated_'.$layer->data_ease.'ms ksp-layer-'.$l.' '.$layer->data_out.'" ';
																	$output .= 'style="
																	z-index: ' . $layer->z_index . ';
																	font-size: ' . $layer->font_size . 'px;
																	line-height: ' . $layer->line_height . 'px;
																	font-family: ' . $kadence_slider[$layer->font]['font-family'] . ';
																	font-weight: ' . $kadence_slider[$layer->font]['font-weight'] . ';
																	font-style: ' . $fontstyleoutput . ';
																	color: ' . $layer->font_color. ';
																	letter-spacing: ' . $layer->letter_spacing. 'px;
																	
																	" ';

																	$output .= 'data-delay="' . $layer->data_delay . '"' . "\n" .
																	'data-ease="' . $layer->data_ease . '"' . "\n" .
																	'data-in="' . $layer->data_in . '"' . "\n" .
																	'data-out="' . $layer->data_out . '"' . "\n" .
																	'data-top="' . $layer->data_y . '"' . "\n" .
																	'data-left="' . $layer->data_x . '"' . "\n" .
																	'data-font-size="' . $layer->font_size . '"' . "\n" .
																	'data-line-height="' . $layer->line_height . '"' . "\n" .
																	'data-letter-spacing="' . $layer->letter_spacing. '"' . "\n";
																$output .= '>' . "\n" .
																$layer->inner_html . "\n" .
																'</div>' . "\n";
																// If link
																if(!empty($layer->link)) {
																	$output .='</a>';
																}
															break;
															case 'button':
																// if Link 
																if(!empty($layer->link)) {
																	$target = $layer->link_new_tab == 1 ? 'target="_blank"' : '';
																	$output .= '<a href="' . stripslashes($layer->link) . '"' . $target;
																} else {
																	$output .= '<a href="#"';
																}
																$output .= ' class="ksp-layer ksp-btn-layer delay_'.$layer->data_delay.'ms animated_'.$layer->data_ease.'ms ksp-layer-'.$l.' '.$layer->data_out.'" ';
																$output .= 'style="
																	z-index: ' . $layer->z_index . '; font-size: ' . $layer->font_size . 'px; line-height: ' . $layer->line_height . 'px; font-family: ' . $kadence_slider[$layer->font]['font-family'] . '; font-weight: ' . $kadence_slider[$layer->font]['font-weight'] . ';';
																	if(isset($kadence_slider[$layer->font]['font-style']) && !empty($kadence_slider[$layer->font]['font-style']) ) {
																		$output .= 'font-style: ' . $kadence_slider[$layer->font]['font-style'] . ';';
																	}
																	$output .= 'padding-left: ' . $layer->padding . 'px; padding-right: ' . $layer->padding . 'px; letter-spacing: ' . $layer->letter_spacing. 'px;background: ' . $layer->background_color. '; color: ' . $layer->font_color. '; border-style: solid; border-width: ' . $layer->border_width. 'px; border-color: ' . $layer->border_color. '; border-radius: ' . $layer->border_radius. 'px;" ';
																	$output .= 'data-delay="' . $layer->data_delay . '"' . "\n" .
																	'data-ease="' . $layer->data_ease . '"' . "\n" .
																	'data-in="' . $layer->data_in . '"' . "\n" .
																	'data-out="' . $layer->data_out . '"' . "\n" .
																	'data-top="' . $layer->data_y . '"' . "\n" .
																	'data-left="' . $layer->data_x . '"' . "\n" .
																	'data-font-size="' . $layer->font_size . '"' . "\n" .
																	'data-padding="' . $layer->padding . '"' . "\n" .
																	'data-color="' . $layer->font_color . '"' . "\n" .
																	'data-border-color="' . $layer->border_color . '"' . "\n" .
																	'data-background-color="' . $layer->background_color . '"' . "\n" .
																	'data-hcolor="' . $layer->font_hover_color . '"' . "\n" .
																	'data-hborder-color="' . $layer->border_hover_color . '"' . "\n" .
																	'data-hbackground-color="' . $layer->background_hover_color . '"' . "\n" .
																	'data-letter-spacing="' . $layer->letter_spacing. '"' . "\n" .
																	'data-border-width="' . $layer->border_width . '"' . "\n" .
																	'data-line-height="' . $layer->line_height . '"' . "\n";

																$output .= '>';
																$output .= $layer->inner_html;
																$output .='</a>';

															break;
															case 'image':
																// if Link 
																// if Link 
																if(!empty($layer->link)) {
																	$target = $layer->link_new_tab == 1 ? 'target="_blank"' : '';
																	$output .= '<a href="' . stripslashes($layer->link) . '"' . $target . ' class="ksp-layer-link">';
																}
																$output .= '<img class="ksp-layer ksp-image-layer delay_'.$layer->data_delay.'ms animated_'.$layer->data_ease.'ms ksp-layer-'.$l.' '.$layer->data_out.'" ';
																$output .= 'style="
																	z-index: ' . $layer->z_index . ';	
																	width: ' . $layer->width . 'px;
																	height: ' . $layer->height . 'px;															
																	" ';
																	$output .= 'data-delay="' . $layer->data_delay . '"' . "\n" .
																	'data-ease="' . $layer->data_ease . '"' . "\n" .
																	'data-in="' . $layer->data_in . '"' . "\n" .
																	'data-out="' . $layer->data_out . '"' . "\n" .
																	'data-top="' . $layer->data_y . '"' . "\n" .
																	'data-left="' . $layer->data_x . '"' . "\n".
																	'data-width="' . $layer->width . '"' . "\n" .
																	'data-height="' . $layer->height . '"' . "\n" ;

																$output .= 'src="'.$layer->image_src.'"" alt="'.$layer->image_alt.'">';
																if(!empty($layer->link)) {
																	$output .='</a>';
																}
															break;
														}
														
														$output .='</div>';
														$l ++;
													}
													echo $output;
													
													?>
													</div>
					                            </div>
					                      	</li> 
					                      	<?php $slidenumber ++; ?>
					            <?php endforeach; ?>
					        	</ul>
					        	<ul class="kad-slider-pagination ksp-pag-<?php echo esc_attr($id);?>">
					        		<?php foreach ($slides as $slide) : ?>
								    <li class="kad-slider-dot"></li>
								    <?php endforeach; ?>
								</ul>
					        	<a class="kad-slider-next kad-slider-navigate ksp-next-<?php echo esc_attr($id);?>"></a>
					        	<a class="kad-slider-prev kad-slider-navigate ksp-prev-<?php echo esc_attr($id);?>"></a>
					        	<?php } ?>
					      </div> <!--kad-slides-->
					  </div> <!--kad-slider-->
		            		
			<?php  $output = ob_get_contents();
				ob_end_clean();
			return $output;
		}
	}


