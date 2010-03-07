<?php

class dmWidgetContentCkEditorForm extends dmWidgetPluginForm
{

  public function configure()
  {
    parent::configure();

    $this->widgetSchema['html'] = new sfWidgetFormTextareaDmCkEditor(array(
      'ckeditor' => $this->getService('ckeditor')
    ));
    
    $this->validatorSchema['html'] = new sfValidatorString();
  }

  public function getStylesheets()
  {
    return array_merge(parent::getStylesheets(), array(
      'dmCkEditorPlugin.widgetForm'
    ));
  }

  public function getJavascripts()
  {
    $javascripts = parent::getJavascripts();
    array_unshift($javascripts, 'dmCkEditorPlugin.widgetForm');

    return $javascripts;
  }

  protected function renderContent($attributes)
  {
    return $this->getHelper()->tag('ul.dm_form_elements',
      $this->getHelper()->tag('li.dm_form_element.clearfix', $this['html']->field()->error()).
      $this['cssClass']->renderRow()
    );
  }
}