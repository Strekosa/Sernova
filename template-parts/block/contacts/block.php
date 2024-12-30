<?php
/**
 * Block Name: Contacts
 * Description: Contacts block managed with ACF.
 * Category: common
 * Icon: format-image
 * Keywords: contacts acf block
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

$icon = get_field('icon');
$title = get_field('title');

?>
<section
		id="<?php echo $block_id; ?>"
		class="<?php echo $slug; ?> <?php echo $align_class; ?> <?php echo $custom_class; ?> "
>

	<div class="<?php echo $slug; ?>__wrapp container-boxed column">

		<?php
		if ($title) : ?>
			<h2 class="<?php echo $slug; ?>__title">
				<?php echo $title; ?>
			</h2>
		<?php endif; ?>

		<?php
		// check if the nested repeater field has rows of data
		if (have_rows('contacts_list')):?>
			<div class="<?php echo $slug; ?>__list <?php echo $style; ?>">
				<?php while (have_rows('contacts_list')): the_row();
					$icon = get_sub_field('icon');
					$title = get_sub_field('title');
					$contacts = get_sub_field('contacts');
					?>
					<div class="<?php echo $slug; ?>__item flex column align-center">
						<div class="<?php echo $slug; ?>__item-inner flex column align-center">
							<div class="<?php echo $slug; ?>__item-top flex column align-center">
								<?php
								if ($icon) : ?>
									<div class="<?php echo $slug; ?>__item-icon flex column align-center justify-center">
										<img src="<?php echo esc_url($icon ['url']); ?>"
											 alt="<?php echo esc_attr($icon ['alt']); ?>"/>
									</div>
								<?php endif; ?>

								<?php
								if ($title) : ?>
									<h4 class="<?php echo $slug; ?>__item-title">
										<?php echo $title; ?>
									</h4>
								<?php endif; ?>
							</div>

							<div class="<?php echo $slug; ?>__item-main flex column justify-center align-center">
								<?php if ($contacts): ?>
									<?php if (!empty($contacts['address'])): ?>
										<p class="<?php echo $slug; ?>__item-address">
											<span><?php _e('Address:', THEME_TD); ?></span>
											<?php echo esc_html($contacts['address']); ?>
										</p>
									<?php endif; ?>

									<?php if (!empty($contacts['phones']) && is_array($contacts['phones'])): ?>
										<ul class="<?php echo $slug; ?>__item-phones">
											<?php foreach ($contacts['phones'] as $phone_item): ?>
												<?php
												$phone = isset($phone_item['phone']) ? $phone_item['phone'] : '';
												$phone_link = preg_replace('/[^0-9+]/', '', $phone);
												?>
												<?php if ($phone): ?>
													<li class="<?php echo $slug; ?>__item-phones-item">
														<span><?php _e('Phone:', THEME_TD); ?></span>
														<a class="dynamic-phone-link"
														   href="tel:<?php echo esc_attr($phone_link); ?>"
														   data-phone="<?php echo esc_attr($phone_link); ?>">
															<?php echo esc_html($phone); ?>
														</a>
													</li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>



									<?php if (!empty($contacts['emails']) && is_array($contacts['emails'])): ?>
										<ul class="<?php echo $slug; ?>__item-emails">
											<?php foreach ($contacts['emails'] as $email): ?>
												<li class="<?php echo $slug; ?>__item-emails-item">
													<span><?php _e('Email:', THEME_TD); ?></span>
													<a href="mailto:<?php echo esc_attr($email['email']); ?>">
														<?php echo esc_html($email['email']); ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								<?php endif; ?>
							</div>

						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
