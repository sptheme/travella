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

/* ---------------------------------------------------------------------- */
/*	Tour meta
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_tour_meta') ) {
	function sp_tour_meta(){
		global $post;

		$out = ''; $dests = ''; $types = '';
		$tours_day = get_post_meta( $post->ID, 'sp_day', true ); 
		$duration = get_post_meta( $post->ID, 'sp_duration', true ); 
		$departure = get_post_meta( $post->ID, 'sp_departure', true ); 
		$overview = get_post_meta( $post->ID, 'sp_overview', true ); 
		$tour_type = wp_get_post_terms( $post->ID, 'tour-type' );
		$destinations = wp_get_post_terms( $post->ID, 'destination' );

		$out .= '<ul class="tour-meta">';
		$out .= '<li><span class="meta-label">' . esc_attr__( 'Duration: ', SP_TEXT_DOMAIN ) . '</span>';
		$out .= '<span class="meta-value">' . sprintf( esc_attr__( '%1$s days / %2$s night', SP_TEXT_DOMAIN ),
			 $tours_day,
			 $tours_day - 1 ) . '</span></li>';
		
		$out .= '<li><span class="meta-label">' . esc_attr__( 'Destination: ', SP_TEXT_DOMAIN ) . '</span>';
		$out .=	'<span class="meta-value">'; 
		foreach ($destinations as $destination) {
			$dests .= $destination->name . ', ';
		}
		$out .= rtrim($dests, ', ') . '</span></li>';
		
		$out .= '<li><span class="meta-label">' . esc_attr__( 'Departure: ', SP_TEXT_DOMAIN ) . '</span>';
		$out .= '<span class="meta-value">' . esc_attr__( $departure ) . '</span></li>';

		$out .= '<li><span class="meta-label">' . esc_attr__( 'Type: ', SP_TEXT_DOMAIN ) . '</span>';
		$out .=	'<span class="meta-value">'; 
		foreach ($tour_type as $type) {
			$types .= $type->name . ', ';
		}
		$out .= rtrim($types, ', ') . '</span></li>';

		$out .= '<li class="overview">' . $overview . '</li>';

		$out .= '</ul>';

		echo $out;
	}
}
