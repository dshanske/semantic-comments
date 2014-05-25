<?php

function syndication_links() {
   $facebook =  get_post_meta(get_the_ID(), 'sc_fb_url', true);
   $twitter =  get_post_meta(get_the_ID(), 'sc_tw_url', true);
   $gplus =  get_post_meta(get_the_ID(), 'sc_gplus_url', true);
   $instagram =  get_post_meta(get_the_ID(), 'sc_insta_url', true);
   if (!empty($facebook) or !empty($facebook) or !empty($facebook))
       {
         ?><span class="syn-links">Shared on <?php
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

    ?></span><?php
   }
}

function webaction_post () {
  ?>
                <li class="webaction-post">Post about this on: <action do="post" with="<?php the_permalink(); ?>">
                    <a href="https://www.twitter.com/intent/tweet?url=<?php urlencode(the_permalink()); ?>&text=<?php urlencode(the_title()); ?>" onclick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Twitter</a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php urlencode(the_permalink()); ?>" target="_blank" onclick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Facebook</a>
                    <a href="https://plus.google.com/share?url=<?php urlencode(the_permalink()); ?>" onclick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Google+</a>

                </action></li>
  <?php
   }



function webaction_repost () {
     $facebook =  get_post_meta(get_the_ID(), 'sc_fb_url', true);
     $twitter =  get_post_meta(get_the_ID(), 'sc_tw_url', true);
     $gplus =  get_post_meta(get_the_ID(), 'sc_gplus_url', true);
     $instagram =  get_post_meta(get_the_ID(), 'sc_insta_url', true);

  ?>
                <li class="webaction-repost">Repost on: <action do="repost" with="<?php the_permalink(); ?>">
                    <a href="https://www.twitter.com/intent/retweet?tweet_id=<?php echo wp_basename($twitter); ?>" onclick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">Twitter</a>
                </action></li>
  <?php
   }

function webaction_reply() {
   	$facebook =  get_post_meta(get_the_ID(), 'sc_fb_url', true);
  	$twitter =  get_post_meta(get_the_ID(), 'sc_tw_url', true);
 	$gplus =  get_post_meta(get_the_ID(), 'sc_gplus_url', true);
 	$instagram =  get_post_meta(get_the_ID(), 'sc_insta_url', true);

   ?>
                <li class="webaction-reply">Reply on: <action do="reply" with="<?php the_permalink(); ?>">
                  <a href="https://www.twitter.com/intent/tweet?in_reply_to=<?php echo wp_basename($twitter); ?>">Twitter</a>
                </action></li>
   <?php
   }

function webaction_props () {
        $facebook =  get_post_meta(get_the_ID(), 'sc_fb_url', true);
	$twitter =  get_post_meta(get_the_ID(), 'sc_tw_url', true);
	$gplus =  get_post_meta(get_the_ID(), 'sc_gplus_url', true);
   	$instagram =  get_post_meta(get_the_ID(), 'sc_insta_url', true);

   ?>
                <li class="webaction-props">Like/Favorite on: <action do="props" with="<?php the_permalink(); ?>">
                    <a href="https://www.twitter.com/intent/favorite?tweet_id=<?php echo wp_basename($twitter); ?>">Twitter</a>
                </action></li>
  <?php

   }

function embed_facebook ($url)
   {
	if (strpos($url,'https://www.facebook.com/') !== false) {

       ?>
   		<div id="fb-root"></div> 
          <script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/en_US/all.js#xfbml=1"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>
          <div class="fb-post" data-href="<?php echo esc_url($url);?> " data-width="466"><div class="fb-xfbml-parse-ignore"><a href="<?php echo esc_url($url) ;?> ">Post</a></div></div>
     <?php
      }
   }

function embed_gplus ($url)
   { 
	if (strpos($url,'https://plus.google.com/') !== false) {
   ?>
		<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
		<div class="g-post" data-href="<?php echo esc_url($url); ?>"></div>
      <?php
     }
   }

function embed_instagram ($url)
   {
    if (strpos($lurl,'https://instagram.com/') !== false) {

   ?>
	<iframe src="<?php echo esc_url($url); ?>embed" width="612" height="710" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
    <?php 
     }
   }

function embed_twitter ($url)
   {
	 if (strpos($url,'https://twitter.com/') !== false) {
                        echo wp_oembed_get($url);
          }
   }

?>

