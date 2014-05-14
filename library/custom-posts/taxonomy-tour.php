<?php
add_action('init', 'sp_tax_tour_type_init', 0);

function sp_tax_tour_type_init() {
	register_taxonomy(
		'tour-type',
		array( 'tour' ),
		array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'Tour type', 'sptheme_admin' ),
				'singular_name' => __( 'tour type', 'sptheme_admin' ),
				'search_items' =>  __( 'Search tour type', 'sptheme_admin' ),
				'all_items' => __( 'All tour types', 'sptheme_admin' ),
				'parent_item' => __( 'Parent tour type', 'sptheme_admin' ),
				'parent_item_colon' => __( 'Parent tour type:', 'sptheme_admin' ),
				'edit_item' => __( 'Edit tour type', 'sptheme_admin' ),
				'update_item' => __( 'Update tour type', 'sptheme_admin' ),
				'add_new_item' => __( 'Add New tour type', 'sptheme_admin' ),
				'new_item_name' => __( 'tour type', 'sptheme_admin' )
			),
			'sort' => true,
			'rewrite' => array( 'slug' => 'tour-type' ),
			'show_in_nav_menus' => false
		)
	);
}

// Create meta edit form
if ( ! function_exists( 'edit_tour_type' ) ) {
	
	function edit_tour_type($tag, $taxonomy) {
		$thumb = get_option( 'tour_type_'.$tag->term_id.'_thumb', '' );
		?>
		<tr class="form-field">
	        <th scope="row" valign="top"><label for="tour_type_thumb">Icon</label></th>
	        <td>
	            <input type="text" name="tour_type_thumb" id="tour_type_thumb" value="<?php echo $thumb; ?>" style="width: 80%;"/>
	            <input type="button" value="Select Image" class="media-select" id="tour_type_thumb_selectMedia" name="tour_type_thumb_selectMedia" style="width: 15%;">
	            <br />
	            <p class="description">Thumbnail for category</p>
	        </td>
	    </tr>
	    <?php
	}
	
}

// Create meta add form
if ( ! function_exists( 'add_tour_type' ) ) {

	function add_tour_type($tag) {
		?>
		<div class="form-field">
			<label for="tour_type_thumb">Icon</label>
			<input type="text" name="tour_type_thumb" id="tour_type_thumb" value="" style="width: 80%;"/>
	        <input type="button" value="Select Image" class="media-select" id="tour_type_thumb_selectMedia" name="tour_type_thumb_selectMedia" style="width: 15%;">
	            <br />
	            <p class="description">Thumbnail for category</p>
		</div>
		<?php
	}

}
add_action( 'tour-type_edit_form_fields', 'edit_tour_type', 10, 2);
add_action( 'tour-type_add_form_fields', 'add_tour_type', 10, 2);

// Save meta values
if ( ! function_exists( 'save_tour_type' ) ) {
	
	function save_tour_type($term_id, $tt_id) {
	    if (!$term_id) return;
	
		if (isset($_POST['tour_type_thumb'])){
			$name = 'tour_type_' .$term_id. '_thumb';
			update_option( $name, $_POST['tour_type_thumb'] );
		}
	}

}
add_action( 'created_tour-type', 'save_tour_type', 10, 2);
add_action( 'edited_tour-type', 'save_tour_type', 10, 2);

// Delete Meta values fields after delete category
if ( ! function_exists( 'delete_tour_type' ) ) {

	function delete_tour_type($id) {
		delete_option( 'tour_type_'.$id.'_thumb' );
	}
	
}
add_action( 'deleted_term_taxonomy', 'delete_tour_type' );	

// Show meta values in table column
if ( ! function_exists( 'tour_type_columns' ) ) {

	function tour_type_columns($category_columns) {
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
add_filter("manage_edit-tour-type_columns", 'tour_type_columns');


// Render meta value into table column
if ( ! function_exists( 'manage_tour_type_columns' ) ) {

	function manage_tour_type_columns($out, $column_name, $cat_id) {
	
		$thumb = get_option( 'tour_type_'.$cat_id.'_thumb', '' );
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
add_filter("manage_tour-type_custom_column", 'manage_tour_type_columns', 10, 3);