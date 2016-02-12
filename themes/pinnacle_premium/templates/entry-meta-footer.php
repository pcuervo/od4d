 <?php $post_category = get_the_category(); if ( $post_category ) {?> <span class="postedinbottom"><i class="kt-icon-stack"></i> <?php the_category(', ') ?></span><?php }?>
<?php $tags = get_the_tags(); if ($tags) { ?> <span class="posttags color_gray"><i class="kt-icon-tag"></i> <?php the_tags('', ', ', ''); ?> </span><?php } ?>
