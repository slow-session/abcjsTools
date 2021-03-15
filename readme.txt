=== ABCJS Tools ===
Contributors: asjl
Tags: music abc-notation sheet-music abcjs editor
Requires at least: 4.0
Tested up to: 5.7
Stable tag: 0.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Include sheet music on your WordPress site by simply specifying the ABC style string.

== Description ==

This includes the abcjs system on your WordPress site. To produce sheet music, put a valid ABC Notation string between the shortcodes [abc-music] and [/abc-music] on your page or post.

You can also display music with the audio player available in abcjs version 6.0.0 using the shortcodes [abc-player] and [/abc-player].

If you want a simple ABC editor on your WordPress page then including the tags [abc-editor] and [/abc-editor] will a 'textarea' on the page where you can input ABC notation.

* Use with CAUTION!! No guarantees whatsoever!!

== Installation ==

1. Upload this folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Click 'Settings' in the dashboard, then 'ABC Notation' to customize.

== Frequently Asked Questions ==

= Where can this be used? =

Anywhere that shortcodes are accepted. That is, on pages, post, and widgets. It will not work on comments.

= How does it work? =

The plugin includes the [abcjs](http://abcjs.net/) JavaScript library. The string that is put in the shortcode is passed to that library, which translates it and renders it in an SVG element that it places on the page instead of the shortcode.

= What can be put in the ABC string that is placed in the shortcode? =

There is much written about ABC Notation around the web. You can start [here](http://abcjsTools.com)

== Thanks ==

To Paul Rosen for his work on ABCJS and in particular on the ABC Notation plugin. The plugin has many more features that this software but was overkill for what I needed!

== Upgrade Notice ==

= 0.0.1 =
* First version - unlikely ever to be an official WordPress plugin. 
