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
		render_repeater_list('features_list', $slug);
		?>

	</div>
</section>
