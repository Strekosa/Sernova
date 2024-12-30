<?php
/**
 * Block Name: Careers
 * Description: Careers block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: careers acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package Port
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

			<?php
			$terms = get_terms(array(
					'taxonomy' => 'types',
					'hide_empty' => false,
					'meta_key' => 'taxonomy_order',
					'orderby' => 'meta_value_num',
					'order' => 'ASC',
			));
			if ($terms): ?>
				<div class="<?php echo $slug; ?>__taxonomies container-boxed align-center">
					<button class="<?php echo $slug; ?>__taxonomy filter-button active" data-filter="all">
						<?php _e('All categories', THEME_TD); ?>
					</button>
					<?php foreach ($terms as $term): ?>
						<button class="<?php echo $slug; ?>__taxonomy filter-button"
								data-filter="<?php echo sanitize_html_class($term->slug); ?>">
							<?php echo esc_html($term->name); ?>
						</button>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
		$query_args = array(
				'post_type' => 'careers',
				'post_status' => 'publish',
				'posts_per_page' => -1,
		);

		$careers_query = new WP_Query($query_args);

		if ($careers_query->have_posts()): ?>
			<div class="<?php echo $slug; ?>__list">
				<div class="<?php echo $slug; ?>__list-wrapp container-boxed">

					<?php while ($careers_query->have_posts()): $careers_query->the_post(); ?>
						<?php
						$post_id = get_the_ID();
						$location = get_field('location', $post_id);
						$terms = get_the_terms($post_id, 'types');
						$terms_classes = $terms ? implode(' ', wp_list_pluck($terms, 'slug')) : '';
						?>
						<a href="<?php echo get_permalink($post_id); ?>"
						   class="<?php echo $slug; ?>__item <?php echo esc_attr($terms_classes); ?>">
							<h4 class="<?php echo $slug; ?>__item-title">
								<?php the_title(); ?>
							</h4>
							<?php if ($location): ?>
								<div class="<?php echo $slug; ?>__item-location">
									<?php echo $location; ?>
								</div>
							<?php endif; ?>
						</a>

					<?php endwhile; ?>

				</div>
			</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
</section>
