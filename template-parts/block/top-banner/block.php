<?php
/**
 * Block Name: Top banner
 * Description: Top banner block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: top-banner acf block
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
$bg_image = get_field('bg_image');
$bg_url = $bg_image['url'];
?>


<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>"
		style="background-image: url('<?= $bg_url; ?>');"
>
	<div class="<?php echo $slug; ?>__wrapp container-boxed column">
		<div class="<?php echo $slug; ?>__breadcrumbs">
			<?php
			custom_breadcrumbs();
			?>
		</div>
		<div class="<?php echo $slug; ?>__heading">
		<?php
		if ($title) : ?>
			<h1 class="<?php echo $slug; ?>__title">
				<?php echo $title; ?>
			</h1>
		<?php endif; ?>

		<?php
		if ($subtitle) : ?>
			<div class="<?php echo $slug; ?>__subtitle">
				<?php echo $subtitle; ?>
			</div>
		<?php endif; ?>
		</div>
	</div>
</section>
