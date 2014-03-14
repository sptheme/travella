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
	global $days_of_tour;
	$prefix = 'sp_';

	/* ---------------------------------------------------------------------- */
	/*	PAGE
	/* ---------------------------------------------------------------------- */
	$meta_boxes[] = array(
		'id'       => 'tour-attribute',
		'title'    => __('Tour attribute', 'sptheme_admin'),
		'pages'    => array('tour'),
		'context'  => 'normal',
		'priority' => 'high',
		'fields'   => array(
			array(
				'name' 		=> __('Number of day', 'sptheme_admin'),
				'id'   		=> $prefix . 'day',
				'std'  		=> '1',
				'desc' 		=> 'Select amount of days tour',
				'type' 		=> 'select',
				'options'	=> $days_of_tour
				
			),
			array(
				'name' 		=> __('Departure', 'sptheme_admin'),
				'id'   		=> $prefix . 'departure',
				'std'  		=> '',
				'desc' 		=> 'e.g: Daily - from Phnom Penh or Siem Reap city',
				'type' 		=> 'text',
				'size' 		=> 60
				
			),
			array(
				'name' 		=> __('Oveview', 'sptheme_admin'),
				'id'   		=> $prefix . 'overview',
				'std'  		=> '',
				'desc'		=> 'Only write short description maximum length of 255 characters',
				'type' 		=> 'wysiwyg',
				'options' 	=> array(
					'textarea_rows' => 4,
					'teeny'         => true,
					'media_buttons' => false,
				),
			),
			array(
				'name' 		=> __('Tour photos', 'sptheme_admin'),
				'id'   		=> $prefix . 'tour_potos',
				'type' => 'image_advanced',
				'max_file_uploads' => sizeof($days_of_tour),
				'std'  => '',
				'desc' => 'Max size 650px width and auto proportion of height. And allow only ' . sizeof($days_of_tour) . ' photos'
				
			)
		)
	);

	return $meta_boxes;
}