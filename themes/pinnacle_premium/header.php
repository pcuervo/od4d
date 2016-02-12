<?php 
/*
- Force plugins to stop stating incorrect errors -
wp_head();
*/
get_template_part('templates/head'); ?>
<?php global $pinnacle; 
  if(isset($pinnacle["smooth_scrolling"]) && $pinnacle["smooth_scrolling"] == '1') { $scrolling = '1';} else if(isset($pinnacle["smooth_scrolling"]) && $pinnacle["smooth_scrolling"] == '2') { $scrolling = '2';} else {$scrolling = '0';}
  if(isset($pinnacle["smooth_scrolling_hide"]) && $pinnacle["smooth_scrolling_hide"] == '1') {$scrolling_hide = '1';} else {$scrolling_hide = '0';} 
  if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == '1') {$animate = '1';} else {$animate = '0';}
  if(isset($pinnacle['sticky_header']) && $pinnacle['sticky_header'] == '1') {$sticky = '1';} else {$sticky = '0';}
  if(isset($pinnacle['header_style'])) {$header_style = $pinnacle['header_style'];} else {$header_style = 'default';}
  if(isset($pinnacle['select2_select'])) {$select2_select = $pinnacle['select2_select'];} else {$select2_select = '1';}
  ?>
<body <?php body_class(); ?> data-smooth-scrolling="<?php echo esc_attr($scrolling);?>" data-smooth-scrolling-hide="<?php echo esc_attr($scrolling_hide);?>" data-jsselect="<?php echo esc_attr($select2_select);?>" data-animate="<?php echo esc_attr($animate);?>" data-sticky="<?php echo esc_attr($sticky);?>">
<div id="wrapper" class="container">
  <!--[if lt IE 8]>
    <div class="alert alert-warning">
      <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'pinnacle'); ?>
    </div>
  <![endif]-->
  <?php
    if($header_style == 'center') {
      get_template_part('templates/header-center');
    } else {
    get_template_part('templates/header');
  }
  ?>
  <div class="wrap contentclass" role="document">
    <?php do_action('kt_afterheader');?>