<?php

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 650;
	
/* ---------------------------------------------------------------------- */
/*	Setup wordpress theme support
/* ---------------------------------------------------------------------- */
	
add_action( 'after_setup_theme', 'sp_theme_setup' );
if( !function_exists('sp_theme_setup') )
{
	function sp_theme_setup(){
		
		// Makes theme available for translation.
		load_theme_textdomain( SP_TEXT_DOMAIN, get_template_directory() . '/languages' );
		
		// Add visual editor stylesheet support
		add_editor_style( SP_ASSETS_THEME . 'css/base.css');
	
		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
	
		// Add navigation menus
		register_nav_menus( array(
			'primary'	=> __( 'Main Navigation', SP_TEXT_DOMAIN ),
			'footer'  	=> __( 'Footer Navigation', SP_TEXT_DOMAIN )
		) );
	
		// Add suport for post thumbnails and set default sizes
		add_theme_support( 'post-thumbnails' );
		
		add_image_size('tour-mini', 88, 60, true);
		add_image_size('tour-thumb', 232, 157, true); 
		add_image_size('tour-large', 650, 433, true ); 
		
	}

}

/* ---------------------------------------------------------------------- */
/*	Register and add styles and scripts for fontend
/* ---------------------------------------------------------------------- */
if( !function_exists('sp_frontend_scripts_styles') )
{
	if(!is_admin()){
		add_action('wp_enqueue_scripts', 'sp_frontend_scripts_styles'); //print Script and CSS
	}

	function sp_frontend_scripts_styles() {
		
		//Register CSS style
		//wp_enqueue_style('gfont-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,400italic', false, '1');
		wp_enqueue_style('theme-info', SP_BASE_URL . 'style.css', false, '1');
		wp_enqueue_style('normalize', SP_ASSETS_THEME . 'css/normalize.css', false, '1');
		wp_enqueue_style('base', SP_ASSETS_THEME . 'css/base.css', false, '1');
		wp_enqueue_style('flexslider', SP_ASSETS_THEME . 'css/flexslider.css', false, '1');
		wp_enqueue_style('layout', SP_ASSETS_THEME . 'css/layout.css', false, '1');

		//Register scripts
		wp_enqueue_script('jquery-easing', SP_ASSETS_THEME . 'js/jquery.easing.min.js', array('jquery'), SP_SCRIPTS_VERSION, true);
		wp_enqueue_script('flexslider', SP_ASSETS_THEME . 'js/jquery.flexslider.js', array('jquery'), SP_SCRIPTS_VERSION, true);
		wp_enqueue_script('custom', SP_ASSETS_THEME . 'js/custom.js', array('jquery'), SP_SCRIPTS_VERSION, true);

		if ( is_singular() && comments_open() ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

/* ---------------------------------------------------------------------- */
/*	Print customs css
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_print_custom_css') ){

	add_action('wp_head', 'sp_print_custom_css');
	
	function sp_print_custom_css(){
		global $smof_data;
?>
	<style type="text/css">
		body{
		
		}
	</style>
<?		
	}
}

/* ---------------------------------------------------------------------- */
/*	Show main and footer navigation
/* ---------------------------------------------------------------------- */

if( !function_exists('sp_main_navigation')) {

	function sp_main_navigation() {
		
		// set default main menu if wp_nav_menu not active
		if ( function_exists ( 'wp_nav_menu' ) )
			wp_nav_menu( array(
				'container'      => false,
				'menu_class'	 => 'nav-menu',
				'theme_location' => 'primary',
				'fallback_cb' => 'sp_main_nav_fallback'
				) );
		else
			sp_main_nav_fallback();	
	}
}

if (!function_exists('sp_main_nav_fallback')) {
	
	function sp_main_nav_fallback() {
    	
		$menu_html = '<ul class="nav-menu clear">';
		$menu_html .= '<li><a href="'.admin_url('nav-menus.php').'">'.esc_html__('Add Main menu', SP_TEXT_DOMAIN).'</a></li>';
		$menu_html .= '</ul>';
		echo $menu_html;
		
	}
	
}

/* ---------------------------------------------------------------------- */
/*	Makes some changes to the <title> tag, by filtering the output of wp_title()
/* ---------------------------------------------------------------------- */

if( !function_exists('sp_filter_wp_title')) {

	add_filter('wp_title', 'sp_filter_wp_title', 10, 2);

	function sp_filter_wp_title( $title, $separator ) {

		if ( is_feed() ) return $title;

		global $paged, $page;

		if ( is_search() ) {
			$title = sprintf(__('Search results for %s', SP_TEXT_DOMAIN), '"' . get_search_query() . '"');

			if ( $paged >= 2 )
				$title .= " $separator " . sprintf(__('Page %s', SP_TEXT_DOMAIN), $paged);

			$title .= " $separator " . get_bloginfo('name', 'display');

			return $title;
		}

		$title .= get_bloginfo('name', 'display');
		$site_description = get_bloginfo('description', 'display');

		if ( $site_description && ( is_home() || is_front_page() ) )
			$title .= " $separator " . $site_description;

		if ( $paged >= 2 || $page >= 2)
			$title .= " $separator " . sprintf(__('Page %s', SP_TEXT_DOMAIN), max($paged, $page) );

		return $title;

	}

}		

/* ---------------------------------------------------------------------- */
/*	Visual editor improvment
/* ---------------------------------------------------------------------- */

if ( is_admin() ) {
	add_filter( 'mce_buttons', 'sp_add_buttons_row1' );
	add_filter( 'mce_buttons_2', 'sp_add_buttons_row2' );
}
	
/*
* Add buttons to visual editor first row
*
* $buttons = ARRAY [default WordPress visual editor buttons array]
*/
if ( ! function_exists( 'sp_add_buttons_row1' ) ) {
	function sp_add_buttons_row1( $buttons ) {
		//inserting buttons after "italic" button
		$pos = array_search( 'italic', $buttons, true );
		if ( $pos != false ) {
			$add = array_slice( $buttons, 0, $pos + 1 );
			$add[] = 'underline';
			$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
		}

		//inserting buttons after "justifyright" button
		$pos = array_search( 'justifyright', $buttons, true );
		if ( $pos != false ) {
			$add = array_slice( $buttons, 0, $pos + 1 );
			$add[] = 'justifyfull';
			$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
		}
		
		return $buttons;
	}
} // /sp_add_buttons_row1

/*
* Add buttons to visual editor second row
*
* $buttons = ARRAY [default WordPress visual editor buttons array]
*/
if ( ! function_exists( 'sp_add_buttons_row2' ) ) {
	function sp_add_buttons_row2( $buttons ) {
		//inserting buttons before "underline" button
		$pos = array_search( 'underline', $buttons, true );
		if ( $pos != false ) {
			$add = array_slice( $buttons, 0, $pos );
			$add[] = 'removeformat';
			$add[] = '|';
			$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
		}

		//remove "justify full" button from second row
		$pos = array_search( 'justifyfull', $buttons, true );
		if ( $pos != false ) {
			unset( $buttons[$pos] );
			$add = array_slice( $buttons, 0, $pos + 1 );
			$add[] = '|';
			$add[] = 'sub';
			$add[] = 'sup';
			$add[] = '|';
			$buttons = array_merge( $add, array_slice( $buttons, $pos + 1 ) );
		}

		return $buttons;
	}
} // sp_add_buttons_row2

/* ---------------------------------------------------------------------- */
/*	Customizable login screen and WordPress admin area
/* ---------------------------------------------------------------------- */

// Custom logo login
add_action('login_head', 'sp_custom_login_logo');
function sp_custom_login_logo() {
    echo '<style type="text/css">
		body.login{ background-color:#ffffff; }
        .login h1 a { background-image:url('.SP_ASSETS_THEME.'images/logo.png) !important; width:166px; height:45px; background-size: auto auto !important;}
    </style>';
}

// Remove wordpress link on admin login logo
add_filter('login_headerurl', 'sp_remove_link_on_admin_login_info');
function sp_remove_link_on_admin_login_info() {
     return  get_bloginfo('url');
}

// Change login logo title
add_filter('login_headertitle', 'sp_change_loging_logo_title');
function sp_change_loging_logo_title(){
	return 'Go to '.get_bloginfo('name').' Homepage';
}

//	Remove logo and other items in Admin menu bar
add_action( 'wp_before_admin_bar_render', 'sp_remove_admin_bar_links' );
function sp_remove_admin_bar_links() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('wp-logo');
}

//  Remove wordpress version generation
add_filter('the_generator', 'sp_remove_version_info');
function sp_remove_version_info() {
     return '';
}

//  Clean up wp_head()
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

// Customising footer text
add_filter('admin_footer_text', 'sp_modify_footer_admin');
function sp_modify_footer_admin () {  
  echo 'Created by <a href="http://www.novacambodia.com" target="_blank">novadesign</a>. Powered by <a href="http://www.wordpress.org" target="_blank">WordPress</a>';  
} 

//  Set favicons for backend code
add_action( 'admin_head', 'sp_adminfavicon' );
function sp_adminfavicon() {
echo '<link rel="icon" type="image/x-icon" href="'.SP_BASE_URL.'favicon.ico" />';
}