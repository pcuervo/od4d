<?php get_header(); ?>
		<?php get_template_part('templates/archive', 'header'); ?>
		 <?php global $pinnacle;
		 if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;}
		 if(!empty($pinnacle['portfolio_tax_fullwidth'])) {$portfolio_fullwidth = $pinnacle['portfolio_tax_fullwidth'];} else {$portfolio_fullwidth = '0';}
		 if(!empty($pinnacle['portfolio_tax_masonry'])) {$portfolio_masonry = $pinnacle['portfolio_tax_masonry'];} else {$portfolio_masonry = '0';}
		 if(!empty($pinnacle['portfolio_tax_filter'])) {$portfolio_filter = $pinnacle['portfolio_tax_filter'];} else {$portfolio_filter = '0';}
		 if(!empty($pinnacle['portfolio_tax_items'])) {$portfolio_items = $pinnacle['portfolio_tax_items'];} else {$portfolio_items = '12';}
		 if(isset($pinnacle['portfolio_style_default'])) {
		      			$pstyleclass = $pinnacle['portfolio_style_default'];
		      		} else {
		      			$pstyleclass = 'padded_style';
		      		}
		 if(isset($pinnacle['portfolio_ratio_default'])) {
                   	 			$pimgratio = $pinnacle['portfolio_ratio_default'];
                   	 		} else {
                   	 			$pimgratio = "square";
                   	 		}
        if(isset($pinnacle['portfolio_hover_style_default'])) {
		      			$phoverstyleclass = $pinnacle['portfolio_hover_style_default'];
		      		} else {
		      			$phoverstyleclass = 'p_lightstyle';
		      		}
		    if(isset($pinnacle['portfolio_viewdetails_text']) && !empty($pinnacle['portfolio_viewdetails_text']) ) {
            	$viewdetails = $pinnacle['portfolio_viewdetails_text'];
	        } else {
	            $viewdetails = __('View details', 'pinnacle');
	        }
	        if(isset($pinnacle['portfolio_type_under_title']) && $pinnacle['portfolio_type_under_title'] == '0') {
					$portfolio_item_types = 'false';
				} else {
					$portfolio_item_types = 'true';
				}
				if(isset($pinnacle['portfolio_tax_show_excerpt']) && $pinnacle['portfolio_tax_show_excerpt'] == '0') {
					$portfolio_excerpt = 'false';
				} else {
					$portfolio_excerpt = 'true';
				}
				if(isset($pinnacle['portfolio_tax_lightbox']) && $pinnacle['portfolio_tax_lightbox'] == '0') {
					$portfolio_lightbox = 'false';
				} else {
					$portfolio_lightbox = 'true';
				}
		 if(!empty($pinnacle['portfolio_tax_column'])) {$portfolio_column = $pinnacle['portfolio_tax_column'];} else {$portfolio_column = 4;}
		                if(!empty($portfolio_fullwidth) && $portfolio_fullwidth == '1') {
			                if ($portfolio_column == '2') {$itemsize = 'tcol-sxl-3 tcol-xl-4 tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 700; $sxl = 4;  $xl = 3; $md = 2; $sm = 2; $xs = 1; $ss = 1;} 
						    else if ($portfolio_column == '3'){ $itemsize = 'tcol-sxl-25 tcol-xl-3 tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 460; $sxl = 5;  $xl = 4; $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
						    else if ($portfolio_column == '6'){ $itemsize = 'tcol-sxl-2 tcol-xl-2 tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $sxl = 6; $xl = 6; $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
						    else if ($portfolio_column == '5'){ $itemsize = 'tcol-sxl-2 tcol-xl-2 tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $sxl = 6;  $xl = 6; $md = 5; $sm = 4; $xs = 3; $ss = 2;} 
						    else {$itemsize = 'tcol-sxl-2 tcol-xl-25 tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 360; $sxl = 6; $xl = 5; $md = 4; $sm = 3; $xs = 2; $ss = 1;}
			            } else {
					        if ($portfolio_column == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 600; $sxl = 2; $xl = 2; $md = 2; $sm = 2; $xs = 1; $ss = 1;} 
					        else if ($portfolio_column == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 400; $sxl = 3; $xl = 3; $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
					        else if ($portfolio_column == '6'){ $itemsize = 'tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300;  $sxl = 6; $xl = 6; $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
					        else if ($portfolio_column == '5'){ $itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $sxl = 5; $xl = 5; $md = 5; $sm = 4; $xs = 3; $ss = 2;} 
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
						if (!empty($portfolio_masonry) && $portfolio_masonry == '1') {$slideheight = '';}
		if ($portfolio_fullwidth == '1') { $contentclass = "kad-fullwidth"; } else {$contentclass = "";} 
		$showexcerpt = 'false';
		// Set global loop var
        global $kt_portfolio_loop;
                 $kt_portfolio_loop = array(
                 	'lightbox' => $portfolio_lightbox,
                 	'showexcerpt' => $portfolio_excerpt,
                 	'showtypes' => $portfolio_item_types,
                 	'pstyleclass' => $pstyleclass,
                 	'viewdetails' => $viewdetails,
                 	'slidewidth' => $slidewidth,
                 	'slideheight' => $slideheight,
                 	);
		            ?> 
		            <div id="content" class="container <?php echo esc_attr($contentclass);?>">
   		<div class="row">
      <div class="main <?php echo kadence_main_class(); ?>" role="main">
      	<?php echo category_description(); ?> 
      	<?php if (!have_posts()) : ?>
		<div class="alert">
		    <?php _e('Sorry, no results were found.', 'pinnacle'); ?>
		</div>
		  <?php get_search_form(); ?>
		<?php endif; ?>
		<?php if ($portfolio_filter == '1') { ?>
      		<section id="options" class="kt-filter-options clearfix">
			<?php if(!empty($pinnacle['filter_all_text'])) {$alltext = $pinnacle['filter_all_text'];} else {$alltext = __('All', 'pinnacle');}
			if(!empty($pinnacle['portfolio_filter_text'])) {$portfoliofiltertext = $pinnacle['portfolio_filter_text'];} else {$portfoliofiltertext = __('Filter Projects', 'pinnacle');}
			global $wp_query;
				// get the query object
					$cat_obj = $wp_query->get_queried_object();
					$portfolio_cat_ID  = $cat_obj->term_id;
					$termtypes = array( 'child_of' => $portfolio_cat_ID,);
					$categories= get_terms('portfolio-type', $termtypes);
					$count = count($categories);
						echo '<a class="filter-trigger headerfont" data-toggle="collapse" data-target=".filter-collapse"><i class="kt-icon-tags"></i> '.$portfoliofiltertext.'</a>';
						echo '<ul id="filters" class="clearfix option-set filter-collapse">';
						echo '<li class="postclass"><a href="#" data-filter="*" title="All" class="selected"><h5>'.$alltext.'</h5><div class="arrow-up"></div></a></li>';
						 if ( $count > 0 ){
							foreach ($categories as $category){ 
							$termname = strtolower($category->slug);
							$termname = preg_replace("/[^a-zA-Z 0-9]+/", " ", $termname);
							$termname = str_replace(' ', '-', $termname);
							echo '<li class="postclass"><a href="#" data-filter=".'.esc_attr($termname).'" title="" rel="'.esc_attr($termname).'"><h5>'.esc_html($category->name).'</h5><div class="arrow-up"></div></a></li>';
								}
				 		}
				 		echo "</ul>"; ?>
				</section>
            <?php } ?>                   
		<div id="portfoliowrapper" class="rowtight init-isotope <?php echo esc_attr($pstyleclass);?> <?php echo esc_attr($phoverstyleclass);?> <?php if ($portfolio_filter == 'yes') {echo 'kad_pfilter_class';}?>" data-fade-in="<?php echo esc_attr($animate);?>" data-iso-selector=".p-item" data-iso-style="masonry" data-iso-filter="true"> 
		<?php global $wp_query;
					$cat_obj = $wp_query->get_queried_object();
		 			$termslug = $cat_obj->slug;
					query_posts(array( 'paged' => $paged, 'posts_per_page' => $portfolio_items, 'orderby' => 'menu_order', 'order' => 'ASC', 'post_type' => 'portfolio', 'portfolio-type' => $termslug) );
		 			while (have_posts()) : the_post(); 
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
						<div class="<?php echo esc_attr($itemsize);?> <?php echo esc_attr(strtolower($tax)); ?> all p-item">
	                	<?php do_action('kadence_portfolio_loop_start');
								get_template_part('templates/content', 'loop-portfolio'); 
							  do_action('kadence_portfolio_loop_start');
						?>
	                    </div>
					<?php endwhile; ?>
                </div> <!--portfoliowrapper-->
                
                                    
                    <?php if ($wp_query->max_num_pages > 1) :
                            kad_wp_pagenavi();
                    endif; 
                    $wp_query = null; 
                    wp_reset_query(); ?>
</div><!-- /.main -->
  <?php get_footer(); ?>