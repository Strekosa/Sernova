<?php
/**
 * Block Name: CTA
 * Description: CTA block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: cta acf block
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

// Поле custom_value определяет источник данных
$custom_value = get_field('custom_value');

// Проверяем источник данных
if ($custom_value) {
	$title = get_field('title');
	$subtitle = get_field('subtitle');
	$link = get_field('button');
} else {
	$title = get_field('cta_title', 'options');
	$subtitle = get_field('cta_subtitle', 'options');
	$link = get_field('cta_button', 'options');
}
?>

<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>"
>
	<div class="<?php echo $slug; ?>__wrapp container-boxed column align-center">
		<div class="<?php echo $slug; ?>__heading">
			<?php if ($title): ?>
				<h2 class="<?php echo $slug; ?>__title">
					<?php echo esc_html($title); ?>
				</h2>
			<?php endif; ?>

			<?php if ($subtitle): ?>
				<h2 class="<?php echo $slug; ?>__subtitle">
					<?php echo esc_html($subtitle); ?>
				</h2>
			<?php endif; ?>
		</div>

		<?php if ($link && !empty($link['url']) && !empty($link['title'])): ?>
			<div class="<?php echo $slug; ?>__button button button-secondary">
				<a href="<?php echo esc_url($link['url']); ?>"
				   target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
					<?php echo esc_html($link['title']); ?>
				</a>
				<svg width="68" height="56" viewBox="0 0 101 84" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g clip-path="url(#clip0_2227_2880)">
						<path fill-rule="evenodd" clip-rule="evenodd"
							  d="M66.386 17.0273L99.9236 74.7191C102.533 81.3662 98.9137 84 89.7823 84H29.2295C18.6674 84 15.4273 80.4883 20.8135 71.2493L36.341 44.4937L51.1531 18.9922C56.6655 9.50234 59.9057 6.78497 66.3439 16.9856H66.386V17.0273Z"
							  fill="#0BBBEF"/>
						<path fill-rule="evenodd" clip-rule="evenodd"
							  d="M51.697 6.81533L33.2412 38.8014L10.5264 78.2299C8.43868 81.2404 5.14002 83.7073 0.338182 84H-81.3766C-86.6795 83.7073 -88.0574 81.1986 -85.5103 76.7665L-85.5938 76.8502L-45.8847 7.94426V8.06969C-43.0036 3.01045 -37.492 0 -31.2704 0H45.893C52.031 0 54.2023 1.83973 51.7805 6.85716H51.697V6.81533Z"
							  fill="#0B4697"/>
					</g>
					<defs>
						<clipPath id="clip0_2227_2880">
							<rect width="100.5" height="84" fill="white" transform="translate(0.25)"/>
						</clipPath>
					</defs>
				</svg>
			</div>
		<?php endif; ?>
	</div>
</section>
