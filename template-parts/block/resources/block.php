<?php
/**
 * Block Name: Resources
 * Description: Resources block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: resources acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package sernova
 *
 * @var array $block
 */

$slug = str_replace('acf/', '', $block['name']);
$block_id = $slug . '-' . $block['id'];
$align_class = $block['align'] ? 'align' . $block['align'] : '';
$custom_class = isset($block['className']) ? $block['className'] : '';
?>

<section
		id="<?php echo $block_id; ?>"
		class="<?php echo "$slug $align_class $custom_class"; ?>">
	<div class="<?php echo $slug; ?>__wrapp flex column">

		<div class="<?php echo $slug; ?>__heading">
			<div class="<?php echo $slug; ?>__heading-main  container-boxed align-center">

				<?php
				$categories = get_terms(array(
						'taxonomy' => 'category',
						'hide_empty' => true,
						'meta_key' => 'order',
						'orderby' => 'meta_value_num',
						'order' => 'ASC',
				));

				if (!empty($categories) && !is_wp_error($categories)): ?>
					<div class="<?php echo $slug; ?>__taxonomies flex align-center">
						<button class="<?php echo $slug; ?>__taxonomy filter-posts-button active" data-filter="all">
							<?php _e('All categories', THEME_TD); ?>
						</button>
						<?php foreach ($categories as $category): ?>
							<button class="<?php echo $slug; ?>__taxonomy filter-posts-button"
									data-filter="<?php echo sanitize_html_class($category->slug); ?>">
								<?php echo esc_html($category->name); ?>
							</button>
						<?php endforeach; ?>

					</div>
				<?php endif; ?>

				<div class="<?php echo $slug; ?>__search">
					<form method="get" id="resources-search-form" class="search-form"
						  action="<?php echo esc_url(home_url('/')); ?>">
						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M8.16992 15.75C12.105 15.75 15.2949 12.56 15.2949 8.625C15.2949 4.68997 12.105 1.5 8.16992 1.5C4.23489 1.5 1.04492 4.68997 1.04492 8.625C1.04492 12.56 4.23489 15.75 8.16992 15.75Z"
								  stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
							<path d="M16.0449 16.5L13.5449 14" stroke="white" stroke-width="1.5" stroke-linecap="round"
								  stroke-linejoin="round"/>
						</svg>
						<input type="search" name="s" id="search-input" class="search-field pos-rel"
							   placeholder="<?php echo esc_attr__('Search', 'wp_dev'); ?>"
							   value="<?php echo esc_attr(get_search_query()); ?>"/>

					</form>
				</div>
			</div>

		</div>


<!--		--><?php
//		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//		$query_args = array(
//				'post_type' => 'post',
//				'post_status' => 'publish',
//				'posts_per_page' => 12,
//		);
//
//		$posts_query = new WP_Query($query_args);
//
//		if ($posts_query->have_posts()): ?>
<!--			<div class="--><?php //echo $slug; ?><!--__list">-->
<!--				<div class="--><?php //echo $slug; ?><!--__list-wrapp container-boxed">-->
<!---->
<!--					--><?php //while ($posts_query->have_posts()): $posts_query->the_post(); ?>
<!--						--><?php
//						$post_id = get_the_ID();
//						$terms = get_the_terms($post_id, 'category');
//						$terms_classes = $terms ? implode(' ', wp_list_pluck($terms, 'slug')) : '';
//						$category_name = $terms ? $terms[0]->name : __('Uncategorized', THEME_TD);
//						$custom_text = get_field('text', $post_id);
//						get_template_part('template-parts/content')
//						?>
<!---->
<!--					--><?php //endwhile; ?>
<!---->
<!--				</div>-->
<!---->
<!--				<div class="--><?php //echo $slug; ?><!--__pagination container-boxed justify-center">-->
<!--					--><?php
//					$total_pages = $posts_query->max_num_pages;
//					$current_page = max(1, get_query_var('paged'));
//
//					if ($total_pages > 1) {
//						$pagination_links = paginate_links(array(
//								'total' => $total_pages,
//								'current' => $current_page,
//								'type' => 'array',
//								'prev_text' => __('<svg width="9" height="18" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
//  <path d="M7.43016 1.08008L0.910156 7.60008C0.140156 8.37008 0.140156 9.63008 0.910156 10.4001L7.43016 16.9201" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
//</svg>'),
//								'next_text' => __('<svg width="9" height="18" viewBox="0 0 9 18" fill="none" xmlns="http://www.w3.org/2000/svg">
//<path d="M0.910156 16.9201L7.43016 10.4001C8.20016 9.63008 8.20016 8.37008 7.43016 7.60008L0.910156 1.08008" stroke="black" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
//</svg>'),
//						));
//
//						if (!empty($pagination_links)) {
//							echo '<div class="pagination-container">';
//							foreach ($pagination_links as $link) {
//								echo '<span class="pagination-item pagination-link">' . $link . '</span>';
//							}
//							echo '</div>';
//						}
//					}
//					?>
<!---->
<!--				</div>-->
<!--			</div>-->
<!--		--><?php //endif; ?>
<!--		--><?php //wp_reset_postdata(); ?>


		<?php
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$query_args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => 12,
				'paged' => $paged,
		);

		$posts_query = new WP_Query($query_args);

		if ($posts_query->have_posts()): ?>
			<div class="<?php echo $slug; ?>__list">
				<div class="<?php echo $slug; ?>__list-wrapp container-boxed">
					<?php while ($posts_query->have_posts()): $posts_query->the_post(); ?>
						<?php
						$post_id = get_the_ID();
						$terms = get_the_terms($post_id, 'category');
						$terms_classes = $terms ? implode(' ', wp_list_pluck($terms, 'slug')) : '';
						$category_name = $terms ? $terms[0]->name : __('Uncategorized', THEME_TD);
						$custom_text = get_field('text', $post_id);
						get_template_part('template-parts/content')
						?>
					<?php endwhile; ?>
				</div>

				<div class="<?php echo $slug; ?>__pagination container-boxed justify-center">
					<?php
					$total_pages = $posts_query->max_num_pages;
					$current_page = max(1, get_query_var('paged'));

					if ($total_pages > 1) {
						$pagination_links = paginate_links(array(
								'total' => $total_pages,
								'current' => $current_page,
								'type' => 'array',
								'prev_text' => '«',
								'next_text' => '»',
						));

						if (!empty($pagination_links)) {
							echo '<div class="pagination-container">';
							foreach ($pagination_links as $link) {
								if (strpos($link, 'prev') !== false && $current_page <= 1) {
									continue;
								}
								if (strpos($link, 'next') !== false && $current_page >= $total_pages) {
									continue;
								}
								echo '<span class="pagination-item pagination-link">' . $link . '</span>';
							}
							echo '</div>';
						}
					}
					?>
				</div>
			</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

	</div>
</section>
