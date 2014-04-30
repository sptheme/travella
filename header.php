<?php global $smof_data; ?>
<!DOCTYPE html>
<!--[if IE 8 ]>    <html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js lt-ie9> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="no-js">
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />

	<title><?php wp_title('|', true, 'right'); ?></title>

	<?php if ( isset($smof_data['theme_favicon']) && $smof_data['theme_favicon'] ) : ?>
	<link rel="shortcut icon" href="<?php echo $smof_data['theme_favicon']; ?>" type="image/png" />
	<?php endif; ?>

	<!-- add feeds, pingback and stuff-->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php echo ($smof_data['feedburner'] == '') ? bloginfo( 'rss2_url' ) :  $smof_data['feedburner']; ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
	
</head>
<body <?php body_class(); ?>>

<div id="wrapper">
	<aside id="sidemenu-container" role="navigation">
		<div class="container clearfix">
		<div class="brand-desktop">
			<a  href="<?php echo home_url() ?>/"  title="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>">
                <?php if( isset($smof_data['theme_logo']) && $smof_data['theme_logo'] ) : ?>
                <img src="<?php echo $smof_data['theme_logo']; ?>" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" />
                <?php else: ?>
                <span><?php bloginfo( 'name' ); ?></span>
                <?php endif; ?>
            </a>
		</div>
	    <nav id="sidemenu">
	    	<?php echo sp_main_navigation(); ?>
	    </nav><!-- .primary-nav .wrap -->
		</div><!-- end .container .clearfix -->
	</aside><!-- #main-nav -->
	<header id="header" class="header">
		<div class="container clearfix">
			<div class="genericon genericon-menu" id="menu-trigger"></div>
	        <div class="brand">
	            <?php if( !is_singular() ) echo '<h1>'; else echo '<h2>'; ?>
	            
	            <a  href="<?php echo home_url() ?>/"  title="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>">
	                <?php if( isset($smof_data['theme_logo']) && $smof_data['theme_logo'] ) : ?>
	                <img src="<?php echo $smof_data['theme_logo']; ?>" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" />
	                <?php else: ?>
	                <span><?php bloginfo( 'name' ); ?></span>
	                <?php endif; ?>
	            </a>
	            
	            <?php if( !is_singular() ) echo '</h1>'; else echo '</h2>'; ?>
	        </div><!-- end .brand -->
		</div><!-- end .container .clearfix -->
	</header> <!-- #header -->
	<?php if ( is_home() ) : ?>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		$("#home-slider").flexslider({
			directionNav: false,
			controlNav: true,
			animation: "slide",
			pauseOnHover: true
		});
	});		
	</script>
	<?php $home_slide_setting = get_page_by_title($smof_data['home_slider'], 'post');
	$args = array( 'post_type' =>	'slider', 'p' => $home_slide_setting->ID, 'posts_per_page' => 1 );
	$custom_query = new WP_Query($args); ?>
	<section id="home-slider" class="flexslider">
		<ul class="slides">
	<?php while ($custom_query->have_posts()) :
		$custom_query->the_post();
		$home_sliders = rwmb_meta( 'sp_sliders', $args = array('type' => 'plupload_image') );
		foreach ( $home_sliders as $slide ){
			echo '<li><img src="' . $slide["full_url"] . '"></li>';
		}
	endwhile;
	wp_reset_postdata(); // Restore global post data ?>
		</ul>
	</section> <!-- #home-slider -->
	<?php endif; ?>

	<?php get_template_part('library/content/searchform-tour'); ?>
	
