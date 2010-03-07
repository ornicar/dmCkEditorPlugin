/**
 * Create a droppable overlay on top of the ckeditor interface
 * @param {Object} editor 
 * @param {String} link the link for the ajax action
 */
function dmCkEditorCreateOverlay(editor, link) {

  var overlayid = 'drag_box_' + editor.name;
  $editor = $('#cke_' + editor.name);
  var offset = $editor.offset();
  $(document.body).append('<div id="'+overlayid+'"><input style="width: 100%; height: 100%;" /></div>');

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

CKEDITOR.plugins.add('diem',
{
  init: function(editor)
  {
    editor.on('instanceReady', function() {
      var overlayid;
      
      $('#dm_page_tree a.ui-draggable').live('dragstart', function(event, ui){
        overlayid = dmCkEditorCreateOverlay(editor, $.dm.ctrl.getHref('+/dmCkEditor/page/id/'));
      });

      $('#dm_page_tree a.ui-draggable').live('dragstop', function(event, ui) {
        $('#' + overlayid).remove();
      });
      
      $('#dm_media_browser li.image.ui-draggable').live('dragstart', function(event, ui) {
        overlayid = dmCkEditorCreateOverlay(editor, $.dm.ctrl.getHref('+/dmCkEditor/media/id/'));
      });

      $('#dm_media_browser li.image.ui-draggable').live('dragstop', function(event, ui) {
        $('#' + overlayid).remove();
      });
    });
  }
});