
=== Facebook RSS Reader ===
Contributors: muzedon
Donate link: http://www.sangavinomonreale.net/sostieni-san-gavino-monreale-net/
Tags: rss, facebook, feed, atom, images
Requires at least: 3.0.1
Tested up to: 3.6
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple RSS Reader from Facebook page feed.

== Description ==

Simple RSS Reader from Facebook page feed. This widget reads the stream from a Facebook page and allows to easily embed into Wordpress, showing title, description (with image thumb) and date.

It's useful to integrate pages Facebook activity into websites. 


== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place your 'Facebook RSS Reader' widget wherever you want


== Frequently Asked Questions ==

= Does it works with Facebook profiles or groups? =

No, RSS feeds are provided only for Facebook Pages.

= Can I set local format for date field? =

Yes, you have to edit the PHP function setlocale() as explained on http://php.net/manual/en/function.setlocale.php.

= Can I set the size of thumbnails? =

Yes, find row
$entry[$i]->description = str_replace('_s.jpg" ', '_n.jpg" style="width:100%;" ', $entry[$i]->description); 
and comment it to get the 130px standard thumb, or replace 'width:100%' with your preferred size 

== Screenshots ==

1. There are no screenshots

== Changelog ==

= 1.0 =
* First release

== Upgrade Notice ==

= 1.0 =
* First release

