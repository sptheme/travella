<?php global $smof_data, $adults;$custom_search_page = get_page_by_title($smof_data['search_tour_page']);//allows you to modify the search parameters. for example bbpress search_id needs to be 'bbp_search' instead of 'term'. you can also deactivate ajax search by setting ajax_disable to true$search_params_tour = array(		'placeholder'  	=> __('City, region, district or specific tour', SP_TEXT_DOMAIN),	'search_id'	   	=> 'term',	'form_action'	=> get_page_link($custom_search_page->ID),	'submit'		=> __('Search', SP_TEXT_DOMAIN));?><section id="search-wrap">	<div class="container clearfix"><form action="<?php echo $search_params_tour['form_action']; ?>" id="searchform-tour" method="get">	<ul>		<li>		<h4><?php echo __('Where?', SP_TEXT_DOMAIN); ?></h4>		<label for="<?php echo $search_params_tour['search_id']; ?>"><?php echo __('Tour location', SP_TEXT_DOMAIN); ?></label>		<input type="text" id="<?php echo $search_params_tour['search_id']; ?>" name="<?php echo $search_params_tour['search_id']; ?>" value="<?php if(!empty($_GET['term'])) echo $_GET['term']; ?>" placeholder='<?php echo $search_params_tour['placeholder']; ?>' />		</li>		<li>		<h4><?php echo __('When?', SP_TEXT_DOMAIN); ?></h4>		<label for="start_date"><?php echo __('Arrive date', SP_TEXT_DOMAIN); ?></label>		<input type="text" id="start_date" name="start_date" value="<?php if(!empty($_GET['start_date'])) echo $_GET['start_date']; ?>" />		</li>		<li class="col-guests">		<h4><?php echo __('Who?', SP_TEXT_DOMAIN); ?></h4>		<label for="guests"><?php echo __('Guests', SP_TEXT_DOMAIN); ?></label>		<select id="guests" name="guests">		<?php foreach( $adults as $adult){ ?>			<option value="<?php echo $adult; ?>"><?php echo $adult; ?></option>		<?php } ?>		</select>		</li>		<li class="col-btn-search">		<input type="submit" value="<?php echo $search_params_tour['submit']; ?>" id="searchform-tour" />		</li>	</ul></form>	</div><!-- .container .clearfix --></section> <!-- #search-wrap -->