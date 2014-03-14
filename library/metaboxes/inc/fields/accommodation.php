<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Accommodation_Field' ) ) 
{
	class RWMB_Accommodation_Field extends RWMB_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{
			wp_enqueue_style( 'rwmb-accommodation', RWMB_CSS_URL . 'accommodation.css', array(), RWMB_VER );
			wp_enqueue_script( 'rwmb-accommodation', RWMB_JS_URL.'accommodation.js', array(), RWMB_VER, true );
		}

		/**
		* Get field HTML
		*
		* @param $field
		* @param $meta
		*
		* @return string
		*/
		static function html( $meta, $field ) 
		{

			global $post, $days_of_tour;

			$id = $field['id'];

			$accommodations = get_post_meta( $post->ID, $id, true ) ? maybe_unserialize(get_post_meta( $post->ID, $id, true )) : false;

			$html = '<ul id="accommodations" class="postbox">';

				if( $accommodations ) {

					foreach ( $accommodations as $i => $line ) {

						$comm_type			= isset( $line['comm-type'] )		? $line['comm-type']		: null;
						$comm_value			= isset( $line['comm-value'] )		? $line['comm-value']		: null;
						
						
						$html .= '<li class="hotel-option">
									<div class="inside">
										<div class="rwmb-field">

											<div class="rwmb-label">
												<label>' . __('Comm line', 'sptheme_admin') . '</label>
											</div><!-- end .rwmb-label -->

											<div class="rwmb-input">
											<table>
												<tr class="hotel-destination">
												<td width="110">
												<select name="comm-type[]" class="rwmb-select">';
										foreach ($days_of_tour as $key => $value) :
											$html .= '<option value="' . $key . '" ' . selected( $comm_type, $key, false ) . '>' . $value . '</option>';
										endforeach;	
										$html .= '</select>
												</td>
												<td width="95"><input type="text" name="comm-value[]" class="rwmb-text" size="30" value="' . $comm_value . '"></td>
												<td width="20"><button class="remove-hotel-option button-secondary">' . __('Remove line', 'sptheme_admin') . '</button><td>
												</tr>
											</table>
											</div><!-- end .rwmb-input -->

										</div><!-- end .rwmb-field -->

										
										<input type="hidden" name="' . $id . '[]" class="rwmb-text" size="30" value="">
								
									</div><!-- end .inside -->
									
								</li>';

					}

				} else {


						$html .= '<li class="hotel-option">
									<div class="inside">
												
										<div class="rwmb-field">

											
											<div class="rwmb-input">
											<table>
												<tr>
												<td><label>' . __('Location', 'sptheme_admin') . '</label></td>
												<td><label>' . __('Hotel name', 'sptheme_admin') . '</label></td>
												<td><label>' . __('Room type', 'sptheme_admin') . '</label></td>
												<td><label>' . __('Level', 'sptheme_admin') . '</label></td>
												</tr>
												<tr>
												<td>
												<input type="text" name="hotel-location[]" class="rwmb-text" value=""></td>
												<td><input type="text" name="hotel-name[]" class="rwmb-text" value=""></td>
												<td><input type="text" name="room-type[]" class="rwmb-text" value=""></td>
												<td>
												<select name="hotel-level[]" class="rwmb-select">';
										foreach ($days_of_tour as $key => $value) :
											$html .= '<option value="' . $key . '">' . $value . '</option>';
										endforeach;	
										$html .= '</select>
												</td>
												<td width="20"><button class="remove-hotel-location button-secondary">' . __('Remove line', 'sptheme_admin') . '</button><td>
												</tr>
											</table>	
											<button class="add-hotel-location button-secondary">' . __('+ New location', 'sptheme_admin') . '</button>
											</div><!-- end .rwmb-input -->

										</div><!-- end .rwmb-field -->

										<button class="remove-hotel-option button-secondary">' . __('- Remove options', 'sptheme_admin') . '</button>
										
										<input type="hidden" name="' . $id . '[]" class="rwmb-text" size="30" value="">
								
									</div><!-- end .inside -->
									
								</li>';

				}

				$html .= '</ul><!-- end #open-hours -->
							
						  <p> 
						  <button id="add-hotel-option" class="button-primary">' . __('+ Add options', 'sptheme_admin') . '</button>

						  </p>

						  <input type="hidden" name="accommodation-meta-info" value="' . $post->ID . '|' . $id . '">';

			return $html;
		}

		/**
		 * Save slides
		 *
		 * @param mixed $new
		 * @param mixed $old
		 * @param int $post_id
		 * @param array $field
		 *
		 * @return void
		 */
		static function save( $new, $old, $post_id, $field )
		{
				
			$name = $field['id'];

			$accommodations = array();
			
			foreach( $_POST[$name] as $k => $v ) {

				$accommodations[] = array(
					'comm-type'      => $_POST['comm-type'][$k],
					'comm-value'      => $_POST['comm-value'][$k]
				);

			}

			$new = maybe_serialize( $accommodations );

			update_post_meta( $post_id, $name, $new );

		}
	}
}