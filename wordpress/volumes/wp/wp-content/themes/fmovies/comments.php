<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @subpackage fMovies
 * @author tishonator
 * @since fMovies 1.0.0
 *
 */
 
if ( post_password_required() ) {
	return;
}
?>

	<?php if ( have_comments() ) : ?>
		<h3 id="comments">
			<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'fmovies' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Reply to &ldquo;%2$s&rdquo;',
							'%1$s Replies to &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'fmovies'
						),
						esc_html( number_format_i18n( $comments_number ) ),
						get_the_title()
					);
				}
			?>
		</h3><!-- #comments -->

		<ol class="commentlist">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 56,
				) );
			?>
		</ol><!-- .commentlist -->

		<div class="comment-navigation">
		   
			<div class="alignleft"><?php previous_comments_link(); ?>
			</div><!-- .alignleft -->
	
			<div class="alignright"><?php next_comments_link(); ?>
			</div><!-- .alignright -->
			
		</div><!-- .comment-navigation -->

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'fmovies' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>
