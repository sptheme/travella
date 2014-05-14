<?php
/*
Template Name: Tour type
*/
get_header(); ?>
<div id="content" class="container clearfix">
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
		<?php echo sp_get_tour_type_detail(); ?>
	</div><!-- #main -->
	<?php get_sidebar();?>
</div><!-- #content -->	
<?php get_footer(); ?>