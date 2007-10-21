<?php
/*
Plugin Name: Add To Facebook
Version: 1.1
Plugin URI: http://nothing.golddave.com/
Description: Adds a footer link to add the current post or page to a Facebook Mini-Feed.
Author: David Goldstein
Author URI: http://nothing.golddave.com/
*/

/*
Change Log

1.1
  * Added options page to choose between text/image links.

1.0
  * First public release.
*/

function add_to_facebook($data){
	global $post;
	$current_options = get_option('add_to_facebook_options');
	$linktype = $current_options['link_type'];
	switch ($linktype) {
		case "text":
			$data=$data."<p><a href=\"http://www.facebook.com/share.php?u=".get_permalink($post->ID)."\">Share on Facebook</a></p>";
			break;
		case "image":
			$data=$data."<p><a href=\"http://www.facebook.com/share.php?u=".get_permalink($post->ID)."\"><img src=\"".get_bloginfo(wpurl)."/wp-content/plugins/facebook_share_icon.gif\" alt=\"Share on Facebook\"></a></p>";
			break;
		case "both":
			$data=$data."<p><a href=\"http://www.facebook.com/share.php?u=".get_permalink($post->ID)."\"><img src=\"".get_bloginfo(wpurl)."/wp-content/plugins/facebook_share_icon.gif\" alt=\"Share on Facebook\"></a> <a href=\"http://www.facebook.com/share.php?u=".get_permalink($post->ID)."\">Share on Facebook</a></p>";
			break;
		}
		return $data;
}

add_filter('the_content', 'add_to_facebook');
add_filter('the_excerpt', 'add_to_facebook');

// Create the options page
function add_to_facebook_options_page() { 
	$current_options = get_option('add_to_facebook_options');
	$type = $current_options["link_type"];
	if ($_POST['action']){ ?>
		<div id="message" class="updated fade"><p><strong>Options saved.</strong></p></div>
	<?php } ?>
	<div class="wrap" id="add-to-facebook-options">
		<h2>Add to Facebook Options</h2>
		
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']; ?>">
			<fieldset>
				<legend>Options:</legend>
				<input type="hidden" name="action" value="save_options" />
				<table width="100%" cellspacing="2" cellpadding="5" class="editform">
					<tr>
						<th valign="top" scope="row"><label for="link_type">Link Type:</label></th>
						<td><select name="link_type">
						<option value ="text"<?php if ($type == "text") { print " selected"; } ?>>Text Only</option>
						<option value ="image"<?php if ($type == "image") { print " selected"; } ?>>Image Only</option>
						<option value ="both"<?php if ($type == "both") { print " selected"; } ?>>Image and Text</option>
						</select></td>
					</tr>
				</table>
			</fieldset>
			<p class="submit">
				<input type="submit" name="Submit" value="Update Options &raquo;" />
			</p>
		</form>
	</div>
<?php 
}

function add_to_facebook_add_options_page() {
	// Add a new menu under Options:
	add_options_page('Add to Facebook', 'Add to Facebook', 10, __FILE__, 'add_to_facebook_options_page');
}

function add_to_facebook_save_options() {
	// create array
	$add_to_facebook_options["link_type"] = $_POST["link_type"];
	
	update_option('add_to_facebook_options', $add_to_facebook_options);
	$options_saved = true;
}

add_action('admin_menu', 'add_to_facebook_add_options_page');

if (!get_option('add_to_facebook_options')){
	// create default options
	$add_to_facebook_options["link_type"] = 'text';
	
	update_option('add_to_facebook_options', $add_to_facebook_options);
}

if ($_POST['action'] == 'save_options'){
	add_to_facebook_save_options();
}

?>