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
		add_image_size('tour-thumb', 190, 129, true); 
		add_image_size('tour-large', 940, 416, true ); 

		update_option('medium_size_w', 200);
		update_option('medium_size_h', 140);
		update_option('medium_crop', 1);
		
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
		wp_enqueue_style('gfont-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700', false, '1');
		wp_enqueue_style('theme-info', SP_BASE_URL . 'style.css', false, '1');
		wp_enqueue_style('genericons', SP_ASSETS_THEME . 'css/genericons.css', false, '1');
		wp_enqueue_style('normalize', SP_ASSETS_THEME . 'css/normalize.css', false, '1');
		wp_enqueue_style('base', SP_ASSETS_THEME . 'css/base.css', false, SP_SCRIPTS_VERSION);
		wp_enqueue_style('flexslider', SP_ASSETS_THEME . 'css/flexslider.css', false, '1');
		wp_enqueue_style('jquery-ui-datepicker', SP_ASSETS_THEME . 'css/jquery-ui-1.10.4.datepicker.min.css', false, '1');
		wp_enqueue_style('magnific-popup', SP_ASSETS_THEME . 'css/magnific-popup.css', false, '1');
		wp_enqueue_style('layout', SP_ASSETS_THEME . 'css/layout.css', false, SP_SCRIPTS_VERSION);

		//Register scripts
		wp_enqueue_script('modernizr', SP_ASSETS_THEME . 'js/modernizr.js', array(), SP_SCRIPTS_VERSION, false);
		wp_enqueue_script('jquery-easing', SP_ASSETS_THEME . 'js/jquery.easing.min.js', array('jquery'), SP_SCRIPTS_VERSION, true);
		wp_enqueue_script('jquery-mockjax', SP_ASSETS_THEME . 'js/jquery.mockjax.js', array('jquery'), SP_SCRIPTS_VERSION, true);
		wp_enqueue_script('jquery-form', SP_ASSETS_THEME . 'js/jquery.form.js', array('jquery'), SP_SCRIPTS_VERSION, true);
		wp_enqueue_script('jquery-validate', SP_ASSETS_THEME . 'js/jquery.validate.min.js', array('jquery'), SP_SCRIPTS_VERSION, true);
		wp_enqueue_script('flexslider', SP_ASSETS_THEME . 'js/jquery.flexslider.js', array('jquery'), SP_SCRIPTS_VERSION, true);
		wp_enqueue_script('magnific-popup', SP_ASSETS_THEME . 'js/jquery.magnific-popup.min.js', array('jquery'), SP_SCRIPTS_VERSION, false);
		wp_enqueue_script('custom', SP_ASSETS_THEME . 'js/custom.js', array('jquery', 'jquery-ui-datepicker'), SP_SCRIPTS_VERSION, true);

		if ( is_archive() ) {
			wp_enqueue_script('imageloaded', SP_ASSETS_THEME . 'js/imagesloaded.pkgd.min.js', array('jquery'), SP_SCRIPTS_VERSION, false);
			wp_enqueue_script('isotope', SP_ASSETS_THEME . 'js/isotope.pkgd.min.js', array('jquery'), SP_SCRIPTS_VERSION, false);
		}	

		if ( is_singular() && comments_open() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$config_array = array(
	        'ajaxURL' => admin_url( 'admin-ajax.php' )
	    );
		wp_localize_script( 'custom', 'custom_obj', $config_array );
	}
}

/* ---------------------------------------------------------------------- */
/*	Print customs css
/* ---------------------------------------------------------------------- */
if ( !function_exists('sp_print_custom_css_script') ){

	add_action('wp_head', 'sp_print_custom_css_script');
	
	function sp_print_custom_css_script(){
?>
	<?php if ( is_archive() ) : ?>
	<style type="text/css">
		ul.tour-filters { 
			list-style: none; 
			text-align: center;
		}
		ul.tour-filters li {
			display: inline-block;
			margin: 5px 10px;
		}
		ul.tour-filters li a {
			font-size: 12px;
			display: inline-block;
			border:2px solid #3b5998;
			padding: 2px 20px;
			text-transform: uppercase;
			-webkit-border-radius: 4px;
			 -moz-border-radius: 4px;
			      border-radius: 4px;
		}
		ul.tour-filters li.current a,
		ul.tour-filters li a:hover{ 
			color: #fff;
			background: #00963f;
			border:2px solid #00a847;
		}
		.isotope, .post-isotope {
		  transition-duration: 0.6s;
		  -o-transition-duration: 0.6s;
		  -ms-transition-duration: 0.6s;
		  -moz-transition-duration: 0.6s;
		  -webkit-transition-duration: 0.6s;
		}
		.isotope, .post-isotope {
		  transition-property: height, width;
		  -o-transition-property: height, width;
		  -ms-transition-property: height, width;
		  -moz-transition-property: height, width;
		  -webkit-transition-property: height, width;
		}
	</style>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			var $container = $('.post-isotope').imagesLoaded( function() {
			  $container.isotope({
			    itemSelector: '.isotope-item',
			    layoutMode: 'fitRows'
			  });
			});

			var filterFns = {
				numberGreaterThan50: function() {
				 var number = $(this).find('.number').text();
				 return parseInt( number, 10 ) > 50;
				},
				ium: function() {
				 var name = $(this).find('.name').text();
				 return name.match( /ium$/ );
				}
			};

			$('.tour-filters li a').on( 'click', function( event ) {
				event.preventDefault();
				var filterValue = $( this ).attr('data-filter');
				filterValue = filterFns[ filterValue ] || filterValue;
				$container.isotope({ filter: filterValue });

				$('.tour-filters li').removeClass('current');
				$( this ).parent().addClass('current');
			});
		});
	</script>		
	<?php endif; ?>

	<?php if ( is_page() || is_singular( 'tour' ) || is_singular( 'gallery' ) ) : ?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
	    $('a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]').each(function(){
	        if ($(this).parents('.gallery').length == 0) {
	            $(this).magnificPopup({
	                type:'image',
	                closeOnContentClick: true,
	                });
	            }
	        });
	    $('.gallery').each(function() {
	        $(this).magnificPopup({
	            delegate: 'a',
	            type: 'image',
	            gallery: {enabled: true}
	            });
	        });
	    });

	</script>
	<?php endif; ?>
<?php		
	}
}

/* ---------------------------------------------------------------------- */
/*	Show main and footer navigation
/* ---------------------------------------------------------------------- */

if( !function_exists('sp_main_navigation')) {

	function sp_main_navigation() {
		
		// set default main menu if wp_nav_menu not active
		if ( function_exists ( 'wp_nav_menu' ) ):
			$menu = wp_nav_menu( array(
					'container'      => false,
					'menu_class'	 => 'primary-nav',
					'theme_location' => 'primary',
					'fallback_cb' 	 => 'sp_main_nav_fallback',
					'echo'           => false,
					) );
			/* Adding "+" buttons for dropdown menus */
			$search = '<ul class="sub-menu">';
			$replace = '<span class="nav-child-container"><span class="nav-child-trigger">+</span></span>
						<ul class="sub-menu" style="height: 0;">';
			/*if ( wp_is_mobile() )						
				return str_replace($search, $replace, $menu);
			else
				return $menu;*/
			return str_replace($search, $replace, $menu);		
		else:
			sp_main_nav_fallback();	
		endif;
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

if( !function_exists('sp_footer_navigation')) {

	function sp_footer_navigation() {
		
		// set default footer menu if wp_nav_menu not active
		if ( function_exists ( 'wp_nav_menu' ) )
			wp_nav_menu( array(
				'container'      => false,
				'menu_class'	 => 'nav-footer-menu',
				'theme_location' => 'footer',
				'fallback_cb' => 'sp_footer_nav_fallback'
				) );
		else
			sp_footer_nav_fallback();	
	}
}

if (!function_exists('sp_footer_nav_fallback')) {
	
	function sp_footer_nav_fallback() {
    	
		$menu_html = '<ul class="nav-footer-menu clear">';
		$menu_html .= '<li><a href="'.admin_url('nav-menus.php').'">'.esc_html__('Add footer menu', SP_TEXT_DOMAIN).'</a></li>';
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
	global $smof_data;
    echo '<style type="text/css">
		body.login{ background-color:#ffffff; }
        .login h1 a { background-image:url('.$smof_data['theme_logo'].') !important; height: 100px!important; width: 100%!important; background-size: auto!important;}
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

//  Set favicons for backend code
add_action( 'admin_head', 'sp_adminfavicon' );
function sp_adminfavicon() {
	echo '<link rel="icon" type="image/x-icon" href="'.SP_BASE_URL.'favicon.ico" />';
}