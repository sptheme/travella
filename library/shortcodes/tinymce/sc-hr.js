/**
 * hr Short code button
 */

( function() {
     tinymce.create( 'tinymce.plugins.horz_rule', {
        init : function( ed, url ) {
             ed.addButton( 'horz_rule', {
                title : 'Insert a Horizontal rule',
                image : url + '/ed-icons/hr.png',
                onclick : function() {
						var width = jQuery( window ).width(), H = jQuery( window ).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Line Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=sc-hr-form' );
                 }
             });
         },
         createControl : function( n, cm ) {
             return null;
         },
     });
	tinymce.PluginManager.add( 'horz_rule', tinymce.plugins.horz_rule );
	jQuery( function() {
		var form = jQuery( '<div id="sc-hr-form"><table id="sc-hr-table" class="form-table">\
							<tr>\
							<th><label for="sc-hr-style">Horizontal Rule Style</label></th>\
							<td><select name="style" id="sc-hr-style">\
							<option value="single">Single line</option>\
							<option value="double">Double line</option>\
							<option value="dashed">Dashed line</option>\
							<option value="dotted">Dotted line</option>\
							</select><br />\
							<small>Select a style for horizontal rule.</small></td>\
							</tr>\
							<tr>\
							<th><label for="sc-hr-margin-top">Margin top</label></th>\
							<td><input type="text" name="sc-hr-margin-top" id="sc-hr-margin-top" /><small>(Without px. Default value is 40)</small></td>\
							</tr>\
							<tr>\
							<th><label for="sc-hr-margin-bottom">Margin bottom</label></th>\
							<td><input type="text" name="sc-hr-margin-bottom" id="sc-hr-margin-bottom" /><small>(Without px. Default value is 40)</small></td>\
							</tr>\
							</table>\
							<p class="submit">\
							<input type="button" id="sc-hr-submit" class="button-primary" value="Insert Line" name="submit" />\
							</p>\
							</div>' );
		var table = form.find( 'table' );
		form.appendTo( 'body' ).hide();
		form.find( '#sc-hr-submit' ).click( function() {
			var value = table.find( '#sc-hr-style' ).val(),
			margin_top = table.find( '#sc-hr-margin-top').val(),
			margin_bottom = table.find( '#sc-hr-margin-bottom' ).val(),
			shortcode = '[hr style="' + value + '"';
			if(margin_top)
				shortcode += ' margin_top="' + margin_top + '"';
			if(margin_bottom)
				shortcode += ' margin_bottom="' + margin_bottom + '"';
			shortcode +=']';

			tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
			tb_remove();
		} );
	} );
 } )();