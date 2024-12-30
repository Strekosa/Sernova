<?php
function filter_careers() {
	$taxonomy = 'types';
	$term = isset($_POST['filter']) ? sanitize_text_field($_POST['filter']) : '';
	$query_args = array(
			'post_type' => 'careers',
			'post_status' => 'publish',
			'posts_per_page' => -1,
	);

	if ($term && $term !== 'all') {
		$query_args['tax_query'] = array(
				array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $term,
				),
		);
	}

	$careers_query = new WP_Query($query_args);

	if ($careers_query->have_posts()) {
		while ($careers_query->have_posts()): $careers_query->the_post();
			$post_id = get_the_ID();
			$location = get_field('location', $post_id);
			$terms = get_the_terms($post_id, $taxonomy);
			$terms_classes = $terms ? implode(' ', wp_list_pluck($terms, 'slug')) : '';
			?>
			<a href="<?php echo get_permalink($post_id); ?>" class="careers__item <?php echo esc_attr($terms_classes); ?>">
				<h4 class="careers__item-title"><?php the_title(); ?></h4>
				<?php if ($location): ?>
					<div class="careers__item-location"><?php echo esc_html($location); ?></div>
				<?php endif; ?>
			</a>
		<?php
		endwhile;
	} else {
		echo '<p>No careers found</p>';
	}

	wp_reset_postdata();
	wp_die();
}
add_action('wp_ajax_filter_careers', 'filter_careers');
add_action('wp_ajax_nopriv_filter_careers', 'filter_careers');
?>

