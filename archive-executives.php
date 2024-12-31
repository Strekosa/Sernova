<?php
/**
 * The template for displaying archive--executives pages.
 */

get_header();

$acf_field_name = 'archive_executives_page';
get_template_part('template-parts/content-archive', null, ['acf_field_name' => $acf_field_name]);

get_footer();
