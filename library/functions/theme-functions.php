<?php

/* ---------------------------------------------------------------------- */
/*	Get Post Thumbnail
/* ---------------------------------------------------------------------- */
if( !function_exists('sp_post_thumbnail') ) {

	function sp_post_thumbnail($size = 'thumbnail'){
		global $post;
		$thumb = '';
		
		//get the post thumbnail;
		$thumb_id = get_post_thumbnail_id($post->ID);
		$thumb_url = wp_get_attachment_image_src($thumb_id, $size);
		$thumb = $thumb_url[0];
		if ($thumb) return $thumb;
	}
		

}

/* ---------------------------------------------------------------------- */
/*	Thumnail for social share
/* ---------------------------------------------------------------------- */

if ( !function_exists('sp_facebook_thumb') ) {

	function sp_facebook_thumb() {
		if ( is_singular( 'sp_work' ) ) {
			global $post;

			$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail');
			echo '<meta property="og:image" content="' . esc_attr($thumbnail_src[0]) . '" />';
		}
	}

	add_action('wp_head', 'sp_facebook_thumb');
}

/* ---------------------------------------------------------------------- */
/*	Add User Browser and OS Classes in Body Class
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_browser_body_class') ) {
	function sp_browser_body_class($classes) {
	        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	        if($is_lynx) $classes[] = 'lynx';
	        elseif($is_gecko) $classes[] = 'gecko';
	        elseif($is_opera) $classes[] = 'opera';
	        elseif($is_NS4) $classes[] = 'ns4';
	        elseif($is_safari) $classes[] = 'safari';
	        elseif($is_chrome) $classes[] = 'chrome';
	        elseif($is_IE) {
	                $classes[] = 'ie';
	                if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
	                $classes[] = 'ie'.$browser_version[1];
	        } else $classes[] = 'unknown';
	        if($is_iphone) $classes[] = 'iphone';
	        if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
	                 $classes[] = 'osx';
	           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
	                 $classes[] = 'linux';
	           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
	                 $classes[] = 'windows';
	           }
	        return $classes;
	}
	add_filter('body_class','sp_browser_body_class');
}
