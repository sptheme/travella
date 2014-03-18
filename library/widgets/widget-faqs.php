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
		$sub_nav = $instance['sub_nav'];
		
		/* Before widget (defined by themes). */
		$out = $before_widget;
		
		/* Title of widget (before and after define by theme). */
		if ( $title )
			$out .= $before_title . $title . $after_title;

		if ($sub_nav):
			$out .= sp_get_terms('faq-category');
		else: 
			$out .= sp_get_faqs_list('faq');
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
		$instance['sub_nav'] = strip_tags( $new_instance['sub_nav'] );
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => 'FAQs Categories', 'sub_nav' => true);
		$instance = wp_parse_args( (array) $instance, $defaults); ?>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'sptheme_widget') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat">
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'sub_nav' ); ?>">Sub navigation : </label>
			<input id="<?php echo $this->get_field_id( 'sub_nav' ); ?>" name="<?php echo $this->get_field_name( 'sub_nav' ); ?>" value="<?php echo $instance['sub_nav']; ?>" <?php if( $instance['sub_nav'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
        
	   <?php 
    }
} //end class
?>