<?php
/*
Plugin Name: ABCJS Tools
Plugin URI: http://wordpress.paulrosen.net/plugins/abc-notation
Description: Include sheet music on your WordPress site by simply specifying the ABC style string in the shortcode <strong>[abcjs]</strong>. For a complete description of the syntax, see the <a href="http://wordpress.paulrosen.net/plugins/abc-notation">Plugin Site</a>.
Version: 6.0.0
Author: Paul Rosen
Author URI: http://paulrosen.net
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

/*
Copyright (C) 2015-2019 Paul Rosen

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
//-- Allow upload of .abc files in "Add Media"
//
function abcjs_upload_mimes($mimes = array()) {

	// Add a key and value for the ABC file type
	$mimes['abc'] = "text/abc";

	return $mimes;
}

add_action('upload_mimes', 'abcjs_upload_mimes');

//
//-- Add the javascript and css if there is a shortcode on the page.
//
function abcjs_conditionally_load_resources( $posts ) {

	if ( empty( $posts ) ) {
		return $posts;
	}
	$has_abcjs = false;
	foreach ( $posts as $post ) {
		if ( stripos( $post->post_content, '[abcjs' ) !== false ) {
			$has_abcjs = true;
			break;
		}
	}
	if ( $has_abcjs ) {
	    wp_enqueue_script( 'abcjs-font-awesome', 'https://use.fontawesome.com/b8d1222982.js' );
		wp_enqueue_script( 'abcjs-plugin', plugins_url( '/js/abcjs-basic-min.js', __FILE__ ));
	 	wp_enqueue_script( 'abc-notation', plugins_url( '/js/abc-notation.js', __FILE__ ));

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

// If a URL was passed in, then read the string from that, otherwise read the string from the contents.
function get_abc_string( $file, $content) {
	if ($file) {
		$content2 = file_get_contents( $file );
		$content2 = preg_replace("&\r\n&", "\x01", $content2);
		$content2 = preg_replace("&\n&", "\x01", $content2);
		$content2 = preg_replace("-'-", "\\\'", $content2);
		$content2 = preg_replace("-\"-", "\\\"", $content2);
	} else
		$content2 = process_abc($content);
	return $content2;
}

//
//-- Interpret the [abcjs] shortcode
//
function abcjs_create_music( $atts, $content ) {
    $a = shortcode_atts( array(
	    'file' => '',
	), $atts );

    $content2 = get_abc_string($a['file'], $content);
    
    $wrapperID = 'abc-wrapper-' . uniqid();

    $output = '<!-- Start of ABC + player code -->' . "\n";
    $output .= '<div id="' . $wrapperID . '"></div>' . "\n";
    $output .= '<script type="text/javascript">' . "\n";
    $output .= 'abcjsTools.displayABCmusic("' . $wrapperID . '", "' . $content2 . '");' . "\n";
    $output .= '</script>' . "\n";
    $output .= '<!-- End of ABC + player code -->' . "\n";
    
    return $output;
}
add_shortcode( 'abcjs', 'abcjs_create_music' );

//
//-- Interpret the [abcjs-player] shortcode
//
function abcjs_create_player( $atts, $content ) {
    $a = shortcode_atts( array(
	    'file' => '',
	), $atts );

    $content2 = get_abc_string($a['file'], $content);
    
    $wrapperID = 'abc-wrapper-' . uniqid();

    $output = '<!-- Start of ABC + player code -->' . "\n";
    $output .= '<div id="' . $wrapperID . '"></div>' . "\n";
    $output .= '<script type="text/javascript">' . "\n";
    $output .= 'abcjsTools.displayABCplayer("' . $wrapperID . '", "' . $content2 . '");' . "\n";
    $output .= '</script>' . "\n";
    $output .= '<!-- End of ABC + player code -->' . "\n";
    
    return $output;
}
add_shortcode( 'abcjs-player', 'abcjs_create_player' );

//
//-- Interpret the [abcjs-editor] shortcode
//
function abcjs_create_editor( $atts, $content ) {
    $a = shortcode_atts( array(
	    'file' => '',
	), $atts );

    $content2 = get_abc_string($a['file'], $content);
    
    $wrapperID = 'abc-wrapper-' . uniqid();

    $output = '<!-- Start of ABC + player code -->' . "\n";
    $output .= '<div id="' . $wrapperID . '"></div>' . "\n";
    $output .= '<script type="text/javascript">' . "\n";
    $output .= 'abcjsTools.displayABCeditor("' . $wrapperID . '", "' . $content2 . '");' . "\n";
    $output .= '</script>' . "\n";
    $output .= '<!-- End of ABC + player code -->' . "\n";
    
    return $output;
}
add_shortcode( 'abcjs-editor', 'abcjs_create_editor' );
