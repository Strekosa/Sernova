<?php
get_header();
$archive_page_url = get_field('archive_executives_page', 'option');

if ($archive_page_url) {

	$path = parse_url($archive_page_url, PHP_URL_PATH);
	$slug = trim($path, '/');

	if ($slug) {

		$archive_page = get_page_by_path($slug);

		if ($archive_page && !is_wp_error($archive_page)) {
			echo apply_filters('the_content', $archive_page->post_content);
		}
	}
}

get_footer();

