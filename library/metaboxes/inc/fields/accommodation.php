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
			wp_enqueue_style( 'rwmb-contact-info', RWMB_CSS_URL . 'accommodation.css', array(), RWMB_VER );
			wp_enqueue_script( 'rwmb-contact-info', RWMB_JS_URL.'accommodation.js', array(), RWMB_VER, true );
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

			$accom_infos = get_post_meta( $post->ID, $id, true ) ? maybe_unserialize(get_post_meta( $post->ID, $id, true )) : false;
			$hotels = sp_get_hotel_posts();

			$html = '<ul id="accom-infos">';

			if ($accom_infos){
				foreach ( $accom_infos as $options => $option ) {

					$html .= '<li class="accom-opt-line postbox">';
					$html .= '<h4>Option '.($options+1).'</h4>';
					//$html .= '<button class="remove-opt">' . __('-', 'sptheme_admin') . '</button>';
					$html .= '<div class="inside">';
					$html .= '<div class="rwmb-field">';
					
					//$html .= '<div class="rwmb-label"><label>' . __('Hotel info', 'sptheme_admin') . '</label></div>';
					
					if (is_array($option)){
						foreach( $option as $k => $v ){
							$html .= '<div class="rwmb-input">';
							$html .= '<span class="hotel-line">
									<select name="hotel_name_'.$options.'[]" id="hotelname_'.$options.'" class="hotel-name rwmb-select">
										<option value="null">Select hotel name</option>';
										foreach ($hotels as $key => $value) :
											$html .= '<option value="' . $key . '" ' . selected( $v[0], $key, false ) . '>' . $value . '</option>';
										endforeach;	
							$html .= '</select>';
							$html .= '<input type="text" name="hotel_type_'.$options.'[]" id="hotel_type_'.$options.'" value="'.$v[1].'" class="hotel-type">';
							$html .= '<select name="num_night_'.$options.'[]" id="num_night_'.$options.'" class="num-night rwmb-select">';
							$html .= '<option value="null">Number of night</option>';
										foreach ($days_of_tour as $key => $value) :
											$html .= '<option value="' . $key . '"' . selected( $v[2], $key, false ). '>' . $value . '</option>';
										endforeach;
							$html .= '</select>';
							$html .= '<button class="remove-hotel-line button-secondary">' . __('Remove hotel', 'sptheme_admin') . '</button>	
									</span>';
							$html .= '</div><!-- .rwmb-input -->';		
						}	
					}
					
					$html .= '<button id="add-hotel-line" class="add-hotel-line button-secondary">' . __('+ Add Hotel', 'sptheme_admin') . '</button>';
					$html .= '</div><!-- .rwmb-field -->';
					$html .= '<input type="hidden" name="' . $id . '[]" class="rwmb-text" size="30" value="">';
					$html .= '</div><!-- .inside -->';			
					$html .= '</li>';
					
				}	

			} else {

				$html .= '<li class="accom-opt-line postbox">';
				$html .= '<h4>Option 1</h4>';
				$html .= '<div class="inside">';
				$html .= '<div class="rwmb-field">';
				
				//$html .= '<div class="rwmb-label"><label>' . __('Hotel info', 'sptheme_admin') . '</label></div>';
				$html .= '<div class="rwmb-input">';
				$html .= '<span class="hotel-line">
						<select name="hotel_name_0[]" id="hotelname_0" class="hotel-name rwmb-select">
							<option value="null">Select hotel name</option>';
							foreach ($hotels as $key => $value) :
								$html .= '<option value="' . $key . '">' . $value . '</option>';
							endforeach;	
				$html .= '</select>';
				$html .= '<input type="text" name="hotel_type_0[]" id="hotel_type_0" class="hotel-type" placeholder="Room type">';
				$html .= '<select name="num_night_0[]" id="num_night_0" class="num-night rwmb-select">';
				$html .= '<option value="null">Number of night</option>';
							foreach ($days_of_tour as $key => $value) :
								$html .= '<option value="' . $key . '">' . $value . '</option>';
							endforeach;
				$html .= '</select>';
				$html .= '<button class="remove-hotel-line button-secondary">' . __('Remove hotel', 'sptheme_admin') . '</button>	
						</span>';
				$html .= '</div><!-- .rwmb-input -->';
				$html .= '<button id="add-hotel-line" class="add-hotel-line button-secondary">' . __('+ Add Hotel', 'sptheme_admin') . '</button>';

				$html .= '</div><!-- .rwmb-field -->';
				$html .= '<input type="hidden" name="' . $id . '[]" class="rwmb-text" size="30" value="">';
				$html .= '</div><!-- .inside -->';			
				$html .= '</li>';
			}			  
			$html .= '</ul>';			 
			$html .= '<p> <button id="add-accomm-line" class="button-primary">' . __('+ Add New Options', 'sptheme_admin') . '</button>';
			$html .= '<button id="remove-accomm-line" class="button-primary">' . __('- Remove Options', 'sptheme_admin') . '</button> </p>';
			$html .= '<input type="hidden" name="accom-info-meta-info" value="' . $post->ID . '|' . $id . '">'; 

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

			$accom_infos = array();
			$hotels = array();
			
			foreach ( $_POST[$name] as $k => $v ) {
				unset($hotels);
				foreach( $_POST['hotel_name_'.$k] as $key => $value){
					$hotels[$key] = array(
						$_POST['hotel_name_'.$k][$key],
						$_POST['hotel_type_'.$k][$key],
						$_POST['num_night_'.$k][$key],
					);
					//$hotels[$key] = $_POST['hotel_name_'.$k][$key];
				}
				$accom_infos[] = $hotels;
			}
			$new = maybe_serialize( $accom_infos );

			update_post_meta( $post_id, $name, $new );

		}
	}
}