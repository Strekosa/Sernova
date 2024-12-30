<?php
/**
 * Block Name: Spacer
 * Description: It is spacer ACF Block.
 * Category: common
 * Icon: list-view
 * Keywords: spacer acf block example
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

$heightdesk = get_field('space_desktop');
$heighttablet = get_field('space_tablet');
$heightmob = get_field('space_mobile');
$bg_color = get_field('bg_color');
$border = get_field('border_radius');
$behind = get_field('behind');
?>
<div id="<?php echo $block_id; ?>"
	 class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>"
	 style="
			 --space-desktop: <?php echo $heightdesk; ?>px;
			 --space-tablet: <?php echo $heighttablet; ?>px;
			 --space-mobile: <?php echo $heightmob; ?>px;
			 background: <?php echo $bg_color; ?>;
	 <?php if ($border): ?>
			 border-top-right-radius: 30px;
			 border-top-left-radius: 30px;
			 margin-bottom: -1px;
			 margin-top: -1px;
	 <?php endif; ?>
	 <?php if ($behind): ?>
			 margin-bottom: -30px;
			 margin-top: -1px;
	 <?php endif; ?>
			 ">
</div>
