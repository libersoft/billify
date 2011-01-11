<?php

Class idTestResponse extends sfWebResponse {
  
  public function addStylesheet($css, $position = '', $options = array()){
    
    $options['absolute'] = true;
    
    parent::addStylesheet($css, $position, $options);
  }
}