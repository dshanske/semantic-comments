<?php
/**
 * Plugin Name: Semantic Comments
 * Plugin URI: http://david.shanske.com
 * Description: Additional Comment Handling Options for Semantic Linkbacks
 * Version: 0.1
 * Author: David Shanske
 * Author URI: http://david.shanske.com
 * License: CCO
 */

require_once( plugin_dir_path( __FILE__ ) . '/comment-config.php');
require_once( plugin_dir_path( __FILE__ ) . '/comment-walker.php');

$options = get_option('sc_options');

function semantic_comment_template( $comment_template ) {
        return plugin_dir_path( __FILE__ ) . '/comment-display.php';
}

add_filter( 'wp_list_comments_args', 'wm_comment_args' );
function wm_comment_args( $args ){
    $options = get_option('sc_options');
    if ($options['short_ping']==0)
	{
    	   $args['short_ping'] = true;
        }
    if ($options['comment_walker']==0)
	{
           $args['walker']= new Walker_WMComment();
           unset($args['callback']);
           unset($args['end-callback']);
       }
    return $args;
}

if ($options['template']==0)
   {
     add_filter( "comments_template", "semantic_comment_template" );
   }

function semantic_scripts() {
 // Add Genericons font, for use in the main stylesheet.
        // wp_enqueue_style( 'genericons', '//cdn.jsdelivr.net/genericons/3.1/genericons.css', array(), '3.1' );
	wp_enqueue_script('hovercards', plugin_dir_url( __FILE__ ) . '/js/jquery.hovercard.min.js', array('jquery'), '1.0', 1);
	wp_enqueue_style( 'genericons', plugin_dir_url( __FILE__ ) . '/genericons/genericons.css', array(), null );
    wp_enqueue_style( 'comment-style', plugin_dir_url( __FILE__ ) . 'css/comment-style.css');
}

add_action( 'wp_enqueue_scripts', 'semantic_scripts' );

if (!function_exists('change_avatar_css')) :
function change_avatar_css($class) {
$class = str_replace("class='photo", "class='photo u-photo", $class) ;
return $class;
}
add_filter('get_avatar','change_avatar_css');
endif;

if (!function_exists('webmention_form')) :
  function webmention_form() {
  ?>
     <br />
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

function sc_plugin_notice() {
    if (!class_exists("SemanticLinkbacksPlugin"))
        {
            echo '<div class="error"><p>';
           _e( 'This plugin requires the Semantic Linkbacks Plugin to work properly', 'scomments' );
            echo '</p></div>';
        }
}
add_action( 'admin_notices', 'sc_plugin_notice' );



?>
