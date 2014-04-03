jQuery( document ).ready( function($)  {

	var $accom_infos = $('#accom-infos');

	// Add options
	$('#add-accomm-line').click(function( e ) {
		var current_hotel_count = $('.accom-opt-line').length - 1;
		var new_hotel_count = current_hotel_count+1;
		var $cloneElem = $('.accom-opt-line').last().clone();
		$cloneElem.find('select').prop('selectedIndex', 0).end()
				  .find('input[type=text]').val('').end()
				  .insertAfter( $('.accom-opt-line').last() );

		$cloneElem.children('h4').text('Option '+(new_hotel_count+1));		  

		$cloneElem.find('.hotel-name').each(function(){
			$(this).attr({
				'name': 'hotel_name_'+new_hotel_count+'[]',
				'id': 'hotel_name_'+new_hotel_count
			});
		});
		$cloneElem.find('.hotel-type').each(function(){
			$(this).attr({
				'name': 'hotel_type_'+new_hotel_count+'[]',
				'id': 'hotel_type_'+new_hotel_count,
				'placeholder': 'Room type'
			});
		});
		$cloneElem.find('.num-night').each(function(){
			$(this).attr({
				'name': 'num_night_'+new_hotel_count+'[]',
				'id': 'num_night_'+new_hotel_count,
				'placeholder': 'Number of night'
			});
		});

		e.preventDefault();
	});

	// Remove options
	$('#remove-accomm-line').click(function( e ) {
		if( $accom_infos.children('.accom-opt-line').length == 1 ) {
			alert('You need to have at least 1 option');
		} else {
			$('.accom-opt-line').last().remove();
		}

		e.preventDefault();
	});

	// Add hotels
	$accom_infos.delegate('.add-hotel-line', 'click', function( e ) {
		var $cloneElem = $(this).prev().last().clone();
		$cloneElem.insertAfter( $(this).prev().last() );

		e.preventDefault();
	});

	// Remove hotels
	$accom_infos.delegate('.remove-hotel-line', 'click', function( e ) {
		
		if( $(this).parent().parent().parent().children('.rwmb-input').length == 1 ) {
			alert('You need to have at least 1 hotel!');
		} else {
			$(this).parent().parent().remove();
		}
		e.preventDefault();
	});

});