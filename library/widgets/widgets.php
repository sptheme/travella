<?php

/* ---------------------------------------------------------------------- */
/*	Register sidebars
/* ---------------------------------------------------------------------- */
function sp_widgets_init() {
	
	// Default Sidebar
	register_sidebar( array(
		'name' 			=> __( 'Default Sidebar', 'sptheme_admin' ),
		'id' 			=> 'default-sidebar',
		'description' 	=> __( 'Drag widgets into this sidebar', 'sptheme_admin' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> "</div>",
		'before_title' 	=> '<div class="widget-title"><h3>',
		'after_title' 	=> '</h3></div>',
	) );
	
	// Page Sidebar
	register_sidebar( array(
		'name' 			=> __( 'Page Sidebar', 'sptheme_admin' ),
		'id' 			=> 'pape-sidebar',
		'description' 	=> __( 'Drag widgets to present on static pages', 'sptheme_admin' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> "</div>",
		'before_title' 	=> '<div class="widget-title"><h3>',
		'after_title' 	=> '</h3></div>',
	) );

	// FAQs Sidebar
	register_sidebar( array(
		'name' 			=> __( 'FAQs Sidebar', 'sptheme_admin' ),
		'id' 			=> 'faq-sidebar',
		'description' 	=> __( 'Drag widgets to present on FAQs page', 'sptheme_admin' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' 	=> "</div>",
		'before_title' 	=> '<div class="widget-title"><h3>',
		'after_title' 	=> '</h3></div>',
	) );
	
	
	// Addon widgets		
	require_once ( SP_BASE_DIR . 'library/widgets/widget-assistant.php' );
	require_once ( SP_BASE_DIR . 'library/widgets/widget-faqs.php' );
		
	// Register widgets
	register_widget( 'sp_widget_assistant' );
	register_widget( 'sp_widget_faqs' );

}
add_action('widgets_init', 'sp_widgets_init');

/* ---------------------------------------------------------------------- */
/*	Sidebars Generator
/* ---------------------------------------------------------------------- */

// Class to generate sidebar on the fly
//require_once( SP_BASE_DIR . 'library/widgets/sidebar-generator.php' );

/*adds support for the new avia sidebar manager*/
/*add_theme_support('avia_sidebar_manager');

if(get_theme_support( 'avia_sidebar_manager' )) new avia_sidebar();		*/