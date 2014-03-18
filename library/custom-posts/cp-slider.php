<?php
/*
*****************************************************
* Slider custom post
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
		add_action( 'init', 'sp_slider_cp_init' );
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_slider_cp_custom_column' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-slider_columns', 'sp_slider_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_slider_cp_init' ) ) {
		function sp_slider_cp_init() {
			global $cp_menu_position;

			/*if ( $smof_data['sp_newsticker_revisions'] )
				$supports[] = 'revisions';*/
			$labels = array(
				'name'               => __( 'Sliders', 'sptheme_admin' ),
				'singular_name'      => __( 'Slider', 'sptheme_admin' ),
				'add_new'            => __( 'Add New', 'sptheme_admin' ),
				'all_items'          => __( 'All Slides', 'sptheme_admin' ),
				'add_new_item'       => __( 'Add New Slide', 'sptheme_admin' ),
				'new_item'           => __( 'Add New Slide', 'sptheme_admin' ),
				'edit_item'          => __( 'Edit Slide', 'sptheme_admin' ),
				'view_item'          => __( 'View Slide', 'sptheme_admin' ),
				'search_items'       => __( 'Search Slide', 'sptheme_admin' ),
				'not_found'          => __( 'No Slide found', 'sptheme_admin' ),
				'not_found_in_trash' => __( 'No Slide found in trash', 'sptheme_admin' ),
				'parent_item_colon'  => __( 'Parent Slide', 'sptheme_admin' ),
			);	

			$role     = 'post'; // page
			$slug     = 'sliders';
			$supports = array('title'); // 'title', 'editor', 'thumbnail'

			$args = array(
				'labels' 				=> $labels,
				'rewrite'               => array( 'slug' => $slug ),
				'menu_position'         => $cp_menu_position['sp_slider'],
				'menu_icon'           	=> 'dashicons-slides',
				'supports'              => $supports,
				'capability_type'     	=> $role,
				'query_var'           	=> true,
				'hierarchical'          => false,
				'public'                => true,
				'show_ui'               => true,
				'show_in_nav_menus'	    => false,
				'publicly_queryable'	=> true,
				'exclude_from_search'   => true,
				'has_archive'			=> false,
				'can_export'			=> true
			);
			register_post_type( 'slider' , $args );
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
	if ( ! function_exists( 'sp_slider_cp_columns' ) ) {
		function sp_slider_cp_columns( $columns ) {
			
			$columns = array(
				'cb'                   	=> '<input type="checkbox" />',
				'slider_thumbnail'    	 => __( 'Thumbnail', 'sptheme_admin' ),
				'title'                	=> __( 'Slide Name', 'sptheme_admin' ),
				'date' 					=> __( 'Date', 'sptheme_admin' )
			);

			return $columns;
		}
	} // /gallery_cp_columns

	/*
	* Outputting values for the custom columns in the table
	*
	* $Col = TEXT [column id for switch]
	*/
	if ( ! function_exists( 'sp_slider_cp_custom_column' ) ) {
		function sp_slider_cp_custom_column( $column ) {
			global $post;
			
			switch ( $column ) {
				case "slider_thumbnail":
					$slides = rwmb_meta( 'sp_sliders', $args = array('type' => 'plupload_image', 'size' => 'thumbnail') ); 
					$slides_count = 0;
					$cover_image = '';
					$size = explode( 'x', SP_ADMIN_LIST_THUMB );

					foreach ( $slides as $image ){
						if ($slides_count < 1) {
							$cover_image .= '<img src="' . $image["url"] . '" width="' . $size[0] . '" height="' . $size[1] . '" />';
						}

						$slides_count++;
					}
					
					echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . $cover_image . '</a>';

				break;
				
				default:
				break;
			}
		}
	} // /sp_slider_cp_custom_column

	
	