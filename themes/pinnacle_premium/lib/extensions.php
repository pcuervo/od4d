<?php 
add_action( "after_setup_theme", 'kadence_remove_sections', 1);
function kadence_remove_sections() {
  if ( ! class_exists( 'Redux' ) ) {
                return;
            }
    if(ReduxFramework::$_version <= '3.5.6') {
        return;
        }
    $pinnacle = get_option('pinnacle');
    if(isset($pinnacle['kadence_woo_extension']) && $pinnacle['kadence_woo_extension'] == '0') {
      //sections
      Redux::removeSection('pinnacle', 'shop_settings');
        Redux::removeSection('pinnacle', 'product_settings');
      //topbar
      Redux::removefield('pinnacle', 'show_cartcount');
      //home layout
        Redux::removefield('pinnacle', 'info_product_feat_settings');
        Redux::removefield('pinnacle', 'product_title');
        Redux::removefield('pinnacle', 'home_product_feat_column');
        Redux::removefield('pinnacle', 'home_product_count');
        Redux::removefield('pinnacle', 'home_product_feat_scroll');
        Redux::removefield('pinnacle', 'home_product_feat_speed');
        Redux::removefield('pinnacle', 'info_product_sale_settings');
        Redux::removefield('pinnacle', 'product_sale_title');
        Redux::removefield('pinnacle', 'home_product_sale_count');
        Redux::removefield('pinnacle', 'home_product_sale_scroll');
        Redux::removefield('pinnacle', 'home_product_sale_speed');
        Redux::removefield('pinnacle', 'info_product_best_settings');
        Redux::removefield('pinnacle', 'product_best_title');
        Redux::removefield('pinnacle', 'home_product_best_column');
        Redux::removefield('pinnacle', 'home_product_best_count');
        Redux::removefield('pinnacle', 'home_product_best_scroll');
        Redux::removefield('pinnacle', 'home_product_best_speed');

        // Breadcrumbs
        Redux::removefield('pinnacle', 'show_breadcrumbs_shop');
        Redux::removefield('pinnacle', 'show_breadcrumbs_product');
        Redux::removefield('pinnacle', 'shop_breadcrumbs');

        // Menu
        Redux::removefield('pinnacle', 'menu_cart');
        // language
        Redux::removefield('pinnacle', 'cart_placeholder_text');
        Redux::removefield('pinnacle', 'sold_placeholder_text');
        Redux::removefield('pinnacle', 'sale_placeholder_text');
        Redux::removefield('pinnacle', 'shop_filter_text');
        Redux::removefield('pinnacle', 'description_tab_text');
        Redux::removefield('pinnacle', 'description_header_text');
        Redux::removefield('pinnacle', 'additional_information_tab_text');
        Redux::removefield('pinnacle', 'additional_information_header_text');
        Redux::removefield('pinnacle', 'video_tab_text');
        Redux::removefield('pinnacle', 'video_title_text');
        Redux::removefield('pinnacle', 'reviews_tab_text');
        Redux::removefield('pinnacle', 'related_products_text');
        

        //update feild
    $field = Redux::getField('pinnacle', 'homepage_layout');
    unset($field['options']['disabled']['block_three']);
    unset($field['options']['disabled']['block_nine']);
    unset($field['options']['disabled']['block_ten']);
    Redux::setField('pinnacle',$field);

        add_filter('kadence_widget_carousel_types', 'kadence_unset_product_from_carousel');
        function kadence_unset_product_from_carousel($types) {
            unset($types['featured-products']);
            unset($types['sale-products']);
            unset($types['best-products']);
            unset($types['cat-products']);
            return $types;
        }
    }
    if(isset($pinnacle['kadence_portfolio_extension']) && $pinnacle['kadence_portfolio_extension'] == '0') {
      Redux::removeSection('pinnacle', 'portfolio_options');

      Redux::removefield('pinnacle', 'info_portfolio_settings');
        Redux::removefield('pinnacle', 'portfolio_title');
        Redux::removefield('pinnacle', 'portfolio_type');
        Redux::removefield('pinnacle', 'home_portfolio_carousel_column');
        Redux::removefield('pinnacle', 'home_port_car_layoutstyle');
        Redux::removefield('pinnacle', 'home_port_car_hoverstyle');
        Redux::removefield('pinnacle', 'home_port_car_imageratio');
        Redux::removefield('pinnacle', 'home_portfolio_carousel_count');
        Redux::removefield('pinnacle', 'home_portfolio_carousel_speed');
        Redux::removefield('pinnacle', 'home_portfolio_carousel_scroll');
        Redux::removefield('pinnacle', 'home_portfolio_order');
        Redux::removefield('pinnacle', 'portfolio_car_fullwidth');
        Redux::removefield('pinnacle', 'portfolio_car_lightbox');
        Redux::removefield('pinnacle', 'portfolio_show_type');
        Redux::removefield('pinnacle', 'portfolio_show_excerpt');
        Redux::removefield('pinnacle', 'info_portfolio_full_settings');
        Redux::removefield('pinnacle', 'portfolio_full_title');
        Redux::removefield('pinnacle', 'portfolio_full_type');
        Redux::removefield('pinnacle', 'home_port_count');
        Redux::removefield('pinnacle', 'home_portfolio_full_order');
        Redux::removefield('pinnacle', 'home_port_columns');
        Redux::removefield('pinnacle', 'home_port_layoutstyle');
        Redux::removefield('pinnacle', 'home_port_hoverstyle');
        Redux::removefield('pinnacle', 'home_port_imageratio');
        Redux::removefield('pinnacle', 'portfolio_full_masonry');
        Redux::removefield('pinnacle', 'portfolio_full_filter');
        Redux::removefield('pinnacle', 'portfolio_full_fullwidth');
        Redux::removefield('pinnacle', 'home_portfolio_lightbox');
        Redux::removefield('pinnacle', 'portfolio_full_show_type');
        Redux::removefield('pinnacle', 'portfolio_full_show_excerpt');
        Redux::removefield('pinnacle', 'portfolio_full_fullwidth');
        


      remove_action( 'init', 'kadence_portfolio_post_init', 1 );
      $field = Redux::getField('pinnacle', 'homepage_layout');
    unset($field['options']['disabled']['block_eight']);
    unset($field['options']['disabled']['block_six']);
    Redux::setField('pinnacle',$field);
        add_filter('kadence_widget_carousel_types', 'kadence_unset_portfolio_from_carousel');
        function kadence_unset_portfolio_from_carousel($types) {
            unset($types['portfolio']);
            return $types;
        }
        add_filter( 'kadence_portfolio_post_removal', 'kadence_portfolio_post_removal_function');
        function kadence_portfolio_post_removal_function() { 
            return false;
        }
    }
    if(isset($pinnacle['kadence_staff_extension']) && $pinnacle['kadence_staff_extension'] == '0') {
      remove_action( 'init', 'staff_post_init');
    }
    if(isset($pinnacle['kadence_testimonial_extension']) && $pinnacle['kadence_testimonial_extension'] == '0') {
      remove_action( 'init', 'testimonial_post_init');
        add_filter( 'kadence_testimonial_post_removal', 'kadence_testimonial_post_removal_function');
        function kadence_testimonial_post_removal_function() { 
            return false;
        }
    }
}


function kadence_portfolio_post_on() {
    return apply_filters( 'kadence_portfolio_post_removal', true );
}
function kadence_testimonial_post_on() {
    return apply_filters( 'kadence_testimonial_post_removal', true );
}
add_action( "after_setup_theme", 'kadence_permalinks');
function kadence_permalinks() {
  global $wp_rewrite;
  $pinnacle = get_option('pinnacle');
  if(!empty($pinnacle['portfolio_permalink'])) {$port_rewrite = $pinnacle['portfolio_permalink'];} else {$port_rewrite = __('portfolio');}
  $portfolio_structure = '/'.$port_rewrite.'/%portfolio%';
  $wp_rewrite->add_rewrite_tag("%portfolio%", '([^/]+)', "portfolio=");
  $wp_rewrite->add_permastruct('portfolio', $portfolio_structure, false);

  // Add filter to plugin init function
  add_filter('post_type_link', 'portfolio_permalink', 10, 3);   
  // Adapted from get_permalink function in wp-includes/link-template.php

  function portfolio_permalink($permalink, $post_id, $leavename) {
      $post = get_post($post_id);
      $rewritecode = array(
          '%year%',
          '%monthnum%',
          '%day%',
          '%hour%',
          '%minute%',
          '%second%',
          $leavename? '' : '%postname%',
          '%post_id%',
          '%category%',
          '%author%',
          $leavename? '' : '%pagename%',
      );
   
      if ( '' != $permalink && !in_array($post->post_status, array('draft', 'pending', 'auto-draft')) ) {
          $unixtime = strtotime($post->post_date);
       
          $category = '';
          if ( strpos($permalink, '%category%') !== false ) {
              $cats = wp_get_post_terms($post->ID, 'portfolio-type', array( 'orderby' => 'parent', 'order' => 'DESC' ));
              if ( $cats ) {
                  //usort($cats, '_usort_terms_by_ID'); // order by ID
                  $category = $cats[0]->slug;
              }
              // show default category in permalinks, without
              // having to assign it explicitly
              if ( empty($category) ) {
                  $category = 'portfolio-category';
              }
          }
       
          $author = '';
          if ( strpos($permalink, '%author%') !== false ) {
              $authordata = get_userdata($post->post_author);
              $author = $authordata->user_nicename;
          }
       
          $date = explode(" ",date('Y m d H i s', $unixtime));
          $rewritereplace =
          array(
              $date[0],
              $date[1],
              $date[2],
              $date[3],
              $date[4],
              $date[5],
              $post->post_name,
              $post->ID,
              $category,
              $author,
              $post->post_name,
          );
          $permalink = str_replace($rewritecode, $rewritereplace, $permalink);
      } else { // if they're not using the fancy permalink option
      }
      return $permalink;
  }
}