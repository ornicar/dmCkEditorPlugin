<?php

class sfWidgetFormTextareaDmCkEditor extends sfWidgetFormTextarea
{
  /**
   * Constructor.
   *
   * Available options:
   *
   *  * config: The editor configuration
   *
   * @param array $options     An array of options
   * @param array $attributes  An array of default HTML attributes
   *
   * @see sfWidgetForm
   */
  protected function configure($options = array(), $attributes = array())
  {
    $this->addOption('config');

    $this->setOption('config', array_merge($this->getDefaultConfig(), dmArray::get($options, 'config', array())));

    $this->addOption('ckeditor');

    return parent::configure($options, $attributes);
  }

  public function getJavascripts()
  {
    return array(
      'dmCkEditorPlugin.ckEditor',
      'dmCkEditorPlugin.jQueryAdapter'
    );
  }

  /**
   * @param  string $name        The element name
   * @param  string $value       The value displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $attributes['class'] = dmArray::toHtmlCssClasses(array(
      dmArray::get($attributes, 'class'),
      'dm_ckeditor',
      json_encode($this->getOption('config'))
    ));

    if($ckEditor = $this->getOption('ckeditor'))
    {
      $value = $ckEditor->render($value);
    }

    return parent::render($name, $value, $attributes, $errors);
  }

  protected function getDefaultConfig()
  {
    return array_merge(array(
      'language' => dmDoctrineRecord::getDefaultCulture()
    ), sfConfig::get('dm_ckeditor_config'));
  }
}
