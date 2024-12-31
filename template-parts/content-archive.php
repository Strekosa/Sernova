<?php
/**
 * Template part for displaying archive page content.
 *
 * @param array $args {
 *     Arguments passed to the template part.
 *
 *     @type string $acf_field_name The name of the ACF field storing the archive page URL.
 * }
 */

$acf_field_name = $args['acf_field_name'] ?? '';

if (empty($acf_field_name)) {
	return;
}

$archive_page_url = get_field($acf_field_name, 'option');

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
