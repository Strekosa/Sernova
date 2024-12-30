<?php
/**
 * Block Name: Description
 * Description: Description block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: description acf block
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

$bg_color = get_field('bg_color');
$title = get_field('title');
$text = get_field('text');
$title_color = get_field('title_color');
$text_color = get_field('text_color');
$text_background = get_field('text_background');
$style = get_field('style');
$link = get_field('link');
?>

<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>"
		style="background: <?php echo $bg_color; ?>"
>
	<div class="<?php echo $slug; ?>__wrapp container-boxed column">

		<?php
		if ($title) : ?>
			<h2 class="<?php echo $slug; ?>__title"
				style="color: <?php echo $title_color; ?>">
				<?php echo $title; ?>
			</h2>
		<?php endif; ?>

		<?php
		if ($text):
			// Проверяем, нужно ли добавить класс background и стиль background-color
			$additional_class = $style ? 'background' : '';
			$additional_style = $style ? 'background-color: ' . esc_attr($text_background) . ';' : '';
			?>
			<div class="<?php echo $slug; ?>__text <?php echo $additional_class; ?>"
				 style="color: <?php echo esc_attr($text_color); ?>; <?php echo $additional_style; ?>">
				<?php echo $text; ?>
			</div>
		<?php endif; ?>


		<?php
		$file = get_field('file');
		if ($file): ?>
		<div class="<?php echo $slug; ?>__file button button-primary">

			<a class="flex align-center" href="<?php echo esc_url($file['url']); ?>" target="_blank">
				<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M6.73698 18.0376C5.69005 17.9411 4.65689 17.459 3.85791 16.6187C2.03955 14.7039 2.03955 11.5631 3.85791 9.64836L6.87475 6.48003C8.69311 4.56525 11.6824 4.56525 13.5145 6.48003C15.3329 8.39481 15.3329 11.5356 13.5145 13.4504L12.013 15.0345" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M17.2624 6.96289C18.3094 7.05932 19.3425 7.54146 20.1415 8.38176C21.9599 10.2965 21.9599 13.4373 20.1415 15.3521L17.1247 18.5204C15.3063 20.4352 12.317 20.4352 10.4849 18.5204C8.6665 16.6057 8.6665 13.4649 10.4849 11.5501L11.9864 9.96592" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<?php echo !empty($file['title']) ? esc_html($file['title']) : esc_html($file['filename']); ?>
			</a>
		</div>
		<?php endif; ?>

		<?php if ($link && !empty($link['url']) && !empty($link['title'])): ?>
			<div class="<?php echo $slug; ?>__button button button-primary flex align-center">
				<a href="<?php echo esc_url($link['url']); ?>"
				   target="<?php echo esc_attr($link['target'] ?: '_blank'); ?>"
				   class="flex align-center"
				>
					<svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M6.73698 18.0376C5.69005 17.9411 4.65689 17.459 3.85791 16.6187C2.03955 14.7039 2.03955 11.5631 3.85791 9.64836L6.87475 6.48003C8.69311 4.56525 11.6824 4.56525 13.5145 6.48003C15.3329 8.39481 15.3329 11.5356 13.5145 13.4504L12.013 15.0345" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
						<path d="M17.2624 6.96289C18.3094 7.05932 19.3425 7.54146 20.1415 8.38176C21.9599 10.2965 21.9599 13.4373 20.1415 15.3521L17.1247 18.5204C15.3063 20.4352 12.317 20.4352 10.4849 18.5204C8.6665 16.6057 8.6665 13.4649 10.4849 11.5501L11.9864 9.96592" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
					<?php echo esc_html($link['title']); ?>

				</a>
			</div>
		<?php endif; ?>


	</div>
</section>
