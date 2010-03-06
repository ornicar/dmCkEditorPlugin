CKEDITOR.plugins.add('dmMedia',
{
  init: function(editor)
  {
		var pluginName = 'dmMedia';
		var dialogName = editor.name + '_dialog';
		
		if ($('#'+dialogName).length == 0) {
			$('#dm_admin_content').append('<div id="' + dialogName +'"><input class="dm_ck_drop_zone"></input></div>');
	    $('#'+dialogName).children(':first').dmDroppableInput(function() {                    
	      $.ajax({
	        url: '/admin.php/+/dmMedia/index/id/' + $(this).val().split(' ')[0].split(':')['1'],
	        success: function(src) {
	          editor.setData(src + editor.getData());
	        }
	      });
	     });
		}
		
		var $droppable = $('#'+dialogName).children(':first');
	  editor.ui.addButton('dmImage', {
			label: 'Add media',
			click: function() {
	      $('#' + dialogName).dialog({
	        zIndex: 1,
					open: function(event, ui) {
						$droppable.val('');
					}
				});
			}
  });
}
});