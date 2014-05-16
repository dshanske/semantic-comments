<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. Based on the blank comment template from _s
 *
 * @package SemanticComments
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
1
	<?php // You can start editing here -- including this comment! ?>
	<?php if ( have_comments() ) : ?>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'indieweb' ); ?></h1>
                       <ul class="pager">
			<li class="previous"><?php previous_comments_link( __( '&larr; Older Comments', 'semanticcomments' ) ); ?></li>
			<li class="next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'indieweb' ) ); ?></li>
                       </ul>
		</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation ?>
		<?php $comments_by_type = &separate_comments($comments); ?>
		<?php if (!empty($comments_by_type['webmention'])) { ?>
                <h3>Mentions</h3>
		
	        <ul class="webmention-list">
                        <?php
                                wp_list_comments(
                                array(
                                        'type'       => 'webmention',
                                        'callback'   => 'sem_webmention',
                                        'avatar_size'=> 75
                                )
                        );
                        ?>
                </ul><!-- .webmention-list -->
		<?php } ?>
		<?php if (!empty($comments_by_type['comment'])) { ?>
                <h3>Comments</h3>

		<ul class="comment-list">
			<?php
				wp_list_comments(
				array(
					'type'       => 'comment',
					'callback'   => 'sem_comment',
					'avatar_size'=> 100
				)
			);
			?>
		</ul><!-- .comment-list -->
		<?php } ?>

		<?php if (!empty($comments_by_type['pingback'])) { ?>
               <h3>Pingbacks</h3>
                  <ul class="ping-list">
                        <?php
                                wp_list_comments(
				array(
					'type'       => 'pings',
					'callback'   => 'sem_ping',
					'avatar_size'=> 100
				)
			);
                        ?>
                </ul><!-- .ping-list -->
		<?php } ?>
            
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="comment-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'semanticcomments' ); ?></h1>
			<ul class="pager">
				<li class="previous"><?php previous_comments_link( __( '&larr; Older Comments', 'semanticomments' ) ); ?></li>
				<li class="next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'semanticcomments' ) ); ?></li>
                        </ul>
		</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'indieweb' ); ?></p>
	<?php endif; ?>
	<div class="commentf">
        <?php comment_form(); ?>
        </div>

</div><!-- #comments -->
