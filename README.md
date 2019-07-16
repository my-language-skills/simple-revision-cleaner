# Simple Revision Cleaner

* Contributors: @colomet, @danzhik, @davideC00
* Donate link: https://opencollective.com/mylanguageskills
* Tags: multisite, revisions, cleaning, optimize, delete, database, wordpress plugin
* Requires at least: 3.0.1
* Tested up to: 5.2.2
* Requires PHP: 5.6
* Stable tag: 1.1.1
* License: GPLv3 or later
* License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
* Gutemberg: compatible

This plugin provides simple handy tool for automatic cleaning database from old, non-relevant revesions on your web-site.

## Description

With use of this plugin you will not longer need to care about clean state of your database because of plenty of revisions. Once the plugin is activated, every time you visit admin dashboard of a site it will automatically detect reveions, which are older then you need, and flush them from database.

## Installation

1. Upload plugin folder to /wp-content/plugins/ folder in your web-site file-system.
1. Activate it from 'Plugins page' in your website.

## Frequently Asked Questions

### Is plugin work influenced if I set the limitation on amount of revesions on my web-site?

No, the plugin only checks the date of revision and if it was created earlier than set expiration date, it will be deleted anyway.

### What is the difference of Network Settings of this plugin and local settings of a site?

The main idea is quite same. The only difference is that with use of Network Settings you can spread the time limit of revision storing over all sites in network, restricting possibility to change it from site settings.

## Screenshots

### Settings page in network administration
![Settings Page Network](/wp-assets/screenshot-1.png)

### Settings page in single site (General Settings page)
![Settings Page](/wp-assets/screenshot-2.png)

### Settings page in single site when option is locked by network administrator (General Settings page)
![Settings Page](/wp-assets/screenshot-3.png)


## Changelog

### 1.1.1
* Additions:
  * Internalization
* Enhancements:
  * Fixed a overwriting bug for the Main Blog

### 1.1.0
* Changed:
  * Notification system removed


### 1.0.1  

* Changed:
  * Names of settings pages
  * Name in sidebar menu
  * Default options values (interval increased from 180 days to 365 days)
  * Defualt WordPress notifications are used in admin now
