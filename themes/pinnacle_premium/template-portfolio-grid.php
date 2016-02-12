	<?php
/*
Template Name: Portfolio Grid
*/
?>
	<?php get_header(); ?>
			<?php get_template_part('templates/page', 'header'); ?>
	
      	<?php global $post, $pinnacle; 
	      	if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;}
	      	$portfolio_category = get_post_meta( $post->ID, '_kad_portfolio_type', true );
	      	$portfolio_style = get_post_meta( $post->ID, '_kad_portfolio_style', true ); if(empty($portfolio_style) || $portfolio_style == 'default') {
		      		if(isset($pinnacle['portfolio_style_default'])) {
		      			$pstyleclass = $pinnacle['portfolio_style_default'];
		      		} else {
		      			$pstyleclass = 'padded_style';
		      		}
	      		} else {$pstyleclass = $portfolio_style;}
	      	$portfolio_hover_style = get_post_meta( $post->ID, '_kad_portfolio_hover_style', true ); if(empty($portfolio_hover_style) || $portfolio_hover_style == 'default') {
		      		if(isset($pinnacle['portfolio_hover_style_default'])) {
		      			$phoverstyleclass = $pinnacle['portfolio_hover_style_default'];
		      		} else {
		      			$phoverstyleclass = 'p_lightstyle';
		      		}
	      		} else {$phoverstyleclass = $portfolio_hover_style;}
			$portfolio_items = get_post_meta( $post->ID, '_kad_portfolio_items', true );
			$portfolio_filter = get_post_meta( $post->ID, '_kad_portfolio_filter', true );
			$portfolio_column = get_post_meta( $post->ID, '_kad_portfolio_columns', true ); 
            $portfolio_fullwidth = get_post_meta( $post->ID, '_kad_portfolio_fullwidth', true );
            $portfolio_ratio = get_post_meta( $post->ID, '_kad_portfolio_img_ratio', true );
            $pie = get_post_meta( $post->ID, '_kad_portfolio_item_excerpt', true ); 
            if(!empty($pie) && $pie == "on") {
            	$showexcerpt = 'true';
            } else {
            	$showexcerpt = 'false';
            }
            $portfolio_item_types = get_post_meta( $post->ID, '_kad_portfolio_item_types', true );
            if (!empty($portfolio_item_types) && $portfolio_item_types == 'on'){
				$portfolio_item_types = 'true';
			} else {
				$portfolio_item_types = 'false';
			}
			$portfolio_masonry = get_post_meta( $post->ID, '_kad_portfolio_masonry', true );
			$portfolio_lightbox = get_post_meta( $post->ID, '_kad_portfolio_lightbox', true ); 
			if (!empty($portfolio_lightbox) && $portfolio_lightbox == 'on'){
				$plb = 'true';
			} else {
				$plb = 'false';
			}
			if(isset($pinnacle['portfolio_viewdetails_text']) && !empty($pinnacle['portfolio_viewdetails_text']) ) {
            	$viewdetails = $pinnacle['portfolio_viewdetails_text'];
	        } else {
	            $viewdetails = __('View details', 'pinnacle');
	        }
			$portfolio_order = get_post_meta( $post->ID, '_kad_portfolio_order', true ); 
			if(isset($portfolio_order)) {$p_orderby = $portfolio_order;} else {$p_orderby = 'menu_order';}
			   	if($p_orderby == 'menu_order') {$p_order = 'ASC';} else {$p_order = 'DESC';}
				if($portfolio_category == '-1' || empty($portfolio_category)) { $portfolio_cat_slug = ''; $portfolio_cat_ID = ''; } else {
						$portfolio_cat = get_term_by ('id',$portfolio_category,'portfolio-type' );
						$portfolio_cat_slug = $portfolio_cat -> slug;
						$portfolio_cat_ID = $portfolio_cat -> term_id;
				}
				$portfolio_category = $portfolio_cat_slug;
				if($portfolio_items == 'all') { $portfolio_items = '-1'; }
                   	 if(empty($portfolio_ratio) || $portfolio_ratio == 'default') {
                   	 		if(isset($pinnacle['portfolio_ratio_default'])) {
                   	 			$pimgratio = $pinnacle['portfolio_ratio_default'];
                   	 		} else {
                   	 			$pimgratio = "square";
                   	 		}
                   	 } else {
                   	 	$pimgratio = $portfolio_ratio;
                   	 }
		              if(!empty($portfolio_fullwidth) && $portfolio_fullwidth == 'yes') {
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
						if (!empty($portfolio_masonry) && $portfolio_masonry == 'yes') {$slideheight = '';}
		if ($portfolio_fullwidth == 'yes') { $contentclass = "kad-fullwidth"; } else {$contentclass = "";} 
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
	<div id="content" class="container <?php echo esc_attr($contentclass);?>">
   	<div class="row">
      <div class="main <?php echo kadence_main_class(); ?>" role="main">
		<div class="container">
		<div class="entry-content" itemprop="mainContentOfPage">
					<?php get_template_part('templates/content', 'page'); ?>
		</div>
		</div>
	  	<?php if ($portfolio_filter == 'yes') { ?>
      		<section id="options" class="kt-filter-options clearfix">
			<?php if(!empty($pinnacle['filter_all_text'])) {$alltext = $pinnacle['filter_all_text'];} else {$alltext = __('All', 'pinnacle');}
			if(!empty($pinnacle['portfolio_filter_text'])) {$portfoliofiltertext = $pinnacle['portfolio_filter_text'];} else {$portfoliofiltertext = __('Filter Projects', 'pinnacle');}
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
							echo '<li class="postclass"><a href="#" data-filter=".'.esc_attr($termname).'" title="" rel="'.esc_attr($termname).'"><h5>'.$category->name.'</h5><div class="arrow-up"></div></a></li>';
								}
				 		}
				 		echo "</ul>"; ?>
				</section>
            <?php } ?>                   

            <div id="portfoliowrapper" class="rowtight init-isotope <?php echo esc_attr($pstyleclass);?> <?php echo esc_attr($phoverstyleclass);?> <?php if ($portfolio_filter == 'yes') {echo 'kad_pfilter_class';}?> clearfix" data-fade-in="<?php echo esc_attr($animate);?>" data-iso-selector=".p-item" data-iso-style="masonry" data-iso-filter="true"> 
   
            <?php 
				$temp = $wp_query; 
				  $wp_query = null; 
				  $wp_query = new WP_Query();
				  $wp_query->query(array(
					'paged' => $paged,
					'orderby' => $p_orderby,
					'order' => $p_order,
					'post_type' => 'portfolio',
					'portfolio-type'=>$portfolio_cat_slug,
					'posts_per_page' => $portfolio_items));
					$count =0;
					
					if ( $wp_query ) : 
					while ( $wp_query->have_posts() ) : $wp_query->the_post();
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
                                    
                    <?php if ($wp_query->max_num_pages > 1) : ?>
                            <?php kad_wp_pagenavi(); ?>   
                    <?php endif; ?>
                    <?php 
                      $wp_query = null; 
                      $wp_query = $temp;  // Reset
                    ?>
                    <?php wp_reset_query(); ?>
<?php do_action('kt_after_pagecontent'); ?>
</div><!-- /.main -->
  <?php get_footer(); ?>