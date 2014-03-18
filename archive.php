<?php get_header(); ?>

<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>	
		<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
						if ( is_tax() ) :
							echo $term->name;
						elseif ( is_day() ) :
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

			<?php
					// Start the Loop.
					get_template_part('library/content/loop', 'archive');

				else :
					// If no content, include the "No posts found" template.
					get_template_part('library/content/error404');

				endif;
			?>
		</div><!-- #content -->

<?php get_sidebar();
get_footer(); ?>
