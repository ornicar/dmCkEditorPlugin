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
  protected function updatePage($page) {
    
    $id = str_replace('dmPage-','',$page->id);
    if (!$id || !is_numeric($id))
      return;
      
    $_page = Doctrine_Core::getTable('DmPage')
      ->createQuery('p')
      ->innerJoin('p.Translation t')
      ->where('p.id = ?', $id)
      ->fetchOne();
    
    if (!$_page)
      return;
      
    $url = $this->helper->link($_page)->getHref();

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
      return;
    $media = Doctrine_Core::getTable('dmMedia')->findOneById($id);
    if (!$media)
      return;
    $src = $this->helper->media($media)->getSrc();
    if ($image->src != $src) 
    {
      $image->src = $src;
    }
  }
}