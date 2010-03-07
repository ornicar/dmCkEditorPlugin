/**
 * Create a droppable overlay on top of the ckeditor interface
 * @param {Object} editor 
 * @param {String} link the link for the ajax action
 */
function createOverlay(editor, link) {

  var overlayid = 'drag_box_' + editor.name;
	$editor = $('#cke_' + editor.name);
	var offset = $editor.offset();
	$(document.body).append('<div id="'+overlayid+'"><input style="width: 100%; height: 100%;"></input></div>');
	 
	$('#' + overlayid).css({
		position: 'absolute',
		left: offset.left + 'px',
		top: offset.top + 'px',
		height: $editor.height() + 'px',
		width: $editor.width() + 'px',
		backgroundColor: 'white',
		opacity: 0.5,
		zIndex: 1000,
		display: 'block'
	}).find('input:first').dmDroppableInput(function() {
    $.ajax({
      url: link + $(this).val().split(' ')[0].split(':')['1'],
      success: function(src) {
        editor.setData(src + editor.getData());
      }
    });
  });
	return overlayid;
}

CKEDITOR.plugins.add('dmMedia',
{
  init: function(editor)
  {

		CKEDITOR.instances[editor.name].on('instanceReady', function() {
      var overlayid;
	    $('.image.ui-draggable').live('dragstart', function(event, ui) {
        overlayid = createOverlay(editor, '/admin.php/+/dmMedia/index/id/');			 	
      });
      
			$('#dm_page_tree li.ui-draggable').live('dragstart', function(event, ui){
				overlayid = createOverlay(editor, '/admin.php/+/dmMedia/page/id/');
			});
			
      $('#dm_page_tree li.ui-draggable').live('dragstop', function(event, ui) {
        $('#' + overlayid).remove();
      });
			
      $('.image.ui-draggable').live('dragstop', function(event, ui) {
        $('#' + overlayid).remove();
      });
		});
  }
});