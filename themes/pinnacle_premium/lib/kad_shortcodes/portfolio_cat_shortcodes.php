<?php 
//Shortcode for portfolio Posts
function kad_portfolio_cat_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'columns' => '4',
		'id' => rand(10,100),
		'layoutstyle' => 'default',
		'hoverstyle' => 'default',
		'masonry' => false,
		'fullwidth' => false,
		'ratio' => 'default',
		'childof' => '0',
		'childcategories' => false,
		'showexcerpt' => false,
		'items' => '4'
), $atts));
	global $pinnacle;
	if($childcategories == true) {$parent = "";} else {$parent = "0";}
	if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;}
			if($layoutstyle == 'default') {
		      		if(isset($pinnacle['portfolio_style_default'])) {
		      			$pstyleclass = $pinnacle['portfolio_style_default'];
		      		} else {
		      			$pstyleclass = 'padded_style';
		      		}
	      	} else {
	    		$pstyleclass = $layoutstyle;
	      	}
	      	if($hoverstyle == 'default') {
		      		if(isset($pinnacle['portfolio_hover_style_default'])) {
		      			$phoverstyleclass = $pinnacle['portfolio_hover_style_default'];
		      		} else {
		      			$phoverstyleclass = 'p_lightstyle';
		      		}
	      	} else {
	      		$phoverstyleclass = $hoverstyle;
	      	}
	 		if($ratio == 'default') {
                 if(isset($pinnacle['portfolio_ratio_default'])) {
                   	$pimgratio = $pinnacle['portfolio_ratio_default'];
                	} else {
                   	 $pimgratio = "square";
                   	}
            } else {
              $pimgratio = $ratio;
            }
            
            if($fullwidth == "true") {
                if ($columns == '2') {$itemsize = 'tcol-sxl-3 tcol-xl-4 tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 700; $sxl = 4;  $xl = 3; $md = 2; $sm = 2; $xs = 1; $ss = 1;} 
			    else if ($columns == '3'){ $itemsize = 'tcol-sxl-25 tcol-xl-3 tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 460; $sxl = 5;  $xl = 4; $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
			    else if ($columns == '6'){ $itemsize = 'tcol-sxl-2 tcol-xl-2 tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $sxl = 6; $xl = 6; $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
			    else if ($columns == '5'){ $itemsize = 'tcol-sxl-2 tcol-xl-2 tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $sxl = 6;  $xl = 6; $md = 5; $sm = 4; $xs = 3; $ss = 2;} 
			    else {$itemsize = 'tcol-sxl-2 tcol-xl-25 tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 360; $sxl = 6; $xl = 5; $md = 4; $sm = 3; $xs = 2; $ss = 1;}
            } else {
		        if ($columns == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 600; $sxl = 2; $xl = 2; $md = 2; $sm = 2; $xs = 1; $ss = 1;} 
		        else if ($columns == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 400; $sxl = 3; $xl = 3; $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
		        else if ($columns == '6'){ $itemsize = 'tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300;  $sxl = 6; $xl = 6; $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
		        else if ($columns == '5'){ $itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $sxl = 5; $xl = 5; $md = 5; $sm = 4; $xs = 3; $ss = 2;} 
		        else {$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 300; $sxl = 4; $xl = 4; $md = 4; $sm = 3; $xs = 2; $ss = 1;}
		    }		    
		    if($pimgratio == 'portrait') {
				$temppimgheight = $slidewidth * 1.35;
				$slideheight = floor($temppimgheight);
			} else if($pimgratio == 'landscape') {
				$temppimgheight = $slidewidth / 1.35;
				$slideheight = floor($temppimgheight);
			} else if($pimgratio == 'widelandscape') {
				$temppimgheight = $slidewidth / 2;
				$slideheight = floor($temppimgheight);
			} else {
				$slideheight = $slidewidth;
			}
			
			if ($masonry) {$slideheight = '';}

			//if ($fullwidth) { echo '<div class="p-shortcode-container panel-row-style-wide-content">'; } 
             $shortcodeclasses[] = $pstyleclass;
             $shortcodeclasses[] = $phoverstyleclass;
             $shortcodeclasses[] = 'kt-portfolio-shortcode';
						
		ob_start(); ?>
				<div id="portfoliowrapper-<?php echo $id;?>" class="rowtight init-isotope <?php echo implode(" ", $shortcodeclasses);?>" style="margin-bottom:0;" data-fade-in="<?php echo $animate;?>" data-iso-filter="false" data-iso-selector=".p-item"> 
            	<?php 	$meta = get_option('portfolio_cat_image');
						if (empty($meta)) {$meta = array();}
						if (!is_array($meta)) { $meta = (array) $meta; }
						$args = array( 'parent'=>$parent,'hide_empty'=>'1', 'child_of' => $childof, 'orderby' => $orderby, 'order'=>$order, );
            			$terms = get_terms("portfolio-type", $args);
					if ( !empty( $terms ) && !is_wp_error( $terms ) ) {
						foreach ( $terms as $term ) : ?>
					<div class="<?php echo $itemsize;?> p-item">
                		<div class="portfolio-item grid_item postclass kt_item_fade_in kad-light-gallery kad_portfolio_fade_in">
								<?php $cat_term_id = $term -> term_id;
									if(isset($meta[$cat_term_id])) {$item_meta = $meta[$cat_term_id];} else {$item_meta = array();}
									if(isset($item_meta['category_image'])) { $bg_image_array = $item_meta['category_image']; $src = wp_get_attachment_image_src($bg_image_array[0], 'full'); $ct_image = $src[0];}
									if (!empty($ct_image)) {
									 $image = aq_resize($ct_image, $slidewidth, $slideheight, true);
									if(empty($image)) {$image = $ct_image;} ?>
									<div class="portfolio-imagepadding">
										<div class="portfolio-hoverclass">
										<a href="<?php echo get_term_link( $term );  ?>" class="">
	                                       	<img src="<?php echo $image ?>" alt="<?php the_title(); ?>" class="kad-lightboxhover">
	                                       	<div class="portfolio-hoverover"></div>
	                                       	<div class="portfolio-table">
	                                       		<div class="portfolio-cell">
	                                       		<?php if($pstyleclass == "padded_style" ) { ?>
		                                       		<a href="<?php echo get_term_link( $term );  ?>" class="kad-btn kad-btn-primary"><?php echo __('View', 'pinnacle');?></a>
		                                       	<?php } elseif($pstyleclass == "flat-no-margin" || $pstyleclass == "flat-w-margin" ) { ?>
		                                       		<h5><?php echo $term->name; ?></h5>
		                                       		<?php if($showexcerpt) {?> <p class="p_excerpt"><?php echo $term -> description; ?></p> <?php } ?>
		                                       	<?php } ?>
		                                       	</div>
	                                       	</div>
	                                   	</a>
	                                  	</div>
	                                </div>
	                                <?php $image = null; $ct_image = null;?>
							<?php } ?>
							<?php if($pstyleclass == "padded_style" ) { ?>
		              		<a href="<?php echo get_term_link( $term );  ?>" class="portfoliolink">
			              	<div class="piteminfo">   
								<h5><?php echo $term->name; ?></h5>
								<?php if($showexcerpt) {?> <p class="p_excerpt"><?php echo $term -> description; ?></p> <?php } ?>
			                </div>
		                	</a>
		                	<?php } ?>
                		</div>
                    </div>
					<?php endforeach;  
					} ?>
			</div> <!--portfoliowrapper-->
    <?php //if ($fullwidth) { echo '</div>'; } ?>
	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}