<?php //allows you to modify the search parameters. for example bbpress search_id needs to be 'bbp_search' instead of 's'. you can also deactivate ajax search by setting ajax_disable to true$search_text = get_search_query();if ( empty( $search_text ) )	$search_text = __( 'Search this site', SP_TEXT_DOMAIN );$search_params = array(		'placeholder'  	=> $search_text,	'search_id'	   	=> 's',	'form_action'	=> home_url(),	'submit'		=> __('Search', SP_TEXT_DOMAIN));?><form action="<?php echo $search_params['form_action']; ?>" id="searchform-tour" method="get">	<input type="text" value="<?php echo $search_params['placeholder'] ?>" name="<?php echo $search_params['search_id']; ?>" id="$search_params['search_id'];" onblur="if (this.value == '')    {this.value = '<?php echo $search_params['placeholder'] ?>';}"    onfocus="if (this.value == '<?php echo $search_params['placeholder'] ?>')    {this.value = '';}" />    <input type="submit" id="submit-search" value="<?php echo $search_params['submit'];?>" /></form>