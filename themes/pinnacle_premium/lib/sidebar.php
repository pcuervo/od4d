<?php
/**
 * Determines whether or not to display the sidebar based on an array of conditional tags or page templates.
 *
 * If any of the is_* conditional tags or is_page_template(template_file) checks return true, the sidebar will NOT be displayed.
 *
 * @param array list of conditional tags (http://codex.wordpress.org/Conditional_Tags)
 * @param array list of page templates. These will be checked via is_page_template()
 *
 * @return boolean True will display the sidebar, False will not
 *
 */
class Kadence_Sidebar {
  private $conditionals;
  private $templates;

  public $display = true;

  function __construct($conditionals = array(), $templates = array()) {
    $this->conditionals = $conditionals;
    $this->templates    = $templates;

    $conditionals = array_map(array($this, 'check_conditional_tag'), $this->conditionals);
    $templates    = array_map(array($this, 'check_page_template'), $this->templates);

    if (in_array(true, $conditionals) || in_array(true, $templates)) {
      $this->display = false;
    }
  }

  private function check_conditional_tag($conditional_tag) {
    if (is_array($conditional_tag)) {
      return call_user_func_array($conditional_tag[0], $conditional_tag[1]);
    } else {
      return $conditional_tag();
    }
  }

  private function check_page_template($page_template) {
    return is_page_template($page_template);
  }
}

function kadence_sidebar_id() {
    if(is_front_page()) {
      global $pinnacle;
        if (!empty($pinnacle['home_sidebar'])) {
          $sidebar = $pinnacle['home_sidebar'];
        } else  {
          $sidebar = 'sidebar-primary';
        } 
    } elseif( class_exists('woocommerce') and (is_shop())) {
        global $pinnacle;
        if (!empty($pinnacle['shop_sidebar'])) {
          $sidebar = $pinnacle['shop_sidebar'];
          }
        else  {
          $sidebar = 'sidebar-primary';
        } 
    } elseif( class_exists('woocommerce') and (is_product_category() || is_product_tag())) {
        global $pinnacle;
        if (!empty($pinnacle['shop_cat_sidebar'])) {
          $sidebar = $pinnacle['shop_cat_sidebar'];
          }
        else  {
          $sidebar = 'sidebar-primary';
        } 
    } elseif (class_exists('woocommerce') and is_product()) {
      global $post; 
      $sidebar_name = get_post_meta( $post->ID, '_kad_sidebar_choice', true ); 
      if (empty($sidebar_name) || $sidebar_name == 'default') {
          global $pinnacle;
          if(!empty($pinnacle['product_sidebar_default_sidebar'])) {
            $sidebar = $pinnacle['product_sidebar_default_sidebar'];
          } else {
            $sidebar = 'sidebar-primary';
          }
      } else if(!empty($sidebar_name)) {
        $sidebar = $sidebar_name;
      } else {
        $sidebar = 'sidebar-primary';
      } 
    } elseif( class_exists('woocommerce') and (is_account_page())) {
          $sidebar = 'ktwooaccount';
    } elseif( is_page() || is_single() ) {
      global $post; $sidebar_name = get_post_meta( $post->ID, '_kad_sidebar_choice', true ); 
      if (!empty($sidebar_name)) {
          $sidebar = $sidebar_name;
      } else {
          $sidebar = 'sidebar-primary';
      } 
    } elseif (is_archive()) {
      global $pinnacle; 
      if(isset($pinnacle['blog_cat_sidebar'])) {
          $sidebar = $pinnacle['blog_cat_sidebar'];
      } else  {
          $sidebar = 'sidebar-primary';
        } 
    }
    elseif(is_category()) {
      global $pinnacle; 
      if(isset($pinnacle['blog_cat_sidebar'])) {
          $sidebar = $pinnacle['blog_cat_sidebar'];
      } else {
          $sidebar = 'sidebar-primary';
      } 
    }
    elseif (is_tag()) {
      $sidebar = 'sidebar-primary';
    }
    elseif (is_post_type_archive()) {
      $sidebar = 'sidebar-primary';
    }
     elseif (is_day()) {
       $sidebar = 'sidebar-primary';
     }
     elseif (is_month()) {
       $sidebar = 'sidebar-primary';
     }
     elseif (is_year()) {
       $sidebar = 'sidebar-primary';
     }
     elseif (is_author()) {
       $sidebar = 'sidebar-primary';
    }
    elseif (is_search()) {
      global $pinnacle; 
      if(isset($pinnacle['search_sidebar'])) {
        $sidebar = $pinnacle['search_sidebar'];
      } else {
        $sidebar = 'sidebar-primary';
      } 
    } else {
      $sidebar = 'sidebar-primary';
    }
    return apply_filters('kadence_sidebar_id', $sidebar);
}