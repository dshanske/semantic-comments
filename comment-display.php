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

$options = get_option ('sc_options');



?>

<div id="comments" class="comments-area">
     <div class="comment-nav">

	<div class="respond">

        <?php 
		if($options['webmention_form']==1) {	
		webmention_form();
			}
	?>
	</div>
	<?php if ( have_comments() ) : ?>
                <?php $comments_by_type = separate_comments($comments);
		if ((count($comments_by_type['webmention'])!=0) && class_exists("SemanticLinkbacksPlugin")) { ?>
                <a id="mentions"></a>
		<h3>Mentions</h3>
	        <ul class="mention-list like-list">
                       <?php
                                wp_list_comments(
                                array(
				     'walker'     => 'new Walker_WMComment()',
                                     'type'       => 'all',
				     'short_ping' => 'true', 
                                     'avatar_size'=> $options['mention_size']
                                ),
				get_linkbacks('like') );
                             
                        ?>
                </ul><!-- .like-list -->

                <ul class="mention-list favorite-list">
                       <?php
                                wp_list_comments(
                                array(
                                     'walker'     => 'new Walker_WMComment()',
                                     'type'       => 'all',
                                     'short_ping' => 'true', 
                                     'avatar_size'=> $options['mention_size']
                                ),
                                get_linkbacks('favorite') );

                        ?>
                </ul><!-- .favorite-list -->

                <ul class="mention-list repost-list">
                       <?php
                                wp_list_comments(
                                array(
                                     'walker'     => 'new Walker_WMComment()',
                                     'type'       => 'all',
                                     'short_ping' => 'true', 
                                     'avatar_size'=> $options['mention_size']
                                ),
                                get_linkbacks('repost') );

                        ?>
                </ul><!-- .repost-list -->


                <ul class="mention-list">
                       <?php
                                wp_list_comments(
                                array(
                                     'walker'     => 'new Walker_WMComment()',
                                     'type'       => 'all',
                                     'short_ping' => 'true', 
                                     'avatar_size'=> $options['mention_size']
                                ),
                               get_linkbacks('mention')   );

                        ?>
                </ul><!-- .like-list -->


		<?php } ?>



        </div>
        <div class="comment-return">
		<?php if (count($comments_by_type['comment'])!=0) { ?>
                <h3>Comments</h3>

		<ul class="comment-list">
			<?php
			   if (class_exists("SemanticLinkbacksPlugin"))
                              {
				wp_list_comments(
				array(
				      'walker'     => 'new Walker_WMComment()',
				      'type'       => 'comment',
				      'avatar_size'=> $options['comment_size']
				) );
			     }
			   else
                              {
                                wp_list_comments(
                                array(
                                        'type'       => 'all',
                                        'avatar_size'=> $options['comment_size']
                                ) );
                             }
			?>
		</ul><!-- .comment-list -->
		<?php } ?>

            </div>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'indieweb' ); ?></p>
	<?php endif; ?>

           <h3>Respond</h3>

	<?php if ($options['comment_form']==1) { comment_form(); }
	else {
	   ?>
	   <p>Readers are encouraged to respond on their own site, sending a <a href="http://indiewebcamp.com/webmention">webmention</a> 
or using the form to notify of a reply or using the syndication(Facebook, Twitter, etc) links to respond on those sites.</p>
	   <?php } ?>
</div><!-- #comments -->

