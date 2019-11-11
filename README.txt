=== Simple Revision Cleaner ===
Contributors: colomet, danzhik, davideC00
Donate link: https://opencollective.com/mylanguageskills
Tags: multisite, revisions, cleaning, optimize, delete, database, wordpress plugin
Requires at least: 3.0.1
Tested up to: 5.3
Requires PHP: 5.6
Stable tag: 1.1.1
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

This plugin provides simple handy tool for automatic cleaning database from old, non-relevant revisions on your web-site.

== Description ==

With use of this plugin you will not longer need to care about clean state of your database because of plenty of revisions. Once the plugin is activated, every time you visit admin dashboard of a site it will automatically detect revisions, which are older then you need, and flush them from database.

**Only works with multisite installation!**

== Installation ==

= This plugin requires: =

* Wordpress Multisite installation

= Installation instructions: =

This section describes how to install the plugin and get it working.

1. Clone (or copy) this repository folder `simple-revision-cleaner
` to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. To configure the time zone, go to Settings in your WordPress Multisite dashboard.

== Frequently Asked Questions ==

= I have a feature request, I've found a bug, a plugin is incompatible... =

Please visit [the support forums](https://wordpress.org/support/plugin/simple-revision-cleaner/)

= I am a developer; how can I help? =

Any input is much appreciated, and everything will be considered.
Please visit the [GitHub project page](https://github.com/my-language-skills/simple-revision-cleaner
) to submit issues or even pull requests.

= Is plugin work influenced if I set the limitation on amount of revesions on my web-site? =

No, the plugin only checks the date of revision and if it was created earlier than set expiration date,
it will be deleted anyway.

= What is the difference of Network Settings of this plugin and local settings of a site? =

The main idea is quite same. The only difference is that with use of Network Settings you can spread the time limit of revision storing over all sites in network, restricting possibility to change it from site settings.

== Screenshots ==

1. Settings page in network administration
2. Settings page in single site (General Settings page).
3. Settings page in single site when option is locked by network administrator (General Settings page)

== Changelog ==
= 1.1.1 =
* Additions: Internalization
* Enhancements: Fixed bug when all the revisions were deleted

= 1.1.0 =
* Changed: Notification system removed
* Enhancements: Fixed bug when all the revisions were deleted

= 1.0.1 =
**Changed:**
* Names of settings pages
* Name in sidebar menu
* Default options values (interval increased from 180 days to 365 days)
* Defualt WordPress notifications are used in admin now

= 1.0 =
* First release


== Upgrade Notice ==

= 1.1.0 =
* Fixed bug, which leaded to deleting of all the revisions

= 1.0.1 =
* Increased default interval of storing revisions to 365 days, default WordPress notifications are used now.

== Disclaimers ==

The Simple Revision Cleaner plugin is supplied "as is" and all use is at your own risk.
