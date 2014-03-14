(function($)
{

	// Tabs
	/*--------------------------------------------------------------------------------------*/
	/* 	Tabs																				*/
	/*--------------------------------------------------------------------------------------*/
	$( '.tabber' ).each( function() {
		var widgets = $( this ).find( 'div.tabbed' );
		var titleList = '<ul class="ss-tabs clear">';
		for ( i = 0; i < widgets.length; i++ )
		{
			var widgetTitle = $( widgets[i] ).children( 'h4.tab_title' ).text();
			$( widgets[i] ).children( 'h4.tab_title' ).hide();
			var listItem = '<li><a href="#' + $( widgets[i] ).attr( 'id' ) + '">' + widgetTitle + '</a></li>';
			titleList += listItem;
		};
		titleList += '</ul>';
		$( widgets[0] ).before( titleList );
		$( this ).tabs();
		//$(this).tabs({fx:{ height: 'toggle', opacity: 'toggle', duration: 300 }});
	});

	/*--------------------------------------------------------------------------------------*/
	/* 	Accordion 																			*/
	/*--------------------------------------------------------------------------------------*/
	$('.accordion-container').accordion({
		header:'.accordion > .accordion-title',
		autoHeight:false,
		heightStyle: "content",
		collapsible:true,
		active:false
	});

	/*--------------------------------------------------------------------------------------*/
	/* 	Toggle Content 																		*/
	/*--------------------------------------------------------------------------------------*/
	// Hide the shortcode content
	$('.toggle .inner-content-sc').hide();
	
	// Toggle the content
	$('.toggle-title').click(function() {
		$(this).toggleClass('active').next().slideToggle('normal');
	});

	/*--------------------------------------------------------------------------------------*/
	/* 	Tabs Content 																		*/
	/*--------------------------------------------------------------------------------------*/
	$('.tabgroup').tabs();

	/*--------------------------------------------------------------------------------------*/
	/* 	Projects Hover 																		*/
	/*--------------------------------------------------------------------------------------*/
	$('.gallery-projects .project-item').hover(function(){
		$(this).find('img').stop().animate({
			opacity:0.05
		}, 300);

		$(this).find('.project-background').stop().animate({
			opacity:0.7
		}, 300);

		$(this).find('.project-info').stop().animate({
			opacity:1,
			top:'50%'
		}, 300);

		// Vertically center the project info div
		var infoDiv = $(this).find('.project-info');
		infoDiv.css({ marginTop:-infoDiv.outerHeight() / 2 })
	},
	function(){
		$(this).find('img').stop().animate({
			opacity:1
		}, 300);

		$(this).find('.project-background').stop().animate({
			opacity:0
		}, 300);

		$(this).find('.project-info').stop().animate({
			opacity:0,
			top:'40%'
		}, 150);
	});

}(jQuery));