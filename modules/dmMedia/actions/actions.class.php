<?php

class dmMediaActions extends dmBaseActions {
  
  public function executeIndex(dmWebRequest $request) {
    
    $this->setLayout(false);
    $media = Doctrine_Core::getTable('dmMedia')->findOneById($request->getParameter('id'));
    return $this->renderText($this->getHelper()->media($media)->set('#ck-media-' . $media->getId()));
    
  }

  public function executePage(dmWebRequest $request) {
    
    $this->setLayout(false);
    $page = Doctrine_Core::getTable('dmPage')->findOneById($request->getParameter('id'));
    return $this->renderText($this->getHelper()->link($page)->set('#dmPage-' . $page->getId()));
    
  }
}
