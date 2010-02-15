<?php

class dmCkEditorPluginConfiguration extends sfPluginConfiguration
{
  
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    $this->dispatcher->connect('dm.form_generator.widget_subclass', array($this, 'listenToFormGeneratorWidgetSubclassEvent'));

    $this->dispatcher->connect('dm.context.loaded', array($this, 'listenToContextLoadedEvent'));
  }

  public function listenToContextLoadedEvent(sfEvent $e)
  {
    if ($this->configuration instanceof dmAdminApplicationConfiguration)
    {
      $e->getSubject()->getResponse()
      ->addJavascript('dmCkEditorPlugin.adminLauncher')
      ->addStylesheet('dmCkEditorPlugin.adminStyle');
    }

    /*
     * Add ckeditor.js & jquery.js to javascript compressor black list
     */
    $e->getSubject()->get('javascript_compressor')->addToBlackList(array('ckeditor.js', 'jquery.js'));
  }
  
  public function listenToFormGeneratorWidgetSubclassEvent(sfEvent $e, $subclass)
  {
    if($this->isCkEditorColumn($e['column']))
    {
      $subclass = 'TextareaDmCkEditor';
    }

    return $subclass;
  }

  protected function isCkEditorColumn(sfDoctrineColumn $column)
  {
    return false !== strpos(dmArray::get($column->getTable()->getColumnDefinition($column->getName()), 'extra', ''), 'ckeditor');
  }

}