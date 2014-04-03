<?php
// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'RWMB_Tour_Rate_Field' ) ) 
{
	class RWMB_Tour_Rate_Field extends RWMB_Field
	{
		/**
		 * Enqueue scripts and styles
		 *
		 * @return void
		 */
		static function admin_enqueue_scripts()
		{
			wp_enqueue_style( 'rwmb-tour-rate', RWMB_CSS_URL . 'tour-rate.css', array(), RWMB_VER );
			wp_enqueue_script( 'rwmb-tour-rate', RWMB_JS_URL.'tour-rate.js', array(), RWMB_VER, true );
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

			global $post, $type_tour_rate;

			$id = $field['id'];

			$tour_rates = get_post_meta( $post->ID, $id, true ) ? maybe_unserialize(get_post_meta( $post->ID, $id, true )) : false;
			
			$html = '<div id="tour-rates-info">';

				$html .= '<div class="inside">';
				$html .= '<div class="rwmb-field">';
				
				$html .= '<div class="rwmb-input">';
				$html .= '<table>';
				$html .= '<tr>';
				$html .= '<th>&nbsp;</th>';	
				foreach ($type_tour_rate as $key => $value) {
					$html .= '<th>'.$value.'</th>';	
				}
				$html .= '</tr>';
			if ($tour_rates){
				foreach ( $tour_rates as $options => $option ) {		
					$html .= '<tr class="rate-line">';
					$html .= '<td>';
					$html .= '<span>Opt ' . ($options+1) . '</span>';
					$html .= '<input type="hidden" name="' . $id . '[]" class="rwmb-text" size="30" value="">';
					$html .= '</td>';						
					foreach ($type_tour_rate as $key => $value) {
						$html .= '<td><input type="text" name="pax_price_'.$key.'[]" class="pax-price" size="3" value="'.$option[$key-1].'"></td>';
					}
					$html .= '</tr>';
				}	

			} else {
				$html .= '<tr class="rate-line">';
				$html .= '<td>';
				$html .= '<span>Opt 1</span>';
				$html .= '<input type="hidden" name="' . $id . '[]" class="rwmb-text" size="30" value="">';
				$html .= '</td>';
				foreach ($type_tour_rate as $key => $value) {
					$html .= '<td><input type="text" name="pax_price_'.$key.'[]" class="pax-price" size="3"></td>';
				}
				$html .= '</tr>';
			}
			$html .= '</table>';
			$html .= '<p> <button id="add-rate-line" class="button-primary">' . __('+ Add New Rate', 'sptheme_admin') . '</button>';
			$html .= '<button id="remove-rate-line" class="button-primary">' . __('- Remove Rate', 'sptheme_admin') . '</button></p>';
			$html .= '</div><!-- .rwmb-input -->';
			
			$html .= '</div><!-- .rwmb-field -->';
			$html .= '</div><!-- .inside -->';			
			$html .= '</div>';			 
			$html .= '<input type="hidden" name="tour-rate-meta-info" value="' . $post->ID . '|' . $id . '">'; 

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

			$tour_rates = array();
			
			foreach ( $_POST[$name] as $k => $v ) {
				$tour_rates[] = array(
					$_POST['pax_price_1'][$k],
					$_POST['pax_price_2'][$k],
					$_POST['pax_price_3'][$k],
					$_POST['pax_price_4'][$k],
					$_POST['pax_price_5'][$k],
					$_POST['pax_price_6'][$k],
					$_POST['pax_price_7'][$k],
					$_POST['pax_price_8'][$k]
				);
			}
			$new = maybe_serialize( $tour_rates );

			update_post_meta( $post_id, $name, $new );

		}
	}
}