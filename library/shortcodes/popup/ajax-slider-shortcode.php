<?php

add_action('wp_ajax_sp_slider_shortcode', 'sp_slider_shortcode_ajax' );

function sp_slider_shortcode_ajax(){
	$defaults = array(
		'slider' => null
	);
	$args = array_merge( $defaults, $_GET );
	?>

	<div id="sc-slider-form">
			<table id="sc-slider-table" class="form-table">
				<tr>
					<?php $field = 'slide_id'; ?>
					<th><label for="<?php echo $field; ?>"><?php _e( 'Select slide', 'sptheme_admin' ); ?></label></th>
					<td>
						<select name="<?php echo $field; ?>" id="<?php echo $field; ?>">
							<option value="-1" selected><?php _e( 'Select slider', 'sptheme_admin' ); ?></option>
						<?php
						$args = (array(
							'post_type' => 'slider',
							'limit' => -1
						));
						$posts = get_posts( $args );
						foreach ( $posts as $post ) {
							echo '<option class="level-0" value="' . $post->ID . '">' . $post->post_title . '</option>';
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<?php $field = 'slide_num'; ?>
					<th><label for="<?php echo $field; ?>"><?php _e( 'Number of slide', 'sptheme_admin' ); ?></label></th>
					<td>
						<input type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>" value="-1" /> <smal>(-1 for show all)</small>
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="button" id="option-submit" class="button-primary" value="<?php printf( __( 'Insert %s', 'sptheme_admin' ), __( 'Add Slideshow', 'sptheme_admin' ) ); ?>" name="submit" />
			</p>
	</div>			

	<?php
	exit();	
}
?>