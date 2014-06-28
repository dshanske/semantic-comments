<?php

function syndication_links() {
   $facebook =  get_post_meta(get_the_ID(), 'sc_fb_url', true);
   $twitter =  get_post_meta(get_the_ID(), 'sc_tw_url', true);
   $gplus =  get_post_meta(get_the_ID(), 'sc_gplus_url', true);
   $instagram =  get_post_meta(get_the_ID(), 'sc_insta_url', true);
   if (!empty($facebook) or !empty($facebook) or !empty($facebook))
       {
         ?><?php
        if ( ! empty($facebook) )
            {
         printf( '<a title="Facebook" class="u-syndication fb" href="%1$s" rel="syndication"></a>',
                esc_url( $facebook )
        );
       }

         if ( ! empty($twitter) )
                {
         printf( '<a title="Twitter" class="u-syndication twitter" href="%1$s" rel="syndication"></a>',
                esc_url( $twitter )
        );
       }
        if ( ! empty($gplus) )
       {
         printf( '<a title="Google Plus" class="u-syndication gplus" href="%1$s" rel="syndication"></a>',
                esc_url( $gplus )
        );
       }
        if ( ! empty($instagram) )
       {
         printf( '<a title="Instagram" class="u-syndication instagram" href="%1$s" rel="syndication"></a>',
                esc_url( $instagram )
        );
       }

    ?><?php
   }
}

function webaction_post () {
  ?>
                <span class="webaction-post"><action do="post" with="<?php the_permalink(); ?>">Share this on:
                    <a class="twitter" href="https://www.twitter.com/intent/tweet?url=<?php urlencode(the_permalink()); ?>&text=<?php urlencode(the_title()); ?>" onclick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Twitter</a>
                    <a class="fb" href="https://www.facebook.com/sharer/sharer.php?u=<?php urlencode(the_permalink()); ?>" target="_blank" onclick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Facebook</a>
                    <a class="gplus" href="https://plus.google.com/share?url=<?php urlencode(the_permalink()); ?>" onclick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Google+</a>

                </action></span>
  <?php
   }



function webaction_repost () {
     $twitter =  get_post_meta(get_the_ID(), 'sc_tw_url', true);
  ?>
                <span class="webaction-repost"><action do="repost" with="<?php the_permalink(); ?>">
                    <a title="Retweet" href="https://www.twitter.com/intent/retweet?tweet_id=<?php echo wp_basename($twitter); ?>" onclick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Repost</a>
                </action></span>
  <?php
   }

function webaction_reply() {
  	$twitter =  get_post_meta(get_the_ID(), 'sc_tw_url', true);
   ?>
                <span class="webaction-reply"><action do="reply" with="<?php the_permalink(); ?>">
                  <a title="Reply on Twitter" href="https://www.twitter.com/intent/tweet?in_reply_to=<?php echo wp_basename($twitter); ?>">Reply</a>
                </action></span>
   <?php
   }

function webaction_props () {
	$twitter =  get_post_meta(get_the_ID(), 'sc_tw_url', true);
   ?>
                <span class="webaction-props"><action do="props" with="<?php the_permalink(); ?>">
                    <a title="Favorite on Twitter" href="https://www.twitter.com/intent/favorite?tweet_id=<?php echo wp_basename($twitter); ?>">Favorite</a>
                </action></span>
  <?php

   }

?>
