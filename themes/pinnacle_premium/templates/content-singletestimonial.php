<?php get_template_part('templates/post', 'header'); ?>
<div id="content" class="container">
    <div class="row single-article">
      <div class="main <?php echo kadence_main_class(); ?>" role="main">
		<?php while (have_posts()) : the_post(); ?>
		    <article <?php post_class('postclass'); ?>>
		    	<div class="clearfix">
		    	<div class="staff-img thumbnail alignleft clearfix">
		    		<?php if (has_post_thumbnail( $post->ID ) ) {
				 	  the_post_thumbnail( 'thumbnail' ); } ?>
				</div>
			  	<header>
	      			<h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
	      			<div class="subhead kt-testimonial-subhead">
	      			<?php global $post; $occupation = get_post_meta( $post->ID, '_kad_testimonial_occupation', true ); 
	      								$clientlink = get_post_meta( $post->ID, '_kad_testimonial_link', true ); 
	      								$location = get_post_meta( $post->ID, '_kad_testimonial_location', true ); 
	      						if(!empty($location)) { echo $location . ' | ';}
	      						if(!empty($occupation)) { echo $occupation . ' | '; }
	      						if(!empty($clientlink)) { echo '<a href="'.$clientlink.'" target="_blank">'.$clientlink.'</a>';} 
	      				?>
	      			</div>
				</header>
				<div class="entry-content" itemprop="mainContentOfPage">
				 	
      				<?php the_content(); ?>
    			</div>
    			</div>
    			<footer class="single-footer">
      				<?php wp_link_pages(array('before' => '<nav id="page-nav" class="kt-page-pagnation">', 'after' => '</nav>','link_before'=> '<span>','link_after'=> '</span>')); ?>
			    </footer>

			    <?php comments_template('/templates/comments.php'); ?>
			</article>
		<?php endwhile; ?>
	</div>
