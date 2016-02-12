<?php
/*
Template Name: Contact
*/
?>
	<?php get_header(); ?>
	<script type="text/javascript">
	jQuery(document).ready(function ($) {
		$.extend($.validator.messages, {
	        required: "<?php echo __('This field is required.', 'pinnacle'); ?>",
			email: "<?php echo __('Please enter a valid email address.', 'pinnacle'); ?>",
		 });
		$("#contactForm").validate();
	});
	</script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.validate-ck.js"></script>
	<?php global $pinnacle, $post; $map = get_post_meta( $post->ID, '_kad_contact_map', true ); 
	if ($map == 'yes') { ?>
		    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
		    <?php global $post; $address = get_post_meta( $post->ID, '_kad_contact_address', true ); 
							    $maptype = get_post_meta( $post->ID, '_kad_contact_maptype', true ); 
							    $height = get_post_meta( $post->ID, '_kad_contact_mapheight', true );
							    $address2 = get_post_meta( $post->ID, '_kad_contact_address2', true );
							    $address3 = get_post_meta( $post->ID, '_kad_contact_address3', true );
							    $address4 = get_post_meta( $post->ID, '_kad_contact_address4', true );
							    $mapcenter = get_post_meta( $post->ID, '_kad_contact_map_center', true ); 
							    if($height != '') {$mapheight = $height;} else {$mapheight = 300;}
							    if(empty($mapcenter)) {$center = $address;} else {$center = $mapcenter;}
							    $mapzoom = get_post_meta( $post->ID, '_kad_contact_zoom', true ); 
							    if($mapzoom != '') $zoom = $mapzoom; else $zoom = 15; 
		    ?>
		    <script type="text/javascript">
					jQuery(window).load(function() {
		
					jQuery('#map_address').gmap3({
			map: {
			    address:"<?php echo esc_js($center);?>",
				options: {
              		zoom:<?php echo esc_js($zoom);?>,
					draggable: true,
					mapTypeControl: true,
					mapTypeId: google.maps.MapTypeId.<?php echo esc_js($maptype);?>,
					scrollwheel: false,
					panControl: true,
					rotateControl: false,
					scaleControl: true,
					streetViewControl: true,
					zoomControl: true
				}
			},
			marker:{
            values:[
            		 {address: "<?php echo esc_js($address);?>",
			 	    data:"<div class='mapinfo'>'<?php echo esc_js($address);?>'</div>",
			 	},
			 	<?php if(!empty($address2)) {?> { address: "<?php echo esc_js($address2);?>",
				 	    	data:"<div class='mapinfo'> <?php echo esc_js($address2);?></div>",
				 	},
				 	<?php } ?>
				 	<?php if(!empty($address3)) {?> { address: "<?php echo esc_js($address3);?>",
				 	    	data:"<div class='mapinfo'> <?php echo esc_js($address3);?></div>",
				 	},
				 	<?php } ?>
				 	<?php if(!empty($address4)) {?> { address: "<?php echo esc_js($address4);?>",
				 	    	data:"<div class='mapinfo'><?php echo esc_js($address4);?></div>",
				 	},
				 	<?php } ?>
            ],
            options:{
              draggable: false,
            },
			events:{
              click: function(marker, event, context){
                var map = jQuery(this).gmap3("get"),
                  infowindow = jQuery(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.open(map, marker);
                  infowindow.setContent(context.data);
                } else {
                  jQuery(this).gmap3({
                    infowindow:{
                      anchor:marker, 
                      options:{content: context.data}
                    }
                  });
                }
              },
              closeclick: function(){
                var infowindow = jQuery(this).gmap3({get:{name:"infowindow"}});
                if (infowindow){
                  infowindow.close();
                }
			  }
			}
          }
        });
        
      });
			</script>
	<?php echo '<style type="text/css" media="screen">#map_address {height:'.$mapheight.'px;}</style>'; ?>
    <?php } 

    $pageemail = get_post_meta( $post->ID, '_kad_contact_form_email', true ); 
	$form_math = get_post_meta( $post->ID, '_kad_contact_form_math', true );
	if(isset($_POST['submitted'])) {
		if(isset($form_math) && $form_math == 'yes') {
			if(md5($_POST['kad_captcha']) != $_POST['hval']) {
				$kad_captchaError = __('Check your math.', 'pinnacle');
				$hasError = true;
			}
		}
	if(trim($_POST['contactName']) === '') {
		$nameError = __('Please enter your name.', 'pinnacle');
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	//Check to make sure sure that a valid email address is submitted
	$email_pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';

	if(trim($_POST['email']) === '')  {
		$emailError = __('Please enter your email address.', 'pinnacle');
		$hasError = true;
	} else if (!preg_match($email_pattern, trim($_POST['email']))) {
		$emailError = __('You entered an invalid email address.', 'pinnacle');
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['comments']) === '') {
		$commentError = __('Please enter a message.', 'pinnacle');
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}

	if(!isset($hasError)) {
		if (isset($pageemail)) {
			$emailTo = $pageemail;
		} else {
			$emailTo = get_option('admin_email');
		}
		$sitename = get_bloginfo('name');
		$name = wp_filter_kses( $name );
		$email = wp_filter_kses( $email );
		$comments = wp_filter_kses( $comments );

		$subject = '['.$sitename . ' ' . __("Contact", "pinnacle").'] '. __("From", "pinnacle") . ' ' . $name;
		$body = __('Name', 'pinnacle').": $name \n\n";
		$body .= __('Email', 'pinnacle').": $email \n\n";
		$body .= __('Comments', 'pinnacle').":\n $comments";
		$headers = 'Reply-To: ' . $name . '<' . $email . '>' . "\r\n";

		wp_mail($emailTo, $subject, $body, $headers);
		$emailSent = true;
	}

}  ?>
			<?php get_template_part('templates/page', 'header'); ?>
<?php if ($map == 'yes') { ?>
		            <div id="map_address">
		            </div>
  <?php } ?>

	<div id="content" class="container">
   		<div class="row">
   		<?php $form = get_post_meta( $post->ID, '_kad_contact_form', true );
      	if ($form == 'yes') { ?>
	  		<div id="main" class="main col-md-5" role="main">
	  			<div class="postclass pageclass">
	  	<?php } else { ?>
      		<div id="main" class="main col-md-12" role="main">
      			<div class="postclass pageclass">
      <?php } ?>
      <div class="entry-content" itemprop="mainContentOfPage">
					<?php get_template_part('templates/content', 'page'); ?>
		</div>
		      </div>
		  </div>
      <?php if ($form == 'yes') { ?>
      		<div class="contactformcase col-md-7">
      			<?php
      			 $contactformtitle = get_post_meta( $post->ID, '_kad_contact_form_title', true );
      			 if (!empty($contactformtitle)) { 
      				echo '<h3>'. __($contactformtitle) .'</h3>';
      			} ?>
				<?php if(isset($emailSent) && $emailSent == true) { ?>
							<div class="thanks">
								<p><?php _e('Thanks, your email was sent successfully.', 'pinnacle');?></p>
							</div>
						<?php } else { ?>
							<?php if(isset($hasError) || isset($captchaError)) { ?>
								<p class="error"><?php _e('Sorry, an error occured.', 'pinnacle');?><p>
							<?php } ?>

						<form action="<?php the_permalink(); ?>" id="contactForm" method="post">
							<div class="contactform">
							<p>
								<label for="contactName"><b><?php _e('Name:', 'pinnacle');?></b></label><?php if(isset($nameError)) { ?>
									<span class="error"><?php echo esc_html($nameError);?></span>
								<?php } ?>
								
								<input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo esc_attr($_POST['contactName']);?>" class="required requiredField full" />
                               
							</p>

							<p>
								<label for="email"><b><?php _e('Email:', 'pinnacle'); ?></b></label> <?php if(isset($emailError)) { ?>
									<span class="error"><?php echo esc_html($emailError);?></span>
								<?php } ?>
								<input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) echo esc_attr($_POST['email']);?>" class="required requiredField email full" />
							</p>

							<p><label for="commentsText"><b><?php _e('Message:', 'pinnacle'); ?></b></label>
								<?php if(isset($commentError)) { ?>
									<span class="error"><?php echo esc_html($commentError);?></span>
								<?php } ?>
								<textarea name="comments" id="commentsText" rows="10" class="required requiredField"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo esc_textarea(stripslashes($_POST['comments'])); } else { echo esc_textarea($_POST['comments']); } } ?></textarea>
							</p>
							<?php if(isset($form_math) && $form_math == 'yes') { ?>
							<?php   $one = rand(5, 50);
									$two = rand(1, 9);
									$result = md5($one + $two); ?>
									<p>
									<label for="kad_captcha"><b><?php echo $one.' + '.$two; ?> = </b></label>
									<input type="text" name="kad_captcha" id="kad_captcha" class="required requiredField kad_captcha kad-quarter" />
									<?php if(isset($kad_captchaError)) { ?><label class="error"><?php echo esc_html($kad_captchaError);?></label><?php } ?>
									<input type="hidden" name="hval" id="hval" value="<?php echo esc_attr($result);?>" />
								</p>
							<?php } ?>
							<p>
								<input type="submit" class="kad-btn kad-btn-primary" id="submit" tabindex="5" value="<?php _e('Send Email', 'pinnacle'); ?>" ></input>
							</p>
						</div><!-- /.contactform-->
						<input type="hidden" name="submitted" id="submitted" value="true" />
					</form>
				<?php } ?>
      </div><!--contactform-->
      <?php } ?>
        <?php get_footer(); ?>