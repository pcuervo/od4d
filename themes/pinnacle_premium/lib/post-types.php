<?php
// Custom post types
if ( !is_plugin_active('virtue-toolkit/virtue_toolkit.php') ) {
function kadence_portfolio_post_init() {
  $portfoliolabels = array(
    'name' =>  __('Portfolio', 'pinncale'),
    'singular_name' => __('Portfolio Item', 'pinncale'),
    'add_new' => __('Add New', 'pinncale'),
    'add_new_item' => __('Add New Portfolio Item', 'pinncale'),
    'edit_item' => __('Edit Portfolio Item', 'pinncale'),
    'new_item' => __('New Portfolio Item', 'pinncale'),
    'all_items' => __('All Portfolio', 'pinncale'),
    'view_item' => __('View Portfolio Item', 'pinncale'),
    'search_items' => __('Search Portfolio', 'pinncale'),
    'not_found' =>  __('No Portfolio Item found', 'pinncale'),
    'not_found_in_trash' => __('No Portfolio Items found in Trash', 'pinncale'),
    'parent_item_colon' => '',
    'menu_name' => __('Portfolio', 'pinncale')
  );

  $portargs = array(
    'labels' => $portfoliolabels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite'  => false,
    //'rewrite'  => array( 'slug' => 'portfolio' ), /* you can specify its url slug */
    'has_archive' => false, 
    'capability_type' => 'post', 
    'hierarchical' => false,
    'menu_position' => 8,
    'menu_icon' => 'dashicons-format-gallery',
    'supports' => array( 'title', 'excerpt', 'editor', 'author', 'page-attributes', 'thumbnail', 'comments' )
  ); 
  // Initialize Taxonomy Labels
    $worklabels = array(
        'name' => __( 'Portfolio Type', 'pinncale' ),
        'singular_name' => __( 'Type', 'pinncale' ),
        'search_items' =>  __( 'Search Type', 'pinncale' ),
        'all_items' => __( 'All Type', 'pinncale' ),
        'parent_item' => __( 'Parent Type', 'pinncale' ),
        'parent_item_colon' => __( 'Parent Type:', 'pinncale' ),
        'edit_item' => __( 'Edit Type', 'pinncale' ),
        'update_item' => __( 'Update Type', 'pinncale' ),
        'add_new_item' => __( 'Add New Type', 'pinncale' ),
        'new_item_name' => __( 'New Type Name', 'pinncale' ),
    );
    $portfolio_type_slug = apply_filters('kadence_portfolio_type_slug', 'portfolio-type');
    // Register Custom Taxonomy
    register_taxonomy('portfolio-type',array('portfolio'), array(
        'hierarchical' => true, // define whether to use a system like tags or categories
        'labels' => $worklabels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite'  => array( 'slug' => $portfolio_type_slug )
    ));
    $taglabels = array(
        'name' => __( 'Portfolio Tags', 'pinncale' ),
        'singular_name' => __( 'Tags', 'pinncale' ),
        'search_items' =>  __( 'Search Tags', 'pinncale' ),
        'all_items' => __( 'All Tag', 'pinncale' ),
        'parent_item' => __( 'Parent Tag', 'pinncale' ),
        'parent_item_colon' => __( 'Parent Tag:', 'pinncale' ),
        'edit_item' => __( 'Edit Tag', 'pinncale' ),
        'update_item' => __( 'Update Tag', 'pinncale' ),
        'add_new_item' => __( 'Add New Tag', 'pinncale' ),
        'new_item_name' => __( 'New Tag Name', 'pinncale' ),
    );
    $portfolio_tag_slug = apply_filters('kadence_portfolio_tag_slug', 'portfolio-tag');
    // Register Custom Taxonomy
    register_taxonomy('portfolio-tag',array('portfolio'), array(
        'hierarchical' => false,
        'labels' => $taglabels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite'  => array( 'slug' => $portfolio_tag_slug )
    ));

  register_post_type( 'portfolio', $portargs );
}
add_action( 'init', 'kadence_portfolio_post_init', 1 );
}
    
function testimonial_post_init() {
  $testlabels = array(
    'name' =>  __('Testimonials', 'pinncale'),
    'singular_name' => __('Testimonial', 'pinncale'),
    'add_new' => __('Add New', 'pinncale'),
    'add_new_item' => __('Add New Testimonial', 'pinncale'),
    'edit_item' => __('Edit Testimonial', 'pinncale'),
    'new_item' => __('New Testimonial', 'pinncale'),
    'all_items' => __('All Testimonials', 'pinncale'),
    'view_item' => __('View Testimonial', 'pinncale'),
    'search_items' => __('Search Testimonials', 'pinncale'),
    'not_found' =>  __('No Testimonials found', 'pinncale'),
    'not_found_in_trash' => __('No Testimonials found in Trash', 'pinncale'),
    'parent_item_colon' => '',
    'menu_name' => __('Testimonials', 'pinncale')
  );
   $testimonial_post_slug = apply_filters('kadence_testimonial_post_slug', 'testimonial');
  $testargs = array(
    'labels' => $testlabels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => $testimonial_post_slug ),
    'capability_type' => 'post',
    'has_archive' => false,  
    'hierarchical' => false,
    'menu_position' => 22,
    'menu_icon' => 'dashicons-testimonial',
    'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail' )
  ); 

  // Initialize Taxonomy Labels
    $taxlabels = array(
        'name' => __( 'Testimonial Group', 'pinncale' ),
        'singular_name' => __( 'Testimonials', 'pinncale' ),
        'search_items' =>  __( 'Search Groups', 'pinncale' ),
        'all_items' => __( 'All Groups', 'pinncale' ),
        'parent_item' => __( 'Parent Groups', 'pinncale' ),
        'parent_item_colon' => __( 'Parent Groups:', 'pinncale' ),
        'edit_item' => __( 'Edit Group', 'pinncale' ),
        'update_item' => __( 'Update Group', 'pinncale' ),
        'add_new_item' => __( 'Add New Group', 'pinncale' ),
        'new_item_name' => __( 'New Group Name', 'pinncale' ),
    );
    $testimonial_group_slug = apply_filters('kadence_testimonial_group_slug', 'testimonial-group');
    // Register Custom Taxonomy
    register_taxonomy('testimonial-group',array('testimonial'), array(
        'hierarchical' => true, // define whether to use a system like tags or categories
        'labels' => $taxlabels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite'  => array( 'slug' => $testimonial_group_slug )
    ));

  register_post_type( 'testimonial', $testargs );
}
add_action( 'init', 'testimonial_post_init' );

function staff_post_init() {
  $stafflabels = array(
    'name' =>  __('Staff', 'pinncale'),
    'singular_name' => __('Staff', 'pinncale'),
    'add_new' => __('Add New', 'pinncale'),
    'add_new_item' => __('Add New Staff', 'pinncale'),
    'edit_item' => __('Edit Staff', 'pinncale'),
    'new_item' => __('New Staff', 'pinncale'),
    'all_items' => __('All Staff', 'pinncale'),
    'view_item' => __('View Staff', 'pinncale'),
    'search_items' => __('Search Staff', 'pinncale'),
    'not_found' =>  __('No Staff found', 'pinncale'),
    'not_found_in_trash' => __('No Staff found in Trash', 'pinncale'),
    'parent_item_colon' => '',
    'menu_name' => __('Staff', 'pinncale')
  );
  $staff_post_slug = apply_filters('kadence_staff_post_slug', 'staff');
  $staffargs = array(
    'labels' => $stafflabels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => $staff_post_slug ),
    'capability_type' => 'post',
    'has_archive' => false, 
    'hierarchical' => false,
    'menu_position' => 23,
    'menu_icon' => 'dashicons-id-alt',
    'supports' => array( 'title', 'editor', 'excerpt', 'page-attributes', 'thumbnail' )
  ); 
  // Initialize Taxonomy Labels
    $grouplabels = array(
        'name' => __( 'Staff Group', 'pinncale' ),
        'singular_name' => __( 'Staff', 'pinncale' ),
        'search_items' =>  __( 'Search Groups', 'pinncale' ),
        'all_items' => __( 'All Groups', 'pinncale' ),
        'parent_item' => __( 'Parent Groups', 'pinncale' ),
        'parent_item_colon' => __( 'Parent Groups:', 'pinncale' ),
        'edit_item' => __( 'Edit Group', 'pinncale' ),
        'update_item' => __( 'Update Group', 'pinncale' ),
        'add_new_item' => __( 'Add New Group', 'pinncale' ),
        'new_item_name' => __( 'New Group Name', 'pinncale' ),
    );
    $staff_group_slug = apply_filters('kadence_staff_group_slug', 'staff-group');
    // Register Custom Taxonomy
    register_taxonomy('staff-group',array('staff'), array(
        'hierarchical' => true, // define whether to use a system like tags or categories
        'labels' => $grouplabels,
        'show_ui' => true,
        'query_var' => true,
        'rewrite'  => array( 'slug' => $staff_group_slug )
    ));

  register_post_type( 'staff', $staffargs );
}
add_action( 'init', 'staff_post_init' );

