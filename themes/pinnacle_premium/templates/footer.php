<?php global $pinnacle; if(isset($pinnacle['sitewide_calltoaction']) && $pinnacle['sitewide_calltoaction'] == 1) { get_template_part('templates/sitewide', 'action'); } ?>
<footer id="containerfooter" class="footerclass">
  <div class="container">
  	<span class="[ pull-left ][ text-left ]">Funded by</span>
  	<div class="clearfix"></div>
	<div class="row">

			<div class="col-md-3 col-sm-6">
				<div class="widget-1 footer-widget">
					<aside class="kadence_simple_image">
						<a href="http://www.idrc.ca/" target="_blank">
							<img src="<?php echo THEMEPATH; ?>assets/img/hosted-and-funded/idrc.jpg" alt="IDRC">
						</a>
					</aside>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="widget-1 footer-widget">
					<aside class="kadence_simple_image">
						<a href="http://www.international.gc.ca/" target="_blank">
							<img src="<?php echo THEMEPATH; ?>assets/img/hosted-and-funded/goc.jpg" alt="Government of Canada">
						</a>
					</aside>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="widget-1 footer-widget">
					<aside class="kadence_simple_image">
						<a href="http://www.worldbank.org/" target="_blank">
							<img src="<?php echo THEMEPATH; ?>assets/img/hosted-and-funded/twb.jpg" alt="The World Bank">
						</a>
					</aside>
				</div>
			</div>

			<div class="col-md-3 col-sm-6">
				<div class="widget-1 footer-widget">
					<aside class="kadence_simple_image">
						<a href="https://www.gov.uk/government/organisations/department-for-international-development" target="_blank">
							<img src="<?php echo THEMEPATH; ?>assets/img/hosted-and-funded/uk-aid.jpg" alt="UK Aid">
						</a>
					</aside>
				</div>
			</div>

		</div> <!-- row -->

		<div class="row">
			<div class="col-md-3 col-sm-6 footercol1">
				<div class="widget-1 widget footer-widget">
					<div class="kadence_social_widget clearfix">
						<div class="[ text-left ]">
							<a href="https://www.facebook.com/OpenData4D/" class="facebook_link" title="" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Facebook"><i class="kt-icon-facebook2"></i></a>
							<a href="https://twitter.com/od4_d" class="twitter_link" title="" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="Twitter"><i class="kt-icon-twitter2"></i></a>
							<a href="http://linkedin.com" class="linkedin_link" title="" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="LinkedIn"><i class="kt-icon-linkedin2"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 footercol2">
				<div class="widget-2 widget footer-widget">
					<form action="//od4d.us12.list-manage.com/subscribe/post?u=8161fc94b2c0a5e5eaadf957b&amp;id=b6e447a697" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
						<div id="mc_embed_signup_scroll">
							<label class="" for="mce-EMAIL">newsletter</label>
							<input type="email" value="" name="EMAIL" class="email [ width-100 ]" id="mce-EMAIL" placeholder="your email" required>
							<!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
							<div style="position: absolute; left: -5000px;" aria-hidden="true">
								<input type="text" name="b_8161fc94b2c0a5e5eaadf957b_b6e447a697" tabindex="-1" value="">
							</div>
							<input type="submit" value="join" name="subscribe" id="mc-embedded-subscribe" class="[ kad-btn kad-btn-primary kad-btn--small ]">
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 footercol3">
				<div id="text-4" class="widget widget_text [ text-left ]">
					<div class="textwidget">
						<a href="mailto:contact@od4d.com">contact@od4d.com</a>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 footercol4">
				<div class="widget widget_text [ text-left ]">
					<div class="textwidget">
						<a href="http://opendataresearch.org/">opendataresearch.org</a>
					</div>
				</div>
			</div>
		</div> <!-- row -->

		<div class="footercredits clearfix">

			<?php if (has_nav_menu('footer_navigation')) :
			?><div class="footernav clearfix"><?php
			  wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_class' => 'footermenu'));
			?></div><?php
			endif;?>
			<?php if(!empty($pinnacle['footer_text'])) { echo '<p>'. do_shortcode($pinnacle['footer_text']).'</p>';} ?>
		</div><!-- credits -->
	</div><!-- container -->
</footer>

<?php wp_footer(); ?>
