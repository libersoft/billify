<?php

/**
 * Class ConsoleDecorator
 * 
 * Decorate an object to console view
 * 
 * @author Francesco (cphp) Trucchia <ft@ideato.it>
 * @version 0.1
 * @package ideato.lib
 * @subpackage decorator
 *
 */

Class ConsoleDecorator{
  
  var $propel_obj;
  
  public function __construct($obj){
    $this->obj = $obj;  
  }
  
  public function render(){
    
    $string = '';
    foreach ($this->obj->toArray() as $name => $value){
      $string .= $name.': '.$value."\n";
    }
    return $string;
  }
}