<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package sernova
 */

$slug = 'resources';
$post_id = get_the_ID();
$terms = get_the_terms($post_id, 'category');
$terms_classes = $terms ? implode(' ', wp_list_pluck($terms, 'slug')) : '';
$category_name = $terms ? $terms[0]->name : __('Uncategorized', THEME_TD);
$custom_text = get_field('text', $post_id);
$external_link = get_field('external_link', $post_id);
$external_url = is_array($external_link) && isset($external_link['url']) ? $external_link['url'] : '';
$is_testimonial = $terms && array_search('testimonials', wp_list_pluck($terms, 'slug')) !== false;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<a href="<?php echo esc_url($external_url ? $external_url : get_permalink($post_id)); ?>"
	   class="<?php echo $slug; ?>__item flex column justify-between <?php echo esc_attr($terms_classes); ?> <?php echo $is_testimonial ? 'testimonials-item' : ''; ?>"
	   target="_blank">

		<div class="<?php echo $slug; ?>__item-main flex column">

			<?php if (has_post_thumbnail()): ?>
				<div class="<?php echo $slug; ?>__item-image flex column justify-center">
					<?php the_post_thumbnail('large'); ?>
				</div>
			<?php endif; ?>

			<div class="<?php echo $slug; ?>__item-content">
				<h4 class="<?php echo $slug; ?>__item-title">
					<?php the_title(); ?>
				</h4>

				<?php if ($custom_text): ?>
					<div class="<?php echo $slug; ?>__item-excerpt">
						<?php
						echo $is_testimonial ? $custom_text : wp_trim_words($custom_text, 35, '...');
						?>
					</div>
				<?php endif; ?>

			</div>

		</div>

		<div class="<?php echo $slug; ?>__item-meta flex justify-between">
            <span class="<?php echo $slug; ?>__item-category">
                <?php echo $category_name; ?>
            </span>
			<span class="<?php echo $slug; ?>__item-date">
                <?php echo get_the_date('F jS, Y'); ?>
            </span>
		</div>

	</a>
</article><!-- #post-## -->

