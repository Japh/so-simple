<?php
/**
 * The template for displaying all pages.
 *
 * @package So Simple
 */

get_header(); ?>

	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'templates/parts/content', 'page' ); ?>

		<?php endwhile; ?>

	</main><!-- #main -->

<?php get_footer(); ?>