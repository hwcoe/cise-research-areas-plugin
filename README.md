# CISE Faculty Listing and Research Areas
Contributors: Allison Logan, Sarah Zachrich Jeng
This plugin is specifically for use with the CISE department website. It allows administrators to display research areas tiled format that also utilizes popups. This plugin may work with other Wordpress templates but that has not been tested. 

It also provides a faculty-pg post template.

## Description
The CISE Faculty Listing and Research Areas plugin has been created specifically for use with the CISE department website. This plugin allows admin to display a tiled list of research areas that, when clicked, pop up with more information and affiliated faculty. Numerous research areas can be added and will alphabetize automatically. The plugin also provides a faculty-pg post template.

The specified category and ACF Field Groups must be used for this plugin to work. The faculty pages need to be individual posts with the faculty-pg category and using the Faculty Single Entry post template. 

## Installation
For help installing this (or any other) WordPress plugin, please read the [Managing Plugins](http://codex.wordpress.org/Managing_Plugins) article on the Codex.

## Implementation
1. Under Posts > Categories, add the "research-areas-pg" and "faculty-pg" categories
2. Activate the plugin
3. Under Posts > Tags, create tags for each of your research areas with -rapg at the end of each one. This will help to separate these tags from your regularly used ones, which is essential.
4. To create a faculty page:
    1. Assign a regular post the "faculty-pg" category. 
    2. Add the specific tags that correspond with their research. 
    3. Assign it the "Faculty Single Entry" post template.
5. To create a Research areas listing, create WP-Show-Posts lists for each of the tags with the following settings
    1. 3 columns (2 columns if there are only two faculty)
    1. Image location above title
    1. Content type: none
    1. No Meta info
    1. Order: Asc
    1. Order by: Slug
6. Under Posts > Add New
    1. Create a separate post for each research area and use the research-areas-pg category
    1. Add content into the “Content Area” including the WP-Show-Posts shortcode in order to show associated faculty.
    1. Make sure to add a feature image. 
7. Add the plugin shortcode to the designated Research Areas page:

[RESEARCH_AREAS type="post" posts_per_page="50" order="ASC" orderby="title" category_name="research-areas-pg"]

## Required Plugins
* [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/)
* [WP Show Posts](https://wordpress.org/plugins/wp-show-posts/)

## Frequently Asked Questions
Can I change the category that the plugin uses?
No. This change has been made within the plugin and there are no settings options.

## Changelog

TODO escaping fields in post template
change plugin name to reflect expanded functionality

v2.0
* Add faculty single post template within plugin (was previously in child theme)
* Load Faculty Page Information and Research Areas Post Options field groups from plugin
* Update styles to match Mercury theme
* Escape ACF get_field calls
* Update plugin title to reflect expanded functionality

v1.0 (2019-03-25) =
* [NEW] Initial release
