/**
 * Project Grid Short code button
 */

(function($) {
     tinymce.create( 'tinymce.plugins.slider', {
        init : function( ed, url ) {
             ed.addButton( 'slider', {
                title : 'Insert slideshow',
                image : url + '/ed-icons/slider.png',
                onclick : function() {
						var width = jQuery( window ).width(), H = jQuery( window ).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Slideshow Options', 'admin-ajax.php?action=sp_slider_shortcode&width=' + W + '&height=' + H );					                 }
             });
         },
         getInfo : function() {
				return {
						longname : 'SP Theme',
						author : 'Sopheak Peas',
						authorurl : 'http://www.linkedin.com/in/sopheakpeas',
						infourl : 'http://www.linkedin.com/in/sopheakpeas',
						version : '1.0.1'
				};
		}
     });
	tinymce.PluginManager.add( 'slider', tinymce.plugins.slider );

	// handles the click event of the submit button
	$('body').on('click', '#sc-slider-form #option-submit', function() {
		form = $('#sc-slider-form');
		// defines the options and their default values
		// again, this is not the most elegant way to do this
		// but well, this gets the job done nonetheless
		var options = { 
			'slide_id' : null,
			'slide_num' : null
			};
		var shortcode = '[slider';
		
		for( var index in options) {
			var value = form.find('#'+index).val();
			
			// attaches the attribute to the shortcode only if it's different from the default value
			if ( value !== options[index] )
				shortcode += ' ' + index + '="' + value + '"';
		}
		
		shortcode += ']';
			
		// inserts the shortcode into the active editor
		tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
		// closes Thickbox
		tb_remove();
		
		
	});
	
})(jQuery);