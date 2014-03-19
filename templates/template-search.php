<?php
/*
Template Name: Search page
*/
get_header(); ?>
	<div id="main" role="main">
        
        <?php
        global $wp_query;
        $total_results = $wp_query->found_posts;
        echo $total_results;
        ?>
    	
    </div><!-- #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
