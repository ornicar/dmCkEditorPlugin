<?php

require_once dirname(__FILE__).'/vendor/simplehtmldom/simple_html_dom.php';

/**
 * 
 * @author Robert Gründler <robert@dubture.com>
 *
 */
class dmCkEditor 
{
  
  protected $helper;
  
  public function __construct(dmHelper $helper) 
  {
    $this->helper = $helper;
  }

  /**
   * Renders the ckeditor contents
   * @param string $data
   */
  public function render($data) 
  {
    
    $html = str_get_html($data);
    foreach ($html->find('img') as $image) 
    {
      $this->updateImage($image);
    }
    return $html;
    
  }

  /**
   * 
   * @param string $image
   */
  protected function updateImage($image) 
  {
    
    $id = str_replace('ck-media-','',$image->id);
    $media = Doctrine_Core::getTable('dmMedia')->findOneById($id);
    $src = $this->helper->media($media)->getSrc();
    if ($image->src != $src) 
    {
      $image->src = $src;
    }
  }
}