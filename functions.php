<?php
 
/* ---------------------------------------------------------------------- */
/*	Define constant
/* ---------------------------------------------------------------------- */

 
$shortname = get_template(); 

//WP 3.4+ only
$themeData     = wp_get_theme( $shortname );
$themeName     = $themeData->Name;
$themeName = str_replace( ' ', '', $themeName );

//Basic constants	
define( 'SP_THEME_NAME', strtoupper($themeName) );
define( 'SP_TEXT_DOMAIN', strtolower($themeName) );
define( 'SP_SCRIPTS_VERSION', '20140312' ); // yyyymmdd
define( 'SP_ADMIN_LIST_THUMB', '64x64' ); //thumbnail size (width x height) on post/

define( 'SP_BASE_DIR',   get_template_directory() . '/' );
define( 'SP_BASE_URL',     get_template_directory_uri() . '/' );
define( 'SP_ASSETS_THEME', get_template_directory_uri() . '/assets/' );
define( 'SP_ASSETS_ADMIN', get_template_directory_uri() . '/library/assets/' );

/* Custom post WordPress admin menu position - 30, 33, 39, 42, 45, 48 */
if ( ! isset( $cp_menu_position ) )
	$cp_menu_position = array(
			'sp_slider'		=> 30,
			'sp_tour'		=> 33,
			'sp_faq'		=> 39
		);

$days_of_tour = array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15');

/* ---------------------------------------------------------------------- */
/*	Load some backend functions
/* ---------------------------------------------------------------------- */
/* theme setup */
require_once( SP_BASE_DIR . 'library/functions/theme-setup.php');
require_once( SP_BASE_DIR . 'library/functions/theme-functions.php');

//Theme Admin
require_once( SP_BASE_DIR . 'library/functions/admin-functions.php' );
