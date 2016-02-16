<?php 
// pinnacle Shortcode Generator 

// Enqueue scripts

function kad_shortcode_button_scripts(){
	 wp_enqueue_media();
  	wp_enqueue_script('kadwidget_upload', get_template_directory_uri() . '/assets/js/min/widget_upload.min.js');
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style('kad-shortcode-css', get_template_directory_uri() . '/lib/kad_shortcodes/css/kad-short-pop.css'); 
	wp_enqueue_script('kad_shortcode',get_template_directory_uri() . '/lib/kad_shortcodes/js/min/kad_shortcode_pop.min.js',array( 'jquery', 'wp-color-picker' ),'1.3.0 ', TRUE);
}

add_action('admin_enqueue_scripts','kad_shortcode_button_scripts');

add_action('admin_footer','kad_shortcode_content');

function kadence_shortcode_option( $name, $attr_option, $shortcode ){
	
	$kad_option_element = null;
	
	(isset($attr_option['desc']) && !empty($attr_option['desc'])) ? $desc = '<p class="description">'.$attr_option['desc'].'</p>' : $desc = '';
	
		
	switch( $attr_option['type'] ){
		
		case 'radio':
	    
		$kad_option_element .= '<div class="label"><strong>'.$attr_option['title'].': </strong></div><div class="content">';
	    foreach( $attr_option['values'] as $val => $title ){
	    
		(isset($attr_option['def']) && !empty($attr_option['def'])) ? $def = $attr_option['def'] : $def = '';
		
		 $kad_option_element .= '
			<label for="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'">'.$title.'</label>
		    <input class="attr" type="radio" data-attrname="'.$name.'" name="'.$shortcode.'-'.$name.'" value="'.$val.'" id="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'"'. ( $val == $def ? ' checked="checked"':'').'>';
	    }
		
		$kad_option_element .= $desc . '</div>';
		
	    break;
	    case 'checkbox':
		
		$kad_option_element .= '<div class="label"><label for="' . $name . '"><strong>' . $attr_option['title'] . ': </strong></label></div>    <div class="content"> <input type="checkbox" class="' . $name . '" data-attrname="'.$name.'" id="' . $name . '" />'. $desc. '</div> ';
		
		break;
		case 'select':

		$kad_option_element .= '
		<div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		
		<div class="content"><select id="'.$name.'" class="kad-sc-select">';
			$values = $attr_option['values'];
			foreach( $values as $value => $vname ){
				if($value == $attr_option['default']) { $selected=' selected="selected"';} else { $selected=""; }
		    	$kad_option_element .= '<option value="'.$value.'" ' . $selected .'>'.$vname.'</option>';
			}
		$kad_option_element .= '</select>' . $desc . '</div>';

		break;
		case 'icon-select':

		$kad_option_element .= '
		<div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		
		<div class="content"><select id="'.$name.'" class="kad-icon-select">';
			$values = $attr_option['values'];
			foreach( $values as $value ){
		    	$kad_option_element .= '<option value="'.$value.'">'.$value.'</option>';
			}
		$kad_option_element .= '</select>' . $desc . '</div>';

		break;
		case 'color':
			
	           $kad_option_element .= '
	           <div class="label"><label><strong>'.$attr_option['title'].' </strong></label></div>
			   <div class="content"><input type="text" value="'. ( isset($attr_option['default']) ? $attr_option['default'] : "" ) . '" class="kad-popup-colorpicker" data-attrname="'.$name.'" style="width: 70px;" data-default-color="'. ( isset($attr_option['default']) ? $attr_option['default'] : "" ) . '"/>';
			   $kad_option_element .= $desc . '</div>';
		break;
		case 'textarea':
		$kad_option_element .= '
		<div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
		<div class="content"><textarea class="kad-sc-'.$name.'" data-attrname="'.$name.'"></textarea> ' . $desc . '</div>';
		break;
		case 'text':
		default:
		    $kad_option_element .= '
			<div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
			<div class="content"><input class="attr kad-sc-'.$name.' kt-short-textbox" type="text" data-attrname="'.$name.'" value="" />' . $desc . '</div>';
		break;
	}
	
	$kad_option_element .= '<div class="clear"></div>';
    
	
    return $kad_option_element;
}

function kad_shortcode_content(){

	//Columns
$pinnacle_shortcodes['columns'] = array( 
	'title'=>__('Columns', 'pinnacle'), 
	'attr'=>array(
		'columns'=>array(
			'type'=>'radio', 
			'title'=>__('Columns','pinnacle'),
			'values' => array(
				"span6" => '<img src="'. get_template_directory_uri().'/assets/img/twocolumn.jpg" />' . __("Two Columns", "pinnacle"),
				"span4right" => '<img src="'. get_template_directory_uri().'/assets/img/twocolumnright.jpg" />' . __("Two Columns offset Right", "pinnacle"),
				"span4left" => '<img src="'. get_template_directory_uri().'/assets/img/twocolumnleft.jpg" />' . __("Two Columns offset Left", "pinnacle"),
				"span4" => '<img src="'. get_template_directory_uri().'/assets/img/threecolumn.jpg" />' . __("Three Columns", "pinnacle"),
				"span3" => '<img src="'. get_template_directory_uri().'/assets/img/fourcolumn.jpg" />' . __("Four Columns", "pinnacle"),
				)
		),
	) 
);
	// Divider 
$pinnacle_shortcodes['hr'] = array( 
	'title'=>__('Divider', 'pinnacle'), 
	'attr'=>array(
		'style'=>array(
			'type'=>'select', 
			'title'=>__('Style', 'pinnacle'),
			'default' => 'line',
			'values' => array(
				"line" => __("Line", "pinnacle"),
				"dots" => __("Dots", "pinnacle"),
				"gradient" => __("Gradient", "pinnacle"),
				)
		),
		'size'=>array(
			'type'=>'select',
			'default' => '1px',
			'title'=>__('Size','pinnacle'),
			'values' => array(
				"1px" => "1px",
				"2px" => "2px",
				"3px" => "3px",
				"4px" => "4px",
				"5px" => "5px",
				)
		),
		'color'=>array(
			'type'=>'color', 
			'title'  => __('Color','pinnacle'),
		)
	) 
);
// Spacer
$pinnacle_shortcodes['space'] = array( 
	'title'=>__('Spacing', 'pinnacle'), 
	'attr'=>array(
		'size'=>array(
			'type'=>'select', 
			'title'=>__('Size','pinnacle'),
			'default' => '10px',
			'values' => array(
				"10px" => "10px",
				"20px" => "20px",
				"30px" => "30px",
				"40px" => "40px",
				"50px" => "50px",
				)
		)
	) 
);
// Spacer
$pinnacle_shortcodes['tabs'] = array( 
	'title'=>__('Tabs', 'pinnacle'), 
);
$pinnacle_shortcodes['accordion'] = array( 
	'title'=>__('Accordion', 'pinnacle'),
);
$pinnacle_shortcodes['pullquote'] = array( 
	'title'=>__('Pull-Quotes', 'pinnacle'), 
	'attr'=>array(
		'align'=>array(
			'type'=>'select', 
			'title'=>__('Align', 'pinnacle'),
			'default' => 'center',
			'values' => array(
				"center" => __('Center','pinnacle'),
				"left" => __('Left','pinnacle'),
				"right" => __('Right','pinnacle'),
				)
		),
		'content'=>array(
			'type'=>'textarea', 
			'title'=>__('Pull-Quote Text', 'pinnacle')
		)
	) 
);
$pinnacle_shortcodes['blockquote'] = array( 
	'title'=>__('Block-Quotes', 'pinnacle'), 
	'attr'=>array(
		'align'=>array(
			'type'=>'select', 
			'title'=>__('Align', 'pinnacle'),
			'default' => 'center',
			'values' => array(
				"center" => __('Center','pinnacle'),
				"left" => __('Left','pinnacle'),
				"right" => __('Right','pinnacle'),
				)
		),
		'content'=>array(
			'type'=>'textarea', 
			'title'=>__('Block-Quote Text', 'pinnacle')
		)
	) 
);
$pinnacle_shortcodes['kt_box'] = array( 
	'title'=>__('Simple Box', 'pinnacle'), 
	'attr'=>array(
		'padding_top'=>array(
			'type'=>'text', 
			'title'=>__('Padding Top (just a number)', 'pinnacle'),
			'default' => '15',
		),
		'padding_bottom'=>array(
			'type'=>'text', 
			'title'=>__('Padding Bottom (just a number)', 'pinnacle'),
			'default' => '15',
		),
		'padding_left'=>array(
			'type'=>'text', 
			'title'=>__('Padding Left (just a number)', 'pinnacle'),
			'default' => '15',
		),
		'padding_right'=>array(
			'type'=>'text', 
			'title'=>__('Padding Right (just a number)', 'pinnacle'),
			'default' => '15',
		),
		'min_height'=>array(
			'type'=>'text', 
			'title'=>__('Min Height (just a number)', 'pinnacle'),
			'default' => '0',
		),
		'background'=>array(
			'type'=>'color', 
			'title'  => __('Background Color','pinnacle'),
			'default' => '',
		),
		'opacity'=>array(
			'type'=>'select', 
			'title'=>__('Background Color Opacity', 'pinnacle'),
			'default' => '1',
			'values' => array(
				"1" => __('1.0','pinnacle'),
				"0.9" => __('0.9','pinnacle'),
				"0.8" => __('0.8','pinnacle'),
				"0.7" => __('0.7','pinnacle'),
				"0.6" => __('0.6','pinnacle'),
				"0.5" => __('0.5','pinnacle'),
				"0.4" => __('0.4','pinnacle'),
				"0.3" => __('0.3','pinnacle'),
				"0.2" => __('0.2','pinnacle'),
				"0.1" => __('0.1','pinnacle'),
				"0.0" => __('0.0','pinnacle'),
				)
		),
		'content'=>array(
			'type'=>'textarea', 
			'title'=>__('Content Text', 'pinnacle')
		)
	) 
);

$icons = kad_icon_list();
$btnicons = $icons;
array_unshift($btnicons, '"" => ""');
	//Button
$pinnacle_shortcodes['btn'] = array( 
	'title'=>__('Button', 'pinnacle'), 
	'attr'=>array(
		'text'=>array(
			'type'=>'text', 
			'title'=>__('Button Text', 'pinnacle')
		),
		'target'=>array(
			'type'=>'checkbox', 
			'title'=>__('Open Link In New Tab?','pinnacle')
		),
		'tcolor'=>array(
			'type'=>'color', 
			'title'  => __('Font Color','pinnacle'),
			'default' => '#ffffff',
		),
		'bcolor'=>array(
			'type'=>'color', 
			'title'  => __('Button Background Color','pinnacle'),
			'default' => '',
		),
		'bordercolor'=>array(
			'type'=>'color', 
			'title'  => __('Button Border Color','pinnacle'),
			'default' => '',
		),
		'thovercolor'=>array(
			'type'=>'color', 
			'title'  => __('Font Hover Color','pinnacle'),
			'default' => '#ffffff',
		),
		'bhovercolor'=>array(
			'type'=>'color', 
			'title'  => __('Button Background Hover Color','pinnacle'),
			'default' => '',
		),
		'borderhovercolor'=>array(
			'type'=>'color', 
			'title'  => __('Button Border Hover Color','pinnacle'),
			'default' => '',
		),
		'link'=>array(
			'type'=>'text', 
			'title'=>__('Link URL', 'pinnacle')
		),
		'border'=>array(
			'type'=>'select', 
			'title'=>__('Border Size', 'pinnacle'),
			'default' => '0',
			'values' => array(
				"" => __('0', 'pinnacle'),
				"1px" => __('1px', 'pinnacle'),
				"2px" => __('2px', 'pinnacle'),
				"3px" => __('3px', 'pinnacle'),
				"4px" => __('4px', 'pinnacle'),
				"5px" => __('5px', 'pinnacle'),
				"6px" => __('6px', 'pinnacle'),
				"7px" => __('7px', 'pinnacle'),
				"8px" => __('8px', 'pinnacle'),
				)
		),
		'size'=>array(
			'type'=>'select', 
			'title'=>__('Button Size', 'pinnacle'),
			'default' => '',
			'values' => array(
				"" => __('Default', 'pinnacle'),
				"large" => __('Large', 'pinnacle'),
				"small" => __('Small', 'pinnacle'),
				)
		),
		'font'=>array(
			'type'=>'select', 
			'title'=>__('Font Family', 'pinnacle'),
			'default' => '',
			'values' => array(
				"" => __('Default', 'pinnacle'),
				"h1-family" => __('H1 Family', 'pinnacle'),
				)
		),
		'icon'=>array(
			'type'=>'icon-select', 
			'title'=>__('Choose an Icon (optional)', 'pinnacle'),
			'values' => $btnicons 
		),
	) 
);
$pinnacle_shortcodes['gmap'] = array( 
	'title'=>__('Google Map', 'pinnacle'), 
	'attr'=>array(
		'address'=>array(
			'type'=>'text', 
			'title'=>__('Address One', 'pinnacle')
		),
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Address Title One','pinnacle'),
			'desc'=>__('Displays in Popup e.g. = Business Name', 'pinnacle')
		),
		'height'=>array(
			'type'=>'text', 
			'title'=>__('Map Height', 'pinnacle'),
			'desc'=>__('Just a number e.g. = 400', 'pinnacle'), 
		),
		'zoom'=>array(
			'type'=>'select', 
			'title'=>__('Map Zoom','pinnacle'),
			'default' => '15',
			'values' => array(
				"1" => "1",
				"2" => "2",
				"3" => "3",
				"4" => "4",
				"5" => "5",
				"6" => "6",
				"7" => "7",
				"8" => "8",
				"9" => "9",
				"10" => "10",
				"11" => "11",
				"12" => "12",
				"13" => "13",
				"14" => "14",
				"15" => "15",
				"16" => "16",
				"17" => "17",
				"18" => "18",
				"19" => "19",
				"20" => "20",
				)
		),
		'maptype'=>array(
			'type'=>'select', 
			'title'=>__('Map Type','pinnacle'),
			'default' => 'ROADMAP',
			'values' => array(
				"ROADMAP" => __('ROADMAP', 'pinnacle'),
				"HYBRID" => __('HYBRID', 'pinnacle'),
				"TERRAIN" => __('TERRAIN', 'pinnacle'),
				"SATELLITE" => __('SATELLITE', 'pinnacle'),
				)
		),
		'address2'=>array(
			'type'=>'text', 
			'title'=>__('Address Two', 'pinnacle')
		),
		'title2'=>array(
			'type'=>'text', 
			'title'=>__('Address Title Two','pinnacle'),
			'desc'=>__('Displays in Popup e.g. = Business Name', 'pinnacle')
		),
		'address3'=>array(
			'type'=>'text', 
			'title'=>__('Address Three', 'pinnacle')
		),
		'title3'=>array(
			'type'=>'text', 
			'title'=>__('Address Title Three','pinnacle'),
			'desc'=>__('Displays in Popup e.g. = Business Name', 'pinnacle')
		),
		'address4'=>array(
			'type'=>'text', 
			'title'=>__('Address Four', 'pinnacle')
		),
		'title4'=>array(
			'type'=>'text', 
			'title'=>__('Address Title Four','pinnacle'),
			'desc'=>__('Displays in Popup e.g. = Business Name', 'pinnacle')
		),
		'center'=>array(
			'type'=>'text', 
			'title'=>__('Map Center','pinnacle'),
			'desc'=>__('Defaults to Address One', 'pinnacle')
		)
	) 
);

$pinnacle_shortcodes['icon'] = array( 
	'title'=>__('Icon', 'pinnacle'), 
	'attr'=>array(
		'icon'=>array(
			'type'=>'icon-select', 
			'title'=>__('Choose an Icon', 'pinnacle'),
			'values' => $icons
		),
		'size'=>array(
			'type'=>'select', 
			'title'=>__('Icon Size','pinnacle'),
			'default' => '14px',
			'values' => array(
				"5px" => "5px",
				"6px" => "6px",
				"7px" => "7px",
				"8px" => "8px",
				"9px" => "9px",
				"10px" => "10px",
				"11px" => "11px",
				"12px" => "12px",
				"13px" => "13px",
				"14px" => "14px",
				"15px" => "15px",
				"16px" => "16px",
				"17px" => "17px",
				"18px" => "18px",
				"19px" => "19px",
				"20px" => "20px",
				"21px" => "21px",
				"22px" => "22px",
				"23px" => "23px",
				"24px" => "24px",
				"25px" => "25px",
				"26px" => "26px",
				"27px" => "27px",
				"28px" => "28px",
				"29px" => "29px",
				"30px" => "30px",
				"31px" => "31px",
				"32px" => "32px",
				"33px" => "33px",
				"34px" => "34px",
				"35px" => "35px",
				"36px" => "36px",
				"37px" => "37px",
				"38px" => "38px",
				"39px" => "39px",
				"40px" => "40px",
				"41px" => "41px",
				"42px" => "42px",
				"43px" => "43px",
				"44px" => "44px",
				"45px" => "45px",
				"46px" => "46px",
				"47px" => "47px",
				"48px" => "48px",
				"49px" => "49px",
				"50px" => "50px",
				"51px" => "51px",
				"52px" => "52px",
				"53px" => "53px",
				"54px" => "54px",
				"55px" => "55px",
				"56px" => "56px",
				"57px" => "57px",
				"58px" => "58px",
				"59px" => "59px",
				"60px" => "60px",
				"61px" => "61px",
				"62px" => "62px",
				"63px" => "63px",
				"64px" => "64px",
				"65px" => "65px",
				"66px" => "66px",
				"67px" => "67px",
				"68px" => "68px",
				"69px" => "69px",
				"70px" => "70px",
				"71px" => "71px",
				"72px" => "72px",
				"73px" => "73px",
				"74px" => "74px",
				"75px" => "75px",
				"76px" => "76px",
				"77px" => "77px",
				"78px" => "78px",
				"79px" => "79px",
				"80px" => "80px",
			)
		),
		'color'=>array(
			'type'=>'color', 
			'title'  => __('Icon Color','pinnacle'),
			'default' => '',
		),
		'float'=>array(
			'type'=>'select', 
			'title'=>__('Icon Float', 'pinnacle'),
			'default' => '',
			'values' => array(
				"" => "none",
				"left" => "Left",
				"right" => "Right",
				)
		),
		'style'=>array(
			'type'=>'select', 
			'title'=>__('Icon Style', 'pinnacle'),
			'default' => '',
			'values' => array(
				"" => "none",
				"circle" => __('Circle', 'pinnacle'),
				"smcircle" => __('Small Circle', 'pinnacle'),
				"square" => __('Square', 'pinnacle'),
				"smsquare" => __('Small Square', 'pinnacle'),
				)
		),
		'background'=>array(
			'type'=>'color', 
			'title'  => __('Background Color','pinnacle'),
			'default' => '',
		)
	) 
);
$pinnacle_shortcodes['iconbox'] = array( 
	'title'=>__('Icon Box', 'pinnacle'), 
	'attr'=>array(
		'icon'=>array(
			'type'=>'icon-select', 
			'title'=>__('Choose an Icon', 'pinnacle'),
			'values' => $icons
		),
		'color'=>array(
			'type'=>'color', 
			'title'  => __('Icon Color','pinnacle'),
			'default' => '#ffffff',
		),
		'background'=>array(
			'type'=>'color', 
			'title'  => __('Icon Background Color','pinnacle'),
			'default' => '#444444',
		),
		'hbackground'=>array(
			'type'=>'color', 
			'title'  => __('Hover Icon Background Color','pinnacle'),
			'default' => '',
		),
		'tcolor'=>array(
			'type'=>'color', 
			'title'  => __('Font Color','pinnacle'),
			'default' => '#444444',
		),
		'link'=>array(
			'type'=>'text', 
			'title'=>__('Link URL', 'pinnacle')
		),
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Title', 'pinnacle')
		),
		'description'=>array(
			'type'=>'textarea', 
			'title'=>__('Description', 'pinnacle')
		),
		'btn'=>array(
			'type'=>'checkbox', 
			'title'=>__('Use Button?','pinnacle')
		),
		'btn_show'=>array(
			'type'=>'checkbox', 
			'title'=>__('Show Button without hover?','pinnacle')
		),
		'btn_txt'=>array(
			'type'=>'text', 
			'title'=>__('Button Text e.g. Read More', 'pinnacle')
		),

	) 
);
$pinnacle_shortcodes['kt_typed'] = array( 
	'title'=>__('Animated Typed Text', 'pinnacle'), 
	'attr'=>array(
		'first_sentence'=>array(
			'type'=>'text', 
			'title'=>__('First Sentence', 'pinnacle')
		),
		'second_sentence'=>array(
			'type'=>'text', 
			'title'=>__('Second Sentence (optional)', 'pinnacle')
		),
		'third_sentence'=>array(
			'type'=>'text', 
			'title'=>__('Third Sentence (optional)', 'pinnacle')
		),
		'fourth_sentence'=>array(
			'type'=>'text', 
			'title'=>__('Fourth Sentence (optional)', 'pinnacle')
		),
		'loop'=>array(
			'type'=>'checkbox', 
			'title'=>__('Loop','pinnacle')
		)
	) 
);
$pinnacle_shortcodes['kad_youtube'] = array( 
	'title'=>__('YouTube', 'pinnacle'), 
	'attr'=>array(
		'url'=>array(
			'type'=>'text', 
			'title'=>__('Video URL', 'pinnacle')
		),
		'width'=>array(
			'type'=>'text', 
			'title'=>__('Video Width', 'pinnacle'),
			'desc' =>__('Just a number e.g. = 600', 'pinnacle'), 
		),
		'height'=>array(
			'type'=>'text', 
			'title'=>__('Video Height', 'pinnacle'),
			'desc'=>__('Just a number e.g. = 400', 'pinnacle'), 
		),
		'maxwidth'=>array(
			'type'=>'text', 
			'title'=>__('Video Max Width', 'pinnacle'),
			'desc'=>__('Keeps the responsive video from getting too large', 'pinnacle'), 
		),
		'hidecontrols'=>array(
			'type'=>'checkbox', 
			'title'=>__('Hide Controls','pinnacle')
		),
		'autoplay'=>array(
			'type'=>'checkbox', 
			'title'=>__('Auto Play','pinnacle')
		),
		'rel'=>array(
			'type'=>'checkbox', 
			'title'=>__('Show Related','pinnacle')
		),
		'modestbranding'=>array(
			'type'=>'checkbox', 
			'title'=>__('Modest Branding?','pinnacle')
		)
	) 
);
$pinnacle_shortcodes['kad_vimeo'] = array( 
	'title'=>__('Vimeo', 'pinnacle'), 
	'attr'=>array(
		'url'=>array(
			'type'=>'text', 
			'title'=>__('Video URL', 'pinnacle')
		),
		'width'=>array(
			'type'=>'text', 
			'title'=>__('Video Width', 'pinnacle'),
			'desc' =>__('Just a number e.g. = 600', 'pinnacle'), 
		),
		'height'=>array(
			'type'=>'text', 
			'title'=>__('Video Height', 'pinnacle'),
			'desc'=>__('Just a number e.g. = 400', 'pinnacle'), 
		),
		'maxwidth'=>array(
			'type'=>'text', 
			'title'=>__('Video Max Width', 'pinnacle'),
			'desc'=>__('Keeps the responsive video from getting too large', 'pinnacle'), 
		),
		'autoplay'=>array(
			'type'=>'checkbox', 
			'title'=>__('Auto Play','pinnacle')
		)
	) 
);
$postcategories = get_categories();
$cat_options = array();
$cat_options = array("" => "All");
if(!empty($postcategories)){
foreach ($postcategories as $cat) {
      $cat_options[$cat->slug] = $cat->name;
}
}
$staffcategories = get_terms('staff-group');
$staff_cat_options = array();
$staff_cat_options = array("" => "All");
if(!empty($staffcategories)){
	foreach ($staffcategories as $scat) {
	      $staff_cat_options[$scat->slug] = $scat->name;
	}
}

$pinnacle_shortcodes['blog_posts'] = array( 
	'title'=>__('Blog Posts', 'pinnacle'), 
	'attr'=>array(
		'orderby'=>array(
			'type'=>'select', 
			'title'=>__('Order By', 'pinnacle'),
			'default' => 'date',
			'values' => array(
				"date" => __('Date','pinnacle'),
				"rand" => __('Random','pinnacle'),
				"menu_order" => __('Menu Order','pinnacle'),
				)
		),
		'cat'=>array(
			'type'=>'select',
			'default' => '',
			'title'=>__('Category', 'pinnacle'),
			'values' => $cat_options,
		),
		'items'=>array(
			'type'=>'text', 
			'title'=>__('Number of Posts', 'pinnacle')
		),
	) 
);
$pinnacle_shortcodes['staff_posts'] = array( 
	'title'=>__('Staff Posts', 'pinnacle'), 
	'attr'=>array(
		'orderby'=>array(
			'type'=>'select', 
			'title'=>__('Order By', 'pinnacle'),
			'default' => 'menu_order',
			'values' => array(
				"menu_order" => __('Menu Order','pinnacle'),
				"date" => __('Date','pinnacle'),
				"rand" => __('Random','pinnacle'),
				)
		),
		'columns'=>array(
			'type'=>'select', 
			'title'=>__('Columns', 'pinnacle'),
			'default' => '3',
			'values' => array(
				"2" => __('Two', 'pinnacle'),
				"3" => __('Three', 'pinnacle'),
				"4" => __('Four', 'pinnacle'),
				"5" => __('Five', 'pinnacle'),
				"6" => __('Six', 'pinnacle'),
				)
		),
		'items'=>array(
			'type'=>'text', 
			'title'=>__('Number of Posts', 'pinnacle')
		),
		'cat'=>array(
			'type'=>'select',
			'default' => '',
			'title'=>__('Category', 'pinnacle'),
			'values' => $staff_cat_options,
		),
		'link'=>array(
			'type'=>'checkbox', 
			'title'=>__('Link to single post?','pinnacle')
		),
		'limit_content'=>array(
			'type'=>'checkbox', 
			'title'=>__('Use Full Content?','pinnacle')
		),
		'ratio'=>array(
			'type'=>'select', 
			'title'=>__('Image Ratio', 'pinnacle'),
			'default' => 'square',
			'values' => array(
				"square" => __('Square', 'pinnacle'),
				"portrait" => __('Portrait', 'pinnacle'),
				"landscape" => __('Landscape', 'pinnacle'),
				"widelandscape" => __('Widelandscape', 'pinnacle'),
				)
		),
	) 
);

	//Button
$pinnacle_shortcodes['kad_modal'] = array( 
	'title'=>__('Modal', 'pinnacle'), 
	'attr'=>array(
		'btntitle'=>array(
			'type'=>'text', 
			'title'=>__('Button Title', 'pinnacle')
		),
		'btncolor'=>array(
			'type'=>'color', 
			'title'  => __('Button Font Color','pinnacle'),
			'default' => '#ffffff',
		),
		'btnbackground'=>array(
			'type'=>'color', 
			'title'  => __('Button Background Color','pinnacle'),
			'default' => '',
		),
		'btnsize'=>array(
			'type'=>'select', 
			'title'=>__('Button Size', 'pinnacle'),
			'default' => '',
			'values' => array(
				"" => __('Default', 'pinnacle'),
				"large" => __('Large', 'pinnacle'),
				"small" => __('Small', 'pinnacle'),
				)
		),
		'btnfont'=>array(
			'type'=>'select', 
			'title'=>__('Font Family', 'pinnacle'),
			'default' => '',
			'values' => array(
				"" => __('Default', 'pinnacle'),
				"h1-family" => __('H1 Family', 'pinnacle'),
				)
		),
		'title'=>array(
			'type'=>'text', 
			'title'=>__('Modal Title', 'pinnacle')
		),
		'content'=>array(
			'type'=>'textarea', 
			'title'=>__('Modal Content', 'pinnacle')
		)
	) 
);
$pinnacle_shortcodes['kad_testimonial_form'] = array( 
	'title'=>__('Testimonial Form', 'pinnacle'), 
	'attr'=>array(
		'location'=>array(
			'type'=>'checkbox', 
			'title'=>__('Show Location Field?','pinnacle')
		),
		'position'=>array(
			'type'=>'checkbox', 
			'title'=>__('Show Position Field?','pinnacle')
		),
		'link'=>array(
			'type'=>'checkbox', 
			'title'=>__('Show Link Field?','pinnacle')
		),
		'name_label'=>array(
			'type'=>'text', 
			'title'=>__('Name Field Label', 'pinnacle'),
			'desc'=>__('Default: Name', 'pinnacle')
		),
		'testimonial_label'=>array(
			'type'=>'text', 
			'title'=>__('Testimonial Field Label','pinnacle'),
			'desc'=>__('Default: Testimonial', 'pinnacle')
		),
		'location_label'=>array(
			'type'=>'text', 
			'title'=>__('Location Field Label', 'pinnacle'),
			'desc'=>__('Default: Location - Optional', 'pinnacle')
		),
		'position_label'=>array(
			'type'=>'text', 
			'title'=>__('Position Field Label', 'pinnacle'),
			'desc'=>__('Default: Position or Company - optional', 'pinnacle')
		),
		'link_label'=>array(
			'type'=>'text', 
			'title'=>__('Link Field Label','pinnacle'),
			'desc'=>__('Default: Link - optional', 'pinnacle')
		),
		'submit_label'=>array(
			'type'=>'text', 
			'title'=>__('Submit Field Label', 'pinnacle'),
			'desc'=>__('Default: Submit', 'pinnacle')
		),
		'success_message'=>array(
			'type'=>'text', 
			'title'=>__('Success Message', 'pinnacle'),
			'desc'=>__('Default: Thank you for submitting your testimonial! It is now awaiting approval from the site admnistator. Thank you!', 'pinnacle')
		),
	) 
);

	ob_start(); ?>
	<div id="kadence-shortcode-container">
		<div id="kadence-shortcode-innercontainer" class="mfp-hide mfp-with-anim">
		 	<div class="kadenceshortcode-content">
		 		<div class="shortcodes-header">
					<div class="kadshort-header"><h3><?php echo __('Pinnacle Shortcodes', 'pinnacle'); ?></h3></div>
					<div class="kadshort-select"><select id="kadence-shortcodes" data-placeholder="<?php _e("Choose a shortcode", 'pinnacle'); ?>">
				    <option></option>
					
					<?php 
					$pinnacle_shortcodes = apply_filters('kadence_shortcodes', $pinnacle_shortcodes);
					foreach( $pinnacle_shortcodes as $shortcode => $options ){
						
							$kad_sc_html .= '<option value="'.$shortcode.'">'.$options['title'].'</option>';
							$kad_options_html .= '<div class="shortcode-options" id="options-'.$shortcode.'" data-name="'.$shortcode.'">';
							
								if( !empty($options['attr']) ){
									 foreach( $options['attr'] as $name => $attr_option ){
										$kad_options_html .= kadence_shortcode_option( $name, $attr_option, $shortcode );
									 }
								}
			
							$kad_options_html .= '</div>'; 
						
					} 
			
			$kad_sc_html .= '</select></div></div>'; 	
		
	
		 echo $kad_sc_html . $kad_options_html; ?>

 				
			<div class="kad_shortcode_insert">	
				<a href="javascript:void(0);" id="kad-shortcode-insert" class="kad-addshortcode-btn" style=""><?php _e("Add Shortcode", "pinnacle"); ?></a>
			</div>
	</div> 
	</div>
	</div>
<?php  $output = ob_get_contents();
		ob_end_clean();
	echo $output;
}