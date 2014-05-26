<?php

if (!function_exists('change_avatar_css')) :
function change_avatar_css($class) {
$class = str_replace("class='photo", "class='photo u-photo", $class) ;
return $class;
}
add_filter('get_avatar','change_avatar_css');
endif;

/**
 * Webmentions 
 *
 */
if (!function_exists('sem_webmention')) :
function sem_webmention( $comment, array $args, $depth ) {
  $GLOBALS['comment'] = $comment;

  $author = get_comment_author();
  $url    = get_comment_author_url();
  $face   = get_avatar( $comment, $args['avatar_size'], '', $author );
  $wm_type = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_type', true);
  $c_url = get_comment_meta( $comment->comment_ID, 'semantic_linkbacks_canonical', true);
  $host = parse_url($c_url, PHP_URL_HOST);
  $host = preg_replace("/^www\./", "", $host);
  if ( ! empty( $url ) && 'http://' !== $url ) {
    $face = sprintf( '<a href="%s" rel="external nofollow" title="%s">%s</a>', esc_url( $url ), $author, $face );
  }
  echo '<li class="facepile h-cite p-comment" id="comment-' . get_comment_ID() . '">' . $face;
  switch ($wm_type) {    
     case "like": 
	echo '<a href="" class="u-in-like-of"></a>';
  	echo '<a class="action u-like" title="Liked on ' . $host . '" href="'. esc_url( $c_url ) . '">Liked</a>';
     break;
     case "repost":
	  echo '<a href="" class="u-repost-of"></a>';
        echo '<a class="action u-repost" title="Reposted on  ' . $host . '" href="'. esc_url( $c_url ) . '">Reposted</a>';
     break;
     case "favorite":
	  echo '<a href="" class="u-in-like-of"></a>';
        echo '<a class="action u-like u-favorite" title="Favorited on ' . $host . '" href="'. esc_url( $c_url ) . '">Favorited</a>';
     break;
     case "rsvp":
        echo '<a class="action in-reply-to" title="Reply ' . $host . '" href="'. esc_url( $c_url ) . '">RSVP</a>';
     break;
     case "reply":
        echo '<a class="action in-reply-to" title="Reply ' . $host . '" href="'. esc_url( $c_url ) . '">Reply</a>';
     break;	
     default:
        echo '<a class="action" title="Mentioned on ' . $host . '" href="'. esc_url( $c_url ) . '">Mentioned</a>';
    }

   echo '</li>';
 }
endif;
/**
 * Display template for pingbacks and trackbacks.
 *
 */
if (!function_exists('sem_ping')) :
    function sem_ping($comment, $args, $depth)
    {
	$GLOBALS['comment'] = $comment;
	extract( $args, EXTR_SKIP );
	?>
	<div <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID(); ?>">
		<div class="ping-body" id="div-ping-<?php comment_ID(); ?>">
 
			<div class="ping-author h-card vcard">
				<div class="ping-meta-wrapper">
					<span class="ping-meta">
						<?php
						printf(  '<cite class="fn u-url"><h4>%s</h4></cite>', get_comment_author_link() );
						
						printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time() );
						?>
					</span><!-- .ping-meta -->
				</div><!-- .ping-meta-wrapper -->
			</div><!-- .ping-author -->
 
			<div class="ping-text p-summary">
				<?php comment_text(); ?>
			</div><!-- .ping-text -->
 
		</div><!-- .ping-body -->
	</div><!-- #div-ping-<?php comment_ID(); ?>-->
	<?php               
    }
endif;

/**
 * Display template for comments.
 *
 */
if (!function_exists('sem_comment')) :
    function sem_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
                // Proceed with normal comments.
                global $post; ?>
                <li class="p-comment h-cite comment" id="li-comment-<?php comment_ID(); ?>">
                        <a href="<?php echo $comment->comment_author_url;?>">
                            <?php echo get_avatar($comment, 64); ?>
                        </a>
                        <div class="comment-body">
			 <div class="comment-meta">
			    <a href="" class="in-reply-to"></a>
                            <h3 class="comment-author p-author vcard h-card">
                                <?php
                                printf('<cite class="fn">%1$s %2$s</cite>',
                                    get_comment_author_link(),
                                    // If current post author is also comment author, make it known visually.
                                    ($comment->user_id === $post->post_author) ? '<span class="post-author"> ' . __(
                                        'Post author',
                                        'semanticcomments'
                                    ) . '</span> ' : ''); ?>
                            </h3>
                            <span class="comment-time">
                                <?php printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                                            esc_url(get_comment_link($comment->comment_ID)),
                                            get_comment_time('c'),
                                            sprintf(
                                                __('%1$s at %2$s', 'semanticcomments'),
                                                get_comment_date(),
                                                get_comment_time()
                                            )
                                        ); ?>
                            </span>

                            <?php if ('0' == $comment->comment_approved) : ?>
                                <p class="comment-awaiting-moderation"><?php _e(
                                    'Your comment is awaiting moderation.',
                                    'semanticcomments'
                                ); ?></p>
                            <?php endif; ?>
			</div>
                            <span class="p-summary"><?php comment_text(); ?></span>
                        </div>
                        <!--/.comment-body -->
                <?php
    }
endif;


if (!function_exists('webmention_form')) :
  function webmention_form() {
  ?>
     <form id="webmention-form" action="<?php echo site_url('?webmention=endpoint'); ?>" method="post">
      <p>
        <label for="webmention-source"><?php _e('Respond on your own site:', 'webmention_form'); ?></label>
        <input id="webmention-source" size="15" type="url" name="source" placeholder="http://example.com/post/100" />
      
        <input id="webmention-submit" type="submit" name="submit" value="Send" />
      
      <input id="webmention-target" type="hidden" name="target" value="<?php the_permalink(); ?>" />
	</p>
    </form>
  <?php
  }
endif;

?>
