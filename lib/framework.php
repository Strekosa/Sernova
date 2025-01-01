<?php
/**
 * Various functions required for sernova-bootstrap to work properly
 *
 * @package sernova
 */

/*
 * Table of contests:
 * 1 - WP Content Width
 * 2 - Menu navigation walker
 * 3 - Pagination
 * 4 - Comments tree
 */

// 1 - WP Content Width @link {https://codex.wordpress.org/Content_Width}
if ( ! isset( $content_width ) ) {
	$content_width = 1140;
}
/**
 * sernova_navwalker class
 * Menu navigation walker
 * Class Name: sernova__navwalker
 * GitHub URI: https://github.com/twittem/wp-woodwork-navwalker
 * Description: A custom WordPress nav walker class to implement the woodwork 3 navigation style in a custom theme using the WordPress built in menu manager.
 */
class sernova_Navwalker extends Walker_Nav_Menu
{

	/**
	 * Starts the list before the elements are added.
	 *
	 * Adds classes to the unordered list sub-menus.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array $args An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl(&$output, $depth = 0, $args = array())
	{
		// Depth-dependent classes.
		$indent = ($depth > 0 ? str_repeat("\t", $depth) : ''); // code indent
		$display_depth = ($depth + 1); // because it counts the first submenu as 0
		$classes = array(
				'sub-menu',
				($display_depth % 2 ? 'menu-odd' : 'menu-even'),
				($display_depth >= 2 ? 'sub-sub-menu' : ''),
				'menu-depth-' . $display_depth
		);
		$class_names = implode(' ', $classes);

		// Build HTML for output.

		$output .= '<span class="nav-desc" id="nav-desc-show"><svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.37978 0.87978C0.575042 0.684518 0.891625 0.684518 1.08689 0.87978L5.73333 5.52623L10.3798 0.87978C10.575 0.684518 10.8916 0.684518 11.0869 0.87978C11.2821 1.07504 11.2821 1.39162 11.0869 1.58689L6.08689 6.58689C5.89162 6.78215 5.57504 6.78215 5.37978 6.58689L0.37978 1.58689C0.184518 1.39162 0.184518 1.07504 0.37978 0.87978Z" fill="#1A1A1B"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M10.2148 0.714788C10.5012 0.428404 10.9655 0.428404 11.2519 0.714788C11.5383 1.00117 11.5383 1.46549 11.2519 1.75188L6.25188 6.75188C5.96549 7.03826 5.50117 7.03826 5.21479 6.75188L0.214788 1.75188C-0.0715961 1.46549 -0.0715961 1.00117 0.214788 0.714788C0.501173 0.428404 0.965494 0.428404 1.25188 0.714788L5.73333 5.19624L10.2148 0.714788ZM10.9219 1.04477C10.8178 0.940632 10.6489 0.940632 10.5448 1.04477L5.89832 5.69122C5.85457 5.73498 5.79522 5.75956 5.73333 5.75956C5.67145 5.75956 5.6121 5.73498 5.56834 5.69122L0.921895 1.04477C0.817755 0.940632 0.648911 0.940632 0.544772 1.04477C0.440632 1.14891 0.440632 1.31776 0.544772 1.4219L5.54477 6.4219C5.64891 6.52603 5.81776 6.52603 5.9219 6.4219L10.9219 1.4219C11.026 1.31776 11.026 1.14891 10.9219 1.04477Z" fill="#1A1A1B"/>
</svg>
</span>';
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	/**
	 * Start the element output.
	 *
	 * Adds main/sub-classes to the list items and links.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param array $args An array of arguments. @see wp_nav_menu()
	 * @param int $id Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = $depth > 0 ? str_repeat( "\t", $depth ) : ''; // Code indent.

		// Generate depth-dependent classes.
		$depth_classes = array_filter( [
				$depth === 0 ? 'main-menu-item' : 'sub-menu-item',
				$depth >= 2 ? 'sub-sub-menu-item' : '',
				$depth % 2 ? 'menu-item-odd' : 'menu-item-even',
				'menu-item-depth-' . $depth,
		] );
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// Apply custom or default classes.
		$classes = (array) ( $item->classes ?? [] );
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// Start building the HTML structure for menu items.
		$output .= sprintf(
				'%s<li id="nav-menu-item-%d" class="%s %s">',
				$indent,
				$item->ID,
				$depth_class_names,
				$class_names
		);

		// Prepare link attributes.
		$attributes = array_filter( [
				! empty( $item->attr_title ) ? sprintf( 'title="%s"', esc_attr( $item->attr_title ) ) : '',
				! empty( $item->target ) ? sprintf( 'target="%s"', esc_attr( $item->target ) ) : '',
				! empty( $item->xfn ) ? sprintf( 'rel="%s"', esc_attr( $item->xfn ) ) : '',
				! empty( $item->url ) ? sprintf( 'href="%s"', esc_attr( $item->url ) ) : '',
				sprintf( 'class="menu-link %s"', $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ),
		] );

		// Combine attributes into a string.
		$attributes_string = implode( ' ', $attributes );

		// Build the link HTML.
		$item_output = sprintf(
				'%1$s<a %2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes_string,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
		);

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


/**
 * Pagination
 * Renders pagination links.
 *
 * @param bool $echo Whether to echo the pagination or return it.
 * @return string|null Pagination HTML if $echo is false, otherwise null.
 */
function codeska_pagination( $echo = true ) {
	global $wp_query;

	// Generate pagination links.
	$pagination_links = paginate_links(
			array(
					'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
					'format'    => '?paged=%#%',
					'current'   => max( 1, get_query_var( 'paged' ) ),
					'total'     => $wp_query->max_num_pages,
					'type'      => 'array',
					'prev_next' => true,
					'prev_text' => __( '&laquo; Prev' ),
					'next_text' => __( 'Next &raquo;' ),
			)
	);

	// If there are pagination links, format them into a list.
	if ( ! empty( $pagination_links ) ) {
		$pagination = '<ul class="pagination">' . implode( '', array_map( fn( $page ) => "<li>$page</li>", $pagination_links ) ) . '</ul>';

		if ( $echo ) {
			echo $pagination; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $pagination;
		}
	}

	return null;
}

/**
 * 4 - Comments tree
 * sernova Comments Tree
 */
if ( ! class_exists( 'Codeska_Comments' ) ) :
	/**
	 * Undocumented class
	 */
	class Codeska_Comments extends Walker_Comment {
		/**
		 * tree_type
		 *
		 * @var string $tree_type  tree_type
		 */
		public $tree_type = 'comment';

		/**
		 * db_fields
		 *
		 * @var array $db_fields  tree_type
		 */
		public $db_fields = array(
			'parent' => 'comment_parent',
			'id'     => 'comment_ID',
		);
		/** CONSTRUCTOR
		 * You'll have to use this if you plan to get to the top of the comments list, as
		 * start_lvl() only goes as high as 1 deep nested comments */
		public function __construct() { ?>
			<h3><?php comments_number( __( 'No Responses to', 'wp_dev' ), __( 'One Response to', 'wp_dev' ), __( '% Responses to', 'wp_dev' ) ); ?> &#8220;<?php the_title(); ?>&#8221;</h3>
			<ol class="comment-list">
			<?php
		}

		/**
		 * Starts the list before the CHILD elements are added.
		 *
		 * @param string  $output output
		 * @param integer $depth depth
		 * @param array   $args args
		 * @return void
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 1;
			?>
		<ul class="children">
			<?php
		}

		/**
		 * Ends the children list of after the elements are added.
		 *
		 * @param string  $output output
		 * @param integer $depth depth
		 * @param array   $args args
		 * @return void
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$GLOBALS['comment_depth'] = $depth + 1;
			?>
		</ul><!-- /.children -->
			<?php
		}

		/**
		 * START_EL
		 *
		 * @param string  $output output
		 * @param mixed   $comment comment
		 * @param integer $depth depth
		 * @param array   $args args
		 * @param integer $id id
		 * @return void
		 */
		public function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
			$depth++;
			$GLOBALS['comment_depth'] = $depth;
			$GLOBALS['comment'] = $comment;
			$parent_class = !empty($args['has_children']) ? 'parent' : '';

			$output .= sprintf(
					'<li %s id="comment-%d">',
					comment_class($parent_class, null, null, false),
					$comment->comment_ID
			);

			$output .= sprintf(
					'<article id="comment-body-%1$d" class="comment-body">
            <header class="comment-author">
                %2$s
                <div class="author-meta vcard author">
                    <cite class="fn">%3$s</cite>
                    <time datetime="%4$s">
                        <a href="%5$s">%6$s</a>
                    </time>
                </div>
            </header>
            <section id="comment-content-%1$d" class="comment">
                %7$s
            </section>
            <div class="comment-meta comment-meta-data hide">
                <a href="%8$s">%9$s at %10$s</a> %11$s
            </div>
            <div class="reply">%12$s</div>
        </article>',
					$comment->comment_ID,
					get_avatar($comment, $args['avatar_size']),
					get_comment_author_link(),
					esc_attr(get_comment_date('c')),
					esc_url(get_comment_link($comment->comment_ID)),
					sprintf('%1$s', get_comment_date(), get_comment_time()),
					$comment->comment_approved ? comment_text(null, false) : '<div class="notice"><p class="bottom">' . __('Your comment is awaiting moderation.', 'wp_dev') . '</p></div>',
					htmlspecialchars(get_comment_link($comment->comment_ID)),
					get_comment_date(),
					get_comment_time(),
					get_edit_comment_link('(Edit)'),
					comment_reply_link(array_merge($args, ['depth' => $depth, 'max_depth' => $args['max_depth']]), $comment, $args['post'], false)
			);

			$output .= '</li>';
		}


		/**
		 * end_el
		 *
		 * @param string  $output output
		 * @param mixed   $comment comment
		 * @param integer $depth depth
		 * @param array   $args args
		 * @return void
		 */
		public function end_el( & $output, $comment, $depth = 0, $args = array() ) {
			?>
		</li><!-- /#comment-' . get_comment_ID() . ' -->
			<?php
		}
		/** DESTRUCTOR */
		public function __destruct() {
			?>
			</ol><!-- /#comment-list -->
		<?php }
	}
endif;
?>
