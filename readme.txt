=== WP Post Expiry ===
Contributors: mabfahad
Tags: post expiry, unpublish post, schedule post, auto unpublish, post management
Requires at least: 5.0
Tested up to: 6.5
Requires PHP: 7.2
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Set an expiry date for posts to automatically unpublish them at a scheduled time.

== Description ==

**WP Post Expiry** allows you to assign expiry dates to posts. Once the expiration time is reached, the post will be automatically unpublished (moved to draft). Ideal for time-sensitive content like announcements, sales, or event updates.

**Features:**
- Simple interface in post editor to set expiry date
- Automatically unpublishes expired posts
- Hourly cron-based expiry checks
- Lightweight and fully WordPress-native

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Edit any post and set an expiry date from the meta box.

== Frequently Asked Questions ==

= What happens when a post expires? =
It will be automatically set to "draft" status by the plugin.

= Does this plugin delete expired posts? =
No. It only unpublishes them. You can manually delete if needed.

= How often does the plugin check for expired posts? =
Every hour using WordPress's built-in cron system.

== Screenshots ==

1. Meta box in post editor to set expiry date
2. Settings page (if applicable)

== Changelog ==

= 1.0.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.0 =
First stable release of WP Post Expiry.

== License ==

This plugin is licensed under the GPLv2 or later.

