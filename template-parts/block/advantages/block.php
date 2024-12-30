<?php
/**
 * Block Name: Advantages
 * Description: Advantages block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: advantages acf block
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

$bg_color = get_field('background_color');
$style = get_field('style');
$icon = get_field('icon');
$title = get_field('title');
$subtitle = get_field('subtitle');
$title_color = get_field('title_color');
$text_color = get_field('text_color');

?>
<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?> "
		style="background: <?php echo $bg_color; ?>"
>

	<div class="<?php echo $slug; ?>__wrapp container-boxed column">
		<div class="<?php echo $slug; ?>__heading flex column">
			<div class="flex align-center">
				<?php
				if ($icon) : ?>
					<div class="<?php echo $slug; ?>__icon">
						<img src="<?php echo esc_url($icon ['url']); ?>"
							 alt="<?php echo esc_attr($icon ['alt']); ?>"/>
					</div>
				<?php endif; ?>
				<?php
				if ($title) : ?>
					<h2 class="<?php echo $slug; ?>__title"
						style="color: <?php echo $title_color; ?>">
						<?php echo $title; ?>
					</h2>
				<?php endif; ?>
			</div>

			<?php
			if ($subtitle) : ?>
				<div class="<?php echo $slug; ?>__subtitle"
					style="color: <?php echo $text_color; ?>">
					<?php echo $subtitle; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
		// check if the nested repeater field has rows of data
		if (have_rows('advantages_list')):?>
			<div class="<?php echo $slug; ?>__list <?php echo $style; ?>">
				<?php while (have_rows('advantages_list')): the_row();
					$icon = get_sub_field('icon');
					$title = get_sub_field('title');
					$text = get_sub_field('text');
					?>
					<div class="<?php echo $slug; ?>__item flex column align-center">
						<div class="<?php echo $slug; ?>__item-inner flex column">
							<div class="<?php echo $slug; ?>__item-top flex <?php echo $icon ? 'align-center' : ''; ?>">
								<?php
								if ($icon) : ?>
									<div class="<?php echo $slug; ?>__item-icon">
										<img src="<?php echo esc_url($icon ['url']); ?>"
											 alt="<?php echo esc_attr($icon ['alt']); ?>"/>
									</div>
								<?php endif; ?>

								<?php
								if ($title) : ?>
									<h4 class="<?php echo $slug; ?>__item-title">
										<?php echo $title; ?>
									</h4>
								<?php endif; ?>
							</div>
							<?php
							if ($text) : ?>
								<div class="<?php echo $slug; ?>__item-text">
									<?php echo $text; ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
