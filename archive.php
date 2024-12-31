<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package sernova
 */

get_header();

$acf_field_name = 'archive_resourses_page';
get_template_part('template-parts/content-archive', null, ['acf_field_name' => $acf_field_name]);

get_footer();
