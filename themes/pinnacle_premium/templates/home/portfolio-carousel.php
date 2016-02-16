<?php global $pinnacle; 
	if(isset($pinnacle['home_portfolio_carousel_count'])) {$hp_pcount = $pinnacle['home_portfolio_carousel_count'];} else {$hp_pcount = '8';}
	if(isset($pinnacle['home_portfolio_carousel_speed'])) {$hport_speed = $pinnacle['home_portfolio_carousel_speed'].'000';} else {$hport_speed = '9000';}
	if(isset($pinnacle['home_portfolio_order'])) {$hp_orderby = $pinnacle['home_portfolio_order'];} else {$hp_orderby = 'menu_order';}
	if(isset($pinnacle['home_portfolio_carousel_scroll']) && $pinnacle['home_portfolio_carousel_scroll'] == 'all' ) {$hport_scroll = '';} else {$hport_scroll = '1';}
	if(isset($pinnacle['portfolio_show_type']) && $pinnacle['portfolio_show_type'] == 1) {$portfolio_item_types = 'true';} else {$portfolio_item_types = 'false';}
	if(isset($pinnacle['home_port_car_layoutstyle'])) {$layoutstyle = $pinnacle['home_port_car_layoutstyle'];} else {$layoutstyle = 'default';}
	if(isset($pinnacle['home_port_car_hoverstyle'])) {$hoverstyle = $pinnacle['home_port_car_hoverstyle'];} else {$hoverstyle = 'default';}
	if(isset($pinnacle['home_port_car_imageratio'])) {$ratio = $pinnacle['home_port_car_imageratio'];} else {$ratio = 'default';}
	if(isset($pinnacle['portfolio_show_excerpt']) && $pinnacle['portfolio_show_excerpt'] == 1) {$showexcerpt = 'true';} else {$showexcerpt = 'false';}
	if(isset($pinnacle['portfolio_car_fullwidth']) && $pinnacle['portfolio_car_fullwidth'] == 1) {$fullwidth = true;} else {$fullwidth = false;}
	if(isset($pinnacle['portfolio_car_lightbox']) && $pinnacle['portfolio_car_lightbox'] == 1) {$plb = 'true';} else {$plb = 'false';}
	if(isset($pinnacle['home_portfolio_carousel_column'])) {$columns = $pinnacle['home_portfolio_carousel_column'];} else {$columns = 3;}
	if($hp_orderby == 'menu_order') {$p_order = 'ASC';} else {$p_order = 'DESC';}
	if(!empty($pinnacle['portfolio_type'])) {
							$port_cat = get_term_by ('id',$pinnacle['portfolio_type'],'portfolio-type');
							$portfolio_category = $port_cat -> slug;
						} else {
							$portfolio_category = '';
						}
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
            if(isset($pinnacle['portfolio_viewdetails_text']) && !empty($pinnacle['portfolio_viewdetails_text']) ) {
            	$viewdetails = $pinnacle['portfolio_viewdetails_text'];
	        } else {
	            $viewdetails = __('View details', 'pinnacle');
	        }

		if($fullwidth) {
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


    echo '<div class="home-portfolio home-margin carousel_outerrim home-padding kad-animation" data-animation="fade-in" data-delay="0">';
	if(!empty($pinnacle['portfolio_title'])) { echo '<div class="clearfix"><h3 class="hometitle">'.$pinnacle['portfolio_title'].'</h3></div>';}
	if ($fullwidth) { echo '<div class="p-home-container panel-row-style-wide-content">'; } 

	$shortcodeclasses[] = $pstyleclass;
    $shortcodeclasses[] = $phoverstyleclass;
    $shortcodeclasses[] = 'kt-portfolio-homepage';
    // Set global loop var
        global $kt_portfolio_loop;
                 $kt_portfolio_loop = array(
                 	'lightbox' => $plb,
                 	'showexcerpt' => $showexcerpt,
                 	'showtypes' => $portfolio_item_types,
                 	'pstyleclass' => $pstyleclass,
                 	'viewdetails' => $viewdetails,
                 	'slidewidth' => $slidewidth,
                 	'slideheight' => $slideheight,
                 	);

		                ?>

		<div class="home-margin fredcarousel">
		<div id="carouselcontainer-portfolio" class="<?php echo implode(" ", $shortcodeclasses);?> rowtight fadein-carousel">
		<div id="portfolio-carousel" class="clearfix caroufedselclass initcaroufedsel clearfix" data-carousel-container="#carouselcontainer-portfolio" data-carousel-transition="700" data-carousel-scroll="<?php echo esc_attr($hport_scroll); ?>" data-carousel-auto="true" data-carousel-speed="<?php echo esc_attr($hport_speed); ?>" data-carousel-id="portfolio" data-carousel-sxl="<?php echo esc_attr($sxl);?>" data-carousel-xl="<?php echo esc_attr($xl);?>" data-carousel-md="<?php echo esc_attr($md);?>" data-carousel-sm="<?php echo esc_attr($sm);?>" data-carousel-xs="<?php echo esc_attr($xs);?>" data-carousel-ss="<?php echo esc_attr($ss);?>">
		<?php 
				$temp = $wp_query; 
				  $wp_query = null; 
				  $wp_query = new WP_Query();
				  $wp_query->query(array(
					'orderby' => $hp_orderby,
					'order' => $p_order,
					'post_type' => 'portfolio',
					'portfolio-type'=>$portfolio_category,
					'posts_per_page' => $hp_pcount));
					$count =0;
					?>
					<?php if ( $wp_query ) : 
							 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<div class="<?php echo $itemsize;?> all p-item">
                	<?php do_action('kadence_portfolio_loop_start');
							get_template_part('templates/content', 'loop-portfolio'); 
						  do_action('kadence_portfolio_loop_start');
					?>
                    </div>
					<?php endwhile; else: ?>
					<li class="error-not-found"><?php _e('Sorry, no portfolio entries found.', 'pinnacle');?></li>
						
				<?php endif; ?>
                                    
                    <?php 
                      $wp_query = null; 
                      $wp_query = $temp;  // Reset
                    ?>
                    <?php wp_reset_query(); ?>
                </div>
            </div>
<div class="clearfix"></div>
            <a id="prevport-portfolio" class="prev_carousel kt-icon-arrow-left" href="#"></a>
			<a id="nextport-portfolio" class="next_carousel kt-icon-arrow-right" href="#"></a>
</div> <!-- fred Carousel-->
</div> <!--featclass -->
<?php if ($fullwidth) { echo '</div>'; } ?>

