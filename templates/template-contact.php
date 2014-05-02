<?php
/*
Template Name: Contact page
*/
get_header(); ?>
<div id="content" class="container clearfix">
	<div id="main" role="main">
	
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">					
	  jQuery(document).ready(function ($)
		{
			var locations = [
				['<div class="map-infowindow"><strong>Head Office: Phnom Penh</strong></div>', 11.592475,104.931313],
				['<div class="map-infowindow"><strong>Branch #1 Siem Reap</strong></div>', 13.363661,103.856152],
				['<div class="map-infowindow"><strong>Branch #2 Germany</strong></div>', 50.113533, 8.712158],
				['<div class="map-infowindow"><strong>Branch #3 Italy</strong></div>', 43.08243, 12.01561]
	        ];
			
			var map = new google.maps.Map(document.getElementById('contact-map'), {
				  scrollwheel: false,
				  zoom: 2,
				  center: new google.maps.LatLng(35.626773,46.425781),
				  mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			
			var infowindow = new google.maps.InfoWindow();
			var marker, i;

			for (i = 0; i < locations.length; i++) {  
			  marker = new google.maps.Marker({
				position: new google.maps.LatLng(locations[i][1], locations[i][2]),
				map: map,
				travelMode: google.maps.TravelMode["Driving"], //Driving or Walking or Bicycling or Transit
				animation: google.maps.Animation.DROP,
			  });
		
			  google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
				  infowindow.setContent(locations[i][0]);
				  infowindow.open(map, marker);
				}
			  })(marker, i));
			
			    google.maps.event.addListener(map, "click", function(){
				  infowindow.close();
				});
			};
		});
	</script>
	<div id="contact-map"></div>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</header>
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post -->
		<?php endwhile;
		else : 
			get_template_part('library/content/error404');
		endif; ?>
	</div><!-- #main -->
	<?php get_sidebar();?>
</div><!-- #content -->	
<?php get_footer(); ?>