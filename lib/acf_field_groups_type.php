<?php
/**
 * Custom taxonomy for ACF Field Group for better organization in WP dashboard
 *
 * @package sernova
 */

if ( ! class_exists( 'ACF_Field_Groups_Type' ) ) :

	/**
	 * ACF_Field_Groups_Type is a class for adding Field Group Type taxonomy for ACF Field Group post type.
	 */
	class ACF_Field_Groups_Type {

		/**
		 * Taxonomy slug.
		 *
		 * @var string
		 */
		private $taxonomy = 'acf-fg-type';

		/**
		 * ACF Field Group post type slug.
		 *
		 * @var string
		 */
		private $post_type = 'acf-field-group';

		/**
		 * Default terms which based on ACF Location Rules.
		 *
		 * @var array
		 */
		private $default_terms = [ 'Template', 'Option', 'Post Type', 'Flexible Content', 'Block', 'Taxonomy', 'User', 'Menu Item' ];

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'init', [ $this, 'field_group_taxonomy' ] );
			add_filter( 'manage_edit-acf-field-group_columns', [ $this, 'field_group_columns' ], 20 );
			add_action( 'manage_acf-field-group_posts_custom_column', [ $this, 'field_group_columns_html' ], 20, 2 );
			add_action( 'restrict_manage_posts', [ $this, 'field_group_filter' ], 10, 2 );
			add_action( 'acf/input/admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts' ] );
		}

		/**
		 * Registers taxonomy and inserts default terms.
		 */
		public function field_group_taxonomy() {
			register_taxonomy(
				$this->taxonomy,
				$this->post_type,
				[
					'label'             => __( 'Field Group Type' ),
					'labels'            => [
						'separate_items_with_commas' => __( 'Start typing: ' ) . implode( ', ', $this->default_terms ),
					],
					'rewrite'           => false,
					'show_ui'           => true,
					'show_admin_column' => true,
					'query_var'         => true,
				]
			);

			foreach ( $this->default_terms as $default_term ) {
				wp_insert_term( $default_term, $this->taxonomy );
			}
		}

		/**
		 * Modifies admin columns for ACF Field Groups.
		 *
		 * @param array $columns An array of column headers.
		 * @return array
		 */
		public function field_group_columns( $columns ) {
			unset( $columns['taxonomy-acf-fg-type'] );
			$new_columns = [];

			foreach ( $columns as $key => $title ) {
				if ( $key === 'acf-fg-status' ) {
					$new_columns[ $this->taxonomy ] = __( 'Type' );
				}
				$new_columns[ $key ] = $title;
			}

			return $new_columns;
		}

		/**
		 * Renders custom column content.
		 *
		 * @param string $column The column name.
		 * @param int    $post_id The post ID.
		 */
		public function field_group_columns_html( $column, $post_id ) {
			if ( $column === $this->taxonomy ) {
				$terms = get_the_terms( $post_id, $this->taxonomy );

				if ( $terms ) {
					echo implode( ', ', wp_list_pluck( $terms, 'name' ) );
				}
			}
		}

		/**
		 * Adds a filter dropdown for taxonomy in admin.
		 *
		 * @param string $post_type The post type slug.
		 * @param string $which The location of the extra table nav markup.
		 */
		public function field_group_filter( $post_type, $which ) {
			if ( $this->post_type !== $post_type ) {
				return;
			}

			$taxonomy_obj  = get_taxonomy( $this->taxonomy );
			$taxonomy_name = $taxonomy_obj->labels->name;
			$terms         = get_terms( $this->taxonomy );

			echo '<select name="' . esc_attr( $this->taxonomy ) . '" id="' . esc_attr( $this->taxonomy ) . '" class="postform">';
			echo '<option value="">' . esc_html( $taxonomy_name ) . '</option>';

			foreach ( $terms as $term ) {
				printf(
					'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
					esc_attr( $term->slug ),
					selected( $_GET[ $this->taxonomy ] ?? '', $term->slug, false ),
					esc_html( $term->name ),
					esc_html( $term->count )
				);
			}

			echo '</select>';
		}

		/**
		 * Enqueues scripts and styles for ACF admin.
		 */
		public function admin_enqueue_scripts() {
			$dir_path = 'assets/flexible-content-thumbs/';
			$dir_uri  = get_stylesheet_directory_uri() . '/' . $dir_path;
			$files    = $this->get_directory_files( $dir_path );

			wp_register_script( 'flexible-content-thumbs-js', $dir_uri . 'inc/script.js', [], '1.0.0', false );
			wp_localize_script( 'flexible-content-thumbs-js', 'flexibleContentThumbs', [
				'dirUri' => $dir_uri,
				'files'  => $files,
			] );
			wp_enqueue_script( 'flexible-content-thumbs-js' );
			wp_enqueue_style( 'flexible-content-thumbs-css', $dir_uri . 'inc/style.css', [], '1.0.0' );
		}

		/**
		 * Retrieves files from a directory.
		 *
		 * @param string $dir_path Directory path.
		 * @return array
		 */
		private function get_directory_files( $dir_path ) {
			$files = [];
			$dir   = locate_template( $dir_path );

			if ( $dir && is_dir( $dir ) ) {
				foreach ( new DirectoryIterator( $dir ) as $file_info ) {
					if ( $this->is_valid_file( $file_info ) ) {
						$module_name = pathinfo( $file_info->getFilename(), PATHINFO_FILENAME );
						$files[ $module_name ] = $this->get_file_url( $dir_path, $file_info->getFilename() );
					}
				}
			}

			return $files;
		}

		/**
		 * Checks if a file is valid (not a directory and not a hidden file).
		 *
		 * @param DirectoryIterator $file_info File information.
		 * @return bool
		 */
		private function is_valid_file( $file_info ) {
			return ! $file_info->isDot() && ! $file_info->isDir();
		}

		/**
		 * Constructs the full URL for a file.
		 *
		 * @param string $dir_path Directory path.
		 * @param string $filename File name.
		 * @return string
		 */
		private function get_file_url( $dir_path, $filename ) {
			return get_stylesheet_directory_uri() . '/' . $dir_path . $filename;
		}
	}

	new ACF_Field_Groups_Type();

endif;
