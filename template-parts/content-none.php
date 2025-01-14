<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package sernova
 */

?>

<section class="no-results not-found">
	<div class="no-results__heading">
		<h3 class="no-results__title">
			<?php esc_html_e( 'Nothing Found', 'wp_dev' ); ?>
		</h3>
	</div><!-- .page-header -->

	<div class="no-results__content flex column">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			?>
			<?php /* translators: Ready to publish your first post? */ ?>
			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'wp_dev' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'wp_dev' ); ?></p>
			<?php

		else :
			?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wp_dev' ); ?></p>
			<?php
				get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
