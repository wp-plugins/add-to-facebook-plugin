=== Plugin Name ===
Tags: facebook
Tested up to: 2.5.1

This plugin adds a footer link to add the current post or page to a Facebook Mini-Feed.

== Description ==
This plugin adds a footer link to add the current post or page to a Facebook Mini-Feed.  While the plugin is activated a link will appear after the content of the post with the text "Share on Facebook" or the Facebook icon or both. Clicking this link will bring the user to the Facebook site.  If the user isn't logged in they will be prompted to do so. Once logged into Facebook the post will be added to the Mini-Feed of the account.

== Installation ==
1. Add a directory called 'addtofacebook' (without the quotes) to your '/wp-content/plugins/' directory.
2. Upload addtofacebook.php and facebook_share_icon.gif to the '/wp-content/plugins/addtofacebook/' directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.
4. Go to 'Options->Add to Facebook' in your admin interface to select you options.

== Options/Additional Setup ==
There are two options on the options page: Link Type and Insertion Type.

Link Type - This option sets if you want your Facebook link to be text, image or both.

Insertion Type - This option sets how you want to insert the link into your posts/pages.  There are two choices: auto or template.
-Auto - When insertion type is set to auto the Facebook link will automatically be inserted right after the post.
-Template - When insertion type is set to template the Facebook link will appear wherever the template tag for the plugin is added to your theme. This option requires the following template tag to be added to your theme:
<?php if(function_exists(addtofacebook)) : addtofacebook(); endif; ?>