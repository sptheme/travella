<?php
add_action('init', 'sp_tax_destination_init', 0);

function sp_tax_destination_init() {
	
	register_taxonomy(
		'destination',
		array( 'tour', 'hotel' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'Destination', 'sptheme_admin' ),
				'singular_name' => __( 'Destination', 'sptheme_admin' ),
				'search_items' =>  __( 'Search Destination', 'sptheme_admin' ),
				'all_items' => __( 'All Destinations', 'sptheme_admin' ),
				'parent_item' => __( 'Parent Destination', 'sptheme_admin' ),
				'parent_item_colon' => __( 'Parent Destination:', 'sptheme_admin' ),
				'edit_item' => __( 'Edit Destination', 'sptheme_admin' ),
				'update_item' => __( 'Update Destination', 'sptheme_admin' ),
				'add_new_item' => __( 'Add New Destination', 'sptheme_admin' ),
				'new_item_name' => __( 'Destination', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'destination' ),
			'show_in_nav_menus' => false
		)
	);
}