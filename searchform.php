<?php
/**
 * Searchform
 *
 * Custom template for search form
 */
?>
<!-- BEGIN of search form -->
<form method="get" id="search-form" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<input type="search" name="s" id="search-input" class="search-field pos-rel" placeholder="<?php echo esc_attr__('Search', 'wp_dev'); ?>" value="<?php echo esc_attr(get_search_query()); ?>"/>


	<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M8.16992 15.75C12.105 15.75 15.2949 12.56 15.2949 8.625C15.2949 4.68997 12.105 1.5 8.16992 1.5C4.23489 1.5 1.04492 4.68997 1.04492 8.625C1.04492 12.56 4.23489 15.75 8.16992 15.75Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		<path d="M16.0449 16.5L13.5449 14" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
	</svg>
</form>
<!-- END of search form -->
