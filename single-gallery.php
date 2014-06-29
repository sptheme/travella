<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

<div id="content" class="container clearfix">	
	<div id="main" role="main">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
					<header class="entry-header">
						<h1 class="entry-title">
							<?php the_title(); ?>
						</h1>
						<!-- <div class="entry-meta"><?php the_time('j M, Y'); ?></div> -->
					</header>

					<div class="entry-content">
						<?php echo sp_get_latest_photogallery( $post->ID ); ?>
					</div><!-- .entry-content -->

				</article><!-- #post -->

		<?php endwhile;
		else : 
			get_template_part('library/content/error404');
		endif; ?>
	</div><!-- #main -->
	<?php get_sidebar();?>
</div><!-- #content -->	
<?php get_footer(); ?>