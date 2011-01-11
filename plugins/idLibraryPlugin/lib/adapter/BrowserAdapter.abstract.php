<?php

Abstract Class BrowserAdapter {
  
  protected $command_name;
  
  protected $content;
  protected $url;
  
  protected $tmp_dir;
  
  public function __construct() {
    $this->tmp_dir = DIRECTORY_SEPARATOR.'tmp';
  }
  
  public function setContent($content) {
    $this->content = $content;
  }
  
  public function getContent() {
    return $this->content;
  }
  
  public function setUrl($url) {
    $this->url = $url;
  }
  
  public function getUrl() {
    return $this->url;
  }
  
  public function setTmpDir($tmp_dir) {
    $this->tmp_dir = $tmp_dir;
  }
  
  public function getTmpDir() {
    return $this->tmp_dir;
  }
  
  private function urlIsValid() 
  {
    if($this->url == '' || !$this->url) {
      return false;
    }
    return true;
  }
  
  private function createTmpFile() 
  {
    $filename = tempnam($this->tmp_dir, 'adapter_');
    file_put_contents($filename, $this->content);
    $this->url = 'file://'.$filename;
  }
  
  public function open($url = null)
  {
      
    if(!$url && $this->content) 
    {
      $this->createTmpFile();
    } 
    else 
    {
      $this->url = $url;
    }
    
    if(!$this->urlIsValid()) 
    {
      throw new Exception('Url is not valid');
    }
    
    shell_exec($this->command_name.' '.$this->url);
    
    return true;
  }
}