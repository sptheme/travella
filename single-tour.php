<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

<?php echo sp_tour_photos(); ?>

<div id="content" class="container clearfix">	
	<div id="main" role="main">	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		get_template_part( 'library/content/content', 'tour' );
	endwhile; else :
		get_template_part('library/content/error404');
	endif; ?>
	<?php  ?>
	</div>
	<!-- #main -->	
	<?php get_sidebar('tour'); ?>
</div><!-- #content -->		
<?php get_footer(); ?>