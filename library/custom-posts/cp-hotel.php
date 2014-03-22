<?php
/*
*****************************************************
* Hotel custom post
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
		add_action( 'init', 'sp_hotel_cp_init' );
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_hotel_cp_custom_column' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-hotel_columns', 'sp_hotel_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_hotel_cp_init' ) ) {
		function sp_hotel_cp_init() {
			global $cp_menu_position;

			/*if ( $smof_data['sp_newsticker_revisions'] )
				$supports[] = 'revisions';*/
			$labels = array(
				'name'               => __( 'Hotels', 'sptheme_admin' ),
				'singular_name'      => __( 'Hotel', 'sptheme_admin' ),
				'add_new'            => __( 'Add New', 'sptheme_admin' ),
				'all_items'          => __( 'All Hotels', 'sptheme_admin' ),
				'add_new_item'       => __( 'Add New Hotel', 'sptheme_admin' ),
				'new_item'           => __( 'Add New Hotel', 'sptheme_admin' ),
				'edit_item'          => __( 'Edit Hotel', 'sptheme_admin' ),
				'view_item'          => __( 'View Hotel', 'sptheme_admin' ),
				'search_items'       => __( 'Search Hotel', 'sptheme_admin' ),
				'not_found'          => __( 'No Hotel found', 'sptheme_admin' ),
				'not_found_in_trash' => __( 'No Hotel found in trash', 'sptheme_admin' ),
				'parent_item_colon'  => __( 'Parent Hotel', 'sptheme_admin' ),
			);	

			$role     = 'post'; // page
			$slug     = 'hotels';
			$supports = array('title'); // 'title', 'editor', 'thumbnail'

			$args = array(
				'labels' 				=> $labels,
				'rewrite'               => array( 'slug' => $slug ),
				'menu_position'         => $cp_menu_position['sp_hotel'],
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
			register_post_type( 'hotel' , $args );
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
	if ( ! function_exists( 'sp_hotel_cp_columns' ) ) {
		function sp_hotel_cp_columns( $columns ) {
			
			$columns = array(
				'cb'                   	=> '<input type="checkbox" />',
				'title'                	=> __( 'Hotel Name', 'sptheme_admin' ),
				'hotel_level'		 	=> __( 'Hotel level', 'sptheme_admin' ),
				'hotel_location'		=> __( 'Location', 'sptheme_admin' ),
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
	if ( ! function_exists( 'sp_hotel_cp_custom_column' ) ) {
		function sp_hotel_cp_custom_column( $column ) {
			global $post;
			
			switch ( $column ) {
				
				case "hotel_level":
					$hotel_level = get_post_meta($post->ID, 'sp_hotel_level', true);
					for ( $i=1; $i<=$hotel_level; $i++){
						echo '<span class="dashicons dashicons-star-filled"></span>';
					}

				break;

				case "hotel_location":
					$terms = get_the_terms( $post->ID, 'destination' );

					if ( empty( $terms ) )
					break;
	
					$output = array();
	
					foreach ( $terms as $term ) {
						
						$output[] = sprintf( '<a href="%s">%s</a>',
							esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'destination' => $term->slug ), 'edit.php' ) ),
							esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'destination', 'display' ) )
						);
	
					}
	
					echo join( ', ', $output );

				break;
				
				default:
				break;
			}
		}
	} // /sp_hotel_cp_custom_column

	
	