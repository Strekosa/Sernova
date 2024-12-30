<?php
/**
 * Block Name: Principles
 * Description: Principles block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: principles acf block
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

$title_first = get_field('title_first');
$title_second = get_field('title_second');
$text = get_field('text');
$images = get_field('images');

?>
<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">

	<div class="<?php echo $slug; ?>__main container-boxed column">

		<?php
		if ($title_first) : ?>
			<h4 class="<?php echo $slug; ?>__title">
				<?php echo $title_first; ?>
			</h4>
		<?php endif; ?>

		<?php
		render_repeater_list('principles_list', $slug);
		?>

		<?php
		if ($title_second) : ?>
			<h4 class="<?php echo $slug; ?>__title">
				<?php echo $title_second; ?>
			</h4>
		<?php endif; ?>

		<?php if ($text || $images): ?>
		<div class="<?php echo $slug; ?>__content">
			<?php
			if ($text) : ?>
				<div class="<?php echo $slug; ?>__text">
					<?php echo $text; ?>
				</div>
			<?php endif; ?>

			<?php
			// check if the nested repeater field has rows of data
			if (have_rows('images')):
				$counter = 1;
				?>
				<div class="<?php echo $slug; ?>__images flex">
					<?php while (have_rows('images')): the_row();
						$icon = get_sub_field('image');
						?>

						<?php if ($icon): ?>
							<div class="<?php echo $slug; ?>__image flex column justify-center align-center">
								<img src="<?php echo esc_url($icon['url']); ?>"
									 alt="<?php echo esc_attr($icon['alt']); ?>"/>
							</div>
						<?php endif; ?>

						<?php
						$counter++;
					endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
</section>
