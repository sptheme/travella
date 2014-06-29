<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'sp_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * @return void
 */
function sp_register_meta_boxes( $meta_boxes )
{
	global $days_of_tour, $hotel_levels;
	$prefix = 'sp_';
	
	/*$accommodations_arr = array();
	$accommodations = get_terms('accommodation', array('post_status' => 'publish', 'posts_per_page' => '5',));
	foreach ($accommodations as $term) {
	    $accommodations_arr[$term->term_id] = $term->name;
	}*/

	$destinations_arr = array();
	$destinations = get_terms('destination', array('post_status' => 'publish', 'posts_per_page' => '5',));
	foreach ($destinations as $term) {
	    $destinations_arr[$term->term_id] = $term->name;
	}
	$destinations_tmp 	= array_unshift($destinations_arr, "Select a accommodation");

	$price_included = '<ul>
					<li>Local English speaking guide as per program</li>
					</ul>';
	$price_excluded = '<ul>
					<li>Visa fee to Cambodia</li>
					<li>International air ticket in-out Cambodia</li>
					<li>Other meals, drink, personal expenses, tip</li>
					<li>Other not mentioned in "INCLUDES"</li>
					</ul>';
 				 				

	/* ---------------------------------------------------------------------- */
	/*	TOUR POST TYPE
	/* ---------------------------------------------------------------------- */
	$meta_boxes[] = array(
		'id'       => 'tour-attribute',
		'title'    => __('Tour attribute', 'sptheme_admin'),
		'pages'    => array('tour'),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			/*array(
				'name' 		=> __('Oveview', 'sptheme_admin'),
				'id'   		=> $prefix . 'overview',
				'std'  		=> '',
				'desc'		=> 'Only write short description maximum length of 255 characters',
				'type' 		=> 'textarea',
				'cols' 		=> 20,
				'rows' 		=> 3,
			),*/
			array(
				'name' 		=> __('Highlight infomation', 'sptheme_admin'),
				'id'   		=> $prefix . 'highlight',
				'std'  		=> '',
				'desc' 		=> '',
				'type' 		=> 'wysiwyg',
				'options' 	=> array(
					'textarea_rows' => 5,
					'teeny'         => true,
					'media_buttons' => false,
				),
				
			),
			array(
				'name' 		=> __('Number of day', 'sptheme_admin'),
				'id'   		=> $prefix . 'day',
				'std'  		=> '1',
				'desc' 		=> 'Select amount of days tour',
				'type' 		=> 'select',
				'options'	=> $days_of_tour
				
			),
			/*array(
				'name' => __('Destination', 'sptheme_admin'),
				'id'   => $prefix . 'destination',
				'type' => 'select_advanced',
				'options' => $destination_arr,
				'multiple'    => true,
				'placeholder' => __( 'Select an Item', 'sptheme_admin' ),
			),*/
			array(
				'name' 		=> __('Departure', 'sptheme_admin'),
				'id'   		=> $prefix . 'departure',
				'std'  		=> '',
				'desc' 		=> 'e.g: Daily - from Phnom Penh or Siem Reap city',
				'type' 		=> 'text',
				'size' 		=> 60
				
			),
			array(
				'name' 		=> __('Tour photos', 'sptheme_admin'),
				'id'   		=> $prefix . 'tour_potos',
				'type' => 'image_advanced',
				'max_file_uploads' => sizeof($days_of_tour),
				'std'  => '',
				'desc' => 'Max size 650px width and auto proportion of height. And allow only ' . sizeof($days_of_tour) . ' photos'
				
			),
			/*array(
				'name'    => __( 'Price', 'sptheme_admin' ),
				'id'      => $prefix . 'tour_price',
				'type'    => 'post',
				'desc'	  => 'Select price pacakge for this tour. <a href="edit.php?post_type=accommodation">Manage Price</a>',

				'post_type' => 'accommodation',
				'field_type' => 'select_advanced',
				'query_args' => array(
					'post_status' => 'publish',
					'posts_per_page' => '5',
				),
				'placeholder' => __( 'Select an Item', 'sptheme_admin' ),
			),*/
			array(
				'name' 		=> __('Price included', 'sptheme_admin'),
				'id'   		=> $prefix . 'included',
				'std'  		=> $price_included,
				'desc' 		=> '',
				'type' 		=> 'wysiwyg',
				'options' 	=> array(
					'textarea_rows' => 5,
					'teeny'         => true,
					'media_buttons' => false,
				),
				
			),
			array(
				'name' 		=> __('Price excluded', 'sptheme_admin'),
				'id'   		=> $prefix . 'excluded',
				'std'  		=> $price_excluded,
				'desc' 		=> '',
				'type' 		=> 'wysiwyg',
				'options' 	=> array(
					'textarea_rows' => 5,
					'teeny'         => true,
					'media_buttons' => false,
				),
				
			)
		)
	);

	/* ---------------------------------------------------------------------- */
	/*	SLIDER POST TYPE
	/* ---------------------------------------------------------------------- */
	$meta_boxes[] = array(
		'id'       => 'slider-settings',
		'title'    => __('Photo slideshow', 'sptheme_admin'),
		'pages'    => array('slider'),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __('Upload photos', 'sptheme_admin'),
				'id'   => $prefix . 'sliders',
				'type' => 'image_advanced',
				'max_file_uploads' => 5,
				'std'  => '',
				'desc' => 'Max size 650px wide and auto proportion of height'
			)
		)
	);

	/* ---------------------------------------------------------------------- */
	/*	GALLERY POST TYPE
	/* ---------------------------------------------------------------------- */
	$meta_boxes[] = array(
		'id'       => 'album-settings',
		'title'    => __('Album setting', 'sptheme_admin'),
		'pages'    => array('gallery'),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __('Upload photos', 'sptheme_admin'),
				'id'   => $prefix . 'gallery',
				'type' => 'image_advanced',
				'max_file_uploads' => 90,
				'std'  => '',
				'desc' => 'Max size 650px wide'
			)
		)
	);

	/* ---------------------------------------------------------------------- */
	/*	ACCOMMODATION POST TYPE
	/* ---------------------------------------------------------------------- */
	$meta_boxes[] = array(
		'id'       => 'accom-settings',
		'title'    => __('Package infomation', 'sptheme_admin'),
		'pages'    => array('accommodation'),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'type' => 'heading',
				'name' => __( 'Validity', 'sptheme_admin' ),
				'id'   => 'validity_fake_id', // Not used but needed for plugin
			),
			array(
				'name' => __( 'From', 'sptheme_admin' ),
				'id'   => $prefix . 'price_valid_from',
				'type' => 'date',

				// jQuery date picker options. See here http://api.jqueryui.com/datepicker
				'js_options' => array(
					'appendText'      => __( '(yyyy-mm-dd)', 'sptheme_admin' ),
					'autoSize'        => true,
					'buttonText'      => __( 'Select Date', 'sptheme_admin' ),
					'dateFormat'      => __( 'yy-mm-dd', 'sptheme_admin' ),
				),
			),
			array(
				'name' => __( 'To', 'sptheme_admin' ),
				'id'   => $prefix . 'price_valid_to',
				'type' => 'date',

				// jQuery date picker options. See here http://api.jqueryui.com/datepicker
				'js_options' => array(
					'appendText'      => __( '(yyyy-mm-dd)', 'sptheme_admin' ),
					'autoSize'        => true,
					'buttonText'      => __( 'Select Date', 'sptheme_admin' ),
					'dateFormat'      => __( 'yy-mm-dd', 'sptheme_admin' ),
				),
			),
			array(
				'type' => 'heading',
				'name' => __( 'Accommodation options', 'sptheme_admin' ),
				'id'   => 'accommodation_fake_id', // Not used but needed for plugin
			),
			array(
				//'name' => __('Accommodation', 'sptheme_admin'),
				'id'   => $prefix . 'accommodation',
				'type' => 'accommodation',
				'std'  => ''
			),
			/*array(
				'type' => 'heading',
				'name' => __( 'Price/Rate options', 'sptheme_admin' ),
				'id'   => 'tour_price_fake_id', // Not used but needed for plugin
			),
			array(
				'id'   => $prefix . 'tour_rate',
				'type' => 'tour_rate',
				'std'  => ''
			),*/
			array(
				'name' 		=> __('Tour price', 'sptheme_admin'),
				'id'   		=> $prefix . 'min_price',
				'std'  		=> '',
				'desc' 		=> 'Enter tour min price, number only. e.g 300',
				'type' 		=> 'text',
				'size' 		=> 8
			)
		)
	);		

	/* ---------------------------------------------------------------------- */
	/*	HOTEL POST TYPE
	/* ---------------------------------------------------------------------- */
	/*$meta_boxes[] = array(
		'id'       => 'hotel-settings',
		'title'    => __('Hotel infomation', 'sptheme_admin'),
		'pages'    => array('hotel'),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __('Location', 'sptheme_admin'),
				'id'   => $prefix . 'hotel_location',
				'type' => 'select_advanced',
				'std'  => '',
				'options' => $destination_arr,
				'multiple'    => false,
				'placeholder' => __( 'Select location', 'sptheme_admin' ),
			),
			array(
				'name' => __('Level', 'sptheme_admin'),
				'id'   => $prefix . 'hotel_level',
				'type' => 'select',
				'std'  => '',
				'options' => $hotel_levels
			),
			array(
				'name' => __('Website', 'sptheme_admin'),
				'id'   => $prefix . 'hotel_website',
				'type' => 'url',
				'std'  => '',
				'desc' => 'Must be has <strong>http://</strong> e.g: http://www.sokhahotels.com'
			),
			array(
				'type' => 'heading',
				'name' => __( 'Room Type', 'sptheme_admin' ),
				'id'   => 'room_type_heading', // Not used but needed for plugin
			),
			array(
				'name' => __('Type', 'sptheme_admin'),
				'id'   => $prefix . 'hotel_roomtype',
				'type' => 'text',
				'std'  => 'Standard',
				'desc' => 'Type only name of room. e.g: Standard, Deluxe ...',
				'clone' => true,
			),
		)
	);*/

	/* ---------------------------------------------------------------------- */
	/*	TESTIMONIAL POST TYPE
	/* ---------------------------------------------------------------------- */
	$meta_boxes[] = array(
		'id'       => 'testimonial-settings',
		'title'    => __('Testimonial settings', 'sptheme_admin'),
		'pages'    => array('testimonial'),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' => __('Nationality', 'sptheme_admin'),
				'id'   => $prefix . 'nationality',
				'type' => 'text',
				'std'  => '',
				'desc' => 'e.g: France or Germany...'
			),
			array(
				'name' => __('Tour link', 'sptheme_admin'),
				'id'   => $prefix . 'tour_link',
				'type' => 'text',
				'std'  => '',
				'desc' => 'Place link/url of tour that this person has commented.'
			)
		)
	);

	return $meta_boxes;
}