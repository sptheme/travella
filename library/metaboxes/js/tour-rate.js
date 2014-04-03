jQuery( document ).ready( function($)  {

	var $tour_rate_infos = $('#tour-rates-info');

	// Add options
	$('#add-rate-line').click(function( e ) {
		var current_hotel_count = $('.rate-line').length - 1;
		var new_hotel_count = current_hotel_count+1;
		var $cloneElem = $('.rate-line').last().clone();
		$cloneElem.find('input[type=text]').val('').end()
				  .insertAfter( $('.rate-line').last() );

		$cloneElem.children('td').children('span').text('Opt '+(new_hotel_count+1));		  

		e.preventDefault();
	});

	// Remove options
	$('#remove-rate-line').click(function( e ) {
		if( $tour_rate_infos.find('tr.rate-line').length == 1 ) {
			alert('You need to have at least 1 option');
		} else {
			$('.rate-line').last().remove();
		}

		e.preventDefault();
	});

});