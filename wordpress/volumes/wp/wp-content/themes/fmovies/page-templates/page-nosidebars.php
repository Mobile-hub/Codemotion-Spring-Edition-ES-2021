<?php
/*

Template Name: No Sidebars Page

*/

?>
<?php get_header(); ?>

<div id="main-content-wrapper">
	<div id="main-content-full">
	<?php if ( have_posts() ) :
			
			while ( have_posts() ) :
			
				the_post(); ?>
				
				<div class="wide-content">
				
					<?php
					// includes the single page content templata here
					get_template_part( 'template-parts/content', 'page' );

					// if comments are open or there's at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					} ?>
				
				</div>
				
	<?php   endwhile;
				
		  else : 
		  
			// if no content is loaded, show the 'no found' template
			get_template_part( 'content', 'none' );
	 
		  endif; ?>
	</div>
</div>
<?php get_footer(); ?>