<?php

class dmWidgetContentCkEditorView extends dmWidgetPluginView
{
  public function configure()
  {
    parent::configure();

    $this->addRequiredVar(array('html'));
  }

  protected function doRender()
  {
    $vars = $this->getViewVars();

    return $vars['html'];
  }

  public function doRenderForIndex()
  {
    return strip_tags($this->compiledVars['html']);
  }
}