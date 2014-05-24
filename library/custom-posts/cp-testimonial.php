<?php
/*
*****************************************************
* Testimonial custom post
*
* CONTENT:
* - 1) Actions and filters
* - 2) Creating a custom post
*****************************************************
*/





/*
*****************************************************
*      1) ACTIONS AND FILTERS
*****************************************************
*/
	//ACTIONS
		//Registering CP
		add_action( 'init', 'sp_testimonial_cp_init' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_testimonial_cp_init' ) ) {
		function sp_testimonial_cp_init() {
			global $cp_menu_position;

			/*if ( $smof_data['sp_newsticker_revisions'] )
				$supports[] = 'revisions';*/
			$labels = array(
				'name'               => __( 'Testimonials', 'sptheme_admin' ),
				'singular_name'      => __( 'Testimonial', 'sptheme_admin' ),
				'add_new'            => __( 'Add New', 'sptheme_admin' ),
				'all_items'          => __( 'All Testimonials', 'sptheme_admin' ),
				'add_new_item'       => __( 'Add New Testimonial', 'sptheme_admin' ),
				'new_item'           => __( 'Add New Testimonial', 'sptheme_admin' ),
				'edit_item'          => __( 'Edit Testimonial', 'sptheme_admin' ),
				'view_item'          => __( 'View Testimonial', 'sptheme_admin' ),
				'search_items'       => __( 'Search Testimonial', 'sptheme_admin' ),
				'not_found'          => __( 'No Testimonial found', 'sptheme_admin' ),
				'not_found_in_trash' => __( 'No Testimonial found in trash', 'sptheme_admin' ),
				'parent_item_colon'  => __( 'Parent Testimonial', 'sptheme_admin' ),
			);	

			$role     = 'post'; // page
			$slug     = 'testimonials';
			$supports = array('title', 'editor'); // 'title', 'editor', 'thumbnail'

			$args = array(
				'labels' 				=> $labels,
				'rewrite'               => array( 'slug' => $slug ),
				'menu_position'         => $cp_menu_position['sp_testimonial'],
				'menu_icon'           	=> 'dashicons-id',
				'supports'              => $supports,
				'capability_type'     	=> $role,
				'query_var'           	=> true,
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_nav_menus'	    => false,
				'publicly_queryable'	=> true,
				'exclude_from_search'   => false,
				'has_archive'			=> false,
				'can_export'			=> true
			);
			register_post_type( 'testimonial' , $args );
		}
	} 

	
	