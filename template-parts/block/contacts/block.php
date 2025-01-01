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

?>

<section
		id="<?php echo esc_attr($block_id); ?>"
		class="<?php echo esc_attr($slug); ?> <?php echo esc_attr($align_class); ?> <?php echo esc_attr($custom_class); ?>">

	<div class="<?php echo esc_attr($slug); ?>__wrapp container-boxed column">

		<?php if ($title = get_field('title')) : ?>
			<h2 class="<?php echo esc_attr($slug); ?>__title">
				<?php echo esc_html($title); ?>
			</h2>
		<?php endif; ?>

		<?php if (have_rows('contacts_list')) : ?>
			<div class="<?php echo esc_attr($slug); ?>__list <?php echo esc_attr($style ?? ''); ?>">
				<?php while (have_rows('contacts_list')) : the_row();
					$icon = get_sub_field('icon');
					$title = get_sub_field('title');
					$contacts = get_sub_field('contacts');
					?>
					<div class="<?php echo esc_attr($slug); ?>__item flex column align-center">
						<div class="<?php echo esc_attr($slug); ?>__item-inner flex column align-center">
							<div class="<?php echo esc_attr($slug); ?>__item-top flex column align-center">
								<?php if ($icon) : ?>
									<div class="<?php echo esc_attr($slug); ?>__item-icon flex column align-center justify-center">
										<img src="<?php echo esc_url($icon['url']); ?>"
											 alt="<?php echo esc_attr($icon['alt']); ?>"/>
									</div>
								<?php endif; ?>

								<?php if ($title) : ?>
									<h4 class="<?php echo esc_attr($slug); ?>__item-title">
										<?php echo esc_html($title); ?>
									</h4>
								<?php endif; ?>
							</div>

							<div class="<?php echo esc_attr($slug); ?>__item-main flex column justify-center align-center">
								<?php render_contact_item($slug, $contacts); ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
