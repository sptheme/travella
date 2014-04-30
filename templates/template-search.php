<?php
/*
Template Name: Search page
*/
get_header(); ?>
<div id="content" class="container clearfix">
	<div id="main" role="main">
    <header class="page-header">
	    <h1 class="page-title">
	        <?php echo __('Search results for:',SP_TEXT_DOMAIN)." ".$_GET['term']; ?>
	    </h1>
	</header><!-- .page-header -->
	<?php 
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	/*$args = array( 
	    'post_type' => 'tour', 
	    's' => $_GET['term'], 
	    'tax_query' => array(
	            'relation' => 'OR',
	            array(
	                'taxonomy' => 'destination',
	                'field' => 'id',
	                'terms' => $_GET['destination']
	            ),
	            array(
	                'taxonomy' => 'tour-type',
	                'field' => 'id',
	                'terms' => $_GET['tour_type']
	            )),
	    'paged' => $paged, 
	    'posts_per_page' => 2
	    );*/
	$args = array( 
	    'post_type' => 'tour', 
	    's' => $_GET['term'], 
	    'paged' => $paged
	    );
	$queryposts = new WP_Query($args); // Display all search results on one page

	// If there are search results
	if ($queryposts->have_posts()) :
	?>

	<!-- Begin Results -->
	<div class="tour-results-list clearfix">
	    <ul>
	        <?php while ($queryposts->have_posts()) : $queryposts->the_post(); 
	            echo '<li>' . sp_render_thumbnail_tour() .'</li>';  
	        endwhile; ?>
	    </ul>
	    <?php // Pagination
	        if(function_exists('wp_pagenavi'))
	            wp_pagenavi();
	        else 
	            echo sp_pagination($queryposts->max_num_pages); 
	    ?>
	</div>
	<!-- End Results -->

	<?php else : // If the search did not match any entries ?>

	    <h3 class="entry-title"><?php _e( 'Sorry, we cannot find what you are searching for!', SP_TEXT_DOMAIN ); ?></h3>
	    <p><?php _e( 'Please try new search again!', SP_TEXT_DOMAIN ); ?></p>

	<?php endif; wp_reset_postdata(); ?>

    	
    </div><!-- #main -->
	<?php get_sidebar(); ?>
</div>	
<?php get_footer(); ?>
