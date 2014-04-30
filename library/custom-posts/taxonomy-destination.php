<?php
add_action('init', 'sp_tax_destination_init', 0);

function sp_tax_destination_init() {
	
	register_taxonomy(
		'destination',
		array( 'tour' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'Location', 'sptheme_admin' ),
				'singular_name' => __( 'Location', 'sptheme_admin' ),
				'search_items' =>  __( 'Search Location', 'sptheme_admin' ),
				'all_items' => __( 'All Locations', 'sptheme_admin' ),
				'parent_item' => __( 'Parent Location', 'sptheme_admin' ),
				'parent_item_colon' => __( 'Parent Location:', 'sptheme_admin' ),
				'edit_item' => __( 'Edit Location', 'sptheme_admin' ),
				'update_item' => __( 'Update Location', 'sptheme_admin' ),
				'add_new_item' => __( 'Add New Location', 'sptheme_admin' ),
				'new_item_name' => __( 'Location', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'destination' ),
			'show_in_nav_menus' => true
		)
	);
}


// Create meta edit form
if ( ! function_exists( 'edit_destination' ) ) {
	
	function edit_destination($tag, $taxonomy) {
		$thumb = get_option( 'destination_'.$tag->term_id.'_thumb', '' );
		?>
		<tr class="form-field">
	        <th scope="row" valign="top"><label for="destination_thumb">Icon</label></th>
	        <td>
	            <input type="text" name="destination_thumb" id="destination_thumb" value="<?php echo $thumb; ?>" style="width: 80%;"/>
	            <input type="button" value="Select Image" class="media-select" id="destination_thumb_selectMedia" name="destination_thumb_selectMedia" style="width: 15%;">
	            <br />
	            <p class="description">Thumbnail for category</p>
	        </td>
	    </tr>
	    <?php
	}
	
}

// Create meta add form
if ( ! function_exists( 'add_destination' ) ) {

	function add_destination($tag) {
		?>
		<div class="form-field">
			<label for="destination_thumb">Icon</label>
			<input type="text" name="destination_thumb" id="destination_thumb" value="" style="width: 80%;"/>
	        <input type="button" value="Select Image" class="media-select" id="destination_thumb_selectMedia" name="destination_thumb_selectMedia" style="width: 15%;">
	            <br />
	            <p class="description">Thumbnail for category</p>
		</div>
		<?php
	}

}
add_action( 'destination_edit_form_fields', 'edit_destination', 10, 2);
add_action( 'destination_add_form_fields', 'add_destination', 10, 2);

// Save meta values
if ( ! function_exists( 'save_destination' ) ) {
	
	function save_destination($term_id, $tt_id) {
	    if (!$term_id) return;
	
		if (isset($_POST['destination_thumb'])){
			$name = 'destination_' .$term_id. '_thumb';
			update_option( $name, $_POST['destination_thumb'] );
		}
	}

}
add_action( 'created_destination', 'save_destination', 10, 2);
add_action( 'edited_destination', 'save_destination', 10, 2);

// Delete Meta values fields after delete category
if ( ! function_exists( 'delete_destination' ) ) {

	function delete_destination($id) {
		delete_option( 'destination_'.$id.'_thumb' );
	}
	
}
add_action( 'deleted_term_taxonomy', 'delete_destination' );	

// Show meta values in table column
if ( ! function_exists( 'destination_columns' ) ) {

	function destination_columns($category_columns) {
		$new_columns = array(
			'cb'        		=> '<input type="checkbox" />',
			'name'      		=> __('Name', SP_TEXT_DOMAIN),
			'description'     	=> __('Description', SP_TEXT_DOMAIN),
			'thumbnail' 		=> __('Thumbnail', SP_TEXT_DOMAIN),
			'slug'      		=> __('Slug', SP_TEXT_DOMAIN),
			'posts'     		=> __('Items', SP_TEXT_DOMAIN),
			);
		return $new_columns;
	}

}
add_filter("manage_edit-destination_columns", 'destination_columns');


// Render meta value into table column
if ( ! function_exists( 'manage_destination_columns' ) ) {

	function manage_destination_columns($out, $column_name, $cat_id) {
	
		$thumb = get_option( 'destination_'.$cat_id.'_thumb', '' );
		$image = aq_resize( $thumb, 150, 86, true );
	
		switch ($column_name) {
			case 'thumbnail':
				if(!empty($thumb)){

					$out = '<img src="'. $image .'" alt="">';
				}
	 			break;
	 		default:
				break;
		}
		return $out;
	}

}
add_filter("manage_destination_custom_column", 'manage_destination_columns', 10, 3);