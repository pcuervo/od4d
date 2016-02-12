<?php if ( apply_filters( 'kadence_tooltip_nextpostlink', true ) ) { ?>
	<div class="kad-post-navigation clearfix">
        <div class="alignleft kad-previous-link">
        <?php previous_post_link('%link', '<span class="kt-next-post" data-toggle="tooltip" data-placement="top" data-original-title="%title">'.__('Previous Post', 'pinnacle').'</span>'); ?> 
        </div>
        <div class="alignright kad-next-link">
        <?php next_post_link('%link', '<span class="kt-next-post" data-toggle="tooltip" data-placement="top" data-original-title="%title">'.__('Next Post', 'pinnacle').'</span>'); ?> 
        </div>
 </div> <!-- end navigation -->

 <?php } else { ?>
 <div class="kad-post-navigation clearfix">
        <div class="alignleft kad-previous-link">
        <?php previous_post_link('%link', __('Previous Post', 'pinnacle')); ?> 
        </div>
        <div class="alignright kad-next-link">
        <?php next_post_link('%link', '%title">'.__('Next Post', 'pinnacle')); ?> 
        </div>
 </div> <!-- end navigation -->
 <?php } ?>