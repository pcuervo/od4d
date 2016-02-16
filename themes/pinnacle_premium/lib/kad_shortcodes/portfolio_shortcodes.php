<?php 
//Shortcode for portfolio Posts
function kad_portfolio_shortcode_function( $atts, $content) {
	extract(shortcode_atts(array(
		'orderby' => 'menu_order',
		'cat' => '',
		'columns' => '4',
		'id' => rand(10,100),
		'lightbox' => 'false',
		'offset' => null,
		'isostyle' => 'masonry',
		'layoutstyle' => 'default',
		'hoverstyle' => 'default',
		'masonry' => false,
		'fullwidth' => "false",
		'usefullwidthdiv' => "true",
		'ratio' => 'default',
		'filter' => false,
		'showtypes' => 'true',
		'showexcerpt' => 'false',
		'items' => '4'
), $atts));
	global $pinnacle;
	if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;}
	if($orderby == 'menu_order') {$order = 'ASC';} else {$order = 'DESC';} 
			if(empty($cat)) { 
				$portfolio_cat_slug = ''; 
				$portfolio_cat_ID = ''; 
			} else {
				$portfolio_cat_slug = $cat;
				$portfolio_cat = get_term_by ('slug',$cat,'portfolio-type' );
				$portfolio_cat_ID = $portfolio_cat -> term_id;
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

			if (($fullwidth == "true") && ($usefullwidthdiv == "true")) { echo '<div class="p-shortcode-container panel-row-style-wide-content">'; } 
	  		if ($filter) { 
      			echo '<section id="kt-filter-options" class="clearfix">';
				 if(!empty($pinnacle['filter_all_text'])) {$alltext = $pinnacle['filter_all_text'];} else {$alltext = __('All', 'pinnacle');}
					  if(!empty($pinnacle['portfolio_filter_text'])) {$portfoliofiltertext = $pinnacle['portfolio_filter_text'];} else {$portfoliofiltertext = __('Filter Projects', 'pinnacle');}
					$termtypes = array( 'child_of' => $portfolio_cat_ID,);
					$categories= get_terms('portfolio-type', $termtypes);
					$count = count($categories);
						echo '<a class="filter-trigger headerfont" data-toggle="collapse" data-target=".filter-collapse"><i class="icon-tags"></i> '.$portfoliofiltertext.'</a>';
						echo '<ul id="filters" class="clearfix option-set filter-collapse">';
						echo '<li class="postclass"><a href="#" data-filter="*" title="All" class="selected"><h5>'.$alltext.'</h5><div class="arrow-up"></div></a></li>';
						 if ( $count > 0 ){
							foreach ($categories as $category){ 
							$termname = strtolower($category->slug);
							$termname = preg_replace("/[^a-zA-Z 0-9]+/", " ", $termname);
							$termname = str_replace(' ', '-', $termname);
							echo '<li class="postclass"><a href="#" data-filter=".'.$termname.'" title="" rel="'.$termname.'"><h5>'.$category->name.'</h5><div class="arrow-up"></div></a></li>';
								}
				 		}
				 		echo "</ul>";
				echo '</section>';
             }
             if ($filter) { $shortcodeclasses[] = 'kad_pfilter_class';}
             $shortcodeclasses[] = $pstyleclass;
             $shortcodeclasses[] = $phoverstyleclass;
             $shortcodeclasses[] = 'kt-portfolio-shortcode';
             global $kt_portfolio_loop;
                 $kt_portfolio_loop = array(
                 	'lightbox' => $lightbox,
                 	'showexcerpt' => $showexcerpt,
                 	'showtypes' => $showtypes,
                 	'pstyleclass' => $pstyleclass,
                 	'viewdetails' => $viewdetails,
                 	'slidewidth' => $slidewidth,
                 	'slideheight' => $slideheight,
                 	);

						
		ob_start(); ?>
				<div id="portfoliowrapper-<?php echo esc_attr($id);?>" class="rowtight init-isotope <?php echo implode(" ", $shortcodeclasses);?>" style="margin-bottom:0;" data-fade-in="<?php echo esc_attr($animate);?>" data-iso-selector=".p-item" data-iso-style="<?php echo esc_attr($isostyle);?>" data-iso-filter="true"> 
            	<?php   $wp_query = null; 
				  		$wp_query = new WP_Query();
				        $wp_query->query(array(
				        	'orderby' 			=> $orderby,
				        	'order' 			=> $order,
				        	'post_type' 		=> 'portfolio',
				        	'portfolio-type'	=>$portfolio_cat_slug,
				        	'offset' 			=> $offset,
				        	'posts_per_page'	=> $items
				        	)
				        );
					    $count =0;
					    if ( $wp_query ) : 
					    while ( $wp_query->have_posts() ) : $wp_query->the_post();
							global $post;
							$terms = get_the_terms( $post->ID, 'portfolio-type' );
							if ( $terms && ! is_wp_error( $terms ) ) : $links = array();
								foreach ( $terms as $term ) { $links[] = $term->slug;}
									$links = preg_replace("/[^a-zA-Z 0-9]+/", " ", $links);
									$links = str_replace(' ', '-', $links);	
									$tax = join( " ", $links );		
								else :	
									$tax = '';	
								endif;
						?>

					<div class="<?php echo esc_attr($itemsize);?> <?php echo strtolower($tax); ?> all p-item">
                	<?php do_action('kadence_portfolio_loop_start');
							get_template_part('templates/content', 'loop-portfolio'); 
						  do_action('kadence_portfolio_loop_end');
					?>
                    </div>
					<?php endwhile; else: ?>
					 
					<li class="error-not-found"><?php _e('Sorry, no portfolio entries found.', 'pinnacle');?></li>
						
				<?php endif; ?>
                </div> <!--portfoliowrapper-->
               <?php $wp_query = null; wp_reset_query(); ?>

    <?php if (($fullwidth == "true") && ($usefullwidthdiv == "true")) { ?> </div> <?php } ?>
	<?php  $output = ob_get_contents();
		ob_end_clean();
	return $output;
}