<?php global $pinnacle, $post; if(isset($pinnacle['header_height'])) {$header_height = $pinnacle['header_height'];} else {$header_height = 90;}
      if(isset($pinnacle['m_sticky_header']) && $pinnacle['m_sticky_header'] == '1') {$msticky = '1'; $mstickyclass = 'mobile-stickyheader';} else {$msticky = '0'; $mstickyclass = '';}
      if(isset($pinnacle['shrink_header']) && $pinnacle['shrink_header'] == '1') {$shrinkh = '1';} else {$shrinkh = '0';}
      if(!kadence_pagetitle_behind_header()) {
          $pageheaderbg = '0';
        } else {
          $pageheaderbg = '1';
        } 
            if(isset($pinnacle['logo_container_width'])) {
              if($pinnacle['logo_container_width'] == '50') {
                $logocclass = 'col-md-6 col-sm-9 col-ss-10'; $menulclass = 'kt-menu-left col-md-3 col-sm-3 col-ss-2'; $menurclass = 'kt-menu-right col-md-3 col-sm-3 col-ss-2';
              } elseif($pinnacle['logo_container_width'] == '41') {
                $logocclass = 'col-md-4 col-sm-8 col-ss-10'; $menulclass = 'kt-menu-left col-md-4 col-sm-4 col-ss-2'; $menurclass = 'kt-menu-right col-md-4 col-sm-4 col-ss-2';
              }elseif($pinnacle['logo_container_width'] == '33') {
                $logocclass = 'col-md-4 col-sm-8 col-ss-10'; $menulclass = 'kt-menu-left col-md-4 col-sm-4 col-ss-2'; $menurclass = 'kt-menu-right col-md-4 col-sm-4 col-ss-2';
              }elseif($pinnacle['logo_container_width'] == '25') {
                $logocclass = 'kt-logo-25 col-md-4 col-sm-8 col-ss-9'; $menulclass = 'kt-menu-left kt-logo-25 col-md-4 col-sm-4 col-ss-3'; $menurclass = 'kt-menu-right kt-logo-25 col-md-4 col-sm-4 col-ss-3';
              } else {
                $logocclass = 'col-md-2 col-sm-8 col-ss-9'; $menulclass = 'kt-menu-left col-md-5 col-sm-4 col-ss-3'; $menurclass = 'kt-menu-right col-md-5 col-sm-4 col-ss-3';
              }
          } else {$logocclass = 'col-md-4 col-sm-8 col-ss-9'; $menulclass = 'kt-menu-left col-md-4 col-sm-4 col-ss-3'; $menurclass = 'kt-menu-right col-md-4 col-sm-4 col-ss-3';} ?>
<header id="kad-banner" class="banner headerclass kad-header-style-basic kad-header-center-logo <?php echo $mstickyclass;?>" data-header-shrink="<?php echo esc_attr($shrinkh); ?>" data-mobile-sticky="<?php echo $msticky;?>" data-pageheaderbg="<?php echo $pageheaderbg;?>" data-header-base-height="<?php echo $header_height;?>">
<?php if (kadence_display_topbar()) : ?> 
 <?php get_template_part('templates/header', 'topbar'); ?>
<?php endif; ?>
<?php do_action('kt_before_header_content'); ?>

          <style type="text/css"> .kad-header-style-basic .kad-primary-nav ul.sf-menu > li > a, .kad-header-style-basic #kad-shrinkheader #mobile-nav-trigger a {line-height:<?php echo $header_height;?>px; }  </style>
  <div id="kad-shrinkheader" class="container" style="height:<?php echo $header_height;?>px; line-height:<?php echo $header_height;?>px;">
    <div class="row">
    <div class="<?php echo $menulclass; ?> kad-header-menu-left">
          <?php if (has_nav_menu('left_navigation')) : ?>
            <nav id="nav-main-left" class="clearfix kad-primary-nav" role="navigation">
              <?php wp_nav_menu(array('theme_location' => 'left_navigation', 'menu_class' => 'sf-menu'));?>
              </nav> 
              <?php endif;
           ?>
          </div>
          <div class="<?php echo $logocclass; ?> clearfix kad-header-left kad-header-logo">
            <div id="logo" class="logocase">
              <a class="brand logofont" style="height:<?php echo $header_height;?>px; line-height:<?php echo $header_height;?>px; display:block;" href="<?php echo home_url(); ?>/">
                      <?php if (!empty($pinnacle['x1_logo_upload']['url'])) { ?> 
                       <div id="thelogo" style="height:<?php echo $header_height;?>px; line-height:<?php echo $header_height;?>px;">
                       <div style="background-image: url('<?php echo $pinnacle['x1_logo_upload']['url']; ?>'); max-height:<?php echo esc_attr($header_height);?>px; height:<?php echo $pinnacle['x1_logo_upload']['height']; ?>px; width:<?php echo $pinnacle['x1_logo_upload']['width']; ?>px;" class="kad-standard-logo kad-lg" /></div>
                       <?php if (!empty($pinnacle['th_x1_logo_upload']['url'])) { ?> 
                       <div style="background-image: url('<?php echo $pinnacle['th_x1_logo_upload']['url']; ?>'); max-height:<?php echo esc_attr($header_height);?>px; height:<?php echo $pinnacle['th_x1_logo_upload']['height']; ?>px; width:<?php echo $pinnacle['th_x1_logo_upload']['width']; ?>px;" class="kad-lg kad-standard-logo-tranbg" /></div> <?php }?>
                        </div> <?php } else { echo apply_filters('kad_site_name', get_bloginfo('name')); } ?>
              </a>
           </div> <!-- Close #logo -->
       </div><!-- close col -->
       <div class="<?php echo $menurclass; ?> kad-header-right">
          <?php if (has_nav_menu('right_navigation')) : ?>
            <nav id="nav-main-right" class="clearfix kad-primary-nav">
              <?php wp_nav_menu(array('theme_location' => 'right_navigation', 'menu_class' => 'sf-menu'));?>
              </nav> 
           <?php endif;
           ?>
           <div id="mobile-nav-trigger" class="nav-trigger">
              <a class="nav-trigger-case collapsed" data-toggle="collapse" rel="nofollow" data-target=".mobile_menu_collapse">
                <div class="kad-navbtn mobileclass clearfix"><i class="kt-icon-menu3"></i></div>
              </a>
            </div>
        </div> <!-- Close col -->       
    </div> <!-- Close Row -->
  </div> <!-- Close Container -->
  <?php if (has_nav_menu('primary_navigation')) : ?>
  <div class="container">
            <div id="kad-mobile-nav" class="kad-mobile-nav">
              <div class="kad-nav-inner mobileclass">
                <div id="mobile_menu_collapse" class="kad-nav-collapse collapse mobile_menu_collapse">
                   <?php if(isset($pinnacle['menu_search']) && $pinnacle['menu_search'] == '1') { get_search_form(); } ?>
                   <?php if(isset($pinnacle['mobile_submenu_collapse']) && $pinnacle['mobile_submenu_collapse'] == '1') {
                    wp_nav_menu( array('theme_location' => 'primary_navigation','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'menu_class' => 'kad-mnav', 'walker' => new kadence_mobile_walker()));
                  } else {
                    wp_nav_menu( array('theme_location' => 'primary_navigation','items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'menu_class' => 'kad-mnav')); 
                 }?>
              </div>
            </div>
          </div>
          </div> <!-- Close Container -->
          <?php  endif; ?>
          <?php do_action('kt_after_header_content'); ?>
</header>