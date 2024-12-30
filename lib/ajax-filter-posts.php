<?php

function filter_resources() {
	$taxonomy = 'category';
	$term = isset($_POST['filter']) ? sanitize_text_field($_POST['filter']) : 'all';
	$paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

	$query_args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => 12,
		'paged' => $paged,
		's' => $search,
	);

	if ($term !== 'all') {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $term,
			),
		);
	}

	$resources_query = new WP_Query($query_args);

	if ($resources_query->have_posts()) {
		ob_start();

		while ($resources_query->have_posts()) {
			$resources_query->the_post();
			get_template_part('template-parts/content');
		}

		$posts_html = ob_get_clean();

		$pagination = paginate_links(array(
			'total' => $resources_query->max_num_pages,
			'current' => $paged,
			'type' => 'array',
			'prev_text' => '«',
			'next_text' => '»',
		));

		$pagination_html = '';
		if ($pagination) {
			foreach ($pagination as $link) {
				$pagination_html .= '<span class="pagination-item pagination-link">' . $link . '</span>';
			}
		}

		wp_send_json_success(array(
			'posts' => $posts_html,
			'pagination' => $pagination_html,
		));
	} else {
		wp_send_json_error(array('message' => 'No posts found.'));
	}

	wp_reset_postdata();
	wp_die();
}

add_action('wp_ajax_filter_resources', 'filter_resources');
add_action('wp_ajax_nopriv_filter_resources', 'filter_resources');
?>

