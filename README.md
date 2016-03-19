# Semantic Comments #

**Contributors:** dshanske  
**Tags:** indieweb, webmention, comments  
**Requires at least:**  
**Tested up to:**  
**Stable tag:**  

## Description ##

Semantic Comments improves comment handling in WordPress to take advantage of [Webmentions](https://github.com/pfefferle/wordpress-webmention) and the [Semantic Linkbacks Plugin](https://github.com/pfefferle/wordpress-semantic-linkbacks). 

This includes several ways to display comments, including a Facepile.  

This WordPress plugin is meant to be used in combination with the [WordPress IndieWeb plugin](https://github.com/indieweb/wordpress-indieweb).

## Notes ##

As of now, pagination for comments should be adjusted as it will affect the mention display as well.

## Usage ##

Semantic Comments adds a custom comment walker that can be used to change the display of comments to support webmentions.

Semantic Comments offers a comment template with limited styling so it should inherit from your theme, as well as adjustable avatar sizes. 

All configuration options are enabled by default, but can be selectively disabled for more control by the theme. 

## Changelog ##

Version 0.1 - Complete rewrite of Display Code to be less intrusive in relation to the theme, addition of Settings Page under Comments.

Version 0.03 - Post Meta Boxes and function to display has been forked into a new plugin. Webactions have also been removed. This plugin will revert to only comment display for now.

Version 0.02 - Adds Post Meta Boxes for Syndication URLs for the 4 major syndication sites (supported by [Bridgy](https://brid.gy/)), add function to display these, add Twitter/Facebook/Google Plus/Instagram embed code functions, remove comment form in favor of webmention form and start of webactions section. 

Version 0.01 - Replaces the Comments Template with one that has separate function calls for Webmentions, Comments, and Pingbacks/Trackbacks. The Webmentions are displayed using a Facepile.
