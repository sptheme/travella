<?php
/**
 * Theme short codes
 * Containes short codes for layout columns, tabs, accordion, slider, carousel, posts, etc.
 */

add_action( 'wp_enqueue_scripts', 'add_script_style_sc' );

function add_script_style_sc() {
	if(!is_admin()){
		wp_enqueue_script( 'shortcode-js',    SP_BASE_URL . 'library/shortcodes/js/shortcodes.js', array( 'jquery-ui-core', 'jquery-ui-tabs', 'jquery-ui-accordion', 'custom-scripts' ), null, true );
		wp_enqueue_style( 'shortcode', SP_BASE_URL . 'library/shortcodes/css/shortcodes.css', false, '1.0' );
	}
	
}

// Register and initialize short codes
function sp_add_shortcodes() {
	add_shortcode( 'col', 'col' );
	add_shortcode( 'hr', 'sp_hr_shortcode_sc' );
	add_shortcode( 'email_encoder', 'sp_email_encoder_sc' );
	add_shortcode( 'slider', 'sp_slider_sc' );
	add_shortcode( 'portfolio', 'sp_portfolio_sc' );
	add_shortcode( 'biographies', 'sp_biography_sc' );
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

function sp_portfolio_sc( $atts, $content = null ){
	
	global $post;

	extract( shortcode_atts( array(
		'category_id'		=> null
	), $atts ) );

	$out = '';
	$cols = 1;
	$args = array(
		'post_type' => 'work',
		'tax_query' => array(
			array(
				'taxonomy' => 'work-category',
				'field' => 'term_id',
				'terms' => $category_id
			)
		)
	);

	$custom_query = new WP_Query($args);
	$out .= '<ul class="project-grid clearfix">';
	while ($custom_query->have_posts()) :
			$custom_query->the_post();
		
		$location = get_post_meta( $post->ID, 'sp_work_location', true );
		$date = get_post_meta( $post->ID, 'sp_work_date', true );
		
		$thumb = '';
		$thumb_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'work-thumb');
		$thumb = $thumb_url[0];

		$out .= '<li>';
		if ( has_post_thumbnail() ) {
			$out .= '<figure>';
			$out .= '<a class="zoom" href="' . get_permalink() . '"></a>';
			$out .= '<div class="media-container"></div>';
			$out .= '<img src="' . $thumb . '" />';
			$out .= '</figure>';
		}	
		$out .= '<h5><a href="' . get_permalink() . '">' . get_the_title() . '</a></h5>';
		$out .= '<div class="item-info">' . $location . ' - ' . $date . '</div>';
		$out .= '</li>';

		$cols++;

	endwhile;
	//wp_reset_postdata(); // Restore global post data

	$out .= '</ul>';	

	return $out;
}

function sp_biography_sc( $atts, $content = null ){

	extract( shortcode_atts( array(), $atts ) );

	$out = '';
	$args = array(
        'type' => 'biography',
        'orderby' => 'id',
        'taxonomy' => 'biography-categories'
    );
    $bio_categories = get_categories( $args );
    foreach ($bio_categories as $category) {
		
		if($category->parent < 1){
			if (!has_children($category->cat_ID, 'biography-categories')){
				$out .= '<h3>' . $category->name . '</h3>';
				$args = array('post_type' => 'biography', 'posts_per_page' => -1, 'biography-categories' => $category->slug);
				query_posts( $args );
				
				$out .= '<ul class="bio clearfix">';
				if (have_posts()) : while(have_posts()) : the_post();
					$out .= '<li class="one-third">' . get_the_title() . '</li>';
					$out .= '<li class="two-third last">' . get_the_content() . '</li>';
				endwhile; endif; wp_reset_query();
				$out .= '</ul>';
			} else{
				$out .= '<h3>' . $category->name . '</h3>';
				$terms = get_terms($category->taxonomy, array('child_of' => $category->term_id));
				
				foreach ($terms as $sub_cat) {
					$out .= '<h5>' . $sub_cat->name . '</h5>';
					$args = array('post_type' => 'biography', 'posts_per_page' => -1, 'biography-categories' => $sub_cat->slug);
					query_posts( $args );
				
					$out .= '<ul class="bio clearfix">';
					if (have_posts()) : while(have_posts()) : the_post();
						$out .= '<li class="one-third">' . get_the_title() . '</li>';
						$out .= '<li class="two-third last">' . get_the_content() . '</li>';
					endwhile; endif; wp_reset_query();
					$out .= '</ul>';
				}
			}
		}		
    }

	return $out;

}

function has_children($cat_id, $taxonomy) {
    $children = get_terms(
        $taxonomy,
        array( 'parent' => $cat_id, 'hide_empty' => false )
    );
    if ($children){
        return true;
    }
    return false;
}

function category_has_parent($catid){
    $category = get_category($catid);
    if ($category->category_parent > 0){
        return true;
    }
    return false;
}




