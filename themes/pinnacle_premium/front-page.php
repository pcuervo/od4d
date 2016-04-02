	<?php get_header(); ?>
	<?php global $pinnacle;
		$mobile_detect = false;
			if(isset($pinnacle['mobile_switch']) && $pinnacle['mobile_switch']  == '1') {
				$mobile_slider = true;
				$detect = new Mobile_Detect_pinnacle;
				if(isset($pinnacle['mobile_tablet_show']) && $pinnacle['mobile_tablet_show']  == '1') {
					if($detect->isMobile()) {
						$mobile_detect = true;
					} else {
						$mobile_detect = false;
					}
				} else {
					if($detect->isMobile() && !$detect->isTablet()) {
						$mobile_detect = true;
					} else {
						$mobile_detect = false;
					}
				}
			} else {
				$mobile_slider = false;
			}
			if(($mobile_slider == true) && ($mobile_detect == true)){
				$m_home_header = $pinnacle['choose_mobile_slider'];
					if ($m_home_header == "rev") {
					get_template_part('templates/mobile_home/mobilerev', 'slider');
				}
				else if ($m_home_header == "flex") {
					get_template_part('templates/mobile_home/mobileflex', 'slider');
				}
				else if ($m_home_header == "pagetitle") {
					get_template_part('templates/mobile_home/page-title', 'mhome');
				}
				else if ($m_home_header == "video") {
					get_template_part('templates/mobile_home/mobilevideo', 'block');
				}
				else if ($m_home_header == "shortcode") {
					get_template_part('templates/mobile_home/cyclone', 'slider');
				}
				else if ($m_home_header == "ktslider") {
					get_template_part('templates/mobile_home/kt-slider', 'slider');
				}
			} else {
			  $home_header = $pinnacle['choose_home_header'];
				if ($home_header == "rev") {
							get_template_part('templates/home/rev', 'slider');
				}
				else if ($home_header == "ktslider") {
							get_template_part('templates/home/kt', 'slider');
				}
				else if ($home_header == "flex") {
					get_template_part('templates/home/flex', 'slider');
				}
				else if ($home_header == "carousel") {
					get_template_part('templates/home/carousel', 'slider');
				}
				else if ($home_header == "imgcarousel") {
					get_template_part('templates/home/image', 'carousel');
				}
				else if ($home_header == "latest") {
					get_template_part('templates/home/latest', 'slider');
				}
				else if ($home_header == "cyclone") {
					get_template_part('templates/home/cyclone', 'slider');
				}
				else if ($home_header == "video") {
					get_template_part('templates/home/video', 'block');
				}
				else if ($home_header == "pagetitle") {
					get_template_part('templates/home/page-title', 'home');
				}
}?>
	<div id="content" class="container homepagecontent">
		<div class="row">
			<div class="main <?php echo kadence_main_class(); ?>" role="main">

				<?php
				if( isset($pinnacle['homepage_layout']['enabled'])) {
					$layout = $pinnacle['homepage_layout']['enabled'];
				} else {
					$layout = array("block_one" => "block_one", "block_four" => "block_four");
				} ?>

				<article class="key-concepts home-margin home-padding kad-animation" data-animation="fade-in" data-delay="0">
					<div class="[ home-margin ][ rowtight ]">
						<?php
							$key_concepts = get_page_by_title('What we do');
							$key_concepts_ID = $key_concepts->ID;
							$post = get_post($key_concepts_ID);
							$content = apply_filters('the_content', $post->post_content);

							$key_concepts_args = array(
								'page_id' => $key_concepts_ID
							);
							$query_key_concepts = new WP_Query( $key_concepts_args );
							if ( $query_key_concepts->have_posts() ) : while( $query_key_concepts->have_posts() ) : $query_key_concepts->the_post(); ?>
								<h4 class="[ text-center ][ widget-title ]"><?php the_title(); ?></h4>
								<?php the_content(); ?>
							<?php endwhile; endif; wp_reset_query();
						?>
					</div>
				</article>

				<article class="key-concepts home-margin home-padding kad-animation" data-animation="fade-in" data-delay="0">
					<h4 class="[ text-center ][ widget-title ]">Our Projects around the world</h4>
					<div id="map" class="[ projects-map ][ margin-bottom ]" style="height: 350px"></div>
				</article>

				<?php if ($layout):
					foreach ($layout as $key=>$value) {

						switch($key) {
							case 'block_one':?>
								<?php get_template_part('templates/home/callto', 'action'); ?>
							<?php
							break;
							case 'block_two':
								get_template_part('templates/home/image', 'menu');
							break;
							case 'block_three':
								if (class_exists('woocommerce'))  {
									get_template_part('templates/home/product', 'carousel');
								}
							break;
							case 'block_four': ?>
								<?php if(is_home()) { ?>
								<?php if(kadence_display_sidebar()) {$display_sidebar = true; $fullclass = '';} else {$display_sidebar = false; $fullclass = 'fullwidth';}
									global $pinnacle, $postcolumn;
									if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;}
									if(isset($pinnacle['home_post_summery']) && $pinnacle['home_post_summery'] == 'full'){
										$summary = 'full'; $postclass = "single-article fullpost"; $contentid = 'homelatestpost';
									} else if(isset($pinnacle['home_post_summery']) && $pinnacle['home_post_summery'] == 'grid'){
										if(isset($pinnacle['home_post_grid_columns'])) {$blog_grid_column = $pinnacle['home_post_grid_columns'];} else {$blog_grid_column = '3';}
										if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;}
										$summary = 'grid'; $postclass = 'postlist'; $contentid = 'kad-blog-grid-case';
										if ($blog_grid_column == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $postcolumn = '2';}
										else if ($blog_grid_column == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $postcolumn = '3';}
										else {$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $postcolumn = '4';}
									} else if(isset($pinnacle['home_post_summery']) && $pinnacle['home_post_summery'] == 'photo'){
										if(isset($pinnacle['home_post_grid_columns'])) {$blog_grid_column = $pinnacle['home_post_grid_columns'];} else {$blog_grid_column = '3';}
										if(isset($pinnacle['pinnacle_animate_in']) && $pinnacle['pinnacle_animate_in'] == 1) {$animate = 1;} else {$animate = 0;}
										$summary = 'photo'; $postclass = 'postlist'; $contentid = 'kad-blog-photo-grid-case';
										if ($blog_grid_column == '2') {$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $postcolumn = '2'; $image_width = 560; $titletag = "h4";}
										else if ($blog_grid_column == '3'){ $itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $postcolumn = '3'; $image_width = 380; $titletag = "h5";}
										else {$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12'; $image_width = 340; $titletag = "h5";}
									} else {$summary = 'normal'; $postclass = 'postlist'; $contentid = 'homelatestpost';}
									if(isset($pinnacle['blog_infinitescroll']) && $pinnacle['blog_infinitescroll'] == 1) {$infinitescroll = true;} else {$infinitescroll = false;}?>
									<div id="<?php echo $contentid;?>" class="homecontent <?php echo $fullclass; ?>  <?php echo $postclass; ?> clearfix home-margin"  data-fade-in="<?php echo $animate;?>">
										<?php if($summary == 'full'){
											if($display_sidebar){
												global $kt_feat_width;
												$kt_feat_width = 848;
											} else {
											  global $kt_feat_width;
												$kt_feat_width = 1170;
											}
											while (have_posts()) : the_post();
												get_template_part('templates/content', 'fullpost');
											endwhile;
										} else if($summary == 'grid') { ?>
											<div id="kad-blog-grid" class="rowtight" data-fade-in="<?php echo esc_attr($animate);?>">
												<?php while (have_posts()) : the_post(); ?>
													<div class="<?php echo esc_attr($itemsize); ?> b_item kad_blog_item">
														<?php  get_template_part('templates/content', 'post-grid'); ?>
													</div>
												<?php endwhile; ?>
											</div>
											<script type="text/javascript">jQuery(document).ready(function ($) {var $container = $('#kad-blog-grid');$container.imagesLoadedn( function(){$container.isotopeb({masonry: {columnWidth: ".b_item"}, transitionDuration: "0.8s"});if($('#kad-blog-grid').attr('data-fade-in') == 1) {$('#kad-blog-grid .kad_blog_fade_in').css('opacity',0); $('#kad-blog-grid .kad_blog_fade_in').each(function(i){$(this).delay(i*150).animate({'opacity':1},350);});}});});</script>
											<?php
										} else if ($summary == 'photo') { ?>
											<div id="kad-blog-photo-grid" class="rowtight" data-fade-in="<?php echo esc_attr($animate);?>">
												<?php while (have_posts()) : the_post(); ?>
													<div class="<?php echo $itemsize;?> b_item kad_blog_item">
														<div id="post-<?php the_ID(); ?>" class="blog_item postclass kad_blog_fade_in grid_item" style="max-width:<?php echo esc_attr($image_width);?>px">
															<?php if(has_post_thumbnail( $post->ID )) {
																$image_url = wp_get_attachment_image_src(
																get_post_thumbnail_id( $post->ID ), 'full' );
																$thumbnailURL = $image_url[0];
																$image = aq_resize($thumbnailURL, $image_width, false);
																if(empty($image)) { $image = $thumbnailURL; }
															} else {
															  $thumbnailURL = pinnacle_post_default_placeholder();
																  $image = aq_resize($thumbnailURL, $image_width, false);
																  if(empty($image)) { $image = $thumbnailURL; }
															  } ?>
																  <div class="imghoverclass img-margin-center">
																	<a href="<?php the_permalink()  ?>" title="<?php the_title(); ?>">
																	  <img src="<?php echo $image ?>" alt="<?php the_title(); ?>" class="iconhover" style="display:block;">
																	</a>
																  </div>
															  <?php $image = null; $thumbnailURL = null;   ?>
															<div class="photo-postcontent">
																<header>
																	<a href="<?php the_permalink() ?>"><?php echo '<'.$titletag.' class="entry-title">';  the_title(); echo '</'.$titletag.'>'; ?></a>
																	<?php get_template_part('templates/entry', 'meta-subhead'); ?>
																</header>
															</div><!-- Text size -->
														</div> <!-- Blog Item -->
													</div>
												<?php endwhile; ?>
											</div>
											<script type="text/javascript">jQuery(document).ready(function ($) {var $container = $('#kad-blog-photo-grid');$container.imagesLoadedn( function(){$container.isotopeb({masonry: {columnWidth: ".b_item"}, transitionDuration: "0.8s"});if($('#kad-blog-photo-grid').attr('data-fade-in') == 1) {$('#kad-blog-photo-grid .kad_blog_fade_in').css('opacity',0); $('#kad-blog-photo-grid .kad_blog_fade_in').each(function(i){$(this).delay(i*150).animate({'opacity':1},350);});}});});</script>
										<?php } else {
											if($display_sidebar){
												global $kt_post_with_sidebar;
												$kt_post_with_sidebar = true;
											} else {
												global $kt_feat_width;
												$kt_post_with_sidebar = false;
											}
											while (have_posts()) : the_post();
												get_template_part('templates/content', get_post_format());
											endwhile;
										} ?>
									</div>
								<?php
								if ($wp_query->max_num_pages > 1) :
									if(function_exists('kad_wp_pagenavi')) {
										kad_wp_pagenavi();
									}
								endif;

								if ($infinitescroll) {
									if($grid == true) {?>
										<script type="text/javascript">
											jQuery(document).ready(function ($) {
												var $container = $('#kad-blog-grid');
												$('.homecontent').infinitescroll({
													nextSelector: ".wp-pagenavi a.next",
													navSelector: ".wp-pagenavi",
													itemSelector: ".kad_blog_item",
													loading: {
														msgText: "",
														finishedMsg: '',
														img: "<?php echo get_template_directory_uri() . '/assets/img/loader.gif'; ?>"
													}
												},
												function( newElements ) {
													var $newElems = jQuery( newElements ).hide(); // hide to begin with
													// ensure that images load before adding to masonry layout
													$newElems.imagesLoadedn(function(){
														$newElems.fadeIn(); // fade in when ready
														$container.isotopeb( 'appended', $newElems );
														if($container.attr('data-fade-in') == 1) {
															//fadeIn items one by one
															$newElems.each(function() {
															$(this).find('.kad_blog_fade_in').delay($(this).attr('data-delay')).animate({'opacity' : 1, 'top' : 0},800,'swing');},{accX: 0, accY: -85},'easeInCubic');
														}
													});
												});
											});
										</script>

									<?php } else { ?>

										<script type="text/javascript">
											jQuery(document).ready(function ($) {
												$('.homecontent').infinitescroll({
													nextSelector: ".wp-pagenavi a.next",
													navSelector: ".wp-pagenavi",
													itemSelector: ".kad_blog_item",
													loading: {
														msgText: "",
														finishedMsg: '',
														img: "<?php echo get_template_directory_uri() . '/assets/img/loader.gif'; ?>"
													}
												},
												function( newElements ) {
													var $newElems = jQuery( newElements ); // hide to begin with
													if($newElems.attr('data-animation') == 'fade-in') {
														//fadeIn items one by one
														$newElems.each(function() {
															$(this).appear(function() {
															$(this).delay($(this).attr('data-delay')).animate({'opacity' : 1, 'top' : 0},800,'swing');},{accX: 0, accY: -85},'easeInCubic');
														});
													}
												});
											});
										</script>

									<?php }
									} ?>

								<?php } else { ?>
									<div class="homecontent clearfix home-margin">
										<?php get_template_part('templates/content', 'page'); ?>
									</div>
								<?php }
							break;
							case 'block_five':
								get_template_part('templates/home/blog', 'home');
							break;
							case 'block_six':
								get_template_part('templates/home/portfolio', 'carousel');
							break;
							case 'block_seven':
								get_template_part('templates/home/icon', 'menu');
							break;
							case 'block_eight':
								get_template_part('templates/home/home', 'portfolio');
							break;
							case 'block_nine':
								if (class_exists('woocommerce'))  {
									get_template_part('templates/home/product-sale', 'carousel');
								}
							break;
							case 'block_ten':
								if (class_exists('woocommerce'))  {
									get_template_part('templates/home/product-best', 'carousel');
								}
							break;
							case 'block_eleven':
								get_template_part('templates/home/custom', 'carousel');
							break;
							case 'block_twelve':
								get_template_part('templates/home/widget', 'box');
							break;
						}
					}
				endif; ?>

				<div class="home_blog home-margin clearfix home-padding">
					<div class="[ tcol-xs-12 tcol-md-4 ]">
						<?php get_template_part('templates/home/blog', 'home'); ?>
					</div>
					<div class="[ tcol-xs-12 tcol-md-4 ]">
						<div id="kad-blog-grid">
							<h3 class="hometitle">@Od4_d</h3>
							<div id="post-85" class="blog_item postclass kad_blog_fade_in grid_item" itemscope="" itemtype="http://schema.org/BlogPosting">
								<a class="twitter-timeline" href="https://twitter.com/OD4D" data-widget-id="678012125193723904">Tweets por el @OD4D.</a>
								<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							</div> <!-- Blog Item -->
						</div>
					</div>
					<div class="[ tcol-xs-12 tcol-md-4 ]">
						<h3 class="hometitle">Links</h3>
						<a class="[ kad-btn kad-btn--primary kad-btn--xlarge ][ margin-bottom ]" href="http://pcuervo.com/od4d/le-programme">
							AR
						</a>
						<a class="[ kad-btn kad-btn--primary kad-btn--xlarge ]" href="http://pcuervo.com/od4d/le-programme">
							Program document
						</a>
					</div>
				</div>
			</div><!-- /.main -->
			<?php get_footer(); ?>