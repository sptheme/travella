<?php get_header(); ?>
	<?php get_search_form(); ?>
	<section id="home">
		<h1>Welcome to homepage</h1>
		<p>This is a <a href="demo.html">simple</a> welcome page.</p>
	</section>

	<?php get_template_part('library/content/searchform-tour'); ?>

	<h2>Destination</h2>
	<?php echo sp_get_all_terms_destination(); ?>
        
<?php get_footer(); ?>
    