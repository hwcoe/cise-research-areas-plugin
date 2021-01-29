# Research Areas
Contributors: Allison Logan
This plugin is specifically for use with the CISE Child Theme template. It allows administrators to display research areas tiled format that also utilizes popups. This plugin may work with other Wordpress templates but that has not been tested. 

## Description
The CISE Research Areas plugin has been created specifically for use with the CISE Child Theme. This plugin allows admin to display a tiled list of research areas that, when clicked, pop up with more information and affiliated faculty. Numerous research areas can be added and will alphabetize automatically. 

The specified category and ACF Field Groups must be used for this plugin to work. And the faculty pages need to be individual posts. 

## Installation
For help installing this (or any other) WordPress plugin, please read the [Managing Plugins](http://codex.wordpress.org/Managing_Plugins) article on the Codex.

## Implementation
1. Under Posts > Categories, add the "research-areas-pg" category
1. It is recommended that you update your archive.php file to exclude posts from this category, but it is not required.
1. Upload the field group file located in _Required Files to the ACF plugin
1. Install the plugin
    1. For help installing this (or any other) WordPress plugin, please read the [Managing Plugins](http://codex.wordpress.org/Managing_Plugins) article on the Codex.
1. Under Posts > Tags, create tags for each research area with -rapg at the end of each one. This will help to separate these tags from your regularly used ones, which is essential. 
1. Go to the individual faculty pages and add the specific tags that correspond with their research. 
1. Create WP-Show-Posts lists for each of the tags with the following settings
    1. 3 columns (2 columns if there are only two faculty)
    1. Image location above title
    1. Content type: none
    1. No Meta info
    1. Order: Asc
    1. Order by: Slug
1. Under Posts > Add New
    1. Create a separate post for each research area and use the research-areas-pg category
    1. Add content into the “Content Area” including the WP-Show-Posts shortcode 
    1. Make sure to add a feature image. 
1. Add the plugin shortcode to the designated Research Areas page

## Required Plugins
* [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/)
* [WP Show Posts](https://wordpress.org/plugins/wp-show-posts/)

## Frequently Asked Questions
Can I change the category that the plugin uses?
No. This change has been made within the plugin and there are no settings options.

## Changelog

v1.0 (2019-03-25) =
* [NEW] Initial release
