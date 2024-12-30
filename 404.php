<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 * @package gis-point
 */

get_header();

?>

	<div id="primary" class="content-area not-found flex column">
		<section class="error-404 flex column">

			<div class="error-404__content container-boxed column align-center justify-center">
				<h4 class="error-404__title">
					<?php esc_html_e('Nothing found', 'wp-dev'); ?>
					<span>
                    <?php
					// Проверяем, передан ли параметр "search" в URL
					if (!empty($_GET['search'])) {
						echo esc_html($_GET['search']); // Безопасный вывод пользовательского ввода
					} else {
						esc_html_e(''); // Вывод по умолчанию, если параметр не передан
					}
					?>
                </span>
					<?php esc_html_e('on request', 'wp-dev'); ?>
				</h4>

				<div class="error-404__link button button-primary">
					<a href="<?php echo home_url(); ?>">
						<?php esc_html_e('Home page', 'wp-dev'); ?>
					</a>
				</div>

			</div><!-- .page-content -->
			<section id="cta" class="cta">
				<div class="cta__wrapp container-boxed column align-center">

					<div class="cta__heading">
						<?php
						$title = get_field('cta_title', 'options');
						if ($title) : ?>
							<h2 class="cta__title">
								<?php echo $title; ?>
							</h2>
						<?php endif; ?>

						<?php
						$subtitle = get_field('cta_subtitle', 'options');
						if ($subtitle) : ?>
							<h2 class="cta__subtitle">
								<?php echo $subtitle; ?>
							</h2>
						<?php endif; ?>
					</div>

					<?php
					$link = get_field('cta_button', 'options');
					if ($link):
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<div class="button button-secondary">
							<a href="<?php echo esc_url($link_url); ?>"
							   target="<?php echo esc_attr($link_target); ?>">
								<?php echo esc_html($link_title); ?>
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
										<rect width="100.5" height="84" fill="white"
											  transform="translate(0.25)"/>
									</clipPath>
								</defs>
							</svg>
						</div>
					<?php endif; ?>

				</div>
			</section>
		</section>

		</section><!-- .error-404 -->
	</div><!-- #primary -->

<?php
get_footer();
