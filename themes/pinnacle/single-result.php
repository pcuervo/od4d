<?php 
    global $post;
    get_header(); 
?>

<div id="pageheader" class="titleclass">
    <div class="header-color-overlay"></div>
    <div class="container">
        <div class="page-header">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="post_page_title entry-title" itemprop="name headline"><?php echo get_the_title(); ?></h1>
                </div>
            </div>
        </div>
    </div><!--container-->
</div><!--titleclass-->

<div id="content" class="container">
    <div class="row single-article" itemscope="">
        <div class="main col-lg-9 col-md-8" role="main">
            <?php while ( have_posts()) : the_post(); ?>
                <article <?php post_class('postclass'); ?>
                    <?php         
                    $thumb = get_post_thumbnail_id();
                    $img_url = wp_get_attachment_url( $thumb,'full' );
                    $image = $img_url;
                    if($image) : ?>
                        <section class="postfeat">
                            <div class="imghoverclass post-single-img" itemprop="image">
                                <a href="<?php echo esc_url($img_url); ?>" data-rel="lightbox" class="">
                                    <img src="<?php echo esc_url($image); ?>" itemprop="image" alt="<?php the_title(); ?>" />
                                </a>
                            </div>
                        </section>
                    <?php endif; ?>

                    <?php get_template_part('templates/entry', 'meta-subhead'); ?>

                    <?php 
                        $abstract = get_result_meta( $post->ID, '_abstract_meta' );
                        if( $abstract ){
                            echo '<p><strong>' . $abstract . '</strong></p>';
                        }
                    ?>

                    <div class="entry-content clearfix" itemprop="description articleBody">
                        <?php the_content(); ?>
                        <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'pinnacle'), 'after' => '</p></nav>')); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
        <div class="main col-lg-3 col-md-4">
        </div>
    </div>
</div>

<?php get_footer() ?>