<?php
/**
 * Page template file
 *
 * @package sernova
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<section id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</section><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
