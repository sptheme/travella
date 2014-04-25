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
define( 'SP_ASSETS_ADMIN', get_template_directory_uri() . '/library/admin/assets/' );

/* Custom post WordPress admin menu position - 30, 33, 39, 42, 45, 48 */
if ( !isset( $cp_menu_position ) )
	$cp_menu_position = array(
			'sp_slider'			=> 30,
			'sp_tour'			=> 33,
			'sp_accommodation'	=> 39,
			'sp_faq'			=> 42
		);

if ( !isset( $currency ) )
	$currency = array('USD', 'EUR');

if ( !isset( $days_of_tour ) )
	$days_of_tour = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15');

if ( !isset( $adults ) )
	$adults = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10');

if ( !isset( $children ) )
	$children = array('0', '1', '2', '3', '4', '5');

if ( !isset( $hotel_levels ) )
	$hotel_levels = array(
			'1'	=> 'Level 1',
			'2'	=> 'Level 2',
			'3'	=> 'Level 3',
			'4'	=> 'Level 4',
			'5'	=> 'Level 5'
		);

if ( !isset( $type_tour_rate )){
	$type_tour_rate = array(
			'1' => '1 pax',
			'2' => '2 pax',
			'3' => '3-4 pax',
			'4' => '5-6 pax',
			'5' => '7-10 pax',
			'6' => '11-15 pax',
			'7' => '16-20 pax',
			'8' => 'Sup. Single'
		);
}

/* ---------------------------------------------------------------------- */
/*	Load some backend functions
/* ---------------------------------------------------------------------- */
/* theme setup */
require_once( SP_BASE_DIR . 'library/functions/theme-setup.php');
require_once( SP_BASE_DIR . 'library/functions/aq_resizer.php');
require_once( SP_BASE_DIR . 'library/functions/theme-functions.php');

//Theme Admin
require_once( SP_BASE_DIR . 'library/functions/admin-functions.php' );
