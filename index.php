<?php get_header(); ?>

	<section id="destinations">
		<div class="container clearfix">
		<header class="section-title">
		<h2><?php _e('TOP Destination', SP_TEXT_DOMAIN); ?></h2>
		<p><?php _e('Your can be there with Eurasie Travel to visit <br>Asia’s popular destinations cover...', SP_TEXT_DOMAIN); ?></p>
		</header>
		<?php echo sp_render_main_destinations(); ?>
		</div>
	</section> <!-- .main-destination -->

	<section id="latest-offer">
		<header class="section-title">
		<h2><?php _e('Explore our latest offers', SP_TEXT_DOMAIN); ?></h2>
		</header>
		<?php echo sp_latest_tour_offer(); ?>
	</section> <!-- #latest-offer -->
        
<?php get_footer(); ?>
    