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
    
    foreach ($html->find('a.link') as $page) 
    {
      $this->updatePage($page);
    }
    return $html;
  }

  /**
   * @param string $page link to the page to update
   * @return void
   */
  protected function updatePage($page)
  {
    
    $id = str_replace('dmPage-','',$page->id);
    if (!$id || !is_numeric($id))
    {
      return;
    }
      
    $pageRecord = dmDb::table('DmPage')->findOneByIdWithI18n($id);
    
    if (!$pageRecord)
    {
      return;
    }
      
    $url = $this->helper->link($pageRecord)->getHref();

    if ($page->href != $url) 
    {
      $page->href = $url;
    }
  }
  
  /**
   * 
   * @param string $image
   * @return void
   */
  protected function updateImage($image) 
  {
    $id = str_replace('ck-media-','',$image->id);

    if (!$id || !is_numeric($id))
    {
      return;
    }
    
    $mediaRecord = dmDb::table('dmMedia')->findOneByIdWithFolder($id);

    if (!$mediaRecord)
    {
      return;
    }
    
    $src = $this->helper->media($mediaRecord)->getSrc();
    
    if ($image->src != $src) 
    {
      $image->src = $src;
    }
  }
}