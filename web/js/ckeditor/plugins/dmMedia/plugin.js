CKEDITOR.plugins.add('dmMedia',
{
  init: function(editor)
  {
		var pluginName = 'dmMedia';
		var dialogName = editor.name + '_dialog';
		var overlayid = 'drag_box_' + editor.name; 
		
		CKEDITOR.instances[editor.name].on('instanceReady', function() {
			
	    $('.image.ui-draggable').live('dragstart', function(event, ui) {
			 $editor = $('#cke_' + editor.name);
			 var offset = $editor.offset();
			 $(document.body).append('<div id="'+overlayid+'"><input style="width: 100%; height: 100%;"></input></div>');
			 
			 $('#' + overlayid).css({
			  position: 'absolute',
				left:  offset.left + 'px',
				top: offset.top + 'px',
				height: $editor.height() +'px',
				width: $editor.width() + 'px',
				backgroundColor: 'white',
				opacity: 0.5,
				zIndex: 1000,
				display: 'block'
			 }).find('input:first').dmDroppableInput(function() {
	        $.ajax({
	          url: '/admin.php/+/dmMedia/index/id/' + $(this).val().split(' ')[0].split(':')['1'],
	          success: function(src) {
	            editor.setData(src + editor.getData());
	          }
	        });
			  });
      });
		});
		
		$('.image.ui-draggable').live('dragstop', function(event, ui) {
			$('#' + overlayid).remove();
		});
}
});