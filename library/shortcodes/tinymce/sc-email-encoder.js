/**
 * email_encoder Short code button
 */

( function() {
     tinymce.create( 'tinymce.plugins.email_encoder', {
        init : function( ed, url ) {
             ed.addButton( 'email_encoder', {
                title : 'Insert Email Encoder',
                image : url + '/ed-icons/email-encoder.png',
                onclick : function() {
						var width = jQuery( window ).width(), H = jQuery( window ).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Email Encoder Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=sc-email-encoder-form' );
                 }
             });
         },
         createControl : function( n, cm ) {
             return null;
         },
     });
	tinymce.PluginManager.add( 'email_encoder', tinymce.plugins.email_encoder );
	jQuery( function() {
		var form = jQuery( '<div id="sc-email-encoder-form"><table id="sc-email-encoder-table" class="form-table">\
							<tr>\
							<th><label for="sc-email-address">Email address</label></th>\
							<td><input type="text" name="sc-email-address" id="sc-email-address" /></td>\
							</tr>\
							<tr>\
							<th><label for="sc-email-subject">Subject</label></th>\
							<td><input type="text" name="sc-email-subject" id="sc-email-subject" /></td>\
							</tr>\
							</table>\
							<p class="submit">\
							<input type="button" id="sc-email-encoder-submit" class="button-primary" value="Insert Content Email" name="submit" />\
							</p>\
							</div>' );
		var table = form.find( 'table' );
		form.appendTo( 'body' ).hide();
		form.find( '#sc-email-encoder-submit' ).click( function() {
			var email_address = table.find( '#sc-email-address' ).val(),
			subject = table.find( '#sc-email-subject' ).val(),
			shortcode = '[email_encoder';
			if (email_address) {
				shortcode += ' email="' + email_address + '"';
			} else {
				shortcode += ' email="name@domainname.com"'; 
			}	
			if (subject) {
				shortcode += ' subject="' + subject + '"]';
			} else {
				shortcode += ' subject="General Inquirie"]';
			}	

			tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
			tb_remove();
		} );
	} );
 } )();