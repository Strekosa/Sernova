<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package sernova
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
	<?php if (is_single()): ?>
		<meta property="og:type" content="article"/>
		<meta property="og:title" content="<?php echo get_the_title(); ?>"/>
		<meta property="og:description" content="<?php echo wp_strip_all_tags(get_the_excerpt()); ?>"/>
		<meta property="og:url" content="<?php echo get_permalink(); ?>"/>
		<?php if (has_post_thumbnail()): ?>
			<meta property="og:image" content="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>"/>
		<?php else: ?>
			<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/path-to-default-image.jpg"/>
		<?php endif; ?>
	<?php endif; ?>

</head>

<body <?php body_class(); ?>>
<header class="header" id="header">
	<div class="header__container container-boxed">
		<div class="header__row flex justify-between align-center w-100">

			<div class="header__main flex justify-between align-center w-100">
				<a class="header__brand brand" href="<?php echo esc_url(home_url()); ?>"
				   aria-label="Logo">
					<?php if (get_header_image()) : ?>
						<img class="brand__img" src="<?php echo(get_header_image()); ?>"
							 alt="<?php bloginfo('name'); ?>"/>
					<?php
					else :
						bloginfo('name');
					endif;
					?>
				</a><!-- /.brand -->
				<div class="header__main-container flex justify-between w-100">

					<nav class="nav-primary header__nav navbar navbar-expand-lg navbar-light bg-light flex align-center">
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#primaryNavBar"
								aria-controls="primaryNavBar" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>

						<div class="collapse navbar-collapse flex column  justify-between ">
							<div class="collapse navbar-collapse-wrapp flex column">

								<div class="collapse navbar-collapse-main flex column">
									<div class="collapse navbar-collapse-inner flex column">

										<?php
										if (has_nav_menu('primary')) :
											wp_nav_menu(
													[
															'theme_location' => 'primary',
															'menu_id' => 'primary-menu',
															'container_id' => 'primaryNavBar',
															'menu_class' => 'navbar-nav flex',
															'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
															'walker' => new sernova_Navwalker(),
													]
											);
										endif;
										?>
										<?php
										$link = get_field('header_button', 'options');
										if ($link):
											$link_url = $link['url'];
											$link_title = $link['title'];
											$link_target = $link['target'] ? $link['target'] : '_self';
											?>
											<div class="header__button button show-on-tablet ">
												<a href="<?php echo esc_url($link_url); ?>"
												   target="<?php echo esc_attr($link_target); ?>"
												   aria-label="Contact button"
												>
													<?php echo esc_html($link_title); ?>
												</a>
											</div>
										<?php endif; ?>
									</div>
									<div class="header__footer site-footer__bottom flex justify-between align-center show-on-tablet">

										<div class="socials flex ">
											<?php if (have_rows('socials', 'options')): ?>
												<ul class="socials-list flex">

													<?php while (have_rows('socials', 'options')): the_row(); ?>
														<?php if (($icon = get_sub_field('icon')) && ($link = get_sub_field('link'))): ?>
															<li>
																<a href="<?php echo $link['url']; ?>"
																   target="_blank"
																   aria-label="Social link"
																>
																	<img
																			src="<?php echo $icon['sizes']['thumbnail'] ?>"
																			alt=""></a>
															</li>
														<?php endif; ?>
													<?php endwhile; ?>

												</ul>
											<?php endif; ?>
										</div>

									</div>
								</div>
							</div>
						</div>

					</nav><!-- .nav-primary -->

					<div class="header__search-form">
						<form method="get" id="header-search-form" class="search-form"
							  action="<?php echo esc_url(home_url('/')); ?>">
							<svg width="19" height="18" viewBox="0 0 19 18" fill="none"
								 xmlns="http://www.w3.org/2000/svg">
								<path d="M8.29004 15.75C12.2251 15.75 15.415 12.56 15.415 8.625C15.415 4.68997 12.2251 1.5 8.29004 1.5C4.35501 1.5 1.16504 4.68997 1.16504 8.625C1.16504 12.56 4.35501 15.75 8.29004 15.75Z"
									  stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
								<path d="M16.165 16.5L13.665 14" stroke="black" stroke-width="1.5"
									  stroke-linecap="round"
									  stroke-linejoin="round"/>
							</svg>
							<input type="search" name="s" id="search-input" class="search-field pos-rel"
								   placeholder="<?php echo esc_attr__('Search', 'wp_dev'); ?>"
								   value="<?php echo esc_attr(get_search_query()); ?>"/>

						</form>
					</div>

					<?php
					$link = get_field('header_button', 'options');
					if ($link):
						$link_url = $link['url'];
						$link_title = $link['title'];
						$link_target = $link['target'] ? $link['target'] : '_self';
						?>
						<div class="header__button button button-primary hide-on-tablet">
							<a href="<?php echo esc_url($link_url); ?>"
							   target="<?php echo esc_attr($link_target); ?>"
							   aria-label="Contact button"
							>
								<?php echo esc_html($link_title); ?>
							</a>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
		<h2>ffff</h2>
	</div>

</header><!-- .banner -->
<main id="content" class="site-content">
