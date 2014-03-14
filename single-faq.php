<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
	
	<div id="main" role="main">	
	<?php get_template_part( 'library/content/loop', 'faq' ); ?>
	</div>
	<!-- #main -->	
	
<?php get_footer(); ?>