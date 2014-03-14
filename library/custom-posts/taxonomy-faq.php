<?php
add_action('init', 'sp_tax_faq_init', 0);

function sp_tax_faq_init() {
	
	register_taxonomy(
		'faq-category',
		array( 'faq' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'FAQ Category', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'faq-category' ),
			'show_in_nav_menus' => false
		)
	);
}