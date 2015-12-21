	<?php get_header(); ?>

			<?php global $pinnacle;
			if(isset($pinnacle['mobile_switch']) && $pinnacle['mobile_switch'] == '1') {
				$m_home_header = $pinnacle['choose_mobile_slider'];
				if ($m_home_header == "flex") {
					get_template_part('templates/mobile_home/mobileflex', 'slider');
				} else if ($m_home_header == "pagetitle") {
					get_template_part('templates/mobile_home/page-title', 'mhome');
				} else if ($m_home_header == "video") {
					get_template_part('templates/mobile_home/mobilevideo', 'block');
				}
			}
			$home_header = $pinnacle['choose_home_header'];
			if(empty($home_header)) {$home_header = "pagetitle";}
			if ($home_header == "flex") {
				get_template_part('templates/home/flex', 'slider');
			} else if ($home_header == "carousel") {
				get_template_part('templates/home/carousel', 'slider');
			} else if ($home_header == "latest") {
				get_template_part('templates/home/latest', 'slider');
			} else if ($home_header == "video") {
				get_template_part('templates/home/video', 'block');
			} else if ($home_header == "pagetitle") {
				get_template_part('templates/home/page-title', 'home');
			} ?>
				<div id="content" class="container homepagecontent">
					<div class="row">
						<div class="main <?php echo esc_attr( pinnacle_main_class() ); ?>" role="main">
							<?php if(isset($pinnacle['homepage_layout']['enabled'])) {
								$layout = $pinnacle['homepage_layout']['enabled'];
							} else {
								$layout = array("block_two" => "block_four");
							} ?>

							<div class="home-what-is home-margin home-padding kad-animation" data-animation="fade-in" data-delay="0">
								<div class="clearfix">
									<h2 class="hometitle">What is OD4D?</h2>
									<h4 class="[ text-center ]">Open data for development</h4>
								</div>
								<div class="home-margin [ rowtight ]">
									<div class="[ tcol-ss-12 tcol-sm-8 tcol-lg-6 ][ tcol-sm-offset-2 tcol-lg-offset-3 ][ all ][ p-item ]" style="">
										<?php $whatIs = get_page_by_title('What is OD4D?'); ?>
										<p class=""><?php echo $whatIs->post_content; ?></p>
									</div>
								</div>
							</div>

							<div class="clearfix"></div>

							<?php get_template_part('templates/home/carousel', 'slider'); ?>

							<div class="clearfix"></div>

							<div class="quote-is home-margin home-padding kad-animation" data-animation="fade-in" data-delay="0">
								<div class="home-margin">
									<div class="[ tcol-ss-12 tcol-sm-8 tcol-lg-6 ][ tcol-sm-offset-2 tcol-lg-offset-3 ][ all ][ p-item ]" style="">
										<?php
											$quote = get_page_by_title('Quote');
											$quoteID = $quote->ID;
											$post = get_post($quoteID);
											$content = apply_filters('the_content', $post->post_content);
											echo $content;
										?>
									</div>
								</div>
							</div>
							<div class="clearfix"></div>

							<?php if ($layout):
								foreach ($layout as $key=>$value) {
									switch($key) {

										case 'block_one':
											get_template_part('templates/home/callto', 'action');
										break;

										case 'block_two':
											get_template_part('templates/home/example', 'iconmenu');
										break;

										case 'block_four':
											if(is_home()) {
												global $pinnacle, $postcolumn;
												if(pinnacle_display_sidebar()) {
													$display_sidebar = true;
													$fullclass = '';
												} else {
													$display_sidebar = false;
													$fullclass = 'fullwidth';
												}
												if(isset($pinnacle['home_post_summery']) && $pinnacle['home_post_summery'] == 'full'){
														$summary = 'full';
														$postclass = "single-article fullpost";
														$contentid = 'homelatestpost';
												} else if(isset($pinnacle['home_post_summery']) && $pinnacle['home_post_summery'] == 'grid'){
														if(isset($pinnacle['home_post_grid_columns'])) {
																$blog_grid_column = $pinnacle['home_post_grid_columns'];
															} else {
																$blog_grid_column = '3';
															}
														$summary = 'grid';
														$postclass = 'postlist';
														$contentid = 'kad-blog-grid-case';
														if ($blog_grid_column == '2') {
															$itemsize = 'tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12';
															$postcolumn = '2';
														} else if ($blog_grid_column == '3'){
															$itemsize = 'tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12';
															$postcolumn = '3';
														} else {
															$itemsize = 'tcol-md-3 tcol-sm-4 tcol-xs-6 tcol-ss-12';
															$postcolumn = '4';
														}
												} else {
													$summary = 'normal';
													$postclass = 'postlist';
													$contentid = 'homelatestpost';
												} ?>

												<div id="<?php echo esc_attr($contentid);?>" class="homecontent <?php echo esc_attr($fullclass); ?>  <?php echo esc_attr($postclass); ?> clearfix home-margin">
													<?php if($summary == 'full'){
																if($display_sidebar){
																   while (have_posts()) : the_post();
																	get_template_part('templates/content', 'fullpost');
																   endwhile;
																} else {
																	while (have_posts()) : the_post();
																	get_template_part('templates/content', 'fullpostfull');
																	endwhile;
																}
													} else if($summary == 'grid') { ?>
																<div id="kad-blog-grid" class="rowtight init-masonry" data-masonry-selector=".b_item">
																	<?php while (have_posts()) : the_post(); ?>
																		<div class="<?php echo esc_attr($itemsize);?> b_item kad_blog_item">
																			<?php  get_template_part('templates/content', 'post-grid'); ?>
																		</div>
																	<?php endwhile; ?>
																</div>
													<?php } else {
																if($display_sidebar){
																	while (have_posts()) : the_post();
																		get_template_part('templates/content', get_post_format());
																	endwhile;
																} else {
																	while (have_posts()) : the_post();
																		get_template_part('templates/content', 'fullwidth');
																	endwhile;
																}
													} ?>
												</div>
												<?php if ($wp_query->max_num_pages > 1) :
															if(function_exists('pinnacle_wp_pagination')) {
																pinnacle_wp_pagination();
															} else { ?>
																<nav class="post-nav">
																	<ul class="pager">
																		  <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'pinnacle')); ?></li>
																		  <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'pinnacle')); ?></li>
																	</ul>
																</nav>
															<?php }
												endif;
											} else { ?>
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
									}
								}
							endif; ?>

							<div class="home_blog home-margin clearfix home-padding">
								<div id="kad-blog-grid" class="rowtight init-masonry" data-masonry-selector=".b_item">
									<div class="tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12 b_item kad_blog_item">
										<div class="clearfix">
											<h5 class="hometitle">Implementing partners</h5>
										</div>
										<div id="post-85" class="blog_item postclass kad_blog_fade_in grid_item" itemscope="" itemtype="http://schema.org/BlogPosting">
											<div class="img-margin-center">
												<a href="" title="">
													<img src="<?php echo THEMEPATH; ?>assets/img/implementing-partners/ilda.jpg" alt="" itemprop="image" class="iconhover" style="display:block;">
												</a>
											</div>
											<div class="img-margin-center">
												<a href="" title="">
													<img src="<?php echo THEMEPATH; ?>assets/img/implementing-partners/caribbean-open-institute.jpg" alt="" itemprop="image" class="iconhover" style="display:block;">
												</a>
											</div>
											<div class="img-margin-center">
												<a href="" title="">
													<img src="<?php echo THEMEPATH; ?>assets/img/implementing-partners/www-foundation.jpg" alt="" itemprop="image" class="iconhover" style="display:block;">
												</a>
											</div>
											<div class="img-margin-center">
												<a href="" title="">
													<img src="<?php echo THEMEPATH; ?>assets/img/implementing-partners/open-knowledge.jpg" alt="" itemprop="image" class="iconhover" style="display:block;">
												</a>
											</div>
											<div class="img-margin-center">
												<a href="" title="">
													<img src="<?php echo THEMEPATH; ?>assets/img/implementing-partners/odi.jpg" alt="" itemprop="image" class="iconhover" style="display:block;">
												</a>
											</div>
										</div> <!-- Blog Item -->
									</div>
									<div class="tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12 b_item kad_blog_item">
										<div class="clearfix">
											<h5 class="hometitle">@OD4D</h5>
										</div>
										<div id="post-85" class="blog_item postclass kad_blog_fade_in grid_item" itemscope="" itemtype="http://schema.org/BlogPosting">
											<a class="twitter-timeline"  href="https://twitter.com/OD4D" data-widget-id="678012125193723904">Tweets por el @OD4D.</a>
											<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
										</div> <!-- Blog Item -->
									</div>
									<div class="tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12 b_item kad_blog_item">
										<div class="clearfix">
											<h5 class="hometitle">#opendata</h5>
										</div>
										<div id="post-85" class="blog_item postclass kad_blog_fade_in grid_item" itemscope="" itemtype="http://schema.org/BlogPosting">
											<a class="twitter-timeline"  href="https://twitter.com/hashtag/opendata" data-widget-id="678017565562642432">Tweets sobre #opendata</a>
											<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
										</div> <!-- Blog Item -->
									</div>
								</div>
							</div>

						</div><!-- /.main -->
						<?php get_sidebar(); ?>
					</div><!-- /.row-->
				</div><!-- /.content -->
	</div><!-- /.wrap -->
	<?php get_footer(); ?>