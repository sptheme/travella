<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>
<div id="content" class="container clearfix">	
	<div id="main" role="main">	
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		get_template_part( 'library/content/content', 'faq' );
	endwhile; else : 
		get_template_part('library/content/error404');
	endif; ?>

	<div id="related-fqas">
		<h3><?php _e( 'Related FAQs:', SP_TEXT_DOMAIN ); ?></h3>
		<ul>
		<?php $taxonomy = 'faq-category';
			$post_related = sp_get_posts_related_by_taxonomy( $post->ID, $taxonomy );
			while ( $post_related->have_posts() ): $post_related->the_post(); ?>
			<li><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', SP_TEXT_DOMAIN ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></li>
		<?php endwhile; ?>
		</ul>
	</div> <!-- #related-fqas -->

	</div>
	<!-- #main -->	
	<?php get_sidebar('faq'); ?>
</div><!-- #content -->		
<?php get_footer(); ?>