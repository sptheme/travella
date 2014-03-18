<?php


/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/

class sp_widget_assistant extends WP_Widget {
	/*
	*****************************************************
	* widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'sp-widget-assistant';
		$prefix = SP_THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Assistant', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-assistant',
			'description' => __( 'A widget that allows to view assistant information','sptheme_widget' )
			);
		$control_ops = array();

		//$this->WP_Widget( $id, $name, $widget_ops, $control_ops );
		parent::__construct( $id, $name, $widget_ops, $control_ops );
		
	}
		
		
	function widget( $args, $instance) {
		extract ($args);
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title']);
		$desc = $instance['desc'];
		$call_assistant = $instance['call_assistant'];
		
		/* Before widget (defined by themes). */
		$out = $before_widget;
		
		/* Title of widget (before and after define by theme). */
		if ( $title )
			$out .= $before_title . $title . $after_title;

		$out .= $desc ;
		$out .= '<p class="call-assistant">' . $call_assistant . '</p>';
	
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
		$instance['desc'] = strip_tags( $new_instance['desc'] );
		$instance['call_assistant'] = strip_tags( $new_instance['call_assistant'] );
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Need Assistance?', 'desc' => 'Our team is 24/7 at your service to help you with your booking issues or answer any related questions.', 'call_assistant' => '(855) 12 608 108');
		$instance = wp_parse_args( (array) $instance, $defaults); ?>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'sptheme_widget') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Descriptoin:', 'sptheme_widget') ?></label>
		<textarea id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" class="widefat" rows="5"><?php echo $instance['desc']; ?></textarea> 
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'call_assistant' ); ?>"><?php _e('Phone number:', 'sptheme_widget') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'call_assistant' ); ?>" name="<?php echo $this->get_field_name( 'call_assistant' ); ?>" value="<?php echo $instance['call_assistant']; ?>" class="widefat">
		</p>

        
	   <?php 
    }
} //end class
?>