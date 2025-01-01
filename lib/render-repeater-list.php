<?php
/**
 * Render a list of items from an ACF repeater field.
 *
 * @param string $field_name The name of the ACF repeater field.
 * @param string $slug The CSS class prefix for styling.
 */
function render_repeater_list($field_name, $slug) {
	if (!have_rows($field_name)) {
		return;
	}

	$counter = 1;
	echo '<div class="' . esc_attr($slug . '__list') . '">';

	while (have_rows($field_name)) : the_row();
		$icon = get_sub_field('icon');
		$title = get_sub_field('title');

		render_repeater_item($icon, $title, $slug, $counter);
		$counter++;
	endwhile;

	echo '</div>';
}

/**
 * Render a single item in the repeater list.
 *
 * @param array|null $icon Icon data from ACF.
 * @param string|null $title Title of the item.
 * @param string $slug The CSS class prefix for styling.
 * @param int $counter Counter value for items without an icon.
 */
function render_repeater_item($icon, $title, $slug, $counter) {
	echo '<div class="' . esc_attr($slug) . '__item flex align-center">';

	if ($icon) {
		echo '<div class="' . esc_attr($slug) . '__item-icon flex column justify-center align-center">';
		echo '<img src="' . esc_url($icon['url']) . '" alt="' . esc_attr($icon['alt']) . '"/>';
		echo '</div>';
	} else {
		echo '<div class="' . esc_attr($slug) . '__item-counter flex column justify-center align-center">';
		echo esc_html($counter);
		echo '</div>';
	}

	if ($title) {
		echo '<p class="' . esc_attr($slug) . '__item-title">';
		echo esc_html($title);
		echo '</p>';
	}

	echo '</div>';
}
