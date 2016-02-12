<?php global $pinnacle; if(!empty($pinnacle['search_placeholder_text'])) {$searchtext = $pinnacle['search_placeholder_text'];} else {$searchtext = __('Search', 'pinnacle');} ?>
<form role="search" method="get" id="searchform" class="form-search" action="<?php echo home_url('/'); ?>">
  <label class="hide" for="s"><?php _e('Search for:', 'pinnacle'); ?></label>
  <input type="text" value="<?php if (is_search()) { echo get_search_query(); } ?>" name="s" id="s" class="search-query" placeholder="<?php echo $searchtext; ?>">
  <button type="submit" id="searchsubmit" class="search-icon"><i class="kt-icon-search4"></i></button>
</form>