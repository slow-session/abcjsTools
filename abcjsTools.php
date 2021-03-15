<?php
/*
Plugin Name: ABCJS Tools
Plugin URI: https://github.com/slow-session/abcjsTools
Description: Include sheet music on your WordPress site by simply specifying the ABC style string in the shortcode <strong>[abc-music]</strong>. Also supports the new audio player in ABCJS 6.0.0 using <strong>[abc-player]</strong> and a simple ABC editor using <strong>[abc-editor]</strong>. Heavily derived from the Paul Rosen's <a href="https://wordpress.paulrosen.net/plugins/abc-notation">ABC Notation</a> plugin.
Version: 0.0.1
Author:  Andy Linton
Author URI: https://github.com/asjl
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/*
Copyright (C) 2021 Andy Linton

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

//
//-- Add the javascript and css if there is a shortcode on the page.
//
function abcjs_conditionally_load_resources( $posts ) {

	if ( empty( $posts ) ) {
		return $posts;
	}
	$has_abcjs = false;
	foreach ( $posts as $post ) {
		if ( stripos( $post->post_content, '[abc-' ) !== false ) {
			$has_abcjs = true;
			break;
		}
	}
	if ( $has_abcjs ) {
	    wp_enqueue_script( 'abcjs-font-awesome', 'https://use.fontawesome.com/b8d1222982.js' );
		wp_enqueue_script( 'abcjs-plugin', plugins_url( '/js/abcjs-basic-min.js', __FILE__ ));
	 	wp_enqueue_script( 'abcjsTools', plugins_url( '/js/abcjsTools.js', __FILE__ ));

		$plugin_url = plugin_dir_url( __FILE__ );
	        wp_enqueue_style( 'style1', $plugin_url . 'abcjs-audio.css' );
	}

	return $posts;
}

add_filter( 'the_posts', 'abcjs_conditionally_load_resources' );

// This turns the shortcode parameter back into the originally pasted string.
function process_abc( $content ) {
	$content2 = preg_replace("&<br />\r\n&", "\x01", $content);
	$content2 = preg_replace("&<br />\n&", "\x01", $content2);
	$content2 = preg_replace("&<br>\r\n&", "\x01", $content2);
	$content2 = preg_replace("&<br>\n&", "\x01", $content2);
	$content2 = preg_replace("&\r\n&", "\x01", $content2);
	$content2 = preg_replace("&\n&", "\x01", $content2);
	$content2 = preg_replace("-\"-", "\\\"", $content2);
	$content2 = preg_replace("-&#8221;-", "\\\"", $content2);
	$content2 = preg_replace("-&#8222;-", "\\\"", $content2);
	$content2 = preg_replace("-&#8217;-", "'", $content2);
	$content2 = preg_replace("-&#8243;-", "\\\"", $content2);
	$content2 = preg_replace("-&#8220;-", "\\\"", $content2);
	$content2 = preg_replace("-'-", "\\\'", $content2);
	return $content2;
}

//
//-- Interpret the [abcjs] shortcode
//
function abcjs_create_music( $atts, $content ) {
    $content2 = process_abc($content);

    $wrapperID = 'abc-wrapper-' . uniqid();

    $output = '<!-- Start of ABC + player code -->' . "\n";
    $output .= '<div id="' . $wrapperID . '"></div>' . "\n";
    $output .= '<script type="text/javascript">' . "\n";
    $output .= 'abcjsTools.displayABCmusic("' . $wrapperID . '", "' . $content2 . '");' . "\n";
    $output .= '</script>' . "\n";
    $output .= '<!-- End of ABC + player code -->' . "\n";
    
    return $output;
}
add_shortcode( 'abc-music', 'abcjs_create_music' );

//
//-- Interpret the [abcjs-player] shortcode
//
function abcjs_create_player( $atts, $content ) {
    $content2 = process_abc($content);
    
    $wrapperID = 'abc-wrapper-' . uniqid();

    $output = '<!-- Start of ABC + player code -->' . "\n";
    $output .= '<div id="' . $wrapperID . '"></div>' . "\n";
    $output .= '<script type="text/javascript">' . "\n";
    $output .= 'abcjsTools.displayABCplayer("' . $wrapperID . '", "' . $content2 . '");' . "\n";
    $output .= '</script>' . "\n";
    $output .= '<!-- End of ABC + player code -->' . "\n";
    
    return $output;
}
add_shortcode( 'abc-player', 'abcjs_create_player' );

//
//-- Interpret the [abcjs-editor] shortcode
//
function abcjs_create_editor( $atts, $content ) {
    $content2 = process_abc($content);
    
    $wrapperID = 'abc-wrapper-' . uniqid();

    $output = '<!-- Start of ABC + player code -->' . "\n";
    $output .= '<div id="' . $wrapperID . '"></div>' . "\n";
    $output .= '<script type="text/javascript">' . "\n";
    $output .= 'abcjsTools.displayABCeditor("' . $wrapperID . '", "' . $content2 . '");' . "\n";
    $output .= '</script>' . "\n";
    $output .= '<!-- End of ABC + player code -->' . "\n";
    
    return $output;
}
add_shortcode( 'abc-editor', 'abcjs_create_editor' );
