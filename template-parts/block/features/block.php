<?php
/**
 * Block Name: Features
 * Description: Features block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: features acf block
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

$title = get_field('title');
$bg_color = get_field('background_color');
$title_color = get_field('title_color');
?>
<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>"
		style="background: <?php echo $bg_color; ?>"
>

	<div class="<?php echo $slug; ?>__main container-boxed column">

		<?php
		if ($title) : ?>
			<h2 class="<?php echo $slug; ?>__title"
				style="color: <?php echo $title_color; ?>">
				<?php echo $title; ?>
			</h2>
		<?php endif; ?>

		<?php
		// check if the nested repeater field has rows of data
		if (have_rows('features_list')):
			$counter = 1;
			?>
			<div class="<?php echo $slug; ?>__list">
				<?php while (have_rows('features_list')): the_row();
					$icon = get_sub_field('icon');
					$title = get_sub_field('title');
					?>
					<div class="<?php echo $slug; ?>__item flex align-center">
						<?php if ($icon): ?>
							<div class="<?php echo $slug; ?>__item-icon flex column justify-center align-center">
								<img src="<?php echo esc_url($icon['url']); ?>"
									 alt="<?php echo esc_attr($icon['alt']); ?>"/>
							</div>
						<?php else: ?>
							<div class="<?php echo $slug; ?>__item-counter flex column justify-center align-center">
								<?php echo $counter; ?>
							</div>
						<?php endif; ?>

						<?php if ($title): ?>
							<p class="<?php echo $slug; ?>__item-title">
								<?php echo $title; ?>
							</p>
						<?php endif; ?>
					</div>
					<?php
					$counter++;
				endwhile; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
