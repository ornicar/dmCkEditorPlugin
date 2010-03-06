<?php

class dmMediaActions extends dmBaseActions {
  
  public function executeIndex(dmWebRequest $request) {
    
    $this->setLayout(false);
    $this->media = Doctrine_Core::getTable('dmMedia')->findOneById($request->getParameter('id'));
    
  }  
}
