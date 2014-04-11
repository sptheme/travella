<?php get_header(); ?>

<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
	<div id="main" role="main">

		<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php echo $term->name; ?>
			</h1>
		</header><!-- .page-header -->

		<?php
				// Start the Loop.
				echo '<ul>';
				while ( have_posts() ) : the_post();
				echo '<li>' . sp_render_thumbnail_tour() .'</li>';				
				endwhile;
				echo '</ul>';

				if(function_exists('wp_pagenavi'))
                    wp_pagenavi();
                else 
                    echo sp_pagination();

			else :
				// If no content, include the "No posts found" template.
				get_template_part('library/content/error404');

			endif;
		?>
	</div><!-- #content -->

<?php get_sidebar();
get_footer(); ?>
