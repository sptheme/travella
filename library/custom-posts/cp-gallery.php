<?php
/*
*****************************************************
* Gallery custom post
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
		add_action( 'init', 'sp_gallery_cp_init' );
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_gallery_cp_custom_column' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-gallery_columns', 'sp_gallery_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_gallery_cp_init' ) ) {
		function sp_gallery_cp_init() {
			global $cp_menu_position;

			/*if ( $smof_data['sp_newsticker_revisions'] )
				$supports[] = 'revisions';*/
			$labels = array(
				'name'               => __( 'Photo Gallery', 'sptheme_admin' ),
				'singular_name'      => __( 'Photo', 'sptheme_admin' ),
				'add_new'            => __( 'Add New', 'sptheme_admin' ),
				'all_items'          => __( 'Albums', 'sptheme_admin' ),
				'add_new_item'       => __( 'Add New photo', 'sptheme_admin' ),
				'new_item'           => __( 'Add New photo', 'sptheme_admin' ),
				'edit_item'          => __( 'Edit photo', 'sptheme_admin' ),
				'view_item'          => __( 'View photo', 'sptheme_admin' ),
				'search_items'       => __( 'Search photo', 'sptheme_admin' ),
				'not_found'          => __( 'No photo found', 'sptheme_admin' ),
				'not_found_in_trash' => __( 'No photo found in trash', 'sptheme_admin' ),
				'parent_item_colon'  => __( 'Parent photo', 'sptheme_admin' ),
			);	

			$role     = 'post'; // page
			$slug     = 'gallery';
			$supports = array('title', 'thumbnail'); // 'title', 'editor', 'thumbnail'

			$args = array(
				'labels' 				=> $labels,
				'rewrite'               => array( 'slug' => $slug ),
				'menu_position'         => $cp_menu_position['sp_gallery'],
				'menu_icon'           	=> 'dashicons-images-alt2',
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
			register_post_type( 'gallery' , $args );
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
	if ( ! function_exists( 'sp_gallery_cp_columns' ) ) {
		function sp_gallery_cp_columns( $columns ) {
			
			$columns = array(
				'cb'                   	=> '<input type="checkbox" />',
				'gallery_thumbnail'	   	=> __( 'Thumbnail', 'sptheme_admin' ),
				'title'                	=> __( 'Album Name', 'sptheme_admin' ),
				'date'		 			=> __( 'Date', 'sptheme_admin' )
			);

			return $columns;
		}
	}

	/*
	* Outputting values for the custom columns in the table
	*
	* $Col = TEXT [column id for switch]
	*/
	if ( ! function_exists( 'sp_gallery_cp_custom_column' ) ) {
		function sp_gallery_cp_custom_column( $column ) {
			global $post;
			
			switch ( $column ) {
				case "gallery_thumbnail":
					echo get_the_post_thumbnail( $post->ID, array(50, 50) );
				break;
				
				default:
				break;
			}
		}
	} // /sp_gallery_cp_custom_column

	
	