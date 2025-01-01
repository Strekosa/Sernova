<?php
/**
 * Renders the breadcrumb navigation.
 */
function custom_breadcrumbs() {
	echo '<nav class="breadcrumbs">';
	echo '<a href="' . home_url() . '">Home</a>';

	$svg_separator = '<svg class="breadcrumbs-separator" width="7" height="2" viewBox="0 0 7 2" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M6.54253 0.33V1.408H0.956531V0.33H6.54253Z" fill="white"/>
    </svg>';

	$type = detect_breadcrumb_type();

	switch ($type) {
		case 'post':
			render_post_breadcrumbs($svg_separator);
			break;
		case 'solutions':
			render_solutions_breadcrumbs($svg_separator);
			break;
		case 'careers_archive':
			render_careers_archive_breadcrumbs($svg_separator);
			break;
		case 'careers_single':
			render_careers_single_breadcrumbs($svg_separator);
			break;
		case 'special_page':
			render_special_page_breadcrumbs($svg_separator);
			break;
		case 'home':
		case 'page':
			render_generic_breadcrumbs($svg_separator, get_the_title());
			break;
	}

	echo '</nav>';
}

/**
 * Detects the breadcrumb type.
 *
 * @return string|null The type of breadcrumb to render.
 */
function detect_breadcrumb_type() {
	$types = [
		'post'              => is_single() && get_post_type() === 'post',
		'solutions'         => is_singular('solutions'),
		'careers_archive'   => is_post_type_archive('careers'),
		'careers_single'    => is_singular('careers'),
		'special_page'      => is_page(['about', 'strategic-alliances', 'our-team']),
		'home'              => is_home(),
		'page'              => is_page(),
	];

	foreach ($types as $type => $condition) {
		if ($condition) return $type;
	}

	return null;
}

/**
 * Renders breadcrumbs for single posts.
 */
function render_post_breadcrumbs($svg_separator) {
	echo $svg_separator;
	echo '<a href="' . home_url('/resources/') . '">Resources</a>';
	$categories = get_the_category();
	if (!empty($categories)) {
		echo $svg_separator . '<span>' . esc_html($categories[0]->name) . '</span>';
	}
}

/**
 * Renders breadcrumbs for solutions.
 */
function render_solutions_breadcrumbs($svg_separator) {
	echo $svg_separator . '<span class="opacity">Solutions</span>';
	echo $svg_separator . '<span>' . esc_html(get_the_title()) . '</span>';
}

/**
 * Renders breadcrumbs for careers archive.
 */
function render_careers_archive_breadcrumbs($svg_separator) {
	echo $svg_separator . '<span class="opacity">Sernova</span>';
	echo $svg_separator . '<span>Careers</span>';
}

/**
 * Renders breadcrumbs for single careers posts.
 */
function render_careers_single_breadcrumbs($svg_separator) {
	echo $svg_separator . '<span class="opacity">Sernova</span>';
	echo $svg_separator . '<a href="' . esc_url(get_post_type_archive_link('careers')) . '">Careers</a>';
	$terms = get_the_terms(get_the_ID(), 'types');
	if (!empty($terms) && !is_wp_error($terms)) {
		echo $svg_separator . '<span>' . esc_html($terms[0]->name) . '</span>';
	}
}

/**
 * Renders breadcrumbs for special pages.
 */
function render_special_page_breadcrumbs($svg_separator) {
	echo $svg_separator . '<span class="opacity">Sernova</span>';
	echo $svg_separator . '<span>' . esc_html(get_the_title()) . '</span>';
}

/**
 * Renders generic breadcrumbs.
 */
function render_generic_breadcrumbs($svg_separator, $title) {
	echo $svg_separator . '<span>' . esc_html($title) . '</span>';
}
