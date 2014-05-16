<?php
/**
 * Plugin Name: Semantic Comments
 * Plugin URI: http://david.shanske.com
 * Description: New Comment Templating that Offers Semantic Webmention Facepiles
 as well as separate Webmentions, Comments, and Trackbacks/Linkbacks. Styling is minimal
 * Version: 0.01
 * Author: David Shanske
 * Author URI: http://david.shanske.com
 * License: CCO
 */


require_once( plugin_dir_path( __FILE__ ) . '/comment-handler.php');

function semantic_comment_template( $comment_template ) {
        return plugin_dir_path( __FILE__ ) . '/comment-display.php';
}

add_filter( "comments_template", "semantic_comment_template" );

function semantic_scripts() {
    wp_enqueue_style( 'comment-style', plugin_dir_url( __FILE__ ) . 'css/comment-style.css');
}

add_action( 'wp_enqueue_scripts', 'semantic_scripts' );


?>
