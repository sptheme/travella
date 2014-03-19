<?php
/**
 * The sidebar containing the main widget area.
 */

global $post;
?>

	<aside id="sidebar" class="widget-area" role="complementary">

	<?php if ( is_active_sidebar('faq-sidebar') ) :	
			dynamic_sidebar('faq-sidebar');
	else:?>	
			<div class="non-widget widget">
		    <h3><?php _e('Sidebar ', SP_TEXT_DOMAIN); ?></h3>
		    <p class="noside"><?php _e('To edit this sidebar, go to admin backend\'s <strong><em>Appearance -&gt; Widgets</em></strong> and place widgets into the <strong><em>'.$sidebar_choice.'</em></strong> Area', SP_TEXT_DOMAIN); ?></p>
		    </div>
	<?php endif; ?>
	</aside> <!--End #Sidebar-->
