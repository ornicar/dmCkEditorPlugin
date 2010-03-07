(function($)
{
  // on page load
  $(function()
  {

    $.dmAdminLaunchCkEditor = function()
    {
      // starts all players in the page
      $('textarea.dm_ckeditor').each(function()
      {
        var $this = $(this), options = $this.metadata();
        $this.ckeditor(options);
      });
    };

    $.dmAdminLaunchCkEditor();
  });
  
})(jQuery);
