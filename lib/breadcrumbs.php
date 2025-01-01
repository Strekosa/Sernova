<?php
function custom_breadcrumbs() {
	echo '<nav class="breadcrumbs">';
	echo '<a href="' . home_url() . '">Home</a>';

	$svg_separator = '<svg class="breadcrumbs-separator" width="7" height="2" viewBox="0 0 7 2" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M6.54253 0.33V1.408H0.956531V0.33H6.54253Z" fill="white"/>
    </svg>';

	// Helper function for rendering a breadcrumb segment
	$render_breadcrumb = function ($label, $url = null, $is_opacity = false) use ($svg_separator) {
		echo $svg_separator;
		if ($url) {
			echo '<a href="' . esc_url($url) . '">' . esc_html($label) . '</a>';
		} else {
			$class = $is_opacity ? ' class="opacity"' : '';
			echo '<span' . $class . '>' . esc_html($label) . '</span>';
		}
	};

	if (is_single() && get_post_type() === 'post') {
		$render_breadcrumb('Resources', home_url('/resources/'));
		$categories = get_the_category();
		if (!empty($categories)) {
			$render_breadcrumb($categories[0]->name);
		}
	} elseif (is_singular('solutions')) {
		$render_breadcrumb('Solutions', null, true);
		$render_breadcrumb(get_the_title());
	} elseif (is_post_type_archive('careers')) {
		$render_breadcrumb('Sernova', null, true);
		$render_breadcrumb('Careers');
	} elseif (is_singular('careers')) {
		$render_breadcrumb('Sernova', null, true);
		$render_breadcrumb('Careers', get_post_type_archive_link('careers'));
		$terms = get_the_terms(get_the_ID(), 'types');
		if (!empty($terms) && !is_wp_error($terms)) {
			$render_breadcrumb($terms[0]->name);
		}
	} elseif (is_page(['about', 'strategic-alliances', 'our-team'])) {
		$render_breadcrumb('Sernova', null, true);
		$render_breadcrumb(get_the_title());
	} elseif (is_home()) {
		$render_breadcrumb('Resources');
	} elseif (is_page()) {
		$render_breadcrumb(get_the_title());
	}

	echo '</nav>';
}

