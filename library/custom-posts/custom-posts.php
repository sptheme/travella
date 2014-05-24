<?php

//All custom posts
require_once( SP_BASE_DIR . 'library/custom-posts/cp-slider.php' );
require_once( SP_BASE_DIR . 'library/custom-posts/cp-tour.php' );
require_once( SP_BASE_DIR . 'library/custom-posts/cp-accommodation.php' );
require_once( SP_BASE_DIR . 'library/custom-posts/cp-hotel.php' );
require_once( SP_BASE_DIR . 'library/custom-posts/cp-faq.php' );
require_once( SP_BASE_DIR . 'library/custom-posts/cp-testimonial.php' );

//Taxonomies
require_once( SP_BASE_DIR . 'library/custom-posts/taxonomy-tour.php' );
require_once( SP_BASE_DIR . 'library/custom-posts/taxonomy-destination.php' );
require_once( SP_BASE_DIR . 'library/custom-posts/taxonomy-faq.php' );
	
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

		if ( 'faq' == $screen->post_type )
			$title = __( "Question title", 'sptheme_admin' );

		return $title;
	}
} // /sp_change_new_post_title