(function($) {

	$(function(){
		$('input[type="button"].media-select').click(function(){
			orginal_media_upload = wp.media.editor.send.attachment;
			wp.media.editor.send.attachment = function(props, attachment){
				$('#destination_thumb').val(attachment.url);
			}

			wp.media.editor.open(this);
			window.send_to_editor = orginal_media_upload;

			return false;
		});
	});

}(jQuery));