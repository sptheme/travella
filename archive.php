<?php get_header(); ?>

		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', SP_TEXT_DOMAIN ), get_the_date() );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', SP_TEXT_DOMAIN ), get_the_date( _x( 'F Y', 'monthly archives date format', SP_TEXT_DOMAIN ) ) );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', SP_TEXT_DOMAIN ), get_the_date( _x( 'Y', 'yearly archives date format', SP_TEXT_DOMAIN ) ) );

						else :
							_e( 'Archives', SP_TEXT_DOMAIN );

						endif;
					?>
				</h1>
			</header><!-- .page-header -->

			<!-- Begin Results -->
        	<div class="results-list clearfix">
            <ol>
                <?php while (have_posts()) : the_post(); ?>
                    <li id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>> <?php the_title(); ?></li>
                <?php endwhile; 
                    // Pagination
                    if(function_exists('wp_pagenavi'))
                        wp_pagenavi();
                    else 
                        echo sp_pagination();
                ?>
            </ol>
	        </div>
	        <!-- End Results -->

	        <?php else : // If the search did not match any entries
	        	get_template_part('library/content/error404');
	        endif; ?>
		</div><!-- #content -->

<?php get_sidebar();
get_footer(); ?>
