<?php
/**
 * The template for displaying all single posts careers.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package sernova
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<section id="main" class="single-careers_wrapp site-main" role="main">

			<div class="single-careers__breadcrumbs container-boxed column">
				<?php
				custom_breadcrumbs();
				?>
			</div>

			<div class="single-careers__heading container-boxed column">
				<h3 class="single-careers__title">
					<?php the_title(); ?>
				</h3>
				<div class="single-careers__info flex justify-between">
					<?php
					$taxonomy = 'types';
					$terms = get_the_terms(get_the_ID(), $taxonomy);
					?>

					<?php if ($terms && !is_wp_error($terms)): ?>
						<div class="single-careers__taxonomy">
							<?php foreach ($terms as $term): ?>
								<span class="single-careers__taxonomy-item">
								<?php echo esc_html($term->name); ?>
							</span>
								<span class="single-careers__taxonomy-separator"><?php _e(',', THEME_TD); ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>


					<?php $location = get_field('location'); ?>
					<?php if ($location): ?>
						<div class="single-careers__locations">
							<?php echo $location; ?>
						</div>
					<?php endif; ?>

				</div>
			</div>

			<div class="single-careers__main">
				<div class="single-careers__main-wrapp container-boxed justify-between">
					<div class="single-careers__employment">
						<?php $job_type = get_field('job_type'); ?>
						<?php if ($job_type): ?>
							<div class="single-careers__employment-type">
								<?php echo $job_type; ?>
							</div>
						<?php endif; ?>

						<?php $work_schedule = get_field('work_schedule'); ?>
						<?php if ($work_schedule): ?>
							<div class="single-careers__employment-schedule">
								<?php echo $work_schedule; ?>
							</div>
						<?php endif; ?>
					</div>

					<div class="single-careers__content">
						<!-- TEXT -->
						<?php
						$current_term = get_queried_object();

						$slug = 'text';
						$block_id = $slug . '-' . $current_term->term_id;

						$text = get_field('text');
						?>
						<section
								id="<?php echo $block_id; ?>"
								class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">
							<div class="<?php echo $slug; ?>__wrapp">

								<?php
								if ($text) : ?>
									<div class="<?php echo $slug; ?>__content">
										<?php echo $text; ?>
									</div>
								<?php endif; ?>

								<?php
								$link = get_field('email_button', 'options');
								if ($link):
									$link_url = $link['url'];
									$link_title = $link['title'];
									$link_target = $link['target'] ? $link['target'] : '_self';
									?>
									<div class="single-careers__bottom">
										<div class="single-careers__bottom-text">
											<?php _e('To apply, please email your CV to:', THEME_TD); ?>
										</div>
										<div class="single-careers__button button button-primary">
											<a href="<?php echo esc_url($link_url); ?>"
											   target="<?php echo esc_attr($link_target); ?>"
											   class=" flex align-center">
												<svg width="20" height="21" viewBox="0 0 20 21" fill="none"
													 xmlns="http://www.w3.org/2000/svg">
													<path d="M1.6665 7.58329C1.6665 4.66663 3.33317 3.41663 5.83317 3.41663H14.1665C16.6665 3.41663 18.3332 4.66663 18.3332 7.58329V13.4166C18.3332 16.3333 16.6665 17.5833 14.1665 17.5833H5.83317"
														  stroke="black" stroke-width="1.5" stroke-miterlimit="10"
														  stroke-linecap="round" stroke-linejoin="round"/>
													<path d="M14.1668 8L11.5585 10.0833C10.7002 10.7667 9.29183 10.7667 8.43349 10.0833L5.8335 8"
														  stroke="black" stroke-width="1.5" stroke-miterlimit="10"
														  stroke-linecap="round" stroke-linejoin="round"/>
													<path d="M1.6665 14.25H6.6665" stroke="black" stroke-width="1.5"
														  stroke-miterlimit="10" stroke-linecap="round"
														  stroke-linejoin="round"/>
													<path d="M1.6665 10.9166H4.1665" stroke="black" stroke-width="1.5"
														  stroke-miterlimit="10" stroke-linecap="round"
														  stroke-linejoin="round"/>
												</svg>

												<?php echo esc_html($link_title); ?>
											</a>
										</div>
									</div>
								<?php endif; ?>

							</div>
						</section>
					</div>
				</div>
			</div>

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

		</section><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
