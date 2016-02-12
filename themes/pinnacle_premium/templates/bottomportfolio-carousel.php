<div id="portfolio_carousel_container" class="carousel_outerrim">
    <?php global $post, $pinnacle;

    	$text = get_post_meta( $post->ID, '_kad_portfolio_carousel_title', true );
    	$bporder = get_post_meta( $post->ID, '_kad_portfolio_carousel_order', true );
        $bpgroup = get_post_meta( $post->ID, '_kad_portfolio_carousel_group', true );
        if(isset($bporder)) {
        	$bp_orderby = $bporder;
        } else {
        	$bp_orderby = 'menu_order';
        }
		if($bp_orderby == 'menu_order') {
			$bp_order = 'ASC';
		} else {
			$bp_order = 'DESC';
		}
		if(empty($bpgroup) || $bpgroup == 'default') {
			if(isset($pinnacle['single_portfolio_carousel_items']) &&  $pinnacle['single_portfolio_carousel_items'] == 'cat') {
				$typeterms =  wp_get_post_terms( $post->ID, 'portfolio-type', array( 'orderby' => 'parent', 'order' => 'ASC' ));
				$typeterm = $typeterms[0]; $bp_cat_slug = $typeterm->slug; 
			} else {
				$bp_cat_slug = '';
			}
		} else if($bpgroup == 'cat') {
			$typeterms =  wp_get_post_terms( $post->ID, 'portfolio-type', array( 'orderby' => 'parent', 'order' => 'ASC' ));
			$typeterm = $typeterms[0]; $bp_cat_slug = $typeterm->slug; 
		} else {
			$bp_cat_slug = '';
		}
        $showexcerpt = 'false'; 
        $plb = 'false';
        $portfolio_item_types = 'true';

    	if(!empty($text) ) { 
    		echo '<h3 class="sectiontitle">'.$text.'</h3>'; 
    	} else {
    		echo '<h3 class="sectiontitle">';
    		echo apply_filters( 'kt_recent_projects_title', __('Recent Projects', 'pinnacle') );
    		echo '</h3>';
    	}

        if(isset($pinnacle['portfolio_style_default'])) {
		    $pstyleclass = $pinnacle['portfolio_style_default'];
		} else {
		    $pstyleclass = 'padded_style';
		}
		if(isset($pinnacle['portfolio_hover_style_default'])) {
		    $phoverstyleclass = $pinnacle['portfolio_hover_style_default'];
		} else {
		    $phoverstyleclass = 'p_lightstyle';
		}
		if(isset($pinnacle['portfolio_ratio_default'])) {
            $pimgratio = $pinnacle['portfolio_ratio_default'];
        } else {
            $pimgratio = "square";
        }
        if(isset($pinnacle['portfolio_viewdetails_text']) && !empty($pinnacle['portfolio_viewdetails_text']) ) {
            $viewdetails = $pinnacle['portfolio_viewdetails_text'];
        } else {
            $viewdetails = __('View details', 'pinnacle');
        }
        if(!empty($pinnacle['portfolio_recent_car_column'])) {$portfolio_column = $pinnacle['portfolio_recent_car_column'];} else {$portfolio_column = 4;}
            	if ($portfolio_column == '2') {
            		$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $slidewidth = 600; $sxl = 2; $xl = 2; $md = 2; $sm = 2; $xs = 1; $ss = 1;
            	} else if ($portfolio_column == '3'){
            		$itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 400; $sxl = 3; $xl = 3; $md = 3; $sm = 3; $xs = 2; $ss = 1;
            	} else if ($portfolio_column == '6'){ 
            		$itemsize = 'tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $sxl = 6; $xl = 6; $md = 6; $sm = 4; $xs = 3; $ss = 2;
            	} else if ($portfolio_column == '5'){
            		$itemsize = 'tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $slidewidth = 300; $sxl = 5; $xl = 5; $md = 5; $sm = 4; $xs = 3; $ss = 2;
            	} else {
            		$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $slidewidth = 300; $sxl = 4; $xl = 4; $md = 4; $sm = 3; $xs = 2; $ss = 1;
            	}
        // Set Image Ratio
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
            <div class="portfolio-carouselcase fredcarousel">
				<div id="carouselcontainer" class="rowtight">
            	<div id="portfolio-carousel" class="clearfix caroufedselclass <?php echo esc_attr($pstyleclass);?> <?php echo esc_attr($phoverstyleclass);?> initcaroufedsel" data-carousel-container="#portfolio-carousel" data-carousel-transition="400" data-carousel-scroll="1" data-carousel-auto="true" data-carousel-speed="9000" data-carousel-id="bottomportfolio" data-carousel-sxl="<?php echo esc_attr($sxl);?>" data-carousel-xl="<?php echo esc_attr($xl);?>" data-carousel-md="<?php echo esc_attr($md);?>" data-carousel-sm="<?php echo esc_attr($sm);?>" data-carousel-xs="<?php echo esc_attr($xs);?>" data-carousel-ss="<?php echo esc_attr($ss);?>">
                 <?php 
				$temp = $wp_query; 
				  $wp_query = null; 
				  $wp_query = new WP_Query();
				  $wp_query->query(array('orderby' => $bp_orderby,'order' => $bp_order,'post_type' => 'portfolio','portfolio-type'=> $bp_cat_slug,'post__not_in' => array($post->ID),'posts_per_page' => '8'));
					if ( $wp_query ) : 
					while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
					<div class="<?php echo esc_attr($itemsize); ?> kad_portfolio_item">
					
					<?php do_action('kadence_portfolio_loop_start');
							get_template_part('templates/content', 'loop-portfolio'); 
						  do_action('kadence_portfolio_loop_start');
					?>
					
                    </div>

					<?php endwhile; else: ?>
					 
					<li class="error-not-found"><?php _e('Sorry, no portfolio entries found.', 'virtue');?></li>
						
				<?php endif; ?>	
                <?php 
					  $wp_query = null; 
					  $wp_query = $temp;  // Reset
					?>
                    <?php wp_reset_query(); ?>
													
			</div>
		</div>
     <div class="clearfix"></div>
            <a id="prevport-bottomportfolio" class="prev_carousel kt-icon-arrow-left" href="#"></a>
			<a id="nextport-bottomportfolio" class="next_carousel kt-icon-arrow-right" href="#"></a>
            </div>
</div><!-- Porfolio Container-->	