<?php get_header(); ?>
<div id="content" class="container clearfix">
<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
	<div id="main" role="main">

		<?php if ( have_posts() ) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php echo $term->name; ?>
			</h1>
		</header><!-- .page-header -->

		<?php if ( !empty($term->description) ) : ?>
		<div class="entry-post">
		<p><?php echo $term->description; ?></p>
		</div>
		<?php endif; ?>

		<?php 
			$term_slug = $term->slug;
			$args = array(
						'post_type'			=> 'tour',
						array(
							'taxonomy' => 'tour-type',
							'field' => 'slug',
							'terms' => $term_slug
						),
						'posts_per_page'	=>	-1,

					);

			$tourtype = get_posts( $args );

			foreach ($tourtype as $post ) :
				$objects_ids[] = $post->ID;
			endforeach;

			$destinations = wp_get_object_terms( $objects_ids, 'destination' );

			if ( ! empty( $destinations ) ) {
				if ( ! is_wp_error( $destinations ) ) {
					echo '<ul>';
					foreach( $destinations as $term ) {
						if( $term->parent == 0 ){
							echo '<li><a href="#' . strtolower($term->name) . '">' . $term->name . '</a> <span class="tour-count">' . $term->count . ' Tours</span></li>'; 
						}
					}
					echo '</ul>';
				}
			}
		?>	

		<div class="tour-results-list clearfix">
		<?php
				// Start the Loop.
				echo '<ul>';
				while ( have_posts() ) : the_post();
				$term_list = get_the_term_list($post->ID, 'destination', '', ' ', '');

				echo '<li class="' . strtolower(strip_tags($term_list)) . '">' . sp_render_thumbnail_tour() .'</li>';				
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
	</div><!-- .tour-results-list clearfix -->
	</div><!-- #content -->

<?php get_sidebar(); ?>
</div><!-- #content -->
<?php get_footer(); ?>
