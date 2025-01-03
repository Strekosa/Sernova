<?php
/**
 * Theme functions and definitions.
 *
 * @package sernova
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

/**
 * Text domain definition
 */
defined( 'THEME_TD' ) ? THEME_TD : define( 'THEME_TD', 'wp_dev' );

// Load modules
$theme_includes = [
	'/lib/helpers.php',
	'/lib/cleanup.php',                        // Clean up default theme includes
	'/lib/enqueue-scripts.php',                // Enqueue styles and scripts
	'/lib/protocol-relative-theme-assets.php', // Protocol (http/https) relative assets path
	'/lib/framework.php',                      // Css framework related stuff (content width, nav walker class, comments, pagination, etc.)
	'/lib/theme-support.php',                  // Theme support options
	'/lib/template-tags.php',                  // Custom template tags
	'/lib/menu-areas.php',                     // Menu areas
	'/lib/widget-areas.php',                   // Widget areas
	'/lib/customizer.php',                     // Theme customizer
	'/lib/vc_shortcodes.php',                  // Visual Composer shortcodes
	'/lib/jetpack.php',                        // Jetpack compatibility file
	'/lib/acf_field_groups_type.php',          // ACF Field Groups Organizer
	'/lib/acf_blocks_loader.php',              // ACF Blocks Loader
	'/lib/wp_dashboard_customizer.php',        // WP Dashboard customizer
	'/lib/breadcrumbs.php',                    // Breadcrumbs
	'/lib/menu-category-links.php',            // Menu category links
	'/lib/render-contact-item.php',            // Render contact item
	'/lib/render-repeater-list.php',           // Render repeater list
	'/lib/ajax-filter-careers.php',            // Ajax Filter Careers
	'/lib/ajax-filter-posts.php',              // Ajax Filter Careers
];

foreach ( $theme_includes as $file ) {
	if ( ! locate_template( $file ) ) {
		/* translators: %s error*/
		trigger_error( esc_html( sprintf( esc_html( __('Error locating %s for inclusion', 'wp_dev') ), $file ) ), E_USER_ERROR ); // phpcs:ignore
		continue;
	}
	require_once locate_template( $file );
}
unset( $file, $filepath );


/**
 * wp_has_sidebar Add body class for active sidebar
 *
 * @param array $classes - classes
 * @return array
 */
function wp_has_sidebar( $classes ) {
	if ( is_active_sidebar( 'sidebar' ) ) {
		// add 'class-name' to the $classes array
		$classes[] = 'has_sidebar';
	}
	return $classes;
}

add_filter( 'body_class', 'wp_has_sidebar' );

// Remove the version number of WP
// Warning - this info is also available in the readme.html file in your root directory - delete this file!
remove_action( 'wp_head', 'wp_generator' );


/**
 * Obscure login screen error messages
 *
 * @return string
 */
function wp_login_obscure() {
	return sprintf(
		'<strong>%1$s</strong>: %2$s',
		__( 'Error' ),
		__( 'wrong username or password' )
	);
}

add_filter( 'login_errors', 'wp_login_obscure' );

/**
 * Require Authentication for All WP REST API Requests
 *
 * @param WP_Error|null|true $result WP_Error if authentication error, null if authentication method wasn't used, true if authentication succeeded.
 * @return WP_Error
 */
function rest_authentication_require( $result ) {
	if ( true === $result || is_wp_error( $result ) ) {
		return $result;
	}

	if ( ! is_user_logged_in() ) {
		return new WP_Error(
			'rest_not_logged_in',
			__( 'You are not currently logged in.' ),
			array( 'status' => 401 )
		);
	}

	return $result;
}

add_filter( 'rest_authentication_errors', 'rest_authentication_require' );


// Disable the theme / plugin text editor in Admin
define( 'DISALLOW_FILE_EDIT', true );

// ACF Pro Options Page////////////////////////////////////////////////////////////////////////////////////////////////
if (function_exists('acf_add_options_page')) {

	//Main settings page
	acf_add_options_page(array(
		'page_title' => 'Theme Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug' => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false
	));

	// Subpage for common blocks
	acf_add_options_sub_page(array(
		'page_title' => 'Common Blocks',
		'menu_title' => 'Common Blocks',
		'parent_slug' => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false
	));

	// Subpage for links archive pages
	acf_add_options_sub_page(array(
		'page_title' => 'Archive page links',
		'menu_title' => 'Archive page links',
		'parent_slug' => 'theme-general-settings',
		'capability' => 'edit_posts',
		'redirect' => false
	));
}


//Disable rest api for non-logged in users/////////////////////////////////////////////////////////////////////////////
add_filter('rest_authentication_errors', function ($result) {
	if (strpos($_SERVER['REQUEST_URI'], 'contact-form-7/')) {
		$result = true;
	} else {
		if (empty($result) && !current_user_can('edit_others_posts')) {
			return new WP_Error('rest_not_logged_in', 'You are not currently logged in.', array('status' => 401));
		}
	}

	return $result;
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//function custom_search_redirect() {
//	if (is_search() && !empty(get_search_query())) {
//		global $wpdb;
//		$search_query = sanitize_text_field(get_search_query());
//
//		// SQL запрос: сначала ищем точное совпадение по заголовку, затем ищем в содержимом
//		$results = $wpdb->get_results(
//			$wpdb->prepare(
//				"
//                SELECT ID, post_title, post_type
//                FROM {$wpdb->posts}
//                WHERE post_status = 'publish'
//                AND (
//                    post_title LIKE %s OR post_content LIKE %s
//                )
//                ORDER BY
//                    CASE
//                        WHEN post_title LIKE %s THEN 1
//                        ELSE 2
//                    END ASC
//                LIMIT 1
//                ",
//				'%' . $wpdb->esc_like($search_query) . '%',
//				'%' . $wpdb->esc_like($search_query) . '%',
//				$wpdb->esc_like($search_query)
//			)
//		);
//
//		// Если найдены результаты
//		if (!empty($results)) {
//			$redirect_url = add_query_arg('highlight', urlencode($search_query), get_permalink($results[0]->ID));
//			wp_redirect($redirect_url);
//			exit;
//		} else {
//			// Если результатов нет, возвращаем 404
//			global $wp_query;
//			$wp_query->set_404();
//			status_header(404);
//			nocache_headers();
//			include(get_query_template('404'));
//			exit;
//		}
//	}
//}
//add_action('template_redirect', 'custom_search_redirect');

///////////////////////////////////////////////////////////////

