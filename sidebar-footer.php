<?php
/**
 * The sidebar containing the main widget area.
 */

global $post;
?>

	<aside id="footer-sidebar" class="footer-widgets" role="complementary">
		<div class="container clearfix">
	<?php if ( is_active_sidebar('footer-sidebar') ) :	
			dynamic_sidebar('footer-sidebar');
		else:?>	
			<div class="non-widget widget">
		     <h3><?php _e('Sidebar ', SP_TEXT_DOMAIN); ?></h3>
		    <p class="noside"><?php _e('To edit this sidebar, go to admin backend\'s <strong><em>Appearance -&gt; Widgets</em></strong> and place widgets into the <strong><em>Footer Sidebar 1</em></strong> Area', SP_TEXT_DOMAIN); ?></p>
		    </div>
	<?php endif; ?>
		</div> <!-- .container .clearfix -->
	</aside> <!--End #Sidebar-->
