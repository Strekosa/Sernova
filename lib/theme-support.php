<?php
/**
 * Register theme support for languages, menus, post-thumbnails, post-formats etc.
 *
 * @link https://codex.wordpress.org/Function_Reference/add_theme_support
 * @package sernova
 */

if ( ! function_exists( 'sernova_theme_support' ) ) :
	/**
	 * Add theme supports.
	 */
	function sernova_theme_support() {
		sernova_add_language_support();
		sernova_add_core_features();
		sernova_add_html5_support();
		sernova_add_post_formats();
		sernova_add_woocommerce_support();
		sernova_add_widget_shortcode_support();
		sernova_add_custom_background();
		sernova_add_custom_header();
	}

	add_action( 'after_setup_theme', 'sernova_theme_support' );

	/**
	 * Add language support.
	 */
	function sernova_add_language_support() {
		load_theme_textdomain( 'wp_dev', get_template_directory() . '/languages' );
	}

	/**
	 * Add core WordPress features.
	 */
	function sernova_add_core_features() {
		add_theme_support( 'menus' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
	}

	/**
	 * Add HTML5 support for core elements.
	 */
	function sernova_add_html5_support() {
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
	}

	/**
	 * Add support for post formats.
	 */
	function sernova_add_post_formats() {
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	}

	/**
	 * Add WooCommerce support.
	 */
	function sernova_add_woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}

	/**
	 * Add widget shortcode support.
	 */
	function sernova_add_widget_shortcode_support() {
		add_filter( 'widget_text', 'do_shortcode' );
	}

	/**
	 * Add custom background support.
	 */
	function sernova_add_custom_background() {
		add_theme_support( 'custom-background', array( 'default-color' => 'fff' ) );
	}

	/**
	 * Add custom header support.
	 */
	function sernova_add_custom_header() {
		add_theme_support(
			'custom-header',
			array(
				'default-image' => get_template_directory_uri() . '/assets/dist/images/custom-logo.png',
				'height'        => '200',
				'flex-height'   => true,
				'uploads'       => true,
				'header-text'   => false,
			)
		);
	}
endif;


