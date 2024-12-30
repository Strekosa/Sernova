<?php
/**
 * Block Name: Map
 * Description: Map block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: Map acf block
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
$subtitle = get_field('subtitle');
$map = get_field('map');
?>


<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">

	<div class="<?php echo $slug; ?>__wrapp container-boxed column">
		<div class="<?php echo $slug; ?>__breadcrumbs">
			<?php
			custom_breadcrumbs();
			?>
		</div>

		<?php
		if ($map) : ?>
			<div class="<?php echo $slug; ?>__map">
				<img src="<?php echo esc_url($map ['url']); ?>"
					 alt="<?php echo esc_attr($map ['alt']); ?>"/>
			</div>
		<?php endif; ?>

		<?php
		// check if the nested repeater field has rows of data
		if (have_rows('markers')):?>
			<div class="<?php echo $slug; ?>__markers flex column">
				<?php while (have_rows('markers')): the_row();
					$icon = get_sub_field('icon');
					$title = get_sub_field('text');
					?>
					<div class="<?php echo $slug; ?>__marker flex align-center">

						<?php
						if ($icon) : ?>
							<div class="<?php echo $slug; ?>__marker-icon">
								<img src="<?php echo esc_url($icon ['url']); ?>"
									 alt="<?php echo esc_attr($icon ['alt']); ?>"/>
							</div>
						<?php endif; ?>

						<?php
						if ($title) : ?>
							<p class="<?php echo $slug; ?>__marker-title">
								<?php echo $title; ?>
							</p>
						<?php endif; ?>

					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>

	</div>
</section>
