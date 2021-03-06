<?php


/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/

class sp_widget_cards_payment extends WP_Widget {
	/*
	*****************************************************
	* widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'sp-widget-cards-payment';
		$prefix = SP_THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Cards Payment', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-cards-payment',
			'description' => __( 'A widget present cards payments','sptheme_widget' )
			);
		$control_ops = array();

		//$this->WP_Widget( $id, $name, $widget_ops, $control_ops );
		parent::__construct( $id, $name, $widget_ops, $control_ops );
		
	}
		
		
	function widget( $args, $instance) {
		extract ($args);
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title']);
		
		/* Before widget (defined by themes). */
		$out = $before_widget;
		
		/* Title of widget (before and after define by theme). */
		if ( $title )
			$out .= $before_title . $title . $after_title;

		$out .= '<div class="payment-cards">';
		$out .= '<img src="' . SP_ASSETS_THEME . 'images/payment-card/visacard.png">';
		$out .= '<img src="' . SP_ASSETS_THEME . 'images/payment-card/discover.png">';
		$out .= '<img src="' . SP_ASSETS_THEME . 'images/payment-card/bank-transfer.png">';
		$out .= '<img src="' . SP_ASSETS_THEME . 'images/payment-card/paypal.png">';
		$out .= '<img src="' . SP_ASSETS_THEME . 'images/payment-card/american-express.png">';
		$out .= '<img src="' . SP_ASSETS_THEME . 'images/payment-card/mastercard.png">';
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
		
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form( $instance ) {
		/* Set up some default widget settings. */
		$defaults = array( 'title' => '');
		$instance = wp_parse_args( (array) $instance, $defaults); ?>
		
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'sptheme_widget') ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"  class="widefat">
		</p>

        
	   <?php 
    }
} //end class
?>