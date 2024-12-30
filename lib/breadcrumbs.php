<?php
function custom_breadcrumbs() {
	echo '<nav class="breadcrumbs">';

	// Link to the home page
	echo '<a href="' . home_url() . '">Home</a>';

	// SVG separator
	$svg_separator = '<svg class="breadcrumbs-separator" width="7" height="2" viewBox="0 0 7 2" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M6.54253 0.33V1.408H0.956531V0.33H6.54253Z" fill="white"/>
    </svg>';

	// For single standard posts
	if (is_single() && get_post_type() === 'post') {
		// Home → Resources (link) → Category Name
		echo $svg_separator;

		// Get the URL for the Resources page (replace with the correct URL)
		$resources_page_url = home_url('/resources/');
		echo '<a href="' . esc_url($resources_page_url) . '">Resources</a>';

		// Get the first category of the post
		$categories = get_the_category();
		if (!empty($categories)) {
			$category = $categories[0];
			echo $svg_separator;
			echo '<span>' . esc_html($category->name) . '</span>';
		}
	}

	// For single posts of the custom post type "Solutions"
	elseif (is_singular('solutions')) {
		// Home → Solutions → Post Title
		echo $svg_separator;
		echo '<span class="opacity">Solutions</span>';
		echo $svg_separator;
		echo '<span>' . esc_html(get_the_title()) . '</span>';
	}

	// For the archive of the custom post type "Careers"
	elseif (is_post_type_archive('careers')) {
		// Home → Sernova → Careers
		echo $svg_separator;
		echo '<span class="opacity">Sernova</span>';
		echo $svg_separator;
		echo '<span>Careers</span>';
	}

	// For single posts of the custom post type "Careers"
	elseif (is_singular('careers')) {
		// Home → Sernova → Careers (link) → Taxonomy Name
		echo $svg_separator;
		echo '<span class="opacity">Sernova</span>';
		echo $svg_separator;
		echo '<a href="' . esc_url(get_post_type_archive_link('careers')) . '">Careers</a>';

		// Get the first taxonomy term of the post (if available)
		$terms = get_the_terms(get_the_ID(), 'types'); // Replace 'types' with the correct taxonomy name
		if (!empty($terms) && !is_wp_error($terms)) {
			$term = $terms[0];
			echo $svg_separator;
			echo '<span>' . esc_html($term->name) . '</span>';
		}
	}

	// For specific pages: About and Strategic Alliances
	elseif (is_page(['about', 'strategic-alliances','our-team'])) {
		// Home → Sernova → Page Title
		echo $svg_separator;
		echo '<span class="opacity">Sernova</span>';
		echo $svg_separator;
		echo '<span>' . esc_html(get_the_title()) . '</span>';
	}

	// For the blog page (standard posts archive)
	elseif (is_home()) {
		echo $svg_separator;
		echo '<span>Resources</span>';
	}

	// For all other pages
	elseif (is_page()) {
		echo $svg_separator;
		echo '<span>' . esc_html(get_the_title()) . '</span>';
	}

	echo '</nav>';
}




