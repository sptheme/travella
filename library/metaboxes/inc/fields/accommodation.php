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

			global $post, $commLine;

			$id = $field['id'];

			$accom_infos = get_post_meta( $post->ID, $id, true ) ? maybe_unserialize(get_post_meta( $post->ID, $id, true )) : false;

			echo '<pre>';
			print_r($accom_infos);
			echo '</pre>';

				$html = '<ul id="accom-infos">';
				$html .= '<li class="accom-opt-line postbox">';
				$html .= '<h4>Accommodation Option</h4>';
				$html .= '<div class="inside">';
				//$html .= '<div class="hotel-info-container">';
				$html .= '<div class="rwmb-field">';
				
				//$html .= '<div class="rwmb-label"><label>' . __('Hotel info', 'sptheme_admin') . '</label></div>';
				$html .= '<div class="rwmb-input">';
				$html .= '<span class="hotel-line">
						<select name="hotel[]" id="hotel" class="rwmb-select">';
							foreach ($commLine as $key => $value) :
								$html .= '<option value="' . $key . '">' . $value . '</option>';
							endforeach;	
				$html .= '</select>
						<button class="remove-hotel-line button-secondary">' . __('Remove hotel', 'sptheme_admin') . '</button>	
						<input type="hidden" name="hotel_info[]" id="hotel_info" value="">
						</span>
						<button id="add-hotel-line" class="add-hotel-line button-secondary">' . __('+ Add Hotel', 'sptheme_admin') . '</button>';
				$html .= '</div><!-- .rwmb-input -->';

				$html .= '</div><!-- .rwmb-field -->';
				$html .= '<input type="hidden" name="' . $id . '[]" class="rwmb-text" size="30" value="">';
				$html .= '</div><!-- .inside -->';			
				$html .= '</li>';
				$html .= '</ul>';			 
				$html .= '<p> <button id="add-accomm-line" class="button-primary">' . __('+ Add Options', 'sptheme_admin') . '</button> </p>

						  <input type="hidden" name="accom-info-meta-info" value="' . $post->ID . '|' . $id . '">'; 

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
				$accom_infos[] = array( 
					'hotel' => $_POST['hotels'][$k]
				);
				
			}
			$new = maybe_serialize( $accom_infos );

			update_post_meta( $post_id, $name, $new );

		}
	}
}