<?php
/**
 * Updates the menu item if it's a category link.
 *
 * @param WP_Post $item The menu item.
 * @return WP_Post The updated menu item.
 */
function update_category_menu_item($item) {
	// Check if the menu item is a category
	if ($item->object !== 'category') {
		return $item; // Return as is if it's not a category
	}

	// Get the category object
	$category = get_category($item->object_id);
	if ($category) {
		// Generate a custom URL for the category
		$item->url = generate_category_url($category->slug);
	}

	return $item;
}

/**
 * Generates a custom URL for a category based on its slug.
 *
 * @param string $slug The category slug.
 * @return string The custom URL for the category.
 */
function generate_category_url($slug) {
	return home_url('/resources/?category=' . $slug);
}

/**
 * Replaces category links in the menu with custom URLs.
 *
 * @param array $items The array of menu items.
 * @return array The updated array of menu items.
 */
function replace_category_links_in_menu($items) {
	// Iterate through each menu item and update it if necessary
	foreach ($items as &$item) {
		$item = update_category_menu_item($item);
	}
	return $items;
}

// Hook the function to the menu filter
add_filter('wp_get_nav_menu_items', 'replace_category_links_in_menu', 10, 2);
