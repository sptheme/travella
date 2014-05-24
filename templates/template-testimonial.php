<?php
/*
Template Name: Testimonial
*/
get_header(); ?>
<div id="content" class="container clearfix">
	<div id="main" role="main">
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
		
		<div class="testimonials">
		<?php 
			$args = array(
				'post_type'	=> 'testimonial',
				);
			$custom_query = new WP_Query($args);
			while ( $custom_query->have_posts() ): $custom_query->the_post();
			$tour_link = get_post_meta( get_the_ID() , 'sp_tour_link', true );
		?>
		<figure class="light">
		<blockquote>
			<?php the_content(); ?>
		</blockquote>
		<figcaption>
			<p><a href="<?php echo $tour_link; ?>"><?php the_title(); ?></a></p>
			<span><?php echo get_post_meta( get_the_ID() , 'sp_nationality', true ) ; ?></span>
		</figcaption>	
		</figure>
		<?php	
			endwhile;
			wp_reset_postdata(); // Restore global post data
		?>
		</div> <!-- .testimonials -->

	</div><!-- #main -->
	<?php get_sidebar();?>
</div><!-- #content -->	
<?php get_footer(); ?>