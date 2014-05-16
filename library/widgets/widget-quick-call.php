<?php


/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/

class sp_widget_quick_call extends WP_Widget {
	/*
	*****************************************************
	* widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'sp-widget-quickcall';
		$prefix = SP_THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Quick call', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-quickcall',
			'description' => __( 'A widget present quick call ','sptheme_widget' )
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
		$call_number = $instance['call_number'];
		$skype_name = $instance['skype_name'];
		
		/* Before widget (defined by themes). */
		$out = $before_widget;
		
		/* Title of widget (before and after define by theme). */
		if ( $title )
			$out .= $before_title . $title . $after_title;

		$out .= '<p class="call-number">' . $call_number . '</p>';
		$out .= '<p>' . $desc . '</p>';

		$out .= '<script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>';
		$out .= '<div id="SkypeButton_Call_' . $skype_name . '_1">';
		$out .= '<script type="text/javascript">';
		$out .= 'Skype.ui({';
		$out .= '"name": "call",';
		$out .= '"element": "SkypeButton_Call_' . $skype_name . '_1",';
		$out .= '"participants": ["' . $skype_name . '"],';
		$out .= '"imageColor": "white",';
		$out .= '"imageSize": 32';
		$out .= '});';
		$out .= '</script>';
		$out .= '</div>';
	
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
		$instance['call_number'] = strip_tags( $new_instance['call_number'] );
		$instance['desc'] = strip_tags( $new_instance['desc'] );
		$instance['skype_name'] = strip_tags( $new_instance['skype_name'] );
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'Quick Call', 'desc' => 'Call 24 hours a day, 7 days a week!', 'skype_name' => 'bonnyseng', 'call_number' => '(+855) 12 608 108');
		$instance = wp_parse_args( (array) $instance, $defaults); ?>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'sptheme_widget') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'call_number' ); ?>"><?php _e('Call number:', 'sptheme_widget') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'call_number' ); ?>" name="<?php echo $this->get_field_name( 'call_number' ); ?>" value="<?php echo $instance['call_number']; ?>"  class="widefat">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'desc' ); ?>"><?php _e('Descriptoin:', 'sptheme_widget') ?></label>
		<textarea id="<?php echo $this->get_field_id( 'desc' ); ?>" name="<?php echo $this->get_field_name( 'desc' ); ?>" class="widefat" rows="5"><?php echo $instance['desc']; ?></textarea> 
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'skype_name' ); ?>"><?php _e('Skype name:', 'sptheme_widget') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'skype_name' ); ?>" name="<?php echo $this->get_field_name( 'skype_name' ); ?>" value="<?php echo $instance['skype_name']; ?>" class="widefat">
		</p>

        
	   <?php 
    }
} //end class
?>