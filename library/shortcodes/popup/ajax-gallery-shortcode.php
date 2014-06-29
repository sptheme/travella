<?php

add_action('wp_ajax_sp_gallery_shortcode', 'sp_gallery_shortcode_ajax' );

function sp_gallery_shortcode_ajax(){
	$defaults = array(
		'gallery' => null
	);
	$args = array_merge( $defaults, $_GET );
	?>

	<div id="sc-gallery-form">
			<table id="sc-gallery-table" class="form-table">
				<tr>
					<?php $field = 'gallery_id'; ?>
					<th><label for="<?php echo $field; ?>"><?php _e( 'Select album: ', 'sptheme_admin' ); ?></label></th>
					<td>
						<select name="<?php echo $field; ?>" id="<?php echo $field; ?>">
							<option class="level-0" value="-1"><?php _e( 'All albums', 'sptheme_admin' ); ?></option>
							<?php
							/*$args = (array(
								'post_type' => 'gallery',
								'post_per_pages' => -1
							));
							$posts = get_posts( $args );
							foreach ( $posts as $post ) {
								echo '<option class="level-0" value="' . $post->ID . '">' . $post->post_title . '</option>';
							}*/
							?>
						</select>
					</td>
				</tr>
				<tr>
					<?php $field = 'gallery_num'; ?>
					<th><label for="<?php echo $field; ?>"><?php _e( 'Number of photo: ', 'sptheme_admin' ); ?></label></th>
					<td>
						<input type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>" value="-1" /> <smal>(-1 for show all)</small>
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="button" id="option-submit" class="button-primary" value="<?php _e( 'Add Gallery', 'sptheme_admin' ); ?>" name="submit" />
			</p>
	</div>			

	<?php
	exit();	
}
?>