<?php
 
	/**
	*  A method for inserting multiple rows into the specified table
	* @author	Ugur Mirza ZEYREK
	* @source http://stackoverflow.com/a/12374838/1194797
	*/
	 
	function ksp_insert_rows($row_arrays = array(), $wp_table_name) {
	global $wpdb;
	$wp_table_name = esc_sql($wp_table_name);
	// Setup arrays for Actual Values, and Placeholders
	$values = array();
	$place_holders = array();
	$query = "";
	$query_columns = "";
	
	$query .= "INSERT INTO {$wp_table_name} (";
	
	        foreach($row_arrays as $count => $row_array)
	        {
	
	            foreach($row_array as $key => $value) {
	
	                if($count == 0) {
	                    if($query_columns) {
	                    $query_columns .= ",".$key."";
	                    } else {
	                    $query_columns .= "".$key."";
	                    }
	                }
	
	                $values[] =  $value;
	
	                if(is_numeric($value)) {
	                    if(isset($place_holders[$count])) {
	                    $place_holders[$count] .= ", '%d'";
	                    } else {
	                    $place_holders[$count] = "( '%d'";
	                    }
	                } else {
	                    if(isset($place_holders[$count])) {
	                    $place_holders[$count] .= ", '%s'";
	                    } else {
	                    $place_holders[$count] = "( '%s'";
	                    }
	                }
	            }
	                    // mind closing the GAP
	                    $place_holders[$count] .= ")";
	        }
	
	$query .= " $query_columns ) VALUES ";
	
	$query .= implode(', ', $place_holders);
	
	if($wpdb->query($wpdb->prepare($query, $values))){
	    return true;
	} else {
	    return false;
	}
	
	}

// Add slider
add_action('wp_ajax_ksp_addSlider', 'ksp_addSlider_callback');
function ksp_addSlider_callback() {
	global $wpdb;
	$options = $_POST['datas'];

	$output = ksp_addSlider_insert($options);
	
	// Returning
	$output = json_encode($wpdb->insert_id);

	if(is_array($output)) {
		print_r($output);
	} else{
		echo $output;
	}

	die();
}
function ksp_addSlider_insert($options) {
	global $wpdb;
	return $wpdb->insert(
		$wpdb->prefix . 'ksp_sliders',
		array(
			'name' => $options['name'],
			'maxHeight' => $options['maxHeight'],
			'maxWidth' => $options['maxWidth'],
			'fullHeight' => $options['fullHeight'],
			'fullWidth' => $options['fullWidth'],
			'full_offset' => $options['full_offset'],
			'responsive' => $options['responsive'],
			'autoPlay' => $options['autoPlay'],
			'pauseTime' => $options['pauseTime'],
			'enableParallax' => $options['enableParallax'],
			'singleSlide' => $options['singleSlide'],
			'minHeight' => $options['minHeight'],
			'pauseonHover' => $options['pauseonHover'],
		),
		array(
			'%s',
			'%d',
			'%d',
			'%d',
			'%d',
			'%s',
			'%d',
			'%d',
			'%d',
			'%d',
			'%d',
			'%d',
			'%d',
		)
	);
}

// Edit slider
add_action('wp_ajax_ksp_editSlider', 'ksp_editSlider_callback');
function ksp_editSlider_callback() {
	global $wpdb;
	$options = $_POST['datas'];
	$table_name = $wpdb->prefix . 'ksp_sliders';
		
	$output = $wpdb->update(
		$table_name,
		array(
			'name' => $options['name'],
			'maxHeight' => $options['maxHeight'],
			'maxWidth' => $options['maxWidth'],
			'fullHeight' => $options['fullHeight'],
			'fullWidth' => $options['fullWidth'],
			'full_offset' => $options['full_offset'],
			'responsive' => $options['responsive'],
			'autoPlay' => $options['autoPlay'],
			'pauseTime' => $options['pauseTime'],
			'enableParallax' => $options['enableParallax'],
			'singleSlide' => $options['singleSlide'],
			'minHeight' => $options['minHeight'],
			'pauseonHover' => $options['pauseonHover'],
		),
		array('id' => $options['id']), 
		array(
			'%s',
			'%d',
			'%d',
			'%d',
			'%d',
			'%s',
			'%d',
			'%d',
			'%d',
			'%d',
			'%d',
			'%d',
			'%d',
			'%d',
		),
		array('%d')
	);
	
	// Returning
	$output = json_encode($output);
	if(is_array($output)) print_r($output);
	else echo $output;
	
	die();
}

// Edit slides. Receives an array with all the slides options. Delete al the old slides then recreate them
add_action('wp_ajax_ksp_editSlides', 'ksp_editSlides_callback');
function ksp_editSlides_callback() {
	global $wpdb;
	$options = $_POST['datas'];
	$table_name = $wpdb->prefix . 'ksp_slides';
	
	$output = true;
	
	// Remove all the old slides
	$output = $wpdb->delete($table_name, array('slider_parent' => $options['slider_parent']), array('%d'));
	if($output === false) {
		echo json_encode(false);
	} else {
		// It's impossible to have 0 slides (jQuery checks it)
		$output = ksp_insert_rows($options['options'], $table_name);
		
		// Returning
		$output = json_encode($output);

		if(is_array($output)) {
			print_r($output);
		} else { 
			echo $output;
		}
	}
	
	die();
}

add_action('wp_ajax_ksp_editLayers', 'ksp_editLayers_callback');
function ksp_editLayers_callback() {
	global $wpdb;
	$options = $_POST['datas'];
	$table_name = $wpdb->prefix . 'ksp_layers';
	
	$output = true;	
	
	$output = $wpdb->delete($table_name, array('slider_parent' => $options['slider_parent']), array('%d'));

	if($output === false) {
		echo json_encode(false);
	} else {
		$option_temp = json_decode(stripslashes($options['options']));
		if(empty($option_temp)) {
			echo json_encode(true);
		} else {	
			// Insert row per row
			$options_array = json_decode(stripslashes($options['options']));
			$output = ksp_insert_rows($options_array, $table_name);

			// Returning
			$output = json_encode($output);

			if(is_array($output)) {
				print_r($output);
			} else {
				echo $output;
			}
		}
	}
	
	die();
}

// Delete slider and its content
add_action('wp_ajax_ksp_deleteSlider', 'ksp_deleteSlider_callback');
function ksp_deleteSlider_callback() {
	global $wpdb;
	$options = $_POST['datas'];
	
	$real_output = true;
	
	// Delete slider
	$table_name = $wpdb->prefix . 'ksp_sliders';		
	$output = $wpdb->delete($table_name, array('id' => $options['id']), array('%d'));
	if($output === false) {
		$real_output = false;
	}
	
	// Delete slides
	$table_name = $wpdb->prefix . 'ksp_slides';		
	$output = $wpdb->delete($table_name, array('slider_parent' => $options['id']), array('%d'));
	if($output === false) {
		$real_output = false;
	}
	
	// Delete Layers
	$table_name = $wpdb->prefix . 'ksp_layers';		
	$output = $wpdb->delete($table_name, array('slider_parent' => $options['id']), array('%d'));
	if($output === false) {
		$real_output = false;
	}
	
	// Returning
	$real_output = json_encode($real_output);
	if(is_array($real_output)) print_r($real_output);
	else echo $real_output;
	
	die();
}

// Duplicate slider and its content
add_action('wp_ajax_ksp_duplicateSlider', 'ksp_duplicateSlider_callback');
function ksp_duplicateSlider_callback() {
	global $wpdb;
	$options = $_POST['datas'];
	
	$output = true;
	$real_output = true;
	
	$slider_id = $options['id'];
	
	$cloned_slider_name = '';
	
	$sliders = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'ksp_sliders WHERE id = \'' . $slider_id . '\'', ARRAY_A);
	foreach($sliders as $slider) {
		$cloned_slider_name = $slider['name'] = $slider['name'] . '_' . __('Copy', 'ksp');
		$output = ksp_addSlider_insert($slider);
	}
	
	if($output === false) {
		$real_output = false;
	} else {
		$cloned_slider_id = $wpdb->insert_id;
		
		// Clone slides
		$slides = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'ksp_slides WHERE slider_parent = ' . $slider_id . ' ORDER BY position', ARRAY_A);
		if(empty($slides)) {
			$output = true;
		}
		else {
			foreach($slides as $key => $slide) {
				unset($slides[$key]['id']);
				$slides[$key]['slider_parent'] = $cloned_slider_id;
			}
			$temp = ksp_insert_rows($slides, $wpdb->prefix . 'ksp_slides');
			if($temp === false) {
				$output = false;
			}
		}
		
		// Clone Layers
		$layers = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'ksp_layers WHERE slider_parent = ' . $slider_id, ARRAY_A);
		if(empty($layers)) {
			$output = true;
		}
		else {
			foreach($layers as $key => $element) {
				unset($layers[$key]['id']);
				$layers[$key]['slider_parent'] = $cloned_slider_id;
			}
			$temp = ksp_insert_rows($layers, $wpdb->prefix . 'ksp_layers');
			if($temp === false) {
				$output = false;
			}
			
			if($output === false) {
				$real_output = false;
			}
		}
	}
	
	if($real_output === true) {
		$real_output = array(
			'response' => true,
			'cloned_slider_id' => $cloned_slider_id,
			'cloned_slider_name' => $cloned_slider_name,
		);
	} else {
		$real_output = array(
			'response' => false,
			'cloned_slider_id' => false,
			'cloned_slider_name' => false,
		);
	}
	
	// Returning
	$real_output = json_encode($real_output);
	if(is_array($real_output)) print_r($real_output);
	else echo $real_output;
	
	die();
}

// Exports the slider in xml
add_action('wp_ajax_ksp_exportSlider', 'ksp_exportSlider_callback');
function ksp_exportSlider_callback() {
	global $wpdb;
	
	// Clear the temp folder
	array_map('unlink', glob(KADENCE_SLIDER_PATH . '/temp/*'));
	
	$options = $_POST['datas'];
	
	$real_output = true;
	
	$result = array();
	
	// Get the slider
	$sliders = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'ksp_sliders WHERE id = \'' . $options['id'] . '\'', ARRAY_A);
	if(empty($sliders)) {
		$real_output = false;
	} else {
		foreach($sliders as $key => $temp) {
			unset($sliders[$key]['id']);
		}
		$result['sliders'] = $sliders;
	}
	$slider_slug = strtolower(preg_replace('/[^a-zA-Z0-9-_\.]/','', $sliders[0]['name']));
	$zip = new ZipArchive();
	$filename = 'ksp-' . $slider_slug . '.zip';
	if($zip->open(KADENCE_SLIDER_PATH . '/temp/' . $filename, ZipArchive::CREATE) !== TRUE) {
		echo false;
		die();
	}
	
	// Get the slides
	$slides = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'ksp_slides WHERE slider_parent = ' . $options['id'] . ' ORDER BY position', ARRAY_A);
	if(! empty($slides)) {
		foreach($slides as $key => $temp) {
			unset($slides[$key]['id']);
			unset($slides[$key]['slider_parent']);
			
			// Add images to zip and remove media directory URLs
			if($slides[$key]['background_type_image'] != 'none' && $slides[$key]['background_type_image'] != 'undefined') {
				$img = $slides[$key]['background_type_image'];
				$zip->addFromString(basename($img), file_get_contents($img));
				$slides[$key]['background_type_image'] = basename($img);
			}
		}
		$result['slides'] = $slides;
	}
	
	// Get the layers
	$layers = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'ksp_layers WHERE slider_parent = ' . $options['id'], ARRAY_A);
	if(! empty($layers)) {
		foreach($layers as $key => $temp) {
			unset($layers[$key]['id']);
			unset($layers[$key]['slider_parent']);
			
			// Add images to zip and remove media directory URLs
			if($layers[$key]['type'] == 'image') {
				$img = $layers[$key]['image_src'];
				$zip->addFromString(basename($img), file_get_contents($img));
				$layers[$key]['image_src'] = basename($img);
			}
		}
		$result['layers'] = $layers;
	}
	
	$json = json_encode($result);	
	$zip->addFromString("slider.json", $json);
	
	$zip->close();
	
	if($real_output === true) {
		$real_output = array(
			'response' => true,
			'url' => KADENCE_SLIDER_URL . '/temp/' . $filename,
		);
	} else {
		$real_output = array(
			'response' => false,
			'url' => false,
		);
	}
	
	// Returning
	$real_output = json_encode($real_output);
	if(is_array($real_output)) print_r($real_output);
	else echo $real_output;
	
	die();
}

// Inport the slider from a json string
add_action('wp_ajax_ksp_importSlider', 'ksp_importSlider_callback');
function ksp_importSlider_callback() {
	global $wpdb;
	
	// Clear the temp folder
	array_map('unlink', glob(KADENCE_SLIDER_PATH . '/temp/*'));
	
	foreach($_FILES as $file) {		
		$output = true;
		$real_output = true;
		
		$zip = new ZipArchive();
		if($zip->open($file['tmp_name']) !== TRUE) {
			echo false;
			die();
		}
		
		$zip->extractTo(KADENCE_SLIDER_PATH . '/temp/');
		
		$imported_array = json_decode(file_get_contents(KADENCE_SLIDER_PATH . '/temp/slider.json'));
		
		$sliders = $imported_array->sliders;
		foreach($sliders as $slider) {
			$output = ksp_addSlider_insert((array) $slider);
		}
		
		if($output === false) {
			$real_output = false;
		} else {
			$imported_slider_id = $wpdb->insert_id;
			
			// Import slides
			$slides = $imported_array->slides;
			if(empty($slides)) {
				$output = true;
			} else {
				foreach($slides as $key => $slide) {
					$slides[$key]->slider_parent = $imported_slider_id;
					
					// Set background images
					if($slides[$key]->background_type_image != 'undefined' && $slides[$key]->background_type_image != 'none') {
						$upload = media_sideload_image(KADENCE_SLIDER_URL . '/temp/' . $slides[$key]->background_type_image, 0, null, 'src');
						$slides[$key]->background_type_image = $upload;
					}
				}
				$temp = ksp_insert_rows($slides, $wpdb->prefix . 'ksp_slides');
				if($temp === false) {
					$output = false;
				}
			}
			
			// Import layers
			$layers = (array) $imported_array->layers;
			if(empty($layers)) {
				$output = true;
			} else {
				foreach($layers as $key => $element) {
					$layers[$key]->slider_parent = $imported_slider_id;
					
					// Set images
					if($layers[$key]->type == 'image') {
						$upload = media_sideload_image(KADENCE_SLIDER_URL . '/temp/' . $layers[$key]->image_src, 0, null, 'src');
						$layers[$key]->image_src = $upload;
					}
				}
				$temp = ksp_insert_rows($layers, $wpdb->prefix . 'ksp_layers');
				if($temp === false) {
					$output = false;
				}
				
				if($output === false) {
					$real_output = false;
				}
			}
		}
		
		if($real_output === true) {
			$real_output = array(
				'response' => true,
				'imported_slider_id' => $imported_slider_id,
				'imported_slider_name' => $imported_array->sliders[0]->name,
			);
		} else {
			$real_output = array(
				'response' => false,
				'imported_slider_id' => false,
				'imported_slider_name' => false,
			);
		}
		
		// Returning
		$real_output = json_encode($real_output);
		if(is_array($real_output)) print_r($real_output);
		else echo $real_output;
		
		die();
	}
}

function ksp_import_direct($file) {
	global $wpdb;
	
	if(empty( $file ) ) {
		die();
	}
	// Clear the temp folder
	array_map('unlink', glob(KADENCE_SLIDER_PATH . '/temp/*'));
	

		$output = true;
		$real_output = true;
		
		$zip = new ZipArchive();
		if($zip->open($file) !== TRUE) {
			return 'false';
			die();
		}
		
		$zip->extractTo(KADENCE_SLIDER_PATH . '/temp/');
		
		$imported_array = json_decode(file_get_contents(KADENCE_SLIDER_PATH . '/temp/slider.json'));
		
		$sliders = $imported_array->sliders;
		foreach($sliders as $slider) {
			$output = ksp_addSlider_insert((array) $slider);
		}
		
		if($output === false) {
			$real_output = false;
		} else {
			$imported_slider_id = $wpdb->insert_id;
			
			// Import slides
			$slides = $imported_array->slides;
			if(empty($slides)) {
				$output = true;
			} else {
				foreach($slides as $key => $slide) {
					$slides[$key]->slider_parent = $imported_slider_id;
					
					// Set background images
					if($slides[$key]->background_type_image != 'undefined' && $slides[$key]->background_type_image != 'none') {
						$upload = media_sideload_image(KADENCE_SLIDER_URL . '/temp/' . $slides[$key]->background_type_image, 0, null, 'src');
						$slides[$key]->background_type_image = $upload;
					}
				}
				$temp = ksp_insert_rows($slides, $wpdb->prefix . 'ksp_slides');
				if($temp === false) {
					$output = false;
				}
			}
			
			// Import layers
			$layers = (array) $imported_array->layers;
			if(empty($layers)) {
				$output = true;
			} else {
				foreach($layers as $key => $element) {
					$layers[$key]->slider_parent = $imported_slider_id;
					
					// Set images
					if($layers[$key]->type == 'image') {
						$upload = media_sideload_image(KADENCE_SLIDER_URL . '/temp/' . $layers[$key]->image_src, 0, null, 'src');
						$layers[$key]->image_src = $upload;
					}
				}
				$temp = ksp_insert_rows($layers, $wpdb->prefix . 'ksp_layers');
				if($temp === false) {
					$output = false;
				}
				
				if($output === false) {
					$real_output = false;
				}
			}
		}
		
		if($real_output === true) {
			$real_output = array(
				'response' => true,
				'imported_slider_id' => $imported_slider_id,
				'imported_slider_name' => $imported_array->sliders[0]->name,
			);
		} else {
			$real_output = array(
				'response' => false,
				'imported_slider_id' => false,
				'imported_slider_name' => false,
			);
		}
		
		// Returning
		$real_output = json_encode($real_output);
		return $real_output;
		
		die();
}
