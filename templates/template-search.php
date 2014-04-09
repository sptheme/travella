<?php
/*
Template Name: Search page
*/
get_header(); ?>
	<div id="main" role="main">
    <h3>Custom search page</h3>    
        <?php if (isset($_GET['term'])) {
		echo $_GET['term'];
	} ?>
    	
    </div><!-- #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
