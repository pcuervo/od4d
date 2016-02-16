<?php 
function kt_create_flexslider($speed, $animationspeed, $animation, $auto, $initdelay, $width, $height, $image_gallery, $link) {
  ob_start(); ?>
  <div class="flexslider kt-flexslider loading" style="max-width:<?php echo esc_attr($width);?>px;" data-flex-speed="<?php echo esc_attr($speed);?>" data-flex-anim-speed="<?php echo esc_attr($animationspeed);?>" data-flex-initdelay="<?php echo esc_attr($initdelay);?>" data-flex-animation="<?php echo esc_attr($animation);?>" data-flex-auto="<?php echo esc_attr($auto);?>">
        <ul class="slides">
        <?php if(!empty($image_gallery)) {
            $attachments = array_filter( explode( ',', $image_gallery ) );
            if ($attachments) {
            foreach ($attachments as $attachment) {
              $attachment_post = get_post( $attachment  );
                $attachment_url = wp_get_attachment_url($attachment , 'full');
                $image = aq_resize($attachment_url, $width, $height, true);
                if(empty($image)) {$image = $attachment_url;} ?>
                    <li>
                        <a <?php if($link == "post") { echo 'href="'.get_the_permalink().'" alt="'.get_the_title().'"'; } else { echo 'href="'.esc_url($attachment_url).'" data-rel="lightbox"'; } ?>>
                            <img src="<?php echo esc_url($image); ?>" itemprop="image" width="<?php echo esc_attr($width);?>" height="<?php echo esc_attr($height);?>" alt="<?php esc_attr($attachment_post->post_excerpt);?>" />
                        </a>
                    </li>
                <?php 
                }
            }
        } ?>           
        </ul>
    </div> <!--Flex Slides-->
<?php $output = ob_get_contents();
    ob_end_clean();
    echo $output;
}