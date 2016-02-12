<?php
/**
 * @category Pinnacle Theme
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'pinnacle_metaboxes' );


function kt_metabox_show_on_kt_template( $display, $meta_box ) {

    if( 'kt-template' !== $meta_box['show_on']['key'] )
        return $display;

    // Get the current ID
    if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
    elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
    if( !isset( $post_id ) ) return false;

    $template_name = get_page_template_slug( $post_id );
    $template_name = substr($template_name, 0, -4);

    // If value isn't an array, turn it into one
    $meta_box['show_on']['value'] = !is_array( $meta_box['show_on']['value'] ) ? array( $meta_box['show_on']['value'] ) : $meta_box['show_on']['value'];

    // See if there's a match
    if(in_array( $template_name, $meta_box['show_on']['value'] )) {
    	return false;
    } else {
    	return true;
	}
}
add_filter( 'cmb_show_on', 'kt_metabox_show_on_kt_template', 10, 2 );

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
// render numbers
add_action( 'cmb_render_kt_text_number', 'kt_cmb_render_kt_text_number', 10, 5 );

function kt_cmb_render_kt_text_number($field_args, $escaped_value, $object_id, $object_type, $field_type_object ) {
    echo $field_type_object->input( array( 'class' => 'cmb_text_small', 'type' => 'kt_text_number' ) );
}

// validate the field
add_filter( 'cmb_validate_kt_text_number', 'kt_cmb_validate_kt_text_number' );
function kt_cmb_validate_kt_text_number($new ) {
   $bnew = preg_replace("/[^0-9]/","",$new);

    return $new;
}

add_filter( 'cmb_render_imag_select_taxonomy', 'imag_render_imag_select_taxonomy', 10, 2 );
function imag_render_imag_select_taxonomy( $field, $meta ) {

    wp_dropdown_categories(array(
            'show_option_none' => __( "All", 'pinnacle' ),
            'hierarchical' => 1,
            'taxonomy' => $field['taxonomy'],
            'orderby' => 'name', 
            'hide_empty' => 0, 
            'name' => $field['id'],
            'selected' => $meta  

        ));
    if ( !empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';
}
add_filter( 'cmb_render_imag_select_category', 'imag_render_imag_select_category', 10, 2 );
function imag_render_imag_select_category( $field, $meta ) {

    wp_dropdown_categories(array(
            'show_option_none' => __( "All Blog Posts", 'pinnacle' ),
            'hierarchical' => 1,
            'taxonomy' => 'category',
            'orderby' => 'name', 
            'hide_empty' => 0, 
            'name' => $field['id'],
            'selected' => $meta  

        ));
    if ( !empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';

}
add_filter( 'cmb_render_select_pages', 'imag_render_select_pages', 10, 2 );
function imag_render_select_pages( $field, $meta ) {	
	$pages = get_pages(); 
    if (!empty($pages)) {
			 echo '<select name="', $field['id'], '" id="', $field['id'], '">';
			  echo '<option value="default"', $meta == 'default' ? ' selected="selected"' : '', '>Theme Options Default</option>';
		  foreach ($pages as $page) {
		    echo '<option value="', $page->ID, '"', $meta == $page->ID ? ' selected="selected"' : '', '>', $page->post_title, '</option>';
		  }
		  echo '</select>'; 
		}
	
    if ( !empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';

}
add_filter( 'cmb_render_imag_select_sidebars', 'imag_render_imag_select_sidebars', 10, 2 );
function imag_render_imag_select_sidebars( $field, $meta ) {
	global $kad_sidebars;	
	
	 echo '<select name="', $field['id'], '" id="', $field['id'], '">';
  foreach ($kad_sidebars as $side) {
    echo '<option value="', $side['id'], '"', $meta == $side['id'] ? ' selected="selected"' : '', '>', $side['name'], '</option>';
  }
  echo '</select>';
	
    if ( !empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';

}
add_filter( 'cmb_render_imag_select_sidebars_product', 'imag_render_imag_select_sidebars_product', 10, 2 );
function imag_render_imag_select_sidebars_product( $field, $meta ) {
	global $kad_sidebars;	
	
	 echo '<select name="', $field['id'], '" id="', $field['id'], '">';
	 echo '<option value="default" selected="selected">Theme Options Default</option>';
  foreach ($kad_sidebars as $side) {
    echo '<option value="', $side['id'], '"', $meta == $side['id'] ? ' selected="selected"' : '', '>', $side['name'], '</option>';
  }
  echo '</select>';
	
    if ( !empty( $field['desc'] ) ) echo '<p class="cmb_metabox_description">' . $field['desc'] . '</p>';

}
function kad_metabox_post_format( $display, $meta_box ) {
    if ( 'format' !== $meta_box['show_on']['key'] )
        return $display;

    // If we're showing it based on ID, get the current ID                  
    if( isset( $_GET['post'] ) ) $post_id = $_GET['post'];
    elseif( isset( $_POST['post_ID'] ) ) $post_id = $_POST['post_ID'];
    if( !isset( $post_id ) )
        return $display;

    $format = get_post_format( $post_id );
    if ( false === $format ) {$format = 'standard';}
    if ($format == $meta_box['show_on']['value']) 
    	return true;
    	 else 
        return false;
}
add_filter( 'cmb_show_on', 'kad_metabox_post_format', 10, 2 );

function pinnacle_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_kad_';

	$meta_boxes[] = array(
				'id'         => 'subtitle_metabox',
				'title'      => __( "Page Title and Subtitle", 'pinnacle' ),
				'pages'      => array( 'page' ), // Post type
				'context'    => 'normal',
				'priority'   => 'default',
				'show_names' => true, // Show field names on the left
				'fields' => array(
					array(
						'name' => __( "Subtitle", 'pinnacle' ),
						'desc' => __( "Subtitle will go below page title", 'pinnacle' ),
						'id'   => $prefix . 'subtitle',
						'type' => 'textarea_code',
					),
					array(
						'name'    => __("Align Text", 'pinnacle' ),
						'desc'    => '',
						'id'      => $prefix . 'pagetitle_align',
						'type'    => 'select',
						'options' => array(
							array( 'name' => __("Default", 'pinnacle' ), 'value' => 'default', ),
							array( 'name' => __("Align Left", 'pinnacle' ), 'value' => 'left', ),
							array( 'name' => __("Align Center", 'pinnacle' ), 'value' => 'center', ),
							array( 'name' => __("Align Right", 'pinnacle' ), 'value' => 'right', ),
						),
					),
					array(
					    'name' => 'Title Color',
					    'id'   => $prefix . 'pagetitle_title_color',
					    'type' => 'colorpicker',
					    'default'  => '',
					   
					),
					array(
					    'name' => 'Sub Title Color',
					    'id'   => $prefix . 'pagetitle_sub_color',
					    'type' => 'colorpicker',
					    'default'  => '',
					   
					),
					array(
					    'name' => 'Background Color',
					    'id'   => $prefix . 'pagetitle_bg_color',
					    'type' => 'colorpicker',
					    'default'  => '',
					   
					),
					array(
					    'name' => 'Background Image',
					    'desc' => 'Upload an image.',
					    'id' => $prefix . 'pagetitle_bg_image',
					    'type' => 'file',
					    'allow' => array( 'url') // limit to just attachments with array( 'attachment' )
					),
					array(
						'name'    => __("Background Image Position", 'pinnacle' ),
						'desc'    => '',
						'id'      => $prefix . 'pagetitle_bg_position',
						'type'    => 'select',
						'default' => 'center center',
						'options' => array(
							array( 'name' => __("Left Top", 'pinnacle' ), 'value' => 'left top', ),
							array( 'name' => __("Left Center", 'pinnacle' ), 'value' => 'left center', ),
							array( 'name' => __("Left Bottom", 'pinnacle' ), 'value' => 'left bottom', ),
							array( 'name' => __("Center Top", 'pinnacle' ), 'value' => 'center top', ),
							array( 'name' => __("Center Center", 'pinnacle' ), 'value' => 'center center', ),
							array( 'name' => __("Center Bottom", 'pinnacle' ), 'value' => 'center bottom', ),
							array( 'name' => __("Right Top", 'pinnacle' ), 'value' => 'right top', ),
							array( 'name' => __("Right Center", 'pinnacle' ), 'value' => 'right center', ),
							array( 'name' => __("Right Bottom", 'pinnacle' ), 'value' => 'right bottom', ),
						),
					),
					array(
					    'name' => 'Repeat Background Image',
					    'desc' => '',
					    'id' => $prefix . 'pagetitle_bg_repeat',
					    'type' => 'checkbox'
					),
					array(
					    'name' => 'Background Cover',
					    'desc' => '',
					    'id' => $prefix . 'pagetitle_bg_cover',
					    'type' => 'checkbox'
					),
					array(
					    'name' => 'Background Parallax',
					    'desc' => '',
					    'id' => $prefix . 'pagetitle_bg_parallax',
					    'type' => 'checkbox'
					),
					array(
						'name' => __( "Padding Top", 'pinnacle' ),
						'desc' => __( "Just enter number e.g. 25", 'pinnacle' ),
						'id'   => $prefix . 'pagetitle_ptop',
						'type' => 'kt_text_number',
					),
					array(
						'name' => __( "Padding Bottom", 'pinnacle' ),
						'desc' => __( "Just enter number e.g. 25", 'pinnacle' ),
						'id'   => $prefix . 'pagetitle_pbottom',
						'type' => 'kt_text_number',
					),
					array(
							'name' => __('Overide and use a Shortcode Slider', 'pinnacle'),
							'desc' => __('Paste slider shortcode here (example: [kadence_slider id="200"])', 'pinnacle'),
							'id'   => $prefix . 'shortcode_slider',
							'type' => 'textarea_code',
						),
					array(
						'name'    => __("Hide Page Title", 'pinnacle' ),
						'desc'    => '',
						'id'      => $prefix . 'pagetitle_hide',
						'type'    => 'select',
						'options' => array(
							array( 'name' => __("Default", 'pinnacle' ), 'value' => 'default', ),
							array( 'name' => __("Show", 'pinnacle' ), 'value' => 'show', ),
							array( 'name' => __("Hide", 'pinnacle' ), 'value' => 'hide', ),
						),
					),
					array(
						'name'    => __("Page Title background behind Header", 'pinnacle' ),
						'desc'    => '',
						'id'      => $prefix . 'pagetitle_behind_head',
						'type'    => 'select',
						'options' => array(
							array( 'name' => __("Default", 'pinnacle' ), 'value' => 'default', ),
							array( 'name' => __("Place behind Header", 'pinnacle' ), 'value' => 'true', ),
							array( 'name' => __("Don't place behind Header", 'pinnacle' ), 'value' => 'false', ),
						),
					),
				)
			);
$meta_boxes[] = array(
				'id'         => 'subtitle_metabox',
				'title'      => __( "Post Title and Subtitle", 'pinnacle' ),
				'pages'      => array( 'product', 'post', 'portfolio','staff','testimonial'), // Post type
				'context'    => 'normal',
				'priority'   => 'default',
				'show_names' => true, // Show field names on the left
				'fields' => array(
					array(
						'name' => __( "Post Header Title", 'pinnacle' ),
						'desc' => __( "Post Header Title", 'pinnacle' ),
						'id'   => $prefix . 'post_header_title',
						'type' => 'textarea_code',
					),
					array(
						'name' => __( "Subtitle", 'pinnacle' ),
						'desc' => __( "Subtitle will go below post title", 'pinnacle' ),
						'id'   => $prefix . 'subtitle',
						'type' => 'textarea_code',
					),
					array(
						'name'    => __("Align Text", 'pinnacle' ),
						'desc'    => '',
						'id'      => $prefix . 'pagetitle_align',
						'type'    => 'select',
						'options' => array(
							array( 'name' => __("Default", 'pinnacle' ), 'value' => 'default', ),
							array( 'name' => __("Align Left", 'pinnacle' ), 'value' => 'left', ),
							array( 'name' => __("Align Center", 'pinnacle' ), 'value' => 'center', ),
							array( 'name' => __("Align Right", 'pinnacle' ), 'value' => 'right', ),
						),
					),
					array(
					    'name' => 'Title Color',
					    'id'   => $prefix . 'pagetitle_title_color',
					    'type' => 'colorpicker',
					    'default'  => '',
					   
					),
					array(
					    'name' => 'Sub Title Color',
					    'id'   => $prefix . 'pagetitle_sub_color',
					    'type' => 'colorpicker',
					    'default'  => '',
					   
					),
					array(
					    'name' => 'Background Color',
					    'id'   => $prefix . 'pagetitle_bg_color',
					    'type' => 'colorpicker',
					    'default'  => '',
					   
					),
					array(
					    'name' => 'Background Image',
					    'desc' => 'Upload an image.',
					    'id' => $prefix . 'pagetitle_bg_image',
					    'type' => 'file',
					    'allow' => array( 'url') // limit to just attachments with array( 'attachment' )
					),
					array(
						'name'    => __("Background Image Position", 'pinnacle' ),
						'desc'    => '',
						'id'      => $prefix . 'pagetitle_bg_position',
						'type'    => 'select',
						'default' => 'center center',
						'options' => array(
							array( 'name' => __("Left Top", 'pinnacle' ), 'value' => 'left top', ),
							array( 'name' => __("Left Center", 'pinnacle' ), 'value' => 'left center', ),
							array( 'name' => __("Left Bottom", 'pinnacle' ), 'value' => 'left bottom', ),
							array( 'name' => __("Center Top", 'pinnacle' ), 'value' => 'center top', ),
							array( 'name' => __("Center Center", 'pinnacle' ), 'value' => 'center center', ),
							array( 'name' => __("Center Bottom", 'pinnacle' ), 'value' => 'center bottom', ),
							array( 'name' => __("Right Top", 'pinnacle' ), 'value' => 'right top', ),
							array( 'name' => __("Right Center", 'pinnacle' ), 'value' => 'right center', ),
							array( 'name' => __("Right Bottom", 'pinnacle' ), 'value' => 'right bottom', ),
						),
					),
					array(
					    'name' => 'Repeat Background Image',
					    'desc' => '',
					    'id' => $prefix . 'pagetitle_bg_repeat',
					    'type' => 'checkbox'
					),
					array(
					    'name' => 'Background Cover',
					    'desc' => '',
					    'id' => $prefix . 'pagetitle_bg_cover',
					    'type' => 'checkbox'
					),
					array(
					    'name' => 'Background Parallax',
					    'desc' => '',
					    'id' => $prefix . 'pagetitle_bg_parallax',
					    'type' => 'checkbox'
					),
					array(
						'name' => __( "Padding Top", 'pinnacle' ),
						'desc' => __( "Just enter number e.g. 25", 'pinnacle' ),
						'id'   => $prefix . 'pagetitle_ptop',
						'type' => 'kt_text_number',
					),
					array(
						'name' => __( "Padding Bottom", 'pinnacle' ),
						'desc' => __( "Just enter number e.g. 25", 'pinnacle' ),
						'id'   => $prefix . 'pagetitle_pbottom',
						'type' => 'kt_text_number',
					),
					array(
							'name' => __('Overide and use a Shortcode Slider', 'pinnacle'),
							'desc' => __('Paste slider shortcode here (example: [kadence_slider id="200"])', 'pinnacle'),
							'id'   => $prefix . 'shortcode_slider',
							'type' => 'textarea_code',
						),
					array(
						'name'    => __("Hide Page Title", 'pinnacle' ),
						'desc'    => '',
						'id'      => $prefix . 'pagetitle_hide',
						'type'    => 'select',
						'options' => array(
							array( 'name' => __("Default", 'pinnacle' ), 'value' => 'default', ),
							array( 'name' => __("Show", 'pinnacle' ), 'value' => 'show', ),
							array( 'name' => __("Hide", 'pinnacle' ), 'value' => 'hide', ),
						),
					),
					array(
						'name'    => __("Page Title background behind Header", 'pinnacle' ),
						'desc'    => '',
						'id'      => $prefix . 'pagetitle_behind_head',
						'type'    => 'select',
						'options' => array(
							array( 'name' => __("Default", 'pinnacle' ), 'value' => 'default', ),
							array( 'name' => __("Place behind Header", 'pinnacle' ), 'value' => 'true', ),
							array( 'name' => __("Don't place behind Header", 'pinnacle' ), 'value' => 'false', ),
						),
					),
				)
			);
$meta_boxes[] = array(
				'id'         => 'standard_post_metabox',
				'title'      => __("Standard Post Options", 'pinnacle'),
				'pages'      => array( 'post',), // Post type
				//'show_on' => array( 'key' => 'format', 'value' => 'standard'),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			array(
				'name'    => __("Post Summary", 'pinnacle' ),
				'desc'    => '',
				'id'      => $prefix . 'post_summery',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Standard Post Default', 'pinnacle' ), 'value' => 'default', ),
					array( 'name' => __('Text', 'pinnacle' ), 'value' => 'text', ),
					array( 'name' => __('Portrait Image', 'pinnacle'), 'value' => 'img_portrait', ),
					array( 'name' => __('Landscape Image', 'pinnacle'), 'value' => 'img_landscape', ),
				),
			),
		),
	);
$meta_boxes[] = array(
				'id'         => 'image_post_metabox',
				'title'      => __("Image Post Options", 'pinnacle'),
				'pages'      => array( 'post',), // Post type
				//'show_on' => array( 'key' => 'format', 'value' => 'standard'),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			
			array(
				'name'    => __("Head Content", 'pinnacle' ),
				'desc'    => '',
				'id'      => $prefix . 'image_blog_head',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __("Image Post Default", 'pinnacle' ), 'value' => 'default', ),
					array( 'name' => __("Image", 'pinnacle' ), 'value' => 'image', ),
					array( 'name' => __("None", 'pinnacle' ), 'value' => 'none', ),
				),
			),
			array(
				'name' => __("Max Image Width", 'pinnacle' ),
				'desc' => __("Default is: 848 or 1140 on fullwidth posts (Note: just input number, example: 650)", 'pinnacle' ),
				'id'   => $prefix . 'image_posthead_width',
				'type' => 'text_small',
			),
			array(
				'name'    => __("Post Summary", 'pinnacle' ),
				'desc'    => '',
				'id'      => $prefix . 'image_post_summery',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Image Post Default', 'pinnacle' ), 'value' => 'default', ),
					array( 'name' => __('Text', 'pinnacle' ), 'value' => 'text', ),
					array( 'name' => __('Portrait Image', 'pinnacle'), 'value' => 'img_portrait', ),
					array( 'name' => __('Landscape Image', 'pinnacle'), 'value' => 'img_landscape', ),
				),
			),
		),
	);
	$meta_boxes[] = array(
				'id'         => 'gallery_post_metabox',
				'title'      => __("Gallery Post Options", 'pinnacle'),
				'pages'      => array( 'post',), // Post type
				//'show_on' => array( 'key' => 'format', 'value' => 'standard'),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			
			array(
				'name'    => __("Post Head Content", 'pinnacle' ),
				'desc'    => '',
				'id'      => $prefix . 'gallery_blog_head',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __("Gallery Post Default", 'pinnacle' ), 'value' => 'default', ),
					array( 'name' => __("Image Slider - (Flex Slider)", 'pinnacle' ), 'value' => 'flex', ),
					array( 'name' => __("Carousel Slider - (Caroufedsel Slider)", 'pinnacle' ), 'value' => 'carouselslider', ),
					array( 'name' => __("Image Carousel - (Caroufedsel Carousel)", 'pinnacle' ), 'value' => 'carousel', ),
					array( 'name' => __("Shortcode", 'pinnacle' ), 'value' => 'shortcode', ),
					array( 'name' => __("None", 'pinnacle' ), 'value' => 'none', ),
				),
			),
			array(
				'name' => __("Post Slider Gallery", 'pinnacle' ),
				'desc' => __("Add images for gallery here", 'pinnacle' ),
				'id'   => $prefix . 'image_gallery',
				'type' => 'kad_gallery',
			),
			array(
				'name' => __('Gallery Post Shortcode', 'pinnacle'),
				'desc' => __('If using shortcode place here.', 'pinnacle'),
				'id'   => $prefix . 'post_gallery_shortcode',
				'type' => 'textarea_code',
			),
			array(
				'name' => __("Max Slider Height", 'pinnacle' ),
				'desc' => __("Default is: 400 (Note: just input number, example: 350)", 'pinnacle' ),
				'id'   => $prefix . 'gallery_posthead_height',
				'type' => 'text_small',
			),
			array(
				'name' => __("Max Slider Width", 'pinnacle' ),
				'desc' => __("Default is: 848 or 1140 on fullwidth posts (Note: just input number, example: 650, only applys to Image Slider)", 'pinnacle' ),
				'id'   => $prefix . 'gallery_posthead_width',
				'type' => 'text_small',
			),
			array(
				'name'    => __("Post Summary", 'pinnacle' ),
				'desc'    => '',
				'id'      => $prefix . 'gallery_post_summery',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Gallery Post Default', 'pinnacle' ), 'value' => 'default', ),
					array( 'name' => __('Photo Grid - (Need atleast five images)', 'pinnacle'), 'value' => 'gallery_grid', ),
					array( 'name' => __('Portrait Image (feature image)', 'pinnacle'), 'value' => 'img_portrait', ),
					array( 'name' => __('Landscape Image (feature image)', 'pinnacle'), 'value' => 'img_landscape', ),
					array( 'name' => __('Portrait Image Slider', 'pinnacle'), 'value' => 'slider_portrait', ),
					array( 'name' => __('Landscape Image Slider', 'pinnacle'), 'value' => 'slider_landscape', ),
				),
			),
		),
	);
$meta_boxes[] = array(
				'id'         => 'video_post_metabox',
				'title'      => __("Video Post Options", 'pinnacle'),
				'pages'      => array( 'post',), // Post type
				//'show_on' => array( 'key' => 'format', 'value' => 'standard'),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			
			array(
				'name'    => __("Post Head Content", 'pinnacle' ),
				'desc'    => '',
				'id'      => $prefix . 'video_blog_head',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __("Video Post Default", 'pinnacle' ), 'value' => 'default', ),
					array( 'name' => __("Video", 'pinnacle' ), 'value' => 'video', ),
					array( 'name' => __("Shortcode", 'pinnacle' ), 'value' => 'shortcode', ),
					array( 'name' => __("None", 'pinnacle' ), 'value' => 'none', ),
				),
			),
			array(
				'name' => __('Video Post embed code', 'pinnacle'),
				'desc' => __('Place Embed Code Here, works with youtube, vimeo. (Use the featured image for screen shot)', 'pinnacle'),
				'id'   => $prefix . 'post_video',
				'type' => 'textarea_code',
			),
			array(
				'name' => __('Video Post Shortcode', 'pinnacle'),
				'desc' => __('If using shortcode place here. (Use the featured image for screen shot)', 'pinnacle'),
				'id'   => $prefix . 'post_video_shortcode',
				'type' => 'textarea_code',
			),
			array(
				'name' => __("Max Video Width", 'pinnacle' ),
				'desc' => __("Default is: 848 or 1140 on fullwidth posts (Note: just input number, example: 650, does not apply to carousel slider)", 'pinnacle' ),
				'id'   => $prefix . 'video_posthead_width',
				'type' => 'text_small',
			),
			array(
				'name'    => __("Post Summary", 'pinnacle' ),
				'desc'    => '',
				'id'      => $prefix . 'video_post_summery',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Video Post Default', 'pinnacle' ), 'value' => 'default', ),
					array( 'name' => __('Video - (when possible)', 'pinnacle'), 'value' => 'video', ),
					array( 'name' => __('Portrait Image (feature image)', 'pinnacle'), 'value' => 'img_portrait', ),
					array( 'name' => __('Landscape Image (feature image)', 'pinnacle'), 'value' => 'img_landscape', ),
				),
			),
		),
	);

	$meta_boxes[] = array(
				'id'         => 'post_metabox',
				'title'      => __("Post Options", 'pinnacle'),
				'pages'      => array( 'post',), // Post type
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			array(
				'name' => __('Display Sidebar?', 'pinnacle'),
				'desc' => __('Choose if layout is fullwidth or sidebar', 'pinnacle'),
				'id'   => $prefix . 'post_sidebar',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Default', 'pinnacle'), 'value' => 'default', ),
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
				),
			),
			array(
				'name'    => __('Choose Sidebar', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'sidebar_choice',
				'type'    => 'imag_select_sidebars',
			),
			array(
				'name' => __('Author Info', 'pinnacle'),
				'desc' => __('Display an author info box?', 'pinnacle'),
				'id'   => $prefix . 'blog_author',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Default', 'pinnacle'), 'value' => 'default', ),
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
				),
			),	
			array(
				'name' => __('Posts Carousel', 'pinnacle'),
				'desc' => __('Display a carousel with similar or recent posts?', 'pinnacle'),
				'id'   => $prefix . 'blog_carousel_similar',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Default', 'pinnacle'), 'value' => 'default', ),
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
					array( 'name' => __('Yes - Display Recent Posts', 'pinnacle'), 'value' => 'recent', ),
					array( 'name' => __('Yes - Display Similar Posts', 'pinnacle'), 'value' => 'similar', )
				),
				
			),
			array(
				'name' => __('Carousel Title', 'pinnacle'),
				'desc' => __('ex. Similar Posts', 'pinnacle'),
				'id'   => $prefix . 'blog_carousel_title',
				'type' => 'text_medium',
			),
		),
	);

	$meta_boxes[] = array(
				'id'         => 'portfolio_post_metabox',
				'title'      => __('Portfolio Post Options', 'pinnacle'),
				'pages'      => array( 'portfolio' ), // Post type
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			
			array(
				'name'    => __('Project Layout', 'pinnacle'),
				'desc'    => '<a href="http://docs.kadencethemes.com/pinnacle/#portfolio_posts" target="_blank" >Whats the difference?</a>',
				'id'      => $prefix . 'ppost_layout',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => __('Beside 40%', 'pinnacle'), 'value' => 'beside', ),
					array( 'name' => __('Beside 33%', 'pinnacle'), 'value' => 'besidesmall', ),
					array( 'name' => __('Above', 'pinnacle'), 'value' => 'above', ),
					array( 'name' => __('Three Rows', 'pinnacle'), 'value' => 'three', ), 
				),
			),
			array(
				'name'    => __('Project Options', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'ppost_type',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Image', 'pinnacle'), 'value' => 'image', ),
					array( 'name' => __('Image Slider (Flex Slider)', 'pinnacle'), 'value' => 'flex', ),
					array( 'name' => __('Carousel Slider', 'pinnacle'), 'value' => 'carousel', ),
					array( 'name' => __('Image Carousel', 'pinnacle'), 'value' => 'imgcarousel', ),
					array( 'name' => __('Shortcode Slider', 'pinnacle'), 'value' => 'shortcode', ),
					array( 'name' => __('Image Grid', 'pinnacle'), 'value' => 'imagegrid', ),
					array( 'name' => __('Image List', 'pinnacle'), 'value' => 'imagelist', ),
					array( 'name' => __('Image List Style 2', 'pinnacle'), 'value' => 'imagelist2', ),
					array( 'name' => __('Video', 'pinnacle'), 'value' => 'video', ),
					array( 'name' => __('None', 'pinnacle'), 'value' => 'none', ),
				),
			),
			array(
				'name'    => __('Columns (Only for Image Grid option)', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'portfolio_img_grid_columns',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Four Column', 'pinnacle'), 'value' => '4', ),
					array( 'name' => __('Three Column', 'pinnacle'), 'value' => '3', ),
					array( 'name' => __('Two Column', 'pinnacle'), 'value' => '2', ),
					array( 'name' => __('Five Column', 'pinnacle'), 'value' => '5', ),
					array( 'name' => __('Six Column', 'pinnacle'), 'value' => '6', ),
				),
			),
			array(
				'name' => __("Portfolio Slider/Images", 'pinnacle' ),
				'desc' => __("Add images for post here", 'pinnacle' ),
				'id'   => $prefix . 'image_gallery',
				'type' => 'kad_gallery',
			),
			array(
				'name' => __("Slider Shortcode", 'pinnacle' ),
				'desc' => __("Paste Slider Shortcode here", 'pinnacle' ),
				'id'   => $prefix . 'portfolio_shortcode_slider',
				'type' => 'textarea_code',
			),
			array(
				'name' => __("Max Image/Slider Height", 'pinnacle' ),
				'desc' => __("Default is: 450 (Note: just input number, example: 350)", 'pinnacle' ),
				'id'   => $prefix . 'posthead_height',
				'type' => 'text_small',
			),
			array(
				'name' => __("Max Image/Slider Width", 'pinnacle' ),
				'desc' => __("Default is: 670 or 1140 on above or three row layouts (Note: just input number, example: 650)", 'pinnacle' ),
				'id'   => $prefix . 'posthead_width',
				'type' => 'text_small',
			),
			array(
				'name'    => __('Project Summary', 'pinnacle'),
				'desc'    => 'This determines how its displayed in the <b>portfolio grid page</b>',
				'id'      => $prefix . 'post_summery',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Image', 'pinnacle'), 'value' => 'image', ),
					array( 'name' => __('Image Slider', 'pinnacle'), 'value' => 'slider', ),
					array( 'name' => __('Image with video lightbox (must be url)', 'pinnacle'), 'value' => 'videolight', ),
				),
			),
			array(
				'name' => __('Value 01 Title', 'pinnacle'),
				'desc' => __('ex. Project Type:', 'pinnacle'),
				'id'   => $prefix . 'project_val01_title',
				'type' => 'text_medium',
			),
			array(
				'name' => __('Value 01 Description', 'pinnacle'),
				'desc' => __('ex. Character Illustration', 'pinnacle'),
				'id'   => $prefix . 'project_val01_description',
				'type' => 'text_medium',
			),
			array(
				'name' => __('Value 02 Title', 'pinnacle'),
				'desc' => __('ex. Skills Needed:', 'pinnacle'),
				'id'   => $prefix . 'project_val02_title',
				'type' => 'text_medium',
			),
			array(
				'name' => __('Value 02 Description', 'pinnacle'),
				'desc' => __('ex. Photoshop, Illustrator', 'pinnacle'),
				'id'   => $prefix . 'project_val02_description',
				'type' => 'text_medium',
			),
			array(
				'name' => __('Value 03 Title', 'pinnacle'),
				'desc' => __('ex. Customer:', 'pinnacle'),
				'id'   => $prefix . 'project_val03_title',
				'type' => 'text_medium',
			),
			array(
				'name' => __('Value 03 Description', 'pinnacle'),
				'desc' => __('ex. Example Inc', 'pinnacle'),
				'id'   => $prefix . 'project_val03_description',
				'type' => 'text_medium',
			),
			array(
				'name' => __('Value 04 Title', 'pinnacle'),
				'desc' => __('ex. Project Year:', 'pinnacle'),
				'id'   => $prefix . 'project_val04_title',
				'type' => 'text_medium',
			),
			array(
				'name' => __('Value 04 Description', 'pinnacle'),
				'desc' => __('ex. 2013', 'pinnacle'),
				'id'   => $prefix . 'project_val04_description',
				'type' => 'text_medium',
			),
			array(
				'name' => __('External Website', 'pinnacle'),
				'desc' => __('ex. Website:', 'pinnacle'),
				'id'   => $prefix . 'project_val05_title',
				'type' => 'text_medium',
			),
			array(
				'name' => __('Website Address', 'pinnacle'),
				'desc' => __('ex. http://www.example.com', 'pinnacle'),
				'id'   => $prefix . 'project_val05_description',
				'type' => 'text_medium',
			),
			array(
				'name' => __('If Video Project - Video URL (recomended)', 'pinnacle'),
				'desc' => __('Place youtube, vimeo url', 'pinnacle'),
				'id'   => $prefix . 'post_video_url',
				'type' => 'textarea_code',
			),
			array(
				'name' => __('If Video Project - Video Embed Code', 'pinnacle'),
						'desc' => __('Place Embed Code Here, works with youtube, vimeo... (does not work with lightbox)', 'pinnacle'),
						'id'   => $prefix . 'post_video',
						'type' => 'textarea_code',
					),
			array(
				'name'    => __('Choose Portfolio Parent Page', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'portfolio_parent',
				'type'    => 'select_pages',
			),
				
		),
	);
	$meta_boxes[] = array(
				'id'         => 'portfolio_post_carousel_metabox',
				'title'      => __('Bottom Carousel Options', 'pinnacle'),
				'pages'      => array( 'portfolio' ), // Post type
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			array(
				'name' => __('Carousel Title', 'pinnacle'),
				'desc' => __('ex. Similar Projects', 'pinnacle'),
				'id'   => $prefix . 'portfolio_carousel_title',
				'type' => 'text_medium',
			),
			array(
				'name' => __('Bottom Portfolio Carousel', 'pinnacle'),
				'desc' => __('Display a carousel with portfolio items below project?', 'pinnacle'),
				'id'   => $prefix . 'portfolio_carousel_recent',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Default', 'pinnacle'), 'value' => 'defualt', ),
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
				),
			),
			array(
				'name' => __('Carousel Items', 'pinnacle'),
				'desc' => '',
				'id'   => $prefix . 'portfolio_carousel_group',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Default', 'pinnacle'), 'value' => 'defualt', ),
					array( 'name' => __('All Portfolio Posts', 'pinnacle'), 'value' => 'all', ),
					array( 'name' => __('Only of same Portfolio Type', 'pinnacle'), 'value' => 'cat', ),
				),
			),
			array(
				'name' => __('Carousel Order', 'pinnacle'),
				'desc' => '',
				'id'   => $prefix . 'portfolio_carousel_order',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Menu Order', 'pinnacle'), 'value' => 'menu_order', ),
					array( 'name' => __('Title', 'pinnacle'), 'value' => 'title', ),
					array( 'name' => __('Date', 'pinnacle'), 'value' => 'date', ),
					array( 'name' => __('Random', 'pinnacle'), 'value' => 'rand', ),
				),
			),
				
		),
	);

	$meta_boxes[] = array(
				'id'         => 'testimonial_post_metabox',
				'title'      => __('Testimonial Options', 'pinnacle'),
				'pages'      => array( 'testimonial' ), // Post type
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			array(
				'name' => __('Text Next To Name', 'pinnacle'),
				'desc' => __('ex: New York, NY', 'pinnacle'),
				'id'   => $prefix . 'testimonial_location',
				'type' => 'text',
			),
			array(
				'name'    => __('Client Title (single post only)', 'pinnacle'),
				'desc'    => __('ex: CEO of Example Inc', 'pinnacle'),
				'id'      => $prefix . 'testimonial_occupation',
				'type' => 'text',
			),
			array(
				'name'    => __('Link (single post only)', 'pinnacle'),
				'desc'    => __('ex: http://www.example.com', 'pinnacle'),
				'id'      => $prefix . 'testimonial_link',
				'type' => 'text',
			),
		),
	);
	$meta_boxes[] = array(
				'id'         => 'staff_post_metabox',
				'title'      => __('Staff Options', 'pinnacle'),
				'pages'      => array( 'staff' ), // Post type
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			array(
				'name' => __('Job Title', 'pinnacle'),
				'desc' => __('ex: Customer Service', 'pinnacle'),
				'id'   => $prefix . 'staff_job_title',
				'type' => 'text',
			),
			array(
				'name'    => __('Facebook Link', 'pinnacle'),
				'id'      => $prefix . 'staff_facebook',
				'type' => 'text',
			),
			array(
				'name'    => __('Twitter Link', 'pinnacle'),
				'id'      => $prefix . 'staff_twitter',
				'type' => 'text',
			),
			array(
				'name'    => __('Instagram Link', 'pinnacle'),
				'id'      => $prefix . 'staff_instagram',
				'type' => 'text',
			),
			array(
				'name'    => __('Linkedin Link', 'pinnacle'),
				'id'      => $prefix . 'staff_linkedin',
				'type' => 'text',
			),
		),
	);
	$meta_boxes[] = array(
				'id'         => 'single_post_metabox',
				'title'      => __("Post Options", 'pinnacle'),
				'pages'      => array( 'staff', 'testimonial'), // Post type
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			array(
				'name' => __('Display Sidebar?', 'pinnacle'),
				'desc' => __('Choose if layout is fullwidth or sidebar', 'pinnacle'),
				'id'   => $prefix . 'post_sidebar',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
				),
			),
			array(
				'name'    => __('Choose Sidebar', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'sidebar_choice',
				'type'    => 'imag_select_sidebars',
			),
		),
	);
	$meta_boxes[] = array(
				'id'         => 'product_post_side_metabox',
				'title'      => __('Product Sidebar Options', 'pinnacle'),
				'pages'      => array( 'product' ), // Post type
				'context'    => 'normal',
				'priority'   => 'default',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			array(
				'name' => __('Display Sidebar?', 'pinnacle'),
				'desc' => __('Choose if layout is fullwidth or sidebar', 'pinnacle'),
				'id'   => $prefix . 'post_sidebar',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Default', 'pinnacle'), 'value' => 'default', ),
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
				),
			),
			array(
				'name'    => __('Choose Sidebar', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'sidebar_choice',
				'type'    => 'imag_select_sidebars_product',
				),
		),
	);
	$meta_boxes[] = array(
				'id'         => 'product_post_metabox',
				'title'      => __('Product Video Tab', 'pinnacle'),
				'pages'      => array( 'product' ), // Post type
				'context'    => 'normal',
				'priority'   => 'default',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			array(
						'name' => __('Product Video', 'pinnacle'),
						'desc' => __('Place Embed Code Here, works with youtube, vimeo...', 'pinnacle'),
						'id'   => $prefix . 'product_video',
						'type' => 'textarea_code',
					),
		),
	);


			$meta_boxes[] = array(
				'id'         => 'portfolio_metabox',
				'title'      => __('Portfolio Page Options', 'pinnacle'),
				'pages'      => array( 'page' ), // Post type
				'show_on' => array('key' => 'page-template', 'value' => array( 'template-portfolio-grid.php')),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			array(
				'name'    => __('Style', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'portfolio_style',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Default', 'pinnacle'), 'value' => 'default', ),
					array( 'name' => __('Post Boxes', 'pinnacle'), 'value' => 'padded_style', ),
					array( 'name' => __('Flat No Margin', 'pinnacle'), 'value' => 'flat-no-margin', ),
					array( 'name' => __('Flat with Margin', 'pinnacle'), 'value' => 'flat-w-margin', ),
				),
			),
			array(
				'name'    => __('Hover Style', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'portfolio_hover_style',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Default', 'pinnacle'), 'value' => 'default', ),
					array( 'name' => __('Light', 'pinnacle'), 'value' => 'p_lightstyle', ),
					array( 'name' => __('Dark', 'pinnacle'), 'value' => 'p_darkstyle', ),
					array( 'name' => __('Primary Color', 'pinnacle'), 'value' => 'p_primarystyle', ),
				),
			),
			array(
				'name'    => __('Columns', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'portfolio_columns',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Four Column', 'pinnacle'), 'value' => '4', ),
					array( 'name' => __('Three Column', 'pinnacle'), 'value' => '3', ),
					array( 'name' => __('Two Column', 'pinnacle'), 'value' => '2', ),
					array( 'name' => __('Five Column', 'pinnacle'), 'value' => '5', ),
					array( 'name' => __('Six Column', 'pinnacle'), 'value' => '6', ),
				),
			),
			array(
				'name'    => __('Fullwidth - Span Screen Size?', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'portfolio_fullwidth',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
				),
			),
			array(
				'name'    => __('Filter?', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'portfolio_filter',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
				),
			),
			array(
                'name' => __('Portfolio Work Types', 'pinnacle'),
                'desc' => __('You can have filterable portfolios with one work type if has children', 'pinnacle'),
                'id' => $prefix .'portfolio_type',
                'type' => 'imag_select_taxonomy',
                'taxonomy' => 'portfolio-type',
            ),
            array(
				'name'    => __('Order Items By', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'portfolio_order',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Menu Order', 'pinnacle'), 'value' => 'menu_order', ),
					array( 'name' => __('Title', 'pinnacle'), 'value' => 'title', ),
					array( 'name' => __('Date', 'pinnacle'), 'value' => 'date', ),
					array( 'name' => __('Random', 'pinnacle'), 'value' => 'rand', ),
				),
			),
			array(
				'name'    => __('Items per Page', 'pinnacle'),
				'desc'    => __('How many portfolio items per page', 'pinnacle'),
				'id'      => $prefix . 'portfolio_items',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('All', 'pinnacle'), 'value' => 'all', ),
					array( 'name' => '3', 'value' => '3', ),
					array( 'name' => '4', 'value' => '4', ),
					array( 'name' => '5', 'value' => '5', ),
					array( 'name' => '6', 'value' => '6', ),
					array( 'name' => '7', 'value' => '7', ),
					array( 'name' => '8', 'value' => '8', ),
					array( 'name' => '9', 'value' => '9', ),
					array( 'name' => '10', 'value' => '10', ),
					array( 'name' => '11', 'value' => '11', ),
					array( 'name' => '12', 'value' => '12', ),
					array( 'name' => '13', 'value' => '13', ),
					array( 'name' => '14', 'value' => '14', ),
					array( 'name' => '15', 'value' => '15', ),
					array( 'name' => '16', 'value' => '16', ),
				),
			),
			array(
				'name'    => __('Image Ratio?', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'portfolio_img_ratio',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Default', 'pinnacle'), 'value' => 'default', ),
					array( 'name' => __('Square 1:1', 'pinnacle'), 'value' => 'square', ),
					array( 'name' => __('Portrait 3:4', 'pinnacle'), 'value' => 'portrait', ),
					array( 'name' => __('Landscape 4:3', 'pinnacle'), 'value' => 'landscape', ),
					array( 'name' => __('Wide Landscape 4:2', 'pinnacle'), 'value' => 'widelandscape', ),
				),
			),
			array(
				'name' => __('Masonry Layout?', 'pinnacle'),
				'desc' => __('Images height will not be cropped', 'pinnacle'),
				'id'   => $prefix . 'portfolio_masonry',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
					),
			),
			array(
				'name' => __('Display Item Work Types', 'pinnacle'),
				'desc' => '',
				'id'   => $prefix . 'portfolio_item_types',
				'type' => 'checkbox',
			),
			array(
				'name' => __('Display Item Excerpt', 'pinnacle'),
				'desc' => '',
				'id'   => $prefix . 'portfolio_item_excerpt',
				'type' => 'checkbox',
			),
			array(
				'name' => __('Add Lightbox link in each item', 'pinnacle'),
				'desc' => '',
				'id'   => $prefix . 'portfolio_lightbox',
				'type' => 'checkbox',
			),
				
			));
	$meta_boxes[] = array(
				'id'         => 'staff_page_metabox',
				'title'      => __('Staff Page Options', 'pinnacle'),
				'pages'      => array( 'page' ), // Post type
				'show_on' => array('key' => 'page-template', 'value' => array( 'template-staff-grid.php' )),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			array(
				'name'    => __('Columns', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'staff_columns',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Four Column', 'pinnacle'), 'value' => '4', ),
					array( 'name' => __('Three Column', 'pinnacle'), 'value' => '3', ),
					array( 'name' => __('Two Column', 'pinnacle'), 'value' => '2', ),
				),
			),
			array(
                'name' => __('Limit to Group', 'pinnacle'),
                'desc' => '',
                'id' => $prefix .'staff_type',
                'type' => 'imag_select_taxonomy',
                'taxonomy' => 'staff-group',
            ),
			array(
				'name'    => __('Items per Page', 'pinnacle'),
				'desc'    => __('How many portfolio items per page', 'pinnacle'),
				'id'      => $prefix . 'staff_items',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('All', 'pinnacle'), 'value' => 'all', ),
					array( 'name' => '3', 'value' => '3', ),
					array( 'name' => '4', 'value' => '4', ),
					array( 'name' => '5', 'value' => '5', ),
					array( 'name' => '6', 'value' => '6', ),
					array( 'name' => '7', 'value' => '7', ),
					array( 'name' => '8', 'value' => '8', ),
					array( 'name' => '9', 'value' => '9', ),
					array( 'name' => '10', 'value' => '10', ),
					array( 'name' => '11', 'value' => '11', ),
					array( 'name' => '12', 'value' => '12', ),
					array( 'name' => '13', 'value' => '13', ),
					array( 'name' => '14', 'value' => '14', ),
					array( 'name' => '15', 'value' => '15', ),
					array( 'name' => '16', 'value' => '16', ),
				),
			),
			array(
				'name'    => __('Image Ratio?', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'staff_img_ratio',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Square 1:1', 'pinnacle'), 'value' => 'square', ),
					array( 'name' => __('Portrait 3:4', 'pinnacle'), 'value' => 'portrait', ),
					array( 'name' => __('Landscape 4:3', 'pinnacle'), 'value' => 'landscape', ),
					array( 'name' => __('Wide Landscape 4:2', 'pinnacle'), 'value' => 'widelandscape', ),
				),
			),
			array(
				'name' => __('Masonry Layout?', 'pinnacle'),
				'desc' => __('Images height will not be cropped', 'pinnacle'),
				'id'   => $prefix . 'staff_masonry',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('No', 'pinnacle'), 'value' => 'false', ),
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'true', ),
					),
			),
			array(
				'name' => __('Use Staff Excerpt or Content?', 'pinnacle'),
				'id'   => $prefix . 'staff_wordlimit',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Excerpt', 'pinnacle'), 'value' => 'false', ),
					array( 'name' => __('Content', 'pinnacle'), 'value' => 'true', ),
					),
			),
			array(
				'name' => __('Make images and title link to single post?', 'pinnacle'),
				'id'   => $prefix . 'staff_single_link',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'true', ),
					array( 'name' => __('No', 'pinnacle'), 'value' => 'false', ),
					),
			),
				
			));
			$meta_boxes[] = array(
				'id'         => 'testimonial_page_metabox',
				'title'      => __('Testimonial Page Options', 'pinnacle'),
				'pages'      => array( 'page' ), // Post type
				'show_on' => array('key' => 'page-template', 'value' => array( 'template-testimonial-grid.php' )),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			array(
				'name'    => __('Columns', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'testimonial_columns',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Four Column', 'pinnacle'), 'value' => '4', ),
					array( 'name' => __('Three Column', 'pinnacle'), 'value' => '3', ),
					array( 'name' => __('Two Column', 'pinnacle'), 'value' => '2', ),
				),
			),
			array(
				'name'    => __('Orderby', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'testimonial_orderby',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Menu Order', 'pinnacle'), 'value' => 'menu_order', ),
					array( 'name' => __('Title', 'pinnacle'), 'value' => 'title', ),
					array( 'name' => __('Date', 'pinnacle'), 'value' => 'date', ),
					array( 'name' => __('Random', 'pinnacle'), 'value' => 'rand', ),
				),
			),
			array(
                'name' => __('Testimonial Group', 'pinnacle'),
                'desc' => '',
                'id' => $prefix .'testimonial_type',
                'type' => 'imag_select_taxonomy',
                'taxonomy' => 'testimonial-group',
            ),
			array(
				'name'    => __('Items per Page', 'pinnacle'),
				'desc'    => __('How many testimonial items per page', 'pinnacle'),
				'id'      => $prefix . 'testimonial_items',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('All', 'pinnacle'), 'value' => 'all', ),
					array( 'name' => '3', 'value' => '3', ),
					array( 'name' => '4', 'value' => '4', ),
					array( 'name' => '5', 'value' => '5', ),
					array( 'name' => '6', 'value' => '6', ),
					array( 'name' => '7', 'value' => '7', ),
					array( 'name' => '8', 'value' => '8', ),
					array( 'name' => '9', 'value' => '9', ),
					array( 'name' => '10', 'value' => '10', ),
					array( 'name' => '11', 'value' => '11', ),
					array( 'name' => '12', 'value' => '12', ),
					array( 'name' => '13', 'value' => '13', ),
					array( 'name' => '14', 'value' => '14', ),
					array( 'name' => '15', 'value' => '15', ),
					array( 'name' => '16', 'value' => '16', ),
				),
			),
			array(
				'name' => __('Limit Testimonial Text', 'pinnacle'),
				'desc' => '',
				'id'   => $prefix . 'limit_testimonial',
				'type' => 'checkbox',
				'std'  => '0'
			),
			array(
				'name' => __('Word Count Text', 'pinnacle'),
				'desc' => __('eg: 25', 'pinnacle'),
				'id'   => $prefix . 'testimonial_word_count',
				'type' => 'text_small',
			),
			array(
				'name' => __('Add link to single post', 'pinnacle'),
				'desc' => '',
				'id'   => $prefix . 'single_testimonial_link',
				'type' => 'checkbox',
				'std'  => '0'
			),
			array(
				'name' => __('Link Text', 'pinnacle'),
				'desc' => __('eg: Read More', 'pinnacle'),
				'id'   => $prefix . 'testimonial_link_text',
				'type' => 'text_small',
			),							
			));

			
			$meta_boxes[] = array(
				'id'         => 'pagefeature_metabox',
				'title'      => __('Feature Page Options', 'pinnacle'),
				'pages'      => array( 'page' ), // Post type
				'show_on' => array('key' => 'page-template', 'value' => array( 'template-feature.php')),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			
			array(
				'name'    => __('Header Options', 'pinnacle'),
				'desc'    => __('If image slider make sure images uploaded are at-least 1170px wide.', 'pinnacle'),
				'id'      => $prefix . 'page_head',
				'type'    => 'select',
				'defualt' => 'pagetitle',
				'options' => array(
					array( 'name' => __('Page Title', 'pinnacle'), 'value' => 'pagetitle', ),
					array( 'name' => __('Image Slider (Flex Slider)', 'pinnacle'), 'value' => 'flex', ),
					array( 'name' => __('Carousel Slider', 'pinnacle'), 'value' => 'carousel', ),
					array( 'name' => __('Image Carousel', 'pinnacle'), 'value' => 'imgcarousel', ),
					array( 'name' => __('Shortcode Slider', 'pinnacle'), 'value' => 'shortcode', ),
					array( 'name' => __('Video', 'pinnacle'), 'value' => 'video', ),
				),
			),
			array(
				'name' => __("Slider Images", 'pinnacle' ),
				'desc' => __("Add for flex, carousel, and image carousel.", 'pinnacle' ),
				'id'   => $prefix . 'image_gallery',
				'type' => 'kad_gallery',
			),
			array(
				'name' => __('If Shortcode Slider', 'pinnacle'),
				'desc' => __('Paste slider shortcode here (example: [cycloneslider id="slider1"])', 'pinnacle'),
				'id'   => $prefix . 'feature_shortcode_slider',
				'type' => 'textarea_code',
			),
			array(
				'name' => __('Max Image/Slider Height', 'pinnacle'),
				'desc' => __('Default is: 400 (Note: just input number, example: 350)', 'pinnacle'),
				'id'   => $prefix . 'posthead_height',
				'type' => 'text_small',
			),
			array(
				'name' => __("Max Image/Slider Width", 'pinnacle' ),
				'desc' => __("Default is: 1140 on fullwidth posts (Note: just input number, example: 650, does not apply to Carousel slider)", 'pinnacle' ),
				'id'   => $prefix . 'posthead_width',
				'type' => 'text_small',
			),
			array(
				'name' => __('If Video Post', 'pinnacle'),
				'desc' => __('Place Embed Code Here, works with youtube, vimeo...', 'pinnacle'),
				'id'   => $prefix . 'post_video',
				'type' => 'textarea_code',
			),
								
			));
	$meta_boxes[] = array(
				'id'         => 'bloglist_metabox',
				'title'      => __('Blog List Options', 'pinnacle'),
				'pages'      => array( 'page' ), // Post type
				'show_on' => array('key' => 'page-template', 'value' => array( 'template-blog.php')),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			
			array(
                'name' => __('Blog Category', 'pinnacle'),
                'desc' => __('Select all blog posts or a specific category to show', 'pinnacle'),
                'id' => $prefix .'blog_cat',
                'type' => 'imag_select_category',
                'taxonomy' => 'category',
            ),
			array(
				'name'    => __('How Many Posts Per Page', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'blog_items',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('All', 'pinnacle'), 'value' => 'all', ),
					array( 'name' => '2', 'value' => '2', ),
					array( 'name' => '3', 'value' => '3', ),
					array( 'name' => '4', 'value' => '4', ),
					array( 'name' => '5', 'value' => '5', ),
					array( 'name' => '6', 'value' => '6', ),
					array( 'name' => '7', 'value' => '7', ),
					array( 'name' => '8', 'value' => '8', ),
					array( 'name' => '9', 'value' => '9', ),
					array( 'name' => '10', 'value' => '10', ),
					array( 'name' => '11', 'value' => '11', ),
					array( 'name' => '12', 'value' => '12', ),
					array( 'name' => '13', 'value' => '13', ),
					array( 'name' => '14', 'value' => '14', ),
					array( 'name' => '15', 'value' => '15', ),
					array( 'name' => '16', 'value' => '16', ),
				),
			),
			array(
				'name'    => __('Display Post Content as:', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'blog_summery',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Summary', 'pinnacle'), 'value' => 'summery', ),
					array( 'name' => __('Full', 'pinnacle'), 'value' => 'full', ),
				),
			),
				
			));
			$meta_boxes[] = array(
				'id'         => 'bloggrid_metabox',
				'title'      => __('Blog Grid Options', 'pinnacle'),
				'pages'      => array( 'page' ), // Post type
				'show_on' => array('key' => 'page-template', 'value' => array( 'template-blog-grid.php')),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			
			array(
                'name' => __('Blog Category', 'pinnacle'),
                'desc' => __('Select all blog posts or a specific category to show', 'pinnacle'),
                'id' => $prefix .'blog_cat',
                'type' => 'imag_select_category',
                'taxonomy' => 'category',
            ),
			array(
				'name'    => __('How Many Posts Per Page', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'blog_items',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('All', 'pinnacle'), 'value' => 'all', ),
					array( 'name' => '2', 'value' => '2', ),
					array( 'name' => '3', 'value' => '3', ),
					array( 'name' => '4', 'value' => '4', ),
					array( 'name' => '5', 'value' => '5', ),
					array( 'name' => '6', 'value' => '6', ),
					array( 'name' => '7', 'value' => '7', ),
					array( 'name' => '8', 'value' => '8', ),
					array( 'name' => '9', 'value' => '9', ),
					array( 'name' => '10', 'value' => '10', ),
					array( 'name' => '11', 'value' => '11', ),
					array( 'name' => '12', 'value' => '12', ),
					array( 'name' => '13', 'value' => '13', ),
					array( 'name' => '14', 'value' => '14', ),
					array( 'name' => '15', 'value' => '15', ),
					array( 'name' => '16', 'value' => '16', ),
				),
			),
			array(
				'name'    => __('Choose Column Layout:', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'blog_columns',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Four Column', 'pinnacle'), 'value' => '4', ),
					array( 'name' => __('Three Column', 'pinnacle'), 'value' => '3', ),
					array( 'name' => __('Two Column', 'pinnacle'), 'value' => '2', ),
				),
			),			
			));
            $meta_boxes[] = array(
				'id'         => 'bloggrid_metabox',
				'title'      => __('Blog Grid Options', 'pinnacle'),
				'pages'      => array( 'page' ), // Post type
				'show_on' => array('key' => 'page-template', 'value' => array('template-blog-photogrid.php')),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true,
				'fields' => array(
			
			array(
                'name' => __('Blog Category', 'pinnacle'),
                'desc' => __('Select all blog posts or a specific category to show', 'pinnacle'),
                'id' => $prefix .'blog_cat',
                'type' => 'imag_select_category',
                'taxonomy' => 'category',
            ),
			array(
				'name'    => __('How Many Posts Per Page', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'blog_items',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('All', 'pinnacle'), 'value' => 'all', ),
					array( 'name' => '2', 'value' => '2', ),
					array( 'name' => '3', 'value' => '3', ),
					array( 'name' => '4', 'value' => '4', ),
					array( 'name' => '5', 'value' => '5', ),
					array( 'name' => '6', 'value' => '6', ),
					array( 'name' => '7', 'value' => '7', ),
					array( 'name' => '8', 'value' => '8', ),
					array( 'name' => '9', 'value' => '9', ),
					array( 'name' => '10', 'value' => '10', ),
					array( 'name' => '11', 'value' => '11', ),
					array( 'name' => '12', 'value' => '12', ),
					array( 'name' => '13', 'value' => '13', ),
					array( 'name' => '14', 'value' => '14', ),
					array( 'name' => '15', 'value' => '15', ),
					array( 'name' => '16', 'value' => '16', ),
				),
			),
			array(
				'name'    => __('Choose Column Layout:', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'blog_columns',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('Four Column', 'pinnacle'), 'value' => '4', ),
					array( 'name' => __('Three Column', 'pinnacle'), 'value' => '3', ),
					array( 'name' => __('Two Column', 'pinnacle'), 'value' => '2', ),
				),
			),
			array(
				'name'    => __('Fullwidth - Span Screen Size?', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'blog_photofullwidth',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
				),
			),
			));
			$meta_boxes[] = array(
				'id'         => 'contact_metabox',
				'title'      => __('Contact Page Options', 'pinnacle'),
				'pages'      => array( 'page' ), // Post type
				'show_on' => array('key' => 'page-template', 'value' => array( 'template-contact.php')),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true, // Show field names on the left
				'fields' => array(
			
			array(
                'name' => __('Use Contact Form', 'pinnacle'),
                'desc' => '',
                'id' => $prefix .'contact_form',
                'type'    => 'select',
				'options' => array(
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
				),
			),
			array(
				'name' => __('Contact Form Title', 'pinnacle'),
				'desc' => __('ex. Send us an Email', 'pinnacle'),
				'id'   => $prefix . 'contact_form_title',
				'type' => 'text',
			),
			array(
				'name' => __('Contact Form Email Recipient', 'pinnacle'),
				'desc' => __('ex. joe@gmail.com', 'pinnacle'),
				'id'   => $prefix . 'contact_form_email',
				'type' => 'text',
			),
			array(
                'name' => __('Use Simple Math Question', 'pinnacle'),
                'desc' => 'Adds a simple math question to form.',
                'id' => $prefix .'contact_form_math',
                'type'    => 'select',
				'options' => array(
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
				),
			),
			array(
                'name' => __('Use Map', 'pinnacle'),
                'desc' => '',
                'id' => $prefix .'contact_map',
                'type'    => 'select',
				'options' => array(
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
				),
			),
			array(
				'name' => __('Address', 'pinnacle'),
				'desc' => __('Enter your Location', 'pinnacle'),
				'id'   => $prefix . 'contact_address',
				'type' => 'text',
			),
			array(
				'name'    => __('Map Type', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'contact_maptype',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('ROADMAP', 'pinnacle'), 'value' => 'ROADMAP', ),
					array( 'name' => __('HYBRID', 'pinnacle'), 'value' => 'HYBRID', ),
					array( 'name' => __('TERRAIN', 'pinnacle'), 'value' => 'TERRAIN', ),
					array( 'name' => __('SATELLITE', 'pinnacle'), 'value' => 'SATELLITE', ),
				),
			),
			array(
				'name' => __('Map Zoom Level', 'pinnacle'),
				'desc' => __('A good place to start is 15', 'pinnacle'),
				'id'   => $prefix . 'contact_zoom',
				'std'  => '15',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('1 (World View)', 'pinnacle'), 'value' => '1', ),
					array( 'name' => '2', 'value' => '2', ),
					array( 'name' => '3', 'value' => '3', ),
					array( 'name' => '4', 'value' => '4', ),
					array( 'name' => '5', 'value' => '5', ),
					array( 'name' => '6', 'value' => '6', ),
					array( 'name' => '7', 'value' => '7', ),
					array( 'name' => '8', 'value' => '8', ),
					array( 'name' => '9', 'value' => '9', ),
					array( 'name' => '10', 'value' => '10', ),
					array( 'name' => '11', 'value' => '11', ),
					array( 'name' => '12', 'value' => '12', ),
					array( 'name' => '13', 'value' => '13', ),
					array( 'name' => '14', 'value' => '14', ),
					array( 'name' => '15', 'value' => '15', ),
					array( 'name' => '16', 'value' => '16', ),
					array( 'name' => '17', 'value' => '17', ),
					array( 'name' => '18', 'value' => '18', ),
					array( 'name' => '19', 'value' => '19', ),
					array( 'name' => '20', 'value' => '20', ),
					array( 'name' => __('21 (Street View)', 'pinnacle'), 'value' => '21', ),
					),
			),
			array(
				'name' => __('Map Height', 'pinnacle'),
				'desc' => __('Default is 300', 'pinnacle'),
				'id'   => $prefix . 'contact_mapheight',
				'type' => 'text_small',
			),
			array(
				'name' => __('Address Two', 'pinnacle'),
				'desc' => __('Enter your Location', 'pinnacle'),
				'id'   => $prefix . 'contact_address2',
				'type' => 'text',
			),
			array(
				'name' => __('Address Three', 'pinnacle'),
				'desc' => __('Enter a Location', 'pinnacle'),
				'id'   => $prefix . 'contact_address3',
				'type' => 'text',
			),
			array(
				'name' => __('Address Four', 'pinnacle'),
				'desc' => __('Enter a Location', 'pinnacle'),
				'id'   => $prefix . 'contact_address4',
				'type' => 'text',
			),
			array(
				'name' => __('Map Center', 'pinnacle'),
				'desc' => __('Enter a Location', 'pinnacle'),
				'id'   => $prefix . 'contact_map_center',
				'type' => 'text',
			),	
			));
			$meta_boxes[] = array(
				'id'         => 'page_sidebar',
				'title'      => __('Sidebar Options', 'pinnacle'),
				'pages'      => array( 'page' ), // Post type
				'show_on' => array( 'key' => 'kt-template', 'value' => array('template-portfolio-grid','template-contact')),
				'context'    => 'normal',
				'priority'   => 'high',
				'show_names' => true,
				'fields' => array(
			array(
				'name' => __('Display Sidebar?', 'pinnacle'),
				'desc' => __('Choose if layout is fullwidth or sidebar', 'pinnacle'),
				'id'   => $prefix . 'page_sidebar',
				'type'    => 'select',
				'options' => array(
					array( 'name' => __('No', 'pinnacle'), 'value' => 'no', ),
					array( 'name' => __('Yes', 'pinnacle'), 'value' => 'yes', ),
				),
			),
			array(
				'name'    => __('Choose Sidebar', 'pinnacle'),
				'desc'    => '',
				'id'      => $prefix . 'sidebar_choice',
				'type'    => 'imag_select_sidebars',
				),
				
			));
			global $pinnacle;
	if(isset($pinnacle['custom_tab_01']) && $pinnacle['custom_tab_01'] == '1') {
	$meta_boxes[] = array(
				'id'         => 'kad_custom_tab_01',
				'title'      => __( "Pinnacle Custom Tab 01", 'pinnacle' ),
				'pages'      => array( 'product', ), // Post type
				'context'    => 'normal',
				'priority'   => 'default',
				'show_names' => true, // Show field names on the left
				'fields' => array(
					array(
						'name' => __( "Tab Title", 'pinnacle' ),
						'desc' => __( "This will show on the tab", 'pinnacle' ),
						'id'   => $prefix . 'tab_title_01',
						'type' => 'text',
					),
					array(
						'name'    => __( 'Tab Content', 'pinnacle' ),
						'desc'    => __( 'Add Tab Content', 'pinnacle' ),
						'id'      => $prefix . 'tab_content_01',
						'type'    => 'wysiwyg',
						'options' => array( 'textarea_rows' => 5, ),
					),
					array(
						'name' => __( "Tab priority", 'pinnacle' ),
						'desc' => __( "This will determine where the tab is shown (e.g. 20)", 'pinnacle' ),
						'id'   => $prefix . 'tab_priority_01',
						'type' => 'text_small',
					),
				)

			);
	}
	if(isset($pinnacle['custom_tab_02']) && $pinnacle['custom_tab_02'] == '1') {
	$meta_boxes[] = array(
				'id'         => 'kad_custom_tab_02',
				'title'      => __( "Pinnacle Custom Tab 02", 'pinnacle' ),
				'pages'      => array( 'product', ), // Post type
				'context'    => 'normal',
				'priority'   => 'default',
				'show_names' => true, // Show field names on the left
				'fields' => array(
					array(
						'name' => __( "Tab Title", 'pinnacle' ),
						'desc' => __( "This will show on the tab", 'pinnacle' ),
						'id'   => $prefix . 'tab_title_02',
						'type' => 'text',
					),
					array(
						'name'    => __( 'Tab Content', 'pinnacle' ),
						'desc'    => __( 'Add Tab Content', 'pinnacle' ),
						'id'      => $prefix . 'tab_content_02',
						'type'    => 'wysiwyg',
						'options' => array( 'textarea_rows' => 5, ),
					),
					array(
						'name' => __( "Tab priority", 'pinnacle' ),
						'desc' => __( "This will determine where the tab is shown (e.g. 20)", 'pinnacle' ),
						'id'   => $prefix . 'tab_priority_02',
						'type' => 'text_small',
					),
				)

			);
	}
	if(isset($pinnacle['custom_tab_03']) && $pinnacle['custom_tab_03'] == '1') {
	$meta_boxes[] = array(
				'id'         => 'kad_custom_tab_03',
				'title'      => __( "Pinnacle Custom Tab 03", 'pinnacle' ),
				'pages'      => array( 'product', ), // Post type
				'context'    => 'normal',
				'priority'   => 'default',
				'show_names' => true, // Show field names on the left
				'fields' => array(
					array(
						'name' => __( "Tab Title", 'pinnacle' ),
						'desc' => __( "This will show on the tab", 'pinnacle' ),
						'id'   => $prefix . 'tab_title_03',
						'type' => 'text',
					),
					array(
						'name'    => __( 'Tab Content', 'pinnacle' ),
						'desc'    => __( 'Add Tab Content', 'pinnacle' ),
						'id'      => $prefix . 'tab_content_03',
						'type'    => 'wysiwyg',
						'options' => array( 'textarea_rows' => 5, ),
					),
					array(
						'name' => __( "Tab priority", 'pinnacle' ),
						'desc' => __( "This will determine where the tab is shown (e.g. 20)", 'pinnacle' ),
						'id'   => $prefix . 'tab_priority_03',
						'type' => 'text_small',
					),
				)

			);
	}

	return $meta_boxes;
}

add_action( 'init', 'initialize_showcase_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function initialize_showcase_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'cmb/init.php';

}