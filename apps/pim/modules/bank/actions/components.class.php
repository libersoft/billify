<?php

class bankComponents extends paComponents
{
  public function executeEditBread()
  {
    $this->bank = BancaPeer::retrieveByPK($this->getRequestParameter('id'));
  }	
}