<?php global $pinnacle; 
if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;}
if(isset($pinnacle['home_port_columns'])) {$columns = $pinnacle['home_port_columns'];} else {$columns = '4';}
if(isset($pinnacle['home_port_count'])) {$items = $pinnacle['home_port_count'];} else {$items = '8';}
if(isset($pinnacle['home_port_layoutstyle'])) {$layoutstyle = $pinnacle['home_port_layoutstyle'];} else {$layoutstyle = 'default';}
if(isset($pinnacle['home_port_hoverstyle'])) {$hoverstyle = $pinnacle['home_port_hoverstyle'];} else {$hoverstyle = 'default';}
if(isset($pinnacle['home_port_imageratio'])) {$ratio = $pinnacle['home_port_imageratio'];} else {$ratio = 'default';}
if(isset($pinnacle['portfolio_full_show_type']) && $pinnacle['portfolio_full_show_type'] == 1) {$portfolio_item_types = 'true';} else {$portfolio_item_types = 'false';}
if(isset($pinnacle['portfolio_full_show_excerpt']) && $pinnacle['portfolio_full_show_excerpt'] == 1) {$showexcerpt = 'true';} else {$showexcerpt = 'false';}
if(isset($pinnacle['portfolio_full_filter']) && $pinnacle['portfolio_full_filter'] == 1) {$filter = true;} else {$filter = false;}
if(isset($pinnacle['portfolio_full_fullwidth']) && $pinnacle['portfolio_full_fullwidth'] == 1) {$fullwidth = true;} else {$fullwidth = false;}
if(isset($pinnacle['portfolio_full_masonry']) && $pinnacle['portfolio_full_masonry'] == 1) {$masonry = true;} else {$masonry = false;}
if(!empty($pinnacle['home_portfolio_lightbox']) && $pinnacle['home_portfolio_lightbox'] == 1) {$plb = 'true';} else {$plb = 'false';}
if(isset($pinnacle['home_portfolio_full_order'])) {$orderby = $pinnacle['home_portfolio_full_order'];} else {$orderby = 'menu_order';}
if($orderby == 'menu_order') {$order = 'ASC';} else {$order = 'DESC';} 

if(!empty($pinnacle['portfolio_full_type'])) {
	$port_cat = get_term_by ('id',$pinnacle['portfolio_full_type'],'portfolio-type');
	$portfolio_cat_slug = $port_cat -> slug;
	$portfolio_cat_ID = $pinnacle['portfolio_full_type'];
} else {
	$portfolio_cat_ID = '';
	$portfolio_cat_slug = '';
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
			
			if ($masonry) {$slideheight = '';}

			echo '<div class="home-portfolio clearfix home-margin home-padding">';
			if(!empty($pinnacle['portfolio_full_title'])) { echo '<div class="clearfix"><h3 class="hometitle">'.$pinnacle['portfolio_full_title'].'</h3></div>';}

			if ($fullwidth) { echo '<div class="p-home-container panel-row-style-wide-content">'; } 
	  		if ($filter) { 
      			echo '<section id="options" class="kt-filter-options clearfix">';
				 if(!empty($pinnacle['filter_all_text'])) {$alltext = $pinnacle['filter_all_text'];} else {$alltext = __('All', 'virtue');}
					  if(!empty($pinnacle['portfolio_filter_text'])) {$portfoliofiltertext = $pinnacle['portfolio_filter_text'];} else {$portfoliofiltertext = __('Filter Projects', 'virtue');}
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
            <div id="portfoliowrapper-home" class="rowtight init-isotope <?php echo implode(" ", $shortcodeclasses);?>" style="margin-bottom:0;" data-fade-in="<?php echo $animate;?>" data-iso-selector=".p-item" data-iso-style="masonry" data-iso-filter="true"> 
            	<?php   $wp_query = null; 
				  		$wp_query = new WP_Query();
				        $wp_query->query(array('orderby' => $orderby,'order' => $order,'post_type' => 'portfolio','portfolio-type'=>$portfolio_cat_slug,'posts_per_page' => $items));
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

					<div class="<?php echo $itemsize;?> <?php echo strtolower($tax); ?> all p-item">
                	<?php do_action('kadence_portfolio_loop_start');
							get_template_part('templates/content', 'loop-portfolio'); 
						  do_action('kadence_portfolio_loop_start');
					?>
                    </div>
					<?php endwhile; else: ?>
					 
					<li class="error-not-found"><?php _e('Sorry, no portfolio entries found.', 'virtue');?></li>
						
				<?php endif; ?>
                </div> <!--portfoliowrapper-->
               <?php $wp_query = null; wp_reset_query(); ?>

 <?php if ($fullwidth) { ?> </div> <?php } ?>
</div><!-- /.home-portfolio -->

