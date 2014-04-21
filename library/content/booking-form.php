<?php global $post, $smof_data, $guests; ?><div id="booking-form" class="white-popup-block mfp-hide"><div id="result">Please fill information bellow to process your booking:</div><form class="send-tour-booking" action="" method="post">	<h3><?php echo __('Submit tour booking', SP_TEXT_DOMAIN); ?></h3>	<h4><?php echo __('Personal information', SP_TEXT_DOMAIN); ?></h4>	<label for="title"><?php echo __('Title', SP_TEXT_DOMAIN); ?></label>	<select id="title" name="title">		<option value="1">Mr.</option>		<option value="2">Ms.</option>	</select>	<label for="full_name"><?php echo __('Full name', SP_TEXT_DOMAIN); ?></label>	<input type="text" id="full_name" name="full_name" />	<label for="email"><?php echo __('Email address', SP_TEXT_DOMAIN); ?></label>	<input type="text" id="email" name="email" />	<label for="confirm_email"><?php echo __('Confirm email address', SP_TEXT_DOMAIN); ?></label>	<input type="text" id="confirm_email" name="confirm_email" />	<label for="phone_number"><?php echo __('Phone number', SP_TEXT_DOMAIN); ?></label>	<input type="text" id="phone_number" name="phone_number" />	<label for="country"><?php echo __('Country', SP_TEXT_DOMAIN); ?></label>	<select id="country" name="country">		<option value="0"><?php echo __('Select country', SP_TEXT_DOMAIN); ?></option>		<option value="1">United Sated</option>		<option value="2">France</option>	</select>	<label for="address"><?php echo __('Address', SP_TEXT_DOMAIN); ?></label>	<input type="text" id="address" name="address" />	<label for="town"><?php echo __('Town / City', SP_TEXT_DOMAIN); ?></label>	<input type="text" id="town" name="town">	<h4><?php echo __('Tour information', SP_TEXT_DOMAIN); ?></h4>	<h5><?php the_title(); ?></h5>	<label for="arrive_date"><?php echo __('Arrive date', SP_TEXT_DOMAIN); ?></label>	<input type="text" id="arrive_date" name="arrive_date" />		<label for="guests"><?php echo __('Adults', SP_TEXT_DOMAIN); ?></label>	<select id="guests" name="guests">	<?php foreach( $guests as $guest){ ?>		<option value="<?php echo $guest; ?>"><?php echo $guest; ?></option>	<?php } ?>	</select>		<label for="children"><?php echo __('Children', SP_TEXT_DOMAIN); ?></label>	<select id="children" name="children">	<?php foreach( $guests as $guest){ ?>		<option value="<?php echo $guest; ?>"><?php echo $guest; ?></option>	<?php } ?>	</select>	<label for="requirements"><?php echo __('Special requirements: (Not Guaranteed)', SP_TEXT_DOMAIN); ?></label>	<textarea cols="78" rows="10" name="requirements" id="requirements"></textarea>		<p><input type="submit" value="<?php echo __('Submit Booking', SP_TEXT_DOMAIN); ?>" /></p>	<input type="hidden" name="tour_name" value="<?php the_title(); ?>">	<input type="hidden" name="destination" value="<?php echo sp_get_tour_destination(); ?>"></form></div> <!-- #booking-form -->