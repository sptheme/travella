<?php


/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/

class sp_widget_faqs extends WP_Widget {
	/*
	*****************************************************
	* widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'sp-widget-faq';
		$prefix = SP_THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'FAQs', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-faq',
			'description' => __( 'A widget that present categories of FAQs','sptheme_widget' )
			);
		$control_ops = array();

		//$this->WP_Widget( $id, $name, $widget_ops, $control_ops );
		parent::__construct( $id, $name, $widget_ops, $control_ops );
		
	}
		
		
	function widget( $args, $instance) {
		extract ($args);
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title']);
		$view_type = $instance['view_type'];
		
		/* Before widget (defined by themes). */
		$out = $before_widget;
		
		/* Title of widget (before and after define by theme). */
		if ( $title )
			$out .= $before_title . $title . $after_title;

		if ($view_type == 'category'):
			$out .= sp_get_terms('faq-category');
		else: 
			$out .= sp_get_popular_faqs_posts();
		endif;
	
		/* After widget (defined by themes). */		
		$out .= $after_widget;

		echo $out;
	}	
	
	/**
	 * Update the widget settings.
	 */	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['view_type'] = strip_tags( $new_instance['view_type'] );
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'FAQs Categories', 'view_type' => 'popular');
		$instance = wp_parse_args( (array) $instance, $defaults); ?>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'sptheme_widget') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat">
		</p>

		<p>
			<strong><?php _e('Display as:', 'sptheme_widget') ?></strong><br>
			<input type="radio" name="<?php echo $this->get_field_name( 'view_type' ); ?>" value="popular" <?php if( $instance['view_type'] == 'popular' ) echo 'checked="checked"'; ?>><small>Popular FAQs</small><br>
			<input type="radio" name="<?php echo $this->get_field_name( 'view_type' ); ?>" value="category" <?php if( $instance['view_type'] == 'category' ) echo 'checked="checked"'; ?>><small>FAQs Category</small>
		</p>

	<?php 
    }
} //end class
?>