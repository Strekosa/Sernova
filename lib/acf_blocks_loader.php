<?php
/**
 * Loader for ACF Blocks
 *
 * @package sernova
 */

if ( ! class_exists( 'ACF_Blocks_Loader' ) && function_exists( 'acf_register_block' ) ) :

	/**
	 * ACF_Blocks_Loader handles the automatic registration of ACF Blocks.
	 */
	class ACF_Blocks_Loader {

		/**
		 * Directory containing block templates.
		 *
		 * @var string
		 */
		private $dir = 'template-parts/block/';

		/**
		 * Default file extension for block templates.
		 *
		 * @var string
		 */
		private $ext = '.php';

		/**
		 * Constructor. Adds the action to register blocks.
		 */
		public function __construct() {
			add_action( 'acf/init', [ $this, 'register_blocks' ] );
		}

		/**
		 * Registers ACF blocks based on templates found in the specified directory.
		 *
		 * @return void
		 */
		public function register_blocks() {
			if ( ! file_exists( locate_template( $this->dir ) ) ) {
				return;
			}

			$dir = new DirectoryIterator( locate_template( $this->dir ) );

			foreach ( $dir as $file_info ) {
				if ( $this->is_valid_block_file( $file_info ) ) {
					$this->register_block( $file_info );
				}
			}
		}

		/**
		 * Validates if a file is a block template.
		 *
		 * @param DirectoryIterator $file_info File information.
		 * @return bool
		 */
		private function is_valid_block_file( $file_info ) {
			return ! $file_info->isDot() && '.DS_Store' !== $file_info->getFilename();
		}

		/**
		 * Registers a single block.
		 *
		 * @param DirectoryIterator $file_info File information.
		 * @return void
		 */
		private function register_block( $file_info ) {
			$slug        = str_replace( $this->ext, '', $file_info->getFilename() );
			$file_path   = locate_template( $this->get_block_template_path( $slug ) );
			$file_headers = $this->get_block_headers( $file_path );

			acf_register_block( [
				'name'            => $slug,
				'title'           => $file_headers['title'] ?: __( 'Unnamed Block:', 'wp_dev' ) . ' ' . $slug,
				'description'     => $file_headers['description'],
				'category'        => $file_headers['category'] ?: 'formatting',
				'icon'            => $file_headers['icon'],
				'keywords'        => $this->parse_keywords( $file_headers['keywords'] ),
				'supports'        => $this->parse_json( $file_headers['supports'] ),
				'render_callback' => [ $this, 'block_render_callback' ],
				'enqueue_style'   => $this->get_asset_url( $slug, 'style.css' ),
				'enqueue_script'  => $this->get_asset_url( $slug, 'script.js' ),
			] );
		}

		/**
		 * Retrieves block headers from a template file.
		 *
		 * @param string $file_path Path to the block template file.
		 * @return array
		 */
		private function get_block_headers( $file_path ) {
			return get_file_data( $file_path, [
				'title'       => 'Block Name',
				'description' => 'Description',
				'category'    => 'Category',
				'icon'        => 'Icon',
				'keywords'    => 'Keywords',
				'supports'    => 'Supports',
			] );
		}

		/**
		 * Parses keywords from a string.
		 *
		 * @param string $keywords Keywords string.
		 * @return array
		 */
		private function parse_keywords( $keywords ) {
			return explode( ' ', $keywords );
		}

		/**
		 * Parses a JSON string into an array.
		 *
		 * @param string $json JSON string.
		 * @return array|null
		 */
		private function parse_json( $json ) {
			return json_decode( $json, true );
		}

		/**
		 * Callback function for rendering a block.
		 *
		 * @param array  $block Block settings and attributes.
		 * @param string $content Inner block content.
		 * @param bool   $is_preview Whether it is a preview.
		 * @param int    $post_id Post ID.
		 * @return void
		 */
		public function block_render_callback( $block, $content, $is_preview, $post_id ) {
			$slug          = str_replace( 'acf/', '', $block['name'] );
			$template_path = $this->get_block_template_path( $slug );

			if ( file_exists( get_theme_file_path( $template_path ) ) ) {
				include get_theme_file_path( $template_path );
			}
		}

		/**
		 * Constructs the relative path to a block's directory.
		 *
		 * @param string $slug Block name.
		 * @return string
		 */
		private function get_block_dir_path( $slug ) {
			return $this->dir . $slug . '/';
		}

		/**
		 * Constructs the relative path to a block's template file.
		 *
		 * @param string $slug Block name.
		 * @return string
		 */
		private function get_block_template_path( $slug ) {
			return $this->get_block_dir_path( $slug ) . 'block' . $this->ext;
		}

		/**
		 * Constructs the URL to a block's asset.
		 *
		 * @param string $slug Block name.
		 * @param string $asset Asset file name.
		 * @return string
		 */
		private function get_asset_url( $slug, $asset ) {
			return get_template_directory_uri() . '/' . $this->get_block_dir_path( $slug ) . $asset;
		}
	}

	new ACF_Blocks_Loader();

endif;
