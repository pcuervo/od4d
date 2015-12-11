<form role="search" method="get" id="searchform" class="form-search" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
	<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="search-query" placeholder="<?php _e( 'Search for products', 'pinnacle' ); ?>" />
	<button type="submit" id="searchsubmit" class="search-icon"><i class="icon-search"></i></button>
	<input type="hidden" name="post_type" value="product" />
</form>