<?php
/**
 * Enqueue all styles and scripts.
 *
 * Learn more about enqueue_script: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_script}
 * Learn more about enqueue_style: {@link https://codex.wordpress.org/Function_Reference/wp_enqueue_style}
 *
 * @package sernova
 */

if ( ! function_exists( 'sernova_scripts' ) ) :
	/**
	 * sernova_scripts
	 *
	 * @return void
	 */
	function sernova_scripts() {
		// Enqueue the main Stylesheet.
		wp_enqueue_style('main-stylesheet', asset_path('styles/main.css'), [], '1.0.0', 'all');

		// Deregister the jquery version bundled with WordPress.
		wp_deregister_script('jquery');

		// CDN hosted jQuery placed in the header.
		wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-2.2.4.min.js', [], '2.2.4', false);

		// Enqueue the main JS file with dependencies.
		wp_enqueue_script(
			'main-javascript',
			asset_path('scripts/main.js'),
			['jquery'],
			'1.0.0',
			true
		);

		// Pass variables from PHP to JS.
		$theme_vars = [
			'home' => get_home_url(),
			'isHome' => is_front_page(),
			'ajaxurl' => admin_url('admin-ajax.php'),
		];
		wp_localize_script('main-javascript', 'themeVars', $theme_vars);

		// Comments reply script.
		if (is_singular() && comments_open()) {
			wp_enqueue_script('comment-reply');
		}
	}
	add_action('wp_enqueue_scripts', 'sernova_scripts');

endif;


