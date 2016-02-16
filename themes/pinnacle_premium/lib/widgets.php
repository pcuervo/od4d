<?php
/**
 * Register sidebars and widgets
 */
function kadence_sidebar_list() {
  $all_sidebars=array(array('name'=>__('Primary Sidebar', 'pinnacle'), 'id'=>'sidebar-primary'));
  global $pinnacle; 
  if(isset($pinnacle['cust_sidebars'])) {
  if (is_array($pinnacle['cust_sidebars'])) {
    $i = 1;
  foreach($pinnacle['cust_sidebars'] as $sidebar){
    if(empty($sidebar)) {$sidebar = 'sidebar'.$i;}
    $all_sidebars[]=array('name'=>$sidebar, 'id'=>'sidebar'.$i);
    $i++;
  }
 }
}
  global $kad_sidebars;
  $kad_sidebars = $all_sidebars;
  return $all_sidebars;
}
add_action('init', 'kadence_sidebar_list');

function kadence_register_sidebars(){
  $the_sidebars = kadence_sidebar_list();
  if (function_exists('register_sidebar')){
    foreach($the_sidebars as $side){
      kadence_register_sidebar($side['name'], $side['id']);    
    }

  }
}
function kadence_register_sidebar($name, $id){
  register_sidebar(array('name'=>$name,
    'id' => $id,
         'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
    'after_widget' => '</div></section>',
    'before_title' => '<h5 class="widget-title">',
    'after_title' => '</h5>',
  ));
}
add_action('widgets_init', 'kadence_register_sidebars');

function kadence_widgets_init() {
    //Topbar 
  if(kadence_display_topbar_widget()) {
  register_sidebar(array(
    'name'          => __('Topbar Widget', 'pinnacle'),
    'id'            => 'topbarright',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<span class="topbar-widget-title">',
    'after_title'   => '</span>',
  ));
}
  // Sidebars
  register_sidebar(array(
    'name'          => __('Primary Sidebar', 'pinnacle'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-inner">',
    'after_widget'  => '</div></section>',
    'before_title'  => '<h5 class="widget-title">',
    'after_title'   => '</h5>',
  ));
  register_sidebar(array(
    'name'          => __('Home Widget Area', 'pinnacle'),
    'id'            => 'homewidget',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ));

  // Footer
  global $pinnacle; if(isset($pinnacle['footer_layout'])) { $footer_layout = $pinnacle['footer_layout'];} else {$footer_layout = "fourc";}
  if ($footer_layout == "fourc" || $footer_layout == "five") {
    if ( function_exists('register_sidebar') )
      register_sidebar(array(
        'name' => __('Footer Column 1', 'pinnacle'),
        'id' => 'footer_1',
        'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      )
    );
    if ( function_exists('register_sidebar') )
      register_sidebar(array(
        'name' => __('Footer Column 2', 'pinnacle'),
        'id' => 'footer_2',
        'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      )
    );
    if ( function_exists('register_sidebar') )
      register_sidebar(array(
        'name' => __('Footer Column 3', 'pinnacle'),
        'id' => 'footer_3',
        'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      )
    );
    if ( function_exists('register_sidebar') )
      register_sidebar(array(
        'name' => __('Footer Column 4', 'pinnacle'),
        'id' => 'footer_4',
        'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      )
    );
  } else if ($footer_layout == "threec") {
    if ( function_exists('register_sidebar') )
      register_sidebar(array(
        'name' => __('Footer Column 1', 'pinnacle'),
        'id' => 'footer_third_1',
        'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      )
    );
    if ( function_exists('register_sidebar') )
      register_sidebar(array(
        'name' => __('Footer Column 2', 'pinnacle'),
        'id' => 'footer_third_2',
        'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      )
    );
    if ( function_exists('register_sidebar') )
      register_sidebar(array(
        'name' => __('Footer Column 3', 'pinnacle'),
        'id' => 'footer_third_3',
        'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
      )
    );
  } else {
      if ( function_exists('register_sidebar') )
        register_sidebar(array(
          'name' => __('Footer Column 1', 'pinnacle'),
          'id' => 'footer_double_1',
          'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
          'after_widget' => '</aside></div>',
          'before_title' => '<h4 class="widget-title">',
          'after_title' => '</h4>',
        )
      );
      if ( function_exists('register_sidebar') )
        register_sidebar(array(
          'name' => __('Footer Column 2', 'pinnacle'),
          'id' => 'footer_double_2',
          'before_widget' => '<div class="footer-widget"><aside id="%1$s" class="widget %2$s">',
          'after_widget' => '</aside></div>',
          'before_title' => '<h4 class="widget-title">',
          'after_title' => '</h4>',
        )
      );
    }

  // Widgets
  register_widget('kad_contact_widget');
  register_widget('kad_social_widget');
  register_widget('kad_recent_posts_widget');
  if(kadence_testimonial_post_on()) {
    register_widget('kad_testimonial_slider_widget');
  }
  register_widget('kad_post_grid_widget');
  register_widget('kad_image_widget');
  register_widget('kad_gallery_widget');
  register_widget('kad_carousel_widget');
  register_widget('kad_infobox_widget');
  register_widget('kad_gmap_widget');
  register_widget('kad_calltoaction_widget');
  register_widget('kad_imgmenu_widget');
  register_widget('kad_split_content_widget');
}
add_action('widgets_init', 'kadence_widgets_init');

/**
 * Contact widget
 */
class kad_contact_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
    $widget_ops = array('classname' => 'widget_kadence_contact', 'description' => __('Use this widget to add a Vcard to your site', 'pinnacle'));
    parent::__construct('widget_kadence_contact', __('Pinnacle: Contact/Vcard', 'pinnacle'), $widget_ops);
  }

  public function widget($args, $instance) {

    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }

    ob_start();
    extract($args, EXTR_SKIP);

    $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
  if (!isset($instance['company'])) { $instance['company'] = ''; }
  if (!isset($instance['name'])) { $instance['name'] = ''; }
    if (!isset($instance['street_address'])) { $instance['street_address'] = ''; }
    if (!isset($instance['locality'])) { $instance['locality'] = ''; }
    if (!isset($instance['region'])) { $instance['region'] = ''; }
    if (!isset($instance['postal_code'])) { $instance['postal_code'] = ''; }
    if (!isset($instance['tel'])) { $instance['tel'] = ''; }
    if (!isset($instance['fixedtel'])) { $instance['fixedtel'] = ''; }
    if (!isset($instance['email'])) { $instance['email'] = ''; }

    echo $before_widget;
    if ($title) {
      echo $before_title;
      echo $title;
      echo $after_title;
    }
  ?>
    <div class="vcard">
      
      <?php if(!empty($instance['company'])):?><h5 class="vcard-company"><i class="kt-icon-office"></i><?php echo $instance['company']; ?></h5><?php endif;?>
      <?php if(!empty($instance['name'])):?><p class="vcard-name"><i class="kt-icon-user2"></i><?php echo $instance['name']; ?></p><?php endif;?>
      <?php if(!empty($instance['street_address']) || !empty($instance['locality']) || !empty($instance['region']) ):?>
        <p class="vcard-address"><i class="kt-icon-location2"></i><?php echo $instance['street_address']; ?>
       <span><?php echo $instance['locality']; ?> <?php echo $instance['region']; ?> <?php echo $instance['postal_code']; ?></span></p>
     <?php endif;?>
      <?php if(!empty($instance['tel'])):?><p class="tel"><i class="kt-icon-mobile2"></i> <?php echo $instance['tel']; ?></p><?php endif;?>
      <?php if(!empty($instance['fixedtel'])):?><p class="tel fixedtel"><i class="kt-icon-phone3"></i> <?php echo $instance['fixedtel']; ?></p><?php endif;?>
      <?php if(!empty($instance['email'])):?><p><a class="email" href="mailto:<?php echo antispambot($instance['email']);?>"><i class="kt-icon-envelop"></i> <?php echo antispambot($instance['email']); ?></a></p> <?php endif;?>
    </div>
      <?php
    echo $after_widget;
  }

  public function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
  $instance['company'] = strip_tags($new_instance['company']);
  $instance['name'] = strip_tags($new_instance['name']);
    $instance['street_address'] = strip_tags($new_instance['street_address']);
    $instance['locality'] = strip_tags($new_instance['locality']);
    $instance['region'] = strip_tags($new_instance['region']);
    $instance['postal_code'] = strip_tags($new_instance['postal_code']);
    $instance['tel'] = strip_tags($new_instance['tel']);
    $instance['fixedtel'] = strip_tags($new_instance['fixedtel']);
    $instance['email'] = strip_tags($new_instance['email']);

    return $instance;
  }


  public function form($instance) {
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $company = isset($instance['company']) ? esc_attr($instance['company']) : '';
  $name = isset($instance['name']) ? esc_attr($instance['name']) : '';
  $street_address = isset($instance['street_address']) ? esc_attr($instance['street_address']) : '';
    $locality = isset($instance['locality']) ? esc_attr($instance['locality']) : '';
    $region = isset($instance['region']) ? esc_attr($instance['region']) : '';
    $postal_code = isset($instance['postal_code']) ? esc_attr($instance['postal_code']) : '';
    $tel = isset($instance['tel']) ? esc_attr($instance['tel']) : '';
    $fixedtel = isset($instance['fixedtel']) ? esc_attr($instance['fixedtel']) : '';
    $email = isset($instance['email']) ? esc_attr($instance['email']) : '';
  ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('company')); ?>"><?php _e('Company Name:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('company')); ?>" name="<?php echo esc_attr($this->get_field_name('company')); ?>" type="text" value="<?php echo esc_attr($company); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('name')); ?>"><?php _e('Name:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('name')); ?>" name="<?php echo esc_attr($this->get_field_name('name')); ?>" type="text" value="<?php echo esc_attr($name); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('street_address')); ?>"><?php _e('Street Address:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('street_address')); ?>" name="<?php echo esc_attr($this->get_field_name('street_address')); ?>" type="text" value="<?php echo esc_attr($street_address); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('locality')); ?>"><?php _e('City/Locality:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('locality')); ?>" name="<?php echo esc_attr($this->get_field_name('locality')); ?>" type="text" value="<?php echo esc_attr($locality); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('region')); ?>"><?php _e('State/Region:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('region')); ?>" name="<?php echo esc_attr($this->get_field_name('region')); ?>" type="text" value="<?php echo esc_attr($region); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('postal_code')); ?>"><?php _e('Zipcode/Postal Code:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('postal_code')); ?>" name="<?php echo esc_attr($this->get_field_name('postal_code')); ?>" type="text" value="<?php echo esc_attr($postal_code); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('tel')); ?>"><?php _e('Mobile Telephone:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('tel')); ?>" name="<?php echo esc_attr($this->get_field_name('tel')); ?>" type="text" value="<?php echo esc_attr($tel); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('fixedtel')); ?>"><?php _e('Fixed Telephone:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('fixedtel')); ?>" name="<?php echo esc_attr($this->get_field_name('fixedtel')); ?>" type="text" value="<?php echo esc_attr($fixedtel); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php _e('Email:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" />
    </p>
  <?php
  }
}
/**
 * Social widget
 */
class kad_social_widget extends WP_Widget {
    private static $instance = 0;
    public function __construct() {
    $widget_ops = array('classname' => 'widget_kadence_social', 'description' => __('Simple way to add Social Icons', 'pinnacle'));
    parent::__construct('widget_kadence_social', __('Pinnacle: Social Links', 'pinnacle'), $widget_ops);
  }

  public function widget($args, $instance) {

    if (!isset($args['widget_id'])) {
      $args['widget_id'] = null;
    }

    ob_start();
    extract($args, EXTR_SKIP);

    $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
    if (!isset($instance['facebook'])) { $instance['facebook'] = ''; }
    if (!isset($instance['twitter'])) { $instance['twitter'] = ''; }
    if (!isset($instance['instagram'])) { $instance['instagram'] = ''; }
    if (!isset($instance['googleplus'])) { $instance['googleplus'] = ''; }
    if (!isset($instance['flickr'])) { $instance['flickr'] = ''; }
    if (!isset($instance['vimeo'])) { $instance['vimeo'] = ''; }
    if (!isset($instance['youtube'])) { $instance['youtube'] = ''; }
    if (!isset($instance['pinterest'])) { $instance['pinterest'] = ''; }
    if (!isset($instance['dribbble'])) { $instance['dribbble'] = ''; }
    if (!isset($instance['linkedin'])) { $instance['linkedin'] = ''; }
    if (!isset($instance['tumblr'])) { $instance['tumblr'] = ''; }
    if (!isset($instance['stumbleupon'])) { $instance['stumbleupon'] = ''; }
    if (!isset($instance['vk'])) { $instance['vk'] = ''; }
    if (!isset($instance['viadeo'])) { $instance['viadeo'] = ''; }

    if (!isset($instance['rss'])) { $instance['rss'] = ''; }

    echo $before_widget;
    if ($title) {
      echo $before_title;
      echo $title;
      echo $after_title;
    }
  ?>
    <div class="kadence_social_widget clearfix">
      
<?php if(!empty($instance['facebook'])):?><a href="<?php echo esc_url($instance['facebook']); ?>" class="facebook_link" title="Facebook" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Facebook"><i class="kt-icon-facebook3"></i></a><?php endif;?>
<?php if(!empty($instance['twitter'])):?><a href="<?php echo esc_url($instance['twitter']); ?>" class="twitter_link" title="Twitter" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Twitter"><i class="kt-icon-twitter2"></i></a><?php endif;?>
<?php if(!empty($instance['instagram'])):?><a href="<?php echo esc_url($instance['instagram']); ?>" class="instagram_link" title="Instagram" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Instagram"><i class="kt-icon-instagram"></i></a><?php endif;?>
<?php if(!empty($instance['googleplus'])):?><a href="<?php echo esc_url($instance['googleplus']); ?>" class="googleplus_link" rel="publisher" title="GooglePlus" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="GooglePlus"><i class="kt-icon-googleplus2"></i></a><?php endif;?>
<?php if(!empty($instance['flickr'])):?><a href="<?php echo esc_url($instance['flickr']); ?>" class="flickr_link" title="Flickr" data-toggle="tooltip" target="_blank" data-placement="top" data-original-title="Flickr"><i class="kt-icon-flickr2"></i></a><?php endif;?>
<?php if(!empty($instance['vimeo'])):?><a href="<?php echo esc_url($instance['vimeo']); ?>" class="vimeo_link" title="Vimeo" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Vimeo"><i class="kt-icon-vimeo"></i></a><?php endif;?>
<?php if(!empty($instance['youtube'])):?><a href="<?php echo esc_url($instance['youtube']); ?>" class="youtube_link" title="YouTube" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="YouTube"><i class="kt-icon-youtube"></i></a><?php endif;?>
<?php if(!empty($instance['pinterest'])):?><a href="<?php echo esc_url($instance['pinterest']); ?>" class="pinterest_link" title="Pinterest" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Pinterest"><i class="kt-icon-pinterest"></i></a><?php endif;?>
<?php if(!empty($instance['dribbble'])):?><a href="<?php echo esc_url($instance['dribbble']); ?>" class="dribbble_link" title="Dribbble" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Dribbble"><i class="kt-icon-dribbble2"></i></a><?php endif;?>
<?php if(!empty($instance['linkedin'])):?><a href="<?php echo esc_url($instance['linkedin']); ?>" class="linkedin_link" title="LinkedIn" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="LinkedIn"><i class="kt-icon-linkedin2"></i></a><?php endif;?>
<?php if(!empty($instance['tumblr'])):?><a href="<?php echo esc_url($instance['tumblr']); ?>" class="tumblr_link" title="Tumblr" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Tumblr"><i class="kt-icon-tumblr2"></i></a><?php endif;?>
<?php if(!empty($instance['stumbleupon'])):?><a href="<?php echo esc_url($instance['stumbleupon']); ?>" class="stumbleupon_link" title="StumbleUpon" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="StumbleUpon"><i class="kt-icon-stumbleupon"></i></a><?php endif;?>
<?php if(!empty($instance['vk'])):?><a href="<?php echo esc_url($instance['vk']); ?>" class="vk_link" title="VK" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="VK"><i class="kt-icon-vk"></i></a><?php endif;?>
<?php if(!empty($instance['viadeo'])):?><a href="<?php echo esc_url($instance['viadeo']); ?>" class="viadeo_link" title="Viadeo" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Viadeo"><i class="kt-icon-icon-viadeo"></i></a><?php endif;?>
<?php if(!empty($instance['xing'])):?><a href="<?php echo esc_url($instance['xing']); ?>" class="xing_link" title="Xing" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Xing"><i class="kt-icon-xing"></i></a><?php endif;?>
<?php if(!empty($instance['rss'])):?><a href="<?php echo esc_url($instance['rss']); ?>" class="rss_link" title="RSS" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="RSS"><i class="kt-icon-feed"></i></a><?php endif;?>
    </div>
  <?php
    echo $after_widget;

  }

  public function update($new_instance, $old_instance) {
    $instance = $old_instance;
     $instance['title'] = strip_tags($new_instance['title']);
    $instance['facebook'] = strip_tags($new_instance['facebook']);
    $instance['twitter'] = strip_tags($new_instance['twitter']);
    $instance['instagram'] = strip_tags($new_instance['instagram']);
    $instance['googleplus'] = strip_tags($new_instance['googleplus']);
    $instance['flickr'] = strip_tags($new_instance['flickr']);
    $instance['vimeo'] = strip_tags($new_instance['vimeo']);
    $instance['youtube'] = strip_tags($new_instance['youtube']);
    $instance['pinterest'] = strip_tags($new_instance['pinterest']);
    $instance['dribbble'] = strip_tags($new_instance['dribbble']);
    $instance['linkedin'] = strip_tags($new_instance['linkedin']);
    $instance['tumblr'] = strip_tags($new_instance['tumblr']);
    $instance['stumbleupon'] = strip_tags($new_instance['stumbleupon']);
    $instance['vk'] = strip_tags($new_instance['vk']);
    $instance['viadeo'] = strip_tags($new_instance['viadeo']);
    $instance['xing'] = strip_tags($new_instance['xing']);
    $instance['rss'] = strip_tags($new_instance['rss']);

    return $instance;
  }
  public function form($instance) {
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $facebook = isset($instance['facebook']) ? esc_attr($instance['facebook']) : '';
    $twitter = isset($instance['twitter']) ? esc_attr($instance['twitter']) : '';
    $instagram = isset($instance['instagram']) ? esc_attr($instance['instagram']) : '';
    $googleplus = isset($instance['googleplus']) ? esc_attr($instance['googleplus']) : '';
    $flickr = isset($instance['flickr']) ? esc_attr($instance['flickr']) : '';
    $vimeo = isset($instance['vimeo']) ? esc_attr($instance['vimeo']) : '';
    $youtube = isset($instance['youtube']) ? esc_attr($instance['youtube']) : '';
    $pinterest = isset($instance['pinterest']) ? esc_attr($instance['pinterest']) : '';
    $dribbble = isset($instance['dribbble']) ? esc_attr($instance['dribbble']) : '';
    $linkedin = isset($instance['linkedin']) ? esc_attr($instance['linkedin']) : '';
    $tumblr = isset($instance['tumblr']) ? esc_attr($instance['tumblr']) : '';
    $stumbleupon = isset($instance['stumbleupon']) ? esc_attr($instance['stumbleupon']) : '';
    $vk = isset($instance['vk']) ? esc_attr($instance['vk']) : '';
    $viadeo = isset($instance['viadeo']) ? esc_attr($instance['viadeo']) : '';
    $xing = isset($instance['xing']) ? esc_attr($instance['xing']) : '';
    $rss = isset($instance['rss']) ? esc_attr($instance['rss']) : '';
  ?>
  <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php _e('Facebook:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php _e('Twitter:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php _e('Instagram:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_attr($instagram); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('googleplus')); ?>"><?php _e('GooglePlus:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('googleplus')); ?>" name="<?php echo esc_attr($this->get_field_name('googleplus')); ?>" type="text" value="<?php echo esc_attr($googleplus); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('flickr')); ?>"><?php _e('Flickr:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('flickr')); ?>" name="<?php echo esc_attr($this->get_field_name('flickr')); ?>" type="text" value="<?php echo esc_attr($flickr); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('vimeo')); ?>"><?php _e('Vimeo:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('vimeo')); ?>" name="<?php echo esc_attr($this->get_field_name('vimeo')); ?>" type="text" value="<?php echo esc_attr($vimeo); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php _e('Youtube:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_attr($youtube); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php _e('Pinterest:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('dribbble')); ?>"><?php _e('Dribbble:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('dribbble')); ?>" name="<?php echo esc_attr($this->get_field_name('dribbble')); ?>" type="text" value="<?php echo esc_attr($dribbble); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php _e('Linkedin:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('tumblr')); ?>"><?php _e('Tumblr:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('tumblr')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr')); ?>" type="text" value="<?php echo esc_attr($tumblr); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('stumbleupon')); ?>"><?php _e('Stumbleupon:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('stumbleupon')); ?>" name="<?php echo esc_attr($this->get_field_name('stumbleupon')); ?>" type="text" value="<?php echo esc_attr($stumbleupon); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('vk')); ?>"><?php _e('VK:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('vk')); ?>" name="<?php echo esc_attr($this->get_field_name('vk')); ?>" type="text" value="<?php echo esc_attr($vk); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('viadeo')); ?>"><?php _e('Viadeo:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('viadeo')); ?>" name="<?php echo esc_attr($this->get_field_name('viadeo')); ?>" type="text" value="<?php echo esc_attr($viadeo); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('xing')); ?>"><?php _e('Xing:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('xing')); ?>" name="<?php echo esc_attr($this->get_field_name('xing')); ?>" type="text" value="<?php echo esc_attr($xing); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('rss')); ?>"><?php _e('RSS:', 'pinnacle'); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('rss')); ?>" name="<?php echo esc_attr($this->get_field_name('rss')); ?>" type="text" value="<?php echo esc_attr($rss); ?>" />
    </p>
  <?php
  }
}
/**
 * Kadence Recent_Posts widget class
 *  Just a rewite of wp recent post
 * 
 */
class kad_recent_posts_widget extends WP_Widget {

    private static $instance = 0;
    public function __construct() {
      $widget_ops = array('classname' => 'kadence_recent_posts', 'description' => __('This shows the most recent posts on your site with a thumbnail', 'pinnacle'));
      parent::__construct('kadence_recent_posts', __('Pinnacle: Recent Posts', 'pinnacle'), $widget_ops);
  }

  public function widget($args, $instance) {

    if ( ! isset( $args['widget_id'] ) )
      $args['widget_id'] = $this->id;

    ob_start();
    extract($args);

    $title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts', 'pinnacle') : $instance['title'], $instance, $this->id_base);
    if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
      $number = 10;

    $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'category_name' => $instance['thecate'], 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
    if ($r->have_posts()) :
?>
    <?php echo $before_widget; ?>
    <?php if ( $title ) echo $before_title . $title . $after_title; ?>
    <ul>
    <?php  while ($r->have_posts()) : $r->the_post(); ?>
    <li class="clearfix postclass">
        <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" class="recentpost_featimg">
          <?php global $post; if(has_post_thumbnail( $post->ID ) ) { 
            the_post_thumbnail( 'widget-thumb' ); 
          } else { 
            $image_url = pinnacle_img_placeholder_small();
            $image = aq_resize($image_url, 60, 60, true);
            if(empty($image)) { $image = $image_url; }
            echo '<img width="60" height="60" src="'.esc_attr($image).'" class="attachment-widget-thumb wp-post-image" alt="">'; } ?></a>
        <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" class="recentpost_title"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
        <span class="recentpost_date color_gray"><?php echo get_the_date(get_option( 'date_format' )); ?></span>
        </li>
    <?php endwhile; ?>
    </ul>
    <?php echo $after_widget; ?>
<?php
    // Reset the global $the_post as this query will have stomped on it
    wp_reset_postdata();

    endif;
  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number'] = (int) $new_instance['number'];
    $instance['thecate'] = $new_instance['thecate'];

    return $instance;
  }

  public function form( $instance ) {
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $number = isset($instance['number']) ? absint($instance['number']) : 5;
    if (isset($instance['thecate'])) { $thecate = esc_attr($instance['thecate']); } else {$thecate = '';}
     $categories= get_categories();
     $cate_options = array();
          $cate_options[] = '<option value="">All</option>';
 
    foreach ($categories as $cate) {
      if ($thecate==$cate->slug) { $selected=' selected="selected"';} else { $selected=""; }
      $cate_options[] = '<option value="' . $cate->slug .'"' . $selected . '>' . $cate->name . '</option>';
    }

?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'pinnacle'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'pinnacle'); ?></label>
    <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
        <p>
    <label for="<?php echo $this->get_field_id('thecate'); ?>"><?php _e('Limit to Catagory (Optional):', 'pinnacle'); ?></label>
    <select id="<?php echo $this->get_field_id('thecate'); ?>" name="<?php echo $this->get_field_name('thecate'); ?>"><?php echo implode('', $cate_options); ?></select>
  </p>
<?php
  }
}

/**
 * Kadence Testimonial_slider widget class
 *  Just a rewite of wp recent post
 * 
 */
class kad_testimonial_slider_widget extends WP_Widget {

    private static $instance = 0;
    public function __construct() {
      $widget_ops = array('classname' => 'kadence_testimonials_slider', 'description' => __('This shows a slider with your testimonials', 'pinnacle'));
      parent::__construct('kadence_testimonials_slider', __('Pinnacle: Testimonial Carousel', 'pinnacle'), $widget_ops);
  }

  public function widget($args, $instance) {
    if ( ! isset( $args['widget_id'] ) )
      $args['widget_id'] = $this->id;

    ob_start();
    extract($args);
    $carousel_rn = (rand(10,100));
    $title = apply_filters('widget_title', empty($instance['title']) ? __('Testimonials', 'pinnacle') : $instance['title'], $instance, $this->id_base);
    if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
      $number = 10;
    if ( empty( $instance['wordcount'] ) || ! $wordcount = absint( $instance['wordcount'] ) )
      $wordcount = 25;
    if(isset($instance['orderby'])) {$testorder = $instance['orderby'];} else {$testorder = 'rand';}
    if(isset($instance['columns'])) {$columns = $instance['columns'];} else {$columns = '1';}
    if(!empty($instance['link'])) {$link = $instance['link'];} else {$link = false;}
    if(!empty($instance['linktext'])) {$linktext = $instance['linktext'];} else {$linktext = '';}
    if(!empty($instance['pagelink'])) {$pagelink = $instance['pagelink'];} else {$pagelink = '';}
    if(!empty($instance['speed'])) {$speed = $instance['speed'];} else {$speed = '11000';}
    if(!empty($instance['test_bg_color'])) {$test_bg_color = $instance['test_bg_color'];} else {$test_bg_color = '#ffffff';}
    if(!empty($instance['test_color'])) {$test_color = 'color:'.$instance['test_color'];} else {$test_color = 'color: #444444';}
    if(!empty($instance['test_title_color'])) {$test_title_color = 'color:'.$instance['test_title_color']; $test_title_color_bg = 'background-color:'.$instance['test_title_color'];} else {$test_title_color = 'color: #444444'; $test_title_color_bg = 'background-color:#4444;';}
    if(!empty($instance['test_bg_opacity'])) {$test_bg_opacity = $instance['test_bg_opacity'];} else {$test_bg_opacity = '1';}
    if(empty($instance['scroll']) || $instance['scroll'] == 1) {$scroll = 'items:1,';} else {$scroll = '';}
    $bg_color_rgb = kt_hex2rgb($test_bg_color);
    $bg_color = 'background: rgba('.$bg_color_rgb[0].', '.$bg_color_rgb[1].', '.$bg_color_rgb[2].', '.$test_bg_opacity.');';
    $border_color = 'border-top-color: rgba('.$bg_color_rgb[0].', '.$bg_color_rgb[1].', '.$bg_color_rgb[2].', '.$test_bg_opacity.');'; 
    if ($columns == '2') {$itemsize = 'tcol-lg-6 tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 560; $slideheight = 560; $md = 2; $sm = 2; $xs = 1; $ss = 1;} 
    else if ($columns == '1') {$itemsize = 'tcol-lg-12 tcol-md-12 tcol-sm-12 tcol-xs-12 tcol-ss-12'; $slidewidth = 560; $slideheight = 560; $md = 1; $sm = 1; $xs = 1; $ss = 1;} 
    else if ($columns == '3'){ $itemsize = 'tcol-lg-4 tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 366; $slideheight = 366; $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
    else if ($columns == '6'){ $itemsize = 'tcol-lg-2 tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 240; $slideheight = 240; $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
    else if ($columns == '5'){ $itemsize = 'tcol-lg-25 tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 240; $slideheight = 240; $md = 5; $sm = 4; $xs = 3; $ss = 2;} 
    else {$itemsize = 'tcol-lg-3 tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 269; $slideheight = 269; $md = 4; $sm = 3; $xs = 2; $ss = 1;} 
    $widget_title_style = '<style type="text/css">#testimonial-c-case-'.$carousel_rn.' .widget-title {'.$test_title_color.'} #testimonial-c-case-'.$carousel_rn.' .widget-title:after {'.$test_title_color_bg.'}</style>';
    $r = new WP_Query( apply_filters('widget_posts_args', array( 
    'post_type' => 'testimonial', 
    'testimonial-group' => $instance['thecat'], 
    'no_found_rows' => true, 
    'posts_per_page' => $number,
    'orderby' => $testorder, 
    'post_status' => 'publish', 
    'ignore_sticky_posts' => true ) ) );
    if ($r->have_posts()) :
?>
    <?php echo $before_widget; ?>
    <?php echo $widget_title_style;?>
    <div id="testimonial-c-case-<?php echo $carousel_rn;?>">
    <?php if ( $title ) echo $before_title . $title . $after_title; ?>
        <div class="fredcarousel">
          <div id="carouselcontainer-<?php echo $carousel_rn;?>" class="rowtight kt-testimonail-carousel">
          <div id="testimonial-carousel-<?php echo $carousel_rn;?>" class="kad-testimonial-carousel">
            <?php  while ($r->have_posts()) : $r->the_post(); ?>
            <div class="<?php echo $itemsize;?> t_item">
              <div class="grid_item testimonial_item all">
                <div class="testimonialbox clearfix" style="<?php echo $bg_color;?> <?php echo $test_color;?>">
                <?php global $post; ?>
                  <?php echo esc_attr(strip_tags(pinnacle_content($wordcount))); ?>
                  <?php if(isset($link) && $link == 'page') {
                                    if(!empty($pagelink)) {$thepagelink = $pagelink;} else {$thepagelink = get_the_permalink();}
                                    echo '<a href="'.$thepagelink.'" class="kadtestimoniallink testpagelink">';
                                    if(!empty($linktext)) $thelinktext = $linktext; else {$thelinktext = __('Read More', 'virtue');}
                                    echo $thelinktext;
                                    echo '</a>';
                                  
                                  } else if(isset($link) && $link == 'post'){ 
                                    echo '<a href="'.get_the_permalink().'" class="kadtestimoniallink">';
                                    if(!empty($linktext)) $thelinktext = $linktext; else {$thelinktext = __('Read More', 'virtue');}
                                    echo $thelinktext;
                                    echo '</a>';

                                  } ?>
                </div>
                <div class="testimonialbottom">
                <div class="lipbg kad-arrow-down" style="<?php echo $border_color;?>"></div>
                <p style="<?php echo $test_title_color;?>"><strong><?php the_title();?></strong>
                <?php $location = get_post_meta( $post->ID, '_kad_testimonial_location', true ); if($location != '') { echo ' - ' . $location;} ?>
                </p>
                </div> <!--testimonial bottom -->
              </div> <!-- grid item -->
            </div> <!--itemsize -->
      <?php endwhile; ?>
        </div>
      </div>
        <div class="clearfix"></div>
        <a class="prev kt-icon-arrow-left test-prev" id="prevport-<?php echo $carousel_rn; ?>" style="<?php echo $bg_color;?> <?php echo $test_color;?>" href="#"></a>
        <a class="next kt-icon-arrow-right test-next" id="nextport-<?php echo $carousel_rn; ?>" style="<?php echo $bg_color;?> <?php echo $test_color;?>" href="#"></a>
    </div>
    <script type="text/javascript"> jQuery( window ).load(function () {var $wcontainer = jQuery('#carouselcontainer-<?php echo $carousel_rn; ?>'); var $container = jQuery('#testimonial-carousel-<?php echo $carousel_rn; ?>'); 
          function ini_testCarousel() {
            $container.carouFredSel({scroll: { <?php echo $scroll; ?> easing: "swing", duration: 700, pauseOnHover : true}, auto: {play: true, timeoutDuration: <?php echo $speed; ?>},prev: '#prevport-<?php echo $carousel_rn; ?>', next: '#nextport-<?php echo $carousel_rn; ?>', pagination: false, swipe: true, items: {visible: null}});
          }
          setWidths();
          ini_testCarousel();
          jQuery(window).on("debouncedresize", function( event ) { $container.trigger("destroy"); setWidths(); ini_testCarousel();});
          $wcontainer.animate({'opacity' : 1});
          function getUnitWidth() {var width;
          if(jQuery(window).width() <= 480) {
          width = $wcontainer.width() / <?php echo $ss;?>;
          } else if(jQuery(window).width() <= 768) {
          width = $wcontainer.width() / <?php echo $xs;?>;
          } else if(jQuery(window).width() <= 990) {
          width = $wcontainer.width() / <?php echo $sm;?>;
          } else {
          width = $wcontainer.width() / <?php echo $md;?>;
          }
          return width;
          }
          function setWidths() {
          var unitWidth = getUnitWidth() -1;
          $container.children().css({ width: unitWidth });
          } });
      </script>
      </div>      
    <?php echo $after_widget; ?>
<?php
    // Reset the global $the_post as this query will have stomped on it
    wp_reset_postdata();

    endif;

  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number'] = (int) $new_instance['number'];
    $instance['wordcount'] = (int) $new_instance['wordcount'];
    $instance['thecat'] = $new_instance['thecat'];
    $instance['test_bg_color'] = $new_instance['test_bg_color'];
    $instance['test_title_color'] = $new_instance['test_title_color'];
    $instance['test_color'] = $new_instance['test_color'];
    $instance['test_bg_opacity'] = $new_instance['test_bg_opacity'];
    $instance['linktext'] = $new_instance['linktext'];
    $instance['link'] = $new_instance['link'];
    $instance['pagelink'] = $new_instance['pagelink'];
    $instance['orderby'] = $new_instance['orderby'];
    $instance['columns'] = $new_instance['columns'];
    $instance['speed'] = (int) $new_instance['speed'];

    return $instance;
  }


  public function form( $instance ) {
    
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $number = isset($instance['number']) ? absint($instance['number']) : 5;
    $wordcount = isset($instance['wordcount']) ? absint($instance['wordcount']) : 25;
    $speed = isset($instance['speed']) ? esc_attr($instance['speed']) : '';
    $test_color = isset($instance['test_color']) ? esc_attr($instance['test_color']) : '#444444';
    $test_title_color = isset($instance['test_title_color']) ? esc_attr($instance['test_title_color']) : '#444444';
    $test_bg_color = isset($instance['test_bg_color']) ? esc_attr($instance['test_bg_color']) : '#ffffff';
    if (isset($instance['test_bg_opacity'])) { $test_bg_opacity = $instance['test_bg_opacity']; } else {$test_bg_opacity = '1.0';}
    if (isset($instance['link'])) { $link = esc_attr($instance['link']); } else {$link = 'none';}
    if (isset($instance['pagelink'])) { $pagelink = esc_attr($instance['pagelink']); } else {$pagelink = '';}
    $linktext = isset($instance['linktext']) ? esc_attr($instance['linktext']) : '';
    if (isset($instance['orderby'])) { $orderby = esc_attr($instance['orderby']); } else {$orderby = 'random';}
    if (isset($instance['columns'])) { $columns = esc_attr($instance['columns']); } else {$columns = '1';}
    $linkoptions = array(array('name' => __('none', 'virtue'), 'slug' => 'false'), array('name' => __('Page Link', 'virtue'), 'slug' => 'page'), array('name' => __('Post Link', 'virtue'), 'slug' => 'post'));
    $orderoptions = array(array('name' => 'Random', 'slug' => 'rand'), array('name' => 'Menu Order', 'slug' => 'menu_order'), array('name' => 'Date', 'slug' => 'date'));
    $opacityoptions = array(array('name' => '1.0', 'slug' => '1.0'),array('name' => '0.9', 'slug' => '0.9'),array('name' => '0.8', 'slug' => '0.8'),array('name' => '0.7', 'slug' => '0.7'),array('name' => '0.6', 'slug' => '0.6'),array('name' => '0.5', 'slug' => '0.5'),array('name' => '0.4', 'slug' => '0.4'),array('name' => '0.3', 'slug' => '0.3'),array('name' => '0.2', 'slug' => '0.2'),array('name' => '0.1', 'slug' => '0.1'),array('name' => '0.0', 'slug' => '0.0') );
    $testimonial_columns_options = array(array("slug" => "1", "name" => __('1 Column', 'pinnacle')), array("slug" => "2", "name" => __('2 Columns', 'pinnacle')), array("slug" => "3", "name" => __('3 Columns', 'pinnacle')), array("slug" => "4", "name" => __('4 Columns', 'pinnacle')), array("slug" => "5", "name" => __('5 Columns', 'pinnacle')), array("slug" => "6", "name" => __('6 Columns', 'pinnacle')));
     foreach ($testimonial_columns_options as $testimonial_column_option) {
      if ($columns == $testimonial_column_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $testimonial_columns_array[] = '<option value="' . $testimonial_column_option['slug'] .'"' . $selected . '>' . $testimonial_column_option['name'] . '</option>';
    }
    $order_options = array();
    foreach ($orderoptions as $ooption) {
      if ($orderby==$ooption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $order_options[] = '<option value="' . $ooption['slug'] .'"' . $selected . '>' . $ooption['name'] . '</option>';
    }
    $opacity_options = array();
    foreach ($opacityoptions as $opacityoption) {
      if ($test_bg_opacity == $opacityoption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $opacity_options[] = '<option value="' . $opacityoption['slug'] .'"' . $selected . '>' . $opacityoption['name'] . '</option>';
    }
    $link_options = array();
    foreach ($linkoptions as $loption) {
      if ($link==$loption['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $link_options[] = '<option value="' . $loption['slug'] .'"' . $selected . '>' . $loption['name'] . '</option>';
    }
    $pages = get_pages();
     $pagelink_options = array();
     foreach ($pages as $poption) {
      if ($pagelink == get_page_link( $poption->ID )) { $selected=' selected="selected"';} else { $selected=""; }
      $pagelink_options[] = '<option value="' . get_page_link( $poption->ID ) .'"' . $selected . '>' . $poption->post_title . '</option>';
    }
    if (isset($instance['thecat'])) { $thecat = esc_attr($instance['thecat']); }
     $categories= get_terms('testimonial-group');
     $cat_options = array();
          $cat_options[] = '<option value="">All</option>';
 
    foreach ($categories as $cat) {
      if ($thecat==$cat->slug) { $selected=' selected="selected"';} else { $selected=""; }
      $cat_options[] = '<option value="' . $cat->slug .'"' . $selected . '>' . $cat->name . '</option>';
    }

?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'pinnacle'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:', 'pinnacle'); ?></label>
    <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('wordcount'); ?>"><?php _e('Number of words to show:', 'pinnacle'); ?></label>
    <input id="<?php echo $this->get_field_id('wordcount'); ?>" name="<?php echo $this->get_field_name('wordcount'); ?>" type="text" value="<?php echo $wordcount; ?>" size="3" /></p>
    <p>
    <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', 'pinnacle'); ?></label>
    <select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>"><?php echo implode('', $order_options); ?></select>
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('thecat'); ?>"><?php _e('Limit to Group (Optional):', 'pinnacle'); ?></label>
    <select id="<?php echo $this->get_field_id('thecat'); ?>" name="<?php echo $this->get_field_name('thecat'); ?>"><?php echo implode('', $cat_options); ?></select>
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e('Carousel Columns', 'pinnacle'); ?></label>
    <select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>"><?php echo implode('', $testimonial_columns_array); ?></select>
    </p>
    <p><label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e('Carousel Speed (e.g. = 7000)', 'pinnacle'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>" type="text" value="<?php echo $speed; ?>" />
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link Options:', 'virtue'); ?></label>
    <select id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>"><?php echo implode('', $link_options); ?></select>
    </p>
    <p>
    <label for="<?php echo $this->get_field_id('pagelink'); ?>"><?php _e('If link to page, choose page:', 'virtue'); ?></label>
    <select id="<?php echo $this->get_field_id('pagelink'); ?>" name="<?php echo $this->get_field_name('pagelink'); ?>"><?php echo implode('', $pagelink_options); ?></select>
    </p>
     <p><label for="<?php echo $this->get_field_id('linktext'); ?>"><?php _e('Link text (e.g. = Read More)', 'virtue'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('linktext'); ?>" name="<?php echo $this->get_field_name('linktext'); ?>" type="text" value="<?php echo $linktext; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('test_color'); ?>"><?php _e('Testimonial Text Color (e.g. = #444444)', 'pinnacle'); ?></label><br />
      <input type="text" class="widefat kad-widget-colorpicker" style="width: 70px;"  name="<?php echo $this->get_field_name('test_color'); ?>" id="<?php echo $this->get_field_id('test_color'); ?>" value="<?php echo $test_color; ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('test_title_color'); ?>"><?php _e('Testimonial Name Color (e.g. = #444444)', 'pinnacle'); ?></label><br />
      <input type="text" class="widefat kad-widget-colorpicker" style="width: 70px;"  name="<?php echo $this->get_field_name('test_title_color'); ?>" id="<?php echo $this->get_field_id('test_title_color'); ?>" value="<?php echo $test_title_color; ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('test_bg_color'); ?>"><?php _e('Testimonial Background Color (e.g. = #ffffff)', 'pinnacle'); ?></label><br />
      <input type="text" class="widefat kad-widget-colorpicker" style="width: 70px;"  name="<?php echo $this->get_field_name('test_bg_color'); ?>" id="<?php echo $this->get_field_id('test_bg_color'); ?>" value="<?php echo $test_bg_color; ?>">
    </p>
     <p>
    <label for="<?php echo $this->get_field_id('test_bg_opacity'); ?>"><?php _e('Background Opacity:', 'pinnacle'); ?></label>
    <select id="<?php echo $this->get_field_id('test_bg_opacity'); ?>" name="<?php echo $this->get_field_name('test_bg_opacity'); ?>"><?php echo implode('', $opacity_options); ?></select>
    </p>
  
<?php
  }
}
/**
 * Kadence Testimonial_slider widget class
 *  Just a rewite of wp recent post
 * 
 */
class kad_post_grid_widget extends WP_Widget {

    private static $instance = 0;
    public function __construct() {
      $widget_ops = array('classname' => 'kadence_image_grid', 'description' => __('This shows a grid of featured images from recent posts or portfolio items', 'pinnacle'));
      parent::__construct('kadence_image_grid', __('Pinnacle: Post Grid', 'pinnacle'), $widget_ops);
  }

  function widget($args, $instance) {

    if ( ! isset( $args['widget_id'] ) )
      $args['widget_id'] = $this->id;

    ob_start();
    extract($args);

    $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
    if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
      $number = 8; 
      echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title;
        
       switch ($instance['gridchoice']) {
      
        case "portfolio" :
        
          $r = new WP_Query( apply_filters('widget_posts_args', array( 
          'post_type' => 'portfolio', 
          'portfolio-type' => $instance['thetype'], 
          'no_found_rows' => true, 
          'posts_per_page' => $number, 
          'post_status' => 'publish', 
          'ignore_sticky_posts' => true ) ) );
          if ($r->have_posts()) :
          ?>        
          <div class="imagegrid-widget">
          <?php  while ($r->have_posts()) : $r->the_post(); ?>
          <?php global $post; if(has_post_thumbnail( $post->ID ) ) { ?> <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" class="imagegrid_item lightboxhover"><?php the_post_thumbnail( 'widget-thumb' ); ?>
          </a>
                    <?php } ?>
          <?php endwhile; ?>
          </div>
          <?php wp_reset_postdata(); endif;
                break;
                case "post":          
            $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'category_name' => $instance['thecat'], 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
            if ($r->have_posts()) : ?>
            <div class="imagegrid-widget">
          <?php  while ($r->have_posts()) : $r->the_post(); ?>
          
            <?php global $post; if(has_post_thumbnail( $post->ID ) ) { ?> <a href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>" class="imagegrid_item lightboxhover"><?php the_post_thumbnail( 'widget-thumb' ); ?></a><?php } ?>
          <?php endwhile; ?>
          </div>
          <?php wp_reset_postdata(); endif;
               break; 
       } ?>
             
             <div class="clearfix"></div>
      <?php echo $after_widget; ?>
        
<?php
  }

  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number'] = (int) $new_instance['number'];
    $instance['thecat'] = $new_instance['thecat'];
    $instance['thetype'] = $new_instance['thetype'];
    $instance['gridchoice'] = $new_instance['gridchoice'];

    return $instance;
  }

  public function form( $instance ) {
    
    $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
    $gridchoice = isset($instance['gridchoice']) ? esc_attr($instance['gridchoice']) : '';
    $number = isset($instance['number']) ? absint($instance['number']) : 6;
    if (isset($instance['thecat'])) { $thecat = esc_attr($instance['thecat']); } else {$thecat = '';}
    if (isset($instance['thetype'])) { $thetype = esc_attr($instance['thetype']); } else {$thetype = '';}
     $types= get_terms('portfolio-type');
     $type_options = array();
          $type_options[] = '<option value="">All</option>';
    if(!empty($types) && !is_wp_error($types) ) {
      foreach ($types as $type) {
        if ($thetype==$type->slug) { $selected=' selected="selected"';} else { $selected=""; }
        $type_options[] = '<option value="' . $type->slug .'"' . $selected . '>' . $type->name . '</option>';
      }
    }
     $categories= get_categories();
     $cat_options = array();
          $cat_options[] = '<option value="">All</option>';
 
    foreach ($categories as $cat) {
      if ($thecat==$cat->slug) { $selected=' selected="selected"';} else { $selected=""; }
      $cat_options[] = '<option value="' . $cat->slug .'"' . $selected . '>' . $cat->name . '</option>';
    }


?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'pinnacle'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

    <p><label for="<?php echo $this->get_field_id('gridchoice'); ?>"><?php _e('Grid Choice:','pinnacle'); ?></label>
        <select id="<?php echo $this->get_field_id('gridchoice'); ?>" name="<?php echo $this->get_field_name('gridchoice'); ?>">
            <option value="post"<?php echo ($gridchoice === 'post' ? ' selected="selected"' : ''); ?>><?php _e('Blog Posts', 'pinnacle'); ?></option>
            <option value="portfolio"<?php echo ($gridchoice === 'portfolio' ? ' selected="selected"' : ''); ?>><?php _e('Portfolio', 'pinnacle'); ?></option>
        </select></p>
        
        <p><label for="<?php echo $this->get_field_id('thecat'); ?>"><?php _e('If Post - Choose Category (Optional):', 'pinnacle'); ?></label>
    <select id="<?php echo $this->get_field_id('thecat'); ?>" name="<?php echo $this->get_field_name('thecat'); ?>"><?php echo implode('', $cat_options); ?></select></p>
        
    <p><label for="<?php echo $this->get_field_id('thetype'); ?>"><?php _e('If Portfolio - Choose Type (Optional):', 'pinnacle'); ?></label>
    <select id="<?php echo $this->get_field_id('thetype'); ?>" name="<?php echo $this->get_field_name('thetype'); ?>"><?php echo implode('', $type_options); ?></select></p>
        
        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of images to show:', 'pinnacle'); ?></label>
    <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
  
<?php
  }
}


class kad_image_widget extends WP_Widget{

      private static $instance = 0;
    public function __construct() {
        $widget_ops = array('classname' => 'kadence_simple_image', 'description' => __('This allows for an image and a simple about text.', 'pinnacle'));
        parent::__construct('kadence_simple_image', __('Pinnacle: Image', 'pinnacle'), $widget_ops);
    }

    public function widget($args, $instance){ 
        extract( $args );
        if (!empty($instance['image_link_open']) && $instance['image_link_open'] == "none") {
          $uselink = false;
          $link = '';
          $linktype = '';
        } else if(empty($instance['image_link_open']) || $instance['image_link_open'] == "lightbox") {
          $uselink = true;
          $link = esc_url($instance['image_uri']);
          $linktype = 'rel="lightbox"';
        } else if($instance['image_link_open'] == "_blank") {
          $uselink = true;
          if(!empty($instance['image_link'])) {$link = $instance['image_link'];} else {$link = esc_url($instance['image_uri']);}
          $linktype = 'target="_blank"';
        } else if($instance['image_link_open'] == "_self") {
          $uselink = true;
          if(!empty($instance['image_link'])) {$link = $instance['image_link'];} else {$link = esc_url($instance['image_uri']);}
          $linktype = 'target="_self"';
        }
        if(!empty($instance['image_id'])) {
          $alt = esc_attr( get_post_meta($instance['image_id'], '_wp_attachment_image_alt', true) );
        } else {
          $alt = '';
        }
    ?>
     <?php echo $before_widget; ?>
    <div class="kad_img_upload_widget">
        <?php if($uselink == true) {echo '<a href="'.$link.'" '.$linktype.'>';} ?>
        <img src="<?php echo esc_url($instance['image_uri']); ?>" alt="<?php echo esc_attr($alt);?>"/>
        <?php if($uselink == true) {echo '</a>'; }?>
        <?php if(!empty($instance['text'])) { ?> <p class="kadence_image_widget_caption"><?php echo $instance['text']; ?></p><?php }?>
    </div>

    <?php echo $after_widget; ?>
    <?php }

    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['text'] = strip_tags( $new_instance['text'] );
        $instance['image_uri'] = strip_tags( $new_instance['image_uri'] );
        $instance['image_id'] = $new_instance['image_id'];
        $instance['image_link'] = $new_instance['image_link'];
        $instance['image_link_open'] = $new_instance['image_link_open'];
        return $instance;
    }

  public function form($instance){ 
    $image_uri = isset($instance['image_uri']) ? esc_attr($instance['image_uri']) : '';
    $image_id = isset($instance['image_id']) ? esc_attr($instance['image_id']) : '';
    $image_link = isset($instance['image_link']) ? esc_attr($instance['image_link']) : '';
    if (isset($instance['image_link_open'])) { $image_link_open = esc_attr($instance['image_link_open']); } else {$image_link_open = 'lightbox';}
    $link_options = array();
    $link_options_array = array();
    $link_options[] = array("slug" => "lightbox", "name" => __('Lightbox', 'pinnacle'));
    $link_options[] = array("slug" => "_blank", "name" => __('New Window', 'pinnacle'));
    $link_options[] = array("slug" => "_self", "name" => __('Same Window', 'pinnacle'));
    $link_options[] = array("slug" => "none", "name" => __('No Link', 'pinnacle'));

    foreach ($link_options as $link_option) {
      if ($image_link_open == $link_option['slug']) { $selected=' selected="selected"';} else { $selected=""; }
      $link_options_array[] = '<option value="' . $link_option['slug'] .'"' . $selected . '>' . $link_option['name'] . '</option>';
    }
    ?>
  <div class="kad_img_upload_widget">
    <p>
        <img class="kad_custom_media_image" src="<?php if(!empty($instance['image_uri'])){echo $instance['image_uri'];} ?>" style="margin:0;padding:0;max-width:100px;display:block" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e('Image URL', 'pinnacle'); ?></label><br />
        <input type="text" class="widefat kad_custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $image_uri; ?>">
        <input type="hidden" value="<?php echo $image_id; ?>" class="kad_custom_media_id" name="<?php echo $this->get_field_name('image_id'); ?>" id="<?php echo $this->get_field_id('image_id'); ?>" />
        <input type="button" value="<?php _e('Upload', 'pinnacle'); ?>" class="button kad_custom_media_upload" id="kad_custom_image_uploader" />
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('image_link_open'); ?>"><?php _e('Image opens in', 'pinnacle'); ?></label><br />
        <select id="<?php echo $this->get_field_id('image_link_open'); ?>" name="<?php echo $this->get_field_name('image_link_open'); ?>"><?php echo implode('', $link_options_array);?></select>
    </p>
    <p>
        <label for="<?php echo $this->get_field_id('image_link'); ?>"><?php _e('Image Link (optional)', 'pinnacle'); ?></label><br />
        <input type="text" class="widefat kad_img_widget_link" name="<?php echo $this->get_field_name('image_link'); ?>" id="<?php echo $this->get_field_id('image_link'); ?>" value="<?php echo $image_link; ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Text/Caption (optional)', 'pinnacle'); ?></label><br />
      <textarea name="<?php echo $this->get_field_name('text'); ?>" id="<?php echo $this->get_field_id('text'); ?>" class="widefat" ><?php if(!empty($instance['text'])) echo $instance['text']; ?></textarea>
    </p>
  </div>
    <?php
  }


}
