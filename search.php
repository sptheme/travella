<?php
/**
 * The template for displaying Search Results pages.
 */
get_header(); ?>
	<div id="main" role="main">
    	
    	<?php if(!empty($_GET['s']) && ($_GET['post_type'] == 'tour')) { 
            get_template_part('library/content/search-tours');
        } else { ?>
        <header class="page-header">
            <h1 class="page-title">
                <?php echo __('Search results for: ',SP_TEXT_DOMAIN)." ".esc_attr( get_search_query() ); ?>
            </h1>
        </header><!-- .page-header -->
        <?php if (have_posts()) : ?>
        <div class="results-list clearfix">
            <ol>
                <?php while (have_posts()) : the_post(); ?>
                    
                    <li id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                        <?php the_excerpt(); ?>
                    </li>

                <?php endwhile; ?>
            </ol>
            <?php // Pagination
                if(function_exists('wp_pagenavi'))
                    wp_pagenavi();
                else 
                    echo sp_pagination(); ?>
        </div>
        <!-- End Results -->

        <?php else : // If the search did not match any entries ?>

            <h3 class="entry-title"><?php _e( 'Sorry, we cannot find what you are searching for!', SP_TEXT_DOMAIN ); ?></h3>
            <p><?php _e( 'Please try new search again!', SP_TEXT_DOMAIN ); ?>
            <?php get_search_form(); ?>

        <?php endif; ?>
        <?php } // end query string ?>
    	
    </div><!-- #main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
