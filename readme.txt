=== ABC Notation ===
Contributors: paulrosen
Donate link: http://wordpress.paulrosen.net/plugins/abc-notation
Tags: music abc-notation sheet-music abcjs
Requires at least: 4.0
Tested up to: 5.2.2
Stable tag: 5.8.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Include sheet music on your WordPress site by simply specifying the ABC style string.

== Description ==

This includes the abcjs system on your WordPress site. To produce sheet music, put a valid ABC Notation string between the shortcodes [abcjs] and [/abcjs] on your page or post.

This also generates MIDI by using the shortcode [abcjs-midi] and can produce both visual and audio music that is coordinated with [abcjs-audio].

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

There is much written about ABC Notation around the web. You can start [here](http://abcnotation.com)

= What parameters may be used? =

The shortcode can take the same parameters as abcjs. See [the documentation](https://github.com/paulrosen/abcjs/blob/master/api.md) for details.

There is also an interactive way to play with the parameters: [Configurator](https://configurator.abcjs.net).

Here are some examples:

To make the music responsive:
```
[abcjs engraver="{ responsive: 'resize' }"]
... some ABC string ...
[/abcjs]
```

To set or override the tempo:
```
[abcjs-midi midi="{ qpm: 150 }"]
... some ABC string ...
[/abcjs-midi]
```

List of parameters to the `[abcjs]` shortcode:

`[abcjs class="abc-paper"] etc... [/abcjs]` puts the named class on the generated `<svg>` element.

`[abcjs parser="{}" engraver="{}" render="{}"] etc... [/abcjs]` passes the javascript objects straight through to `abcjs.renderAbc`. See the abcjs documentation for details.

`[abcjs file="https://url/to/abc/file"]` loads the string from the specified file instead of the embedded string. You can upload this file using Add New Media or it can reside in any publicly available place.

`[abcjs number_of_tunes=2]` if there are more than one tune in the ABC string, this specifies how many should be printed out. If this is set to more than the number of tunes in the string, that's ok, the additional places are ignored, so if you want to be sure you have all the tunes, then use a high number for this.

List of parameters to the `[abcjs-midi]` shortcode:

`[abcjs-midi class="abc-paper"] etc... [/abcjs-midi]` puts the named class on the generated MIDI element.

`[abcjs-midi parser="{}" midi="{}"] etc... [/abcjs-midi]` passes the javascript objects straight through to `abcjs.renderMidi`. See the abcjs documentation for details.

`[abcjs-midi file="https://url/to/abc/file"] etc... [/abcjs-midi]` loads the string from the specified file instead of the embedded string. You can upload this file using Add New Media or it can reside in any publicly available place.

`[abcjs-midi number_of_tunes=2] etc... [/abcjs-midi]` if there are more than one tune in the ABC string, this specifies how many should be printed out. If this is set to more than the number of tunes in the string, that's ok, the additional places are ignored, so if you want to be sure you have all the tunes, then use a high number for this.

List of parameters to the `[abcjs-audio]` shortcode:

`[abcjs-audio class-paper="abcjs-paper"] etc... [/abcjs-audio]` puts the named class on the generated `<svg>` element.

`[abcjs-audio class-audio="abcjs-audio"] etc... [/abcjs-audio]` puts the named class on the generated MIDI element.

`[abcjs-audio params="{}"] etc... [/abcjs-audio]` passes the javascript objects straight through to `abcjs.renderAbc` and `abcjs.renderMidi`. See the abcjs documentation for details.

`[abcjs-audio file="https://url/to/abc/file"] etc... [/abcjs-audio]` loads the string from the specified file instead of the embedded string. You can upload this file using Add New Media or it can reside in any publicly available place.

`[abcjs-audio number_of_tunes=2] etc... [/abcjs-audio]` if there are more than one tune in the ABC string, this specifies how many should be printed out. If this is set to more than the number of tunes in the string, that's ok, the additional places are ignored, so if you want to be sure you have all the tunes, then use a high number for this.

`[abcjs-audio animate="false"] etc... [/abcjs-audio]` If true, this will cause a cursor to follow the music as it is playing.

`[abcjs-audio qpm="undefined"] etc... [/abcjs-audio]` If this is present, then it sets the beats per minute. If is not set, then the beats per minute is set by the `Q:` line in the ABC string.

= Help! Some characters are not printing properly. =

Try pasting the ABC string in using the "Text" editor instead of the "Visual" editor. That will help keep the quotation marks and any other interpreted characters from being changed by WordPress.

== Thanks ==

Special thanks to http://www.beliefmedia.com/ for the idea to load the ABC string from a file, and for the idea to conditionally load the javascript only if there is a shortcode on the page.

== Upgrade Notice ==

= 5.8.1 =
* Upgrade to use the abcjs 5.8.1 code.
* Add entry point to draw music and audio and animate the audio.

= 5.0.0 =
* Upgrade to use the abcjs 5.0.0 code.

= 4.1.0 =
* Upgrade to use the abcjs 4.1.0 code.

= 3.3.4 =
* Upgrade to use the abcjs 3.3.4 code.

= 3.3.2 =
* Upgrade to use the abcjs 3.3.2 code.
* Add "file" parameter to get the ABC from a separate file.
* Allow files with the extension ".abc" to be uploaded in Add Media.
* Add the "number_of_tunes" parameter to allow more than one tune to be displayed.

= 3.3.0 =
* Upgrade to use the abcjs 3.3.0 code.

= 3.0.1 =
* Upgrade to use the abcjs 3.0.1 code.

= 3.0.0 =
* Upgrade to use the abcjs 3.0 code.

= 2.1 =
* Upgrade to use the abcjs 2.1 code.

* Allow the shortcode to appear inside a <pre> tag.

= 2.0 =
* Upgrade to use the abcjs 2.0 code.

= 1.12.1 =
* Get rid of smart quotes.

= 1.12 =
* Initial version

== Screenshots ==

1. An example of a shortcode and the resultant music that is produced.

== Changelog ==

= 1.12 =
* Initial version of this plugin. (Version numbers are in sync with the version of abcjs that is included.)

= 2.0 =
* Upgrade abcjs version.

= 2.1 =
* Upgrade abcjs version.

= 2.3 =
* Upgrade abcjs version. See https://github.com/paulrosen/abcjs for details.

= 2.3.1 =
* Added entry point for creating MIDI downloads.
* Tested through WP 4.4.

= 3.1.3 =
* Upgrade to use the abcjs 3.1.3 code.
* Add &#8222; as one of the smart quotes.

= 3.1.4 =
* Add parameter to do responsiveness.

= 3.2.0 =
* Add overlay feature
* Bug fixes
* Upgrade to use the abcjs 3.2.0 code.

= 3.2.1 =
* Fix crash when window.performance is not available.
* Fix placement of rests when the stem direction is forced.
* Upgrade to use the abcjs 3.2.0 code.

= 3.3.0 =
* Upgrade to use the abcjs 3.3.0 code.

= 3.3.2 =
* Upgrade to use the abcjs 3.3.2 code.
* Add "file" parameter to get the ABC from a separate file.
* Allow files with the extension ".abc" to be uploaded in Add Media.
* Add the "number_of_tunes" parameter to allow more than one tune to be displayed.

= 3.3.4 =
* Upgrade to use the abcjs 3.3.4 code.

= 4.1.0 =
* Upgrade to use the abcjs 4.1.0 code.

= 5.0.0 =
* Upgrade to use the abcjs 5.0.0 code.

= 5.8.1 =
* Upgrade to use the abcjs 5.8.1 code.
* Add entry point to draw music and audio and animate the audio.

