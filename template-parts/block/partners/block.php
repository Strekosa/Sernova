<?php
/**
 * Block Name: Partners
 * Description: Partners block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: partners acf block
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

$image_position = get_field('image_position');
$image = get_field('image');
$title = get_field('title');
$desc = get_field('description');
$link = get_field('link');
?>
<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?> <?php echo $image_position; ?>">

	<div class="<?php echo $slug; ?>__wrapp container-boxed justify-between">
		<?php
		// check if the nested repeater field has rows of data
		if (have_rows('partners_list')):
			$counter = 1;
			?>
			<div class="<?php echo $slug; ?>__list">
				<?php while (have_rows('partners_list')): the_row();
					$icon = get_sub_field('image');
					$content = get_sub_field('content');
					$text = $content['text'] ?? '';
					$link = $content['link'] ?? '';
					?>
					<div class="<?php echo $slug; ?>__item flex">
						<div class="<?php echo $slug; ?>__item-media flex">
							<?php if ($icon): ?>
								<div class="<?php echo $slug; ?>__item-icon flex column justify-center align-center">
									<img src="<?php echo esc_url($icon['url']); ?>"
										 alt="<?php echo esc_attr($icon['alt']); ?>"/>
								</div>
							<?php endif; ?>
						</div>
						<?php if ($text || $link): ?>
							<div class="<?php echo $slug; ?>__item-content">
								<?php if ($text): ?>
									<div class="<?php echo $slug; ?>__item-text flex column">
										<?php echo wp_kses_post($text); ?>
									</div>
								<?php endif; ?>

								<?php if ($link): ?>
									<div class="<?php echo $slug; ?>__item-link button button-primary">
										<a href="<?php echo esc_url($link['url']); ?>"
										   target="<?php echo esc_attr($link['target'] ?: '_self'); ?>"
										   class="flex align-center">
											<?php echo esc_html($link['title'] ?: 'Visit Partner'); ?>
										</a>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
					<?php
					$counter++;
				endwhile; ?>
			</div>
		<?php endif; ?>
	</div>

</section>
