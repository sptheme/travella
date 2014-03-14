/**
 * hr Short code button
 */

( function() {
     tinymce.create( 'tinymce.plugins.biography', {
        init : function( ed, url ) {
             ed.addButton( 'biography', {
                title : 'Insert a Horizontal rule',
                image : url + '/ed-icons/biography.png',
                onclick : function() {
					ed.focus();
					ed.selection.setContent(' [biographies] ');
                 }
             });
         },
         createControl : function( n, cm ) {
             return null;
         },
     });
	tinymce.PluginManager.add( 'biography', tinymce.plugins.biography );
	
 } )();