<?php

Class idTestController extends sfFrontWebController {
  
  public function genUrl($parameters = array(), $absolute = false) {
    return parent::genUrl($parameters, true);
  }
  
}