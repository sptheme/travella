/**
 * Column Short code button
 */

( function() {
     tinymce.create( 'tinymce.plugins.col', {
        init : function( ed, url ) {
             ed.addButton( 'col', {
                title : 'Insert layout columns',
                image : url + '/ed-icons/layout.png',
                onclick : function() {
						var width = jQuery( window ).width(), H = jQuery( window ).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Layout Column Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=sc-col-form' );
                 }
             });
         },
         createControl : function( n, cm ) {
             return null;
         },
     });
	tinymce.PluginManager.add( 'col', tinymce.plugins.col );
	jQuery( function() {
		var form = jQuery( '<div id="sc-col-form"><table id="sc-col-table" class="form-table">\
							<tr>\
							<th><label for="sc-col-coltype">Available column sets:</label></th>\
							<td><select name="coltype" id="sc-col-coltype">\
							<option value="column-set-1">1 : 1</option>\
							<option value="column-set-2">1/2 : 1/2</option>\
							<option value="column-set-3">1/2 : 1/4 : 1/4</option>\
							<option value="column-set-4">1/4 : 1/4 : 1/2</option>\
							<option value="column-set-5">1/4 : 1/2 : 1/4</option>\
							<option value="column-set-6">1/4 : 1/4 : 1/4 : 1/4</option>\
							<option value="column-set-7">3/4 : 1/4</option>\
							<option value="column-set-8">1/4 : 3/4</option>\
							<option value="column-set-9">2/3 : 1/3</option>\
							<option value="column-set-10">1/3 : 2/3</option>\
							<option value="column-set-11">1/3 : 1/3 : 1/3</option>\
							</select><br />\
							<small>Select a column set to insert into page.</small></td>\
							</tr>\
							</table>\
							<p class="submit">\
							<input type="button" id="sc-col-submit" class="button-primary" value="Insert Columns" name="submit" />\
							</p>\
							</div>' );
		var table = form.find( 'table' );
		form.appendTo( 'body' ).hide();
		var dummy = '<p>Insert your content here. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus leo ante, consectetur sit amet vulputate vel, dapibus sit amet lectus.</p>';
		var nl = '<br /><br />';
		form.find( '#sc-col-submit' ).click( function() {
			var shortcode = '';
			var coltype = table.find( '#sc-col-coltype' ).val();
			switch( coltype ) {
				case 'column-set-1':
				shortcode = '[col type="full"]' + dummy + '[/col]';
				break;

				case 'column-set-2':
				shortcode = '[col type="two-fourth"]' + dummy + '[/col]' + nl + '[col type="two-fourth last"]' + dummy + '[/col]';
				break;

				case 'column-set-3':
				shortcode = '[col type="two-fourth"]' + dummy + '[/col]'+ nl + '[col type="one-fourth"]' + dummy + '[/col]' + nl + '[col type="one-fourth last"]' + dummy + '[/col]';
				break;

				case 'column-set-4':
				shortcode = '[col type="one-fourth"]' + dummy + '[/col]' + nl + '[col type="one-fourth"]' + dummy + '[/col]' + nl + '[col type="two-fourth last"]' + dummy + '[/col]';
				break;

				case 'column-set-5':
				shortcode = '[col type="one-fourth"]' + dummy + '[/col]' + nl + '[col type="two-fourth"]' + dummy + '[/col]' + nl + '[col type="one-fourth last"]' + dummy + '[/col]';
				break;

				case 'column-set-6':
				shortcode = '[col type="one-fourth"]' + dummy + '[/col]' + nl + '[col type="one-fourth"]' + dummy + '[/col]' + nl + '[col type="one-fourth"]' + dummy + '[/col]' + nl + '[col type="one-fourth last"]' + dummy + '[/col]';
				break;

				case 'column-set-7':
				shortcode = '[col type="three-fourth"]' + dummy + '[/col]' + nl + '[col type="one-fourth last"]' + dummy + '[/col]';
				break;

				case 'column-set-8':
				shortcode = '[col type="one-fourth"]' + dummy + '[/col]' + nl + '[col type="three-fourth last"]' + dummy + '[/col]';
				break;

				case 'column-set-9':
				shortcode = '[col type="two-third"]' + dummy + '[/col]' + nl + '[col type="one-third last"]' + dummy + '[/col]';
				break;

				case 'column-set-10':
				shortcode = '[col type="one-third"]' + dummy + '[/col]' + nl + '[col type="two-third last"]' + dummy + '[/col]';
				break;

				case 'column-set-11':
				shortcode = '[col type="one-third"]' + dummy + '[/col]' + nl + '[col type="one-third"]' + dummy + '[/col]' + nl + '[col type="one-third last"]' + dummy + '[/col]';
				break;
			}
			tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
			tb_remove();
		} );
	} );
 } )();