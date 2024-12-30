<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package woodwork
 */
$logo = get_field('logo', 'options');
$logo_text = get_field('logo_text', 'options');
$copyright_text = get_field('copyright_text', 'options');
$made_by = get_field('made_by', 'options');
$terms_of_use = get_field('terms_of_use', 'options');
$privacy_policy = get_field('privacy_policy', 'options');
$contact_title = get_field('contact_title ', 'options');
$social = get_field('social', 'options');
$contacts_title = get_field('contact_title', 'options');

?>

</main><!-- #content -->

<footer id="footer-container" class="site-footer" role="contentinfo">

	<div class="site-footer__main container-boxed">

		<div class="site-footer__title flex">
			<a class="site-footer__logo flex column"
			   href="<?php echo esc_url(home_url()); ?>"
			   aria-label="Logo">
				<?php
				if ($logo) : ?>
					<img class="site-footer__logo-img" src="<?php echo esc_url($logo ['url']); ?>"
						 alt="<?php echo esc_attr($logo ['alt']); ?>"/>
				<?php endif; ?>
			</a>
		</div>

		<nav class="nav-footer">
			<?php
			if (has_nav_menu('footer_menu')) :
				wp_nav_menu(
						[
								'theme_location' => 'footer_menu',
								'menu_id' => 'footer-menu',
								'menu_class' => 'footer-menu navbar-nav',
								'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
								'walker' => new sernova_Navwalker()
						]
				);
			endif;
			?>
		</nav>

	</div>

	<div class="site-footer__bottom container-boxed justify-between">
		<div class="site-footer__bottom-main flex justify-between align-end">
			<?php
			if ($copyright_text) : ?>
				<span class="site-footer__copyright">
					<?php echo $copyright_text; ?>
				</span>
			<?php endif; ?>

			<?php if (have_rows('documents', 'options')): ?>
				<div class="site-footer__docs flex align-center justify-center">
					<?php while (have_rows('documents', 'options')): the_row(); ?>
						<?php
						if ($doc_link = get_sub_field('doc')):
							$doc_link_url = $doc_link['url'];
							$doc_link_title = $doc_link['title'];
							$doc_link_target = $doc_link['target'] ? $doc_link['target'] : '_self';
							?>
							<a class="site-footer__doc " href="<?php echo esc_url($doc_link_url); ?>"
							   aria-label="<?php echo esc_html($doc_link_title); ?>"
							   target="<?php echo esc_attr($doc_link_target); ?>">
								<?php echo esc_html($doc_link_title); ?>
							</a>
							<div class="site-footer__doc-separator"></div>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="site-footer__socials social flex ">
			<?php if (have_rows('socials', 'options')): ?>
				<ul class="site-footer__socials-list socials-list flex">

					<?php while (have_rows('socials', 'options')): the_row(); ?>
						<?php
						$icon = get_sub_field('icon');
						$link = get_sub_field('link');
						if ($icon && $link): ?>
							<li>
								<a href="<?php echo esc_url($link['url']); ?>" target="_blank" aria-label="social link">
									<img src="<?php echo esc_url($icon['sizes']['thumbnail']); ?>" alt="">
								</a>
							</li>
						<?php endif; ?>
					<?php endwhile; ?>

				</ul>
			<?php endif; ?>
		</div>

	</div>

</footer><!-- #colophon -->

<?php wp_footer(); ?>
<div id="backtop" style="">
	<a href="#header" class="no-underline" aria-label="scroll to top">
		<svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M9.5558 4.96922L2.47802 12.047C2.18913 12.3359 1.85209 12.4743 1.46691 12.4623C1.08172 12.4502 0.744684 12.2998 0.455795 12.0109C0.19098 11.722 0.0525542 11.385 0.0405171 10.9998C0.0284801 10.6146 0.166906 10.2776 0.455795 9.98866L9.98913 0.455328C10.1336 0.310883 10.2901 0.208568 10.4586 0.148383C10.6271 0.0881981 10.8076 0.0581055 11.0002 0.0581055C11.1928 0.0581055 11.3734 0.0881981 11.5419 0.148383C11.7104 0.208568 11.8669 0.310883 12.0114 0.455328L21.5447 9.98866C21.8095 10.2535 21.9419 10.5845 21.9419 10.9817C21.9419 11.3789 21.8095 11.722 21.5447 12.0109C21.2558 12.2998 20.9127 12.4442 20.5155 12.4442C20.1183 12.4442 19.7752 12.2998 19.4864 12.0109L12.4447 4.96922V21.1109C12.4447 21.5201 12.3063 21.8632 12.0294 22.1401C11.7526 22.4169 11.4095 22.5553 11.0002 22.5553C10.591 22.5553 10.2479 22.4169 9.97107 22.1401C9.69422 21.8632 9.5558 21.5201 9.5558 21.1109V4.96922Z"
				  fill="#141414"/>
		</svg>
	</a>
</div>

</body>

</html>
