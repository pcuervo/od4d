<?php

/**
 * Registering meta sections for taxonomies
 *
 * All the definitions of meta sections are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value.
 *
 * You also should read the changelog to know what has been changed
 *
 */

// Hook to 'admin_init' to make sure the class is loaded before
// (in case using the class in another plugin)
add_action( 'admin_init', 'kad_register_taxonomy_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function kad_register_taxonomy_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Taxonomy_Meta_Kad' ) )
		return;

	$meta_sections = array();
	$prefix = 'kad_';
	// First meta section
	$meta_sections[] = array(
		'title'      => __('Slider Options', 'pinnacle'),             // section title
		'taxonomies' => array('product_cat'), 							// list of taxonomies. Default is array('category', 'post_tag'). Optional
		'id'         => 'product_cat_slider', 						// ID of each section, will be the option name

		'fields' => array(                             // List of meta fields
			// TEXT
			array(
				'name' => __('Category Slider', 'pinnacle'),                      // field name
				'desc' => __('Add a slider shortcode here from the Revolution, Kadence or Cyclone Slider', 'pinnacle'),         // field description, optional
				'id'   => 'cat_short_slider',                      // field id, i.e. the meta key
				'type' => 'text',                      // field type
				'std'  => '',                      // default value, optional
			),

		),
	);
	$meta_sections[] = array(
		'title'      => 'Extra Product Category Options',             // section title
		'taxonomies' => array('portfolio-type'), 							// list of taxonomies. Default is array('category', 'post_tag'). Optional
		'id'         => 'portfolio_cat_image', 						// ID of each section, will be the option name

		'fields' => array(                             // List of meta fields
			// TEXT
			array(
					    'name' => __('Category Image', 'pinnacle' ),
					    'id' => 'category_image',
					    'type' => 'image',
					),
		),
	);
	$meta_sections[] = array(
		'title'      => 'Header Options',             // section title
		'taxonomies' => array('product_cat', 'product_tag','category', 'post_tag', 'portfolio-type', 'portfolio-tag'), 							// list of taxonomies. Default is array('category', 'post_tag'). Optional
		'id'         => 'product_cat_pageheader', 						// ID of each section, will be the option name

		'fields' => array(                             // List of meta fields
			array(
				'name'    => __("Align Text", 'pinnacle' ),
						'id'      => $prefix . 'pagetitle_align',
						'type'    => 'select',
						'options' => array(
							'default' => __("Default", 'pinnacle' ),
							'left' => __("Align Left", 'pinnacle' ),
							'center' => __("Align Center", 'pinnacle' ),
							'right' => __("Align Right", 'pinnacle' ),
						),
					),
					array(
					    'name' => __('Title Color', 'pinnacle'),
					    'id'   => $prefix . 'pagetitle_title_color',
					    'type' => 'color',
					),
					array(
					    'name' => __('Sub Title Color', 'pinnacle'),
					    'id'   => $prefix . 'pagetitle_sub_color',
					    'type' => 'color',
					),
					array(
					    'name' => __('Background Color', 'pinnacle'),
					    'id'   => $prefix . 'pagetitle_bg_color',
					    'type' => 'color',
					),
					array(
					    'name' => __('Background Image', 'pinnacle' ),
					    'id' => $prefix . 'pagetitle_bg_image',
					    'type' => 'image',
					),
					array(
						'name'    => __("Background Image Position", 'pinnacle' ),
						'id'      => $prefix . 'pagetitle_bg_position',
						'type'    => 'select',
						'options' => array(
							'left top' => __("Left Top", 'pinnacle' ),
							'left center' => __("Left Center", 'pinnacle' ),
							'left bottom' => __("Left Bottom", 'pinnacle' ),
							'center top' => __("Center Top", 'pinnacle' ),
							'center center' => __("Center Center", 'pinnacle' ),
							'center bottom' => __("Center Bottom", 'pinnacle' ),
							'right top' => __("Right Top", 'pinnacle' ),
							'right center' => __("Right Center", 'pinnacle' ),
							'right bottom' => __("Right Bottom", 'pinnacle' ),
						),
					),
					array(
					    'name' => __('Repeat Background Image', 'pinnacle' ),
					    'id' => $prefix . 'pagetitle_bg_repeat',
					    'type' => 'checkbox'
					),
					array(
					    'name' => __('Background Cover', 'pinnacle' ),
					    'id' => $prefix . 'pagetitle_bg_cover',
					    'type' => 'checkbox'
					),
					array(
					    'name' => __('Background Parallax', 'pinnacle' ),
					    'id' => $prefix . 'pagetitle_bg_parallax',
					    'type' => 'checkbox'
					),
					array(
						'name' => __( "Padding Top", 'pinnacle' ),
						'id'   => $prefix . 'pagetitle_ptop',
						'desc' => __( "Just enter number e.g. 25", 'virtue' ),
						'type' => 'text',
					),
					array(
						'name' => __( "Padding Bottom", 'pinnacle' ),
						'id'   => $prefix . 'pagetitle_pbottom',
						'desc' => __( "Just enter number e.g. 25", 'virtue' ),
						'type' => 'text',
					),
					array(
						'name'    => __("Display Page Title", 'pinnacle' ),
						'id'      => $prefix . 'pagetitle_hide',
						'type'    => 'select',
						'options' => array(
							'defualt' => __("Default", 'pinnacle' ),
							'show' => __("Show", 'pinnacle' ),
							'hide' => __("Hide", 'pinnacle' ),
						),
					),
		),
	);

	foreach ( $meta_sections as $meta_section )
	{
		new RW_Taxonomy_Meta_Kad( $meta_section );
	}
}