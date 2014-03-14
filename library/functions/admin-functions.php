<?php

//Admin options
require_once( SP_BASE_DIR . 'library/admin/index.php' );
//meta boxes
require_once( SP_BASE_DIR . 'library/metaboxes/meta-box.php'); 
require_once( SP_BASE_DIR . 'library/metaboxes/meta-options.php'); 

// shortcodes
/*require_once( SP_BASE_DIR . 'library/shortcodes/shortcodes.php');
require_once( SP_BASE_DIR . 'library/shortcodes/visual-shortcodes.php');*/

//Custom post type and taxonomies
require_once( SP_BASE_DIR . 'library/custom-posts/custom-posts.php');

/* ---------------------------------------------------------------------- */
/*	Add SMOF Framework links to WordPress admin bar
/* ---------------------------------------------------------------------- */

if ( ! function_exists( 'smof_admin_bar_render' ) ) {

	function smof_admin_bar_render() {
	
		if ( current_user_can('edit_theme_options') ) {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
			'parent' => false, // use 'false' for a root menu, or pass the ID of the parent menu
			'id' => 'smof_options', // link ID, defaults to a sanitized title value
			'title' => __('Theme Options'), // link title
			'href' => admin_url( 'themes.php?page=optionsframework'), // name of file
			'meta' => false // array of any of the following options: array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
		));
		}
	}

}	
add_action( 'wp_before_admin_bar_render', 'smof_admin_bar_render' );