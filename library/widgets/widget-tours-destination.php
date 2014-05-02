<?php


/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/

class sp_widget_tours_destination extends WP_Widget {
	/*
	*****************************************************
	* widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'sp-widget-tours-destination';
		$prefix = SP_THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Tour by Destination', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-tours-destination',
			'description' => __( 'A widget that allows to view tours by each destination','sptheme_widget' )
			);
		$control_ops = array();

		//$this->WP_Widget( $id, $name, $widget_ops, $control_ops );
		parent::__construct( $id, $name, $widget_ops, $control_ops );
		
	}
		
		
	function widget( $args, $instance) {
		extract ($args);
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title']);
		$exclude_terms = $instance['exclude_terms'];
		
		/* Before widget (defined by themes). */
		$out = $before_widget;
		
		/* Title of widget (before and after define by theme). */
		if ( $title )
			$out .= $before_title . $title . $after_title;

		$out .= sp_get_all_terms_destination($instance['exclude_terms']);

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
		$instance['exclude_terms'] = strip_tags( $new_instance['exclude_terms'] );
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Tours by Destination');
		$instance = wp_parse_args( (array) $instance, $defaults); ?>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'sptheme_widget') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'exclude_terms' ); ?>"><?php _e('Destination to be excluded:', 'sptheme_widget') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'exclude_terms' ); ?>" name="<?php echo $this->get_field_name( 'exclude_terms' ); ?>" size="3" value="<?php echo $instance['exclude_terms']; ?>" class="widefat">
		<small><?php echo _e('Place terms id and separate by <strong>,</strong>', SP_TEXT_DOMAIN); ?></small>
		</p>

        
	   <?php 
    }
} //end class
?>