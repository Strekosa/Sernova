<?php
/**
 * Block Name: Contact-form
 * Description: Contact-form block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: contact-form acf block
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
$desc = get_field('desc');
$form = get_field('form');
$text = get_field('text');
?>
<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">
	<div class="<?php echo $slug; ?>__main container-boxed justify-between">

		<div class="<?php echo $slug; ?>__text flex column">
			<?php if ($title) : ?>
				<h2 class="<?php echo $slug; ?>__title">
					<?php echo $title; ?>
				</h2>
			<?php endif; ?>

			<?php if ($desc) : ?>
				<div class="<?php echo $slug; ?>__description">
					<?php echo $desc; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="<?php echo $slug; ?>__form">
			<?php
			if ($form):
				foreach ($form as $p):
					$cf7_id = $p->ID;
					echo do_shortcode('[contact-form-7 id="' . $cf7_id . '" ]');
				endforeach;
			endif;
			?>
		</div>
	</div>
</section>
