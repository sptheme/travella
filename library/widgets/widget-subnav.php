<?php


/*
*****************************************************
*      WIDGET CLASS
*****************************************************
*/

class sp_widget_subnav extends WP_Widget {
	/*
	*****************************************************
	*      widget constructor
	*****************************************************
	*/
	function __construct() {
		$id     = 'sp-widget-subnav';
		$prefix = SP_THEME_NAME . ': ';
		$name   = '<span>' . $prefix . __( 'Sub Navigation', 'sptheme_widget' ) . '</span>';
		$widget_ops = array(
			'classname'   => 'sp-widget-subnav',
			'description' => __( 'Show Page Sub Navigation','sptheme_widget' )
			);
		$control_ops = array();

		//$this->WP_Widget( $id, $name, $widget_ops, $control_ops );
		parent::__construct( $id, $name, $widget_ops, $control_ops );
		
		}

	function form($instance) {
	
		
		$instance = wp_parse_args( (array) $instance, array('level' => 1,'pagename' => '') );
        
		$level = $instance['level'];
        $pagename = $instance['pagename'];

?>
        
        <p>
            <label for="<?php echo $this->get_field_id('pagename'); ?>">
               <?php _e('Show Page Name:', 'chthemes'); ?>
            </label>
            <input type="checkbox" id="<?php echo $this->get_field_id('pagename'); ?>" name="<?php echo $this->get_field_name('pagename'); ?>" value="yes" <?php if ( $pagename == 'yes' ) echo 'checked="yes"'; ?> />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('level'); ?>">
               <?php _e('Level:', 'chthemes'); ?>
            </label>
            <select id="<?php echo $this->get_field_id('level'); ?>" name="<?php echo $this->get_field_name('level'); ?>">
                <option value="1" <?php if ( $level == '1' ) echo 'selected'; ?>>1</option>
                <option value="2" <?php if ( $level == '2' ) echo 'selected'; ?>>2</option>
                <option value="3" <?php if ( $level == '3' ) echo 'selected'; ?>>3</option>
                <option value="4" <?php if ( $level == '4' ) echo 'selected'; ?>>4</option>
                <option value="5" <?php if ( $level == '5' ) echo 'selected'; ?>>5</option>
                <option value="6" <?php if ( $level == '6' ) echo 'selected'; ?>>6</option>
                <option value="7" <?php if ( $level == '7' ) echo 'selected'; ?>>7</option>
                <option value="8" <?php if ( $level == '8' ) echo 'selected'; ?>>8</option>
            </select>
        </p>


<?php
    }

	function update($new_instance, $old_instance) {
        
        $instance=$old_instance;

        $instance['level'] = $new_instance['level'];
        $instance['pagename'] = $new_instance['pagename'];
        
        return $instance;

    }

	function widget($args, $instance) {
	
		extract($args);

		$level = $instance['level'];        
        $pagename = $instance['pagename'];		
		
        if( is_page() ):
        
		echo $before_widget;
        
        global $post;
        global $wpdb;
        
		if($post->post_parent){
			
    		$relations = array();
			
            $result = $wpdb->get_results( "SELECT ID FROM wp_posts WHERE post_parent = $post->ID AND post_type='page'" );
            
            if ($result){
            
            foreach($result as $pageID){
            	array_push($relations, $pageID->ID);
            }
            
            $relations_string = implode(",",$relations);
            
            $sidelinks = wp_list_pages("title_li=&echo=0&sort_column=menu_order&include=".$relations_string);
      		
      		$submenutitle = get_the_title();
    		    
            } else {
                $sidelinks = wp_list_pages("title_li=&echo=0&depth=".$level."&sort_column=menu_order&child_of=".$post->post_parent);
                $submenutitle = get_the_title($post->post_parent);
            }
            
		} else {
            $sidelinks = wp_list_pages("title_li=&echo=0&depth=".$level."&sort_column=menu_order&child_of=".$post->ID);
            $submenutitle = get_the_title();
		}
		
		if ($sidelinks) { ?>
            
            <?php if( $pagename == 'yes' ){ ?>
            <div class="widget-title">
                <h3><?php echo $submenutitle; ?></h3>
            </div>
            <?php } ?>
            <ul>
            <?php echo $sidelinks; ?>
            </ul>
            
		<?php }
        		
		echo $after_widget;
        
        endif;
		
	}

}
    
?>