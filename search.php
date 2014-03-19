<?php
/**
 * The template for displaying Search Results pages.
 */
get_header(); ?>
	<div id="main" role="main">
    	
    	<?php if(!empty($_GET['s'])) { ?>
            <header class="page-header">
                <h1 class="page-title">
                    <?php echo __('Search results for:',SP_TEXT_DOMAIN)." ".esc_attr( get_search_query() ); ?>
                </h1>
            </header><!-- .page-header -->
        <?php } ?>
        <?php 
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array( 
            'post_type' => 'tour', 
            's' => $_GET['s'], 
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
            'posts_per_page' => 3
            );
        $queryposts = new WP_Query($args); // Display all search results on one page

        // If there are search results
        if ($queryposts->have_posts()) :
        ?>

        <!-- Begin Results -->
        <div class="results-list clearfix">
            <ol>

                <?php while ($queryposts->have_posts()) : $queryposts->the_post(); ?>
                    
                    <li id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                            <?php the_title(); ?>
                    </li>

                <?php endwhile; 
                    wp_reset_query();
                    // Pagination
                    if(function_exists('wp_pagenavi'))
                        wp_pagenavi();
                    else 
                        echo sp_pagination($queryposts->max_num_pages);
                ?>

            </ol>
        </div>
        <!-- End Results -->

        <?php else : // If the search did not match any entries ?>

            <h3 class="entry-title"><?php _e( 'Sorry, we cannot find what you are searching for!', SP_TEXT_DOMAIN ); ?></h3>
            <p><?php _e( 'Please try new search again!', SP_TEXT_DOMAIN ); ?>
            <?php get_search_form(); ?>

        <?php endif; ?>
    	
    </div><!-- #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
