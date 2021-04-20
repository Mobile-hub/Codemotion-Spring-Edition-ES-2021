<?php
/**
 * The default template for displaying content
 *
 * Used for single, index, archive, and search contents.
 *
 * @subpackage fmovies
 * @author tishonator
 * @since fMovies 1.0.0
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( is_single() ) : ?>

			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>

	<?php else : ?>
	
			<h1 class="entry-title">
				<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h1>
	
	<?php endif; ?>

	<div class="before-content">
	</div><!-- .before-content -->

	<?php if ( is_single() ) : ?>

				<div class="content">
					<?php
						if ( has_post_thumbnail() ) :

							the_post_thumbnail();

						endif;
						
						the_content( __( 'Read More...', 'fmovies') );
					?>
				</div><!-- .content -->

	<?php else : ?>

				<div class="content">
					<?php if ( has_post_thumbnail() ) : ?>
								
								<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail(); ?>
								</a>
								
					<?php endif;

						  the_content( __( 'Read More', 'fmovies') );
					?>
				</div><!-- .content -->

	<?php endif; ?>

	<div class="after-content">

		<?php if ( !is_single() && get_the_title() === '' ) : ?>

				<span class="icon clock-icon">
					<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
						<time datetime="<?php the_date( DATE_W3C ); ?>"><?php echo get_the_date(); ?></time>
					</a>
				</span><!-- .clock-icon -->
	
		<?php else : ?>

				<span class="icon clock-icon">
					<time datetime="<?php the_date( DATE_W3C ); ?>"><?php echo get_the_date(); ?></time>
				</span><!-- .clock-icon -->
			
		<?php endif; ?>

		<?php if ( ! post_password_required() ) : ?>

					<?php if ( has_category() ) : ?>
							<p class="categories-wrapper">
								<?php the_category( _x( ', ', 'Used between list items, there is a space after the comma.', 'fmovies' ) ) ?>
							</p><!-- .categories-wrapper -->						
					<?php endif; ?>
				
					<?php if ( has_tag() ) : ?>
							<p class="tags-wrapper">
									<?php the_tags('', _x( ', ', 'Used between list items, there is a space after the comma.', 'fmovies' ), ''); ?> 
							</p><!-- .tags-wrapper -->						
					<?php endif; ?>

		<?php endif; // ! post_password_required() ?>

		<span class="icon author-icon">
			<?php the_author_posts_link(); ?>
		</span><!-- .author-icon -->

		<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>

					<span class="icon comments-icon">
						<?php comments_popup_link(__( 'No Comments', 'fmovies' ), __( '1 Comment', 'fmovies' ), __( '% Comments', 'fmovies' ), '', __( 'Comments are closed.', 'fmovies' )); ?>
					</span><!-- .comments-icon -->
		
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'fmovies' ), '<span class="edit-icon">', '</span>' ); ?>

	</div><!-- .after-content -->
	
	<?php if ( !is_single() ) : ?>
			<div class="separator">
			</div>
	<?php endif; ?>
</article><!-- #post-## -->
