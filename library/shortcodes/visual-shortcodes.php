<?php
/**
 * Short codes in visual editor
 * Register short code buttons and add them to the visual mode of editor
 */

// Register Buttons
function register_buttons( $buttons ) {
	array_push( $buttons, 'col' );
	array_push( $buttons, 'horz_rule' );
	array_push( $buttons, 'email_encoder' );
	array_push( $buttons, 'slider' );
	array_push( $buttons, 'accordion' );

    return $buttons;
}

// Register TinyMCE Plugin
function add_plugins($plugin_array) {
	$js_path = SP_BASE_URL . 'library/shortcodes/tinymce/';
	$plugin_array['col'] 			= $js_path . 'sc-columns.js';
	$plugin_array['horz_rule']		= $js_path . 'sc-hr.js';
	$plugin_array['email_encoder']	= $js_path . 'sc-email-encoder.js';
	$plugin_array['slider']			= $js_path . 'sc-slider.js';
	$plugin_array['accordion']		= $js_path . 'sc-accordion.js';
	
    return $plugin_array;
 }

// Initialization Function
function add_buttons() {

    if ( current_user_can( 'edit_posts' ) &&  current_user_can( 'edit_pages' ) ) {
	  add_filter( 'mce_external_plugins', 'add_plugins' );
      add_filter( 'mce_buttons_3', 'register_buttons' );
	}
 }
add_action( 'init', 'add_buttons' );  

require_once( SP_BASE_DIR . 'library/shortcodes/popup/ajax-slider-shortcode.php');
//require_once( SP_BASE_DIR . 'library/shortcodes/popup/ajax-portfolio-shortcode.php');

?>