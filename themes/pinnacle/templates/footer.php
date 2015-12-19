<?php global $pinnacle; ?>
<footer id="containerfooter" class="footerclass" role="contentinfo">
	<div class="container">
		<div class="row">
			<?php if(isset($pinnacle['footer_layout'])) { $footer_layout = $pinnacle['footer_layout']; } else { $footer_layout = 'fourc'; }
				if ($footer_layout == "fourc") {
					if (is_active_sidebar('footer_1') ) { ?>
						<div class="col-md-3 col-sm-6 footercol1">
							<div class="widget-1 widget-first footer-widget">
								<aside id="kadence_simple_image-3" class="widget kadence_simple_image">
									<div class="kad_img_upload_widget">
										<span class="[ pull-left ][ text-left ]">Hosted by</span>
										<a href="http://pcuervo.com/od4d/wp-content/uploads/2015/12/IDRC-logo-blue-full-name.png" data-rel="lightbox">
											<img src="http://pcuervo.com/od4d/wp-content/uploads/2015/12/IDRC-logo-blue-full-name.png" alt="">
										</a>
									</div>
								</aside>
							</div>
						</div>
					<?php }; ?>
					<?php if (is_active_sidebar('footer_2') ) { ?>
						<div class="col-md-3 col-sm-6 footercol2">
						<?php dynamic_sidebar('footer_2'); ?>
						</div>
					<?php }; ?>
					<?php if (is_active_sidebar('footer_3') ) { ?>
						<div class="col-md-3 col-sm-6 footercol3">
						<?php dynamic_sidebar('footer_3'); ?>
						</div>
					<?php }; ?>
					<?php if (is_active_sidebar('footer_4') ) { ?>
						<div class="col-md-3 col-sm-6 footercol4">
						<?php dynamic_sidebar('footer_4'); ?>
						</div>
					<?php }; ?>
				<?php } else if($footer_layout == "threec") {
					if (is_active_sidebar('footer_third_1') ) { ?>
						<div class="col-md-4 footercol1">
						<?php dynamic_sidebar('footer_third_1'); ?>
						</div>
					<?php }; ?>
					<?php if (is_active_sidebar('footer_third_2') ) { ?>
						<div class="col-md-4 footercol2">
						<?php dynamic_sidebar('footer_third_2'); ?>
						</div>
					<?php }; ?>
					<?php if (is_active_sidebar('footer_third_3') ) { ?>
						<div class="col-md-4 footercol3">
						<?php dynamic_sidebar('footer_third_3'); ?>
						</div>
					<?php }; ?>
				<?php } else {
						if (is_active_sidebar('footer_double_1') ) { ?>
						<div class="col-md-6 footercol1">
						<?php dynamic_sidebar('footer_double_1'); ?>
						</div>
						<?php }; ?>
					<?php if (is_active_sidebar('footer_double_2') ) { ?>
						<div class="col-md-6 footercol2">
						<?php dynamic_sidebar('footer_double_2'); ?>
						</div>
					<?php }; ?>
				<?php } ?>
				</div> <!-- Row -->
				<div class="row">
					<div class="col-md-3 col-sm-6 footercol1">
						<div class="widget-1 widget-last footer-widget">
							<aside id="widget_kadence_social-3" class="widget widget_kadence_social">
								<div class="kadence_social_widget clearfix">
									<div class="[ text-left ]">
										<a href="https://www.facebook.com/OpenData4D/" class="facebook_link" title="" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Facebook"><i class="icon-facebook"></i></a>
										<a href="https://twitter.com/od4_d" class="twitter_link" title="" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Twitter"><i class="icon-twitter"></i></a>
										<a href="http://linkedin.com" class="linkedin_link" title="" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="LinkedIn"><i class="icon-linkedin"></i></a>
									</div>
								</div>
							</aside>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 footercol2">
						<div class="widget-2 widget footer-widget">
							<!-- Begin MailChimp Signup Form -->
							<link href="//cdn-images.mailchimp.com/embedcode/slim-081711.css" rel="stylesheet" type="text/css">
							<style type="text/css">
								#mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
								/* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
								   We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
							</style>
							<div id="mc_embed_signup">
							<form action="//od4d.us12.list-manage.com/subscribe/post?u=8161fc94b2c0a5e5eaadf957b&amp;id=b6e447a697" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
							    <div id="mc_embed_signup_scroll">
								<label for="mce-EMAIL">Subscribe to our mailing list</label>
								<input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
							    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
							    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_8161fc94b2c0a5e5eaadf957b_b6e447a697" tabindex="-1" value=""></div>
							    <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
							    </div>
							</form>
							</div>

							<!--End mc_embed_signup-->
						</div>
					</div>
					<div class="col-md-3 col-sm-6 footercol3">
						<div class="widget-3 widget footer-widget">
							<aside id="text-4" class="widget widget_text [ text-left ]">
								<div class="textwidget">
									<a href="mailto:contact@od4d.net">contact@od4d.net</a>
								</div>
							</aside>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 footercol4">
						<div class="widget-4 widget footer-widget">
							<aside id="text-4" class="widget widget_text [ text-left ]">
								<div class="textwidget">
									<a href="http://opendataresearch.org/">opendataresearch.org</a>
								</div>
							</aside>
						</div>
					</div>
				</div> <!-- Row -->
		<div class="footercredits clearfix">
			<?php if (has_nav_menu('footer_navigation')) :?>
				<div class="footernav clearfix">
				<?php wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'footermenu'));?>
				</div>
			<?php endif;?>
			<?php if(!empty($pinnacle['footer_text'])) {
				$footerstring = $pinnacle['footer_text'];
				$footerstring = str_replace('[copyright]','&copy;',$footerstring);
				$footerstring = str_replace('[the-year]',date('Y'),$footerstring);
				$footerstring = str_replace('[site-name]',get_bloginfo('name'),$footerstring);
				echo '<p>'. do_shortcode($footerstring).'</p>';} ?>
		</div><!-- credits -->
	</div><!-- container -->
</footer>
<?php wp_footer(); ?>