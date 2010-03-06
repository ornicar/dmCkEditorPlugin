( function(){
  
	
	$(document).bind('instanceReady.ckeditor', function() {
		
	});
	
  CKEDITOR.dialog.add('dmMedia', function(a){
		var b=a.lang.about;
		return {
			title:CKEDITOR.env.ie?b.dlgTitle:b.title,
			minWidth:390,
			minHeight:230,
			contents:[{
				id:'tab1',
				label:'',
				title:'',
				expand:true,
				padding:0,
				elements:[{
					type:'html',
					html:'<a>foo</a>'
				}]
			}],
			buttons:[CKEDITOR.dialog.cancelButton]
		};
	});
						
  CKEDITOR.dialog.add('insertHTML', function(editor) {
    return exampleDialog(editor);
  });
    
})();