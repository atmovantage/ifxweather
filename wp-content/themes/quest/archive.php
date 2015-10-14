<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Quest
 */

get_header();
$layout = quest_get_mod( 'layout_archive_style' ); ?>

<?php get_template_part( 'partials/content', $layout ); ?>

<?php get_footer(); ?>
