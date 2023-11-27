<form class="searchform" id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="search-field input" name="s" placeholder="<?php echo __('Tìm bài viết', 'wp-mango');?>" value="<?php echo get_search_query(); ?>">
    <button type="submit" class="btn">
      <i class="icon icon-28"></i>
      <span class="visuallyhidden">Search</span>
    </button>
</form>