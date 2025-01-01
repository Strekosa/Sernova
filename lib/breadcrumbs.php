<?php
function custom_breadcrumbs() {
	echo '<nav class="breadcrumbs">';
	echo '<a href="' . home_url() . '">Home</a>';

	$svg_separator = '<svg class="breadcrumbs-separator" width="7" height="2" viewBox="0 0 7 2" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M6.54253 0.33V1.408H0.956531V0.33H6.54253Z" fill="white"/>
    </svg>';

	$render_breadcrumb = function ($label, $url = null, $is_opacity = false) use ($svg_separator) {
		echo $svg_separator;
		if ($url) {
			echo '<a href="' . esc_url($url) . '">' . esc_html($label) . '</a>';
		} else {
			$class = $is_opacity ? ' class="opacity"' : '';
			echo '<span' . $class . '>' . esc_html($label) . '</span>';
		}
	};

	$type = detect_breadcrumb_type();

	switch ($type) {
		case 'post':
			$render_breadcrumb('Resources', home_url('/resources/'));
			$categories = get_the_category();
			if (!empty($categories)) {
				$render_breadcrumb($categories[0]->name);
			}
			break;
		case 'solutions':
			$render_breadcrumb('Solutions', null, true);
			$render_breadcrumb(get_the_title());
			break;
		case 'careers_archive':
			$render_breadcrumb('Sernova', null, true);
			$render_breadcrumb('Careers');
			break;
		case 'careers_single':
			$render_breadcrumb('Sernova', null, true);
			$render_breadcrumb('Careers', get_post_type_archive_link('careers'));
			$terms = get_the_terms(get_the_ID(), 'types');
			if (!empty($terms) && !is_wp_error($terms)) {
				$render_breadcrumb($terms[0]->name);
			}
			break;
		case 'special_page':
			$render_breadcrumb('Sernova', null, true);
			$render_breadcrumb(get_the_title());
			break;
		case 'home':
			$render_breadcrumb('Resources');
			break;
		case 'page':
			$render_breadcrumb(get_the_title());
			break;
	}

	echo '</nav>';
}

function detect_breadcrumb_type() {
	if (is_single() && get_post_type() === 'post') {
		return 'post';
	} elseif (is_singular('solutions')) {
		return 'solutions';
	} elseif (is_post_type_archive('careers')) {
		return 'careers_archive';
	} elseif (is_singular('careers')) {
		return 'careers_single';
	} elseif (is_page(['about', 'strategic-alliances', 'our-team'])) {
		return 'special_page';
	} elseif (is_home()) {
		return 'home';
	} elseif (is_page()) {
		return 'page';
	}
	return null;
}


