<?php
/**
 * Theme short codes
 * Containes short codes for layout columns, tabs, accordion, slider, carousel, posts, etc.
 */

add_action( 'wp_enqueue_scripts', 'add_script_style_sc' );

function add_script_style_sc() {
	if(!is_admin()){
		wp_enqueue_script( 'shortcode-js',    SP_BASE_URL . 'library/shortcodes/js/shortcodes.js', array( 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-ui-accordion' ), null, true );
		wp_enqueue_style( 'shortcode', SP_BASE_URL . 'library/shortcodes/css/shortcodes.css', false, '1.0' );
	}
	
}

// Register and initialize short codes
function sp_add_shortcodes() {
	add_shortcode( 'col', 'col' );
	add_shortcode( 'hr', 'sp_hr_shortcode_sc' );
	add_shortcode( 'email_encoder', 'sp_email_encoder_sc' );
	add_shortcode( 'slider', 'sp_slider_sc' );
	add_shortcode( 'accordion', 'sp_accordion_shortcode' );
	add_shortcode( 'accordion_section', 'sp_accordion_section_shortcode' );	
	add_shortcode( 'sc_gallery', 'sp_gallery_sc' );
	
}
add_action( 'init', 'sp_add_shortcodes' );

// Helper function for removing automatic p and br tags from nested short codes
function return_clean( $content, $p_tag = false, $br_tag = false )
{
	$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );

	if ( $br_tag )
		$content = preg_replace( '#<br \/>#', '', $content );

	if ( $p_tag )
		$content = preg_replace( '#<p>|</p>#', '', $content );

	return do_shortcode( shortcode_unautop( trim( $content ) ) );
}

/*--------------------------------------------------------------------------------------*/
/* 	Columns																				*/
/*--------------------------------------------------------------------------------------*/
function col( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'type' => 'full'
	), $atts ) );
	$out = '<div class="column ' . $type . '">' . return_clean( $content ) . '</div>';
	if ( strpos( $type, 'last' ) )
		$out .= '<div class="clear"></div>';
	return $out;
}

/*--------------------------------------------------------------------------------------*/
/* 	Accordion																			*/
/*--------------------------------------------------------------------------------------*/

// Main accordion container
function sp_accordion_shortcode($atts, $content = null) {
	return '<div class="accordion-container clearfix">' . return_clean($content) . '</div>';
}

// Accordion section
function sp_accordion_section_shortcode($atts, $content = null) {

	extract(shortcode_atts(array(
		'title' => 'Title Goes Here',		
	), $atts));

	return '<div class="accordion"><div class="accordion-title"><h5>' . $title . '</h5></div><div class="inner-content-sc">' . return_clean($content) . '</div></div>';
	
}

/*--------------------------------------------------------------------------------------*/
/* 	Devide																				*/
/*--------------------------------------------------------------------------------------*/

function sp_hr_shortcode_sc($atts, $content = null) {
	
	extract(shortcode_atts(array(
		'style' => 'dashed',
		'margin_top' => '40',
		'margin_bottom' => '40',
	), $atts));
	
	return '<hr class="' .$style . '" style="margin-top:' . $margin_top . 'px;margin-bottom:' . $margin_bottom . 'px;" />';
	
}

/*--------------------------------------------------------------------------------------*/
/* 	Email encoder																		*/
/*--------------------------------------------------------------------------------------*/

function sp_email_encoder_sc($atts, $content = null){
	extract(shortcode_atts(array(
		'email' 	=> 'name@domainname.com',
		'subject'	=> 'General Inquirie'
	), $atts));

	return '<a href="mailto:' . antispambot($email) . '?subject=' . $subject . '">' . antispambot($email) . '</a>';
}

/*--------------------------------------------------------------------------------------*/
/* 	Slider 																				*/
/*--------------------------------------------------------------------------------------*/
function sp_slider_sc( $atts, $content = null ){

	extract( shortcode_atts( array(
		'slide_id' => null,
		'slide_num' => null,
	), $atts ) );

	$out = '';
	$args = array(
		'post_type' 		=>	'slider',
		'posts_per_page'	=>	$slide_num,
		'p'					=>	$slide_id
	);

	$custom_query = new WP_Query($args);	
		
	while ($custom_query->have_posts()) :
		$custom_query->the_post();
		$out .= sp_slideshow();
	endwhile;
	wp_reset_postdata(); // Restore global post data

	return $out;

}

/*--------------------------------------------------------------------------------------*/
/* Photogallery
/*--------------------------------------------------------------------------------------*/
function sp_gallery_sc( $atts, $content = null ){

	global $post;

	extract( shortcode_atts( array(
		'gallery_id' => null,
		'gallery_num' => null,
	), $atts ) );

	$out = '';

	$args = array(
		'post_type' 		=>	'gallery',
		'posts_per_page'	=>	$gallery_num,
	);

	$custom_query = new WP_Query( $args );

	if( $custom_query->have_posts() ) :
		$out .= '<div class="cover-album">';
		while ( $custom_query->have_posts() ) : $custom_query->the_post();

			if ( has_post_thumbnail() ):
				$out .= '<div class="one-third">';	
                $out .= '<a href="' . get_permalink() . '">';
                $out .= get_the_post_thumbnail( $post->ID, 'tour-thumb');
                $out .= '<h5>' . get_the_title() . '</h5>';
                $out .= '</a>';
                $out .= '</div>';
            endif;
            
		endwhile; wp_reset_postdata();
		$out .= '</div>';
	endif;

	return $out;

}




