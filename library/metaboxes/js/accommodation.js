jQuery( document ).ready( function($)  {

	var $accommodations = $('#accommodations'),
		$hotel_option  = $('.hotel-option'),
		$hotel_destination = $('.hotel-destination');
				
	// Fix for sortable jumping "bug"
	function adjustContainerHeight() {

		$accommodations.height('auto').height( $('#accommodations').height() );

	}
	adjustContainerHeight();	

	// Add slide
	$('#add-hotel-option').click(function( e ) {

		$accommodations.height('auto');

		var $cloneElem = $('.hotel-option').last().clone();

		$cloneElem.find('select').val('').end()
				  .find('input[type=text]').val('').end()
				  .insertAfter( $('.hotel-option').last() );

		adjustContainerHeight();

		e.preventDefault();
	});

	// Delete slide
	$accommodations.delegate('.remove-hotel-option', 'click', function( e ) {
		
		if( $accommodations.children('.hotel-option').length == 1 ) {

			$hotel_option.find('input[type=text]').val('').end()
				  .find('input[type=hidden]').val('').end()
				  .find('select').val('').end();

			adjustCommTypes( $(this) );
			
			alert('You need to have at least 1 slide!');
			

		} else {

			$(this).parents('.hotel-option').remove();
			adjustContainerHeight();

		}

		e.preventDefault();
	});
	

	// Sortable slides
	$accommodations.sortable({
		handle      : '.inside',
		placeholder : 'sortable-placeholder',
		sort        : function( event, ui ) {
			$('.sortable-placeholder').height( $(this).find('.ui-sortable-helper').height() );
		},
		tolerance   :'pointer'
	});

});