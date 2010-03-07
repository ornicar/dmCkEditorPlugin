<?php

class dmCkEditorActions extends dmBaseActions
{
  
  public function executeMedia(dmWebRequest $request)
  {
    $this->forward404Unless(
      ($mediaId = $request->getParameter('id')) &&
      ($media = dmDb::table('DmMedia')->findOneByIdWithFolder($mediaId))
    );
    
    return $this->renderText($this->getHelper()->media($media)->set('#ck-media-' . $mediaId));
  }

  public function executePage(dmWebRequest $request)
  {
    $this->forward404Unless(
      ($pageId = $request->getParameter('id')) &&
      ($page = dmDb::table('DmPage')->findOneByIdWithI18n($pageId))
    );
    
    return $this->renderText($this->getHelper()->link($page)->set('#dmPage-' . $pageId));
  }
}
