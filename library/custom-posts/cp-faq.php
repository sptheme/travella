<?php
/*
*****************************************************
* FAQ custom post
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
		add_action( 'init', 'sp_faq_cp_init' );
		//CP list table columns
		add_action( 'manage_posts_custom_column', 'sp_faq_cp_custom_column' );

		//FILTERS
		//CP list table columns
		add_filter( 'manage_edit-faq_columns', 'sp_faq_cp_columns' );




/*
*****************************************************
*      2) CREATING A CUSTOM POST
*****************************************************
*/
	/*
	* Custom post registration
	*/
	if ( ! function_exists( 'sp_faq_cp_init' ) ) {
		function sp_faq_cp_init() {
			global $cp_menu_position;

			/*if ( $smof_data['sp_newsticker_revisions'] )
				$supports[] = 'revisions';*/
			$labels = array(
				'name'               => __( 'FAQs', 'sptheme_admin' ),
				'singular_name'      => __( 'FAQ', 'sptheme_admin' ),
				'add_new'            => __( 'Add New', 'sptheme_admin' ),
				'all_items'          => __( 'All FAQs', 'sptheme_admin' ),
				'add_new_item'       => __( 'Add New FAQ', 'sptheme_admin' ),
				'new_item'           => __( 'Add New FAQ', 'sptheme_admin' ),
				'edit_item'          => __( 'Edit FAQ', 'sptheme_admin' ),
				'view_item'          => __( 'View FAQ', 'sptheme_admin' ),
				'search_items'       => __( 'Search FAQ', 'sptheme_admin' ),
				'not_found'          => __( 'No FAQ found', 'sptheme_admin' ),
				'not_found_in_trash' => __( 'No FAQ found in trash', 'sptheme_admin' ),
				'parent_item_colon'  => __( 'Parent FAQ', 'sptheme_admin' ),
			);	

			$role     = 'post'; // page
			$slug     = 'faqs';
			$supports = array('title', 'editor'); // 'title', 'editor', 'thumbnail'

			$args = array(
				'labels' 				=> $labels,
				'rewrite'               => array( 'slug' => $slug ),
				'menu_position'         => $cp_menu_position['sp_faq'],
				'menu_icon'           	=> 'dashicons-lightbulb',
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
			register_post_type( 'faq' , $args );
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
	if ( ! function_exists( 'sp_faq_cp_columns' ) ) {
		function sp_faq_cp_columns( $columns ) {
			
			$columns = array(
				'cb'                   	=> '<input type="checkbox" />',
				'title'                	=> __( 'Question', 'sptheme_admin' ),
				'faq_category'			=> __( 'Category', 'sptheme_admin' ),
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
	if ( ! function_exists( 'sp_faq_cp_custom_column' ) ) {
		function sp_faq_cp_custom_column( $column ) {
			global $post;
			
			switch ( $column ) {
				

				case "faq_category":
					$terms = get_the_terms( $post->ID, 'faq-category' );

					if ( empty( $terms ) )
					break;
	
					$output = array();
	
					foreach ( $terms as $term ) {
						
						$output[] = sprintf( '<a href="%s">%s</a>',
							esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'faq-category' => $term->slug ), 'edit.php' ) ),
							esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'faq-category', 'display' ) )
						);
	
					}
	
					echo join( ', ', $output );

				break;
				
				default:
				break;
			}
		}
	} // /sp_faq_cp_custom_column

	
	