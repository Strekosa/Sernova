<?php
/**
 * Block Name: Team
 * Description: Team block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: team acf block
 * Supports: { "align":false, "anchor":true }
 *
 * @package sernova
 *
 * @var array $block
 */

$slug = str_replace('acf/', '', $block['name']);
$block_id = $slug . '-' . $block['id'];
$align_class = $block['align'] ? 'align' . $block['align'] : '';
$custom_class = isset($block['className']) ? $block['className'] : '';

$label = get_field('label');
$title = get_field('title');
$text = get_field('subtitle');

?>
<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?>">

	<div class="<?php echo $slug; ?>__wrapp container-boxed justify-between">

		<div class="<?php echo $slug; ?>__heading flex column ">
			<?php
			if ($title) : ?>
				<h5 class="<?php echo $slug; ?>__title flex align-center">
					<?php echo $title; ?>
				</h5>
			<?php endif; ?>

			<?php
			if ($text) : ?>
				<div class="<?php echo $slug; ?>__text flex align-center">
					<?php echo $text; ?>
				</div>
			<?php endif; ?>
		</div>

		<?php
		$featured_posts = get_field('team_list');
		if ($featured_posts): ?>
			<div class="<?php echo $slug; ?>__list">
				<?php foreach ($featured_posts

							   as $index => $featured_post): ?>
					<?php
					$name = get_the_title($featured_post->ID);
					$position = get_field('position', $featured_post->ID);
					$socials = get_field('socials', $featured_post->ID);
					$image_url = get_the_post_thumbnail_url($featured_post->ID);
					$image_alt = get_post_meta(get_post_thumbnail_id($featured_post->ID), '_wp_attachment_image_alt', true);
					?>

					<a href="#popup-<?php echo $index; ?>"
					   class="<?php echo $slug; ?>__item flex column open-modal-button">

						<div class="<?php echo $slug; ?>__item-image flex column">
							<?php if ($image_url): ?>
								<img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
							<?php endif; ?>
						</div>

						<div class="<?php echo $slug; ?>__item-main">
							<?php if ($name): ?>
								<h5 class="<?php echo $slug; ?>__item-name">
									<?php echo $name; ?>
								</h5>
							<?php endif; ?>
							<?php if ($position): ?>
								<div class="<?php echo $slug; ?>__item-position">
									<?php echo $position; ?>
								</div>
							<?php endif; ?>
						</div>
					</a>

					<!-- Modal -->
					<div id="popup-<?php echo $index; ?>" class="modal hidden">
						<div class="modal__content">
							<button class="modal-close">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
									 fill="none">
									<path d="M18.2983 5.71022C18.2058 5.61752 18.0959 5.54397 17.9749 5.49379C17.8539 5.44361 17.7242 5.41778 17.5933 5.41778C17.4623 5.41778 17.3326 5.44361 17.2116 5.49379C17.0907 5.54397 16.9808 5.61752 16.8883 5.71022L11.9983 10.5902L7.10827 5.70022C7.01569 5.60764 6.90578 5.5342 6.78481 5.4841C6.66385 5.43399 6.5342 5.4082 6.40327 5.4082C6.27234 5.4082 6.14269 5.43399 6.02173 5.4841C5.90076 5.5342 5.79085 5.60764 5.69827 5.70022C5.60569 5.79281 5.53225 5.90272 5.48214 6.02368C5.43204 6.14464 5.40625 6.27429 5.40625 6.40522C5.40625 6.53615 5.43204 6.6658 5.48214 6.78677C5.53225 6.90773 5.60569 7.01764 5.69827 7.11022L10.5883 12.0002L5.69827 16.8902C5.60569 16.9828 5.53225 17.0927 5.48214 17.2137C5.43204 17.3346 5.40625 17.4643 5.40625 17.5952C5.40625 17.7262 5.43204 17.8558 5.48214 17.9768C5.53225 18.0977 5.60569 18.2076 5.69827 18.3002C5.79085 18.3928 5.90076 18.4662 6.02173 18.5163C6.14269 18.5665 6.27234 18.5922 6.40327 18.5922C6.5342 18.5922 6.66385 18.5665 6.78481 18.5163C6.90578 18.4662 7.01569 18.3928 7.10827 18.3002L11.9983 13.4102L16.8883 18.3002C16.9809 18.3928 17.0908 18.4662 17.2117 18.5163C17.3327 18.5665 17.4623 18.5922 17.5933 18.5922C17.7242 18.5922 17.8538 18.5665 17.9748 18.5163C18.0958 18.4662 18.2057 18.3928 18.2983 18.3002C18.3909 18.2076 18.4643 18.0977 18.5144 17.9768C18.5645 17.8558 18.5903 17.7262 18.5903 17.5952C18.5903 17.4643 18.5645 17.3346 18.5144 17.2137C18.4643 17.0927 18.3909 16.9828 18.2983 16.8902L13.4083 12.0002L18.2983 7.11022C18.6783 6.73022 18.6783 6.09022 18.2983 5.71022Z"
										  fill="#000"/>
								</svg>
							</button>

							<div class="modal__content-wrapp flex">
								<?php if ($image_url): ?>
									<div class="modal__content-image">
										<img src="<?php echo $image_url; ?>" alt="<?php echo $image_alt; ?>">
									</div>
								<?php endif; ?>

								<div class="modal__content-main flex justify-between">
									<div class="modal__content-inner flex column justify-between">
										<div class="modal__content-heading flex column" style="margin-bottom: 25px;">
											<?php if ($name): ?>
												<h3 class="modal__content-name">
													<?php echo $name; ?>
												</h3>
											<?php endif; ?>

											<?php if ($position): ?>
												<h5 class="modal__content-position">
													<?php echo $position; ?>
												</h5>
											<?php endif; ?>
										</div>

										<div class="modal__content-text">
											<?php echo apply_filters('the_content', get_the_content(null, false, $featured_post->ID)); ?>

										</div>
									</div>
									<div class="modal__content-socials social flex">
										<?php if ($socials && is_array($socials)): ?>
											<ul class="socials-list flex">
												<?php foreach ($socials as $social): ?>
													<?php
													$icon = isset($social['icon']) ? $social['icon'] : null;
													$link = isset($social['link']) ? $social['link'] : null;
													?>
													<?php if ($icon && $link): ?>
														<li class="socials-list__item">
															<a href="<?php echo esc_url($link['url']); ?>"
															   target="_blank" rel="noopener noreferrer">
																<img src="<?php echo esc_url($icon['sizes']['thumbnail']); ?>"
																	 alt="<?php echo esc_attr($link['title'] ?? 'Social link'); ?>"/>
															</a>
														</li>
													<?php endif; ?>
												<?php endforeach; ?>
											</ul>
										<?php endif; ?>
									</div>
								</div>


							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<?php wp_reset_postdata();
		endif; ?>
	</div>
</section>

