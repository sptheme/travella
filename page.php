<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
	<div id="main" role="main">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</header>
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post -->
		<?php endwhile;
		else : 
			get_template_part('library/content/error404');
		endif; ?>
	</div><!-- #main -->
	<?php get_sidebar();?>
<?php get_footer(); ?>