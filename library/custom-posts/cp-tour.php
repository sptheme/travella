<?php
/*
*****************************************************
* Tour custom post
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
		add_action( 'init', 'sp_tour_cp_init' );
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_tour_cp_custom_column' );

	//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-tour_columns', 'sp_tour_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_tour_cp_init' ) ) {
		function sp_tour_cp_init() {
			global $cp_menu_position;

			/*if ( $smof_data['sp_newsticker_revisions'] )
				$supports[] = 'revisions';*/
			$labels = array(
				'name'               => __( 'Tours', 'sptheme_admin' ),
				'singular_name'      => __( 'tour', 'sptheme_admin' ),
				'add_new'            => __( 'Add New', 'sptheme_admin' ),
				'all_items'          => __( 'All tours', 'sptheme_admin' ),
				'add_new_item'       => __( 'Add New tour', 'sptheme_admin' ),
				'new_item'           => __( 'Add New tour', 'sptheme_admin' ),
				'edit_item'          => __( 'Edit tour', 'sptheme_admin' ),
				'view_item'          => __( 'View tour', 'sptheme_admin' ),
				'search_items'       => __( 'Search tour', 'sptheme_admin' ),
				'not_found'          => __( 'No tour found', 'sptheme_admin' ),
				'not_found_in_trash' => __( 'No tour found in trash', 'sptheme_admin' ),
				'parent_item_colon'  => __( 'Parent tour', 'sptheme_admin' ),
			);	

			$role     = 'post'; // page
			$slug     = 'tours';
			$supports = array('title', 'editor', 'thumbnail'); // 'title', 'editor', 'thumbnail'

			$args = array(
				'labels' 				=> $labels,
				'rewrite'               => array( 'slug' => $slug ),
				'menu_position'         => $cp_menu_position['sp_tour'],
				'menu_icon'           	=> 'dashicons-location',
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
			register_post_type( 'tour' , $args );
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
	if ( ! function_exists( 'sp_tour_cp_columns' ) ) {
		function sp_tour_cp_columns( $columns ) {
			
			$columns = array(
				'cb'                   	=> '<input type="checkbox" />',
				'tour_thumbnail'	   	=> __( 'Thumbnail', 'sptheme_admin' ),
				'title'                	=> __( 'Tour Name', 'sptheme_admin' ),
				'tour_departure' 		=> __( 'Departure', 'sptheme_admin' ),
				'tour_type'		 		=> __( 'Tour type', 'sptheme_admin' ),
				'tour_detination'		=> __( 'Destination', 'sptheme_admin' ),
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
	if ( ! function_exists( 'sp_tour_cp_custom_column' ) ) {
		function sp_tour_cp_custom_column( $column ) {
			global $post;
			
			switch ( $column ) {
				case "tour_thumbnail":
					$size = explode( 'x', SP_ADMIN_LIST_THUMB );
					if (get_the_post_thumbnail( $post->ID, $size, array( 'title' => get_the_title( $post->ID ) ) )) {
						echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . get_the_post_thumbnail( $post->ID, $size, array( 'title' => get_the_title( $post->ID ) ) ) . '</a>';	
					} else {
						$albums = rwmb_meta( 'sp_tour_album', $args = array('type' => 'plupload_image', 'size' => 'thumbnail') ); 
						$albums_count = 0;
						$cover_image = '';
						$size = explode( 'x', SP_ADMIN_LIST_THUMB );

						foreach ( $albums as $image ){
							if ($albums_count < 1) {
								$cover_image .= '<img src="' . $image["url"] . '" width="' . $size[0] . '" height="' . $size[1] . '" />';
							}	

							$albums_count++;
						}
						
						echo '<a href="' . get_edit_post_link( $post->ID ) . '">' . $cover_image . '</a>';
					}	

				break;

				case "tour_departure":
					$output = get_post_meta( $post->ID, 'sp_departure', true);
					echo '<small>' . $output . '</small>';

				break;

				case "tour_type":
					$terms = get_the_terms( $post->ID, 'tour-type' );

					if ( empty( $terms ) )
					break;
	
					$output = array();
	
					foreach ( $terms as $term ) {
						
						$output[] = sprintf( '<a href="%s">%s</a>',
							esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'tour-type' => $term->slug ), 'edit.php' ) ),
							esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'tour-type', 'display' ) )
						);
	
					}
	
					echo join( ', ', $output );

				break;

				case "tour_detination":
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
	} // /sp_tour_cp_custom_column

	
	