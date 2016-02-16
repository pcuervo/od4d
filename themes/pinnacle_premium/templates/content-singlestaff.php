<?php get_template_part('templates/post', 'header'); ?>
<div id="content" class="container">
    <div class="row single-article">
      <div class="main <?php echo kadence_main_class(); ?>" role="main">
		<?php while (have_posts()) : the_post(); ?>
		    <article <?php post_class('postclass'); ?>>
		    	<div class="clearfix">
		    	<div class="staff-img thumbnail alignleft clearfix">
				 		<?php the_post_thumbnail( 'medium' ); ?>
				</div>
			  	<header class="kt-staff-header">
	      			<h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
	      			<?php $staff_job_title = get_post_meta( $post->ID, '_kad_staff_job_title', true );
			                	if(!empty($staff_job_title)) echo '<div class="kt-staff-title">'.$staff_job_title.'</div>'; ?>
				</header>
				<div class="entry-content" itemprop="mainContentOfPage">
      				<?php the_content(); ?>
      				<?php wp_link_pages(array('before' => '<nav id="page-nav" class="kt-page-pagnation">', 'after' => '</nav>','link_before'=> '<span>','link_after'=> '</span>')); ?>
    			</div>
    			</div>
    			<footer class="single-footer">
      				<footer class="clearfix staff-footer">
                          	<div class="kadence_social_widget">
                             <?php $staff_facebook = get_post_meta( $post->ID, '_kad_staff_facebook', true );
                             $staff_twitter = get_post_meta( $post->ID, '_kad_staff_twitter', true );
                             $staff_instagram = get_post_meta( $post->ID, '_kad_staff_instagram', true );
                             $staff_linkedin = get_post_meta( $post->ID, '_kad_staff_linkedin', true ); 
                             if(!empty($staff_facebook)) { ?>
									<a href="<?php echo $staff_facebook;?>" target="_blank" class="facebook_link" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Facebook', 'pinnacle');?>" title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Facebook', 'pinnacle');?>"><i class="kt-icon-facebook3"></i></a>
								<?php } if(!empty($staff_twitter)) { ?>
                             		<a href="<?php echo $staff_twitter;?>" target="_blank" class="twitter_link" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Twitter', 'pinnacle');?>" title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Twitter', 'pinnacle');?>"><i class="kt-icon-twitter2"></i></a>
								<?php } if(!empty($staff_instagram)) { ?>
                             		<a href="<?php echo $staff_instagram;?>" target="_blank" class="instagram_link" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Instagram', 'pinnacle');?>" title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Instagram', 'pinnacle');?>"><i class="kt-icon-instagram"></i></a>
								<?php } if(!empty($staff_linkedin)) { ?>
                             		<a href="<?php echo $staff_linkedin;?>" target="_blank" class="linkedin_link" data-toggle="tooltip" data-placement="top" data-original-title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Linkedin', 'pinnacle');?>" title="<?php _e('Follow', 'pinnacle'); ?>  <?php the_title(); ?> <?php _e('on Linkedin', 'pinnacle');?>"><i class="kt-icon-linkedin2"></i></a>
								<?php } ?>
							</div>
                          </footer>
			    </footer>
			</article>
		<?php endwhile; ?>
	</div>