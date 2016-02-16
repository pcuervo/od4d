<?php
/**
 * virtue initial setup and constants
 */
function kadence_setup() {
 global $pinnacle; 
 if(isset($pinnacle['header_style']) && $pinnacle['header_style'] == "center") {
      register_nav_menus(array(
        'left_navigation' => __('Left Navigation', 'pinnacle'),
        'right_navigation' => __('Right Navigation', 'pinnacle'),
        'primary_navigation' => __('Mobile Navigation', 'pinnacle'),
        'topbar_navigation' => __('Topbar Navigation', 'pinnacle'),
        'footer_navigation' => __('Footer Navigation', 'pinnacle'),
      ));
  } else {
  register_nav_menus(array(
        'primary_navigation' => __('Primary Navigation', 'pinnacle'),
        'topbar_navigation' => __('Topbar Navigation', 'pinnacle'),
        'footer_navigation' => __('Footer Navigation', 'pinnacle'),
      ));
  }
  add_theme_support( 'title-tag' );
  add_theme_support('post-thumbnails');
  add_image_size( 'widget-thumb', 60, 60, true );
  add_post_type_support( 'attachment', 'page-attributes' );
  add_theme_support('post-formats', array('gallery', 'image', 'video'));
  add_theme_support( 'automatic-feed-links' );
  add_editor_style('/assets/css/editor-style.css');

}
add_action('after_setup_theme', 'kadence_setup');

function kt_fav_output(){
// Keep for fallback
    global $pinnacle; 
    if(!empty($pinnacle['pinnacle_custom_favicon']['url'])) { 
      echo '<link rel="shortcut icon" type="image/x-icon" href="'. esc_url($pinnacle['pinnacle_custom_favicon']['url']).'" />';
    }
} 
add_action('wp_head', 'kt_fav_output', 1);

// Backwards compatibility for older than PHP 5.3.0
if (!defined('__DIR__')) { define('__DIR__', dirname(__FILE__)); }

/**
 * Define helper constants
 */
$get_theme_name = explode('/themes/', get_template_directory());

define('RELATIVE_PLUGIN_PATH',  str_replace(home_url() . '/', '', plugins_url()));
define('RELATIVE_CONTENT_PATH', str_replace(home_url() . '/', '', content_url()));
define('THEME_NAME',            next($get_theme_name));
define('THEME_PATH',            RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);


