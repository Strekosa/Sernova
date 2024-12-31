<?php
/**
 * The template for displaying archive--careers pages.
 */

get_header();

$acf_field_name = 'archive_careers_page';
get_template_part('template-parts/content-archive', null, ['acf_field_name' => $acf_field_name]);

get_footer();
