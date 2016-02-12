<?php
/**
 * Configuration values
 */
function kadence_init_define_values(){
  global $pinnacle; 
  if(isset($pinnacle['post_word_count'])) { $excerptlength = $pinnacle['post_word_count'];} else { $excerptlength = '40'; } 
  define('POST_EXCERPT_LENGTH', $excerptlength);
}

add_action('init', 'kadence_init_define_values');
/**
 * .main classes
 */
function kadence_main_class() {
  if (kadence_display_sidebar()) {
    // Classes on pages with the sidebar
    $class = 'col-lg-9 col-md-8 kt-sidebar';
  } else {
    // Classes on full width pages
    $class = 'col-md-12 kt-nosidebar';
  }

  return $class;
}

/**
 * .sidebar classes
 */
function kadence_sidebar_class() {
  return 'col-lg-3 col-md-4';
}

/**
 * Define which pages shouldn't have the sidebar
 *
 * See lib/sidebar.php for more details
 */
function kadence_display_sidebar() {
   if (class_exists('woocommerce'))  {
        $sidebar_config = new Kadence_Sidebar(
        array('kadence_sidebar_on_shop_page','kadence_sidebar_page_woo', 'kadence_sidebar_on_product_post','kadence_sidebar_on_archive_page','kadence_sidebar_on_shop_cat_page','kadence_sidebar_on_post','is_404','kadence_sidebar_on_home_page','kadence_sidebar_on_myaccount_page','is_cart','is_checkout',array('is_singular', array('portfolio')),array('is_singular', array('kadslider')), array('is_tax', array('portfolio-type'))
        ),
        array('template-portfolio-grid.php','template-contact.php')
      );
  } else {
  $sidebar_config = new Kadence_Sidebar(
    array('kadence_sidebar_page', 'kadence_sidebar_on_post','is_404','kadence_sidebar_on_archive_page_noshop','kadence_sidebar_on_home_page', array('is_singular', array('portfolio')), array('is_singular', array('kadslider')), array('is_tax', array('portfolio-type'))
      ),
    array('template-portfolio-grid.php','template-contact.php' )
  );
}

  return apply_filters('kadence_display_sidebar', $sidebar_config->display);
}

function kadence_sidebar_on_shop_page() {
  if( is_shop() ) {
  global $pinnacle; 
    if(isset($pinnacle['shop_layout']) && $pinnacle['shop_layout'] == 'sidebar') {
        return false;
      } else {
        return true;
    }
  }
}
function kadence_sidebar_page_woo() {
  if( is_page() && !is_page_template('template-portfolio-grid.php') && !is_page_template('template-contact.php') && !is_account_page() && !is_shop() && !is_front_page() ) {
  global $post; 
  $postsidebar = get_post_meta( $post->ID, '_kad_page_sidebar', true );
      if(isset($postsidebar) && $postsidebar == 'yes') {
        return false;
        } else {
        return true;
        }
  }
}
function kadence_sidebar_page() {
  if( is_page() && !is_page_template('template-portfolio-grid.php') && !is_page_template('template-contact.php') && !is_front_page() ) {
  global $post; 
  $postsidebar = get_post_meta( $post->ID, '_kad_page_sidebar', true );
      if(isset($postsidebar) && $postsidebar == 'yes') {
        return false;
        } else {
        return true;
        }
  }
}
function kadence_sidebar_on_shop_cat_page() {
  if(is_product_category() || is_product_tag()) {
  global $pinnacle; 
    if(isset($pinnacle['shop_cat_layout']) && $pinnacle['shop_cat_layout'] == 'sidebar') {
        return false;
      } else {
        return true;
    }
  }
}
function kadence_sidebar_on_product_post() {
  if( is_product()) {
     global $post;
    $postsidebar = get_post_meta( $post->ID, '_kad_post_sidebar', true );
      if(isset($postsidebar) && $postsidebar == 'yes') {
        return false;
      } else if (empty($postsidebar) || !isset($postsidebar) || $postsidebar == 'default'){
        global $pinnacle; if(isset($pinnacle['product_sidebar_default']) && $pinnacle['product_sidebar_default'] == 'yes') {
            return false;
          } else  {
            return true;
          }
        } else {
          return true;
        }  
    }
}
function kadence_sidebar_on_myaccount_page() {
  if(is_account_page()) {
    $current_user = wp_get_current_user();
        if ( 0 == $current_user->ID ) {
            return true;
        } else { 
            return false;
        }
   }
}
function kadence_sidebar_on_post() {
  if(is_single() ) {
    global $post;
    $postsidebar = get_post_meta( $post->ID, '_kad_post_sidebar', true );
      if(isset($postsidebar) && $postsidebar == 'no') {
        return true;
        } else if(isset($postsidebar) && $postsidebar == 'default') {
          global $pinnacle;
          if(isset($pinnacle['blogpost_sidebar_default']) && $pinnacle['blogpost_sidebar_default'] == 'no') {
            return true;
          } else {
            return false;
          }
        } else {
          return false;
        }
      }
}

function kadence_sidebar_on_home_page() {
  if(is_front_page()) {
      global $pinnacle; 
      if(isset($pinnacle['home_sidebar_layout']) && $pinnacle['home_sidebar_layout'] == 'sidebar') {
        return false;
        } else {
          return true;
        }
   }
}
function kadence_sidebar_on_archive_page() {
  if(is_archive() && !is_shop() && !is_product_category() && !is_product_tag()) {
      global $pinnacle; 
      if(isset($pinnacle['blog_cat_layout']) && $pinnacle['blog_cat_layout'] == 'sidebar') {
        return false;
        } else {
          return true;
        }
   }
}
function kadence_sidebar_on_archive_page_noshop() {
  if(is_archive()) {
      global $pinnacle; 
      if(isset($pinnacle['blog_cat_layout']) && $pinnacle['blog_cat_layout'] == 'sidebar') {
        return false;
        } else {
          return true;
        }
   }
}
function kadence_shop_layout_css() {
  global $pinnacle;
  if(kadence_display_sidebar()) {
          if(isset($pinnacle['product_shop_layout'])) {
            $columns = "shopcolumn".$pinnacle['product_shop_layout']." shopsidebarwidth"; 
          } else {$columns = "shopcolumn4 shopsidebarwidth"; }
      } else {
         if(isset($pinnacle['product_shop_layout'])) { $columns = "shopcolumn".$pinnacle['product_shop_layout']." shopfullwidth"; 
          } else { $columns = "shopcolumn4 shopfullwidth";  }
      }

  return $columns;
}
function kadence_category_layout_css() {
  global $pinnacle;
  if(kadence_display_sidebar()) {
          if(isset($pinnacle['product_shop_layout']) && $pinnacle['product_shop_layout'] == "single") {
            $columns = "s-threecolumn"; 
          } else {
            $columns = "s-threecolumn"; 
          }
    } else {
        if(isset($pinnacle['product_shop_layout']) && $pinnacle['product_shop_layout'] == "single") {
            $columns = "fourcolumn"; 
          } else {
            $columns = "fourcolumn";
          }
        }

  return $columns;
}

function kadence_display_topbar() {
  global $pinnacle;
   if(isset($pinnacle['topbar'])) {
  if($pinnacle['topbar'] == 1 ) {$topbar = true;} else { $topbar = false;}
} else {$topbar = true;}
  return $topbar;
  }
function kadence_display_topbar_icons() {
  global $pinnacle;
 if(isset($pinnacle['topbar_icons'])) {
  if($pinnacle['topbar_icons'] == 1 ) {$topbaricons = true;} else { $topbaricons = false;}
} else {$topbaricons = false;}
  return $topbaricons;
  }
  function kadence_display_top_search() {
  global $pinnacle;
 if(isset($pinnacle['topbar_search'])) {
  if($pinnacle['topbar_search'] == 1 ) {$topsearch = true;} else { $topsearch = false;}
} else {$topsearch = true;}
  return $topsearch;
  }
function kadence_display_topbar_widget() {
  global $pinnacle;
 if(isset($pinnacle['topbar_widget'])) {
  if($pinnacle['topbar_widget'] == 1 ) {$topbarwidget = true;} else { $topbarwidget = false;}
} else {$topbarwidget = false;}
  return $topbarwidget;
  }
function kadence_hide_pagetitle() {
  if( is_front_page() ) {
    global $pinnacle;
    if(isset($pinnacle['choose_home_header']) && $pinnacle['choose_home_header'] == 'none') {
        $pagetitledisplay = false;
    } else {
        $pagetitledisplay = true;
    }
  } else if(is_page() && !is_front_page() ) {
    global $post, $pinnacle;
    $hidepagetitle = get_post_meta( $post->ID, '_kad_pagetitle_hide', true );
      if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
        $pagetitledisplay = false;
      } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
        $pagetitledisplay = true;
      } else {
           if(isset($pinnacle['default_showpagetitle']) && $pinnacle['default_showpagetitle'] == '0') {
            $pagetitledisplay = false;
            } else {
            $pagetitledisplay = true;
            }
      }
    }else if (is_singular('product') ) {
     global $post, $pinnacle;
      $hidepagetitle = get_post_meta( $post->ID, '_kad_pagetitle_hide', true );
      if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
        $pagetitledisplay = false;
      } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
        $pagetitledisplay = true;
      } else {
           if(isset($pinnacle['default_showproducttitle']) && $pinnacle['default_showproducttitle'] == '0') {
            $pagetitledisplay = false;
            } else {
            $pagetitledisplay = true;
            }
      }
  } else if(is_tax('product_cat') || is_tax('product_tag') || is_category() ||  is_tag() ) {
    global $post, $pinnacle;
      $cat_term_id = get_queried_object()->term_id;
      $meta = get_option('product_cat_pageheader');
      if (empty($meta)) {$meta = array();}
      if (!is_array($meta)) {$meta = (array) $meta;}
        $meta = isset($meta[$cat_term_id]) ? $meta[$cat_term_id] : array();
        if(isset($meta['kad_pagetitle_hide'])) {$hidepagetitle = $meta['kad_pagetitle_hide']; }
        if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
          $pagetitledisplay = false;
        } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
          $pagetitledisplay = true;
        } else {
         if(isset($pinnacle['default_showpagetitle']) && $pinnacle['default_showpagetitle'] == '0') {
              $pagetitledisplay = false;
              } else {
              $pagetitledisplay = true;
              }
    }
  }else if (is_singular('portfolio') ) {
     global $post, $pinnacle;
      $hidepagetitle = get_post_meta( $post->ID, '_kad_pagetitle_hide', true );
      if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
        $pagetitledisplay = false;
      } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
        $pagetitledisplay = true;
      } else {
           if(isset($pinnacle['default_showportfoliotitle']) && $pinnacle['default_showportfoliotitle'] == '0') {
            $pagetitledisplay = false;
            } else {
            $pagetitledisplay = true;
            }
      }
  }
  else if (is_single() ) {
     global $post, $pinnacle;
    $hidepagetitle = get_post_meta( $post->ID, '_kad_pagetitle_hide', true );
      if(isset($hidepagetitle) && $hidepagetitle == 'hide') {
        $pagetitledisplay = false;
      } else if(isset($hidepagetitle) && $hidepagetitle == 'show') {
        $pagetitledisplay = true;
      } else {
           if(isset($pinnacle['default_showposttitle']) && $pinnacle['default_showposttitle'] == '0') {
            $pagetitledisplay = false;
            } else {
            $pagetitledisplay = true;
            }
      }
  } else {
    global $pinnacle;
     if(isset($pinnacle['default_showpagetitle']) && $pinnacle['default_showpagetitle'] == '0') {
            $pagetitledisplay = false;
      } else {
            $pagetitledisplay = true;
      }
  }

  return apply_filters('kadence_pagetitle_display', $pagetitledisplay);
}
function kadence_pagetitle_behind_header() {
  if(!kadence_hide_pagetitle()) {
    $pageheaderbg = false;
  } else {
    if(is_front_page()) {
      global $pinnacle;
                if(isset($pinnacle['hs_behindheader']) && $pinnacle['hs_behindheader'] == '0') {
                  $pageheaderbg = false;
                } else {
                  $pageheaderbg = true;
                }
      } elseif(is_page() || is_single() || is_singular() ) {
        global $post, $pinnacle;
              $hs_behind = get_post_meta( $post->ID, '_kad_pagetitle_behind_head', true );
              if(isset($hs_behind) && $hs_behind == 'true') {
                $pageheaderbg = true;
              } else if(isset($hs_behind) && $hs_behind == 'false') {
                $pageheaderbg = false;
              } else {
                if(isset($pinnacle['pagetitle_intoheader']) && $pinnacle['pagetitle_intoheader'] == '0') {
                  $pageheaderbg = false;
                } else {
                  $pageheaderbg = true;
                }
              }
      } else {
        global $pinnacle;
        if(isset($pinnacle['pagetitle_intoheader']) && $pinnacle['pagetitle_intoheader'] == '0') {
                  $pageheaderbg = false;
                } else {
                  $pageheaderbg = true;
                }
      }
  }
      return apply_filters('kadence_pagetitle_behindheader', $pageheaderbg);
}
function kadence_shop_behindheader($pageheaderbg) {
   if (class_exists('woocommerce'))  {
      if(is_shop()) {
                global $pinnacle;
                if(isset($pinnacle['ss_behindheader']) && $pinnacle['ss_behindheader'] == '0') {
                  $pageheaderbg = false;
                } else {
                  $pageheaderbg = true;
                }

      }
    }
    return $pageheaderbg;
}
add_filter('kadence_pagetitle_behindheader','kadence_shop_behindheader');

function kadence_header_height() {
  global $pinnacle;
    if(kadence_display_topbar()) {
        if(isset($pinnacle['topbar_height']) && isset($pinnacle['header_height'])) {
        $output = $pinnacle['topbar_height'] + $pinnacle['header_height'];
        } else {
          $output = '120';
        }
    } else {
         if(isset($pinnacle['header_height'])) {
          $output = $pinnacle['header_height'];
          } else {
           $output = '120';
          }
    }
    return $output;
  }
add_filter('body_class','layout_body_class');
function layout_body_class($classes) {
 global $pinnacle;
  if(isset($pinnacle['sticky_header']) && $pinnacle['sticky_header'] == '1') {
    $stickyheader = 'stickyheader';
  } else {
    $stickyheader = 'notsticky';
  }
  if(kadence_pagetitle_behind_header()) {
    $pagetitlebg = 'trans-header';
  } else {
    $pagetitlebg = 'none-trans-header';
  }

  $classes[] = 'wide';
  $classes[] = $pagetitlebg;
  $classes[] = $stickyheader;

  return $classes;
}

/*  Browser detection body_class() output
/* ------------------------------------ */ 
function kad_browser_body_class( $classes ) {
    global $is_IE;
    if($is_IE) {
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $browser = substr( "$browser", 25, 8);
        if ($browser == "MSIE 7.0"  ) {
            $classes[] = 'ie7';
            $classes[] = 'ie';
        } elseif ($browser == "MSIE 6.0" ) {
            $classes[] = 'ie6';
            $classes[] = 'ie';
        } elseif ($browser == "MSIE 8.0" ) {
            $classes[] = 'ie8';
            $classes[] = 'ie';
        } elseif ($browser == "MSIE 9.0" ) {
            $classes[] = 'ie9';
            $classes[] = 'ie';
        } else {
            $classes[] = 'ie';
        }
    }
    else $classes[] = 'not_ie';

    return $classes;
}
add_filter( 'body_class', 'kad_browser_body_class' );

function kad_icon_list() {
$icons = array("kt-icon-heart" => "kt-icon-heart","kt-icon-cloud" => "kt-icon-cloud","kt-icon-star" => "kt-icon-star","kt-icon-tv" => "kt-icon-tv","kt-icon-sound" => "kt-icon-sound","kt-icon-video" => "kt-icon-video","kt-icon-trash" => "kt-icon-trash","kt-icon-user" => "kt-icon-user","kt-icon-key" => "kt-icon-key","kt-icon-search" => "kt-icon-search","kt-icon-settings" => "kt-icon-settings","kt-icon-camera" => "kt-icon-camera","kt-icon-location" => "kt-icon-location","kt-icon-eye" => "kt-icon-eye","kt-icon-bubble" => "kt-icon-bubble","kt-icon-stack" => "kt-icon-stack","kt-icon-cup" => "kt-icon-cup","kt-icon-phone" => "kt-icon-phone","kt-icon-news" => "kt-icon-news","kt-icon-mail" => "kt-icon-mail","kt-icon-like" => "kt-icon-like","kt-icon-photo" => "kt-icon-photo","kt-icon-note" => "kt-icon-note","kt-icon-study" => "kt-icon-study","kt-icon-lab" => "kt-icon-lab","kt-icon-food" => "kt-icon-food","kt-icon-t-shirt" => "kt-icon-t-shirt","kt-icon-fire" => "kt-icon-fire","kt-icon-clip" => "kt-icon-clip","kt-icon-shop" => "kt-icon-shop","kt-icon-calendar" => "kt-icon-calendar","kt-icon-wallet" => "kt-icon-wallet","kt-icon-vynil" => "kt-icon-vynil","kt-icon-truck" => "kt-icon-truck","kt-icon-world" => "kt-icon-world","kt-icon-paperplane" => "kt-icon-paperplane","kt-icon-params" => "kt-icon-params","kt-icon-banknote" => "kt-icon-banknote","kt-icon-data" => "kt-icon-data","kt-icon-music" => "kt-icon-music","kt-icon-megaphone" => "kt-icon-megaphone","kt-icon-tag" => "kt-icon-tag","kt-icon-lock" => "kt-icon-lock","kt-icon-bulb" => "kt-icon-bulb","kt-icon-diamond" => "kt-icon-diamond","kt-icon-display" => "kt-icon-display","kt-icon-pen" => "kt-icon-pen","kt-icon-clock" => "kt-icon-clock","kt-icon-mobile" => "kt-icon-mobile","kt-icon-laptop" => "kt-icon-laptop","kt-icon-desktop" => "kt-icon-desktop","kt-icon-tablet" => "kt-icon-tablet","kt-icon-phone2" => "kt-icon-phone2","kt-icon-document" => "kt-icon-document","kt-icon-documents" => "kt-icon-documents","kt-icon-search2" => "kt-icon-search2","kt-icon-clipboard" => "kt-icon-clipboard","kt-icon-newspaper" => "kt-icon-newspaper","kt-icon-notebook" => "kt-icon-notebook","kt-icon-book-open" => "kt-icon-book-open","kt-icon-browser" => "kt-icon-browser","kt-icon-calendar2" => "kt-icon-calendar2","kt-icon-presentation" => "kt-icon-presentation","kt-icon-picture" => "kt-icon-picture","kt-icon-pictures" => "kt-icon-pictures","kt-icon-video2" => "kt-icon-video2","kt-icon-camera2" => "kt-icon-camera2","kt-icon-printer" => "kt-icon-printer","kt-icon-toolbox" => "kt-icon-toolbox","kt-icon-briefcase" => "kt-icon-briefcase","kt-icon-wallet2" => "kt-icon-wallet2","kt-icon-gift" => "kt-icon-gift","kt-icon-bargraph" => "kt-icon-bargraph","kt-icon-grid" => "kt-icon-grid","kt-icon-expand" => "kt-icon-expand","kt-icon-focus" => "kt-icon-focus","kt-icon-edit" => "kt-icon-edit","kt-icon-adjustments" => "kt-icon-adjustments","kt-icon-ribbon" => "kt-icon-ribbon","kt-icon-hourglass" => "kt-icon-hourglass","kt-icon-lock2" => "kt-icon-lock2","kt-icon-megaphone2" => "kt-icon-megaphone2","kt-icon-shield" => "kt-icon-shield","kt-icon-trophy" => "kt-icon-trophy","kt-icon-flag" => "kt-icon-flag","kt-icon-map" => "kt-icon-map","kt-icon-puzzle" => "kt-icon-puzzle","kt-icon-basket" => "kt-icon-basket","kt-icon-envelope" => "kt-icon-envelope","kt-icon-streetsign" => "kt-icon-streetsign","kt-icon-telescope" => "kt-icon-telescope","kt-icon-gears" => "kt-icon-gears","kt-icon-key2" => "kt-icon-key2","kt-icon-paperclip" => "kt-icon-paperclip","kt-icon-attachment" => "kt-icon-attachment","kt-icon-pricetags" => "kt-icon-pricetags","kt-icon-lightbulb" => "kt-icon-lightbulb","kt-icon-layers" => "kt-icon-layers","kt-icon-pencil" => "kt-icon-pencil","kt-icon-tools" => "kt-icon-tools","kt-icon-tools-2" => "kt-icon-tools-2","kt-icon-scissors" => "kt-icon-scissors","kt-icon-paintbrush" => "kt-icon-paintbrush","kt-icon-magnifying-glass" => "kt-icon-magnifying-glass","kt-icon-circle-compass" => "kt-icon-circle-compass","kt-icon-linegraph" => "kt-icon-linegraph","kt-icon-mic" => "kt-icon-mic","kt-icon-strategy" => "kt-icon-strategy","kt-icon-beaker" => "kt-icon-beaker","kt-icon-caution" => "kt-icon-caution","kt-icon-recycle" => "kt-icon-recycle","kt-icon-anchor" => "kt-icon-anchor","kt-icon-profile-male" => "kt-icon-profile-male","kt-icon-profile-female" => "kt-icon-profile-female","kt-icon-bike" => "kt-icon-bike","kt-icon-wine" => "kt-icon-wine","kt-icon-hotairballoon" => "kt-icon-hotairballoon","kt-icon-globe" => "kt-icon-globe","kt-icon-genius" => "kt-icon-genius","kt-icon-map-pin" => "kt-icon-map-pin","kt-icon-dial" => "kt-icon-dial","kt-icon-chat" => "kt-icon-chat","kt-icon-heart2" => "kt-icon-heart2","kt-icon-cloud2" => "kt-icon-cloud2","kt-icon-upload" => "kt-icon-upload","kt-icon-download" => "kt-icon-download","kt-icon-target" => "kt-icon-target","kt-icon-hazardous" => "kt-icon-hazardous","kt-icon-piechart" => "kt-icon-piechart","kt-icon-speedometer" => "kt-icon-speedometer","kt-icon-global" => "kt-icon-global","kt-icon-compass" => "kt-icon-compass","kt-icon-lifesaver" => "kt-icon-lifesaver","kt-icon-clock2" => "kt-icon-clock2","kt-icon-aperture" => "kt-icon-aperture","kt-icon-quote" => "kt-icon-quote","kt-icon-scope" => "kt-icon-scope","kt-icon-alarmclock" => "kt-icon-alarmclock","kt-icon-refresh" => "kt-icon-refresh","kt-icon-happy" => "kt-icon-happy","kt-icon-sad" => "kt-icon-sad","kt-icon-facebook" => "kt-icon-facebook","kt-icon-twitter" => "kt-icon-twitter","kt-icon-googleplus" => "kt-icon-googleplus","kt-icon-rss" => "kt-icon-rss","kt-icon-tumblr" => "kt-icon-tumblr","kt-icon-linkedin" => "kt-icon-linkedin","kt-icon-dribbble" => "kt-icon-dribbble","kt-icon-home" => "kt-icon-home","kt-icon-home2" => "kt-icon-home2","kt-icon-home3" => "kt-icon-home3","kt-icon-home5" => "kt-icon-home5","kt-icon-home4" => "kt-icon-home4","kt-icon-home6" => "kt-icon-home6","kt-icon-office" => "kt-icon-office","kt-icon-newspaper2" => "kt-icon-newspaper2","kt-icon-pencil2" => "kt-icon-pencil2","kt-icon-pencil3" => "kt-icon-pencil3","kt-icon-pencil4" => "kt-icon-pencil4","kt-icon-pencil5" => "kt-icon-pencil5","kt-icon-quill" => "kt-icon-quill","kt-icon-quill2" => "kt-icon-quill2","kt-icon-pencil6" => "kt-icon-pencil6","kt-icon-pen2" => "kt-icon-pen2","kt-icon-pen3" => "kt-icon-pen3","kt-icon-pen4" => "kt-icon-pen4","kt-icon-home7" => "kt-icon-home7","kt-icon-marker" => "kt-icon-marker","kt-icon-blog" => "kt-icon-blog","kt-icon-brush" => "kt-icon-brush","kt-icon-palette" => "kt-icon-palette","kt-icon-palette2" => "kt-icon-palette2","kt-icon-eyedropper" => "kt-icon-eyedropper","kt-icon-eyedropper2" => "kt-icon-eyedropper2","kt-icon-droplet" => "kt-icon-droplet","kt-icon-droplet2" => "kt-icon-droplet2","kt-icon-droplet3" => "kt-icon-droplet3","kt-icon-paint-format" => "kt-icon-paint-format","kt-icon-image" => "kt-icon-image","kt-icon-image2" => "kt-icon-image2","kt-icon-images" => "kt-icon-images","kt-icon-image3" => "kt-icon-image3","kt-icon-image5" => "kt-icon-image5","kt-icon-image4" => "kt-icon-image4","kt-icon-images2" => "kt-icon-images2","kt-icon-camera3" => "kt-icon-camera3","kt-icon-camera4" => "kt-icon-camera4","kt-icon-camera5" => "kt-icon-camera5","kt-icon-music2" => "kt-icon-music2","kt-icon-music3" => "kt-icon-music3","kt-icon-music4" => "kt-icon-music4","kt-icon-piano" => "kt-icon-piano","kt-icon-guitar" => "kt-icon-guitar","kt-icon-headphones" => "kt-icon-headphones","kt-icon-play" => "kt-icon-play","kt-icon-play2" => "kt-icon-play2","kt-icon-movie" => "kt-icon-movie","kt-icon-movie2" => "kt-icon-movie2","kt-icon-film" => "kt-icon-film","kt-icon-film2" => "kt-icon-film2","kt-icon-camera6" => "kt-icon-camera6","kt-icon-camera7" => "kt-icon-camera7","kt-icon-camera8" => "kt-icon-camera8","kt-icon-dice" => "kt-icon-dice","kt-icon-gamepad" => "kt-icon-gamepad","kt-icon-gamepad2" => "kt-icon-gamepad2","kt-icon-pacman" => "kt-icon-pacman","kt-icon-spades" => "kt-icon-spades","kt-icon-clubs" => "kt-icon-clubs","kt-icon-diamonds" => "kt-icon-diamonds","kt-icon-king" => "kt-icon-king","kt-icon-queen" => "kt-icon-queen","kt-icon-rock" => "kt-icon-rock","kt-icon-bishop" => "kt-icon-bishop","kt-icon-knight" => "kt-icon-knight","kt-icon-bullhorn" => "kt-icon-bullhorn","kt-icon-megaphone3" => "kt-icon-megaphone3","kt-icon-connection" => "kt-icon-connection","kt-icon-connection2" => "kt-icon-connection2","kt-icon-radio" => "kt-icon-radio","kt-icon-radio2" => "kt-icon-radio2","kt-icon-podcast" => "kt-icon-podcast","kt-icon-mic2" => "kt-icon-mic2","kt-icon-mic3" => "kt-icon-mic3","kt-icon-mic4" => "kt-icon-mic4","kt-icon-book" => "kt-icon-book","kt-icon-books" => "kt-icon-books","kt-icon-library" => "kt-icon-library","kt-icon-library2" => "kt-icon-library2","kt-icon-profile" => "kt-icon-profile","kt-icon-file" => "kt-icon-file","kt-icon-copy" => "kt-icon-copy","kt-icon-copy2" => "kt-icon-copy2","kt-icon-paste" => "kt-icon-paste","kt-icon-stack2" => "kt-icon-stack2","kt-icon-stack3" => "kt-icon-stack3","kt-icon-folder" => "kt-icon-folder","kt-icon-folder-download" => "kt-icon-folder-download","kt-icon-folder-upload" => "kt-icon-folder-upload","kt-icon-folder8" => "kt-icon-folder8","kt-icon-folder-remove" => "kt-icon-folder-remove","kt-icon-folder-open" => "kt-icon-folder-open","kt-icon-folder-open2" => "kt-icon-folder-open2","kt-icon-folder-open3" => "kt-icon-folder-open3","kt-icon-folder2" => "kt-icon-folder2","kt-icon-certificate" => "kt-icon-certificate","kt-icon-cc" => "kt-icon-cc","kt-icon-tag2" => "kt-icon-tag2","kt-icon-tag3" => "kt-icon-tag3","kt-icon-tag4" => "kt-icon-tag4","kt-icon-tags" => "kt-icon-tags","kt-icon-tags2" => "kt-icon-tags2","kt-icon-cart" => "kt-icon-cart","kt-icon-cart2" => "kt-icon-cart2","kt-icon-cart3" => "kt-icon-cart3","kt-icon-cart4" => "kt-icon-cart4","kt-icon-basket2" => "kt-icon-basket2","kt-icon-basket3" => "kt-icon-basket3","kt-icon-bag" => "kt-icon-bag","kt-icon-bag2" => "kt-icon-bag2","kt-icon-bag3" => "kt-icon-bag3","kt-icon-credit" => "kt-icon-credit","kt-icon-credit2" => "kt-icon-credit2","kt-icon-calculate" => "kt-icon-calculate","kt-icon-support" => "kt-icon-support","kt-icon-phone3" => "kt-icon-phone3","kt-icon-phone4" => "kt-icon-phone4","kt-icon-phone6" => "kt-icon-phone6","kt-icon-phone5" => "kt-icon-phone5","kt-icon-address-book" => "kt-icon-address-book","kt-icon-notebook2" => "kt-icon-notebook2","kt-icon-envelop" => "kt-icon-envelop","kt-icon-mail-send" => "kt-icon-mail-send","kt-icon-envelop-opened" => "kt-icon-envelop-opened","kt-icon-envelop2" => "kt-icon-envelop2","kt-icon-pushpin" => "kt-icon-pushpin","kt-icon-location2" => "kt-icon-location2","kt-icon-location3" => "kt-icon-location3","kt-icon-location4" => "kt-icon-location4","kt-icon-compass2" => "kt-icon-compass2","kt-icon-map2" => "kt-icon-map2","kt-icon-map3" => "kt-icon-map3","kt-icon-map4" => "kt-icon-map4","kt-icon-direction" => "kt-icon-direction","kt-icon-history" => "kt-icon-history","kt-icon-clock3" => "kt-icon-clock3","kt-icon-clock4" => "kt-icon-clock4","kt-icon-clock5" => "kt-icon-clock5","kt-icon-alarm" => "kt-icon-alarm","kt-icon-bell" => "kt-icon-bell","kt-icon-bell2" => "kt-icon-bell2","kt-icon-stopwatch" => "kt-icon-stopwatch","kt-icon-calendar3" => "kt-icon-calendar3","kt-icon-calendar4" => "kt-icon-calendar4","kt-icon-calendar5" => "kt-icon-calendar5","kt-icon-calendar7" => "kt-icon-calendar7","kt-icon-calendar6" => "kt-icon-calendar6","kt-icon-print" => "kt-icon-print","kt-icon-print2" => "kt-icon-print2","kt-icon-mouse" => "kt-icon-mouse","kt-icon-keyboard" => "kt-icon-keyboard","kt-icon-keyboard2" => "kt-icon-keyboard2","kt-icon-screen" => "kt-icon-screen","kt-icon-laptop2" => "kt-icon-laptop2","kt-icon-mobile2" => "kt-icon-mobile2","kt-icon-mobile3" => "kt-icon-mobile3","kt-icon-tablet2" => "kt-icon-tablet2","kt-icon-tv2" => "kt-icon-tv2","kt-icon-cabinet" => "kt-icon-cabinet","kt-icon-drawer" => "kt-icon-drawer","kt-icon-drawer2" => "kt-icon-drawer2","kt-icon-drawer3" => "kt-icon-drawer3","kt-icon-box" => "kt-icon-box","kt-icon-cd" => "kt-icon-cd","kt-icon-undo" => "kt-icon-undo","kt-icon-redo" => "kt-icon-redo","kt-icon-forward" => "kt-icon-forward","kt-icon-reply" => "kt-icon-reply","kt-icon-bubble2" => "kt-icon-bubble2","kt-icon-bubbles" => "kt-icon-bubbles","kt-icon-bubble3" => "kt-icon-bubble3","kt-icon-bubbles2" => "kt-icon-bubbles2","kt-icon-bubbles3" => "kt-icon-bubbles3","kt-icon-bubble4" => "kt-icon-bubble4","kt-icon-bubble5" => "kt-icon-bubble5","kt-icon-bubbles4" => "kt-icon-bubbles4","kt-icon-user2" => "kt-icon-user2","kt-icon-users" => "kt-icon-users","kt-icon-user3" => "kt-icon-user3","kt-icon-user4" => "kt-icon-user4","kt-icon-users3" => "kt-icon-users3","kt-icon-users2" => "kt-icon-users2","kt-icon-users4" => "kt-icon-users4","kt-icon-vcard" => "kt-icon-vcard","kt-icon-tshirt" => "kt-icon-tshirt","kt-icon-quotes-left" => "kt-icon-quotes-left","kt-icon-quotes-right" => "kt-icon-quotes-right","kt-icon-spinner" => "kt-icon-spinner","kt-icon-busy2" => "kt-icon-busy2","kt-icon-busy" => "kt-icon-busy","kt-icon-spinner2" => "kt-icon-spinner2","kt-icon-spinner3" => "kt-icon-spinner3","kt-icon-spinner4" => "kt-icon-spinner4","kt-icon-spinner5" => "kt-icon-spinner5","kt-icon-microscope" => "kt-icon-microscope","kt-icon-binoculars" => "kt-icon-binoculars","kt-icon-search3" => "kt-icon-search3","kt-icon-search4" => "kt-icon-search4","kt-icon-search5" => "kt-icon-search5","kt-icon-zoomin" => "kt-icon-zoomin","kt-icon-zoomout" => "kt-icon-zoomout","kt-icon-search6" => "kt-icon-search6","kt-icon-expand2" => "kt-icon-expand2","kt-icon-contract" => "kt-icon-contract","kt-icon-expand3" => "kt-icon-expand3","kt-icon-contract2" => "kt-icon-contract2","kt-icon-key3" => "kt-icon-key3","kt-icon-key4" => "kt-icon-key4","kt-icon-key5" => "kt-icon-key5","kt-icon-key6" => "kt-icon-key6","kt-icon-keyhole" => "kt-icon-keyhole","kt-icon-lock3" => "kt-icon-lock3","kt-icon-wrench" => "kt-icon-wrench","kt-icon-wrench2" => "kt-icon-wrench2","kt-icon-settings2" => "kt-icon-settings2","kt-icon-equalizer" => "kt-icon-equalizer","kt-icon-equalizer2" => "kt-icon-equalizer2","kt-icon-equalizer3" => "kt-icon-equalizer3","kt-icon-cog" => "kt-icon-cog","kt-icon-cogs" => "kt-icon-cogs","kt-icon-cog2" => "kt-icon-cog2","kt-icon-tools2" => "kt-icon-tools2","kt-icon-screwdriver" => "kt-icon-screwdriver","kt-icon-wand2" => "kt-icon-wand2","kt-icon-wand" => "kt-icon-wand","kt-icon-health" => "kt-icon-health","kt-icon-aid" => "kt-icon-aid","kt-icon-bug" => "kt-icon-bug","kt-icon-inject" => "kt-icon-inject","kt-icon-inject2" => "kt-icon-inject2","kt-icon-construction" => "kt-icon-construction","kt-icon-cone" => "kt-icon-cone","kt-icon-pie2" => "kt-icon-pie2","kt-icon-pie3" => "kt-icon-pie3","kt-icon-pie" => "kt-icon-pie","kt-icon-stats" => "kt-icon-stats","kt-icon-stats2" => "kt-icon-stats2","kt-icon-stats3" => "kt-icon-stats3","kt-icon-bars" => "kt-icon-bars","kt-icon-bars2" => "kt-icon-bars2","kt-icon-stats-up" => "kt-icon-stats-up","kt-icon-stats-down" => "kt-icon-stats-down","kt-icon-gift2" => "kt-icon-gift2","kt-icon-gift3" => "kt-icon-gift3","kt-icon-balloon" => "kt-icon-balloon","kt-icon-trophy2" => "kt-icon-trophy2","kt-icon-trophy3" => "kt-icon-trophy3","kt-icon-diamond2" => "kt-icon-diamond2","kt-icon-glass" => "kt-icon-glass","kt-icon-glass2" => "kt-icon-glass2","kt-icon-bottle" => "kt-icon-bottle","kt-icon-bottle2" => "kt-icon-bottle2","kt-icon-mug" => "kt-icon-mug","kt-icon-food2" => "kt-icon-food2","kt-icon-food3" => "kt-icon-food3","kt-icon-cup2" => "kt-icon-cup2","kt-icon-cup3" => "kt-icon-cup3","kt-icon-leaf" => "kt-icon-leaf","kt-icon-leaf2" => "kt-icon-leaf2","kt-icon-apple-fruit" => "kt-icon-apple-fruit","kt-icon-tree" => "kt-icon-tree","kt-icon-tree2" => "kt-icon-tree2","kt-icon-paw" => "kt-icon-paw","kt-icon-steps" => "kt-icon-steps","kt-icon-flower" => "kt-icon-flower","kt-icon-rocket" => "kt-icon-rocket","kt-icon-meter" => "kt-icon-meter","kt-icon-meter2" => "kt-icon-meter2","kt-icon-meter-slow" => "kt-icon-meter-slow","kt-icon-meter-fast" => "kt-icon-meter-fast","kt-icon-dashboard" => "kt-icon-dashboard","kt-icon-balance" => "kt-icon-balance","kt-icon-hammer" => "kt-icon-hammer","kt-icon-bomb" => "kt-icon-bomb","kt-icon-fire2" => "kt-icon-fire2","kt-icon-lab2" => "kt-icon-lab2","kt-icon-atom" => "kt-icon-atom","kt-icon-magnet" => "kt-icon-magnet","kt-icon-magnet2" => "kt-icon-magnet2","kt-icon-dumbbell" => "kt-icon-dumbbell","kt-icon-skull" => "kt-icon-skull","kt-icon-lamp" => "kt-icon-lamp","kt-icon-lamp2" => "kt-icon-lamp2","kt-icon-remove" => "kt-icon-remove","kt-icon-remove2" => "kt-icon-remove2","kt-icon-remove3" => "kt-icon-remove3","kt-icon-remove4" => "kt-icon-remove4","kt-icon-airplane" => "kt-icon-airplane","kt-icon-paperplane2" => "kt-icon-paperplane2","kt-icon-bike2" => "kt-icon-bike2","kt-icon-ship" => "kt-icon-ship","kt-icon-car" => "kt-icon-car","kt-icon-bus" => "kt-icon-bus","kt-icon-truck2" => "kt-icon-truck2","kt-icon-cube" => "kt-icon-cube","kt-icon-cube4" => "kt-icon-cube4","kt-icon-pyramid" => "kt-icon-pyramid","kt-icon-pyramid2" => "kt-icon-pyramid2","kt-icon-cylinder" => "kt-icon-cylinder","kt-icon-package" => "kt-icon-package","kt-icon-puzzle2" => "kt-icon-puzzle2","kt-icon-puzzle3" => "kt-icon-puzzle3","kt-icon-glasses" => "kt-icon-glasses","kt-icon-glasses2" => "kt-icon-glasses2","kt-icon-accessibility" => "kt-icon-accessibility","kt-icon-accessibility2" => "kt-icon-accessibility2","kt-icon-brain" => "kt-icon-brain","kt-icon-shield2" => "kt-icon-shield2","kt-icon-shield3" => "kt-icon-shield3","kt-icon-shield5" => "kt-icon-shield5","kt-icon-shield4" => "kt-icon-shield4","kt-icon-soccer" => "kt-icon-soccer","kt-icon-football" => "kt-icon-football","kt-icon-baseball" => "kt-icon-baseball","kt-icon-basketball" => "kt-icon-basketball","kt-icon-golf" => "kt-icon-golf","kt-icon-hockey" => "kt-icon-hockey","kt-icon-racing" => "kt-icon-racing","kt-icon-eightball" => "kt-icon-eightball","kt-icon-bowlingball" => "kt-icon-bowlingball","kt-icon-bowling" => "kt-icon-bowling","kt-icon-lightning" => "kt-icon-lightning","kt-icon-power" => "kt-icon-power","kt-icon-switch" => "kt-icon-switch","kt-icon-powercord" => "kt-icon-powercord","kt-icon-socket" => "kt-icon-socket","kt-icon-clipboard2" => "kt-icon-clipboard2","kt-icon-clipboard3" => "kt-icon-clipboard3","kt-icon-signup" => "kt-icon-signup","kt-icon-clipboard4" => "kt-icon-clipboard4","kt-icon-list" => "kt-icon-list","kt-icon-list2" => "kt-icon-list2","kt-icon-grid2" => "kt-icon-grid2","kt-icon-grid3" => "kt-icon-grid3","kt-icon-grid4" => "kt-icon-grid4","kt-icon-grid5" => "kt-icon-grid5","kt-icon-grid6" => "kt-icon-grid6","kt-icon-grid7" => "kt-icon-grid7","kt-icon-tree3" => "kt-icon-tree3","kt-icon-tree4" => "kt-icon-tree4","kt-icon-menu" => "kt-icon-menu","kt-icon-menu2" => "kt-icon-menu2","kt-icon-menu3" => "kt-icon-menu3","kt-icon-menu4" => "kt-icon-menu4","kt-icon-menu5" => "kt-icon-menu5","kt-icon-menu6" => "kt-icon-menu6","kt-icon-menu7" => "kt-icon-menu7","kt-icon-cloud3" => "kt-icon-cloud3","kt-icon-cloud-download" => "kt-icon-cloud-download","kt-icon-cloud-upload" => "kt-icon-cloud-upload","kt-icon-earth" => "kt-icon-earth","kt-icon-network" => "kt-icon-network","kt-icon-link" => "kt-icon-link","kt-icon-link2" => "kt-icon-link2","kt-icon-link22" => "kt-icon-link22","kt-icon-link3" => "kt-icon-link3","kt-icon-link4" => "kt-icon-link4","kt-icon-flag2" => "kt-icon-flag2","kt-icon-anchor2" => "kt-icon-anchor2","kt-icon-flag3" => "kt-icon-flag3","kt-icon-attachment2" => "kt-icon-attachment2","kt-icon-flag4" => "kt-icon-flag4","kt-icon-eye2" => "kt-icon-eye2","kt-icon-eye3" => "kt-icon-eye3","kt-icon-eye4" => "kt-icon-eye4","kt-icon-bookmark" => "kt-icon-bookmark","kt-icon-spotlight" => "kt-icon-spotlight","kt-icon-starburst" => "kt-icon-starburst","kt-icon-temperature" => "kt-icon-temperature","kt-icon-snowflake" => "kt-icon-snowflake","kt-icon-weather-rain" => "kt-icon-weather-rain","kt-icon-weather-snow" => "kt-icon-weather-snow","kt-icon-umbrella" => "kt-icon-umbrella","kt-icon-moon" => "kt-icon-moon","kt-icon-star2" => "kt-icon-star2","kt-icon-star3" => "kt-icon-star3","kt-icon-star4" => "kt-icon-star4","kt-icon-heart3" => "kt-icon-heart3","kt-icon-heart4" => "kt-icon-heart4","kt-icon-heart5" => "kt-icon-heart5","kt-icon-heart-broken" => "kt-icon-heart-broken","kt-icon-thumbs-up" => "kt-icon-thumbs-up","kt-icon-thumbs-down" => "kt-icon-thumbs-down","kt-icon-people" => "kt-icon-people","kt-icon-man" => "kt-icon-man","kt-icon-male" => "kt-icon-male","kt-icon-woman" => "kt-icon-woman","kt-icon-yin-yang" => "kt-icon-yin-yang","kt-icon-happy2" => "kt-icon-happy2","kt-icon-smiley" => "kt-icon-smiley","kt-icon-tongue" => "kt-icon-tongue","kt-icon-sad2" => "kt-icon-sad2","kt-icon-wink" => "kt-icon-wink","kt-icon-grin" => "kt-icon-grin","kt-icon-cool" => "kt-icon-cool","kt-icon-angry" => "kt-icon-angry","kt-icon-evil" => "kt-icon-evil","kt-icon-shocked" => "kt-icon-shocked","kt-icon-confused" => "kt-icon-confused","kt-icon-neutral" => "kt-icon-neutral","kt-icon-wondering" => "kt-icon-wondering","kt-icon-warning" => "kt-icon-warning","kt-icon-notification" => "kt-icon-notification","kt-icon-question" => "kt-icon-question","kt-icon-question2" => "kt-icon-question2","kt-icon-plus-circle" => "kt-icon-plus-circle","kt-icon-plus-circle2" => "kt-icon-plus-circle2","kt-icon-minus-circle" => "kt-icon-minus-circle","kt-icon-minus-circle2" => "kt-icon-minus-circle2","kt-icon-info" => "kt-icon-info","kt-icon-info2" => "kt-icon-info2","kt-icon-checkmark-circle" => "kt-icon-checkmark-circle","kt-icon-checkmark-circle2" => "kt-icon-checkmark-circle2","kt-icon-close" => "kt-icon-close","kt-icon-close2" => "kt-icon-close2","kt-icon-checkmark" => "kt-icon-checkmark","kt-icon-checkmark2" => "kt-icon-checkmark2","kt-icon-minus" => "kt-icon-minus","kt-icon-plus" => "kt-icon-plus","kt-icon-minus2" => "kt-icon-minus2","kt-icon-plus2" => "kt-icon-plus2","kt-icon-play3" => "kt-icon-play3","kt-icon-pause" => "kt-icon-pause","kt-icon-stop" => "kt-icon-stop","kt-icon-arrow-up" => "kt-icon-arrow-up","kt-icon-arrow-right" => "kt-icon-arrow-right","kt-icon-arrow-down" => "kt-icon-arrow-down","kt-icon-arrow-left" => "kt-icon-arrow-left","kt-icon-arrow-up2" => "kt-icon-arrow-up2","kt-icon-arrow-right2" => "kt-icon-arrow-right2","kt-icon-arrow-down2" => "kt-icon-arrow-down2","kt-icon-arrow-left2" => "kt-icon-arrow-left2","kt-icon-arrow-up3" => "kt-icon-arrow-up3","kt-icon-arrow-right3" => "kt-icon-arrow-right3","kt-icon-arrow-down3" => "kt-icon-arrow-down3","kt-icon-arrow-left3" => "kt-icon-arrow-left3","kt-icon-arrow-up4" => "kt-icon-arrow-up4","kt-icon-arrow-right4" => "kt-icon-arrow-right4","kt-icon-arrow-down4" => "kt-icon-arrow-down4","kt-icon-arrow-left4" => "kt-icon-arrow-left4","kt-icon-arrow-up5" => "kt-icon-arrow-up5","kt-icon-arrow-right5" => "kt-icon-arrow-right5","kt-icon-arrow-down5" => "kt-icon-arrow-down5","kt-icon-arrow-left5" => "kt-icon-arrow-left5","kt-icon-arrow-up6" => "kt-icon-arrow-up6","kt-icon-arrow-right6" => "kt-icon-arrow-right6","kt-icon-arrow-down6" => "kt-icon-arrow-down6","kt-icon-arrow-left6" => "kt-icon-arrow-left6","kt-icon-checkbox-checked" => "kt-icon-checkbox-checked","kt-icon-checkbox" => "kt-icon-checkbox","kt-icon-checkbox-checked2" => "kt-icon-checkbox-checked2","kt-icon-radio-unchecked" => "kt-icon-radio-unchecked","kt-icon-crop" => "kt-icon-crop","kt-icon-crop2" => "kt-icon-crop2","kt-icon-vector" => "kt-icon-vector","kt-icon-rulers" => "kt-icon-rulers","kt-icon-scissors2" => "kt-icon-scissors2","kt-icon-font" => "kt-icon-font","kt-icon-font-size" => "kt-icon-font-size","kt-icon-bold" => "kt-icon-bold","kt-icon-font-size2" => "kt-icon-font-size2","kt-icon-page-break" => "kt-icon-page-break","kt-icon-page-break2" => "kt-icon-page-break2","kt-icon-highlight" => "kt-icon-highlight","kt-icon-pagebreak" => "kt-icon-pagebreak","kt-icon-table" => "kt-icon-table","kt-icon-newtab" => "kt-icon-newtab","kt-icon-newtab2" => "kt-icon-newtab2","kt-icon-embed" => "kt-icon-embed","kt-icon-code" => "kt-icon-code","kt-icon-mail2" => "kt-icon-mail2","kt-icon-mail3" => "kt-icon-mail3","kt-icon-mail4" => "kt-icon-mail4","kt-icon-mail5" => "kt-icon-mail5","kt-icon-googleplus2" => "kt-icon-googleplus2","kt-icon-googleplus3" => "kt-icon-googleplus3","kt-icon-googleplus4" => "kt-icon-googleplus4","kt-icon-googleplus5" => "kt-icon-googleplus5","kt-icon-facebook2" => "kt-icon-facebook2","kt-icon-facebook3" => "kt-icon-facebook3","kt-icon-facebook4" => "kt-icon-facebook4","kt-icon-facebook5" => "kt-icon-facebook5","kt-icon-instagram" => "kt-icon-instagram","kt-icon-twitter2" => "kt-icon-twitter2","kt-icon-twitter3" => "kt-icon-twitter3","kt-icon-twitter4" => "kt-icon-twitter4","kt-icon-feed" => "kt-icon-feed","kt-icon-feed2" => "kt-icon-feed2","kt-icon-feed3" => "kt-icon-feed3","kt-icon-youtube" => "kt-icon-youtube","kt-icon-youtube2" => "kt-icon-youtube2","kt-icon-vimeo" => "kt-icon-vimeo","kt-icon-vimeo2" => "kt-icon-vimeo2","kt-icon-vimeo3" => "kt-icon-vimeo3","kt-icon-lanyrd" => "kt-icon-lanyrd","kt-icon-flickr" => "kt-icon-flickr","kt-icon-flickr2" => "kt-icon-flickr2","kt-icon-flickr3" => "kt-icon-flickr3","kt-icon-flickr4" => "kt-icon-flickr4","kt-icon-picassa" => "kt-icon-picassa","kt-icon-picassa2" => "kt-icon-picassa2","kt-icon-dribbble2" => "kt-icon-dribbble2","kt-icon-dribbble3" => "kt-icon-dribbble3","kt-icon-dribbble4" => "kt-icon-dribbble4","kt-icon-forrst" => "kt-icon-forrst","kt-icon-forrst2" => "kt-icon-forrst2","kt-icon-deviantart" => "kt-icon-deviantart","kt-icon-deviantart2" => "kt-icon-deviantart2","kt-icon-steam" => "kt-icon-steam","kt-icon-steam2" => "kt-icon-steam2","kt-icon-github" => "kt-icon-github","kt-icon-github2" => "kt-icon-github2","kt-icon-github3" => "kt-icon-github3","kt-icon-github4" => "kt-icon-github4","kt-icon-github5" => "kt-icon-github5","kt-icon-wordpress" => "kt-icon-wordpress","kt-icon-wordpress2" => "kt-icon-wordpress2","kt-icon-joomla" => "kt-icon-joomla","kt-icon-blogger" => "kt-icon-blogger","kt-icon-blogger2" => "kt-icon-blogger2","kt-icon-tumblr2" => "kt-icon-tumblr2","kt-icon-tumblr3" => "kt-icon-tumblr3","kt-icon-yahoo" => "kt-icon-yahoo","kt-icon-tux" => "kt-icon-tux","kt-icon-apple" => "kt-icon-apple","kt-icon-finder" => "kt-icon-finder","kt-icon-android" => "kt-icon-android","kt-icon-windows" => "kt-icon-windows","kt-icon-windows8" => "kt-icon-windows8","kt-icon-soundcloud" => "kt-icon-soundcloud","kt-icon-skype" => "kt-icon-skype","kt-icon-reddit" => "kt-icon-reddit","kt-icon-linkedin2" => "kt-icon-linkedin2","kt-icon-lastfm" => "kt-icon-lastfm","kt-icon-lastfm2" => "kt-icon-lastfm2","kt-icon-delicious" => "kt-icon-delicious","kt-icon-stumbleupon" => "kt-icon-stumbleupon","kt-icon-stackoverflow" => "kt-icon-stackoverflow","kt-icon-stumbleupon2" => "kt-icon-stumbleupon2","kt-icon-pinterest" => "kt-icon-pinterest","kt-icon-pinterest2" => "kt-icon-pinterest2","kt-icon-xing" => "kt-icon-xing","kt-icon-xing2" => "kt-icon-xing2","kt-icon-flattr" => "kt-icon-flattr","kt-icon-foursquare" => "kt-icon-foursquare","kt-icon-paypal" => "kt-icon-paypal","kt-icon-yelp" => "kt-icon-yelp","kt-icon-html5" => "kt-icon-html5","kt-icon-css3" => "kt-icon-css3","kt-icon-chrome" => "kt-icon-chrome","kt-icon-firefox" => "kt-icon-firefox","kt-icon-IE" => "kt-icon-IE","kt-icon-opera" => "kt-icon-opera","kt-icon-safari" => "kt-icon-safari","kt-icon-icon-viadeo" => "kt-icon-icon-viadeo","kt-icon-arrow-left7" => "kt-icon-arrow-left7","kt-icon-arrow-down7" => "kt-icon-arrow-down7","kt-icon-arrow-up7" => "kt-icon-arrow-up7","kt-icon-arrow-right7" => "kt-icon-arrow-right7","kt-icon-arrow-left8" => "kt-icon-arrow-left8","kt-icon-arrow-down8" => "kt-icon-arrow-down8","kt-icon-arrow-up8" => "kt-icon-arrow-up8","kt-icon-arrow-right8" => "kt-icon-arrow-right8","kt-icon-arrow-left9" => "kt-icon-arrow-left9","kt-icon-arrow-down9" => "kt-icon-arrow-down9","kt-icon-arrow-up9" => "kt-icon-arrow-up9","kt-icon-uniE63C" => "kt-icon-uniE63C","kt-icon-euro" => "kt-icon-euro","kt-icon-gbp" => "kt-icon-gbp","kt-icon-dollar" => "kt-icon-dollar","kt-icon-rupee" => "kt-icon-rupee","kt-icon-cny" => "kt-icon-cny","kt-icon-ruble" => "kt-icon-ruble","kt-icon-won" => "kt-icon-won","kt-icon-bitcoin" => "kt-icon-bitcoin","kt-icon-xing3" => "kt-icon-xing3","kt-icon-xing-square" => "kt-icon-xing-square","kt-icon-vk" => "kt-icon-vk","kt-icon-weibo" => "kt-icon-weibo","kt-icon-renren" => "kt-icon-renren","kt-icon-pagelines" => "kt-icon-pagelines","kt-icon-stack-exchange" => "kt-icon-stack-exchange");

return apply_filters('kadence_icon_list', $icons);

}

if (!isset($content_width)) { $content_width = 940; }
