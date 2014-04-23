<?php

/* ---------------------------------------------------------------------- */
/*	Custom Excerpt Length
/* ---------------------------------------------------------------------- */
if (!function_exists('sp_excerpt_length')) {

	function sp_excerpt_length($length) {
		return 30;
	}
	
	add_filter('excerpt_length', 'sp_excerpt_length');

}

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
/*	Print tour meta data
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_tour_meta') ) {
	function sp_tour_meta(){

		$out = '';
		$tours_day = get_post_meta( get_the_ID(), 'sp_day', true ); 
		$duration = get_post_meta( get_the_ID(), 'sp_duration', true ); 
		$departure = get_post_meta( get_the_ID(), 'sp_departure', true );
		$price_id = get_post_meta( get_the_ID(), 'sp_tour_price', true );

		$out .= '<ul>';
		$out .= '<li><span class="meta-label">' . esc_attr__( 'Duration: ', SP_TEXT_DOMAIN ) . '</span>';
		$out .= '<span class="meta-value">' . sprintf( esc_attr__( '%1$s days / %2$s night', SP_TEXT_DOMAIN ),
			 $tours_day + 1,
			 $tours_day) . '</span></li>';
		
		$out .= '<li><span class="meta-label">' . esc_attr__( 'Destination: ', SP_TEXT_DOMAIN ) . '</span>';
		$out .=	sp_get_tour_destination();
		$out .= '</li>';
		
		$out .= '<li><span class="meta-label">' . esc_attr__( 'Departure: ', SP_TEXT_DOMAIN ) . '</span>';
		$out .= '<span class="meta-value">' . esc_attr__( $departure ) . '</span></li>';

		$out .= '<li><span class="meta-label">' . esc_attr__( 'Type: ', SP_TEXT_DOMAIN ) . '</span>';
		$out .=	sp_get_tour_type();
		$out .= '</li>';

		//$out .= '<li class="overview">' . $overview . '</li>';
		$out .= '<li>prices: ' . sp_get_tour_rate($price_id, 'min') . '</li>';
		$out .= '<li><a class="open-booking-form" href="#booking-form">' . esc_attr__( 'Booking', SP_TEXT_DOMAIN ) . '</a></li>';

		$out .= '</ul>';

		return $out;
	}
}

/* ---------------------------------------------------------------------- */
/*	Get tour destination
/* ---------------------------------------------------------------------- */
if ( !function_exists( 'sp_get_tour_destination' ) ){

	function sp_get_tour_destination(){
		$destinations = wp_get_post_terms( get_the_ID(), 'destination' );
		foreach ($destinations as $term) {
			$dests[] = $term->name;
		}
		$out = implode(', ', $dests);
		return $out;
	}

}

/* ---------------------------------------------------------------------- */
/*	Get tour type
/* ---------------------------------------------------------------------- */
if ( !function_exists( 'sp_get_tour_type' ) ){

	function sp_get_tour_type(){
		$tour_type = wp_get_post_terms( get_the_ID(), 'tour-type' );
		foreach ($tour_type as $type) {
			$types[] = $type->name;
		}
		$out = implode(', ', $types);
		return $out;
	}

}

/* ---------------------------------------------------------------------- */
/*	Print tour photos
/* ---------------------------------------------------------------------- */
if ( !function_exists( 'sp_tour_photos' )){
	function sp_tour_photos(){
		
		$out = '';
		$tour_photos = rwmb_meta( 'sp_tour_potos', $args = array('type' => 'plupload_image', 'size' => 'tour-mini') ); 

		if ( $tour_photos ){
			$out .= '<ul class="tour-photos">';
			foreach ( $tour_photos as $photo ){
				$out .= '<li><a class="magnific" href="' . $photo['full_url'] . '" title="' . $photo['title'] . '">';
				$out .= '<img src="' . $photo['url'] . '" />';
				$out .= '</a></li>';
			}
			$out .= '</ul>';
		}

		return $out;
		
	}
}

/* ---------------------------------------------------------------------- */
/*	Price included and excluded
/* ---------------------------------------------------------------------- */
if ( !function_exists( 'sp_price_included_exlcuded' ) ){
	function sp_price_included_exlcuded(){
		
		$included = get_post_meta( get_the_ID(), 'sp_included', true );
		$excluded = get_post_meta( get_the_ID(), 'sp_excluded', true );

		$out = '<div class="price-included">';
		$out .= '<strong>' . __( 'Price included', SP_TEXT_DOMAIN ) . '</strong>';
		$out .= $included;
		$out .= '</div>';
		$out .= '<div class="price-excluded">';
		$out .= '<strong>' . __( 'Price excluded', SP_TEXT_DOMAIN ) . '</strong>';
		$out .= $excluded;
		$out .= '</div>';

		return $out;
	}
}

/* ---------------------------------------------------------------------- */
/*	Display slideshow
/* ---------------------------------------------------------------------- */
if ( ! function_exists( 'sp_slideshow' ) ) {
	function sp_slideshow(){
		$sliders = rwmb_meta( 'sp_sliders', $args = array('type' => 'plupload_image', 'size' => 'work-large') ); 
		$out = '';
		$out .='<script type="text/javascript">
				jQuery(document).ready(function($){
					$("#slideshow").flexslider({
						animation: "slide",
						pauseOnHover: true,
						controlNav: false
					});
				});		
				</script>';
		$out .= '<div id="slideshow" class="flexslider">';
		$out .= '<ul class="slides">';

		foreach ( $sliders as $slide ){

			$out .= '<li>';
			$out .= '<img src="' . $slide["full_url"] . '" />';
			$out .= '</li>';
		
		}

		$out .= '</ul>';
		$out .= '</div>';	

		return $out;	
	}
}

/* ---------------------------------------------------------------------- */
/*  Render thumbnail tour - using in Loop
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_render_thumbnail_tour') ) {

	function sp_render_thumbnail_tour(){
		$thumb = sp_post_thumbnail('tour-thumb');
		$price_id = get_post_meta( get_the_ID(), 'sp_tour_price', true );
		$tour_price = sp_get_tour_rate($price_id, 'min');
		$out = '<div class="view view-style-1">';
		$out .= '<img src="' . $thumb . '">';
		$out .= '<div class="mask">';
		$out .= '<a class="genericon genericon-search" href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', SP_TEXT_DOMAIN ), the_title_attribute( 'echo=0' ) ) . '"></a>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '<div class="tour-info">';
		$out .= '<h4><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', SP_TEXT_DOMAIN ), the_title_attribute( 'echo=0' ) ) . '">' . get_the_title() . '</a></h4>';
		if ( $tour_price ){
		$out .= '<small>' . __('Price per person from', SP_TEXT_DOMAIN) . '</small>';
		$out .= '<span class="tour-price">' . $tour_price . '</span>';
		$out .= '<a class="button light-gray" href="' . get_permalink() .'">' . __('Booking', SP_TEXT_DOMAIN) . '</a></h4>';
		}
		$out .= '</div>';
		return $out;
	}

}

/* ---------------------------------------------------------------------- */               							
/*  Related tours
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_get_related_tours') ) {
	function sp_get_related_tours($post_num, $post_id){
		$tour_type = wp_get_post_terms($post_id, 'tour-type');
		$destinations = wp_get_post_terms($post_id, 'destination');
		$des_array = array();
		$type_array = array();
		foreach ($destinations as $value) {
			$des_array[] = $value->term_id;
		}
		foreach ($tour_type as $value) {
			$type_array[] = $value->term_id;
		}
		
		$args = array(
			'post_type'	=> 'tour',
			'post__not_in' => array($post_id),
			'tax_query' => array(
					'relation' => 'OR',
		  			array(
						'taxonomy' => 'destination',
						'field' => 'id',
		  				'terms' => array(join(', ', $des_array))
					),
					array(
						'taxonomy' => 'tour-type',
						'field' => 'id',
		  				'terms' => array(join(', ', $type_array))
					)),
			'orderby' => 'rand',
			'posts_per_page' => $post_num
			);
		$custom_query = new WP_Query($args);
		$out = '<div id="related-tours">';
		$out .= '<ul>';
		while ( $custom_query->have_posts() ): $custom_query->the_post();
			$thumb = sp_post_thumbnail('tour-mini');
			$out .= '<li>';
			$out .= '<img src="' . $thumb . '">';
			$out .= '<a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', SP_TEXT_DOMAIN ), the_title_attribute( 'echo=0' ) ) . '">' . get_the_title() . '</a>';
			$out .= sp_get_tour_type();
			$out .= '</li>';
		endwhile;
		wp_reset_postdata(); // Restore global post data
		$out .= '</ul>';
		$out .= '</div>';

		return $out;
	}
}


/* ---------------------------------------------------------------------- */
/*  Get tour rate
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_get_tour_rate') ) {

	function sp_get_tour_rate($post_id, $rate_level){
		global $type_tour_rate, $currency;

		$tour_rates = maybe_unserialize(get_post_meta( $post_id, 'sp_tour_rate', true ));
		if ($tour_rates){
			$opt_rates = array();
			foreach ( $tour_rates as $options => $option ) {
				foreach( $option as $k => $v ){
					if ( ($rate_level == 'min') && ($k == (count($type_tour_rate) - 2)) ){
						$opt_rates[] = $v;	
					} elseif ( ($rate_level == 'max') && ($k == (count($type_tour_rate) - 8)) ){
						$opt_rates[] = $v;	
					}
				}
			}
			if ( $rate_level == 'min' ){
				return $currency[0] . ' ' . min($opt_rates);
			} elseif ( $rate_level == 'max' ){
				return $currency[0] . ' ' . max($opt_rates);
			}
		} else {
			return null;
		}
		
	}
}

/* ---------------------------------------------------------------------- */               							
/*  Send tour booking information
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_send_booking_tour') ) {

	function sp_send_booking_tour(){
		global $smof_data;
		
		parse_str ($_POST['tours'], $tour_info);
		$agency_email = 'sopheak@supersoftgroup.com'; //'sales@eurasietravel.com.kh';
		($tour_info['title'] == 1 ) ? $title = 'Mr.' : $title = 'Ms.';

		$emailTo = $tour_info['email'];
		$subject = 'Hello ' . $title . ' ' . $tour_info['full_name'];
		$body = sp_email_template( $tour_info );
		$headers = 'From: '.$tour_info['full_name'].' <'.$emailTo.'>' . "\r\n BCC:" . $agency_email . '\r\n Reply-To: ' . $tour_info['email'];
		
		mail($emailTo, $subject, $body, $headers);

		$out = '<h3>Thank you for booking with us!</h3>';
		$out .= '<h5>We\'ll contact you within 01 working day.</h5>'; 
		$out .= '<p>If you don\'t receive our answer after 1 working day, please check your spam email. It may go to your spam mailbox.</p>';
		$out .= '<p>If you have any questions, please kindly contact us at: <a href="mailto:sales@eurasietravel.com.kh">sales@eurasietravel.com.kh</a></p>';
		echo $out;

		die();
	}

	add_action('wp_ajax_nopriv_sp_send_booking_tour', 'sp_send_booking_tour'); //executes for users that are not logged in.
	add_action('wp_ajax_sp_send_booking_tour', 'sp_send_booking_tour');

}

if ( !function_exists('sp_email_template') ){

	function sp_email_template( $tour_info ){
	
		($tour_info['title'] == 1 ) ? $title = 'Mr.' : $title = 'Ms.';
		$out = 'Dear ' . $title . ' ' . $tour_info['full_name'];
		$out .= '<p>Your request has been submitted to ' . get_bloginfo('wpurl', 'display') . ' One of our travel consultants will respond to you within 1 working day.</p>';
		$out .= '<p><strong>Please note:</strong> If you submit incorrect information, please contact our travel consultants to change your request at <a href="mailto:sales@eurasietravel.com.kh">sales@eurasietravel.com.kh</a></p>';
		$out .= '<p style="font-weight:bold; font-size:14px;">Please review the details below of what you selected:</p>';
		
		$out .= '<table style="width:700px;border-spacing:3px;font-family:Arial;font-size:12px"><tbody>';
		$out .= '<tr>';
		$out .= '<td colspan="2"><div style="color:#3366cc; border-bottom:2px solid #3399cc;"><strong>Customer Information</strong></div></td>';
		$out .= '</tr>';
		$out .= '<tr>';
		$out .= '<td style="padding-left:30px;width:30%"><strong>Full Name:</strong></td>';
		$out .= '<td width="70%">' . $tour_info['full_name'] . '</td>';
		$out .= '</tr>';
		$out .= '<tr>';
		$out .= '<td style="padding-left:30px;width:30%"><strong>Email:</strong></td>';
		$out .= '<td width="70%">' . $tour_info['email'] . '</td>';
		$out .= '</tr>';
		$out .= '<tr>';
		$out .= '<td style="padding-left:30px;width:30%"><strong>Phone number:</strong></td>';
		$out .= '<td width="70%">' . $tour_info['phone_number'] . '</td>';
		$out .= '</tr>';
		$out .= '<tr>';
		$out .= '<td style="padding-left:30px;width:30%"><strong>Country:</strong></td>';
		$out .= '<td width="70%">' . $tour_info['country'] . '</td>';
		$out .= '</tr>';
		$out .= '<tr>';
		$out .= '<td style="padding-left:30px;width:30%"><strong>Arrive date:</strong></td>';
		$out .= '<td width="70%">' . $tour_info['arrive_date'] . '</td>';
		$out .= '</tr>';
		$out .= '<tr>';
		$out .= '<td colspan="2"><div style="color:#3366cc; border-bottom:2px solid #3399cc;"><strong>Booking Information</strong></div></td>';
		$out .= '</tr>';
		$out .= '<tr>';
		$out .= '<td style="padding-left:30px;width:30%"><strong>Tour name:</strong></td>';
		$out .= '<td width="70%">' . $tour_info['tour_name'] . '</td>';
		$out .= '</tr>';
		$out .= '<tr>';
		$out .= '<td style="padding-left:30px;width:30%"><strong>Destination:</strong></td>';
		$out .= '<td width="70%">' . $tour_info['destination'] . '</td>';
		$out .= '</tr>';
		$out .= '<tr>';
		$out .= '<td style="padding-left:30px;width:30%"><strong>Adults:</strong></td>';
		$out .= '<td width="70%">' . $tour_info['guests'] . '</td>';
		$out .= '</tr>';
		$out .= '<tr>';
		$out .= '<td style="padding-left:30px;width:30%"><strong>Children:</strong></td>';
		$out .= '<td width="70%">' . $tour_info['children'] . '</td>';
		$out .= '</tr>';
		$out .= '</tbody></table>';
		$out .= '<p><strong>Special requirements: </strong>' . $tour_info['requirements'] . '</p>';
		$out .= '<p><strong>Reservation - Eurasie Travel</strong></p>';
		$out .= '<p style="font-size:12px;"><strong>Eurasie Travel</strong>';
		$out .= '<br>Head office: No. AC04, St. 55, Borey Sopheak Mongkul,';
		$out .= '<br>Sangkat Chroy Changvar, Khan Russey Keo,';
		$out .= '<br>Phnom Penh, Cambodia.';
		$out .= '<br>Email: <a href="mailto:sales@eurasietravel.com.kh">sales@eurasietravel.com.kh</a>';
		$out .= '<br>Tel: +855 23 426-456, 012 608-108';
		$out .= '<br>Fax: +855 23 432-242';
		$out .= '<br>Website: ' . get_bloginfo('wpurl', 'display') . '</p>';
		return $out;
	}

}


/* ---------------------------------------------------------------------- */               							
/*  Get hotel post
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_get_hotel_posts') ) {

	function sp_get_hotel_posts() {
		$args = array(
				'post_type' => 'hotel',
				'posts_per_page' => -1,
			);
		$custom_query = new WP_Query($args);
		if ( $custom_query->have_posts() ) {
			while( $custom_query->have_posts() )
			{
				$post = $custom_query->next_post();
				$options[$post->post_title] = $post->post_title;
			}
		}
		return $options;
	}

}	

/* ---------------------------------------------------------------------- */               							
/*  Set FAQs post view count
/* ---------------------------------------------------------------------- */
function sp_set_faq_post_views($postID) {
    $count_key = 'sp_faq_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/* ---------------------------------------------------------------------- */               							
/*  Display popular FAQs post
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_get_popular_faqs_posts') ) {
	function sp_get_popular_faqs_posts() {
		$args = array(
				'post_type' => 'faq',
				'meta_key' => 'sp_faq_post_views_count',
				'orderby' => 'meta_value_num',
				'order' => 'DESC',
				'posts_per_page' => 10,
			);
		$custom_query = new WP_Query($args);
		$out = '<div id="faq-list">';
		$out .= '<ul>';
		while ( $custom_query->have_posts() ): $custom_query->the_post();
			$out .= '<li><a href="' . get_permalink() .'" title="' . sprintf( esc_attr__( 'Permalink to %s', SP_TEXT_DOMAIN ), the_title_attribute( 'echo=0' ) ) . '">' . get_the_title() . '</a></li>';
		endwhile;
		wp_reset_postdata(); // Restore global post data
		$out .= '</ul>';
		$out .= '</div>';

		return $out;
	}
}

/* ---------------------------------------------------------------------- */               							
/*  Retrieve the terms in a taxonomy as sub navigation
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_get_faqs_terms') ) {

	function sp_get_faqs_terms($taxonomy){
		$taxonomies = sp_get_terms_list($taxonomy);
		if ( count($taxonomies) ) {
			$out = '<ul>';
			foreach ( $taxonomies as $term ) {
				$out .= '<li><a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'sptheme_widget'), $term->name) . '">' . $term->name . '</a><span class="post-count>">(' . $term->count . ')</span></li>';
			}
			$out .= '</ul>';
		}
		return $out;
	}

}

/* ---------------------------------------------------------------------- */               							
/*  Retrieve term destination
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_render_main_destinations') ) {

	function sp_render_main_destinations(){
		$args = array(
				'parent'	=> 0,
				'hide_empty' => 0
			);
		$main_destinations = get_terms('destination', $args);
		$out = '';
		if ( count($main_destinations) ) {
			foreach ( $main_destinations as $term ) {
				$tax_image_url = get_option( 'destination_'.$term->term_id.'_thumb', '' );
				$image = aq_resize( $tax_image_url, 300, 172, true );
				$out .= '<div class="country clearfix">';
				$out .= '<img src="' . $image . '">';
				$out .= '<ul class="country-info">';
				$out .= '<li class="left">';
				$out .= '<h3>' . $term->name .'</h3>';
				$out .= '<a href="#" class="learn-more">' . __('Learn more', SP_TEXT_DOMAIN) . '</a>';
				$out .= '</li>';
				$out .= '<li class="meta-highlight right">';
				$out .= '<a href="' . get_term_link( $term ) . '" class="tour-amount"><b>' . $term->count .'</b> ' . __('Tours', SP_TEXT_DOMAIN) . '</a>';
				$out .= '<a href="' . get_term_link( $term ) . '"><b>' . wp_count_terms('destination', array('parent' => $term->term_id)) . '</b> ' . __('Destinations', SP_TEXT_DOMAIN) . '</a>';
				$out .= '</li>';
				$out .= '</ul>';
				$out .= '</div>';
			}
		}
		return $out;	
	}

}

/* ---------------------------------------------------------------------- */               							
/*  Retrieve term destination
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_get_all_terms_destination') ) {

	function sp_get_all_terms_destination(){
		$args = array(
				'parent'	=> 0,
				'hide_empty' => 0
			);
		$destinations = get_terms('destination', $args);
		if ( count($destinations) ) {
			$out = '<dl>';
			foreach ( $destinations as $term ) {
				$out .= '<dt><a href="' . get_term_link( $term ) . '" title="' . sprintf(__('View all post filed under %s', 'sptheme_widget'), $term->name) . '">' . $term->name . '</a><span class="post-count>">(' . $term->count . ')</span></dt>';
	
				$child_args = array(
						'child_of' => $term->term_id,
						'hide_empty' => 0
					);
				$des_child = get_terms('destination', $child_args);

				foreach ($des_child as $term_child) {
					$out .= '<dd><a href="' . get_term_link( $term_child ) . '" title="' . sprintf(__('View all post filed under %s', 'sptheme_widget'), $term_child->name) . '">' . $term_child->name . '</a><span class="post-count>">(' . $term_child->count . ')</span></dd>';	
				}

			}
			$out .= '</dl>';
		}
		return $out;
	}

}

/* ---------------------------------------------------------------------- */               							
/*  Retrieve the terms list and return array
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_get_terms_list') ) {

	function sp_get_terms_list($taxonomy){
		$args = array(
				'hide_empty'	=> 0
			);
		$taxonomies = get_terms($taxonomy, $args);
		return $taxonomies;
	}

}


/* ---------------------------------------------------------------------- */               							
/*  Get related post by Taxonomy
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_get_posts_related_by_taxonomy') ) {

	function sp_get_posts_related_by_taxonomy($post_id, $taxonomy, $args=array()) {

		//$query = new WP_Query();
		$terms = wp_get_object_terms($post_id, $taxonomy);
		if (count($terms)) {
		
		// Assumes only one term for per post in this taxonomy
		$post_ids = get_objects_in_term($terms[0]->term_id,$taxonomy);
		$post = get_post($post_id);
		$args = wp_parse_args($args,array(
		  'post_type' => $post->post_type, // The assumes the post types match
		  //'post__in' => $post_ids,
		  'post__not_in' => array($post_id),
		  'tax_query' => array(
		  			array(
						'taxonomy' => $taxonomy,
						'field' => 'term_id',
		  				'terms' => $terms[0]->term_id
					)),
		  'orderby' => 'rand',
		  'posts_per_page' => -1
		  
		));
		$query = new WP_Query($args);
		}
		return $query;
	}

}

/* ---------------------------------------------------------------------- */               							
/*  Taxonomy has children and has parent
/* ---------------------------------------------------------------------- */
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

/* ---------------------------------------------------------------------- */
/*  Get related pages
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_get_related_pages') ) {

	function sp_get_related_pages() {

		$orig_post = $post;
		global $post;
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {
			$tag_ids = array();
			foreach($tags as $individual_tag)
			$tag_ids[] = $individual_tag->term_id;
			$args=array(
			'post_type' => 'page',
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>5
			);
			$pages_query = new WP_Query( $args );
			if( $pages_query->have_posts() ) {
				echo '<div id="relatedpages"><h3>Related Pages</h3><ul>';
				while( $pages_query->have_posts() ) {
				$pages_query->the_post(); ?>
				<li><div class="relatedthumb"><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('thumb'); ?></a></div>
				<div class="relatedcontent">
				<h3><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<?php the_time('M j, Y') ?>
				</div>
				</li>
			<?php }
				echo '</ul></div>';
			} else { 
				echo "No Related Pages Found:";
			}
		}
		$post = $orig_post;
		wp_reset_postdata(); 

	}
	
}

/* ---------------------------------------------------------------------- */
/*	Displays a page pagination
/* ---------------------------------------------------------------------- */

if ( !function_exists('sp_pagination') ) {

	function sp_pagination( $pages = '', $range = 2 ) {

		$showitems = ( $range * 2 ) + 1;

		global $paged, $wp_query;

		if( empty( $paged ) )
			$paged = 1;

		if( $pages == '' ) {

			$pages = $wp_query->max_num_pages;

			if( !$pages )
				$pages = 1;

		}

		if( 1 != $pages ) {

			$output = '<nav class="pagination">';

			// if( $paged > 2 && $paged >= $range + 1 /*&& $showitems < $pages*/ )
				// $output .= '<a href="' . get_pagenum_link( 1 ) . '" class="next">&laquo; ' . __('First', 'sptheme_admin') . '</a>';

			if( $paged > 1 /*&& $showitems < $pages*/ )
				$output .= '<a href="' . get_pagenum_link( $paged - 1 ) . '" class="next">&larr; ' . __('Previous', SP_TEXT_DOMAIN) . '</a>';

			for ( $i = 1; $i <= $pages; $i++ )  {

				if ( 1 != $pages && ( !( $i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems ) )
					$output .= ( $paged == $i ) ? '<span class="current">' . $i . '</span>' : '<a href="' . get_pagenum_link( $i ) . '">' . $i . '</a>';

			}

			if ( $paged < $pages /*&& $showitems < $pages*/ )
				$output .= '<a href="' . get_pagenum_link( $paged + 1 ) . '" class="prev">' . __('Next', SP_TEXT_DOMAIN) . ' &rarr;</a>';

			// if ( $paged < $pages - 1 && $paged + $range - 1 <= $pages /*&& $showitems < $pages*/ )
				// $output .= '<a href="' . get_pagenum_link( $pages ) . '" class="prev">' . __('Last', 'sptheme_admin') . ' &raquo;</a>';

			$output .= '</nav>';

			return $output;

		}

	}

}		

