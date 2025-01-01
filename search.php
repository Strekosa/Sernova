<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 * @package sernova
 */

get_header(); ?>

	<section id="primary" class="content-area search__page">
		<div class="search__heading  container-boxed column">
			<div class="search__breadcrumbs">
				<?php
				custom_breadcrumbs();
				?>
			</div>
			<?php /* translators: %s: search term */ ?>
			<h2 class="search__title">
				<?php printf(esc_html__('Search Results for : %s', 'wp_dev'), '<span>' . get_search_query() . '</span>'); ?>
			</h2>

<!--			<div class="search__form">-->
<!--				--><?php
//				get_search_form();
//				?>
<!--			</div>-->
		</div><!-- .page-header -->

		<?php if (have_posts()) : ?>
			<div class="search__main">
				<div class="search__list container-boxed">
					<?php
					/* Start the Loop */
					while (have_posts()) :
						the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part('template-parts/content', 'search');
					endwhile;
					?>
				</div>
				<?php
				// Post navigation
//				the_posts_navigation();
				?>
			</div>
		<?php else : ?>
			<div class="search__main">
				<div class="search__no-found container-boxed">
					<?php
					// No content found
					get_template_part('template-parts/content', 'none');
					?>
				</div>
			</div>
		<?php endif; ?>


		<!-- CTA -->
		<?php
		$current_term = get_queried_object();

		$slug = 'cta';
		$block_id = $slug . '-' . $current_term->term_id;

		$custom_value = get_field('custom_value');

		$title = get_field('title') ?: get_field('cta_title', 'options');
		$subtitle = get_field('subtitle') ?: get_field('cta_subtitle', 'options');
		$link = get_field('button') ?: get_field('cta_button', 'options');
		?>

		<section
				id="<?php echo $block_id; ?>"
				class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>"
		>
			<div class="<?php echo $slug; ?>__wrapp container-boxed column align-center">


				<div class="<?php echo $slug; ?>__heading">
					<?php
					if ($title) : ?>
						<h2 class="<?php echo $slug; ?>__title">
							<?php echo $title; ?>
						</h2>
					<?php endif; ?>

					<?php
					if ($subtitle) : ?>
						<h2 class="<?php echo $slug; ?>__subtitle">
							<?php echo $subtitle; ?>
						</h2>
					<?php endif; ?>
				</div>

				<?php
				if ($link):
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<div class="<?php echo $slug; ?>__button button button-secondary">
						<a href="<?php echo esc_url($link_url); ?>"
						   target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?>
						</a>

						<svg width="68" height="56" viewBox="0 0 101 84" fill="none"
							 xmlns="http://www.w3.org/2000/svg">
							<g clip-path="url(#clip0_2227_2880)">
								<path fill-rule="evenodd" clip-rule="evenodd"
									  d="M66.386 17.0273L99.9236 74.7191C102.533 81.3662 98.9137 84 89.7823 84H29.2295C18.6674 84 15.4273 80.4883 20.8135 71.2493L36.341 44.4937L51.1531 18.9922C56.6655 9.50234 59.9057 6.78497 66.3439 16.9856H66.386V17.0273Z"
									  fill="#0BBBEF"/>
								<path fill-rule="evenodd" clip-rule="evenodd"
									  d="M51.697 6.81533L33.2412 38.8014L10.5264 78.2299C8.43868 81.2404 5.14002 83.7073 0.338182 84H-81.3766C-86.6795 83.7073 -88.0574 81.1986 -85.5103 76.7665L-85.5938 76.8502L-45.8847 7.94426V8.06969C-43.0036 3.01045 -37.492 0 -31.2704 0H45.893C52.031 0 54.2023 1.83973 51.7805 6.85716H51.697V6.81533Z"
									  fill="#0B4697"/>
							</g>
							<defs>
								<clipPath id="clip0_2227_2880">
									<rect width="100.5" height="84" fill="white" transform="translate(0.25)"/>
								</clipPath>
							</defs>
						</svg>
					</div>
				<?php endif; ?>

			</div>
		</section>

	</section><!-- #primary -->

<?php
get_footer();
