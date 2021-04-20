<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @subpackage fMovies
 * @author tishonator
 * @since fMovies 1.0.0
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

 get_header(); ?>

 <div class="clear">
</div><!-- .clear -->

<div id="main-content-wrapper">

	<div id="main-content">

	<?php if ( have_posts() ) : 

				// starts the loop
				while ( have_posts() ) :

					the_post();

					/*
					 * Include the post format-specific template for the content.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;

				the_posts_pagination( array(
                        'prev_next' => '',
                    ) );

		  else :

				// if no content is loaded, show the 'no found' template
				get_template_part( 'template-parts/content', 'none' );
			
		  endif; ?>

	</div><!-- #main-content -->

	<?php get_sidebar(); ?>

</div><!-- #main-content-wrapper -->

<?php get_footer(); ?>