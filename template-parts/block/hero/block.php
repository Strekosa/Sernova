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
	<div class="<?php echo $slug; ?>__wrapp container-boxed pos-rel">
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
				<div class="<?php echo $slug; ?>__button button button-primary hide-mobile">
					<a href="<?php echo esc_url($link_url); ?>"
					   target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>

		<div class="<?php echo $slug; ?>__animation-wrapp">
		<div class="<?php echo $slug; ?>__animation anim-block" style='position: relative'>
			<video autoplay muted playsinline style="width: 100%; height: auto;">
				<?php
				$is_ios = strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false;
				$is_safari = strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') === false;

				$default_video = get_template_directory_uri() . '/assets/images/Sernova logo anim 16x9 E3E3E3.mp4';
				$iphone_video = get_template_directory_uri() . '/assets/images/Sernova logo anim 16x9 E3E3E3.mp4?v=' . time();

				?>

				<?php if ($is_ios || $is_safari): ?>
					<source src="<?php echo esc_url($iphone_video); ?>" type="video/mp4">
				<?php else: ?>
					<source src="<?php echo esc_url($default_video); ?>" type="video/mp4">
				<?php endif; ?>

			</video>

			<!-- Overlay Section -->
			<div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none;">

				<?php
				$link_1 = get_field('link_1', 'option');
				$link_2 = get_field('link_2', 'option');
				$link_3 = get_field('link_3', 'option');
				?>

				<?php if ($link_1):
					$link_1_url = $link_1['url'];
					$link_1_target = $link_1['target'] ? $link_1['target'] : '_self';
					?>
					<a href="<?php echo esc_url($link_1_url); ?>" target="<?php echo esc_attr($link_1_target); ?>"
					   style="position: absolute; top: 34%; left: 28%; width: 26%; height: 14%; pointer-events: auto; transform: rotate(-60deg);">
					</a>
				<?php endif; ?>

				<?php if ($link_2):
					$link_2_url = $link_2['url'];
					$link_2_target = $link_2['target'] ? $link_2['target'] : '_self';
					?>
					<a href="<?php echo esc_url($link_2_url); ?>" target="<?php echo esc_attr($link_2_target); ?>"
					   style="position: absolute; top: 34%; left: 46%; width: 26%; height: 14%; pointer-events: auto; transform: rotate(60deg);">
					</a>
				<?php endif; ?>

				<?php if ($link_3):
					$link_3_url = $link_3['url'];
					$link_3_target = $link_3['target'] ? $link_3['target'] : '_self';
					?>
					<a href="<?php echo esc_url($link_3_url); ?>" target="<?php echo esc_attr($link_3_target); ?>"
					   style="position: absolute; top: 61%; left: 37.5%; width: 26%; height: 14%; pointer-events: auto;">
					</a>
				<?php endif; ?>

			</div>

		</div>
		</div>

		<?php
		if ($link):
			$link_url = $link['url'];
			$link_title = $link['title'];
			$link_target = $link['target'] ? $link['target'] : '_self';
			?>
			<div class="<?php echo $slug; ?>__button button button-primary show-mobile" style="z-index: 1">
				<a href="<?php echo esc_url($link_url); ?>"
				   target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>
