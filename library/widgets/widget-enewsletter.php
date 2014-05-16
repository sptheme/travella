<?php


/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/

class sp_widget_enewsletter extends WP_Widget {
	/*
	*****************************************************
	* widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'sp-widget-enewsletter';
		$prefix = SP_THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'eNewsletter', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-enewsletter',
			'description' => __( 'A widget that allows to subscribe enewsletter','sptheme_widget' )
			);
		$control_ops = array();

		//$this->WP_Widget( $id, $name, $widget_ops, $control_ops );
		parent::__construct( $id, $name, $widget_ops, $control_ops );
		
	}
		
		
	function widget( $args, $instance) {
		extract ($args);
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title']);
		$feed_desc = $instance['feed_desc'];
		$feed_address = $instance['feed_address'];
		
		/* Before widget (defined by themes). */
		$out = $before_widget;
		
		/* Title of widget (before and after define by theme). */
		if ( $title )
			$out .= $before_title . $title . $after_title;

		$out .= '<form class="subscriber" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open(\'http://feedburner.google.com/fb/a/mailverify?uri=' . $feed_address . '\', \'popupwindow\', \'scrollbars=yes,width=550,height=520\');return true">';
		$out .= '<label for="mail_subscriber">Get our FREE eNewsletter:</label>';
		$out .= '<input type="text" class="mail-subscriber" name="mail" placeholder="Enter your email…">';
		$out .= '<input type="hidden" value="' . $feed_address . '" name="uri"/>';
        $out .= '<input type="hidden" name="loc" value="en_US"/>';
		$out .= '<input type="submit" value="Subscribe Now" class="btn-subscriber">';
		$out .= '</form>';
	
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
		$instance['feed_desc'] = strip_tags( $new_instance['feed_desc'] );
		$instance['feed_address'] = strip_tags( $new_instance['feed_address'] );
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '', 'feed_desc' => 'Get our FREE eNewsletter:', 'feed_address' => 'EurasieTravel');
		$instance = wp_parse_args( (array) $instance, $defaults); ?>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'sptheme_widget') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'feed_desc' ); ?>"><?php _e('feed_descriptoin:', 'sptheme_widget') ?></label>
		<textarea id="<?php echo $this->get_field_id( 'feed_desc' ); ?>" name="<?php echo $this->get_field_name( 'feed_desc' ); ?>" class="widefat" rows="5"><?php echo $instance['feed_desc']; ?></textarea> 
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'feed_address' ); ?>"><?php _e('Phone number:', 'sptheme_widget') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'feed_address' ); ?>" name="<?php echo $this->get_field_name( 'feed_address' ); ?>" value="<?php echo $instance['feed_address']; ?>" class="widefat">
		</p>

        
	   <?php 
    }
} //end class
?>