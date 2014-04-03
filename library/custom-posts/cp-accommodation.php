<?php
/*
*****************************************************
* Accommodation custom post
*
* CONTENT:
* - 1) Actions and filters
* - 2) Creating a custom post
* - 3) Custom post list in admin
*****************************************************
*/





/*
*****************************************************
*      1) ACTIONS AND FILTERS
*****************************************************
*/
	//ACTIONS
		//Registering CP
		add_action( 'init', 'sp_accommodation_cp_init' );
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_accommodation_cp_custom_column' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-accommodation_columns', 'sp_accommodation_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_accommodation_cp_init' ) ) {
		function sp_accommodation_cp_init() {
			global $cp_menu_position;

			/*if ( $smof_data['sp_newsticker_revisions'] )
				$supports[] = 'revisions';*/
			$labels = array(
				'name'               => __( 'Accommodations', 'sptheme_admin' ),
				'singular_name'      => __( 'Accommodation', 'sptheme_admin' ),
				'add_new'            => __( 'Add New Accommodation', 'sptheme_admin' ),
				'all_items'          => __( 'All Accommodations', 'sptheme_admin' ),
				'add_new_item'       => __( 'Add New Accommodation', 'sptheme_admin' ),
				'new_item'           => __( 'Add New Accommodation', 'sptheme_admin' ),
				'edit_item'          => __( 'Edit Accommodation', 'sptheme_admin' ),
				'view_item'          => __( 'View Accommodation', 'sptheme_admin' ),
				'search_items'       => __( 'Search Accommodation', 'sptheme_admin' ),
				'not_found'          => __( 'No Accommodation found', 'sptheme_admin' ),
				'not_found_in_trash' => __( 'No Accommodation found in trash', 'sptheme_admin' ),
				'parent_item_colon'  => __( 'Parent Accommodation', 'sptheme_admin' ),
			);	

			$role     = 'post'; // page
			$slug     = 'accommodations';
			$supports = array('title'); // 'title', 'editor', 'thumbnail'

			$args = array(
				'labels' 				=> $labels,
				'rewrite'               => array( 'slug' => $slug ),
				'menu_position'         => $cp_menu_position['sp_accommodation'],
				'menu_icon'           	=> 'dashicons-star-filled',
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
			register_post_type( 'accommodation' , $args );
		}
	} 


/*
*****************************************************
*      3) CUSTOM POST LIST IN ADMIN
*****************************************************
*/
	/*
	* Registration of the table columns
	*
	* $Cols = ARRAY [array of columns]
	*/
	if ( ! function_exists( 'sp_accommodation_cp_columns' ) ) {
		function sp_accommodation_cp_columns( $columns ) {
			
			$columns = array(
				'cb'                   	=> '<input type="checkbox" />',
				'title'                	=> __( 'Accommodation Packgage', 'sptheme_admin' ),
				'min_price'		 		=> __( 'Min Price', 'sptheme_admin' ),
				'max_price'				=> __( 'Max Price', 'sptheme_admin' ),
				'valid_date'		 	=> __( 'Validity', 'sptheme_admin' ),
				'date'		 			=> __( 'Created date', 'sptheme_admin' )
			);

			return $columns;
		}
	}

	/*
	* Outputting values for the custom columns in the table
	*
	* $Col = TEXT [column id for switch]
	*/
	if ( ! function_exists( 'sp_accommodation_cp_custom_column' ) ) {
		function sp_accommodation_cp_custom_column( $column ) {
			global $post;
			
			switch ( $column ) {
				
				case "min_price":
					echo 'show value of min price';
				break;

				case "max_price":
					echo 'show value of max price';
				break;

				case "valid_date":
					$valid_from = get_post_meta( $post->ID, 'sp_price_valid_from', true );
					$valid_to = get_post_meta( $post->ID, 'sp_price_valid_to', true );
					echo date("jS F, Y", strtotime($valid_from)) . ' to ' . date("jS F, Y", strtotime($valid_to)); 
					
				break;				
				
				default:
				break;
			}
		}
	} // /sp_accommodation_cp_custom_column

	
	