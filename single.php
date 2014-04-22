<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div id="content" class="container clearfix">
	<div id="main" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		get_template_part( 'library/content/content', 'standard' );
	endwhile; else :
		get_template_part('library/content/error404');
	endif; ?>
	</div><!-- #main -->
	<?php get_sidebar(); ?>
</div><!-- #content -->	
<?php get_footer(); ?>