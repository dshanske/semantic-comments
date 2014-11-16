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
require_once( plugin_dir_path( __FILE__ ) . '/comment-handler.php');
require_once( plugin_dir_path( __FILE__ ) . '/comment-walker.php');

function semantic_comment_template( $comment_template ) {
        return plugin_dir_path( __FILE__ ) . '/comment-display.php';
}

add_filter( 'wp_list_comments_args', 'wm_comment_args' );
function wm_comment_args( $args ){
    $args['walker']= new Walker_WMComment();
    $args['short_ping'] = true;
    unset($args['callback']);
    unset($args['end-callback']);
    return $args;
}

// add_filter( "comments_template", "semantic_comment_template" );

function semantic_scripts() {
 // Add Genericons font, for use in the main stylesheet.
        // wp_enqueue_style( 'genericons', '//cdn.jsdelivr.net/genericons/3.1/genericons.css', array(), '3.1' );
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

?>
