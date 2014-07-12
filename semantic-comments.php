<?php
/**
 * Plugin Name: Semantic Comments
 * Plugin URI: http://david.shanske.com
 * Description: New Comment Templating that Offers Semantic Webmention Facepiles
 as well as separate Webmentions, Comments, and Trackbacks/Linkbacks. Styling is minimal
 * Version: 0.02
 * Author: David Shanske
 * Author URI: http://david.shanske.com
 * License: CCO
 */


require_once( plugin_dir_path( __FILE__ ) . '/comment-handler.php');
require_once( plugin_dir_path( __FILE__ ) . '/syndication.php');
require_once( plugin_dir_path( __FILE__ ) . '/syn-postmeta.php');


function semantic_comment_template( $comment_template ) {
        return plugin_dir_path( __FILE__ ) . '/comment-display.php';
}

add_filter( "comments_template", "semantic_comment_template" );

function semantic_scripts() {
 // Add Genericons font, for use in the main stylesheet.
        wp_enqueue_style( 'genericons', '//cdn.jsdelivr.net/genericons/3.1/genericons.css', array(), '3.1' );
    wp_enqueue_style( 'comment-style', plugin_dir_url( __FILE__ ) . 'css/comment-style.css');
     wp_enqueue_style( 'syndication-style', plugin_dir_url( __FILE__ ) . 'css/syndication-style.css');	
}

add_action( 'wp_enqueue_scripts', 'semantic_scripts' );
?>
