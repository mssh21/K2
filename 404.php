<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package K2
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div id="page-lyt" class="container">
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
		</div>
	</main><!-- #main -->

<?php
get_footer();
