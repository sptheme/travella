<?php

//All custom posts
require_once( SP_BASE_DIR . 'library/custom-posts/cp-tour.php' );

//Taxonomies
require_once( SP_BASE_DIR . 'library/custom-posts/taxonomy-tour.php' );
require_once( SP_BASE_DIR . 'library/custom-posts/taxonomy-destination.php' );
	
/*==========================================================================*/

//Change title text when creating new post
if ( is_admin() )
	add_filter( 'enter_title_here', 'sp_change_new_post_title' );	
	
/*
* Changes "Enter title here" text when creating new post
*/
if ( ! function_exists( 'sp_change_new_post_title' ) ) {
	function sp_change_new_post_title( $title ){
		$screen = get_current_screen();

		if ( 'tour' == $screen->post_type )
			$title = __( "Tour title", 'sptheme_admin' );

		return $title;
	}
} // /sp_change_new_post_title