<?php 
function pinnacle_prebuilt_page_layouts($layouts){
  $layouts['home-page'] = array (
    'name'        => __('Example Home', 'pinnacle'),
    'description' => __('A basic home layout with pagebuilder', 'pinnacle'),
    'widgets'     =>
          array(
              0 =>
                array(
                  'title'         => 'Winter Clothing Specials',
                  'description'   => "Shop Here",
                  'height'        => '220',
                  'link'          => '#',
                  'image_uri'     => get_template_directory_uri() . '/assets/img/img_menu_01.jpg',
                  'target'        => '',
                  'info'          =>
                                  array(
                                    'class'   => 'kad_imgmenu_widget',
                                    'id'      => '1',
                                    'grid'    => '0',
                                    'cell'    => '0',
                                  ),
                ),
              1 =>
                array(
                  'title'         => 'A Collection of Macro Photos',
                  'description'   => "View Here",
                  'height'        => '220',
                  'link'          => '#',
                  'image_uri'     => get_template_directory_uri() . '/assets/img/img_menu_02.jpg',
                  'target'        => '',
                  'info'          =>
                                  array(
                                    'class'   => 'kad_imgmenu_widget',
                                    'id'      => '2',
                                    'grid'    => '0',
                                    'cell'    => '0',
                                  ),
                ),
              2 =>
                array(
                  'title'         => 'Our Latest Coffee Recipes',
                  'description'   => "Read Here",
                  'height'        => '220',
                  'link'          => '#',
                  'image_uri'     => get_template_directory_uri() . '/assets/img/img_menu_03.jpg',
                  'target'        => '',
                  'info'          =>
                                  array(
                                    'class'   => 'kad_imgmenu_widget',
                                    'id'      => '3',
                                    'grid'    => '0',
                                    'cell'    => '1',
                                  ),
                ),
            3 =>
                array(
                  'title'         => 'Travel The World Blog',
                  'description'   => "View Here",
                  'height'        => '220',
                  'link'          => '#',
                  'image_uri'     => get_template_directory_uri() . '/assets/img/img_menu_04.jpg',
                  'target'        => '',
                  'info'          =>
                                  array(
                                    'class' => 'kad_imgmenu_widget',
                                    'id'    => '4',
                                    'grid'  => '0',
                                    'cell'  => '1',
                                  ),
                ),
            4 =>
                array(
                  'title'   => 'Key Features',
                  'text'    => '',
                  'info'    =>
                            array(
                              'class'   => 'WP_Widget_Text',
                              'id'      => '5',
                              'grid'    => '1',
                              'cell'    => '0',
                            ),
                ),
            5 =>
                array(
                  'image_uri'       => get_template_directory_uri() . '/assets/img/phone_mock.png',
                  'image_link'      => '',
                  'image_link_open' => 'none',
                  'text'            => '',
                  'info'            =>
                                    array(
                                      'class'   => 'kad_image_widget',
                                      'id'      => '6',
                                      'grid'    => '2',
                                      'cell'    => '0',
                                    ),
                ),
            6 =>
                  array(
                    'title'           => 'Responsive Design',
                    'description'     => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus placerat risus eu augue rutrum, eu elementum elit semper. Nam et hendrerit ex. Phasellus quis mi in ligula facilisis laoreet sit amet ut enim. Nam magna turpis, rutrum at finibus sed, luctus ut ex. Duis tempus pharetra lacus vitae luctus.",
                    'info_icon'       => 'kt-icon-phone',
                    'image_uri'       => '',
                    'size'            => '28',
                    'style'           => 'kad-circle-iconclass',
                    'color'           => '#ffffff',
                    'iconbackground'  => '#444444',
                    'background'      => '',
                    'link'            => '',
                    'info'            =>
                                      array(
                                        'class'   => 'kad_infobox_widget',
                                        'id'      => '7',
                                        'grid'    => '2',
                                        'cell'    => '1',
                                      ),
                  ),
            7 =>
                  array(
                    'title'           => 'Tons of Options',
                    'description'     => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus placerat risus eu augue rutrum, eu elementum elit semper. Nam et hendrerit ex. Phasellus quis mi in ligula facilisis laoreet sit amet ut enim. Nam magna turpis, rutrum at finibus sed, luctus ut ex. Duis tempus pharetra lacus vitae luctus.",
                    'info_icon'       => 'kt-icon-params',
                    'image_uri'       => '',
                    'size'            => '28',
                    'style'           => 'kad-circle-iconclass',
                    'color'           => '#ffffff',
                    'iconbackground'  => '#444444',
                    'background'      => '',
                    'link'            => '',
                    'info'            =>
                                      array(
                                        'class'   => 'kad_infobox_widget',
                                        'id'      => '8',
                                        'grid'    => '2',
                                        'cell'    => '1',
                                      ),
                  ),
            8 =>
                  array(
                    'title'           => 'Ecommerce Tools',
                    'description'     => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus placerat risus eu augue rutrum, eu elementum elit semper. Nam et hendrerit ex. Phasellus quis mi in ligula facilisis laoreet sit amet ut enim. Nam magna turpis, rutrum at finibus sed, luctus ut ex. Duis tempus pharetra lacus vitae luctus.",
                    'info_icon'       => 'kt-icon-shop',
                    'image_uri'       => '',
                    'size'            => '28',
                    'style'           => 'kad-circle-iconclass',
                    'color'           => '#ffffff',
                    'iconbackground'  => '#444444',
                    'background'      => '',
                    'link'            => '',
                    'info'            =>
                                      array(
                                        'class'   => 'kad_infobox_widget',
                                        'id'      => '9',
                                        'grid'    => '2',
                                        'cell'    => '1',
                                      ),
                  ),
            9 =>
                  array(
                    'title'       => 'Responsive Design. Powerful Options.',
                    'subtitle'    => 'And support thats got you covered.',
                    'btn_link'    => '#',
                    'btn_text'    => 'Buy Here',
                    'btn_target'  => '',
                    'align'       => 'center',
                    'tsize'       => '40',
                    'ssize'       => '20',
                    'tcolor'      => '#ffffff',
                    'scolor'      => '#ffffff',
                    'info'        =>
                                  array(
                                    'class'   => 'kad_calltoaction_widget',
                                    'id'      => '10',
                                    'grid'    => '3',
                                    'cell'    => '0',
                                  ),
                  ),
    ),
    'grids' =>
          array(
                0 =>
                    array(
                        'cells' => '2',
                        'style' => array(
                            'row_stretch'                 => 'full',
                            'background'                  => '#ffffff',
                            'background_image'            => '',
                            'background_image_position'   => '',
                            'background_image_style'      => '',
                            'padding_top'                 => '50px',
                            'padding_bottom'              => '50px',
                            'bottom_margin'               => '0px',
                      ),
                ),
                1 =>
                    array(
                      'cells' => '1',
                      'style' => array(
                            'row_stretch'     => 'full',
                            'background'      => '#f9f9f9',
                            'padding_top'     => '60px',
                            'padding_bottom'  => '1px',
                            'bottom_margin'   => '0px',
                      ),
                ),
                2 =>
                    array(
                      'cells' => '2',
                      'style' => array(
                            'row_stretch'     => 'full',
                            'background'      => '#f9f9f9',
                            'padding_top'     => '0px', 
                            'padding_bottom'  => '30px',
                            'bottom_margin'   => '0px',
                      ),
                ),
                3 =>
                    array(
                      'cells' => '1',
                      'style' => array(
                            'row_stretch'                 => 'full',
                            'background'                  => '#555555',
                            'padding_top'                 => '100px', 
                            'padding_bottom'              => '100px',
                            'bottom_margin'               => '0px',
                      ),
                ),
          ),
    'grid_cells' =>
          array(
                0 =>
                  array(
                    'weight'  => '0.50',
                    'grid'    => '0',
                  ),
                1 =>
                  array(
                    'weight'  => '0.50',
                    'grid'    => '0',
                  ),
                2 =>
                  array(
                    'weight'  => '1',
                    'grid'    => '1',
                  ),
                3 =>
                  array(
                    'weight'  => '0.50',
                    'grid'    => '2',
                  ),
                4 =>
                  array(
                    'weight'  => '0.50',
                    'grid'    => '2',
                  ),
                5 =>
                  array(
                    'weight'  => '1',
                    'grid'    => '3',
                  ),
          ),
  );

  return $layouts;
}
add_filter('siteorigin_panels_prebuilt_layouts', 'pinnacle_prebuilt_page_layouts');