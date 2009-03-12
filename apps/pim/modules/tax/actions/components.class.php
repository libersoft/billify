<?php

class taxComponents extends paComponents
{
  public function executeEditBread()
  {
    $this->tax = TassaPeer::retrieveByPK($this->getRequestParameter('id'));
  }	
}