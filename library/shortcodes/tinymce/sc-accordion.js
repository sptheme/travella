/**
 * Accordion Short code button
 */

( function() {
     tinymce.create( 'tinymce.plugins.accordion', {
        init : function( ed, url ) {
             ed.addButton( 'accordion', {
                title : 'Insert an accordion',
                image : url + '/ed-icons/accordion.png',
                onclick : function() {
						var width = jQuery( window ).width(), H = jQuery( window ).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Accordion Options', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=sc-accordion-form' );
                 }
             });
         },
         createControl : function( n, cm ) {
             return null;
         },
     });
	tinymce.PluginManager.add( 'accordion', tinymce.plugins.accordion );
	jQuery( function() {
		var form = jQuery( '<div id="sc-accordion-form"><table id="sc-accordion-table" class="form-table">\
							<tr>\
							<th><label for="accordion-new">New Accordion?</label></th>\
							<td>\
								<select id="accordion-new" name="accordion-new" size="1">\
									<option value="no" selected="selected">No</option>\
									<option value="yes">Yes</option>\
								</select>\
							</td>\
							</tr>\
							<tr>\
							<th><label for="section-title">Section title</label></th>\
							<td><input type="text" name="section-title" id="section-title" /></td>\
							</tr>\
							<tr>\
							<th><label for="section-content">Section content</label></th>\
							<td><textarea id="section-content" name="section-content" value="" rows="5"></textarea></td>\
							</tr>\
							</table>\
							<p class="submit">\
							<input type="button" id="sc-accordion-submit" class="button-primary" value="Insert Accordions" name="submit" />\
							</p>\
							</div>' );
		var table = form.find( 'table' );
		form.appendTo( 'body' ).hide();
		form.find( '#sc-accordion-submit' ).click( function() {

			var is_accordion = table.find( '#accordion-new' ).val(),
			title = table.find('#section-title').val(),
			content = table.find('#section-content').val(),
			shortcode = '';
			
			if (is_accordion == 'yes'){
				shortcode += '[accordion][accordion_section';
			} else{
				shortcode += '[accordion_section';
			}
			
			// Check if the title field is empty
			if (title) {
				shortcode += ' title=\"' + title + '\"]';
			}
			else {
				shortcode += ' title=\"Title Goes Here\"]';
			}
			
			// Check if the content field is empty
			if (content) {
				shortcode += content;
			}
			else {
				shortcode += 'Content Goes Here';
			}
			
			// Check if this is a new accordion
			if (is_accordion == 'yes') {
				shortcode += '[/accordion_section][/accordion]'; 
			}
			else {
				shortcode += '[/accordion_section]';
			}

			tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, shortcode );
			tb_remove();
		} );
	} );
 } )();