<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cavatina
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
    <?php

	comment_form( 
		array( 
			'class_form'    => 'c-comment-form  comment-form',
			'label_submit'  => __( 'Send', 'cavatina' ),
			'comment_field' => '<p class="comment-form-comment"><label for="comment">'.__( 'Comment', 'cavatina' ).'</label> <textarea placeholder="'.__( 'Your Comment*', 'cavatina' ).'" id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required" class=""></textarea></p>',
			) 
	);

	// You can start editing here -- including this comment!
	if ( have_comments() ) :
	?>
    <h2 class="comments-title">
        <?php
			$cavatina_comment_count = get_comments_number();
			if ( '1' === $cavatina_comment_count ) {
				printf(
					/* translators: Comments */
					'<span>'.esc_html_e( 'Comments', 'cavatina' ).'</span>'
				);
			} else {
				printf(
					/* translators: Comments */
					'<span>'.esc_html_e( 'Comments', 'cavatina' ).'</span>'
				);
			}
			?>
    </h2><!-- .comments-title -->

    <?php the_comments_navigation(); ?>

    <ol class="comment-list">
        <?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 144,
				)
			);
			?>
    </ol><!-- .comment-list -->

    <?php
		the_comments_navigation();
		// If comments are closed and there are comments, let's leave a little note
		if ( ! comments_open() ) :
	?>

    <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'cavatina' ); ?></p>

    <?php
		endif;
	endif; // Check for have_comments().
	?>

</div><!-- #comments -->