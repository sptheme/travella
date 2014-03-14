<?php

add_action('wp_ajax_sp_portfolio_shortcode', 'sp_portfolio_shortcode_ajax' );

function sp_portfolio_shortcode_ajax(){
	$defaults = array(
		'category' => null
	);
	$args = array_merge( $defaults, $_GET );
	?>

	<div id="sc-portfolio-form">
			<table id="sc-portfolio-table" class="form-table">
				<tr>
					<?php $field = 'category_id'; ?>
					<th><label for="option-<?php echo $field; ?>"><?php _e( 'Portfolio category', 'sptheme_admin' ); ?></label></th>
					<td>
						<select name="<?php echo $field; ?>" id="option-<?php echo $field; ?>">
							<option value="-1" selected><?php _e( 'Select category', 'sptheme_admin' ); ?></option>
						<?php
						$args = array(
			                'type' => 'work',
			                'orderby' => 'name',
			                'taxonomy' => 'work-category',
			            );
			            $of_cats_obj = get_categories( $args );
				        foreach ($of_cats_obj as $cat){
				             echo '<option class="level-0" value="' . $cat->cat_ID . '">' . $cat->cat_name . '</option>';
				        } 
						?>
						</select>
					</td>
				</tr>
			</table>
			<p class="submit">
				<input type="button" id="option-submit" class="button-primary" value="<?php printf( __( 'Insert %s', 'sptheme_admin' ), __( 'Insert Portfolio', 'sptheme_admin' ) ); ?>" name="submit" />
			</p>
	</div>			

	<?php
	exit();	
}
?>