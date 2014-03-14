<?php
add_action('init', 'sp_tax_tour_type_init', 0);

function sp_tax_tour_type_init() {
	register_taxonomy(
		'tour-type',
		array( 'tour' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'Tour type', 'sptheme_admin' ),
				'singular_name' => __( 'tour type', 'sptheme_admin' ),
				'search_items' =>  __( 'Search tour type', 'sptheme_admin' ),
				'all_items' => __( 'All tour types', 'sptheme_admin' ),
				'parent_item' => __( 'Parent tour type', 'sptheme_admin' ),
				'parent_item_colon' => __( 'Parent tour type:', 'sptheme_admin' ),
				'edit_item' => __( 'Edit tour type', 'sptheme_admin' ),
				'update_item' => __( 'Update tour type', 'sptheme_admin' ),
				'add_new_item' => __( 'Add New tour type', 'sptheme_admin' ),
				'new_item_name' => __( 'tour type', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'tour-type' ),
			'show_in_nav_menus' => false
		)
	);
}

?>