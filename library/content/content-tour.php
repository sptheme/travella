<article class="post-<?php the_ID(); ?>">	<div class="three-fourth">	<header class="entry-header">		<h1 class="entry-title"><?php the_title(); ?></h1>	</header>	<div class="tour-meta">		<?php echo sp_tour_meta(); ?>	</div> <!-- .tour-meta -->	</div> <!-- .three-fourth -->	<div class="one-fourth last">	<center>	<?php $price_id = get_post_meta( get_the_ID(), 'sp_tour_price', true ); ?>	<div class="tour-price"><?php echo sp_get_tour_rate($price_id, 'min'); ?></div>	<a class="open-booking-form button yellow" href="#booking-form"><?php echo esc_attr__( 'Booking', SP_TEXT_DOMAIN ); ?></a><br>	<a class="open-included-box" href="#included-box"><?php echo esc_attr__( 'What’s included', SP_TEXT_DOMAIN ); ?></a>	</center>	</div> <!-- .one-fourth -->	<div class="clear"></div>	<?php $overview = get_post_meta( get_the_ID(), 'sp_overview', true ); ?>	<p class="overview"><?php echo $overview; ?></p>	<div id="tour-tabs">		<ul>			<li><a href="#highlight"><?php echo esc_attr__( 'Highlights', SP_TEXT_DOMAIN ); ?></a></li>			<li><a href="#itinerary"><?php echo esc_attr__( 'Itinerary', SP_TEXT_DOMAIN ); ?></a></li>			<li><a href="#accoms"><?php echo esc_attr__( 'Accommodations', SP_TEXT_DOMAIN ); ?></a></li>		</ul>		<div id="highlight">			<?php $highlight = get_post_meta( get_the_ID(), 'sp_highlight', true ); ?>			<?php echo $highlight; ?>		</div><!-- .highlight -->		<div id="itinerary">			<?php the_content(); ?>		</div><!-- .itinerary -->		<div id="accoms">			<?php echo sp_get_accommodation_optoins($price_id); ?>		</div><!-- .accommodation -->	</div><!-- .tabgroup -->	<div id="included-box" class="white-popup-block mfp-hide">	<?php echo sp_price_included_exlcuded(); ?>	</div><!-- .included-box -->	<?php get_template_part('library/content/booking-form'); ?>	</article>