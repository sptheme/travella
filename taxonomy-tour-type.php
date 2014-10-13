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

		<?php endif; ?>

		<?php 
			$args = array(
						'post_type' => 'tour',
						'tax_query' => array(
							array(
								'taxonomy' => 'tour-type',
								'field'    => 'slug',
								'terms'    => $term->slug,
							),
						),
						'posts_per_page'	=>	-1,

					);

			$tours = get_posts( $args );

			foreach ($tours as $post ) : setup_postdata( $post );
				$objects_ids[] = $post->ID;
			endforeach;
			wp_reset_postdata();

			$destinations = wp_get_object_terms( $objects_ids, 'destination' );

			if ( ! empty( $destinations ) ) {
				if ( ! is_wp_error( $destinations ) ) {
					echo '<ul class="tour-filters">';
					echo '<li class="current"><a data-filter="*" href="#">All</a></li>';
					foreach( $destinations as $term ) {
						if( $term->parent == 0 ){
							echo '<li><a data-filter=".' . strtolower($term->name) . '" href="#">' . $term->name . '</a></li>'; 
						}
					}
					echo '</ul>';
				}
			}
		?>	

		<div class="tour-results-list clearfix">

		<?php

			$custom_query = new WP_Query($args);
	 		
	 		// Start the Loop.
			echo '<ul class="post-isotope">';
			while ( $custom_query->have_posts() ) : $custom_query->the_post();
				$term_list = get_the_term_list($post->ID, 'destination', '', ' ', '');
				echo '<li class="isotope-item all ' . strtolower(strip_tags($term_list)) . '">' . sp_render_thumbnail_tour() .'</li>';				
			endwhile;
			echo '</ul>';
			wp_reset_postdata();
			
		?>
	</div><!-- .tour-results-list clearfix -->
	</div><!-- #content -->

<?php get_sidebar(); ?>
</div><!-- #content -->
<?php get_footer(); ?>
