<?php

//function filter_resources() {
//	$taxonomy = 'category';
//	$term = isset($_POST['filter']) ? sanitize_text_field($_POST['filter']) : 'all';
//	$paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
//	$search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
//
//	$query_args = array(
//		'post_type' => 'post',
//		'post_status' => 'publish',
//		'posts_per_page' => 12,
//		'paged' => $paged,
//		's' => $search,
//	);
//
//	if ($term !== 'all') {
//		$query_args['tax_query'] = array(
//			array(
//				'taxonomy' => $taxonomy,
//				'field'    => 'slug',
//				'terms'    => $term,
//			),
//		);
//	}
//
//	$resources_query = new WP_Query($query_args);
//
//	if ($resources_query->have_posts()) {
//		ob_start();
//
//		while ($resources_query->have_posts()) {
//			$resources_query->the_post();
//			get_template_part('template-parts/content');
//		}
//
//		$posts_html = ob_get_clean();
//
//		$pagination = paginate_links(array(
//			'total' => $resources_query->max_num_pages,
//			'current' => $paged,
//			'type' => 'array',
//			'prev_text' => '«',
//			'next_text' => '»',
//		));
//
//		$pagination_html = '';
//		if ($pagination) {
//			foreach ($pagination as $link) {
//				$pagination_html .= '<span class="pagination-item pagination-link">' . $link . '</span>';
//			}
//		}
//
//		wp_send_json_success(array(
//			'posts' => $posts_html,
//			'pagination' => $pagination_html,
//		));
//	} else {
//		wp_send_json_error(array('message' => 'No posts found.'));
//	}
//
//	wp_reset_postdata();
//	wp_die();
//}
//
//add_action('wp_ajax_filter_resources', 'filter_resources');
//add_action('wp_ajax_nopriv_filter_resources', 'filter_resources');


/**
 * Handles filtering resources via AJAX.
 */
function filter_resources()
{
	$taxonomy = 'category';
	$term = sanitize_text_field($_POST['filter'] ?? 'all');
	$paged = intval($_POST['page'] ?? 1);
	$search = sanitize_text_field($_POST['search'] ?? '');

	$query_args = build_query_args($taxonomy, $term, $paged, $search);
	$resources_query = new WP_Query($query_args);

	if ($resources_query->have_posts()) {
		wp_send_json_success([
			'posts' => get_posts_html($resources_query),
			'pagination' => get_pagination_html($resources_query->max_num_pages, $paged),
		]);
	} else {
		wp_send_json_error(['message' => 'No posts found.']);
	}

	wp_reset_postdata();
	wp_die();
}

/**
 * Builds query arguments for WP_Query.
 *
 * @param string $taxonomy Taxonomy to filter by.
 * @param string $term Term to filter by.
 * @param int $paged Current page.
 * @param string $search Search query.
 * @return array Query arguments.
 */
function build_query_args($taxonomy, $term, $paged, $search)
{
	$args = [
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => 12,
		'paged' => $paged,
		's' => $search,
	];

	if ($term !== 'all') {
		$args['tax_query'] = [
			[
				'taxonomy' => $taxonomy,
				'field' => 'slug',
				'terms' => $term,
			],
		];
	}

	return $args;
}

/**
 * Generates HTML for posts.
 *
 * @param WP_Query $query WP_Query object.
 * @return string Generated HTML.
 */
function get_posts_html($query)
{
	ob_start();
	while ($query->have_posts()) {
		$query->the_post();
		get_template_part('template-parts/content');
	}
	return ob_get_clean();
}

/**
 * Generates pagination HTML.
 *
 * @param int $total_pages Total number of pages.
 * @param int $current_page Current page number.
 * @return string Pagination HTML.
 */
function get_pagination_html($total_pages, $current_page)
{
	$pagination = paginate_links([
		'total' => $total_pages,
		'current' => $current_page,
		'type' => 'array',
		'prev_text' => '«',
		'next_text' => '»',
	]);

	if (!$pagination) {
		return '';
	}

	$pagination_html = '';
	foreach ($pagination as $link) {
		$pagination_html .= '<span class="pagination-item pagination-link">' . $link . '</span>';
	}

	return $pagination_html;
}

add_action('wp_ajax_filter_resources', 'filter_resources');
add_action('wp_ajax_nopriv_filter_resources', 'filter_resources');

?>

