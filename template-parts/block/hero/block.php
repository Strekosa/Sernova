<?php
/**
 * Block Name: Hero
 * Description: Hero banner block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: hero acf block
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
$link = get_field('button');
?>


<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>"
		style="background-image: url('<?= $bg_url; ?>');"
>
	<div class="<?php echo $slug; ?>__wrapp container-boxed column">
		<div class="<?php echo $slug; ?>__main flex column">
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

			<?php
			if ($link):
				$link_url = $link['url'];
				$link_title = $link['title'];
				$link_target = $link['target'] ? $link['target'] : '_self';
				?>
				<div class="<?php echo $slug; ?>__button button button-primary">
					<a href="<?php echo esc_url($link_url); ?>"
					   target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>

		<div class="<?php echo $slug; ?>__animation">

		</div>
	</div>
</section>
