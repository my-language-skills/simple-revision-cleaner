# Simple Revision Cleaner
* Contributors: danzhik
* Donate link: 
* Tags: revisions,cleaning
* Requires at least: 3.0.1
* Tested up to: 4.9.6
* Requires PHP: 7.2.0
* Stable tag: 1.0
* License: GNU 3.0
* License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
 
This plugin provides simple handy tool for automatic cleaning database from old, non-relevant revesions on your web-site.
 
## Description 
 
 
    With use of this plugin you will not longer need to care about clean state of your database because of plenty of revisions. Once the plugin is activated, every time you visit admin dashboard of a site it will automatically detect reveions, which are older then you need, and flush them from database.
 
## Installation 
 
1. Upload plugin folder to /wp-content/plugins/ folder in your web-site file-system.
1. Activate it from 'Plugins page' in your website.
 
## Frequently Asked Questions 
 
### How am I notified if some revisions were deleted from datatabase? 

Once some revisions are deeleted, you will get an alert when admin dashboard will be loaded.

### Is plugin work influenced if I set the limitation on amount of revesions on my web-site? 
 
No, the plugin only checks the date of revision and if it was created earlier than set expiration date, it will be deleted anyway.

### What is the difference of Network Settings of this plugin and local settings of a site? 

The main idea is quite same. The only difference is that with use of Network Settings you can spread the time limit of revision storing over all sites in network, restricting possibility to change it from site settings.
 
## Screenshots 

### Settings page in network administration
![Settings Page Network](/assets/screenshot-2.png)
 
### Settings page in single site (General Settings page)
![Settings Page](/assets/screenshot-1.png) 

 
## Changelog 
 

 
## Upgrade Notice 