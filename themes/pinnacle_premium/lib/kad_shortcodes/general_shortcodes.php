<?php
//Shortcode for year
function kad_year_shortcode_function() {
    $year = date('Y');
	return $year;
}
function kad_copyright_shortcode_function() {
	return '&copy;';
}
function kad_sitename_shortcode_function() {
	$sitename = get_bloginfo('name');
	return $sitename;
}
function kad_sitetagline_shortcode_function() {
	$sitetag = get_bloginfo ( 'description' );
	return $sitetag;
}
function kad_themecredit_shortcode_function() {
	$my_theme = wp_get_theme();
	$output = '- Wordpress Theme by <a href="'.$my_theme->{'Author URI'}.'">Kadence Themes</a>';
	return $output;
}
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active('virtue-toolkit/virtue_toolkit.php') || is_plugin_active('kadence-toolkit/kadence_toolkit.php') ) {
function kadence_plugin_admin_notice(){
    echo '<div class="error"><p>Please <strong>Disable</strong> the Kadence ToolKit Plugin. It is not needed with Pinnacle Premium.</p></div>';
}
add_action('admin_notices', 'kadence_plugin_admin_notice');
}

if ( !is_plugin_active('virtue-toolkit/virtue_toolkit.php') ) {
//Shortcode for accordion
function kad_accordion_shortcode_function($atts, $content ) {
		extract(shortcode_atts(array(
'id' => rand(1, 99)
), $atts));
	$GLOBALS['pane_count'] = 0;
	$GLOBALS['panes'] = '';
	do_shortcode( $content );
	if( is_array( $GLOBALS['panes'] ) ){
		
	foreach( $GLOBALS['panes'] as $tab ){
	$tabs[] = '<div class="panel panel-default"><div class="panel-heading"><a class="accordion-toggle '.$tab['open'].'" data-toggle="collapse" data-parent="#accordionname'.$id.'" href="#collapse'.$id.$tab['link'].'"><h5><i class="kt-icon-minus primary-color"></i><i class="kt-icon-plus"></i>'.$tab['title'].'</h5></a></div><div id="collapse'.$id.$tab['link'].'" class="panel-collapse collapse '.$tab['in'].'"><div class="panel-body postclass">'.$tab['content'].'</div></div></div>';

}
$return = "\n".'<div class="panel-group" id="accordionname'.$id.'">'.implode( "\n", $tabs ).'</div>'."\n";
}
return $return;
}

function kad_accordion_pane_function($atts, $content ) {
	extract(shortcode_atts(array(
'title' => 'Pane %d',
'start' => ''
), $atts));
if ($start != '') {$open = '';} else {$open = 'collapsed';}
if ($start != '') {$in = 'in';} else {$in = '';}

$x = $GLOBALS['pane_count'];
$GLOBALS['panes'][$x] = array( 'title' => $title, 'open' => $open, 'in' => $in, 'link' => $GLOBALS['pane_count'], 'content' =>  do_shortcode( $content ) );

$GLOBALS['pane_count']++;
}
function kad_tab_shortcode_function($atts, $content ) {
	extract(shortcode_atts(array(
'id' => rand(1, 99)
), $atts));
	$GLOBALS['tab_count'] = 0;
	$GLOBALS['tabs'] = '';
	do_shortcode( $content );
	if( is_array( $GLOBALS['tabs'] ) ){
		
	foreach( $GLOBALS['tabs'] as $nav ){
	$tabnav[] = '<li class="'.$nav['active'].'"><a href="#sctab'.$id.$nav['link'].'">'.$nav['title'].'</a></li>';
	}
		
	foreach( $GLOBALS['tabs'] as $tab ){
	$tabs[] = '<div class="tab-pane clearfix '.$tab['active'].'" id="sctab'.$id.$tab['link'].'">'.$tab['content'].'</div>';
	}
	
$return = "\n".'<ul class="nav nav-tabs sc_tabs">'.implode( "\n", $tabnav ).'</ul> <div class="tab-content postclass">'.implode( "\n", $tabs ).'</div>'."\n";
}
return $return;
}
function kad_tab_pane_function($atts, $content ) {
	extract(shortcode_atts(array(
'title' => 'Tab %d',
'start' => ''
), $atts));
if ($start != '') {$active = 'active';} else {$active = '';}

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array( 'title' => $title, 'active' => $active, 'link' => $GLOBALS['tab_count'], 'content' =>  do_shortcode( $content ) );

$GLOBALS['tab_count']++;
}

//Shortcode for columns
function kad_column_shortcode_function( $atts, $content ) {
	return '<div class="row">'.do_shortcode($content).'</div>';
}
function kad_hcolumn_shortcode_function( $atts, $content ) {
	return '<div class="row">'.do_shortcode($content).'</div>';
}
function kad_column11_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'tablet' => '',
			'phone' => ''
			), $atts));
		if(empty($tablet)) {$tclass = "";} else if ($tablet == 'span2') {$tclass = "col-sm-2";} else if ($tablet == 'span3') {$tclass = "col-sm-3";} else if ($tablet == 'span4') {$tclass = "col-sm-4";} else if ($tablet == 'span6') {$tclass = "col-sm-6";} else if ($tablet == 'span8') {$tclass = "col-sm-8";} else {$tclass = "";}
		if(empty($phone)) {$pclass = "";} else if ($phone == 'span2') {$pclass = "col-ss-2";} else if ($phone == 'span3') {$pclass = "col-ss-3";} else if ($phone == 'span4') {$pclass = "col-ss-4";} else if ($phone == 'span6') {$pclass = "col-ss-6";} else if ($phone == 'span8') {$pclass = "col-ss-8";} else {$tclass = "";}
	return '<div class="col-md-11 '.$tclass.' '.$pclass.'">'.do_shortcode($content).'</div>';
}
function kad_column10_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'tablet' => '',
			'phone' => ''
			), $atts));
		if(empty($tablet)) {$tclass = "";} else if ($tablet == 'span2') {$tclass = "col-sm-2";} else if ($tablet == 'span3') {$tclass = "col-sm-3";} else if ($tablet == 'span4') {$tclass = "col-sm-4";} else if ($tablet == 'span6') {$tclass = "col-sm-6";} else if ($tablet == 'span8') {$tclass = "col-sm-8";} else {$tclass = "";}
		if(empty($phone)) {$pclass = "";} else if ($phone == 'span2') {$pclass = "col-ss-2";} else if ($phone == 'span3') {$pclass = "col-ss-3";} else if ($phone == 'span4') {$pclass = "col-ss-4";} else if ($phone == 'span6') {$pclass = "col-ss-6";} else if ($phone == 'span8') {$pclass = "col-ss-8";} else {$tclass = "";}
	return '<div class="col-md-10 '.$tclass.' '.$pclass.'">'.do_shortcode($content).'</div>';
}
function kad_column9_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'tablet' => '',
			'phone' => ''
			), $atts));
		if(empty($tablet)) {$tclass = "";} else if ($tablet == 'span2') {$tclass = "col-sm-2";} else if ($tablet == 'span3') {$tclass = "col-sm-3";} else if ($tablet == 'span4') {$tclass = "col-sm-4";} else if ($tablet == 'span6') {$tclass = "col-sm-6";} else if ($tablet == 'span8') {$tclass = "col-sm-8";} else {$tclass = "";}
		if(empty($phone)) {$pclass = "";} else if ($phone == 'span2') {$pclass = "col-ss-2";} else if ($phone == 'span3') {$pclass = "col-ss-3";} else if ($phone == 'span4') {$pclass = "col-ss-4";} else if ($phone == 'span6') {$pclass = "col-ss-6";} else if ($phone == 'span8') {$pclass = "col-ss-8";} else {$tclass = "";}
	return '<div class="col-md-9 '.$tclass.' '.$pclass.'">'.do_shortcode($content).'</div>';
}
function kad_column8_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'tablet' => '',
			'phone' => ''
			), $atts));
		if(empty($tablet)) {$tclass = "";} else if ($tablet == 'span2') {$tclass = "col-sm-2";} else if ($tablet == 'span3') {$tclass = "col-sm-3";} else if ($tablet == 'span4') {$tclass = "col-sm-4";} else if ($tablet == 'span6') {$tclass = "col-sm-6";} else if ($tablet == 'span8') {$tclass = "col-sm-8";} else {$tclass = "";}
		if(empty($phone)) {$pclass = "";} else if ($phone == 'span2') {$pclass = "col-ss-2";} else if ($phone == 'span3') {$pclass = "col-ss-3";} else if ($phone == 'span4') {$pclass = "col-ss-4";} else if ($phone == 'span6') {$pclass = "col-ss-6";} else if ($phone == 'span8') {$pclass = "col-ss-8";} else {$tclass = "";}
	return '<div class="col-md-8 '.$tclass.' '.$pclass.'">'.do_shortcode($content).'</div>';
}
function kad_column7_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'tablet' => '',
			'phone' => ''
			), $atts));
		if(empty($tablet)) {$tclass = "";} else if ($tablet == 'span2') {$tclass = "col-sm-2";} else if ($tablet == 'span3') {$tclass = "col-sm-3";} else if ($tablet == 'span4') {$tclass = "col-sm-4";} else if ($tablet == 'span6') {$tclass = "col-sm-6";} else if ($tablet == 'span8') {$tclass = "col-sm-8";} else {$tclass = "";}
		if(empty($phone)) {$pclass = "";} else if ($phone == 'span2') {$pclass = "col-ss-2";} else if ($phone == 'span3') {$pclass = "col-ss-3";} else if ($phone == 'span4') {$pclass = "col-ss-4";} else if ($phone == 'span6') {$pclass = "col-ss-6";} else if ($phone == 'span8') {$pclass = "col-ss-8";} else {$tclass = "";}
	return '<div class="col-md-7 '.$tclass.' '.$pclass.'">'.do_shortcode($content).'</div>';
}
function kad_column6_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'tablet' => '',
			'phone' => ''
			), $atts));
		if(empty($tablet)) {$tclass = "";} else if ($tablet == 'span2') {$tclass = "col-sm-2";} else if ($tablet == 'span3') {$tclass = "col-sm-3";} else if ($tablet == 'span4') {$tclass = "col-sm-4";} else if ($tablet == 'span6') {$tclass = "col-sm-6";} else if ($tablet == 'span8') {$tclass = "col-sm-8";} else {$tclass = "";}
		if(empty($phone)) {$pclass = "";} else if ($phone == 'span2') {$pclass = "col-ss-2";} else if ($phone == 'span3') {$pclass = "col-ss-3";} else if ($phone == 'span4') {$pclass = "col-ss-4";} else if ($phone == 'span6') {$pclass = "col-ss-6";} else if ($phone == 'span8') {$pclass = "col-ss-8";} else {$tclass = "";}
	return '<div class="col-md-6 '.$tclass.' '.$pclass.'">'.do_shortcode($content).'</div>';
}
function kad_column5_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'tablet' => '',
			'phone' => ''
			), $atts));
		if(empty($tablet)) {$tclass = "";} else if ($tablet == 'span2') {$tclass = "col-sm-2";} else if ($tablet == 'span3') {$tclass = "col-sm-3";} else if ($tablet == 'span4') {$tclass = "col-sm-4";} else if ($tablet == 'span6') {$tclass = "col-sm-6";} else if ($tablet == 'span8') {$tclass = "col-sm-8";} else {$tclass = "";}
		if(empty($phone)) {$pclass = "";} else if ($phone == 'span2') {$pclass = "col-ss-2";} else if ($phone == 'span3') {$pclass = "col-ss-3";} else if ($phone == 'span4') {$pclass = "col-ss-4";} else if ($phone == 'span6') {$pclass = "col-ss-6";} else if ($phone == 'span8') {$pclass = "col-ss-8";} else {$tclass = "";}
	return '<div class="col-md-5 '.$tclass.' '.$pclass.'">'.do_shortcode($content).'</div>';
}
function kad_column4_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'tablet' => '',
			'phone' => ''
			), $atts));
		if(empty($tablet)) {$tclass = "";} else if ($tablet == 'span2') {$tclass = "col-sm-2";} else if ($tablet == 'span3') {$tclass = "col-sm-3";} else if ($tablet == 'span4') {$tclass = "col-sm-4";} else if ($tablet == 'span6') {$tclass = "col-sm-6";} else if ($tablet == 'span8') {$tclass = "col-sm-8";} else {$tclass = "";}
		if(empty($phone)) {$pclass = "";} else if ($phone == 'span2') {$pclass = "col-ss-2";} else if ($phone == 'span3') {$pclass = "col-ss-3";} else if ($phone == 'span4') {$pclass = "col-ss-4";} else if ($phone == 'span6') {$pclass = "col-ss-6";} else if ($phone == 'span8') {$pclass = "col-ss-8";} else {$tclass = "";}
	return '<div class="col-md-4 '.$tclass.' '.$pclass.'">'.do_shortcode($content).'</div>';
}
function kad_column3_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'tablet' => '',
			'phone' => ''
			), $atts));
		if(empty($tablet)) {$tclass = "";} else if ($tablet == 'span2') {$tclass = "col-sm-2";} else if ($tablet == 'span3') {$tclass = "col-sm-3";} else if ($tablet == 'span4') {$tclass = "col-sm-4";} else if ($tablet == 'span6') {$tclass = "col-sm-6";} else if ($tablet == 'span8') {$tclass = "col-sm-8";} else {$tclass = "";}
		if(empty($phone)) {$pclass = "";} else if ($phone == 'span2') {$pclass = "col-ss-2";} else if ($phone == 'span3') {$pclass = "col-ss-3";} else if ($phone == 'span4') {$pclass = "col-ss-4";} else if ($phone == 'span6') {$pclass = "col-ss-6";} else if ($phone == 'span8') {$pclass = "col-ss-8";} else {$tclass = "";}
	return '<div class="col-md-3 '.$tclass.' '.$pclass.'">'.do_shortcode($content).'</div>';
}
function kad_column2_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'tablet' => '',
			'phone' => ''
			), $atts));
		if(empty($tablet)) {$tclass = "";} else if ($tablet == 'span2') {$tclass = "col-sm-2";} else if ($tablet == 'span3') {$tclass = "col-sm-3";} else if ($tablet == 'span4') {$tclass = "col-sm-4";} else if ($tablet == 'span6') {$tclass = "col-sm-6";} else if ($tablet == 'span8') {$tclass = "col-sm-8";} else {$tclass = "";}
		if(empty($phone)) {$pclass = "";} else if ($phone == 'span2') {$pclass = "col-ss-2";} else if ($phone == 'span3') {$pclass = "col-ss-3";} else if ($phone == 'span4') {$pclass = "col-ss-4";} else if ($phone == 'span6') {$pclass = "col-ss-6";} else if ($phone == 'span8') {$pclass = "col-ss-8";} else {$tclass = "";}
	return '<div class="col-md-2 '.$tclass.' '.$pclass.'">'.do_shortcode($content).'</div>';
}
function kad_column25_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'tablet' => '',
			'phone' => ''
			), $atts));
		if(empty($tablet)) {$tclass = "";} else if ($tablet == 'span2') {$tclass = "col-sm-2";} else if ($tablet == 'span3') {$tclass = "col-sm-3";} else if ($tablet == 'span4') {$tclass = "col-sm-4";} else if ($tablet == 'span6') {$tclass = "col-sm-6";} else if ($tablet == 'span8') {$tclass = "col-sm-8";} else {$tclass = "";}
		if(empty($phone)) {$pclass = "";} else if ($phone == 'span2') {$pclass = "col-ss-2";} else if ($phone == 'span3') {$pclass = "col-ss-3";} else if ($phone == 'span4') {$pclass = "col-ss-4";} else if ($phone == 'span6') {$pclass = "col-ss-6";} else if ($phone == 'span8') {$pclass = "col-ss-8";} else {$tclass = "";}
	return '<div class="col-md-25 '.$tclass.' '.$pclass.'">'.do_shortcode($content).'</div>';
}
function kad_column1_function( $atts, $content ) {
	extract(shortcode_atts(array(
			'tablet' => '',
			'phone' => ''
			), $atts));
		if(empty($tablet)) {$tclass = "";} else if ($tablet == 'span2') {$tclass = "col-sm-2";} else if ($tablet == 'span3') {$tclass = "col-sm-3";} else if ($tablet == 'span4') {$tclass = "col-sm-4";} else if ($tablet == 'span6') {$tclass = "col-sm-6";} else if ($tablet == 'span8') {$tclass = "col-sm-8";} else {$tclass = "";}
		if(empty($phone)) {$pclass = "";} else if ($phone == 'span2') {$pclass = "col-ss-2";} else if ($phone == 'span3') {$pclass = "col-ss-3";} else if ($phone == 'span4') {$pclass = "col-ss-4";} else if ($phone == 'span6') {$pclass = "col-ss-6";} else if ($phone == 'span8') {$pclass = "col-ss-8";} else {$tclass = "";}
	return '<div class="col-md-1 '.$tclass.' '.$pclass.'">'.do_shortcode($content).'</div>';
}
//Shortcode for Icons
function kad_icon_shortcode_function( $atts) {
	extract(shortcode_atts(array(
		'icon' => '',
		'size' => '',
		'color' => '',
		'style' => '',
		'background' => '',
		'float'=> ''
), $atts));
	if($style == 'circle') {$stylecss = 'kad-circle-iconclass';}
	 else if($style == 'smcircle') {$stylecss = 'kad-smcircle-iconclass';}
	 else if($style == 'square') {$stylecss = 'kad-square-iconclass';}
	 else if($style == 'smsquare') {$stylecss = 'kad-smsquare-iconclass';}
	 else {$stylecss = '';}
	if(empty($background)) {$background = '#eee';}
	if(empty($icon)) {$icon = 'icon-home';}
	if(empty($size)) {$size = '20px';}
	if(empty($color)) {$color = '#444';}
	if(empty($float)) {$float = '';}
	ob_start(); ?>
			<i class="<?php echo $icon;?> <?php if(!empty($stylecss)){echo $stylecss;}?>" style="font-size:<?php echo $size; ?>; display=inline-block; color:<?php echo $color;?>; <?php if(!empty($float)){echo 'float:'.$float.';';} if(!empty($stylecss)){echo 'background:'.$background.';';} ?>
			"></i>
	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}
//Shortcode for Info Boxes
function kad_info_boxes_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'icon' => '',
		'image' => '',
		'id' => rand(10,100),
		'size' => '28',
		'link' => '',
		'target' => '_self',
		'iconbackground' => '',
		'style' => 'circle',
		'color' => '',
		'tcolor' => '',
		'background' => ''
), $atts));
	ob_start(); ?>
	<?php if(!empty($link)) {echo '<a href="'.$link.'" target="'.$target.'" class="kadinfolink">'; } ?>
	<div class="kad-info-box kad-info-box-<?php echo $id;?> clearfix" style="<?php if(!empty($background)) { echo 'background:'.$background;} else {echo 'padding-left:0px; padding-right:0px;';}?>">
		<div class="kt-info-icon-case"><?php if(!empty($image)){?> <img src="<?php echo $image; ?>" > <?php } else if(!empty($icon)){?> <i class="<?php echo $icon;?> <?php if(!empty($style)) {echo $style;}?>" style="<?php if(!empty($iconbackground)) echo 'background:'.$iconbackground;?>; font-size:<?php echo $size;?>px; <?php if(!empty($color)) echo 'color:'.$color;?>"></i><?php }?></div>
		<div class="kt-info-content-case"><?php echo $content; ?></div>
	</div>
	<?php if(!empty($link)) {echo '</a>'; } 
	if(!empty($tcolor)) {echo '<style type="text/css" media="screen">.kad-info-box-'.$id.' h1, .kad-info-box-'.$id.' h2, .kad-info-box-'.$id.' h3, .kad-info-box-'.$id.' h4, .kad-info-box-'.$id.' h5, .kad-info-box-'.$id.' p {color:'.$tcolor.';}</style>';}?>
	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}
//Shortcode for Icons Boxes
function kad_icon_boxes_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'icon' => '',
		'id' => (rand(10,100)),
		'color' => '',
		'image' => '',
		'background' => '',
		'tcolor' => '',
		'hbackground' => '',
		'btn' => false,
		'btn_show' => false,
		'btn_txt' => __('Read More', 'pinnacle'),
		'link' => '',
		'target' => '_self'
), $atts));
	if(empty($color)) {$color = '#444';}
	if($btn_show) {$btn_show_class = "";} else {$btn_show_class = "kt-iconbtn-hide";}
	if(empty($background)) {$background = 'transparent';}
	if(!empty($link)) {
		$output = '<a href="'.$link.'" target="'.$target.'" class="kad-icon-box-'.$id.' kad-icon-box">';
	} else {
		$output = '<div class="kad-icon-box-'.$id.' kad-icon-box">';
	}
	if(!empty($image)) {
	$output .= '<img src="'.$image.'" class="kad-icon-box-img">'.$content;
	} else {
	$output .= '<i class="'.$icon.'" style="color:'.$color.'"></i>'.$content;
	}
	if($btn == 'true') $output .= '<div class="kad-btn sm-kad-btn '.$btn_show_class.' kad-btn-primary">'.$btn_txt.'</div>';
	if(!empty($link)) {
		$output .= '</a>';
	} else {
		$output .= '</div>';
	}
	$output .= '<style type="text/css" media="screen">.kad-icon-box-'.$id.' i, .kad-icon-box-'.$id.' h4:after  {background:'.$background.';} .kad-icon-box-'.$id.', .kad-icon-box-'.$id.' h1, .kad-icon-box-'.$id.' h2, .kad-icon-box-'.$id.' h3, .kad-icon-box-'.$id.' h4, .kad-icon-box-'.$id.' h5 {color:'.$tcolor.' !important;} .kad-icon-box-'.$id.':hover i, .kad-icon-box-'.$id.':hover h4:after {background:'.$hbackground.';}</style>';

	return $output;
}
//Shortcode for modal
function kad_modal_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'title' => 'Modal Title',
		'close' => 'true',
		'btntitle' => 'Click Here',
		'id' => '',
		'btnfont' => 'body',
		'btnsize' => 'medium',
		'btncolor' => '',
		'btnbackground' => ''
), $atts));
	if(empty($id)) {$id = rand(1, 99);}
	if($btnsize == 'large'){$sizeclass = "lg-kad-btn";} else if ($btnsize == 'small') {$sizeclass = "sm-kad-btn";} else {$sizeclass = "";}
	if($btnfont == 'h1-family'){$fontclass = "headerfont";} else {$fontclass = "";}
	ob_start(); ?>
	<button class="kad-btn kad-btn-primary <?php echo $sizeclass.' '.$fontclass;?>" style="<?php if(!empty($btnbackground)) {echo 'background-color:'.$btnbackground.';'; } if(!empty($btncolor)) { echo 'color:'.$btncolor.';';}?>" data-toggle="modal" data-target="#kt-modal-<?php echo $id;?>">
	 <?php echo $btntitle; ?>
	</button>

	<!-- Modal -->
	<div class="modal fade" id="kt-modal-<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="#kt-modal-label-<?php echo $id;?>" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        <h4 class="modal-title" id="kt-modal-label-<?php echo $id;?>"><?php echo $title; ?></h4>
	      </div>
	      <div class="modal-body">
	        <?php echo do_shortcode($content); ?>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="kad-btn" data-dismiss="modal"><?php _e('Close', 'pinnacle'); ?></button>
	      </div>
	    </div>
	  </div>
	</div>

	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}
//Image Split
function kad_image_split_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'height' => '500',
		'image' => '',
		'image_cover' => 'false',
		'img_background' => '',
		'content_background' => '',
		'image_link' => '',
		'link_target' => '_self',
		'imageside' => 'left',
		'id' => rand(1, 99),
), $atts));
	ob_start(); ?>
	<!-- Image Split -->
	<div class="kt-image-slit" id="kt-image-split-<?php echo esc_attr($id);?>">
	  <div class="row">
	    <div class="col-sm-6 kt-si-imagecol img-ktsi-<?php echo esc_attr($imageside);?>" style="<?php if(!empty($img_background)) {echo 'background-color:'.esc_attr($img_background).';';} if($image_cover == 'true' && !empty($image)) {echo 'background-image:url('.esc_url($image).'); background-size:cover; background-position: center center; min-height:'.esc_attr($height / 2).'px;';}?>">
	      <div class="kt-si-table-box" style="height:<?php echo esc_attr($height);?>px">
	      	<div class="kt-si-cell-box">
	      		<?php if(!empty($image_link)) { echo '<a href="'.$image_link.'" target="'.$link_target.'" class="kt-si-image-link">';} 

	      		if($image_cover == 'true' && !empty($image)) {
	      			echo '<div class="kt-si-image kt-si-cover-image" style="max-height:'.$height.'px;"></div>'; 
	      		} else if(!empty($image)){
	      			 echo '<img src="'.esc_url($image).'" class="kt-si-image" style="max-height:'.$height.'px">'; 
	      		}
	      		if(!empty($image_link)) { echo '</a>';}  ?>
	        </div>
	      </div>
	     </div>
	     <div class="col-sm-6 kt-si-imagecol content-ktsi-<?php echo esc_attr($imageside);?>" <?php if(!empty($content_background)) {echo 'style="background-color:'.$content_background.'"';}?>>
	      <div class="kt-si-table-box" style="height:<?php echo esc_attr($height);?>px">
	      	<div class="kt-si-cell-box">
 				<?php echo do_shortcode($content); ?>
	        </div>
	      </div>
	     </div>
	  </div>
	</div>

	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}
//Typed Text
function kadence_typed_text_shortcode_function( $atts) {
	extract(shortcode_atts(array(
		'first_sentence' => 'typed text',
		'second_sentence' => '',
		'third_sentence' => '',
		'fourth_sentence' => '',
		'loop' => 'false',
		'speed' => '40',
), $atts));
if(!empty($second_sentence) && empty($third_sentence) && empty($fourth_sentence)) {
	$count = '2';
} else if(!empty($second_sentence) && !empty($third_sentence) && empty($fourth_sentence)) {
	$count = '3';
} else if(!empty($second_sentence) && !empty($third_sentence) && !empty($fourth_sentence)){
	$count = '4';
} else {
	$count = '1';
}
$output = '<span class="kt_typed_element" data-first-sentence="'.$first_sentence.'"';
	if(!empty($second_sentence)) {
		$output .= ' data-second-sentence="'.$second_sentence.'"';
	}
	if(!empty($third_sentence)) {
		$output .= ' data-third-sentence="'.$third_sentence.'"';
	}
	if(!empty($fourth_sentence)) {
		$output .= ' data-fourth-sentence="'.$fourth_sentence.'"';
	}
	$output .= 'data-sentence-count="'.$count.'" data-loop="'.$loop.'" data-speed="'.$speed.'"></span>';

	return $output;
}
// Video Shortcode
function kad_youtube_shortcode_function( $atts, $content) {
		// Prepare data
		$return = array();
		$params = array();
		$atts = shortcode_atts(array(
				'url'  => false,
				'width' => 600,
				'height' => 400,
				'maxwidth' => '',
				'autoplay' => 'false',
				'controls' => 'true',
				'hidecontrols' => 'false',
				'fs' => 'true',
				'loop' => 'false',
				'rel' => 'false',
				'https' => 'true',
				'modestbranding' => 'false',
				'theme' => 'dark'
		), $atts, 'kad_youtube' );

		if ( !$atts['url'] ) return '<p class="error">YouTube: ' . __( 'please specify correct url', 'virtue' ) . '</p>';
		$id = ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $atts['url'], $match ) ) ? $match[1] : false;
		// Check that url is specified
		if ( !$id ) return '<p class="error">YouTube: ' . __( 'please specify correct url', 'virtue' ) . '</p>';
		// Prepare params
		if($atts['hidecontrols'] == 'true') {$atts['controls'] = 'false';}
		foreach ( array('autoplay', 'controls', 'fs', 'modestbranding', 'theme', 'rel', 'loop' ) as $param ) $params[$param] = str_replace( array( 'false', 'true', 'alt' ), array( '0', '1', '2' ), $atts[$param] );
		// Prepare player parameters
		$params = http_build_query( $params );
		if($atts['maxwidth']) {$maxwidth = 'style="max-width:'.$atts['maxwidth'].'px;"';} else{ $maxwidth = '';}
		// Create player
		$protocol = ( $atts['https'] === 'true' ) ? 'https' : 'http';

		$return[] = '<div class="kad-youtube-shortcode videofit" '.$maxwidth.' >';
		$return[] = '<iframe width="' . $atts['width'] . '" height="' . $atts['height'] . '" src="'.$protocol.'://www.youtube.com/embed/' . $id . '?' . $params . '" frameborder="0" allowfullscreen="true"></iframe>';
		$return[] = '</div>';
		// Return result
		return implode( '', $return );
}
function kad_vimeo_shortcode_function( $atts, $content) {
		$return = array();
		$atts = shortcode_atts( array(
				'url'        => false,
				'width'      => 600,
				'height'     => 400,
				'maxwidth' => '',
				'autoplay'   => 'no'
			), $atts, 'vimeo' );
		if ( !$atts['url'] ) return '<p class="error">Vimeo: ' . __( 'please specify correct url', 'virtue' ) . '</p>';
		$id = ( preg_match( '~(?:<iframe [^>]*src=")?(?:https?:\/\/(?:[\w]+\.)*vimeo\.com(?:[\/\w]*\/videos?)?\/([0-9]+)[^\s]*)"?(?:[^>]*></iframe>)?(?:<p>.*</p>)?~ix', $atts['url'], $match ) ) ? $match[1] : false;
		// Check that url is specified
		if ( !$id ) return '<p class="error">Vimeo: ' . __( 'please specify correct url', 'virtue' ) . '</p>';

		if($atts['maxwidth']) {$maxwidth = 'style="max-width:'.$atts['maxwidth'].'px;"';} else{ $maxwidth = '';}
		$autoplay = ( $atts['autoplay'] === 'yes' ) ? '&amp;autoplay=1' : '';
		// Create player
		$return[] = '<div class="kad-vimeo-shortcode  videofit" '.$maxwidth.'>';
		$return[] = '<iframe width="' . $atts['width'] . '" height="' . $atts['height'] .
			'" src="//player.vimeo.com/video/' . $id . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff' .
			$autoplay . '" frameborder="0" allowfullscreen="true"></iframe>';
		$return[] = '</div>';
		// Return result
		return implode( '', $return );
	}
//Simple Box
function kad_simple_box_shortcode_function( $atts, $content ) {
	extract(shortcode_atts(array(
		'padding_top' => '15',
		'padding_bottom' => '15',
		'padding_left' => '15',
		'padding_right' => '15',
		'min_height' => '1',
		'background' => '#ffffff',
		'style' => '',
		'opacity' => '1'
), $atts));
	$bg_color_rgb = kt_hex2rgb($background);
	if(!empty($style)) {$style = $style;} else {$style = '';}
    $bcolor = 'rgba('.$bg_color_rgb[0].', '.$bg_color_rgb[1].', '.$bg_color_rgb[2].', '.$opacity.');';
	return '<div class="kt-simple-box" style="background-color:'.$bcolor.' min-height:'.$min_height.'px; padding-top:'.$padding_top.'px; padding-bottom:'.$padding_bottom.'px; padding-left:'.$padding_left.'px; padding-right:'.$padding_right.'px; '.$style.'">'. do_shortcode($content) .'</div>';
}
//Button
function kad_button_shortcode_function( $atts) {
	extract(shortcode_atts(array(
		'id' => rand(1, 99),
		'bcolor' => '',
		'bhovercolor' => '',
		'thovercolor' => '',
		'link' => '',
		'border' => '0',
		'bordercolor' => '#000',
		'borderhovercolor' => '',
		'target' => '',
		'text' => '',
		'size' => 'medium',
		'font' => 'body',
		'icon' => '',
		'tcolor' => '',
), $atts));
	if($target == 'true' || $target == '_blank') {$target = '_blank';} else {$target = '_self';} 
	if($size == 'large'){$sizeclass = "lg-kad-btn";} else if ($size == 'small') {$sizeclass = "sm-kad-btn";} else {$sizeclass = "";}
	if($font == 'h1-family'){$fontclass = "headerfont";} else {$fontclass = "";}
	if(!empty($icon)) {$iconhtml = '<i class="'.$icon.'""></i>';} else {$iconhtml = "";}
	$output = '<a href="'.$link.'" id="kadbtn'.$id.'" target="'.$target.'" class="kad-btn btn-shortcode kad-btn-primary '.$sizeclass.' '.$fontclass.'" style="background-color:'.$bcolor.'; border: '.$border.' solid; border-color:'.$bordercolor.'; color:'.$tcolor.'">'.$text.' '.$iconhtml.'</a>';
	$output .= '<style type="text/css" media="screen">#kadbtn'.$id.':hover {';
	if(!empty($bhovercolor)) { $output .= 'background:'.$bhovercolor.' !important;';}
	if(!empty($thovercolor)) { $output .= 'color:'.$thovercolor.' !important;';}
	if(!empty($borderhovercolor)) {$output .= 'border-color:'.$borderhovercolor.'!important;';}
	$output .= '} </style>';
return $output;

}
function kad_blockquote_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'align' => 'center',
), $atts));
		switch ($align)
	{
		case "center":
		$output = '<div class="blockquote-full postclass clearfix">' . do_shortcode($content) . '</div>';
		break;
		
		case "left":
		$output = '<div class="blockquote-left postclass clearfix">' . do_shortcode($content) . '</div>';
		break;
		
		case "right":
		$output = '<div class="blockquote-right postclass clearfix">' . do_shortcode($content) . '</div>';
		break;
	}
	  return $output;
}
function kad_pullquote_shortcode_function( $atts, $content) {
   extract( shortcode_atts( array(
	  'align' => 'center'
  ), $atts ));

	switch ($align)
	{
		case "center":
		$output = '<div class="pullquote-center">' . do_shortcode($content) . '</div>';
		break;
		
		case "right":
		$output = '<div class="pullquote-right">' . do_shortcode($content) . '</div>';
		break;
		
		case "left":
		$output = '<div class="pullquote-left">' . do_shortcode($content) . '</div>';
		break;
	}

   return $output;
}
function kad_hrule_function($atts) {
	extract(shortcode_atts(array(
		'color' => '',
		'style' => 'line',
		'size' => ''
), $atts));
	if($style == 'dots') {
		$output = '<div class="hrule_dots clearfix" style="';
		if(!empty($color)) {$output .= 'border-color:'.$color.';';}
		if(!empty($size)) {$output .= ' border-top-width:'.$size; }
		$output .= '"></div>';
	} elseif ($style == 'gradient') {
		$output = '<div class="hrule_gradient"></div>';
	} else {
		$output = '<div class="hrule clearfix" style="';
		if(!empty($color)) {$output .= 'background:'.$color.';';}
		if(!empty($size)) {$output .= ' height:'.$size; }
		$output .= '"></div>';
	}

	return $output;
}
function kad_popover_function($atts, $content) {
	extract(shortcode_atts(array(
		'direction' => 'top',
		'text' => '',
		'title' => ''
), $atts));
		$output = '<a class="kad_popover" data-toggle="popover" data-placement="'.$direction.'" data-content="'.$text.'" data-original-title="'.$title.'">';
		$output .= $content;
		$output .= '</a>';

	return $output;
}
function kad_hrule_dots_function($atts) {
	extract(shortcode_atts(array(
		'color' => '',
		'size' => ''
), $atts));
	$output = '<div class="hrule_dots clearfix" style="';
	if(!empty($color)) {$output .= 'border-color:'.$color.';';}
	if(!empty($size)) {$output .= ' border-top-width:'.$size.'px;'; }
	$output .= '"></div>';

	return $output;
}
function kad_hrule_gradient_function() {
	$output = '<div class="hrule_gradient"></div>';
	return $output;
}
function kad_hrpadding_function($atts ) {
	extract(shortcode_atts(array(
		'size' => ''
), $atts));
	if(empty($size)) {$size = '10px';}
	return '<div class="kad-spacer clearfix" style="height:'.$size.'"></div>';
}
function kad_hrpadding_minus_10_function( ) {
	return '<div class="space_minus_10 clearfix"></div>';
}
function kad_hrpadding_minus_20_function( ) {
	return '<div class="space_minus_20 clearfix"></div>';
}
function kad_hrpadding10_function( ) {
	return '<div class="space_10 clearfix"></div>';
}
function kad_hrpadding20_function( ) {
	return '<div class="space_20 clearfix"></div>';
}
function kad_hrpadding40_function( ) {
	return '<div class="space_40 clearfix"></div>';
}
function kad_hrpadding30_function( ) {
	return '<div class="space_30 clearfix"></div>';
}
function kad_hrpadding80_function( ) {
	return '<div class="space_80 clearfix"></div>';
}
function kad_clearfix_function( ) {
	return '<div class="clearfix"></div>';
}
function kad_columnhelper_function( ) {
	return '';
}
function kadence_bc_shortcode( ) {
	ob_start(); ?>
	<div class="kt_shortcode_breadcrumbs">
	<?php kadence_breadcrumbs(); ?>
	</div>
	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}
function pinnacle_extra_shortcodes(){
add_shortcode('accordion', 'kad_accordion_shortcode_function');
   add_shortcode('pane', 'kad_accordion_pane_function');
   add_shortcode('tabs', 'kad_tab_shortcode_function');
   add_shortcode('tab', 'kad_tab_pane_function');
   add_shortcode('columns', 'kad_column_shortcode_function');
   add_shortcode('hcolumns', 'kad_hcolumn_shortcode_function');
   add_shortcode('span11', 'kad_column11_function');
   add_shortcode('span10', 'kad_column10_function');
   add_shortcode('span9', 'kad_column9_function');
   add_shortcode('span8', 'kad_column8_function');
   add_shortcode('span7', 'kad_column7_function');
   add_shortcode('span6', 'kad_column6_function');
   add_shortcode('span5', 'kad_column5_function');
   add_shortcode('span4', 'kad_column4_function');
   add_shortcode('span3', 'kad_column3_function');
   add_shortcode('span2', 'kad_column2_function');
   add_shortcode('span25', 'kad_column25_function');
   add_shortcode('span1', 'kad_column1_function');
   add_shortcode('columnhelper', 'kad_columnhelper_function');
   add_shortcode('icon', 'kad_icon_shortcode_function');
   add_shortcode('pullquote', 'kad_pullquote_shortcode_function');
   add_shortcode('blockquote', 'kad_blockquote_shortcode_function');
   add_shortcode('btn', 'kad_button_shortcode_function');
   add_shortcode('hr', 'kad_hrule_function');
   add_shortcode('hr_dots', 'kad_hrule_dots_function');
   add_shortcode('hr_gradient', 'kad_hrule_gradient_function');
   add_shortcode('minus_space_10', 'kad_hrpadding_minus_10_function');
   add_shortcode('minus_space_20', 'kad_hrpadding_minus_20_function');
   add_shortcode('space_10', 'kad_hrpadding10_function');
   add_shortcode('space_20', 'kad_hrpadding20_function');
   add_shortcode('space_30', 'kad_hrpadding30_function');
   add_shortcode('space_40', 'kad_hrpadding40_function');
   add_shortcode('space_80', 'kad_hrpadding80_function');
   add_shortcode('space', 'kad_hrpadding_function');
   add_shortcode('clear', 'kad_clearfix_function');
   add_shortcode('infobox', 'kad_info_boxes_shortcode_function');
   add_shortcode('iconbox', 'kad_icon_boxes_shortcode_function');
   add_shortcode('carousel', 'kad_carousel_shortcode_function');
   add_shortcode('blog_posts', 'kad_blog_shortcode_function');
   add_shortcode('testimonial_posts', 'kad_testimonial_shortcode_function');
   add_shortcode('custom_carousel', 'kad_custom_carousel_shortcode_function');
   add_shortcode('carousel_item', 'kad_custom_carousel_item_shortcode_function');
   add_shortcode('img_menu', 'kad_image_menu_shortcode_function');
   add_shortcode('gmap', 'kad_map_shortcode_function');
   add_shortcode('portfolio_posts', 'kad_portfolio_shortcode_function');
   add_shortcode('portfolio_types', 'kad_portfolio_cat_shortcode_function');
   add_shortcode('staff_posts', 'kad_staff_shortcode_function');
   add_shortcode('kad_youtube', 'kad_youtube_shortcode_function');
   add_shortcode('kad_vimeo', 'kad_vimeo_shortcode_function');
   add_shortcode('kad_popover', 'kad_popover_function');
   add_shortcode('kad_modal', 'kad_modal_shortcode_function');
   add_shortcode('kt_imgsplit', 'kad_image_split_shortcode_function');
   add_shortcode('kt_box', 'kad_simple_box_shortcode_function');
   add_shortcode('kt_breadcrumbs', 'kadence_bc_shortcode');
   add_shortcode('kt_typed', 'kadence_typed_text_shortcode_function');
   add_shortcode('kt_post_carousel', 'kad_latest_posts_carousel_shortcode_function');
}
add_action( 'init', 'pinnacle_extra_shortcodes');


} //    Close for plugin
function pinnacle_register_shortcodes(){
	add_shortcode('the-year', 'kad_year_shortcode_function');
	add_shortcode('copyright', 'kad_copyright_shortcode_function');
	add_shortcode('site-name', 'kad_sitename_shortcode_function');
	add_shortcode('site-tagline', 'kad_sitetagline_shortcode_function');
	add_shortcode('theme-credit', 'kad_themecredit_shortcode_function');
}
add_action( 'init', 'pinnacle_register_shortcodes');
//    Clean up Shortcodes

function kad_content_clean_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'kad_content_clean_shortcodes');
function kad_widget_clean_shortcodes($text){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        '<p></p>' => '', 
        ']<br />' => ']'
    );
    $text = strtr($text, $array);
    return $text;
}
add_filter('widget_text', 'kad_widget_clean_shortcodes');
remove_filter('widget_text', 'do_shortcode');
add_filter('widget_text', 'do_shortcode', 50);
add_action( 'init', 'kt_remove_bstw_do_shortcode' );
function kt_remove_bstw_do_shortcode() {
    if ( function_exists( 'bstw' ) ) {
        remove_filter( 'widget_text', array( bstw()->text_filters(), 'do_shortcode' ), 10 );
    }
}

