<?php
/**
 * Block Name: Text
 * Description: Text block managed with ACF.
 * Category: common
 * Icon: list-view
 * Keywords: text acf block
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

$text = get_field('text');
?>
<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>"

>
	<div class="<?php echo $slug; ?>__wrapp container-boxed">

			<?php
			if ($text) : ?>
				<div class="<?php echo $slug; ?>__content">
					<?php echo $text; ?>
				</div>
			<?php endif; ?>

	</div>
</section>
