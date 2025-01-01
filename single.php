<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @package sernova
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<section id="main" class="single_wrapp site-main" role="main">

			<div class="single__breadcrumbs container-boxed column">
				<?php
				custom_breadcrumbs();
				?>
			</div>

			<div class="single__heading-wrapp container-boxed">

				<div class="single__heading flex column">
					<h3 class="single__title">
						<?php the_title(); ?>
					</h3>
					<div class="single__info flex justify-between">
						<?php
						$taxonomy = 'category';
						$terms = get_the_terms(get_the_ID(), $taxonomy);
						?>

						<?php if ($terms && !is_wp_error($terms)): ?>
							<div class="single__taxonomy">
								<?php foreach ($terms as $term): ?>
									<span class="single__taxonomy-item">
								<?php echo esc_html($term->name); ?>
							</span>
									<span class="single__taxonomy-separator"><?php _e(',', THEME_TD); ?></span>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>

						<span class="single__item-date">
										<?php echo get_the_date('F jS, Y'); ?>
									</span>

					</div>
				</div>
				<?php if (has_post_thumbnail()): ?>
					<div class="single__heading-image flex column justify-center">
						<?php the_post_thumbnail('large'); ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="single__main">
				<div class="single__main-wrapp container-boxed justify-between">
					<div class="single__share">

						<?php
						$current_url = urlencode(get_permalink());
						$post_title = urlencode(get_the_title());
						?>

						<div class="single__share-main flex">
							<h6 class="single__share-title"><?php _e('Share This Article', 'text-domain'); ?></h6>
							<div class="single__share-links flex" >
								<!-- LinkedIn -->
								<a class="single__share-link"
								   href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $current_url; ?>&title=<?php echo $post_title; ?>"
								   target="_blank"
								   rel="noopener noreferrer"
								   aria-label="Share on LinkedIn">
									<svg width="42" height="42" viewBox="0 0 42 42" fill="none"
										 xmlns="http://www.w3.org/2000/svg">
										<rect x="0.5" y="0.5" width="41" height="41" rx="20.5" fill="white"/>
										<rect x="0.5" y="0.5" width="41" height="41" rx="20.5" stroke="#0B4697"/>
										<g clip-path="url(#clip0_620_1578)">
											<path d="M17.7963 17.7764H14.8952C14.7664 17.7764 14.6621 17.8807 14.6621 18.0095V27.3295C14.6621 27.4583 14.7664 27.5626 14.8952 27.5626H17.7963C17.9251 27.5626 18.0294 27.4583 18.0294 27.3295V18.0095C18.0294 17.8807 17.9251 17.7764 17.7963 17.7764Z"
												  fill="#0B4697"/>
											<path d="M16.346 13.1428C15.2904 13.1428 14.4316 14.0007 14.4316 15.0551C14.4316 16.11 15.2904 16.9682 16.346 16.9682C17.4008 16.9682 18.2589 16.11 18.2589 15.0551C18.2589 14.0007 17.4008 13.1428 16.346 13.1428Z"
												  fill="#0B4697"/>
											<path d="M25.1744 17.543C24.0092 17.543 23.1478 18.0439 22.6254 18.6131V18.0078C22.6254 17.879 22.521 17.7747 22.3923 17.7747H19.6139C19.4852 17.7747 19.3809 17.879 19.3809 18.0078V27.3278C19.3809 27.4566 19.4852 27.5609 19.6139 27.5609H22.5087C22.6375 27.5609 22.7418 27.4566 22.7418 27.3278V22.7166C22.7418 21.1627 23.1639 20.5573 24.2471 20.5573C25.4268 20.5573 25.5205 21.5278 25.5205 22.7965V27.3279C25.5205 27.4567 25.6249 27.561 25.7536 27.561H28.6495C28.7782 27.561 28.8826 27.4567 28.8826 27.3279V22.2157C28.8826 19.9051 28.442 17.543 25.1744 17.543Z"
												  fill="#0B4697"/>
										</g>
										<defs>
											<clipPath id="clip0_620_1578">
												<rect width="15.75" height="15.75" fill="white"
													  transform="translate(13.7812 13.125)"/>
											</clipPath>
										</defs>
									</svg>
								</a>

								<!-- Twitter (X) -->
								<a href="https://twitter.com/intent/tweet?url=<?php echo $current_url; ?>&text=<?php echo $post_title; ?>"
								   target="_blank"
								   rel="noopener noreferrer"
								   aria-label="Share on Twitter">
									<svg width="42" height="42" viewBox="0 0 42 42" fill="none"
										 xmlns="http://www.w3.org/2000/svg">
										<rect x="0.5" y="0.5" width="41" height="41" rx="20.5" fill="white"/>
										<rect x="0.5" y="0.5" width="41" height="41" rx="20.5" stroke="#0B4697"/>
										<g clip-path="url(#clip0_620_1575)">
											<path d="M22.5237 19.7757L28.4811 13H27.0699L21.8949 18.882L17.7648 13H13L19.2469 21.8955L13 28.9999H14.4112L19.8725 22.787L24.2352 28.9999H29M14.9205 14.0413H17.0885L27.0688 28.0098H24.9003"
												  fill="#0B4697"/>
										</g>
										<defs>
											<clipPath id="clip0_620_1575">
												<rect width="16" height="16" fill="white" transform="translate(13 13)"/>
											</clipPath>
										</defs>
									</svg>
								</a>

								<!-- Email -->
								<a href="mailto:?subject=<?php echo $post_title; ?>&body=<?php echo $current_url; ?>"
								   aria-label="Share via Email">
									<svg width="42" height="42" viewBox="0 0 42 42" fill="none"
										 xmlns="http://www.w3.org/2000/svg">
										<rect x="0.5" y="0.5" width="41" height="41" rx="20.5" fill="white"/>
										<rect x="0.5" y="0.5" width="41" height="41" rx="20.5" stroke="#0B4697"/>
										<path d="M13.7571 15.0835C13.8828 15.0322 14.0173 15 14.1594 15H27.8406C27.9827 15 28.1172 15.0322 28.2429 15.0835L22.113 21.4417C21.489 22.0894 20.5112 22.0894 19.887 21.4417L13.7571 15.0835ZM28.8291 26.3821C28.9353 26.1893 29 25.9654 29 25.7234V16.2766C29 16.105 28.9682 15.9419 28.9124 15.7923L23.176 21.7422L28.8291 26.3821ZM22.6573 22.2715C22.1812 22.7206 21.5915 22.9483 21 22.9483C20.4085 22.9483 19.8188 22.7208 19.3427 22.2715L13.7056 26.8981C13.8452 26.9635 13.9983 27 14.1594 27H27.8406C28.0017 27 28.1548 26.9635 28.2944 26.8981L22.6573 22.2715ZM13.0877 15.7922C13.0318 15.9419 13 16.105 13 16.2766V25.7234C13 25.9654 13.0647 26.1893 13.1709 26.3821L18.824 21.7422L13.0877 15.7922Z"
											  fill="#0B4697"/>
									</svg>
								</a>
							</div>
						</div>


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
								$file = get_field('pdf');
								if ($file):

									$url = $file['url'];
									$title = $file['title'];
									?>
									<div class="single__button button button-primary flex">
										<a class="flex align-center" href="<?php echo esc_attr($url); ?>"
										   title="<?php echo esc_attr($title); ?>" target="_blank">
											<svg width="18" height="21" viewBox="0 0 18 21" fill="none"
												 xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd"
													  d="M3.20712 0.558517C2.46136 0.676006 1.78348 1.1713 1.43968 1.84982L1.24566 2.23279L1.22913 6.93405L1.21254 11.6353H0.606302H0V14.5875V17.5398L0.592448 17.556L1.1849 17.5723L1.21765 18.1688C1.24578 18.6819 1.2772 18.8189 1.44205 19.1483C1.7847 19.8328 2.42746 20.3007 3.21806 20.4408C3.6784 20.5225 14.9898 20.5183 15.4684 20.4364C16.4628 20.2661 17.2418 19.515 17.4336 18.5418C17.4792 18.3105 17.5 16.1544 17.5 11.6691V5.13337L16.2088 3.93848C15.4986 3.28133 14.3691 2.23881 13.6988 1.62183L12.4801 0.5L7.98699 0.506704C5.51578 0.51034 3.36486 0.53369 3.20712 0.558517ZM2.86799 1.3856C2.47977 1.56649 2.16678 1.8989 2.00569 2.30142C1.88727 2.59736 1.88368 2.73945 1.88368 7.12085V11.6353L5.90929 11.6357C8.25198 11.6358 10.0873 11.6593 10.2995 11.6917C11.3028 11.8451 12.2115 12.641 12.5512 13.6637C12.601 13.8136 12.6585 14.143 12.6791 14.3956C12.7785 15.622 12.1041 16.7967 11.0103 17.3022L10.549 17.5154L6.20898 17.5311L1.86898 17.5468L1.89559 18.0424C1.9377 18.8252 2.2465 19.3229 2.87055 19.6137L3.1836 19.7595L9.32398 19.759L15.4644 19.7584L15.7705 19.6251C15.9418 19.5506 16.1874 19.3742 16.328 19.2249C16.7996 18.724 16.7708 19.187 16.7708 12.1081V5.78359H15.3815C14.6175 5.78359 13.845 5.75791 13.6649 5.72649C12.862 5.58634 12.1397 5.05065 11.77 4.32117L11.5755 3.93718L11.5555 2.58787L11.5355 1.23857H7.35954H3.1836L2.86799 1.3856ZM12.2235 2.50265C12.2432 3.66703 12.2496 3.721 12.4027 4.02239C12.6049 4.42025 12.9433 4.73653 13.3681 4.92435C13.6904 5.0669 13.7492 5.07286 15.0239 5.09258C15.8891 5.10593 16.3455 5.09309 16.3455 5.05548C16.3455 4.98566 12.3327 1.29538 12.2567 1.29538C12.2268 1.29538 12.2121 1.82777 12.2235 2.50265ZM2.24826 14.6138V16.1235H2.5217H2.79514V15.5622V15.0008L3.3572 14.9764C3.99255 14.9486 4.22807 14.8621 4.44615 14.5762C4.6389 14.3236 4.64759 13.764 4.46238 13.532C4.17484 13.1719 4.07872 13.1424 3.12515 13.1224L2.24826 13.104V14.6138ZM5.22569 14.618V16.1235L5.87891 16.1232C6.69102 16.1228 6.92976 16.0623 7.26754 15.7712C7.58108 15.501 7.7178 15.1503 7.71556 14.6218C7.71264 13.9241 7.47773 13.48 6.98785 13.2462C6.74734 13.1314 6.62466 13.1155 5.97005 13.114L5.22569 13.1124V14.618ZM8.38542 14.6211V16.1298L8.67404 16.1124L8.96267 16.0951V15.4702V14.8452L9.60069 14.8371L10.2387 14.8289L10.2576 14.624L10.2764 14.4191H9.60434H8.93229V13.9646V13.5101H9.69184H10.4514V13.3113V13.1124H9.4184H8.38542V14.6211ZM2.79514 14.0574V14.6045L3.24722 14.5774C3.52066 14.561 3.7597 14.5133 3.85207 14.4567C4.15698 14.2699 4.10594 13.7437 3.76736 13.5836C3.68381 13.5442 3.43091 13.5114 3.2053 13.511L2.79514 13.5101V14.0574ZM5.83187 13.5385C5.83108 13.5542 5.82987 14.0463 5.8292 14.6322L5.82793 15.6974L6.20071 15.69C6.92131 15.6758 7.10938 15.4513 7.10938 14.6055C7.10938 14.1089 7.09206 14.0142 6.97053 13.8452C6.89123 13.7349 6.74145 13.6231 6.62114 13.5843C6.41284 13.5173 5.83467 13.4837 5.83187 13.5385Z"
													  fill="black"/>
											</svg>
											<span><?php echo esc_html($title); ?></span>
										</a>
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
