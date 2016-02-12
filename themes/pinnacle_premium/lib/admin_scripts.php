<?php

/**
 * Enqueue CSS & JS
 */
function kadence_admin_scripts() {
  wp_register_style('kad_admincssstyles', get_template_directory_uri() . '/assets/css/kad_adminstyles.css', false, 128);
  wp_enqueue_style('kad_admincssstyles');

  wp_register_script('kad_admin_js', get_template_directory_uri() . '/assets/js/kad_adminscripts.js', false, 128, false);
  wp_enqueue_script('kad_admin_js');

}

add_action('admin_enqueue_scripts', 'kadence_admin_scripts');
