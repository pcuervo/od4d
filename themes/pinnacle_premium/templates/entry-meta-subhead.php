<div class="subhead">
    <span class="postauthortop author vcard">
    <?php global $pinnacle; if(!empty($pinnacle['post_by_text'])) {$authorbytext = $pinnacle['post_by_text'];} else {$authorbytext = __('by', 'pinnacle');} echo $authorbytext; ?> <span itemprop="author"><a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="fn" rel="author"><?php echo get_the_author() ?></a></span>
    </span><span class="updated postdate"><?php if(!empty($pinnacle['post_on_text'])) {$postontext = $pinnacle['post_on_text'];} else {$postontext = __('on', 'pinnacle');} echo $postontext; ?> <span class="postday" itemprop="datePublished"><?php echo get_the_date() ?></span></span>
    <span class="postcommentscount"><?php if(!empty($pinnacle['post_with_text'])) {$withtext = $pinnacle['post_with_text'];} else {$withtext = __('with', 'pinnacle');}?>
    <?php echo $withtext;?> <a href="<?php the_permalink();?>#post_comments"><?php comments_number(); ?></a>
    </span>
    <meta itemprop="dateModified" content="<?php echo esc_attr(get_the_modified_date()); ?>">
</div>

<?php //__('No Replies', 'pinnacle'), __('1 Reply', 'pinnacle'), __('% Replies') ?>